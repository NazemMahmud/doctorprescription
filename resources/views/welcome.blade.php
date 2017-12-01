@extends('layouts.master')
@section('title')
    Doctor Prescription
@endsection
@section('body')
    <div class="form-signin">
        <div class="text-center">
            <img src="{!! asset('img/dpicon.png') !!} " alt="Doctor Prescription Logo">
        </div>
        <hr>
        <div class="tab-content">
            <div id="login" class="tab-pane active">
                <form action="{{ route('doctor.login.submit') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="text" placeholder="Email" name="email" class="form-control top" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" placeholder="Password" name="password" class="form-control bottom" required >
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                    <button name="signin" id="signin" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                </form>
            </div>
            <div id="forgot" class="tab-pane">
                <form action="index.html">
                    <p class="text-muted text-center">Enter your valid e-mail</p>
                    <input type="email" placeholder="mail@domain.com" class="form-control">
                    <br>
                    <button class="btn btn-lg btn-danger btn-block" type="submit">Recover Password</button>
                </form>
            </div>
            <div id="signup" class="tab-pane">
                {{--{{ route('registration') }}--}}
                <form class="form-horizontal" method="POST" action="{{ route('doctor.register') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <p class="text-muted text-center">Create a new account</p>

                    <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" required placeholder="name" class="form-control top" name="name" value="{{ old('name') }}" autofocus>
                    </div>
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" required placeholder="mail@domain.com" class="form-control middle" name="email" value="{{ old('email') }}" >
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" required placeholder="password (at least 6 character)" class="form-control middle" id="password" name="password" minlength="6">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="">
                        <input id="password_confirm" placeholder="confirm password" class="form-control middle" type="password"  name="password_confirmation" required minlength="6">
                    </div>
                    <div class="signupas" style="">
                        <select class="form-control middle" name="sign_as" id="sign_as" onchange="signUpAs(this.value);" required>
                            <option value="doctor">Sign Up As</option>
                            <option value="doctor">Doctor</option>
                            <option value="pa">Personal Assistant</option>
                            <option value="assistant">Assistant Doctor</option>
                        </select>
                    </div>

                    <div class="tab-pane" id="select_doc" style="display:none;">
                        <input id="which_doc" placeholder="Select Doctor" class="form-control middle" type="text"  name="which_doc" >
                        <div id="searchbox"></div>
                    </div>
                    {{--<div id="searchbox"></div>--}}
                    <br>

                    <button class="btn btn-lg btn-success btn-block" type="submit">Register</button>
                    {{--<input type="hidden" name="_token" value="{{ Session::token() }}">--}}
                </form>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <ul class="list-inline">
{{--                @if(Auth::guest())--}}
                    <li><a class="text-muted" id="show-login" href="#login" data-toggle="tab">Login</a></li>
                    <li><a class="text-muted" id="show-forgot" href="#forgot" data-toggle="tab">Forgot Password</a></li>
                    <li><a class="text-muted" id="show-signup" href="#register" data-toggle="tab">Signup</a>
                {{--@endif--}}
            </ul>
        </div>
    </div>


    <!--jQuery -->
    {{--<script src="assets/lib/jquery/jquery.js"></script>--}}

    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    <!--Bootstrap -->
    {{--<script src="bootstrap/js/bootstrap.js"></script>--}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/searchbox.js') }}"></script>

    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                $('.list-inline li > a').click(function() {
                    var activeForm = $(this).attr('href') + ' > form';
                    //console.log(activeForm);
                    $(activeForm).addClass('animated fadeIn');
                    //set timer to 1 seconds, after that, unload the animate animation
                    setTimeout(function() {
                        $(activeForm).removeClass('animated fadeIn');
                    }, 1000);
                });
                $('#show-signup').click(function () {
                    $('#signup').addClass( "active" );
                    $('#login').removeClass( "active" );
                    $('#forgot').removeClass( "active" );

                });
                $('#show-login').click(function () {
                    $('#signup').removeClass( "active" );
                    $('#login').addClass( "active" );
                    $('#forgot').removeClass( "active" );

                });
                $('#show-forgot').click(function () {
                    $('#signup').removeClass( "active" );
                    $('#login').removeClass( "active" );
                    $('#forgot').addClass( "active" );
                });

            });
        })(jQuery);
    </script>
    <script>
        var password = document.getElementById("password")
            , confirm_password = document.getElementById("password_confirm");

        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;

        function signUpAs(type) {
            if(type== 'pa' || type== 'assistant' ){
                document.getElementById("select_doc").style.display = "block";
            }else{
                document.getElementById("select_doc").style.display = "none";
            }
        }
    </script>
@endsection