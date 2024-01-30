<?php
include_once 'models/db.php';

function __empty_post() {
  return array(
    'id' => '',
    'title' => '',
    'content' => '',
    'datestamp' => '',
    'tags' => '',
    'user_id' => ''
  );
}

function __check_post($post) {
  $errors = array();
  if (!$post['content']) {
    $errors['content'] = "Content may not be empty.";
  }

  if (!$post['title']) {
    $errors['title'] = "Title may not be empty.";
  }

  return $errors;
}

function findPostById($id) {
  global $db;
  $st = $db -> prepare('SELECT * FROM post WHERE id = :id');
  $st -> execute(array(':id' => $id));
  return $st -> fetch(PDO::FETCH_ASSOC);
}

function findAllPosts($limit = 5) {
  global $db;
  $st = $db -> prepare('SELECT * FROM post ORDER BY datestamp DESC LIMIT :limit');
  $st -> execute(array(':limit' => $limit));
  return $st -> fetchAll(PDO::FETCH_ASSOC);
}

function addPost($post, $user_id) {
  global $db;
  $st = $db -> prepare("INSERT INTO post (title, content, datestamp, tags, user_id) VALUES (:title, :content, :datestamp, :tags, :user_id)");
  $st -> bindParam(':title', $post['title']);
  $st -> bindParam(':content', $post['content']);
  $st -> bindParam(':tags', $post['tags']);
  $st -> bindValue(':datestamp', date('Y-m-d H:i:s T'));
  $st -> bindParam(':user_id', $user_id);
  $st -> execute();
  return $db->lastInsertId();
}

function updatePost($post) {
  global $db;
  $st = $db -> prepare("UPDATE post SET title=:title, content=:content, tags=:tags WHERE id=:id");
  $st -> bindParam(':title', $post['title']);
  $st -> bindParam(':content', $post['content']);
  $st -> bindParam(':tags', $post['tags']);
  $st -> bindValue(':id', $post['id']);
  $st -> execute();
}

function deletePostById($id) {
  global $db;
  $st = $db -> prepare("DELETE FROM post WHERE id=:id");
  $st -> bindValue(':id', $id);
  $st -> execute();
}

function deletePostByUserId($user_id) {
  global $db;
  $st = $db -> prepare("DELETE FROM post WHERE user_id = :user_id");
  $st -> bindValue(':user_id', $user_id);
  $st -> execute();
}

function findPostsByUserId($user_id) {
  global $db;
  $st = $db -> prepare('SELECT * FROM post WHERE user_id = :user_id ORDER BY datestamp DESC LIMIT 5');
  $st -> execute(array(':user_id' => $user_id));
  $results = $st -> fetchAll(PDO::FETCH_ASSOC);
  return $results;
}

?>