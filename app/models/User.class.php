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

    if (
      empty($data['email']) && empty($data['password']) &&
      empty($data['confirm_password'])
    ) {

      $this->error .= 'Please fill out all required fields! <br>';
    } else {

      // name validation
      if (empty($data['name']) && !preg_match("/^[a-zA-Z0-9]+$/", $data['name'])) {
        $this->error .= 'Please enter a valid name! <br>';
      }

      // validate signup form
      if (empty($data['email']) || !preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email'])) {
        $this->error .= 'Please enter a valid email! <br>';
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
      $sql = "SELECT * FROM `users` WHERE `email` = :email limit 1";
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
        $data['password'] = hash('sha1', $data['password']);

        $sql = "INSERT INTO `users` ( `name`, `url_address`, `email`, `password`, `rank`, `date`) VALUES(:name, :url_address, :email, :password, :rank, :date)";

        $result = $db->write($sql, $data);

        if ($result) {
          # check for errors to let it die down
          header('Location: ' . ROOT . 'login');

          exit;
        }
      }
    }
    $_SESSION['error'] = $this->error;
  }

  public  function login($POST)
  {
    # get form values
    # as an array, so you don't to create new arrays
    $data = array();

    // instantiate db
    $db = Database::getInstance();

    $data['email'] = trim($POST['email']);
    $data['password'] = trim($POST['password']);

    if (
      empty($data['email']) && empty($data['password'])
    ) {
      $this->error .= 'Please fill out all required fields! <br>';
    } else {

      // validate login form
      if (empty($data['email']) || !preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email'])) {
        $this->error .= 'Please enter a valid email! <br>';
      }

      // validate pwd
      if (strlen($data['password']) < 5) {
        $this->error .= 'Please enter a valid password! <br>';
      }

      if ($this->error == '') {
        # confirm login
        $data['password'] = hash('sha1', $data['password']);

        // check if email already exist
        $sql = "SELECT * FROM `users` WHERE `email` = :email && `password` = :password LIMIT 1";

        $result = $db->read($sql, $data);

        if ($result) {
          # check for errors to let it die down

          $_SESSION['user_url'] = $result[0]->url_address;
          header('Location: ' . ROOT . 'home');

          exit;
        }
      }
      $this->error = 'Invalid email or password <br>';
    }
    $_SESSION['error'] = $this->error;
  }

  public function getUser($url)
  {
    $db = Database::newInstance();
    $arr = false;

    $arr['url'] = addslashes($url);
    $sql = 'SELECT * FROM users WHERE url_address =:url LIMIT 1';

    $result = $db->read($sql, $arr);

    if (is_array($result)) {

      return $result[0];
    }


    return false;
  }

  public function getCustomers()
  {
    $db = Database::newInstance();
    $arr = false;

    $arr['rank'] = "customer";
    $sql = "SELECT * FROM users WHERE rank =:rank";

    $result = $db->read($sql, $arr);

    if (is_array($result)) {

      return $result;
    }

    return false;
  }

  public function getAdmins()
  {
    $db = Database::newInstance();
    $arr = false;

    $arr['rank'] = "admin";
    $sql = "SELECT * FROM users WHERE rank =:rank";

    $result = $db->read($sql, $arr);

    if (is_array($result)) {

      return $result;
    }

    return false;
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

  public function checkLogin($redirect = false, $userAccess = array())
  {
    // limit user access
    /* check current user rank
    * get user from db
    */
    $db = Database::getInstance();

    if (count($userAccess) > 0) {

      $arr['url'] = $_SESSION['user_url'];
      $sql = "SELECT * FROM `users` WHERE `url_address` = :url LIMIT 1 ";

      $result = $db->read($sql, $arr);

      if (is_array($result)) {
        // get first item in result set
        $result = $result[0];

        if (in_array($result->rank, $userAccess)) {
          return $result;
        }
      }

      // redirect to login if user is not found
      header('Location: ' . ROOT . 'login');
    }

    if (isset($_SESSION['user_url'])) {
      // read from db
      $arr = false;
      $arr['url'] = $_SESSION['user_url'];
      $sql = 'SELECT * FROM `users` WHERE `url_address` = :url LIMIT 1';
      $result = $db->read($sql, $arr);

      if (is_array($result)) {
        // code...

        return $result[0];
      }

      if ($redirect) {
        // code...
        header('Location: ' . ROOT . 'login');

        exit;
      }
    }

    return false;
  }

  public function logout()
  {
    if (isset($_SESSION['user_url'])) {

      unset($_SESSION['user_url']);
    }
    return header('Location: ' . ROOT . 'home');

    exit;
  }
}
