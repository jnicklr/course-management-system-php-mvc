import { defineConfig } from 'vite';

export default defineConfig({
  root: './ts',
  build: {
    outDir: '../public/js',
    rollupOptions: {
      input: {
        main: './ts/index.ts',
      },
      output: {
        entryFileNames: '[name].js',
        chunkFileNames: 'chunk.js',
        assetFileNames: 'assets/[name][extname]'
      }
    },
    emptyOutDir: true,
  },
  resolve: {
    alias: {
      '@': '/ts',
    }
  }
});
