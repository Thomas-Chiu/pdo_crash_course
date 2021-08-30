<?php
header("Access-Control-Allo-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

$database = new Database;
$db = $database->connect();
$category = new Category($db);
$data = json_decode(file_get_contents("php://input"));

if ($data->name === null) {
  echo json_encode(array("msg" => "格式錯誤"));
  die();
} else {
  $category->name = $data->name;
}

if ($category->create()) {
  echo json_encode(array(
    "msg" => "新增成功",
    "name" => $category->name
  ));
} else {
  echo json_encode(array("msg" => "新增失敗"));
}
