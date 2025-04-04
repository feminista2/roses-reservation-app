import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Tailwind CSS or custom styles
                'resources/js/app.js',   // Main JavaScript file
            ],
            refresh: true, // Enable hot module replacement (HMR) for CSS and JS changes
        }),
    ],

    build: {
        manifest:true,
        outDir: 'public/build',
    },

//    server: {
//        proxy: {
            // Proxy API requests to Laravel's backend (allowing API requests on frontend)
//            '/': 'http://localhost:8000',
//        },
//        hmr: {
//            host: 'localhost', // Ensures HMR works properly with Vite on localhost
//            port: 5173, // Default Vite HMR port
//        },
//    },
});