<?php session_start(); ?>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>KodDestek.com</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="style.css">

</head>

<body>
	<?php
	include("sqlconnect.php");
	?>
	<div id="top">
		<div id="logodiv">
			<a href="index.php" id="logodivlink"><img src="assets/logo.png" style="height: 70px;"></a>
		</div>
		<div id="search-box">
			
			<form class="arama" action="search.php" method="GET" style="margin:auto;max-width:300px">
  			<input type="text" placeholder="Başlık ara" name="search" id="search">
  			<button type="submit"><i class="fa fa-search"></i></button>
			</form>


		</div>
		<?php

		if (isset($_SESSION["user"])) { ?>

			<div style="margin-right: 10px; margin-top:10px">
				<a href='title.php'><span class="plusbtn"><img src="assets/plus.png" style="width: 50px;height: 50px;vertical-align:middle;" /> Konu Oluştur</span></a><br>
				<a href='logout.php'><span class="plusbtn"><img src="assets/logout.png" style="padding-left:5px;width: 50px;height: 50px;vertical-align:middle;" /> Çıkış Yap</span></a>
			</div>
		<?php
		} else { ?>
			<div id="login-box">
				<form method="post" action="login.php">
					<table>
						<tr>
							<td><label for="user">Kullanıcı Adı:</label></td>
							<td><input name="user" type="text" class="login-tb" required></td>
						</tr>
						<tr>
							<td><label for="pass">Şifre:</label></td>
							<td><input name="pass" type="text" class="login-tb" required></td>
						</tr>
						<tr>
							<td><a href="register.php" class="memberlink">Üye Ol</a></td>
							<td><input type="submit" value="Giriş Yap" style="width: 100%"></td>
						</tr>
					</table>
				</form>
			</div>
		<?php } ?>

	</div>
	<div id="content">
		<div id="left">
			<div class="titles">
				<?php
				if ($users = $db->query('SELECT title FROM tbl_titles')) {
					foreach ($db->query('SELECT * FROM tbl_titles ORDER BY id DESC limit 21') as $row) {
						echo '<div class="title"><a href="index.php?title=', $row['id'], '" class="leftlink">', $row['title'], '</div></a>'; //yapıldı
					}
				} else {
					echo 'Sorguda bir hata meydana geldi.';
					$error = $db->errorInfo();
					echo 'Hata mesajı: ' . $error[2];
				}
				?>
			</div>
		</div>
	</div>
	<div id="right">
		<div id="article-body">
			<?php
			//sayfalama
			if (isset($_GET['title'])) {
				$titleid = $_GET['title'];
				$Sayfa = @intval($_GET['sayfa']);
				if (!$Sayfa) $Sayfa = 1;
				$Say = $db->query("select * from tbl_topic where titleid=" . $titleid . " order by id DESC");
				$ToplamVeri = $Say->rowCount();
				$Limit = 5;
				$Sayfa_Sayisi = ceil($ToplamVeri / $Limit);
				if ($Sayfa > $Sayfa_Sayisi) {
					$Sayfa = 1;
				}
				$Goster = $Sayfa * $Limit - $Limit;
				$GorunenSayfa = 5;
				//başlık
				$baslik = $db->query("SELECT * FROM tbl_titles WHERE id='$titleid'")->fetch(PDO::FETCH_ASSOC);
				echo "<div style='height: 3rem;margin:1em'><h1 style='display:inline'>", $baslik['title'], "</h1>";
				//cevap yaz
				if (isset($_SESSION["user"])) {
				?>

					<a href='topic.php?konu=<?php echo $titleid ?>'><span class="plusbtn"><img src="assets/plus.png" style="width: 50px;height: 50px;vertical-align:middle;" /> Cevap yaz</span></a>
				</div>

					<?php }


				//mesajlar
				if ($posts = $db->query('SELECT * FROM tbl_topic')) {
					foreach ($db->query("SELECT * FROM tbl_topic WHERE titleid='{$titleid}' limit $Goster,$Limit") as $row) {
						echo '<div class="topicdiv">', $row['topictext'], '<hr class="ciz"></hr>';
						$yaziid = $row['userId'];
						$yazarad = $db->query("SELECT * FROM tbl_user WHERE id='$yaziid'")->fetch(PDO::FETCH_ASSOC);
						echo '<div class="usersign">' . $yazarad['username'] . '</div></div>';
					}
				} else {
					echo 'Sorguda bir hata meydana geldi.';
					$error = $db->errorInfo();
					echo 'Hata mesajı: ' . $error[2];
				}
			}
			else{ ?>
				<div class="topicdiv" style="text-align:center"><span class="orang">KodDestek.com</span>'a hoşgeldiniz.<br/> 
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Koddestek ile mevcut başlıklar hakkında bilgi alabilir,
					mevcut konulara yorum yapabilir veya bilmediğiniz bir 
					konu hakkında bilgi almak için başlık oluşturabilirsiniz.
					 </p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Koddestek'i kullanmaya başlamak için tek yapman 
						gereken sağ üst kısımdan üye olmak veya giriş yapmak.</p>
					<img src="assets/a.png" style="width: 700px;">
					
					
					
					</div>
			
			<?php
			}
?>
<div id="pager">
	<?php
	if (isset($_GET['title'])) {
		for ($s = 1; $s <= $Sayfa_Sayisi; $s++) {
			if ($Sayfa == $s) { // eğer bulunduğumuz sayfa ise link yapma.
				echo $s . ' ';
			} else {
				echo '<a href="?title=' . $titleid . '&sayfa=' . $s . '">' . $s . '</a> ';
			}
		}
	}
	?>
</div>
	</div>
	</div>
	</div>
</body>
</html>