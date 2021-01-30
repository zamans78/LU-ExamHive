<?php
session_start();
require_once "assets/connect/pdo.php";

//Form Validation
if (isset($_POST['Teacher_Email']) && isset($_POST['pass']) && isset($_POST['login'])) {

    //Checks length of email & password
    if (strlen($_POST['Teacher_Email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = "User name and password are required";
        header("Location: teacher_Login.php");
        return;

        //Checks email format.
    } else if (strpos($_POST['Teacher_Email'], "@") === false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: teacher_Login.php");
        return;

        //If Credentials are Correct:
    } else {

        $salt = '6JDs,=+w^q;-57Qc,Zz:g[=8[r==FC';
        $check = md5($salt . $_POST['pass']);

        $stmt = $pdo->prepare('SELECT Teacher_ID, Name FROM teacher WHERE Email = :em AND Password = :pw');
        $stmt->execute(array(':em' => $_POST['email'], ':pw' => $check));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row !== false) {
            $_SESSION['Teacher_ID'] = $row['Teacher_ID'];
            $_SESSION['Name'] = $row['Name'];
            header("Location: teacher_dashboard.php");
            return;
        } else {
            $_SESSION['error'] = "Incorrect password or Email";
            error_log("Login fail " . $_POST['Teacher_Email'] . " $check");
            header("Location: teacher_Login.php");
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
			<a class="navbar-brand" href="#">LU EXAM HIVE</a>
			<button type="button" class="btn btn-sm btn-dark rounded-0 ml-3">
				<a href="index.php" class="text-white text-decoration-none">Back</a>
		</nav>
	</header>

	<!--Teacher Registration Start -->
	<main>
		<div class="container">
			<div class="row  mt-5 mb-5">

				<!--Column 1 -->
				<div class="col-lg-6  col-sm-12 ">

					<div class=" d-md-none d-lg-block d-sm-none">
						<div class="col-sm-8 col-lg-10">
							<img src="assets/images/teacher.jpg" class="card-img" alt="Teacher">
						</div>
						<div class="container my-4">
							<h1 class="my-2 display-4">Teacher Login</h1>
							<p>Press enter on the card above.</p>
							<p class="my-3">Pressing the button will redirect you to the teacher dashboard.</p>
						</div>
					</div>

					<h1 class="my-2 display-4 d-none d-md-block d-sm-block d-lg-none mb-4 text-center">Teacher Login
					</h1>
				</div>

        <!--Column 2 -->

				<div class="col-lg-6 col-md-12 col-sm-12 align-self-center">
<?php
if (isset($_SESSION['error'])) {
    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
    unset($_SESSION['error']);
}
?>
					<form method="POST" action="teacher_Login.php">
						<div class="form-group w-75 ">
							<input type="email" name="Teacher_Email" class="form-control " id="exampleInputEmail1"
								aria-describedby="emailHelp" placeholder="email...">
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
								else.</small>
						</div>
						<div class="form-group w-75">

							<input type="password" name="pass" class="form-control" id="exampleInputPassword1"
								placeholder="password...">
						</div>
						<div class="w-75 d-flex justify-content-end">
							<button type="submit" name="login" class="btn btn-dark ml-1">Login</button>
						</div>
     </form>

				</div>
			</div>
		</div>
	</main>
	<!--Teacher Registration End -->


<!--footer Start -->
<?php
require_once 'assets/connect/footer.php';
?>
<!--footer End -->

</body>

</html>