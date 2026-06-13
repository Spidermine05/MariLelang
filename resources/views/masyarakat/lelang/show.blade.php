@extends('layouts.app-masyarakat')
@section('title', 'Detail Lelang — ' . $lelang->barang->nama_barang)
@section('content')
<div style="padding:24px; max-width:1000px; margin:0 auto;">
    <a href="{{ route('masyarakat.lelang.index') }}" style="color:#64748B; text-decoration:none; font-size:13px; display:inline-flex; align-items:center; gap:6px; margin-bottom:20px; font-weight:600;">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Lelang
    </a>

    <div style="display:grid; grid-template-columns:1fr 360px; gap:24px; align-items:start;">

        {{-- ── KIRI: Info Barang ────────────────────────────────────────── --}}
        <div>
            {{-- Foto & Info Barang --}}
            <div style="background:white; border-radius:16px; border:1px solid #E2E8F0; overflow:hidden; margin-bottom:20px; box-shadow:0 2px 12px #0000000a;">
                <div style="height:280px; background:linear-gradient(135deg,#EEF2FF,#E0E7FF); overflow:hidden; position:relative;">
                    @if($lelang->barang->foto_barang)
                        <img src="{{ $lelang->barang->foto_url }}" style="width:100%; height:280px; object-fit:cover; display:block;">
                        <i class="bi bi-tag-fill" style="font-size:72px; color:#A5B4FC;"></i>
                    @endif
                    {{-- Status badge di atas foto --}}
                    @php
                        $badgeStyle = match($lelang->status) {
                            'berlangsung' => 'background:#D1FAE5; color:#065F46;',
                            'dibuka'      => 'background:#DBEAFE; color:#1E40AF;',
                            'selesai'     => 'background:#F3F4F6; color:#374151;',
                            default       => 'background:#F3F4F6; color:#374151;',
                        };
                        $badgeLabel = match($lelang->status) {
                            'berlangsung' => '🟢 Sedang Berlangsung',
                            'dibuka'      => '🔵 Belum Dimulai',
                            'selesai'     => '⚫ Selesai',
                            default       => $lelang->status,
                        };
                    @endphp
                    <span style="position:absolute; top:12px; left:12px; {{ $badgeStyle }} border-radius:50px; padding:5px 12px; font-size:12px; font-weight:700;">
                        {{ $badgeLabel }}
                    </span>
                </div>
                <div style="padding:22px;">
                    @if($lelang->barang->kategori)
                        <span style="background:#EEF2FF; color:#4F46E5; font-size:10px; font-weight:700; padding:3px 10px; border-radius:50px; text-transform:uppercase; letter-spacing:.06em;">
                            {{ $lelang->barang->kategori->nama_kategori }}
                        </span>
                    @endif
                    <h1 style="font-size:24px; font-weight:900; margin:10px 0 8px; color:#0F172A; letter-spacing:-.3px;">
                        {{ $lelang->barang->nama_barang }}
                    </h1>
                    <p style="font-size:14px; color:#64748B; line-height:1.75; margin-bottom:14px;">
                        {{ $lelang->barang->deskripsi_barang ?? 'Tidak ada deskripsi.' }}
                    </p>
                    <div style="display:flex; gap:20px; flex-wrap:wrap; font-size:13px; color:#64748B; padding-top:14px; border-top:1px solid #F1F5F9;">
                        <div><span style="color:#94A3B8; font-weight:600;">Kondisi</span><br><strong style="color:#0F172A;">{{ ucfirst($lelang->barang->kondisi ?? '-') }}</strong></div>
                        <div><span style="color:#94A3B8; font-weight:600;">Harga Awal</span><br><strong style="color:#0F172A;">Rp {{ number_format($lelang->barang->harga_awal,0,',','.') }}</strong></div>
                        <div><span style="color:#94A3B8; font-weight:600;">Mulai</span><br><strong style="color:#0F172A;">{{ $lelang->waktu_mulai?->format('d M Y, H:i') ?? '-' }}</strong></div>
                        <div><span style="color:#94A3B8; font-weight:600;">Selesai</span><br><strong style="color:#0F172A;">{{ $lelang->waktu_selesai?->format('d M Y, H:i') ?? '-' }}</strong></div>
                    </div>
                </div>
            </div>

            {{-- Riwayat Penawaran --}}
            <div style="background:white; border-radius:16px; border:1px solid #E2E8F0; overflow:hidden; box-shadow:0 2px 12px #0000000a;">
                <div style="padding:16px 20px; border-bottom:1px solid #E2E8F0; display:flex; align-items:center; justify-content:space-between;">
                    <span style="font-size:14px; font-weight:800; color:#0F172A;">Riwayat Penawaran</span>
                    <span style="background:#EEF2FF; color:#4F46E5; border-radius:50px; padding:3px 10px; font-size:12px; font-weight:700;">{{ $lelang->penawaran->count() }} penawaran</span>
                </div>
                <table style="width:100%; border-collapse:collapse; font-size:13px;">
                    <thead>
                        <tr style="background:#F8FAFF;">
                            <th style="padding:10px 16px; text-align:left; font-weight:700; color:#94A3B8; font-size:11px; text-transform:uppercase; letter-spacing:.06em;">#</th>
                            <th style="padding:10px 16px; text-align:left; font-weight:700; color:#94A3B8; font-size:11px; text-transform:uppercase; letter-spacing:.06em;">Peserta</th>
                            <th style="padding:10px 16px; text-align:left; font-weight:700; color:#94A3B8; font-size:11px; text-transform:uppercase; letter-spacing:.06em;">Harga Tawar</th>
                            <th style="padding:10px 16px; text-align:left; font-weight:700; color:#94A3B8; font-size:11px; text-transform:uppercase; letter-spacing:.06em;">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lelang->penawaran->sortByDesc('harga_tawar')->values() as $i => $p)
                        <tr style="border-top:1px solid #F1F5F9; {{ $i===0 ? 'background:#FFFBEB;' : '' }}">
                            <td style="padding:10px 16px; color:#94A3B8; font-weight:700;">
                                {{ $i === 0 ? '🏆' : ($i + 1) }}
                            </td>
                            <td style="padding:10px 16px; font-weight:700; color:#0F172A;">
                                {{ $p->masyarakat?->nama_lengkap ?? '—' }}
                                @if($i === 0)<span style="background:#FEF3C7; color:#D97706; font-size:10px; font-weight:700; padding:2px 6px; border-radius:50px; margin-left:6px;">Tertinggi</span>@endif
                            </td>
                            <td style="padding:10px 16px; font-weight:800; color:{{ $i===0 ? '#D97706' : '#0F172A' }}; font-size:{{ $i===0 ? '15px' : '13px' }};">
                                Rp {{ number_format($p->harga_tawar,0,',','.') }}
                            </td>
                            <td style="padding:10px 16px; color:#64748B;">
                                {{ $p->waktu_tawar?->format('d/m H:i:s') ?? '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding:32px; text-align:center; color:#94A3B8;">
                                <div style="font-size:32px; margin-bottom:8px;">📭</div>
                                Belum ada penawaran.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ── KANAN: Bid Panel ────────────────────────────────────────── --}}
        <div style="position:sticky; top:80px;">
            <div style="background:white; border-radius:16px; border:1px solid #E2E8F0; padding:24px; box-shadow:0 4px 20px #0000000f;">

                {{-- Harga tertinggi --}}
                <div style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:.08em; margin-bottom:4px;">Penawaran Tertinggi</div>
                <div style="font-size:34px; font-weight:900; color:#F59E0B; margin-bottom:6px; letter-spacing:-.5px;">
                    Rp {{ number_format($penawaranTertinggi?->harga_tawar ?? $lelang->barang->harga_awal, 0, ',', '.') }}
                </div>

                @if($lelang->status === 'berlangsung' && (!$lelang->waktu_selesai || now()->lessThan($lelang->waktu_selesai)))
                {{-- Countdown --}}
                <div style="display:flex; align-items:center; gap:6px; font-size:12px; color:#64748B; font-weight:600; margin-bottom:18px;">
                    <span style="width:7px; height:7px; border-radius:50%; background:#EF4444; display:inline-block; animation:blink 1s infinite;"></span>
                    <span class="countdown" data-end="{{ $lelang->waktu_selesai }}">Menghitung...</span>
                </div>
                <div style="background:#F8FAFF; border-radius:10px; padding:12px 14px; margin-bottom:16px; font-size:13px; border:1px solid #E8EDFF;">
                    <div style="color:#64748B; margin-bottom:2px; font-weight:600;">Min. kenaikan bid</div>
                    <div style="font-weight:800; color:#4F46E5; font-size:16px;">Rp {{ number_format($lelang->harga_minimal_bid,0,',','.') }}</div>
                </div>

                {{-- Error / Success alert --}}
                @if($errors->any())
                <div style="background:#FEF2F2; border:1px solid #FECACA; border-radius:8px; padding:10px 12px; margin-bottom:12px; font-size:12px; color:#DC2626; font-weight:600;">
                    {{ $errors->first() }}
                </div>
                @endif
                @if(session('success'))
                <div style="background:#F0FDF4; border:1px solid #BBF7D0; border-radius:8px; padding:10px 12px; margin-bottom:12px; font-size:12px; color:#15803D; font-weight:600;">
                    ✅ {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div style="background:#FEF2F2; border:1px solid #FECACA; border-radius:8px; padding:10px 12px; margin-bottom:12px; font-size:12px; color:#DC2626; font-weight:600;">
                    ⏰ {{ session('error') }}
                </div>
                @endif

                <form method="POST" action="{{ route('masyarakat.penawaran.store', $lelang->id_lelang) }}">
                    @csrf
                    @php $minBid = ($penawaranTertinggi?->harga_tawar ?? $lelang->barang->harga_awal) + $lelang->harga_minimal_bid; @endphp
                    <div style="margin-bottom:14px;">
                        <label style="display:block; font-size:11px; font-weight:700; color:#64748B; margin-bottom:6px; text-transform:uppercase; letter-spacing:.06em;">
                            Harga Penawaran Anda (Rp)
                        </label>
                        <input type="number" name="harga_tawar" min="{{ $minBid }}"
                            placeholder="{{ number_format($minBid,0,',','.') }}"
                            value="{{ old('harga_tawar') }}"
                            required
                            style="width:100%; padding:13px 14px; border:1.5px solid #E2E8F0; border-radius:10px; font-size:16px; font-weight:700; font-family:inherit; outline:none; transition:border-color .2s, box-shadow .2s; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#4F46E5'; this.style.boxShadow='0 0 0 3px #4F46E51F';"
                            onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none';">
                    </div>
                    <div style="background:#EEF2FF; border-radius:8px; padding:9px 12px; margin-bottom:14px; font-size:12px; color:#4F46E5; font-weight:600;">
                        💡 Min. penawaran: <strong>Rp {{ number_format($minBid,0,',','.') }}</strong>
                    </div>
                    <button type="submit"
                        style="width:100%; padding:14px; background:linear-gradient(135deg,#4F46E5,#6366F1); color:white; border:none; border-radius:10px; font-size:15px; font-weight:800; cursor:pointer; font-family:inherit; box-shadow:0 4px 14px #4F46E54D; transition:transform .15s,box-shadow .15s;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px #4F46E566';"
                        onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 14px #4F46E54D';">
                        <i class="bi bi-hammer"></i> Ajukan Penawaran
                    </button>
                </form>

                @elseif($lelang->status === 'berlangsung' && $lelang->waktu_selesai && now()->greaterThanOrEqualTo($lelang->waktu_selesai))
                <div style="text-align:center; padding:24px 16px; background:#FEF2F2; border-radius:12px; border:1px dashed #FECACA;">
                    <div style="font-size:36px; margin-bottom:10px;">⏰</div>
                    <div style="font-weight:800; color:#DC2626; font-size:14px; margin-bottom:4px;">Waktu Lelang Sudah Habis</div>
                    <div style="font-size:12px; color:#EF4444;">Penawaran tidak dapat diajukan.</div>
                </div>

                @elseif($lelang->status === 'dibuka')
                <div style="margin-bottom:18px; font-size:12px; color:#64748B; font-weight:600;">
                    Mulai: {{ $lelang->waktu_mulai?->format('d M Y, H:i') ?? '-' }}
                </div>
                <div style="text-align:center; padding:24px 16px; background:#EFF6FF; border-radius:12px; border:1px dashed #BFDBFE;">
                    <div style="font-size:36px; margin-bottom:10px;">⏳</div>
                    <div style="font-weight:800; color:#1E40AF; font-size:14px; margin-bottom:4px;">Lelang Belum Dimulai</div>
                    <div style="font-size:12px; color:#3B82F6;">Pantau terus dan bersiaplah untuk menawar!</div>
                </div>

                @elseif($lelang->status === 'selesai')
                <div style="text-align:center; padding:24px 16px; background:#F0FDF4; border-radius:12px; border:1px dashed #BBF7D0; margin-top:12px;">
                    <div style="font-size:36px; margin-bottom:10px;">🏆</div>
                    <div style="font-weight:800; color:#15803D; font-size:14px; margin-bottom:6px;">Lelang Telah Selesai</div>
                    @if($penawaranTertinggi)
                    <div style="font-size:12px; color:#16A34A;">Pemenang: <strong>{{ $penawaranTertinggi->masyarakat?->nama_lengkap ?? '-' }}</strong></div>
                    <div style="font-size:14px; font-weight:800; color:#15803D; margin-top:6px;">Rp {{ number_format($penawaranTertinggi->harga_tawar,0,',','.') }}</div>
                    @endif
                </div>
                @endif

            </div>
        </div>

    </div>
</div>

<style>
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
@media (max-width: 768px) {
    div[style*="grid-template-columns:1fr 360px"] {
        display: block !important;
    }
    div[style*="position:sticky"] {
        margin-top: 20px;
    }
}
</style>
<script>
let reloaded = sessionStorage.getItem('reloaded_{{ $lelang->id_lelang }}');

function updateCountdowns(){
    document.querySelectorAll('.countdown[data-end]').forEach(el => {
        const d = new Date(el.dataset.end) - Date.now();
        if (d <= 0) {
            el.textContent = 'Waktu habis';
            if (!reloaded) {
                reloaded = true;
                sessionStorage.setItem('reloaded_{{ $lelang->id_lelang }}', '1');
                location.reload();
            }
            return;
        }
        const h = Math.floor(d/3600000),
              m = Math.floor(d%3600000/60000),
              s = Math.floor(d%60000/1000);
        el.textContent = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')} tersisa`;
    });
}
updateCountdowns();
setInterval(updateCountdowns, 1000);
</script>
@endsection