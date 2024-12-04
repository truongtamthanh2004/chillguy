import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import basicSsl from "@vitejs/plugin-basic-ssl";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
        basicSsl(),
    ],
    server: {
        https: true,
        host: "localhost",
        port: 5173,
        strictPort: true,
        hmr: {
            host: "localhost",
            port: 5173,
        },
    },
});
