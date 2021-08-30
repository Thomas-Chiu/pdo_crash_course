<?php
header("Access-Control-Allo-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Method: PATCH");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

$database = new Database;
$db = $database->connect();
$category = new Category($db);
$data = json_decode(file_get_contents("php://input"));

if ($data->id === null || $data->name === null) {
  echo json_encode(array("msg" => "格式錯誤"));
  die();
} else {
  $category->id = $data->id;
  $category->name = $data->name;
}

if ($category->update()) {
  echo json_encode(array(
    "msg" => "修改成功",
    "id" => $category->id,
    "name" => $category->name
  ));
} else {
  echo json_encode(array("msg" => "修改失敗"));
}
