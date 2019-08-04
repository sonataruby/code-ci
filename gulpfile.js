var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass        = require('gulp-sass');
var csso = require('gulp-csso');
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var del = require('del');
var less = require('gulp-less');
var cssmin = require('gulp-cssmin');
var concat = require('gulp-concat');


const AUTOPREFIXER_BROWSERS = [
  'ie >= 10',
  'ie_mob >= 10',
  'ff >= 30',
  'chrome >= 34',
  'safari >= 7',
  'opera >= 23',
  'ios >= 7',
  'android >= 4.4',
  'bb >= 10'
];

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
    return gulp.src(['node_modules/bootstrap/scss/bootstrap.scss', 'develop/scss/*.scss'])
        .pipe(sass({
	      outputStyle: 'nested',
	      precision: 10,
	      includePaths: ['.'],
	      onError: console.error.bind(console, 'Sass error:')
	    }))
        .pipe(autoprefixer({browsers: AUTOPREFIXER_BROWSERS}))
        .pipe(csso())
        .pipe(gulp.dest("libs/css"))
        .pipe(browserSync.stream());
});


gulp.task('less', function() {
    return gulp.src(['develop/less/*.less'])
        .pipe(less())
        //.pipe(autoprefixer({browsers: AUTOPREFIXER_BROWSERS}))
        //.pipe(concat('app.css'))
        .pipe(csso())
        .pipe(gulp.dest("libs/css"))
        .pipe(browserSync.stream());
});

gulp.task('cssmin', function() {
    return gulp.src(['develop/css/*.css'])
        .pipe(cssmin())
        //.pipe(autoprefixer({browsers: AUTOPREFIXER_BROWSERS}))
        .pipe(csso())
        .pipe(gulp.dest("libs/css"))
        .pipe(browserSync.stream());
});

// Move the javascript files into our /src/js folder
gulp.task('js', function() {

    gulp.src(['develop/js/*.js'])
        .pipe(uglify())
        .pipe(gulp.dest("libs/js"))
        .pipe(browserSync.stream());

    

   
    return gulp.src(['node_modules/jquery/dist/jquery.js', 'node_modules/popper.js/dist/umd/popper.js','node_modules/bootstrap/dist/js/bootstrap.js'])
    	.pipe(concat('app.js'))
    	.pipe(uglify())
        .pipe(gulp.dest("libs/js"))
        .pipe(browserSync.stream());
});

gulp.task('editer', function() {
    gulp.src(['node_modules/froala-editor/css/*.css','node_modules/froala-editor/css/*/*'])
        .pipe(cssmin())
        .pipe(csso())
        .pipe(gulp.dest("libs/editor/css"));
    gulp.src(['node_modules/froala-editor/js/*.js','node_modules/froala-editor/js/*/*'])
        .pipe(uglify())
        .pipe(gulp.dest("libs/editor/js"));
});
gulp.task('icons', function() { 
    del(['libs/icoins/*']);
    gulp.src(['node_modules/@fortawesome/fontawesome-free/webfonts/*'])
        .pipe(gulp.dest('libs/icoins/webfonts/'))

    return gulp.src(['node_modules/@fortawesome/fontawesome-free/css/all.css'])
        .pipe(concat('icoin.css'))
        .pipe(csso())
        .pipe(gulp.dest('libs/icoins/css/'))
        .pipe(browserSync.stream());
});

gulp.task('animate', function() { 
    
  
    return gulp.src(['node_modules/animate.css/animate.css'])
        .pipe(cssmin())
        .pipe(autoprefixer({browsers: AUTOPREFIXER_BROWSERS}))
        .pipe(csso())
        .pipe(gulp.dest('libs/css/'))
        .pipe(browserSync.stream());
});


gulp.task('clean', () => del(['libs/js/*.js', 'libs/css/*.css']));

gulp.task('default', gulp.series(['clean','js','less','sass','cssmin','icons'],function(done) { 
    // default task code here
    done();
}));