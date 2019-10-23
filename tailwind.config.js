module.exports = {
  theme: {
    extend: {
      colors: {
        light: 'hsl(210, 16.7%, 97.6%)',
        'aa-100': 'hsla(0, 100%, 0%, 0.03)',
        'gray-100': 'hsl(208, 10%, 95%)',
        'gray-200': 'hsl(208, 10%, 90%)',
        'gray-300': 'hsl(208, 10%, 80%)',
        'gray-400': 'hsl(208, 10%, 70%)',
        'gray-500': 'hsl(208, 10%, 60%)',
        'gray-600': 'hsl(208, 10%, 50%)',
        'gray-700': 'hsl(208, 14%, 40%)',
        'gray-800': 'hsl(208, 18%, 28%)',
        'gray-900': 'hsl(208, 22%, 16%)',
      },
      flex: {
        'h-full': '1 0 auto',
      },
      fontSize: {
        '2xs': '0.6875rem',
        '2sm': '0.8125rem',
      },
      height: {
        '1/2-screen': '50vh',
      },
      inset: {
        '1/2': '50%',
      },
      maxWidth: {
        none: 'none',
        '400px': '400px',
        '500px': '500px',
        '600px': '600px',
        '700px': '700px',
        '1000px': '1000px',
      },
      padding: {
        '3/4': '75%',
      },
      spacing: {
        '2px': '2px',
      },
    },
    screens: {
      sm: '576px',
      md: '768px',
      lg: '992px',
      xl: '1200px',
      dark: { raw: '(prefers-color-scheme: dark)' },
    },
    container: {
      center: true,
      padding: '1rem',
    },
  },
  variants: {
    textColor: ['responsive', 'hover', 'focus', 'group-hover'],
    textDecoration: ['responsive', 'hover', 'focus', 'group-hover'],
  },
  plugins: [],
}
