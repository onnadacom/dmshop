<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// insert
if ($m == '') {

    // 결제번호
    $chk = shop_payment_code(addslashes($_POST['pay_code']));

    if ($chk['id']) {

        alert("이미 중복된 결제번호가 있습니다.\\n\\n다시 시도하여 주시기 바랍니다.");

    }

    // 동일 주문번호 체크
    $chk = shop_order(addslashes($_POST['pay_code']));

    if ($chk['id']) {

        alert("이미 중복된 결제번호가 있습니다.\\n\\n다시 시도하여 주시기 바랍니다.");

    }

    $sql_common = "";
    $sql_common .= " set pay_code = '".addslashes($_POST['pay_code'])."' ";
    $sql_common .= ", pay_payment = '100' ";
    $sql_common .= ", user_id = '".addslashes($_POST['user_id'])."' ";
    $sql_common .= ", user_name = '".addslashes($_POST['user_name'])."' ";
    $sql_common .= ", user_zip1 = '".addslashes($_POST['user_zip1'])."' ";
    $sql_common .= ", user_zip2 = '".addslashes($_POST['user_zip2'])."' ";
    $sql_common .= ", user_addr1 = '".addslashes($_POST['user_addr1'])."' ";
    $sql_common .= ", user_addr2 = '".addslashes($_POST['user_addr2'])."' ";
    $sql_common .= ", user_hp = '".addslashes($_POST['user_hp1'])."-".addslashes($_POST['user_hp2'])."-".addslashes($_POST['user_hp3'])."' ";
    $sql_common .= ", user_tel = '".addslashes($_POST['user_tel1'])."-".addslashes($_POST['user_tel2'])."-".addslashes($_POST['user_tel3'])."' ";
    $sql_common .= ", user_email = '".addslashes($_POST['user_email'])."' ";
    $sql_common .= ", pay_money = '".str_replace(",", "", addslashes($_POST['pay_money']))."' ";
    $sql_common .= ", pay_type = '".addslashes($_POST['pay_type'])."' ";
    $sql_common .= ", pay_title = '".addslashes($_POST['pay_title'])."' ";
    $sql_common .= ", pay_memo = '".addslashes($_POST['pay_memo'])."' ";
    $sql_common .= ", pay_datetime = '".$shop['time_ymdhis']."' ";

    // 무통장
    if ($_POST['pay_type'] == '5') {

        // 설정의 계좌정보 저장
        $sql_common .= ", pay_bank_name = '".addslashes($dmshop['bank_name'])."' ";
        $sql_common .= ", pay_bank_number = '".addslashes($dmshop['bank_number'])."' ";
        $sql_common .= ", pay_bank_holder = '".addslashes($dmshop['bank_holder'])."' ";

    }

    // 등록
    sql_query(" insert into $shop[payment_table] $sql_common ");

}

// update
else if ($m == 'u') {

    $sql_common = "";
    $sql_common .= " set pay_memo = '".addslashes($_POST['pay_memo'])."' ";

    // 수정
    sql_query(" update $shop[payment_table] $sql_common where id = '".addslashes($_POST['pay_id'])."' ");

}

// bank_ok
else if ($m == 'bank_ok') {

    $sql_common = "";
    $sql_common .= " set pay_payment = '101' ";
    $sql_common .= ", pay_ok_datetime = '".$shop['time_ymdhis']."' ";

    // 수정
    sql_query(" update $shop[payment_table] $sql_common where id = '".addslashes($_POST['pay_id'])."' ");

}

// bank_cancel
else if ($m == 'bank_cancel') {

    $sql_common = "";
    $sql_common .= " set pay_payment = '100' ";
    $sql_common .= ", pay_ok_datetime = '0000-00-00 00:00:00' ";

    // 수정
    sql_query(" update $shop[payment_table] $sql_common where id = '".addslashes($_POST['pay_id'])."' ");

}

// cancel
else if ($m == 'cancel') {

    $sql_common = "";
    $sql_common .= " set pay_payment = '301' ";

    // 수정
    sql_query(" update $shop[payment_table] $sql_common where id = '".addslashes($_POST['pay_id'])."' ");

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 신규 등록
if ($m == '') {

    shop_url("./payment_list.php");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>