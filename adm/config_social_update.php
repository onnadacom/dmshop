<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

$login_naver_id = trim(strip_tags(mysql_real_escape_string($_POST['login_naver_id'])));
$login_naver_secret = trim(strip_tags(mysql_real_escape_string($_POST['login_naver_secret'])));
$login_kakao_key = trim(strip_tags(mysql_real_escape_string($_POST['login_kakao_key'])));
$login_facebook_id = trim(strip_tags(mysql_real_escape_string($_POST['login_facebook_id'])));
$login_facebook_secret = trim(strip_tags(mysql_real_escape_string($_POST['login_facebook_secret'])));
$login_twitter_key = trim(strip_tags(mysql_real_escape_string($_POST['login_twitter_key'])));
$login_twitter_secret = trim(strip_tags(mysql_real_escape_string($_POST['login_twitter_secret'])));
$login_google_id = trim(strip_tags(mysql_real_escape_string($_POST['login_google_id'])));
$login_google_secret = trim(strip_tags(mysql_real_escape_string($_POST['login_google_secret'])));

// common
$sql_common = "";
$sql_common .= "set login_naver_id = '".$login_naver_id."' ";
$sql_common .= ", login_naver_secret = '".$login_naver_secret."' ";
$sql_common .= ", login_kakao_key = '".$login_kakao_key."' ";
$sql_common .= ", login_facebook_id = '".$login_facebook_id."' ";
$sql_common .= ", login_facebook_secret = '".$login_facebook_secret."' ";
$sql_common .= ", login_twitter_key = '".$login_twitter_key."' ";
$sql_common .= ", login_twitter_secret = '".$login_twitter_secret."' ";
$sql_common .= ", login_google_id = '".$login_google_id."' ";
$sql_common .= ", login_google_secret = '".$login_google_secret."' ";

// update
sql_query(" update $shop[config_table] $sql_common ");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

url($urlencode);
?>