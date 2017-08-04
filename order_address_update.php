<?
include_once("./_dmshop.php");
if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }

// 로그인
if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

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

$sql_common = "";
$sql_common .= " set order_rec_name = '".trim(strip_tags(mysql_real_escape_string($order_rec_name)))."' ";
$sql_common .= ", order_rec_zip1 = '".trim(strip_tags(mysql_real_escape_string($order_rec_zip1)))."' ";
$sql_common .= ", order_rec_zip2 = '".trim(strip_tags(mysql_real_escape_string($order_rec_zip2)))."' ";
$sql_common .= ", order_rec_addr1 = '".trim(strip_tags(mysql_real_escape_string($order_rec_addr1)))."' ";
$sql_common .= ", order_rec_addr2 = '".trim(strip_tags(mysql_real_escape_string($order_rec_addr2)))."' ";
$sql_common .= ", order_rec_hp = '".trim(strip_tags(mysql_real_escape_string($order_rec_hp1)))."-".trim(strip_tags(mysql_real_escape_string($order_rec_hp2)))."-".trim(strip_tags(mysql_real_escape_string($order_rec_hp3)))."' ";
$sql_common .= ", order_rec_tel = '".trim(strip_tags(mysql_real_escape_string($order_rec_tel1)))."-".trim(strip_tags(mysql_real_escape_string($order_rec_tel2)))."-".trim(strip_tags(mysql_real_escape_string($order_rec_tel3)))."' ";
$sql_common .= ", order_memo = '".mysql_real_escape_string($order_memo)."' ";

// 배송정보변경
sql_query(" update $shop[order_table] $sql_common where order_code = '".addslashes($order_code)."' ");

message("<p class='title'>알림</p><p class='text'>배송정보변경을 완료하였습니다.</p>", "c");
?>