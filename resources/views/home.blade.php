<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('icon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('icon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('icon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('icon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('icon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('icon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('icon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('icon/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('icon/favicon-196x196.png') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('icon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ asset('icon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('icon/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('icon/favicon-128.png') }}" sizes="128x128" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('icon/mstile-144x144.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ asset('icon/mstile-70x70.png') }}" />
    <meta name="msapplication-square150x150logo" content="{{ asset('icon/mstile-150x150.png') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ asset('icon/mstile-310x150.png') }}" />
    <meta name="msapplication-square310x310logo" content="{{ asset('icon/mstile-310x310.png') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @if (session('success'))
        <script>
            window.onload = function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
            };
        </script>
    @endif
    <header>
        <nav class="navbar navbar-expand-lg bg-transparent mt-2" id="navbar">
            <div class="container-fluid container-lg" id="round-onclick">
                <a class="logo d-lg-none d-block text-decoration-none" href="#">
                    <img src="img/logo.webp" alt="Logo" />
                </a>
                <button class="navbar-toggler menu border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list" id="menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#one">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#two">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#three">Benefit</a>
                        </li>
                    </ul>
                    <a class="logo d-lg-block text-decoration-none d-none" href="#">
                        <img src="img/logo.webp" alt="Logo" />
                    </a>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#four" id="navz">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#five" id="navz">FAQ</a>
                        </li>
                        <li class="nav-item">
                            @auth
                                <a class="nav-link" href="{{ route('profile') }}" id="navz"><i
                                        class="fa-solid fa-user-large"></i></a>
                                <div class="dropdown">
                                    <div>
                                        <a href="{{ route('profile') }}" id="login">Profile</a>
                                        {{-- <a href="/sesi/signup" id="signup">Sign Up</a> --}}
                                    </div>
                                </div>
                            @else
                                <a class="nav-link" href="{{ route('login') }}" id="navz"><i
                                        class="fa-solid fa-user-large"></i></a>
                                <div class="dropdown">
                                    <div>
                                        <a href="{{ route('login') }}" id="login">Login</a>
                                        <a href="{{ route('register') }}" id="signup">Sign Up</a>
                                    </div>
                                </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <section id="one">
            <video autoplay muted loop id="video-bg">
                <source src="img/bv.webm" type="video/webm" />
            </video>
            <video autoplay muted loop id="video-mobile">
                <source src="img/bv.webm" type="video/webm" />
            </video>
            <div class="content">
                <p>
                    One Drop of Used Cooking Oil has The Power to Bring About Millions of
                    Changes.
                </p>
                <hr />
                <a class="discover-link">DISCOVER <span>MORE</span></a>
                <div class="arrow"><a href="#two"><i class="bi bi-chevron-down"></i></a></div>
            </div>
        </section>

        <section id="two">
            <h2 id="text">
                Starting With Us<br /><span>Create a Comfortable Environment</span>
            </h2>

            <img src="https://user-images.githubusercontent.com/65358991/170092504-132fa547-5ced-40e5-ab64-ded61518fac2.png"
                id="bird1" />
            <img src="https://user-images.githubusercontent.com/65358991/170092542-9747edcc-fb51-4e21-aaf5-a61119393618.png"
                id="bird2" />
        </section>

        <div class="sec">
            <p>
                {{ $desc }}
            </p>
        </div>

        <section id="three">
            <div class="benefit-cards">
                <!-- Benefit Card 1 -->
                <div class="benefit-card">
                    <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0" />
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M3.1315 10.229L2.00578 12.1775C1.61721 12.8518 1.61721 13.6804 2.00578 14.3547L5.22293 19.9318C4.83436 19.2575 4.83436 18.429 5.22293 17.7547L6.54864 15.4575L7.93721 13.0118L8.6515 13.4233C8.7715 13.4918 8.90864 13.3604 8.84007 13.2347L6.72579 9.55469L2.48007 9.56612C2.34293 9.56612 2.2915 9.74897 2.4115 9.81754L3.1315 10.229Z"
                                fill="url(#paint0_linear)" />
                            <path
                                d="M6.5544 15.4575L5.22868 17.7547C4.84011 18.4289 4.84011 19.2575 5.22868 19.9318C5.61726 20.6118 6.34297 21.0289 7.13154 21.0289H10.0515V15.4804L6.5544 15.4575Z"
                                fill="url(#paint1_linear)" />
                            <path
                                d="M6.72579 9.54883L2.48007 9.56026C2.34293 9.56026 2.2915 9.74311 2.4115 9.81169L3.12578 10.2231L2.00578 12.1774C1.61721 12.8517 1.61721 13.6803 2.00578 14.3545L3.6115 17.1317C3.22293 16.4574 3.22293 15.6288 3.6115 14.9545L4.7315 13.0117L6.72579 9.54883Z"
                                fill="url(#paint2_linear)" />
                            <path
                                d="M10.0457 18.2462H7.12568C6.4514 18.2462 5.82282 17.9376 5.4114 17.4233L5.22282 17.7548C4.83425 18.4291 4.83425 19.2576 5.22282 19.9319C5.61711 20.6119 6.34282 21.0291 7.1314 21.0291H10.0514V18.2462H10.0457Z"
                                fill="url(#paint3_linear)" />
                            <path
                                d="M18.24 5.66319L17.1143 3.71462C16.7257 3.04605 16.0057 2.62891 15.2286 2.62891H8.78857C9.56572 2.62891 10.2857 3.04605 10.6743 3.72034L12 6.01748L13.4229 8.44605L12.7086 8.85748C12.5886 8.92605 12.6343 9.10891 12.7771 9.10891L17.0229 9.12034L19.1371 5.44034C19.2057 5.32034 19.0686 5.18319 18.9486 5.25176L18.24 5.66319Z"
                                fill="url(#paint4_linear)" />
                            <path
                                d="M12.0002 6.01748L10.6745 3.72033C10.286 3.04605 9.56595 2.62891 8.78881 2.62891C8.00024 2.62891 7.27452 3.04605 6.88595 3.72605L5.4231 6.25748L10.2288 9.03462L12.0002 6.01748Z"
                                fill="url(#paint5_linear)" />
                            <path
                                d="M17.0287 9.12034L19.1429 5.44034C19.2115 5.32034 19.0744 5.18319 18.9544 5.25176L18.2401 5.66319L17.1144 3.71462C16.7258 3.04605 16.0058 2.62891 15.2287 2.62891H12.0229C12.8001 2.62891 13.5201 3.04605 13.9087 3.72034L15.0287 5.66319L17.0287 9.12034Z"
                                fill="url(#paint6_linear)" />
                            <path
                                d="M7.84024 7.65176L9.29738 5.12605C9.63452 4.54319 10.2117 4.15462 10.8688 4.05176L10.6802 3.72033C10.286 3.04605 9.56595 2.62891 8.78881 2.62891C8.00024 2.62891 7.27452 3.04605 6.88595 3.72605L5.4231 6.25748L7.84024 7.65176Z"
                                fill="url(#paint7_linear)" />
                            <path
                                d="M14.6344 21.0289H16.8801C17.6573 21.0289 18.3773 20.6118 18.7659 19.9375L21.983 14.3604C21.5944 15.0346 20.8744 15.4518 20.0973 15.4518H17.4459L14.6287 15.4689V14.6461C14.6287 14.5089 14.4459 14.4575 14.3773 14.5775L12.2458 18.2461L14.3773 21.9146C14.4459 22.0346 14.6287 21.9832 14.6287 21.8461L14.6344 21.0289Z"
                                fill="url(#paint8_linear)" />
                            <path
                                d="M17.4515 15.4573H20.103C20.8801 15.4573 21.6001 15.0401 21.9887 14.3658C22.383 13.6858 22.383 12.8458 21.9887 12.1658L20.5315 9.64014L15.7258 12.4173L17.4515 15.4573Z"
                                fill="url(#paint9_linear)" />
                            <path
                                d="M12.2515 18.2573L14.3829 21.9259C14.4515 22.0459 14.6343 21.9944 14.6343 21.8573V21.0287H16.88C17.6572 21.0287 18.3772 20.6116 18.7658 19.9373L20.3715 17.1602C19.9829 17.8344 19.2629 18.2516 18.4858 18.2516H16.24L12.2515 18.2573Z"
                                fill="url(#paint10_linear)" />
                            <path
                                d="M18.1201 11.0344L19.5773 13.5601C19.9144 14.143 19.9601 14.8401 19.7201 15.4573H20.103C20.8801 15.4573 21.6001 15.0401 21.9887 14.3658C22.383 13.6858 22.383 12.8458 21.9887 12.1658L20.5315 9.64014L18.1201 11.0344Z"
                                fill="url(#paint11_linear)" />
                            <path opacity="0.5"
                                d="M18.24 5.66319L17.1143 3.71462C16.7257 3.04605 16.0057 2.62891 15.2286 2.62891H8.78857C9.56572 2.62891 10.2857 3.04605 10.6743 3.72034L12 6.01748L13.4229 8.44605L12.7086 8.85748C12.5886 8.92605 12.6343 9.10891 12.7771 9.10891L17.0229 9.12034L19.1371 5.44034C19.2057 5.32034 19.0686 5.18319 18.9486 5.25176L18.24 5.66319Z"
                                fill="url(#paint12_radial)" />
                            <path opacity="0.5"
                                d="M12 6.01748L10.6743 3.72033C10.2857 3.04605 9.56574 2.62891 8.7886 2.62891C8.00003 2.62891 7.27431 3.04605 6.88574 3.72605C10.68 3.71462 10.2343 9.02891 10.2343 9.02891L12 6.01748Z"
                                fill="url(#paint13_linear)" />
                            <path opacity="0.5"
                                d="M6.5544 15.4575L5.22868 17.7547C4.84011 18.4289 4.84011 19.2575 5.22868 19.9318C5.61726 20.6118 6.34297 21.0289 7.13154 21.0289C5.22868 17.7489 10.0515 15.4804 10.0515 15.4804L6.5544 15.4575Z"
                                fill="url(#paint14_linear)" />
                            <path opacity="0.5"
                                d="M14.6344 21.0289H16.8801C17.6573 21.0289 18.3773 20.6118 18.7659 19.9375L21.983 14.3604C21.5944 15.0346 20.8744 15.4518 20.0973 15.4518H17.4459L14.6287 15.4689V14.6461C14.6287 14.5089 14.4459 14.4575 14.3773 14.5775L12.2458 18.2461L14.3773 21.9146C14.4459 22.0346 14.6287 21.9832 14.6287 21.8461L14.6344 21.0289Z"
                                fill="url(#paint15_linear)" />
                            <defs>
                                <linearGradient id="paint0_linear" x1="5.11724" y1="3.93755" x2="5.43515"
                                    y2="21.5133" gradientUnits="userSpaceOnUse">
                                    <stop offset="0.2544" stop-color="#90D856" />
                                    <stop offset="0.736" stop-color="#00CC00" />
                                </linearGradient>
                                <linearGradient id="paint1_linear" x1="26.3095" y1="18.2432" x2="5.92764"
                                    y2="18.2432" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#00CC00" />
                                    <stop offset="0.1878" stop-color="#06C102" />
                                    <stop offset="0.5185" stop-color="#17A306" />
                                    <stop offset="0.9507" stop-color="#33740C" />
                                    <stop offset="1" stop-color="#366E0D" />
                                </linearGradient>
                                <linearGradient id="paint2_linear" x1="4.33819" y1="9.40906" x2="3.61155"
                                    y2="21.6712" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#90D856" />
                                    <stop offset="1" stop-color="#00CC00" />
                                </linearGradient>
                                <linearGradient id="paint3_linear" x1="24.5381" y1="19.2266" x2="4.41321"
                                    y2="19.2266" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#00CC00" />
                                    <stop offset="0.1878" stop-color="#06C102" />
                                    <stop offset="0.5185" stop-color="#17A306" />
                                    <stop offset="0.9507" stop-color="#33740C" />
                                    <stop offset="1" stop-color="#366E0D" />
                                </linearGradient>
                                <linearGradient id="paint4_linear" x1="22.7021" y1="10.5328" x2="7.32255"
                                    y2="2.02027" gradientUnits="userSpaceOnUse">
                                    <stop offset="0.2544" stop-color="#90D856" />
                                    <stop offset="0.736" stop-color="#00CC00" />
                                </linearGradient>
                                <linearGradient id="paint5_linear" x1="-0.282483" y1="21.7324" x2="9.90844"
                                    y2="4.08175" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#00CC00" />
                                    <stop offset="0.1878" stop-color="#06C102" />
                                    <stop offset="0.5185" stop-color="#17A306" />
                                    <stop offset="0.9507" stop-color="#33740C" />
                                    <stop offset="1" stop-color="#366E0D" />
                                </linearGradient>
                                <linearGradient id="paint6_linear" x1="18.3533" y1="7.12236" x2="8.09756"
                                    y2="0.361988" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#90D856" />
                                    <stop offset="1" stop-color="#00CC00" />
                                </linearGradient>
                                <linearGradient id="paint7_linear" x1="-0.248335" y1="19.707" x2="9.81413"
                                    y2="2.27878" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#00CC00" />
                                    <stop offset="0.1878" stop-color="#06C102" />
                                    <stop offset="0.5185" stop-color="#17A306" />
                                    <stop offset="0.9507" stop-color="#33740C" />
                                    <stop offset="1" stop-color="#366E0D" />
                                </linearGradient>
                                <linearGradient id="paint8_linear" x1="8.18908" y1="22.4633" x2="23.2508"
                                    y2="13.4" gradientUnits="userSpaceOnUse">
                                    <stop offset="0.2544" stop-color="#90D856" />
                                    <stop offset="0.736" stop-color="#00CC00" />
                                </linearGradient>
                                <linearGradient id="paint9_linear" x1="10.7601" y1="-3.0374" x2="23.0223"
                                    y2="20.1699" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#00CC00" />
                                    <stop offset="0.1878" stop-color="#06C102" />
                                    <stop offset="0.5185" stop-color="#17A306" />
                                    <stop offset="0.9507" stop-color="#33740C" />
                                    <stop offset="1" stop-color="#366E0D" />
                                </linearGradient>
                                <linearGradient id="paint10_linear" x1="7.05079" y1="23.541" x2="18.0332"
                                    y2="18.0392" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#90D856" />
                                    <stop offset="1" stop-color="#00CC00" />
                                </linearGradient>
                                <linearGradient id="paint11_linear" x1="12.6718" y1="-1.91446" x2="25.8877"
                                    y2="23.4728" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#00CC00" />
                                    <stop offset="0.1878" stop-color="#06C102" />
                                    <stop offset="0.5185" stop-color="#17A306" />
                                    <stop offset="0.9507" stop-color="#33740C" />
                                    <stop offset="1" stop-color="#366E0D" />
                                </linearGradient>
                                <radialGradient id="paint12_radial" cx="0" cy="0" r="1"
                                    gradientUnits="userSpaceOnUse"
                                    gradientTransform="translate(14.8305 3.86323) rotate(160.731) scale(4.4555 2.28865)">
                                    <stop stop-color="#FBE07A" stop-opacity="0.75" />
                                    <stop offset="0.0803394" stop-color="#FBE387" stop-opacity="0.6897" />
                                    <stop offset="0.5173" stop-color="#FDF2C7" stop-opacity="0.362" />
                                    <stop offset="0.8357" stop-color="#FFFBF0" stop-opacity="0.1233" />
                                    <stop offset="1" stop-color="white" stop-opacity="0" />
                                </radialGradient>
                                <linearGradient id="paint13_linear" x1="10.5129" y1="1.05256" x2="8.77574"
                                    y2="7.25178" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#3C2200" />
                                    <stop offset="0.2217" stop-color="#3B2D02" stop-opacity="0.7783" />
                                    <stop offset="0.6109" stop-color="#394A07" stop-opacity="0.3891" />
                                    <stop offset="1" stop-color="#366E0D" stop-opacity="0" />
                                </linearGradient>
                                <linearGradient id="paint14_linear" x1="2.99336" y1="19.2335" x2="9.23045"
                                    y2="17.6383" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#3C2200" />
                                    <stop offset="0.2217" stop-color="#3B2D02" stop-opacity="0.7783" />
                                    <stop offset="0.6109" stop-color="#394A07" stop-opacity="0.3891" />
                                    <stop offset="1" stop-color="#366E0D" stop-opacity="0" />
                                </linearGradient>
                                <linearGradient id="paint15_linear" x1="22.0669" y1="23.9041" x2="16.7192"
                                    y2="15.9678" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#3C2200" />
                                    <stop offset="0.2217" stop-color="#3B2D02" stop-opacity="0.7783" />
                                    <stop offset="0.6109" stop-color="#394A07" stop-opacity="0.3891" />
                                    <stop offset="1" stop-color="#366E0D" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                        </g>
                    </svg>
                    <h3>Environmental-Friendly Program</h3>
                    <p>
                        This tool is specifically designed to collect used cooking oil from household waste. With this tool,
                        you can help reduce environmental pollution in an easy way.
                    </p>
                </div>

                <!-- Benefit Card 2 -->
                <div class="benefit-card">
                    <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="100px" height="100px" viewBox="0 0 512 512"
                        xml:space="preserve" fill="#000000" stroke="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0" />
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                        <g id="SVGRepo_iconCarrier">
                            <style type="text/css">
                                .st0 {
                                    fill: #00cc00;
                                }
                            </style>
                            <g>
                                <path class="st0"
                                    d="M225.557,316.597c20.281,0,83.625,0,83.625,0c16.797,0,30.406-13.609,30.406-30.406 s-13.609-30.406-30.406-30.406c-15.203,0-45.609,0-121.625,0c-76.031,0-100.094,31.672-126.703,58.281l-48.281,42.172 c-3.125,2.719-4.938,6.672-4.938,10.813v140.157c0,1.875,1.094,3.578,2.797,4.359c1.703,0.766,3.703,0.5,5.125-0.719l93.313-80 c3.297-2.797,7.672-3.984,11.922-3.219l145.406,26.438c10.141,1.844,20.594-0.484,29.016-6.438 c0,0,185.609-129.047,199.297-140.454l0,0c13.063-11.984,12.906-29.375,0.922-42.438c-12-13.094-34.375-10.313-49.297,0.734 c-13.672,11.406-107.078,72.797-107.078,72.797h-113.5l-0.359,0.156c-5.984-0.188-10.656-5.203-10.469-11.172 c0.219-5.984,5.219-10.672,11.188-10.469L225.557,316.597z" />
                                <path class="st0"
                                    d="M362.697,0.003c-27.656,0-51.813,14.781-65.172,36.844c42.719,15.672,73.344,56.641,73.344,104.719 c0,3.547-0.203,7.047-0.531,10.516c38.516-3.844,68.594-36.328,68.594-75.859C438.932,34.128,404.807,0.003,362.697,0.003z" />
                                <path class="st0"
                                    d="M261.979,121.222h-12.016v24.203h12.016c7.609,0,13.797-5.438,13.797-12.109 C275.775,126.66,269.588,121.222,261.979,121.222z" />
                                <path class="st0"
                                    d="M259.244,54.441c-48.109,0-87.125,39.016-87.125,87.125c0,48.125,39.016,87.125,87.125,87.125 s87.125-39,87.125-87.125C346.369,93.457,307.354,54.441,259.244,54.441z M261.979,158.863h-12.016v17.609 c0,3.391-2.75,6.125-6.125,6.125h-3.078c-3.391,0-6.125-2.734-6.125-6.125V113.91c0-3.375,2.734-6.125,6.125-6.125h21.219 c16.078,0,29.141,11.453,29.141,25.531C291.119,147.41,278.057,158.863,261.979,158.863z" />
                            </g>
                        </g>
                    </svg>
                    <h3>Redeem Your Points</h3>
                    <p>
                        EOS offers an enticing points and rewards system for users. Every time users use the tool to dispose
                        of used oil, they will earn points that can be redeemed for various attractive rewards.
                    </p>
                </div>

                <!-- Benefit Card 3 -->
                <div class="benefit-card">
                    <svg width="100px" height="100px" viewBox="0 0 50.8 50.8" xmlns="http://www.w3.org/2000/svg"
                        fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0" />
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                        <g id="SVGRepo_iconCarrier">
                            <g style="display: inline">
                                <path d="M7.854 33.546 16 22.893l7.52 16.293 6.267-27.572 3.76 8.773 5.64-6.893 3.76 8.146"
                                    style="
                    fill: none;
                    stroke: #00cc00;
                    stroke-width: 2.50658;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                    " />
                            </g>
                        </g>
                    </svg>
                    <h3>User-Friendly Operation and Monitoring</h3>
                    <p>
                        The EOS device is designed for user convenience. Equipped with an LCD screen and intuitive keypad
                        buttons, users can easily monitor and control the process of managing used oil.
                    </p>
                </div>
            </div>
        </section>

        <section id="four">
            <div class="container">
                <main class="sliders-container">
                    <ul class="pagination">
                        <li class="pagination__item"><a class="pagination__button"></a></li>
                        <li class="pagination__item"><a class="pagination__button"></a></li>
                        <li class="pagination__item"><a class="pagination__button"></a></li>
                        <li class="pagination__item"><a class="pagination__button"></a></li>
                    </ul>
                </main>
                <footer class="foot3"></footer>
            </div>
        </section>

        <section id="five">
            <div class="text">
                <h2>
                    Find Answers to<br />
                    Your Questions Here!
                </h2>
            </div>
            <div class="faq-container">
                <div>
                    <details>
                        <summary>
                            <span class="faq-title">What is Ecolutionary Oil Saver?</span>
                            <img src="assets/plus.svg" class="expand-icon" alt="Plus" />
                        </summary>
                        <div class="faq-content">
                            Ecolutionary Oil Saver is an innovative initiative aimed at promoting the recycling of used
                            cooking oil from households and industries, thereby reducing its negative impact on the
                            environment.
                        </div>
                    </details>
                    <details>
                        <summary>
                            <span class="faq-title">How can I participate in the Ecolutionary Oil Saver program?</span>
                            <img src="assets/plus.svg" class="expand-icon" alt="Plus" />
                        </summary>
                        <div class="faq-content">
                            You can participate by donating used cooking oil from your household to available collection
                            locations. You can also become a partner or volunteer in used oil collection activities.
                        </div>
                    </details>
                    <details>
                        <summary>
                            <span class="faq-title">Does Ecolutionary Oil Saver accept all types of used cooking
                                oil?</span>
                            <img src="assets/plus.svg" class="expand-icon" alt="Plus" />
                        </summary>
                        <div class="faq-content">
                            Yes, we accept various types of used cooking oil, including used frying oil, waste cooking oil,
                            and others. However, make sure not to mix the oil with other substances such as water or
                            detergent.
                        </div>
                    </details>
                </div>
                <div>
                    <details>
                        <summary>
                            <span class="faq-title">How do I store used cooking oil before donating it?</span>
                            <img src="assets/plus.svg" class="expand-icon" alt="Plus" />
                        </summary>
                        <div class="faq-content">
                            Store used cooking oil in a clean, dry container with a secure lid. Make sure the oil is cooled
                            and avoid mixing it with water, food particles, or other contaminants.
                        </div>
                    </details>
                    <details>
                        <summary>
                            <span class="faq-title">What are the benefits of recycling used cooking oil?</span>
                            <img src="assets/plus.svg" class="expand-icon" alt="Plus" />
                        </summary>
                        <div class="faq-content">
                            Recycling used cooking oil helps reduce environmental pollution, conserves natural resources,
                            and can be repurposed into biodiesel and other products, contributing to a sustainable future.
                        </div>
                    </details>
                    <details>
                        <summary>
                            <span class="faq-title">Can businesses partner with Ecolutionary Oil Saver?</span>
                            <img src="assets/plus.svg" class="expand-icon" alt="Plus" />
                        </summary>
                        <div class="faq-content">
                            Yes, businesses can partner with Ecolutionary Oil Saver by setting up collection points,
                            participating in awareness campaigns, and donating used cooking oil from their operations.
                        </div>
                    </details>
                </div>
            </div>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <script src="https://rawgit.com/lmgonzalves/momentum-slider/master/dist/momentum-slider.min.js"></script>
        <script src="js/script.js"></script>
    </body>

    </html>
