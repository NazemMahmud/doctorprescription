<?php
/**
 * Created by PhpStorm.
 * User: Nazem Mahmud
 * Date: 9/16/2017
 * Time: 11:04 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  <!--Mobile first-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--IE Compatibility modes-->
    <title>@yield('title') </title>
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
@include('include.header')
@yield('main-body')
<!--jQuery -->
{{--<script src="assets/lib/jquery/jquery.js"></script>--}}



<!--Bootstrap -->
{{--<script src="bootstrap/js/bootstrap.js"></script>--}}
<script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
</body>
</html>

