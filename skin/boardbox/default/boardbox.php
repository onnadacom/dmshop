<?
if (!defined("_DMSHOP_")) exit;
// 게시판박스
?>
<style type="text/css">
.skin_boardbox_default {background-color:#ffffff;}
.skin_boardbox_default .line {height:1px; background:url('<?=$dmshop_boardbox_path?>/img/line.gif') repeat-x;}
.skin_boardbox_default a {text-decoration:none; display:block; width:100%; margin-top:2px;}
.skin_boardbox_default a {font-weight:bold; line-height:28px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.skin_boardbox_default a:hover {font-weight:bold; line-height:28px; font-size:12px; color:#000000; font-family:gulim,굴림;}
.skin_boardbox_default a.hover {font-weight:bold; line-height:28px; font-size:12px; color:#000000; font-family:gulim,굴림;}
.skin_boardbox_default a span {margin-left:14px;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_boardbox_default">
<tr>
    <td><img src="<?=$dmshop_boardbox_path?>/img/title.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_boardbox_default">
<? for ($i=0; $i<count($list); $i++) { ?>
<tr><td><a href="<?=$shop['url']?>/board.php?bbs_id=<?=$list[$i]['bbs_id']?>" <? if ($list[$i]['bbs_id'] == $bbs_id) { echo "class='hover'"; } ?>><span><?=$list[$i]['bbs_title']?></span></a></td></tr>
<tr><td height="1" class="line"></td></tr>
<? } ?>
</table>