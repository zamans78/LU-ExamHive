<?php
require "assets/connect/pdo.php";

$error = '';
$no_data = '';

//deleting record
if (isset($_POST['delete'])) {
  $id_to_delete = $_POST['id_to_delete'];

  $sql = "DELETE FROM Student WHERE Student_ID = $id_to_delete";
  $stmt = $pdo->prepare($sql);
  $stmt = $pdo->query($sql);

  if ($stmt) {
    header('Location: admin_student_info.php');
  } else {
    $error = '<label class="alert alert-danger">Something went wrong.</label>';
  }
}



//getting the data by query parameter
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $pdo->query("SELECT * from Student WHERE Student_ID = $id");
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
        <a class="navbar-brand" href="index.php"><img src="assets/images/LuExamHiveLogo.png" height="30px"> LU EXAM HIVE</a>
        <a type="button" href="javascript:history.back(1)" class="btn btn-sm btn-outline-dark ml-3"><i class="fas fa-arrow-left"></i> Go Back</a>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="row mt-4">
        <div class="col">
          <h3 class="display-4">Student Details</h3>
        </div>
      </div>

      <div class="row alert alert-light shadow-lg p-3 mb-5 bg-white rounded mt-3">
        <div class="col"></div>
        <div class="col-xl-9 col-lg-9 col-md-10 col-sm-9 col-xs-6 my-5">
          <?php foreach ($infos as $info) { ?>

            <p><b>Name: </b><span class="text-primary"><?php echo $info['FirstName'] . ' ' . $info['LastName']; ?></span></p>
            <p><b>Profile ID: </b><span class="text-primary"><?php echo $info['Profile_ID']; ?></span></p>
            <p><b>Student ID: </b><span class="text-primary"><?php echo $info['Student_ID']; ?></span></p>
            <p><b>Batch: </b><span class="text-primary"><?php echo $info['Batch']; ?></span></p>
            <p><b>Section: </b><span class="text-primary"><?php echo $info['Section']; ?></span></p>
            <p><b>Email: </b><span class="text-primary"><?php echo $info['Student_Email']; ?></span></p>
            <p><b>Email Status: </b><span class="<?php if ($info['Student_Email_Status'] != 'verified') {
                                                    $status = 'text-danger';
                                                  } else {
                                                    $status = 'text-success';
                                                  }
                                                  echo $status ?>"><?php echo htmlspecialchars($info['Student_Email_Status']); ?></span></p>
            <p><b>OTP: </b><span class="text-primary"><?php echo $info['Student_Otp']; ?></span></p>
            <p><b>Activation Code: </b><span class="text-primary"><?php echo $info['Student_Activation_Code']; ?></span></p>
            <p><b>Registration Date & Time: </b><span class="text-primary"><?php echo $info['Registration_Datetime']; ?></span></p>

            <!-- Delete Button -->

            <form action="admin_student_details.php" method="POST" class="d-flex justify-content-end">

              <input type="hidden" name="id_to_delete" value="<?php echo $info['Student_ID'] ?>">
              <input type="submit" name="delete" value="Delete record" class="btn btn-danger mt-5">

            </form>

          <?php } ?>

          <?php echo $no_data; ?>
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