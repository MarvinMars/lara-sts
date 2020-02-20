let mix = require('laravel-mix');
const webpack = require('webpack');

let webpackConfig = {
    resolve: {
        //Add aliases for the external libraries here
        alias: {},
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
            Popper: 'popper.js/dist/umd/popper.js',
        }),
    ],
};

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/frontend.scss', 'public/css')
    .version();


mix.webpackConfig(webpackConfig);