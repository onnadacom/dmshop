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
$sql_common .= " set skin_item = '".$_POST['skin_item']."' ";

// update
sql_query(" update $shop[design_skin_table] $sql_common ");

// common
$sql_common = "";
$sql_common .= " set buy_use1 = '".addslashes($_POST['buy_use1'])."' ";
$sql_common .= ", buy_use2 = '".addslashes($_POST['buy_use2'])."' ";
$sql_common .= ", buy_use3 = '".addslashes($_POST['buy_use3'])."' ";
$sql_common .= ", buy_use4 = '".addslashes($_POST['buy_use4'])."' ";
$sql_common .= ", buy_use5 = '".addslashes($_POST['buy_use5'])."' ";
$sql_common .= ", buy_use6 = '".addslashes($_POST['buy_use6'])."' ";
$sql_common .= ", sns_use1 = '".addslashes($_POST['sns_use1'])."' ";
$sql_common .= ", sns_use2 = '".addslashes($_POST['sns_use2'])."' ";
$sql_common .= ", sns_use3 = '".addslashes($_POST['sns_use3'])."' ";
$sql_common .= ", sns_use4 = '".addslashes($_POST['sns_use4'])."' ";
$sql_common .= ", sns_use5 = '".addslashes($_POST['sns_use5'])."' ";
$sql_common .= ", sns_use6 = '".addslashes($_POST['sns_use6'])."' ";
$sql_common .= ", item_gallery = '".addslashes($_POST['item_gallery'])."' ";
$sql_common .= ", item_relation = '".addslashes($_POST['item_relation'])."' ";
$sql_common .= ", tab_use1 = '".addslashes($_POST['tab_use1'])."' ";
$sql_common .= ", tab_use2 = '".addslashes($_POST['tab_use2'])."' ";
$sql_common .= ", tab_use3 = '".addslashes($_POST['tab_use3'])."' ";
$sql_common .= ", tab_use4 = '".addslashes($_POST['tab_use4'])."' ";
$sql_common .= ", tab_use5 = '".addslashes($_POST['tab_use5'])."' ";
$sql_common .= ", item_option1 = '".addslashes($_POST['item_option1'])."' ";
$sql_common .= ", item_option2 = '".addslashes($_POST['item_option2'])."' ";
$sql_common .= ", item_option3 = '".addslashes($_POST['item_option3'])."' ";
$sql_common .= ", item_option4 = '".addslashes($_POST['item_option4'])."' ";
$sql_common .= ", item_option5 = '".addslashes($_POST['item_option5'])."' ";
$sql_common .= ", item_option6 = '".addslashes($_POST['item_option6'])."' ";
$sql_common .= ", item_option7 = '".addslashes($_POST['item_option7'])."' ";
$sql_common .= ", item_option8 = '".addslashes($_POST['item_option8'])."' ";
$sql_common .= ", item_option9 = '".addslashes($_POST['item_option9'])."' ";
$sql_common .= ", item_option10 = '".addslashes($_POST['item_option10'])."' ";
$sql_common .= ", thumb_type = '".addslashes($_POST['thumb_type'])."' ";
$sql_common .= ", smart_zoom = '".addslashes($_POST['smart_zoom'])."' ";
$sql_common .= ", image_default_use = '".addslashes($_POST['image_default_use'])."' ";
$sql_common .= ", image_default = '".addslashes($_POST['image_default'])."' ";
$sql_common .= ", image_default_width = '".addslashes($_POST['image_default_width'])."' ";
$sql_common .= ", image_default_height = '".addslashes($_POST['image_default_height'])."' ";
$sql_common .= ", image_default1_border = '".addslashes($_POST['image_default1_border'])."' ";
$sql_common .= ", image_default1_border_color = '".addslashes($_POST['image_default1_border_color'])."' ";
$sql_common .= ", image_default2_border = '".addslashes($_POST['image_default2_border'])."' ";
$sql_common .= ", image_default2_border_color = '".addslashes($_POST['image_default2_border_color'])."' ";
$sql_common .= ", image_gallery_thumb_use = '".addslashes($_POST['image_gallery_thumb_use'])."' ";
$sql_common .= ", image_gallery_thumb = '".addslashes($_POST['image_gallery_thumb'])."' ";
$sql_common .= ", image_gallery_thumb_width = '".addslashes($_POST['image_gallery_thumb_width'])."' ";
$sql_common .= ", image_gallery_thumb_height = '".addslashes($_POST['image_gallery_thumb_height'])."' ";
$sql_common .= ", image_gallery1_border = '".addslashes($_POST['image_gallery1_border'])."' ";
$sql_common .= ", image_gallery1_border_color = '".addslashes($_POST['image_gallery1_border_color'])."' ";
$sql_common .= ", image_gallery2_border = '".addslashes($_POST['image_gallery2_border'])."' ";
$sql_common .= ", image_gallery2_border_color = '".addslashes($_POST['image_gallery2_border_color'])."' ";
$sql_common .= ", image_relation_use = '".addslashes($_POST['image_relation_use'])."' ";
$sql_common .= ", image_relation = '".addslashes($_POST['image_relation'])."' ";
$sql_common .= ", image_relation_width = '".addslashes($_POST['image_relation_width'])."' ";
$sql_common .= ", image_relation_height = '".addslashes($_POST['image_relation_height'])."' ";
$sql_common .= ", image_relation1_border = '".addslashes($_POST['image_relation1_border'])."' ";
$sql_common .= ", image_relation1_border_color = '".addslashes($_POST['image_relation1_border_color'])."' ";
$sql_common .= ", image_relation2_border = '".addslashes($_POST['image_relation2_border'])."' ";
$sql_common .= ", image_relation2_border_color = '".addslashes($_POST['image_relation2_border_color'])."' ";
$sql_common .= ", item_image_width = '".addslashes($_POST['item_image_width'])."' ";
$sql_common .= ", item_title_font_family = '".addslashes($_POST['item_title_font_family'])."' ";
$sql_common .= ", item_title_font_size = '".addslashes($_POST['item_title_font_size'])."' ";
$sql_common .= ", item_title_font_color = '".addslashes($_POST['item_title_font_color'])."' ";
$sql_common .= ", item_title_font_bold = '".addslashes($_POST['item_title_font_bold'])."' ";
$sql_common .= ", item_title_font_italic = '".addslashes($_POST['item_title_font_italic'])."' ";
$sql_common .= ", item_title_font_underline = '".addslashes($_POST['item_title_font_underline'])."' ";
$sql_common .= ", item_subtitle_font_family = '".addslashes($_POST['item_subtitle_font_family'])."' ";
$sql_common .= ", item_subtitle_font_size = '".addslashes($_POST['item_subtitle_font_size'])."' ";
$sql_common .= ", item_subtitle_font_color = '".addslashes($_POST['item_subtitle_font_color'])."' ";
$sql_common .= ", item_subtitle_font_bold = '".addslashes($_POST['item_subtitle_font_bold'])."' ";
$sql_common .= ", item_subtitle_font_italic = '".addslashes($_POST['item_subtitle_font_italic'])."' ";
$sql_common .= ", item_subtitle_font_underline = '".addslashes($_POST['item_subtitle_font_underline'])."' ";
$sql_common .= ", item_price_font_family = '".addslashes($_POST['item_price_font_family'])."' ";
$sql_common .= ", item_price_font_size = '".addslashes($_POST['item_price_font_size'])."' ";
$sql_common .= ", item_price_font_color = '".addslashes($_POST['item_price_font_color'])."' ";
$sql_common .= ", item_price_font_bold = '".addslashes($_POST['item_price_font_bold'])."' ";
$sql_common .= ", item_price_font_italic = '".addslashes($_POST['item_price_font_italic'])."' ";
$sql_common .= ", item_price_font_through = '".addslashes($_POST['item_price_font_through'])."' ";
$sql_common .= ", item_money_font_family = '".addslashes($_POST['item_money_font_family'])."' ";
$sql_common .= ", item_money_font_size = '".addslashes($_POST['item_money_font_size'])."' ";
$sql_common .= ", item_money_font_color = '".addslashes($_POST['item_money_font_color'])."' ";
$sql_common .= ", item_money_font_bold = '".addslashes($_POST['item_money_font_bold'])."' ";
$sql_common .= ", item_money_font_italic = '".addslashes($_POST['item_money_font_italic'])."' ";
$sql_common .= ", item_money_font_underline = '".addslashes($_POST['item_money_font_underline'])."' ";
$sql_common .= ", item_cash_font_family = '".addslashes($_POST['item_cash_font_family'])."' ";
$sql_common .= ", item_cash_font_size = '".addslashes($_POST['item_cash_font_size'])."' ";
$sql_common .= ", item_cash_font_color = '".addslashes($_POST['item_cash_font_color'])."' ";
$sql_common .= ", item_cash_font_bold = '".addslashes($_POST['item_cash_font_bold'])."' ";
$sql_common .= ", item_cash_font_italic = '".addslashes($_POST['item_cash_font_italic'])."' ";
$sql_common .= ", item_cash_font_underline = '".addslashes($_POST['item_cash_font_underline'])."' ";
$sql_common .= ", item_limit_font_family = '".addslashes($_POST['item_limit_font_family'])."' ";
$sql_common .= ", item_limit_font_size = '".addslashes($_POST['item_limit_font_size'])."' ";
$sql_common .= ", item_limit_font_color = '".addslashes($_POST['item_limit_font_color'])."' ";
$sql_common .= ", item_limit_font_bold = '".addslashes($_POST['item_limit_font_bold'])."' ";
$sql_common .= ", item_limit_font_italic = '".addslashes($_POST['item_limit_font_italic'])."' ";
$sql_common .= ", item_limit_font_underline = '".addslashes($_POST['item_limit_font_underline'])."' ";
$sql_common .= ", item_sale_limit_font_family = '".addslashes($_POST['item_sale_limit_font_family'])."' ";
$sql_common .= ", item_sale_limit_font_size = '".addslashes($_POST['item_sale_limit_font_size'])."' ";
$sql_common .= ", item_sale_limit_font_color = '".addslashes($_POST['item_sale_limit_font_color'])."' ";
$sql_common .= ", item_sale_limit_font_bold = '".addslashes($_POST['item_sale_limit_font_bold'])."' ";
$sql_common .= ", item_sale_limit_font_italic = '".addslashes($_POST['item_sale_limit_font_italic'])."' ";
$sql_common .= ", item_sale_limit_font_underline = '".addslashes($_POST['item_sale_limit_font_underline'])."' ";
$sql_common .= ", item_delivery_money_font_family = '".addslashes($_POST['item_delivery_money_font_family'])."' ";
$sql_common .= ", item_delivery_money_font_size = '".addslashes($_POST['item_delivery_money_font_size'])."' ";
$sql_common .= ", item_delivery_money_font_color = '".addslashes($_POST['item_delivery_money_font_color'])."' ";
$sql_common .= ", item_delivery_money_font_bold = '".addslashes($_POST['item_delivery_money_font_bold'])."' ";
$sql_common .= ", item_delivery_money_font_italic = '".addslashes($_POST['item_delivery_money_font_italic'])."' ";
$sql_common .= ", item_delivery_money_font_underline = '".addslashes($_POST['item_delivery_money_font_underline'])."' ";
$sql_common .= ", item_total_money_font_family = '".addslashes($_POST['item_total_money_font_family'])."' ";
$sql_common .= ", item_total_money_font_size = '".addslashes($_POST['item_total_money_font_size'])."' ";
$sql_common .= ", item_total_money_font_color = '".addslashes($_POST['item_total_money_font_color'])."' ";
$sql_common .= ", item_total_money_font_bold = '".addslashes($_POST['item_total_money_font_bold'])."' ";
$sql_common .= ", item_total_money_font_italic = '".addslashes($_POST['item_total_money_font_italic'])."' ";
$sql_common .= ", item_total_money_font_underline = '".addslashes($_POST['item_total_money_font_underline'])."' ";
$sql_common .= ", item_relation_title_font_family = '".addslashes($_POST['item_relation_title_font_family'])."' ";
$sql_common .= ", item_relation_title_font_size = '".addslashes($_POST['item_relation_title_font_size'])."' ";
$sql_common .= ", item_relation_title_font_color = '".addslashes($_POST['item_relation_title_font_color'])."' ";
$sql_common .= ", item_relation_title_font_bold = '".addslashes($_POST['item_relation_title_font_bold'])."' ";
$sql_common .= ", item_relation_title_font_italic = '".addslashes($_POST['item_relation_title_font_italic'])."' ";
$sql_common .= ", item_relation_title_font_underline = '".addslashes($_POST['item_relation_title_font_underline'])."' ";
$sql_common .= ", item_relation_money_font_family = '".addslashes($_POST['item_relation_money_font_family'])."' ";
$sql_common .= ", item_relation_money_font_size = '".addslashes($_POST['item_relation_money_font_size'])."' ";
$sql_common .= ", item_relation_money_font_color = '".addslashes($_POST['item_relation_money_font_color'])."' ";
$sql_common .= ", item_relation_money_font_bold = '".addslashes($_POST['item_relation_money_font_bold'])."' ";
$sql_common .= ", item_relation_money_font_italic = '".addslashes($_POST['item_relation_money_font_italic'])."' ";
$sql_common .= ", item_relation_money_font_underline = '".addslashes($_POST['item_relation_money_font_underline'])."' ";
$sql_common .= ", item_optiontitle_font_family = '".addslashes($_POST['item_optiontitle_font_family'])."' ";
$sql_common .= ", item_optiontitle_font_size = '".addslashes($_POST['item_optiontitle_font_size'])."' ";
$sql_common .= ", item_optiontitle_font_color = '".addslashes($_POST['item_optiontitle_font_color'])."' ";
$sql_common .= ", item_optiontitle_font_bold = '".addslashes($_POST['item_optiontitle_font_bold'])."' ";
$sql_common .= ", item_optiontitle_font_italic = '".addslashes($_POST['item_optiontitle_font_italic'])."' ";
$sql_common .= ", item_optiontitle_font_underline = '".addslashes($_POST['item_optiontitle_font_underline'])."' ";
$sql_common .= ", item_optioncontent_font_family = '".addslashes($_POST['item_optioncontent_font_family'])."' ";
$sql_common .= ", item_optioncontent_font_size = '".addslashes($_POST['item_optioncontent_font_size'])."' ";
$sql_common .= ", item_optioncontent_font_color = '".addslashes($_POST['item_optioncontent_font_color'])."' ";
$sql_common .= ", item_optioncontent_font_bold = '".addslashes($_POST['item_optioncontent_font_bold'])."' ";
$sql_common .= ", item_optioncontent_font_italic = '".addslashes($_POST['item_optioncontent_font_italic'])."' ";
$sql_common .= ", item_optioncontent_font_underline = '".addslashes($_POST['item_optioncontent_font_underline'])."' ";
$sql_common .= ", help_font_family = '".addslashes($_POST['help_font_family'])."' ";
$sql_common .= ", help_font_size = '".addslashes($_POST['help_font_size'])."' ";
$sql_common .= ", help_font_color = '".addslashes($_POST['help_font_color'])."' ";
$sql_common .= ", help_font_bold = '".addslashes($_POST['help_font_bold'])."' ";
$sql_common .= ", help_font_italic = '".addslashes($_POST['help_font_italic'])."' ";
$sql_common .= ", help_font_underline = '".addslashes($_POST['help_font_underline'])."' ";

// update
sql_query(" update $shop[design_item_table] $sql_common ");

// 썸네일 폴더 삭제
shop_delete("{$shop['path']}/data/thumb/item");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>