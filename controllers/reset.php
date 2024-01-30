<?php
  include_once "include/util.php";

  function post_index($params) {
    $output = `sqlite3 blog.db3 < blog.sql`;
    redirectRelative("index");
  }
?>