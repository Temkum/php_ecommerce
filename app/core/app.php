<?php

class App
{
  protected $controller = 'home';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    $url = $this->parseURL();

    if (file_exists('../app/controllers/' . strtolower($url[0]) . '.php')) {

      $this->controller = strtolower($url[0]);
      unset($url[0]);
    }

    require '../app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    // check if url location is set
    if (isset($url[1])) {

      $url[1] = strtolower($url[1]);

      if (method_exists($this->controller, $url[1])) {
        // replace method with one supplied by user
        $this->method = $url[1];
        unset($url[1]);
      }
    }
    // display url
    $this->params = (count($url) > 0) ? $url : ['home'];
    // run the class
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  private function parseURL()
  {
    $url = isset($_GET['url']) ? $_GET['url'] : "home";

    /* sanitize url & turn into an array 
      - trim to remove extra space from url
     - sanitize with filter_var
    */

    return explode('/', filter_var(trim($url, '/'), FILTER_SANITIZE_URL));
  }
}
