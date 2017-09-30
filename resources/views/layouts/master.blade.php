<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--IE Compatibility modes-->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!--Mobile first-->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Admin Template">
    <meta name="author" content="">
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') Login </title>
    <link rel="icon" href="{!! asset('img/icon.ico') !!} " />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="{{ URL::to('bootstrap/css/bootstrap.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../public/font-awesome/css/font-awesome.css">

    <!-- Metis core stylesheet -->
    {{--<link rel="stylesheet" href="css/main.css">--}}
    <link rel="stylesheet" href="{{ URL::to('css/main.css') }}">

    <!-- metisMenu stylesheet -->
    {{--<link rel="stylesheet" href="assets/lib/metismenu/metisMenu.css">--}}
    {{--<link rel="stylesheet" href="{{ URL::to('/css/main.css') }}">--}}

    <!-- onoffcanvas stylesheet -->
    {{--<link rel="stylesheet" href="assets/lib/onoffcanvas/onoffcanvas.css">--}}

    <!-- animate.css stylesheet -->
    {{--<link rel="stylesheet" href="assets/lib/animate.css/animate.css">--}}


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="login">
@yield('body')
</body>

</html>
