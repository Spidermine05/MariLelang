@extends('layouts.admin')
@section('title', isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori')
@section('content')
<div style="max-width:480px;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
        <a href="{{ route('admin.kategori.index') }}" style="color:var(--text-muted); text-decoration:none; font-size:13px;"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h2 style="font-size:20px; font-weight:800;">{{ isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori' }}</h2>
    </div>
    <div style="background:white; border-radius:12px; border:1px solid var(--border); padding:28px;">
        <form method="POST" action="{{ isset($kategori) ? route('admin.kategori.update', $kategori->id_kategori) : route('admin.kategori.store') }}">
            @csrf @if(isset($kategori)) @method('PUT') @endif
            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase;">Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}" maxlength="50" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit;">
                @error('nama_kategori') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
            </div>
            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase;">Deskripsi (opsional)</label>
                <textarea name="deskripsi_kategori" maxlength="255" style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; resize:vertical; min-height:80px;">{{ old('deskripsi_kategori', $kategori->deskripsi_kategori ?? '') }}</textarea>
            </div>
            <button type="submit" style="padding:12px 28px; background:var(--brand); color:white; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">
                {{ isset($kategori) ? 'Simpan Perubahan' : 'Tambah Kategori' }}
            </button>
        </form>
    </div>
</div>
@endsection
