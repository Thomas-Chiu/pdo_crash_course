<?php
class Database
{
  // DB 參數
  private $host = "localhost";
  private $db_name = "myblog";
  private $username = "root";
  private $password = "";
  private $conn;

  // DB 連線
  public function connect()
  {
    $this->conn = null;

    try {
      $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
      // 設定 PDO Exception 報錯模式
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "DB 連線成功";
    }
    // 處理 error
    catch (PDOException $err) {
      echo "DB 連線失敗: " . $err->getMessage();
    }
    // 記得返回連線
    return $this->conn;
  }
}
