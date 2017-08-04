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
$sql_common .= " set company_name = '".addslashes($_POST['company_name'])."' ";
$sql_common .= ", company_number1 = '".addslashes($_POST['company_number1'])."' ";
$sql_common .= ", company_number2 = '".addslashes($_POST['company_number2'])."' ";
$sql_common .= ", shop_name = '".addslashes($_POST['shop_name'])."' ";
$sql_common .= ", domain_type = '".addslashes($_POST['domain_type'])."' ";
$sql_common .= ", ssl_use = '".addslashes($_POST['ssl_use'])."' ";
$sql_common .= ", number1 = '".addslashes($_POST['number1'])."' ";
$sql_common .= ", number2 = '".addslashes($_POST['number2'])."' ";
$sql_common .= ", number3 = '".addslashes($_POST['number3'])."' ";
$sql_common .= ", fax1 = '".addslashes($_POST['fax1'])."' ";
$sql_common .= ", fax2 = '".addslashes($_POST['fax2'])."' ";
$sql_common .= ", fax3 = '".addslashes($_POST['fax3'])."' ";
$sql_common .= ", zip1 = '".addslashes($_POST['zip1'])."' ";
$sql_common .= ", zip2 = '".addslashes($_POST['zip2'])."' ";
$sql_common .= ", addr1 = '".addslashes($_POST['addr1'])."' ";
$sql_common .= ", addr2 = '".addslashes($_POST['addr2'])."' ";
$sql_common .= ", ceo_name = '".addslashes($_POST['ceo_name'])."' ";
$sql_common .= ", ceo_email = '".addslashes($_POST['ceo_email'])."' ";
$sql_common .= ", admin_name = '".addslashes($_POST['admin_name'])."' ";
$sql_common .= ", admin_email = '".addslashes($_POST['admin_email'])."' ";
$sql_common .= ", order_guest_use = '".addslashes($_POST['order_guest_use'])."' ";
$sql_common .= ", order_receive_day = '".addslashes($_POST['order_receive_day'])."' ";
$sql_common .= ", order_exchange_day = '".addslashes($_POST['order_exchange_day'])."' ";
$sql_common .= ", cart_day = '".addslashes($_POST['cart_day'])."' ";
$sql_common .= ", view_day = '".addslashes($_POST['view_day'])."' ";
$sql_common .= ", order_cash_min = '".addslashes($_POST['order_cash_min'])."' ";
$sql_common .= ", payment_type6 = '".addslashes($_POST['payment_type6'])."' ";
$sql_common .= ", delivery_money = '".addslashes($_POST['delivery_money'])."' ";
$sql_common .= ", delivery_money_free = '".addslashes($_POST['delivery_money_free'])."' ";
$sql_common .= ", domain = '".addslashes($_POST['domain'])."' ";
if ($_POST['cookie_domain']) {
$sql_common .= ", cookie_domain = '.".addslashes($_POST['cookie_domain'])."' ";
}
$sql_common .= ", reply_write_level = '".addslashes($_POST['reply_write_level'])."' ";
$sql_common .= ", qna_write_level = '".addslashes($_POST['qna_write_level'])."' ";
$sql_common .= ", serial_key = '".addslashes($_POST['serial_key'])."' ";
$sql_common .= ", agency_name = '".addslashes($_POST['agency_name'])."' ";
$sql_common .= ", agency_url = '".addslashes($_POST['agency_url'])."' ";
$sql_common .= ", agency_tel = '".addslashes($_POST['agency_tel'])."' ";
$sql_common .= ", block_ip = '".addslashes($_POST['block_ip'])."' ";
$sql_common .= ", block_keyword = '".addslashes($_POST['block_keyword'])."' ";
$sql_common .= ", mouse_event = '".addslashes($_POST['mouse_event'])."' ";
$sql_common .= ", dm_user_id = '".addslashes($_POST['dm_user_id'])."' ";
$sql_common .= ", dm_user_pw = '".addslashes($_POST['dm_user_pw'])."' ";
$sql_common .= ", zipcode = '".addslashes($_POST['zipcode'])."' ";

// update
sql_query(" update $shop[config_table] $sql_common ");

// 묶음배송으로 등록된 상품 -> 배송비 일괄 변경(단, 묶음배송 사용안함으로 등록된 것은 안 바뀜) 
sql_query(" update $shop[item_table] set item_delivery = '".addslashes($_POST['delivery_money'])."' where item_delivery_bunch = 1 "); 

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>