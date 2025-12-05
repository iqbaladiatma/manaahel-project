import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    // Disable dark mode by default (use 'class' if you want to enable it later)
    darkMode: false,

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'gold': '#D4AF37',
                'gold-light': '#F4D03F',
                'blue-primary': '#1E40AF',
                'blue-light': '#3B82F6',
            },
        },
    },

    plugins: [forms],
};
