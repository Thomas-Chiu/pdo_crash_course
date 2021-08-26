<?php
header("Access-Control-Allow_origin: *");
header("Content-Type: application/json");
# 限制 req 權限
header("Access-Control-Allow_Methods: DELETE");
header("Access-Control_Allow-Headers: Access-Control_Allow_Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

$database = new Database();
$db = $database->connect();

$post = new Post($db);

# 取得原始 DELETE 資料
$data = json_decode(file_get_contents("php://input"));

# 指定 ID 刪除
$post->id = $data->id;

# 回傳 JSON
if ($post->delete()) {
  echo json_encode(
    array("msg" => "刪除成功")
  );
} else {
  echo json_encode(
    array("msg" => "刪除失敗")
  );
}
