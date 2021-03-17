<?php
session_start();
require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Student_ID']) && !isset($_SESSION['Batch']) && !isset($_SESSION['Section'])) {
	header("Location: student_login.php");
	return;
}
//getting the data by query parameter
if (isset($_GET['batch']) && isset($_GET['sec'])) {
	$batch = $_GET['batch'];
	$sec = $_GET['sec'];

	$stmt = $pdo->query("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, question_description.Action, question_description.Meeting_Link, teacher.Name from teacher INNER JOIN question_description on teacher.Teacher_ID = question_description.Teacher_ID WHERE Action = 'Posted' AND Batch = $batch AND Section = '$sec' AND Meeting_Link = '' ORDER BY Question_Description_ID DESC");
	$infos = $stmt->fetchAll(PDO::FETCH_ASSOC);

	//for meeting link
	$stmt1 = $pdo->query("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, question_description.Action, question_description.Meeting_Link, teacher.Name from teacher INNER JOIN question_description on teacher.Teacher_ID = question_description.Teacher_ID WHERE Action = 'meeting' AND Batch = $batch AND Section = '$sec' ORDER BY Question_Description_ID DESC");
	$rows = $stmt1->fetchAll(PDO::FETCH_ASSOC);

	//for multilple choice/other question
	$stmt2 = $pdo->query("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, question_description.Action, question_description.Meeting_Link, teacher.Name from teacher INNER JOIN question_description on teacher.Teacher_ID = question_description.Teacher_ID WHERE Action = 'quiz' AND Batch = $batch AND Section = '$sec' ORDER BY Question_Description_ID DESC");
	$rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	require_once 'assets/connect/head.php';
	?>
	<link rel="stylesheet" href="assets/css/table.css">
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light sticky-top">
			<div class="container justify-content-start">
				<a class="navbar-brand" href="index.php"><img id="logo" src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
				<a type="button" href="student_logout.php" class="btn btn-sm btn-dark ml-auto">Logout <i class="fas fa-door-open"></i></a>
			</div>
		</nav>
	</header>
	<!--posts Start(128) -->
	<main>
		<div class="container">

			<div class="row">
				<div class="col d-flex justify-content-start mt-4">
					<h2 class="display-4">Dashboard</h2>
				</div>
			</div>
			<div class="row">
				<div class="col d-flex justify-content-center mt-3">
					<p class="">Select a question from the table below and start the exam. Double check the course code and other necessary things before proceeding further.</p>
				</div>
			</div>
			<div class="row">
				<div class="col d-flex justify-content-center">
					<?php
					if (isset($_SESSION['ExamDone'])) {
						echo ('<p style="color: green;">' . htmlentities($_SESSION['ExamDone']) . "</p>\n");
						unset($_SESSION['ExamDone']);
					}
					?>
				</div>
			</div>



			<div class="row">
				<div class="col"></div>
				<div class="col-xl-11 col-lg-11 col-md-10 col-sm-9 col-xs-6 my-3 table-responsive-sm">
					<table class="table table-hover">
						<thead class="bg-success text-white">
							<tr>
								<th scope="col">Title</th>
								<th scope="col">Course Code</th>
								<th scope="col">Course Title</th>
								<th scope="col">Batch (Sec)</th>
								<th scope="col">Posted by</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach ($infos as $info) { ?>

								<tr onclick="window.location='answer_script.php?id=<?php echo $info['Question_Description_ID']; ?>&title=<?php echo $info['Title']; ?>&ct=<?php echo $info['Course_Name']; ?>&cc=<?php echo $info['Course_Code']; ?>&batch=<?php echo $info['Batch']; ?>&sec=<?php echo $info['Section']; ?>';">
									<td><?php echo htmlspecialchars($info['Title']); ?></td>
									<td><?php echo htmlspecialchars($info['Course_Code']); ?></td>
									<td><?php echo htmlspecialchars($info['Course_Name']); ?></td>
									<td><?php echo htmlspecialchars($info['Batch']); ?>(<?php echo htmlspecialchars($info['Section']); ?>)</td>
									<td><?php echo htmlspecialchars($info['Name']); ?></td>
								</tr>

							<?php } ?>

						</tbody>
					</table>

				</div>
				<div class="col"></div>
			</div>

			<div class="row">
				<div class="col"></div>
				<div class="col-xl-11 col-lg-11 col-md-10 col-sm-9 col-xs-6 my-3 my-5">
					<p>
						
						<a class="btn btn-dark mb-1" href="posts.php" role="button">All Posted Questions <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mailbox2" viewBox="0 0 16 16">
								<path d="M9 8.5h2.793l.853.854A.5.5 0 0 0 13 9.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5H9v1z" />
								<path d="M12 3H4a4 4 0 0 0-4 4v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a4 4 0 0 0-4-4zM8 7a3.99 3.99 0 0 0-1.354-3H12a3 3 0 0 1 3 3v6H8V7zm-3.415.157C4.42 7.087 4.218 7 4 7c-.218 0-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0c0 .334-.164.264-.415.157z" />
							</svg></a>
						<button class="btn btn-dark mb-1" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
							Quiz Questions &nbsp;<i class="fas fa-chevron-circle-down"></i>
						</button>
						<button class="btn btn-dark mb-1" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
							Meeting Links &nbsp;<i class="fas fa-chevron-circle-down"></i>
						</button>
					</p>
					<div class="collapse" id="collapseExample">
						<div class="card card-body bg-dark">
							<ul class="list-group">

								<?php foreach ($rows as $row) { ?>
									<li class="list-group-item"><a href="<?php echo $row['Meeting_Link']; ?>" target="_blank"><?php echo $row['Title']; ?> | Batch: <?php echo $row['Batch']; ?> (<?php echo $row['Section']; ?>) |&nbsp;<i class="fas fa-chalkboard-teacher"></i>&nbsp;<?php echo $row['Name']; ?></a></li>
								<?php } ?>

							</ul>
						</div>
					</div>

					<div class="collapse" id="collapseExample2">
						<div class="card card-body bg-dark">
							<ul class="list-group">

								<?php foreach ($rows2 as $row) { ?>
									<li class="list-group-item"><a href="quiz_answer_script.php?id=<?php echo $row['Question_Description_ID']; ?>&title=<?php echo $row['Title']; ?>&ct=<?php echo $row['Course_Name']; ?>&cc=<?php echo $row['Course_Code']; ?>&batch=<?php echo $row['Batch']; ?>&sec=<?php echo $row['Section']; ?>" target="_blank">
									
									<?php echo $row['Title']; ?> | Course Code: <?php echo $row['Course_Code']; ?> | Batch: <?php echo $row['Batch']; ?> (<?php echo $row['Section']; ?>) |&nbsp;<i class="fas fa-chalkboard-teacher"></i>&nbsp;<?php echo $row['Name']; ?></a></li>
								<?php } ?>

							</ul>
						</div>
					</div>

				</div>
				<div class="col"></div>
			</div>
			<div class="row">
				<div class="col d-flex justify-content-center mt-3">
					<p class="">Cannot find your question? Click the 'All Posted Question' on top to see a list of questions posted by all teachers.</p>
				</div>
			</div>

		</div>

	</main>
	<!--posts End(128) -->

	<!--footer Start -->
	<?php
	require_once 'assets/connect/footer.php';
	?>
	<!--footer End -->
</body>

</html>