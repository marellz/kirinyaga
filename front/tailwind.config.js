/** @type {import('tailwindcss').Config} */
import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

export default {
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue",
  ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Outfit", 'sans-serif', ...defaultTheme.fontFamily.sans],
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
}

