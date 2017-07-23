# Bluemix PHP + MySQL テスト用アプリ

このサンプルは、redis のパスワードをクリア・テキストでインターネットへ送信するというアンチパターンのため、実際に実行することは、お勧めできません。

## MySQLデータベースのセットアップ

### Compose for MySQL サービスを作成
IBM Bluemix カタログから(Compose for MySQL)[https://console.bluemix.net/catalog/services/compose-for-mysql?env_id=ibm:yp:us-south&taxonomyNavigation=apps]を作成します。

### MySQLのパスワード設定
MySQLのサービス資格情報の中から、MySQLサーバーのパスワードを確認して、setup_db.sh のPASSWDにに文字列をセットします。

### DBセットアップ
setup_db.shを実行して、データベースの作成、及び、サンプルデータをロードします。


## セッション・ストアのセットアップ

### Compose for Redis サービスを作成
IBM Bluemix カタログから(Compose for Redis)[https://console.bluemix.net/catalog/services/compose-for-redis?env_id=ibm:yp:us-south&taxonomyNavigation=apps]を作成します。

### store_encrypter.php にパスワードを設定

本来ならば、環境変数から取得するべきものですが、アンチパターンで力が入らないので、Bluemixのサービス資格を参照して、auth=をセットします。

~~~
ini_set('session.save_path','tcp://sl-us-south-1-portal.5.dblayer.com:18638?auth=****************');
~~~


## Bluemix デプロイへのセットアップ

### Buildpackの設定確認

このビルドパックは、CloudFoundry の https://github.com/cloudfoundry/php-buildpack または 高良がフォークした https://github.com/takara9/php_sample_apl を利用できます。どちらを利用しても差がありません。

### 設定オーバーライド .bp-config/options.json

redis をセッション・ストアとして利用するために、.bp-config/options.json に設定を追加しています。追加するモジュールは、mbstring 以降の5個です。 これは、デプロイ時に、php.ini に設定としてモジュールが追加されます。　それから、PHPのバージョンを7系の最新版にします。

~~~
{
    "PHP_EXTENSIONS": ["bz2", "zlib", "curl", "mcrypt", "mbstring", "pdo", "pdo_mysql", "openssl", "redis" ],
    "PHP_VERSION": "{PHP_71_LATEST}"
}
~~~


### manifest.yml の修正
この11行目と12行目の MySQL と Reids のインスタンス名を変更します。MySQLとRedisのインスタンス名は、CLI の bx cf services で調べることができます。

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
    11	- Compose for MySQL-ne
    12	- Compose for Redis-44
~~~


## Bluemix へデプロイ

manifest.yml でパラメータを指定してあるので、次のコマンドでデプロイを実行できます。

~~~
imac:php_sample_apl maho$ bx cf push
'cf push' を起動しています...

マニフェスト・ファイル /Users/maho/bluemix/php_sample_apl/manifest.yml を使用しています

tkr9955@yahoo.co.jp として組織 試験 / スペース dev 内のアプリ phpSample を更新しています...
OK

経路 phpsample-skiech-inkie.mybluemix.net を作成しています...
OK

phpsample-skiech-inkie.mybluemix.net を phpSample にバインドしています...
OK

phpSample をアップロードしています...
次のパスからアプリ・ファイルをアップロードしています: /Users/maho/bluemix/php_sample_apl
9.2K、18 個のファイルをアップロードしています
Done uploading               
OK
tkr9955@yahoo.co.jp としてサービス Compose for MySQL-ne を組織 試験 / スペース dev 内のアプリ phpSample にバインドしています...
OK
tkr9955@yahoo.co.jp としてサービス Compose for Redis-44 を組織 試験 / スペース dev 内のアプリ phpSample にバインドしています...
OK

tkr9955@yahoo.co.jp として組織 試験 / スペース dev 内のアプリ phpSample を停止しています...
OK

tkr9955@yahoo.co.jp として組織 試験 / スペース dev 内のアプリ phpSample を開始しています...
Creating container
Successfully created container
Downloading app package...
Downloaded app package (8.7K)
Downloading build artifacts cache...
Downloaded build artifacts cache (202B)
Staging...
-------> Buildpack version 4.3.38
HTTPD 2.4.27
Installing HTTPD
Downloaded [https://buildpacks.cloudfoundry.org/dependencies/httpd/httpd-2.4.27-linux-x64-ebe06494.tgz] to [/tmp]
Warning: PHP_EXTENSIONS in options.json is deprecated. See: http://docs.cloudfoundry.org/buildpacks/php/gsg-php-config.html
Installing PHP
PHP 7.1.7
Downloaded [https://buildpacks.cloudfoundry.org/dependencies/php7/php7-7.1.7-linux-x64-f56b6cf4.tgz] to [/tmp]
Finished: [2017-07-23 12:33:24.874926]
Exit status 0
Staging complete
Uploading droplet, build artifacts cache...
Uploading build artifacts cache...
Uploading droplet...
Uploaded build artifacts cache (204B)
Uploaded droplet (58M)
Uploading complete
Destroying container
Successfully destroyed container

2 個の中の 0 個のインスタンスが実行中です, 2 個が開始中です
2 個の中の 2 個のインスタンスが実行中です

アプリが開始されました


OK

アプリ phpSample はコマンド `$HOME/.bp/bin/start` を使用して開始されました

tkr9955@yahoo.co.jp として組織 試験 / スペース dev 内のアプリ phpSample の正常性と状況を表示しています...
OK

要求された状態: started
インスタンス: 2/2
使用: 64M x 2 インスタンス
URL: phpsample-subultimate-reverification.mybluemix.net, phpsample-unrespirable-emittance.mybluemix.net, phpsample-courageous-piloti.mybluemix.net, phpsample-dropsied-avenger.mybluemix.net, phpsample-skiech-inkie.mybluemix.net
最終アップロード日時: Sun Jul 23 12:32:53 UTC 2017
スタック: cflinuxfs2
ビルドパック: https://github.com/cloudfoundry/php-buildpack

     状態   開始日時                 CPU    メモリー           ディスク           詳細
#0   実行   2017-07-23 09:33:58 PM   0.4%   64M の中の 21.6M   1G の中の 169.1M
#1   実行   2017-07-23 09:33:55 PM   0.8%   64M の中の 26.4M   1G の中の 169.1M

~~~
 
これで、Bluemix から割り当てられたURLでアクセスすれば、サンプル・アプリで、動作を確認することができます。サンプル・アプリの


# なぜ、アンチパターンと言うのか？

このサンプル・プログラムでは、セッション・ストアとして redis を利用しているのですが、redis は同じLAN上のサーバーからアクセスを前提としているため、SSLなどの暗号化接続をサポートしていません。 Compose for Redis では この点を保護するために、Compose 社のサービスでは、コンソールからSSHトンネルと有効にすることで、安全な通信を提供しています。
しかし、Bluemix から利用できるRedisは、現在、統合推進中で、コンソールを操作することができないため、SSHトンネルを利用できないためです。
このサンプルでは、redis に格納するデータ PHPのセッション・ハンドラの拡張モジュールをを追加して、セッション・オブジェクトを暗号化して保存しているため、万一、redisのユーザーが取られても、内容を見ることはできません。しかし、データベースのパスワードをクリアテキストで送信するしか無いため、残念ながら、現在はアンチパターンと呼んでいます。







