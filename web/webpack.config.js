var Encore = require('@symfony/webpack-encore');

Encore
// the project directory where all compiled assets will be stored
    .setOutputPath('dist/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/dist')

    // will create web/build/app.js and web/build/app.css
    .addEntry('app', './assets/js/app.js')
    .addStyleEntry('style','./assets/scss/style.scss')
    .addEntry('admin-js', './assets/js/admin.js')
    .addStyleEntry('admin-style','./assets/scss/admin.scss')

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

    // create hashed filenames (e.g. app.abc123.css)
    .enableVersioning()

    // allow sass/scss files to be processed
    .enableSassLoader()
    .enablePostCssLoader((options) => {
        options.config = {
            path: 'app/config/postcss.config.js'
        };
    })
;

// export the final configuration
module.exports = Encore.getWebpackConfig();