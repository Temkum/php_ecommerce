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

  public static function getInstance()
  {

    if (self::$conn) {

      return self::$conn;
    }
    // instantiate class within the class
    $c = new self();

    return self::$conn;
  }
}