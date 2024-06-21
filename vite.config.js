import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/universal/submit.js'
            ],
            refresh: true,
        }),
    ],
});
