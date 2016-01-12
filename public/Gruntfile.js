module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    //
    sass: {
      dist: {
        options:{
          sourcemap: 'none'
        },
        files: {
          'css/style.css': 'css/sass/style.scss',
          'css/style-ie.css': 'css/sass/style-ie.scss'
        }
      }
    },
    //
    postcss: {
      modern: {
        options: {
          processors: [
            require('autoprefixer-core')({browsers: 'last 2 versions'})//,
            //require('cssnano')() // minify the result
          ]
        },
        src: 'css/style.css',
        dest: 'css/style.css'
      },
      oldIE: {
        options: {
          processors: [
            require('autoprefixer-core')({browsers: 'ie 8'}),
            require('postcss-opacity')//, // plugin for ie8 compatible opacity
            //require('cssnano')() // minify the result
          ]
        },
        src: 'css/style-ie.css',
        dest: 'css/style-ie.css'
      }

    },
    //
    watch: {
      css: {
        files: 'css/sass/*.scss',
        tasks: ['sass','postcss']
      }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-postcss'); // Postcss plugins - https://www.npmjs.com/search?q=postcss
  grunt.loadNpmTasks('grunt-contrib-watch');
  //
  grunt.registerTask('default',['watch']);
  //
  grunt.registerTask('modern',['postcss:modern']);
  grunt.registerTask('oldIE',['postcss:oldIE']);
};
