<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$title ?? ""}}</title>
    <link rel="stylesheet" href="{{asset('assets')}}/css/main/app.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/pages/auth.css" />
    <link rel="shortcut icon" href="{{asset('assets')}}/images/logo/favicon.svg" type="image/x-icon" />
    <link rel="shortcut icon" href="{{asset('assets')}}/images/logo/favicon.png" type="image/png" />
</head>

<body>
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="course">Courses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="blog">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="login">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="register">Register</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="kontak">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>