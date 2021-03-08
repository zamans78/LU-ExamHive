<?php
require "assets/connect/pdo.php";

$Updated = '';
$log_in = '';
if (!isset($_GET["code"])) {
  exit("Can't find page. Please try again.");
}
// getting the code from the link as it comes as the from of a query parameter
$code = $_GET["code"];


// getting the email from resetPasswords table by checking if it has a row that contains the code
$sqlEmail = "SELECT email FROM Reset_Password WHERE code='$code'";
$stmt = $pdo->prepare($sqlEmail);
$stmt = $pdo->query($sqlEmail);


// getting the password from input field
if (isset($_POST["password"])) {
  $salt = '8JDs,=-w^q;-57Jc,ZP:g[=8[r+=FC';
  $Password = md5($salt . $_POST['password']);

  //fething to get the email from resetPasswords table
  $row = $stmt->fetch();
  $email = $row["email"] ??= 'default value';

  // updating the password in the main table where the email matches with the fetched email
  $sql = "UPDATE Student SET Password='$Password' WHERE Student_Email='$email'";
  $stmt = $pdo->prepare($sql);
  $stmt = $pdo->query($sql);

  // deleting the record from resetPasswords table once the password is changed
  if ($stmt) {
    $sql = "DELETE FROM Reset_Password WHERE code='$code'";
    $stmt = $pdo->prepare($sql);
    $stmt = $pdo->query($sql);
    $Updated = "Password updated! Go back to";
    $log_in = "log in page.";
  } else {
    exit("Something went wrong");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
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
        <div class="col d-flex justify-content-center mt-4">
          <h2 class="display-4 ">Change your password</h2>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex justify-content-center mt-4">
          <p>Do not use any old password. Try making it as secure as possilble.</p>
        </div>
      </div>

      <div class="col d-flex justify-content-center ">
        <?php echo ('<p style="color: green;">' . $Updated . "</p>\n" . '&nbsp;' . '<a href="student_login.php">' . $log_in . '</a>'); ?>
      </div>

      <form method="POST">
        <div class="form-group">
          <div class="row">
            <div class="col"></div>
            <div class="col-xl-7 col-lg-7 col-md-9 col-sm-10 col-xs-6">

            <div class="row ">
                <div class="col">
                  <div class="form-group">
                  <div class="input-group">
                  <input type="password" name="password" placeholder="New Password" class="form-control" required id="exampleInputPassword1">
                  <div class="input-group-append">
                    <span class="input-group-text bg-transparent border-left-0" onclick = "togglePassword()"><i id="hide1" class="fa fa-eye" style="display:none" ></i>
                    <i id="hide2" class="fa fa-eye-slash"></i></span>
                  </div>
                  </div>
                  </div>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col d-flex justify-content-center">
                  <input type="submit" name="submit" value="Update Password" class="btn btn-dark my-3">
                </div>
              </div>
            </div>
            <div class="col"></div>
          </div>
        </div>
      </form>




    </div>

  </main>


  <?php
  require_once "assets/connect/footer.php";
  ?>