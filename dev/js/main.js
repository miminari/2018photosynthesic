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
        // keyColors: []
    },
    created () {
        axios.get('/wp-json/wp/v2/posts?_embed&per_page=3')// eslint-disable-line
            .then(response => {
                this.isLoading = false;
                this.isLoaded = true;
                this.posts = response.data;
                getColor(response.data);
            }).catch(error => {
                console.error('error:', error);
            });
    }
});

// ドミナントカラーを配列に入れる
const getColor = (posts) => {
    axios.get('/wordpress/wp-content/themes/2018photosynthesic/js/color.json')// eslint-disable-line
        .then(response => { // JSONあり
            if (response.data) {
            console.log('でーたあり');// eslint-disable-line
            } else { // 初回だけドミナントカラー取得
            console.log('でーたなし');// eslint-disable-line
            console.log(posts);// eslint-disable-line
                posts.forEach(post => {
                    if (post._embedded['wp:featuredmedia']) { // キャッチ画像が設定されているなら
                        var imgUrl = post._embedded['wp:featuredmedia'][0].source_url;
                        var dominant = getDominant(imgUrl,dominant)
                            .then(dominant => {
                                thisColorinfo = {
                                    'id': post.id,
                                    'modified': post.modified,
                                    'dominant': dominant
                                };
                                console.log(thisColorinfo);// eslint-disable-line
                            }).catch(error => {
                                console.log('error:', error);// eslint-disable-line
                            });
                    } else {
                        console.log('画像なし');// eslint-disable-line
                    }
                });
            }
        }).catch(error => { // JSON読み込みエラー
        console.log('error:', error);// eslint-disable-line
        console.log(colors);// eslint-disable-line
        });
};

// ドミナントカラー取得
const getDominant = (imgUrl,dominant) => {
    const colors = RGBaster.colors(imgUrl, { // eslint-disable-line
        paletteSize: 3,
        exclude: ['rgb(255,255,255)', 'rgb(0,0,0)'],
        success: function (colors) {
            console.log(colors);// eslint-disable-line
            dominant = { 'dominant': colors.dominant };
        }
    });
};
