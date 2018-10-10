/* main.js for photosynthesic
    varsion 0.2
*/
var color = '#eee';

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
                // ドミナントカラーを配列に入れる
                axios.get('/wordpress/wp-content/themes/2018photosynthesic/js/color.json')// eslint-disable-line
                    .then(response => { // JSONあり
                        console.log(response.data);// eslint-disable-line
                    }).catch(error => { // 初回だけドミナントカラー取得
                        console.log('error:', error);// eslint-disable-line
                        this.posts.forEach(post => {
                            if (post._embedded['wp:featuredmedia']) { // キャッチ画像が設定されているなら
                                var imgUrl = post._embedded['wp:featuredmedia'][0].source_url;
                                var colors = RGBaster.colors(imgUrl, { // eslint-disable-line
                                    paletteSize: 3,
                                    exclude: ['rgb(255,255,255)', 'rgb(0,0,0)'],
                                    success: function (colors) {
                                        var dominant = colors.palette[0];
                                        console.log(dominant);// eslint-disable-line
                                        // json に保存
                                    }
                                });
                            } else {
                                this.keyColors.push(color);
                            }
                        });
                    });
            }).catch(error => {
                console.error('error:', error);
            });
    }
});

