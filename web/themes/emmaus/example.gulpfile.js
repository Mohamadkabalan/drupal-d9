'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync');
const reload = browserSync.reload;
const mode = require('gulp-mode')({
  modes: ["prod", "dev"],
  default: "prod",
  verbose: false
});

// Build tasks.
function style() {
  return gulp.src('sass/**/*.scss')
    .pipe(mode.dev(sourcemaps.init())) // Use "gulp style --dev" for sourcemaps
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['last 2 versions']
    }))
    .pipe(mode.dev(sourcemaps.write()))
    .pipe(gulp.dest('css'))
    .pipe(browserSync.reload({
      stream: true
    }))
    ;
}

// Watch & Build tasks.
// Use "gulp watch --dev" for sourcemaps
function watchFiles() {
  var files = [
    'css/style.css',
    'js/**/*.js',
    'images/**/*',
    'templates/**/*.twig',
    '*.twig'
  ];
  browserSync.init({
    proxy: "d8starter.docksal"
  });
  gulp.watch('./sass/**/*.scss', style);
  gulp.watch(files).on('change', browserSync.reload)
}

const watch = gulp.series(style, watchFiles);

exports.style = style;
exports.css = style;
exports.build = style;
exports.watch = watch;
