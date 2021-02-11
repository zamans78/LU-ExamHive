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

$stmt = $pdo->prepare("SELECT Course_Code, Course_Name, Batch, Section FROM question_description where Question_Description_ID = :xyz");
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

<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="container justify-content-start">
                <a class="navbar-brand" href="index.php"><img src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
                <a type="button" href="javascript:history.back(1)" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
            </div>
        </nav>
    </header>
    <div class="text-center bg-light text-dark ">
      <div class="card-header alert alert-danger ">
        <h2 class="display-4">Delete Confirmation</h2>
      </div>
      <div class="col d-flex justify-content-center mt-3">
        <p class="text-danger">File with following information will be deleted permanently.</p>
      </div>

      <div class="row">
        <div class="col d-flex justify-content-center mt-3">
          <p class="deleteText"><b>Course Name:</b> <?php echo ($row['Course_Name']); ?>. <b>Course Code:</b> <?php echo ($row['Course_Code']); ?>.</p>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex justify-content-center mt-3">
          <p class="deleteText"><b>Batch:</b> <?php echo ($row['Batch']); ?>. <b>Section:</b> <?php echo ($row['Section']); ?>.</p>
        </div>
      </div>
      <div class="row mt-3 mb-5">
        <div class="col d-flex justify-content-center mt-3">
          <form method="POST">
            <input type="hidden" name="Question_Description_ID" value="<?php echo $_GET['Question_Description_ID'] ?>">
            <input class="btn btn-danger btn-lg" type="submit" name="Delete" value="Delete">
          </form>
        </div>
      </div>
    </div>
    <?php
    require_once 'assets/connect/footer.php';
    ?>
</body>