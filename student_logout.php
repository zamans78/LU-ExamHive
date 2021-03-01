<?php
session_start();
session_destroy();
unset($_SESSION['Student_ID']);
unset($_SESSION['Batch']);
unset($_SESSION['Section']);
header("location:student_Login.php");
