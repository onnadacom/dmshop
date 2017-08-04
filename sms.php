<?
include_once("./_dmshop.php");

if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }
if ($hp) { $hp = preg_match("/^[0-9\-]+$/", $hp) ? $hp : ""; }
if ($item_code) { $item_code = preg_match("/^[a-zA-Z0-9_\-]+$/", $item_code) ? $item_code : ""; }

if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

}

// 설정
$dmshop_design_item = shop_design_item();

if (!$dmshop_design_item['sns_use6']) {

    message("<p class='title'>알림</p><p class='text'>사용하지 않는 서비스입니다.</p>", "c");

}

$hp1 = "";
$hp2 = "";
$message = "";

if ($user_id) {

    $user = shop_user($user_id);

    if (!$user['user_hp']) {

        message("<p class='title'>알림</p><p class='text'>존재하지 않는 회원이거나 휴대폰 번호가 없습니다.</p>", "c");

    }

    $hp1 = $user['user_hp'];

}

if ($item_code) {

    $dmshop_item = shop_item_code($item_code);

    if (!$dmshop_item['id']) {

        message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "c");

    }

    $message = $dmshop['shop_name']." - ".$dmshop_item['item_title']."\n".$shop['url']."/item.php?id=".$item_code;

}

if ($shop_user_login) {

    if ($dmshop_user['user_hp']) {

        $hp2 = $dmshop_user['user_hp'];

    }

}

if ($hp) {

    $hp1 = $hp;

}

if (!$dmshop_skin['skin_sms']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "c");

}

// 스킨 경로
$dmshop_sms_path = "";
$dmshop_sms_path = $shop['path']."/skin/sms/".$dmshop_skin['skin_sms'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 문자전송";

// 페이지 아이디
$page_id = "sms";

include_once("./shop.top.php");
include_once("$dmshop_sms_path/sms.php");
include_once("./shop.bottom.php");
?>