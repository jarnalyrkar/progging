const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');
const settings = require('./settings');


module.exports = {
  entry: {
    App: settings.themeLocation + "assets/js/scripts.js"
  },
  output: {
    path: path.resolve(__dirname, settings.themeLocation + "dist/js"),
    filename: "scripts-bundled.[hash].js"
  },
  module: {
    rules: [{
      test: /\.js$/,
      exclude: /node_modules/,
      use: {
        loader: 'babel-loader',
        options: {
          presets: ['@babel/preset-env']
        }
      }
    }]
  },
  mode: 'production',
  devtool: 'source-map',
  optimization: {
    minimize: true,
    minimizer: [new TerserPlugin()],
  },
}