<?php
/**
 * Created by PhpStorm.
 * User: Nazem Mahmud
 * Date: 9/7/2017
 * Time: 1:18 AM
 */

namespace App\Http\Controllers;

use App\DoctorPermission;
use App\Notification;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Patient;
use App\Doctor;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:doctor', ['except'=>['ajax']]); // default gurad auth:web ; guest dile Auth::guest kaj kore, r auth dile
//        $this->middleware('auth', ['except' => ['getActivate', 'anotherMethod']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (Auth::guest()) {
//            return view('welcome');
//        }
        $patients = Patient::orderBy('created_at', 'desc')->where('doctor_id', Auth::id())->get();
        $doctor = Doctor::where('id', Auth::id())->first();
        $user_type = $doctor->admin_type;
        if($user_type!='doctor'){
            $user_senior = $doctor->senior_docid;
//            $permission = DoctorPermission::('doc_Id', Auth::id())->where('permission_Id', 1)->where('permission_Id', 1)->first();
            $patients = Patient::orderBy('created_at', 'desc')->where('doctor_id', $user_senior)->get();
        }
        return view('doctor', ['patients'=>$patients]); // doctor
//        if (Auth::check()) {
////            return redirect('/home');
//        return view('home');
////            return redirect()->route('doctor.dashboard') ;
//        }else{
//            return view('welcome');
//        }//return view('home');
    }

    public function approval(Request $request) // when someone open account as PA or assistant doc, then this method is called
    {
//        $sub_doc = Doctor::where('id', $listid)->first();
        return view('doctor_approval'); // doctor
//        return view('doctor_approval', ['sub_doc'=>$sub_doc]); // doctor
    }
    public function ajax(Request $request) // on key doctor name show up @ sign as PA or assistant doc
    {
        $search = $request['name'];
        $token = $request["token"];
        $name = Doctor::where('name','like','%'.$search.'%' )->take(3)->get();
//        $search_name = DB::table('doctors')->where('name', $search)->get();
        $returnHTML = view('ajax1')->with('name',$name)->render();
//        $returnHTML = view('ajax1')->render();
//        $id = $request['id'];
//        $id = $id + 1;
        //if($request->ajax()) {
            return response()->json(array('success' => true, 'html' => $returnHTML));
       // }
    }

    public function Notification(Request $request) // Notification ; At present only for PA / Assistant Doc request
    {
        $token = $request["token"];
        if($request["view"] != '')
        {
            $update_query =Notification::where('to_doc_id', Auth::id())->where('notification_status', 0)->update(['notification_status' => 1]); //"UPDATE comments SET comment_status=1 WHERE comment_status=0";
//          Answer::where('question_id', 2)->update(['customer_id' => 1, 'answer' => 2]);
        }
        $notifications = Notification::where('to_doc_id', Auth::id())->where('accept_status', 0)->get(); //"SELECT * FROM comments ORDER BY comment_id DESC LIMIT 5"; $result = mysqli_query($connect, $query);
//        $delete_request = Notification::where('accept_status', '>', 0)->delete();
        $msg = ' ';
        $returnHTML = view('notification_fetch')->with(['notifications'=>$notifications, 'msg'=>$msg])->render();

        $query_1 = Notification::where('to_doc_id', Auth::id())->where('notification_status', 0)->get(); //"SELECT * FROM comments WHERE comment_status=0";  $result_1 = mysqli_query($connect, $query_1);
        $count = $query_1->count();      //$result_1);
        return response()->json(array('success' => true, 'notification' => $returnHTML, 'unseen_notification' => $count ));
    }

    public function request_handle(Request $request) // PA/ Assistant doc request Accept/ Reject
    {
        $notifications = Notification::where('to_doc_id', Auth::id())->get();
        $notification_id = $request['notification_id'];
        $request_value = $request['request_value']; // yes / no

        $notification = Notification::where('notification_id', $notification_id)->first();
        $notification_type = $notification->notification_type; // request pa / request assistant / .....
        $doctor_id = $notification->from_doc_id;

        $msg = '';
        if($request_value=='yes'){ //
            $update_query1 =Notification::where('notification_id', $notification_id)->update(['accept_status' => 1]);
            $update_query2 =Doctor::where('id', $notification->from_doc_id)->update(['active' => 1]);

            for($i =1 ; $i<=7 ; $i++) {
                    //                $table->increments('DP_Id');
                    $add_permission = new DoctorPermission();
                    $add_permission->permission_Id = $i;
                    $add_permission->doc_Id = $doctor_id;
                    $add_permission->active = 0;
                    $add_permission->save();
            }
        }
        else if($request_value=='no'){
            $update_query =Notification::where('notification_id', $notification_id)->update(['accept_status' => 2]);
        }

        $returnHTML = view('notification_fetch')->with(['notifications'=>$notifications])->render();

        return response()->json(array('notification' => $returnHTML));
    }

    public function Assistants(Request $request) // for assistants page
    {
        $doctor = Doctor::where('id', Auth::id())->first();
        $assistants = Doctor::where('senior_docid', Auth::id())->where('active', 1)->get();
        $permissions = Permission::get();
        $permissions_count = count($permissions);

        return view('assistants', ['docotr'=>$doctor, 'assistants'=>$assistants, 'permissions'=>$permissions, '$permissions_count'=>$permissions_count]);
    }

    public function Permissions(Request $request) // post type
    {
        $assistants = DoctorPermission::where('doc_Id', $request['assist-doctor-id'])->get();
        $assistants_count = count($assistants);
        if($assistants_count<=0){
            if($request->has('permission_name')){
                foreach ($request->input("permission_name") as $permission) {
    //                $table->increments('DP_Id');
                    $add_permission = new DoctorPermission();
                    $add_permission->permission_Id = $permission;
                    $add_permission->doc_Id = $request['assist-doctor-id'];
                    $add_permission->active = 1;
                    $add_permission->save();
                }
            }
        }
        else if($assistants_count>0){
            // 1--- doctor_permissions table e ei assistant er under e ja ase all active = 0 kore fela
            $clear_permissions = DoctorPermission::where('doc_Id', $request['assist-doctor-id'])->where('active', 1)->update(['active' => 0]);
            if($request->has('permission_name')) {
                foreach ($request->input("permission_name") as $permission) {
//                2--- doctor_permissions table e ei assistant er under e jeshob active = 0, update those to active =1
                    $find_permission = DoctorPermission::where('doc_Id', $request['assist-doctor-id'])->where('permission_Id', $permission)->first();
                    if (count($find_permission) > 0) {
//                    $add_permission = DoctorPermission::where('doc_Id', $request['assist-doctor-id'])->where('active', 1)->get();
                        $update_active_query = DoctorPermission::where('doc_Id', $request['assist-doctor-id'])->where('permission_Id', $permission)->where('active', 0)->update(['active' => 1]);
                    } //              3--- doctor_permissions table e ei assistant er under e new permission ashle add kora, jegula DB te ekhono add hoynai
                    else {
                        $add_permission = new DoctorPermission();
                        $add_permission->permission_Id = $permission;
                        $add_permission->doc_Id = $request['assist-doctor-id'];
                        $add_permission->active = 1;
                        $add_permission->save();
                    }

                }
            }
        }

        $doctor = Doctor::where('id', Auth::id())->first();
        $assistants = Doctor::where('senior_docid', Auth::id())->where('active', 1)->get();
        $permissions = Permission::get();
        $permissions_count = count($permissions);

        return view('assistants', ['docotr'=>$doctor, 'assistants'=>$assistants, 'permissions'=>$permissions, '$permissions_count'=>$permissions_count]);

    }
}


//        return view('admin'); // view create korte hobe admin=  admin.blade.php
