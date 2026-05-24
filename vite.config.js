import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/auth-petugas.css',
                'resources/css/admin/dashboard-admin.css', 

            ],
            refresh: true,
        }),
    ],
});