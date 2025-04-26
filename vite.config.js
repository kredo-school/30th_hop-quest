import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                // js folder
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/profile_edit.js',

                // home folder
                'resources/js/home/home.js',
                'resources/js/home/jquery-3.6.0.min.js',
                'resources/js/home/slick.min.js',

                // quest folder
                'resources/js/quest/confirm-quest.js',
                'resources/js/quest/edit-quest.js',
                'resources/js/quest/map.js',
                'resources/js/quest/photo-container.js',
                'resources/js/quest/quest-add-spot.js',
                'resources/js/quest/scroll-adjustment.js',
                'resources/js/quest/view-quest.js',

                // comment folder
                'resources/js/quest/comment/quest-comment.js',

                // quest folder
                'resources/js/quest/quest/edit-quest-modal.js',

                // quest-body folder
                'resources/js/quest/comment/edit-questbody-modal.js',

                
            ],
            refresh: true,
        }),
    ],
});
