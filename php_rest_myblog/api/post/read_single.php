<?php
header("Access-Control-Allow-origin: *");
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

$database = new Database();
$db = $database->connect();

$post = new Post($db);

# 取得 GET 參數
$post->id = isset($_GET["id"]) ? $_GET["id"] : die();

# 呼叫 read_single 函式
$post->read_single();

# 整理資料
$post_arr = array(
  "id" => $post->id,
  "title" => $post->title,
  "body" => $post->body,
  "author" => $post->author,
  "category_id" => $post->category_id,
  "category_name" => $post->category_name
);

# 回傳 JSON
// 用 echo 或 print_r() 皆可;
print_r(json_encode($post_arr));
