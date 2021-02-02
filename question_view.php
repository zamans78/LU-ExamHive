<?php

session_start();

require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Teacher_ID'])) {
    die("Not logged in");
}

if (isset($_REQUEST['Question_Description_ID'])) {
    $Question_Description_ID = htmlentities($_REQUEST['Question_Description_ID']);

    $stmt = $pdo->prepare("
        SELECT * FROM question_description
        WHERE Question_Description_ID = :Question_Description_ID
    ");

    $stmt->execute([
        ':Question_Description_ID' => $Question_Description_ID,
    ]);

    $question_description = $stmt->fetch(PDO::FETCH_OBJ);

    $stmt = $pdo->prepare("
        SELECT * FROM question
        WHERE Question_Description_ID = :Question_Description_ID
    ");

    $stmt->execute([
        ':Question_Description_ID' => $Question_Description_ID,
    ]);

    $question = [];

    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        $question[] = $row;
    }

    $questionLen = count($question);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
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

            <h1>Question information</h1>

            <div class="row">
                <div class="col-sm-2">Course Code:</div>
                <div class="col-sm-4">
                    <?php echo $question_description->Course_Code; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">Course Name:</div>
                <div class="col-sm-4">
                    <?php echo $question_description->Course_Name; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">Batch:</div>
                <div class="col-sm-4">
                    <?php echo $question_description->Batch; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">Section:</div>
                <div class="col-sm-4">
                    <?php echo $question_description->Section; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">Titel:</div>
                <div class="col-sm-8">
                    <?php echo $question_description->Title; ?>
                </div>
            </div>

            <?php if ($questionLen > 0): ?>
                <div class="row">
                    <div class="col-sm-2">Questions:</div>
                    <div class="col-sm-8">
                        <ul>
                            <?php for ($i = 1; $i <= $questionLen; $i++): ?>
                                <li><?php echo $question[$i - 1]->Question; ?></li>
                            <?php endfor;?>
                        </ul>
                    </div>
                </div>
            <?php endif;?>
        </div>
		<?php
require_once 'assets/connect/footer.php';
?>
    </body>
</html>
