<?
include_once("./_dmshop.php");

if (shop_keyword_filter($ar_title)) { message("<p class='title'>알림</p><p class='text'>제목에 금지어가 포함되어있습니다.</p>", "b"); }
if (shop_keyword_filter($ar_content)) { message("<p class='title'>알림</p><p class='text'>내용 금지어가 포함되어있습니다.</p>", "b"); }

// br 태그제거
if ($_POST['ar_content'] == '<br>' || $_POST['ar_content'] == '<br />') { $_POST['ar_content'] = ""; }

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

// 스킨 경로
$dmshop_board_path = "";
$dmshop_board_path = $shop['path']."/skin/board/".$dmshop_board['bbs_skin'];

// 비밀글 미사용
if (!$dmshop_board['bbs_secret']) {

    $ar_secret = "";

}

// 등록
if ($m == '') {

    // 쓰기권한
    if ($dmshop_board['bbs_write_level'] > '1') {

        if ($shop_user_login) {

            if ($dmshop_user['user_level'] < $dmshop_board['bbs_write_level']) {

                message("<p class='title'>알림</p><p class='text'>글을 작성할 권한이 없습니다.</p>", "b");

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

            $ar_name = $dmshop_user['user_nick'];

        } else {

            $ar_name = $dmshop_user['user_name'];

        }

        $ar_email = $dmshop_user['user_email'];
        $ar_homepage = $dmshop_user['user_homepage'];
        $ar_password = "";
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
        $ar_name = $_POST['ar_name'];
        $ar_email = $_POST['ar_email'];
        $ar_homepage = $_POST['ar_homepage'];
        $ar_password = sql_password(trim(strip_tags(mysql_real_escape_string($_POST['ar_password']))));
        $datetime = $shop['time_ymdhis'];

    }

    // 작성일 변경
    if ($article_datetime && $shop_user_admin) {

        $datetime = $_POST['datetime'];

    }

    // 작성자 변경
    if ($article_name && $shop_user_admin) {

        $user_id = "";
        $ar_name = $_POST['ar_name'];
        $ar_email = $_POST['ar_email'];
        $ar_homepage = $_POST['ar_homepage'];
        $ar_password = sql_password(trim(strip_tags(mysql_real_escape_string($_POST['ar_password']))));

    }

    // 운영자
    if ($shop_user_admin) {

        $ar_notice = $_POST['ar_notice'];

    } else {

        $ar_notice = "";

    }

    $ar_name = trim(strip_tags(mysql_real_escape_string($ar_name)));
    $ar_email = trim(strip_tags(mysql_real_escape_string($ar_email)));
    $ar_homepage = trim(strip_tags(mysql_real_escape_string($ar_homepage)));
    $ar_notice = trim(strip_tags(mysql_real_escape_string($ar_notice)));
    $ar_secret = trim(strip_tags(mysql_real_escape_string($ar_secret)));
    $ar_category = trim(strip_tags(mysql_real_escape_string($_POST['ar_category'])));
    $ar_title = trim(mysql_real_escape_string($_POST['ar_title']));
    $ar_content = mysql_real_escape_string($_POST['ar_content']);
    $ar_ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));

    @include_once("$dmshop_board_path/write_update.top.php");

    $sql_common = "";
    $sql_common .= " set user_id = '".$user_id."' ";
    $sql_common .= ", ar_name = '".$ar_name."' ";
    $sql_common .= ", ar_email = '".$ar_email."' ";
    $sql_common .= ", ar_homepage = '".$ar_homepage."' ";
    $sql_common .= ", ar_password = '".$ar_password."' ";
    $sql_common .= ", ar_notice = '".$ar_notice."' ";
    $sql_common .= ", ar_secret = '".$ar_secret."' ";
    $sql_common .= ", ar_category = '".$ar_category."' ";
    $sql_common .= ", ar_title = '".$ar_title."' ";
    $sql_common .= ", ar_content = '".$ar_content."' ";
    $sql_common .= ", ar_ip = '".$ar_ip."' ";
    $sql_common .= ", datetime = '".$datetime."' ";

    // insert
    sql_query(" insert into {$shop['article_table']}{$bbs_id} $sql_common ");

    $article_id = mysql_insert_id();

    // 공지체크
    $bbs_notice = 0;
    $chk = sql_fetch(" select ar_notice from {$shop['article_table']}{$bbs_id} where ar_notice = '1' ");
    if ($chk['ar_notice']) { $bbs_notice = 1; }

    // 아이디 저장
    sql_query(" update {$shop['article_table']}{$bbs_id} set ar_id = '".$article_id."' where id = '".$article_id."' ");

    // 카운트 증가
    sql_query(" update $shop[board_table] set bbs_write_count = bbs_write_count + 1, bbs_notice = '".$bbs_notice."' where bbs_id = '".$bbs_id."' ");

    // 적립금 지급. 회원
    if ($shop_user_login && $dmshop_board['bbs_write_cash'] && $dmshop['article_cash_use']) {

        // 적립금 처리
        shop_cash_insert($dmshop_user['user_id'], (int)($dmshop_board['bbs_write_cash'] * 1), "[{$dmshop_board['bbs_title']} - {$ar_title}] 게시물 등록", $bbs_id, $article_id, "bbs_write");

    }

    // 비회원
    if (!$shop_user_login) {

        $ss_name = "article_".$bbs_id."_".$article_id;

        if (!shop_get_session($ss_name)) {

            shop_set_session($ss_name, true);

        }

    }

    // 파일경로
    $dir = $shop['path']."/data/article/".$bbs_id."/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    if ($dmshop_board['bbs_file_limit']) {

        for ($i=1; $i<=$dmshop_board['bbs_file_limit']; $i++) {

            $upload_name = $i;
            $upload_mode = "af_".$bbs_id."_".$article_id."_".$i;
            include("./upload_article_file.php");

        }

    }

    @include_once("$dmshop_board_path/write_update.bottom.php");

    if ($dmshop_board['bbs_list_level'] <= 1 && $dmshop_board['bbs_read_level'] <= 1 && !$ar_secret) {

        // 신디케이션
        if ($dmshop['syndi_type']) {

            syndi_create("./xml_syndi.xml", syndi_article($bbs_id, $article_id, "regist"));

        }

    }

    shop_url("./board.php?bbs_id={$bbs_id}&article_id={$article_id}");

}

// 수정
else if ($m == 'u' && $article_id) {

    if (!$article_id) {

        message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

    $dmshop_article = shop_article($bbs_id, $article_id);

    if (!$dmshop_article['id']) {

        message("<p class='title'>알림</p><p class='text'>게시물이 삭제되었거나 존재하지 않습니다.</p>", "b", "./board.php?bbs_id={$bbs_id}");

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

    // 관리자
    if ($shop_user_admin) {

        // 작성일 변경
        if ($article_datetime) {

            $datetime = $_POST['datetime'];

        } else {

            $datetime = $dmshop_article['datetime'];

        }

        // 작성자 변경
        if ($article_name) {

            $ar_name = $_POST['ar_name'];
            $ar_email = $_POST['ar_email'];
            $ar_homepage = $_POST['ar_homepage'];

            if ($_POST['ar_password']) {

                $ar_password = sql_password(trim(strip_tags(mysql_real_escape_string($_POST['ar_password']))));

            } else {

                $ar_password = $dmshop_article['ar_password'];

            }

        } else {
        // 수정일 경우 작성자 정보로

            $ar_name = $dmshop_article['ar_name'];
            $ar_email = $dmshop_article['ar_email'];
            $ar_homepage = $dmshop_article['ar_homepage'];
            $ar_password = $dmshop_article['ar_password'];

        }

        $ar_notice = $_POST['ar_notice'];

    }

    // 회원
    else if ($shop_user_login) {

        // 회원 정보로
        if ($dmshop_board['bbs_name'] == '2' && $dmshop_user['user_nick']) {

            $ar_name = $dmshop_user['user_nick'];

        } else {

            $ar_name = $dmshop_user['user_name'];

        }

        $ar_email = $dmshop_user['user_email'];
        $ar_homepage = $dmshop_user['user_homepage'];
        $ar_password = "";
        $datetime = $dmshop_article['datetime'];

    } else {
    // 비회원

/*
        // 지엠스팸프리 검사
        include_once("$shop[path]/zmSpamFree/zmSpamFree.php");

        if (!zsfCheck($_POST['robot_key'])) {

            message("<p class='title'>알림</p><p class='text'>스팸방지 코드가 틀렸습니다.</p>", "b");

        }
*/

        $ar_name = $_POST['ar_name'];
        $ar_email = $_POST['ar_email'];
        $ar_homepage = $_POST['ar_homepage'];
        $ar_password = sql_password(trim(strip_tags(mysql_real_escape_string($_POST['ar_password']))));
        $datetime = $dmshop_article['datetime'];

    }

    $ar_name = trim(strip_tags(mysql_real_escape_string($ar_name)));
    $ar_email = trim(strip_tags(mysql_real_escape_string($ar_email)));
    $ar_homepage = trim(strip_tags(mysql_real_escape_string($ar_homepage)));
    $ar_notice = trim(strip_tags(mysql_real_escape_string($ar_notice)));
    $ar_secret = trim(strip_tags(mysql_real_escape_string($ar_secret)));
    $ar_category = trim(strip_tags(mysql_real_escape_string($_POST['ar_category'])));
    $ar_title = trim(mysql_real_escape_string($_POST['ar_title']));
    $ar_content = mysql_real_escape_string($_POST['ar_content']);
    $ar_ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));

    $sql_common = "";
    $sql_common .= " set ar_name = '".$ar_name."' ";
    $sql_common .= ", ar_email = '".$ar_email."' ";
    $sql_common .= ", ar_homepage = '".$ar_homepage."' ";
    $sql_common .= ", ar_password = '".$ar_password."' ";
    $sql_common .= ", ar_notice = '".$ar_notice."' ";
    $sql_common .= ", ar_secret = '".$ar_secret."' ";
    $sql_common .= ", ar_category = '".$ar_category."' ";
    $sql_common .= ", ar_title = '".$ar_title."' ";
    $sql_common .= ", ar_content = '".$ar_content."' ";
    $sql_common .= ", ar_ip = '".$ar_ip."' ";
    $sql_common .= ", datetime = '".$datetime."' ";

    @include_once("$dmshop_board_path/write_update.top.php");

    // update
    sql_query(" update {$shop['article_table']}{$bbs_id} $sql_common where id = '".$article_id."' ");

    // 공지체크
    $bbs_notice = 0;
    $chk = sql_fetch(" select ar_notice from {$shop['article_table']}{$bbs_id} where ar_notice = '1' ");
    if ($chk['ar_notice']) { $bbs_notice = 1; }

    // 공지 업데이트
    sql_query(" update $shop[board_table] set bbs_notice = '".$bbs_notice."' where bbs_id = '".$bbs_id."' ");

    // 파일경로
    $dir = $shop['path']."/data/article/".$bbs_id."/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    if ($dmshop_board['bbs_file_limit']) {

        for ($i=1; $i<=$dmshop_board['bbs_file_limit']; $i++) {

            $upload_name = $i;
            $upload_mode = "af_".$bbs_id."_".$article_id."_".$i;
            include("./upload_article_file.php");

        }

    }

    @include_once("$dmshop_board_path/write_update.bottom.php");

    shop_url("./board.php?bbs_id={$bbs_id}&article_id={$article_id}");

}

// 답변
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

            message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "b");

        }

    }

    // 회원
    if ($shop_user_login) {

        $user_id = $dmshop_user['user_id'];

        if ($dmshop_board['bbs_name'] == '2' && $dmshop_user['user_nick']) {

            $ar_name = $dmshop_user['user_nick'];

        } else {

            $ar_name = $dmshop_user['user_name'];

        }

        $ar_email = $dmshop_user['user_email'];
        $ar_homepage = $dmshop_user['user_homepage'];
        $ar_password = "";
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
        $ar_name = $_POST['ar_name'];
        $ar_email = $_POST['ar_email'];
        $ar_homepage = $_POST['ar_homepage'];
        $ar_password = sql_password(trim(strip_tags(mysql_real_escape_string($_POST['ar_password']))));
        $datetime = $shop['time_ymdhis'];

    }

    // 작성일 변경
    if ($article_datetime && $shop_user_admin) {

        $datetime = $_POST['datetime'];

    }

    // 작성자 변경
    if ($article_name && $shop_user_admin) {

        $user_id = "";
        $ar_name = $_POST['ar_name'];
        $ar_email = $_POST['ar_email'];
        $ar_homepage = $_POST['ar_homepage'];
        $ar_password = sql_password(trim(strip_tags(mysql_real_escape_string($_POST['ar_password']))));

    }

    // 운영자
    if ($shop_user_admin) {

        $ar_notice = $_POST['ar_notice'];

    } else {

        $ar_notice = "";

    }

    $ar_name = trim(strip_tags(mysql_real_escape_string($ar_name)));
    $ar_email = trim(strip_tags(mysql_real_escape_string($ar_email)));
    $ar_homepage = trim(strip_tags(mysql_real_escape_string($ar_homepage)));
    $ar_notice = trim(strip_tags(mysql_real_escape_string($ar_notice)));
    $ar_secret = trim(strip_tags(mysql_real_escape_string($ar_secret)));
    $ar_category = trim(strip_tags(mysql_real_escape_string($_POST['ar_category'])));
    $ar_title = trim(mysql_real_escape_string($_POST['ar_title']));
    $ar_content = mysql_real_escape_string($_POST['ar_content']);
    $ar_ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));

    @include_once("$dmshop_board_path/write_update.top.php");

    $sql_common = "";
    $sql_common .= " set user_id = '".$user_id."' ";
    $sql_common .= ", ar_name = '".$ar_name."' ";
    $sql_common .= ", ar_email = '".$ar_email."' ";
    $sql_common .= ", ar_homepage = '".$ar_homepage."' ";
    $sql_common .= ", ar_password = '".$ar_password."' ";
    $sql_common .= ", ar_notice = '".$ar_notice."' ";
    $sql_common .= ", ar_secret = '".$ar_secret."' ";
    $sql_common .= ", ar_category = '".$ar_category."' ";
    $sql_common .= ", ar_title = '".$ar_title."' ";
    $sql_common .= ", ar_content = '".$ar_content."' ";
    $sql_common .= ", ar_ip = '".$ar_ip."' ";
    $sql_common .= ", datetime = '".$datetime."' ";

    // insert
    sql_query(" insert into {$shop['article_table']}{$bbs_id} $sql_common ");

    $answer_id = mysql_insert_id();

    // 아이디 저장
    sql_query(" update {$shop['article_table']}{$bbs_id} set ar_id = '".$article_id."' where id = '".$answer_id."' ");

    // 카운트 증가
    sql_query(" update $shop[board_table] set bbs_write_count = bbs_write_count + 1 where bbs_id = '".$bbs_id."' ");

    // 원글 업데이트
    sql_query(" update {$shop['article_table']}{$bbs_id} set ar_count = ar_count + 1 where id = '".$article_id."' ");

    // 비회원
    if (!$shop_user_login) {

        $ss_name = "article_".$bbs_id."_".$answer_id;

        if (!shop_get_session($ss_name)) {

            shop_set_session($ss_name, true);

        }

    }

    // 파일경로
    $dir = $shop['path']."/data/article/".$bbs_id."/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    if ($dmshop_board['bbs_file_limit']) {

        for ($i=1; $i<=$dmshop_board['bbs_file_limit']; $i++) {

            $upload_name = $i;
            $upload_mode = $bbs_id."_".$answer_id."_".$i;
            include("./upload_article_file.php");

        }

    }

    @include_once("$dmshop_board_path/write_update.bottom.php");

    shop_url("./board.php?bbs_id={$bbs_id}&article_id={$answer_id}");

}

// 삭제
else if ($m == 'd') {

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

            shop_url("./board_password.php?m=article_delete&bbs_id={$bbs_id}&article_id={$article_id}");

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

        message("<p class='title'>알림</p><p class='text'>삭제할 권한이 없습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

    // 신디케이션
    if ($dmshop['syndi_type']) {

        syndi_create("./xml_syndi.xml", syndi_article($bbs_id, $article_id, "delete"));

    }

    @include_once("$dmshop_board_path/write_update.top.php");

    // 적립금 회수
    if ($dmshop_article['user_id']) {

        // 적립금 삭제
        shop_cash_delete($dmshop_article['user_id'], "", $bbs_id, $article_id, "bbs_write");

    }

    // 댓글 적립금 회수
    $result = sql_query(" select * from $shop[article_reply_table] where bbs_id = '".$bbs_id."' and article_id = '".$article_id."' order by reply_id asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        // 회원
        if ($row['user_id']) {

            // 적립금 삭제
            shop_cash_delete($row['user_id'], "", $bbs_id, $article_id, $row['id']);

        }

    }

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[article_file_table] where INSTR(upload_mode, 'af_".$bbs_id."_".$article_id."_') ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/article/".$bbs_id."/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[article_file_table] where INSTR(upload_mode, 'af_".$bbs_id."_".$article_id."_') ");

    // 답변글이라면
    if ($dmshop_article['id'] != $dmshop_article['ar_id']) {

        // 원글 업데이트
        sql_query(" update {$shop['article_table']}{$bbs_id} set ar_count = ar_count - 1 where id = '".$article_id."' ");

    }

    // 게시물 삭제
    sql_query(" delete from {$shop['article_table']}{$bbs_id} where id = '".$article_id."' ");

    // 댓글 삭제
    sql_query(" delete from $shop[article_reply_table] where bbs_id = '".$bbs_id."' and article_id = '".$article_id."' ");

    // 공지체크
    $bbs_notice = 0;
    $chk = sql_fetch(" select ar_notice from {$shop['article_table']}{$bbs_id} where ar_notice = '1' ");
    if ($chk['ar_notice']) { $bbs_notice = 1; }

    // 카운트 감소
    sql_query(" update $shop[board_table] set bbs_write_count = bbs_write_count - 1, bbs_reply_count = bbs_reply_count - ".(int)($dmshop_article['ar_reply']).", bbs_notice = '".$bbs_notice."' where bbs_id = '".$bbs_id."' ");

    @include_once("$dmshop_board_path/write_update.bottom.php");

    shop_url("./board.php?bbs_id={$bbs_id}");

}

// 선택삭제
else if ($m == 'check_delete') {

    if (!$shop_user_admin) {

        message("<p class='title'>알림</p><p class='text'>삭제할 권한이 없습니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

    }

    @include_once("$dmshop_board_path/write_update.top.php");

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        if ($bbs_id && $chk_article_id[$k]) {

            $dmshop_article = shop_article($bbs_id, $chk_article_id[$k]);

            if ($dmshop_article['id']) {

                // 적립금 회수
                if ($dmshop_article['user_id']) {

                    // 적립금 삭제
                    shop_cash_delete($dmshop_article['user_id'], "", $bbs_id, $chk_article_id[$k], "bbs_write");

                }

                // 댓글 적립금 회수
                $result = sql_query(" select * from $shop[article_reply_table] where bbs_id = '".$bbs_id."' and article_id = '".$chk_article_id[$k]."' order by reply_id asc ");
                for ($n=0; $row=sql_fetch_array($result); $n++) {

                    // 회원
                    if ($row['user_id']) {

                        // 적립금 삭제
                        shop_cash_delete($row['user_id'], "", $bbs_id, $chk_article_id[$k], $row['id']);

                    }

                }

                // 첨부파일 삭제
                $result = sql_query(" select datetime, upload_file from $shop[article_file_table] where INSTR(upload_mode, 'af_".$bbs_id."_".$chk_article_id[$k]."_') ");
                for ($n=0; $file=sql_fetch_array($result); $n++) {

                    // 원본
                    $file_path = $shop['path']."/data/article/".$bbs_id."/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

                    // 첨부파일 삭제
                    @unlink($file_path);

                }

                // 파일 삭제
                sql_query(" delete from $shop[article_file_table] where INSTR(upload_mode, 'af_".$bbs_id."_".$chk_article_id[$k]."_') ");

                // 답변글이라면
                if ($dmshop_article['id'] != $dmshop_article['ar_id']) {

                    // 원글 업데이트
                    sql_query(" update {$shop['article_table']}{$bbs_id} set ar_count = ar_count - 1 where id = '".$chk_article_id[$k]."' ");

                }

                // 게시물 삭제
                sql_query(" delete from {$shop['article_table']}{$bbs_id} where id = '".$chk_article_id[$k]."' ");

                // 댓글 삭제
                sql_query(" delete from $shop[article_reply_table] where bbs_id = '".$bbs_id."' and article_id = '".$chk_article_id[$k]."' ");

                // 카운트 감소
                sql_query(" update $shop[board_table] set bbs_write_count = bbs_write_count - 1, bbs_reply_count = bbs_reply_count - ".(int)($dmshop_article['ar_reply'])." where bbs_id = '".$bbs_id."' ");

            }

        }

    }

    // 공지체크
    $bbs_notice = 0;
    $chk = sql_fetch(" select ar_notice from {$shop['article_table']}{$bbs_id} where ar_notice = '1' ");
    if ($chk['ar_notice']) { $bbs_notice = 1; }

    // 공지 업데이트
    sql_query(" update $shop[board_table] set bbs_notice = '".$bbs_notice."' where bbs_id = '".$bbs_id."' ");

    @include_once("$dmshop_board_path/write_update.bottom.php");

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", "./board.php?bbs_id={$bbs_id}");

}
?>