<?php
require "assets/connect/pdo.php";

//getting the data by query parameter
if (isset($_GET['batch']) && isset($_GET['sec'])) {
  $batch = $_GET['batch'];
  $sec = $_GET['sec'];

  $stmt = $pdo->query("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, question_description.Action, question_description.Meeting_Link, teacher.Name from teacher INNER JOIN question_description on teacher.Teacher_ID = question_description.Teacher_ID WHERE Action = 'post' AND Batch = $batch AND Section = '$sec' AND Meeting_Link = '' ORDER BY Question_Description_ID DESC");
  $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
      </div>
    </nav>
  </header>
  <!--posts Start(128) -->
  <main>
    <div class="container">

      <div class="row">
        <div class="col d-flex justify-content-start mt-4">
          <h2 class="display-4">Dashboard</h2>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex justify-content-center mt-3">
          <p class="">Select a question from the table below and start the exam. Double check the course code and other necessary things before proceeding further</p>
        </div>
      </div>

      <div class="row">
        <div class="col"></div>
        <div class="col-xl-11 col-lg-11 col-md-10 col-sm-9 col-xs-6 my-3">
          <table class="table table-hover">
            <thead class="bg-success text-white">
              <tr>
                <th scope="col">Title</th>
                <th scope="col">Course Code</th>
                <th scope="col">Course Code</th>
                <th scope="col">Batch</th>
                <th scope="col">Section</th>
                <th scope="col">Posted by</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

            <?php foreach ($infos as $info) { ?>

              <tr onclick="window.location='answer_script.php';">
                <th scope="row"><?php echo htmlspecialchars($info['Title']); ?></th>
                <td><?php echo htmlspecialchars($info['Course_Code']); ?></td>
                <td><?php echo htmlspecialchars($info['Course_Name']); ?></td>
                <td><?php echo htmlspecialchars($info['Batch']); ?></td>
                <td><?php echo htmlspecialchars($info['Section']); ?></td>
                <td><?php echo htmlspecialchars($info['Name']); ?></td>
                <td><a href="answer_script.php">Take the exam</a></td>
              </tr>

            <?php } ?>              

            </tbody>
          </table>

        </div>
        <div class="col"></div>
      </div>

    </div>

  </main>
  <!--posts End(128) -->

  <!--footer Start -->
  <?php
  require_once 'assets/connect/footer.php';
  ?>
  <!--footer End -->
</body>

</html>