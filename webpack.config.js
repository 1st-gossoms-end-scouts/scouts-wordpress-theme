var path = require( 'path' );

module.exports = {
  entry: {
    gutenberg: './theme/jsx/gutenberg.js',
  },
  output: {
    path: path.resolve(__dirname, 'theme/js'),
    filename: '[name].js'
  },
  module: {
    loaders: [
      {
        test: /.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
      },
    ],
  },
};