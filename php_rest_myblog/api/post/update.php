<?php
header("Access-Control-Allow_origin: *");
header("Content-Type: application/json");
# 限制 req 權限
header("Access-Control-Allow_Methods: PUT");
header("Access-Control_Allow-Headers: Access-Control_Allow_Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

$database = new Database();
$db = $database->connect();

$post = new Post($db);

# 取得原始 PUT 資料
$data = json_decode(file_get_contents("php://input"));

# 驗證 PUT 資料
if (
  $data->id === null ||
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

# 指定 ID 修改
$post->id = $data->id;
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;


# 回傳 JSON
if ($post->update()) {
  echo json_encode(
    array("msg" => "修改成功")
  );
} else {
  echo json_encode(
    array("msg" => "修改失敗")
  );
}
