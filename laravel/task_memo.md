# サブドメインのサポート（必要に応じて）
config/session.php　のドメイン設定を変更する
https://readouble.com/laravel/11.x/ja/sanctum.html

# 開発終了後、emailのバリデーション部分修正する
UserRequest
AuthRequest

# ログイン後、閲覧していたページへリダイレクトするように処理を書く
現在は、すべてトップページへ行くようになっている

laravel側から、新規ユーザー登録の際に、すでに登録されているメールアドレスで登録しようとした際に、すでに登録されたメールアドレスである旨を記載した、JSONをNuxt側にJSONレスポンスで返却したいです