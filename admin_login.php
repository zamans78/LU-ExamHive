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
      <div class="row">

        <div class="col"></div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-5">
          <div class="card my-5 shadow-lg p-3 my-5 bg-white rounded">
            <div class="card-body">
              <h5 class="card-title">Admin Login</h5>
              <form>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <input type="submit" class="btn btn-dark" name="submit" value="Log in">
              </form>
            </div>
          </div>
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