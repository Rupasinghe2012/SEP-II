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
        <!-- /.search form -->
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
            <li ><a href="{{url('/admin/home')}}"><i class="fa fa-home"></i><span>HOME</span></a></li>
            <li><a href="{{url('/templates/new')}}"><i class="fa fa-plus-square" aria-hidden="true"></i> <span>ADD TEMPLATE</span></a></li>
            <li><a href="{{url('/templates/edit')}}"><i class="fa fa-pencil-square" aria-hidden="true"></i><span>EDIT TEMPLATE</span></a></li>
            <li><a href="{{url('/templates/slide')}}"><i class="fa fa-picture-o" aria-hidden="true"></i> <span>SLIDE-SHOW</span></a></li>
            <li><a href="{{url('/templates/mail/view')}}"><i class="fa fa-envelope-square" aria-hidden="true"></i> <span>MANAGE MAILS</span></a></li>
            <li><a href="{{url('/admin/user/manage')}}"><i class="fa fa-users" aria-hidden="true"></i> <span>MANAGE USERS</span></a></li>
            <li><a href="{{url('/reports')}}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>REPORTS</span></a></li>
            <li><a href="{{url('/my-profile/'.Auth::user()->id)}}"><i class="fa fa-user" aria-hidden="true"></i> <span>MY PROFILE</span></a></li>
            <li><a href="{{url('/calender/view')}}"><i class="fa fa-calendar" aria-hidden="true"></i> <span>EVENT CALENDAR</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>