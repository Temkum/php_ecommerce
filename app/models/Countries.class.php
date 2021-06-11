<?php

class Countries
{

  public function getCountries()
  {
    $DB = Database::newInstance();
    $sql = 'SELECT * FROM countries ORDER BY id DESC';
    $data = $DB->read($sql);

    return $data;
  }

  public function getStates($id)
  {
    $arr['id'] = (int) $id;

    $DB = Database::newInstance();
    $sql = 'SELECT * FROM states WHERE parent=:id ORDER BY id DESC';
    $data = $DB->read($sql, $arr);

    return $data;
  }
}
