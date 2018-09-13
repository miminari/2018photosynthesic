const imagemin = require('imagemin');
const imageminSvgo = require('imagemin-svgo');

imagemin(['svg/icons/*.svg'], 'svg/dist/icons/', {
  use: [
    imageminSvgo({
      plugins: [
        {cleanupIDs: {remove: false}},
        {cleanupNumericValues: {floatPrecision: 2}},
        {removeViewBox: false},
        {removeStyleElement: true},
        {removeTitle: true}
      ],
      multipass: true
    })
  ]
}).then(function () {
  console.log('SVG-Icons were successfully optimized');
});
