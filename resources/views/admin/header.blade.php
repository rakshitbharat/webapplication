<header class="main-header">
    <a href="index2.html" class="logo">
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <a href="#">ComingSoon</a>
                                </div>
                            </div>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{!! route('admin_adminprofile') !!}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{!! route('admin_logout') !!}" class="btn btn-default btn-flat"
                                   onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i> Log Out</a>

                                <form id="logout-form" action="{!! route('admin_logout') !!}" method="POST" style="display: none;">
                                    {{ csrf_field() }} 
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>