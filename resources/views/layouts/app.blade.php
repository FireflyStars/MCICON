<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>MCICON</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        {{-- Notification Css from libs --}}
        <link href="{{ asset('libs/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="{{ asset('css/backend/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/backend/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/backend/style.css') }}" rel="stylesheet" type="text/css" />
        @yield('style')
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fas fa-user-circle"></i>
                            <!-- <img src="assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle"> -->
                            <span class="pro-user-name ml-1">
                                Admin <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                            <!-- item-->
                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings"></i>
                                <span>Settings</span>
                            </a> --}}

                            <!-- item-->
                            <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo text-center">
                        <span class="logo-lg">
                            <img src="{{ asset('images/logo.svg') }}" alt="" height="40" width="240" style="object-fit: cover">
                            <!-- <span class="logo-lg-text-light text-primary">VoetbalTalk</span> -->
                        </span>
                        <span class="logo-sm">
                            <img src="{{ asset('images/logo.svg') }}" alt="" height="40" width="40">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile disable-btn waves-effect">
                            <i class="fe-menu"></i>
                        </button>
                    </li>
                </ul>

            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                {{-- <div class="slimscroll-menu"> --}}
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <li class="menu-title">Navigation</li>

                            <li>
                                <a href="{{ route('about-us.index') }}">
                                    <i class="mdi mdi-newspaper"></i>
                                    <span> About Us </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('privacy.index') }}">
                                    <i class="mdi mdi-newspaper"></i>
                                    <span> Privacy </span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('price.index') }}">
                                    <i class="mdi mdi-newspaper"></i>
                                    <span> Price </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('resource-rule.index') }}">
                                    <i class="far fa-address-card"></i>
                                    <span> Resource Rule </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('category.index') }}">
                                    <i class="far fa-address-card"></i>
                                    <span> Category </span>
                                </a>
                            </li>

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                {{-- </div> --}}
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                <!-- Start Content-->
                @yield('content')
                </div> <!-- content -->
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                            2019 &copy; Repair <a href=""></a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->
        @include('variable')
        <!-- Vendor js -->
        <script src="{{ asset('js/backend/vendor.min.js') }}"></script>

        <!-- Toastr js -->
        <script src="{{ asset('/libs/toastr/toastr.min.js') }}"></script>

        <!-- knob plugin -->
        <script src="{{ asset('libs/jquery-knob/jquery.knob.min.js') }}"></script>

        {{-- vuejs cdn --}}
        <script src="{{ asset('libs/vuejs/vue.js') }}"></script>
        <script src="{{ asset('libs/vuejs/axios.min.js') }}"></script>

        <!-- App js -->

        <script src="{{ asset('js/backend/app.min.js') }}"></script>
        @yield('script')
    </body>
</html>
