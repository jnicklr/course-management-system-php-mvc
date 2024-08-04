import { defineConfig } from 'vite';

export default defineConfig({
  root: './ts',
  build: {
    outDir: '../public',
    rollupOptions: {
      input: {
        main: './resources/ts/index.ts',
        styles: './resources/css/main.css'
      },
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/chunk.js',
        assetFileNames: 'css/[name][extname]'
      },
      treeshake: true,
      external: ['/public/img/**']
    },
    emptyOutDir: false,
  },
  resolve: {
    alias: {
      '@': '/ts',
    }
  }
});
