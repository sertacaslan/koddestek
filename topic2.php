<?php
session_start();
include("sqlconnect.php");
?>
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
        if (isset($_SESSION["user"])) {
            $kul_id = $_SESSION["id"]; //kullanıcı idsi

            $title_id; //title id varsa session yoksa get
            if (isset($_SESSION["titlename"])) {
                $title_name = $_SESSION["titlename"];
                //başlık idsi alınır
                $basliksorgu = $db->query("SELECT * FROM tbl_titles WHERE title='$title_name'")->fetch(PDO::FETCH_ASSOC);
                $title_id = $basliksorgu['id'];
            } else {
                //session yoksa getten veri gelir
                $title_id = $_SESSION["konu"];
            }
            $topic = $_POST["topic"];
            echo "kulid=", $kul_id, " titleid=", $title_id, " ";

            //topic ekler
            try {
                $db->exec("INSERT INTO tbl_topic (topictext,titleId,userId) VALUES('$topic','$title_id','$kul_id')");
            } catch (PDOException $err) {
                echo "hata ===", $err;
            } finally {
                echo "Kayıt işlemi başarılı";
                unset($_SESSION["title"]);
                unset($_SESSION["konu"]);

                header("Location: index.php?title=$title_id");

                echo "kulid=", $kul_id, " titleid=", $title_id, " ";
                exit();
            }
        } else {
            echo "Bu özelliği kullanabilmek için lütfen giriş yapın.";

            header("Location: index.php?title=$title_id");
        }
        ?>
    </div>
</body>

</html>