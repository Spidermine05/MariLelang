You are an expert Laravel developer, Frontend Designer, and DevSecOps engineer. Before doing anything, thoroughly analyze the entire codebase first.

## PHASE 1 — CODEBASE ANALYSIS

Scan and read ALL files in this project including:
- All routes (routes/web.php, routes/api.php)
- All Controllers in app/Http/Controllers/**
- All Models in app/Models/**
- All Migrations in database/migrations/**
- All Views in resources/views/**
- All Middleware in app/Http/Middleware/**
- Config files: config/auth.php, config/database.php, config/app.php
- composer.json and package.json

After reading everything, produce a SUMMARY in this format:

### PROJECT SUMMARY
- Project Name: 
- Framework & Version:
- Database Driver:
- Authentication Guards: (list all guards found)
- User Roles: (list all roles)
- Existing Features: (bullet list)
- Missing Features: (bullet list)
- Existing Routes: (grouped by role/prefix)
- Missing Routes: (based on controllers that exist but have no route, or views that have no controller)
- Bug/Issues Found: (list any obvious bugs, mismatched column names, undefined routes, etc.)
- Security Issues Found: (list any vulnerabilities spotted)

Do NOT write any code yet. Wait for confirmation.

---

## PHASE 2 — LANDING PAGE

After summary is confirmed, build a professional public landing page first before any dashboard work.

### Route
- GET / → LandingController@index (replace current redirect to masyarakat.login)
- Create app/Http/Controllers/LandingController.php
  - Fetch: total lelang berlangsung, total barang tersedia, total masyarakat terdaftar, 6 lelang aktif terbaru (with barang + foto)
  - Pass all to resources/views/landing.blade.php

### Design Direction
Build a premium, conversion-focused landing page. The aesthetic is: modern Indonesian marketplace — trustworthy, energetic, professional. Think Tokopedia-meets-Sotheby's.

Typography:
- Display/heading font: "Playfair Display" (Google Fonts) — for hero headline and section titles
- Body font: "Plus Jakarta Sans" (already used in project) — for body text and UI
- Use large, bold headlines with tight letter-spacing

Color Palette (use CSS variables):
- --brand: #4F46E5 (indigo, existing brand)
- --brand-dark: #3730A3
- --accent: #F59E0B (amber — for highlights, CTAs, badges)
- --surface: #FFFFFF
- --bg: #F8FAFF (very slight blue tint)
- --text: #0F172A
- --text-muted: #64748B

### Sections to Build (in order):

#### 1. NAVBAR (sticky, glassmorphism on scroll)
- Left: Logo "ML" badge + "MariLelang" wordmark
- Right: nav links — Tentang Kami, Cara Kerja, Lelang Aktif — then CTA buttons: "Masuk" (outline) and "Daftar Sekarang" (filled indigo)
- On scroll: add backdrop-blur + subtle shadow via JS scroll event
- Mobile: hamburger menu with smooth slide-down

#### 2. HERO SECTION
- Full viewport height (min-height: 100vh)
- Split layout: left 55% text, right 45% visual
- Left content:
  - Small badge pill: "🔨 Platform Lelang Terpercaya #1"
  - H1 headline (Playfair Display, 72px): "Lelang Barang Terbaik, Harga Terjangkau"
  - Subheadline (18px, muted): "Ikuti lelang online secara real-time. Temukan barang berkualitas dengan penawaran yang adil dan transparan."
  - Two CTA buttons: "Mulai Lelang Sekarang" (large, indigo filled) + "Lihat Cara Kerja" (ghost with arrow icon)
  - Trust badges row below CTAs: "✓ Terpercaya", "✓ Aman & Terverifikasi", "✓ Transparan"
- Right visual:
  - Floating card stack effect — 3 overlapping auction item cards with staggered CSS animation (float up/down)
  - Each card shows: item icon/emoji, item name, current bid price, countdown timer visual
  - Behind cards: large soft gradient blob (indigo + amber)
- Background: subtle dot grid pattern using CSS radial-gradient

#### 3. STATS COUNTER SECTION
- Full-width band with indigo gradient background
- 4 animated counters (count up animation on scroll into view using IntersectionObserver):
  - Total Barang Dilelang: {{ $stats['total_barang'] }}+
  - Lelang Berlangsung: {{ $stats['total_lelang_aktif'] }}
  - Pengguna Terdaftar: {{ $stats['total_masyarakat'] }}+
  - Transaksi Selesai: {{ $stats['total_terjual'] }}+
- Each stat has icon + large number + label

#### 4. HOW IT WORKS (Cara Kerja)
- Section title: "Cara Kerja" (Playfair Display)
- Subtitle: "Mudah, cepat, dan transparan dalam 3 langkah"
- Three steps in a horizontal timeline layout with connecting line:
  1. 📝 "Daftar Akun" — Buat akun gratis dalam hitungan menit
  2. 🔍 "Temukan Barang" — Jelajahi barang lelang yang tersedia
  3. 🏆 "Ajukan Penawaran" — Tawar harga terbaik dan menangkan lelang
- Each step: large step number (outlined, faded), icon circle, title, description
- Subtle entrance animation (slide up) on scroll

#### 5. ACTIVE AUCTIONS (Lelang Aktif)
- Section title + "Lihat Semua →" link to masyarakat.login
- Responsive card grid (3 cols desktop, 2 tablet, 1 mobile)
- Render {{ $lelangAktif }} from controller (up to 6 items)
- Each auction card:
  - Foto barang (or placeholder gradient with item icon if no foto)
  - Status badge: "🟢 Berlangsung" or "🔵 Akan Dibuka"
  - Item name (bold)
  - Category tag (pill)
  - "Penawaran Tertinggi" label + price (amber, bold)
  - Countdown timer (JS, calculated from waktu_selesai)
  - "Ikut Lelang →" button (links to masyarakat.login with message)
- Hover: card lifts with shadow + scale(1.02)
- If no active auctions: show empty state illustration with "Belum ada lelang aktif saat ini"

#### 6. WHY CHOOSE US (Keunggulan)
- Two-column layout: left text, right feature grid
- Left: section label + Playfair Display heading "Mengapa Memilih MariLelang?" + paragraph
- Right: 2x2 feature grid cards:
  - 🔒 Keamanan Terjamin — Sistem terenkripsi dan data terlindungi
  - ⚡ Real-time Updates — Pantau penawaran secara langsung
  - 📊 Transparan — Semua riwayat penawaran bisa dilihat
  - 🏅 Terpercaya — Dikelola oleh petugas terverifikasi
- Each card: icon in colored circle, bold title, short description

#### 7. TESTIMONIALS (static, hardcoded — 3 cards)
- Section: "Apa Kata Pengguna Kami"
- 3 testimonial cards in a row:
  - Avatar initials circle, name, role ("Peserta Lelang"), star rating (5 stars), quote text
  - Quotes related to online auction experience in Indonesia
- Soft background: very light indigo tint

#### 8. CTA BANNER
- Full-width bold section with indigo-to-indigo-dark gradient
- Large heading: "Siap Ikut Lelang?" 
- Subtext: "Daftar gratis sekarang dan mulai penawaran pertama Anda"
- Big white button: "Daftar Sekarang — Gratis"
- Decorative: floating circles/shapes in background (CSS only)

#### 9. FOOTER
- 4 column layout:
  - Col 1: Logo + tagline + social icons (placeholder links)
  - Col 2: Navigasi — Beranda, Cara Kerja, Lelang Aktif
  - Col 3: Akun — Daftar Masyarakat, Masuk, Portal Petugas
  - Col 4: Kontak — placeholder email, phone, address
- Bottom bar: copyright + "Dibuat dengan ❤️ di Indonesia"
- Dark background (#0F172A)

### Technical Requirements for Landing Page:
- Pure HTML/CSS/JS within a single Blade file (resources/views/landing.blade.php)
- No external JS framework — vanilla JS only for: scroll navbar, counter animation, countdown timers, mobile menu, smooth scroll
- All CSS in resources/css/landing.css — loaded via @vite
- Fully responsive: mobile (375px), tablet (768px), desktop (1280px+)
- Page load performance: no render-blocking resources, fonts preloaded
- Add @vite(['resources/css/landing.css']) in head
- Smooth scroll behavior: html { scroll-behavior: smooth }
- All internal links use Laravel route() helper

---

## PHASE 3 — FEATURE COMPLETION

After landing page is done, implement ALL missing features in this order:

### A. Routes (routes/web.php)
Add all missing routes grouped properly:

- Petugas group (prefix: petugas, middleware: auth:petugas + EnsureIsPetugas):
  - Dashboard
  - Pendataan Barang: index, create, store, edit, update, destroy
  - Manajemen Lelang: index, create, store, show, buka, tutup
  - Generate Laporan: index, export PDF

- Admin group (prefix: admin, middleware: auth:petugas + EnsureIsAdmin):
  - Dashboard
  - Kelola User (Masyarakat): index, show, aktivasi, nonaktifkan
  - Tambah Petugas: index, create, store, edit, update, destroy
  - Pendataan Barang: index, create, store, edit, update, destroy
  - Kelola Kategori: index, create, store, edit, update, destroy
  - Generate Laporan: index, export PDF

- Masyarakat group (prefix: masyarakat, middleware: auth:masyarakat):
  - Dashboard
  - Lelang: index (aktif), show (detail + bid form), search
  - Penawaran: store (submit bid), riwayat
  - Generate Laporan: index, export PDF

### B. Models
Create these models if not exist with full relationships:
- Barang (table: tb_barang) — belongs to Kategori, Petugas; has many Lelang
- Kategori (table: tb_kategori) — has many Barang
- Lelang (table: tb_lelang) — belongs to Barang, Petugas, Masyarakat (pemenang); has many Penawaran
- Penawaran (table: tb_penawaran) — belongs to Lelang, Masyarakat
- HistoryLelang (table: history_lelang) — belongs to Lelang, Barang, Masyarakat

### C. Controllers

#### Petugas Controllers:
1. Petugas/BarangController
   - index(): paginate 10, with kategori, searchable by nama_barang
   - create(): form with kategori dropdown
   - store(): validate, handle foto upload to storage/public/barang, save
   - edit($id): load barang
   - update($id): validate, handle foto update
   - destroy($id): delete foto from storage, delete record

2. Petugas/LelangController
   - index(): list all lelang with barang, status badge
   - create(): form — select barang (status: tersedia), set waktu_mulai, waktu_selesai, harga_minimal_bid
   - store(): validate, create lelang, update status_barang to 'dilelang'
   - show($id): detail lelang with live penawaran list
   - buka($id): set status to 'berlangsung', waktu_mulai = now()
   - tutup($id): set status to 'ditutup', determine pemenang (highest penawaran), update harga_akhir, id_user, create HistoryLelang, update status_barang to 'terjual'

3. Petugas/LaporanController
   - index(): list lelang ditutup with filter by date range
   - exportPdf(): generate PDF using DomPDF with table of closed auctions, winner, final price

#### Admin Controllers:
4. Admin/UserController
   - index(): paginate masyarakat list with status_akun badge
   - show($id): detail user + riwayat penawaran
   - aktivasi($id): set status_akun = 'aktif'
   - nonaktifkan($id): set status_akun = 'nonaktif'

5. Admin/PetugasController
   - index(): list all petugas with level
   - create(): form with level dropdown (petugas only, not administrator)
   - store(): validate, hash password, save
   - edit($id): load petugas
   - update($id): validate, update (only hash password if filled)
   - destroy($id): delete

6. Admin/BarangController (same as Petugas but sees ALL barang from all petugas)

7. Admin/KategoriController: full CRUD

8. Admin/LaporanController
   - index(): global stats — total lelang, total transaksi, top barang, filter by month/year
   - exportPdf(): full report PDF

#### Masyarakat Controllers:
9. Masyarakat/LelangController
   - index(): list active lelang (status: berlangsung) with countdown waktu_selesai
   - show($id): detail barang, current highest bid, bid history, bid form
   - search(): filter by nama_barang, id_kategori, harga range

10. Masyarakat/PenawaranController
    - store($lelangId): validate bid > current highest + harga_minimal_bid, save penawaran, update previous bids status to 'kalah'
    - riwayat(): paginate own penawaran history with status

11. Masyarakat/LaporanController
    - index(): own bid history grouped by lelang
    - exportPdf(): personal report — bids submitted, won/lost status

### D. Views

Use consistent design language matching existing admin dashboard:
- Font: Plus Jakarta Sans
- Brand color: #4F46E5 (indigo)
- CSS variables already defined in resources/css/admin/dashboard.css

#### Layout Files:
1. resources/views/layouts/petugas.blade.php
   - Sidebar with navigation links (Dashboard, Barang, Lelang, Laporan)
   - Top navbar with petugas name and logout
   - @yield('content') area
   - Active link highlighting using request()->routeIs()

2. resources/views/layouts/admin.blade.php
   - Sidebar with: Dashboard, Kelola User, Tambah Petugas, Barang, Kategori, Laporan
   - Same design system

#### Petugas Views:
- petugas/dashboard.blade.php — stat cards: total barang, lelang berlangsung, lelang selesai hari ini
- petugas/barang/index.blade.php — table with foto thumbnail, nama, kategori, harga_awal, status, action buttons
- petugas/barang/form.blade.php — reused for create/edit: nama, tgl, harga_awal, deskripsi, kategori select, kondisi radio, foto upload with preview
- petugas/lelang/index.blade.php — table with barang name, status badge (colored), waktu_mulai, waktu_selesai, action: buka/tutup/detail
- petugas/lelang/form.blade.php — create form: select barang tersedia, datetime picker, harga_minimal_bid
- petugas/lelang/show.blade.php — detail: barang info, live penawaran table
- petugas/laporan/index.blade.php — filter form + table + export button

#### Admin Views:
- admin/dashboard.blade.php (convert to use admin layout)
- admin/user/index.blade.php — table: nama, username, email, telp, status badge, actions
- admin/user/show.blade.php — user profile + bid history
- admin/petugas/index.blade.php — table with level badge
- admin/petugas/form.blade.php
- admin/barang/index.blade.php — with petugas column
- admin/barang/form.blade.php
- admin/kategori/index.blade.php
- admin/laporan/index.blade.php — stats + Chart.js chart + filter + export

#### Masyarakat Views:
- masyarakat/lelang/index.blade.php — card grid + countdown timer JS
- masyarakat/lelang/show.blade.php — detail + bid form + bid history
- masyarakat/lelang/search.blade.php — search results + filter sidebar
- masyarakat/penawaran/riwayat.blade.php — table with status badges
- masyarakat/laporan/index.blade.php — summary + export

### E. Additional Fixes
1. Add migration: add column status_akun enum('aktif','nonaktif') default 'aktif' to tb_masyarakat
2. Add Laravel Scheduler in app/Console/Kernel.php — every minute check tb_lelang where waktu_selesai < now() and status != 'ditutup', auto-close them
3. Add storage:link — ensure public/storage symlink for foto uploads
4. Add foto_barang accessor in Barang model — return asset path or default placeholder

---

## PHASE 4 — SECURITY HARDENING

After all features are complete, implement the following security layers:

### 1. HTTPS / SSL Enforcement
In app/Http/Middleware/ForceHttps.php (create this file):
- Redirect all HTTP requests to HTTPS in production (APP_ENV=production)
- Set Strict-Transport-Security header (HSTS): max-age=31536000; includeSubDomains
Register in bootstrap/app.php as global middleware

In AppServiceProvider.php boot():
- Add URL::forceScheme('https') when APP_ENV is production

### 2. Security Headers Middleware
Create app/Http/Middleware/SecurityHeaders.php:
Apply these headers to every response:
- X-Content-Type-Options: nosniff
- X-Frame-Options: SAMEORIGIN
- X-XSS-Protection: 1; mode=block
- Referrer-Policy: strict-origin-when-cross-origin
- Permissions-Policy: camera=(), microphone=(), geolocation=()
- Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' fonts.googleapis.com; style-src 'self' 'unsafe-inline' fonts.googleapis.com fonts.gstatic.com; font-src fonts.gstatic.com; img-src 'self' data: storage.googleapis.com
Register as global middleware

### 3. Rate Limiting
In bootstrap/app.php or RouteServiceProvider:
- Login routes (masyarakat, petugas, admin): max 5 attempts per minute per IP
- Bid/penawaran store route: max 10 attempts per minute per user
- Export/laporan routes: max 3 attempts per minute per user

### 4. CSRF Protection
Ensure ALL POST/PUT/PATCH/DELETE routes use @csrf in blade forms (audit every form view)
Add VerifyCsrfToken middleware exceptions only if absolutely needed (none by default)

### 5. Input Validation & Sanitization
In every Controller store()/update() method, ensure:
- Use $request->validate() with strict rules
- Foto upload: validate mimes:jpg,jpeg,png,webp and max:2048
- Harga fields: validate integer and min:0
- String fields: validate string and max with strip_tags on output
- Never use $request->all() directly in create() — always use validated()

### 6. SQL Injection Prevention
Audit all DB queries:
- Replace any raw DB::statement() or DB::select() with raw user input using parameterized bindings
- Ensure all Eloquent where() clauses use parameter binding not string concatenation

### 7. Authentication Security
In LoginControllers (all 3 guards):
- Add RateLimiter — lock account after 5 failed attempts for 15 minutes
- Regenerate session after login ($request->session()->regenerate())
- Clear session on logout ($request->session()->invalidate() + regenerateToken())
- Check if these are already present; if not, add them

### 8. Authorization (Gates & Policies)
Create these Policies:
- BarangPolicy: petugas can only edit/delete their own barang (id_petugas check); admin can edit all
- LelangPolicy: petugas can only buka/tutup lelang they created; admin can manage all
- PenawaranPolicy: masyarakat can only bid on 'berlangsung' lelang

Register policies in AppServiceProvider

### 9. File Upload Security
In BarangController foto upload handling:
- Validate extension whitelist: jpg, jpeg, png, webp only
- Validate MIME type (not just extension)
- Generate unique filename using Str::uuid() + extension (never use original filename)
- Store outside public root in storage/app/public/barang/
- Virus scan hook comment (placeholder for ClamAV integration)

### 10. Environment & Config Security
Audit .env and add/confirm these settings:
- APP_DEBUG=false in production
- SESSION_SECURE_COOKIE=true
- SESSION_HTTPONLY=true
- SESSION_SAME_SITE=lax
- Add .env.example with all keys but no values

### 11. Password Security
In PetugasController store/update and MasyarakatAuthController register:
- Ensure bcrypt/Hash::make() is used (audit all password saves)
- Add password strength validation: min:8, at least 1 uppercase, 1 number
- Create app/Rules/StrongPassword.php with regex validation

### 12. Logging & Monitoring
In critical actions, add Log::info/warning entries:
- Failed login attempts: log IP, username, timestamp
- Lelang dibuka/ditutup: log petugas ID, lelang ID, timestamp
- Bid submitted: log user ID, lelang ID, amount
- Admin actions (user aktivasi/nonaktif, petugas CRUD): log admin ID + action

---

## EXECUTION RULES

- Always read existing files before modifying them — never overwrite without checking
- Maintain existing code style (same indentation, naming conventions)
- Keep all text/labels in Bahasa Indonesia
- All blade views must extend the appropriate layout
- All forms must have @csrf
- All redirects after store/update/destroy must use ->with('success', '...') flash message
- Show flash messages in the layout file using @if(session('success'))
- Use consistent color coding for status badges: berlangsung=green, dibuka=blue, ditutup=red/gray, tersedia=indigo
- Paginate all index pages with 10 items per page
- All money values displayed with number_format($value, 0, ',', '.') and prefix 'Rp '
- Landing page must be visually impressive — it is the first thing users see