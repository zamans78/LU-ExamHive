<?php

function validationHelper()
{
    if (strlen($_POST['Course_Code']) < 1 || strlen($_POST['Course_Name']) < 1 || strlen($_POST['Title']) < 1 ||
        strlen($_POST['Batch']) < 1 || strlen($_POST['Section']) < 1) {
        $_SESSION['status'] = "All fields are required";
        return false;
    }

    for ($i = 1; $i <= 9; $i++) {

        if (!isset($_POST['Question' . $i])) {
            continue;
        }

        $Question = htmlentities($_POST['Question' . $i]);

        if (strlen($Question) < 1) {
            $_SESSION['status'] = "All fields are required";
            return false;
        }
    }
    return true;
}
