(function(){function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s}return e})()({1:[function(require,module,exports){
/* main.js for photosynthesic
    varsion 0.2
*/
// var color = '#eee';

var vm = new Vue({ // eslint-disable-line
    el: '#app',
    filters: {
        moment: function (date) {
            return moment(date).format('YYYY/MM/DD HH:mm');// eslint-disable-line
        }
    },
    data: {
        isLoaded: false,
        isLoading: true,
        posts: [],
        keyColors: []
    },
    created () {
        axios.get('/wp-json/wp/v2/posts?_embed&per_page=3')// eslint-disable-line
            .then(response => {
                this.isLoading = false;
                this.isLoaded = true;
                this.posts = response.data;
                /*
                response.data.forEach(post => {
                    if (post._embedded['wp:featuredmedia']) { // キャッチ画像が設定されているなら
                        var imgUrl = post._embedded['wp:featuredmedia'][0].source_url;
                        var colors = RGBaster.colors(imgUrl, { // eslint-disable-line
                            paletteSize: 3,
                            exclude: ['rgb(255,255,255)', 'rgb(0,0,0)'],
                            success: function (colors) {
                                var dominant = colors.palette[0];
                                console.log(typeof dominant);// eslint-disable-line
                                this.keyColors.push(dominant);
                            }
                        });
                    } else {
                        this.keyColors.push(color);
                    }
                });
                console.log(this.keyColors);// eslint-disable-line
                */
            }).catch(error => {
                console.error('error:', error);
            });
    }
});

},{}]},{},[1]);
