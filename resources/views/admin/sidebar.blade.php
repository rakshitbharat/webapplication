<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">       
        <ul class="sidebar-menu">
            <li class="home">
                <a href="{{ route('admin_home') }}"> <i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="usermanagement">
                        <a href="{!! route('admin_usermanagement.index') !!}">
                            <i class="fa fa-user"></i> <span>Admin Users</span>
                        </a>
                    </li>
                    <li class="normalusermanagement">
                        <a href="{!! route('admin_normalusermanagement.index') !!}" class="nav-link ">
                            <i class="fa fa-users"></i>
                            <span class="title">Normal Users</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
                <li class="mainTransaction">
                    <a href="{!! route('admin_mainTransaction') !!}" class="nav-link ">
                            <i class="fa fa-money"></i>
                            <span class="title">Main Transaction</span>
                            <span class="selected"></span>
                    </a>
                </li>
                <li class="accountType">
                    <a href="{!! route('admin_accountType') !!}" class="nav-link ">
                            <i class="fa fa-server"></i>
                            <span class="title">Account Type</span>
                            <span class="selected"></span>
                    </a>
                </li>
                <li class="account">
                    <a href="{!! route('admin_account') !!}" class="nav-link ">
                            <i class="fa fa-server"></i>
                            <span class="title">Account</span>
                            <span class="selected"></span>
                    </a>
                </li>
            </li>
        </ul>
    </section>
</aside>