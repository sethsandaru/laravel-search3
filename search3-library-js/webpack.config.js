var webpack = require('webpack');
var path = require('path');
// build library
var BUILD_DIR = path.resolve(__dirname, '../assets/js/bundles');

// source file location
var APP_DIR = path.resolve(__dirname, 'src');

var config = {
    entry: {
        template: "./src/template.js",
        gui: "./src/gui.js",
    },
    output: {
        path: BUILD_DIR,
        filename: '[name]_bundle.js'
    },

    module: {
        loaders: [
            {
                test: /\.js?/,
                include: APP_DIR,
                loader: 'babel-loader'
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