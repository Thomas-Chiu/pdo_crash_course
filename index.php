<?php
$host = "localhost";
$port = 3306;
$user = "root";
$password = "";
$dbname = "pdoposts";

# 定義 DSN (Data Source Name)
$dsn = "mysql:host=" . $host . ";port=" . $port . ";dbname=" . $dbname;

# 建立 PDO 物件
$pdo = new PDO($dsn, $user, $password);
# 可設定 PDO 屬性
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
// 關閉 PDO 驅動程式模擬預處理，改由 MySQL 執行
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

# PDO 查詢
// $stmt = $pdo->query("SELECT * FROM posts");

// 關聯性陣列資料
// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//   echo $row["body"] . "<br>";
// }

// 取得物件資料
// while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
//   echo $row->title . "<br>";
// }

# 假設使用者輸入
$author = "thomas";
$is_published = false;
$id = 4;

# 準備 PDO statement
// 不安全作法 (直接將變數寫在 SQL 語法有 SQL injection 風險)
// $sql = "SELECT * FROM posts WHERE author = '$author'";

# 查詢多筆資料 fetchAll()

# positional params 位置參數 (? 號表示)
// $sql = "SELECT * FROM posts WHERE author = ?";
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$author]);

// 上面 PDO 已定義 DEFAULT_FETCH_MODE 參數為 PDO::FETCH_OBJ 
// $results = $stmt->fetchAll();
// echo "<pre>";
// print_r($results);
// echo "</pre>";

# named params 具名參數 (: 號表示)
// $sql = "SELECT * FROM posts WHERE author = :author && is_published=:is_published";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(["author" => $author, "is_published" => "$is_published"]);
// $results = $stmt->fetchAll();
// foreach ($results as $result) {
//   echo "author: " . $result->author . ", body: " . $result->body . "<br>";
// }

# 查詢單筆資料
// $sql = "SELECT * FROM posts WHERE id=:id";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(["id" => $id]);
// $result = $stmt->fetch();
// echo "author: " . $result->author . ", body: " . $result->body;

# 取得資料列數
// $sql = "SELECT * FROM posts WHERE author = ?";
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$author]);
// $results = $stmt->fetchAll();
// $results_count = $stmt->rowCount();
// foreach ($results as $result) {
//   echo "author: " . $result->author . ", body: " . $result->body . "<br>";
// }
// echo "total: " . $results_count;

# 新增資料
// $title = "post five";
// $body  = "this is post 5";
// $author = "andy";

// $sql = "INSERT INTO posts(title, body, author) VALUES(:title, :body, :author)";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(["title" => $title, "body" => $body, "author" => $author]);
// echo "post five added";

# 修改資料
// $id = 1;
// $body  = "this is the updated post";

// $sql = "UPDATE posts SET body = :body WHERE id = :id";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(["body" => $body, "id" => $id]);
// echo "post one updated";

# 刪除資料
// $id = 3;

// $sql = "DELETE FROM posts WHERE id = ?";
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$id]);
// echo "post three deleted";

# 條件查詢 (% 號包著)
// $search = "%f%";
// $sql = "SELECT * FROM posts WHERE title LIKE ?";
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$search]);
// $results = $stmt->fetchAll();
// foreach ($results as $result) {
//   echo $result->title . "<br>";
// }
