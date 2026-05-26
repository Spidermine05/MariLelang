import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/landing.css',
                'resources/css/auth-petugas.css',
                'resources/css/dashboard.css',
                'resources/css/admin/dashboard.css',
            ],
            refresh: true,
        }),
    ],
});
