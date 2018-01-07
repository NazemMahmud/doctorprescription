@extends('layouts.main')
@section('title')
    Patient History
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
    <div class="container-fluid" style="margin-bottom: 150px;">
            <div class="col-md-6 col-md-offset-3 list-all" style="">
                <div class="row naw" style="padding-top: 10px;">
                    <div class="col-md-6" style="">
                        <h4 style=""><b> Patient Name: <span style="">{{ $patient->PatientName }}</span></b></h4>
                        <h4 style=""><b>Age:</b> <span style="">{{ $patient->PatientAge }}</span></h4>
                        <h4 style=""><b>Weight:</b> <span style="">{{ $patient->PatientWeight }}</span></h4>

                    </div>
                    <div class="col-md-6" style="">
                        <div class="row pdate" style="">
                            <h4 style="">Date: {{ $patient->created_at->format('d/m/Y') }}</h4>
                        </div>

                    </div>

                </div>


                {{--<div class="row">--}}
                    {{--<div class="col-md-6 ">--}}
                        {{--<form action="" class="form-group">--}}
                            {{--<button class="btn " type="submit" style="">--}}
                                {{--View Details--}}
                            {{--</button>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>

        <div class="col-md-6 col-md-offset-3 session-new" id="create_session" style="border-radius: 10px 10px 0 0" >
            <div class="row  "  style=" ">
                {{--<div class="session-new" style="border-bottom: 2px solid #e9ebee">--}}
                    <a href="#" style="" onclick=""><h3>Create Session</h3></a>
                {{--</div>--}}

            </div>
        </div>
        <div class="col-md-6 col-md-offset-3 list-all" id="prescription" style="">
            <div class="row" style="margin-top: 10px;">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" name="" method="post" action="{{ route('patient.create_session') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="pat-id" id="pat-id" value="{{ $patient->id }}">
                            {{--SYMPTOMS--}}
                        <div class="form-group" >
                            <label class="col-sm-3 col-md-3 control-label no-padding-right" for="form-field-1-1">Symptoms:</label>
                            <div class="col-sm-9 col-md-8" >
                                <textarea class="form-control" type="text" cols="80" rows="5"  name="symptoms" id="symptoms" ></textarea>
                            </div>
                        </div>
                            {{--TESTS--}}
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 control-label no-padding-right" for="form-field-1-1">Tests (if any):</label>
                            <div class="col-sm-9 col-md-9" style="margin-top: 7px;">
                                @foreach($tests as $test)
                                    <div class="col-sm-6 col-md-6">
                                        <input class="form-check-input" id="test_name[]" type="checkbox" name="test_name[]" value="{{ $test->Testid }}" style="margin-right: 5px;">{{ $test->TestName }}
                                    </div>
                                @endforeach

                            </div>
                        </div>
                                {{--MEDICINES--}}

                        <div class="form-group">
                            <div class="row" style="margin-bottom: 10px;">
                                <label class="col-sm-3 col-md-3 control-label " for="form-field-1-1">Medicines:</label>
                                <div class="col-md-7 col-sm-7" style="">
                                    <button class="add_field_button btn btn-view" style="background-color: #4BA52A; float: right;" >Add More </button>
                                </div>
                            </div>
                            {{--<input type="hidden" name="rows[0][link]" value="' + link + '">--}}
                            {{--<input type="hidden" name="rows[0][store]" value="' + store + '">--}}
                            {{--<input type="hidden" name="rows[1][link]" value="' + link + '">--}}
                            {{--<input type="hidden" name="rows[1][store]" value="' + store + '">--}}

                            <div class="col-md-9 col-sm-9 col-md-offset-3 col-sm-offset-3 input_fields_wrap  ">
                                {{--<div class="col-sm-12 col-md-12 input_fields_wrap " >--}}
                                <div class="row" style="margin-bottom: 5px;">
                                    <div class="col-md-5 col-sm-5" style="margin-bottom: 5px;">
                                        {{--<input type="text" class="form-control" name="medicine_name[]" placeholder="Medicine name">--}}
                                        <input type="text" class="form-control" name="medicine[0][name]" placeholder="Medicine name">
                                    </div>
                                    <div class="col-md-4 col-sm-4" style="margin-bottom: 5px;">
                                        {{--<input class="form-control" name="medicine_duration[]" type="number"  placeholder="Duration in days">--}}
                                        <input class="form-control" name="medicine[0][duration]" type="number"  placeholder="Duration in days">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5" style="margin-bottom: 5px;">
                                        {{--<select class="selectpicker form-control" id="medicine_dose[]" name="[]" type="text">--}}
                                        <select class="selectpicker form-control" id="" name="medicine[0][dose]" type="text">
                                            <option value="NULL">Select Dose</option>
                                            <option value="1-0-1">1-0-1</option>
                                            <option value="1-0-0">1-0-0</option>
                                            <option value="1-1-1">1-1-1</option>
                                            <option value="drop half hour delay">drop half hour delay</option>
                                            <option value="drop 3 hour delay">drop 3 hour delay</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 col-sm-4 " style="margin-bottom: 5px;">
                                        <select class="form-control" id="" name="medicine[0][before_after_meal]" type="text">
                                            <option value="NULL">Before/After Meal</option>
                                            <option value="before">before taking meal</option>
                                            <option value="after">after taking meal</option>
                                        </select>
                                    </div>
                                </div>

                                    {{--<button type="submit" class="btn btn-primary buton" id="save_medicine" style="margin-left: 20px;">Add Medicine</button>--}}
                                    {{--<input type="hidden" name="_token" value="{{ Session::token() }}">--}}

                                    {{--<select required class="form-control" type="text"  name="category" id="category" onchange="subCategory(this.value);">--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Return Date:</label>
                            <div class="col-sm-6" >
                                <input required placeholder=""  class="form-control" type="text"  name="return_date" id="return_date" >
                            </div>
                        </div>


                        {{--<div class="form-group">--}}
                            {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Select Images:</label>--}}
                            {{--<div class="col-sm-2" style="margin-top:7px;">--}}
                                {{--<input type="file" name="firstFile" id="firstFile">--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-2" style="margin-top:7px;">--}}
                                {{--<input type="file" name="secondFile" id="secondFile">--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-2" style="margin-top:7px;">--}}
                                {{--<input type="file" name="thirdFile" id="thirdFile">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <!--<div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">First Image:</label>
                            <div class="col-sm-2" >
                                <input type="file" class="btn btn-block btn-sm btn-primary" name="firstFile" id="firstFile">
                                <input style="visibility:hidden;" type="submit" value="Upload Image" id="submit1" name="submit1" >
                            </div>
                        </div>-->

                        <div class="clearfix form-actions" style="padding-bottom: 10px;">
                            <div class="col-md-offset-3 col-md-9">
                                <button name="btnAdd" class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Add Session
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3 session-new" id="prev_session" style="border-radius: 0 0 10px 10px ">
            <div class="row  "  style=" ">
                {{--<div class="session-new" style="border-bottom: 2px solid #e9ebee">--}}
                <a href="#" style="" onclick=""><h3>Previous Sessions</h3></a>
                {{--</div>--}}

            </div>
        </div>

        <div class="col-md-6 col-md-offset-3 list-all" id="prev_prescription" style="">
            <div class="row" style="margin-top: 10px;">

                    <div class="col-sm-12 col-md-12 naw" style=" margin-top: 7px;">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><h5 style="color: #343290;"><b>Session No</b></h5></th>
                                        <th style="text-align: center"><h5 style="color: #343290;"><b>Session Date</b></h5></th>
                                        <th style="text-align: center"><h5 style="color: #343290;"><b>Return Date</b></h5></th>
                                        <th style="text-align: center"><h5 style="color: #343290;"><b>View </b></h5></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sessions as $session)
                                    <tr class="info">
                                        <td style="text-align: center">{{ $session->SessionId }}</td>
                                        <td style="text-align: center">{{ $session->created_at->format('d-m-Y') }}</td>
                                        <td style="text-align: center">{{ $session->ReturnDate }}</td>
                                        <td style="text-align: center"><a href="{{ route('patient.session_details', ['patient_id'=>$patient->id, 'session_id'=>$session->SessionId]) }}">View Details</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- PAGE CONTENT BEGINS -->
                    {{--<form class="form-horizontal" role="form" name="" method="post" action="{{ route('patient.create_session') }}" enctype="multipart/form-data">--}}
                        {{--{{ csrf_field() }}--}}
                        <input type="hidden" name="pat-id" id="pat-id" value="{{ $patient->id }}">

                        {{--<div class="clearfix form-actions" style="padding-bottom: 10px;">--}}
                            {{--<div class="col-md-offset-3 col-md-9">--}}
                                {{--<button name="btnAdd" class="btn btn-info" type="submit">--}}
                                    {{--<i class="ace-icon fa fa-check bigger-110"></i>--}}
                                    {{--Add Session--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}

            </div>
        </div>


    </div>
    {{--CUSTOM SCRIPT--}}

@endsection
{{--            <li>{{ Auth::user()->username }}</li>--}}
