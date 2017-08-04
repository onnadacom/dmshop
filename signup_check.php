<?
include_once("./_dmshop.php");

if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "b");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_mypage']) {

    message("<p class='title'>알림</p><p class='text'>마이페이지 스킨이 설정되지 않았습니다.</p>", "b");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_signup']) {

    message("<p class='title'>알림</p><p class='text'>회원가입 스킨이 설정되지 않았습니다.</p>", "b");

}

if ($dmshop_user['social']) {

    if ($m == 'd') {

        url("signup_leave.php?m=d");

    } else {

        url("signup_form.php?m=u");

    }

}

// 스킨 경로
$dmshop_mypage_path = "";
$dmshop_mypage_path = $shop['path']."/skin/mypage/".$dmshop_skin['skin_mypage'];

// 스킨 경로
$dmshop_signup_path = "";
$dmshop_signup_path = $shop['path']."/skin/signup/".$dmshop_skin['skin_signup'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 비밀번호확인";

// 페이지 아이디
$page_id = "signup_check";

if ($m == 'd') {

    $m = "d";
    $action = "signup_leave.php";

} else {

    $m = "u";
    $action = "signup_form.php";

}

include_once("./_top.php");
include_once("$dmshop_signup_path/signup_check.php");
include_once("./_bottom.php");
?>