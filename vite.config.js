import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/about.css',
                'resources/css/contact.css',
                'resources/css/home.css',
                'resources/css/pageBD.css',
                'resources/css/vacancies.css',
                'resources/css/cart.css',
                'resources/css/products.css',
            ],
            refresh: true,
        }),
    ],
});
