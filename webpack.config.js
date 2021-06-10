module.exports = {
	entry: './assets/js/block/block.js',
	output: {
		path: __dirname,
		filename: 'assets/js/block/block.min.js',
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
