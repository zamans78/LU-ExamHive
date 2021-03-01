<?php
session_start();
require_once "assets/connect/pdo.php";

//Form Validation
if (isset($_POST['Admin_Email']) && isset($_POST['Password']) && isset($_POST['login'])) {

    //Checks length of email & password
    if (strlen($_POST['Admin_Email']) < 1 || strlen($_POST['Password']) < 1) {
        $_SESSION['error'] = "Admin Email and Password are required";
        header("Location: admin_login.php");
        return;
    }
    //Checks email format.
    else if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $_POST["Admin_Email"])) {
        $_SESSION['error'] = "Email is not valid.";
        header("Location: admin_login.php");
        return;
    }
    //If Credentials are Correct:
    else {

        $salt = '6JDs,=+w^q;-57Qc,Zz:g[=8[r==FC';
        $check = md5($salt . $_POST['Password']);

        $stmt = $pdo->prepare('SELECT Admin_ID FROM admin WHERE Admin_Email = :em AND Password = :pw');
        $stmt->execute(array(':em' => $_POST['Admin_Email'], ':pw' => $check));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row !== false) {
            $_SESSION['Admin_ID'] = $row['Admin_ID'];
            header("Location: admin_dashboard.php");
            return;
        } else {
            $_SESSION['error'] = "Incorrect password or Email";
            error_log("Login fail " . $_POST['Admin_Email'] . " $check");
            header("Location: admin_login.php");
            return;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php
//Head Links
require_once 'assets/connect/head.php';
?>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <div class="container justify-content-start">
      <a class="navbar-brand" href="index.php"><img id="logo" src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="row">
        <div class="col"></div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-5">
          <div class="card my-5 shadow-lg p-3 my-5 bg-white rounded">
            <div class="card-body">
              <h5 class="card-title">Admin Login</h5>
              <?php
if (isset($_SESSION['error'])) {
    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
    unset($_SESSION['error']);
}
?>
              <form method="POST" action="admin_login.php">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="Admin_Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="Password" class="form-control" id="exampleInputPassword1">
                </div>
                <input type="submit" class="btn btn-dark" name="login" value="Log in">
              </form>
            </div>
          </div>
        </div>
        <div class="col"></div>

      </div>
    </div>
  </main>

  <!--footer Start -->
  <?php
require_once 'assets/connect/footer.php';
?>
  <!--footer End -->

</body>

</html>