import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/about.css',
                'resources/css/contact.css',
                'resources/css/home.css',
                'resources/css/pageBD.css',
            ],
            refresh: true,
        }),
    ],
});
