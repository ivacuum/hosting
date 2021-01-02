const path = require('path')

module.exports = {
  output: {
    chunkFilename: 'assets/chunk-[name].js?id=[chunkhash]',
  },
  resolve: {
    alias: {
      '@': path.resolve('resources/js'),
    },
  },
}
