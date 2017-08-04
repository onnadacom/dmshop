<?php
include_once("./_dmshop.php");
if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// update
if ($m == 'u') {

    if (!$coupon_id) {

        alert(" 쿠폰이 삭제되었거나 존재하지 않습니다.");

    }

    $dmshop_coupon = shop_coupon($coupon_id);

    if (!$dmshop_coupon['id']) {

        alert("쿠폰이 삭제되었거나 존재하지 않습니다.");

    }

    // set
    $sql_common = "";
    $sql_common .= " set coupon_auto = '".addslashes($_POST['coupon_auto'])."' ";
    $sql_common .= ", coupon_order_money = '".addslashes($_POST['coupon_order_money'])."' ";

    // 수정
    sql_query(" update $shop[coupon_table] $sql_common where id = '".$coupon_id."' ");

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

echo "<script type='text/javascript'>opener.location.reload();</script>";

shop_url($urlencode);
?>