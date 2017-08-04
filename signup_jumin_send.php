<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($dmshop['kcb_id']) { if (substr($dmshop['kcb_id'],-3) != 'DMP') { message("<p class='title'>알림</p><p class='text'>쇼핑몰 환경설정 페이지의 실명인증 회원사 아이디가 입력되지 않았거나 올바르지 않습니다.</p>", "", "", false, true); } } else { message("<p class='title'>알림</p><p class='text'>쇼핑몰 환경설정 페이지의 실명인증 회원사 아이디가 입력되지 않았거나 올바르지 않습니다.</p>", "", "", false, true); }

if ($user_name) { $user_name = preg_match("/^[A-Za-z0-9_가-힣\x20]+$/", $user_name) ? $user_name : ""; }
if ($page_id) { $page_id = preg_match("/^[A-Za-z0-9_\-]+$/", $page_id) ? $page_id : ""; }
if ($user_jumin1) { $user_jumin1 = preg_match("/^[0-9]+$/", $user_jumin1) ? $user_jumin1 : ""; }
if ($user_jumin2) { $user_jumin2 = preg_match("/^[0-9]+$/", $user_jumin2) ? $user_jumin2 : ""; }
$ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));

// 회원가입
$dmshop_signup = shop_signup();

// 주민등록번호 미사용
if ($page_id == 'signup' && $dmshop_signup['user_real_check'] != '1') {

    message("<p class='title'>알림</p><p class='text'>실명인증기능이 현재 미사용상태 입니다. 처음부터 다시 이용하시기 바랍니다.</p>", "", "", false, true);

}

if (!$user_name) {

    message("<p class='title'>알림</p><p class='text'>성명을 입력하세요. 한글만 가능합니다.</p>", "", "", false, true);

}

if (!$user_jumin1 || !$user_jumin2) {

    message("<p class='title'>알림</p><p class='text'>주민등록번호를 입력하세요.</p>", "", "", false, true);

}

$real_type = "1";

// 주민등록 인증 동일아이피 체크 당일
$chk = sql_fetch(" select count(*) as cnt from $shop[real_table] where real_type = '".$real_type."' and real_ip = '".$ip."' and substring(datetime,1,10) = '".$shop['time_ymd']."' ");

// 1일 횟수
if ($chk['cnt'] >= $dmshop_signup['user_real_max']) {

    message("<p class='title'>알림</p><p class='text'>고객님의 PC에서는 1일 인증요청횟수를 초과하였습니다. 내일 다시 이용하시기 바랍니다.</p>", "", "", false, true);

}

$sql_common = "";
$sql_common .= " set real_type = '".$real_type."' ";
$sql_common .= ", real_ip = '".$ip."' ";
$sql_common .= ", user_name = '".addslashes($user_name)."' ";
$sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

// insert
sql_query(" insert into $shop[real_table] $sql_common ");

if (!$dmshop['real_type']) {

    echo "<script type='text/javascript'>";
    echo "document.getElementById('real_jumin_check').value = '1';";
    echo "document.getElementById('real_user_name').value = '".text($user_name)."';";
    echo "document.getElementById('real_user_jumin').value = '".$user_jumin1.$user_jumin2."';";
    echo "</script>";

    message("<p class='title'>알림</p><p class='text'>실명인증을 완료하였습니다.</p>", "", "", false, true);

}

// kcb start
$name = $user_name; // 성명
$ssn = $user_jumin1.$user_jumin2; // 주민번호(숫자만)
$memid = $dmshop['kcb_id']; // 회원사코드
$qryBrcCd = "x";
$qryBrcNm = "x";
$qryId = "u1234"; // 쿼리ID, 고정값
$qryKndCd = "1"; // 요청구분  (내국인,주민등록번호 : 1, 외국인,외국인등록번호 : 2)
$qryRsnCd = "01"; // 조회사유  (회원가입 : 01, 회원정보수정 : 02, 회원탈회 : 03, 성인인증 : 04, 기타 : 05)
$qryIP = $_SERVER['SERVER_ADDR']; // IP
$qryDomain = $dmshop['domain']; // 도메인
$qryDt = date("Ymd"); // 현재일 (20101101)
$EndPointURL = "http://www.ok-name.co.kr/KcbWebService/OkNameService";
$Option = "U"; // utf-8인경우는 U추가, D: debug mode, L: log 기록.

// ***절대경로*를 포함한 모듈명. 리눅스,유닉스계열은 확장자가 붙지 않습니다. 모듈에 실행권한 추가할 것.
$exe = $shop['path']."/real/kcb/okname";
//$exe = "/home/dm/ser/real/kcb/okname";

// 모듈호출명령어
$cmd="{$exe} \"{$name}\" \"{$ssn}\" $memid $qryBrcCd $qryBrcNm $qryId $qryKndCd $qryRsnCd $qryIP $qryDomain $qryDt $EndPointURL $Option";

// 보안상 초기화
$out = "";
$ret = "";
$result = "";

// 실행
@exec($cmd, $out, $ret);

if ($ret <= '200') {

    $result = sprintf("B%03d", $ret);

} else {

    $result = sprintf("S%03d", $ret);

}

// 인증성공
if ($result == 'B000') {

    echo "<script type='text/javascript'>";
    echo "document.getElementById('real_jumin_check').value = '1';";
    echo "document.getElementById('real_user_name').value = '".text($user_name)."';";
    echo "document.getElementById('real_user_jumin').value = '".$user_jumin1.$user_jumin2."';";
    echo "</script>";

    message("<p class='title'>알림</p><p class='text'>실명인증을 완료하였습니다.</p>", "", "", false, true);

}

// 주민번호가 없음으로 실패. 주민등록페이지 유도
else if ($result=='B001' || $result=='B002' || $result=='B016') {

    echo "<script type='text/javascript'>";
    echo "shopOpen('http://www.ok-name.co.kr/oknm/okname.jsp?restCode=".$result."', 'KCB_GuideView', 'width=560, height=416, scrollbars=no');";
    echo "</script>";

    message("<p class='title'>알림</p><p class='text'>실명인증을 실패하였습니다.</p><p class='text'>팝업창의 실패에 대한 안내페이지를 확인하시기 바랍니다.<br />팝업창이 뜨지 않을경우 팝업창 해제를 하여주시기 바랍니다.</p></p>", "", "", false, true);

} else {

    message("<p class='title'>알림</p><p class='text'>실명인증 수단을 사용할 수 없습니다. 고객센터에 문의하여주세요.</p><p class='text'>실패내용 : result 결과값 없음</p>", "", "", false, true);

}
?>