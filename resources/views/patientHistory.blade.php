@extends('layouts.main')
@section('title')
    Doctor Prescription
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
        {{--@foreach($patients as $patient)--}}
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
                    <form class="form-horizontal" role="form" name="" method="post" action="#" enctype="multipart/form-data">
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
                                <div class="col-sm-4 col-md-4">
                                    <input class="form-check-input" id="test_name[]" type="checkbox" name="test_name[]" value="1" style="margin-right: 5px;">Test name 1
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <input class="form-check-input" id="test_name[]" type="checkbox" name="test_name[]" value="3" style="margin-right: 5px;">Test name 2
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <input class="form-check-input" id="test_name[]" type="checkbox" name="test_name[]" value="1" style="margin-right: 5px;">Test name 1
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <input class="form-check-input" id="test_name[]" type="checkbox" name="test_name[]" value="3" style="margin-right: 5px;">Test name 2
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <input class="form-check-input" id="test_name[]" type="checkbox" name="test_name[]" value="1" style="margin-right: 5px;">Test name 1
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <input class="" id="test_name[]" type="checkbox" name="test_name[]" value="3" style="margin-right: 5px;">Test name 2
                                </div>

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

                            <div class="col-md-9 col-sm-9 col-md-offset-3 col-sm-offset-3 input_fields_wrap  ">
                                {{--<div class="col-sm-12 col-md-12 input_fields_wrap " >--}}
                                <div class="row" style="margin-bottom: 5px;">
                                    <div class="col-md-5 col-sm-5" style="margin-bottom: 5px;">
                                        <input type="text" class="form-control" name="medicine_name[]" placeholder="Medicine name">
                                    </div>
                                    <div class="col-md-4 col-sm-4" style="margin-bottom: 5px;">
                                        <input class="form-control" name="medicine_duration[]" type="number"  placeholder="Duration in days">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5" style="margin-bottom: 5px;">
                                        <select class="selectpicker form-control" id="medicine_dose[]" name="[]" type="text">
                                            <option value="NULL">Select Dose</option>
                                            <option value="1-0-1">1-0-1</option>
                                            <option value="1-0-0">1-0-0</option>
                                            <option value="1-1-1">1-1-1</option>
                                            <option value="drop half hour delay">drop half hour delay</option>
                                            <option value="drop 3 hour delay">drop 3 hour delay</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 col-sm-4 " style="margin-bottom: 5px;">
                                        <select class="form-control" id="medicine_before_after_meal[]" name="medicine_before_after_meal[]" type="text">
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
        <div class="col-md-6 col-md-offset-3 session-new" id="create_session" style="border-radius: 0 0 10px 10px ">
            <div class="row  "  style=" ">
                {{--<div class="session-new" style="border-bottom: 2px solid #e9ebee">--}}
                <a href="#" style="" onclick=""><h3>Previous Sessions</h3></a>
                {{--</div>--}}

            </div>
        </div>


    </div>
    {{--CUSTOM SCRIPT--}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
    </script>
    <script>
        $(document).ready(function(){
//                  CREATE A SESSION FOR PATIENT
            $("#create_session").click(function(){
                $("#prescription").slideToggle("slow");
            })
            //DYNAMIC MEDICINE ADD STARTS
            var max_fields      = 20; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="more_medicine_row"><div class="row" style="margin-bottom: 5px;">' +
                                              '<div class="col-md-5 col-sm-5" style="margin-bottom: 5px;">'+
                                              '<input type="text" class="form-control" name="medicine_name[]" placeholder="Medicine name">' + '</div>'+
                                              '<div class="col-md-4 col-sm-4" style="margin-bottom: 5px;">'+
                                              '<input class="form-control" name="medicine_duration[]" type="number"  placeholder="Duration in days">'+ '</div>'+
                                            '</div>' +
                                            '<div class="row">'+
                                              '<div class="col-md-5 col-sm-5" style="margin-bottom: 5px;">'+
                                                '<select class="selectpicker form-control" id="medicine_dose[]" name="[]" type="text">'+
                                                    '<option value="NULL">Select Dose</option>'+
                                                    '<option value="1-0-1">1-0-1</option>'+
                                                    '<option value="1-0-0">1-0-0</option>'+
                                                    '<option value="1-1-1">1-1-1</option>'+
                                                    '<option value="drop half hour delay">drop half hour delay</option>'+
                                                    '<option value="drop 3 hour delay">drop 3 hour delay</option>'+
                                                '</select>'+
                                              '</div>'+
                                              '<div class="col-md-4 col-sm-4 " style="margin-bottom: 5px;">'+
                                                '<select class="form-control" id="medicine_before_after_meal[]" name="medicine_before_after_meal[]" type="text">'+
                                                    '<option value="NULL">Before/After Meal</option>'+
                                                    '<option value="before">before taking meal</option>'+
                                                    '<option value="after">after taking meal</option>'+
                                                '</select>'+
                                              '</div>'+
                                               '<div class="col-md-1 col-sm-1 ">'+'<a href="#" class="btn btn-danger remove_field">Remove</a></div>' +
                                            '</div>'+
                                            '</div>'); //add input box
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault();
                $(this).parent('div').parent('div').parent('div').remove();
//                $(this).parent('div').remove(); more_medicine_row
                x--;
            })
                //DYNAMIC MEDICINE ADD END
            $( "#return_date" ).datepicker(); // this is datepicker b****
        });


    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection
{{--            <li>{{ Auth::user()->username }}</li>--}}
