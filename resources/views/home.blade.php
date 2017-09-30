<html>
<title>Doctor Prescription</title>
    <body>
    <div id="header">
        <h1><a href="" style="color: white;">Logo</a></h1>
    </div>
    <!--close-Header-part-->

    <!--top-Header-menu-->
    <div id="user-nav" class="navbar navbar-inverse">
        <ul class="nav">
{{--            <li>{{ Auth::user()->username }}</li>--}}
            <li>
                <a href=""
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                </a>

                {{--<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">--}}
                    {{--{{ csrf_field() }}--}}
                {{--</form>--}}
            </li>
        </ul>
    </div>

    <!--start-top-serch-->
    <div id="search">
        <input type="text" placeholder="Search here..."/>
        <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
    </div>
    <!--close-top-serch-->
        <h1>mara khaw</h1>
    </body>
</html>