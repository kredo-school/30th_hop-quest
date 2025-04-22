import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/home/home.js',
                'resources/js/quest/view-quest.js',
                'resources/js/quest/comment/quest-comment',
                'resources/js/quest/map.js',
                'resources/js/profile_edit.jsprofile_edit.js',
            ],
            refresh: true,
        }),
    ],
});
