<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Admin</title>
<style>
    body { font-family: Arial, sans-serif; font-size: 12px; color: #1e293b; margin: 0; padding: 20px; }
    .header { text-align: center; border-bottom: 2px solid #4F46E5; padding-bottom: 12px; margin-bottom: 20px; }
    .header h1 { font-size: 20px; margin: 0 0 4px; color: #4F46E5; }
    .header p { margin: 2px 0; color: #64748b; font-size: 11px; }
    .stats-row { display: flex; gap: 16px; margin-bottom: 20px; }
    .stat-box { flex: 1; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px; text-align: center; }
    .stat-box .val { font-size: 20px; font-weight: 700; color: #4F46E5; }
    .stat-box .lbl { font-size: 10px; color: #64748b; text-transform: uppercase; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th { background: #4F46E5; color: white; padding: 8px 10px; text-align: left; font-size: 11px; }
    td { padding: 7px 10px; border-bottom: 1px solid #e2e8f0; font-size: 11px; }
    tr:nth-child(even) td { background: #f8faff; }
    .footer { text-align: center; font-size: 10px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 10px; margin-top: 20px; }
    .total-row td { font-weight: 700; background: #eef2ff; color: #4F46E5; }
</style>
</head>
<body>
<div class="header">
    <h1>MariLelang — Laporan Admin</h1>
    <p>Total Transaksi: Rp {{ number_format($stats['total_transaksi'], 0, ',', '.') }} &nbsp;|&nbsp; Total Lelang Selesai: {{ $stats['total_lelang'] }}</p>
    <p>Dicetak: {{ now()->format('d F Y, H:i') }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Barang</th>
            <th>Petugas</th>
            <th>Pemenang</th>
            <th>Harga Akhir</th>
            <th>Tanggal Selesai</th>
        </tr>
    </thead>
    <tbody>
        @forelse($lelang as $i => $item)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $item->barang?->nama_barang ?? '—' }}</td>
            <td>{{ $item->petugas?->nama_petugas ?? '—' }}</td>
            <td>{{ $item->pemenang?->nama_lengkap ?? 'Tidak ada pemenang' }}</td>
            <td>{{ $item->harga_akhir ? 'Rp ' . number_format($item->harga_akhir, 0, ',', '.') : '—' }}</td>
            <td>{{ $item->updated_at?->format('d/m/Y H:i') }}</td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center; color:#64748b;">Tidak ada data.</td></tr>
        @endforelse
        @if($lelang->count())
        <tr class="total-row">
            <td colspan="4">Total ({{ $lelang->count() }} lelang)</td>
            <td colspan="2">Rp {{ number_format($lelang->sum('harga_akhir'), 0, ',', '.') }}</td>
        </tr>
        @endif
    </tbody>
</table>

<div class="footer">
    &copy; {{ date('Y') }} MariLelang — Dokumen ini digenerate otomatis oleh sistem.
</div>
</body>
</html>
