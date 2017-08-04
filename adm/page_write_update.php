<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if (!$page_id) {

    alert("페이지 아이디가 입력되지 않았습니다.");

}

// br 태그제거
if ($_POST['page_text_content'] == '<br>') { $_POST['page_text_content'] = ""; }
if ($_POST['page_text_top'] == '<br>') { $_POST['page_text_top'] = ""; }
if ($_POST['page_text_bottom'] == '<br>') { $_POST['page_text_bottom'] = ""; }

// insert
if ($m == '') {

    // 페이지
    $dmshop_page = shop_page($page_id);

    if ($dmshop_page['page_id']) {

        alert("이미 존재하는 페이지 아이디입니다.");

    }

    // 개별적용
    $sql_common = "";
    $sql_common .= " set page_id = '".$page_id."' ";
    $sql_common .= ", page_title = '".addslashes($_POST['page_title'])."' ";
    $sql_common .= ", page_position = '".addslashes($_POST['page_position'])."' ";
    $sql_common .= ", page_view = '".addslashes($_POST['page_view'])."' ";
    $sql_common .= ", page_text_content = '".addslashes($_POST['page_text_content'])."' ";
    $sql_common .= ", page_text_top = '".addslashes($_POST['page_text_top'])."' ";
    $sql_common .= ", page_text_bottom = '".addslashes($_POST['page_text_bottom'])."' ";
    $sql_common .= ", page_include_top = '".addslashes($_POST['page_include_top'])."' ";
    $sql_common .= ", page_include_bottom = '".addslashes($_POST['page_include_bottom'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 등록
    sql_query(" insert into $shop[page_table] $sql_common ");

}

// update
else if ($m == 'u') {

    // 페이지
    $dmshop_page = shop_page($page_id);

    if (!$dmshop_page['page_id']) {

        alert("페이지가 삭제되었거나 존재하지 않습니다.");

    }

    // 개별적용
    $sql_common = "";
    $sql_common .= " set page_title = '".addslashes($_POST['page_title'])."' ";
    $sql_common .= ", page_position = '".addslashes($_POST['page_position'])."' ";
    $sql_common .= ", page_view = '".addslashes($_POST['page_view'])."' ";
    $sql_common .= ", page_text_content = '".addslashes($_POST['page_text_content'])."' ";
    $sql_common .= ", page_text_top = '".addslashes($_POST['page_text_top'])."' ";
    $sql_common .= ", page_text_bottom = '".addslashes($_POST['page_text_bottom'])."' ";
    $sql_common .= ", page_include_top = '".addslashes($_POST['page_include_top'])."' ";
    $sql_common .= ", page_include_bottom = '".addslashes($_POST['page_include_bottom'])."' ";

    // 수정
    sql_query(" update $shop[page_table] $sql_common where page_id = '".$page_id."' ");

}

// delete
else if ($m == 'd') {

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[design_file_table] where upload_mode in ('page_top_".$page_id."','page_bottom_".$page_id."') ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[design_file_table] where upload_mode in ('page_top_".$page_id."','page_bottom_".$page_id."') ");

    // 페이지 삭제
    sql_query(" delete from $shop[page_table] where page_id = '".$page_id."' ");

} else {

    alert("페이지가 삭제되었거나 존재하지 않습니다.");

}

// insert, update
if ($m == '' || $m == 'u') {

    // 파일경로
    $dir = $shop['path']."/data/design/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // 상단
    $upload_name = "top";
    $upload_mode = "page_top_".$page_id;
    include("./upload_page_file.php");

    // 하단
    $upload_name = "bottom";
    $upload_mode = "page_bottom_".$page_id;
    include("./upload_page_file.php");

}

// 신규 등록
if ($m == '') {

    shop_url("./page_list.php");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>