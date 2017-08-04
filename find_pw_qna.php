<?
include_once("./_dmshop.php");

if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }

// 로그인
if ($shop_user_login) {

    shop_url("$shop[path]");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_find']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "b");

}

if (!$user_id) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

$user_id = strtolower(trim(strip_tags(mysql_real_escape_string($user_id))));

if ($user_id == 'admin') {

    message("<p class='title'>알림</p><p class='text'>관리자 아이디는 비밀번호 찾기를 하실 수 없습니다.</p>", "b");

}

// 회원 데이터
$user = shop_user($user_id);

// 폼 체크
if (!$_POST['form_check']) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

if ($user['datetime'] != $_POST['form_check']) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

$ss_name = "find_pw_".$user_id;

if (!shop_get_session($ss_name)) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

// 스킨 경로
$dmshop_find_path = "";
$dmshop_find_path = $shop['path']."/skin/find/".$dmshop_skin['skin_find'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 비밀번호 찾기";

// 페이지 아이디
$page_id = "find_pw_qna";

include_once("./_top.php");
include_once("$dmshop_find_path/find_pw_qna.php");
include_once("./_bottom.php");
?>