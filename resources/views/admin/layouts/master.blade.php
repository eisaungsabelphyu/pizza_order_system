<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">
    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/5a3ef4f42f.js" crossorigin="anonymous"></script>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('admin/images/icon/logo.png') }}"/>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="{{Request::is('category/list') ? 'active' : ''}}">
                            <a href="{{route('category#list')}}" class="text-decoration-none">
                                <i class="fa-solid fa-list"></i> Category</a>
                        </li>
                        <li class="{{Request::is('product/list') ? 'active' : ''}}">
                            <a href="{{route('product#list')}}" class="text-decoration-none">
                                <i class="fa-solid fa-pizza-slice"></i> Product</a>
                        </li>
                        <li class="{{Request::is('order/list') ? 'active' : ''}}">
                            <a href="{{route('admin#orderList')}}" class="text-decoration-none">
                                <i class="fa-solid fa-list-check"></i> Order List</a>
                        </li>
                        <li class="{{Request::is('user/list') ? 'active' : ''}}">
                            <a href="{{route('admin#userList')}}" class="text-decoration-none">
                                <i class="fa-solid fa-users"></i> User List</a>
                        </li>
                        <li class="{{Request::is('contact/list') ? 'active' : ''}}">
                            <a href="{{route('admin#contactList')}}" class="text-decoration-none">
                                <i class="fa-solid fa-envelope-circle-check"></i> Contact List</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <span class="form-header">
                                <h3>Admin Dashboard Panel!</h3>
                            </span>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->image == null)
                                                <img src="{{asset('image/default_user.jfif')}}">
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}"
                                                alt="John Doe" />
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn text-decoration-none" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        @if (Auth::user()->image == null)
                                                            <img src="{{asset('image/default_user.jfif')}}" class="img-thumbnail">
                                                        @else
                                                            <img src="{{ asset('storage/'.Auth::user()->image) }}"
                                                            alt="" />
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#" class="text-decoration-none">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#details')}}" class="text-decoration-none">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#list')}}" class="text-decoration-none">
                                                        <i class="fa-solid fa-users"></i>Admin List</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('auth#changePasswordPage')}}" class="text-decoration-none">
                                                        <i class="zmdi zmdi-account"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form action="{{ route('logout') }}" method="post"
                                                    class="d-flex justify-content-center">
                                                    @csrf
                                                    <button class="btn bg-dark text-white col-10" type="submit">
                                                        <i class="zmdi zmdi-power"></i> Logout
                                                    </button>
                                                </form>
                                           </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            @yield('content') 
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <!-- Jquery JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script> --}}
    <!-- Bootstrap JS-->
    <!-- JavaScript Bundle with Popper -->

    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

</body>
@yield('scriptSection')

</html>
<!-- end document-->
