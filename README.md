# 2018photosynthesic

2018photosynthesic wordpress テーマ

## Install
dev/ で
npm install

## Use
npm run build
でSASSのコンパイルとJSの書き出し

npm run watch
でSASSとJSの監視

npm run release
でリリース用のファイル（圧縮版）を出力

## ざっくりコーディングガイドライン

* 基本的にIDにスタイルを振らない。（ボタンにアニメーションなど動きを付ける場合はOK）
* functions.phpで修正出来る範囲内で、wordpressのクラス名にスタイルを振らない。降る場合は親に.prefix-blockが少なくとも一つ指定していること。
* wordpressのコアファイルを触らない。
* cssのアニメーションは通常のスタイルとは別に分けて書く。

### 命名規則
SMACSSとBEMをベースに。

prefix-block__element--modifier

でblockに接頭語を付けて区別

ex. l-global__header

* クラス名はwordressのクラス名と区別するために、BEM表記（prefix-block__element--modifier）でクラス名を作る。

#### 継承について
`.m-box`
`.m-box--large`
というボックスのモジュールを作った場合、`.md-box--large`は`.m-box`を`@extend`で継承する。

### prefix-

* l- --- Layout
* m- --- Module
* is- --- State
* t- --- Theme
* a- --- Animation

### CSS、SCSSの構成
html5boilerplateをベースにしています。
* html5boilerplate/_normalize.scss --- normalizeです。触らないこと。
* _base.scss --- 基本触らない。タグに何か設定したい時はここに。
* _function.scss ---　関数はここにまとめる。
* _helper.scss --- 今回は使いません。
* _media.scss --- メディアクエリはここに。モバイルファーストの場合に使用。
* _print.scss --- 印刷用。
* style.scss --- メイン。
