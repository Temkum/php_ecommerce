<?php

// Contains all configuration needed for your website to run
define('WEBSITE_TITLE', 'MY eSHOP');
define('DB_NAME', 'php_ecommerce');
define('DB_USER', 'root');
define('DB_PWD', 'loveisall21');

define('DEBUG', true);

if (DEBUG) {
  # code...
  ini_set('display_errors', 1);
} else {
  ini_set('display_errors', 0);
}