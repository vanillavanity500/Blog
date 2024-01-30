<?php
include_once "include/util.php";
include_once "models/post.php";
include_once "models/user.php";

function get_list() {
  $posts = findAllPosts();
  renderTemplate(
    "views/index.php",
    array(
      'title' => 'Recent Posts',
      'posts' => $posts,
    )
  );
}

function get_add() {
  ensureLoggedIn();
  $post = __empty_post();
  renderTemplate(
    "views/post_addedit.php",
    array(
      'title' => 'Add a blog post',
      'operation' => 'add',
      'post' => $post,
      'user' => $_SESSION['user'],
    )
  );
}

function post_add() {
  ensureLoggedIn();
  $post = __empty_post();
  $post['title'] = safeParam($_REQUEST, 'title', false);
  $post['content'] = safeParam($_REQUEST, 'content', false);
  $post['tags'] = safeParam($_REQUEST, 'tags', false);
  $errors = __check_post($post);
  if ($errors) {
    renderTemplate(
      "views/post_addedit.php",
      array(
        'title' => 'Add a blog post',
        'operation' => 'add',
        'errors' => $errors,
        'post' => $post,
        'user' => $_SESSION['user'],
      )
    );
  } else {
    $post['datestamp'] = time();
    addPost($post, $_SESSION['user']['id']);
    redirectRelative("index");
  }
}

function get_view($id) {
  $post = findPostById($id);
  renderTemplate(
    "views/post_view.php",
    array(
      'title' => 'View a blog post',
      'operation' => 'edit',
      'post' => $post
    )
  );
}

function get_edit($id) {
  ensureLoggedIn();
  $post = findPostById($id);
  if (!$post) {
    die("No post with that ID found");
  }
  if ($post['user_id'] != $_SESSION['user']['id']) {
    die("Can't edit a post that isn't yours.");
  }
  renderTemplate(
    "views/post_addedit.php",
    array(
      'title' => 'Edit a blog post',
      'operation' => "edit/$id",
      'post' => $post
    )
  );
}

function post_edit($id) {
  ensureLoggedIn();
  $post = findPostById($id);
  if (!$post) {
    die("No post with that ID found");
  }
  if ($post['user_id'] != $_SESSION['user']['id']) {
    die("Can't edit a post that isn't yours.");
  }
  $post['title'] = safeParam($_REQUEST, 'title', false);
  $post['content'] = safeParam($_REQUEST, 'content', false);
  $post['tags'] = safeParam($_REQUEST, 'tags', false);
  $errors = __check_post($post);
  if ($errors) {
    renderTemplate(
      "views/post_addedit.php",
      array(
        'title' => 'Edit a blog post',
        'operation' => "edit/$id",
        'errors' => $errors,
        'post' => $post
      )
    );
  } else {
    updatePost($post);
    redirectRelative("index");
  }
}

function post_delete($id) {
  ensureLoggedIn();
  $post = findPostById($id);
  if (!$post) {
    die("No post with that ID found");
  }
  if ($post['user_id'] != $_SESSION['user']['id']) {
    die("Can't edit a post that isn't yours.");
  }
  deletePostByID($id);
  redirectRelative("index");
}
?>