<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// common
$sql_common = "";
$sql_common .= " set sub_body_position = '".addslashes($_POST['sub_body_position'])."' ";
$sql_common .= ", sub_layout = '".addslashes($_POST['sub_layout'])."' ";
$sql_common .= ", sub_width_use = '".addslashes($_POST['sub_width_use'])."' ";
$sql_common .= ", sub_width = '".addslashes($_POST['sub_width'])."' ";
$sql_common .= ", sub_menu_width = '".addslashes($_POST['sub_menu_width'])."' ";
$sql_common .= ", sub_center_width = '".addslashes($_POST['sub_center_width'])."' ";
$sql_common .= ", sub_mc_width = '".addslashes($_POST['sub_mc_width'])."' ";
$sql_common .= ", sub_background_image_type = '".addslashes($_POST['sub_background_image_type'])."' ";
$sql_common .= ", sub_background_color = '".addslashes($_POST['sub_background_color'])."' ";
$sql_common .= ", sub_scrollbox_top = '".addslashes($_POST['sub_scrollbox_top'])."' ";

// update
sql_query(" update $shop[design_table] $sql_common ");

// common
$sql_common = "";
$sql_common .= " set skin_sub_top = '".addslashes($_POST['skin_sub_top'])."' ";
$sql_common .= ", skin_sub_menu = '".addslashes($_POST['skin_sub_menu'])."' ";
$sql_common .= ", skin_sub_bottom = '".addslashes($_POST['skin_sub_bottom'])."' ";
$sql_common .= ", skin_sub_scrollbox = '".addslashes($_POST['skin_sub_scrollbox'])."' ";

// update
sql_query(" update $shop[design_skin_table] $sql_common ");

// 파일경로
$dir = $shop['path']."/data/design/".shop_data_path("", "");

@mkdir("$dir", 0707);
@chmod("$dir", 0707);

// 서브 배경
$upload_mode = "sub_background_image";
include("./upload_design_file.php");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>