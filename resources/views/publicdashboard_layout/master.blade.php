<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title> Public Dashboard</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('/assets/assets/css/dashlite.css?ver=3.1.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('/assets/assets/css/theme.css?ver=3.1.2') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-menu-trigger">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-sidebar-brand">
                        <a href="html/index.html" class="logo-link nk-sidebar-logo">
                        <img class="logo-light logo-img" src="{{ asset('/assets/images/logo.png') }}" srcset="{{ asset('/assets/images/logo2x.png 2x') }}" alt="logo">
                            <img class="logo-dark logo-img" src="{{ asset('assets/images/logo-dark.png') }}" srcset="{{ asset('/assets/images/logo-dark2x.png 2x') }}" alt="logo-dark">
                        </a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element nk-sidebar-body">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Use-Case Preview</h6>
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item has-sub active">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class=""></em></span>
                                        <span class="nk-menu-text">College</span>
                                    </a>
                                    <ul class="nk-menu-sub" style="display: block;">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('allcollege/') }}" class="nk-menu-link"><span class="nk-menu-text">All College</span></a>
                                        </li>
                                        <!-- <li class="nk-menu-item">
                                            <a href="" class="nk-menu-link"><span class="nk-menu-text">Approved Users</span></a>
                                        </li> -->
                                    </ul>
                                </li>
                                <!-- <li class="nk-menu-item has-sub active">
                                   <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class=""></em></span>
                                        <span class="nk-menu-text">Colleges</span>
                                    </a>
                                    <ul class="nk-menu-sub" style="display: block;"> 
                                         <li class="nk-menu-item">
                                            <a href="{{ url('addcollege') }}" class="nk-menu-link"><span class="nk-menu-text">Add College</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('collegelist') }}" class="nk-menu-link"><span class="nk-menu-text">College List</span></a>
                                        </li> 
                                    </ul> 
                                </li> -->
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Dashboards</h6>
                                </li><!-- .nk-menu-item -->
                              </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img" src="{{ asset('assets/images/logo.png') }}" srcset="{{ asset('assets/images/logo2x.png 2x') }}" alt="logo">
                                    <img class="logo-dark logo-img" src="{{ asset('assets/images/logo-dark.png') }}" srcset="{{ asset('assets/images/logo-dark2x.png 2x') }}" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-news d-none d-xl-block">
                                <div class="nk-news-list">
                                    
                                </div>
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                     <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">Administrator</div>
                                                    <div class="user-name dropdown-indicator">Abu Bin Ishityak</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>AB</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">Abu Bin Ishtiyak</span>
                                                        <span class="sub-text">info@softnio.com</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                    <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                                    <!-- {{ Auth::user()->user_type }} -->
                                                    @if((Auth::user()->user_type) == 0)
                                                        <li><a href="{{ url('/admin-dashboard/allusers') }}"><span>Back</span></a></li>
                                                    @elseif((Auth::user()->user_type) == 1)
                                                        <li><a href="{{ url('/student-dashboard/student') }}"><span>Back</span></a></li>
                                                    @elseif((Auth::user()->user_type) == 2)
                                                        <li><a href="{{ url('/staff-dashboard/staff') }}"><span>Back</span></a></li>
                                                    @elseif((Auth::user()->user_type) == 3)
                                                        <li><a href="{{ url('/sponsor-dashboard/sponsor') }}"><span>Back</span></a></li>  
                                                    @elseif((Auth::user()->user_type) == 4)
                                                        <li><a href="{{ url('/alumni-dashboard/alumni') }}"><span>Back</span></a></li>  
                                                    @endif
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{ url('logout') }}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                @yield('content')

                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; Copyright </div>
                        </div>
                    </div>
                </div>
                    
    <!-- JavaScript -->
    <script src="{{ asset('/assets/assets/js/bundle.js?ver=3.1.2')}}"></script>
    <script src="{{ asset('/assets/assets/js/scripts.js?ver=3.1.2')}}"></script>
    <script src="{{ asset('/assets/assets/js/charts/gd-default.js?ver=3.1.2')}}"></script>
    <script src="{{ asset('/assets/assets/js/example-toastr.js?ver=3.1.2')}}"></script>
    <script src="{{ asset('/assets/assets/js/libs/datatable-btns.js?ver=3.1.2')}}"></script>
                    
</body>

</html>