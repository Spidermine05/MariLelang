@extends('layouts.app-masyarakat')
@section('title', 'Detail Lelang')
@section('content')
<div style="padding:24px; max-width:960px; margin:0 auto;">
    <a href="{{ route('masyarakat.lelang.index') }}" style="color:#64748B; text-decoration:none; font-size:13px; display:inline-block; margin-bottom:20px;"><i class="bi bi-arrow-left"></i> Kembali ke Daftar Lelang</a>

    <div style="display:grid; grid-template-columns:1fr 380px; gap:24px;">
        {{-- Kiri: Info Barang --}}
        <div>
            <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; margin-bottom:20px;">
                <div style="height:280px; background:linear-gradient(135deg,#EEF2FF,#E0E7FF); display:flex; align-items:center; justify-content:center;">
                    @if($lelang->barang->foto_barang)
                    <img src="{{ $lelang->barang->foto_url }}" style="width:100%; height:100%; object-fit:cover;">
                    @else
                    <span style="font-size:72px;"><i class="bi bi-tag-fill" style="color:#A5B4FC;"></i></span>
                    @endif
                </div>
                <div style="padding:20px;">
                    @if($lelang->barang->kategori)
                    <span style="background:#EEF2FF; color:#4F46E5; font-size:10px; font-weight:700; padding:2px 8px; border-radius:50px; text-transform:uppercase;">{{ $lelang->barang->kategori->nama_kategori }}</span>
                    @endif
                    <h1 style="font-size:22px; font-weight:800; margin:10px 0 6px;">{{ $lelang->barang->nama_barang }}</h1>
                    <p style="font-size:14px; color:#64748B; line-height:1.7;">{{ $lelang->barang->deskripsi_barang }}</p>
                    <div style="margin-top:12px; font-size:13px; color:#64748B;">
                        Kondisi: <strong>{{ ucfirst($lelang->barang->kondisi) }}</strong> &nbsp;|&nbsp;
                        Harga Awal: <strong>Rp {{ number_format($lelang->barang->harga_awal,0,',','.') }}</strong>
                    </div>
                </div>
            </div>

            {{-- Riwayat Penawaran --}}
            <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden;">
                <div style="padding:16px 20px; border-bottom:1px solid #E2E8F0; font-size:14px; font-weight:800;">Riwayat Penawaran ({{ $lelang->penawaran->count() }})</div>
                <table style="width:100%; border-collapse:collapse; font-size:13px;">
                    <thead><tr style="background:#F8FAFF;">
                        <th style="padding:10px 16px; text-align:left; font-weight:700; color:#64748B; font-size:11px; text-transform:uppercase;">Peserta</th>
                        <th style="padding:10px 16px; text-align:left; font-weight:700; color:#64748B; font-size:11px; text-transform:uppercase;">Harga Tawar</th>
                        <th style="padding:10px 16px; text-align:left; font-weight:700; color:#64748B; font-size:11px; text-transform:uppercase;">Waktu</th>
                    </tr></thead>
                    <tbody>
                        @forelse($lelang->penawaran->sortByDesc('harga_tawar') as $i => $p)
                        <tr style="border-top:1px solid #E2E8F0; {{ $i===0 ? 'background:#FFFBEB;' : '' }}">
                            <td style="padding:10px 16px; font-weight:700;">{{ $p->masyarakat?->nama_lengkap ?? '—' }}</td>
                            <td style="padding:10px 16px; font-weight:800; color:{{ $i===0 ? '#D97706' : '#0F172A' }};">Rp {{ number_format($p->harga_tawar,0,',','.') }}</td>
                            <td style="padding:10px 16px; color:#64748B;">{{ $p->waktu_tawar?->format('d/m H:i:s') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" style="padding:24px; text-align:center; color:#64748B;">Belum ada penawaran.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Kanan: Bid Form --}}
        <div>
            <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; padding:24px; position:sticky; top:80px;">
                <div style="font-size:12px; font-weight:700; color:#64748B; text-transform:uppercase; margin-bottom:4px;">Penawaran Tertinggi</div>
                <div style="font-size:32px; font-weight:900; color:#F59E0B; margin-bottom:4px;">
                    Rp {{ number_format($penawaranTertinggi?->harga_tawar ?? $lelang->barang->harga_awal, 0, ',', '.') }}
                </div>
                <div style="font-size:12px; color:#64748B; margin-bottom:16px; display:flex; align-items:center; gap:4px;">
                    <span style="width:6px; height:6px; border-radius:50%; background:#EF4444; display:inline-block; animation:blink 1s infinite;"></span>
                    <span class="countdown" data-end="{{ $lelang->waktu_selesai }}">Menghitung...</span>
                </div>
                <div style="background:#F8FAFF; border-radius:8px; padding:12px; margin-bottom:16px; font-size:13px;">
                    <div style="color:#64748B; margin-bottom:2px;">Min. kenaikan bid:</div>
                    <div style="font-weight:800; color:#4F46E5;">Rp {{ number_format($lelang->harga_minimal_bid,0,',','.') }}</div>
                </div>

                @if($lelang->status === 'berlangsung')
                <form method="POST" action="{{ route('masyarakat.penawaran.store', $lelang->id_lelang) }}">
                    @csrf
                    @php $minBid = ($penawaranTertinggi?->harga_tawar ?? $lelang->barang->harga_awal) + $lelang->harga_minimal_bid; @endphp
                    <div style="margin-bottom:12px;">
                        <label style="display:block; font-size:12px; font-weight:700; color:#64748B; margin-bottom:6px; text-transform:uppercase;">Harga Penawaran Anda (Rp)</label>
                        <input type="number" name="harga_tawar" min="{{ $minBid }}" placeholder="{{ number_format($minBid,0,',','.') }}" required style="width:100%; padding:12px; border:1px solid #E2E8F0; border-radius:8px; font-size:16px; font-weight:700; font-family:inherit; outline:none;">
                        @error('harga_tawar') <span style="color:#DC2626; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" style="width:100%; padding:14px; background:#4F46E5; color:white; border:none; border-radius:8px; font-size:15px; font-weight:800; cursor:pointer; font-family:inherit;">
                        <i class="bi bi-hammer"></i> Ajukan Penawaran
                    </button>
                </form>
                @else
                <div style="text-align:center; padding:16px; background:#F1F5F9; border-radius:8px; color:#64748B; font-size:14px; font-weight:600;">
                    Lelang belum dibuka / sudah ditutup
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<style>@keyframes blink{0%,100%{opacity:1}50%{opacity:.3}}</style>
<script>
function updateCountdowns(){document.querySelectorAll('.countdown[data-end]').forEach(el=>{const d=new Date(el.dataset.end)-Date.now();if(d<=0){el.textContent='Selesai';return;}const h=Math.floor(d/3600000),m=Math.floor(d%3600000/60000),s=Math.floor(d%60000/1000);el.textContent=`${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')} tersisa`;});}
updateCountdowns();setInterval(updateCountdowns,1000);
</script>
@endsection
