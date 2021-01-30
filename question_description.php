<?php
session_start();
require_once "assets/connect/pdo.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
require_once "assets/connect/head.php";
?>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <a class="navbar-brand" href="#">LU EXAM HIVE</a>
      <button type="button" class="btn btn-sm btn-dark rounded-0 ml-3">
        <a href="teacher_dashboard.php" class="text-white text-decoration-none">Back</a>
    </nav>
  </header>
  <!--Question Description Start(128) -->
  <main>
  <div class="container">

    <div class="row">
      <div class="col d-flex justify-content-center mt-4">
        <h2 class="display-4 ">Create Question</h2>
      </div>
    </div>
    <div class="row">
      <div class="col d-flex justify-content-center mt-3">
        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate
            obcaecati incidunt veritatis totam!</p>
      </div>
    </div>

    <div class="row">
      <div class="col"></div>
      <div class="col-xl-9 col-lg-9 col-md-10 col-sm-9 col-xs-6 my-5">

          <form>

            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Course Title:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Course Code:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Batch:</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Section:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="">
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Title:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="" required>
              </div>
            </div>

            <!-- <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Sign in</button>
              </div>
            </div> -->
          </form>



      </div>
      <div class="col"></div>
    </div>

  </div>

  </main>
  <!--Question Description End(128) -->

  <?php
require_once "assets/connect/footer.php";
?>
</body>

</html>
