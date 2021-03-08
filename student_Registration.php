<?php
session_start();
require_once "assets/connect/pdo.php";

$FirstName = $LastName = $Student_ID = $Student_Email = $Batch = $Section = '';

$message = '';
$error_Student_ID = '';
$error_FirstName = '';
$error_LastName = '';
$error_Student_Email = '';
$error_Password = '';
$error_Batch = '';
$error_Section = '';

if (isset($_POST["Register"]) && isset($_POST["Student_ID"]) && isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["Student_Email"]) && isset($_POST["Password"]) && isset($_POST["Batch"]) && isset($_POST["Section"])) {

  //Student ID Check.
  if (empty($_POST["Student_ID"])) {
    $error_Student_ID = "<label class='text-danger'>Enter Student_ID</label>";
  } else if (strlen($_POST["Student_ID"]) < 10 || strlen($_POST["Student_ID"]) > 10) {
    $error_Student_ID = "<label class='text-danger'>Student ID must have 10 digits.</label>";
  } else {
    $Student_ID = trim($_POST["Student_ID"]);
    $Student_ID = htmlentities($Student_ID);
  }

  //Student Email Check.
  if (empty($_POST["Student_Email"])) {
    $error_Student_Email = '<label class="text-danger">Enter Email Address</label>';
  } else {
    $Student_Email = trim($_POST["Student_Email"]); //Left & Right space is removed.
    if (!filter_var($Student_Email, FILTER_VALIDATE_EMAIL)) {
      $error_Student_Email = '<label class="text-danger">Enter Valid Email Address</label>';
    }
  }
  //Student Password Check.
  if (mb_strlen($_POST["Password"]) <= 8) {
    $error_Password = "<label class='text-danger'>Your Password Must Contain At Least 8 Characters!</label>";
  } elseif (!preg_match("#[0-9]+#", $_POST["Password"])) {
    $error_Password = "<label class='text-danger'>Your Password Must Contain At Least 1 Number!</label>";
  } elseif (!preg_match("#[A-Z]+#", $_POST["Password"])) {
    $error_Password = "<label class='text-danger'>Your Password Must Contain At Least 1 Capital Letter!</label>";
  } elseif (!preg_match("#[a-z]+#", $_POST["Password"])) {
    $error_Password = "<label class='text-danger'>Your Password Must Contain At Least 1 Lowercase Letter!</label>";
  } elseif (!preg_match("#[\W]+#", $_POST["Password"])) {
    $error_Password = "<label class='text-danger'>Your Password Must Contain At Least 1 Special Character!</label>";
  } else {
    $Password_polish = trim($_POST["Password"]);
    $salt = '8JDs,=-w^q;-57Jc,ZP:g[=8[r+=FC';
    $Password = md5($salt . $Password_polish);
  }
  //Student First Name Check.
  if (empty($_POST["FirstName"])) {
    $error_FirstName = "<label class='text-danger'>Enter FirstName</label>";
  } else {
    $FirstName = trim($_POST["FirstName"]);
    $FirstName = htmlentities($FirstName);
  }
  //Student Last Name Check.
  if (empty($_POST["LastName"])) {
    $error_LastName = "<label class='text-danger'>Enter LastName</label>";
  } else {
    $LastName = trim($_POST["LastName"]);
    $LastName = htmlentities($LastName);
  }

  //Student Batch Check.
  if (empty($_POST["Batch"])) {
    $error_Batch = "<label class='text-danger'>Enter Batch</label>";
  } else {
    $Batch = trim($_POST["Batch"]);
    $Batch = htmlentities($Batch);
  }

  //Student Section Check.
  if (empty($_POST["Section"])) {
    $error_Section = "<label class='text-danger'>Enter Section</label>";
  } else if (strlen($_POST["Section"]) > 1) {
    $error_Section = "<label class='text-danger'>Multiple Section not Allowed.</label>";
  } else {
    $Section = trim($_POST["Section"]);
    $Section = htmlentities($Section);
  }

  if ($error_Student_ID == '' && $error_FirstName == '' && $error_LastName == '' && $error_Student_Email == '' && $error_Password == '' && $error_Batch == '' && $error_Section == '') {

    $Student_Activation_Code = md5(rand());
    $Student_Otp = rand(100000, 999999);
    $data = array(
      ':Student_ID' => $Student_ID,
      ':FirstName' => $FirstName,
      ':LastName' => $LastName,
      ':Student_Email' => $Student_Email,
      ':Password' => $Password,
      ':Batch' => $Batch,
      ':Section' => $Section,
      ':Student_Activation_Code' => $Student_Activation_Code,
      ':Student_Email_Status' => 'not verified',
      ':Student_Otp' => $Student_Otp,
    );
    //Query to insert unique user data into register_user table.(Will only execute if email is not present in database table)
    $query = "
		INSERT INTO student(Student_ID, FirstName, LastName,Student_Email,Password,Batch,Section, Student_Activation_Code, Student_Email_Status, Student_Otp)
		SELECT * FROM (SELECT :Student_ID, :FirstName, :LastName, :Student_Email,:Password, :Batch, :Section,:Student_Activation_Code, :Student_Email_Status, :Student_Otp) AS tmp
		WHERE NOT EXISTS (SELECT Student_ID FROM student WHERE Student_ID = :Student_ID) LIMIT 1";
    $statement = $pdo->prepare($query); //Makes qurey for execution.
    $statement->execute($data);

    //Check if email unique or not.
    if ($pdo->lastInsertId() == 0) { //lastInsertId() returns last inserted id.

      $message = '<label class="text-danger">This Student ID is Already Registerd.</label>';
    } else {
      require 'assets/phpmailer/class.phpmailer.php';
      require 'assets/phpmailer/class.smtp.php';
      $mail = new PHPMailer;

      $mail->SMTPDebug = 3; // Enable verbose debug output
      $mail->isSMTP(); // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
      $mail->SMTPAuth = true; // Enable SMTP authentication
      $mail->Username = 'luexamhive@gmail.com'; // SMTP username
      $mail->Password = 'examhive44'; // SMTP password
      $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587; // TCP port to connect to

      $mail->setFrom('luexamhive@gmail.com', 'LU EXAM HIVE');
      $mail->addAddress($_POST['Student_Email']); // Add a recipient
      $mail->isHTML(true); // Set email format to HTML
      $mail->Subject = 'LU EXAM HIVE Email Verification Code.';
      $message_body = '
        <p>For verifying your email address,enter the provided verification code: <b>' . $Student_Otp . '</b>.</p>
        <p>Sincerely,</p>
        <p>LU Authority.</p>
        ';
      $mail->Body = $message_body;

      if ($mail->Send()) {
        $_SESSION['Success'] = 'Please Check Your Email for Verification Code.';
        header('location:otp.php?code=' . $Student_Activation_Code);
      } else {
        $message = $mail->ErrorInfo;
      }
      $message = '<label class="text-danger">Email Already Registerd.</label>';
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
        <a type="button" href="student_login.php" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
      </div>
    </nav>
  </header>

  <!--Student Registration Start -->
  <main>
    <div class="container">

      <div class="row">
        <div class="col d-flex justify-content-center mt-4">
          <h2 class="display-4 ">Student Registration</h2>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex justify-content-center mt-3">
          <p class="">New Students may register using the form below. Already registered? <a href="student_login.php">Log in</a> instead.</p>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex justify-content-center mt-4">
          <?php echo $message; ?>
        </div>
      </div>
      <form method="POST" action="student_Registration.php">
        <div class="form-group">
          <div class="row">
            <div class="col"></div>
            <div class="col-xl-7 col-lg-7 col-md-9 col-sm-10 col-xs-6">
              <div class="row mt-3">
                <div class="col">
                  <label for="">First Name</label>
                  <input type="text" name="FirstName" class="form-control" value="<?php echo $FirstName ?>">
                  <?php echo $error_FirstName; ?>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col">
                  <label for="">Last Name</label>
                  <input type="text" name="LastName" class="form-control" value="<?php echo $LastName ?>">
                  <?php echo $error_LastName; ?>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col">
                  <label for="">Student Id</label>
                  <input type="number" name="Student_ID" class="form-control" value="<?php echo $Student_ID ?>">
                  <?php echo $error_Student_ID; ?>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col">
                  <label for="">Email</label>
                  <input type="email" name="Student_Email" class="form-control" value="<?php echo $Student_Email ?>">
                  <?php echo $error_Student_Email; ?>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col">
                  <label for="">Password</label>
                  <div class="form-group">
                  <div class="input-group">
                  <input type="password" name="Password" class="form-control" id="exampleInputPassword1">
                  <div class="input-group-append">
                    <span class="input-group-text bg-transparent border-left-0" onclick = "togglePassword()"><i id="hide1" class="fa fa-eye" style="display:none" ></i>
                    <i id="hide2" class="fa fa-eye-slash"></i></span>
                  </div>
                  </div>
                  <?php echo $error_Password; ?>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col">
                  <label for="">Batch</label>
                  <input type="number" name="Batch" class="form-control" value="<?php echo $Batch ?>">
                  <?php echo $error_Batch; ?>
                </div>

                <div class="col">
                  <label for="">Section</label>
                  <input type="text" name="Section" class="form-control" value="<?php echo $Section ?>">
                  <?php echo $error_Section; ?>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col d-flex justify-content-end">
                  <input class="btn btn-dark my-3" name="Register" id="btn" type="submit" value="Submit">
                </div>
              </div>
            </div>
            <div class="col"></div>
          </div>
        </div>
      </form>
    </div>
  </main>
  <!--Student Registration End-->


  <!--footer Start -->
  <?php
  require_once 'assets/connect/footer.php';
  ?>
  <!--footer End -->
</body>

</html>