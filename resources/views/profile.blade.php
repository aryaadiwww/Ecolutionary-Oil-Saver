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
    <title>Profile Member</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
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
    <!-- HEADER -->
    <header class="block" style="background:#cccccc">
        <ul class="header-menu horizontal-list">
            <li>
                <a class="header-menu-tab" href="/"><i data-feather="arrow-left-circle"></i></a>
            </li>
        </ul>
        <div class="profile-menu">
            <div class="dropdown">
                <a id="dropdown-toggle">{{ auth()->user()->name }}<i class="icon-chevron-down"
                        data-feather="chevron-down"></i><i class="icon-chevron-left"
                        data-feather="chevron-left"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('update') }}" style="margin-bottom: 10px"><i class="icon"
                                data-feather="settings"></i>Settings</a></li>
                    <li><a href="{{ route('logout') }}"><i class="icon" data-feather="log-out"></i>Log Out</a></li>
                </ul>
            </div>
            <div class="profile-picture small-profile-picture">
                <img width="40px" alt="User Pict" src="{{ asset('storage/user/' . Auth::user()->foto) }}">
            </div>
        </div>
    </header>
    <div class="main-container">

        <!-- LEFT-CONTAINER -->
        <div class="left-container container">
            <div class="profile block">
                <!-- PROFILE (MIDDLE-CONTAINER) -->
                <a class="add-button" href="#28"><span class="icon"></span></a>
                <div class="profile-picture big-profile-picture clear">
                    <img width="150px" alt="User Pict" src="{{ asset('storage/user/' . Auth::user()->foto) }}">
                </div>
                <h1 class="user-name">{{ auth()->user()->name }}</h1>
                <div class="profile-description">
                    <p class="scnd-font-color">Kode Member: <span>{{ auth()->user()->id }}</span></p>
                </div>
            </div>
            <ul class="social block">
                <li>
                    <a href="https://www.instagram.com/share?url=[URL]&title=[TITLE]">
                        <div class="instagram icon"><i data-feather="instagram"></i></div>
                        <h2 class="instagram titular">SHARE TO INSTAGRAM</h2>
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=[URL]&t=[TITLE]">
                        <div class="facebook icon"><i data-feather="facebook"></i></div>
                        <h2 class="facebook titular">SHARE TO FACEBOOK</h2>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/intent/tweet?url=[URL]&text=[TEXT]">
                        <div class="twitter icon"><i data-feather="twitter"></i></div>
                        <h2 class="twitter titular">SHARE TO TWITTER</h2>
                    </a>
                </li>
            </ul>
        </div>

        <!-- MIDDLE-CONTAINER -->
        <div class="middle-container container">
            <div class="calendar-day block">
                <!-- CALENDAR DAY (LEFT-CONTAINER) -->
                <div class="arrow-btn-container">
                    <h2 class="titular">TOTAL POIN</h2>
                </div>
                <p class="the-day">{{ auth()->user()->points }}</p>
            </div>
            <div class="donut-chart-block block">
                <!-- DONUT CHART BLOCK (LEFT-CONTAINER) -->
                <h2 class="titular">TOTAL MINYAK</h2>
                <div class="donut-chart">
                    <canvas id="myDonutChart"></canvas>
                    <p class="center-date">
                        <span class="scnd-font-color">{{ auth()->user()->ml }}</span>
                        <br><span id="capacityRatio"></span>
                    </p>
                </div>
            </div>
        </div>

        <!-- RIGHT-CONTAINER -->
        @if (session('success'))
            {{-- <div class="alert alert-success">
                {{ session('success') }}
            </div> --}}
            <script>
                window.onload = function() {
                    const error = ("{{ session('success') }}");
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: error
                    });
                }
            </script>
        @endif

        @if (session('error'))
            {{-- <div class="alert alert-danger">
                {{ session('error') }}
            </div> --}}
            <script>
                window.onload = function() {
                    const error = ("{{ session('error') }}");
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "error",
                        title: error
                    });
                }
            </script>
        @endif
        <div class="right-container container">
            <div class="menu-box block">
                <h2 class="titular">TUKAR POINMU!</h2>
                <ul class="menu-box-menu">
                    @foreach ($rewards as $reward)
                        <li>
                            <a class="menu-box-tab" href="#" data-id="{{ $reward->id }}"
                                data-points="{{ $reward->points }}">
                                <span class="icon fontawesome-envelope"></span>{{ $reward->name }}
                                <div class="menu-box-number" style="color: #fff">{{ $reward->points }} poin</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <form id="rewardForm" method="POST" action="{{ route('reward.requests') }}" style="display:none;">
                @csrf
                <input type="hidden" id="reward_id" name="reward_id">
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </form>

            <!-- Pop-up -->
            <div id="popup" style="display: none;">
                <div class="popup-content">
                    <img src="{{ asset('assets/question.svg') }}" alt="icon">
                    <p>Apakah Anda yakin ingin menukar <span id="reward-name"></span> dengan <span
                            id="reward-points"></span> poin?</p>
                    <button id="confirm-redeem">Tukar</button>
                    <button id="cancel-redeem">Batal</button>
                </div>
            </div>
            <div class="line-chart-block block clear">
                <!-- LINE CHART BLOCK (RIGHT-CONTAINER) -->
                <h2 class="titular">HISTORY</h2>
                <ul class="time-lenght horizontal-list">
                    <li><a class="time-lenght-btn" href="#14">Week</a></li>
                    <li><a class="time-lenght-btn" href="#15">Month</a></li>
                    <li><a class="time-lenght-btn" href="#16">Year</a></li>
                </ul>
                <ul class="month-data clear">
                    <li>
                        <p>JUN<span class="scnd-font-color"> 2024</span></p>
                        <p><span class="entypo-plus increment"> </span>... <sup>L</sup></p>
                    </li>
                    <li>
                        <p>JUL<span class="scnd-font-color"> 2024</span></p>
                        <p><span class="entypo-plus increment"> </span>... <sup>L</sup></p>
                    </li>
                    <li>
                        <p>AUG<span class="scnd-font-color"> 2024</span></p>
                        <p><span class="entypo-plus increment"> </span>... <sup>L</sup></p>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end right-container -->
    </div>
    <!-- end main-container -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Periksa apakah pengguna terotentikasi dan properti 'ml' tersedia
            @if (auth()->check() && auth()->user()->ml !== null)
                const usedOil = {{ auth()->user()->ml }};
                const totalCapacity = 15000;
                const remainingCapacity = totalCapacity - usedOil;

                const ctx = document.getElementById('myDonutChart').getContext('2d');
                const myDonutChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Used Oil', 'Remaining Capacity'],
                        datasets: [{
                            data: [usedOil, remainingCapacity],
                            backgroundColor: ['#F33939', '#e0e0e0'],
                            hoverBackgroundColor: ['#C02B2B', '#e0e0e0']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutoutPercentage: 70,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        }
                    }
                });

                // Update the text in the center of the donut chart
                const centerText = document.querySelector('.center-date span.scnd-font-color');
                centerText.textContent = `${usedOil} mL`;

                // Update the capacity ratio text
                const capacityRatioText = document.getElementById('capacityRatio');
                capacityRatioText.textContent = `/ ${totalCapacity} mL`;
            @else
                console.error("User is not authenticated or 'ml' property is not available.");
            @endif
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rewardForm = document.getElementById('rewardForm');
            const rewardIdInput = document.getElementById('reward_id');

            document.querySelectorAll('.menu-box-tab').forEach(function(tab) {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const rewardId = this.getAttribute('data-id');
                    rewardIdInput.value = rewardId;
                    rewardForm.submit();
                });
            });
        });
    </script>
    <script>
        const dm = document.querySelector(".dropdown-menu");
        const dt = document.querySelector("#dropdown-toggle");

        document.addEventListener("click", function(e) {
            if (!dm.contains(e.target) && !dt.contains(e.target)) {
                dm.classList.remove("show");
            }
        });

        const dropdownMenu = document.querySelector(".dropdown-menu");
        const iconDown = document.querySelector(".icon-chevron-down");
        const iconLeft = document.querySelector(".icon-chevron-left");

        document.querySelector("#dropdown-toggle").onclick = () => {
            dropdownMenu.classList.toggle("show");
            iconDown.style.display = "block";
            iconLeft.style.display = "none";
        };

        document.addEventListener("DOMContentLoaded", function() {
            const dropdownToggle = document.querySelector('#dropdown-toggle');
            const chevronDown = document.querySelector('.icon-chevron-down');
            const chevronLeft = document.querySelector('.icon-chevron-left');

            dropdownToggle.addEventListener('click', function() {
                chevronDown.style.display = "block";
                chevronLeft.style.display = "none";
            });

            document.addEventListener('click', function(event) {
                if (!dropdownToggle.contains(event.target)) {
                    chevronDown.style.display = "none";
                    chevronLeft.style.display = "block";
                }
            });
        });
    </script>
    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>

</body>

</html>
