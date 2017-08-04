<?
include_once("./_dmshop.php");
if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }

// 로그인
if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_order_address']) {

    message("<p class='title'>알림</p><p class='text'>배송지 변경 스킨이 설정되지 않았습니다.</p>", "c");

}

// 주문정보
$dmshop_order = shop_order($order_code);

// 주문 내역이 없다.
if (!$dmshop_order['id']) {

    message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "c");

}

// 주문자가 다르다.
if ($dmshop_user['user_id'] != $dmshop_order['user_id'] && !$shop_user_admin) {

    message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "c");

}

// 상품발송되었다면
if ($dmshop_order['order_delivery']) {

    message("<p class='title'>알림</p><p class='text'>배송지 변경은 배송준비중 이전에만 가능합니다.</p>", "c");

}

// 취소, 교환, 환불
if ($dmshop_order['order_cancel'] || $dmshop_order['order_exchange'] || $dmshop_order['order_refund']) {

    message("<p class='title'>알림</p><p class='text'>배송지 변경은 배송준비중 이전에만 가능합니다.</p>", "c");

}

// 스킨 경로
$dmshop_order_address_path = "";
$dmshop_order_address_path = $shop['path']."/skin/order_address/".$dmshop_skin['skin_order_address'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 배송지 변경";

// 페이지 아이디
$page_id = "order_address";

// 연락처 처리
$order_rec_hp1 = "";
$order_rec_hp2 = "";
$order_rec_hp3 = "";

$order_rec_tel1 = "";
$order_rec_tel2 = "";
$order_rec_tel3 = "";

if ($dmshop_order['order_rec_hp']) {

    $order_rec_hp = explode("-", trim($dmshop_order['order_rec_hp']));
    for ($i=0; $i<count($order_rec_hp); $i++) {

        if ($order_rec_hp[$i]) {

            $order_rec_hp1 = $order_rec_hp[0];
            $order_rec_hp2 = $order_rec_hp[1];
            $order_rec_hp3 = $order_rec_hp[2];

        }

    }

}

if ($dmshop_order['order_rec_tel']) {

    $order_rec_tel = explode("-", trim($dmshop_order['order_rec_tel']));
    for ($i=0; $i<count($order_rec_tel); $i++) {

        if ($order_rec_tel[$i]) {

            $order_rec_tel1 = $order_rec_tel[0];
            $order_rec_tel2 = $order_rec_tel[1];
            $order_rec_tel3 = $order_rec_tel[2];

        }

    }

}

include_once("./shop.top.php");
include_once("$dmshop_order_address_path/order_address.php");
include_once("./shop.bottom.php");
?>