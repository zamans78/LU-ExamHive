<?php
require "assets/connect/pdo.php";

//getting the data by query parameter
if (isset($_GET['id'])) {
  $question_id = $_GET['id'];

  //fetching questions
  $stmt = $pdo->query("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, question_description.Action, question.Question_ID, question.Question FROM question 
  INNER JOIN question_description ON question.Question_Description_ID = question_description.Question_Description_ID 
  WHERE question.Question_Description_ID = $question_id ORDER BY question.Question_ID ASC");
  $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);

  //fetching qestion info
  $sql = $pdo->prepare("SELECT * FROM `question_description` WHERE Question_Description_ID = $question_id");
  $sql->setFetchMode(PDO::FETCH_OBJ);
  $sql->execute();
}

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
    <p class="pt-2 text-center">Fill in the form below before writing answers.</p>



    <form method="POST" action="#">

      <div class="student-info shadow p-3 mb-5 bg-white rounded mt-3">

        <div class="row">
          <div class="col">
            <input type="text" name="Name" class="form-control" placeholder="Name">
          </div>

          <div class="col">
            <input type="number" name="ID" class="form-control" placeholder="ID">
          </div>
        </div>
        <div class="row mt-3">

          <div class="col">
            <input type="number" name="Course_Code" class="form-control" placeholder="Course Code">
          </div>

          <div class="col">
            <input type="number" name="Batch" class="form-control" placeholder="Batch">
          </div>

          <div class="col">
            <input type="text" name="Section" class="form-control" placeholder="Section">
          </div>
        </div>

      </div>




      <!-- question info -->
      <div class="answers shadow-lg p-3 mb-5 bg-white rounded mt-3">

        <?php if ($row = $sql->fetch()) { ?>

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
              <h6>Batch: <?php echo $row->Batch; ?></h6>
            </div>
          </div>

          <div class="row">
            <div class="col d-flex justify-content-center">
              <h6>Section: <?php echo $row->Section; ?></h6>
            </div>
          </div>


          <div class="row">
            <div class="col d-flex justify-content-center mb-5">
              <h6>Answer the following question.</h6>
            </div>
          </div>

        <?php } ?>


        <!-- question start -->
        <!-- https://stackoverflow.com/questions/15320069/how-to-prevent-user-pasting-text-in-a-textbox -->
        <?php foreach ($infos as $info) { ?>
          <div class="form-group px-xs-0 px-sm-0 px-md-3 px-lg-5 px-xl-5 mx-xs-1 mx-sm-1 mx-md-3 mx-lg-5 mx-xl-5 mb-5">
            <label class="control-label col-sm-12 d-flex justify-content-left " for="Title"><b>Q. <?php echo $info['Question']; ?> </b></label>
            <div class="col">
              <textarea name="ansBox" class="form-control" id="exampleFormControlTextarea1" rows="3" onkeypress='validate(event)' maxlength="700" value="${cpCon.receiveNo}" required onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete=off></textarea>
            </div>
          </div>

        <?php } ?>


        <div class="row">
          <div class="col d-flex justify-content-center mb-5">
            <input type="submit" class="form-group btn btn-dark px-4" name="ansSubmit" value="Submit">
          </div>
        </div>


      </div>

    </form>
    
  </div>








  <!--footer Start -->
  <?php
  require_once 'assets/connect/footer.php';
  ?>
  <!--footer End -->
</body>

</html>