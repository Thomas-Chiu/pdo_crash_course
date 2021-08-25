<?php
header("Access-Control-Allow_origin: *");
header("Content-Type: application/json");
# 限制 req 權限
header("Access-Control-Allow_Methods: POST");
header("Access-Control_Allow-Headers: Access-Control_Allow_Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

$database = new Database();
$db = $database->connect();

$post = new Post($db);


# 取得原始 POST 資料
$data = json_decode(file_get_contents("php://input"));

# 驗證 POST 資料
if (
  $data->title === null ||
  $data->body === null ||
  $data->author === null ||
  $data->category_id === null
) {
  echo json_encode(
    array("msg" => "格式錯誤")
  );
  die();
}

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;


# 回傳 JSON
if ($post->create()) {
  echo json_encode(
    array("msg" => "新增成功")
  );
} else {
  echo json_encode(
    array("msg" => "新增失敗")
  );
}
