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
$sql_common .= " set menu_list_id = '".addslashes($_POST['menu_list_id'])."' ";
$sql_common .= ", menu_margin_top = '".addslashes($_POST['menu_margin_top'])."' ";
$sql_common .= ", menu_margin_left = '".addslashes($_POST['menu_margin_left'])."' ";
$sql_common .= ", menu_margin_right = '".addslashes($_POST['menu_margin_right'])."' ";
$sql_common .= ", menu_margin_side = '".addslashes($_POST['menu_margin_side'])."' ";
$sql_common .= ", menu_margin_bottom = '".addslashes($_POST['menu_margin_bottom'])."' ";
$sql_common .= ", menu_searchbox_skin = '".addslashes($_POST['menu_searchbox_skin'])."' ";
$sql_common .= ", menu_loginbox_skin = '".addslashes($_POST['menu_loginbox_skin'])."' ";
$sql_common .= ", menu_menubar_use = '".addslashes($_POST['menu_menubar_use'])."' ";
$sql_common .= ", menu_menubar_skin = '".addslashes($_POST['menu_menubar_skin'])."' ";
$sql_common .= ", menu_planbox_skin = '".addslashes($_POST['menu_planbox_skin'])."' ";
$sql_common .= ", menu_boardbox_skin = '".addslashes($_POST['menu_boardbox_skin'])."' ";
$sql_common .= ", menu_article = '".addslashes($_POST['menu_article'])."' ";
$sql_common .= ", menu_article_skin = '".addslashes($_POST['menu_article_skin'])."' ";
$sql_common .= ", menu_article_sort = '".addslashes($_POST['menu_article_sort'])."' ";
$sql_common .= ", menu_article_use1 = '".addslashes($_POST['menu_article_use1'])."' ";
$sql_common .= ", menu_article_use2 = '".addslashes($_POST['menu_article_use2'])."' ";
$sql_common .= ", menu_article_use3 = '".addslashes($_POST['menu_article_use3'])."' ";
$sql_common .= ", menu_article_width = '".addslashes($_POST['menu_article_width'])."' ";
$sql_common .= ", menu_article_height = '".addslashes($_POST['menu_article_height'])."' ";
$sql_common .= ", menu_banner_group = '".addslashes($_POST['menu_banner_group'])."' ";
$sql_common .= ", menu_banner_sort = '".addslashes($_POST['menu_banner_sort'])."' ";
$sql_common .= ", menu_banner_skin = '".addslashes($_POST['menu_banner_skin'])."' ";
$sql_common .= ", menu_banner_rolling_limit = '".addslashes($_POST['menu_banner_rolling_limit'])."' ";
$sql_common .= ", menu_banner_rolling_time = '".addslashes($_POST['menu_banner_rolling_time'])."' ";
$sql_common .= ", menu_tag = '".addslashes($_POST['menu_tag'])."' ";

// update
sql_query(" update $shop[design_menu_table] $sql_common ");

// 파일경로
$dir = $shop['path']."/data/design/".shop_data_path("", "");

@mkdir("$dir", 0707);
@chmod("$dir", 0707);

$upload_mode = "menu_background_default";
include("./upload_design_file.php");

$upload_mode = "menu_background_top";
include("./upload_design_file.php");

$upload_mode = "menu_background_bottom";
include("./upload_design_file.php");

$upload_mode = "menu_help";
include("./upload_design_file.php");

$upload_mode = "menu_bank";
include("./upload_design_file.php");

$upload_mode = "menu_logo";
include("./upload_design_file.php");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>