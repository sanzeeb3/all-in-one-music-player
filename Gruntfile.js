/* jshint node:true */
module.exports = function( grunt ){
	'use strict';

	grunt.initConfig({

		// Store project settings.
		pkg: grunt.file.readJSON( 'package.json' ),

		// Generate POT files.
		makepot: {
			options: {
				type: 'wp-plugin',
				domainPath: 'languages',
				potHeaders: {
					'report-msgid-bugs-to': '',
					'language-team': 'LANGUAGE <EMAIL@ADDRESS>'
				}
			},
			dist: {
				options: {
					potFilename: 'all-in-one-music-player.pot',
					exclude: [
						'vendor/.*'
					]
				}
			}
		},

		// Compress files and folders.
		compress: {
			options: {
				archive: '<%= pkg.name %>.zip'
			},
			files: {
				src: [
					'**',
					'!.*',
					'!*.md',
					'!*.zip',
					'!.*/**',
					'!phpcs.xml',
					'!Gruntfile.js',
					'!package.json',
					'!composer.json',
					'!composer.lock',
					'!node_modules/**',
					'!package-lock.json',
					'!vendor/composer/installers/**',
					'!webpack.config.js',
				],
				dest: '<%= pkg.name %>',
				expand: true
			}
		}

	});

	// Load NPM tasks to be used here
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-contrib-compress' );
	grunt.registerTask( 'i18n', [
		'makepot',
		'compress'
	]);
};
