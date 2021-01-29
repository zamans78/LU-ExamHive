<?php
session_start();
require_once "assets/connect/pdo.php";

$error_Student_Otp = '';
$Student_Activation_Code = '';
$message = '';

//If url consists of code key.(Generated in URL just after )
if (isset($_GET["code"])) {
    $Student_Activation_Code = $_GET["code"];
    $_SESSION['code'] = $Student_Activation_Code;
}
//If submit button is pressed.
if (isset($_POST["check"])) {

    //If OTP is not present in Post.
    if (empty($_POST["Student_Otp"])) {
        $error_Student_Otp = 'Enter OTP Number';
    } else {
        //This query will search entered data with data in refister_user table
        $query = "
			SELECT * FROM student
			WHERE Student_Activation_Code = '" . $_SESSION['code'] . "'
			AND Student_Otp = '" . trim($_POST["Student_Otp"]) . "'
			";

        $statement = $pdo->prepare($query); //Make query for execution.
        $statement->execute(); //Will execute above query.
        //Total no of row affected after abve execution.
        $total_row = $statement->rowCount();
        //If true then entered OTP has matched OTP number in database.
        if ($total_row > 0) {
            $query = "
				UPDATE student
				SET Student_Email_Status = 'verified'
				WHERE Student_Activation_Code = '" . $_SESSION['code'] . "'
				";
            $statement = $pdo->prepare($query);
            if ($statement->execute()) {
                $_SESSION['registered'] = 'Your Registration is Complete.You may login in.';
                header('location:student_login.php');
            }
        } else {
            //For invalid OTP number
            $message = '<label class="text-danger">Invalid OTP Number</label>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php
require_once "assets/connect/head.php";
?>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <a class="navbar-brand" href="#">LU EXAM HIVE</a>
      <button type="button" class="btn btn-sm btn-dark rounded-0 ml-3">
        <a href="index.php" class="text-white text-decoration-none">Back</a>
    </nav>
  </header>

  <!-- OTP Start(128) -->
  <main>
    <div class="container">
      <div class="row">
        <div class="col d-flex justify-content-center mt-4">
          <h2 class="display-4 ">OTP Verification</h2>
        </div>
      </div>
      <div class="col d-flex justify-content-center ">
      <?php
if (isset($_SESSION['Success'])) {
    echo ('<p style="color: green;">' . htmlentities($_SESSION['Success']) . "</p>\n");
    unset($_SESSION['Success']);
}
?>
      <?php echo $message; ?>
      </div>

      <form method="POST" action="otp.php">
        <div class="form-group">
        <div class="row">
          <div class="col"></div>
        <div class="col-xl-7 col-lg-7 col-md-9 col-sm-10 col-xs-6">

          <div class="row ">
            <div class="col">
              <label for=""></label>
              <input type="number"  name="Student_Otp" class="form-control" required>
              <?php echo $error_Student_Otp; ?>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col d-flex justify-content-center">
              <input class="btn btn-dark my-3" id="btn" type="submit" name="check" value="Submit">
            </div>
          </div>
          </div>
          <div class="col"></div>
      </div>
        </div>
      </form>

  </div>

  </main>
  <!--OTP End(128) -->

<?php
require_once "assets/connect/footer.php";
?>
</body>

</html>