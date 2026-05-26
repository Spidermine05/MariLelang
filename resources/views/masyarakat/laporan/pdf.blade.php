<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Penawaran Saya</title>
<style>
    body { font-family: Arial, sans-serif; font-size: 12px; color: #1e293b; margin: 0; padding: 20px; }
    .header { text-align: center; border-bottom: 2px solid #4F46E5; padding-bottom: 12px; margin-bottom: 20px; }
    .header h1 { font-size: 20px; margin: 0 0 4px; color: #4F46E5; }
    .header p { margin: 2px 0; color: #64748b; font-size: 11px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th { background: #4F46E5; color: white; padding: 8px 10px; text-align: left; font-size: 11px; }
    td { padding: 7px 10px; border-bottom: 1px solid #e2e8f0; font-size: 11px; }
    tr:nth-child(even) td { background: #f8faff; }
    .badge { padding: 2px 8px; border-radius: 50px; font-size: 10px; font-weight: 700; }
    .badge-menang { background: #dcfce7; color: #166534; }
    .badge-kalah  { background: #fee2e2; color: #991b1b; }
    .badge-aktif  { background: #eef2ff; color: #4338ca; }
    .footer { text-align: center; font-size: 10px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 10px; margin-top: 20px; }
</style>
</head>
<body>
<div class="header">
    <h1>MariLelang — Laporan Penawaran</h1>
    <p>Nama: {{ $user->nama_lengkap }} &nbsp;|&nbsp; Email: {{ $user->email }}</p>
    <p>Dicetak: {{ now()->format('d F Y, H:i') }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Barang</th>
            <th>Harga Tawar</th>
            <th>Waktu</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($penawaran as $i => $p)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $p->lelang?->barang?->nama_barang ?? '—' }}</td>
            <td>Rp {{ number_format($p->harga_tawar, 0, ',', '.') }}</td>
            <td>{{ $p->waktu_tawar?->format('d/m/Y H:i') }}</td>
            <td><span class="badge badge-{{ $p->status_tawar }}">{{ ucfirst($p->status_tawar) }}</span></td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center; color:#64748b;">Belum ada data penawaran.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    &copy; {{ date('Y') }} MariLelang — Dokumen ini digenerate otomatis oleh sistem.
</div>
</body>
</html>
