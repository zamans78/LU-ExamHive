<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=lu_exam_hive', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
