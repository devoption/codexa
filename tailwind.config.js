/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                'figtree': ['Figtree', 'sans-serif'],
                'jetbrains': ['JetBrains Mono', 'monospace'],
            },
            colors: {
                'primary': 'var(--color-primary)',
                'secondary': 'var(--color-secondary)',

                'alert': {
                    'info': 'var(--color-alert-info)',
                    'success': 'var(--color-alert-success)',
                    'warning': 'var(--color-alert-warning)',
                    'danger': 'var(--color-alert-danger)',
                },

                'gray': {
                    '50': 'var(--color-gray-50)',
                    '100': 'var(--color-gray-100)',
                    '200': 'var(--color-gray-200)',
                    '300': 'var(--color-gray-300)',
                    '400': 'var(--color-gray-400)',
                    '500': 'var(--color-gray-500)',
                    '600': 'var(--color-gray-600)',
                    '700': 'var(--color-gray-700)',
                    '800': 'var(--color-gray-800)',
                    '900': 'var(--color-gray-900)',
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
