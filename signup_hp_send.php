<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($real_type) { $real_type = preg_match("/^[0-9]+$/", $real_type) ? $real_type : ""; }
if ($user_name) { $user_name = preg_match("/^[A-Za-z0-9_가-힣\x20]+$/", $user_name) ? $user_name : ""; }
if ($page_id) { $page_id = preg_match("/^[A-Za-z0-9_\-]+$/", $page_id) ? $page_id : ""; }
if ($user_hp1) { $user_hp1 = preg_match("/^[0-9]+$/", $user_hp1) ? $user_hp1 : ""; }
if ($user_hp2) { $user_hp2 = preg_match("/^[0-9]+$/", $user_hp2) ? $user_hp2 : ""; }
if ($user_hp3) { $user_hp3 = preg_match("/^[0-9]+$/", $user_hp3) ? $user_hp3 : ""; }
$ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));

// 회원가입
$dmshop_signup = shop_signup();

// 휴대폰 인증 미사용, SMS 인증 미사용
if ($page_id == 'signup' && $dmshop_signup['user_real_check'] != '3' || $page_id == 'signup_form' && $dmshop_signup['user_hp'] != '3') {

    message("<p class='title'>알림</p><p class='text'>휴대폰 인증기능이 현재 미사용상태 입니다. 처음부터 다시 이용하시기 바랍니다.</p>", "", "", false, true);

}

if (!$user_hp1 || !$user_hp2 || !$user_hp3) {

    message("<p class='title'>알림</p><p class='text'>휴대폰 번호를 입력하세요.</p>", "", "", false, true);

}

$real_type = "3";

// 휴대폰 인증 동일아이피 체크 당일
$chk = sql_fetch(" select count(*) as cnt from $shop[real_table] where real_type = '".$real_type."' and real_ip = '".$ip."' and substring(datetime,1,10) = '".$shop['time_ymd']."' ");

// 1일 횟수
if ($chk['cnt'] >= $dmshop_signup['user_real_max']) {

    message("<p class='title'>알림</p><p class='text'>고객님의 PC에서는 1일 인증요청횟수를 초과하였습니다. 내일 다시 이용하시기 바랍니다.</p>", "", "", false, true);

}

// 인증번호 생성
$real_code = rand(100000,999999);

$sql_common = "";
$sql_common .= " set real_type = '".$real_type."' ";
$sql_common .= ", real_code = '".$real_code."' ";
$sql_common .= ", real_ip = '".$ip."' ";
$sql_common .= ", user_name = '".addslashes($user_name)."' ";
$sql_common .= ", user_hp = '".$user_hp1."-".$user_hp2."-".$user_hp3."' ";
$sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

// insert
sql_query(" insert into $shop[real_table] $sql_common ");

// sms
$shop_sms_config = shop_sms_config("hp_real");

// 사용
if ($shop_sms_config['sms_use']) {

    $sms_to = $user_hp1.$user_hp2.$user_hp3;
    $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

    $sms_message = $shop_sms_config['sms_message'];
    $sms_message = str_replace("[인증키]", $real_code, $sms_message);
    $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
    $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

    // 전송
    shop_sms_send("hp_real", "", $sms_to, $sms_from, $sms_message);

} else {

    message("<p class='title'>알림</p><p class='text'>인증번호 발송시스템이 미사용중입니다. 쇼핑몰 관리자에게 문의하여 주십시오.</p>", "", "", false, true);

}

echo "<script type='text/javascript'>";
echo "document.getElementById('real_hp_code').value = '".$real_code."';";
//echo "document.getElementById('real_hp_code_check').value = '".$real_code."';";
echo "document.getElementById('real_hp1').value = '".$user_hp1."';";
echo "document.getElementById('real_hp2').value = '".$user_hp2."';";
echo "document.getElementById('real_hp3').value = '".$user_hp3."';";
echo "</script>";

message("<p class='title'>알림</p><p class='text'>인증번호 발송을 완료하였습니다.</p>", "", "", false, true);
?>