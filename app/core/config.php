<?php

// Contains all configuration needed for your website to run
define('WEBSITE_TITLE', 'eShopper');
define('DB_NAME', 'php_ecommerce');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', 'loveisall21');
define('DB_TYPE', 'mysql');

define('THEME', 'ecomm/');

define('DEBUG', true);

if (DEBUG) {
  # code...
  ini_set('display_errors', 1);
} else {
  ini_set('display_errors', 0);
}
