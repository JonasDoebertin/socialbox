var gulp       = require('gulp'),
    args       = require('yargs').argv,
    rename     = require('gulp-rename'),
    zip        = require('gulp-zip'),
    sass       = require('gulp-sass'),
    autoprefix = require('gulp-autoprefixer'),
    minifyCSS  = require('gulp-minify-css'),
    jshint     = require('gulp-jshint'),
    stylish    = require('jshint-stylish'),
    uglify     = require('gulp-uglify'),
    include    = require('gulp-include');


var releasePaths = [
    '**/*',
    '!{_src,_src/**}',
    '!{node_modules,node_modules/**}',
    '!.gitignore',
    '!composer.json',
    '!composer.lock',
    '!description.txt',
    '!gulpfile.js',
    '!ideas.txt',
    '!package.json',
    '!readme.md'
];

var releaseExtrasPaths = [
    'installation.txt',
    'license.txt'
];


/*
    Compile and minify SCSS
 */
gulp.task('css', function() {
    gulp.src('_src/scss/*.scss')
        .pipe(sass({errLogToConsole: true}))
        .pipe(autoprefix('last 2 versions', '> 1%', 'ie 8', 'ie 9'))
        .pipe(minifyCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest('assets/css'));
});


/*
    Task: Combine and uglify JS
 */
gulp.task('js', function() {
    return gulp.src('_src/js/*.js')
        .pipe(include())
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'))
        .pipe(jshint.reporter('fail'))
        .pipe(uglify())
        .pipe(gulp.dest('assets/js'));
});


/*
    Release a package
 */
gulp.task('release', ['css', 'js'], function() {

    /* Create package zip file */
    gulp.src(releasePaths)
        .pipe(rename(function(path) {
            path.dirname = 'socialbox/' + path.dirname;
        }))
        .pipe(zip('socialbox.zip'))
        .pipe(gulp.dest('_releases/' + args.tag));

    /* Copy license and installation instructions */
    gulp.src(releaseExtrasPaths)
        .pipe(gulp.dest('_releases/' + args.tag));
});

/*
    Watch tasks
 */
gulp.task('watch', function() {
    gulp.watch('_src/scss/**/*.scss', ['css']);
    gulp.watch('_src/js/**/*.js', ['js']);
});

/*
    Default task
 */
gulp.task('default', ['watch']);
