<?php
session_start();

require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Teacher_ID'])) {
    die('Not logged in');
}

function validatePos()
{
    if (
        strlen($_POST['Course_Code']) < 1 || strlen($_POST['Course_Name']) < 1 || strlen($_POST['Title']) < 1 ||
        strlen($_POST['Batch']) < 1 || strlen($_POST['Section']) < 1
    ) {
        $_SESSION['status'] = "All fields are required";
        return false;
    }

    for ($i = 1; $i <= 50; $i++) {

        if (!isset($_POST['Question' . $i])) {
            continue;
        }
        $Question = htmlentities($_POST['Question' . $i]);

        if (strlen($Question) < 1) {
            $_SESSION['status'] = "All fields are required";
            return false;
        }
    }
    return true;
}

if (
    isset($_POST['Course_Code']) && isset($_POST['Course_Name']) && isset($_POST['Title']) && isset($_POST['Batch'])
    && isset($_POST['Section'])
) {

    if (
        strlen($_POST['Course_Code']) < 1 || strlen($_POST['Course_Name']) < 1 || strlen($_POST['Title']) < 1 ||
        strlen($_POST['Batch']) < 1 || strlen($_POST['Section']) < 1
    ) {

        $_SESSION['error'] = 'All values are required';
        header("Location: question_edit.php");
        return;
    } elseif (validatePos() != true) {
        $_SESSION['error'] = validatePos();
        header("Location: question_edit.php");
    } else {
        $sql = "UPDATE question_description SET Course_Code = :Course_Code, Course_Name = :Course_Name,Batch=:Batch,Section=:Section,Title=:Title
            WHERE Question_Description_ID = :Question_Description_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            array(
                ':Course_Code' => $_POST['Course_Code'],
                ':Course_Name' => $_POST['Course_Name'],
                ':Batch' => $_POST['Batch'],
                ':Section' => $_POST['Section'],
                ':Title' => $_POST['Title'],
                ':Question_Description_ID' => $_GET['Question_Description_ID'],
            )
        );
        $_SESSION['success'] = 'Record updated';

        $stmt = $pdo->prepare('DELETE FROM question WHERE Question_Description_ID=:Question_Description_ID');
        $stmt->execute(array(':Question_Description_ID' => $_REQUEST['Question_Description_ID']));

        for ($i = 1; $i <= 50; $i++) {

            if (!isset($_POST['Question' . $i])) {
                continue;
            }
            $Question = $_POST['Question' . $i];
            $stmt = $pdo->prepare('INSERT INTO question
    (Question_Description_ID, Question)
    VALUES ( :Question_Description_ID, :Question)');

            $stmt->execute(
                array(
                    ':Question_Description_ID' => $_REQUEST['Question_Description_ID'],
                    ':Question' => $Question,
                )
            );
        }

        $_SESSION['success'] = 'Record updated';
        header('Location: teacher_dashboard.php');
        return;
    }
}

// Guardian: Make sure that user_id is present
if (!isset($_GET['Question_Description_ID'])) {
    $_SESSION['error'] = "Missing Question Description ID";
    header('Location: teacher_dashboard.php');
    return;
}

$stmt = $pdo->prepare("SELECT * FROM question_description where Question_Description_ID = :Question_Description_ID");
$stmt->execute(array(":Question_Description_ID" => $_GET['Question_Description_ID']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM question where Question_Description_ID = :Question_Description_ID");
$stmt->execute(array(":Question_Description_ID" => $_GET['Question_Description_ID']));
$rowOfPosition = $stmt->fetchAll();

if ($row === false) {
    $_SESSION['error'] = 'Bad value for user_id';
    header('Location: index.php');
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
            <h2 class="display-4">Edit Question</h2>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center mt-3">
                <p class="">Fill the fields below to create question !!!</p>
            </div>
        </div>

        <div class="container col-xl-7 col-lg-7 col-md-7">
            <?php
if (isset($_SESSION['error'])) {
    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
    unset($_SESSION['error']);
}
?>


            <form method="post" class="form-horizontal">
                <div class="form-group input-group input-group-lg">
                    <label class="control-label col-sm-12 d-flex justify-content-left" for="Course_Code"><b>Course Code:</b></label>
                    <div class="col">
                        <input class="form-control" type="text" name="Course_Code" id="Course_Code" value="<?php echo $row['Course_Code'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-12 d-flex justify-content-left" for="Course_Name"><b>Course Name:</b></label>
                    <div class="col">
                        <input class="form-control" type="text" name="Course_Name" id="Course_Name" value="<?php echo $row['Course_Name'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-12 d-flex justify-content-left" for="Batch"><b>Batch:</b></label>
                    <div class="col">
                        <input class="form-control" type="text" name="Batch" id="Batch" value="<?php echo $row['Batch'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-12 d-flex justify-content-left " for="Section"><b>Section:</b></label>
                    <div class="col">
                        <input class="form-control" type="text" name="Section" id="Section" value="<?php echo $row['Section'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-12 d-flex justify-content-left " for="Title"><b>Title:</b></label>
                    <div class="col">
                        <input class="form-control" type="text" name="Title" id="Title" value="<?php echo $row['Title'] ?>">
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

                <div id="position_fields" class="p-3">
                <?php
$countPos = 1;
foreach ($rowOfPosition as $row) {?>
    <div id="inputFormRow">
    <div class="input-group mb-3">
    <textarea class="form-control m-input"  name="Question<?=$countPos?>" placeholder="Q..." id="floatingTextarea2" style="height: 70px" autocomplete="off"> <?=$row['Question']?></textarea>
    <div class="input-group-append">
    <button id="removeRow" type="button" class="ml-2 btn btn-danger">Remove</button>
    </div>
    </div>
    </div>

<?php
$countPos++;
}?>
<script type="text/javascript">
let nxtContpos = <?=$countPos?>;
$(document).ready(function(){
$('#addPos').click(function(event){
    event.preventDefault();

    if (nxtContpos >= 11) {
    alert("Maximum of 10 position entries exceeded");
    return;
}
nxtContpos++;

let html = '';
html += '<div id="inputFormRow">';
html += '<div class="input-group mb-3">';
html += '  <textarea class="form-control m-input" name="Question' + nxtContpos + '" placeholder="Q..." id="floatingTextarea2" style="height: 70px" autocomplete="off"></textarea>';
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

                </div>
                <div class="form-group d-flex justify-content-center">
					<div class="col-sm-4 col-sm-offset-2 p-1">
						<input class="btn btn-dark btn-block mb-5" type="submit" value="Save">
					</div>
				</div>
                </div>

            </form>

            </div>




<?php
require_once 'assets/connect/footer.php';
?>

</body>
</html>

