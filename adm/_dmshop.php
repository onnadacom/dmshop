<?
$shop_path = "..";
include_once("$shop_path/shop.common.php");

// 로그인
if (!$shop_user_login) {

    shop_url("$shop[path]/signin.php?url={$urlencode}");

}

// 관리자
if (!$shop_user_admin) {

    message("<p class='title'>알림</p><p class='text'>관리자로 로그인하여주세요.</p>", "b");

}

// 관리자 페이지 활성
$shop['admin_page'] = true;
?>