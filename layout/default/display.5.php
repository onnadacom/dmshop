<?
if (!defined('_DMSHOP_')) exit;

$display_list = 5;
$display = shop_design_box_list($display_id, $display_type, $display_list);

echo "<table width='".$dmshop_design_box_type['box_width']."' border='0' cellspacing='0' cellpadding='0' style='table-layout:fixed;'><tr><td>";
echo shop_banner_skin("display_{$display_id}_{$display_type}_5", $display['skin'], $display['banner'], "", "1", "1", $display['rolling_limit'], $display['rolling_time'], $display['sort']); /* 레이어ID, 스킨명, 배너그룹ID, 배너ID, 가로갯수, 새로갯수, 롤링횟수, 롤링시간, 정렬방식 */
echo "</td></tr></table>";
?>