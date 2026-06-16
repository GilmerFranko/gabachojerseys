import { defineConfig } from "vite";

export default defineConfig({
  build: {
    manifest: true,
    outDir: "static/dist",
    rollupOptions: {
      input: {
        // Vite entrará aquí y seguirá las migas de pan de los "import"
        admin: "./static/js/admin-entry.js",
        public: "./static/js/public-entry.js",
      },
    },
  },
  server: {
    port: 5173,
    strictPort: true,
    cors: true,
  },
  css: {
    devSourcemap: false,
  },
});
