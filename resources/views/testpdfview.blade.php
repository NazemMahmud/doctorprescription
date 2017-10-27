<!DOCTYPE html>
<html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <style>
        body {
            /* background-image: url('assets/zois-pictures/mail/logo2.png');*/
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: 50%;
            padding:0 ;
        }
        .border{border-bottom:2px solid #000;}
        p{ margin:0; font-size:18px;}
        h4{ margin:0;}
        .footer{ padding-top:40px;font-size:16px;
            /*    color:#775214; */
            text-align:center;}
        /*
        .block {
           float: left;
           margin: 75px 10px 40px;
           padding: 10px;
           width: auto;
        }
        */
        .block1 {
            /*   float: right;*/
            /*    text-align: center;*/
            margin:75px 20% 20px;
            padding: 10px;
            width: auto;
        }
        .underline{
            width: 100%;
            border-bottom: 4px dotted #4c6aaf;
            margin-bottom: 20px;
        }
        @media screen and (max-width: 480px) {
            body {
                padding:0px;
            }
            .block {
                margin:75px 10px 0px;
            }
            .block1 {
                float: left;
                margin:0px 0 20px;
            }
        }

        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers td{
            width: auto;
            /*        margin-left: 25px;*/
        }
        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        .pdf-comments{
            /*for comment*/
            margin-top: 20px;
            /*height: 30px;*/
            width: 100%;
            min-height: 190px;        }

    </style>
</head>

<body >
<!--
<div style="float:right;">
    <img src="assets/zois-pictures/mail/logo.png" alt="">
</div>
-->


<!--
<div class="block"></div>
-->

<div class="block1">
    <p>Nazem Mahmud</p>
    <p>Academic Achievement</p>
    <p>Chamber Address</p>
    <p>Contact No.</p>
    <p>Email</p>
</div>
<!--    <div class="underline"></div>-->
<table id="patients">
        <tr>
            <td>Patinet Name: {{ $patient->PatientName }} }}</td>
            <td>Patinet Age: {{ $patient->PatientAge }}</td>
            <td>Patinet Weight:{{ $patient->PatientWeight }}</td>
        </tr>
</table>


<table id="customers">
    <tr>
        <th>Test Name</th>
        <th>Checked</th>
    </tr>
    @foreach($tests as $test)
        <tr>
            <td>{{ App\Test::where('Testid', $test->test_id)->first()->TestName }}</td>
            <td></td>
        </tr>
    @endforeach

</table>
<div class="pdf-comments">
    {{--for comment--}}
    <h3>Any Comments</h3>
</div>
<p class="footer">Address: 219/220,(4th Floor) Nawabpur Road, Dhaka. Cell: +(880)1977-964723 </p>
</body>
</html>


{{--<html>--}}
{{--<head>--}}

    {{--<style>--}}
        {{--/*pdf view start*/--}}

        {{--.pdf-content{--}}
            {{--/*pdf body*/--}}
            {{--width: 100%;--}}
            {{--height: auto;--}}
            {{--/*background-color: #d3d3d3;*/--}}
        {{--}--}}
        {{--.pdf-doctor{--}}
            {{--/*for doctor*/--}}
            {{--border-bottom: 1px dashed gray;--}}
        {{--}--}}
        {{--.rx{--}}
            {{--float: left;--}}
            {{--margin-top: 5px;--}}
            {{--width: 100px;--}}
            {{--height:100px;--}}
            {{--/*background: url("../images/rx1.png");*/--}}
        {{--}--}}
        {{--.rx img{--}}
            {{--width: 100px;--}}
            {{--height:100px;--}}
        {{--}--}}

        {{--.doctor-info p{--}}
            {{--text-align: center;--}}
        {{--}--}}
        {{--/*--}}{{--for patient start--}}{{--*/--}}
        {{--.pdf-patient{--}}
            {{--margin-top: 7px;--}}
            {{--border-top: 1px dashed gray;--}}
            {{--height: 30px;--}}
            {{--width: 100%;--}}
        {{--}--}}
        {{--.pdf-patient h4{--}}
            {{--/*float: left;*/--}}
            {{--display: inline;--}}
            {{--color: #0000cc;--}}
        {{--}--}}
        {{--.pdf-patient-name{--}}
            {{--float: left;--}}
            {{--margin-left: 76px;--}}
            {{--margin-top: 7px;--}}
            {{--width: 45%;--}}
        {{--}--}}
        {{--.pdf-patient-name h4{--}}
            {{--/*display: inline;*/--}}
        {{--}--}}
        {{--.pdf-test{--}}
            {{--/*for test*/--}}
            {{--margin-top: 20px;--}}
            {{--height: 5em;--}}
            {{--width: 100%;--}}
            {{--/*border: 1px solid black;*/--}}
        {{--}--}}
        {{--.pdf-test h4{--}}
            {{--margin-left: 76px;--}}
            {{--/*display: inline;*/--}}
            {{--color: #0000cc;--}}
        {{--}--}}
        {{--.pdf-test-list{--}}
            {{--/*border: 1px solid black;*/--}}
            {{--/*float: left;*/--}}
            {{--margin-left: 78px;--}}
            {{--/*width: 40%;*/--}}
        {{--}--}}
        {{--.pdf-test-list p{--}}
            {{--margin-left: 15px;--}}
            {{--padding-top: 5px;--}}
        {{--}--}}
        {{--.testNames{--}}
            {{--background: #10e37a;--}}
            {{--margin-bottom: 2px;--}}
            {{--/*text-align: center;*/--}}
            {{--width: auto;--}}
            {{--height: auto;--}}
        {{--}--}}

        {{--/*pdf view end*/--}}
    {{--</style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="pdf-content">--}}
    {{--<div class="pdf-doctor">--}}
        {{----}}
    {{--</div>--}}

    {{--<div class="pdf-patient">--}}
        {{--for patient--}}
        {{--<div class="pdf-patient-name">--}}
            {{--<h4><i>Patient name</i>: </h4>--}}
            {{--<h4>{{ $patients->name }}</h4>--}}
            {{--style="text-decoration: underline; text-decoration-style: dotted;"--}}
        {{--</div>--}}
        {{--<div class="pdf-patient-date" style="margin-left: 175px;">--}}
            {{--<h4><i>Date</i>: </h4>--}}
            {{--<h4>{{ $patients->created_at }}</h4>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="pdf-test">--}}
        {{--for test--}}
        {{--<h4>Tests</h4>--}}

        {{--<div class="pdf-test-list">--}}
            {{--<ul>--}}
                {{--@foreach($tests as $test)--}}
                    {{--<li style="list-style: none;">--}}
                        {{--<div class="testNames">{{ $test->test_name }}</div>--}}
                    {{--</li>--}}
                {{--@endforeach--}}
            {{--</ul><!-- show test list  end -->--}}
        {{--</div>--}}

    {{--</div>--}}




{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
