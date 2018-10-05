/* main.js for photosynthesic
    varsion 0.2
*/
var color = '#eee';

var vm = new Vue({ // eslint-disable-line
    el: '#app',
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
            }).catch(error => {
                console.error('error:', error);
            });
    }
});
