import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import preset from "./vendor/filament/support/tailwind.config.preset";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Onest", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require("@tailwindcss/typography")],
};
