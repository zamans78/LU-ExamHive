<?php
require "assets/connect/pdo.php";
$no_data = '';
$status = '';

//getting the data by query parameter
if ($pdo) {

  $stmt = $pdo->query("SELECT * from Student WHERE Student_Email_Status = 'not verified' ORDER BY Student_ID");
  $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <a type="button" href="admin_student_info.php" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="row mt-4">
        <div class="col">
          <h3 class="display-4">Unverified Email List</h3>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col">
          <h5 class="d-flex justify-content-center">A list of students who haven't verified their email.</h5>
          <p class="d-flex justify-content-center">Students will not get access to the website untill they are verified.</p>
        </div>
      </div>

      <div class="row">
        <div class="col"></div>
        <div class="col-xl-9 col-lg-9 col-md-10 col-sm-12 col-xs-12 my-5">
          <table class="table table-hover">
            <thead>
              <tr class="bg-danger text-white">
                <th scope="col">Student_ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Batch</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($infos as $info) { ?>

                <tr onclick="window.location='admin_student_details.php?id=<?php echo $info['Student_ID'] ?>';">
                  <th scope="row"><?php echo htmlspecialchars($info['Student_ID']); ?></th>
                  <td><?php echo htmlspecialchars($info['FirstName'] . ' ' . $info['LastName']); ?></td>
                  <td><?php echo htmlspecialchars($info['Student_Email']); ?></td>
                  <td><?php echo htmlspecialchars($info['Batch']); ?></td>
                  <td><span class="<?php if ($info['Student_Email_Status'] != 'verified') {
                                      $status = 'text-danger';
                                    } else {
                                      $status = 'text-success';
                                    }
                                    echo $status ?>"><?php echo htmlspecialchars($info['Student_Email_Status']); ?></span></td>
                  <td><a href="admin_student_details.php?id=<?php echo $info['Student_ID'] ?>">More info</a></td>
                </tr>

              <?php } ?>
              <?php echo $no_data; ?>

            </tbody>
          </table>
        </div>
        <div class="col"></div>
      </div>

  </main>

  <!--footer Start -->
  <?php
  require_once 'assets/connect/footer.php';
  ?>
  <!--footer End -->

</body>

</html>