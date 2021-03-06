<?php

class Controller
{

  public function view($path, $data = [])
  {
    if (is_array($data)) {
      # code...
      extract($data);
    }

    if (file_exists('../app/views/' . THEME . $path . '.php')) {
      include '../app/views/' . THEME . $path . '.php';
    } else {
      include '../app/views/' . THEME . '404.php';
    }
  }

  public function loadModel($model)
  {
    if (file_exists('../app/models/' . strtolower($model) . '.class.php')) {
      include_once '../app/models/' . strtolower($model) . '.class.php';

      // return instance of the model
      return $m = new $model();
    }

    return false;
  }
}
