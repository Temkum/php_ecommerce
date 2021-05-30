<?php
class Category
{
  public function create($Data)
  {
    # code...
    $DB = Database::getInstance();

    $arr['category'] = ucwords($Data->data);

    // validate user input
    if (!preg_match("/^[a-zA-Z ]+$/", trim($arr['category']))) {
      $_SESSION['error'] = 'Please enter a valid category name!';
    }

    # create category
    if (!isset($_SESSION['error']) && $_SESSION['error'] == "") {
      $sql = 'INSERT INTO `categories` (category) VALUES (:category)';
      $check = $DB->write($sql, $arr);

      if ($check) {
        # check if it returns a result
        return true;
      }
    }

    return false;
  }

  public function edit($Data)
  {
    # code...
  }

  public function delete($Data)
  {
    # code...
  }
}
