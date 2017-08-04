<?php
set_time_limit(0);
include_once ("../shop.config.php");

// 이미 생성
if (file_exists("../shop.database.php")) {

    echo "<script type='text/javascript'>location.replace('not.php');</script>";
    exit;

}

$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0

$mysql_host = addslashes($_POST['mysql_host']);
$mysql_user = addslashes($_POST['mysql_user']);
$mysql_password = addslashes($_POST['mysql_password']);
$mysql_db = addslashes($_POST['mysql_db']);
$user_id = addslashes($_POST['user_id']);
$user_pw = addslashes($_POST['user_pw']);

if (strtolower($shop['charset']) == 'utf-8') @mysql_query("set names utf8"); 
$mysql_connect = @mysql_connect($mysql_host, $mysql_user, $mysql_password);
if (!$mysql_connect) {

    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
    echo "<script type='text/javascript'>alert('데이터베이스 정보를 확인하여주시기 바랍니다.'); history.go(-1);</script>";
    exit;

}

if (strtolower($shop['charset']) == 'utf-8') @mysql_query("set names utf8"); 
$mysql_select_db = @mysql_select_db($mysql_db, $mysql_connect);
if (!$mysql_select_db) {

    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
    echo "<script type='text/javascript'>alert('데이터베이스 정보를 확인하여주시기 바랍니다.'); history.go(-1);</script>";
    exit;

}

// 테이블 생성
$file = implode("", file("update.sql"));
preg_match_all("/CREATE TABLE(.*)\;[\r\n]/Uis", $file, $matches);
for ($i=0; $i<count($matches[1]); $i++) {

    $sql = "CREATE TABLE ".$matches[1][$i].";";
    mysql_query($sql) or die(mysql_error());

}

// 데이터 생성
$file = implode("", file("update2.sql"));
preg_match_all("/INSERT INTO(.*)\)\;[\r\n]/Uis", $file, $matches);
for ($i=0; $i<count($matches[1]); $i++) {

    $sql = "INSERT INTO".$matches[1][$i].");";
    mysql_query($sql) or die(mysql_error());

}

// 관리자 정보 변경
@mysql_query(" update $shop[user_table] set user_pw = PASSWORD('$user_pw'), user_login = '".$shop['time_ymdhis']."', user_login_ip = '".$_SERVER['REMOTE_ADDR']."', user_ip = '".$_SERVER['REMOTE_ADDR']."', datetime = '".$shop['time_ymdhis']."' where user_id = '$user_id' ");

// 현재 버전 설정
$shop['version'] = "DM SHOP Ver. 0.99.56";
$shop['version_code'] = "56";
$shop['version_date'] = "2017-02-15";

// update
@mysql_query(" update $shop[config_table] set version = '".$shop['version']."', version_code = '".$shop['version_code']."', version_date = '".$shop['version_date']."' ");

// db 설정파일 생성
$text ='<?php
$mysql_host = "'.$mysql_host.'";
$mysql_user = "'.$mysql_user.'";
$mysql_password = "'.$mysql_password.'";
$mysql_db = "'.$mysql_db.'";
?>';

$file = "../shop.database.php";
$f = @fopen($file, "w");
@fwrite($f, $text);
@fclose($f);
@chmod($file, 0606);

echo "<script type='text/javascript'>location.replace('ok.php');</script>";
exit;
?>