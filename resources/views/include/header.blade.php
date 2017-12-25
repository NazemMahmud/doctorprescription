<nav class="navbar navbar-default">
    <div class="container">
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
                {{--<button type="submit" class="btn btn-default" style="display: none;">Submit</button>--}}
            </form>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle glyphicon glyphicon-envelope" data-toggle="dropdown" style="font-size:18px;">
                        <span class="label label-pill label-danger  count" style="border-radius:9px;font-size: 12px; position: absolute; top: 8px; right: 5px; display: none;" > <!--label-danger class-->
<!--               <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span>-->
                        </span>
                    </a>
                    <ul class="dropdown-menu" id="dropdown-notification"></ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu" >
                        <a class="dropdown-item" href="#" style="color: #000;">Account</a>
                        @if( App\Doctor::where('id',Auth::id())->first()->admin_type == 'doctor')
                            <div class="dropdown-divider" style=""></div>
                            <a class="dropdown-item" href="#" style="color: #000;">Assistants</a>
                        @endif
                        <div class="dropdown-divider" style=""></div>
                        <a href="#" class="dropdown-item" style="color: #000;" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Logout
                            {{-- <span class="glyphicon glyphicon-log-in"></span>  --}}
                        </a>
                        <form id="logout-form" action="{{ route('doctor.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
                <li>

                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right ">
                <li class="" sty><a href="{{ route('doctor.dashboard') }}">Home</a></li>
                <li class=""> <a class="" data-toggle="modal" data-target="#myModal"  href="#">Enroll </a> </li>
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
</nav>