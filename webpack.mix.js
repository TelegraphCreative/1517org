let mix = require('laravel-mix')
require('laravel-mix-tailwind')

mix.setPublicPath('./web')

    // The App Build
    .js('resources/js/app.js', 'assets/js')
    .sass('resources/scss/app.scss', 'assets/css')
    .sass('resources/scss/styleguide.scss', 'assets/css')
    .copy('resources/fonts', './web/assets/fonts')
    .sourceMaps()
    .browserSync({
        proxy: '1517org.test',
        files: [
            './templates/**/*.twig',
            './web/css/**/*.css',
            './web/js/**/*.js',
        ],
    })
    .tailwind()
    .version()
