<?php
include_once("./_dmshop.php");
if ($id) { $id = preg_match("/^[0-9]+$/", $id) ? $id : ""; }

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if (!$id) {

    alert("분류가 삭제되었거나 존재하지 않습니다.");

}

// 카테고리
$dmshop_category = shop_category($id);

if (!$dmshop_category['id']) {

    alert("분류가 삭제되었거나 존재하지 않습니다.");

}

// update
if ($m == '') {

    // 일괄적용
    if ($check_all) {

        $sql_common = "";
        $sql_common .= " set skin = '".addslashes($_POST['skin'])."' ";
        $sql_common .= ", item_width = '".addslashes($_POST['item_width'])."' ";
        $sql_common .= ", item_height = '".addslashes($_POST['item_height'])."' ";
        $sql_common .= ", thumb_use = '".addslashes($_POST['thumb_use'])."' ";
        $sql_common .= ", thumb_width = '".addslashes($_POST['thumb_width'])."' ";
        $sql_common .= ", thumb_height = '".addslashes($_POST['thumb_height'])."' ";

        // 업데이트
        sql_query(" update $shop[category_table] $sql_common ");

    }

    // br 태그제거
    if ($text_top == '<br>' || $text_top == '<br />') {

        $text_top = "";

    }

    if ($text_bottom == '<br>' || $text_bottom == '<br />') {

        $text_bottom = "";

    }

    // 개별적용
    $sql_common = "";
    $sql_common .= " set view = '".addslashes($_POST['view'])."' ";
    $sql_common .= ", subject = '".addslashes($_POST['subject'])."' ";
    $sql_common .= ", skin = '".addslashes($_POST['skin'])."' ";
    $sql_common .= ", item_width = '".addslashes($_POST['item_width'])."' ";
    $sql_common .= ", item_height = '".addslashes($_POST['item_height'])."' ";
    $sql_common .= ", thumb_use = '".addslashes($_POST['thumb_use'])."' ";
    $sql_common .= ", thumb_width = '".addslashes($_POST['thumb_width'])."' ";
    $sql_common .= ", thumb_height = '".addslashes($_POST['thumb_height'])."' ";
    $sql_common .= ", text_top = '".addslashes($text_top)."' ";
    $sql_common .= ", text_bottom = '".addslashes($text_bottom)."' ";
    $sql_common .= ", include_top = '".addslashes($_POST['include_top'])."' ";
    $sql_common .= ", include_bottom = '".addslashes($_POST['include_bottom'])."' ";

    // 업데이트
    sql_query(" update $shop[category_table] $sql_common where id = '".$id."' ");

    // 가로메뉴 업데이트
    sql_query(" update $shop[design_wmlist_table] set title = '".addslashes($_POST['subject'])."' where menu_type = 'category' and menu_id = '".$id."' ");

    // 세로메뉴 업데이트
    sql_query(" update $shop[design_hmlist_table] set title = '".addslashes($_POST['subject'])."' where menu_type = 'category' and menu_id = '".$id."' ");

}

// delete
else if ($m == 'd') {

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[design_file_table] where upload_mode in ('category_top_".$id."','category_bottom_".$id."') ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[design_file_table] where upload_mode in ('category_top_".$id."','category_bottom_".$id."') ");

    // 분류 삭제
    sql_query(" delete from $shop[category_table] where id = '".$id."' ");

    // 가로메뉴 삭제
    sql_query(" delete from $shop[design_wmlist_table] where menu_type = 'category' and menu_id = '".$id."' ");

    // 세로메뉴 삭제
    sql_query(" delete from $shop[design_hmlist_table] where menu_type = 'category' and menu_id = '".$id."' ");

    // 메인중앙 분류 초기화
    sql_query(" update $shop[display_box_list_table] set category = '0' where category = '".$id."' ");

} else {

    alert("분류가 삭제되었거나 존재하지 않습니다.");

}

// insert, update
if ($m == '' || $m == 'u') {

    // 파일경로
    $dir = $shop['path']."/data/design/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // 상단
    $upload_mode = "category_top_".$id;
    include("./upload_design_file.php");

    // 하단
    $upload_mode = "category_bottom_".$id;
    include("./upload_design_file.php");

    /*------------------------------
        ## 상품 아이콘 ##
    ------------------------------*/

    $tmp_icon_id_add = "";

    // 아이콘 리스트
    $result = sql_query(" select * from $shop[icon_file_table] order by position desc, id asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $tmp_icon_id = $row['id'];

        // 등록
        if ($_POST['icon_insert'][$tmp_icon_id]) {

            $tmp_icon_id_add .= "|".$tmp_icon_id;

        }

    }

    // 일괄적용
    if ($check_all) {

        $sql_search = " ";

    } else {

        $sql_search = " where id = '".$id."' ";

    }

    if ($tmp_icon_id_add) {

        $tmp_icon_id_add = $tmp_icon_id_add."|";

        // 수정
        sql_query(" update $shop[category_table] set item_icon = '".$tmp_icon_id_add."' $sql_search ");

    } else {

        // 수정
        sql_query(" update $shop[category_table] set item_icon = '' $sql_search ");

    }

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>