<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>{{ $title ?? 'Dashboard || Admin Panel' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Feel Good connects you with expert mental health professionals and coaches to help you overcome challenges and achieve personal and professional goals. Learn to manage yourself and feel good.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('public/favicons') }}/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('public/favicons') }}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('public/favicons') }}/favicon-16x16.png">
    <link rel="manifest" href="{{ url('public/favicons') }}/site.webmanifest">
    <meta content="Umesh Upadhayay" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="favicons/images-favicon.ico">

    {{--<script src="{{ url('public/js/jquery-jquery.min.js') }}"></script>--}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- plugin css -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('public/css/jquery.vectormap-jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css">
    
    <!-- preloader css -->
    <link rel="stylesheet" href="{{ url('public/css/css-preloader.min.css') }}" type="text/css">
    <!-- apexcharts -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ url('public/js/apexcharts-apexcharts.min.js') }}"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ url('public/css/css-bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ url('public/css/css-icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-thin-straight/css/uicons-thin-straight.css'>
    <link href="{{ url('public/css/css-app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="{{ url('public/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.css" integrity="sha512-X6069m1NoT+wlVHgkxeWv/W7YzlrJeUhobSzk4J09CWxlplhUzJbiJVvS9mX1GGVYf5LA3N9yQW5Tgnu9P4C7Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js" integrity="sha512-SXJkO2QQrKk2amHckjns/RYjUIBCI34edl9yh0dzgw3scKu0q4Bo/dUr+sGHMUha0j9Q1Y7fJXJMaBi4xtyfDw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 @yield('script')
    <style>
        .navbar-brand-box {
            background-color: #077773 !important;
            -webkit-box-shadow: 0 1px 0 #077773 !important;
            box-shadow: 0 1px 0 #077773 !important;
        }

        .vertical-menu {
            background-color: #077773 !important;
        }


        #sidebar-menu ul li a,
        .menu-title,
        #sidebar-menu ul li a i,
        body:not([data-sidebar-size=sm]) #vertical-menu-btn,
        .logo-txt {
            color: #fff;
        }


        .toast-success {
            background: #077773;
        }

        .toast-error {
            background: red;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: #077773;
            color: #fff;
        }

        body[data-sidebar=dark] #sidebar-menu ul li a {
            color: #fff;
        }

        body[data-sidebar=dark] #sidebar-menu ul li a i {
            color: #fff;
        }
        body[data-sidebar=dark] #sidebar-menu ul li ul.sub-menu li a{
            color:#fff;
        }
        body[data-sidebar=dark][data-sidebar-size=sm] .vertical-menu #sidebar-menu>ul>li:hover>ul a{
            color:#fff;
        }

        /*.mm-active .active{*/
        /*    color: #077773 !important;*/
        /*}*/
        /*.mm-active .active i{*/
        /*    color: #fff;*/
        /*}*/
    </style>
    <script>
        const url = "{{ url('') }}";
    </script>
</head>


<body class="sidebar-enable" data-sidebar="dark" data-sidebar-size="lg">

    @foreach ($errors->all() as $item)
        <script>
            toastr.error('{{ $item }}', 'Errpr Occured')
        </script>
    @endforeach
    @if (session()->has('error'))
        <script>
            toastr.error("{{ session()->get('error') }}", 'Error')
        </script>
    @endif

    @if (session()->has('success'))
        <script>
            toastr.success('{{ session()->get('success') }}', 'Success')
        </script>
    @endif
    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ url('admin/dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ url('public/assets/img/footer-logo.png') }}" alt=""  class="img-fluid">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ url('public/assets/img/footer-logo.png') }}" alt="" class="img-fluid">
                                <!--<span class="logo-txt">edha</span>-->
                            </span>
                        </a>

                        <a href="{{ url('admin/dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ url('public/assets/img/footer-logo.png') }}" alt="" class="img-fluid">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ url('public/assets/img/footer-logo.png') }}" alt="" class="img-fluid">
                                <!--<span class="logo-txt">edha</span>-->
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    <!--<form class="app-search d-none d-lg-block">-->
                    <!--    <div class="position-relative">-->
                    <!--        <input type="text" class="form-control" placeholder="Search...">-->
                    <!--        <button class="btn btn-success" type="button"><i-->
                    <!--                class="bx bx-search-alt align-middle"></i></button>-->
                    <!--    </div>-->
                    <!--</form>-->
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="search" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Search Result">

                                        <button class="btn btn-primary" type="submit"><i
                                                class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-none d-sm-inline-block">
                        <!--<button type="button" class="btn header-item" id="mode-setting-btn">-->
                          
                        <!--    <i class="fas fa-sun" class="icon-lg layout-mode-light"></i>-->
                        <!--</button>-->
                    </div>

                    <!--<div class="dropdown d-none d-lg-inline-block ms-1">-->
                    <!--    <button type="button" class="btn header-item" data-bs-toggle="dropdown"-->
                    <!--        aria-haspopup="true" aria-expanded="false">-->
                    <!--        <i data-feather="grid" class="icon-lg"></i>-->
                    <!--    </button>-->
                    <!--    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">-->
                    <!--        <div class="p-2">-->
                    <!--            <div class="row g-0">-->
                    <!--                <div class="col">-->
                    <!--                    <a class="dropdown-icon-item" href="#">-->
                    <!--                        <img src="{{ url('public/images/brands-github.jpg') }}" alt="Github">-->
                    <!--                        <span>GitHub</span>-->
                    <!--                    </a>-->
                    <!--                </div>-->
                    <!--                <div class="col">-->
                    <!--                    <a class="dropdown-icon-item" href="#">-->
                    <!--                        <img src="{{ url('public/images/brands-bitbucket.jpg') }}"-->
                    <!--                            alt="bitbucket">-->
                    <!--                        <span>Bitbucket</span>-->
                    <!--                    </a>-->
                    <!--                </div>-->
                    <!--                <div class="col">-->
                    <!--                    <a class="dropdown-icon-item" href="#">-->
                    <!--                        <img src="{{ url('public/images/brands-dribbble.jpg') }}" alt="dribbble">-->
                    <!--                        <span>Dribbble</span>-->
                    <!--                    </a>-->
                    <!--                </div>-->
                    <!--            </div>-->

                    <!--            <div class="row g-0">-->
                    <!--                <div class="col">-->
                    <!--                    <a class="dropdown-icon-item" href="#">-->
                    <!--                        <img src="{{ url('public/images/brands-dropbox.jpg') }}" alt="dropbox">-->
                    <!--                        <span>Dropbox</span>-->
                    <!--                    </a>-->
                    <!--                </div>-->
                    <!--                <div class="col">-->
                    <!--                    <a class="dropdown-icon-item" href="#">-->
                    <!--                        <img src="{{ url('public/images/brands-mail_chimp.jpg') }}"-->
                    <!--                            alt="mail_chimp">-->
                    <!--                        <span>Mail Chimp</span>-->
                    <!--                    </a>-->
                    <!--                </div>-->
                    <!--                <div class="col">-->
                    <!--                    <a class="dropdown-icon-item" href="#">-->
                    <!--                        <img src="{{ url('public/images/brands-slack.jpg') }}" alt="slack">-->
                    <!--                        <span>Slack</span>-->
                    <!--                    </a>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <!--<div class="dropdown d-inline-block">-->
                    <!--    <button type="button" class="btn header-item noti-icon position-relative"-->
                    <!--        id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"-->
                    <!--        aria-expanded="false">-->
                    <!--        <i class="fas fa-bell"></i>-->
                    <!--        <span class="badge bg-danger rounded-pill">5</span>-->
                    <!--    </button>-->
                    <!--    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"-->
                    <!--        aria-labelledby="page-header-notifications-dropdown">-->
                    <!--        <div class="p-3">-->
                    <!--            <div class="row align-items-center">-->
                    <!--                <div class="col">-->
                    <!--                    <h6 class="m-0"> Notifications </h6>-->
                    <!--                </div>-->
                    <!--                <div class="col-auto">-->
                    <!--                    <a href="#!" class="small text-reset text-decoration-underline"> Unread-->
                    <!--                        (3)</a>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div data-simplebar style="max-height: 230px;">-->
                    <!--            <a href="#!" class="text-reset notification-item">-->
                    <!--                <div class="d-flex">-->
                    <!--                    <div class="flex-shrink-0 me-3">-->
                    <!--                        <img src="{{ url('public/images/users-avatar-3.jpg') }}"-->
                    <!--                            class="rounded-circle avatar-sm" alt="user-pic">-->
                    <!--                    </div>-->
                    <!--                    <div class="flex-grow-1">-->
                    <!--                        <h6 class="mb-1">James Lemire</h6>-->
                    <!--                        <div class="font-size-13 text-muted">-->
                    <!--                            <p class="mb-1">It will seem like simplified English.</p>-->
                    <!--                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hour-->
                    <!--                                    ago</span></p>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </a>-->
                    <!--            <a href="#!" class="text-reset notification-item">-->
                    <!--                <div class="d-flex">-->
                    <!--                    <div class="flex-shrink-0 avatar-sm me-3">-->
                    <!--                        <span class="avatar-title bg-primary rounded-circle font-size-16">-->
                    <!--                            <i class="bx bx-cart"></i>-->
                    <!--                        </span>-->
                    <!--                    </div>-->
                    <!--                    <div class="flex-grow-1">-->
                    <!--                        <h6 class="mb-1">Your order is placed</h6>-->
                    <!--                        <div class="font-size-13 text-muted">-->
                    <!--                            <p class="mb-1">If several languages coalesce the grammar</p>-->
                    <!--                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min-->
                    <!--                                    ago</span></p>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </a>-->
                    <!--            <a href="#!" class="text-reset notification-item">-->
                    <!--                <div class="d-flex">-->
                    <!--                    <div class="flex-shrink-0 avatar-sm me-3">-->
                    <!--                        <span class="avatar-title bg-success rounded-circle font-size-16">-->
                    <!--                            <i class="bx bx-badge-check"></i>-->
                    <!--                        </span>-->
                    <!--                    </div>-->
                    <!--                    <div class="flex-grow-1">-->
                    <!--                        <h6 class="mb-1">Your item is shipped</h6>-->
                    <!--                        <div class="font-size-13 text-muted">-->
                    <!--                            <p class="mb-1">If several languages coalesce the grammar</p>-->
                    <!--                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min-->
                    <!--                                    ago</span></p>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </a>-->

                    <!--            <a href="#!" class="text-reset notification-item">-->
                    <!--                <div class="d-flex">-->
                    <!--                    <div class="flex-shrink-0 me-3">-->
                    <!--                        <img src="{{ url('public/images/users-avatar-6.jpg') }}"-->
                    <!--                            class="rounded-circle avatar-sm" alt="user-pic">-->
                    <!--                    </div>-->
                    <!--                    <div class="flex-grow-1">-->
                    <!--                        <h6 class="mb-1">Salena Layfield</h6>-->
                    <!--                        <div class="font-size-13 text-muted">-->
                    <!--                            <p class="mb-1">As a skeptical Cambridge friend of mine occidental.-->
                    <!--                            </p>-->
                    <!--                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hour-->
                    <!--                                    ago</span></p>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </a>-->
                    <!--        </div>-->
                    <!--        <div class="p-2 border-top d-grid">-->
                    <!--            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">-->
                    <!--                <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>-->
                    <!--            </a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item right-bar-toggle me-2">
                            <i data-feather="settings" class="icon-lg"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-light-subtle border-start border-end"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{ url('public/images/logo.png') }}"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">
                                edha
                            </span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="{{route('profile')}}"><i
                                    class="mdi mdi mdi-face-man font-size-16 align-middle me-1"></i> Profile</a>
                            <!--<a class="dropdown-item" href="auth-lock-screen.html"><i-->
                            <!--        class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock Screen</a>-->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('admin/logout') }}"><i
                                    class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" data-key="t-menu">Menu</li>

                        <li>
                            <a href="{{ url('admin/dashboard') }}">
                                <i class="fas fa-tv"></i>
                                <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>
                       





                        <li>
                            <a href="javascript:%20void(0);" class="has-arrow">
                                <i class="fi fi-rs-calendar"></i>
                                <span data-key="t-tables">Bookings</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ route('bookings') }}">
                                        <span data-key="t-dashboard">Package Bookings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sessions', ['url' => 'all', 'id' => 'all']) }}"
                                        data-key="t-basic-tables">All
                                        Sessions</a>
                                </li>
                                <li>
                                    <a href="{{ route('sessions', ['url' => 'Pending', 'id' => 'all']) }}"
                                        data-key="t-basic-tables">Open
                                        Sessions</a>
                                </li>
                                <li>
                                    <a href="{{ route('sessions', ['url' => 'done', 'id' => 'all']) }}"
                                        data-key="t-basic-tables">Closed
                                        Sessions
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sessions', ['url' => 'cancel', 'id' => 'all']) }}"
                                        data-key="t-basic-tables">Cancelled
                                        Sessions
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:%20void(0);" class="has-arrow">
                                <i class="fi fi-rs-chart-line-up"></i>
                                <span data-key="t-tables">Reports</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ url('admin/expert-statics') }}">
                                        <span data-key="t-dashboard">Expert Report</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('financial_report') }}" data-key="t-basic-tables">Financial
                                        Report</a>
                                </li>
                                <li>
                                    <a href="{{ route('session_reports') }}" data-key="t-basic-tables">Session
                                        Report</a>
                                </li>
                                <li>
                                    <a href="{{ route('user_sessions') }}" data-key="t-basic-tables">Completed Sessions
                                        Report</a>
                                </li>
                                <li>
                                    <a href="{{ route('open_slots') }}" data-key="t-basic-tables">Open Slots</a>
                                </li>
                                <li>
                                    <a href="{{ route('subscribers') }}" data-key="t-basic-tables">Subscribers</a>
                                </li>
                                <li>
                                    <a href="{{ route('users') }}" data-key="t-basic-tables">Clients</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('join_request') }}">
                              <i class="fi fi-rs-add-document"></i>
                                <span data-key="t-dashboard">Join Request</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pending_to_accept') }}">
                               <i class="fi fi-rs-file-signature"></i>
                                <span data-key="t-dashboard">Verification Pending</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('experts.index') }}">
                                <i class="fi fi-rs-user-gear"></i>
                                <span data-key="t-dashboard">Experts</span>
                            </a>
                        </li>
                         <li>
                            <a href="javascript:%20void(0);" class="has-arrow">
                                <i class="fi fi-rs-list"></i>
                                <span data-key="t-tables">Master Data</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ route('category.index') }}">
                                        <i class="fas fa-certificate"></i>
                                        <span data-key="t-dashboard">Category</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('subcategory.index') }}">
                                        <i class="far fa-closed-captioning"></i>
                                        <span data-key="t-dashboard">Sub Category</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('endcategory.index') }}">
                                        <i class="fas fa-cookie"></i>
                                        <span data-key="t-dashboard">End Category</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('blog.index') }}">
                               <i class="fi fi-rs-book-alt"></i>
                                <span data-key="t-dashboard">Blogs</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('video.index') }}">
                               <i class="fi fi-rs-film"></i>
                                <span data-key="t-dashboard">Videos</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gallery.create') }}">
                               <i class="fi fi-rs-film"></i>
                                <span data-key="t-dashboard">Gallery</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                @yield('content')
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; edha.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design &amp; Develop by <a href="#!" class="text-decoration-underline">edha</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->




    <!-- JAVASCRIPT -->
    <script src="{{ url('public/js/jquery-jquery.min.js') }}"></script>

    <script src="{{ url('public/js/js-bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/js/metismenu-metisMenu.min.js') }}"></script>
    <script src="{{ url('public/js/simplebar-simplebar.min.js') }}"></script>
    <script src="{{ url('public/js/node-waves-waves.min.js') }}"></script>
    <script src="{{ url('public/js/feather-icons-feather.min.js') }}"></script>
    <!-- pace js -->
    
    <script src="{{ url('public/js/pace-js-pace.min.js') }}"></script>



    <!-- Plugins js-->
    <script src="{{ url('public/js/jquery.vectormap-jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ url('public/js/maps-jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- dashboard init -->
    <!--<script src="{{ url('public/js/pages-dashboard.init.js') }}"></script>-->

    <script src="{{ url('public/js/js-app.js') }}"></script>
    <script src="{{ url('public/assets/js/app.js') }}"></script>

</body>

</html>
