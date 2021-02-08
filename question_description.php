<?php
session_start();
require_once "assets/connect/pdo.php";
include 'assets/inc/validation_helper.php';

if (!isset($_SESSION['Teacher_ID'])) {
    die("Not logged in");
}

$status = false;

if (isset($_SESSION['status'])) {
    $status = htmlentities($_SESSION['status']);
    $status_color = htmlentities($_SESSION['color']);

    unset($_SESSION['status']);
    unset($_SESSION['color']);
}

$_SESSION['color'] = 'red';

// Check to see if we have some POST data, if we do process it
if (isset($_POST['Course_Code']) && isset($_POST['Course_Name']) && isset($_POST['Batch']) && isset($_POST['Section']) && isset($_POST['Title'])) {

    if (!validationHelper()) {
        header("Location: question_description.php");
        return;
    }

    $Course_Code = htmlentities($_POST['Course_Code']);
    $Course_Name = htmlentities($_POST['Course_Name']);
    $Batch = htmlentities($_POST['Batch']);
    $Section = htmlentities($_POST['Section']);
    $Title = htmlentities($_POST['Title']);

    $stmt = $pdo->prepare("
        INSERT INTO question_description (Teacher_ID, Course_Code, Course_Name, Batch, Section, Title)
        VALUES (:Teacher_ID, :Course_Code, :Course_Name, :Batch, :Section, :Title)
    ");

    $stmt->execute([
        ':Teacher_ID' => $_SESSION['Teacher_ID'],
        ':Course_Code' => $Course_Code,
        ':Course_Name' => $Course_Name,
        ':Batch' => $Batch,
        ':Section' => $Section,
        ':Title' => $Title,
    ]);

    $Question_Description_ID = $pdo->lastInsertId();

    for ($i = 1; $i <= 50; $i++) {
        if (!isset($_POST['Question' . $i])) {
            continue;
        }
        $Question = htmlentities($_POST['Question' . $i]);

        $stmt = $pdo->prepare("
            INSERT INTO question (Question_Description_ID, Question)
            VALUES (:Question_Description_ID,:Question)
        ");

        $stmt->execute([
            ':Question_Description_ID' => $Question_Description_ID,
            ':Question' => $Question,
        ]);
    }

    $_SESSION['status'] = 'Record added';
    $_SESSION['color'] = 'green';

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
			<h2 class="display-4">Create Question</h2>
		</div>
		<div class="row">
			<div class="col"></div>
			<div class="col d-flex justify-content-center mt-3">
				<p class="">Fill the fields below to create question !!!</p>
			</div>
			<div class="col d-flex justify-content-center mt-3">



			</div>
		</div>
		<?php
if ($status !== false) {
    // Look closely at the use of single and double quotes
    echo ('<p style="color: ' . $status_color . ';" class="col-sm-10 col-sm-offset-2">' .
        htmlentities($status) .
        "</p>\n");
}
?>
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
					<label class="control-label col-sm-12 d-flex justify-content-left " for="Action"><b>Action:</b></label>
					<div class="px-3">
				  <select name="" class="custom-select" id="inputGroupSelect01">
				    <option value="draft">Draft</option>
				    <option value="post">Post</option>
				  </select>
				  </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-12 d-flex justify-content-left"><b>Add Question:</b></label>
					<div class="col">
						<button id="addPos" class="btn btn-success btn-md btn-block"><i class="fas fa-pencil-alt"></i></button>
					</div>
				</div>
				<div id="position_fields" class="py-5">

				</div>
				<div class="form-group d-flex justify-content-center">
					<div class="col-sm-4 col-sm-offset-2 p-1">
						<input class="btn btn-dark btn-block mb-5" type="submit" value="Save">

					</div>
				</div>
			</form>
		</div>
	</div>


<script type="text/javascript">
let countPos = 0;
$(document).ready(function(){
$('#addPos').click(function(event){
    event.preventDefault();

    if (countPos >= 11) {
    alert("Maximum of 10 position entries exceeded");
    return;
}
countPos++;

let html = '';
html += '<div id="inputFormRow">';
html += '<div class="input-group mb-3">';
html += '  <textarea class="form-control m-input" name="Question' + countPos + '" placeholder="Q..." id="floatingTextarea2" style="height: 100px" autocomplete="off"></textarea>';
html += '<div class="input-group-append">';
html += '<button id="removeRow" type="button" class="ml-2 btn btn-danger">Remove</button>';
html += '</div>';
html += '</div>';

$('#position_fields').append(html);

$(document).on('click', '#removeRow', function () {
$(this).closest('#inputFormRow').remove();
});

});
});

</script>
</body>
<?php
require_once 'assets/connect/footer.php';
?>

</html>