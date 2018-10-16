(function(){function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s}return e})()({1:[function(require,module,exports){
/* main.js for photosynthesic
    varsion 0.2
*/
// var color = '#eee';
// var colors = [];

const vm = new Vue({ // eslint-disable-line
    el: '#app',
    filters: {
        moment: function (date) {
            return moment(date).format('YYYY/MM/DD HH:mm');// eslint-disable-line
        }
    },
    data: {
        isLoaded: false,
        isLoading: true,
        posts: []
    },
    created () {
        axios.get('/wp-json/wp/v2/posts?_embed&per_page=3')// eslint-disable-line
            .then(response => {
                this.isLoading = false;
                this.isLoaded = true;
                this.posts = response.data;
                getColor(response.data);// 色を取得
            }).catch(error => {
                console.error('error:', error);
            });
    }
});

// ドミナントカラーを配列に入れる
const getColor = (posts) => {
    for (const key in posts) {
        if (posts[key]._embedded['wp:featuredmedia']) { // キャッチ画像が設定されているなら
            // console.log('key:'+key+',id:'+posts[key].id);// eslint-disable-line
            var imgUrl = posts[key]._embedded['wp:featuredmedia'][0].media_details.sizes.thumbnail.source_url;
            RGBaster.colors(imgUrl, { // eslint-disable-line
                paletteSize: 3,
                success: function (colors) {
                    // vm.keyColors.push(colors.dominant);
                    // vm.keyColors.push({ id: post.id, dominant: colors.dominant });
                    // console.log('dcolor:'+colors.secondary);// eslint-disable-line
                    // vm.posts[key].dcolor = colors.dominant;
                    Vue.set(vm.posts[key], 'dcolor', colors.secondary);// eslint-disable-line
                    Vue.set(vm.posts[key], 'isColored', true);// eslint-disable-line
                }
            });
            // var dominant = getDominant(imgUrl)
            //     .then(response => {
            //         var thisColorinfo = {
            //             'id': post.id,
            //             'modified': post.modified,
            //             'dominant': dominant
            //         };
            //         console.log(thisColorinfo);// eslint-disable-line
            //     });
        } else {
            // console.log('画像なし');
            // vm.keyColors.push({ id: post.id, dominant: '#eee' });
            Vue.set(vm.posts[key], 'dcolor', '#eee');// eslint-disable-line
            Vue.set(vm.posts[key], 'isColored', true);// eslint-disable-line
        }
    }
};
// async function getDominant(imgUrl) {
//     RGBaster.colors(imgUrl, {
//         paletteSize: 3,
//         exclude: ['rgb(255,255,255)', 'rgb(0,0,0)'],
//         success: function (colors) {
//             console.log(colors);// eslint-disable-line
//             const dominant = await colors.dominant;
//         }
//     });
// }
// カラー取得
// const getDominant = async (imgURL) => {
//     const dominant = RGBaster.colors(imgURL, { // eslint-disable-line
//         paletteSize: 3,
//         success: await function (colors) {
//             console.log(colors);// eslint-disable-line
//             Promise.resolve({ 'dominant': colors.dominant });
//         }
//     });
//     return dominant;
// };

},{}]},{},[1]);
