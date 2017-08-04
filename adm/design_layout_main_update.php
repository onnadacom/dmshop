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
$sql_common .= " set main_body_position = '".addslashes($_POST['main_body_position'])."' ";
$sql_common .= ", main_layout = '".addslashes($_POST['main_layout'])."' ";
$sql_common .= ", main_width_use = '".addslashes($_POST['main_width_use'])."' ";
$sql_common .= ", main_width = '".addslashes($_POST['main_width'])."' ";
$sql_common .= ", main_menu_width = '".addslashes($_POST['main_menu_width'])."' ";
$sql_common .= ", main_center_width = '".addslashes($_POST['main_center_width'])."' ";
$sql_common .= ", main_mc_width = '".addslashes($_POST['main_mc_width'])."' ";
$sql_common .= ", main_background_image_type = '".addslashes($_POST['main_background_image_type'])."' ";
$sql_common .= ", main_background_color = '".addslashes($_POST['main_background_color'])."' ";
$sql_common .= ", main_scrollbox_top = '".addslashes($_POST['main_scrollbox_top'])."' ";

// update
sql_query(" update $shop[design_table] $sql_common ");

// common
$sql_common = "";
$sql_common .= " set skin_main = '".addslashes($_POST['skin_main'])."' ";
$sql_common .= ", skin_main_top = '".addslashes($_POST['skin_main_top'])."' ";
$sql_common .= ", skin_main_menu = '".addslashes($_POST['skin_main_menu'])."' ";
$sql_common .= ", skin_main_bottom = '".addslashes($_POST['skin_main_bottom'])."' ";
$sql_common .= ", skin_main_scrollbox = '".addslashes($_POST['skin_main_scrollbox'])."' ";

// update
sql_query(" update $shop[design_skin_table] $sql_common ");

// 파일경로
$dir = $shop['path']."/data/design/".shop_data_path("", "");

@mkdir("$dir", 0707);
@chmod("$dir", 0707);

// 메인 배경
$upload_mode = "main_background_image";
include("./upload_design_file.php");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>