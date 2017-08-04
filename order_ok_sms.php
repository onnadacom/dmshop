<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }
if ($sms_hp1) { $sms_hp1 = preg_match("/^[0-9\-]+$/", $sms_hp1) ? $sms_hp1 : ""; }
if ($sms_hp2) { $sms_hp2 = preg_match("/^[0-9\-]+$/", $sms_hp2) ? $sms_hp2 : ""; }

// 주문번호가 없다
if (!$order_code) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", $shop['path']);

}

// 주문 세션확인
$ss_name = "order_".$order_code;

if (!shop_get_session($ss_name)) {

    message("<p class='title'>알림</p><p class='text'>만료된 페이지입니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", $shop['path']);

}

if (!$sms_message) {

    message("<p class='title'>알림</p><p class='text'>메세지내용을 입력하세요.</p>", "", "", false, true);

}

if (!$sms_hp1) {

    message("<p class='title'>알림</p><p class='text'>수신번호를 입력하세요.</p>", "", "", false, true);

}

if (!$sms_hp2) {

    message("<p class='title'>알림</p><p class='text'>발신번호를 입력하세요.</p>", "", "", false, true);

}

// 주문 데이터
$dmshop_order = shop_order($order_code);

// sms 1
$shop_sms_config = shop_sms_config("order_bank_self");

// 사용
if ($shop_sms_config['sms_use']) {

    // 전송
    shop_sms_send("order_bank_self", "", $sms_hp1, $sms_hp2, $sms_message);

} else {

    message("<p class='title'>알림</p><p class='text'>사용하지 않는 서비스입니다.</p>", "", "", false, true);

}

message("<p class='title'>알림</p><p class='text'>발송하였습니다.</p>", "", "", false, true);
?>