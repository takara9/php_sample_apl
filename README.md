# PHP + Db2 テスト用アプリ

このPHPのサンプル・アプリは、Bluemix上で PHPからDb2 をアクセスするためのサンプルコードです。
外部のセッション・ストアを利用せず、Bluemix のロードバランサー gorouter のセッション・アフィニティの機能でセッション情報を維持します。

## Db2 データベースのセットアップ

### Db2 Warehouse on Cloud
IBM Bluemix カタログから[Db2 wareHouse on Cloud](https://console.bluemix.net/catalog/services/db2-warehouse-on-cloud?region=ibm:yp:au-syd&env_id=ibm:yp:us-south&taxonomyNavigation=services)を作成します。

### clpplus 設定
Db2 Warehouse on Cloud の管理画面を開いて、Connection info のページから、Data Server Driver Package をダウンロードします。ドライバーのダウンロードと設定方法は、Qiita [PHP最新バージョン5.6系／7系からのDb2接続](http://qiita.com/MahoTakara/items/24cd9acd0249186ea617)に書いておきました。


### DBセットアップ
clpplus で Bb2へログインします。

~~~
clpplus -nw USERNAME@LABEL
~~~

次に、SQLを実行してテスト用データを作成します。

~~~
SQL> start ./setup.sql
~~~


## Bluemix デプロイへのセットアップ

### Buildpackの設定確認

2017/8/4現在のPHPの最新バージョン5.6.31, 7.1.7 からDb2と接続するために、cloudfoundry/php-buildpack https://github.com/cloudfoundry/php-buildpack を少しカスタマイズして利用します。　カスタマイズしたビルドパックは、高良がフォークした https://github.com/takara9/php_sample_apl にあります。

それから、Db2 のドライバーを組み込んだ PHP実行形式を 旧SoftLayer の Swift Object Storage に置いてあり、前述のビルドパックは、ダウンロードしてランタイムを構成します。


### manifest.yml の修正
この11行目の Db2のインスタンス名を変更します。Blumix CLI の bx cf services で調べることができます。

~~~
     1	applications:
     2	- path: .
     3	  memory: 64M
     4	  instances: 1
     5	  random-route: true
     6	  domain: mybluemix.net
     7	  name: phpSample
     8	  disk_quota: 512M
     9	  buildpack: https://github.com/takara9/php-buildpack
    10	services:
    11	- dashDB for Analytics-iq
~~~


## Bluemix へデプロイ

manifest.yml でパラメータを指定してあるので、次のコマンドでデプロイを実行できます。

~~~
bx cf push
~~~
 
これで、Bluemix から割り当てられたURLでアクセスすれば、サンプル・アプリで、動作を確認することができます。







