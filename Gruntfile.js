/*
 * Generated on 2015-05-10
 * generator-assemble v0.5.0
 * https://github.com/assemble/generator-assemble
 *
 * Copyright (c) 2015 Hariadi Hinta
 * Licensed under the MIT license.
 */

'use strict';

// # Globbing
// for performance reasons we're only matching one level down:
// '<%= config.src %>/templates/pages/{,*/}*.hbs'
// use this if you want to match all subfolders:
// '<%= config.src %>/templates/pages/**/*.hbs'

module.exports = function(grunt) {

  require('time-grunt')(grunt);
  require('load-grunt-tasks')(grunt);

  // Project configuration.
  grunt.initConfig({

    config: {
      app: 'app',
      dist: 'dist'
    },

    watch: {
      pages: {
        files: ['<%= config.app %>/*.php'],
        tasks: ['copy:themeFiles']
      },
      templates: {
        files: ['<%= config.app %>/templates/{,*/}*.php'],
        tasks: ['copy:themeTemplates']
      },
      php: {
        files: ['<%= config.app %>/php/{,*/}*.php'],
        tasks: ['copy:themePHP']
      },
      sass: {
        files: ['<%= config.app %>/styles/sass/{,*/}*.scss'],
        tasks: ['sass', 'copy:themeCSS']
      },
      scripts: {
        files: ['<%= config.app %>/scripts/{,*/}*.js'],
        tasks: ['copy:themeJS']
      }
    },


    php: {
        dist: {
            options: {
                hostname: 'localhost',
                port: 3000,
                base: '<%= config.dist %>', // Project root
                keepalive: false,
                open: false
            }
        }
    },


    browserSync: {
        dist: {
            bsFiles: {
                src: [
                  '<%= config.dist %>/assets/{,*/}*.{css,js,php}'
                ]
            },
            options: {
                proxy: 'localhost:3000',
                watchTask: true,
                notify: true,
                open: true
            }
        }
    },






    copy: {
      themeFiles: {
        expand: true,
        cwd: '<%= config.app %>/',
        src: '*.{ico,html,php,txt}',
        dest: '<%= config.dist %>'
      },
      themeTemplates: {
        expand: true,
        cwd: '<%= config.app %>/templates/',
        src: '{,*/}*.{html,php}',
        dest: '<%= config.dist %>/assets/templates/'
      },
      themePHP: {
        expand: true,
        cwd: '<%= config.app %>/php/',
        src: '{,*/}*.{html,php}',
        dest: '<%= config.dist %>/assets/php/'
      },
      themeCSS: {
        expand: true,
        cwd: '<%= config.app %>/styles/',
        src: '{,*/}*.{css,map}',
        dest: '<%= config.dist %>/assets/css/'
      },
      themeJS: {
        expand: true,
        cwd: '<%= config.app %>/scripts/',
        src: '{,*/}*.js',
        dest: '<%= config.dist %>/assets/js/'
      },
      themeIMG: {
        expand: true,
        cwd: '<%= config.app %>/images/',
        src: '{,*/}*.{png,jpg,jpeg,gif,webp,svg}',
        dest: '<%= config.dist %>/assets/images/'
      },


      validate: {
        expand: true,
        cwd: 'bower_components/jquery-validation/dist',
        src: '**',
        dest: '<%= config.dist %>/assets/lib/jquery-validation'
      },
      bootstrap: {
        expand: true,
        cwd: 'bower_components/bootstrap/dist/',
        src: '**',
        dest: '<%= config.dist %>/assets/lib/bootstrap'
      },
      contentful: {
        expand: true,
        cwd: 'bower_components/contentful/dist/',
        src: '**',
        dest: '<%= config.dist %>/assets/lib/contentful'
      },
      slick: {
        expand: true,
        cwd: 'bower_components/slick.js/slick/',
        src: '**',
        dest: '<%= config.dist %>/assets/lib/slick'
      }
    },


    sass: {
      dist: {
        options: {
          style: 'expanded',
          require: 'susy'
        },
        files: {
          '<%= config.app %>/styles/main.css': '<%= config.app %>/styles/sass/main.scss'
        }
      }
    },

    // Before generating any new files,
    // remove any previously-created files.
    clean: ['<%= config.dist %>/**/*']

  });
  grunt.loadNpmTasks('grunt-contrib-sass');

  // grunt.registerTask('server', [
  //   'build',
  //   'connect:livereload',
  //   'watch'
  // ]);

  grunt.registerTask('build', [
    'clean',
    'sass',
    'copy'
  ]);

  grunt.registerTask('default', [
    'build'
  ]);

  grunt.registerTask('serve', [
    'build',
    'php:dist',
    'browserSync:dist',
    'watch'
  ]);

};
