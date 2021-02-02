<?php
session_start();
session_destroy();
unset($_SESSION['Teacher_ID']);
unset($_SESSION['Name']);
header("location:teacher_Login.php");
