import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./resources/js/**/*.js",
        "./resources/js/**/*.ts",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Noto Sans", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gunmetal: "#1b2f33ff",
                "light-cyan": "#cbeef3ff",
                "tea-rose-red": "#eec6caff",
                "red-crayola": "#ef3054ff",
                madder: "#a41623ff",
            },
        },
    },

    plugins: [forms],
};
