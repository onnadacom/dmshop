<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }

// 회원
if ($shop_user_login) {

    shop_url("$shop[path]");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_find']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "", "", false, true);

}

if (!$user_id) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", "", false, true);

}

$user_id = strtolower(trim(strip_tags(mysql_real_escape_string($user_id))));

if ($user_id == 'admin') {

    message("<p class='title'>알림</p><p class='text'>관리자 아이디는 비밀번호 찾기를 하실 수 없습니다.</p>", "b");

}

if (!$user_pw || !$user_pw_re) {

    message("<p class='title'>알림</p><p class='text'>비밀번호가 입력되지 않았습니다.</p>", "", "", false, true);

}

if ($user_pw != $user_pw_re) {

    message("<p class='title'>알림</p><p class='text'>입력하신 비밀번호가 일치하지 않습니다.</p>", "", "", false, true);

}

// 회원 데이터
$user = shop_user($user_id);

// 폼 체크
if (!$_POST['form_check']) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", "", false, true);

}

if ($user['datetime'] != $_POST['form_check']) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", "", false, true);

}

$ss_name = "find_pw_new_".$user_id;

if (!shop_get_session($ss_name)) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", "", false, true);

}

// 아이디가 존재하면 패스워드 변경
if ($user['user_id']) {

    sql_query(" update $shop[user_table] set user_pw = '".sql_password($user_pw)."' where user_id = '".$user_id."' ");

    message("<p class='title'>알림</p><p class='text'>비밀번호 변경을 완료하였습니다.</p>", "", "./signin.php");

} else {

    message("<p class='title'>알림</p><p class='text'>아이디가 존재하지 않습니다.</p>", "", $shop['path']);

}
?>