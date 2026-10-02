## 概要
COACHTECH 教材 Tutorial 11-2「タスク管理APIのCRUD実装」で作成した成果物です。
以下が表示されるものを作成

HTTPメソッド	URL	操作	ステータスコード
GET	/api/tasks	一覧取得	200
POST	/api/tasks	作成	201 / 422
GET	/api/tasks/{id}	詳細取得	200 / 404
PUT	/api/tasks/{id}	更新	200 / 404 / 422
DELETE	/api/tasks/{id}	削除	204 / 404
## 使用技術
- PHP 8.x
- Laravel 10.x
- REST API（CRUD）
- API Resources、FormRequest（バリデーション）


## 学んだこと
- APIリソースの記載
- コントローラーにAPIの記載

## 動作確認
- ポストマンでそれぞれ確認


