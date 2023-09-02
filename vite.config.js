import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import svgLoader from "vite-svg-loader";
import path from "path";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true,
    }),
    vue({
      template: {
        base: null,
        includeAbsolute: false,
      },
    }),
    svgLoader(),
  ],
  resolve: {
    alias: {
      ziggy: path.resolve("vendor/tightenco/ziggy/dist/vue.es.js"),
      root: path.resolve("public"),
    },
  },
});
