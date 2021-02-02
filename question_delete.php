<?php

session_start();
require_once "assets/connect/pdo.php";

if (isset($_POST['Delete']) && isset($_POST['Question_Description_ID'])) {
    echo 23132;
    $sql = "DELETE FROM question_description WHERE Question_Description_ID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['Question_Description_ID']));
    $_SESSION['success'] = 'Record deleted';
    header('Location: teacher_dashboard.php');
    return;
}

// Guardian: Make sure that user_id is present
if (!isset($_GET['Question_Description_ID'])) {
    $_SESSION['error'] = "Missing user_id";
    header('Location: teacher_dashboard.php');
    return;
}

$stmt = $pdo->prepare("SELECT Course_Code, Course_Name FROM question_description where Question_Description_ID = :xyz");
$stmt->execute(array(":xyz" => $_GET['Question_Description_ID']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    $_SESSION['error'] = 'Bad value for Question Description ID';
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
<header>
	<nav class="navbar navbar-expand-lg navbar-light sticky-top">
			<a class="navbar-brand" href="#">LU EXAM HIVE</a>
			<button type="button" class="btn btn-sm btn-dark rounded-0 ml-3">
				<a href="teacher_dashboard.php" class="text-white text-decoration-none">Back</a>
		</nav>

	</header>
<body>
<div class="container">
    <p>Course Code: <?php echo ($row['Course_Code']); ?></p>
    <p>Course Name: <?php echo ($row['Course_Name']); ?></p>
    <form method="post"><input type="hidden" name="Question_Description_ID" value="<?php echo $_GET['Question_Description_ID'] ?>">
        <input type="submit" name="Delete" value="Delete">
    </form>
</div>
<?php
require_once 'assets/connect/footer.php';
?>
</body>