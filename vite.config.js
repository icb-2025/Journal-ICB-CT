import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});


// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel([
//             'resources/css/app.css',
//             'resources/js/app.js',
//         ]),
//     ],
//     server: {
//         host: '0.0.0.0', // ini membuat Vite bisa diakses dari jaringan
//         port: 5173,      // default port, bisa diganti kalau bentrok
//         strictPort: true,
//         hmr: {
//             host: '192.168.43.203', // IP komputer kamu, bukan localhost
//         },
//     },
// });
