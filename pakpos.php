<?php
/* -- Banner start here -- */
/******************************************************
* PakPos by ./MyHeartIsYr
* Presented to MZ
*******************************************************/
/* -- Banner end here -- */

function pakposHeader(){
?>
<html>
<head>
<title>PakPos</title>
<style type="text/css">
body {
	background: #000;
	color: #00ff00;
	font-family: Courier;
}
h1 {
	font-family: Monotype Corsiva;
	text-align: center;
}
table {
	border: 1px solid #000;
}
li {
	display: inline;
	padding: 5px;
	margin: 5px;
}
tr {
	background: #111111;
}
.tabel {
	background: #333333;
}
a {
	color: #dd0000;
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
input {
	border: 1px solid #fff;
	background: transparent;
	color: white;
	width: 350px;
}
textarea {
	border: 1px solid #fff;
	background: transparent;
	color: white;
	resize: none;
}
pre {
	font-family: Courier;
	color: #fff;
}
</style>
</head>
<body>
<h1>PakPos</h1>
<hr>
<center>
<ul>
<li>[<a href="?option=biasa">Kirim email biasa</a>]</li>
<li>[<a href="?option=massal">Kirim email massal</a>]</li>
<li>[<a href="?option=about">About</a>]</li>
<li>[<a href="?option=help">Help</a>]</li>
</ul>
</center>
<hr>
<?php
}

function pakposFooter(){
?>
<hr>
<center>&copy; Copyleft ./MyHeartIsYr <?=date('Y')?></center>
</body>
</html>
<?php
}

if(isset($_GET['option']) && $_GET['option'] == "biasa"){
	pakposHeader();
	echo "<table width=\"800\" border='0' cellpadding='0' cellspacing='1' align='center'>
	<tr class='tabel'><td><center>Kirim Email (Biasa)</center></td></tr>
	</table>
	<form method='post'>
	<table width=\"800\" border='0' cellpadding='0' cellspacing='1' align='center'>
	<tr><td>Nama</td><td><input type='text' name='nama'></td></tr>
	<tr><td>Email</td><td><input type='text' name='email'></td></tr>
	<tr><td>Subjek</td><td><input type='text name='sub'></td></tr>
	<tr><td>Pesan</td><td><textarea name='msg' cols='80' rows='20'></textarea></td></tr>
	<tr><td>Target</td><td><input type='text' name='target'></td></tr>
	<tr><td></td><td><input style='width: 100px;' type='submit' name='kirim' value='Kirim'></td></tr>
	</form></table>";
	if(isset($_POST['kirim'])){
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$sub = $_POST['sub'];
		$msg = nl2br($_POST['msg']);
		$target = $_POST['target'];
		
		$header = "Content type:text/html charset=iso-8859-1" . "\r\n";
		$header .= "MIME Version: 1.0" . "\r\n";
		$header .= "From: $nama <$email>" . "\r\n";
		$header .= "To: $target" . "\r\n";
		
		$deliver = @mail($target, $sub, $msg, $header);
		if($deliver){
			$status = "<pre>[!] Berhasil</pre>";
		}
		else {
			$status = "<pre>[!] Gagal</pre>";
		}
		echo $status;
	}
	pakposFooter();
}
elseif(isset($_GET['option']) && $_GET['option'] == "massal"){
	pakposHeader();
	echo "<table width=\"800\" border='0' cellpadding='0' cellspacing='1' align='center'>
	<tr class='tabel'><td><center>Kirim Email (Massal)</center></td></tr>
	</table>
	<form method='post'>
	<table width=\"800\" border='0' cellpadding='0' cellspacing='1' align='center'>
	<tr><td>Nama</td><td><input type='text' name='nama'></td></tr>
	<tr><td>Email</td><td><input type='text' name='email'></td></tr>
	<tr><td>Subjek</td><td><input type='text name='sub'></td></tr>
	<tr><td>Pesan</td><td><textarea name='message' cols='80' rows='20'></textarea></td></tr>
	<tr><td>Target</td><td><input type='text' name='daftar_target'></td></tr>
	<tr><td></td><td><input style='width: 100px;' type='submit' name='kirim' value='Kirim'></td></tr>
	</form></table>";
	if(isset($_POST['kirim'])){
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$sub = $_POST['sub'];
		$message = nl2br($_POST['message']);
		$daftar_target = $_POST['daftar_target'];
		
		$header = "Content type:text/html charset=iso-8859-1" . "\r\n";
		$header .= "MIME Version: 1.0" . "\r\n";
		$header .= "From: $nama <$email>" . "\r\n";
		$header .= "To: $target" . "\r\n";
		if(file_exists($daftar_target)){
			$buka = @fopen($daftar_target, "r");
			while(!feof($buka)){
				$buff = fgets($buka, 4096);
				if($buff != "" and $buff != "\n"){
					$status = "[*] Sending to $buff<br>";
					$send = @mail($buff, $sub, $message, $header);
					if($send == false){
						$status .= "[!] Gagal<br>";
					}
					else {
						$status .= "[!] Berhasil<br>";
					}
				}
			}
			fclose($buka);
			echo $status;
		}
		else {
			echo "[!] File tidak ada, buat dulu dong :\\";
		}
	}
	pakposFooter();
}
elseif(isset($_GET['option']) && $_GET['option'] == "about"){
	pakposHeader();
	echo "<table width=\"800\" border='0' cellpadding='0' cellspacing='1' align='center'>
	<tr class='tabel'><td><center>About Me</center></td></tr>
	<tr><td>Saya cuma anak smp kelas 9 yang beberapa bulan lagi akan lulus (semoga saja)</td></tr>
	</table>";
	pakposFooter();
}
elseif(isset($_GET['option']) && $_GET['option'] == "help"){
	pakposHeader();
	echo "<table width=\"800\" border='0' cellpadding='0' cellspacing='1' align='center'>
	<tr class='tabel'><td><center>Help</center></td></tr>
	<tr><td>Bingung ya? Tenang saya bantuin kok :D</td></tr>
	<tr><td><center>Kirim Email Biasa</center></td></tr>
	<tr><td>Cara pakenya: pakpos.php?option=biasa<br>
	Yang ini isikan aja kaya biasa, tau kan :D</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><center>Kirim Email Massal</center></td></tr>
	<tr><td>Cara pakenya: pakpos.php?option=massal<br>
	Yang ini agak beda, buat file teks biasa dan isikan dengan daftar email yang mau<br>
	dikirimin email. Namanya bebas</td></tr>
	</table>";
}
else {
	die("<font face='Courier New'>[!] Use: pakpos.php?option=help</font>");
}
?>