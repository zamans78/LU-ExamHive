<?php
session_start();
require_once "assets/connect/pdo.php";

$_SESSION['Question_Description_ID'] = $_GET['Question_Description_ID'];

if (!isset($_SESSION['Name']) && !isset($_SESSION['Teacher_ID'])) {
  header("Location: teacher_Login.php");
  return;
}


if (isset($_GET['Question_Description_ID'])) {
  $question_id = $_GET['Question_Description_ID'];

  //query for quiz question
  $stmt = $pdo->query("SELECT * FROM question_description INNER JOIN quiz_question ON quiz_question.Question_Description_ID = question_description.Question_Description_ID WHERE question_description.Question_Description_ID = $question_id");
  $infos = $stmt->fetchAll(PDO::FETCH_OBJ);


  //question info
  $sql = $pdo->prepare("SELECT * FROM question_description WHERE Question_Description_ID = $question_id");
  $sql->setFetchMode(PDO::FETCH_OBJ);
  $sql->execute();
}

//changing stauts/action
if (isset($_POST['submit'])) {
  $question_id = $_GET['Question_Description_ID'];
  $action = $_POST['Action'];
  try {
      
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql2 = "UPDATE question_description SET Action = '$action' WHERE Question_Description_ID = $question_id";
      // use exec() because no results are returned
      $pdo->exec($sql2);

    header("Location: question_view_quiz.php?Question_Description_ID=$question_id");
  } catch (PDOException $e) {
      $err = $e->getMessage();
      echo "Data insertion failed. Please try again. $err";
  }
  
}


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
      <a type="button" href="teacher_dashboard.php" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
    </div>
  </nav>
</header>

<body>

  <div class="card text-center bg-light text-dark mb-5">
    <div class="card-header bg-dark text-white ">
      <h2 class="display-4">Question Information</h2>
    </div>
  </div>

  <div class="row mb-3 ">
    <div class="col d-flex justify-content-center">
      <a class="btn btn-warning my-2 mx-3" type="button" href="question_quiz_submission.php?Question_Description_ID=<?php echo $_GET['Question_Description_ID']; ?>">Submissions and results&nbsp;<i class="fas fa-chevron-circle-right"></i>
      </a>
    </div>
  </div>


  <div class="container shadow-lg p-3 mb-5 bg-white rounded mt-3">
    <div class="row">
      <div class="col">
        <h2 class="pt-2 text-center text-success">Question Layout</h2>
      </div>
    </div>

    <div class="row">
      <div class="col d-flex justify-content-center mt-1">
        <h4>Leading University</h4>
      </div>
    </div>

    <div class="row">
      <div class="col d-flex justify-content-center">
        <h6>Department of CSE</h6>
      </div>
    </div>
    <?php if ($row = $sql->fetch()) { ?>
      <div class="row">
        <div class="col d-flex justify-content-center">
          <h6><?php echo $row->Title; ?></h6>
        </div>
      </div>

      <div class="row">
        <div class="col d-flex justify-content-center">
          <h6>Course Title: <?php echo $row->Course_Name; ?></h6>
        </div>
      </div>

      <div class="row">
        <div class="col d-flex justify-content-center">
          <h6>Course Code: <?php echo $row->Course_Code; ?></h6>
        </div>
      </div>

      <div class="row">
        <div class="col d-flex justify-content-center">
          <h6>Batch: <?php echo $row->Batch; ?>. Section: <?php echo $row->Section; ?></h6>
        </div>
      </div>

      <div class="row">
        <div class="col d-flex justify-content-center">
          <h6>Current Status: <?php if ($row->Action == 'quiz') {
                                echo "Posted";
                              } elseif ($row->Action == 'quizDraft') {
                                echo "Draft";
                              } ?><a href="#change"> (Change)</a></h6>
        </div>
      </div>
    <?php } ?>



    <div class="row">
      <div class="col">
        <div class="px-xs-0 px-sm-0 px-md-3 px-lg-5 px-xl-5 mx-xs-1 mx-sm-1 mx-md-3 mx-lg-5 mx-xl-5 mb-5 my-4">

          <?php foreach ($infos as $info) { ?>

            <?php $ans_array = array($info->Choice1, $info->Choice2, $info->Choice3, $info->Answer);
            shuffle($ans_array);
            ?>

            <p><b><?php echo $info->Question_Number; ?>. <?php echo $info->Question; ?></b></p>

            <input type="radio" name="attributes[quizid<?= $info->Question_Number ?>]" value="<?= $ans_array[0] ?>"> <?= $ans_array[0] ?><br>
            <input type="radio" name="attributes[quizid<?= $info->Question_Number ?>]" value="<?= $ans_array[1] ?>"> <?= $ans_array[1] ?><br>
            <input type="radio" name="attributes[quizid<?= $info->Question_Number ?>]" value="<?= $ans_array[2] ?>"> <?= $ans_array[2] ?><br>
            <input type="radio" name="attributes[quizid<?= $info->Question_Number ?>]" value="<?= $ans_array[3] ?>"> <?= $ans_array[3] ?><br><br>

          <?php } ?>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col"></div>
      <div class="col d-flex justify-content-center" id="change">

        <form class="form-inline" action="question_view_quiz.php?Question_Description_ID=<?php echo $_GET['Question_Description_ID']; ?>" method="POST">
          <label class="my-1 mr-2" for="Action"><b>Change Status:</b></label>
          <select class="custom-select my-1 mr-sm-2" id="Action" name="Action">
            <option selected>Choose...</option>
            <option value="quizDraft">Draft</option>
            <option value="quiz">Post</option>
          </select>
          <input type="submit" class="btn btn-dark my-1" value="Change" name="submit">
        </form>
      </div>
      <div class="col"></div>
    </div>

  </div>
  <?php
  require_once 'assets/connect/footer.php';
  ?>
</body>

</html>