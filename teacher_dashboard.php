<?php
session_start();
require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Name']) && !isset($_SESSION['Teacher_ID'])) {
	header("Location: teacher_Login.php");
	return;
} else {
	//Here we can manage individual profile maintain.
	$name = $_SESSION['Name'];
	$stmt = $pdo->query("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code, question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, question_description.Action FROM teacher INNER JOIN question_description on teacher.Teacher_ID = question_description.Teacher_ID where name='$name' AND Meeting_Link = '' ORDER BY Question_Description_ID DESC");

	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	//For meeting link
	$stmt2 = $pdo->query("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, question_description.Meeting_Link, teacher.Name from teacher INNER JOIN question_description on teacher.Teacher_ID = question_description.Teacher_ID where name='$name' AND Action = 'meeting' ORDER BY Question_Description_ID DESC");

	$infos = $stmt2->fetchAll(PDO::FETCH_ASSOC);
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
			<div class="container">
				<a class="navbar-brand" href="index.php"><img id="logo" src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
				<a type="button" href="teacher_logout.php" class="btn btn-sm btn-dark ml-auto">Logout <i class="fas fa-door-open"></i></a>
			</div>
		</nav>
	</header>
	<!--Teacher Dashboard Start(128) -->
	<main class="container">
		<div>

			<div class="row mt-4">
				<div class="col">
					<h3 class="display-4 mt-3"><?php echo $_SESSION['Name']; ?> Dashboard.</h3>
				</div>
			</div>
			<div class="row my-4">
				<div class="col">
					<p class="d-flex justify-content-center">
						<button type="button" class="btn btn-dark my-2"><a href="question_description.php" class="text-white text-decoration-none">Create Question</a>
							<span>
								<i class="fas fa-plus-square"></i>
							</span>
						</button>
						<button type="button" class="btn btn-dark my-2 mx-3"><a href="teacher_meeting.php" class="text-white text-decoration-none">Get Meeting Link</a>
							<span>
								<i class="fas fa-video"></i>
							</span>
						</button>
						<button type="button" class="btn btn-dark my-2"><a href="posts.php" class="text-white text-decoration-none">Posted Questions <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mailbox2" viewBox="0 0 16 16">
									<path d="M9 8.5h2.793l.853.854A.5.5 0 0 0 13 9.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5H9v1z" />
									<path d="M12 3H4a4 4 0 0 0-4 4v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a4 4 0 0 0-4-4zM8 7a3.99 3.99 0 0 0-1.354-3H12a3 3 0 0 1 3 3v6H8V7zm-3.415.157C4.42 7.087 4.218 7 4 7c-.218 0-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0c0 .334-.164.264-.415.157z" />
								</svg></a>
						</button>

						<button class="btn btn-dark my-2 mx-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Meeting Links&nbsp;<i class="fas fa-chevron-circle-down"></i>
						</button>


					</p>
					<div class="collapse" id="collapseExample">
						<div class="card card-body bg-dark">
							<ul class="list-group">
								<?php foreach ($infos as $info) {
									$link = $info['Meeting_Link'];
									if ($link < 1) {
										echo "<p class='text-danger'>No link found.</p>";
									} else { ?>
										<li class="list-group-item"><a href="<?php echo $link; ?>" target="_blank"><?php echo $info['Title']; ?> | Batch: <?php echo $info['Batch']; ?> (<?php echo $info['Section']; ?>) |&nbsp;<i class="fas fa-chalkboard-teacher"></i>&nbsp;<?php echo $info['Name']; ?></a></a><a href="question_delete.php?Question_Description_ID=<?php echo $info['Question_Description_ID']; ?>" class="btn btn-sm btn-danger float-right">Delete</a></li>
									<?php } ?>
								<?php } ?>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col"></div>
			<div class="col-xl-9 col-lg-9 col-md-10 col-sm-12 col-xs-6 my-5 table-responsive-sm">
				<?php
				echo "<table class='table table-hover'>";
				echo "<thead>";
				echo "<tr class='bg-dark text-white'>";
				echo "<th scope='col'>Course Name</th>";
				echo "<th scope='col'>Batch</th>";
				echo "<th scope='col'>Course Code</th>";
				echo "<th scope='col'>Status</th>";
				echo "<th scope='col'>Modify</th>";
				echo " </tr>";
				echo "</thead>";
				echo " <tbody>";
				if (true) {
					foreach ($rows as $row) {
						echo "<tr><td>";
						echo ("<a href='question_view.php?Question_Description_ID=" . $row['Question_Description_ID'] . "'>" . $row['Course_Name'] . "</a>");
						echo ("</td><td>");
						echo ($row['Batch']);
						echo (" (");
						echo ($row['Section']);
						echo (")");
						echo ("</td><td>");
						echo ($row['Course_Code']);
						echo ("</td><td class='");
						if ($row['Action'] == 'Posted') {
							$act = 'text-warning';
						} else if ($row['Action'] == 'Done') {
							$act = 'text-success';
						} else if ($row['Action'] == 'Draft') {
							$act = 'text-dark';
						}
						echo $act;
						echo ("'>");
						echo ($row['Action']);
						echo ("</td><td>");
						echo ('<a href="question_edit.php?Question_Description_ID=' . $row['Question_Description_ID'] . '"><i class="fas fa-edit"></i></a> / <a href="question_delete.php?Question_Description_ID=' . $row['Question_Description_ID'] . '"><i class="far fa-trash-alt"></i></a>');
						echo ("</td></tr>\n");
					}
					echo " </tbody>";
					echo " </table>";
				} else {
					echo 'No Questions Made.';
				}
				?>
			</div>
			<div class="col"></div>
		</div>

		</div>

	</main>
	<!--Teacher Dashboard End(128) -->

	<?php
	require_once 'assets/connect/footer.php';
	?>
</body>

</html>