<?
include_once("./_dmshop.php");

if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }
if ($item_code) { $item_code = preg_match("/^[a-zA-Z0-9_\-]+$/", $item_code) ? $item_code : ""; }
if ($email) { $email = preg_match("/^[A-Za-z0-9_@\-\.]+$/", $email) ? $email : ""; }

// 설정
$dmshop_design_item = shop_design_item();

if (!$dmshop_design_item['sns_use5']) {

    message("<p class='title'>알림</p><p class='text'>사용하지 않는 서비스입니다.</p>", "c");

}

$name = "";
$email1 = "";
$email2 = "";
$title = "";
$content = "";

if ($user_id) {

    $user = shop_user($user_id);

    if (!$user['user_email']) {

        message("<p class='title'>알림</p><p class='text'>존재하지 않는 회원이거나 이메일주소가 없습니다.</p>", "c");

    }

    $email2 = $user['user_email'];

}

if ($item_code) {

    // 상품
    $dmshop_item = shop_item_code($item_code);

    // 상품이 없다.
    if (!$dmshop_item['id']) {

        message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "c");

    }

    $title = $dmshop['shop_name']." - ".$dmshop_item['item_title'];
    $content = $dmshop['shop_name']." - ".$dmshop_item['item_title']."\n".number_format($dmshop_item['item_money'])." 원\n".$shop['url']."/item.php?id=".$item_code;

}

if ($email) {

    $email2 = $email;

}

// 스킨이 없다.
if (!$dmshop_skin['skin_email']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "c");

}

// 스킨 경로
$dmshop_email_path = "";
$dmshop_email_path = $shop['path']."/skin/email/".$dmshop_skin['skin_email'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 이메일 전송";

// 페이지 아이디
$page_id = "email";

include_once("./shop.top.php");
include_once("$dmshop_email_path/email.php");
include_once("./shop.bottom.php");
?>