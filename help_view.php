<?
include_once("./_dmshop.php");
if ($help_id) { $help_id = preg_match("/^[0-9]+$/", $help_id) ? $help_id : ""; }

// 로그인
if (!$shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_help']) {

    message("<p class='title'>알림</p><p class='text'>1:1 문의/상담 스킨이 설정되지 않았습니다.</p>", "c");

}

if (!$help_id) {

    message("<p class='title'>알림</p><p class='text'>문의가 삭제되었거나 존재하지 않습니다.</p>", "c");

}

$dmshop_help = shop_help($help_id);

if (!$dmshop_help['id']) {

    message("<p class='title'>알림</p><p class='text'>문의가 삭제되었거나 존재하지 않습니다.</p>", "c");

}

if ($dmshop_help['id'] != $dmshop_help['help_id']) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

if ($dmshop_user['user_id'] != $dmshop_help['user_id']) {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

// 세션 생성
$ss_name = "help_view_".$help_id;
if (!shop_get_session($ss_name)) {

    shop_set_session($ss_name, true);

}

// 답변
$dmshop_help_reply = shop_help_reply($dmshop_help['id']);

if ($dmshop_help_reply['id']) {

    // 세션 생성
    $ss_name = "help_view_".$dmshop_help_reply['id'];
    if (!shop_get_session($ss_name)) {

        shop_set_session($ss_name, true);

    }

}

// user
$user = shop_user($dmshop_help['user_id']);

// 스킨 경로
$dmshop_help_path = "";
$dmshop_help_path = $shop['path']."/skin/help/".$dmshop_skin['skin_help'];

// 타이틀 제목
$shop['title'] = "1:1문의 열람";

// 페이지 아이디
$page_id = "help_view";

include_once("./shop.top.php");
include_once("$dmshop_help_path/help_view.php");
include_once("./shop.bottom.php");
?>