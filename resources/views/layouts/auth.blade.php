<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Sistem Lelang Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue-main:   #5B8DEF;
            --blue-dark:   #3B6FD4;
            --blue-light:  #EBF1FD;
            --white:       #ffffff;
            --gray-50:     #F8FAFC;
            --gray-100:    #F1F5F9;
            --gray-300:    #CBD5E1;
            --gray-500:    #64748B;
            --gray-700:    #334155;
            --gray-900:    #0F172A;
            --error:       #EF4444;
            --radius-sm:   6px;
            --radius-md:   10px;
            --radius-lg:   16px;
            --radius-xl:   22px;
            --shadow-card: 0 8px 32px rgba(91,141,239,.18), 0 2px 8px rgba(0,0,0,.06);
            --shadow-btn:  0 4px 14px rgba(91,141,239,.35);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px 0;
        }

        .bg-dots {
            display: none;
        }

        /* Wrapper card */
        .auth-wrapper {
            position: relative; z-index: 1;
            width: 100%; max-width: 440px;
            padding: 16px;
            animation: slideUp .45s cubic-bezier(.22,.68,0,1.2) both;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Card utama */
        .auth-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        /* Header card */
        .auth-header {
            background: linear-gradient(135deg, var(--blue-main) 0%, var(--blue-dark) 100%);
            padding: 20px 28px 18px;
            text-align: center;
            position: relative;
        }
        .auth-header::after {
            content: '';
            position: absolute;
            bottom: -1px; left: 0; right: 0;
            height: 18px;
            background: var(--white);
            border-radius: 50% 50% 0 0 / 18px 18px 0 0;
        }
        .auth-header .badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,.18);
            color: #fff;
            font-size: 10px; font-weight: 600;
            letter-spacing: .08em; text-transform: uppercase;
            padding: 3px 10px; border-radius: 20px;
            margin-bottom: 8px;
            backdrop-filter: blur(4px);
        }
        .auth-header h1 {
            color: #fff;
            font-size: 22px; font-weight: 700;
            letter-spacing: -.4px;
        }
        .auth-header p {
            color: rgba(255,255,255,.8);
            font-size: 12px; margin-top: 3px;
        }

        /* Body form */
        .auth-body {
            padding: 18px 24px 22px;
        }

        /* Back link */
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: var(--gray-500); font-size: 12px; font-weight: 500;
            text-decoration: none; margin-bottom: 14px;
            transition: color .2s;
        }
        .back-link:hover { color: var(--blue-main); }
        .back-link svg { width: 14px; height: 14px; }

        /* Form group */
        .form-group { margin-bottom: 10px; }
        .form-group label {
            display: block;
            font-size: 11px; font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 4px;
            letter-spacing: .02em;
        }

        .input-wrap { position: relative; }
        .input-wrap > svg:first-of-type {
            position: absolute; left: 10px; top: 50%; transform: translateY(-50%);
            width: 14px; height: 14px;
            color: var(--gray-300);
            pointer-events: none;
            transition: color .2s;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 8px 10px 8px 32px;
            font-family: inherit; font-size: 13px;
            color: var(--gray-900);
            background: var(--gray-50);
            border: 1.5px solid var(--gray-100);
            border-radius: var(--radius-md);
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }
        input:focus {
            background: var(--white);
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3px rgba(91,141,239,.12);
        }
        .input-wrap:has(input:focus) > svg:first-of-type { color: var(--blue-main); }
        input.is-invalid { border-color: var(--error); }
        input.is-invalid:focus { box-shadow: 0 0 0 3px rgba(239,68,68,.1); }

        /* Password toggle */
        .toggle-pass {
            position: absolute; right: 8px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; padding: 2px;
            color: var(--gray-300); transition: color .2s;
        }
        .toggle-pass:hover { color: var(--blue-main); }
        .toggle-pass svg { width: 14px; height: 14px; display: block; }
        input.has-toggle { padding-right: 32px; }

        /* Error message */
        .field-error {
            display: flex; align-items: center; gap: 4px;
            color: var(--error); font-size: 11px; font-weight: 500;
            margin-top: 3px;
        }
        .field-error svg { width: 11px; height: 11px; flex-shrink: 0; }

        /* Alert global */
        .alert {
            display: flex; align-items: flex-start; gap: 8px;
            padding: 9px 12px; border-radius: var(--radius-md);
            font-size: 12px; font-weight: 500;
            margin-bottom: 12px;
        }
        .alert-error   { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }
        .alert-success { background: #F0FDF4; color: #16A34A; border: 1px solid #BBF7D0; }
        .alert svg { width: 14px; height: 14px; flex-shrink: 0; margin-top: 1px; }

        /* Submit button */
        .btn-primary {
            width: 100%; padding: 10px;
            background: linear-gradient(135deg, var(--blue-main) 0%, var(--blue-dark) 100%);
            color: #fff; font-family: inherit; font-size: 13px; font-weight: 700;
            border: none; border-radius: var(--radius-md);
            cursor: pointer; letter-spacing: .02em;
            box-shadow: var(--shadow-btn);
            transition: transform .15s, box-shadow .15s, opacity .15s;
            margin-top: 14px;
            display: block;
        }
        .btn-primary:hover  { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(91,141,239,.45); }
        .btn-primary:active { transform: translateY(0); opacity: .9; }

        /* Footer link */
        .auth-footer {
            text-align: center; margin-top: 14px;
            font-size: 12px; color: var(--gray-500);
        }
        .auth-footer a {
            color: var(--blue-main); font-weight: 600; text-decoration: none;
            transition: color .2s;
        }
        .auth-footer a:hover { color: var(--blue-dark); text-decoration: underline; }

        /* Divider */
        .divider {
            display: flex; align-items: center; gap: 10px;
            color: var(--gray-300); font-size: 11px; font-weight: 500;
            margin: 6px 0 10px;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: var(--gray-100);
        }

        /* Remember me */
        .remember-row {
            display: flex; align-items: center; gap: 7px;
            font-size: 12px; color: var(--gray-500);
            margin: 2px 0 12px;
        }
        .remember-row input[type="checkbox"] {
            width: 14px; height: 14px; padding: 0;
            accent-color: var(--blue-main);
        }

        /* 2 kolom grid */
        .form-grid-2 {
            display: grid; grid-template-columns: 1fr 1fr; gap: 0 10px;
        }
        @media (max-width: 380px) { .form-grid-2 { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<div class="bg-dots"></div>

@yield('content')

<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    const btn   = input.parentElement.querySelector('.toggle-pass');
    const isPass = input.type === 'password';
    input.type = isPass ? 'text' : 'password';
    btn.querySelector('.eye-open').style.display  = isPass ? 'none'  : 'block';
    btn.querySelector('.eye-close').style.display = isPass ? 'block' : 'none';
}
</script>
</body>
</html>