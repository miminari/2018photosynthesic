# 2018photosynthesic

2018photosynthesic wordpress テーマ
シングルカラム

## テーマとしての使い方
ダウンロードしたファイルをWordPressのthemesディレクトリに入れたらそのまま使えます。
が、汎用性をあんまり考えていないのであしからず。

## Install
dev/ で

```npm install```

## Use

```npm run build```

でSASSのコンパイルとJSの書き出し

```npm run watch```

でSASSとJSの監視

```npm run release```

でリリース用のファイル（圧縮版）を出力

## SVGのインライン化
dev/svg/icons
にインライン化したいSVGファイルを入れ

```npm run prebuildsprite```

でSVGファイルを最適化

```mpm run svgsprite```

でSVGインライン化

### CSS内のインライン化

SCSSファイル内に

```svg-load('svg/dist/icons/angle-left.svg', fill=rgba($text-color,0.2));```

とか書くとwatchやreleaseをしたらインライン化されます。

## ざっくりコーディングガイドライン

* 基本的にIDにスタイルを振らない。（ボタンにアニメーションなど動きを付ける場合はOK）
* functions.phpで修正出来る範囲内で、wordpressのクラス名にスタイルを振らない。降る場合は親に.prefix-blockが少なくとも一つ指定していること。
* wordpressのコアファイルを触らない。
* cssのアニメーションは通常のスタイルとは別に分けて書く。
* モジュールの入れ子はアリです。

### 命名規則
SMACSSとBEMをベースに。

`prefix-block__element--modifier`

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
dev/scss以下にあります。
html5boilerplateをベースにしています。
* html5boilerplate/_normalize.scss --- normalizeです。触らないこと。
* _base.scss --- 基本触らない。タグに何か設定したい時はここに。
* _config.scss --- 設定
* _function.scss ---　関数はここにまとめる。
* _helper.scss --- 今回は使いません。
* modules/以下 --- 主要なモジュールをファイル分け。メディアクエリも入れます。
* _media.scss --- モジュール単位でないメディアクエリはここに。モバイルファーストの場合に使用。
* _print.scss --- 印刷用。
* style.scss --- メイン。小さいモジュールやレイアウト、ステータス、アニメーションはここ。
* editor-style.scss --- エディター用のスタイル

## Licence
2018photosynthesic WordPress Theme, Copyright 2018 Photosynthesic
2018photosynthesic is distributed under the terms of the GNU GPL.