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


if (isset($_POST['email'])) {

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
		$mail->Subject = 'Reset password instructions';
		$mail->Body    = "<body style='color: #424647; font-size: 16px; text-decoration: none; font-family: Helvetica, Arial, sans-serif; background-color: #dee2e3;'>

		<div id='wrapper' style='max-width: 600px; margin: auto auto; padding: 20px;'>
	
			<div id='logo'>
				<center><h1 style='margin: 0px; margin: 16px 0px;'><a href='#' target='_blank'><img style='max-height: 75px;' src='https://imgur.com/RiQuBgl.png'></a></h1></center>
			</div>
	
			<div id='hr'>
				<hr style='border: 1px solid #8b8f90;'>
			</div>
	
			<div id='message'>
				<h1>Hello,</h1>
	
				<p style='font-size: 20px;'>Someone has requested a link to change your password. You can do this through the button below.</p>
	
				<p style='display: flex; justify-content: center; margin-top: 10px;'>
					<center>
						<a href='$url' target='_blank' style='border: 1px solid #17163e; border-radius: 5px; background-color: #444857; color: #fff; text-decoration: none; font-size: 18px; padding: 10px 20px;'>Change my password</a>
					</center>
				</p>
	
				<p style='font-size: 14px; padding: 16px 0px;'>If you didn't request this, please ignore this email. Your password won't change until you access the link above and create a new one.</p>
	
				<p>Thank you,</p>
				<p>LU Exam Hive Team.</p>
			</div>
	
			<div id='hr'>
				<hr style='border: 1px solid #8b8f90;'>
			</div>
	
			<center id='footer'>
	
				<div style='line-height: 2px;'>
					<p>© LU Exam Hive</p>
					<p>A product of Leading University</p>
				</div>
	
				 
				<p style='margin: 0; padding-bottom: 5px;'>This email was sent by:</p>
				<address>
					LU Exam Hive,<br>
					<u>Leading University, Ragib Nagar,</u><br>
					<u>Sylhet, Bangladesh.</u>
				</address>
	
				<div id='hr'>
					<hr style='border: 0.1px transparent #95999a;'>
				</div>
	
				<p style='color: #95999a;'>This eamil is a service from LU Exam Hive. Delivered by PHPMailer.</p>
	
			</center>
	
		</div>
	
	</body>";
		$mail->AltBody = 'Click this link to reset password-> $url';

		$mail->send();
		$_SESSION['Sent'] = 'Reset password link has been sent to your email. You may close this tab.';
	} catch (Exception $e) {

		$error_message = "<label class='alert alert-danger'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</label>";
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
				<a type="button" href="student_login.php" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
			</div>
		</nav>

	</header>
	<main>
		<div class="container">
			<div class="row text-center">
				<div class="col d-flex justify-content-center mt-4">
					<h2 class="display-4 ">Forgot Password?</h2>
				</div>
			</div>
			<div class="row">
				<div class="col d-flex justify-content-center mt-4">
					<p>Request for a reset password link.</p>
				</div>
			</div>
			<div class="row">
				<div class="col d-flex justify-content-center ">
					<?php
					if (isset($_SESSION['Sent'])) {
						echo ('<p class="alert alert-success">' . htmlentities($_SESSION['Sent']) . "</p>\n");
						unset($_SESSION['Sent']);
					}
					?>
					<?php echo $error_message; ?>
				</div>
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