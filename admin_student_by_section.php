<?php
session_start();
require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Admin_ID'])) {
    header("Location: admin_login.php");
    return;
}

$no_data = '';
$status = '';

//getting the data by query parameter
if (isset($_GET['batch']) && isset($_GET['section'])) {
    $batch = $_GET['batch'];
    $section = $_GET['section'];

    $stmt = $pdo->query("SELECT * from Student WHERE Batch = $batch AND Section = '$section' ORDER BY Student_ID");
    $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //total student count
    $stmt2 = $pdo->query("SELECT COUNT(Section) from Student WHERE Batch = $batch AND Section = '$section'");
    $infos2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
} else {
    $no_data = '<h5 class="alert alert-danger">No data available.</h5>';
}

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
        <a type="button" href="javascript:history.back(1)" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="row mt-4">
        <div class="col">
          <h3 class="display-4">Student Info by Section</h3>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col">
          <h4 class="d-flex justify-content-center">Section:&nbsp;<span class="text-success"><?php echo $section ?></span></h4>

          <h4 class="d-flex justify-content-center">Total Number of Registerd Students: &nbsp;<span class="text-success"><?php foreach ($infos2 as $info2) {
    echo htmlspecialchars($info2['COUNT(Section)']);
}?></span></h4>
        </div>
      </div>


      <div class="row">
        <div class="col"></div>
        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-9 col-xs-6 my-5">

          <table class="table table-hover text-center">
            <thead class="table-secondary">
              <tr>
                <th scope="col">Student Id</th>
                <th scope="col">Name</th>
                <th scope="col">Section</th>
                <th scope="col">Batch</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($infos as $info) {?>

                <tr onclick="window.location='admin_student_details.php?id=<?php echo $info['Student_ID'] ?>';">
                  <th scope="row"><?php echo htmlspecialchars($info['Student_ID']); ?></th>
                  <td><?php echo htmlspecialchars($info['FirstName'] . ' ' . $info['LastName']); ?></td>
                  <td><?php echo htmlspecialchars($info['Section']); ?></td>
                  <td><?php echo htmlspecialchars($info['Batch']); ?></td>
                  <td><?php echo htmlspecialchars($info['Student_Email']); ?></td>
                  <td><span class="<?php if ($info['Student_Email_Status'] != 'verified') {
    $status = 'text-danger';
} else {
    $status = 'text-success';
}
    echo $status?>"><?php echo htmlspecialchars($info['Student_Email_Status']); ?></span></td>
                  <td><a href="admin_student_details.php?id=<?php echo $info['Student_ID'] ?>">More info</a></td>
                </tr>

              <?php }?>
              <?php echo $no_data; ?>
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