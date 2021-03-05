<?php
session_start();
require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Admin_ID'])) {
    header("Location: admin_login.php");
    return;
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
	  <a type="button" href="admin_logout.php" class="btn btn-sm btn-dark ml-auto">Logout<i class="fas fa-door-open"></i></a>
      </div>
    </nav>
  </header>

  <main>

    <div class="container mb-5">
      <div class="row mt-4">
        <div class="col">
          <h3 class="display-4">Admin Dashboard</h3>
        </div>
      </div>

		<div class="container mt-4">
			<div class="row blog-inner justify-content-center">
				<div class="col-lg-4 col-md-6 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<img src="assets/images/adminone.jpg" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title"><p class="text-light bg-dark">Contact Info</p></h5>
							<p class="card-text">View all the messages in the Contact Section.</p>
              <a href="admin_contact_info.php" class="btn btn-dark">See more</a>
						</div>

					</div>
				</div>

				<div class="col-lg-4 col-md-6 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<img src="assets/images/admintwo.jpg" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title"><p class="text-light bg-primary">Teacher Info</p></h5>
							<p class="card-text">View teachers information and Register new Teachers.</p>
              <a href="admin_teacher_info.php" class="btn btn-dark">See more</a>
						</div>

					</div>
				</div>

				<div class="col-lg-4 col-md-12 mt-5 col-sm-12 d-flex justify-content-center">
					<div class="card" style="width: 18rem;">
						<img src="assets/images/adminthree.jpg" class="card-img-top" alt="...">
						<div class="card-body">
						<h5 class="card-title"><p class="text-light bg-success">Stucent Info</p></h5>
							<p class="card-text">View Students information and identify unverified accounts.</p>
              <a href="admin_student_info.php" class="btn btn-dark">See more</a>
						</div>

					</div>
				</div>
			</div>
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