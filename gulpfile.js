const gulp = require("gulp");
const uglify = require("gulp-uglify");
var concat = require('gulp-concat');
var autoprefixer = require('gulp-autoprefixer');
var minifyCSS = require('gulp-minify-css');

/** JS FILES */
var js = [
    './assets/js/vue.min.js',    
    './assets/js/axios.min.js',    
    './assets/js/jquery.3.2.1.js',
    './assets/js/popper.min.js',
    './assets/js/bootstrap.min.js',        
    './assets/js/datatables.min.js',
    './assets/js/jquery.validate.js',
    './assets/js/jquery.mask.js',
    './assets/js/sweetalert.min.js',
    './assets/js/main.js'
]

gulp.task('js', function() {
    return gulp.src(js)
        .pipe(concat('build.js'))        
        .pipe(uglify())
        .pipe(gulp.dest('assets/js'));
});

/** CSS FILES */
let css = [
    './assets/css/normalize.css',
    './assets/css/font-awesome.min.css',
    './assets/css/styles.css',
    './assets/css/animate.css',
    './assets/css/datatables.min.css',
]

gulp.task('css', function() {
    return gulp.src(css)
        .pipe(minifyCSS())
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
        .pipe(concat('build.css'))
        .pipe(gulp.dest('./assets/css'))
});

