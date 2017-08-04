<?
if (!defined('_DMSHOP_')) exit;
// 전문 스토어형
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><? $file = shop_design_file("top_logo"); if ($file['upload_file']) { echo "<a href='".$shop['url']."'>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</a>"; } ?></td>
    <td>
<?
if ($dmshop_top['top_menubar_use']) {

    echo shop_wmbar_skin($dmshop_top['top_menubar_skin']);

}
?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><? if ($dmshop_top['top_article']) { echo shop_article_skin("layout_top_article", $dmshop_top['top_article_skin'], $dmshop_top['top_article'], $dmshop_top['top_article_width'], $dmshop_top['top_article_height'], "", "", "", "", "", $dmshop_top['top_article_sort'], 1, $dmshop_top['top_article_use1'], $dmshop_top['top_article_use2'], $dmshop_top['top_article_use3']); /* 레이어ID, 스킨명, 게시판ID, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식, 제목표기, 작성일표기, 작성자표기, 댓글수표기 */ } ?></td>
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><? include_once("$dmshop_top_path/top.service_menu.php"); ?></td>
    <td width="10"></td>
    <td><?=shop_searchbox_skin($dmshop_top['top_searchbox_skin']);?></td>
</tr>
</table></td>
</tr>
</table>