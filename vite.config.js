import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'], // Inclui CSS no build
            buildDirectory: 'build',  // Define o diretório correto de build
            refresh: true,  // Atualiza automaticamente ao mudar arquivos
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        manifest: true,  // Garante que o Laravel encontre os assets
        outDir: 'public/build',  // Define a saída correta para os arquivos
        emptyOutDir: true,  // Remove arquivos antigos antes de gerar novos
        rollupOptions: {
            input: 'resources/js/app.js',
        },
    },
});
