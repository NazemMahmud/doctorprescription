<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

                {{--<img class="logo" src="{!! asset('img/dpicon.png') !!}" alt="Doctor Prescription Logo" width="54" height="54">--}}
                <a class="navbar-brand" href="#">
                    <img style="display: inline-block;margin-right: 1px; " class="" src="{!! asset('img/dpicon.png') !!}" alt="Doctor Prescription Logo" width="35" height="35">
                    <span style="color: #008000;">Doctor Prescription</span>
                </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <form class="navbar-form navbar-left" id="navBarSearchForm" style="padding-left: 50px; align-content: center;">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default" style="display: none;">Submit</button>
            </form>
            <ul class="nav navbar-nav ">
                <li class=""><a href=""></a></li>
                <li class=""><a href=""></a></li>
                <li class=""><a href="{{ route('doctor.dashboard') }}">Home</a></li>
                <li class="">
                    <a class="" data-toggle="modal" data-target="#myModal"  href="#">Patient </a>
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="#">Create Patient</a></li>--}}
                        {{--<li><a href="#">Patient List</a></li>--}}
                        {{--<li><a href="#">Page 1-3</a></li>--}}
                    {{--</ul>--}}
                </li>
                {{--<li><a href="#">Patient</a></li>--}}
                {{--<li><a href="#">Page 3</a></li>--}}
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

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Patient Enrollment Information</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('create_patient') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group" style="">
                                    <label for="name">Name *</label>
                                    <input required class="form-control" name="patient_name" type="text"  id="patient_name" placeholder="Patient name">
                                </div>
                                <div class="form-group" style="">
                                    <label for="name">Age *</label>
                                    <input class="form-control" name="patient_age" type="text"  id="patient_age" placeholder="Patient Age">
                                </div>
                                <div class="form-group" style="">
                                    <label for="name">Weight *</label>
                                    <input class="form-control" name="patient_weight" type="text"  id="patient_weight" placeholder="Patient Weight">
                                </div>

                                <div class="form-group" style="">
                                    <label for="name">Mobile no. *</label>
                                    <input required class="form-control" name="patient_mobile" type="text"  id="patient_mobile" placeholder="Patient Mobile No.">
                                </div>

                                <button type="submit" class="btn btn-view buton">Enroll</button>
                                {{--<button type="submit" class="btn btn-primary">Back</button>--}}
                                {{--<input type="hidden" name="_token" value="{{ Session::token() }}">--}}

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-view" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        </div>
    </div>
</nav>