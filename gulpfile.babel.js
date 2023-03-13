import { src, dest, watch, series, parallel } from 'gulp';
import yargs from 'yargs';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
const PRODUCTION = yargs.argv.prod;
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';
import del from 'del';
import webpack from 'webpack-stream';
import named from 'vinyl-named';
import browserSync from "browser-sync";

// Add Browser Sync Functionality
const server = browserSync.create();
export const serve = done => {
  server.init({
    proxy: "https://becomeunmistakeable:8890"
  });
  done();
};
export const reload = done => {
  server.reload();
  done();
};

// Create a single css file that is cleaned and sourcemapped
export const styles = () => {
  return src('src/scss/bundle.scss')
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass().on('error', sass.logError))
    .pipe(gulpif(PRODUCTION, postcss([ autoprefixer ])))
    .pipe(gulpif(PRODUCTION, cleanCss({compatibility:'ie8'})))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest('dist/css'))
    .pipe(server.stream());
}

// Create a single css file that is cleaned and sourcemapped
export const blockstyle = () => {
  return src('blocks/**/**/*.scss')
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass().on('error', sass.logError))
    .pipe(gulpif(PRODUCTION, postcss([ autoprefixer ])))
    .pipe(gulpif(PRODUCTION, cleanCss({compatibility:'ie8'})))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest('./blocks'))
    .pipe(server.stream());
}

// Minify and move images added to src/images over to dist/images
export const images = () => {
  return src('src/images/**/*.{jpg,jpeg,png,svg,gif}')
    .pipe(gulpif(PRODUCTION, imagemin()))
    .pipe(dest('dist/images'));
}

// Copy files from src to dist if they aren't handled by our other tasks
export const copy = () => {
  return src(['src/**/*','!src/{images,js,scss}','!src/{images,js,scss}/**/*'])
    .pipe(dest('dist'));
}

// Clean Up The Dist Folder So Deleted Files Don't Remain
export const clean = () => del(['dist']);

// For all files in the array: "src([])" Compile ES6 and add to dist folder
export const blockscript = () => {
  return src(['blocks/layout/**/*.js'])
  .pipe(named())
  .pipe(webpack({
    module: {
      rules: [
        {
          test: /\.js$/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env']
            }
          }
        }
      ]
    },
    mode: PRODUCTION ? 'production' : 'development',
    devtool: !PRODUCTION ? 'inline-source-map' : false,
    output: {
      filename: '[name].js'
    },
  }))
  .pipe(dest('blocks/dist/js/'));
}

// For all files in the array: "src([])" Compile ES6 and add to dist folder
export const scripts = () => {
  return src(['src/js/bundle.js'])
  .pipe(named())
  .pipe(webpack({
    module: {
      rules: [
        {
          test: /\.js$/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env']
            }
          }
        }
      ]
    },
    mode: PRODUCTION ? 'production' : 'development',
    devtool: !PRODUCTION ? 'inline-source-map' : false,
    output: {
      filename: '[name].js'
    },
  }))
  .pipe(dest('dist/js'));
}

// Watch Relevant Files for Changes
export const watchForChanges = () => {
  watch('src/scss/**/*.scss', styles);
  watch('blocks/**/**/*.scss', blockstyle);
  watch('src/images/**/*.{jpg,jpeg,png,svg,gif}', series(images, reload));
  watch(['src/**/*','!src/{images,js,scss}','!src/{images,js,scss}/**/*'], series(copy, reload));
  watch('src/js/**/*.js', series(scripts, reload));
  watch('blocks/layout/**/*.js', series(blockscript, reload));
  watch("**/*.php", reload);
}

// Create a chain of tasks for our singular tasks above
export const dev = series(clean, parallel(styles, blockstyle, images, copy, scripts), serve, watchForChanges)
export const build = series(clean, parallel(styles, blockstyle, images, copy, scripts))
export default dev;


// call: 'npm start' for development - this is defined in package.json
// call: 'npm run build' for production - this is defined in package.json

// Created Using Steps Here:
// https://css-tricks.com/gulp-for-wordpress-initial-setup/
// https://css-tricks.com/gulp-for-wordpress-creating-the-tasks/
