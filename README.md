# Bluemix PHP + PostgreSQL テスト用アプリ

このPHPのサンプル・アプリは、Bluemix上で PHPからPostgreSQL をアクセスするためのサンプルコードです。
外部のセッション・ストアを利用せず、Bluemix のロードバランサー gorouter のセッション・アフィニティの機能でセッション情報を維持します。

## PostgreSQL データベースのセットアップ

### Compose for PostgreSQL サービスを作成
IBM Bluemix カタログから(Compose for PostgreSQL)[https://console.bluemix.net/catalog/services/compose-for-postgresql?env_id=ibm:yp:us-south&taxonomyNavigation=cf-apps]を作成します。

### PostgreSQLのパスワード設定
PostgreSQLのサービス資格情報の中から、PostgreSQLサーバーのパスワードを確認して、setup_db.sh のPASSWDに文字列をセットします。

### DBセットアップ
setup_db.shを実行して、データベースの作成、及び、サンプルデータをロードします。


## Bluemix デプロイへのセットアップ

### Buildpackの設定確認

このビルドパックは、CloudFoundry の https://github.com/cloudfoundry/php-buildpack または 高良がフォークした https://github.com/takara9/php_sample_apl を利用できます。どちらを利用しても差がありません。


### manifest.yml の修正
この11行目の MySQL のインスタンス名を変更します。PostgreSQLのインスタンス名は、CLI の bx cf services で調べることができます。

~~~
     1	applications:
     2	- path: .
     3	  memory: 64M
     4	  instances: 1
     5	  random-route: true
     6	  domain: mybluemix.net
     7	  name: phpSample
     8	  disk_quota: 1024M
     9	  buildpack: https://github.com/cloudfoundry/php-buildpack
    10	services:
    11	- Compose for PostgreSQL-4w
~~~


## Bluemix へデプロイ

manifest.yml でパラメータを指定してあるので、次のコマンドでデプロイを実行できます。

~~~
bx cf push
~~~
 
これで、Bluemix から割り当てられたURLでアクセスすれば、サンプル・アプリで、動作を確認することができます。








