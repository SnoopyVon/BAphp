<?php
$name = '';
$email = '';
$username = '';
$password = '';
$confirmPassword = '';
$nameError = '';
$emailError = '';
$usernameError = '';
$passwordError = '';
$confirmPasswordError = '';
$successMessage = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Name validation uses preg_match() for letters and spaces only.
    if ($name == '') {
        $nameError = 'Please enter your full name.';
    } elseif (preg_match('/^[A-Za-z ]+$/', $name) == 0) {
        $nameError = 'Full name must contain letters and spaces only.';
    }

    // Email validation uses filter_var(), as required by the lesson.
    if ($email == '') {
        $emailError = 'Please enter your email address.';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $emailError = 'Please enter a valid email address.';
    }

    // Username validation uses preg_match() only.
    if ($username == '') {
        $usernameError = 'Please choose a username.';
    } elseif (preg_match('/^[A-Za-z0-9_]{5,15}$/', $username) == 0) {
        $usernameError = 'Username must be 5-15 characters using letters, numbers, or underscores.';
    }

    // Password validation uses isset() and basic checks only.
    if (!isset($_POST['password']) || $password == '') {
        $passwordError = 'Please create a password.';
    }

    if (!isset($_POST['confirm_password']) || $confirmPassword == '') {
        $confirmPasswordError = 'Please confirm your password.';
    } elseif ($confirmPassword != $password) {
        $confirmPasswordError = 'Passwords do not match.';
    }

    if ($nameError == '' && $emailError == '' && $usernameError == '' && $passwordError == '' && $confirmPasswordError == '') {
        $successMessage = 'Registration successful. Your information passed validation.';
    }
}

$pageTitle = 'Register';
$pageClass = 'register-page';
include 'header.php';
?>
<div class="container-fluid d-flex align-items-center justify-content-center min-vh-100">
  <div class="card shadow register-card p-0">
    <div class="row g-0">
      <div class="col-md-5 left-side d-flex flex-column justify-content-center align-items-center text-white p-4">
        <h2 class="display-6 fw-bold mb-3">Get Started</h2>
        <p class="lead fw-light mb-3">Already have an account?</p>
        <a href="login.php" class="btn btn-outline-light rounded-pill px-4 fw-semibold">Log in</a>
      </div>

      <main class="col-md-7 bg-white p-4 p-md-5">
        <h2 class="text-center mb-4">Create New Account</h2>
        <?php if ($successMessage != '') { echo '<div class="alert alert-success">' . $successMessage . '</div>'; } ?>

        <!-- Self-processing form: the form submits back to register.php. -->
        <form method="post" action="" autocomplete="off">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name <i class="bi bi-person-vcard"></i></label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
            <?php if ($nameError != '') { echo '<div class="validation-error">' . $nameError . '</div>'; } ?>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email Address <i class="bi bi-at"></i></label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
            <?php if ($emailError != '') { echo '<div class="validation-error">' . $emailError . '</div>'; } ?>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username <i class="bi bi-person"></i></label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
            <?php if ($usernameError != '') { echo '<div class="validation-error">' . $usernameError . '</div>'; } ?>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password <i class="bi bi-lock"></i></label>
            <input type="password" class="form-control" id="password" name="password">
            <?php if ($passwordError != '') { echo '<div class="validation-error">' . $passwordError . '</div>'; } ?>
          </div>
          <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password <i class="bi bi-lock"></i></label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            <?php if ($confirmPasswordError != '') { echo '<div class="validation-error">' . $confirmPasswordError . '</div>'; } ?>
          </div>
          <button type="submit" name="submit" class="btn btn-primary mb-3 w-100 rounded-pill px-4">Sign Up</button>
        </form>
      </main>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
