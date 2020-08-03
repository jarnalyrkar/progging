var gulp = require('gulp'),
  settings = require('./settings'),
  webpack = require('webpack'),
  browserSync = require('browser-sync').create(),
  postcss = require('gulp-postcss'),
  rgba = require('postcss-hexrgba'),
  autoprefixer = require('autoprefixer'),
  forLoops = require('postcss-for'),
  cssvars = require('postcss-simple-vars'),
  nested = require('postcss-nested'),
  cssImport = require('postcss-import'),
  mixins = require('postcss-mixins'),
  atVariables = require('postcss-at-rules-variables'),
  hash = require('gulp-hash'),
  del = require('del'),
  clean = require('postcss-clean'),
  colorFunctions = require('postcss-color-function');

const isProduction = process.env.NODE_ENV !== 'development';
let hashOptions = {};
// const sourcemaps = require('gulp-sourcemaps');
if (isProduction) {
  hashOptions = {
    hashLength: 5,
    template: '<%= name %>.<%= hash %><%= ext %>'
  };
} else {
  hashOptions = {
    hashLength: 0,
    template: '<%= name %><%= ext %>'
  };
}


gulp.task('styles', function () {
  del(settings.themeLocation + 'dist/css/*.css');
  del(settings.themeLocation + 'dist/css/*.css.map');
  return gulp.src(settings.themeLocation + 'assets/css/style.css')
    .pipe(postcss([cssImport, mixins, forLoops, atVariables, cssvars, nested, rgba, colorFunctions, autoprefixer, clean]))
    .on('error', (error) => console.log(error.toString()))
    .pipe(hash(hashOptions))
    .pipe(gulp.dest(settings.themeLocation + 'dist/css'))
});

gulp.task('scripts', function (callback) {
  del(settings.themeLocation + 'dist/js/*.js');
  del(settings.themeLocation + 'dist/js/*.js.map');
  webpack(require('./webpack.config.js'), function (err, stats) {
    if (err) {
      console.log(err.toString());
    }

    console.log(stats.toString());
    callback();
  });
});

gulp.task('watch', function () {
  browserSync.init({
    notify: false,
    proxy: settings.urlToPreview,
    ghostMode: false,
    injectChanges: true,

  });

  gulp.watch('./**/*.php', function () {
    browserSync.reload();
    done();
  });
  gulp.watch('./**/*.twig', function () {
    browserSync.reload();
    done();
  });
  gulp.watch([settings.themeLocation + 'assets/css/**/*.css', settings.themeLocation + 'assets/css/style.css'], gulp.parallel('waitForStyles'));
  gulp.watch([settings.themeLocation + 'assets/css/**/*.scss', settings.themeLocation + 'assets/css/style.css'], gulp.parallel('waitForStyles'));
  gulp.watch([settings.themeLocation + 'assets/js/modules/*.js', settings.themeLocation + 'assets/js/scripts.js'], gulp.parallel('waitForScripts'));
});

gulp.task('waitForStyles', gulp.series('styles', function () {
  const src = gulp.src('**/*.css');
  if (isProduction) {
    browserSync.reload();
    done();
  } else {
    return gulp.src([settings.themeLocation + 'dist/css/*.css']).pipe(browserSync.stream());
  }
}));

gulp.task('waitForScripts', gulp.series('scripts', function (cb) {
  browserSync.reload();
  cb();
}));

gulp.task('minifycss', )