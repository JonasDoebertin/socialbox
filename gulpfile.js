var gulp       = require('gulp'),
    args       = require('yargs').argv,
    rename     = require('gulp-rename'),
    zip        = require('gulp-zip'),
    sass       = require('gulp-sass'),
    autoprefix = require('gulp-autoprefixer'),
    minifyCSS  = require('gulp-minify-css');


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
    Release a package
 */
gulp.task('release', ['css'], function() {

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
});

/*
    Default task
 */
gulp.task('default', ['watch']);
