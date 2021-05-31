<?php

class Database
{
  public static $conn;

  public function __construct()
  {
    try {
      // $string = "mysql:host=localhost;dbname=php_ecommerce";
      $string = DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME;

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

  public static function newInstance()
  {
    // instantiate class within the class
    $instance = new self();

    return $instance;
  }

  // fetch data from db
  public function read($sql, $data = array())
  {
    # use self since it's a static value
    $stmt = self::$conn->prepare($sql);
    $result = $stmt->execute($data);

    if ($result) {
      // fetch data
      $data = $stmt->fetchAll(PDO::FETCH_OBJ);

      if (is_array($data) && count($data) > 0) {

        return $data;
      }
    }

    return false;
  }

  public function write($sql, $data = array())
  {
    $stmt = self::$conn->prepare($sql);
    $result = $stmt->execute($data);

    if ($result) {
      return true;
    }
    return false;
  }
}
