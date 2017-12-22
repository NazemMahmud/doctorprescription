<?php
/**
 * Created by PhpStorm.
 * User: Nazem Mahmud
 * Date: 9/7/2017
 * Time: 1:18 AM
 */

namespace App\Http\Controllers;

use App\Notification;
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
//        return view('dashboard', ['patients'=>$patients]);
        return view('doctor', ['patients'=>$patients]); // doctor
//        if (Auth::check()) {
////            return redirect('/home');
//        return view('home');
////            return redirect()->route('doctor.dashboard') ;
//        }else{
//            return view('welcome');
//        }//return view('home');
    }

    public function approval(Request $request)
    {
//        $sub_doc = Doctor::where('id', $listid)->first();
        return view('doctor_approval'); // doctor
//        return view('doctor_approval', ['sub_doc'=>$sub_doc]); // doctor
    }
    public function ajax(Request $request)
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

    public function Notification(Request $request)
    {
        $token = $request["token"];
        if($request["view"] != '')
        {
                $update_query =Notification::where('to_doc_id', Auth::id())->where('notification_status', 0)->update(['notification_status' => 1]); //"UPDATE comments SET comment_status=1 WHERE comment_status=0";
//                Answer::where('question_id', 2)->update(['customer_id' => 1, 'answer' => 2]);
        }
        $notifications = Notification::where('to_doc_id', Auth::id())->get(); //"SELECT * FROM comments ORDER BY comment_id DESC LIMIT 5"; $result = mysqli_query($connect, $query);
////            $notificationCount = $notification->count();
        $returnHTML = view('notification_fetch')->with('notifications',$notifications)->render();

        $query_1 = Notification::where('to_doc_id', Auth::id())->where('notification_status', 0)->get(); //"SELECT * FROM comments WHERE comment_status=0";  $result_1 = mysqli_query($connect, $query_1);
        $count = $query_1->count();      //$result_1);
        return response()->json(array('success' => true, 'notification' => $returnHTML, 'unseen_notification' => $count ));




    }
}


//        return view('admin'); // view create korte hobe admin=  admin.blade.php
