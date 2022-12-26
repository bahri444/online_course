<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? ""}}</title>
    <link rel="stylesheet" href="{{asset('assets')}}/css/pages/fontawesome.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/main/app.css">
    <link rel="shortcut icon" href="{{asset('assets')}}/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets')}}/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="{{asset('assets')}}/css/shared/iconly.css">
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            @foreach($lembaga as $lmbg)
                            <h3 class="user-dropdown-name">{{$lmbg->nama}}</h3>
                            @endforeach
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                @foreach($lembaga as $l)
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">

                                    <div class="avatar avatar-md2">
                                        <img src="/logo/{{$l->logo}}" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name">{{$l->nama}}</h6>
                                        <p class="user-dropdown-status text-sm text-muted">Member</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                    <li><a class="dropdown-item" href="#">My Account</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                </ul>
                                @endforeach
                            </div>
                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li class="menu-item">
                                <a href="/" class='menu-link'>
                                    <i class="fas fa-home"></i>
                                    <span>Home</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="blog" class='menu-link'>
                                    <i class="fas fa-blog"></i>
                                    <span>Blog</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="course" class='menu-link'>
                                    <i class="fas fa-users"></i>
                                    <span>Course</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="about" class='menu-link'>
                                    <i class="fas fa-info-circle"></i>
                                    <span>About</span>
                                </a>
                            </li>
                            <li class="menu-item  has-sub">
                                <a href="#" class='menu-link'>
                                    <i class="fas fa-file-invoice"></i>
                                    <span>Transaksi</span>
                                </a>
                                <div class="submenu ">
                                    <div class="submenu-group-wrapper">
                                        <ul class="submenu-group">
                                            <li class="submenu-item  ">
                                                <a href="register" class='submenu-link'>Register</a>
                                            </li>
                                            <li class="submenu-item  ">
                                                <a href="login" class='submenu-link'>Login</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="menu-item">
                                <a href="kontak" class='menu-link'>
                                    <i class="fas fa-address-book"></i>
                                    <span>Kontak</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </header>