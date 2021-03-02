<?php
session_start();
require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Name']) && !isset($_SESSION['Teacher_ID'])) {
    header("Location: teacher_Login.php");
    return;
}
// Check to see if we have some POST data, if we do process it
if (isset($_POST['Course_Code']) && isset($_POST['Course_Name']) && isset($_POST['Batch']) && isset($_POST['Section']) && isset($_POST['Title']) && isset($_POST['Save']) && isset($_POST['Action'])) {

    $Teacher_ID = $_SESSION['Teacher_ID'];
    $Course_Code = htmlentities($_POST['Course_Code']);
    $Course_Name = htmlentities($_POST['Course_Name']);
    $Batch = htmlentities($_POST['Batch']);
    $Section = htmlentities($_POST['Section']);
    $Title = htmlentities($_POST['Title']);
    $Action = htmlentities($_POST['Action']);
    $Content = $_POST['Content'];

    $sql = "INSERT INTO question_description (Teacher_ID, Course_Code, Course_Name, Batch, Section, Title, Action,Content)
    VALUES ('$Teacher_ID', '$Course_Code','$Course_Name','$Batch','$Section','$Title','$Action','$Content')";
    $pdo->exec($sql);
    header('Location: teacher_dashboard.php');
    return;
}
?>

<!DOCTYPE html>
<html>
<head>
<?php
require_once 'assets/connect/head.php';
require_once 'assets/summer_Note/summer_Note.php';
?>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light sticky-top">
			<div class="container justify-content-start">
			<a class="navbar-brand" href="index.php"><img id="logo" src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
				<a type="button" href="teacher_dashboard.php" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
			</div>
		</nav>
	</header>
	<div class="card text-center bg-light text-dark ">
		<div class="card-header bg-dark text-white ">
			<h2 class="display-4">Create Question</h2>
		</div>
		<div class="row">
			<div class="col"></div>
			<div class="col d-flex justify-content-center mt-3">
				<p class="">Fill all the fields below to create a Question Paper !!</p>
			</div>
			<div class="col d-flex justify-content-center mt-3">
			</div>
		</div>
		<div class="container col-xl-7 col-lg-7 col-md-7">
			<form method="post" class="form-horizontal" action="question_description.php">
				<div class="form-group input-group input-group-lg">
					<label class="control-label col-sm-12 d-flex justify-content-left" for="Course_Code"><b>Course Code:</b></label>
					<div class="col">
						<input class="form-control" type="text" name="Course_Code" id="Course_Code" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-12 d-flex justify-content-left" for="Course_Name"><b>Course Name:</b></label>
					<div class="col">
						<input class="form-control" type="text" name="Course_Name" id="Course_Name" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-12 d-flex justify-content-left" for="Batch"><b>Batch:</b></label>
					<div class="col">
						<input class="form-control" type="text" name="Batch" id="Batch" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-12 d-flex justify-content-left " for="Section"><b>Section:</b></label>
					<div class="col">
						<input class="form-control" type="text" name="Section" id="Section" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-12 d-flex justify-content-left " for="Title"><b>Title:</b></label>
					<div class="col">
						<input class="form-control" type="text" name="Title" id="Title" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-12 d-flex justify-content-left " for="Action"><b>Action:</b></label>
					<div class="px-3">
				  <select name="Action" class="custom-select" id="inputGroupSelect01" >
				  <option selected>--Choose--</option>
				    <option value="draft">Draft</option>
				    <option value="post">Post</option>
				  </select>
				  </div>
				</div>

					<label class="control-label col-sm-12 d-flex justify-content-center mt-5"><b>Question Paper</b></label>
					</div>
					<div class="container">
					<div class="col">
    <textarea class="form-control m-input" id="summernote" name="Content" required></textarea>
    <script>
      $('#summernote').summernote({
        placeholder: '#All question with proper spacing must go here. (You can stretch bottom to increase paper length.)',
        tabsize: 2,
        height: 500
      });
    </script>
	</div>
</div>
<div class="container mt-5">
				<div class="form-group d-flex justify-content-center ">
					<div class="col-sm-4 col-sm-offset-2 p-1">
						<input class="btn btn-dark btn-block mb-5" type="submit" name="Save">

					</div>
				</div>
			</form>
			</div>
	</div>
</body>
<?php
require_once 'assets/connect/footer.php';
?>

</html>