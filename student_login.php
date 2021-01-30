<?php
session_start();
require_once "assets/connect/pdo.php";

//Form Validation
if (isset($_POST['Student_Email']) && isset($_POST['Password']) && isset($_POST['login'])) {

    //Checks length of email & password
    if (strlen($_POST['Student_Email']) < 1 || strlen($_POST['Password']) < 1) {
        $_SESSION['error'] = "User name and password are required";
        header("Location: student_login.php");
        return;

        //Checks email format.
    } else if (strpos($_POST['Student_Email'], "@") === false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: student_login.php");
        return;

        //If Credencials are Correct:
    } else {

        $salt = '8JDs,=-w^q;-57Jc,ZP:g[=8[r+=FC';
        $Password = md5($salt . $_POST['Password']);
        $Student_Email_Status = 'verified';

        $stmt = $pdo->prepare('SELECT Student_ID FROM student WHERE Student_Email = :em AND Password = :pw AND Student_Email_Status = :ses');
        $stmt->execute(array(':em' => $_POST['Student_Email'], ':ses' => $Student_Email_Status, ':pw' => $Password));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row !== false) {
            $_SESSION['Student_ID'] = $row['Student_ID'];
            header("Location: posts.php");
            return;
        } else {
            $_SESSION['error'] = "Incorrect password or Email";
            header("Location: student_login.php");
            return;
        }
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

	<!--Student Login/Registration Start -->
	<main>
		<div class="container">
			<div class="row  mt-5 mb-5">

				<!--Column 1 -->
				<div class="col-lg-6  col-sm-12 order-xl-2 order-lg-2 order-md-1 order-sm-1 order-xs-1">
					<div class=" d-md-none d-lg-block d-sm-none">
						<div class="col-sm-8 col-lg-10">
							<img src="assets/images/student.jpg" class="card-img" alt="Student">
						</div>
						<div class="container my-4">
							<h1 class="my-2 display-4">Student Login/Registration</h1>
							<p>Press enter on the card above.</p>
							<p class="my-3">Pressing the button will redirect you to the teacher dashboard.</p>
						</div>
					</div>

					<h1 class="my-2 display-4 d-none d-md-block d-sm-block d-lg-none mb-4 text-center">Student
						Login/Registration</h1>
				</div>

    <!--Column 2 -->

				<div
     class="col-lg-6 col-md-12 col-sm-12 align-self-center order-xl-1 order-lg-1 order-md-2 order-sm-2 order-xs-2">
     <?php
if (isset($_SESSION['error'])) {
    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
    unset($_SESSION['error']);
} else if (isset($_SESSION['registered'])) {
    echo ('<p style="color: green;">' . htmlentities($_SESSION['registered']) . "</p>\n");
    unset($_SESSION['registered']);
}
?>
						<form method="POST" action="student_login.php">
						<div class="form-group w-75 ">
							<input type="email" name="Student_Email" class="form-control " id="exampleInputEmail1"
								aria-describedby="emailHelp" placeholder="email...">
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
								else.</small>
						</div>
						<div class="form-group w-75">

							<input type="password" name="Password" class="form-control" id="exampleInputPassword1"
								placeholder="password...">
						</div>
						<div class="w-75 d-flex justify-content-end">
							<button type="submit" class="btn btn-dark"><a class="text-white text-decoration-none" href="student_Registration.php">Register</a></button>
							<button type="submit" name="login" class="btn btn-dark ml-2">Login</button>
						</div>
     </form>

				</div>
			</div>
		</div>
	</main>
	<!--Student Login/Registration Start -->

<!--footer Start -->
<?php
require_once 'assets/connect/footer.php';
?>
<!--footer End -->
</body>

</html>