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

    $stmt = $pdo->query("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, question_description.Action, question_description.Meeting_Link, teacher.Name from teacher INNER JOIN question_description on teacher.Teacher_ID = question_description.Teacher_ID WHERE Action = 'post' AND Batch = $batch AND Section = '$sec' AND Meeting_Link = '' ORDER BY Question_Description_ID DESC");
    $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //for meeting link
    $stmt1 = $pdo->query("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, question_description.Action, question_description.Meeting_Link, teacher.Name from teacher INNER JOIN question_description on teacher.Teacher_ID = question_description.Teacher_ID WHERE Action = 'meeting' AND Batch = $batch AND Section = '$sec' ORDER BY Question_Description_ID DESC");
    $rows = $stmt1->fetchAll(PDO::FETCH_ASSOC);
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

							<?php foreach ($infos as $info) {?>

								<tr onclick="window.location='answer_script.php?id=<?php echo $info['Question_Description_ID']; ?>&title=<?php echo $info['Title']; ?>&ct=<?php echo $info['Course_Name']; ?>&cc=<?php echo $info['Course_Code']; ?>&batch=<?php echo $info['Batch']; ?>&sec=<?php echo $info['Section']; ?>';">
									<td><?php echo htmlspecialchars($info['Title']); ?></td>
									<td><?php echo htmlspecialchars($info['Course_Code']); ?></td>
									<td><?php echo htmlspecialchars($info['Course_Name']); ?></td>
									<td><?php echo htmlspecialchars($info['Batch']); ?>(<?php echo htmlspecialchars($info['Section']); ?>)</td>
									<td><?php echo htmlspecialchars($info['Name']); ?></td>
								</tr>

							<?php }?>

						</tbody>
					</table>

				</div>
				<div class="col"></div>
			</div>

			<div class="row">
				<div class="col"></div>
				<div class="col-xl-11 col-lg-11 col-md-10 col-sm-9 col-xs-6 my-3 my-5">
					<p>
						<button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
							Meeting Links &nbsp;<i class="fas fa-chevron-circle-down"></i>
						</button>
						<a class="btn btn-dark" href="posts.php" role="button">All Posted Questions</a>
					</p>
					<div class="collapse" id="collapseExample">
						<div class="card card-body">
							<ul class="list-group">

								<?php foreach ($rows as $row) {?>
									<li class="list-group-item"><a href="<?php echo $row['Meeting_Link']; ?>" target="_blank"><?php echo $row['Title']; ?> by <?php echo $row['Name']; ?></a></li>
								<?php }?>

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

