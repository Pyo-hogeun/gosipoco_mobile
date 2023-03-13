'use strict';

var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
var plumber = require('gulp-plumber');

// scss
var sass = require('gulp-sass')(require('sass'));

var departureSrc = './src/';
var destinationSrc = './';

gulp.task('sass', function () {
	return gulp.src(departureSrc+'assets/scss/**/*.scss')
		.pipe(plumber())
		.pipe(sass())
		.pipe(gulp.dest(destinationSrc+'assets/style'))
		.pipe(browserSync.stream());
});

// gulp.task('scss', function () {
// 	return gulp.src(departureSrc+'assets/scss/**/*.scss')
// 		.pipe(plumber())
// 		.pipe(sass())
// 		.pipe(gulp.dest(destinationSrc+'assets/style'))
// 		.pipe(browserSync.stream());
// });

gulp.task('js', function () {
	return gulp.src(departureSrc+'assets/script/*.js')
		.pipe(plumber())
		.pipe(gulp.dest(destinationSrc+'assets/script'))
		.pipe(browserSync.stream());
});

gulp.task('html', function () {
	return gulp.src(destinationSrc + 'html/**/*.html')
		// .pipe(gulp.dest(destinationSrc+'html'))
		.pipe(browserSync.stream());
});

gulp.task('serve', async function () {

	browserSync.init({
		server: './',
		port: 8081
	});

	gulp.watch([departureSrc+"assets/scss/**/*.scss"], gulp.series('sass'));
	gulp.watch([departureSrc+"assets/script/*.js"], gulp.series('js'));;
	gulp.watch([destinationSrc+"html/**/*.html"], gulp.series('html'));
});

gulp.task('default', gulp.series('sass', 'js', 'serve' ));