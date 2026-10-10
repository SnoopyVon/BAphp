<?php
$username = '';
$password = '';
$usernameError = '';
$passwordError = '';
$loginError = '';
$loginSuccess = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Username validation uses preg_match(), as required by the lesson.
    if ($username == '') {
        $usernameError = 'Please enter your username.';
    } elseif (preg_match('/^[A-Za-z0-9_]{5,15}$/', $username) == 0) {
        $usernameError = 'Username must be 5-15 characters using letters, numbers, or underscores.';
    }

    // Password validation uses isset() and a basic length check.
    if (!isset($_POST['password']) || $password == '') {
        $passwordError = 'Please enter your password.';
    }

    // Without sessions or a database, login uses a simple static account.
    if ($usernameError == '' && $passwordError == '') {
        if ($username == 'admin1' && $password == 'Admin123') {
            $loginSuccess = 'Login successful. Welcome to the landing page.';
        } else {
            $loginError = 'Incorrect username or password.';
        }
    }
}

$pageTitle = 'Login';
$pageClass = 'login-page';
include 'header.php';
?>
<div class="container-fluid min-vh-100">
  <div class="row min-vh-100">
    <div class="col-lg-8 h-100 d-none d-lg-block">
      <div class="row h-100">
        <div class="col-4 image-col"></div>
        <div class="col-4 image-col"></div>
        <div class="col-4 image-col"></div>
      </div>
    </div>

    <main class="col-lg-4 login-panel d-flex flex-column justify-content-center align-items-center p-4 py-5">
      <div class="logo"><h1>A</h1><p>ARCHITECTS</p></div>
      <div class="mb-3 greeting"><h2>Welcome back</h2><p class="subtext">Sign in to your studio account</p></div>

      <?php
      if ($loginError != '') {
          echo '<div class="alert alert-danger w-100 form-max-width">' . $loginError . '</div>';
      }
      if ($loginSuccess != '') {
          echo '<div class="alert alert-success w-100 form-max-width">' . $loginSuccess . '</div>';
      }
      ?>

      <!-- This is a self-processing POST form. -->
      <form method="post" action="" class="w-100 form-max-width">
        <div class="mb-3">
          <label for="username" class="form-label">Username <i class="bi bi-person"></i></label>
          <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
          <?php if ($usernameError != '') { echo '<div class="validation-error">' . $usernameError . '</div>'; } ?>
        </div>
        <div class="mb-2">
          <label for="password" class="form-label">Password <i class="bi bi-lock"></i></label>
          <input type="password" class="form-control" id="password" name="password">
          <?php if ($passwordError != '') { echo '<div class="validation-error">' . $passwordError . '</div>'; } ?>
        </div>
        <div class="text-start mb-4"><a href="#" class="text-muted small text-decoration-none">Forgot Password</a></div>
        <button type="submit" name="submit" class="btn btn-dark rounded-pill py-2 fw-semibold w-100">LOGIN</button>
      </form>

      <div class="text-center mt-4"><p class="small text-muted">Don't have an account? <a href="register.php" class="text-decoration-none">Sign Up</a></p></div>
      <div class="text-center"><blockquote class="quote-text">"Architecture is the thoughtful making of space for human experience."</blockquote><p class="quote-author">&mdash; Louis I. Kahn</p></div>
    </main>
  </div>
</div>
<?php include 'footer.php'; ?>
