module.exports = {
  prefix: 'tw-',
  theme: {
    extend: {
      fontSize: {
        '2xs': '0.6875rem',
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
