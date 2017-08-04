<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

for ($i=0; $i<count($chk_id); $i++) {

    // 실제 번호를 넘김
    $k = $chk_id[$i];

    // update
    if ($m == 'u') {

        $sql_common = "";
        $sql_common .= " set bbs_position = '".addslashes($_POST['bbs_position'][$k])."' ";
        $sql_common .= ", bbs_view = '".addslashes($_POST['bbs_view'][$k])."' ";
        $sql_common .= ", bbs_title = '".addslashes($_POST['bbs_title'][$k])."' ";
        $sql_common .= ", bbs_skin = '".addslashes($_POST['bbs_skin'][$k])."' ";

        // 업데이트
        sql_query(" update $shop[board_table] $sql_common where bbs_id = '".addslashes($_POST['bbs_id'][$k])."' ");

        // 가로메뉴 업데이트
        sql_query(" update $shop[design_wmlist_table] set title = '".addslashes($_POST['subject'])."' where menu_type = 'board' and menu_id = '".addslashes($_POST['bbs_id'][$k])."' ");

        // 세로메뉴 업데이트
        sql_query(" update $shop[design_hmlist_table] set title = '".addslashes($_POST['subject'])."' where menu_type = 'board' and menu_id = '".addslashes($_POST['bbs_id'][$k])."' ");

    }

    // delete
    else if ($m == 'd') {

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[design_file_table] where upload_mode in ('board_top_".addslashes($_POST['bbs_id'][$k])."','board_bottom_".addslashes($_POST['bbs_id'][$k])."') ");
        for ($n=0; $file=sql_fetch_array($result); $n++) {

            // 원본
            $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 파일 삭제
        sql_query(" delete from $shop[design_file_table] where upload_mode in ('board_top_".addslashes($_POST['bbs_id'][$k])."','board_bottom_".addslashes($_POST['bbs_id'][$k])."') ");

        // 게시판 삭제
        sql_query(" delete from $shop[board_table] where bbs_id = '".addslashes($_POST['bbs_id'][$k])."' ");

        // 게시판 drop
        sql_query(" drop table ".$shop['article_table'].addslashes($_POST['bbs_id'][$k])." ", false);

        // 게시판 폴더 삭제
        shop_delete("{$shop['path']}/data/article/".addslashes($_POST['bbs_id'][$k])."");

        // 파일 삭제
        sql_query(" delete from $shop[article_file_table] where INSTR(upload_mode, 'af_".addslashes($_POST['bbs_id'][$k])."_') ");

        // 댓글 삭제
        sql_query(" delete from $shop[article_reply_table] where bbs_id = '".addslashes($_POST['bbs_id'][$k])."' ");

        // 가로메뉴 삭제
        sql_query(" delete from $shop[design_wmlist_table] where menu_type = 'board' and menu_id = '".addslashes($_POST['bbs_id'][$k])."' ");

        // 세로메뉴 삭제
        sql_query(" delete from $shop[design_hmlist_table] where menu_type = 'board' and menu_id = '".addslashes($_POST['bbs_id'][$k])."' ");

        // 메인중앙 게시판 초기화
        sql_query(" update $shop[display_box_list_table] set board = '0' where board = '".addslashes($_POST['bbs_id'][$k])."' ");

        // 디자인TOP 게시판 초기화
        sql_query(" update $shop[design_top_table] set top_article = '' where top_article = '".addslashes($_POST['bbs_id'][$k])."' ");

        // 디자인MENU 게시판 초기화
        sql_query(" update $shop[design_menu_table] set menu_article = '' where menu_article = '".addslashes($_POST['bbs_id'][$k])."' ");

    } else {

        // pass

    }

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>