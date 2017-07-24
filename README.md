# PHP + MySQL テスト用アプリ ClearDB版

このPHPのサンプル・アプリは、Bluemix上で PHPからMySQL をアクセスするためのサンプルコードです。
外部のセッション・ストアを利用せず、Bluemix のロードバランサー gorouter のセッション・アフィニティの機能でセッション情報を維持します。

## MySQLデータベースのセットアップ

### Compose for MySQL サービスを作成
IBM Bluemix カタログから(ClearDB Managed MySQL Database)[https://console.bluemix.net/catalog/services/cleardb-managed-mysql-database?env_id=ibm:yp:us-south&taxonomyNavigation=cf-apps]を作成します。

### MySQLのパスワード設定
MySQLのサービス資格情報の中から、MySQLサーバーのパスワードを確認して、setup_db.sh のPASSWDにに文字列をセットします。

### DBセットアップ
setup_db.shを実行して、データベースの作成、及び、サンプルデータをロードします。


## Bluemix デプロイへのセットアップ

### Buildpackの設定確認

このビルドパックは、CloudFoundry の https://github.com/cloudfoundry/php-buildpack または 高良がフォークした https://github.com/takara9/php_sample_apl を利用できます。どちらを利用しても差がありません。


### manifest.yml の修正
この11行目の MySQL のインスタンス名を変更します。MySQLのインスタンス名は、CLI の bx cf services で調べることができます。

~~~
     1	applications:
     2	- path: .
     3	  memory: 64M
     4	  instances: 2
     5	  random-route: true
     6	  domain: mybluemix.net
     7	  name: phpSample
     8	  disk_quota: 1024M
     9	  buildpack: https://github.com/cloudfoundry/php-buildpack
    10	services:
    11	- 
~~~


## Bluemix へデプロイ

manifest.yml でパラメータを指定してあるので、次のコマンドでデプロイを実行できます。

~~~
bx cf push
~~~
 
これで、Bluemix から割り当てられたURLでアクセスすれば、サンプル・アプリで、動作を確認することができます。








