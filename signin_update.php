<?
include_once("./_dmshop.php");

if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }

if ($shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>이미 로그인 중입니다.</p>", "b");

}

if (!$user_id || !$_POST['user_pw']) {

    message("<p class='title'>알림</p><p class='text'>아이디 및 비밀번호를 입력하세요.</p>", "b");

}

// 소문자로 변경
$user_id = strtolower($user_id);

// 회원 데이터
$user = shop_user($user_id);

// 비밀번호 체크
$row = sql_fetch(" select count(*) as cnt from $shop[user_table] where user_id = '".$user_id."' and user_pw = '".sql_password($_POST['user_pw'])."' ");

// 없다면
if (!$user['user_id']) {

    message("<p class='title'>알림</p><p class='text'>회원 아이디가 존재하지 않습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

// 탈퇴시각이 있다면
if ($user['user_leave_datetime'] != '0000-00-00 00:00:00') {

    message("<p class='title'>알림</p><p class='text'>{$user['user_id']} 아이디는 탈퇴한 아이디입니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

// 차단시각이 있다면
if ($user['user_block_datetime'] != '0000-00-00 00:00:00') {

    message("<p class='title'>알림</p><p class='text'>{$user['user_id']} 아이디는 차단된 아이디입니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

// 아이디 존재
if ($user['user_id']) {

    $sql_common = "";
    $sql_common .= " set user_id = '".$user_id."' ";
    $sql_common .= ", login_ip = '".trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])))."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // insert
    sql_query(" insert into $shop[user_login_table] $sql_common ");

    $login_id = mysql_insert_id();

}

// 비밀번호가 다르다.
if ($user['user_pw'] != sql_password($_POST['user_pw'])) {

    message("<p class='title'>알림</p><p class='text'>회원 비밀번호가 일치하지 않습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

// 회원 세션 생성
shop_set_session('ss_user_id', $user_id);

// 로그인 성공
if ($login_id) {

    // update
    sql_query(" update $shop[user_login_table] set login_type = '1' where id = '".$login_id."' ");

}

// 아이디 저장
if ($user_id_save) {

    // 쿠키 아이디
    $cookie_id = "user_id_save";

    // 쿠키가 없다면    
    if (shop_get_cookie($cookie_id) != $user_id) {

        shop_set_cookie($cookie_id, $user_id, (int)(86400 * 30)); // 한달동안 저장

    }

} else {
// 해제

    // 쿠키 아이디
    $cookie_id = "user_id_save";

    // 쿠키가 있다면    
    if (shop_get_cookie($cookie_id) == $user_id) {

        shop_set_cookie($cookie_id, "", 0); // 초기화

    }

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = $shop['url'];

}

if ($user_id == 'admin') {

    shop_url($shop['path']."/adm/");

}

shop_url($urlencode);
?>