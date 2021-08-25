<?php
class Post
{
  # DB 參數
  private $conn;
  private $table = "posts";

  # Post 屬性
  public $id;
  public $category_id;
  public $category_name;
  public $title;
  public $body;
  public $author;
  public $created_at;

  # 建構子
  public function __construct($db)
  {
    $this->conn = $db;
  }

  # 查詢資料
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
    // 回傳資料
    return $stmt;
  }

  # 單一查詢
  public function read_single()
  {
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
    WHERE
      p.id = ?
    LIMIT 0, 1";

    $stmt = $this->conn->prepare($query);
    // 綁定參數 (位置參數)
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    // 取得資料
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // 設置屬性
    $this->title = $row["title"];
    $this->body = $row["body"];
    $this->author = $row["author"];
    $this->category_id = $row["category_id"];
    $this->category_name = $row["category_name"];
  }

  # 新增資料
  public function create()
  {
    $query = "INSERT INTO
      $this->table 
    SET 
      title = :title,
      body = :body,
      author = :author,
      category_id = :category_id";

    $stmt = $this->conn->prepare($query);
    // 資料清理
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->body = htmlspecialchars(strip_tags($this->body));
    $this->author = htmlspecialchars(strip_tags($this->author));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    // 綁定參數 (具名參數)
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":body", $this->body);
    $stmt->bindParam(":author", $this->author);
    $stmt->bindParam(":category_id", $this->category_id);
    // 執行 query
    if ($stmt->execute()) {
      return true;
    }
    // 處理 error
    printf("error: %s . \n", $stmt->error);
    return false;
  }
}
