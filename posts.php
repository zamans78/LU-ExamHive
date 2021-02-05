<!DOCTYPE html>
<html lang="en">

<head>
  <?php
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
  <!--posts Start(128) -->
  <main>
    <div class="container">

      <div class="row">
        <div class="col d-flex justify-content-center mt-4">
          <h2 class="display-4 ">Available Questions</h2>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex justify-content-center mt-3">
          <p class="">Find the question according to your needs! Double check the course code and other necessary things before proceeding further</p>
        </div>
      </div>

      <div class="row">
        <div class="col"></div>
        <div class="col-xl-9 col-lg-9 col-md-10 col-sm-9 col-xs-6 my-5">
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Question Id</th>
                <th scope="col">Batch</th>
                <th scope="col">Section</th>
                <th scope="col">Course Code</th>
                <th scope="col">Posted by</th>
                <th scope="col">Posted Date</th>
              </tr>
            </thead>
            <tbody>
              <tr onclick="window.location='index.html';">
                <th scope="row">2021</th>
                <td>56</td>
                <td>_</td>
                <td>PHY - 2111</td>
                <td>MRI</td>
                <td>date and time here</td>
              </tr>
              <tr onclick="window.location='index.html';">
                <th scope="row">2025</th>
                <td>50</td>
                <td>F</td>
                <td>CSE - 1212</td>
                <td>AAC</td>
                <td>date and time here</td>
              </tr>
              <tr onclick="window.location='index.html';">
                <th scope="row">2030</th>
                <td>44</td>
                <td>C</td>
                <td>CSE - 1111</td>
                <td>MHB</td>
                <td>date and time here</td>
              </tr>
              <tr onclick="window.location='index.html';">
                <th scope="row">2031</th>
                <td>44</td>
                <td>A</td>
                <td>CSE - 1111</td>
                <td>MHB</td>
                <td>date and time here</td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="col"></div>
      </div>

    </div>

  </main>
  <!--posts End(128) -->

  <!--footer Start -->
  <?php
  require_once 'assets/connect/footer.php';
  ?>
  <!--footer End -->
</body>

</html>