<?php
session_start();

require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Teacher_ID'])) {
    die('Not logged in');
}

function validatePos()
{
    if (strlen($_POST['Course_Code']) < 1 || strlen($_POST['Course_Name']) < 1 || strlen($_POST['Title']) < 1 ||
        strlen($_POST['Batch']) < 1 || strlen($_POST['Section']) < 1) {
        $_SESSION['status'] = "All fields are required";
        return false;
    }

    for ($i = 1; $i <= 9; $i++) {

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

if (isset($_POST['Course_Code']) && isset($_POST['Course_Name']) && isset($_POST['Title']) && isset($_POST['Batch'])
    && isset($_POST['Section'])) {

    if (strlen($_POST['Course_Code']) < 1 || strlen($_POST['Course_Name']) < 1 || strlen($_POST['Title']) < 1 ||
        strlen($_POST['Batch']) < 1 || strlen($_POST['Section']) < 1) {

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
        $stmt->execute(array(
            ':Course_Code' => $_POST['Course_Code'],
            ':Course_Name' => $_POST['Course_Name'],
            ':Batch' => $_POST['Batch'],
            ':Section' => $_POST['Section'],
            ':Title' => $_POST['Title'],
            ':Question_Description_ID' => $_GET['Question_Description_ID'])
        );
        $_SESSION['success'] = 'Record updated';

        $stmt = $pdo->prepare('DELETE FROM question WHERE Question_Description_ID=:Question_Description_ID');
        $stmt->execute(array(':Question_Description_ID' => $_REQUEST['Question_Description_ID']));

        for ($i = 1; $i <= 9; $i++) {

            if (!isset($_POST['Question' . $i])) {
                continue;
            }
            $Question = $_POST['Question' . $i];
            $stmt = $pdo->prepare('INSERT INTO question
    (Question_Description_ID, Question)
    VALUES ( :Question_Description_ID, :Question)');

            $stmt->execute(array(
                ':Question_Description_ID' => $_REQUEST['Question_Description_ID'],
                ':Question' => $Question)
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
			<a class="navbar-brand" href="#">LU EXAM HIVE</a>
			<button type="button" class="btn btn-sm btn-dark rounded-0 ml-3">
				<a href="teacher_dashboard.php" class="text-white text-decoration-none">Back</a>
		</nav>

	</header>
<div class="container">
    <h1>Editing Question for </h1>
    <?php
if (isset($_SESSION['error'])) {
    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
    unset($_SESSION['error']);
}
?>
    <form method="post">
        <p>Course Code:
            <input type="text" name="Course_Code" size="60" value="<?php echo $row['Course_Code'] ?>"/></p>
        <p>Course Name:
            <input type="text" name="Course_Name" size="60" value="<?php echo $row['Course_Name'] ?>"/></p>
        <p>Batch:
            <input type="text" name="Batch" size="30" value="<?php echo $row['Batch'] ?>"/></p>
        <p>Section:<br/>
            <input type="text" name="Section" size="80" value="<?php echo $row['Section'] ?>"/></p>
            <p>Title:
            <input type="text" name="Title" size="30" value="<?php echo $row['Title'] ?>"/></p>
        <p>
            Add Question: <input type="submit" id="addPos" value="+">
        <div id="position_fields">
            <?php
$rank = 1;
foreach ($rowOfPosition as $row) {
    echo "<div id=\"position" . $rank . "\">
 <p>
 <input type=\"button\" value=\"-\" onclick=\"$('#position" . $rank . "').remove();return false;\"></p>
 <textarea name=\"Question" . $rank . "\"').\" rows=\"8\" cols=\"80\">" . $row['Question'] . "</textarea>
 </div>";
    $rank++;
}?>
        </div>
        <input type="submit" value="Save">
        <input type="submit" name="cancel" value="Cancel">
        </p>
    </form>
    <p>
        <script>
            countPos = 0;

            // http://stackoverflow.com/questions/17650776/add-remove-html-inside-div-using-javascript
            $(document).ready(function () {
                $('#addPos').click(function (event) {
                    event.preventDefault();
                    if (countPos >= 9) {
                        alert("Maximum of nine position entries exceeded");
                        return;
                    }
                    countPos++;

                    '<div id="position'+countPos+'">\
   <div class="form-group"> \
   <div class="col-sm-1"> \
   <button class="btn btn-danger" \
   onclick="$(\'#position'+countPos+'\').remove();return false;" \
   >-</button> \
   </div> \
   </div> \
   <div class="form-group"> \
   <label class="control-label col-sm-2"></label> \
   <div class="col-sm-5"> \
   <textarea class="form-control" name="Question'+countPos+'" rows="6" ></textarea> \
   </div> \
   </div> \
   </div>');
                });
            });
        </script>
</div>
<?php
require_once 'assets/connect/footer.php';
?>
</body>
</html>