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
        @if( count( $patients)>0 )
            @foreach($patients as $patient)
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
                    <div class="row">
                        <div class="col-md-6 ">
                            <form action="{{ route('patient.history') }}" class="form-group">
                                <input type="hidden" name="pat-id" value="{{ $patient->id }}">
                                {{--<input type="text" name="doctor_id"value="{{ Auth::user()->id }}">--}}
                                <button class="btn " type="submit" style="">
                                    View Details
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        @elseif(count( $patients)<=0)
            <div class="col-md-6 col-md-offset-3 list-all" style="">
                <h3 style="text-align: center; margin-top: 10px;">You have not seen any patient yet</h3>
            </div>

        @endif

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


@endsection
