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
$sql_common .= " set top_layout = '".addslashes($_POST['top_layout'])."' ";
$sql_common .= ", top_banner1_group = '".addslashes($_POST['top_banner1_group'])."' ";
$sql_common .= ", top_banner1_sort = '".addslashes($_POST['top_banner1_sort'])."' ";
$sql_common .= ", top_banner1_skin = '".addslashes($_POST['top_banner1_skin'])."' ";
$sql_common .= ", top_banner1_rolling_limit = '".addslashes($_POST['top_banner1_rolling_limit'])."' ";
$sql_common .= ", top_banner1_rolling_time = '".addslashes($_POST['top_banner1_rolling_time'])."' ";
$sql_common .= ", top_banner2_group = '".addslashes($_POST['top_banner2_group'])."' ";
$sql_common .= ", top_banner2_sort = '".addslashes($_POST['top_banner2_sort'])."' ";
$sql_common .= ", top_banner2_skin = '".addslashes($_POST['top_banner2_skin'])."' ";
$sql_common .= ", top_banner2_rolling_limit = '".addslashes($_POST['top_banner2_rolling_limit'])."' ";
$sql_common .= ", top_banner2_rolling_time = '".addslashes($_POST['top_banner2_rolling_time'])."' ";
$sql_common .= ", top_article = '".addslashes($_POST['top_article'])."' ";
$sql_common .= ", top_article_skin = '".addslashes($_POST['top_article_skin'])."' ";
$sql_common .= ", top_article_sort = '".addslashes($_POST['top_article_sort'])."' ";
$sql_common .= ", top_article_use1 = '".addslashes($_POST['top_article_use1'])."' ";
$sql_common .= ", top_article_use2 = '".addslashes($_POST['top_article_use2'])."' ";
$sql_common .= ", top_article_use3 = '".addslashes($_POST['top_article_use3'])."' ";
$sql_common .= ", top_article_width = '".addslashes($_POST['top_article_width'])."' ";
$sql_common .= ", top_article_height = '".addslashes($_POST['top_article_height'])."' ";
$sql_common .= ", top_searchbox_skin = '".addslashes($_POST['top_searchbox_skin'])."' ";
$sql_common .= ", top_servicemenu1_font_family = '".addslashes($_POST['top_servicemenu1_font_family'])."' ";
$sql_common .= ", top_servicemenu1_font_size = '".addslashes($_POST['top_servicemenu1_font_size'])."' ";
$sql_common .= ", top_servicemenu1_font_color = '".addslashes($_POST['top_servicemenu1_font_color'])."' ";
$sql_common .= ", top_servicemenu1_font_bold = '".addslashes($_POST['top_servicemenu1_font_bold'])."' ";
$sql_common .= ", top_servicemenu2_font_family = '".addslashes($_POST['top_servicemenu2_font_family'])."' ";
$sql_common .= ", top_servicemenu2_font_size = '".addslashes($_POST['top_servicemenu2_font_size'])."' ";
$sql_common .= ", top_servicemenu2_font_color = '".addslashes($_POST['top_servicemenu2_font_color'])."' ";
$sql_common .= ", top_servicemenu2_font_bold = '".addslashes($_POST['top_servicemenu2_font_bold'])."' ";
$sql_common .= ", top_menubar_use = '".addslashes($_POST['top_menubar_use'])."' ";
$sql_common .= ", top_menubar_skin = '".addslashes($_POST['top_menubar_skin'])."' ";
$sql_common .= ", top_bottom_height = '".addslashes($_POST['top_bottom_height'])."' ";

// update
sql_query(" update $shop[design_top_table] $sql_common ");

// 파일경로
$dir = $shop['path']."/data/design/".shop_data_path("", "");

@mkdir("$dir", 0707);
@chmod("$dir", 0707);

$upload_mode = "top_background_image";
include("./upload_design_file.php");

$upload_mode = "top_logo";
include("./upload_design_file.php");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>