<?php
session_start();
require_once "assets/connect/pdo.php";

$_SESSION['Question_Description_ID'] = $_GET['Question_Description_ID'];

if (!isset($_SESSION['Name']) && !isset($_SESSION['Teacher_ID'])) {
    header("Location: teacher_Login.php");
    return;
}
$q_id = $_GET['Question_Description_ID'];

//fetching info about question
$sql = $pdo->prepare("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, teacher.Name FROM question_description INNER JOIN teacher ON question_description.Teacher_ID = teacher.Teacher_ID WHERE Question_Description_ID = $q_id");
$sql->setFetchMode(PDO::FETCH_OBJ);
$sql->execute();
$row = $sql->fetch();

//fetching submissions from student answer
$stmt = $pdo->query("SELECT student_answer.Student_ID, student_answer.Full_Name,  student_answer.Batch ,student_answer.Section, student_answer.Submission_Datetime, student_answer.Score, question_description.Question_Description_ID, question_description.Teacher_ID FROM student_answer INNER JOIN question_description on question_description.Question_Description_ID = student_answer.Question_Description_ID WHERE question_description.Question_Description_ID = '$q_id' ORDER BY Student_ID ASC");

$infos = $stmt->fetchAll(PDO::FETCH_ASSOC);

//submission count
$stmt2 = $pdo->query("SELECT COUNT(Answer), Section, Batch FROM student_answer WHERE Question_Description_ID = $q_id");
$infos2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($infos);
// echo '</pre>';

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
			<a type="button" href="javascript:history.back(1)" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
		</div>
	</nav>
</header>

<body>

	<div class="card text-center bg-light text-dark mb-5">
		<div class="card-header bg-dark text-white ">
			<h2 class="display-4">Submissions</h2>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<p class="text-center">Answer submissions for <b><?php echo $row->Course_Code; ?></b> | <b><?php echo $row->Course_Name; ?></b> | Batch: <b><?php echo $row->Batch; ?>(<?php echo $row->Section; ?>)</b> by <b><?php echo $row->Name; ?></b></p>
		</div>
	</div>

	<div class="row">
		<div class="col d-flex justify-content-center">
			<a role="button" href="generate_result.php?Question_Description_ID=<?php echo$row->Question_Description_ID;?>" class="btn btn-dark btn-sm">Generate Result in PDF Format</a>
		</div>
	</div>

	<div class="row mt-5">
		<div class="col">

			<h4 class="d-flex justify-content-center">Total Number of Submissions: &nbsp;<span class="text-success"><b><?php foreach ($infos2 as $info2) {
    echo htmlspecialchars($info2['COUNT(Answer)']);
}?></b></span></h4>
		</div>
	</div>

	<div class="row mt-5">
		<div class="col"></div>
		<div class="col col-xl-11 col-lg-11 col-md-10 col-sm-9 col-xs-6 my-3">
			<form action="question_submission.php?Question_Description_ID=<?php echo $_GET['Question_Description_ID']; ?>" method="POST">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Student Id</th>
							<th scope="col">Name</th>
							<th scope="col">Batch (Sec)</th>
							<th scope="col">Submission Time</th>
							<th scope="col">Score</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach ($infos as $info) {?>

							<tr class="text-primary" onclick="window.location='question_submission_detail.php?Question_Description_ID=<?php echo htmlspecialchars($info['Question_Description_ID']); ?>&Student_Id=<?php echo htmlspecialchars($info['Student_ID']); ?>';">
								<th scope="row"><?php echo htmlspecialchars($info['Student_ID']); ?></th>
								<td><?php echo htmlspecialchars($info['Full_Name']); ?></td>
								<td><?php echo htmlspecialchars($info['Batch']); ?>(<?php echo htmlspecialchars($info['Section']); ?>)</td>
								<td><?php echo htmlspecialchars($info['Submission_Datetime']); ?></td>

								<td><span class="<?php if ($info['Score'] != null) {
    $status = 'text-success';
} else {
    $status = 'text-danger';
}
    echo $status?>">
										<?php if ($info['Score'] == null) {
        echo "Not given";
    }
    echo htmlspecialchars($info['Score']);?></span></td>
							</tr>

						<?php }?>

					</tbody>
				</table>
			</form>
		</div>
		<div class="col"></div>
	</div>


	<?php
require_once 'assets/connect/footer.php';
?>
</body>

</html>