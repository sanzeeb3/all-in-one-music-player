module.exports = {
	entry: './assets/js/admin/block.js',
	output: {
		path: __dirname,
		filename: 'assets/js/admin/block.min.js',
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
