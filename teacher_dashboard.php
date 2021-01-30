<?php
session_start();
require_once "assets/connect/pdo.php";
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
      <a class="navbar-brand" href="#">LU EXAM HIVE</a>
      <button type="button" class="btn btn-sm btn-dark rounded-0 ml-3">
        <a href="teacher_Login.php" class="text-white text-decoration-none">Back</a>
    </nav>
  </header>
  <!--Teacher Dashboard Start(128) -->
  <main>
  <div class="container">

    <div class="row mt-4">
      <div class="col">
        <h3 class="display-4">Dashboard</h3>
      </div>
      <div class="col mt-3">
        <button type="button" class="btn btn-dark float-right"><a href="question_description.php" class="text-white text-decoration-none" >Create Question</a>
          <span>
            <i class="fas fa-plus-square"></i>
          </span>
        </button>
      </div>
    </div>
    <div class="row">
      <div class="col d-flex justify-content-center mt-3">
        <!-- <p class="">Something</p> -->
      </div>
    </div>

    <div class="row">
      <div class="col"></div>
      <div class="col-xl-9 col-lg-9 col-md-10 col-sm-9 col-xs-6 my-5">
        <table class="table">
          <thead class="table-primary">
            <tr>
              <th scope="col">Question Id</th>
              <th scope="col">Batch</th>
              <th scope="col">Section</th>
              <th scope="col">Course Code</th>
              <th scope="col">Modify</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">2021</th>
              <td>56</td>
              <td>_</td>
              <td>EEE - 2121</td>
              <td><a href="#">Edit</a> / <a href="#">Delete</a></td>
            </tr>
            <tr>
              <th scope="row">2025</th>
              <td>50</td>
              <td>F</td>
              <td>CSE - 1212</td>
              <td><a href="#">Edit</a> / <a href="#">Delete</a></td>
            </tr>
            <tr>
              <th scope="row">2030</th>
              <td>44</td>
              <td>C</td>
              <td>CSE - 1111</td>
              <td><a href="#">Edit</a> / <a href="#">Delete</a></td>
            </tr>
            <tr>
              <th scope="row">2031</th>
              <td>44</td>
              <td>A</td>
              <td>CSE - 1111</td>
              <td><a href="#">Edit</a> / <a href="#">Delete</a></td>
            </tr>
          </tbody>
        </table>

      </div>
      <div class="col"></div>
    </div>

  </div>

  </main>
  <!--Teacher Dashboard End(128) -->

  <?php
require_once 'assets/connect/footer.php';
?>
</body>

</html>
