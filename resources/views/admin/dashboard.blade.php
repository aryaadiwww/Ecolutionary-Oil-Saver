@extends('admin.template.index')

@section('content')
    <div class="content">
        <h1>Overview</h1>
        <div class="container1">
            <h1>Setor Harian</h1>
            <label for="setoran">15%<span> compared with last month</span></label>
            <div class="border-div"></div>
            <div class="bottom">
                <p>{{ $data['todayDepositors'] }} Orang</p>
                <!-- Menampilkan jumlah user yang setoran pada tanggal tertentu -->
                <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="container2">
            <div class="total">
                <i class="dna fa-solid fa-dna"></i>
                <h1>Total</h1>
                <label for="setoran">10%<span> compared with last month</span></label>
            </div>
            <div class="border-div"></div>
            <div class="bottom">
                <p>{{ $data['totalCollected'] }}ml / {{ $data['totalLimit'] }}ml</p>
                <a href="{{ route('report') }}"><i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="container3">
            <h1>Total Member</h1>
            <label for="setoran">2%<span> compared with last month</span></label>
            <div class="border-div"></div>
            <div class="bottom">
                <p>{{ $data['totalMembers'] }} Orang</p> <!-- Menampilkan total anggota -->
                <a href="{{ route('member') }}"><i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="container4">
            <h1>Pengeluaran</h1>
            <label for="setoran">8%<span> compared with last month</span></label>
            <div class="border-div"></div>
            <div class="bottom">
                <p>{{ $data['totalSpentPoints'] }} poin</p> <!-- Menampilkan pengeluaran poin -->
                <a href="{{ route('rewards') }}"><i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
@endsection
