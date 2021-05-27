<?php
session_start();

$rootPath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];

$rootPath = str_replace('index.php', '', $rootPath);

define('ROOT', $rootPath);
define('ASSETS', $rootPath . 'assets/');

include '../app/init.php';

$app = new App();
