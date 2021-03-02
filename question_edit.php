<?php
session_start();
require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Name']) && !isset($_SESSION['Teacher_ID'])) {
    header("Location: teacher_Login.php");
    return;
}

if (
    isset($_POST['Course_Code']) && isset($_POST['Course_Name']) && isset($_POST['Title']) && isset($_POST['Batch'])
    && isset($_POST['Section']) && isset($_POST['Action']) && isset($_POST['Content'])
) {

    $sql = "UPDATE question_description SET Course_Code = :Course_Code, Course_Name = :Course_Name,Batch=:Batch,Section=:Section,Title=:Title,Action = :Action,Content = :Content  WHERE Question_Description_ID = :Question_Description_ID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            ':Course_Code' => $_POST['Course_Code'],
            ':Course_Name' => $_POST['Course_Name'],
            ':Batch' => $_POST['Batch'],
            ':Section' => $_POST['Section'],
            ':Title' => $_POST['Title'],
            ':Action' => $_POST['Action'],
            ':Content' => $_POST['Content'],
            ':Question_Description_ID' => $_GET['Question_Description_ID'],
        )
    );
    header('Location: teacher_dashboard.php');
    return;
}

//Makes sure that user_id is present
if (!isset($_GET['Question_Description_ID'])) {
    header('Location: teacher_dashboard.php');
    return;
}

$stmt = $pdo->prepare("SELECT * FROM question_description where Question_Description_ID = :Question_Description_ID");
$stmt->execute(array(":Question_Description_ID" => $_GET['Question_Description_ID']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
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
        <div class="card-header bg-secondary text-white ">
            <h2 class="display-4">Edit Question</h2>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center mt-3">
                <p class="">Fill the fields below to create question !!!</p>
            </div>
        </div>

        <div class="container col-xl-7 col-lg-7 col-md-7">
            <form method="post" class="form-horizontal">

                <div class="form-group input-group input-group-lg">
                    <label class="control-label col-sm-12 d-flex justify-content-left" for="Course_Code"><b>Course Code:</b></label>
                    <div class="col">
                        <input required class="form-control" type="text" name="Course_Code" id="Course_Code" value="<?php echo $row['Course_Code'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-12 d-flex justify-content-left" for="Course_Name"><b>Course Name:</b></label>
                    <div class="col">
                        <input required class="form-control" type="text" name="Course_Name" id="Course_Name" value="<?php echo $row['Course_Name'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-12 d-flex justify-content-left" for="Batch"><b>Batch:</b></label>
                    <div class="col">
                        <input required class="form-control" type="text" name="Batch" id="Batch" value="<?php echo $row['Batch'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-12 d-flex justify-content-left " for="Section"><b>Section:</b></label>
                    <div class="col">
                        <input required class="form-control" type="text" name="Section" id="Section" value="<?php echo $row['Section'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-12 d-flex justify-content-left " for="Title"><b>Title:</b></label>
                    <div class="col">
                        <input required class="form-control" type="text" name="Title" id="Title" value="<?php echo $row['Title'] ?>">
                    </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-12 d-flex justify-content-left " for="Action"><b>Action:</b></label>
                  <div class="px-3">
                  <select name="Action" class="custom-select" id="inputGroupSelect01">
                  <option selected>--Choose--</option>
                    <option value="draft">Draft</option>
                    <option value="post">Post</option>
                  </select>
                  </div>
                </div>

              <div class="form-group">
				<label class="control-label col-sm-12 d-flex justify-content-center mt-5"><b>Question Paper</b></label>
				</div>

	<div class="container-fluid">
    <textarea required class="form-control m-input" id="summernote" name="Content" ><?php echo $row['Content'] ?></textarea>
    <script>
      $('#summernote').summernote({
        placeholder: '#All question with proper spacing must go here. (You can stretch bottom to increase paper length.)',
        tabsize: 2,
        height: 500
      });
    </script>

     </div>
     <div class="form-group d-flex justify-content-center">
					<div class="col-sm-4 col-sm-offset-2 p-1">
					<input class="btn btn-dark btn-block mb-5" type="submit" value="Save">
					</div>
			 	</div>
     </div>
    </form>


<?php
require_once 'assets/connect/footer.php';
?>
</body>
</html>
