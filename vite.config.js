import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    content: [
        "./resources/**/*.blade.php",
        "./app/Filament/**/*.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/views/vendor/filament/**/*.blade.php",
    ],
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
