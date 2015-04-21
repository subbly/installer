// Gulp and utils
var gulp       = require('gulp'),
  gutil        = require('gulp-util'),
  size         = require('gulp-size'),
  rename       = require('gulp-rename'),
  watch        = require('gulp-watch'),
  notify       = require('gulp-notify'),
  sass         = require('gulp-ruby-sass'),
  minifycss    = require('gulp-minify-css'),
  prefix       = require('gulp-autoprefixer'),
  concat       = require('gulp-concat'),
  uglify       = require('gulp-uglify'),
  paths        = {
    bower: 'bower_components/',
    scss: 'sass/',
    css: 'css/',
    js: 'js/'
  };

// Styles
gulp.task('styles', function () {
  return sass(paths.scss, {
      sourcemap: false,
      style: 'expanded',
      stopOnError: false,
      trace: true
    })
    .on('error', gutil.log)
    .pipe(prefix({
      browsers: ['> 1%', 'last 2 version', 'Firefox 20'],
      cascade: false
    }))
    .on('error', gutil.log)
    .pipe(gulp.dest(paths.css))
    .pipe(size())
    .pipe(minifycss())
    .on('error', gutil.log)
    .pipe(size())
    .pipe(rename({
      suffix: '.min'
    }))
    .on('error', gutil.log)
    .pipe(gulp.dest(paths.css))
    .pipe(notify({
      message: '[Styles] <%= file.relative %> finished'
    }));
});

// Scripts
gulp.task('scripts', function () {
  console.log([
      paths.bower + 'jquery/dist/jquery.js',
      paths.js + 'main.js'
    ])
  return gulp.src([
      paths.bower + 'jquery/dist/jquery.js',
      paths.js + 'main.js'
    ])
    .pipe(concat('app.js'))
    .on('error', gutil.log)
    .pipe(gulp.dest(paths.js))
    .pipe(uglify())
    .on('error', gutil.log)
    .pipe(size())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest(paths.js))
    .pipe(notify({
      message: '[Scripts] <%= file.relative %> finished'
    }));
});

// Watch
gulp.task('watch', function () {
  // Watch .scss files
  gulp.watch(paths.scss + '*.scss', ['styles']);
  // Watch .js files
  gulp.watch(paths.js + '*.js', ['scripts']);
});

// Serve
gulp.task('serve', ['styles', 'scripts'], function () {
  gulp.start('watch');
});

// Build
gulp.task('build', ['styles', 'scripts']);

// Default task
gulp.task('default', ['serve']);
