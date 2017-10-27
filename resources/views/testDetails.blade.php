@extends('layouts.main')
@section('title')
    Doctor Prescription
    {{--'patient'=>$patient,--}}
    {{--'session'=>$session,--}}
    {{--'symptoms'=>$symptom,--}}
    {{--'tests'=>$add_test--}}
@endsection
@section('main-body')
    @if(Session::has('message'))
        {{--<div class="col-md-6">--}}
        <div class=" alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{ Session::get('message') }}
        </div>
        {{--</div>--}}
    @endif
    <div class="container-fluid" style="">
        <div class="col-md-6 col-md-offset-3 list-all" style="">
            <div class="row naw" style="padding-top: 10px;">
                <div class="col-md-6" style="">
                    <h4 style=""><b> Session: <span style="">{{ $session->SessionId }}</span></b></h4>
                    <h4 style=""><b> Patient Name: <span style="">{{ $patient->PatientName }}</span></b></h4>
                    <h4 style=""><b>Age:</b> <span style="">{{ $patient->PatientAge }}</span></h4>
                    <h4 style=""><b>Weight:</b> <span style="">{{ $patient->PatientWeight }}</span></h4>

                </div>
                <div class="col-md-6" style="">
                    <div class="row pdate" style="">
                        <h4 style="">Session Date: {{ $session->created_at->format('d/m/Y') }}</h4>
                    </div>
                    <div class="row pdate" style="">
                        <h4 style="">Return Date: {{ date('d/m/Y', strtotime($session->ReturnDate)) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-3 list-all" id="" style="">
            <div class="row" style="margin-top: 10px;">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" action="#">

                        <input type="hidden" name="pat-id" id="pat-id" value="{{ $patient->id }}">
                        {{--SYMPTOMS--}}
                        <div class="form-group" style="    border-bottom: 1.8px solid #e9ebee;">
                            <label class="col-sm-3 col-md-3 control-label no-padding-right" for="form-field-1-1">Symptoms:</label>
                            <div class="col-sm-9 col-md-8" >
                                <h4 class="" name="symptoms" id="symptoms" >{{ $symptoms->SymptomName }}</h4>
                            </div>
                        </div>
                        {{--TESTS--}}
                        <div class="form-group" style="    border-bottom: 1.8px solid #e9ebee;" >
                            <label class="col-sm-3 col-md-3 control-label no-padding-right" for="form-field-1-1">Tests (if any):</label>
                            <div class="col-sm-9 col-md-9" style="margin-top: 7px;">
                                <ol>
                                    @foreach($tests as $test)
                                        {{--<div class="col-sm-6 col-md-6">--}}
                                                <li>
                                                    <p>{{ App\Test::where('Testid', $test->test_id)->first()->TestName }}</p>
                                                </li>

                                            {{--<input disabled class="form-check-input" id="test_name[]" type="checkbox" name="test_name[]" value="{{ $test->test_id }}" style="margin-right: 5px;">--}}
                                        {{--</div>--}}
                                    @endforeach
                                </ol>

                            </div>

                            <div class="col-md-6 col-xs-6 col-md-offset-4" style="margin-bottom: 7px;">
                                <a class="btn" href="{{ route('patient.test_pdf', ['patient_id'=>$patient->id, 'session_id'=>$session->SessionId]) }}" style="text-decoration: none; background-color: #4CAF50;color: #FFF;">Download Test Names</a>
                            </div>
                        </div>

                        {{--MEDICINES--}}
                        <div class="form-group" style="" >
                            {{--<div class="col-sm-12 col-md-12" style="margin-top: 7px;">--}}
                                {{--<label class="col-sm-3 col-md-3 control-label no-padding-right" for="form-field-1-1">Medicines:</label>--}}
                            {{--</div>--}}

                            <div class="col-sm-12 col-md-12" style=" margin-top: 7px;">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Medicine Name</th>
                                                <th>Medicine Dose</th>
                                                <th>Medicines Duration:</th>
                                                <th>Medicine Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $cnt = 0; ?>
                                            @foreach($medicines as $medicine)
                                                @if($cnt%2==0)
                                                    <tr class="success">
                                                @else
                                                    <tr class="info">
                                                @endif

                                                <td>{{ $cnt }}</td>
                                                <td>{{ $medicine->medicine_name }}</td>
                                                <td>{{ $medicine->MedicineDose }}</td>
                                                <td>{{ $medicine->MedicineDuration }}</td>
                                                <td>{{ $medicine->before_after_meal }}</td>
                                                        <?php $cnt++; ?>
                                            </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
    {{--CUSTOM SCRIPT--}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection
{{--            <li>{{ Auth::user()->username }}</li>--}}
