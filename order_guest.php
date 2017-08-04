<?
include_once("./_dmshop.php");

// 로그인
if ($shop_user_login) {

    shop_url("$shop[path]");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_order_guest']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "b");

}

// 스킨 경로
$dmshop_order_guest_path = "";
$dmshop_order_guest_path = $shop['path']."/skin/order_guest/".$dmshop_skin['skin_order_guest'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 비회원 주문조회";

// 페이지 아이디
$page_id = "order_guest";

include_once("./_top.php");
include_once("$dmshop_order_guest_path/order_guest.php");
include_once("./_bottom.php");
?>