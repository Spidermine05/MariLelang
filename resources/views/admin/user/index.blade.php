@extends('layouts.admin')
@section('title', 'Kelola User')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2 style="font-size:20px; font-weight:800;">Kelola User (Masyarakat)</h2>
</div>

{{-- SEARCH --}}
<form method="GET" style="margin-bottom:16px; display:flex; gap:8px;">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau username..." style="padding:8px 12px; border:1px solid var(--border); border-radius:8px; font-size:13px; flex:1; font-family:inherit;">
    <button type="submit" style="padding:8px 16px; background:var(--brand); color:white; border:none; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit;">Cari</button>
    @if(request('search'))
    <a href="{{ route('admin.users.index') }}" style="padding:8px 14px; background:#F1F5F9; color:var(--text-muted); border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;">Reset</a>
    @endif
</form>

<div style="background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
        <thead>
            <tr style="background:var(--bg);">
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Nama</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Username</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Email</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Telepon</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Status</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr style="border-top:1px solid var(--border);">
                <td style="padding:12px 16px; font-weight:700;">{{ $user->nama_lengkap }}</td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $user->username }}</td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $user->email }}</td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $user->telp ?? '—' }}</td>
                <td style="padding:12px 16px;">
                    @if($user->status_akun === 'aktif')
                    <span style="background:#ECFDF5; color:#059669; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;"><i class="bi bi-check-circle-fill"></i> Aktif</span>
                    @else
                    <span style="background:#FEF2F2; color:#DC2626; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;"><i class="bi bi-x-circle-fill"></i> Nonaktif</span>
                    @endif
                </td>
                <td style="padding:12px 16px;">
                    <div style="display:flex; gap:6px; flex-wrap:wrap;">
                        <a href="{{ route('admin.users.show', $user->id_user) }}" style="padding:5px 10px; background:#EEF2FF; color:var(--brand); border-radius:6px; font-size:12px; font-weight:700; text-decoration:none;">Detail</a>
                        @if($user->status_akun === 'nonaktif')
                        <form method="POST" action="{{ route('admin.users.aktivasi', $user->id_user) }}">
                            @csrf @method('PATCH')
                            <button type="submit" style="padding:5px 10px; background:#ECFDF5; color:#059669; border:none; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit;">
                                <i class="bi bi-check-circle"></i> Aktifkan
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.users.nonaktif', $user->id_user) }}" id="formNonaktif-{{ $user->id_user }}">
                            @csrf @method('PATCH')
                            <button type="button"
                                class="btn-nonaktif-user"
                                data-id="{{ $user->id_user }}"
                                data-nama="{{ $user->nama_lengkap }}"
                                style="padding:5px 10px; background:#FEF2F2; color:#DC2626; border:none; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit;">
                                <i class="bi bi-slash-circle"></i> Nonaktifkan
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="padding:40px; text-align:center; color:var(--text-muted);">Belum ada pengguna terdaftar.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:16px;">{{ $users->withQueryString()->links() }}</div>

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
</style>

{{-- Modal Nonaktifkan User --}}
<div class="ml-modal-overlay" id="modalNonaktif">
    <div class="ml-modal-box" id="modalNonaktifBox">
        <div style="width:56px; height:56px; background:#FEF2F2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
            <i class="bi bi-slash-circle-fill" style="font-size:24px; color:#DC2626;"></i>
        </div>
        <h3 style="text-align:center; font-size:18px; font-weight:800; color:#0F172A; margin-bottom:8px;">Nonaktifkan Akun?</h3>
        <p style="text-align:center; font-size:13px; color:#64748B; line-height:1.6; margin-bottom:6px;">Anda akan menonaktifkan akun:</p>
        <p id="nonaktifNamaUser" style="text-align:center; font-size:14px; font-weight:800; color:#0F172A; margin-bottom:16px;"></p>
        <p style="text-align:center; font-size:12px; color:#DC2626; background:#FEF2F2; border-radius:8px; padding:8px 12px; margin-bottom:24px;">
            <i class="bi bi-exclamation-triangle-fill"></i> Pengguna tidak bisa login sampai diaktifkan kembali.
        </p>
        <div style="display:flex; gap:10px;">
            <button type="button" id="btnBatalNonaktif" style="flex:1; padding:11px; background:#F1F5F9; color:#64748B; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">
                <i class="bi bi-x-lg"></i> Batal
            </button>
            <button type="button" id="btnKonfirmNonaktif" style="flex:1; padding:11px; background:#DC2626; color:white; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">
                <i class="bi bi-slash-circle"></i> Ya, Nonaktifkan
            </button>
        </div>
    </div>
</div>

<script>
(function () {
    var overlay    = document.getElementById('modalNonaktif');
    var box        = document.getElementById('modalNonaktifBox');
    var namaEl     = document.getElementById('nonaktifNamaUser');
    var btnKonfirm = document.getElementById('btnKonfirmNonaktif');
    var targetId   = null;

    document.querySelectorAll('.btn-nonaktif-user').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            targetId = btn.getAttribute('data-id');
            namaEl.textContent = btn.getAttribute('data-nama');
            overlay.classList.add('aktif');
        });
    });

    document.getElementById('btnBatalNonaktif').addEventListener('click', function (e) {
        e.stopPropagation();
        overlay.classList.remove('aktif');
    });

    btnKonfirm.addEventListener('click', function (e) {
        e.stopPropagation();
        if (targetId) document.getElementById('formNonaktif-' + targetId).submit();
    });

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) overlay.classList.remove('aktif');
    });

    box.addEventListener('click', function (e) { e.stopPropagation(); });
})();
</script>

@endsection