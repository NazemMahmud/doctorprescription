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

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    {{--<link rel="stylesheet" href="/resources/demos/style.css">--}}


    <style>

    </style>

</head>
<body style="background-color: #e9ebee;">
@include('include.header')
@yield('main-body')

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var _token = $("#token").val();

        function load_unseen_notification(view = '')
        {
            $.post( "fetch_msg", { token: _token, view: view }, function( data ) {
                console.log( data.unseen_notification); //#dropdown-notification
                console.log( view );
                $('#dropdown-notification').html(data.notification);
                if(data.unseen_notification > 0)
                {
                    $('.count').css('display', 'block');
                    $('.count').html(data.unseen_notification);
                }
            }, "json");
        }

        load_unseen_notification();    // on page load this function will be called; goto function load_unseen_notification(view = '')

        $(document).on('click', '.dropdown-toggle', function(){
            $('.count').html('');
            $('.count').css('display', 'none');
            load_unseen_notification('yes'); // yes likhe pathale view =yes hoy i.e. view!=''; so comment status update hoy
        });

//        setInterval(function(){
//            load_unseen_notification();
//        }, 5000);



    });
</script>
<script src="{{ URL::to('js/requestHandle.js') }}"></script>
</body>
</html>

