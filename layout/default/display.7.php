<?
if (!defined('_DMSHOP_')) exit;
$display_list = 7;
$display = shop_design_box_list($display_id, $display_type, $display_list);

echo "<table width='".$dmshop_design_box_type['box_width']."' border='0' cellspacing='0' cellpadding='0' style='table-layout:fixed;'><tr><td>";
if ($display['html']) { echo stripslashes($display['html']); }
echo "</td></tr></table>";
?>