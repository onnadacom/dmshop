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
$sql_common .= " set user_real_check = '".addslashes($_POST['user_real_check'])."' ";
$sql_common .= ", user_real_max = '".addslashes($_POST['user_real_max'])."' ";
$sql_common .= ", user_id = '".addslashes($_POST['user_id'])."' ";
$sql_common .= ", user_pw = '".addslashes($_POST['user_pw'])."' ";
$sql_common .= ", user_pw_qa = '".addslashes($_POST['user_pw_qa'])."' ";
$sql_common .= ", user_name = '".addslashes($_POST['user_name'])."' ";
$sql_common .= ", user_birth = '".addslashes($_POST['user_birth'])."' ";
$sql_common .= ", user_sex = '".addslashes($_POST['user_sex'])."' ";
$sql_common .= ", user_level = '".addslashes($_POST['user_level'])."' ";
$sql_common .= ", user_nick = '".addslashes($_POST['user_nick'])."' ";
$sql_common .= ", user_hp = '".addslashes($_POST['user_hp'])."' ";
$sql_common .= ", user_tel = '".addslashes($_POST['user_tel'])."' ";
$sql_common .= ", user_addr = '".addslashes($_POST['user_addr'])."' ";
$sql_common .= ", user_company = '".addslashes($_POST['user_company'])."' ";
$sql_common .= ", user_company_tel = '".addslashes($_POST['user_company_tel'])."' ";
$sql_common .= ", user_company_addr = '".addslashes($_POST['user_company_addr'])."' ";
$sql_common .= ", user_email = '".addslashes($_POST['user_email'])."' ";
$sql_common .= ", user_homepage = '".addslashes($_POST['user_homepage'])."' ";
$sql_common .= ", user_recommend = '".addslashes($_POST['user_recommend'])."' ";
$sql_common .= ", user_recommend_cash = '".addslashes($_POST['user_recommend_cash'])."' ";
$sql_common .= ", user_recommend_insert_cash = '".addslashes($_POST['user_recommend_insert_cash'])."' ";
$sql_common .= ", user_profile = '".addslashes($_POST['user_profile'])."' ";
$sql_common .= ", user_robot = '".addslashes($_POST['user_robot'])."' ";
$sql_common .= ", user_etc = '".addslashes($_POST['user_etc'])."' ";
$sql_common .= ", user_etc1 = '".addslashes($_POST['user_etc1'])."' ";
$sql_common .= ", user_etc1_help = '".addslashes($_POST['user_etc1_help'])."' ";
$sql_common .= ", user_etc2 = '".addslashes($_POST['user_etc2'])."' ";
$sql_common .= ", user_etc2_help = '".addslashes($_POST['user_etc2_help'])."' ";
$sql_common .= ", user_etc3 = '".addslashes($_POST['user_etc3'])."' ";
$sql_common .= ", user_etc3_help = '".addslashes($_POST['user_etc3_help'])."' ";
$sql_common .= ", user_etc4 = '".addslashes($_POST['user_etc4'])."' ";
$sql_common .= ", user_etc4_help = '".addslashes($_POST['user_etc4_help'])."' ";
$sql_common .= ", user_etc5 = '".addslashes($_POST['user_etc5'])."' ";
$sql_common .= ", user_etc5_help = '".addslashes($_POST['user_etc5_help'])."' ";

// update
sql_query(" update $shop[signup_table] $sql_common ");

if ($_POST['user_real_check'] == '3' || $_POST['user_hp'] == '3') {

    // update
    sql_query(" update $shop[sms_config_table] set sms_use = '1' where sms_code = 'hp_real' ");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>