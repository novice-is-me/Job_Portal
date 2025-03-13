import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                primary: ["Poppins, sans-serif"],
            },
            textColor: {
                header: "#0d6efd",
                secondary: "#4b5563",
            },
            backgroundColor: {
                primary: "#0d6efd",
            },
            backgroundImage: {
                base: "linear-gradient(0deg, rgba(2,0,36,1) 0%, rgba(250,250,250,1) 0%, rgba(255,255,255,1) 46%, rgba(218,233,255,1) 100%)",
            },
        },
    },

    plugins: [forms],
};
