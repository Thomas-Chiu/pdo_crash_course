<?php
header("Access-Control-Allo-Origin: *");
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

$database = new Database;
$db = $database->connect();

$category = new Category($db);
$result = $category->read();
$num = $result->rowCount();

if ($num > 0) {
  $categories = array(
    "msg" => "OK",
    "data" => array()
  );

  while ($row = $result->fetch(PDO::FETCH_OBJ)) {
    $item = array(
      "id" => $row->id,
      "name" => $row->name,
      "created_at" => $row->created_at
    );
    array_push($categories["data"], $item);
  }

  echo json_encode($categories);
} else {
  echo json_encode(array("msg" => "找不到"));
}
