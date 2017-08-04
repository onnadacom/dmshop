<?
include_once("./_dmshop.php");

// 로그인
if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "b");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_help']) {

    message("<p class='title'>알림</p><p class='text'>1:1 문의/상담 스킨이 설정되지 않았습니다.</p>", "b");

}

// 스킨 경로
$dmshop_help_path = "";
$dmshop_help_path = $shop['path']."/skin/help/".$dmshop_skin['skin_help'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 1:1 문의/상담";

// 페이지 아이디
$page_id = "help";

// 이메일
if ($dmshop_user['user_email']) {

    $user_email = $dmshop_user['user_email'];
    $user_email1 = shop_split("@", $dmshop_user['user_email'], "0");
    $user_email2 = shop_split("@", $dmshop_user['user_email'], "1");

}

// 휴대폰
if ($dmshop_user['user_hp']) {

    $user_hp = $dmshop_user['user_hp'];
    $user_hp1 = shop_split("-", $dmshop_user['user_hp'], "0");
    $user_hp2 = shop_split("-", $dmshop_user['user_hp'], "1");
    $user_hp3 = shop_split("-", $dmshop_user['user_hp'], "2");

}

include_once("./shop.top.php");
include_once("$dmshop_help_path/help.php");
include_once("./shop.bottom.php");
?>