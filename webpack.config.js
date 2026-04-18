const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'development');
}

Encore
    .addEntry('app', './assets/js/app.js')
    .addEntry('app.ga', './assets/js/GA.js')
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSingleRuntimeChunk()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .addLoader({
        test: /\.(mp4|webm|ogg)$/,
        type: 'asset/resource',
        generator: { filename: '[name].[contenthash][ext]' },
    })
;

module.exports = Encore.getWebpackConfig();
