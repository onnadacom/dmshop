<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 취소승인 (개별)
if ($m == 'ok') {

    shop_order_cancel("ok", addslashes($_POST['order_code']));

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}

// 취소승인 (선택)
else if ($m == 'check_ok') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        shop_order_cancel("ok", addslashes($_POST['order_code'][$k]));

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}

// 취소거절 (개별)
else if ($m == 'cancel') {

    shop_order_cancel("cancel", addslashes($_POST['order_code']));

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}

// 취소거절 (선택)
else if ($m == 'check_cancel') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        shop_order_cancel("cancel", addslashes($_POST['order_code'][$k]));

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}

// 내역삭제 (선택)
else if ($m == 'check_delete') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        shop_order_cancel("delete", addslashes($_POST['order_code'][$k]));

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