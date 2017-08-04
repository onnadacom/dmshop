<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

// 회원
if ($shop_user_login) {

    shop_url("$shop[path]");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_order_guest']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "", "", false, true);

}

// 스킨 경로
$dmshop_order_guest_path = "";
$dmshop_order_guest_path = $shop['path']."/skin/order_guest/".$dmshop_skin['skin_order_guest'];

if (!$order_name) {

    message("<p class='title'>알림</p><p class='text'>주문자명이 입력되지 않았습니다.</p>", "", "", false, true);

}

if (!$order_hp) {

    message("<p class='title'>알림</p><p class='text'>휴대폰 번호가 입력되지 않았습니다.</p>", "", "", false, true);

}

if (!$order_password) {

    message("<p class='title'>알림</p><p class='text'>비밀번호가 입력되지 않았습니다.</p>", "", "", false, true);

}

// 세션 지정
$ss_name = "order_guest";

// 요청시 해제
unset($_SESSION[$ss_name]);

$order = sql_fetch(" select * from $shop[order_table] where order_name = '".addslashes($order_name)."' and order_hp = '".addslashes($order_hp)."' and order_password = '".sql_password($order_password)."' ");

if ($order['id']) {

    if (!shop_get_session($ss_name)) {

        // 여러가지로 생성
        $ss_value = $shop['server_time']."_".substr(md5($order_name.$order_hp.$order_password),0,20);

        // 세션 생성
        shop_set_session($ss_name, $ss_value);

        // 여러가지로 업데이트
        sql_query(" update $shop[order_table] set order_guest_session = '".$_SESSION[$ss_name]."' where order_name = '".addslashes($order_name)."' and order_hp = '".addslashes($order_hp)."' and order_password = '".sql_password($order_password)."' ");

    }

    shop_url("./order_guest_list.php");

} else {

    echo "<div class='order_not'><div>입력하신 정보가 올바르지 않습니다. 다시 입력 하세요.</div></div>";

    echo "<script type='text/javascript'>";
    echo "document.getElementById('order_guest_message').style.display = \"inline\";";
    echo "</script>";

}
?>