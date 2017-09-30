<?php

namespace App\Http\Controllers;
ini_set('max_execution_time', 300);

//use App\Medicine;
use App\Patient;
//use App\ReturnDate;
use App\Session;
//use App\Symptom;
//use App\Test;
//use Barryvdh\DomPDF\Facade as PDF; // for PDF at line 76  $pdf = PDF::loadView('pdfview', ['patient'=>$patient]);;
//use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

use App\Doctor;
use Illuminate\Http\Request;
//use Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor'); // default gurad auth:web ; guest dile Auth::guest kaj kore, r auth dile
    }

    public function CreatePatient(Request $request) // post type
    {
        //        validation...
        $this->validate($request, [
            'patient_name'=> 'required',
            'patient_age'=> 'required',
            'patient_mobile'=>'required',
        ]);

        $patient = new Patient();
        $user = Auth::user();
//
        $patient->PatientName = $request['patient_name'];
        $patient->PatientAge = $request['patient_age'];
        $patient->PatientMobile_no = $request['patient_mobile'];
        $patient->PatientWeight = $request['patient_weight'];

        $patient->doctor_id = $user->id;
        $patient->doctor_name = $user->name;

//
//        $patient->user()->associate($user);
        $patient->save();
//
        if($request->user()->patients()->save($patient))
        {
            $message = 'Patient information enrolled successfully' ;
        }
//
        return redirect()->route('doctor.dashboard')->with(['message'=>$message]);
    }

    public function PatientHistory(Request $request) // get type
    {
//        $patients = Patient::orderBy('created_at', 'desc')->where('doctor_id', Auth::id())->get();
        $patient = Patient::where('id', $request['pat-id'])->first();
//        $session = Session::where('patient_id', $request['pat-id'])->first();
//        $doctor = Doctor::where('id', $request['doctor_id'])->first();
        return view('patientHistory',['patient'=>$patient]);
//        return view('patientHistory',['patient'=>$patient,'$doctor'=>$doctor]);
    }

    //dashboard/home page view er
//    public function Dashboard(HttpRequest $request) //get
//    {
//        if (Auth::guest()){
//            return view('welcome');
//
//        }else {
//            $patients = Patient::orderBy('created_at')->where('user_id', Auth::id())->get();
//            return view('dashboard', ['patients'=>$patients]);
//        }
//    }
//    //
//    public function CreatePatientView() // get type
//    {
//        $patients = Patient::orderBy('created_at')->where('user_id', Auth::id())->get();
//        return view('createPatientView', ['patients'=>$patients]);
//    }
    //after enroll a new patient


//    public function ShowAllSession($user_id,$patient_id)
//    {
//        $patients = Patient::orderBy('created_at')->where('user_id', Auth::id())->get();
//        $patient = Patient::where('id', $patient_id)->first();
//        $sessions = Session::orderBy('created_at')->where('patient_id', $patient_id)->get();
//        $user = Auth::user();
//
//        return view('showAllSession', ['patient'=>$patient,'patients'=>$patients, 'sessions'=>$sessions]);
//    }

//    public function CreateSessionView($user_id, $patient_id)
//    {
//        $patients = Patient::orderBy('created_at')->where('user_id', Auth::id())->get();
//        $patient = Patient::where('id', $patient_id)->first();
//        $session = new Session();
//        $session->patient()->associate($patient);
//        $session->save();
//
//        $symptoms = Symptom::where('session_id', $session->id)->get();
//        $medicines = Medicine::orderBy('created_at')->where('session_id', $session->id)->get();
//        $tests = Test::orderBy('created_at')->where('session_id', $session->id)->get();
//
//        return view('editPatientView', ['patient'=>$patient, 'patients'=>$patients, 'session'=>$session,
//                                        'symptoms'=>$symptoms, 'medicines'=> $medicines, 'tests'=>$tests]);
//    }

//    public function EditPatientView($user_id, $patient_id, $session_id)
//    {
//        $patient = Patient::where('id', $patient_id)->first();
//        $patients = Patient::orderBy('created_at')->where('user_id', Auth::id())->get();
//        $session = Session::where('id', $session_id)->first();
//
//        $symptoms = Symptom::where('session_id', $session->id)->first();
//        $medicines = Medicine::orderBy('created_at')->where('session_id', $session->id)->get();
//        $tests = Test::orderBy('created_at')->where('session_id', $session->id)->get();
////        $medicines = Medicine::orderBy('created_at')->where('patient_id', $patient_id)->get();
////        $tests = Test::orderBy('created_at')->where('patient_id', $patient_id)->get();
////        dd($patient_id);
//        return view('editPatientView', ['patient'=>$patient, 'patients'=>$patients, 'session'=>$session,
//            'symptoms'=>$symptoms, 'medicines'=> $medicines, 'tests'=>$tests]);
//    }

//    public function SavePatientSymptom(HttpRequest $request,$user_id, $patient_id, $session_id)
//    {
//        $patient = Patient::where('id', $patient_id)->first();
//        $session = Session::where('id', $session_id)->first();
//        $symptom = new Symptom();
//        $symptom->symptom_name = $request['symptom'];
//        $symptom->session()->associate($session);
//        $symptom->save();
//        $message = 'Patient symptom saved successfully' ;
//
//        return redirect()->route('editpatient', ['user_id'=>$patient->user->id, 'patient_id'=>$patient->id, 'session_id'=>$session->id])->with(['message'=>$message]);
//    }

//    public function SavePatientMedicines(HttpRequest $request,$user_id, $patient_id, $session_id)
//    {
//        $patient = Patient::where('id', $patient_id)->first();
//        $session = Session::where('id', $session_id)->first();
//
//        $medicine = new Medicine();
//        $medicine->medicine_name = $request['medicine_name'];
//        $medicine->medicine_dose = $request['medicine_dose'];
//        $medicine->before_after_food = $request['medicine_before_after_meal'];
//        $medicine->duration = $request['medicine_duration'];
//        $medicine->session()->associate($session);
//        $medicine->save();
////        $message = 'Add medicine successfully' ;
//
//        return redirect()->route('editpatient', ['user_id'=> $patient->user->id, 'patient_id'=>$patient->id, 'session_id'=>$session->id]);
//    }

//    public function SavePatientTests(HttpRequest $request,$user_id, $patient_id, $session_id)
//    {
//        $patient = Patient::where('id', $patient_id)->first();
//        $session = Session::where('id', $session_id)->first();
//
//        $testnames = $request->get('textcheckbox');
//        foreach ($testnames as $value){
//            $tests = new Test();
//            $tests->test_name = $value;
//            $tests->session()->associate($session);
//            $tests->save();
//        }
//
//        $message = 'Add Tests successfully' ;
//
//        return redirect()->route('editpatient', ['user_id'=> $patient->user->id, 'patient_id'=>$patient->id,'session_id'=>$session->id])->with(['message'=>$message]);
//    }

//    public function SaveReturnDate(HttpRequest $request,$user_id, $patient_id, $session_id)
//    {
//        $patient = Patient::where('id', $patient_id)->first();
//        $session = Session::where('id', $session_id)->first();
//        $returndate = new ReturnDate();
//        $returndate->return_date = $request['return_date'];
//        $returndate->session()->associate($session);
//        $returndate->save();
////        $message = 'Patient symptom saved successfully' ;
//
//        return redirect()->route('editpatient', ['user_id'=>$patient->user->id, 'patient_id'=>$patient->id, 'session_id'=>$session->id]);
//    }

//    public function ShowPatientDetails($user_id,$patient_id, $session_id)
//    {
//        $patients = Patient::orderBy('created_at')->where('user_id', Auth::id())->get();
//        $patient = Patient::where('id', $patient_id)->first();
//        $session = Session::where('id', $session_id)->first();
//        $symptoms = Symptom::where('session_id', $session->id)->first();
//        $returndate = ReturnDate::where('session_id', $session->id)->first();
//        $medicines = Medicine::orderBy('created_at')->where('session_id', $session_id)->get();
//        $tests = Test::orderBy('created_at')->where('session_id', $session_id)->get();
//
//        $user = Auth::user();
//
//        return view('patientDetails', ['patient'=>$patient,'patients'=>$patients,'session'=>$session,
//            'symptoms'=>$symptoms, 'medicines'=>$medicines, 'tests'=>$tests, 'returndate'=>$returndate ]);
//    }

//    public function SavePatientInfo(HttpRequest $request,$user_id, $patient_id)
//    {
//        //        validation...
////        $this->validate($request, [
////            'patient_name'=> 'required|max:2000',
////            'patient_age'=> 'required',
////        ]);
//
//
//        $patient = Patient::find($patient_id) ;
//        //$post = Post::where('id', $post_id)->first(); //find($post_id)->first;
////        dd($patient->id);
////        $add_medicine_name = Request::get('myInputsName');
////        $add_medicine_dose = Request::get('myInputsDose');
////        $counter = count($add_medicine_name);
////        dd($request->all());
////        dd($patient);
////        $medicine = new Medicine();
//        $user = Auth::user();
//
////        $patient->name = $request['patient_name'];
////        $patient->age = $request['patient_age'];
////        $patient->weight = $request['patient_weight'];
////        $patient->symptom = $request['symptom'];
//        $patient->test = $request['test'];
////        $patient->medicine = $request['medicine'];
//        $patient->return_date = $request['return-date'];
//
////        foreach($add_medicine_name as $addName){
////            $medicine = new Medicine();
////            $medicine->medicine_name = $addName;
//////            $medicine->medicine_dose = Request::get('myInputsDose');
////            $medicine->patient()->associate($patient);
////            $medicine->save();
////        }
//
////        $patient->user()->associate($user);
////        $medicine->patient()->associate($patient);
//
//        $patient->update();
//
//
//
//
////        foreach ($input['rows'] as $row) {
////            $medicine->user_id = Auth::id();
////            $medicine->medicine_name = $row['nameStore'];
////            $medicine->medicine_dose = $row['doseStore'];
//////            $items = new Multiple([
//////                'user_id' => Auth::id(),
//////                'store' => $row['store'],
//////                'link' => $row['link'],
//////            ]);
//////            $items->save();
////        }
//
//        if($request->user()->patients()->save($patient))
//        {
//            $message = 'Patient information enrolled successfully' ;
//        }
//
//        return redirect()->route('showpatientinfo', ['user_id'=> $patient->user->id, 'patient_id'=>$patient->id])->with(['message'=>$message]);
//    }



//    public function PdfView(HttpRequest $request, $patient_id)
//    {
//        $patients = Patient::where('id', $patient_id)->first();
//        $tests = Test::orderBy('created_at')->where('patient_id', $patient_id)->get();
////        $pdf = PDF::loadView('pdfview', ['patients'=>$patients]);
//        $pdf = PDF::loadView('pdfview', ['patients'=>$patients, 'tests'=>$tests]);
//        return $pdf->download('pdfview.pdf');
//    }

}
