<?
include_once("./_dmshop.php");
if ($pay_code) { $pay_code = preg_match("/^[a-zA-Z0-9]+$/", $pay_code) ? $pay_code : ""; }

// 로그인
if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_payment']) {

    message("<p class='title'>알림</p><p class='text'>개별결제창 스킨이 설정되지 않았습니다.</p>", "c");

}

if (!$pay_code) {

    message("<p class='title'>알림</p><p class='text'>발급내역이 삭제되었거나 존재하지 않습니다.</p>", "c");

}

$dmshop_payment = shop_payment_code($pay_code);

if (!$dmshop_payment['id']) {

    message("<p class='title'>알림</p><p class='text'>발급내역이 삭제되었거나 존재하지 않습니다.</p>", "c");

}

// 주문자가 다르다.
if ($dmshop_user['user_id'] != $dmshop_payment['user_id'] && !$shop_user_admin) {

    message("<p class='title'>알림</p><p class='text'>발급내역이 존재하지 않습니다.</p>", "c");

}

// 스킨 경로
$dmshop_payment_path = "";
$dmshop_payment_path = $shop['path']."/skin/payment/".$dmshop_skin['skin_payment'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 상세결제내역";

// 페이지 아이디
$page_id = "payment_view";

include_once("./shop.top.php");
include_once("$dmshop_payment_path/payment_view.php");
include_once("./shop.bottom.php");
?>