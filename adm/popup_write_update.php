<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// br 태그제거
if ($_POST['pop_text'] == '<br>' || $_POST['pop_text'] == '<br />') { $_POST['pop_text'] = ""; }

// insert
if ($m == '') {

    $sql_common = "";
    $sql_common .= " set pop_title = '".addslashes($_POST['pop_title'])."' ";
    $sql_common .= ", pop_text = '".addslashes($_POST['pop_text'])."' ";
    $sql_common .= ", pop_view = '".addslashes($_POST['pop_view'])."' ";
    $sql_common .= ", pop_position = '".addslashes($_POST['pop_position'])."' ";
    $sql_common .= ", pop_start = '".addslashes($_POST['pop_start'])." ".addslashes($_POST['pop_start_h'])."-".addslashes($_POST['pop_start_i'])."-00' ";
    $sql_common .= ", pop_end = '".addslashes($_POST['pop_end'])." ".addslashes($_POST['pop_end_h'])."-".addslashes($_POST['pop_end_i'])."-00' ";
    $sql_common .= ", pop_width = '".addslashes($_POST['pop_width'])."' ";
    $sql_common .= ", pop_height = '".addslashes($_POST['pop_height'])."' ";
    $sql_common .= ", pop_left = '".addslashes($_POST['pop_left'])."' ";
    $sql_common .= ", pop_top = '".addslashes($_POST['pop_top'])."' ";
    $sql_common .= ", pop_url = '".addslashes($_POST['pop_url'])."' ";
    $sql_common .= ", pop_target = '".addslashes($_POST['pop_target'])."' ";
    $sql_common .= ", pop_hit = '".addslashes($_POST['pop_hit'])."' ";
    $sql_common .= ", pop_datetime = '".$shop['time_ymdhis']."' ";

    // insert
    sql_query(" insert into $shop[popup_table] $sql_common ");

    $popup_id = mysql_insert_id();

}

// update
else if ($m == 'u') {

    // 팝업
    $dmshop_popup = shop_popup($_POST['popup_id']);

    if (!$dmshop_popup['id']) {

        alert("팝업이 삭제되었거나 존재하지 않습니다.");

    }

    $sql_common = "";
    $sql_common .= " set pop_title = '".addslashes($_POST['pop_title'])."' ";
    $sql_common .= ", pop_text = '".addslashes($_POST['pop_text'])."' ";
    $sql_common .= ", pop_view = '".addslashes($_POST['pop_view'])."' ";
    $sql_common .= ", pop_position = '".addslashes($_POST['pop_position'])."' ";
    $sql_common .= ", pop_start = '".addslashes($_POST['pop_start'])." ".addslashes($_POST['pop_start_h'])."-".addslashes($_POST['pop_start_i'])."-00' ";
    $sql_common .= ", pop_end = '".addslashes($_POST['pop_end'])." ".addslashes($_POST['pop_end_h'])."-".addslashes($_POST['pop_end_i'])."-00' ";
    $sql_common .= ", pop_width = '".addslashes($_POST['pop_width'])."' ";
    $sql_common .= ", pop_height = '".addslashes($_POST['pop_height'])."' ";
    $sql_common .= ", pop_left = '".addslashes($_POST['pop_left'])."' ";
    $sql_common .= ", pop_top = '".addslashes($_POST['pop_top'])."' ";
    $sql_common .= ", pop_url = '".addslashes($_POST['pop_url'])."' ";
    $sql_common .= ", pop_target = '".addslashes($_POST['pop_target'])."' ";
    $sql_common .= ", pop_hit = '".addslashes($_POST['pop_hit'])."' ";
    $sql_common .= ", pop_datetime = '".$shop['time_ymdhis']."' ";

    // 수정
    sql_query(" update $shop[popup_table] $sql_common where id = '".addslashes($_POST['popup_id'])."' ");

}

// delete
else if ($m == 'd') {

    // 팝업
    $dmshop_popup = shop_popup(addslashes($_POST['popup_id']));

    if (!$dmshop_popup['id']) {

        alert("팝업이 삭제되었거나 존재하지 않습니다.");

    }

    // 원본
    $file_path = $shop['path']."/data/popup/".shop_data_path("u", $dmshop_popup['upload_datetime'])."/".$dmshop_popup['upload_file'];

    // 첨부파일 삭제
    @unlink($file_path);

    // 팝업 삭제
    sql_query(" delete from $shop[popup_table] where id = '".addslashes($_POST['popup_id'])."' ");

} else {

    alert("팝업이 삭제되었거나 존재하지 않습니다.");

}

// insert, update
if ($m == '' || $m == 'u') {

    // 파일경로
    $dir = $shop['path']."/data/popup/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // 팝업
    $upload_mode = "popup";
    include("./upload_popup_file.php");

}

// 신규 등록
if ($m == '') {

    shop_url("./popup_list.php");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>