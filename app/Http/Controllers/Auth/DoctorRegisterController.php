<?php

namespace App\Http\Controllers\Auth;

use App\Doctor;
use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DoctorRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:doctor');  // guest = middleware ; web = guard default guard
// guest = middleware ; admin = guard ; ['except'=>['logout'] = except logout method; noile loguot korar jonno w age log out korte hobe :(
//        $this->middleware('guest:admin', ['except'=>['logout']] );
    }

//    public function showRegistrationForm()
//    {
//     //   return view('auth.admin-register');
//    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:doctors',
            'password' => 'required|string|min:6|confirmed',
        ]);
//        //         take data from front-end form
        $name = $request['name'];
        $email = $request['email'];
        $password = bcrypt($request['password']);

        $sign_as = $request['sign_as'];
        if($sign_as == 'doctor'){
            //        store data into db column
            $doctor = new Doctor();
            $doctor->name = $name ;
            $doctor->email = $email;
            $doctor->password = $password ;
            $doctor->admin_type = $sign_as ;
            $doctor->active = 1 ;
            $doctor->save(); //        save data

            Auth::guard('doctor')->login($doctor);
//        Auth::login($doctor);// for doctor login;  // for user login; Auth::guard('admin')->login($admin);
//
            return redirect()->route('doctor.dashboard');
        }else{
            $which_doc = $request['which_doc'];
            $doc = Doctor::where('name', $which_doc)->first();
            $doc_id = $doc->id;

            $doctor = new Doctor();
            $doctor->name = $name ;
            $doctor->email = $email;
            $doctor->password = $password ;
            $doctor->admin_type = $sign_as ;
            $doctor->active = 0 ;
            $doctor->senior_docid = $doc_id ;
            $doctor->save(); //        save data

            $notification = new Notification();
            $notification->to_doc_id = $doc_id ; // notification to which doctor
//            $notification->notification_text = $name.' '. $email; // Nou ish requested to be your Personal Assistant
            $notification->from_doc_id = $doctor->id ;
            if($sign_as == 'pa') {
                $notification->notification_type = 'request pa'; // as personal assistant
            }else if($sign_as == 'assistant') {
                $notification->notification_type = 'request assistant'; // assistant doctor
            }
            $notification->notification_status = 0 ; // by default 0 ; accept korle 1, means seen
            $notification->accept_status = 0 ; // by default 0 ; accept korle 1, reject korle 2
            $notification->save(); //        save data

            Auth::guard('doctor')->login($doctor);
            return redirect()->route('doctor.approval');
//            return redirect()->route('doctor.approval',['listid'=>$id] );
        }

    }


//    public function showLoginForm()
//    {
//        //        return view('auth.admin-login');  //auth is folder name; admin-login is blade view
//    }
}








//
//use Illuminate\Support\Facades\Auth;
//
//class AdminLoginController extends Controller
//{
//
////    public function showRegisterForm()
////    {
////        return view('auth.admin-register');  //auth is folder name; admin-login is blade view
////    }
//
//    public function login(Request $request)
//    {
//        //return true; // return view('auth.admin-login');  //auth is folder name; admin-login is blade view
//        //validate form data
//        $this->validate($request, [
//            'email' => 'required|email',
//            'password' => 'required|min:6'
//        ]);
//        //attempt to log user
//        if(Auth::guard('admin')->attempt(['email'=> $request->email, 'password'=>$request->password], $request->remember )){
//            //if success, to indented location
//            return redirect()->intended(route('admin.dashboard'));
//        }
//
//        //if unsuccess, redirect back login with form data
//        return redirect()->back()->withInput($request->only('email','remember'));
//    }
//    public function logout()
//    {
//        //attempt to log user
//        Auth::guard('admin')->logout();
//        return redirect('/admin');
//    }
//
//}
