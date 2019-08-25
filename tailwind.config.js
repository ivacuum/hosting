module.exports = {
  theme: {
    extend: {
      colors: {
        light: '#f8f9fa',
      },
      flex: {
        'h-full': '1 0 auto',
      },
      fontSize: {
        '2xs': '0.6875rem',
      },
      height: {
        '1/2-screen': '50vh',
      },
      inset: {
        '1/2': '50%',
      },
      maxWidth: {
        '400px': '400px',
        '500px': '500px',
        '600px': '600px',
        '700px': '700px',
        '1000px': '1000px',
      },
      padding: {
        '3/4': '75%',
      },
    },
    screens: {
      sm: '576px',
      md: '768px',
      lg: '992px',
      xl: '1200px',
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
