<?php
$dbuser = "root";
$dbpass = "";
$dsn = "mysql:host=localhost;dbname=forumdb";
try {
    $db = new PDO($dsn, $dbuser, $dbpass);
} catch (PDOException $e) {
    echo "Veritabanına Bağlantıda hata oluştu.Hata= ", $e;
}
?>