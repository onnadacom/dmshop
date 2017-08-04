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

// 발송이 아니라면
if ($dmshop_order['order_delivery'] != '2') {

    message("<p class='title'>알림</p><p class='text'>배송중인 상품이 아닙니다.</p>", "b");

}

// 상품수령
if ($dmshop_order['order_receive']) {

    message("<p class='title'>알림</p><p class='text'>이미 상품수령을 하셨습니다.</p>", "b");

}

// 취소, 교환, 환불
if ($dmshop_order['order_cancel'] || $dmshop_order['order_exchange'] || $dmshop_order['order_refund']) {

    message("<p class='title'>알림</p><p class='text'>주문취소 상품은 상품수령을 하실 수 없습니다.</p>", "b");

}

// 상품수령
sql_query(" update $shop[order_table] set order_type = '202', order_receive = '1', order_receive_datetime = '".$shop['time_ymdhis']."' where order_code = '".$order_code."' ");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

message("<p class='title'>알림</p><p class='text'>상품수령 버튼을 클릭해 주셔서 감사 합니다. 교환신청 및 환불신청은 수령일로 부터 {$dmshop['order_exchange_day']}일 이내 접수하실 수 있습니다.</p>", "", $urlencode);
?>