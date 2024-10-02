const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
  transpileDependencies: true,
  publicPath: process.env.NODE_ENV === 'production'
  ? 'https://mostafamahmoud055.github.io/car_shop' // Replace with your repository name
  : '/'
});
