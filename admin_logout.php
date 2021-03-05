<?php
session_start();
session_destroy();
unset($_SESSION['Admin_ID']);
header("location:admin_login.php");
