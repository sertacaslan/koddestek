<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/redirect.css">
    <title>Yönlendir</title>
</head>

<body>
    <div class="container">
        <?php

        include("sqlconnect.php");
        $titlename = $_POST["title"];
        try {
            $db->exec("INSERT INTO tbl_titles (title) VALUES('$titlename')");
        } catch (PDOException $err) {
            echo "hata ===", $err;
        } finally {
            echo "Kayıt işlemi başarılı= ", $titlename;
            $_SESSION['titlename'] = $titlename;
            header('Location: topic.php');
            exit();
        }
        ?>
    </div>
</body>

</html>