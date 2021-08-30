<?php
header("Access-Control-Allo-Origin: *");
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

$database = new Database;
$db = $database->connect();

$category = new Category($db);
$category->id = isset($_GET["id"]) ? $_GET["id"] : die();
$result = $category->read_single();
$row = $result->fetch(PDO::FETCH_ASSOC);

if ($row) {
  echo json_encode(array(
    "msg" => "OK",
    "data" => $row
  ));
} else {
  echo json_encode(array("msg" => "NG"));
}
