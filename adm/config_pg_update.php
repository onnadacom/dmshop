<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// common
$sql_common = "";
$sql_common .= " set order_pg = '".addslashes($_POST['order_pg'])."' ";
$sql_common .= ", kcp_site_code = 'DM".trim(addslashes($_POST['kcp_site_code']))."' ";
$sql_common .= ", kcp_site_key = '".trim(addslashes($_POST['kcp_site_key']))."' ";
$sql_common .= ", kcp_site_name = '".trim(addslashes($_POST['kcp_site_name']))."' ";
$sql_common .= ", kcp_site_logo = '".trim(addslashes($_POST['kcp_site_logo']))."' ";
$sql_common .= ", kicc_site_code = 'DM".trim(addslashes($_POST['kicc_site_code']))."' ";
$sql_common .= ", kicc_site_key = '".trim(addslashes($_POST['kicc_site_key']))."' ";
$sql_common .= ", kicc_site_name = '".trim(addslashes($_POST['kicc_site_name']))."' ";
$sql_common .= ", kicc_site_logo = '".trim(addslashes($_POST['kicc_site_logo']))."' ";
$sql_common .= ", payment_type1 = '".addslashes($_POST['payment_type1'])."' ";
$sql_common .= ", payment_type2 = '".addslashes($_POST['payment_type2'])."' ";
$sql_common .= ", payment_type3 = '".addslashes($_POST['payment_type3'])."' ";
$sql_common .= ", payment_type4 = '".addslashes($_POST['payment_type4'])."' ";
$sql_common .= ", payment_type5 = '".addslashes($_POST['payment_type5'])."' ";
$sql_common .= ", bank_name = '".addslashes($_POST['bank_name'])."' ";
$sql_common .= ", bank_number = '".addslashes($_POST['bank_number'])."' ";
$sql_common .= ", bank_holder = '".addslashes($_POST['bank_holder'])."' ";
$sql_common .= ", order_bank_day = '".addslashes($_POST['order_bank_day'])."' ";
$sql_common .= ", order_escrow_use = '".addslashes($_POST['order_escrow_use'])."' ";
$sql_common .= ", order_escrow_money = '".addslashes($_POST['order_escrow_money'])."' ";
$sql_common .= ", order_pgbank_day = '".addslashes($_POST['order_pgbank_day'])."' ";
$sql_common .= ", order_card_percent = '".addslashes($_POST['order_card_percent'])."' ";
$sql_common .= ", order_mobile_percent = '".addslashes($_POST['order_mobile_percent'])."' ";

// update
sql_query(" update $shop[config_table] $sql_common ");

// 없다면
if (!$dmshop['kcp_site_file']) {

    // 새로운 파일
    $newname = substr(md5(date("ymdhis", $shop['server_time']).rand(1000,9999)),0,10);

    // 파일 변경
    @rename("{$shop['path']}/pay/kcp/bank.php", "{$shop['path']}/pay/kcp/kcp_".$newname."_bank.php");

    // update
    sql_query(" update $shop[config_table] set kcp_site_file = '".$newname."' ");

}

// 없다면
if (!$dmshop['kicc_site_file']) {

    // 새로운 파일
    $newname = substr(md5(date("ymdhis", $shop['server_time']).rand(1000,9999)),0,10);

    // 파일 변경
    @rename("{$shop['path']}/pay/kicc/bank.php", "{$shop['path']}/pay/kicc/kicc_".$newname."_bank.php");

    // update
    sql_query(" update $shop[config_table] set kicc_site_file = '".$newname."' ");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>