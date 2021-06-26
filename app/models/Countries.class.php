<?php

class Countries
{

  public function getCountries()
  {
    $DB = Database::newInstance();
    $sql = "SELECT * FROM countries ORDER BY id DESC";
    $data = $DB->read($sql);

    return $data;
  }

  public function getStates($country)
  {
    $arr['country'] = addslashes($country);

    $DB = Database::newInstance();
    $sql = "SELECT * FROM countries WHERE country=:country LIMIT 1";
    $check = $DB->read($sql, $arr);
    $data = false;

    if (is_array($check)) {
      # code...
      $arr = false; //clear everything in it
      $arr['id'] = $check[0]->id;

      $sql = "SELECT * FROM states WHERE parent=:id ORDER BY id DESC";
      $data = $DB->read($sql, $arr);
    }

    return $data;
  }

  public function getCountry($id)
  {
    $id = (int) $id;
    $DB = Database::newInstance();
    $sql = "SELECT * FROM countries WHERE id='$id' ORDER BY id DESC";
    $data = $DB->read($sql);

    // return single item
    return is_array($data) ? $data[0] : false;
  }

  public function getState($id)
  {
    $arr['id'] = (int) $id;

    $DB = Database::newInstance();
    $sql = "SELECT * FROM states WHERE id=:id";
    $data = $DB->read($sql, $arr);

    return is_array($data) ? $data[0] : false;
  }
}
