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
$sql_common .= " set sms_type = '".addslashes($_POST['sms_type'])."' ";
$sql_common .= ", icode_id = 'dm_".addslashes($_POST['icode_id'])."' ";
$sql_common .= ", icode_pw = '".addslashes($_POST['icode_pw'])."' ";
$sql_common .= ", sms1 = '".addslashes($_POST['sms1'])."' ";
$sql_common .= ", sms2 = '".addslashes($_POST['sms2'])."' ";
$sql_common .= ", sms3 = '".addslashes($_POST['sms3'])."' ";
$sql_common .= ", rec_sms1 = '".addslashes($_POST['rec_sms1'])."' ";
$sql_common .= ", rec_sms2 = '".addslashes($_POST['rec_sms2'])."' ";
$sql_common .= ", rec_sms3 = '".addslashes($_POST['rec_sms3'])."' ";

// update
sql_query(" update $shop[config_table] $sql_common ");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>