@extends('layouts.petugas')
@section('title', 'Buat Lelang')

@section('content')
<div style="max-width:560px;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
        <a href="{{ route('petugas.lelang.index') }}" style="color:var(--text-muted); text-decoration:none; font-size:13px;"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h2 style="font-size:20px; font-weight:800;">Buat Lelang Baru</h2>
    </div>

    <div style="background:white; border-radius:12px; border:1px solid var(--border); padding:28px;">
        <form method="POST" action="{{ route('petugas.lelang.store') }}">
            @csrf

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Pilih Barang (Status: Tersedia)</label>
                <select name="id_barang" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit;">
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barang as $b)
                    <option value="{{ $b->id_barang }}" {{ old('id_barang') == $b->id_barang ? 'selected' : '' }}>
                        {{ $b->nama_barang }} — Rp {{ number_format($b->harga_awal, 0, ',', '.') }}
                    </option>
                    @endforeach
                </select>
                @error('id_barang') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:18px;">
                <div>
                    <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Waktu Mulai</label>
                    <input type="datetime-local" name="waktu_mulai" value="{{ old('waktu_mulai') }}" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit;">
                    @error('waktu_mulai') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Waktu Selesai</label>
                    <input type="datetime-local" name="waktu_selesai" value="{{ old('waktu_selesai') }}" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit;">
                    @error('waktu_selesai') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Minimal Kenaikan Bid (Rp)</label>
                <input type="number" name="harga_minimal_bid" value="{{ old('harga_minimal_bid', 0) }}" min="0" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit;">
                @error('harga_minimal_bid') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
            </div>

            <button type="submit" style="padding:12px 28px; background:var(--brand); color:white; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">Buat Lelang</button>
        </form>
    </div>
</div>
@endsection
