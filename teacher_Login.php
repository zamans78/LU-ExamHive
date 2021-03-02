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
    }
    //Checks email format.
    else if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $_POST["Teacher_Email"])) {
        $_SESSION['error'] = "Email is not valid.";
        header("Location: teacher_Login.php");
        return;
    }
    //If Credentials are Correct:
    else {

        $salt = '6JDs,=+w^q;-57Qc,Zz:g[=8[r==FC';
        $check = md5($salt . $_POST['pass']);

        $stmt = $pdo->prepare('SELECT Teacher_ID, Name FROM teacher WHERE Teacher_Email = :em AND Password = :pw');
        $stmt->execute(array(':em' => $_POST['Teacher_Email'], ':pw' => $check));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row !== false) {
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Teacher_ID'] = $row['Teacher_ID'];
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
			<div class="container justify-content-start">
			<a class="navbar-brand" href="index.php"><img id="logo" src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
				<a type="button" href="index.php" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
			</div>
		</nav>
	</header>

	<!--Teacher Registration Start -->
	<main>
	<div class="container">
  <div class="row">

    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 my-5 align-self-center">
    <img src="assets/images/teacher.jpg" class="card-img" alt="Teacher">
	<h1 class="my-2 display-4 d-flex justify-content-center">Teacher Login</h1>
	<p class='ml-2 d-flex justify-content-center'> User passwords are encrypted.</p>
	<p class="my-3 ml-2 d-flex justify-content-center">New user? <a href="contact.php">Reach us to get started</a></p>
	</div>

    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-5 align-self-center">
	<?php
if (isset($_SESSION['error'])) {
    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
    unset($_SESSION['error']);
}
?>
					<form method="POST" action="teacher_Login.php">
						<div class="form-group  ">
							<input type="email" name="Teacher_Email" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email...">
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
								else.</small>
						</div>
						<div class="form-group">

							<input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password...">
						</div>
						<div class="d-flex justify-content-end">
							<button type="submit" name="login" class="btn btn-dark ml-1">Login <i class="fas fa-sign-in-alt"></i></button>
						</div>
					</form>
	</div>


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