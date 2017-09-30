<?php

namespace App\Http\Controllers\Auth;

use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DoctorLoginController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest:doctor');  // guest = middleware ; web = guard default guard
        $this->middleware('guest:doctor', ['except'=>['logout']] );
    }
    public function showLoginForm()
    {
               // return redirect()->route('welcome');// view('auth.admin-login');  //auth is folder name; admin-login is blade view
                return view('welcome');// view('auth.admin-login');  //auth is folder name; admin-login is blade view
    }
//    public function showRegistrationForm()
//    {
//     //   return view('auth.admin-register');
//    }
    public function login(Request $request)
    {   //validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //attempt to log user
        if(Auth::guard('doctor')->attempt(['email'=> $request->email, 'password'=>$request->password], $request->remember )){
            return redirect()->intended(route('doctor.dashboard'));
        }

        //if unsuccess, redirect back login with form data
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout()
    {
        //attempt to log user
        Auth::guard('doctor')->logout();
        return redirect('/');
//        return redirect()->route('/login');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:doctors',
            'password' => 'required|string|min:6|confirmed',
        ]);
        //         take data from front-end form
        $name = $request['name'];
        $email = $request['email'];
        $password = bcrypt($request['password']);
//
//        store data into db column
        $doctor = new Doctor();
        $doctor->name = $name ;
        $doctor->email = $email;
        $doctor->password = $password ;
        $doctor->save(); //        save data

        Auth::login($doctor);// for doctor login;  // for user login; Auth::guard('admin')->login($admin);

        return redirect()->route('doctor.dashboard');

//        if (Auth::guest()) {
//            return view('welcome');
//        }else {
//            return view('home');
//        }
//
////        return $this->registered($request, $user)
////            ?: redirect($this->redirectPath());
    }



}





