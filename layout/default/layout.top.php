<?
if (!defined('_DMSHOP_')) exit;

if ($page_id == 'main') {

    $layout_column = "main";

} else {

    $layout_column = "sub";

}

// 디자인 설정
$dmshop_design = shop_design();

// 메인, 서브 권장설정
if ($dmshop_design[$layout_column.'_width_use'] == '0') { $dmshop_design[$layout_column.'_menu_width'] = shop_split("|", $dmshop_design[$layout_column.'_width'], "0"); $dmshop_design[$layout_column.'_center_width'] = shop_split("|", $dmshop_design[$layout_column.'_width'], "1"); }

// 전체 가로 사이즈
$dmshop_design[$layout_column.'_layout_width'] = (int)($dmshop_design[$layout_column.'_menu_width'] + $dmshop_design[$layout_column.'_center_width'] + $dmshop_design[$layout_column.'_mc_width']);

// 메인 스타일 설정
echo "\n<style type=\"text/css\">\n";

// 배경 이미지
$file = shop_design_file($layout_column."_background_image");

if ($file['upload_file']) {

    echo "body {background:url('".$shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file']."') "; // 한칸 띄어쓴다. (IE 버그)
    if ($dmshop_design[$layout_column.'_background_image_type'] == '1') { echo "repeat-x;"; }
    else if ($dmshop_design[$layout_column.'_background_image_type'] == '2') { echo "repeat-y;"; }
    else if ($dmshop_design[$layout_column.'_background_image_type'] == '3') { echo "repeat;"; }
    else if ($dmshop_design[$layout_column.'_background_image_type'] == '4') { echo "no-repeat; background-attachment:fixed;"; } else { echo "no-repeat;"; }
    echo "}\n";

}

// 배경 색상
if ($dmshop_design[$layout_column.'_background_color']) { echo "body {background-color:#".$dmshop_design[$layout_column.'_background_color'].";}\n"; }

if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '0' || $layout_auto_set == '0') {

echo ".layout_top {width:".$dmshop_design[$layout_column.'_layout_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";
echo ".layout_left {float:left; width:".$dmshop_design[$layout_column.'_menu_width']."px;}\n";
echo ".layout_contents {width:".$dmshop_design[$layout_column.'_layout_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";
echo ".layout_contents:after {display:block; clear:both; content:'';}\n";
echo ".layout_main {float:left; width:".$dmshop_design[$layout_column.'_center_width']."px; margin-left:".$dmshop_design[$layout_column.'_mc_width']."px;}\n";
echo ".layout_bottom {position:relative; width:".$dmshop_design[$layout_column.'_layout_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";

}

else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '1' || $layout_auto_set == '1') {

echo ".layout_top {width:".$dmshop_design[$layout_column.'_layout_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";
echo ".layout_contents {width:".$dmshop_design[$layout_column.'_layout_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";
echo ".layout_contents:after {display:block; clear:both; content:'';}\n";
echo ".layout_main {float:left; width:".$dmshop_design[$layout_column.'_center_width']."px; margin-right:".$dmshop_design[$layout_column.'_mc_width']."px;}\n";
echo ".layout_left {float:left; width:".$dmshop_design[$layout_column.'_menu_width']."px;}\n";
echo ".layout_bottom {position:relative; width:".$dmshop_design[$layout_column.'_layout_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";

}

else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '2' || $layout_auto_set == '2') {

echo ".layout_top {width:".$dmshop_design[$layout_column.'_layout_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";
echo ".layout_contents {width:".$dmshop_design[$layout_column.'_layout_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";
echo ".layout_contents:after {display:block; clear:both; content:'';}\n";
echo ".layout_main {width:".$dmshop_design[$layout_column.'_layout_width']."px;}\n";
echo ".layout_bottom {position:relative; width:".$dmshop_design[$layout_column.'_layout_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";

}

else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '3' || $layout_auto_set == '3') {

echo ".layout_contents {width:".$dmshop_design[$layout_column.'_layout_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";
echo ".layout_contents:after {display:block; clear:both; content:'';}\n";
echo ".layout_left {float:left; width:".$dmshop_design[$layout_column.'_menu_width']."px;}\n";
echo ".layout_main {float:left; width:".$dmshop_design[$layout_column.'_center_width']."px; margin-left:".$dmshop_design[$layout_column.'_mc_width']."px;}\n";
echo ".layout_top {width:".$dmshop_design[$layout_column.'_center_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";
echo ".layout_bottom {position:relative; width:".$dmshop_design[$layout_column.'_center_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";

}

else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '4' || $layout_auto_set == '4') {

echo ".layout_contents {width:".$dmshop_design[$layout_column.'_layout_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";
echo ".layout_contents:after {display:block; clear:both; content:'';}\n";
echo ".layout_left {float:left; width:".$dmshop_design[$layout_column.'_menu_width']."px;}\n";
echo ".layout_main {float:left; width:".$dmshop_design[$layout_column.'_center_width']."px; margin-right:".$dmshop_design[$layout_column.'_mc_width']."px;}\n";
echo ".layout_top {width:".$dmshop_design[$layout_column.'_center_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";
echo ".layout_bottom {position:relative; width:".$dmshop_design[$layout_column.'_center_width']."px; ".shop_design_position($dmshop_design[$layout_column.'_body_position'])."}\n";

}

echo "</style>\n";

// layout 0
if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '0' || $layout_auto_set == '0') { ?>
<div class="layout_top"><? include_once("$dmshop_top_path/top.php"); ?></div>
<div class="layout_contents">
<div class="layout_left"><? include_once("$dmshop_menu_path/menu.php"); ?></div>
<div class="layout_main">
<?
}

// layout 1
else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '1' || $layout_auto_set == '1') { ?>
<div class="layout_top"><? include_once("$dmshop_top_path/top.php"); ?></div>
<div class="layout_contents">
<div class="layout_main">
<?
}

// layout 2
else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '2' || $layout_auto_set == '2') { ?>
<div class="layout_top"><? include_once("$dmshop_top_path/top.php"); ?></div>
<div class="layout_contents">
<div class="layout_main">
<?
}

// layout 3
else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '3' || $layout_auto_set == '3') { ?>
<div class="layout_contents">
<div class="layout_left"><? include_once("$dmshop_menu_path/menu.php"); ?></div>
<div class="layout_main">
<div class="layout_top"><? include_once("$dmshop_top_path/top.php"); ?></div>
<?
}

// layout 4
else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '4' || $layout_auto_set == '4') { ?>
<div class="layout_contents">
<div class="layout_main">
<div class="layout_top"><? include_once("$dmshop_top_path/top.php"); ?></div>
<? } ?>

<script type="text/javascript">
$('.layout_top_bg').css( { 'height': $('.layout_top').height()+'px' } );
</script>