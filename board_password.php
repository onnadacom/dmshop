<?
include_once("./_dmshop.php");

if ($shop_user_login) {

    message("<p class='title'>알림</p><p class='text'>비회원만 이용하실 수 있습니다.</p>", "b");

}

if (!$bbs_id) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 게시판입니다.</p>", "b");

}

$dmshop_board = shop_board($bbs_id);

if (!$dmshop_board['bbs_id']) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 게시판입니다.</p>", "b");

}

if (!$dmshop_board['bbs_view']) {

    message("<p class='title'>알림</p><p class='text'>접근할 수 없는 게시판입니다.</p>", "b");

}

if (!$dmshop_board['bbs_skin']) {

    message("<p class='title'>알림</p><p class='text'>게시판 스킨이 설정되지 않았습니다.</p>", "b");

}

if (!$article_id) {

    message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

}

$dmshop_article = shop_article($bbs_id, $article_id);

if (!$dmshop_article['id']) {

    message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

}

// 게시물 수정, 게시물 삭제
if ($m == 'article_view' || $m == 'article_edit' || $m == 'article_delete') {

    // 회원이 작성
    if ($dmshop_article['user_id']) {

        message("<p class='title'>알림</p><p class='text'>비회원이 작성한 게시물이 아닙니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

}

// 댓글 삭제
else if ($m == 'reply_delete') {

    if (!$reply_id) {

        message("<p class='title'>알림</p><p class='text'>댓글이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}");

    }

    $dmshop_article_reply = shop_article_reply($reply_id);

    if (!$dmshop_article_reply['id']) {

        message("<p class='title'>알림</p><p class='text'>댓글이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}");

    }

    // 회원이 작성
    if ($dmshop_article_reply['user_id']) {

        message("<p class='title'>알림</p><p class='text'>비회원이 작성한 댓글이 아닙니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}");

    }

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

// 스킨 경로
$dmshop_board_path = "";
$dmshop_board_path = $shop['path']."/skin/board/".$dmshop_board['bbs_skin'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_board['bbs_title'];

// 페이지 아이디
$page_id = $bbs_id;

include_once("./_top.php");

// top 이미지
$file = shop_design_file("board_top_".$bbs_id); if ($file['upload_file']) { echo "<div>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</div>"; }

// top 내용
if ($dmshop_board['bbs_text_top']) { echo "<div>".stripslashes($dmshop_board['bbs_text_top'])."</div>"; }

include_once("$dmshop_board_path/password.php");

// bottom 내용
if ($dmshop_board['bbs_text_bottom']) { echo "<div>".stripslashes($dmshop_board['bbs_text_bottom'])."</div>"; }

// bottom 이미지
$file = shop_design_file("board_bottom_".$bbs_id); if ($file['upload_file']) { echo "<div>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</div>"; }

include_once("./_bottom.php");
?>