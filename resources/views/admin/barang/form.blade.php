@extends('layouts.admin')
@section('title', isset($barang) ? 'Edit Barang' : 'Tambah Barang')

@section('content')
<div style="max-width:640px;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
        <a href="{{ route('admin.barang.index') }}" style="color:var(--text-muted); text-decoration:none; font-size:13px;"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h2 style="font-size:20px; font-weight:800;">{{ isset($barang) ? 'Edit Barang' : 'Tambah Barang' }}</h2>
    </div>

    <div style="background:white; border-radius:12px; border:1px solid var(--border); padding:28px;">
        <form method="POST" action="{{ isset($barang) ? route('admin.barang.update', $barang->id_barang) : route('admin.barang.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($barang)) @method('PUT') @endif

            {{-- ID Barang --}}
            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase;">ID Barang</label>
                <input type="text" value="{{ isset($barang) ? str_pad($barang->id_barang,4,'0',STR_PAD_LEFT) : str_pad($nextId,4,'0',STR_PAD_LEFT) }}" readonly
                    style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; background:#F8FAFC; color:var(--text-muted); cursor:not-allowed;">
                <div style="font-size:11px; color:var(--text-muted); margin-top:4px;">ID otomatis, tidak dapat diubah.</div>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase;">Nama Barang</label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" maxlength="25" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; outline:none;" onfocus="this.style.borderColor='var(--brand)'" onblur="this.style.borderColor='var(--border)'">
                @error('nama_barang') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:18px;">
                <div>
                    <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase;">Tanggal</label>
                    <input type="date" name="tgl" value="{{ old('tgl', isset($barang) ? $barang->tgl : '') }}" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; outline:none;" onfocus="this.style.borderColor='var(--brand)'" onblur="this.style.borderColor='var(--border)'">
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase;">Harga Awal (Rp)</label>
                    <input type="number" name="harga_awal" value="{{ old('harga_awal', $barang->harga_awal ?? '') }}" min="0" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; outline:none;" onfocus="this.style.borderColor='var(--brand)'" onblur="this.style.borderColor='var(--border)'">
                </div>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase;">Deskripsi</label>
                <textarea name="deskripsi_barang" maxlength="100" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; resize:vertical; min-height:80px; outline:none;" onfocus="this.style.borderColor='var(--brand)'" onblur="this.style.borderColor='var(--border)'">{{ old('deskripsi_barang', $barang->deskripsi_barang ?? '') }}</textarea>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:18px;">
                <div>
                    <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase;">Kategori</label>
                    <select name="id_kategori" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; outline:none;" onfocus="this.style.borderColor='var(--brand)'" onblur="this.style.borderColor='var(--border)'">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}" {{ old('id_kategori', $barang->id_kategori ?? '') == $k->id_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase;">Petugas</label>
                    <select name="id_petugas" style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; outline:none;" onfocus="this.style.borderColor='var(--brand)'" onblur="this.style.borderColor='var(--border)'">
                        <option value="">-- Pilih Petugas --</option>
                        @foreach($petugasList as $pt)
                        <option value="{{ $pt->id_petugas }}" {{ old('id_petugas', $barang->id_petugas ?? '') == $pt->id_petugas ? 'selected' : '' }}>{{ $pt->nama_petugas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase;">Kondisi</label>
                <div style="display:flex; gap:20px; padding-top:6px;">
                    <label style="display:flex; align-items:center; gap:8px; font-size:14px; cursor:pointer;">
                        <input type="radio" name="kondisi" value="baru" {{ old('kondisi', $barang->kondisi ?? '') === 'baru' ? 'checked' : '' }}> Baru
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; font-size:14px; cursor:pointer;">
                        <input type="radio" name="kondisi" value="bekas" {{ old('kondisi', $barang->kondisi ?? 'bekas') === 'bekas' ? 'checked' : '' }}> Bekas
                    </label>
                </div>
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase;">Foto Barang</label>
                @if(isset($barang) && $barang->foto_barang)
                <img src="{{ $barang->foto_url }}" id="preview" style="width:120px; height:90px; object-fit:cover; border-radius:8px; border:1px solid var(--border); margin-bottom:8px; display:block;">
                @else
                <img id="preview" style="display:none; width:120px; height:90px; object-fit:cover; border-radius:8px; border:1px solid var(--border); margin-bottom:8px;">
                @endif
                <input type="file" name="foto_barang" accept="image/jpg,image/jpeg,image/png,image/webp"
                    onchange="document.getElementById('preview').src=URL.createObjectURL(this.files[0]); document.getElementById('preview').style.display='block';"
                    style="font-size:13px;">
                <div style="font-size:11px; color:var(--text-muted); margin-top:4px;">JPG, PNG, WebP. Maks 2MB.</div>
                @error('foto_barang') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
            </div>

            <button type="submit" style="padding:12px 28px; background:var(--brand); color:white; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">
                {{ isset($barang) ? 'Simpan Perubahan' : 'Tambah Barang' }}
            </button>
        </form>
    </div>
</div>
@endsection