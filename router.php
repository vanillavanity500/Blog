<?php

if(file_exists("." . $_SERVER['REQUEST_URI']) or str_contains($_SERVER['REQUEST_URI'], 'phpliteadmin')){
  return false;
}

require_once 'include/config.php';
require_once 'include/util.php';

function routeUrl() {
  $method = $_SERVER['REQUEST_METHOD'];
  $requestURI = explode('/', $_SERVER['REQUEST_URI']);
  $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);

  for ($i = 0; $i < sizeof($scriptName); $i++) {
    if ($requestURI[$i] == $scriptName[$i]) {
      unset($requestURI[$i]);
    }
  }
  # continued...

  $entity = array_values($requestURI);
  if(empty($entity[0])){
    header("Location: /index");
    die();
  }
  $controller = 'controllers/' . $entity[0] . '.php';
  $func = strtolower($method) . '_' . (isset($entity[1]) ? $entity[1] : 'index');
  $params = array_slice($entity, 2);

  if (!file_exists($controller)) {
    errorPage(404, "Controller <code>$controller</code> doesn't exist. Do you want to <a href='/framework/createController/$entity[0]'>create it</a>?");
  }

  require $controller;
  if (!function_exists($func)) {
    errorPage(404, "Function <code>$func()</code> doesn't exist in controller <code>$controller</code>. Do you want to <a href='/framework/createFunction/$entity[0]/$func'>create it</a>?");
  }

  call_user_func_array($func, $params);
  errorPage(404, "It looks like you're not redirecting or rendering a template in <code>$func()</code> in the <code>$controller</code> controller. Maybe edit that function?");
  exit();
}

ini_set('session.use_strict_mode', 1);
date_default_timezone_set('America/New_York');
// note, GDPR says that you need to notify about cookies like this.
session_start();
routeUrl();
