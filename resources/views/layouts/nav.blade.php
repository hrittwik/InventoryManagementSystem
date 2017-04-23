<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            {{-- <li class="header">HEADER</li> --}}

            <!-- Optionally, you can add icons to the links -->

            <li class="{{ ($menu['menu'] == "dashboard" ? "active" : "#") }}">
                <a href="{{ url('/') }}"> <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="{{ ($menu['menu'] == "product" ? "active" : "#") }}">
                <a href="{{ url('/product') }}"><i class="fa fa-folder" aria-hidden="true"></i>
                    <span>Product</span>
                </a>
            </li>

            <li class="{{ ($menu['menu'] == "vendor" ? "active" : "#") }}">
                <a href="{{ url('/vendor') }}"><i class="fa fa-building-o"></i>
                    <span>Vendor</span>
                </a>
            </li>

            <li class="{{ ($menu['menu'] == "unit" ? "active" : "#") }}">
                <a href="{{ url('/unit') }}"><i class="fa fa-balance-scale" aria-hidden="true"></i>
                    <span>Unit</span>
                </a>
            </li>

            <li class="{{ ($menu['menu'] == "purchase" ? "active" : "#") }} treeview">
                <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Purchase</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">

                    @if(array_key_exists('sub-menu', $menu))
                        <li class="{{ ($menu['sub-menu'] == 'purchase-index' ? 'active' : '#') }}">
                    @else
                        <li class="#">
                    @endif
                        <a href="{{ url('/purchase') }}"><i class="fa fa-circle-o"></i> Index</a>
                    </li>

                </ul>

        </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
