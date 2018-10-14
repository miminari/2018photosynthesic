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
    axios.get('/wordpress/wp-content/themes/2018photosynthesic/js/color.json')// eslint-disable-line
        .then(response => { // JSONあり
            if (response.data) {
            console.log('でーたあり');// eslint-disable-line
            } else { // 初回だけドミナントカラー取得
            console.log('でーたなし');// eslint-disable-line
                // posts.forEach(post => {
                for (const key in posts) {
                    if (posts[key]._embedded['wp:featuredmedia']) { // キャッチ画像が設定されているなら
                        console.log('key:'+key+',id:'+posts[key].id);// eslint-disable-line
                        var imgUrl = posts[key]._embedded['wp:featuredmedia'][0].source_url;
                        RGBaster.colors(imgUrl, { // eslint-disable-line
                            paletteSize: 3,
                            success: function (colors) {
                                // vm.keyColors.push(colors.dominant);
                                // vm.keyColors.push({ id: post.id, dominant: colors.dominant });
                                console.log('dcolor:'+colors.dominant);// eslint-disable-line
                                vm.posts[key].dcolor = colors.dominant;
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
                        console.log('画像なし');// eslint-disable-line
                        // vm.keyColors.push({ id: post.id, dominant: '#eee' });
                        vm.posts[key].dcolor = '#eee';
                    }
                }
            }
        }).catch(error => { // JSON読み込みエラー
            console.error('error:', error);
        });
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
