<?
include_once("./_dmshop.php");

// 세션해제
session_unset();
session_destroy();

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = $shop['url'];

}

shop_url($urlencode);
?>