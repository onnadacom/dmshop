<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($page_id) { $page_id = preg_match("/^[A-Za-z0-9_\-]+$/", $page_id) ? $page_id : ""; }
if ($user_name) { $user_name = preg_match("/^[A-Za-z0-9_가-힣\x20]+$/", $user_name) ? $user_name : ""; }
if ($user_email) { $user_email = preg_match("/^[A-Za-z0-9_@\-\.]+$/", $user_email) ? $user_email : ""; }
if ($user_email1) { $user_email1 = preg_match("/^[A-Za-z0-9_@\-\.]+$/", $user_email1) ? $user_email1 : ""; }
if ($user_email2) { $user_email2 = preg_match("/^[A-Za-z0-9_@\-\.]+$/", $user_email2) ? $user_email2 : ""; }
$ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));

// 회원가입
$dmshop_signup = sql_fetch(" select * from $shop[signup_table] ");

if ($dmshop_signup['user_real_check'] != '2') {

    message("<p class='title'>알림</p><p class='text'>이메일 인증기능이 현재 미사용상태 입니다. 처음부터 다시 이용하시기 바랍니다.</p>", "", "", false, true);

}

if (!$user_name) {

    message("<p class='title'>알림</p><p class='text'>성명을 입력하세요. 영문 또는 한글만 입력이 가능합니다.</p>", "", "", false, true);

}

if ($page_id == 'signup' && !$user_email || $page_id == 'signup_form' && !$user_email1) {

    message("<p class='title'>알림</p><p class='text'>이메일주소를 입력하세요.</p>", "", "", false, true);

}

if ($page_id == 'signup_form' && !$user_email1 || $page_id == 'signup_form' && !$user_email2) {

    message("<p class='title'>알림</p><p class='text'>이메일주소를 입력하세요.</p>", "", "", false, true);

}

$real_type = "2";

// 이메일 인증 동일아이피 체크 당일
$chk = sql_fetch(" select count(*) as cnt from $shop[real_table] where real_type = '".$real_type."' and real_ip = '".$ip."' and substring(datetime,1,10) = '".$shop['time_ymd']."' ");

// 1일 횟수
if ($chk['cnt'] >= $dmshop_signup['user_real_max']) {

    message("<p class='title'>알림</p><p class='text'>고객님의 PC에서는 1일 인증요청횟수를 초과하였습니다. 내일 다시 이용하시기 바랍니다.</p>", "", "", false, true);

}

if ($page_id == 'signup') {

    $user_email = $user_email;

} else {

    $user_email = $user_email1."@".$user_email2;

}

// 인증번호 생성
$real_code = rand(100000,999999);

$sql_common = "";
$sql_common .= " set real_type = '".$real_type."' ";
$sql_common .= ", real_code = '".$real_code."' ";
$sql_common .= ", real_ip = '".$ip."' ";
$sql_common .= ", user_name = '".$user_name."' ";
$sql_common .= ", user_email = '".$user_email."' ";
$sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

// insert
sql_query(" insert into $shop[real_table] $sql_common ");

$content = "인증번호 : ".$real_code."<p><br></p>";

ob_start();
include_once("./signup_email_text.php");
$content = ob_get_contents();
ob_end_clean();

$to_email = $user_email; // 받는사람
$title = $dmshop['shop_name']." - 회원가입 인증번호"; // 제목
$from_name = $dmshop['shop_name']; // 보내는사람 이름
$from_email = $dmshop['ceo_email']; // 보내는사람 이메일

// 발송
shop_email_send($to_email, $title, $content, $from_name, $from_email, "1");

echo "<script type='text/javascript'>";
echo "document.getElementById('real_email_code').value = '".$real_code."';";
//echo "document.getElementById('real_email_code_check').value = '".$real_code."';";

if ($page_id == 'signup') {

    echo "document.getElementById('real_email').value = '".$user_email."';";

} else {

    echo "document.getElementById('real_email1').value = '".$user_email1."';";
    echo "document.getElementById('real_email2').value = '".$user_email2."';";

}

echo "</script>";

message("<p class='title'>알림</p><p class='text'>인증번호 발송을 완료하였습니다.</p>", "", "", false, true);
?>