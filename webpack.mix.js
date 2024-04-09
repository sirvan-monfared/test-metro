const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.options({
    // Don't perform any css url rewriting by default
    processCssUrls: false,
})

mix.js("resources/js/routes", "public/application");
// mix.js("resources/front/js/custom.js", "public/front/js/");

mix.js('resources/js/vue.js', 'public/application')
   .js('resources/js/vue-front.js', 'public/application')
   .vue().version();

mix.sass('resources/admin/sass/app.scss', 'public/admin/css/app.css')
    .combine([
        'resources/admin/plugins/global/plugins.bundle.js',
        'resources/admin/js/scripts.bundle.js'
    ], 'public/admin/js/app.js');


    // new template
mix.postCss('resources/front/css/new-theme/app-new.css', 'public/front/css/new-theme', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]).version();

mix.copy('node_modules/sticky-js/dist/sticky.min.js', 'public/front/vendor/sticky/sticky.min.js')
