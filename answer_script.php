<?php

$question_id = $_GET['id'];
$title = $_GET['title'];
$course_title = $_GET['ct'];
$course_code = $_GET['cc'];
$batch = $_GET['batch'];
$section = $_GET['sec'];

// Variables declared as empty for persisting data on the form
$name = $student_id = $batch = $section = $success = $failed = $reg_done = '';

// errors array to put all the error message in the array
$errors = array('name' => '', 'student_id' => '', 'batch' => '', 'section' => '');

// Validating and setting data in variables from first form

if (isset($_POST["submit"])) {

  //check name
  if (empty($_POST['name'])) {
    $errors['name'] = 'A name is required';
  } else {
    $name = $_POST['name'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
      $errors['name'] = 'Name must be letters and spaces only';
    }
  }

  //student id check
  if (empty($_POST['student_id'])) {
    $errors['student_id'] = 'Student ID is required.';
  } else {
    $student_id = $_POST['student_id'];
    if (!preg_match('/^[0-9]*$/', $student_id)) {
      $errors['student_id'] = 'ID must be numbers only.';
    }
  }

  //batch check
  if (empty($_POST['batch'])) {
    $errors['batch'] = 'Batch is required.';
  } else {
    $batch = $_POST['batch'];
    if (!preg_match('/^[0-9]*$/', $batch)) {
      $errors['batch'] = 'Batch must be numbers only.';
    }
  }

  //section check
  if (empty($_POST['section'])) {
    $errors['section'] = 'Section is required.';
  } else {
    $section = $_POST['section'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $section)) {
      $errors['section'] = 'Section must be a character.';
    }
  }


  if (array_filter($errors)) {
    //echo 'errors in form';
  } else {
    //setting info in variables here
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $batch = $_POST['batch'];
    $section = $_POST['section'];

    $reg_done = "<label class='alert alert-success'>Registration Done! Now you may write answers. Scroll down to see the questions. &emsp;
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                 </label>";
  }
}



//fetching questions and other data
if (isset($_GET['id'])) {
  $question_id = $_GET['id'];
  require_once "assets/connect/pdo.php";
  $stmt = $pdo->query("SELECT * FROM question_description WHERE Question_Description_ID = $question_id");

  $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//inserting answer in database
if (isset($_POST["ansSubmit"])) {

  $ansName = $_POST['ansName'];
  $ansId = $_POST['ansId'];
  $ansBatch = $_POST['ansBatch'];
  $ansSec = $_POST['ansSec'];
  $ansQuestion_ID = $_POST['ansQuestion_ID'];
  $answer = $_POST['answer'];



  try {
    require_once "assets/connect/pdo.php";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO student_answer (Full_Name, Student_ID, Batch, Section, Question_Description_ID, Answer) VALUES('$ansName', '$ansId', '$ansBatch', '$ansSec', '$ansQuestion_ID', '$answer')";
    // use exec() because no results are returned
    $pdo->exec($sql);
    $success = "<label class='alert alert-success'>Data Inserted Successfully!</label>";
  } catch (PDOException $e) {
    $err = $e->getMessage();
    $failed = "<label class='alert alert-danger'>Data insertion failed. Please try again. $err </label>";
  }
}
// echo '<pre>';
// var_dump($infos);
// echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">

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
  <div class="text-center bg-light text-dark mb-5">
    <div class="bg-info text-white py-2">
      <h2 class="display-4">Answer Script</h2>
    </div>
  </div>
  <div class="container">
    <p class="pt-2 text-center">Fill in the form below and <b>submit it first</b> then start writing the answers.</p>
    <?php echo $reg_done; ?>
    <?php echo $failed; ?>
    <?php echo $success; ?>

    <!-- exam paper registration form -->
    <form method="POST" action="answer_script.php?id=<?php echo $question_id; ?>&title=<?php echo $title; ?>&ct=<?php echo $course_title; ?>&cc=<?php echo $course_code; ?>&batch=<?php echo $batch; ?>&sec=<?php echo $section; ?>">

      <div class="student-info shadow p-3 mb-5 bg-white rounded mt-3">

        <div class="row">
          <div class="col">
            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>">
            <label class="text-danger"><?php echo $errors['name']; ?></label>
          </div>

          <div class="col">
            <input type="number" name="student_id" class="form-control" placeholder="Student ID" value="<?php echo htmlspecialchars($student_id); ?>">
            <label class="text-danger"><?php echo $errors['student_id']; ?></label>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <input type="number" name="batch" class="form-control" placeholder="Batch" value="<?php echo htmlspecialchars($batch); ?>">
            <label class="text-danger"><?php echo $errors['batch']; ?></label>
          </div>

          <div class="col">
            <input type="text" name="section" class="form-control" placeholder="Section" value="<?php echo htmlspecialchars($section); ?>">
            <label class="text-danger"><?php echo $errors['section']; ?></label>
          </div>
        </div>
        <div class="row">
          <div class="col d-flex justify-content-center mt-4">
            <input type="submit" class="form-group btn btn-sm btn-dark px-4" name="submit" value="Submit">
          </div>
        </div>

      </div>
    </form>


    <!-- question info -->
    <div class="answers shadow-lg p-3 mb-5 bg-white rounded mt-3">


      <div class="row">
        <div class="col d-flex justify-content-center mt-5">
          <h4>Leading University</h4>
        </div>
      </div>

      <div class="row">
        <div class="col d-flex justify-content-center">
          <h6>Department of CSE</h6>
        </div>
      </div>

      <div class="row">
        <div class="col d-flex justify-content-center">
          <h6><?php echo $title; ?></h6>
        </div>
      </div>

      <div class="row">
        <div class="col d-flex justify-content-center">
          <h6>Course Title: <?php echo $course_title; ?></h6>
        </div>
      </div>

      <div class="row">
        <div class="col d-flex justify-content-center">
          <h6>Course Code: <?php echo $course_code; ?></h6>
        </div>
      </div>

      <div class="row">
        <div class="col d-flex justify-content-center">
          <h6>Batch: <?php echo $batch; ?></h6>
        </div>
      </div>

      <div class="row">
        <div class="col d-flex justify-content-center">
          <h6>Section: <?php echo $section; ?></h6>
        </div>
      </div>


      <div class="row">
        <div class="col d-flex justify-content-center mb-5">
          <h6>Answer the following question.</h6>
        </div>
      </div>




      <!-- question start -->
      <!-- https://stackoverflow.com/questions/15320069/how-to-prevent-user-pasting-text-in-a-textbox -->
      <form action="answer_script.php?id=<?php echo $question_id; ?>&title=<?php echo $title; ?>&ct=<?php echo $course_title; ?>&cc=<?php echo $course_code; ?>&batch=<?php echo $batch; ?>&sec=<?php echo $section; ?>" method="POST">
        <?php foreach ($infos as $info) { ?>
          <!-- hidden form data -->
          <input type="hidden" name="ansName" value="<?php echo $name; ?>">
          <input type="hidden" name="ansId" value="<?php echo $student_id; ?>">
          <input type="hidden" name="ansBatch" value="<?php echo $batch; ?>">
          <input type="hidden" name="ansSec" value="<?php echo $section; ?>">
          <input type="hidden" name="ansQuestion_ID" value="<?php echo $info['Question_Description_ID']; ?>">

          <div class="form-group px-xs-0 px-sm-0 px-md-3 px-lg-5 px-xl-5 mx-xs-1 mx-sm-1 mx-md-3 mx-lg-5 mx-xl-5 mb-5">
            <label class="control-label col-sm-12 d-flex justify-content-left" for="Title"><b>Q. <?php echo $info['Content']; ?></b></label>
            <div class="col">

              <textarea name="answer" class="form-control" id="exampleFormControlTextarea1" rows="20" onkeypress='validate(event)' maxlength="700" value="${cpCon.receiveNo}" required onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete=off></textarea>

            </div>
          </div>

        <?php } ?>

        <div class="row">
          <div class="col d-flex justify-content-center mb-5">
            <input type="submit" class="form-group btn btn-dark px-4" name="ansSubmit" value="Submit">
          </div>
        </div>

      </form>

    </div>



  </div>








  <!--footer Start -->
  <?php
  require_once 'assets/connect/footer.php';
  ?>
  <!--footer End -->
</body>

</html>