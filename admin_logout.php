<?php
session_start();
session_destroy();
unset($_SESSION['Admin_ID']);
unset($_SESSION['Name']);
header("location:admin_Login.php");