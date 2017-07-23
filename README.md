# Bluemix PHP + MySQL テスト用アプリ

このサンプルは、redis のパスワードをクリア・テキストでインターネットへ送信するというアンチパターンのため、実際に実行することは、お勧めできません。

## MySQLデータベースのセットアップ

* Compose for MySQL サービスを作成
* setup_db.sh の パスワードを設定
* setup_db.shを実行してDBセットアップ


## セッション・ストアのセットアップ

* Compose for Redis サービスを作成
* store_encrypter.phpにパスワードを設定


## ビルドパック設定のセットアップ






