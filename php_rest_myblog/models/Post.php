<?php
class Post
{
  // DB 參數
  private $conn;
  private $table = "posts";

  // Post 屬性
  public $id;
  public $category_id;
  public $category_name;
  public $title;
  public $body;
  public $author;
  public $created_at;

  // 建構子
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // 取得 posts
  public function read()
  {
    // 建立 query
    $query = "SELECT 
      c.name as category_name, 
      p.id, 
      p.category_id, 
      p.title, 
      p.body, 
      p.author, 
      p.created_at 
    FROM 
      $this->table p 
    LEFT JOIN 
      categories c ON p.category_id = c.id 
    ORDER BY 
      p.created_at DESC";

    // 準備 statement
    $stmt = $this->conn->prepare($query);

    // 執行 query
    $stmt->execute();

    return $stmt;
  }
}
