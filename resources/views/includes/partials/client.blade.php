<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->profile_pic==NULL ? URL::asset('/img/pro.jpg') : URL::asset(Auth::user()->profile_pic) }}"  class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li ><a href="{{url('/home')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li><a href="{{url('/site')}}"><i class="fa fa-desktop"></i> <span>MY Sites</span></a></li>
            <li><a href="{{url('/temp')}}"><i class="fa fa-television"></i> <span>My Templates</span></a></li>
            <li><a href="{{url('/profile')}}"><i class="fa fa-user"></i> <span>My Profile</span></a></li>
            <li><a href="{{url('/gallery/list')}}"><i class="fa fa-photo"></i> <span>My galery</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>