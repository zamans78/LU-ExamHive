<?php
session_start();
require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Teacher_ID'])) {
    die("Not logged in");
}

if (isset($_GET['Question_Description_ID'])) {

    $question_des_id = $_GET['Question_Description_ID'];
    $stmt = $pdo->query("SELECT * FROM question_description WHERE Question_Description_ID = $question_des_id");
    $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>LU EXAM HIVE</title>
	<?php
require_once 'assets/connect/head.php';
?>

</head>
<header>
	<nav class="navbar navbar-expand-lg navbar-light sticky-top">
		<div class="container justify-content-start">
		<a class="navbar-brand" href="index.php"><img id="logo" src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
			<a type="button" href="teacher_dashboard.php" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
		</div>
	</nav>
</header>

<body>

	<div class="card text-center bg-light text-dark mb-5">
		<div class="card-header bg-secondary text-white ">
			<h2 class="display-4">Question Information</h2>
		</div>
	</div>

	<div class="row mb-3 ">
		<div class="col d-flex justify-content-center">
			<a class="btn btn-dark my-2 mx-3" type="button" href="question_submission.php?Question_Description_ID=<?php echo $_GET['Question_Description_ID']; ?>">Submissions and results&nbsp;<i class="fas fa-chevron-circle-right"></i>
			</a>
		</div>
	</div>



	<div class="container shadow-lg p-3 mb-5 bg-white rounded mt-3">
		<div class="row">
			<div class="col">
			<h2 class="pt-2 text-center text-success">Question Layout</h2>
			</div>
		</div>

		<div class="row">
			<div class="col d-flex justify-content-center mt-1">
				<h4>Leading University</h4>
			</div>
		</div>

		<div class="row">
			<div class="col d-flex justify-content-center">
				<h6>Department of CSE</h6>
			</div>
		</div>
		<?php foreach ($infos as $info) {?>
			<div class="row">
				<div class="col d-flex justify-content-center">
					<h6><?php echo $info['Title']; ?></h6>
				</div>
			</div>

			<div class="row">
				<div class="col d-flex justify-content-center">
					<h6>Course Title: <?php echo $info['Course_Name']; ?></h6>
				</div>
			</div>

			<div class="row">
				<div class="col d-flex justify-content-center">
					<h6>Course Code: <?php echo $info['Course_Code']; ?></h6>
				</div>
			</div>

			<div class="row">
				<div class="col d-flex justify-content-center">
					<h6>Batch: <?php echo $info['Batch']; ?>. Section: <?php echo $info['Section']; ?></h6>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<p class="px-xs-0 px-sm-0 px-md-3 px-lg-5 px-xl-5 mx-xs-1 mx-sm-1 mx-md-3 mx-lg-5 mx-xl-5 mb-5">
						<?php echo $info['Content']; ?>
						<br><br>

					</p>
				</div>
			</div>
		<?php }?>
	</div>
	<?php
require_once 'assets/connect/footer.php';
?>
</body>

</html>