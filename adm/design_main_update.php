<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}
//alert($_POST['main_tag_bottom_text']);

// br 태그제거
if ($_POST['main_tag_top_text'] == '<br>' || $_POST['main_tag_top_text'] == '<br />') { $_POST['main_tag_top_text'] = ""; }
if ($_POST['main_tag_bottom_text'] == '<br>' || $_POST['main_tag_bottom_text'] == '<br />') { $_POST['main_tag_bottom_text'] = ""; }

// 파일 업로드 경로
$dir = $shop['path']."/data/design/".shop_data_path("", "");

// 디렉토리 생성 및 퍼미션 변경
@mkdir("$dir", 0707);
@chmod("$dir", 0707);

$upload_mode = "main_image_top";
include("./upload_design_file.php");

$upload_mode = "main_image_bottom";
include("./upload_design_file.php");

// common
$sql_common = "";
$sql_common .= " set main_tag_top_text = '".addslashes($_POST['main_tag_top_text'])."' ";
$sql_common .= ", main_tag_bottom_text = '".addslashes($_POST['main_tag_bottom_text'])."' ";
$sql_common .= ", display1_type = '".addslashes($_POST['display1_type'])."' ";
$sql_common .= ", display2_type = '".addslashes($_POST['display2_type'])."' ";
$sql_common .= ", display3_type = '".addslashes($_POST['display3_type'])."' ";
$sql_common .= ", display4_type = '".addslashes($_POST['display4_type'])."' ";
$sql_common .= ", display5_type = '".addslashes($_POST['display5_type'])."' ";
$sql_common .= ", display1_top = '".addslashes($_POST['display1_top'])."' ";
$sql_common .= ", display2_top = '".addslashes($_POST['display2_top'])."' ";
$sql_common .= ", display3_top = '".addslashes($_POST['display3_top'])."' ";
$sql_common .= ", display4_top = '".addslashes($_POST['display4_top'])."' ";
$sql_common .= ", display5_top = '".addslashes($_POST['display5_top'])."' ";

// update
sql_query(" update $shop[design_table] $sql_common ");

// display_box_type
$result = sql_query(" select * from $shop[display_box_type_table] order by display_id asc, display_type asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $sql_common = "";
    $sql_common .= " set box_type = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_list"])."' ";
    $sql_common .= ", box_width = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_box_width"])."' ";
    $sql_common .= ", box_height = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_box_height"])."' ";
    $sql_common .= ", side_width = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_side_width"])."' ";

    // update
    sql_query(" update $shop[display_box_type_table] $sql_common where display_id = '".$row['display_id']."' and display_type = '".$row['display_type']."' ");

}

// 파일 업로드 경로
$dir = $shop['path']."/data/display_box/".shop_data_path("", "");

// 디렉토리 생성 및 퍼미션 변경
@mkdir("$dir", 0707);
@chmod("$dir", 0707);

// display_box_list
$result = sql_query(" select * from $shop[display_box_list_table] order by display_id asc, display_type asc, display_list asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // common
    $sql_common = "";
    $sql_common .= " set category = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_category"])."' ";
    $sql_common .= ", icon = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_icon"])."' ";
    $sql_common .= ", sort = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_sort"])."' ";
    $sql_common .= ", skin = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_skin"])."' ";
    $sql_common .= ", count_width = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_count_width"])."' ";
    $sql_common .= ", count_height = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_count_height"])."' ";
    $sql_common .= ", thumb_width = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_thumb_width"])."' ";
    $sql_common .= ", thumb_height = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_thumb_height"])."' ";
    $sql_common .= ", rolling_limit = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_rolling_limit"])."' ";
    $sql_common .= ", rolling_time = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_rolling_time"])."' ";
    $sql_common .= ", titletype = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_titletype"])."' ";
    $sql_common .= ", title = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_title"])."' ";
    $sql_common .= ", plan = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_plan"])."' ";
    $sql_common .= ", board = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_board"])."' ";
    $sql_common .= ", use1 = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_use1"])."' ";
    $sql_common .= ", use2 = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_use2"])."' ";
    $sql_common .= ", use3 = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_use3"])."' ";
    $sql_common .= ", use4 = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_use4"])."' ";
    $sql_common .= ", banner = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_banner"])."' ";
    $sql_common .= ", url = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_url"])."' ";
    $sql_common .= ", urltype = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_urltype"])."' ";
    $sql_common .= ", html = '".addslashes($_POST["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_html"])."' ";

    // update
    sql_query(" update $shop[display_box_list_table] $sql_common where display_id = '".$row['display_id']."' and display_type = '".$row['display_type']."' and display_list = '".$row['display_list']."' ");

    // file
    $display_id = $row['display_id'];
    $display_type = $row['display_type'];
    $display_list = $row['display_list'];

    include("./upload_display_box_file.php");

}

shop_url("./design_main.php");
?>