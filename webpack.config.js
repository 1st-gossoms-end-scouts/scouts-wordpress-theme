module.exports = {
  entry: './theme/jsx/gutenberg.js',
  output: {
    filename: './theme/js/gutenberg.js',
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