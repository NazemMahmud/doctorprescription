<?php
/**
 * Created by PhpStorm.
 * User: Nazem Mahmud
 * Date: 9/7/2017
 * Time: 1:18 AM
 */

namespace App\Http\Controllers;

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
}


//        return view('admin'); // view create korte hobe admin=  admin.blade.php
