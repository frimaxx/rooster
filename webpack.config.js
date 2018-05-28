var webpack = require('webpack');
var path = require('path');

var BUILD_DIR = path.resolve(__dirname, 'public/build/');
var APP_DIR = path.resolve(__dirname, 'resources/assets/js/');

var config = {
  entry: APP_DIR + '/index.jsx',
  output: {
    path: BUILD_DIR,
    filename: 'bundle.js'
  },
  module : {
    loaders : [
      {
        loader: 'babel-loader',
        test : /\.jsx?/,
        include : APP_DIR,
   	 query: {
                presets: ['es2015', 'react']
        }
      }
    ]
  }
};

module.exports = config;
