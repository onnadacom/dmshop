<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 주문번호가 없다면
if (!$_POST['order_code']) {

    alert("주문내역이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 주문
$dmshop_order = shop_order(addslashes($_POST['order_code']));

if (!$dmshop_order['id']) {

    alert("주문내역이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 업데이트
$sql_common = "";
$sql_common .= " set order_receipt = '".addslashes($_POST['order_receipt'])."' ";
$sql_common .= ", order_receipt_type = '".addslashes($_POST['order_receipt_type'])."' ";
$sql_common .= ", order_receipt_name = '".addslashes($_POST['order_receipt_name'])."' ";
$sql_common .= ", order_receipt_number = '".addslashes($_POST['order_receipt_number'])."' ";
$sql_common .= ", order_pg_code3 = '".addslashes($_POST['order_pg_code3'])."' ";
$sql_common .= ", order_receipt_code = '".addslashes($_POST['order_receipt_code'])."' ";

// update
sql_query(" update $shop[order_table] $sql_common where order_code = '".addslashes($_POST['order_code'])."' ");

echo "<script type='text/javascript'>opener.location.reload();</script>";

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>