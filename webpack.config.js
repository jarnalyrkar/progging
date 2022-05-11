const path = require('path');
const TerserJSPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require('css-minimizer-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
module.exports = {
  plugins: [
    new BrowserSyncPlugin({
      proxy: 'statamic-boilerplate.test',
      host: 'localhost',
      port: 3000,
      notify: false,
      files: [
        './resources/views/*.antlers.html',
        './resources/views/**/*.antlers.html',
        './resources/views/**/**/*.antlers.html',
        './resources/scss/**/*.scss',
        './resources/scss/**/**/*.scss',
        './resources/scss/site.scss',
        './resources/javascript/**/*.js',
        './assets/javascript/site.js',
      ],
    }),
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: "css/site-[contenthash].css",
      ignoreOrder: false,
    }),
    new OptimizeCSSAssetsPlugin({}),
    new TerserJSPlugin({
      terserOptions: {
        output: {
          comments: false,
        },
      },
      extractComments: false,
    }),
  ],
  entry: ['./resources/javascript/site.js', './resources/scss/site.scss'],
  output: {
    filename: 'js/site-[contenthash].js',
    path: path.resolve('public/dist/')
  },
  module: {
    rules: [{
      test: /\.[c|s][s|a|c]ss?$/i,
      use: [
        MiniCssExtractPlugin.loader,
        {
          loader: 'css-loader',
          options: {
            url: false,
          }
        },
        {
          loader: 'sass-loader',
        }
      ],
    },
    {
      test: /\.js$/,
      exclude: /node_modules/,
      use: "babel-loader"
    }
    ]
  },
  mode: "production",
  watch: true,
};