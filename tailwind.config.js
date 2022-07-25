const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/livewire/*.blade.php',
        './node_modules/tw-elements/dist/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                ...colors,
                brand: '#0F6BA5',
                neutral2: '#889096',
                primary: '#0072F5',
                secondary: '#7828C8',
                success: '#17C964',
                greenify: '#00b362',
                warning: '#F5A524',
                error: '#F31260'
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                noto: ["'Baloo Bhaijaan 2'", 'cursive'],
                // noto: ["'Noto Sans Arabic' ", 'sans-serif'],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('tw-elements/dist/plugin'),
        require('tailwind-scrollbar-hide'),
    ],
};
