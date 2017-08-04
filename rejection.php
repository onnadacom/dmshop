<?
$page_id = "block";
include_once("./_dmshop.php");
include_once("$shop[path]/shop.top.php");
$ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));

echo $ip." 아이피는 차단되었습니다.";
?>

<?
include_once("$shop[path]/shop.bottom.php");
?>