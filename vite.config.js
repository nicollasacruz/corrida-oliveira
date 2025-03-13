import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.css'],
            refresh: true,
        }),
        vue(),
    ],
    build: {
        manifest: true,
        outDir: 'storage/app/public/build', // Mudar para a pasta pública do Laravel
        emptyOutDir: true,
    }
});
