<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <title>Monitoring Sensor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    {{-- Header --}}
    <div class="container text-center mt-2">
        <img src="{{ asset('img/logo.webp') }}" style="width: 250px">
        <h1 class="mt-2">Monitoring Ecolutionary Oil Saver Realtime</h1>
        <p>-- Kelompok 5 --</p>
    </div>

    {{-- Main --}}
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <h2>Kode Member</h2>
                    </div>
                    <div class="card-body">
                        <div class=" fs-1 fw-bold">
                            <span id="kodemember">0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <h2>Weight</h2>
                    </div>
                    <div class="card-body">
                        <div class=" fs-1 fw-bold">
                            <span id="suhu">0</span><span class=" fs-5 align-bottom"> g</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h2>Color</h2>
                    </div>
                    <div class="card-body">
                        <div class=" fs-1 fw-bold">
                            <span id="warna">A</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-success text-light">
                        <h2>TDS Value</h2>
                    </div>
                    <div class="card-body">
                        <div class=" fs-1 fw-bold">
                            <span id="tds">0</span><span class=" fs-5 align-bottom"> PPM</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-light">
                        <h2>Kelembaban</h2>
                    </div>
                    <div class="card-body">
                        <div class=" fs-1 fw-bold">
                            <span id="kelembaban">0</span><span class=" fs-5 align-top"> %</span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setInterval(function() {
                $("#kodemember").load("{{ url('bacakode') }}");
                $("#suhu").load("{{ url('bacasuhu') }}");
                $("#warna").load("{{ url('bacawarna') }}");
                $("#tds").load("{{ url('bacatds') }}");
            }, 1000);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
