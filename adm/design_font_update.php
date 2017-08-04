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
$sql_common .= " set ct_item_title_font_family = '".addslashes($_POST['ct_item_title_font_family'])."' ";
$sql_common .= ", ct_item_title_font_size = '".addslashes($_POST['ct_item_title_font_size'])."' ";
$sql_common .= ", ct_item_title_font_color = '".addslashes($_POST['ct_item_title_font_color'])."' ";
$sql_common .= ", ct_item_title_font_bold = '".addslashes($_POST['ct_item_title_font_bold'])."' ";
$sql_common .= ", ct_item_title_font_italic = '".addslashes($_POST['ct_item_title_font_italic'])."' ";
$sql_common .= ", ct_item_title_font_underline = '".addslashes($_POST['ct_item_title_font_underline'])."' ";
$sql_common .= ", ct_item_money_font_family = '".addslashes($_POST['ct_item_money_font_family'])."' ";
$sql_common .= ", ct_item_money_font_size = '".addslashes($_POST['ct_item_money_font_size'])."' ";
$sql_common .= ", ct_item_money_font_color = '".addslashes($_POST['ct_item_money_font_color'])."' ";
$sql_common .= ", ct_item_money_font_bold = '".addslashes($_POST['ct_item_money_font_bold'])."' ";
$sql_common .= ", ct_item_money_font_italic = '".addslashes($_POST['ct_item_money_font_italic'])."' ";
$sql_common .= ", ct_item_money_font_underline = '".addslashes($_POST['ct_item_money_font_underline'])."' ";
$sql_common .= ", ct_item_price_font_family = '".addslashes($_POST['ct_item_price_font_family'])."' ";
$sql_common .= ", ct_item_price_font_size = '".addslashes($_POST['ct_item_price_font_size'])."' ";
$sql_common .= ", ct_item_price_font_color = '".addslashes($_POST['ct_item_price_font_color'])."' ";
$sql_common .= ", ct_item_price_font_bold = '".addslashes($_POST['ct_item_price_font_bold'])."' ";
$sql_common .= ", ct_item_price_font_italic = '".addslashes($_POST['ct_item_price_font_italic'])."' ";
$sql_common .= ", ct_item_price_font_through = '".addslashes($_POST['ct_item_price_font_through'])."' ";
$sql_common .= ", ct_etc_font_family = '".addslashes($_POST['ct_etc_font_family'])."' ";
$sql_common .= ", ct_etc_font_size = '".addslashes($_POST['ct_etc_font_size'])."' ";
$sql_common .= ", ct_etc_font_color = '".addslashes($_POST['ct_etc_font_color'])."' ";
$sql_common .= ", ct_etc_font_bold = '".addslashes($_POST['ct_etc_font_bold'])."' ";
$sql_common .= ", ct_etc_font_italic = '".addslashes($_POST['ct_etc_font_italic'])."' ";
$sql_common .= ", ct_etc_font_underline = '".addslashes($_POST['ct_etc_font_underline'])."' ";
$sql_common .= ", ct_line_font_size = '".addslashes($_POST['ct_line_font_size'])."' ";
$sql_common .= ", ct_line_font_color = '".addslashes($_POST['ct_line_font_color'])."' ";
$sql_common .= ", pl_item_title_font_family = '".addslashes($_POST['pl_item_title_font_family'])."' ";
$sql_common .= ", pl_item_title_font_size = '".addslashes($_POST['pl_item_title_font_size'])."' ";
$sql_common .= ", pl_item_title_font_color = '".addslashes($_POST['pl_item_title_font_color'])."' ";
$sql_common .= ", pl_item_title_font_bold = '".addslashes($_POST['pl_item_title_font_bold'])."' ";
$sql_common .= ", pl_item_title_font_italic = '".addslashes($_POST['pl_item_title_font_italic'])."' ";
$sql_common .= ", pl_item_title_font_underline = '".addslashes($_POST['pl_item_title_font_underline'])."' ";
$sql_common .= ", pl_item_money_font_family = '".addslashes($_POST['pl_item_money_font_family'])."' ";
$sql_common .= ", pl_item_money_font_size = '".addslashes($_POST['pl_item_money_font_size'])."' ";
$sql_common .= ", pl_item_money_font_color = '".addslashes($_POST['pl_item_money_font_color'])."' ";
$sql_common .= ", pl_item_money_font_bold = '".addslashes($_POST['pl_item_money_font_bold'])."' ";
$sql_common .= ", pl_item_money_font_italic = '".addslashes($_POST['pl_item_money_font_italic'])."' ";
$sql_common .= ", pl_item_money_font_underline = '".addslashes($_POST['pl_item_money_font_underline'])."' ";
$sql_common .= ", pl_item_price_font_family = '".addslashes($_POST['pl_item_price_font_family'])."' ";
$sql_common .= ", pl_item_price_font_size = '".addslashes($_POST['pl_item_price_font_size'])."' ";
$sql_common .= ", pl_item_price_font_color = '".addslashes($_POST['pl_item_price_font_color'])."' ";
$sql_common .= ", pl_item_price_font_bold = '".addslashes($_POST['pl_item_price_font_bold'])."' ";
$sql_common .= ", pl_item_price_font_italic = '".addslashes($_POST['pl_item_price_font_italic'])."' ";
$sql_common .= ", pl_item_price_font_through = '".addslashes($_POST['pl_item_price_font_through'])."' ";
$sql_common .= ", pl_etc_font_family = '".addslashes($_POST['pl_etc_font_family'])."' ";
$sql_common .= ", pl_etc_font_size = '".addslashes($_POST['pl_etc_font_size'])."' ";
$sql_common .= ", pl_etc_font_color = '".addslashes($_POST['pl_etc_font_color'])."' ";
$sql_common .= ", pl_etc_font_bold = '".addslashes($_POST['pl_etc_font_bold'])."' ";
$sql_common .= ", pl_etc_font_italic = '".addslashes($_POST['pl_etc_font_italic'])."' ";
$sql_common .= ", pl_etc_font_underline = '".addslashes($_POST['pl_etc_font_underline'])."' ";
$sql_common .= ", pl_line_font_size = '".addslashes($_POST['pl_line_font_size'])."' ";
$sql_common .= ", pl_line_font_color = '".addslashes($_POST['pl_line_font_color'])."' ";

// update
sql_query(" update $shop[design_font_table] $sql_common ");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>