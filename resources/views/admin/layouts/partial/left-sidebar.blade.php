<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('admin.dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3><b>Abir</b> Ecommerce</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.home') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-tachometer {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.home') ? 'text-white' : '' }}"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="header nav-small-cap">eCommarce</li>
            <li class="{{  Request::is('admin/product*') ? 'active' : '' }}">
                <a href="{{ route('admin.product.index') }}">
                    <i class="fa fa-pinterest-p {{  Request::is('admin/product*') ? 'text-white' : '' }}"></i>
                    <span>Product</span>
                </a>
            </li>
            <li class="{{  Request::is('admin/brand*') ? 'active' : '' }}">
                <a href="{{ route('admin.brand.index') }}">
                    <i class="fa fa-bandcamp {{  Request::is('admin/brand*') ? 'text-white' : '' }}"></i>
                    <span>Brand</span>
                </a>
            </li>

            <li class="treeview {{  Request::is('admin/category*') || Request::is('admin/subcategory*') || Request::is('admin/sub/subcategory*') ? 'active menu-open' : '' }}">
                <a href="">
                    <i class="fa fa-th-large"></i>
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{  Request::is('admin/category*') ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}">
                            <i class="ti-more {{  Request::is('admin/category*') ? 'text-white' : '' }}"></i>
                            <span>Category</span>
                        </a>
                    </li>
                    <li class="{{  Request::is('admin/subcategory*') ? 'active' : '' }}">
                        <a href="{{ route('admin.subcategory.index') }}">
                            <i class="ti-more {{  Request::is('admin/subcategory*') ? 'text-white' : '' }}"></i>
                            <span>Subcategory</span>
                        </a>
                    </li>
                    <li class="{{  Request::is('admin/sub/subcategory*') ? 'active' : '' }}">
                        <a href="{{ route('admin.sub.subcategory.index') }}">
                            <i class="ti-more {{  Request::is('admin/sub/subcategory*') ? 'text-white' : '' }}"></i>
                            <span>Sub Subcategory</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{  Request::is('admin/slider*') ? 'active' : '' }}">
                <a href="{{ route('admin.slider.index') }}">
                    <i class="fa fa-sliders {{  Request::is('admin/slider*') ? 'text-white' : '' }}"></i>
                    <span>Slider</span>
                </a>
            </li>

            <li class="{{  Request::is('admin/coupon*') ? 'active' : '' }}">
                <a href="{{ route('admin.coupon.index') }}">
                    <i class="fa fa-gift {{  Request::is('admin/coupon*') ? 'text-white' : '' }}"></i>
                    <span>Coupon</span>
                </a>
            </li>
            <li class="treeview {{  Request::is('admin/address*') ? 'active menu-open' : '' }}">
                <a href="">
                    <i class="fa fa-th-large"></i>
                    <span>Shipping Address</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{  Request::is('admin/address/country*') ? 'active' : '' }}">
                        <a href="{{ route('admin.address.country.index') }}">
                            <i class="ti-more {{  Request::is('admin/address/country*') ? 'text-white' : '' }}"></i>
                            <span>Country</span>
                        </a>
                    </li>
                    <li class="{{  Request::is('admin/address/division*') ? 'active' : '' }}">
                        <a href="{{ route('admin.address.division.index') }}">
                            <i class="ti-more {{  Request::is('admin/address/division*') ? 'text-white' : '' }}"></i>
                            <span>Division</span>
                        </a>
                    </li>
                    <li class="{{  Request::is('admin/address/district*') ? 'active' : '' }}">
                        <a href="{{ route('admin.address.district.index') }}">
                            <i class="ti-more {{  Request::is('admin/address/district*') ? 'text-white' : '' }}"></i>
                            <span>District</span>
                        </a>
                    </li>
                    <li class="{{  Request::is('admin/address/city*') ? 'active' : '' }}">
                        <a href="{{ route('admin.address.city.index') }}">
                            <i class="ti-more {{  Request::is('admin/address/city*') ? 'text-white' : '' }}"></i>
                            <span>City</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{  Request::is('admin/order*') ? 'active' : '' }}">
                <a href="{{ route('admin.order.index') }}">
                    <i class="fa fa-gift {{  Request::is('admin/order*') ? 'text-white' : '' }}"></i>
                    <span>Order</span>
                </a>
            </li>

            <li class="header nav-small-cap">EXTRA</li>
            <li>
                <a href="{{ route('home') }}">
                    <i data-feather="lock" class="fa fa-home"></i>
                    <span>Visit Website</span>
                </a>
            </li>
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
            aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                class="ti-email"></i></a>
        <!-- item-->
        <a href="{{ route('admin.profile.logout') }}" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
                class="ti-lock"></i></a>
    </div>
</aside>
