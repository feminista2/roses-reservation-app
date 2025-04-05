<?php

return [
    /*
     * The path to the Vite manifest file.
     *
     * This is where Laravel will look for the Vite manifest.json file, which is generated
     * when you run npm run build. By default, the manifest.json is located in the
     * public/build/.vite folder. You can update this path if your manifest file
     * is in a different location.
     */
    'manifest_path' => public_path('build/.vite/manifest.json'),

    /*
     * The directory where the built assets will be stored.
     *
     * By default, Vite stores the assets in the public/build directory.
     */
    'build_directory' => 'build',

    /*
     * The base URL for the Vite assets.
     *
     * This URL is used when generating the links to Vite's CSS and JS assets in the Blade
     * templates. If your app is deployed in a subdirectory, you might need to set this to
     * the subdirectory URL (e.g., /your-subdirectory/build).
     */
    'build_url' => env('VITE_URL', '/build'),
];
