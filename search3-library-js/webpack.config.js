var webpack = require('webpack');
var path = require('path');
// build library
var BUILD_DIR = path.resolve(__dirname, '../../public/admin/js/');

// source file location
var APP_DIR = path.resolve(__dirname, 'src');

var config = {
  entry: './src/index.js',
  output: {
    path: BUILD_DIR,
    filename: 'product_builder_bundle.js'
  },

  module : {
    loaders : [
      {
        test : /\.js?/,
        include : APP_DIR,
        loader : 'babel-loader'
      }
    ]
  },

  resolve: {
     modules: [
        "node_modules",
        APP_DIR
    ]
  },
};
 
module.exports = config;