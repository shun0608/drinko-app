# サブドメインのサポート（必要に応じて）
config/session.php　のドメイン設定を変更する
https://readouble.com/laravel/11.x/ja/sanctum.html

# 開発終了後、emailのバリデーション部分修正する
UserRequest
AuthRequest

{"name":"テストユーザー１","email":"drink@example.org","password":"password"}
上記のJSONのそれぞれのname,email,passwordにlaravelのformRequestでバリデーションをかけたいです。値の指定方法について教えてください