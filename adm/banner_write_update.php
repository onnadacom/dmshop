<?php
include_once("./_dmshop.php");
if ($banner_id) { $banner_id = preg_match("/^[0-9]+$/", $banner_id) ? $banner_id : ""; }

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// insert
if ($m == '') {

    // 개별적용
    $sql_common = "";
    $sql_common .= " set group_id = '".trim(strip_tags(mysql_real_escape_string($_POST['group_id'])))."' ";
    $sql_common .= ", ba_title = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_title'])))."' ";
    $sql_common .= ", ba_position = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_position'])))."' ";
    $sql_common .= ", ba_view = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_view'])))."' ";
    $sql_common .= ", ba_width = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_width'])))."' ";
    $sql_common .= ", ba_height = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_height'])))."' ";
    $sql_common .= ", ba_url = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_url'])))."' ";
    $sql_common .= ", ba_target = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_target'])))."' ";
    $sql_common .= ", ba_datetime = '".$shop['time_ymdhis']."' ";

    // 등록
    sql_query(" insert into $shop[banner_table] $sql_common ");

    $banner_id = mysql_insert_id();

}

// update
else if ($m == 'u') {

    // 배너
    $dmshop_banner = shop_banner($banner_id);

    if (!$dmshop_banner['id']) {

        alert("배너가 삭제되었거나 존재하지 않습니다.");

    }

    // 개별적용
    $sql_common = "";
    $sql_common .= " set group_id = '".trim(strip_tags(mysql_real_escape_string($_POST['group_id'])))."' ";
    $sql_common .= ", ba_title = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_title'])))."' ";
    $sql_common .= ", ba_position = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_position'])))."' ";
    $sql_common .= ", ba_view = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_view'])))."' ";
    $sql_common .= ", ba_width = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_width'])))."' ";
    $sql_common .= ", ba_height = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_height'])))."' ";
    $sql_common .= ", ba_url = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_url'])))."' ";
    $sql_common .= ", ba_target = '".trim(strip_tags(mysql_real_escape_string($_POST['ba_target'])))."' ";

    // 수정
    sql_query(" update $shop[banner_table] $sql_common where id = '".$banner_id."' ");

}

// delete
else if ($m == 'd') {

    // 배너
    $dmshop_banner = shop_banner($banner_id);

    if (!$dmshop_banner['id']) {

        alert("배너가 삭제되었거나 존재하지 않습니다.");

    }

    // 원본
    $file_path = $shop['path']."/data/banner/".shop_data_path("u", $dmshop_banner['upload_datetime'])."/".$dmshop_banner['upload_file'];

    // 첨부파일 삭제
    @unlink($file_path);

    // 배너 삭제
    sql_query(" delete from $shop[banner_table] where id = '".$banner_id."' ");

} else {

    alert("배너가 삭제되었거나 존재하지 않습니다.");

}

// insert, update
if ($m == '' || $m == 'u') {

    // 파일경로
    $dir = $shop['path']."/data/banner/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // 배너
    $upload_mode = "banner";
    include("./upload_banner_file.php");

    if (!$ba_width && !$ba_height) {

        // 데이터
        $file = shop_banner($banner_id);

        $sql_common = "";
        $sql_common .= " set ba_width = '".$file['upload_width']."' ";
        $sql_common .= ", ba_height = '".$file['upload_height']."' ";

        // update
        sql_query(" update $shop[banner_table] $sql_common where id = '".$banner_id."' ");

    }

}

// 신규 등록
if ($m == '') {

    shop_url("./banner_list.php");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>