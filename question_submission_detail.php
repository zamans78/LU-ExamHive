<?php
session_start();
require_once "assets/connect/pdo.php";

$errors = array('score' => '');
$success = '';

//getting the data by query parameter
if (isset($_GET['Question_Description_ID']) && isset($_GET['Student_Id'])) {
    $question_id = $_GET['Question_Description_ID'];
    $student_id = $_GET['Student_Id'];
    $_SESSION['question_id'] = $_GET['Question_Description_ID'];

    $stmt = $pdo->query("SELECT * FROM student_answer INNER JOIN question_description on question_description.Question_Description_ID = student_answer.Question_Description_ID WHERE question_description.Question_Description_ID = '$question_id' AND student_answer.Student_ID = '$student_id'");
    $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//putting score in database
if (isset($_POST['submit'])) {
    if (empty($_POST['score'])) {
        $errors['score'] = "Please proive a score in number.";
    } else {
        $score = $_POST['score'];
        if (!preg_match('/^[0-9]*$/', $score)) {
            $errors['score'] = "Score must be numbers only.";
        }
    }

    if (array_filter($errors)) {
        //echo 'errors in form';
    } else {

        try {
            require_once "assets/connect/pdo.php";
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE student_answer SET Score = '$score' WHERE Student_ID = '$student_id' AND Question_Description_ID = '$question_id'";
            // use exec() because no results are returned
            $pdo->exec($sql);
            $success = "<label class='alert alert-success'>Score has been updated!&emsp;
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button></label>";
        } catch (PDOException $e) {
            $err = $e->getMessage();
            echo "Data insertion failed. Please try again. $err";
        }

        $question_id = $_SESSION['question_id'];
        sleep(1);
        header("Location: question_submission.php?Question_Description_ID=$question_id");
    }
}

?>

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
        <a type="button" href="javascript:history.back(1)" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="row mt-4">
        <div class="col">
          <h3 class="display-4">Submission Details</h3>
        </div>
      </div>
      <?php echo $success; ?>
      <div class="row">
        <div class="col">
          <p class="text-center mt-3">Individual student submission details.</p>
          <?php foreach ($infos as $info) {?>
            <p class="text-center">
              <b><?php echo $info['Title']; ?> &emsp;</b>
              <b>Course Code: </b><span class="text-primary"><?php echo $info['Course_Code']; ?></span> &emsp;
              <b>Course Title: </b><span class="text-primary"><?php echo $info['Course_Name']; ?></span> &emsp;
            </p>
        </div>
      </div>

      <div class="row alert alert-light shadow-lg p-3 mb-5 bg-white rounded mt-3">
        <div class="col"></div>
        <div class="col-xl-9 col-lg-9 col-md-10 col-sm-9 col-xs-6 my-5">


          <p class="text-center">
            <b>Name: </b><span class="text-primary"><?php echo $info['Full_Name']; ?></span> &emsp;
            <b>Student ID: </b><span class="text-primary"><?php echo $info['Student_ID']; ?></span> &emsp;
            <b>Batch (Sec): </b><span class="text-primary"><?php echo htmlspecialchars($info['Batch']); ?>(<?php echo htmlspecialchars($info['Section']); ?>)</span> &emsp;
          </p>

          <p class="text-center">
            <button class="btn btn-sm btn-light" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">See The Question&nbsp;<i class="fas fa-chevron-circle-down"></i>
            </button>
          </p>

          <div class="collapse" id="collapseExample">
            <div class="card card-body">
              <p><?php echo $info['Content']; ?></p>
            </div>
          </div>


          <h4 class="text-primary">Answer:</h4>
          <p><?php echo $info['Answer']; ?></p>




          <form method="POST" action="question_submission_detail.php?Question_Description_ID=<?php echo $info['Question_Description_ID']; ?>&Student_Id=<?php echo $info['Student_ID']; ?>" class="form-inline mt-5 pt-5 float-right">
            <div class="form-group mb-2">
              <label>Give a Score or Update Current Score: </label>
            </div>
            <div class="form-group mx-3 mb-2">
              <input type="number" name="score" class="form-control form-control-sm" id="inputPassword2" value="<?php echo $info['Score']; ?>">
              <label class="text-danger"><?php echo $errors['score']; ?></label>
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-sm btn-dark mb-2">
          </form>



        <?php }?>
        </div>
        <div class="col"></div>
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