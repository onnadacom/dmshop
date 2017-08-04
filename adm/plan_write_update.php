<?php
include_once("./_dmshop.php");
if ($plan_id) { $plan_id = preg_match("/^[0-9]+$/", $plan_id) ? $plan_id : ""; }

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// br 태그제거
if ($_POST['text_top'] == '<br>' || $_POST['text_top'] == '<br />') { $_POST['text_top'] = ""; }
if ($_POST['text_bottom'] == '<br>' || $_POST['text_bottom'] == '<br />') { $_POST['text_bottom'] = ""; }

// insert
if ($m == '') {

    // 일괄적용
    if ($_POST['check_all']) {

        $sql_common = "";
        $sql_common .= " set skin = '".addslashes($_POST['skin'])."' ";
        $sql_common .= ", item_width = '".addslashes($_POST['item_width'])."' ";
        $sql_common .= ", item_height = '".addslashes($_POST['item_height'])."' ";
        $sql_common .= ", thumb_use = '".addslashes($_POST['thumb_use'])."' ";
        $sql_common .= ", thumb_width = '".addslashes($_POST['thumb_width'])."' ";
        $sql_common .= ", thumb_height = '".addslashes($_POST['thumb_height'])."' ";

        // 업데이트
        sql_query(" update $shop[plan_table] $sql_common ");

    }

    // 개별적용
    $sql_common = "";
    $sql_common .= " set title = '".addslashes($_POST['title'])."' ";
    $sql_common .= ", position = '".addslashes($_POST['position'])."' ";
    $sql_common .= ", date1 = '".addslashes($_POST['date1'])."' ";
    $sql_common .= ", date2 = '".addslashes($_POST['date2'])."' ";
    $sql_common .= ", view = '".addslashes($_POST['view'])."' ";
    $sql_common .= ", skin = '".addslashes($_POST['skin'])."' ";
    $sql_common .= ", item_width = '".addslashes($_POST['item_width'])."' ";
    $sql_common .= ", item_height = '".addslashes($_POST['item_height'])."' ";
    $sql_common .= ", thumb_use = '".addslashes($_POST['thumb_use'])."' ";
    $sql_common .= ", thumb_width = '".addslashes($_POST['thumb_width'])."' ";
    $sql_common .= ", thumb_height = '".addslashes($_POST['thumb_height'])."' ";
    $sql_common .= ", text_top = '".addslashes($_POST['text_top'])."' ";
    $sql_common .= ", text_bottom = '".addslashes($_POST['text_bottom'])."' ";
    $sql_common .= ", include_top = '".addslashes($_POST['include_top'])."' ";
    $sql_common .= ", include_bottom = '".addslashes($_POST['include_bottom'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 등록
    sql_query(" insert into $shop[plan_table] $sql_common ");

    $plan_id = mysql_insert_id();

}

// update
else if ($m == 'u') {

    if (!$_POST['plan_id']) {

        alert("기획전이 삭제되었거나 존재하지 않습니다.");

    }

    // 기획전
    $dmshop_plan = shop_plan(addslashes($_POST['plan_id']));

    if (!$dmshop_plan['id']) {

        alert("기획전이 삭제되었거나 존재하지 않습니다.");

    }

    // 일괄적용
    if ($_POST['check_all']) {

        $sql_common = "";
        $sql_common .= " set skin = '".addslashes($_POST['skin'])."' ";
        $sql_common .= ", item_width = '".addslashes($_POST['item_width'])."' ";
        $sql_common .= ", item_height = '".addslashes($_POST['item_height'])."' ";
        $sql_common .= ", thumb_use = '".addslashes($_POST['thumb_use'])."' ";
        $sql_common .= ", thumb_width = '".addslashes($_POST['thumb_width'])."' ";
        $sql_common .= ", thumb_height = '".addslashes($_POST['thumb_height'])."' ";

        // 업데이트
        sql_query(" update $shop[plan_table] $sql_common ");

    }

    // 개별적용
    $sql_common = "";
    $sql_common .= " set title = '".addslashes($_POST['title'])."' ";
    $sql_common .= ", position = '".addslashes($_POST['position'])."' ";
    $sql_common .= ", date1 = '".addslashes($_POST['date1'])."' ";
    $sql_common .= ", date2 = '".addslashes($_POST['date2'])."' ";
    $sql_common .= ", view = '".addslashes($_POST['view'])."' ";
    $sql_common .= ", skin = '".addslashes($_POST['skin'])."' ";
    $sql_common .= ", item_width = '".addslashes($_POST['item_width'])."' ";
    $sql_common .= ", item_height = '".addslashes($_POST['item_height'])."' ";
    $sql_common .= ", thumb_use = '".addslashes($_POST['thumb_use'])."' ";
    $sql_common .= ", thumb_width = '".addslashes($_POST['thumb_width'])."' ";
    $sql_common .= ", thumb_height = '".addslashes($_POST['thumb_height'])."' ";
    $sql_common .= ", text_top = '".addslashes($_POST['text_top'])."' ";
    $sql_common .= ", text_bottom = '".addslashes($_POST['text_bottom'])."' ";
    $sql_common .= ", include_top = '".addslashes($_POST['include_top'])."' ";
    $sql_common .= ", include_bottom = '".addslashes($_POST['include_bottom'])."' ";

    // 수정
    sql_query(" update $shop[plan_table] $sql_common where id = '".addslashes($_POST['plan_id'])."' ");

}

// delete
else if ($m == 'd') {

    /*--------------------------------
        ## 기획전 ##
    --------------------------------*/

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[design_file_table] where upload_mode in ('plan_top_".addslashes($_POST['plan_id'])."','plan_bottom_".addslashes($_POST['plan_id'])."') ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[design_file_table] where upload_mode in ('plan_top_".addslashes($_POST['plan_id'])."','plan_bottom_".addslashes($_POST['plan_id'])."') ");

    // 기획전 삭제
    sql_query(" delete from $shop[plan_table] where id = '".addslashes($_POST['plan_id'])."' ");

    /*--------------------------------
        ## 기획전 상품 ##
    --------------------------------*/

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[item_file_table] where upload_mode = 'plan".addslashes($_POST['plan_id'])."' ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/item/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[item_file_table] where upload_mode = 'plan".addslashes($_POST['plan_id'])."' ");

    // 기획전 상품 삭제
    sql_query(" delete from $shop[plan_item_table] where plan_id = '".addslashes($_POST['plan_id'])."' ");

    // 메인중앙 기획전 초기화
    sql_query(" update $shop[display_box_list_table] set plan = '0' where plan = '".addslashes($_POST['plan_id'])."' ");

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
    $upload_mode = "plan_top_".$plan_id;
    include("./upload_design_file.php");

    // 하단
    $upload_mode = "plan_bottom_".$plan_id;
    include("./upload_design_file.php");

    /*--------------------------------
        ## 상품 아이콘 ##
    --------------------------------*/

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
    if ($_POST['check_all']) {

        $sql_search = " ";

    } else {

        $sql_search = " where id = '".$plan_id."' ";

    }

    if ($tmp_icon_id_add) {

        $tmp_icon_id_add = $tmp_icon_id_add."|";

        // 수정
        sql_query(" update $shop[plan_table] set item_icon = '".$tmp_icon_id_add."' $sql_search ");

    } else {

        // 수정
        sql_query(" update $shop[plan_table] set item_icon = '' $sql_search ");

    }

}

// 신규 등록
if ($m == '') {

    shop_url("./plan_list.php");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>