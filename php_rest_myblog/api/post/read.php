<?php
# 設定 headers
header("Access-Control-Allow_origin: *");
header("Content-Type: application/json");

# 引用 Database & Post 類別
include_once "../../config/Database.php";
include_once "../../models/Post.php";

# 建立 DB 實體
$database = new Database();
$db = $database->connect();

# 建立 Post 實體
$post = new Post($db);

# 呼叫 read 函式
$result = $post->read();
# 取得資料列數
$num = $result->rowCount();

# 整理資料
if ($num > 0) {
  $posts_arr = array();
  $posts_arr["data"] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // extract() 取出字首
    extract($row);

    $post_item = array(
      "id" => $id,
      "title" => $title,
      // html_entity_decode() 將 HTML 轉換為對應的字元
      "body" => html_entity_decode($body),
      "author" => $author,
      "category_id" => $category_id,
      "category_name" => $category_name
    );

    // push 到 data 陣列
    array_push($posts_arr["data"], $post_item);

    // 回傳 JSON
    echo json_encode($posts_arr);
  }
} else {
  // 無資料
  echo json_encode(
    array("message" => "找不到文章")
  );
}
