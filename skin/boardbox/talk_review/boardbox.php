<?
if (!defined("_DMSHOP_")) exit;
// 게시판박스
?>
<style type="text/css">
.skin_boardbox_talk_review a {text-decoration:none; display:block; width:100%; margin-top:2px;}
.skin_boardbox_talk_review a {font-weight:bold; line-height:26px; font-size:12px; color:#787878; font-family:gulim,굴림;}
.skin_boardbox_talk_review a:hover {font-weight:bold; line-height:26px; font-size:12px; color:#000000; font-family:gulim,굴림;}
.skin_boardbox_talk_review a.hover {font-weight:bold; line-height:26px; font-size:12px; color:#000000; font-family:gulim,굴림;}
.skin_boardbox_talk_review a span {margin-left:14px;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_boardbox_talk_review">
<tr>
    <td><img src="<?=$dmshop_boardbox_path?>/img/title.gif"></td>
</tr>
</table>

<div style="border:1px solid #e4e4e4; background-color:#fcfcfc; padding:5px 0;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_boardbox_talk_review">
<? for ($i=0; $i<count($list); $i++) { ?>
<tr><td><a href="<?=$shop['url']?>/board.php?bbs_id=<?=$list[$i]['bbs_id']?>" <? if ($list[$i]['bbs_id'] == $bbs_id) { echo "class='hover'"; } ?>><span>- <?=$list[$i]['bbs_title']?></span></a></td></tr>
<? } ?>
</table>
</div>