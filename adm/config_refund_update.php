<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// br 태그제거
if ($_POST['item_refund_text'] == '<br>' || $_POST['item_refund_text'] == '<br />') { $_POST['item_refund_text'] = ""; }

// 일괄적용
if ($_POST['item_refund_text_all']) {

    // update
    sql_query(" update $shop[item_table] set item_refund_text = '".addslashes($_POST['item_refund_text'])."' ");

}

// common
$sql_common = "";
$sql_common .= " set item_refund_text = '".addslashes($_POST['item_refund_text'])."' ";

// update
sql_query(" update $shop[config_table] $sql_common ");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>