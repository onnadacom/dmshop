<?
include_once("./_dmshop.php");
if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }

// 로그인
if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "b");

}

$dmshop_order = shop_order($order_code);

// 주문 내역이 없다.
if (!$dmshop_order['id']) {

    message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "b");

}

// 주문자가 다르다.
if ($dmshop_user['user_id'] != $dmshop_order['user_id'] && !$shop_user_admin) {

    message("<p class='title'>알림</p><p class='text'>주문내역이 존재하지 않습니다.</p>", "b");

}

// 상품수령이 아니라면
if (!$dmshop_order['order_receive']) {

    message("<p class='title'>알림</p><p class='text'>상품수령 후 이용하세요.</p>", "b");

}

// 취소, 환불
if ($dmshop_order['order_cancel'] || $dmshop_order['order_refund']) {

    message("<p class='title'>알림</p><p class='text'>취소, 환불신청 된 주문은 이용하실 수 없습니다.</p>", "b");

}

// 구매 확정하였다
if ($dmshop_order['order_ok']) {

    message("<p class='title'>알림</p><p class='text'>이미 구매확정한 주문입니다.</p>", "b");

}

// 구매확정
shop_order_ok($order_code, 1);

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

message("<p class='title'>알림</p><p class='text'>구매를 완료하였습니다.</p>", "", $urlencode);
?>