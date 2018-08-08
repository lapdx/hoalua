<a href="{{route('controller::product::index')}}" class="logo">
    <span class="logo-mini"><b>HL</b></span>
    <span class="logo-lg"><b>HOA</b> LUA</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" ng-controller="HeaderController">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li style="padding: 15px 0;">
                <img src="/images/ajax-loader.gif" 
                                 ng-show="isFindingisShowLoading"
                                 alt="loading" style="height: 20px"/>
            </li>
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('images/user_default.png')}}" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo \Illuminate\Support\Facades\Auth::user()->email ?></span>
                </a>
            </li>
            
            <!-- Control Sidebar Toggle Button -->
            <li>
                <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i></a>
            </li>
            <form id="logout-form" method="post" action="/logout">
                <?= csrf_field() ?>
            </form>
        </ul>
    </div>
</nav>