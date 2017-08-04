<?
if (!defined('_DMSHOP_')) exit;

$display_list = 6;
$display = shop_design_box_list($display_id, $display_type, $display_list);

echo "<table width='".$dmshop_design_box_type['box_width']."' border='0' cellspacing='0' cellpadding='0' style='table-layout:fixed;'><tr><td>";

$file = shop_display_box_file("display".$display_id."_".$display_type."_6_file");

if ($display['url']) {

    if ($display['urltype']) {

        echo "<a href='".shop_http($display['url'])."' target='_blank'>";

    } else {

        echo "<a href='".shop_http($display['url'])."'>";

    }

}

echo shop_display_box_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_width'], "", "");

if ($display['url']) {

    echo "</a>";

}

echo "</td></tr></table>";
?>