<?
include_once("./_dmshop.php");

// 로그인
if ($shop_user_login) {

    shop_url("$shop[path]");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_signin']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "b");

}

// 아이디 자동저장
$user_id_save = "";
$user_id_save = shop_get_cookie("user_id_save");

if ($user_id_save) {

    $user_id_save = filter1($user_id_save);
    $user_id_save_checked = "checked";

}

// 스킨 경로
$dmshop_signin_path = "";
$dmshop_signin_path = $shop['path']."/skin/signin/".$dmshop_skin['skin_signin'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 로그인";

// 페이지 아이디
$page_id = "signin";

include_once("./_top.php");
include_once("$dmshop_signin_path/signin.php");
include_once("./_bottom.php");
?>