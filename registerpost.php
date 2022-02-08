

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
	$ad=$_POST["name"];
	$syd=$_POST["sname"];
	$mail=$_POST["mail"];
	$uname=$_POST["username"];	
	$sifre=$_POST["pass"];
	try{
	$db->exec("INSERT INTO tbl_user (username, pass, fname, sname, mail) VALUES('$uname','$sifre','$ad','$syd','$mail')");
	}catch(PDOException $err){
		echo "hata ===",$err;
	}finally{
	echo "Üyelik İşlemi Başarılı";	
	header('Location: index.php');
	exit();
}
    ?>
    </div>
</body>

</html>
