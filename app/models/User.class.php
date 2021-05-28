<?php
class User
{
  private $error = '';

  public function signup($POST)
  {
    # get form values
    # as an array, so you don't to create new arrays
    $data = array();

    // instantiate db
    $db = Database::getInstance();

    $data['name'] = trim($POST['name']);
    $data['email'] = trim($POST['email']);
    $data['password'] = trim($POST['password']);
    $confirm_password = trim($POST['confirm_password']);

    // validate signup form
    if (!preg_match("/^[a-zA-Z_-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email']) || empty($data['email'])) {
      $this->error .= 'Please enter a valid email! <br>';
    }

    // name validation
    if (!preg_match("/^[a-zA-Z]+$/", $data['name']) || empty($data['name'])) {
      $this->error .= 'Please enter a valid name! <br>';
    }

    // validate pwd
    if (strlen($data['password']) < 5) {
      $this->error .= 'Passwords must be at least 5 characters long! <br>';
    }

    // validate pwd
    if ($data['password'] != $confirm_password) {
      $this->error .= 'Passwords do not match! <br>';
    }

    // check if email already exist
    $sql = 'SELECT * FROM `users` WHERE `email` = :email limit 1';
    $arr['email'] = $data['email'];
    $check = $db->read($sql, $arr);
    if (is_array($check)) {
      $this->error .=  'Email is already in use! <br>';
    }

    // check if url_address exist
    $data['url_address'] = $this->get_random_string_max(60);
    $sql = 'SELECT * FROM `users` WHERE `url_address` = :url_address limit 1';
    // reset array before use
    $arr = false;
    $arr['url_address'] = $data['url_address'];
    $check = $db->read($sql, $arr);
    
    if (is_array($check)) {
      $data['url_address'] = $this->get_random_string_max(60);
    }

    if ($this->error == '') {
      # save
      $data['rank'] = 'customer';
      $data['date'] = date('Y-m-d H:i:s');

      $sql = "INSERT INTO `users` (`url_address`, `name`, `email`, `password`, `rank`, `date`) VALUES(:url_address, :name, :email, :password, :rank, :date)";

      $result = $db->write($sql, $data);

      if ($result) {
        # check for errors to let it die down
        header('Location: ' . ROOT . 'login');

        exit;
      }
    }

    $_SESSION['error'] = $this->error;
  }

  public  function login($POST)
  {
    # code...
  }

  public function getUser($url)
  {
    # code...
  }

  private function get_random_string_max($length)
  {
    $array = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    $text = '';

    $length = rand(4, $length);

    for ($i = 0; $i < $length; ++$i) {
      $random = rand(0, 61);

      $text .= $array[$random];
    }

    return $text;
  }
}
