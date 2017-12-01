
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  <!--Mobile first-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--IE Compatibility modes-->
    <title>Doctor Prescription</title>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Doctor Prescription">
    <meta name="author" content="">
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{!! asset('img/icon.ico') !!} " />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ URL::to('css/style.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="/resources/demos/style.css">


    <style>

    </style>

</head>
<body style="background-color: #e9ebee;">
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img style="display: inline-block;margin-right: 1px; " class="" src="{!! asset('img/dpicon.png') !!}" alt="Doctor Prescription Logo" width="35" height="35">
                <span style="color: #008000;">Doctor Prescription</span>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav ">
                <li class=""><a href=""></a></li>
                <li class=""><a href=""></a></li>
                {{--<li class=""><a href="#">Home</a></li>--}}


            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span>{{ Auth::user()->name }}</a></li>
                <li>
                    <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <span class="glyphicon glyphicon-log-in"></span> Logout
                    </a>
                    <form id="logout-form" action="{{ route('doctor.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>

        </div>
    </div>
    </div>
</nav>

    @if(Session::has('message'))
        <div class=" alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="container-fluid" style="">
        <div class="col-md-6 col-md-offset-3 list-all" style="">
            <h3 style="text-align: center; margin-top: 10px;">We have received your request. Please, wait for your doctor's approval. Thank you.</h3>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script>
</body>
</html>




