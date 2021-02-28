<?php

//Variables declared as empty for persisting data on the form
$name = $teacherId = $department = $email =  $success = $failed = '';

//errors array to put all the error message in the array
$errors = array('name' => '', 'teacherId' => '', 'department' => '', 'email' => '', 'password' => '');

if (isset($_POST["insert"])) {

  //check name
  if (empty($_POST['name'])) {
    $errors['name'] = 'A name is required';
  } else {
    $name = $_POST['name'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
      $errors['name'] = 'Name must be letters and spaces only';
    }
  }

  //teacher id check
  if (empty($_POST['teacherId'])) {
    $errors['teacherId'] = 'Teacher ID is required.';
  } else {
    $teacherId = $_POST['teacherId'];
    if (!preg_match('/^[0-9]*$/', $teacherId)) {
      $errors['teacherId'] = 'ID must be numbers only.';
    }
  }

  //check department
  if (empty($_POST['department'])) {
    $errors['department'] = 'Department name is required.';
  } else {
    $department = $_POST['department'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $department)) {
      $errors['department'] = 'Department name must be letters and spaces only!';
    }
  }

  //check email
  if (empty($_POST['email'])) {
    $errors['email'] = 'An email is required';
  } else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Email has to be a valid email address.";
    }
  }

  //check password
  if (mb_strlen($_POST['password']) < 6) {
    $errors['password'] = 'Password Must Contain At Least 6 Characters!';
  } elseif (!preg_match('#[0-9]+#', $_POST['password'])) {
    $errors['password'] = 'Your Password Must Contain At Least 1 Number!';
  } else {
    $password_polish = trim($_POST['password']);
    $salt = '6JDs,=+w^q;-57Qc,Zz:g[=8[r==FC';
    $password = md5($salt . $password_polish); 
  }


  if (array_filter($errors)) {
    //echo 'errors in form';
  } else {

    try {
      require_once "assets/connect/pdo.php";
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO teacher (Teacher_ID, Name, Department, Teacher_Email, Password) VALUES($teacherId, '$name', '$department', '$email', '$password')";
      // use exec() because no results are returned
      $pdo->exec($sql);
      $success = "<label class='alert alert-success'>Data Inserted Successfully!</label>";
    } catch(PDOException $e) {
      $err = $e->getMessage();
      $failed = "<label class='alert alert-danger'>Data insertion failed. Please try again. $err </label>";
    }
  }
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
          <h3 class="display-4">Insert Teacher Info</h3>
        </div>
      </div>
      <div class="row mt-5">



      </div>

      <div class="row">
        <div class="col"></div>
        <div class="col-xl-9 col-lg-9 col-md-10 col-sm-9 col-xs-6">
          <?php echo $failed; ?>
          <?php echo $success; ?>
          <form method="POST" action="admin_teacher_insert.php">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name);?>">
                <label class="text-danger"><?php echo $errors['name']; ?></label>
              </div>
              <div class="form-group col-md-6">
                <label>Teacher ID</label>
                <input type="number" class="form-control" name="teacherId" value="<?php echo htmlspecialchars($teacherId);?>">
                <label class="text-danger"><?php echo $errors['teacherId']; ?></label>
              </div>
            </div>

            <div class="form-group">
              <label>Department</label>
              <input type="text" class="form-control" name="department" value="<?php echo htmlspecialchars($department);?>">
              <label class="text-danger"><?php echo $errors['department']; ?></label>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email);?>">
                <label class="text-danger"><?php echo $errors['email']; ?></label>
              </div>
              <div class="form-group col-md-6">
                <label>Password</label>
                <input type="password" class="form-control" name="password">
                <label class="text-danger"><?php echo $errors['password']; ?></label>
              </div>
            </div>

            <input type="submit" class="btn btn-dark float-right mb-5" value="Insert Into Database" name="insert">
          </form>

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