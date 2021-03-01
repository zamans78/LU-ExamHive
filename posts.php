<?php

require_once "assets/connect/pdo.php";

$stmt = $pdo->query("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, question_description.Action, question_description.Meeting_Link, teacher.Name from teacher INNER JOIN question_description on teacher.Teacher_ID = question_description.Teacher_ID WHERE Action = 'post' AND Meeting_Link = '' ORDER BY Question_Description_ID DESC");
$infos = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
      <a class="navbar-brand" href="index.php"><img id="logo" src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
        <a type="button" href="javascript:history.back(1)" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
      </div>
    </nav>
  </header>
  <!--posts Start(128) -->
  <main>
    <div class="container">

      <div class="row">
        <div class="col d-flex justify-content-center mt-4">
          <h2 class="display-4 ">Available Questions</h2>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex justify-content-center mt-3">
          <p class="">Find the question according to your needs! Double check the course code and other necessary things before proceeding further</p>
        </div>
      </div>

      <div class="row">
        <div class="col"></div>
        <div class="col-xl-11 col-lg-11 col-md-10 col-sm-9 col-xs-6 my-5">
          <table class="table table-hover">
            <thead>
              <tr class='bg-dark text-white'>
                <th scope="col">Title</th>
                <th scope="col">Course Code</th>
                <th scope="col">Course Title</th>
                <th scope="col">Batch (Sec)</th>
                <th scope="col">Posted by</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($infos as $info) { ?>

                <tr onclick="window.location='answer_script.php?id=<?php echo $info['Question_Description_ID']; ?>&title=<?php echo $info['Title']; ?>&ct=<?php echo $info['Course_Name']; ?>&cc=<?php echo $info['Course_Code']; ?>&batch=<?php echo $info['Batch']; ?>&sec=<?php echo $info['Section']; ?>';">
                  <td><?php echo htmlspecialchars($info['Title']); ?></td>
                  <td><?php echo htmlspecialchars($info['Course_Code']); ?></td>
                  <td><?php echo htmlspecialchars($info['Course_Name']); ?></td>
                  <td><?php echo htmlspecialchars($info['Batch']); ?>(<?php echo htmlspecialchars($info['Section']); ?>)</td>
                  <td><?php echo htmlspecialchars($info['Name']); ?></td>
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