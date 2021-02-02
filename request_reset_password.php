<?php  
session_start();

$error_message = '';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';
require_once "assets/connect/pdo.php";


if(isset($_POST['email'])){

	$emailTo = $_POST['email'];
	$code = uniqid(true);

	// inserting the code and email in the resetPasswords table
	$sql = "INSERT INTO Reset_Password(code, email) VALUES(:code, :email)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['code' => $code, 'email' => $emailTo]);

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'luexamhive@gmail.com';                     // SMTP username
	    $mail->Password   = 'examhive44';                               // SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom('luexamhive@gmail.com', 'LU Exam Hive');
	    $mail->addAddress($emailTo);     // Add a recipient
	    $mail->addReplyTo('no-reply@mail.com', 'No reply');

	    // Content
	    $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/reset_password.php?code=$code";
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Your password reset link';
	    $mail->Body    = "<h2>You requested for a password reset</h2>
	    				  <br>
	    				  <p>Click <a href='$url'>this link</a> to reset</p>
	    				  <br>
	    				  <p>Note: If you haven't requested for any password reset please ignore this email or delete it</p>";
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    $_SESSION['Sent'] = 'Reset password link has been sent to your email. You may close this tab.';
	} catch (Exception $e) {

            $error_message = "<label class='text-danger'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</label>";
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
		<a class="navbar-brand" href="#">LU EXAM HIVE</a>
		<button type="button" class="btn btn-sm btn-dark rounded-0 ml-3">
		<a href="index.php" class="text-white text-decoration-none">Back</a>
	</nav>

	</header>
	<main>
    <div class="container">
      <div class="row">
        <div class="col d-flex justify-content-center mt-4">
          <h2 class="display-4 ">Forgot Password?</h2>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex justify-content-center mt-4">
          <p>Request for a reset password link.</p>
        </div>
      </div>

      <div class="col d-flex justify-content-center ">
      <?php
		if (isset($_SESSION['Sent'])) {
		    echo ('<p style="color: green;">' . htmlentities($_SESSION['Sent']) . "</p>\n");
		    unset($_SESSION['Sent']);
		}
	  ?>
      <?php echo $error_message; ?>
      </div>
      
      <form method="POST" action="request_reset_password.php">
        <div class="form-group">
        <div class="row">
          <div class="col"></div>
        <div class="col-xl-7 col-lg-7 col-md-9 col-sm-10 col-xs-6">

          <div class="row ">
            <div class="col">
				<input type="email" name="email" placeholder="Email" class="form-control" required>

			</div>
          </div>

          <div class="row mt-3">
            <div class="col d-flex justify-content-center">
              <input type="submit" name="submit" value="Send reset link via email" class="btn btn-dark my-3">
            </div>
          </div>
          </div>
          <div class="col"></div>
      </div>
        </div>
      </form>

      <div class="row">
        <div class="col d-flex justify-content-center mt-4">
          <p>Note: If your email doesn't exist in our database, the data you will provide will not affect our database.</p>
        </div>
      </div>
	
	


  </div>

  </main>


  <?php
require_once "assets/connect/footer.php";
?>
