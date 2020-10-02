var Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')

    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()

    .addEntry('bonus-vue', './assets/bonus/ComposeApp.js')
    .addEntry('homepage', './assets/homepage/Compose.js')
    .addEntry('general', './assets/general/Compose.js')
    .addEntry('feed', './assets/feed/Compose.js')
    .splitEntryChunks()

    .enableVueLoader()
    .enableSingleRuntimeChunk()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    .enableTypeScriptLoader()
    .enableStylusLoader()
    .enableIntegrityHashes(Encore.isProduction())
    .autoProvidejQuery()
;


module.exports = Encore.getWebpackConfig();
