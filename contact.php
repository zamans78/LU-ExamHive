<?php
//Head Links
require_once 'assets/connect/pdo.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';

// Create object of PHPMailer class
$mail = new PHPMailer(true);

$output = '';

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	try {
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		// Gmail ID which you want to use as SMTP server
		$mail->Username = 'luexamhive@gmail.com';
		// Gmail Password
		$mail->Password = 'examhive44';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = 587;

		// Email ID from which you want to send the email
		$mail->setFrom($email);
		// Recipient Email ID where you want to receive emails
		$mail->addAddress('luexamhive@gmail.com');

		$mail->isHTML(true);
		$mail->Subject = "$name contacted via contact form.";
		$mail->Body = "<p><b>Name :</b> $name <br><b>Email :</b> $email <br><b>Message :</b> $message</p>";

		$mail->send();
		$output = "<div class='alert alert-success'>
                  <label>Thank you! $name for contacting us, We will get back to you shortly!</label>
                </div>";

		// inserting the code and email in the resetPasswords table
		$sql = "INSERT INTO Contact_Us(name, email, message) VALUES(:name, :email, :message)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(['name' => $name, 'email' => $email, 'message' => $message]);
	} catch (Exception $e) {
		$output = '<div class="alert alert-danger">
                  <label>' . $e->getMessage() . '</label>
                </div>';
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
				<a type="button" href="javascript:history.back(1)" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
			</div>
		</nav>
	</header>

	<!--Contact us Start(1712020128) -->

	<main>
		<div class="container">
			<h2 class="display-4 mt-4">Contact Us</h2>

			<div class="row">
				<div class="col mt-3">
					<p class="text-justify">Contact us for any help. Please state your inquery clearly!</p>
				</div>
			</div>
			<form action="contact.php" method="POST">

				<div class="form-group">
					<div class="row">
						<div class="col">

							<?php echo $output; ?>

						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col">
							<input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
						</div>
						<div class="col">
							<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col">
							<div class="mb-3">
								<textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="8" placeholder="Your text"></textarea>
								<div class="d-flex justify-content-end">
									<input class="btn btn-dark mt-3" id="btn" name="submit" type="submit" value="Submit">
								</div>
							</div>
						</div>
					</div>
				</div>

			</form>

		</div>
	</main>

	<!--Contact us End(1712020128) -->

	<?php
	//Head Links
	require_once 'assets/connect/footer.php';
	?>
</body>

</html>