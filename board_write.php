<?
include_once("./_dmshop.php");

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

if ($m == '') {

    if ($dmshop_board['bbs_write_level'] > '1') {

        if ($shop_user_login) {

            if ($dmshop_user['user_level'] < $dmshop_board['bbs_write_level']) {

                message("<p class='title'>알림</p><p class='text'>글을 작성할 권한이 없습니다.</p>", "b");

            }

        } else {

            shop_url("$shop[path]/signin.php?url={$urlencode}");

        }

    }

    $dmshop_article['ar_content'] = shop_text($dmshop_board['bbs_write_text']);

}

else if ($m == 'u' && $article_id) {

    if (!$article_id) {

        message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

    $dmshop_article = shop_article($bbs_id, $article_id);

    if (!$dmshop_article['id']) {

        message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

    // 비회원
    $shop_article_session = false;
    if (!$dmshop_article['user_id'] && !$shop_user_login) {

        $ss_name = "article_".$bbs_id."_".$article_id;

        if (shop_get_session($ss_name)) {

            $shop_article_session = true;

        } else {

            shop_url("./board_password.php?m=article_edit&bbs_id={$bbs_id}&article_id={$article_id}");

        }

    }

    // 관리자
    if ($shop_user_admin) {

        // pass

    }

    // 내글
    else if ($dmshop_article['user_id'] && $dmshop_user['user_id'] == $dmshop_article['user_id']) {

        // pass

    }

    // 비회원 (세션이 있다면)
    else if (!$dmshop_article['user_id'] && $shop_article_session) {

        // pass

    } else {

        message("<p class='title'>알림</p><p class='text'>수정할 권한이 없습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

    $dmshop_article['ar_name'] = text($dmshop_article['ar_name']);
    $dmshop_article['ar_password'] = text($dmshop_article['ar_password']);
    $dmshop_article['ar_email'] = text($dmshop_article['ar_email']);
    $dmshop_article['ar_category'] = text($dmshop_article['ar_category']);
    $dmshop_article['ar_ip'] = text($dmshop_article['ar_ip']);
    $dmshop_article['ar_title'] = text($dmshop_article['ar_title']);
    $dmshop_article['ar_content'] = shop_text($dmshop_article['ar_content']);

}

else if ($m == 'a') {

    if (!$article_id) {

        message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

    $dmshop_article = shop_article($bbs_id, $article_id);

    if (!$dmshop_article['id']) {

        message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

    if ($dmshop_article['ar_notice']) {

        message("<p class='title'>알림</p><p class='text'>공지사항에는 답변하실 수 없습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

    if ($dmshop_article['ar_secret'] && !$shop_user_admin) {

        message("<p class='title'>알림</p><p class='text'>비밀글에는 답변하실 수 없습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

    if ($dmshop_board['bbs_answer_level'] > '1') {

        if ($shop_user_login) {

            if ($dmshop_user['user_level'] < $dmshop_board['bbs_answer_level']) {

                message("<p class='title'>알림</p><p class='text'>글을 답변할 권한이 없습니다.</p>", "b");

            }

        } else {

            shop_url("$shop[path]/signin.php?url={$urlencode}");

        }

    }

    $dmshop_article['ar_name'] = "";
    $dmshop_article['ar_password'] = "";
    $dmshop_article['ar_email'] = "";
    $dmshop_article['ar_category'] = "";
    $dmshop_article['ar_ip'] = "";
    $dmshop_article['ar_title'] = text($dmshop_article['ar_title']);
    $dmshop_article['ar_content'] = "";

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

}

// 내용이 없을 경우 br 코드 심는다.
if (!$dmshop_article['ar_content']) {

    //$dmshop_article['ar_content'] = "<br />";

}

// 스킨 경로
$dmshop_board_path = "";
$dmshop_board_path = $shop['path']."/skin/board/".$dmshop_board['bbs_skin'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_board['bbs_title'];

// 페이지 아이디
$page_id = $bbs_id;

if ($dmshop_board['bbs_include_top']) { include($dmshop_board['bbs_include_top']); } else { include_once("./_top.php"); }

// top 이미지
$file = shop_design_file("board_top_".$bbs_id); if ($file['upload_file']) { echo "<div>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</div>"; }

// top 내용
if ($dmshop_board['bbs_text_top']) { echo "<div>".stripslashes($dmshop_board['bbs_text_top'])."</div>"; }

@include_once("$dmshop_board_path/write.top.php");
include_once("$dmshop_board_path/write.php");
@include_once("$dmshop_board_path/write.bottom.php");

// bottom 내용
if ($dmshop_board['bbs_text_bottom']) { echo "<div>".stripslashes($dmshop_board['bbs_text_bottom'])."</div>"; }

// bottom 이미지
$file = shop_design_file("board_bottom_".$bbs_id); if ($file['upload_file']) { echo "<div>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</div>"; }

if ($dmshop_board['bbs_include_bottom']) { include($dmshop_board['bbs_include_bottom']); } else { include_once("./_bottom.php"); }
?>