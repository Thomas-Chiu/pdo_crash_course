<?php
header("Access-Control-Allo-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Method: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

$database = new Database;
$db = $database->connect();
$category = new Category($db);
$data = json_decode(file_get_contents("php://input"));

if ($data->id === null) {
  echo json_encode(array("msg" => "格式錯誤"));
  die();
} else $category->id = $data->id;


if ($category->delete()) {
  echo json_encode(array(
    "msg" => "刪除成功",
    "id" => $category->id,
  ));
} else {
  echo json_encode(array("msg" => "刪除失敗"));
}
