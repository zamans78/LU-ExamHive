<?php
require_once "assets/connect/pdo.php";
$verified = "verified";
$output = '';
$id = '';

$stmt = $pdo->query("SELECT COUNT(Batch), Batch from Student GROUP BY Batch");
$infos = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
        <a type="button" href="admin_dashboard.php" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="row mt-4">
        <div class="col">
          <h3 class="display-4">Student Info</h3>
        </div>
      </div>

      <div class="row mt-5">

        <div class="col">
          <button type="button" class="mr-2 btn btn-dark float-right"><a href="admin_student_unverified.php" class="text-white text-decoration-none">See Unverified Students List</a>
          </button>
        </div>
        <div class="col">

          <form method="post" class="form-inline my-2 mt-lg-0">
            <input class="form-control mr-sm-2" type="number" name="id_to_search" placeholder="Search by ID">
            <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search" value="Search">

          </form>
          <!-- Search Button Functionality -->
          <?php

          require_once "assets/connect/pdo.php";

          if (isset($_POST["search"])) {
            $id = $_POST["id_to_search"];

            $sql = $pdo->prepare("SELECT * FROM `Student` WHERE Student_ID = '$id'");
            $sql->setFetchMode(PDO::FETCH_OBJ);
            $sql->execute();

            if ($row = $sql->fetch()) {
          ?>
              <p class="mt-3 text-success"><?php echo $row->Student_ID . ' - ' . $row->FirstName . ' ' . $row->LastName . ' '; ?><a href="admin_student_details.php?id=<?php echo $row->Student_ID; ?>"> (More details)</a></p>
          <?php
            } else {
              echo "<label class='alert alert-danger'>
              ID does not exist. &emsp;
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button></label>";
            }
          }

          ?>
        </div>

      </div>

      <div class="row">
        <div class="col"></div>
        <div class="col-xl-9 col-lg-9 col-md-10 col-sm-9 col-xs-6 my-5">

          <table class="table table-hover text-center">
            <thead class="table-secondary">
              <tr>
                <th scope="col" colspan="2">Sort Student List by Batch</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($infos as $info) { ?>

                <tr onclick="window.location='admin_student_by_batch.php?batch=<?php echo $info['Batch'] ?>';">
                  <th scope="row">Batch: <span class="text-primary"><?php echo htmlspecialchars($info['Batch']); ?></span></th>
                  <td class="text-right">Total Number of Registerd Student: <b class="text-success"> <?php echo htmlspecialchars($info['COUNT(Batch)']); ?></b></td>
                </tr>

              <?php } ?>
            </tbody>
          </table>

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