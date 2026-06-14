@extends('layouts.admin')
@section('title', 'Kelola Petugas')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2 style="font-size:20px; font-weight:800;">Kelola Petugas</h2>
    <a href="{{ route('admin.petugas.create') }}" style="padding:8px 18px; background:var(--brand); color:white; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;">
        <i class="bi bi-plus-lg"></i> Tambah Petugas
    </a>
</div>

<div style="background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
        <thead>
            <tr style="background:var(--bg);">
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Nama</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Username</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Level</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($petugas as $p)
            <tr style="border-top:1px solid var(--border);">
                <td style="padding:12px 16px; font-weight:700;">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <div style="width:32px; height:32px; border-radius:50%; background:var(--brand-light); display:flex; align-items:center; justify-content:center; font-weight:700; font-size:12px; color:var(--brand);">
                            {{ strtoupper(substr($p->nama_petugas, 0, 1)) }}
                        </div>
                        {{ $p->nama_petugas }}
                    </div>
                </td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $p->username }}</td>
                <td style="padding:12px 16px;">
                    @php $isAdmin = $p->level?->level === 'administrator'; @endphp
                    <span style="background:{{ $isAdmin ? '#EEF2FF' : '#ECFDF5' }}; color:{{ $isAdmin ? '#4F46E5' : '#059669' }}; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;">
                        {{ $isAdmin ? 'Administrator' : 'Petugas' }}
                    </span>
                </td>
                <td style="padding:12px 16px;">
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.petugas.edit', $p->id_petugas) }}" style="padding:5px 10px; background:#EEF2FF; color:var(--brand); border-radius:6px; font-size:12px; font-weight:700; text-decoration:none;">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        @if(!$p->isAdmin())
                        <form method="POST" action="{{ route('admin.petugas.destroy', $p->id_petugas) }}" id="formHapus-{{ $p->id_petugas }}">
                            @csrf @method('DELETE')
                            <button type="button"
                                class="btn-hapus-petugas"
                                data-id="{{ $p->id_petugas }}"
                                data-nama="{{ $p->nama_petugas }}"
                                style="padding:5px 10px; background:#FEF2F2; color:#DC2626; border:none; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit;">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="padding:40px; text-align:center; color:var(--text-muted);">Belum ada petugas terdaftar.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:16px;">{{ $petugas->links() }}</div>

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

{{-- Modal Hapus Petugas --}}
<div class="ml-modal-overlay" id="modalHapus">
    <div class="ml-modal-box" id="modalHapusBox">
        <div style="width:56px; height:56px; background:#FEF2F2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
            <i class="bi bi-trash-fill" style="font-size:24px; color:#DC2626;"></i>
        </div>
        <h3 style="text-align:center; font-size:18px; font-weight:800; color:#0F172A; margin-bottom:8px;">Hapus Petugas?</h3>
        <p style="text-align:center; font-size:13px; color:#64748B; line-height:1.6; margin-bottom:6px;">Anda akan menghapus akun petugas:</p>
        <p id="hapusNamaPetugas" style="text-align:center; font-size:14px; font-weight:800; color:#0F172A; margin-bottom:16px;"></p>
        <p style="text-align:center; font-size:12px; color:#DC2626; background:#FEF2F2; border-radius:8px; padding:8px 12px; margin-bottom:24px;">
            <i class="bi bi-exclamation-triangle-fill"></i> Tindakan ini tidak dapat dibatalkan.
        </p>
        <div style="display:flex; gap:10px;">
            <button type="button" id="btnBatalHapus" style="flex:1; padding:11px; background:#F1F5F9; color:#64748B; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">
                <i class="bi bi-x-lg"></i> Batal
            </button>
            <button type="button" id="btnKonfirmHapus" style="flex:1; padding:11px; background:#DC2626; color:white; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; font-family:inherit;">
                <i class="bi bi-trash"></i> Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script>
(function() {
    var overlay  = document.getElementById('modalHapus');
    var box      = document.getElementById('modalHapusBox');
    var namaEl   = document.getElementById('hapusNamaPetugas');
    var btnKonfirm = document.getElementById('btnKonfirmHapus');
    var targetId = null;

    document.querySelectorAll('.btn-hapus-petugas').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            targetId = btn.getAttribute('data-id');
            namaEl.textContent = btn.getAttribute('data-nama');
            overlay.classList.add('aktif');
        });
    });

    document.getElementById('btnBatalHapus').addEventListener('click', function(e) {
        e.stopPropagation();
        overlay.classList.remove('aktif');
    });

    btnKonfirm.addEventListener('click', function(e) {
        e.stopPropagation();
        if (targetId) document.getElementById('formHapus-' + targetId).submit();
    });

    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) overlay.classList.remove('aktif');
    });

    box.addEventListener('click', function(e) { e.stopPropagation(); });
})();
</script>

@endsection