<?
if (!defined('_DMSHOP_')) exit;

// 하단 설정
$dmshop_bottom = shop_design_bottom();

echo "\n<style type=\"text/css\">\n";

// 배경
$file = shop_design_file("bottom_background_image");

if ($file['upload_file']) { echo ".layout_bottom {background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') repeat;}\n"; }

// 배경 확장
$file = shop_design_file("bottom_background_image2");

if ($file['upload_file']) { echo ".layout_bottom_bg {background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') repeat;}\n"; }

echo ".layout_bottom .service_menu .line {padding:0 5px; line-height:14px; font-size:12px; color:#eeeeee; font-family:gulim,굴림;}\n";

echo ".layout_bottom .service_menu a {\n";
if ($dmshop_bottom['bottom_servicemenu1_font_family']) { echo "font-family:".$dmshop_bottom['bottom_servicemenu1_font_family'].";\n"; }
if ($dmshop_bottom['bottom_servicemenu1_font_size']) { echo "font-size:".$dmshop_bottom['bottom_servicemenu1_font_size']."px;\n"; }
if ($dmshop_bottom['bottom_servicemenu1_font_height']) { echo "line-height:".$dmshop_bottom['bottom_servicemenu1_font_height']."px;\n"; }
if ($dmshop_bottom['bottom_servicemenu1_font_color']) { echo "color:#".$dmshop_bottom['bottom_servicemenu1_font_color'].";\n"; }
if ($dmshop_bottom['bottom_servicemenu1_font_bold']) { echo "font-weight:bold;\n"; } else { echo "font-weight:normal;\n"; }
echo "}\n";

echo ".layout_bottom .service_menu a:hover {\n";
if ($dmshop_bottom['bottom_servicemenu2_font_family']) { echo "font-family:".$dmshop_bottom['bottom_servicemenu2_font_family'].";\n"; }
if ($dmshop_bottom['bottom_servicemenu2_font_size']) { echo "font-size:".$dmshop_bottom['bottom_servicemenu2_font_size']."px;\n"; }
if ($dmshop_bottom['bottom_servicemenu2_font_height']) { echo "line-height:".$dmshop_bottom['bottom_servicemenu2_font_height']."px;\n"; }
if ($dmshop_bottom['bottom_servicemenu2_font_color']) { echo "color:#".$dmshop_bottom['bottom_servicemenu2_font_color'].";\n"; }
if ($dmshop_bottom['bottom_servicemenu2_font_bold']) { echo "font-weight:bold;\n"; } else { echo "font-weight:normal;\n"; }
echo "}\n";

/*
if ($dmshop_bottom['bottom_layout'] == '0') {

echo ".layout_bottom .layer0:after {display:block; clear:both; content:'';}\n";
echo ".layout_bottom .layer1 {float:left;}\n";
echo ".layout_bottom .layer2 {float:left; margin-top:30px;}\n";

}

else if ($dmshop_bottom['bottom_layout'] == '1') {

echo ".layout_bottom .layer0:after {display:block; clear:both; content:'';}\n";
echo ".layout_bottom .layer1 {float:left;}\n";
echo ".layout_bottom .layer2 {float:right;}\n";

}

else if ($dmshop_bottom['bottom_layout'] == '2') {

echo ".layout_bottom .layer0:after {display:block; clear:both; content:'';}\n";
echo ".layout_bottom .layer1 {float:left;}\n";
echo ".layout_bottom .layer2 {float:left;}\n";
echo ".layout_bottom .layer3 {float:right;}\n";

}
*/

echo "</style>\n";

// 레이아웃 출력
include_once("$dmshop_bottom_path/bottom.layout.".(int)($dmshop_bottom['bottom_layout']).".php");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>