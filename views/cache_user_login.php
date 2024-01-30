<!DOCTYPE html>
<html>
  <head>
    <title><?php echo(htmlentities(CONFIG['applicationName']. " - " . $title)); ?></title>
    <link rel="shortcut icon" href="https://cdn.glitch.com/7635e9c3-2015-4ec8-967a-16ca37cc9e55%2Ffavicon.ico" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/static/style.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    <script src="/static/custom.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <img src="https://cdn.glitch.com/5b0f8a54-892a-4d86-9d84-94836d1a3a6c%2Fblog.svg?v=1560192184638" width="30" height="30" class="d-inline-block align-top" alt=""> My Blog Engine</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/phpliteadmin/index.php" style="cursor:pointer">DB Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="post('/reset');" style="cursor:pointer">Reset DB</a>
          </li>
        </ul>
        <ul class="navbar-nav">
<?php  if (isLoggedIn()): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
              <span class="material-icons" style="vertical-align:bottom">account_circle</span> <?php echo(htmlentities($_SESSION['user']['firstName'])); ?> <?php echo(htmlentities($_SESSION['user']['lastName'])); ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="/user/edit">Edit profile</a>
              <a class="dropdown-item" href="/user/logout">Logout</a>
            </div>
          </li>
<?php  else: ?>
          <li class="nav-item">
            <a class="nav-link" onclick="get('/user/login');" style="cursor:pointer">Login</a>
          </li>
<?php  endif; ?>
        </ul>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="display-4"><?php echo(htmlentities(CONFIG['applicationName']. " - " . $title)); ?></h1>
          <p class="lead"><?php echo(htmlentities(CONFIG['leadDescription'])); ?></p>
          <p><em>Author: <?php echo(htmlentities(CONFIG['authorName'])); ?></em></p>
          <hr>
        </div>
      </div>

<?php  if (isset($errors)): ?>
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-danger">
      Please fix the following errors:
      <ul class="mb-0">
<?php  foreach ($errors as $error): ?>
        <li><?php echo(htmlentities($error)); ?></li>
<?php  endforeach; ?>
      </ul>
    </div>
  </div>
</div>
<?php  endif;?>
      
<?php  if (isset($_SESSION['flash'])): ?>
<div class="alert alert-success alert-dismissible flash-message" role="alert" id="flash">
  <?php echo(htmlentities($_SESSION['flash'])); ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $("div.flash-message").fadeTo(1000,1).delay(2000).fadeOut(1000);
  });
</script>
<?php  
   unset($_SESSION['flash']);
   endif;
?>



<div class="row">
  <div class="col-lg-12">

    <form action="/user/login" method="post">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="text" min="1" id="email" name="form[email]" class="form-control" placeholder="Enter email address" value="<?php echo(htmlentities(value($form['email']))); ?>" />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" min="1" id="password" name="form[password]" class="form-control" placeholder="Enter password" value="<?php echo(htmlentities(value($form['password']))); ?>" />
      </div>
      <div class="form-group mt-4">
        <div class="btn-toolbar align-middle">
          <button type="submit" class="btn btn-primary mr-1 d-flex justify-content-center align-content-between"><span class="material-icons">send</span>&nbsp;Submit</button>
          <button class="btn btn-secondary mr-1 d-flex justify-content-center align-content-between" onclick="get('/index')"><span class="material-icons">cancel</span>&nbsp;Cancel</button>
        </div>
      </div>
    </form>
    New here? You can <a href="/user/register">create an account</a>.
  </div>
</div>
<script type="text/javascript">
  $('#email').focus();
</script>
    </div>
    <footer class="footer">
      <div class="container">
        <span class="text-muted">WEBD 236 examples copyright &copy; 2022 <a href="https://www.franklin.edu/">Franklin University</a>. Current time is <?php echo(htmlentities(date('Y-m-d H:i:s T'))); ?></span>
      </div>
    </footer>
  </body>
</html>

