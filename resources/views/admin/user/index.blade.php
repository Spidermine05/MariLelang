@extends('layouts.admin')
@section('title', 'Kelola User')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2 style="font-size:20px; font-weight:800;">Kelola User (Masyarakat)</h2>
</div>

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
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.users.show', $user->id_user) }}" style="padding:5px 10px; background:#EEF2FF; color:var(--brand); border-radius:6px; font-size:12px; font-weight:700; text-decoration:none;">Detail</a>
                        @if($user->status_akun === 'nonaktif')
                        <form method="POST" action="{{ route('admin.users.aktivasi', $user->id_user) }}">
                            @csrf @method('PATCH')
                            <button type="submit" style="padding:5px 10px; background:#ECFDF5; color:#059669; border:none; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit;">Aktifkan</button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.users.nonaktif', $user->id_user) }}" onsubmit="return confirm('Nonaktifkan akun ini?')">
                            @csrf @method('PATCH')
                            <button type="submit" style="padding:5px 10px; background:#FEF2F2; color:#DC2626; border:none; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit;">Nonaktifkan</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="padding:40px; text-align:center; color:var(--text-muted);">Belum ada pengguna.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:16px;">{{ $users->links() }}</div>
@endsection
