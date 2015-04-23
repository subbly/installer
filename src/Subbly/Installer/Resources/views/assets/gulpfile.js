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
  base64       = require('gulp-base64'),
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
    .on('error', gutil.log)
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
  return gulp.src([
      paths.bower + 'jquery/dist/jquery.js',
      paths.bower + 'smooth-scroll.js/dist/js/smooth-scroll.js',
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

// Base64 encode
gulp.task('base64', function () {
  return gulp.src(paths.css + 'app.min.css')
    .pipe(base64({
      debug: true
    }))
    .on('error', gutil.log)
    .pipe(concat('app.min.css'))
    .pipe(gulp.dest(paths.css))
    .pipe(notify({
      message: '[Base64] <%= file.relative %> finished'
    }));
});

// Watch
gulp.task('watch', function () {
  // Watch .scss files
  gulp.watch(paths.scss + '*.scss', ['styles']);
  // Watch .js files
  gulp.watch(paths.js + 'main.js', ['scripts']);
});

// Serve
gulp.task('serve', ['styles', 'scripts'], function () {
  gulp.start('watch');
});

// Build
gulp.task('build', ['styles', 'scripts'], function () {
  return gulp.start('base64');
});

// Default task
gulp.task('default', ['serve']);
