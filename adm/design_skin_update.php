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
$sql_common .= " set skin_signup = '".addslashes($_POST['skin_signup'])."' ";
$sql_common .= ", skin_signin = '".addslashes($_POST['skin_signin'])."' ";
$sql_common .= ", skin_find = '".addslashes($_POST['skin_find'])."' ";
$sql_common .= ", skin_zip = '".addslashes($_POST['skin_zip'])."' ";
$sql_common .= ", skin_popup = '".addslashes($_POST['skin_popup'])."' ";
$sql_common .= ", skin_sms = '".addslashes($_POST['skin_sms'])."' ";
$sql_common .= ", skin_email = '".addslashes($_POST['skin_email'])."' ";
$sql_common .= ", skin_search = '".addslashes($_POST['skin_search'])."' ";
$sql_common .= ", skin_item_gallery = '".addslashes($_POST['skin_item_gallery'])."' ";
$sql_common .= ", skin_item_preview = '".addslashes($_POST['skin_item_preview'])."' ";
$sql_common .= ", skin_order = '".addslashes($_POST['skin_order'])."' ";
$sql_common .= ", skin_mypage = '".addslashes($_POST['skin_mypage'])."' ";
$sql_common .= ", skin_order_list = '".addslashes($_POST['skin_order_list'])."' ";
$sql_common .= ", skin_order_guest = '".addslashes($_POST['skin_order_guest'])."' ";
$sql_common .= ", skin_cash = '".addslashes($_POST['skin_cash'])."' ";
$sql_common .= ", skin_coupon = '".addslashes($_POST['skin_coupon'])."' ";
$sql_common .= ", skin_payment = '".addslashes($_POST['skin_payment'])."' ";
$sql_common .= ", skin_exchange = '".addslashes($_POST['skin_exchange'])."' ";
$sql_common .= ", skin_refund = '".addslashes($_POST['skin_refund'])."' ";
$sql_common .= ", skin_cancel = '".addslashes($_POST['skin_cancel'])."' ";
$sql_common .= ", skin_help = '".addslashes($_POST['skin_help'])."' ";
$sql_common .= ", skin_favorite = '".addslashes($_POST['skin_favorite'])."' ";
$sql_common .= ", skin_cart = '".addslashes($_POST['skin_cart'])."' ";
$sql_common .= ", skin_order_delivery = '".addslashes($_POST['skin_order_delivery'])."' ";
$sql_common .= ", skin_order_address = '".addslashes($_POST['skin_order_address'])."' ";
$sql_common .= ", skin_order_view = '".addslashes($_POST['skin_order_view'])."' ";
$sql_common .= ", skin_order_option = '".addslashes($_POST['skin_order_option'])."' ";

// update
sql_query(" update $shop[design_skin_table] $sql_common ");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>