<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ URL::asset('backend/dist/img/no_user_photo-v1.gif') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}</p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="{{ url('/admin') }}">
                    <i class="fa fa-dashboard"></i> <span>Home</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Home Banner</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/homebanners') }}"><i class="fa fa-table"></i> All Home Banner</a></li>
                    <li><a href="{{ url('/admin/homebanners/create') }}"><i class="fa fa-table"></i> Create Home Banner</a></li>
                    <li><a href="{{ url('/admin/homebanners/recover') }}"><i class="fa fa-trash-o"></i> Recover Home Banner</a></li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Category</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/category') }}"><i class="fa fa-table"></i> All categories</a></li>
                    <li><a href="{{ url('/admin/category/create') }}"><i class="fa fa-table"></i> Create category</a></li>
                    <li><a href="{{ url('/admin/category/recover') }}"><i class="fa fa-trash-o"></i> Recover category</a></li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Roles</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/roles') }}"><i class="fa fa-circle-o"></i> All Roles</a></li>
                    <li><a href="{{ url('/admin/roles/create') }}"><i class="fa fa-circle-o"></i> Create Roles</a></li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/users') }}"><i class="fa fa-circle-o"></i> All Users</a></li>

                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>