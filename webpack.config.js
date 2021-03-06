var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    //.addEntry('app', './assets/js/app.js')
    .addEntry('js/common', './assets/js/common.js')
    .addEntry('js/app',
        [
            './assets/js/app.js',
            './node_modules/jquery/dist/jquery.min.js',
            './node_modules/popper.js/dist/popper.min.js',
            './node_modules/bootstrap/dist/js/bootstrap.min.js',
            './node_modules/holderjs/holder.min.js',
            './node_modules/sweetalert/dist/sweetalert.min.js',
        ])
    .addStyleEntry('css/app',
        ['./node_modules/bootstrap/dist/css/bootstrap.min.css'])
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')

    .cleanupOutputBeforeBuild()
    .autoProvidejQuery() //ojo para jquery
    .enableSourceMaps(!Encore.isProduction())

;

module.exports = Encore.getWebpackConfig();
