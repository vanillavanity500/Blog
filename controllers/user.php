<?php
include_once "include/util.php";
include_once "models/user.php";
include_once "models/post.php";
include_once "include/Validator.php";

function get_login() {
  renderTemplate(
    "views/user_login.php",
    array(
      'title' => 'Log in',
    )
  );
}

function post_login() {
  $form = safeParam($_POST, 'form');
  $email = safeParam($form, 'email');
  $password = safeParam($form, 'password');
  
  $user = findUserByEmailAndPassword($email, $password);
  if (!$user) {
    $errors = array("Bad username/password combination");
    renderTemplate(
      "views/user_login.php",
      array(
        'title' => 'Log in',
        'form' => $form,
        'errors' => $errors,
      )
    );
  } else {
    $destination = $_SESSION['redirect'] ? $_SESSION['redirect'] : "/index";
    restartSession();
    $_SESSION['user'] = $user;
    $_SESSION['flash'] = "Login successful!";
    redirect($destination);
  }
}

function get_logout() {
  restartSession();
  redirectRelative('index');
}

function get_register() {
  renderTemplate(
    "views/user_addedit.php",
    array(
      'title' => 'Create an account',
      'form' => array(),
      'action' => url('user/register'),
    )
  );
}

function verify_account($form) {
  
  if (!$form) {
    return array("No data submitted.");
  }
  
  $val = new Validator();
  $val->email('email1', safeParam($form, 'email1'), 'Not a valid email address.');
  $val->same('email2', safeParam($form, 'email1'), safeParam($form, 'email2'), 'Email addresses must match.');
  $val->password('password1', safeParam($form, 'password1'), "Passwords must be at least 8 characters, have an upper case, symbol, and a number.");
  $val->same('password2', safeParam($form, 'password1'), safeParam($form, 'password2'), 'Passwords must match.');
  $val->required('firstName', safeParam($form, 'firstName'), "A first name must be provided");
  $val->required('lastName', safeParam($form, 'lastName'), "A last name must be provided");
  return $val->hasErrors() ? $val->allErrors() : false;
}

function post_register() {
  $form = safeParam($_POST, 'form');
  $errors = verify_account($form);
  $user = findUserByEmail(safeParam($form, 'email1', false));
  if ($user) {
    $errors['email1'] = 'An account is already registered with that email address';
  }
  if ($errors) {
    renderTemplate(
      "views/user_addedit.php",
      array(
        'title' => 'Create an account',
        'form' => $form,
        'errors' => $errors,
        'action' => url('user/register'),
      )
    );
  } else {
    error_log("Trying to add to database");
    $id = addUser($form['email1'], $form['password1'], $form['firstName'], $form['lastName'], $form['profile']);
    error_log("After add, id is $id");
    restartSession();
    $user = findUserById($id);
    $_SESSION['user'] = $user;
    flash("Welcome to To Do List, {$user['firstName']}.");
    redirectRelative("index");
  }
}

function get_edit() {
  ensureLoggedIn();
  $user = $_SESSION['user'];
  
  renderTemplate(
    "views/user_addedit.php",
    array(
      'title' => 'Edit your profile',
      'action' => url("user/edit/${user['id']}"),
      'form' => array(
        'firstName' => $user['firstName'],
        'lastName'  => $user['lastName'],
        'email1'    => $user['email'],
        'email2'    => $user['email'],
        'password1' => $user['password'],
        'password2' => $user['password'],
        'profile'   => $user['profile'],
      )
    )
  );
}

function post_edit($id) {
  ensureLoggedIn();
  $user=$_SESSION['user'];
  if ($id != $user['id']) {
    die("Can't edit somebody else.");
  }
  $form = safeParam($_POST, 'form');
  $errors = verify_account($form);
  if ($errors) {
    renderTemplate(
      "views/user_addedit.php",
      array(
        'title' => 'Edit your profile',
        'form' => $form,
        'errors' => $errors,
        'action' => url("user/edit/${user['id']}"),
      )
    );
  } else {
    updateUser($user['id'], $form['email1'], $form['password1'], $form['firstName'], $form['lastName'], $form['profile']);
    $_SESSION['user'] = findUserById($user['id']);
    flash("Profile updated");
    redirectRelative("index");
  }
}

function get_view($id) {
  $user = findUserById($id);
  if (!$user) {
    die("No user found by that id.");
  }
  $posts = findPostsByUserId($id);
  if (!$posts) {
    $posts = array();
  }
  
  renderTemplate(
    "views/user_view.php",
    array(
      'title' => "Posts by {$user['firstName']} {$user['lastName']}",
      'user' => $user,
      'posts' => $posts,
    )
  );
}

function post_delete($id) {
  ensureLoggedIn();
  if ($id != $_SESSION['user']['id']) {
    die ("Can't delete other users");
  }
  deletePostByUserId($id);
  deleteUser($id);
  restartSession();
  flash("Account deleted");
  redirectRelative("index");
}
?>
