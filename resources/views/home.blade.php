@extends('layouts.app')

@section('content')

<div class="banner">
    <div class="arrow left">‹</div>
    <div class="arrow right">›</div>
</div>

<div class="container">
    <h1>Jadwal Lelang</h1>

    <div class="jadwal">

        <div class="card">
            <h3>Berakhir</h3>

            <img src="https://cdn-icons-png.flaticon.com/512/809/809957.png" alt="kursi">

            <h2>Kursi Gaming</h2>

            <p>Harga Awal</p>
            <p class="harga">Rp. 350.000</p>

            <p>Tawaran Tertinggi</p>
            <p class="harga">Rp. 800.000</p>
        </div>

        <div class="card">
            <h3>Berlangsung</h3>

            <img src="https://cdn-icons-png.flaticon.com/512/3163/3163478.png" alt="meja">

            <h2>Meja Bundar</h2>

            <p>Harga Awal</p>
            <p class="harga">Rp. 100.000</p>

            <p>Tawaran Tertinggi</p>
            <p class="harga">Rp. 150.000</p>
        </div>

        <div class="card">
            <h3>Belum Dimulai</h3>

            <img src="https://cdn-icons-png.flaticon.com/512/3082/3082037.png" alt="meja">

            <h2>Meja Minimalis</h2>

            <p>Harga Awal</p>
            <p class="harga">Rp. 150.000</p>

            <p>Tawaran Tertinggi</p>
            <p>-</p>
        </div>

    </div>

    <div class="tentang">
        <h2>Tentang Kami</h2>
        <br>
        <p>
            Kami menyediakan sebuah website lelang yang bisa diikuti oleh masyarakat secara online
        </p>
    </div>

</div>

@endsection