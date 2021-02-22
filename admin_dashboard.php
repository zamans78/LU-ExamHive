<?php
session_start();
require_once "assets/connect/pdo.php";
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
        <a class="navbar-brand" href="index.php"><img src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="row mt-4">
        <div class="col">
          <h3 class="display-4">Admin Dashboard</h3>
        </div>
      </div>
      <div class="row">
        <div class="col">

          <div class="row my-5">
            <div class="col-sm-4 pb-3">
              <div class="card contact-shadow">
                <div class="card-body">
                  <h5 class="card-title">Contact info</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="admin_contact_info.php" class="btn btn-dark">More info</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4 pb-3">
              <div class="card teacher-shadow">
                <div class="card-body">
                  <h5 class="card-title">Teacher info</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-dark">More info</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4 pb-3">
              <div class="card student-shadow">
                <div class="card-body">
                  <h5 class="card-title">Student info</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="admin_student_info.php" class="btn btn-dark">More info</a>
                </div>
              </div>
            </div>

          </div>

        </div>
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