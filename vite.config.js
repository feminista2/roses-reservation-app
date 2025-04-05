import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            buildDirectory: './build/',
        }),
    ],
    build: {
        // This will prevent Vite from emptying directories that aren't part of its output
        emptyOutDir: false,
    }
});