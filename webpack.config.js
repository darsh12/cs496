var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .autoProvidejQuery()

    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    .addEntry('js/card-catalog', './public/js/card-catalog.js')
    // .addEntry('js/app', './assets/js/app.js')
    // .addStyleEntry('css/app', './assets/css/app.scss')

    // uncomment if you use Sass/SCSS files
    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: false
    });

    module.exports = {
        module: {
            loaders: [
                // the url-loader uses DataUrls.
                // the file-loader emits files.
                { test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/, loader: "url-loader?limit=10000&mimetype=application/font-woff" },
                { test: /\.(ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/, loader: "file-loader" }
            ]
        }
    };
;

module.exports = Encore.getWebpackConfig();
