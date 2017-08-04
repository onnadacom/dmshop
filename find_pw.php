<?
include_once("./_dmshop.php");

// 로그인
if ($shop_user_login) {

    shop_url("$shop[path]");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_find']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "b");

}

// 스킨 경로
$dmshop_find_path = "";
$dmshop_find_path = $shop['path']."/skin/find/".$dmshop_skin['skin_find'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 비밀번호 찾기";

// 페이지 아이디
$page_id = "find_pw";

include_once("./_top.php");
include_once("$dmshop_find_path/find_pw.php");
include_once("./_bottom.php");
?>