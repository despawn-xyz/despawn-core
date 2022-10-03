const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require("tailwindcss/colors");

const variableColor = (variable) => {
    const SCALE = [50, 100, 200, 300, 400, 500, 600, 700, 800, 900];
    const colors = {}

    SCALE.forEach(scale => {
        colors[scale] = ({ opacityVariable, opacityValue }) => {
            if (opacityValue !== null) {
                return `rgba(var(--${variable}-${scale}), ${opacityValue ?? '1'})`
            }

            if (opacityVariable !== null) {
                return `rgba(var(--${variable}-${scale}), ${opacityVariable ?? '1'})`
            }

            return `rgb(var(--${variable}-${scale}))`
        }
    })

    return colors
}
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
                    DEFAULT: '#06BFFF',
                    '50': '#BEEEFF',
                    '100': '#A9E9FF',
                    '200': '#80DEFF',
                    '300': '#58D4FF',
                    '400': '#2FC9FF',
                    '500': '#06BFFF',
                    '600': '#0098CD',
                    '700': '#006F95',
                    '800': '#00455D',
                    '900': '#001B25'
                },
                neutral: {
                    DEFAULT: '#353841',
                    '50': '#B9BBC7',
                    '100': '#ADB1BD',
                    '200': '#979BAB',
                    '300': '#808599',
                    '400': '#6B7185',
                    '500': '#595E6F',
                    '600': '#474B58',
                    '700': '#353841',
                    '800': '#25272E',
                    '900': '#15161A'
                },
                success: variableColor('primary'),
                warning: variableColor('danger'),
                danger: variableColor('danger'),
            },
            fontSize: {
                base: defaultTheme.fontSize.sm,
                md: defaultTheme.fontSize.base
            },
            boxShadow: {
                inset: '0px 0px 2px 0px rgb(0, 0, 0, 0.40);',
            },
            dropShadow: {
                'colored-drop-shadow': '0 4px 4px rgba(var(--tw-shadow-color), 0.25)',
            },
            transitionDuration: {
                DEFAULT: '250ms'
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
