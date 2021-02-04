<?php
session_start();
require_once "assets/connect/pdo.php";

if (!isset($_SESSION['Name']) && !isset($_SESSION['Teacher_ID'])) {
    header("Location: teacher_Login.php");
    return;

} else {
    //Here we can manage indivisual profile maintain.
    $name = $_SESSION['Name'];
    $stmt = $pdo->query("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name,question_description.Title from teacher INNER JOIN question_description on teacher.Teacher_ID = question_description.Teacher_ID where name='$name'");

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo '<pre>';
    //var_dump($rows);
    //echo '</pre>';
}
?>

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
      <a class="navbar-brand" href="#">LU EXAM HIVE</a>
      <button type="button" class="btn btn-sm btn-dark rounded-0 ml-3">
        <a href="teacher_logout.php" class="text-white text-decoration-none">LOGOUT</a>
    </nav>
  </header>
  <!--Teacher Dashboard Start(128) -->
  <main>
  <div class="container">

    <div class="row mt-4">
      <div class="col">
        <h3 class="display-4">Dashboard</h3>
      </div>
      <div class="col mt-3">
        <button type="button" class="btn btn-dark float-right"><a href="question_description.php" class="text-white text-decoration-none" >Create Question</a>
          <span>
            <i class="fas fa-plus-square"></i>
          </span>
        </button>
      </div>
    </div>
    <div class="row">
      <div class="col d-flex justify-content-center mt-3">
        <!-- <p class="">Something</p> -->
      </div>
    </div>

    <div class="row">
      <div class="col"></div>
      <div class="col-xl-9 col-lg-9 col-md-10 col-sm-9 col-xs-6 my-5">
<?php
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<tr class='bg-dark text-white'>";
echo "<th scope='col'>Course Name</th>";
echo "<th scope='col'>Batch</th>";
echo "<th scope='col'>Section</th>";
echo "<th scope='col'>Course Code</th>";
echo "<th scope='col'>Modify</th>";
echo " </tr>";
echo "</thead>";
echo " <tbody>";
if (true) {
    foreach ($rows as $row) {
        echo "<tr><td>";
        echo ("<a href='question_view.php?Question_Description_ID=" . $row['Question_Description_ID'] . "'>" . $row['Course_Name'] . "</a>");
        echo ("</td><td>");
        echo ($row['Batch']);
        echo ("</td><td>");
        echo ($row['Section']);
        echo ("</td><td>");
        echo ($row['Course_Code']);
        echo ("</td>");
        echo ("<td>");
        echo ('<a href="question_edit.php?Question_Description_ID=' . $row['Question_Description_ID'] . '"><i class="fas fa-edit"></i></a> / <a href="question_delete.php?Question_Description_ID=' . $row['Question_Description_ID'] . '"><i class="far fa-trash-alt"></i></a>');
        echo ("</td></tr>\n");
    }
    echo " </tbody>";
    echo " </table>";
} else {
    echo 'No Questions Made.';
}
?>
      </div>
      <div class="col"></div>
    </div>

  </div>

  </main>
  <!--Teacher Dashboard End(128) -->

<?php
require_once 'assets/connect/footer.php';
?>
</body>

</html>
