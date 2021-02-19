<?php
require_once "assets/connect/pdo.php";
  $verified = "verified";
  
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
        <a class="navbar-brand" href="index.php"><img src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
        <a type="button" href="javascript:history.back(1)" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
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
          <button type="button" class="mr-2 btn btn-dark float-right"><a href="#" class="text-white text-decoration-none">See Unregistered Students List</a>
          </button>
        </div>
        <div class="col">
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search Student by ID" aria-label="Search">
            <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Search">
          </form>
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
            <?php foreach ($infos as $info){ ?>

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