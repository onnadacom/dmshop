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

if (!$user_pw_a) {

    message("<p class='title'>알림</p><p class='text'>답변이 입력되지 않았습니다.</p>", "", "", false, true);

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

$ss_name = "find_pw_".$user_id;

if (!shop_get_session($ss_name)) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", "", false, true);

}

// 아이디가 존재하고, 답변이 일치할 때. sql 구문에서 체크하지 않는 것은 인젝션 예방.
if ($user['user_id'] && $user['user_pw_a'] && $user['user_pw_a'] == $user_pw_a) {

    $ss_name = "find_pw_new_".$user_id;

    if (!shop_get_session($ss_name)) {

        shop_set_session($ss_name, true);

    }

    echo "<script type=\"text/javascript\">";
    echo "findNext();";
    echo "</script>";

} else {

    echo "<div class='find_id_not'><div>입력하신 답변이 올바르지 않습니다. 다시 입력 하세요.</div></div>";

}
?>