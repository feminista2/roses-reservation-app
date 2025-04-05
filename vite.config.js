import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        emptyOutDir: true,
        rollupOptions: {
             input: {
                app: 'resources/js/app.js',  // Specific input path for JS
                css: 'resources/css/app.css',  // Specific input path for CSS
            },
            output: {
                // Ensure output is correctly set to public/build
                dir: 'public/build',
            },
        },
    },
});