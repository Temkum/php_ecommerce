<?php

class Database
{
  public static $conn;

  public function __construct()
  {
    try {
      // $string = "mysql:host=localhost;dbname=php_ecommerce";
      $string = DB_TYPE . ':host=' . DB_HOST . ';dname=' . DB_NAME;

      self::$conn = new PDO($string, DB_USER, DB_PWD);
    } catch (PDOException $e) {

      exit($e->getMessage());
    }
  }

  /* we instantiate by calling this function which returns the $conn
  *
  */
  public static function getInstance()
  {

    if (self::$conn) {

      return self::$conn;
    }
    // instantiate class within the class
    $instance = new self();

    return $instance;
  }

  // fetch data from db
  public function read($query, $data = array())
  {
    # use self since it's a static value
    $stmt = self::$conn->prepare($query);
    $result = $stmt->execute($data);

    if ($result) {
      // fetch data
      $data = $stmt->fetchAll(PDO::FETCH_OBJ);

      if (is_array($data)) {

        return $data;
      }
    }

    return false;
  }

  public function write($query, $data = array())
  {
    $stmt = self::$conn->prepare($query);
    $result = $stmt->execute($data);

    if ($result) {
      return true;
    }

    return false;
  }
}
