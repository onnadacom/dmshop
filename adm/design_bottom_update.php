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
if ($_POST['bottom_tag'] == '<br>' || $_POST['bottom_tag'] == '<br />') { $_POST['bottom_tag'] = ""; }

// common
$sql_common = "";
$sql_common .= " set bottom_layout = '".addslashes($_POST['bottom_layout'])."' ";
$sql_common .= ", bottom_servicemenu1_font_family = '".addslashes($_POST['bottom_servicemenu1_font_family'])."' ";
$sql_common .= ", bottom_servicemenu1_font_size = '".addslashes($_POST['bottom_servicemenu1_font_size'])."' ";
$sql_common .= ", bottom_servicemenu1_font_height = '".addslashes($_POST['bottom_servicemenu1_font_height'])."' ";
$sql_common .= ", bottom_servicemenu1_font_color = '".addslashes($_POST['bottom_servicemenu1_font_color'])."' ";
$sql_common .= ", bottom_servicemenu1_font_bold = '".addslashes($_POST['bottom_servicemenu1_font_bold'])."' ";
$sql_common .= ", bottom_servicemenu2_font_family = '".addslashes($_POST['bottom_servicemenu2_font_family'])."' ";
$sql_common .= ", bottom_servicemenu2_font_size = '".addslashes($_POST['bottom_servicemenu2_font_size'])."' ";
$sql_common .= ", bottom_servicemenu2_font_height = '".addslashes($_POST['bottom_servicemenu2_font_height'])."' ";
$sql_common .= ", bottom_servicemenu2_font_color = '".addslashes($_POST['bottom_servicemenu2_font_color'])."' ";
$sql_common .= ", bottom_servicemenu2_font_bold = '".addslashes($_POST['bottom_servicemenu2_font_bold'])."' ";
$sql_common .= ", bottom_information_font_family = '".addslashes($_POST['bottom_information_font_family'])."' ";
$sql_common .= ", bottom_information_font_size = '".addslashes($_POST['bottom_information_font_size'])."' ";
$sql_common .= ", bottom_information_font_height = '".addslashes($_POST['bottom_information_font_height'])."' ";
$sql_common .= ", bottom_information_font_color = '".addslashes($_POST['bottom_information_font_color'])."' ";
$sql_common .= ", bottom_information_font_bold = '".addslashes($_POST['bottom_information_font_bold'])."' ";
$sql_common .= ", bottom_information_position = '".addslashes($_POST['bottom_information_position'])."' ";
$sql_common .= ", bottom_copyright_font_family = '".addslashes($_POST['bottom_copyright_font_family'])."' ";
$sql_common .= ", bottom_copyright_font_size = '".addslashes($_POST['bottom_copyright_font_size'])."' ";
$sql_common .= ", bottom_copyright_font_height = '".addslashes($_POST['bottom_copyright_font_height'])."' ";
$sql_common .= ", bottom_copyright_font_color = '".addslashes($_POST['bottom_copyright_font_color'])."' ";
$sql_common .= ", bottom_copyright_font_bold = '".addslashes($_POST['bottom_copyright_font_bold'])."' ";
$sql_common .= ", bottom_copyright_position = '".addslashes($_POST['bottom_copyright_position'])."' ";
$sql_common .= ", bottom_tag = '".addslashes($_POST['bottom_tag'])."' ";

// update
sql_query(" update $shop[design_bottom_table] $sql_common ");

// 게시판
$result = sql_query(" select * from $shop[board_table] ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    if ($_POST["board_bottom_".$row['bbs_id']]) {

        sql_query(" update $shop[board_table] set bottom_view = '1' where bbs_id = '".addslashes($row['bbs_id'])."' ");

    } else {

        sql_query(" update $shop[board_table] set bottom_view = '0' where bbs_id = '".addslashes($row['bbs_id'])."' ");

    }

}

// 페이지
$result = sql_query(" select * from $shop[page_table] ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    if ($_POST["page_bottom_".$row['page_id']]) {

        sql_query(" update $shop[page_table] set bottom_view = '1' where page_id = '".addslashes($row['page_id'])."' ");

    } else {

        sql_query(" update $shop[page_table] set bottom_view = '0' where page_id = '".addslashes($row['page_id'])."' ");

    }

}

// 파일경로
$dir = $shop['path']."/data/design/".shop_data_path("", "");

@mkdir("$dir", 0707);
@chmod("$dir", 0707);

$upload_mode = "bottom_background_image";
include("./upload_design_file.php");

$upload_mode = "bottom_background_image2";
include("./upload_design_file.php");

$upload_mode = "bottom_logo";
include("./upload_design_file.php");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>