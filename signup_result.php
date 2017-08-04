<?
include_once("./_dmshop.php");

// 세션
$ss_name = "signup_".$dmshop_user['user_id'];

if (!shop_get_session($ss_name)) {

    shop_url($shop['path']);

}

// 스킨이 없다.
if (!$dmshop_skin['skin_signup']) {

    message("<p class='title'>알림</p><p class='text'>회원가입 스킨이 설정되지 않았습니다.</p>", "b");

}

// 회원가입
$dmshop_signup = sql_fetch(" select * from $shop[signup_table] ");

// 스킨 경로
$dmshop_signup_path = "";
$dmshop_signup_path = $shop['path']."/skin/signup/".$dmshop_skin['skin_signup'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 회원가입 완료";

// 페이지 아이디
$page_id = "signup_result";

include_once("./_top.php");
include_once("$dmshop_signup_path/signup_result.php");
include_once("./_bottom.php");
?>