const path = require('path');

console.log(path.resolve('resources/js'));

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    devtool: "cheap-eval-source-map",
};
