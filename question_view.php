<?php

session_start();

require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Teacher_ID'])) {
	die("Not logged in");
}

if (isset($_REQUEST['Question_Description_ID'])) {
	$Question_Description_ID = htmlentities($_REQUEST['Question_Description_ID']);

	$stmt = $pdo->prepare("
        SELECT * FROM question_description
        WHERE Question_Description_ID = :Question_Description_ID
    ");

	$stmt->execute([
		':Question_Description_ID' => $Question_Description_ID,
	]);

	$question_description = $stmt->fetch(PDO::FETCH_OBJ);

	$stmt = $pdo->prepare("
        SELECT * FROM question
        WHERE Question_Description_ID = :Question_Description_ID
    ");

	$stmt->execute([
		':Question_Description_ID' => $Question_Description_ID,
	]);

	$question = [];

	while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
		$question[] = $row;
	}

	$questionLen = count($question);
}

?>

<!DOCTYPE html>
<html>

<head>
	<title></title>
	<?php
	require_once 'assets/connect/head.php';
	?>

</head>
<header>
	<nav class="navbar navbar-expand-lg navbar-light sticky-top">
		<div class="container justify-content-start">
			<a class="navbar-brand" href="index.php"><img src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
			<a type="button" href="javascript:history.back(1)" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
		</div>
	</nav>
</header>

<body>
	<h2 class="display-4 bg-secondary text-white p-1 d-flex justify-content-center">Question Information</h2>


	<div class="container shadow-lg p-3 mb-5 bg-white rounded mt-3">
		<div class="row">
			<div class="col d-flex justify-content-center">
				<h4>Leading University</h4>
			</div>
		</div>

		<div class="row">
			<div class="col d-flex justify-content-center">
				<h6>Department of CSE</h6>
			</div>
		</div>

		<div class="row">
			<div class="col d-flex justify-content-center">
				<h6><?php echo $question_description->Title; ?></h6>
			</div>
		</div>

		<div class="row">
			<div class="col d-flex justify-content-center">
				<h6>Course Title: <?php echo $question_description->Course_Name; ?></h6>
			</div>
		</div>

		<div class="row">
			<div class="col d-flex justify-content-center">
				<h6>Course Code: <?php echo $question_description->Course_Code; ?></h6>
			</div>
		</div>

		<div class="row">
			<div class="col d-flex justify-content-center">
				<h6>Batch: <?php echo $question_description->Batch; ?>. Section: <?php echo $question_description->Section; ?></h6>
			</div>
		</div>

		<?php if ($questionLen > 0) : ?>
			<div class="row">
				<div class="col d-flex justify-content-center">
				<h6><u>Questions</u></h6>
			</div>
			</div>
			<div class="row">
				<div class="col">
					<ol class="px-xs-0 px-sm-0 px-md-3 px-lg-5 px-xl-5 mx-xs-1 mx-sm-1 mx-md-3 mx-lg-5 mx-xl-5">
						<?php for ($i = 1; $i <= $questionLen; $i++) : ?>
							<li><?php echo $question[$i - 1]->Question; ?></li>
							<br>
						<?php endfor; ?>
					</ol>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php
	require_once 'assets/connect/footer.php';
	?>
</body>

</html>