<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Prof</b>.net</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Profiler</b>.net</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning" id="notificationBell"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu" id="sl">
                                @yield('notifications')

                            </ul>
                        </li>
                        <li class="footer"><a href="{{ url('/notificationsView') }}">View all</a></li>
                    </ul>
                </li>

                <!-- User Account Menu -->
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('auth/login') }}">Login</a></li>
                    <li><a href="{{ url('auth/register') }}">Register</a></li>
                @else
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ Auth::user()->profile_pic==NULL ? URL::asset('/img/pro.jpg') : URL::asset(Auth::user()->profile_pic) }}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ Auth::user()->profile_pic==NULL ? URL::asset('/img/pro.jpg') : URL::asset(Auth::user()->profile_pic) }}" class="img-circle" alt="User Image">
                                <p>
                                    {{ Auth::user()->name }}
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    @endif
                            <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>
    </nav>
</header>
