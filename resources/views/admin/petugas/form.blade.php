@extends('layouts.admin')
@section('title', isset($petugas) ? 'Edit Petugas' : 'Tambah Petugas')

@section('content')
<div style="max-width:480px;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
        <a href="{{ route('admin.petugas.index') }}" style="color:var(--text-muted); text-decoration:none; font-size:13px;"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h2 style="font-size:20px; font-weight:800;">{{ isset($petugas) ? 'Edit Petugas' : 'Tambah Petugas' }}</h2>
    </div>

    <div style="background:white; border-radius:12px; border:1px solid var(--border); padding:28px;">
        <form method="POST" action="{{ isset($petugas) ? route('admin.petugas.update', $petugas->id_petugas) : route('admin.petugas.store') }}">
            @csrf
            @if(isset($petugas)) @method('PUT') @endif

            @foreach([['nama_petugas','Nama Petugas','text'],['username','Username','text']] as [$name,$label,$type])
            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">{{ $label }}</label>
                <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, isset($petugas) ? $petugas->$name : '') }}" maxlength="25" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit;">
                @error($name) <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
            </div>
            @endforeach

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Password {{ isset($petugas) ? '(kosongkan jika tidak diubah)' : '' }}</label>
                <input type="password" name="password" style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit;" {{ isset($petugas) ? '' : 'required' }}>
                @error('password') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit;">
            </div>

            <input type="hidden" name="id_level" value="{{ $levels->first()?->id_level }}">

            <button type="submit" style="padding:12px 28px; background:var(--brand); color:white; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">
                {{ isset($petugas) ? 'Simpan Perubahan' : 'Tambah Petugas' }}
            </button>
        </form>
    </div>
</div>
@endsection
