<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 입금확인
if ($m == 'check_ok') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        shop_order_bank("ok", addslashes($_POST['order_code'][$k]), addslashes($_POST['order_dep_name_real'][$k]), addslashes($_POST['order_dep_money_real'][$k]), addslashes($_POST['order_pay_datetime'][$k]), addslashes($_POST['order_pay_smstype1'][$k]), addslashes($_POST['order_pay_smstype2'][$k]));

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}

// 입금수정
else if ($m == 'check_update') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        shop_order_bank("update", addslashes($_POST['order_code'][$k]), addslashes($_POST['order_dep_name_real'][$k]), addslashes($_POST['order_dep_money_real'][$k]), addslashes($_POST['order_pay_datetime'][$k]), addslashes($_POST['order_pay_smstype1'][$k]), addslashes($_POST['order_pay_smstype2'][$k]));

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}

// 입금취소
else if ($m == 'check_cancel') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        shop_order_bank("cancel", addslashes($_POST['order_code'][$k]), addslashes($_POST['order_dep_name_real'][$k]), addslashes($_POST['order_dep_money_real'][$k]), addslashes($_POST['order_pay_datetime'][$k]), addslashes($_POST['order_pay_smstype1'][$k]), addslashes($_POST['order_pay_smstype2'][$k]));

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