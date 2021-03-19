<?php
session_start();
require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Name']) && !isset($_SESSION['Teacher_ID'])) {
  header("Location: teacher_Login.php");
  return;
}

$question_id = $_GET['id'];

if (isset($_POST['next'])) {
  $qnum = $_POST['qnum'];
  $question = $_POST['question'];
  $choice1 = $_POST['choice1'];
  $choice2 = $_POST['choice2'];
  $choice3 = $_POST['choice3'];
  $answer = $_POST['answer']; 

  try {

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO quiz_question (Question_Description_ID, Question_Number, Question, Choice1, Choice2, Choice3, Answer) VALUES($question_id, $qnum, '$question', '$choice1', '$choice2', '$choice3', '$answer')";
    // use exec() because no results are returned
    $pdo->exec($sql);

    header("Location: question_quiz_description.php?id=$question_id");
  } catch (PDOException $e) {
    $err = $e->getMessage();
    echo "Something went wrong $err";
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  //Head Links
  require_once 'assets/connect/head.php';
  ?>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <div class="container justify-content-start">
        <a class="navbar-brand" href="index.php"><img id="logo" src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
        <a type="button" href="question_quiz.php" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
      </div>
    </nav>
  </header>
  <main>

    <div class="card text-center bg-light text-dark ">
      <div class="card-header bg-dark text-white ">
        <h2 class="display-4">Insert Quiz Quesition</h2>
      </div>
      <div class="row">
        <div class="col"></div>
        <div class="col-8 d-flex justify-content-center mt-3">
          <p>Insert quiz quesition below, click 'Next' to insert another or if done click 'Exit'. <br> Please remeber to put the right 'Question Number' to avoid any conflict in database.</p>
        </div>
        <div class="col"></div>
      </div>
      <div class="container col-xl-7 col-lg-7 col-md-7">
        <form method="POST" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $question_id ?>">

          <div class="form-group">
            <label class="control-label text-primary col-form-label-sm col-sm-4 d-flex justify-content-left" for="qnum"><b>Question Number</b></label>
            <div class="col">
              <input class="form-control form-control-sm col-4" type="number" name="qnum" id="qnum" required>
            </div>
          </div>

          <div class="form-group input-group input-group-lg">
            <label class="control-label col-form-label-lg col-sm-12 d-flex justify-content-left" for="question"><b>Question:</b></label>
            <div class="col">
              <input class="form-control form-control-lg" type="text" name="question" id="question" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label text-danger col-form-label-sm col-sm-12 d-flex justify-content-left" for="choice1"><b>Choice 1:</b></label>
            <div class="col">
              <input class="form-control form-control-sm" type="text" name="choice1" id="choice1">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label text-danger col-form-label-sm col-sm-12 d-flex justify-content-left" for="choice2"><b>Choice 2:</b></label>
            <div class="col">
              <input class="form-control form-control-sm" type="text" name="choice2" id="choice2">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label text-danger col-form-label-sm col-sm-12 d-flex justify-content-left" for="choice3"><b>Choice 3:</b></label>
            <div class="col">
              <input class="form-control form-control-sm" type="text" name="choice3" id="choice3">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label text-success col-form-label-sm col-sm-12 d-flex justify-content-left" for="answer"><b>Answer:</b></label>
            <div class="col">
              <input class="form-control form-control-sm" type="text" name="answer" id="answer">
            </div>
          </div>

          <div class="form-group d-flex justify-content-center ">
            <div class="col-sm-4 col-sm-offset-2 p-1">
              <p></p><input class="btn btn-success btn-block mb-5" type="submit" name="next" value="Next >">
            </div>
          </div>

        </form>

        <div class="col d-flex justify-content-center mt-3">
          <p class="">Note: Choices and answer will be shuffled on students end.<br> When you are done creating all questions click the exit button below.</p>
        </div>

        <div class="col d-flex justify-content-center mt-3">
          <a class="btn btn-block btn-primary mb-4" href="teacher_dashboard.php">Exit</a>
        </div>


      </div>

  </main>

  <!--footer Start -->
  <?php
  require_once 'assets/connect/footer.php';
  ?>
  <!--footer End -->

</body>

</html>