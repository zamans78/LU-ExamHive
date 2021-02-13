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
  <div class="text-center bg-light text-dark mb-5">
    <div class="bg-info text-white py-2">
      <h2 class="display-4">Answer Script</h2>
    </div>
  </div>
  <div class="container">
    <p class="pt-2 text-center">Fill in the form below before writing answers.</p>

    <form method="POST" action="student_Registration.php">

      <div class="student-info shadow p-3 mb-5 bg-white rounded mt-3">

        <div class="row">
          <div class="col">
            <input type="text" name="Name" class="form-control" placeholder="Name">
          </div>

          <div class="col">
            <input type="number" name="ID" class="form-control" placeholder="ID">
          </div>
        </div>
        <div class="row mt-3">

          <div class="col">
            <input type="number" name="Course_Code" class="form-control" placeholder="Course Code">
          </div>

          <div class="col">
            <input type="number" name="Batch" class="form-control" placeholder="Batch">
          </div>

          <div class="col">
            <input type="text" name="Section" class="form-control" placeholder="Section">
          </div>
        </div>

      </div>

      <div class="answers shadow-lg p-3 mb-5 bg-white rounded mt-3">

        <div class="row">
          <div class="col d-flex justify-content-center mt-5">
            <h4>Leading University</h4>
          </div>
        </div>

        <div class="row">
          <div class="col d-flex justify-content-center">
            <h6>Department of CSE</h6>
          </div>
        </div>

        <div class="row">
          <div class="col d-flex justify-content-center">
            <h6>Mid-term Examination, Fall-2020.</h6>
          </div>
        </div>

        <div class="row">
          <div class="col d-flex justify-content-center">
            <h6>Course Title: Microprocessor, Assembly Language</h6>
          </div>
        </div>

        <div class="row">
          <div class="col d-flex justify-content-center">
            <h6>Course Code: EEE-3211</h6>
          </div>
        </div>

        <div class="row">
          <div class="col d-flex justify-content-center">
            <h6>Batch: 55</h6>
          </div>
        </div>

        <div class="row">
          <div class="col d-flex justify-content-center">
            <h6>Section: C</h6>
          </div>
        </div>

        <div class="row">
          <div class="col d-flex justify-content-center mb-5">
            <h6>Answer the following question.</h6>
          </div>
        </div>


        <div class="form-group px-xs-0 px-sm-0 px-md-3 px-lg-5 px-xl-5 mx-xs-1 mx-sm-1 mx-md-3 mx-lg-5 mx-xl-5 mb-5">
          <label class="control-label col-sm-12 d-flex justify-content-left " for="Title"><b>Q. Are you Modoris Ali?</b></label>
          <div class="col">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>

        <div class="form-group px-xs-0 px-sm-0 px-md-3 px-lg-5 px-xl-5 mx-xs-1 mx-sm-1 mx-md-3 mx-lg-5 mx-xl-5 mb-5">
          <label class="control-label col-sm-12 d-flex justify-content-left " for="Title"><b>Q. Do you eat Rice?</b></label>
          <div class="col">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>

        <div class="form-group px-xs-0 px-sm-0 px-md-3 px-lg-5 px-xl-5 mx-xs-1 mx-sm-1 mx-md-3 mx-lg-5 mx-xl-5 mb-5">
          <label class="control-label col-sm-12 d-flex justify-content-left " for="Title"><b>Q. Why do you eat?</b></label>
          <div class="col">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>

        <div class="form-group px-xs-0 px-sm-0 px-md-3 px-lg-5 px-xl-5 mx-xs-1 mx-sm-1 mx-md-3 mx-lg-5 mx-xl-5 mb-5">
          <label class="control-label col-sm-12 d-flex justify-content-left " for="Title"><b>Q. Explain why do you eat?</b></label>
          <div class="col">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>

        <div class="form-group px-xs-0 px-sm-0 px-md-3 px-lg-5 px-xl-5 mx-xs-1 mx-sm-1 mx-md-3 mx-lg-5 mx-xl-5 mb-5">
          <label class="control-label col-sm-12 d-flex justify-content-left " for="Title"><b>Q. Explain again why do you eat?</b></label>
          <div class="col">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>




      </div>



    </form>




  </div>








  <!--footer Start -->
  <?php
  require_once 'assets/connect/footer.php';
  ?>
  <!--footer End -->
</body>

</html>