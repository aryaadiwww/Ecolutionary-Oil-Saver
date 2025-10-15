@extends('admin.template.index')
@section('content')
    <div class="container">
        <h3 id="mainTitle" style="font-size: 24px; padding: 10px 0 5px">
            Minyak Telah Terkumpul
            <span style="font-weight: 300">
                ({{ $data['totalCollected'] }}ml/{{ $data['totalLimit'] }}ml - {{ $data['overallPercentage'] }})
            </span>
        </h3>
        <div class="data">
            <div class="value">
                <h3>Total</h3>
                <div class="percentage">
                    <h4 id="totalValue" style="font-weight: 600">{{ $data['totalValue'] }}ml</h4>
                    <p id="totalPercentage">{{ $data['totalPercentage'] }}</p>
                </div>
                <canvas id="totalChart" height="0"></canvas>
            </div>

            <div class="value">
                <h3>Harian</h3>
                <div class="percentage">
                    <h4 id="harianValue" style="font-weight: 600">{{ $data['harianValue'] }}ml</h4>
                    <p id="harianPercentage">{{ $data['harianPercentage'] }}</p>
                </div>
                <canvas id="harianChart" height="0"></canvas>
            </div>

            <div class="value">
                <h3>Bulanan</h3>
                <div class="percentage">
                    <h4 id="bulananValue" style="font-weight: 600">{{ $data['bulananValue'] }}ml</h4>
                    <p id="bulananPercentage">{{ $data['bulananPercentage'] }}</p>
                </div>
                <canvas id="bulananChart" height="0"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const totalValue = {{ $data['totalValue'] }};
            const harianValue = {{ $data['harianValue'] }};
            const bulananValue = {{ $data['bulananValue'] }};
            const totalLimit = {{ $data['totalLimit'] }};

            const createChart = (ctx, borderColor, value) => {
                return new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [0, value / totalLimit], // Labels untuk titik awal dan akhir
                        datasets: [{
                            data: [1,
                            1], // Koordinat y kedua titik diatur 1 agar tetap horizontal
                            borderColor: borderColor,
                            borderWidth: 30, // Ketebalan garis ditingkatkan
                            fill: false,
                            pointRadius: 0 // Untuk menghilangkan titik pada ujung garis
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                display: false, // Sembunyikan sumbu x
                                type: 'linear',
                                min: 0,
                                max: 1 // Batas maksimal untuk nilai x
                            },
                            y: {
                                display: false, // Sembunyikan sumbu y
                                min: 0,
                                max: 1 // Batas maksimal untuk nilai y agar garis tetap horizontal
                            }
                        },
                        plugins: {
                            legend: {
                                display: false // Sembunyikan legenda
                            }
                        },
                        elements: {
                            line: {
                                tension: 0 // Tanpa kurva
                            }
                        }
                    }
                });
            };

            // Inisialisasi chart untuk setiap canvas dengan warna berbeda dan nilai persentase
            createChart(document.getElementById('totalChart').getContext('2d'), '#292D5F', totalValue);
            createChart(document.getElementById('harianChart').getContext('2d'), '#F9BA33', harianValue);
            createChart(document.getElementById('bulananChart').getContext('2d'), '#3BBB6E', bulananValue);
        });
    </script>
@endsection
