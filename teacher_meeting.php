<?php
session_start();
require_once "assets/connect/pdo.php";
include 'assets/inc/validation_helper.php';

if (!isset($_SESSION['Teacher_ID'])) {
    die("Not logged in");
}

// Check to see if we have some POST data, if we do process it
if (isset($_POST['Course_Code']) && isset($_POST['Course_Name']) && isset($_POST['Batch']) && isset($_POST['Section']) && isset($_POST['Title']) && isset($_POST['Save'])) {

    if (
        strlen($_POST['Course_Code']) < 1 || strlen($_POST['Course_Name']) < 1 || strlen($_POST['Title']) < 1 ||
        strlen($_POST['Batch']) < 1 || strlen($_POST['Section']) < 1
    ) {
        $_SESSION['status'] = "All fields are required";
    }

    $Course_Code = htmlentities($_POST['Course_Code']);
    $Course_Name = htmlentities($_POST['Course_Name']);
    $Batch = htmlentities($_POST['Batch']);
    $Section = htmlentities($_POST['Section']);
    $Title = htmlentities($_POST['Title']);
    $Meeting_Link = htmlentities($_POST['Meeting_Link']);
    $Action = htmlentities($_POST['Action']);

    $stmt = $pdo->prepare("
	INSERT INTO question_description (Teacher_ID, Course_Code, Course_Name, Batch, Section, Title, Meeting_Link, Action)
	VALUES (:Teacher_ID, :Course_Code, :Course_Name, :Batch, :Section, :Title, :Meeting_Link, :Action)
");

    $stmt->execute([
        ':Teacher_ID' => $_SESSION['Teacher_ID'],
        ':Course_Code' => $Course_Code,
        ':Course_Name' => $Course_Name,
        ':Batch' => $Batch,
        ':Section' => $Section,
        ':Title' => $Title,
        ':Meeting_Link' => $Meeting_Link,
        ':Action' => $Action,
    ]);

    $Question_Description_ID = $pdo->lastInsertId();

    $stmt = $pdo->prepare("
            INSERT INTO question (Question_Description_ID, Question)
            VALUES (:Question_Description_ID,:Question)
        ");

    $stmt->execute([
        ':Question_Description_ID' => $Question_Description_ID,
        ':Question' => $Question,
    ]);

    header('Location: teacher_dashboard.php');
    return;
}

?>
<!DOCTYPE html>
<html>

<head>
	<?php
require_once 'assets/connect/head.php';
?>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light sticky-top">
			<div class="container justify-content-start">
				<a class="navbar-brand" href="index.php"><img src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
				<a type="button" href="javascript:history.back(1)" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
			</div>
		</nav>
	</header>
	<div class="card text-center bg-light text-dark ">
		<div class="card-header bg-secondary text-white ">
			<h2 class="display-4">Create Meeting</h2>
		</div>
		<div class="row">
			<div class="col"></div>
			<div class="col d-flex justify-content-center mt-3">
				<p class="">Fill the fields below to create question !!!</p>
			</div>
			<div class="col d-flex justify-content-center mt-3">



			</div>
		</div>
		<div class="container col-xl-7 col-lg-7 col-md-7">
			<form method="post" class="form-horizontal">
				<div class="form-group input-group input-group-lg">
					<label class="control-label col-sm-12 d-flex justify-content-left" for="Course_Code"><b>Course Code:</b></label>
					<div class="col">
						<input class="form-control" type="text" name="Course_Code" id="Course_Code">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-12 d-flex justify-content-left" for="Course_Name"><b>Course Name:</b></label>
					<div class="col">
						<input class="form-control" type="text" name="Course_Name" id="Course_Name">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-12 d-flex justify-content-left" for="Batch"><b>Batch:</b></label>
					<div class="col">
						<input class="form-control" type="text" name="Batch" id="Batch">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-12 d-flex justify-content-left " for="Section"><b>Section:</b></label>
					<div class="col">
						<input class="form-control" type="text" name="Section" id="Section">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-12 d-flex justify-content-left " for="Title"><b>Title:</b></label>
					<div class="col">
						<input class="form-control" type="text" name="Title" id="Title">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-12 d-flex justify-content-left " for="Title"><b>Meeting Link:</b></label>
					<div class="col input-group mb-3">
						<input type="url" name="Meeting_Link" class="form-control" id="basic-url" aria-describedby="basic-addon3">
					</div>

				</div>
				<div class="form-group">
					<div class="px-3">
				  <input type="hidden" name="Action" value="meeting">
				  </div>
				</div>
				<div class="form-group d-flex justify-content-center">
                    <div class="col-sm-4 col-sm-offset-2 p-1">
						<button class="btn btn-dark btn-block"><a href="https://calendar.google.com/calendar/u/0/r/day" target="_blank" class="text-white text-decoration-none">Get Meet Link
						<img src="assets/images/meet.svg" alt=""></a></button>
					</div>
					<div class="form-group d-flex justify-content-center">
						<div class="col mt-3">
							<i class="fas fa-exchange-alt"></i>
						</div>
					</div>
					<div class="col-sm-4 col-sm-offset-2 p-1">
						<button class="btn btn-dark btn-block"> <a href="https://zoom.us/meeting/schedule" target="_blank" class="text-white text-decoration-none">Get Zoom Link
						<img src="assets/images/zoom.svg" alt=""></a> </button>
					</div>
                </div>
				<div class="form-group d-flex justify-content-center">
					<div class="col-sm-4 col-sm-offset-2 p-1">
						<input class="btn btn-dark btn-block mb-5" type="submit" value="Save" name="Save">

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