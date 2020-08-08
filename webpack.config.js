const path = require('path');
const TerserJSPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
module.exports = {
	plugins: [
		new BrowserSyncPlugin({
      proxy: 'progging.test',
			host: 'localhost',
      port: 3000,
      notify: false,
			files: [
				'./*.php',
				'./inc/*.php',
				'./views/**/*.twig',
				'./assets/scss/**/*.scss',
				'./assets/scss/style.scss',
				'./assets/javascript/**/*.js',
				'./assets/javascript/scripts.js',
			],
    }),
    new CleanWebpackPlugin(),
		new MiniCssExtractPlugin({
      filename: "css/style.[hash].css",
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
	entry: ['./assets/javascript/scripts.js', './assets/scss/style.scss'],
	output: {
		filename: 'js/bundle.[hash].js',
		path: path.resolve('dist/')
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