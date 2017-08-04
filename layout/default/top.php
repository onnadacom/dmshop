<?
if (!defined('_DMSHOP_')) exit;

// 상단 설정
$dmshop_top = shop_design_top();

echo "\n<style type=\"text/css\">\n";

echo ".layout_top {margin-bottom:".(int)($dmshop_top['top_bottom_height'])."px;}\n";

// 배경
$file = shop_design_file("top_background_image");

if ($file['upload_file']) { echo ".layout_top_bg {background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') repeat;}\n"; }

echo ".layout_top .service_menu .line {padding:0 5px; line-height:14px; font-size:12px; color:#eeeeee; font-family:gulim,굴림;}\n";

echo ".layout_top .service_menu a {";
if ($dmshop_top['top_servicemenu1_font_family']) { echo "font-family:".$dmshop_top['top_servicemenu1_font_family'].";"; }
if ($dmshop_top['top_servicemenu1_font_size']) { echo "font-size:".$dmshop_top['top_servicemenu1_font_size']."px;"; }
if ($dmshop_top['top_servicemenu1_font_color']) { echo "color:#".$dmshop_top['top_servicemenu1_font_color'].";"; }
if ($dmshop_top['top_servicemenu1_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
echo "}\n";

echo ".layout_top .service_menu a:hover {";
if ($dmshop_top['top_servicemenu2_font_family']) { echo "font-family:".$dmshop_top['top_servicemenu2_font_family'].";"; }
if ($dmshop_top['top_servicemenu2_font_size']) { echo "font-size:".$dmshop_top['top_servicemenu2_font_size']."px;"; }
if ($dmshop_top['top_servicemenu2_font_color']) { echo "color:#".$dmshop_top['top_servicemenu2_font_color'].";"; }
if ($dmshop_top['top_servicemenu2_font_bold']) { echo "font-weight:bold;"; } else { echo "font-weight:normal;"; }
echo "}\n";

if ($dmshop_top['top_layout'] == '0') {

echo ".layout_top .layer0 {position:relative; left:0; top:0px; width:100%; text-align:center;}\n";
echo ".layout_top .layer0 .layer1 {margin:0 auto;}\n";
echo ".layout_top .layer0 .layer2 {position:absolute; right:0px; bottom:10px;}\n";

}

echo "</style>";

// 레이아웃 출력
include_once("$dmshop_top_path/top.layout.".(int)($dmshop_top['top_layout']).".php");
?>