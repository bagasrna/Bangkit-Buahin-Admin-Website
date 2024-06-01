<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="title" content="Klinik OPT Tebu" />
    <meta name="description" content="Klinik OPT Tebu adalah tools untuk opt" />
    <meta name="keywords" content="klinik opt client, tryoutkedinasan, stan, stis, ipdn, sttd" />
    <meta name="author" content="IT Klinik OPT Tebu" />
    <meta property="og:title" content="Klinik OPT Tebu" />
    <meta property="og:description" content="Klinik OPT Tebu adalah tools untuk opt" />
    <title>{{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="/assets/images/p3gi-logo-3.png" />
    <link href="/dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
        integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('style')
    <style>
        .dropdown-item.active {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light mt-2">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand" href="/hama">
                        <b class="logo-icon d-flex justify-content-center">
                            <img src="/assets/images/p3gi-logo-3.png" alt="homepage" class="dark-logo w-75" />
                        </b>
                    </a>
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <hr class="dropdown-divider my-1" style="border-color: rgba(0, 0, 0, 0.1);">
                        </li>
                        <li class="sidebar-item {{ request()->is('hama*') ? 'selected' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link mt-2"
                                href="{{ route('hama.index') }}" aria-expanded="false" id="menu-user"><i
                                    class="mdi mdi-snowman"></i><span class="hide-menu">Hama</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-1" style="border-color: rgba(0, 0, 0, 0.1);">
                        </li>
                        <li class="sidebar-item {{ request()->is('penyakit*') ? 'selected' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link mt-2"
                                href="{{ route('penyakit.index') }}" aria-expanded="false" id="menu-user"><i
                                    class="mdi mdi-cube-unfolded"></i><span class="hide-menu">Penyakit</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-1" style="border-color: rgba(0, 0, 0, 0.1);">
                        </li>
                        <li class="sidebar-item {{ request()->is('gulma*') ? 'selected' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link mt-2"
                                href="{{ route('gulma.index') }}" aria-expanded="false" id="menu-user"><i
                                    class="mdi mdi-hops"></i><span class="hide-menu">Gulma</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-1" style="border-color: rgba(0, 0, 0, 0.1);">
                        </li>
                        <li class="sidebar-item {{ request()->is('ads*') ? 'selected' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link mt-2"
                                href="{{ route('ads.index') }}" aria-expanded="false" id="menu-user"><i
                                    class="mdi mdi-newspaper"></i><span class="hide-menu">Iklan & Promosi</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-1" style="border-color: rgba(0, 0, 0, 0.1);">
                        </li>
                        <li class="text-center p-40 upgrade-btn">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn d-block w-100 btn-danger text-white" type="submit">
                                    Keluar
                                </button>
                            </form>
                        </li>
                    </ul>

                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/dist/js/app-style-switcher.js"></script>
    <script src="/dist/js/waves.js"></script>
    <script src="/dist/js/sidebarmenu.js"></script>
    <script src="/dist/js/custom.js"></script>
    @yield('script')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if ($message = Session::get('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ $message }}'
            })
        @endif
        @if ($errors = Session::get('error'))
            @if (is_array($errors) || is_object($errors))
                @foreach ($errors as $fieldErrors)
                    @foreach ($fieldErrors as $error)
                        Toast.fire({
                            icon: 'error',
                            title: '{{ $error }}'
                        });
                    @endforeach
                @endforeach
            @else
                Toast.fire({
                    icon: 'error',
                    title: '{{ $errors }}'
                });
            @endif
        @endif
        @if ($message = Session::get('warning'))
            Toast.fire({
                icon: 'warning',
                title: '{{ $message }}'
            })
        @endif
        @if ($message = Session::get('info'))
            Toast.fire({
                icon: 'info',
                title: '{{ $message }}'
            })
        @endif
        @if ($message = Session::get('message'))
            Toast.fire({
                icon: 'info',
                title: '{{ $message }}'
            })
        @endif
        @if ($message = Session::get('information'))
            Swal.fire({
                text: '{{ $message }}',
                icon: 'info',
            })
        @endif
    </script>
</body>

</html>
