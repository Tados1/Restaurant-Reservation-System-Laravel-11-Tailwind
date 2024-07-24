import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'moderne': ["Playwrite FR Moderne", "cursive"],
                'josefin': ["Josefin Sans", "sans-serif"]
            },
        },
    },

    plugins: [forms],
};
