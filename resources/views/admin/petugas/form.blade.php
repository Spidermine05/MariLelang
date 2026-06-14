@extends('layouts.admin')
@section('title', isset($petugas) ? 'Edit Petugas' : 'Tambah Petugas')

@section('content')
<div style="max-width:480px;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
        <a href="{{ route('admin.petugas.index') }}" style="color:var(--text-muted); text-decoration:none; font-size:13px;"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h2 style="font-size:20px; font-weight:800;">{{ isset($petugas) ? 'Edit Petugas' : 'Tambah Petugas' }}</h2>
    </div>

    <div style="background:white; border-radius:12px; border:1px solid var(--border); padding:28px;">
        <form id="formPetugas" method="POST" action="{{ isset($petugas) ? route('admin.petugas.update', $petugas->id_petugas) : route('admin.petugas.store') }}">
            @csrf
            @if(isset($petugas)) @method('PUT') @endif

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Nama Petugas</label>
                <input type="text" name="nama_petugas" value="{{ old('nama_petugas', $petugas->nama_petugas ?? '') }}" maxlength="25" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; outline:none;" onfocus="this.style.borderColor='var(--brand)'" onblur="this.style.borderColor='var(--border)'">
                @error('nama_petugas') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Username</label>
                <input type="text" name="username" value="{{ old('username', $petugas->username ?? '') }}" maxlength="25" required style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; outline:none;" onfocus="this.style.borderColor='var(--brand)'" onblur="this.style.borderColor='var(--border)'">
                @error('username') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">
                    Password {{ isset($petugas) ? '(kosongkan jika tidak diubah)' : '' }}
                </label>
                <input type="password" name="password" style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; outline:none;" onfocus="this.style.borderColor='var(--brand)'" onblur="this.style.borderColor='var(--border)'" {{ isset($petugas) ? '' : 'required' }}>
                @error('password') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:12px; font-weight:700; color:var(--text-muted); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" style="width:100%; padding:10px 12px; border:1px solid var(--border); border-radius:8px; font-size:14px; font-family:inherit; outline:none;" onfocus="this.style.borderColor='var(--brand)'" onblur="this.style.borderColor='var(--border)'">
            </div>

            <input type="hidden" name="id_level" value="{{ $levels->first()?->id_level }}">

            @if(!isset($petugas))
            <button type="button" id="btnTriggerTambah" style="padding:12px 28px; background:var(--brand); color:white; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit; transition:background .2s;" onmouseover="this.style.background='var(--brand-dark)'" onmouseout="this.style.background='var(--brand)'">
                <i class="bi bi-person-plus-fill"></i> Tambah Petugas
            </button>
            @else
            <button type="button" id="btnTriggerEdit" style="padding:12px 28px; background:var(--brand); color:white; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit; transition:background .2s;" onmouseover="this.style.background='var(--brand-dark)'" onmouseout="this.style.background='var(--brand)'">
                <i class="bi bi-floppy-fill"></i> Simpan Perubahan
            </button>
            @endif
        </form>
    </div>
</div>

<style>
.ml-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(15,23,42,.5);
    z-index: 10000;
    align-items: center;
    justify-content: center;
}
.ml-modal-overlay.aktif { display: flex; }
.ml-modal-box {
    background: white;
    border-radius: 16px;
    padding: 32px 28px;
    width: calc(100% - 32px);
    max-width: 400px;
    box-shadow: 0 20px 60px rgba(0,0,0,.2);
    animation: mlModalIn .18s ease;
}
@keyframes mlModalIn {
    from { opacity:0; transform:translateY(-12px) scale(.97); }
    to   { opacity:1; transform:translateY(0) scale(1); }
}
.ml-modal-icon {
    width: 56px; height: 56px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
}
.ml-modal-btns { display: flex; gap: 10px; margin-top: 24px; }
.ml-btn-batal {
    flex: 1; padding: 11px; background: #F1F5F9; color: #64748B;
    border: none; border-radius: 8px; font-size: 14px; font-weight: 700;
    cursor: pointer; font-family: inherit;
}
.ml-btn-konfirm {
    flex: 1; padding: 11px; background: var(--brand); color: white;
    border: none; border-radius: 8px; font-size: 14px; font-weight: 700;
    cursor: pointer; font-family: inherit;
}
</style>

@if(!isset($petugas))
{{-- Modal Tambah --}}
<div class="ml-modal-overlay" id="modalTambah">
    <div class="ml-modal-box" id="modalTambahBox">
        <div class="ml-modal-icon" style="background:#EEF2FF;">
            <i class="bi bi-person-plus-fill" style="font-size:24px; color:var(--brand);"></i>
        </div>
        <h3 style="text-align:center; font-size:18px; font-weight:800; color:var(--text); margin-bottom:8px;">Tambah Petugas Baru?</h3>
        <p style="text-align:center; font-size:13px; color:#64748B; line-height:1.6;">
            Pastikan data yang diisi sudah benar.<br>Akun petugas akan langsung aktif setelah disimpan.
        </p>
        <div class="ml-modal-btns">
            <button type="button" class="ml-btn-batal" id="btnBatalTambah"><i class="bi bi-x-lg"></i> Batal</button>
            <button type="button" class="ml-btn-konfirm" id="btnKonfirmTambah"><i class="bi bi-check-lg"></i> Ya, Tambahkan</button>
        </div>
    </div>
</div>
<script>
(function() {
    var overlay = document.getElementById('modalTambah');
    var box     = document.getElementById('modalTambahBox');
    var form    = document.getElementById('formPetugas');

    document.getElementById('btnTriggerTambah').addEventListener('click', function(e) {
        e.stopPropagation();
        overlay.classList.add('aktif');
    });
    document.getElementById('btnBatalTambah').addEventListener('click', function(e) {
        e.stopPropagation();
        overlay.classList.remove('aktif');
    });
    document.getElementById('btnKonfirmTambah').addEventListener('click', function(e) {
        e.stopPropagation();
        form.submit();
    });
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) overlay.classList.remove('aktif');
    });
    box.addEventListener('click', function(e) { e.stopPropagation(); });
})();
</script>
@else
{{-- Modal Edit --}}
<div class="ml-modal-overlay" id="modalEdit">
    <div class="ml-modal-box" id="modalEditBox">
        <div class="ml-modal-icon" style="background:#EEF2FF;">
            <i class="bi bi-pencil-fill" style="font-size:24px; color:var(--brand);"></i>
        </div>
        <h3 style="text-align:center; font-size:18px; font-weight:800; color:var(--text); margin-bottom:8px;">Simpan Perubahan?</h3>
        <p style="text-align:center; font-size:13px; color:#64748B; line-height:1.6; margin-bottom:6px;">Anda akan mengubah data petugas:</p>
        <p style="text-align:center; font-size:14px; font-weight:800; color:var(--text);">{{ $petugas->nama_petugas }}</p>
        <div class="ml-modal-btns">
            <button type="button" class="ml-btn-batal" id="btnBatalEdit"><i class="bi bi-x-lg"></i> Batal</button>
            <button type="button" class="ml-btn-konfirm" id="btnKonfirmEdit"><i class="bi bi-check-lg"></i> Ya, Simpan</button>
        </div>
    </div>
</div>
<script>
(function() {
    var overlay = document.getElementById('modalEdit');
    var box     = document.getElementById('modalEditBox');
    var form    = document.getElementById('formPetugas');

    document.getElementById('btnTriggerEdit').addEventListener('click', function(e) {
        e.stopPropagation();
        overlay.classList.add('aktif');
    });
    document.getElementById('btnBatalEdit').addEventListener('click', function(e) {
        e.stopPropagation();
        overlay.classList.remove('aktif');
    });
    document.getElementById('btnKonfirmEdit').addEventListener('click', function(e) {
        e.stopPropagation();
        form.submit();
    });
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) overlay.classList.remove('aktif');
    });
    box.addEventListener('click', function(e) { e.stopPropagation(); });
})();
</script>
@endif

@endsection