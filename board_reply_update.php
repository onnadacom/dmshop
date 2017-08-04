<?
include_once("./_dmshop.php");

if (shop_keyword_filter($reply_content)) { message("<p class='title'>알림</p><p class='text'>내용 금지어가 포함되어있습니다.</p>", "b"); }

// 회원
if ($shop_user_login) {

    // 폼 체크
    if (!$_POST['form_check']) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

    }

    if ($dmshop_user['datetime'] != $_POST['form_check']) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

    }

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

if (!$dmshop_board['bbs_reply_write']) {

    message("<p class='title'>알림</p><p class='text'>댓글 작성이 미사용 상태입니다.</p>", "b");

}

// 스킨 경로
$dmshop_board_path = "";
$dmshop_board_path = $shop['path']."/skin/board/".$dmshop_board['bbs_skin'];

if (!$article_id) {

    message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

}

$dmshop_article = shop_article($bbs_id, $article_id);

if (!$dmshop_article['id']) {

    message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

}

// 등록
if ($m == '') {

    // 댓글권한
    if ($dmshop_board['bbs_reply_level'] > '1') {

        if ($shop_user_login) {

            if ($dmshop_user['user_level'] < $dmshop_board['bbs_reply_level']) {

                message("<p class='title'>알림</p><p class='text'>댓글을 작성할 권한이 없습니다.</p>", "b");

            }

        } else {

            message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "b");

        }

    }

    // 회원
    if ($shop_user_login) {

        $user_id = $dmshop_user['user_id'];

        // 별명
        if ($dmshop_board['bbs_name'] == '2' && $dmshop_user['user_nick']) {

            $reply_name = $dmshop_user['user_nick'];

        } else {

            $reply_name = $dmshop_user['user_name'];

        }

        $reply_email = $dmshop_user['user_email'];
        $reply_homepage = $dmshop_user['user_homepage'];
        $reply_password = "";
        $datetime = $shop['time_ymdhis'];

    } else {
    // 비회원

/*
        // 지엠스팸프리 검사
        include_once("$shop[path]/zmSpamFree/zmSpamFree.php");

        if (!zsfCheck($_POST['robot_key'])) {

            message("<p class='title'>알림</p><p class='text'>스팸방지 코드가 틀렸습니다.</p>", "b");

        }
*/

        $user_id = "";
        $reply_name = $_POST['reply_name'];
        $reply_email = $_POST['reply_email'];
        $reply_homepage = $_POST['reply_homepage'];
        $reply_password = sql_password(trim(strip_tags(mysql_real_escape_string($_POST['reply_password']))));
        $datetime = $shop['time_ymdhis'];

    }

    // 작성일 변경
    if ($reply_datetime && $shop_user_admin) {

        $datetime = $_POST['datetime'];

    }

    // 작성자 변경
    if ($dmshop_board['bbs_name'] == '1' && $dmshop_user['user_name'] != $_POST['reply_name'] && $shop_user_admin) {

        $user_id = "";
        $reply_name = $_POST['reply_name'];
        $reply_email = $_POST['reply_email'];
        $reply_homepage = $_POST['reply_homepage'];
        $reply_password = sql_password(trim(strip_tags(mysql_real_escape_string($_POST['reply_password']))));

    }

    // 작성자 변경
    else if ($dmshop_board['bbs_name'] == '2' && $dmshop_user['user_nick'] != $_POST['reply_name'] && $shop_user_admin) {

        $user_id = "";
        $reply_name = $_POST['reply_name'];
        $reply_email = $_POST['reply_email'];
        $reply_homepage = $_POST['reply_homepage'];
        $reply_password = sql_password(trim(strip_tags(mysql_real_escape_string($_POST['reply_password']))));

    }

    $reply_name = trim(strip_tags(mysql_real_escape_string($reply_name)));
    $reply_email = trim(strip_tags(mysql_real_escape_string($reply_email)));
    $reply_homepage = trim(strip_tags(mysql_real_escape_string($reply_homepage)));
    $reply_content = mysql_real_escape_string($_POST['reply_content']);
    $reply_ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));

    @include_once("$dmshop_board_path/reply_update.top.php");

    $sql_common = "";
    $sql_common .= " set bbs_id = '".$bbs_id."' ";
    $sql_common .= ", article_id = '".$article_id."' ";
    $sql_common .= ", user_id = '".$user_id."' ";
    $sql_common .= ", reply_name = '".$reply_name."' ";
    $sql_common .= ", reply_email = '".$reply_email."' ";
    $sql_common .= ", reply_homepage = '".$reply_homepage."' ";
    $sql_common .= ", reply_password = '".$reply_password."' ";
    $sql_common .= ", reply_content = '".$reply_content."' ";
    $sql_common .= ", reply_ip = '".$reply_ip."' ";
    $sql_common .= ", datetime = '".$datetime."' ";

    // insert
    sql_query(" insert into $shop[article_reply_table] $sql_common ");

    $reply_id = mysql_insert_id();

    // 아이디 저장
    sql_query(" update $shop[article_reply_table] set reply_id = '".$reply_id."' where id = '".$reply_id."' ");

    // 게시물 카운트 증가
    sql_query(" update {$shop['article_table']}{$bbs_id}  set ar_reply = ar_reply + 1 where id = '".$article_id."' ");

    // 게시판 카운트 증가
    sql_query(" update $shop[board_table] set bbs_reply_count = bbs_reply_count + 1 where bbs_id = '".$bbs_id."' ");

    // 적립금 지급. 회원
    if ($shop_user_login && $dmshop_board['bbs_reply_cash'] && $dmshop['reply_cash_use']) {

        // 적립금 처리
        shop_cash_insert($dmshop_user['user_id'], (int)($dmshop_board['bbs_reply_cash'] * 1), "[{$dmshop_board['bbs_title']} - {$dmshop_article['ar_title']}] 댓글 등록", $bbs_id, $article_id, $reply_id);

    }

    // 비회원
    if (!$shop_user_login) {

        $ss_name = "article_reply_".$bbs_id."_".$article_id."_".$reply_id;

        if (!shop_get_session($ss_name)) {

            shop_set_session($ss_name, true);

        }

    }

    @include_once("$dmshop_board_path/reply_update.bottom.php");

    shop_url("./board.php?bbs_id={$bbs_id}&article_id={$article_id}&page={$page}#reply{$reply_id}");

}

// 수정
else if ($m == 'u' && $reply_id) {

    if (!$reply_id) {

        message("<p class='title'>알림</p><p class='text'>댓글이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}&page={$page}");

    }

    $dmshop_article_reply = shop_article_reply($reply_id);

    if (!$dmshop_article_reply['id']) {

        message("<p class='title'>알림</p><p class='text'>댓글이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}&page={$page}");

    }

    // 비회원
    $shop_reply_session = false;
    if (!$dmshop_article_reply['user_id'] && !$shop_user_login) {

        $reply_password = sql_password(trim(strip_tags(mysql_real_escape_string($_POST['reply_password']))));

        if (!$reply_password) {

            message("<p class='title'>알림</p><p class='text'>비밀번호가 입력되지 않았습니다.</p>", "b");

        }

        $chk = sql_fetch(" select reply_password from $shop[article_reply_table] where id = '".$reply_id."' and reply_password = '".$reply_password."' ");

        // 있다
        if ($chk['reply_password']) {

            $ss_name = "article_reply_".$bbs_id."_".$article_id."_".$reply_id;

            if (!shop_get_session($ss_name)) {

                shop_set_session($ss_name, true);

            }

            $shop_reply_session = true;

        } else {

            message("<p class='title'>알림</p><p class='text'>비밀번호가 일치하지 않습니다.</p>", "b");

        }

    }

    // 관리자
    if ($shop_user_admin) {

        // pass

    }

    // 내글
    else if ($dmshop_article_reply['user_id'] && $dmshop_user['user_id'] == $dmshop_article_reply['user_id']) {

        // pass

    }

    // 비회원 (세션이 있다면)
    else if (!$dmshop_article_reply['user_id'] && $shop_reply_session) {

        // pass

    } else {

        message("<p class='title'>알림</p><p class='text'>수정할 권한이 없습니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}&page={$page}");

    }

    // 관리자
    if ($shop_user_admin) {

        // 작성일 변경
        if ($dmshop_article_reply['datetime'] != $_POST['datetime']) {

            $datetime = $_POST['datetime'];

        } else {

            $datetime = $dmshop_article_reply['datetime'];

        }

        // 작성자 변경
        if ($dmshop_board['bbs_name'] == '1' && $dmshop_user['user_name'] != $_POST['reply_name']) {

            $reply_name = $_POST['reply_name'];
            $reply_email = $_POST['reply_email'];
            $reply_homepage = $_POST['reply_homepage'];

        }

        // 작성자 변경
        else if ($dmshop_board['bbs_name'] == '2' && $dmshop_user['user_nick'] != $_POST['reply_name']) {

            $reply_name = $_POST['reply_name'];
            $reply_email = $_POST['reply_email'];
            $reply_homepage = $_POST['reply_homepage'];

        } else {
        // 수정일 경우 작성자 정보로

            $reply_name = $dmshop_article_reply['reply_name'];
            $reply_email = $dmshop_article_reply['reply_email'];
            $reply_homepage = $dmshop_article_reply['reply_homepage'];

        }

    }

    // 회원
    else if ($shop_user_login) {

        // 회원 정보로
        if ($dmshop_board['bbs_name'] == '2' && $dmshop_user['user_nick']) {

            $reply_name = $dmshop_user['user_nick'];

        } else {

            $reply_name = $dmshop_user['user_name'];

        }

        $reply_email = $dmshop_user['user_email'];
        $reply_homepage = $dmshop_user['user_homepage'];
        $datetime = $dmshop_article_reply['datetime'];

    } else {
    // 비회원

        $reply_name = $_POST['reply_name'];
        $reply_email = $_POST['reply_email'];
        $reply_homepage = $_POST['reply_homepage'];
        $datetime = $dmshop_article_reply['datetime'];

    }

    $reply_name = trim(strip_tags(mysql_real_escape_string($reply_name)));
    $reply_email = trim(strip_tags(mysql_real_escape_string($reply_email)));
    $reply_homepage = trim(strip_tags(mysql_real_escape_string($reply_homepage)));
    $reply_content = mysql_real_escape_string($_POST['reply_content']);

    @include_once("$dmshop_board_path/reply_update.top.php");

    $sql_common = "";
    $sql_common .= " set reply_name = '".$reply_name."' ";
    $sql_common .= ", reply_email = '".$reply_email."' ";
    $sql_common .= ", reply_homepage = '".$reply_homepage."' ";
    $sql_common .= ", reply_content = '".$reply_content."' ";
    $sql_common .= ", datetime = '".$datetime."' ";

    // update
    sql_query(" update $shop[article_reply_table] $sql_common where id = '".$reply_id."' ");

    @include_once("$dmshop_board_path/reply_update.bottom.php");

    shop_url("./board.php?bbs_id={$bbs_id}&article_id={$article_id}&page={$page}#reply{$reply_id}");

}

// 삭제
else if ($m == 'd') {

    if (!$reply_id) {

        message("<p class='title'>알림</p><p class='text'>댓글이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}&page={$page}");

    }

    $dmshop_article_reply = shop_article_reply($reply_id);

    if (!$dmshop_article_reply['id']) {

        message("<p class='title'>알림</p><p class='text'>댓글이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}&page={$page}");

    }

    // 비회원
    $shop_reply_session = false;
    if (!$dmshop_article_reply['user_id'] && !$shop_user_login) {

        $ss_name = "article_reply_".$bbs_id."_".$article_id."_".$reply_id;

        if (shop_get_session($ss_name)) {

            $shop_reply_session = true;

        } else {

            shop_url("./board_password.php?m=reply_delete&bbs_id={$bbs_id}&article_id={$article_id}&reply_id={$reply_id}");

        }

    }

    // 관리자
    if ($shop_user_admin) {

        // pass

    }

    // 내글
    else if ($dmshop_article_reply['user_id'] && $dmshop_user['user_id'] == $dmshop_article_reply['user_id']) {

        // pass

    }

    // 비회원 (세션이 있다면)
    else if (!$dmshop_article_reply['user_id'] && $shop_reply_session) {

        // pass

    } else {

        message("<p class='title'>알림</p><p class='text'>삭제할 권한이 없습니다.</p>", "", "./board.php?bbs_id={$bbs_id}&article_id={$article_id}&page={$page}");

    }

    @include_once("$dmshop_board_path/reply_update.top.php");

    // 댓글 삭제
    sql_query(" delete from $shop[article_reply_table] where id = '".$reply_id."' ");

    // 게시물 카운트 감소
    sql_query(" update {$shop['article_table']}{$bbs_id} set ar_reply = ar_reply - 1 where id = '".$article_id."' ");

    // 게시판 카운트 감소
    sql_query(" update $shop[board_table] set bbs_reply_count = bbs_reply_count - 1 where bbs_id = '".$bbs_id."' ");

    // 회원 적립금 회수
    if ($dmshop_article_reply['user_id']) {

        // 적립금 삭제
        shop_cash_delete($dmshop_article_reply['user_id'], "", $bbs_id, $article_id, $reply_id);

    }

    @include_once("$dmshop_board_path/reply_update.bottom.php");

    shop_url("./board.php?bbs_id={$bbs_id}&article_id={$article_id}&page={$page}");

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

}
?>