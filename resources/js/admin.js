// resources/js/admin.js
import 'bootstrap';

// ── Toggle show/hide password ──────────────────────────────────────────────
document.querySelectorAll('[data-toggle-password]').forEach(btn => {
    btn.addEventListener('click', () => {
        const input   = document.getElementById(btn.getAttribute('data-toggle-password'));
        const iconEye    = btn.querySelector('.icon-eye');
        const iconEyeOff = btn.querySelector('.icon-eye-off');
        if (!input) return;

        const isPass  = input.type === 'password';
        input.type    = isPass ? 'text' : 'password';
        iconEye.classList.toggle('d-none', isPass);
        iconEyeOff.classList.toggle('d-none', !isPass);
    });
});

// ── Password strength meter ────────────────────────────────────────────────
const strengthInput = document.querySelector('[data-strength-meter]');
const strengthFill  = document.getElementById('strengthFill');
const strengthLabel = document.getElementById('strengthLabel');

if (strengthInput && strengthFill && strengthLabel) {
    strengthInput.addEventListener('input', () => {
        const val = strengthInput.value;
        let score = 0;

        if (val.length >= 8)          score++;
        if (/[A-Z]/.test(val))        score++;
        if (/[0-9]/.test(val))        score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = {
            0: { pct: 0,   color: '#ef4444', text: '' },
            1: { pct: 25,  color: '#ef4444', text: 'Lemah' },
            2: { pct: 50,  color: '#f59e0b', text: 'Cukup' },
            3: { pct: 75,  color: '#f59e0b', text: 'Kuat' },
            4: { pct: 100, color: '#22c55e', text: 'Sangat kuat' },
        };

        const { pct, color, text } = levels[score] || levels[0];
        strengthFill.style.width      = pct + '%';
        strengthFill.style.background = color;
        strengthLabel.textContent     = val.length ? text : '';
        strengthLabel.style.color     = color;
    });
}
