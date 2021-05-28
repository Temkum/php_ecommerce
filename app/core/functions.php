<?php

function show($data)
{
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}

function errorCheck()
{

  if (isset($_SESSION['error']) && $_SESSION['error'] != '') {
    echo $_SESSION['error'];
    // unset so that it doesn't display on page load
    unset($_SESSION['error']);
  }
}
