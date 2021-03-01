<?php
require_once "assets/connect/pdo.php";

$stmt = $pdo->query("SELECT * from teacher ORDER BY Teacher_ID ");
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
          <h3 class="display-4">Teacher Info</h3>
        </div>
      </div>
      <div class="row mt-5">

        <div class="col">
          <button type="button" class="mr-2 btn btn-dark float-right"><a href="admin_teacher_insert.php" class="text-white text-decoration-none">Insert New Data </a>
            <span>
              <i class="fas fa-plus-square"></i>
            </span>
          </button>
        </div>

      </div>

      <div class="row">
        <div class="col"></div>
        <div class="col-xl-9 col-lg-9 col-md-10 col-sm-9 col-xs-6 my-5">

          <table class="table table-hover">
            <thead class="table-secondary">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Registration Datetime</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($infos as $info) { ?>

                <tr onclick="window.location='admin_teacher_details.php?id=<?php echo $info['Teacher_ID'] ?>';">
                  <th scope="row"><?php echo htmlspecialchars($info['Teacher_ID']); ?></th>
                  <td><?php echo htmlspecialchars($info['Name']); ?></td>
                  <td><?php echo htmlspecialchars($info['Teacher_Email']); ?></td>
                  <td><?php echo htmlspecialchars($info['Registration_Datetime']); ?></td>
                  <td><a href="admin_teacher_details.php?id=<?php echo $info['Teacher_ID'] ?>">More Info</a></td>
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