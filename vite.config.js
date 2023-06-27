import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/js/backend.js',
                'resources/js/frontend.js',
                'resources/js/auth.js'
            ],
            refresh: true,
        }),
    ],
});
