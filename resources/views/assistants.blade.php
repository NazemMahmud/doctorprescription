{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: Nazem Mahmud--}}
 {{--*/--}}

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
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="container-fluid" style="">
        @if( count( $assistants)>0 )
            @foreach($assistants as $assistant)
                <div class="col-md-6 col-md-offset-3 list-all" style="">
                    <div class="row naw" style="margin-top: 10px;">
                        <div class="col-md-6" style="">
                            <h4 style=""><b> Name: <span style="">{{ $assistant->name }}</span></b></h4>
                            <h4 style=""><b>Assistant type:</b>
                                <span style="">
                                    @if($assistant->admin_type=='pa')Personal Assistant
                                    @elseif($assistant->admin_type=='assistant') Assistant Doctor
                                    @endif
                                </span>
                            </h4>
                            <h4 style=""><b>Phone No.:</b> <span style="">{{ $assistant->contact }}</span></h4>
                            <h4 style=""><b>Email:</b> <span style="">{{ $assistant->email }}</span></h4>

                        </div>
                        {{--@if($assistant->active==0)--}}
                            {{--<div class="col-md-6" style="margin-top: 7%">--}}
                                {{--<div class="row pdate" style="">--}}
                                    {{--<button class="btn btn-primary request_accept" id="request-accept" name="request-accept" style="color:#fff;background-color: #337ab7;border-color: #2e6da4;" type="submit" onclick="assistantRequireHandle()">Accept</button>--}}
                                    {{--<button class="btn request_reject" id="request-reject" name="request-reject" style="margin-left:20px;color:#333;background-color: #fff;border-color: #8c8c8c;" type="submit" onclick="assistantRequireHandle()">Reject</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endif--}}


                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-2 col-xs-5 ">
                            <form action="#" class="form-group">
                                <input type="hidden" name="pat-id" value="{{ $assistant->id }}">
                                {{--<input type="text" name="doctor_id"value="{{ Auth::user()->id }}">--}}
                                <button class="btn " type="submit" style="">
                                    View Details
                                </button>
                            </form>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 ">
                            <button class="btn " id="add-permission"  onclick="getassistid({{ $assistant->id }})"  type="submit" style="">Add Permissions</button>
                        </div>
                        <div class="col-xs-12 col-sm-10 col-md-12 permission_select{{ $assistant->id }}" id="permission-select{{ $assistant->id }}"  style="display: none;">
                            {{--<div class="col-xs-12 col-sm-10 col-md-12">--}}
                                <form action="{{ route('doctor.permissions') }}" method="post" id="permission_set_form" name="permission_set_form"  class="" style="">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="assist-doctor-id" id="assist-doctor-id" value="{{ $assistant->id }}">
                                    <div class="col-sm-12 col-md-12 col-xs-12 checkbox" style="border: 0.2px solid #ddd;min-height: 40px;">
                                        <label style="margin-top: 9px;">
                                            <input type="checkbox" name="all" onclick="getAllPermission({{ $assistant->id }});" id="all{{ $assistant->id }}" class="all{{ $assistant->id }}" value="ALL" >ALL PRIVILEGES</label>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-xs-12 checkbox" style="border: 0.2px solid #ddd;margin-top: -12px;padding-bottom: 15px;padding-top:  15px;padding-left: 18px;">
                                        @foreach($permissions as $permission)
                                            <div class="col-sm-6 col-md-6 col-xs-6" style="margin-top: 7px; text-transform: uppercase;">
                                                <input @if(App\DoctorPermission::where('permission_Id', $permission->permissionId)->where('doc_Id',$assistant->id )->first()->active == 1 ) checked="checked" @endif class="form-check-input" id="permission_name[]" type="checkbox" name="permission_name[]" value="{{ $permission->permissionId }}" style="margin-right: 5px;">{{ $permission->permissionName }}
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group ">
                                        <button type="submit" class="btn btn-primary" id="submit">Make Changes</button>
                                        {{--<button type="reset" value="Reset" class="btn btn-secondary">Reset</button>--}}
                                    </div>

                                </form>
                            {{--</div>--}}
                        </div>
                    </div>


                </div>
            @endforeach

        @elseif(count( $assistants)<=0)
            <div class="col-md-6 col-md-offset-3 list-all" style="">
                <h3 style="text-align: center; margin-top: 10px;">You have not  any assistants yet</h3>
            </div>

        @endif

    </div>

@endsection
<script>
    function getassistid (getId) {
//        $("#permission-select").hide();
        $(".permission_select"+getId).slideToggle("slow");
    }
    function getAllPermission(assistantId) {
        $('body').on('change', '.all'+assistantId+'', function () {
            if ($(this).hasClass('allChecked')) {
                console.log('not allchek');
                $('input[type="checkbox"]', '#permission-select'+assistantId+'').prop('checked', false);
            } else {
                console.log('allchek');
                $('input[type="checkbox"]', '#permission-select'+assistantId+'').prop('checked', true);
            }
            $(this).toggleClass('allChecked');
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
