You are an expert Laravel Blade developer and UI designer.

## CONTEXT
This is the MariLelang project — a Laravel-based online auction platform.
The landing page already exists at resources/views/landing.blade.php with a footer section.
Brand colors: --brand: #4F46E5, --accent: #F59E0B. Font: Plus Jakarta Sans + Playfair Display.

## TASK
Create 3 static pages and integrate them into the existing landing page footer.

---

## PHASE 1 — READ FIRST

Before writing anything, read these files:
- resources/views/landing.blade.php (to find the footer section)
- resources/css/landing.css (to match existing styles)
- routes/web.php (to see existing routes)

Do NOT write any code yet until you have read all three files above.

---

## PHASE 2 — CREATE ROUTES

Add these 3 routes to routes/web.php inside a group:

Route::get('/kontak', fn() => view('static.kontak'))->name('static.kontak');
Route::get('/kebijakan-privasi', fn() => view('static.kebijakan-privasi'))->name('static.kebijakan');
Route::get('/bantuan', fn() => view('static.bantuan'))->name('static.bantuan');

---

## PHASE 3 — CREATE VIEWS

Create folder: resources/views/static/

### Shared rules for all 3 pages:
- Each page is a standalone blade file (no layout extension needed)
- Include the same navbar from landing page (copy the navbar HTML)
- Include the same footer from landing page (copy the footer HTML)
- Add @vite(['resources/css/landing.css']) so styles are consistent
- Add a back link "← Kembali ke Beranda" linking to route('landing') at the top of content
- All pages must be fully responsive
- Use Playfair Display for page title, Plus Jakarta Sans for body

---

### PAGE 1 — resources/views/static/kontak.blade.php

Page title (browser): "Kontak Kami — MariLelang"

Hero bar:
- Background: indigo gradient (same as stats section in landing)
- Title (Playfair Display, white, 42px): "Kontak Kami"
- Subtitle: "Ada pertanyaan? Kami siap membantu Anda"

Content layout (two columns, centered, max-width 900px):

LEFT COLUMN — Contact Info Cards:
Card 1 — WhatsApp (PRIMARY, highlighted with accent color):
  - Icon: WhatsApp logo SVG (green #25D366)
  - Label: "WhatsApp"
  - Value: "0862-8374-823"
  - Sub-label: "Senin – Sabtu, 08.00 – 17.00 WIB"
  - Button: "Chat Sekarang" → href="https://wa.me/6208628374823" target="_blank"
  - Button style: green background (#25D366), white text, rounded
  - This card has a slightly elevated shadow and green left border accent

Card 2 — Email:
  - Icon: envelope SVG
  - Label: "Email"
  - Value: "bantuan@marilelang.id"
  - Sub-label: "Respon dalam 1x24 jam"

Card 3 — Lokasi:
  - Icon: map pin SVG
  - Label: "Kantor"
  - Value: "Bandung, Jawa Barat"
  - Sub-label: "Indonesia"

RIGHT COLUMN — FAQ mini (3 most common questions):
Title: "Pertanyaan Umum"
Q: "Bagaimana cara mendaftar?"
A: "Klik tombol Daftar Sekarang di halaman utama dan isi data diri Anda."

Q: "Apakah pendaftaran gratis?"
A: "Ya, pendaftaran akun masyarakat sepenuhnya gratis."

Q: "Bagaimana jika saya memenangkan lelang?"
A: "Petugas kami akan menghubungi Anda melalui kontak yang terdaftar."

Each FAQ item: question in bold indigo, answer in muted text, separated by thin border.

Bottom CTA bar:
- Text: "Butuh bantuan lebih lanjut?"
- Link: "Kunjungi Halaman Bantuan →" → route('static.bantuan')

---

### PAGE 2 — resources/views/static/kebijakan-privasi.blade.php

Page title (browser): "Kebijakan Privasi — MariLelang"

Hero bar: same style as kontak page
- Title: "Kebijakan Privasi"
- Subtitle: "Terakhir diperbarui: {{ date('d F Y') }}"

Content: single column, max-width 760px, centered, good line-height (1.8)
Prose style: headings in indigo, body in dark gray

Last updated date at top as a small pill badge.

Sections (use <h2> for section titles, Playfair Display):

1. Pendahuluan
"MariLelang berkomitmen untuk melindungi privasi dan keamanan data pribadi Anda. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda saat menggunakan layanan kami."

2. Data yang Kami Kumpulkan
- Informasi identitas: nama lengkap, username, alamat email
- Informasi kontak: nomor telepon, alamat
- Data transaksi: riwayat penawaran dan lelang yang diikuti
- Data teknis: alamat IP, jenis browser, waktu akses

3. Cara Kami Menggunakan Data
- Memproses pendaftaran dan autentikasi akun
- Menjalankan dan mengelola proses lelang
- Mengirimkan notifikasi terkait aktivitas lelang Anda
- Meningkatkan keamanan dan performa platform
- Memenuhi kewajiban hukum yang berlaku

4. Keamanan Data
"Kami menggunakan enkripsi SSL/TLS untuk melindungi data yang dikirimkan. Password disimpan dalam bentuk terenkripsi dan tidak dapat dibaca oleh siapapun termasuk tim kami."

5. Berbagi Data
"Kami tidak menjual, menyewakan, atau membagikan data pribadi Anda kepada pihak ketiga untuk tujuan komersial tanpa persetujuan Anda, kecuali diwajibkan oleh hukum."

6. Hak Pengguna
- Mengakses data pribadi yang kami simpan
- Meminta koreksi data yang tidak akurat
- Meminta penghapusan akun dan data terkait
- Menghubungi kami melalui WhatsApp: 0862-8374-823

7. Perubahan Kebijakan
"Kami dapat memperbarui kebijakan ini sewaktu-waktu. Perubahan signifikan akan diberitahukan melalui email atau notifikasi di platform."

8. Hubungi Kami
"Jika Anda memiliki pertanyaan mengenai kebijakan privasi ini, hubungi kami melalui WhatsApp di 0862-8374-823 atau kunjungi halaman Kontak kami."
Link: route('static.kontak')

---

### PAGE 3 — resources/views/static/bantuan.blade.php

Page title (browser): "Pusat Bantuan — MariLelang"

Hero bar: same style
- Title: "Pusat Bantuan"
- Subtitle: "Temukan jawaban atas pertanyaan Anda"

Search bar (decorative, no backend):
- Input placeholder: "Cari pertanyaan..."
- Indigo search button with magnifier icon
- JS: filter FAQ items by typing (filter on .faq-item elements by text content)

Category tabs (horizontal pill tabs, JS toggle active):
- Semua | Akun | Lelang | Penawaran | Teknis

FAQ accordion layout (click to expand/collapse with smooth CSS transition):
Each item: question row (bold + chevron icon rotates on open) + answer panel

AKUN category:
Q: Bagaimana cara membuat akun?
A: Klik tombol "Daftar Sekarang" di halaman utama. Isi nama lengkap, username, email, nomor telepon, alamat, dan password. Klik "Daftar" dan akun Anda langsung aktif.

Q: Saya lupa password, apa yang harus dilakukan?
A: Saat ini reset password dilakukan melalui bantuan petugas. Hubungi kami via WhatsApp di 0862-8374-823 dengan menyertakan username dan email terdaftar.

Q: Bagaimana cara mengubah data profil?
A: Login ke akun Anda, lalu buka menu Profil di pojok kanan atas untuk mengubah data diri.

LELANG category:
Q: Bagaimana cara melihat lelang yang sedang berlangsung?
A: Setelah login, buka menu "Lelang Aktif" di dashboard. Semua lelang yang sedang berlangsung akan ditampilkan beserta countdown waktu berakhirnya.

Q: Apa itu harga minimal bid?
A: Harga minimal bid adalah selisih minimum yang harus ditambahkan dari tawaran tertinggi saat ini. Contoh: jika tawaran tertinggi Rp 500.000 dan minimal bid Rp 10.000, maka tawaran Anda minimal Rp 510.000.

Q: Kapan lelang ditutup?
A: Lelang ditutup otomatis sesuai waktu yang telah ditentukan petugas, atau dapat ditutup manual oleh petugas sebelum waktu berakhir.

PENAWARAN category:
Q: Bagaimana cara mengajukan penawaran?
A: Buka detail lelang yang ingin diikuti, masukkan nominal tawaran Anda di kolom yang tersedia, lalu klik "Ajukan Penawaran". Pastikan tawaran Anda melebihi tawaran tertinggi saat ini plus harga minimal bid.

Q: Apa yang terjadi jika saya memenangkan lelang?
A: Selamat! Petugas kami akan menghubungi Anda melalui nomor telepon yang terdaftar untuk proses serah terima barang dan pembayaran.

Q: Bisakah saya membatalkan penawaran?
A: Penawaran yang sudah diajukan tidak dapat dibatalkan. Pastikan Anda yakin sebelum mengajukan penawaran.

TEKNIS category:
Q: Browser apa yang didukung?
A: MariLelang mendukung semua browser modern: Chrome, Firefox, Safari, dan Edge versi terbaru.

Q: Apakah MariLelang tersedia di smartphone?
A: Ya, tampilan MariLelang sudah responsif dan dapat diakses melalui browser di smartphone Anda.

Q: Mengapa halaman tidak bisa diakses?
A: Coba bersihkan cache browser Anda atau gunakan mode incognito. Jika masalah berlanjut, hubungi kami via WhatsApp di 0862-8374-823.

Bottom contact banner:
- Background: light indigo (#EEF2FF)
- Text: "Tidak menemukan jawaban yang Anda cari?"
- WhatsApp button: "💬 Chat WhatsApp — 0862-8374-823" → href="https://wa.me/6208628374823" target="_blank"
- Style: green button, opens in new tab

---

## PHASE 4 — UPDATE FOOTER

Read resources/views/landing.blade.php carefully, find the footer section, then add these 3 links in the appropriate column (kolom Navigasi atau buat kolom baru "Informasi"):

- <a href="{{ route('static.kontak') }}">Kontak Kami</a>
- <a href="{{ route('static.kebijakan') }}">Kebijakan Privasi</a>
- <a href="{{ route('static.bantuan') }}">Pusat Bantuan</a>

Also add the WhatsApp number visibly in the footer contact column:
- Label: "WhatsApp"
- Value: "0862-8374-823" as a link → href="https://wa.me/6208628374823"

---
---

## PHASE 5 — DESIGN MODERNIZATION & ICON AUDIT

### STEP 1 — SCAN FOR EMOJI FIRST

Before changing anything, scan ALL blade and css files in the entire project:
- resources/views/**/*.blade.php (scan recursively, every single blade file)
- resources/css/**/*.css (scan recursively, every single css file)

Use this command to find all emoji before touching anything:
grep -rn '[^\x00-\x7F]' resources/views/ resources/css/

Output a complete audit table:

| File | Line | Emoji | Context |
|------|------|-------|---------|
| landing.blade.php | 45 | 🔨 | Badge pill hero section |
| admin/dashboard.blade.php | 33 | 👥 | Stat card icon |
| auth/masyarakat/dashboard.blade.php | 12 | 🏷️ | Category item |
| ... | ... | ... | ... |

Do NOT replace anything yet. Wait until the full audit table is complete.

### STEP 2 — ICON LIBRARY SETUP

Add Bootstrap Icons CDN in the <head> of these files (if not already present):
- resources/views/landing.blade.php
- resources/views/static/kontak.blade.php
- resources/views/static/kebijakan-privasi.blade.php
- resources/views/static/bantuan.blade.php

Add this line:
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

---

### STEP 3 — EMOJI REPLACEMENT MAP

Replace every emoji found with Bootstrap Icons (<i class="bi bi-..."></i>).
Use this mapping as reference:

🔨  → <i class="bi bi-hammer"></i>
✓   → <i class="bi bi-check-circle-fill"></i>
✅  → <i class="bi bi-check-circle-fill"></i>
🚫  → <i class="bi bi-x-circle-fill"></i>
📦  → <i class="bi bi-box-seam"></i>
🏷️  → <i class="bi bi-tag-fill"></i>
🎉  → <i class="bi bi-trophy-fill"></i>
👥  → <i class="bi bi-people-fill"></i>
📝  → <i class="bi bi-pencil-square"></i>
🔍  → <i class="bi bi-search"></i>
🏆  → <i class="bi bi-trophy-fill"></i>
🔒  → <i class="bi bi-shield-lock-fill"></i>
⚡  → <i class="bi bi-lightning-charge-fill"></i>
📊  → <i class="bi bi-bar-chart-fill"></i>
🏅  → <i class="bi bi-patch-check-fill"></i>
🟢  → <i class="bi bi-circle-fill text-success"></i>
🔵  → <i class="bi bi-circle-fill text-primary"></i>
💬  → <i class="bi bi-chat-dots-fill"></i>
❤️  → <i class="bi bi-heart-fill"></i>
→   → <i class="bi bi-arrow-right"></i>
←   → <i class="bi bi-arrow-left"></i>
★ / ⭐ → <i class="bi bi-star-fill"></i>

If an emoji is found that is NOT in this list, choose the most semantically appropriate Bootstrap Icon for it and document the choice in a comment above that line: <!-- replaced [emoji] with bi bi-xxx -->

---

### STEP 4 — MODERN DESIGN OVERHAUL

After all emojis are replaced, apply the following design improvements to ALL pages:
Apply all design changes to ALL blade views in the project, not just landing and static pages. This includes:
- resources/views/admin/**
- resources/views/petugas/**
- resources/views/auth/masyarakat/**
- resources/views/auth/petugas-login.blade.php
- resources/views/auth/admin-login.blade.php
- resources/views/static/**
- resources/views/landing.blade.php

Each role's pages must stay visually consistent with their own layout/color system but all must follow the same modern design rules below (border-radius, shadows, icon usage, typography scale, no emoji).

#### Typography refinements:
- Hero h1: font-size clamp(36px, 5vw, 64px) so it scales fluidly
- Section titles: font-size clamp(28px, 3.5vw, 42px)
- Body text: font-size 16px, line-height 1.75
- Letter-spacing on all uppercase labels: 0.08em
- All Bootstrap Icons used inline with text must have vertical-align: middle and margin-right: 6px

#### Color & surface refinements:
- Remove any pure white (#fff) card backgrounds — replace with #FAFBFF (very subtle blue tint)
- All card borders: 1px solid #E8EDFF instead of gray
- Shadows: replace any box-shadow with harsh offsets with: box-shadow: 0 4px 24px rgba(79, 70, 229, 0.08)
- Hover shadows: box-shadow: 0 8px 32px rgba(79, 70, 229, 0.16)
- All border-radius on cards: 16px
- All border-radius on buttons: 10px
- All border-radius on input fields: 10px

#### Navbar modernization:
- Height: 68px (increase from current)
- Logo "ML" badge: gradient background (linear-gradient(135deg, #4F46E5, #7C3AED)), white text, border-radius: 10px, width/height: 38px
- Nav links: no underline, color: #374151, font-weight: 500
- Nav links on hover: color: #4F46E5, with a 2px indigo underline that slides in via CSS transition
- "Masuk" button: border: 2px solid #4F46E5, color: #4F46E5, background: transparent, padding: 8px 20px
- "Daftar Sekarang" button: background: linear-gradient(135deg, #4F46E5, #6366F1), color: white, padding: 8px 20px, no border
- Both buttons on hover: transform: translateY(-1px) with transition: 0.2s

#### Hero section modernization:
- Remove dot grid background — replace with: a soft radial gradient mesh using 3 blurred circles (CSS only, no images):
  - Circle 1: position absolute, top-left, 500px diameter, background: rgba(79,70,229,0.12), filter: blur(80px), border-radius: 50%
  - Circle 2: position absolute, bottom-right, 400px diameter, background: rgba(245,158,11,0.10), filter: blur(60px), border-radius: 50%
  - Circle 3: position absolute, center, 300px diameter, background: rgba(99,102,241,0.08), filter: blur(100px), border-radius: 50%
- Badge pill: background: #EEF2FF, color: #4F46E5, border: 1px solid #C7D2FE, border-radius: 999px, font-size: 13px, font-weight: 600, padding: 6px 14px
- Primary CTA button: large, height 52px, padding 0 32px, gradient background, font-weight: 600, letter-spacing: 0.01em
- Ghost CTA button: height 52px, padding 0 32px, color: #4F46E5, border: 2px solid #C7D2FE, background: transparent
- Trust badges: small pill row, each with bi-check-circle-fill icon in green, font-size: 13px, color: #374151

#### Stats section modernization:
- Background: linear-gradient(135deg, #4338CA 0%, #4F46E5 50%, #6366F1 100%)
- Stat numbers: font-size: clamp(32px, 4vw, 48px), font-weight: 800, font-family: Playfair Display
- Stat icons: Bootstrap Icons, font-size: 28px, opacity: 0.85, display block, margin-bottom: 8px
- Add subtle top and bottom wave divider using SVG path (white fill, position absolute)

#### Cards modernization (auction cards, feature cards):
- Remove any border that looks heavy
- Add a thin top accent line on hover: border-top: 3px solid #4F46E5 via ::before pseudo-element transition
- Image placeholder area: gradient background (linear-gradient(135deg, #EEF2FF, #E0E7FF)) with centered Bootstrap Icon (bi-box-seam, font-size: 48px, color: #A5B4FC)
- Countdown timer badge: background: #FEF3C7, color: #92400E, border-radius: 6px, padding: 4px 10px, font-size: 12px, font-weight: 600
- Status badge "Berlangsung": background: #D1FAE5, color: #065F46, border-radius: 6px — NO emoji, just text + bi-circle-fill icon
- Status badge "Akan Dibuka": background: #DBEAFE, color: #1E40AF

#### How it works section:
- Step number: change from outlined number to a solid indigo pill badge (40x40px circle, gradient bg, white bold number)
- Connecting line between steps: gradient line (indigo to transparent) instead of solid gray
- Each step card: white background, 16px radius, subtle shadow, padding: 32px
- Icon circle: 56px, gradient background (indigo), white Bootstrap Icon inside, font-size: 24px

#### FAQ accordion (bantuan page):
- Each item: white card, 16px radius, shadow on open state
- Chevron icon: bi-chevron-down, rotates 180deg when open via CSS transition: transform 0.3s ease
- Open state: border-left: 3px solid #4F46E5
- Answer text: color: #4B5563, line-height: 1.8, padding-top: 12px

#### Contact cards (kontak page):
- WhatsApp card: border: 2px solid #25D366, background: linear-gradient(135deg, #F0FFF4, #DCFCE7)
- WhatsApp icon: use Bootstrap Icon bi-whatsapp, color: #16A34A, font-size: 32px
- Other cards: standard indigo border-left: 3px solid #4F46E5

#### Footer modernization:
- Background: #0A0F1E (deeper dark, more premium than #0F172A)
- Top border: 1px solid rgba(255,255,255,0.06)
- Column titles: font-size: 11px, font-weight: 700, letter-spacing: 0.12em, text-transform: uppercase, color: #6366F1
- Links: color: #94A3B8, transition: color 0.2s, hover: color: #E2E8F0
- Social icons: Bootstrap Icons, 20px, in a row with 8px gap, color: #64748B, hover: color: #6366F1
- Copyright bar: border-top: 1px solid rgba(255,255,255,0.06), padding-top: 24px, font-size: 13px, color: #475569

---

### STEP 5 — FINAL AUDIT

After all changes are applied, do a final check:
- Search ALL modified files for any remaining emoji characters (unicode range U+1F300 to U+1FFFF and U+2600 to U+26FF)
- If any are found, replace them using the mapping above
- Confirm Bootstrap Icons CDN is loaded in every page's <head>
- Confirm no inline style uses emoji in content property
- Output a short confirmation: "Audit selesai. X emoji diganti, 0 emoji tersisa."
grep -rn '[^\x00-\x7F]' resources/views/ resources/css/ resources/js/

## EXECUTION RULES
- Read all existing files before editing anything
- Never overwrite existing footer content — only ADD the new links
- Keep Bahasa Indonesia throughout
- All external links (WhatsApp) must have target="_blank" rel="noopener noreferrer"
- Match exact color scheme and font from landing.css
- FAQ accordion must work with pure vanilla JS, no jQuery
- Category tab filter must work with pure vanilla JS
- All 3 pages must look consistent with each other and with the landing page