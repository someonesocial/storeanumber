import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import dotenv from "dotenv";

dotenv.config();

export default defineConfig({
  plugins: [vue()],
  define: {
    "process.env": process.env,
  },
  server: {
    host: "0.0.0.0",
    port: 8080,
    proxy: {
      "/api": {
        target: "http://backend:80",
        changeOrigin: true,
      },
    },
  },
});
