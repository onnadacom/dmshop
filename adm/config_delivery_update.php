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
$sql_common .= " set parcel_id = '".addslashes($_POST['parcel_id'])."' ";
$sql_common .= ", parcel_name = '".addslashes($_POST['parcel_name'])."' ";
$sql_common .= ", parcel_url = '".addslashes($_POST['parcel_url'])."' ";
$sql_common .= ", parcel_search_url = '".addslashes($_POST['parcel_search_url'])."' ";
$sql_common .= ", parcel_tel = '".addslashes($_POST['parcel_tel'])."' ";

// update
sql_query(" update $shop[config_table] $sql_common ");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>