<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/home') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_home') }}"><i class="fab fa-adn"></i>
                    <span>Dashboard</span></a></li>
            <li class="{{ Request::is('admin/setting') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_setting') }}"><i class="fa fa-cog"></i>
                    <span>Setting</span></a></li>

            <li
                class="nav-item dropdown {{ Request::is('admin/top-advertisement') || Request::is('admin/home-advertisement') || Request::is('admin/sidebar-advertisement-*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fab fa-adversal"></i><span>Advertisements</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/top-advertisement') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_top_ad_show') }}"><i class="fas fa-angle-right"></i>Top
                            Advertisements</a></li>
                    <li class="{{ Request::is('admin/home-advertisement') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin_home_ad_show') }}"><i
                                class="fas fa-angle-right"></i>Home
                            Advertisements</a></li>
                    <li class="{{ Request::is('admin/sidebar-advertisement-*') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin_sidebar_ad_show') }}"><i
                                class="fas fa-angle-right"></i>Sidebar
                            Advertisements</a></li>
                </ul>
            </li>

            <li
                class="nav-item dropdown {{ Request::is('admin/category/*') || Request::is('admin/subcategory/*') || Request::is('admin/post/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-newspaper"></i><span>News</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/category/*') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_category_index') }}"><i class="fas fa-angle-right"></i>Categories
                            List</a></li>
                    <li class="{{ Request::is('admin/subcategory/*') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_subcategory_index') }}"><i
                                class="fas fa-angle-right"></i>SubCategories
                            List</a></li>
                    <li class="{{ Request::is('admin/post/*') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_post_index') }}"><i class="fas fa-angle-right"></i>Post List</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="nav-item dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Dropdown
                        Items</span></a>
                <ul class="dropdown-menu">
                    <li class="active"><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Item
                            1</a></li>
                    <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Item
                            2</a></li>
                </ul>
            </li> --}}

            {{-- <li class=""><a class="nav-link" href="setting.html"><i
                        class="fas fa-hand-point-right"></i> <span>Setting</span></a></li>

            <li class=""><a class="nav-link" href="form.html"><i
                        class="fas fa-hand-point-right"></i> <span>Form</span></a></li>

            <li class=""><a class="nav-link" href="table.html"><i
                        class="fas fa-hand-point-right"></i> <span>Table</span></a></li>

            <li class=""><a class="nav-link" href="invoice.html"><i
                        class="fas fa-hand-point-right"></i> <span>Invoice</span></a></li> --}}

        </ul>
    </aside>
</div>
