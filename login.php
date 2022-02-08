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
        require("sqlconnect.php");
        $username = $_POST["user"];
        $userpass = $_POST["pass"];

        if ($username == null || $userpass == null) {
            echo "kullanıcı adı ve şifreyi boş bırakmayın";
            header('refresh:3;url="index.php"');
        } else {
            $cek = $db->query("select * from tbl_user where username = '$username' && pass = '$userpass' ", PDO::FETCH_ASSOC);
            if ($cek->rowCount()) {
                $kul = $db->query("SELECT id FROM tbl_user WHERE username='$username'")->fetch(PDO::FETCH_ASSOC);
                session_start();
                $_SESSION["user"] = $username;
                $_SESSION["id"] = $kul['id'];
                echo "Sayın " . $username . " Üye girişi başarılı, anasayfaya yönlendiriliyorsunuz...";
                header('refresh:3;url="index.php"');
            } else {
                echo "kullanıcı adı veya şifre hatalı";
                header('refresh:3;url="index.php"');
            }
        }
        ?>
    </div>
</body>

</html>