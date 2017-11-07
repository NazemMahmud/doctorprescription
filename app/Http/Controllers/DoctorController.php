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

class DoctorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:doctor'); // default gurad auth:web ; guest dile Auth::guest kaj kore, r auth dile
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
    public function ajax(Request $request)
    {
        $search = $request['search'];

        $name = Doctor::where('name', $search)->get();

    }
}


//        return view('admin'); // view create korte hobe admin=  admin.blade.php
