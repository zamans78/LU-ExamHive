<?php
session_start();
session_destroy();
unset($_SESSION['Student_ID']);
header("location:student_Login.php");
