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
                        <form method="POST" action="{{ route('admin.petugas.destroy', $p->id_petugas) }}" onsubmit="return confirm('Hapus petugas {{ $p->nama_petugas }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="padding:5px 10px; background:#FEF2F2; color:#DC2626; border:none; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit;">
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
@endsection
