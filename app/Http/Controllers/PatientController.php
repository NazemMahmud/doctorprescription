<?php

namespace App\Http\Controllers;
ini_set('max_execution_time', 300);

//use App\Medicine;
use App\Patient;
use App\PatientTest;
use App\PatientMedicine;
use App\Test;
//use App\ReturnDate;
use App\Session;
use App\Symptom;
use PDF;
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
        $sessions = Session::where('patient_id', $request['pat-id'])->get();
        $tests = Test::orderBy('Testid')->get();
//        $session = Session::where('patient_id', $request['pat-id'])->first();
//        $doctor = Doctor::where('id', $request['doctor_id'])->first();
        return view('patientHistory',['patient'=>$patient, 'tests'=>$tests, 'sessions'=>$sessions]);
//        return view('patientHistory',['patient'=>$patient,'$doctor'=>$doctor]);
    }
    public function TestSession(Request $request)
    {
        $patient_id = 5;
        $patient = Patient::where('id', $patient_id)->first();
        $new_sessionID = 2; // new session id
        $session = Session::where('patient_id', $patient_id )->where('SessionId', $new_sessionID)->first();
        $symptom = Symptom::where('patient_id', $patient_id )->where('session_id', $new_sessionID)->first();
        $add_test = PatientTest::where('patient_id', $patient_id )->where('session_id', $new_sessionID)->get();
        $medicines = PatientMedicine::where('patient_id', $patient_id)->where('session_id', $new_sessionID)->get();
        return view('testDetails',['patient'=>$patient,
            'session'=>$session,
            'symptoms'=>$symptom,
            'tests'=>$add_test,
            'medicines'=>$medicines
        ]);
    }

    public function CreateSession(Request $request)
    {
//        $patients = Patient::orderBy('created_at')->where('user_id', Auth::id())->get();
        $patient_id = $request['pat-id'];
        $patient = Patient::where('id', $request['pat-id'])->first();
        $tests = Test::orderBy('Testid')->get();

        $pre_session = Session::where('patient_id', $patient_id)->latest('id')->first(); // ei patient er last session no. koto? oi row ta
        $pre_sessionID = 0;
        if(is_null($pre_session)){
            $pre_sessionID = 0;
        }
        else{
            $pre_sessionID = $pre_session->SessionId;
        }
      //  var_dump($patient->PatientName);
       // var_dump($pre_sessionID);
         // oi row er session id ta
        $new_sessionID = $pre_sessionID + 1; // new session id
//        $pre_symtom = Symptom::orderBy('id', 'desc')->first();
//        sessions table entry
        $session = new Session();
        $session->SessionId = $new_sessionID;
        $session->doctor_id = Auth::user()->id;
        $session->doctor_name = Auth::user()->name;
        $session->patient_id = $patient_id;
        $session->patient_name = $patient->PatientName;
        $date = date('Y-m-d', strtotime($request['return_date']));
        $session->ReturnDate = $date;//$request['return_date'];
        $session->save();

//        symptoms table entry
        $symptom = new Symptom();
        $symptom->SymptomName = $request['symptoms'];
        $symptom->patient_id = $patient_id;
        $symptom->session_id = $new_sessionID;
        $symptom->save();

//        patient_test table entry
        foreach ($request->input("test_name") as $test) {
            $add_test = new PatientTest();
            $add_test->patient_id = $patient_id;
            $add_test->session_id = $new_sessionID;
            $add_test->test_id = $test;
            $add_test->save();
        }
        $patient_test = PatientTest::where('patient_id', $patient_id )->where('session_id', $new_sessionID)->get();

//        patient medicine table entry
//        $input = Request::all();
        $medicineID = 0;
        foreach ($request['medicine'] as $row) {
            $medicineID = $medicineID + 1;
            $items = new PatientMedicine([
                'patient_id'=>$patient_id,
                'session_id'=>$new_sessionID,
                'medicine_id'=>$medicineID,
                'medicine_name'=>$row['name'],
                'MedicineDose'=>$row['dose'],
                'MedicineDuration'=>$row['duration'],
                'before_after_meal'=>$row['before_after_meal'],
            ]);
            $items->save();
        }
        $medicines = PatientMedicine::where('patient_id', $patient_id )->where('session_id', $new_sessionID)->get();

        $message = 'Patient information inserted successfully' ;
//        return redirect()->route('patient.new_session')->with(['message'=>$message, ]);
        return view('patientDetails',['patient'=>$patient, 'message'=>$message,
                                       'session'=>$session,
                                       'symptoms'=>$symptom,
                                       'tests'=>$patient_test,
                                       'medicines'=>$medicines
                                        ]);
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
    public function ViewSession($patient_id, $session_id) // get type
    {
        $patient = Patient::where('id', $patient_id)->first();
        $session = Session::where('patient_id', $patient_id )->where('SessionId', $session_id)->first();
        $symptom = Symptom::where('patient_id', $patient_id )->where('session_id', $session_id)->first();
        $add_test = PatientTest::where('patient_id', $patient_id )->where('session_id', $session_id)->get();
        $medicines = PatientMedicine::where('patient_id', $patient_id)->where('session_id', $session_id)->get();
        return view('testDetails',['patient'=>$patient,
            'session'=>$session,
            'symptoms'=>$symptom,
            'tests'=>$add_test,
            'medicines'=>$medicines
        ]);
    }

    public function ViewTestPDF(Request $request, $patient_id, $session_id)
    {
        $patient = Patient::where('id', $patient_id)->first();
        $session = Session::where('patient_id', $patient_id )->where('SessionId', $session_id)->first();
        $add_test = PatientTest::where('patient_id', $patient_id )->where('session_id', $session_id)->get();

        $pdf = PDF::loadView('testpdfview', ['patient'=>$patient,'session'=>$session, 'tests'=>$add_test]);
        return $pdf->download('testpdfview.pdf');
    }
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



}
