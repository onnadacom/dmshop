<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 상품발송
if ($m == 'check_ok') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        shop_order_delivery("ok", addslashes($_POST['order_code'][$k]), addslashes($_POST['order_delivery_id'][$k]), addslashes($_POST['order_delivery_tel'][$k]), addslashes($_POST['order_delivery_url'][$k]), addslashes($_POST['order_delivery_number'][$k]), addslashes($_POST['order_delivery_datetime'][$k]), addslashes($_POST['order_delivery_smstype1'][$k]), addslashes($_POST['order_delivery_smstype2'][$k]));

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}

// 상품발송 수정
else if ($m == 'check_update') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        shop_order_delivery("update", addslashes($_POST['order_code'][$k]), addslashes($_POST['order_delivery_id'][$k]), addslashes($_POST['order_delivery_tel'][$k]), addslashes($_POST['order_delivery_url'][$k]), addslashes($_POST['order_delivery_number'][$k]), addslashes($_POST['order_delivery_datetime'][$k]), addslashes($_POST['order_delivery_smstype1'][$k]), addslashes($_POST['order_delivery_smstype2'][$k]));

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}

// 상품발송 취소
else if ($m == 'check_cancel') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        shop_order_delivery("cancel", addslashes($_POST['order_code'][$k]), addslashes($_POST['order_delivery_id'][$k]), addslashes($_POST['order_delivery_tel'][$k]), addslashes($_POST['order_delivery_url'][$k]), addslashes($_POST['order_delivery_number'][$k]), addslashes($_POST['order_delivery_datetime'][$k]), addslashes($_POST['order_delivery_smstype1'][$k]), addslashes($_POST['order_delivery_smstype2'][$k]));

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

} else {

    // pass

}
?>