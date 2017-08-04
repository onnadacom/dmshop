<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 관리자 지급
$coupon_make_admin = true;

// 개별지급
if ($m == '') {

    shop_coupon_make(addslashes($_POST['coupon_id']), addslashes($_POST['user_id']), addslashes($_POST['sms_send']), false);

}

// 일괄지급
else if ($m == 'all') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        shop_coupon_make(addslashes($_POST['coupon_id']), addslashes($_POST['user_id'][$k]), addslashes($_POST['sms_send']), false);

    }

}

// 등급별 지급
else if ($m == 'level') {

    // 등급
    if ($_POST['level']) {

        $sql_search = " where user_level = '".addslashes($_POST['level'])."' ";

    } else {

        // 2부터가 회원
        $sql_search = " where user_level >= '2' ";

    }

    // 회원 데이터
    $result = sql_query(" select * from $shop[user_table] $sql_search order by id asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        if ($row['user_id']) {

            shop_coupon_make(addslashes($_POST['coupon_id']), addslashes($row['user_id']), addslashes($_POST['sms_send']), false);

        }

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

echo "<script type='text/javascript'>opener.location.reload();</script>";

//shop_url($urlencode);
alert("쿠폰 지급을 완료하였습니다.", $urlencode);
?>