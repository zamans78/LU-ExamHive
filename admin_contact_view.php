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
          <h3 class="display-4">Contact Info</h3>
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
                <th scope="col">Received At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr onclick="window.location='#';">
                <th scope="row">6</th>
                <td>Modoris Ali</td>
                <td>modoris@gmail.com</td>
                <td>2021-02-06 18:54:51</td>
                <td><a href="#">View</a> / <a href="#">Delete</a></td>
              </tr>
              <tr onclick="window.location='#';">
                <th scope="row">6</th>
                <td>Modoris Ali</td>
                <td>modoris@gmail.com</td>
                <td>2021-02-06 18:54:51</td>
                <td><a href="#">View</a> / <a href="#">Delete</a></td>
              </tr>
              <tr onclick="window.location='#';">
                <th scope="row">6</th>
                <td>Modoris Ali</td>
                <td>modoris@gmail.com</td>
                <td>2021-02-06 18:54:51</td>
                <td><a href="#">View</a> / <a href="#">Delete</a></td>
              </tr>
              <tr onclick="window.location='#';">
                <th scope="row">6</th>
                <td>Kodoris Ali</td>
                <td>Kodoris@gmail.com</td>
                <td>2021-02-06 13:54:51</td>
                <td><a href="#">View</a> / <a href="#">Delete</a></td>
              </tr>
              
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