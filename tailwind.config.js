const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require("tailwindcss/colors");
const plugin = require('tailwindcss/plugin')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: 'rgb(var(--primary-50) / <alpha-value>)',
                    100: 'rgb(var(--primary-100) / <alpha-value>)',
                    200: 'rgb(var(--primary-200) / <alpha-value>)',
                    300: 'rgb(var(--primary-300) / <alpha-value>)',
                    400: 'rgb(var(--primary-400) / <alpha-value>)',
                    500: 'rgb(var(--primary-500) / <alpha-value>)',
                    600: 'rgb(var(--primary-600) / <alpha-value>)',
                    700: 'rgb(var(--primary-700) / <alpha-value>)',
                    800: 'rgb(var(--primary-800) / <alpha-value>)',
                    900: 'rgb(var(--primary-900) / <alpha-value>)',
                },
                gray: {
                    50: 'rgb(var(--gray-50) / <alpha-value>)',
                    100: 'rgb(var(--gray-100) / <alpha-value>)',
                    200: 'rgb(var(--gray-200) / <alpha-value>)',
                    300: 'rgb(var(--gray-300) / <alpha-value>)',
                    400: 'rgb(var(--gray-400) / <alpha-value>)',
                    500: 'rgb(var(--gray-500) / <alpha-value>)',
                    600: 'rgb(var(--gray-600) / <alpha-value>)',
                    700: 'rgb(var(--gray-700) / <alpha-value>)',
                    800: 'rgb(var(--gray-800) / <alpha-value>)',
                    900: 'rgb(var(--gray-900) / <alpha-value>)',
                },
                success: {
                    50: 'rgb(var(--primary-50) / <alpha-value>)',
                    100: 'rgb(var(--primary-100) / <alpha-value>)',
                    200: 'rgb(var(--primary-200) / <alpha-value>)',
                    300: 'rgb(var(--primary-300) / <alpha-value>)',
                    400: 'rgb(var(--primary-400) / <alpha-value>)',
                    500: 'rgb(var(--primary-500) / <alpha-value>)',
                    600: 'rgb(var(--primary-600) / <alpha-value>)',
                    700: 'rgb(var(--primary-700) / <alpha-value>)',
                    800: 'rgb(var(--primary-800) / <alpha-value>)',
                    900: 'rgb(var(--primary-900) / <alpha-value>)',
                },
                warning: {
                    50: 'rgb(var(--danger-50) / <alpha-value>)',
                    100: 'rgb(var(--danger-100) / <alpha-value>)',
                    200: 'rgb(var(--danger-200) / <alpha-value>)',
                    300: 'rgb(var(--danger-300) / <alpha-value>)',
                    400: 'rgb(var(--danger-400) / <alpha-value>)',
                    500: 'rgb(var(--danger-500) / <alpha-value>)',
                    600: 'rgb(var(--danger-600) / <alpha-value>)',
                    700: 'rgb(var(--danger-700) / <alpha-value>)',
                    800: 'rgb(var(--danger-800) / <alpha-value>)',
                    900: 'rgb(var(--danger-900) / <alpha-value>)',
                },
                danger: {
                    50: 'rgb(var(--danger-50) / <alpha-value>)',
                    100: 'rgb(var(--danger-100) / <alpha-value>)',
                    200: 'rgb(var(--danger-200) / <alpha-value>)',
                    300: 'rgb(var(--danger-300) / <alpha-value>)',
                    400: 'rgb(var(--danger-400) / <alpha-value>)',
                    500: 'rgb(var(--danger-500) / <alpha-value>)',
                    600: 'rgb(var(--danger-600) / <alpha-value>)',
                    700: 'rgb(var(--danger-700) / <alpha-value>)',
                    800: 'rgb(var(--danger-800) / <alpha-value>)',
                    900: 'rgb(var(--danger-900) / <alpha-value>)',
                },
            },
            fontSize: {
                base: defaultTheme.fontSize.sm,
                md: defaultTheme.fontSize.base
            },
            boxShadow: {
                inset: '0px 0px 2px 0px rgb(0 0 0 / 0.40)',
                slim: '0 1px 3px rgb(0 0 0 / 0.06), 0 1px 2px rgb(0 0 0 / 0.12)',
                glow: '0 0 4px rgb(0 0 0 / 0.1)',
            },
            transitionDuration: {
                DEFAULT: '250ms'
            },
            maxWidth: {
                lg: '33rem',
                '2xl': '40rem',
                '3xl': '50rem',
                '5xl': '66rem',
            },
            opacity: {
                1: '0.01',
                2.5: '0.025',
                7.5: '0.075',
                15: '0.15',
            },
        },
    },

    plugins: [
        // require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        plugin(function ({ addUtilities, matchUtilities, theme }) {
            addUtilities({
                '.text-shadow': {
                    'text-shadow': 'rgb(0 0 0 / 0.5) 0 0 2px'
                },
            });
        }),
    ],
};
