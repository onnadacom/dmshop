<?
if (!defined('_DMSHOP_')) exit;

$display_list = 4;
$display = shop_design_box_list($display_id, $display_type, $display_list);

echo "<table width='".$dmshop_design_box_type['box_width']."' border='0' cellspacing='0' cellpadding='0' style='table-layout:fixed;'><tr><td>";
echo shop_article_skin("display_{$display_id}_{$display_type}_4", $display['skin'], $display['board'], "1", $display['count_height'], "", "", "", "", "", $display['sort'], $display['use1'], $display['use2'], $display['use3'], $display['use4']); /* 레이어ID, 스킨명, 게시판ID, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식, 제목표기, 작성일표기, 작성자표기, 댓글수표기 */
echo "</td></tr></table>";
?>