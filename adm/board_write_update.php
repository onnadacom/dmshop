<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if (!$bbs_id) {

    alert("게시판 아이디가 입력되지 않았습니다.");

}

if ($bbs_id == 'file' || $bbs_id == 'reply' || $bbs_id == 'good' || $bbs_id == 'down') {

    alert("사용할 수 없는 게시판 아이디입니다.");

}

// br 태그제거
if ($bbs_write_text == '<br>' || $bbs_write_text == '<br />') { $bbs_write_text = ""; }
if ($bbs_text_top == '<br>' || $bbs_text_top == '<br />') { $bbs_text_top = ""; }
if ($bbs_text_bottom == '<br>' || $bbs_text_bottom == '<br />') { $bbs_text_bottom = ""; }

// insert
if ($m == '') {

    // 게시판
    $dmshop_board = shop_board($bbs_id);

    if ($dmshop_board['bbs_id']) {

        alert("이미 존재하는 게시판 아이디입니다.");

    }

    // 일괄적용
    if ($check_all) {

        $sql_common = "";
        $sql_common .= " set bbs_skin = '".trim(strip_tags(mysql_real_escape_string($bbs_skin)))."' ";
        $sql_common .= ", bbs_order = '".trim(strip_tags(mysql_real_escape_string($bbs_order)))."' ";
        $sql_common .= ", bbs_sub_len = '".trim(strip_tags(mysql_real_escape_string($bbs_sub_len)))."' ";
        $sql_common .= ", bbs_new_time = '".trim(strip_tags(mysql_real_escape_string($bbs_new_time)))."' ";
        $sql_common .= ", bbs_hit_time = '".trim(strip_tags(mysql_real_escape_string($bbs_hit_time)))."' ";
        $sql_common .= ", bbs_rows = '".trim(strip_tags(mysql_real_escape_string($bbs_rows)))."' ";
        $sql_common .= ", bbs_gallery = '".trim(strip_tags(mysql_real_escape_string($bbs_gallery)))."' ";
        $sql_common .= ", bbs_thumb_width = '".trim(strip_tags(mysql_real_escape_string($bbs_thumb_width)))."' ";
        $sql_common .= ", bbs_thumb_height = '".trim(strip_tags(mysql_real_escape_string($bbs_thumb_height)))."' ";
        $sql_common .= ", bbs_view_image = '".trim(strip_tags(mysql_real_escape_string($bbs_view_image)))."' ";
        $sql_common .= ", bbs_view_list = '".trim(strip_tags(mysql_real_escape_string($bbs_view_list)))."' ";
        $sql_common .= ", bbs_name = '".trim(strip_tags(mysql_real_escape_string($bbs_name)))."' ";
        $sql_common .= ", bbs_privacy = '".trim(strip_tags(mysql_real_escape_string($bbs_privacy)))."' ";
        $sql_common .= ", bbs_reply_write = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_write)))."' ";
        $sql_common .= ", bbs_secret = '".trim(strip_tags(mysql_real_escape_string($bbs_secret)))."' ";

        // 업데이트
        sql_query(" update $shop[board_table] $sql_common ");

    }

    // 일괄적용 2
    if ($check_all2) {

        $sql_common = "";
        $sql_common .= " set bbs_list_level = '".trim(strip_tags(mysql_real_escape_string($bbs_list_level)))."' ";
        $sql_common .= ", bbs_read_level = '".trim(strip_tags(mysql_real_escape_string($bbs_read_level)))."' ";
        $sql_common .= ", bbs_write_level = '".trim(strip_tags(mysql_real_escape_string($bbs_write_level)))."' ";
        $sql_common .= ", bbs_answer_level = '".trim(strip_tags(mysql_real_escape_string($bbs_answer_level)))."' ";
        $sql_common .= ", bbs_reply_level = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_level)))."' ";
        $sql_common .= ", bbs_download_level = '".trim(strip_tags(mysql_real_escape_string($bbs_download_level)))."' ";
        $sql_common .= ", bbs_file_limit = '".trim(strip_tags(mysql_real_escape_string($bbs_file_limit)))."' ";
        $sql_common .= ", bbs_file_size = '".trim(strip_tags(mysql_real_escape_string($bbs_file_size)))."' ";
        $sql_common .= ", bbs_write_cash = '".trim(strip_tags(mysql_real_escape_string($bbs_write_cash)))."' ";
        $sql_common .= ", bbs_reply_cash = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_cash)))."' ";
        $sql_common .= ", bbs_write_text = '".trim(mysql_real_escape_string($bbs_write_text))."' ";

        // 업데이트
        sql_query(" update $shop[board_table] $sql_common ");

    }

    // 개별적용
    $sql_common = "";
    $sql_common .= " set bbs_id = '".$bbs_id."' ";
    $sql_common .= ", bbs_title = '".trim(strip_tags(mysql_real_escape_string($bbs_title)))."' ";
    $sql_common .= ", bbs_position = '".trim(strip_tags(mysql_real_escape_string($bbs_position)))."' ";
    $sql_common .= ", bbs_view = '".trim(strip_tags(mysql_real_escape_string($bbs_view)))."' ";
    $sql_common .= ", bbs_category = '".trim(strip_tags(mysql_real_escape_string($_POST['bbs_category'])))."' ";
    $sql_common .= ", bbs_category_use = '".trim(strip_tags(mysql_real_escape_string($bbs_category_use)))."' ";
    $sql_common .= ", bbs_skin = '".trim(strip_tags(mysql_real_escape_string($bbs_skin)))."' ";
    $sql_common .= ", bbs_order = '".trim(strip_tags(mysql_real_escape_string($bbs_order)))."' ";
    $sql_common .= ", bbs_sub_len = '".trim(strip_tags(mysql_real_escape_string($bbs_sub_len)))."' ";
    $sql_common .= ", bbs_new_time = '".trim(strip_tags(mysql_real_escape_string($bbs_new_time)))."' ";
    $sql_common .= ", bbs_hit_time = '".trim(strip_tags(mysql_real_escape_string($bbs_hit_time)))."' ";
    $sql_common .= ", bbs_rows = '".trim(strip_tags(mysql_real_escape_string($bbs_rows)))."' ";
    $sql_common .= ", bbs_gallery = '".trim(strip_tags(mysql_real_escape_string($bbs_gallery)))."' ";
    $sql_common .= ", bbs_thumb_width = '".trim(strip_tags(mysql_real_escape_string($bbs_thumb_width)))."' ";
    $sql_common .= ", bbs_thumb_height = '".trim(strip_tags(mysql_real_escape_string($bbs_thumb_height)))."' ";
    $sql_common .= ", bbs_view_image = '".trim(strip_tags(mysql_real_escape_string($bbs_view_image)))."' ";
    $sql_common .= ", bbs_view_list = '".trim(strip_tags(mysql_real_escape_string($bbs_view_list)))."' ";
    $sql_common .= ", bbs_name = '".trim(strip_tags(mysql_real_escape_string($bbs_name)))."' ";
    $sql_common .= ", bbs_privacy = '".trim(strip_tags(mysql_real_escape_string($bbs_privacy)))."' ";
    $sql_common .= ", bbs_reply_write = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_write)))."' ";
    $sql_common .= ", bbs_secret = '".trim(strip_tags(mysql_real_escape_string($bbs_secret)))."' ";
    $sql_common .= ", bbs_list_level = '".trim(strip_tags(mysql_real_escape_string($bbs_list_level)))."' ";
    $sql_common .= ", bbs_read_level = '".trim(strip_tags(mysql_real_escape_string($bbs_read_level)))."' ";
    $sql_common .= ", bbs_write_level = '".trim(strip_tags(mysql_real_escape_string($bbs_write_level)))."' ";
    $sql_common .= ", bbs_answer_level = '".trim(strip_tags(mysql_real_escape_string($bbs_answer_level)))."' ";
    $sql_common .= ", bbs_reply_level = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_level)))."' ";
    $sql_common .= ", bbs_download_level = '".trim(strip_tags(mysql_real_escape_string($bbs_download_level)))."' ";
    $sql_common .= ", bbs_file_limit = '".trim(strip_tags(mysql_real_escape_string($bbs_file_limit)))."' ";
    $sql_common .= ", bbs_file_size = '".trim(strip_tags(mysql_real_escape_string($bbs_file_size)))."' ";
    $sql_common .= ", bbs_write_cash = '".trim(strip_tags(mysql_real_escape_string($bbs_write_cash)))."' ";
    $sql_common .= ", bbs_reply_cash = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_cash)))."' ";
    $sql_common .= ", bbs_write_text = '".trim(mysql_real_escape_string($bbs_write_text))."' ";
    $sql_common .= ", bbs_text_top = '".trim(mysql_real_escape_string($bbs_text_top))."' ";
    $sql_common .= ", bbs_text_bottom = '".trim(strip_tags(mysql_real_escape_string($bbs_text_bottom)))."' ";
    $sql_common .= ", bbs_include_top = '".trim(strip_tags(mysql_real_escape_string($bbs_include_top)))."' ";
    $sql_common .= ", bbs_include_bottom = '".trim(strip_tags(mysql_real_escape_string($bbs_include_bottom)))."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 등록
    sql_query(" insert into $shop[board_table] $sql_common ");

    // 파일경로
    $dir = $shop['path']."/data/article/".$bbs_id;

    // 게시판 폴더 생성
    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

/*--------------------------------
    ## 게시판 생성 ##
--------------------------------*/

$sql = " CREATE TABLE {$shop['article_table']}{$bbs_id} (
  `id` int(11) NOT NULL auto_increment,
  `ar_id` int(11) NOT NULL default '0' COMMENT '원본아이디',
  `ar_count` int(11) NOT NULL default '0' COMMENT '답변수',
  `user_id` varchar(50) NOT NULL COMMENT '회원아이디',
  `ar_name` varchar(50) NOT NULL COMMENT '작성자',
  `ar_email` varchar(255) NOT NULL COMMENT '이메일',
  `ar_homepage` varchar(255) NOT NULL COMMENT '홈페이지',
  `ar_password` varchar(50) NOT NULL COMMENT '패스워드',
  `ar_notice` tinyint(4) NOT NULL default '0' COMMENT '공지사항',
  `ar_secret` tinyint(4) NOT NULL default '0' COMMENT '비밀글',
  `ar_category` varchar(255) NOT NULL COMMENT '분류',
  `ar_title` varchar(255) NOT NULL COMMENT '제목',
  `ar_content` longtext NOT NULL COMMENT '내용',
  `ar_ip` varchar(20) NOT NULL COMMENT '아이피',
  `ar_hit` int(11) NOT NULL default '0' COMMENT '조회수',
  `ar_reply` int(11) NOT NULL default '0' COMMENT '댓글수',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT '작성일',
  PRIMARY KEY (`id`),
  KEY `index_notice` (`ar_notice`),
  KEY `index_list` (`datetime`),
  KEY `index_reply` (`ar_id`,`id`),
  KEY `index_user` (`user_id`,`datetime`)
) DEFAULT CHARSET=utf8 ";
sql_query($sql, false);

}

// update
else if ($m == 'u') {

    // 게시판
    $dmshop_board = shop_board($bbs_id);

    if (!$dmshop_board['bbs_id']) {

        alert("게시판이 삭제되었거나 존재하지 않습니다.");

    }

    // 일괄적용
    if ($check_all) {

        $sql_common = "";
        $sql_common .= " set bbs_skin = '".trim(strip_tags(mysql_real_escape_string($bbs_skin)))."' ";
        $sql_common .= ", bbs_order = '".trim(strip_tags(mysql_real_escape_string($bbs_order)))."' ";
        $sql_common .= ", bbs_sub_len = '".trim(strip_tags(mysql_real_escape_string($bbs_sub_len)))."' ";
        $sql_common .= ", bbs_new_time = '".trim(strip_tags(mysql_real_escape_string($bbs_new_time)))."' ";
        $sql_common .= ", bbs_hit_time = '".trim(strip_tags(mysql_real_escape_string($bbs_hit_time)))."' ";
        $sql_common .= ", bbs_rows = '".trim(strip_tags(mysql_real_escape_string($bbs_rows)))."' ";
        $sql_common .= ", bbs_gallery = '".trim(strip_tags(mysql_real_escape_string($bbs_gallery)))."' ";
        $sql_common .= ", bbs_thumb_width = '".trim(strip_tags(mysql_real_escape_string($bbs_thumb_width)))."' ";
        $sql_common .= ", bbs_thumb_height = '".trim(strip_tags(mysql_real_escape_string($bbs_thumb_height)))."' ";
        $sql_common .= ", bbs_view_image = '".trim(strip_tags(mysql_real_escape_string($bbs_view_image)))."' ";
        $sql_common .= ", bbs_view_list = '".trim(strip_tags(mysql_real_escape_string($bbs_view_list)))."' ";
        $sql_common .= ", bbs_name = '".trim(strip_tags(mysql_real_escape_string($bbs_name)))."' ";
        $sql_common .= ", bbs_privacy = '".trim(strip_tags(mysql_real_escape_string($bbs_privacy)))."' ";
        $sql_common .= ", bbs_reply_write = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_write)))."' ";
        $sql_common .= ", bbs_secret = '".trim(strip_tags(mysql_real_escape_string($bbs_secret)))."' ";

        // update
        sql_query(" update $shop[board_table] $sql_common ");

    }

    // 일괄적용 2
    if ($check_all2) {

        $sql_common = "";
        $sql_common .= " set bbs_list_level = '".trim(strip_tags(mysql_real_escape_string($bbs_list_level)))."' ";
        $sql_common .= ", bbs_read_level = '".trim(strip_tags(mysql_real_escape_string($bbs_read_level)))."' ";
        $sql_common .= ", bbs_write_level = '".trim(strip_tags(mysql_real_escape_string($bbs_write_level)))."' ";
        $sql_common .= ", bbs_answer_level = '".trim(strip_tags(mysql_real_escape_string($bbs_answer_level)))."' ";
        $sql_common .= ", bbs_reply_level = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_level)))."' ";
        $sql_common .= ", bbs_download_level = '".trim(strip_tags(mysql_real_escape_string($bbs_download_level)))."' ";
        $sql_common .= ", bbs_file_limit = '".trim(strip_tags(mysql_real_escape_string($bbs_file_limit)))."' ";
        $sql_common .= ", bbs_file_size = '".trim(strip_tags(mysql_real_escape_string($bbs_file_size)))."' ";
        $sql_common .= ", bbs_write_cash = '".trim(strip_tags(mysql_real_escape_string($bbs_write_cash)))."' ";
        $sql_common .= ", bbs_reply_cash = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_cash)))."' ";
        $sql_common .= ", bbs_write_text = '".trim(mysql_real_escape_string($bbs_write_text))."' ";

        // update
        sql_query(" update $shop[board_table] $sql_common ");

    }

    // 개별적용
    $sql_common = "";
    $sql_common .= " set bbs_title = '".trim(strip_tags(mysql_real_escape_string($bbs_title)))."' ";
    $sql_common .= ", bbs_position = '".trim(strip_tags(mysql_real_escape_string($bbs_position)))."' ";
    $sql_common .= ", bbs_view = '".trim(strip_tags(mysql_real_escape_string($bbs_view)))."' ";
    $sql_common .= ", bbs_category = '".trim(strip_tags(mysql_real_escape_string($_POST['bbs_category'])))."' ";
    $sql_common .= ", bbs_category_use = '".trim(strip_tags(mysql_real_escape_string($bbs_category_use)))."' ";
    $sql_common .= ", bbs_skin = '".trim(strip_tags(mysql_real_escape_string($bbs_skin)))."' ";
    $sql_common .= ", bbs_order = '".trim(strip_tags(mysql_real_escape_string($bbs_order)))."' ";
    $sql_common .= ", bbs_sub_len = '".trim(strip_tags(mysql_real_escape_string($bbs_sub_len)))."' ";
    $sql_common .= ", bbs_new_time = '".trim(strip_tags(mysql_real_escape_string($bbs_new_time)))."' ";
    $sql_common .= ", bbs_hit_time = '".trim(strip_tags(mysql_real_escape_string($bbs_hit_time)))."' ";
    $sql_common .= ", bbs_rows = '".trim(strip_tags(mysql_real_escape_string($bbs_rows)))."' ";
    $sql_common .= ", bbs_gallery = '".trim(strip_tags(mysql_real_escape_string($bbs_gallery)))."' ";
    $sql_common .= ", bbs_thumb_width = '".trim(strip_tags(mysql_real_escape_string($bbs_thumb_width)))."' ";
    $sql_common .= ", bbs_thumb_height = '".trim(strip_tags(mysql_real_escape_string($bbs_thumb_height)))."' ";
    $sql_common .= ", bbs_view_image = '".trim(strip_tags(mysql_real_escape_string($bbs_view_image)))."' ";
    $sql_common .= ", bbs_view_list = '".trim(strip_tags(mysql_real_escape_string($bbs_view_list)))."' ";
    $sql_common .= ", bbs_name = '".trim(strip_tags(mysql_real_escape_string($bbs_name)))."' ";
    $sql_common .= ", bbs_privacy = '".trim(strip_tags(mysql_real_escape_string($bbs_privacy)))."' ";
    $sql_common .= ", bbs_reply_write = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_write)))."' ";
    $sql_common .= ", bbs_secret = '".trim(strip_tags(mysql_real_escape_string($bbs_secret)))."' ";
    $sql_common .= ", bbs_list_level = '".trim(strip_tags(mysql_real_escape_string($bbs_list_level)))."' ";
    $sql_common .= ", bbs_read_level = '".trim(strip_tags(mysql_real_escape_string($bbs_read_level)))."' ";
    $sql_common .= ", bbs_write_level = '".trim(strip_tags(mysql_real_escape_string($bbs_write_level)))."' ";
    $sql_common .= ", bbs_answer_level = '".trim(strip_tags(mysql_real_escape_string($bbs_answer_level)))."' ";
    $sql_common .= ", bbs_reply_level = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_level)))."' ";
    $sql_common .= ", bbs_download_level = '".trim(strip_tags(mysql_real_escape_string($bbs_download_level)))."' ";
    $sql_common .= ", bbs_file_limit = '".trim(strip_tags(mysql_real_escape_string($bbs_file_limit)))."' ";
    $sql_common .= ", bbs_file_size = '".trim(strip_tags(mysql_real_escape_string($bbs_file_size)))."' ";
    $sql_common .= ", bbs_write_cash = '".trim(strip_tags(mysql_real_escape_string($bbs_write_cash)))."' ";
    $sql_common .= ", bbs_reply_cash = '".trim(strip_tags(mysql_real_escape_string($bbs_reply_cash)))."' ";
    $sql_common .= ", bbs_write_text = '".trim(mysql_real_escape_string($bbs_write_text))."' ";
    $sql_common .= ", bbs_text_top = '".trim(mysql_real_escape_string($bbs_text_top))."' ";
    $sql_common .= ", bbs_text_bottom = '".trim(mysql_real_escape_string($bbs_text_bottom))."' ";
    $sql_common .= ", bbs_include_top = '".trim(strip_tags(mysql_real_escape_string($bbs_include_top)))."' ";
    $sql_common .= ", bbs_include_bottom = '".trim(strip_tags(mysql_real_escape_string($bbs_include_bottom)))."' ";

    // update
    sql_query(" update $shop[board_table] $sql_common where bbs_id = '".$bbs_id."' ");

    // 가로메뉴 업데이트
    sql_query(" update $shop[design_wmlist_table] set title = '".trim(strip_tags(mysql_real_escape_string($bbs_title)))."' where menu_type = 'board' and menu_id = '".$bbs_id."' ");

    // 세로메뉴 업데이트
    sql_query(" update $shop[design_hmlist_table] set title = '".trim(strip_tags(mysql_real_escape_string($bbs_title)))."' where menu_type = 'board' and menu_id = '".$bbs_id."' ");

}

// delete
else if ($m == 'd') {

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[design_file_table] where upload_mode in ('board_top_".$bbs_id."','board_bottom_".$bbs_id."') ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[design_file_table] where upload_mode in ('board_top_".$bbs_id."','board_bottom_".$bbs_id."') ");

    // 게시판 삭제
    sql_query(" delete from $shop[board_table] where bbs_id = '".$bbs_id."' ");

    // 게시판 drop
    sql_query(" drop table {$shop['article_table']}{$bbs_id} ", false);

    // 게시판 폴더 삭제
    shop_delete("{$shop['path']}/data/article/{$bbs_id}");

    // 파일 삭제
    sql_query(" delete from $shop[article_file_table] where INSTR(upload_mode, 'af_".$bbs_id."_') ");

    // 댓글 삭제
    sql_query(" delete from $shop[article_reply_table] where bbs_id = '".$bbs_id."' ");

    // 가로메뉴 삭제
    sql_query(" delete from $shop[design_wmlist_table] where menu_type = 'board' and menu_id = '".$bbs_id."' ");

    // 세로메뉴 삭제
    sql_query(" delete from $shop[design_hmlist_table] where menu_type = 'board' and menu_id = '".$bbs_id."' ");

       // 메인중앙 게시판 초기화
    sql_query(" update $shop[display_box_list_table] set board = '0' where board = '".$bbs_id."' ");

    // 디자인TOP 게시판 초기화
    sql_query(" update $shop[design_top_table] set top_article = '' where top_article = '".$bbs_id."' ");

    // 디자인MENU 게시판 초기화
    sql_query(" update $shop[design_menu_table] set menu_article = '' where menu_article = '".$bbs_id."' ");

} else {

    alert("게시판이 삭제되었거나 존재하지 않습니다.");

}

// insert, update
if ($m == '' || $m == 'u') {

    // 파일경로
    $dir = $shop['path']."/data/design/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // 상단
    $upload_name = "top";
    $upload_mode = "board_top_".$bbs_id;
    include("./upload_board_file.php");

    // 하단
    $upload_name = "bottom";
    $upload_mode = "board_bottom_".$bbs_id;
    include("./upload_board_file.php");

}

// 신규 등록
if ($m == '') {

    shop_url("./board_list.php");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>