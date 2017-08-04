<?
if (!defined("_DMSHOP_")) exit;
// 기획전박스
?>
<style type="text/css">
.skin_planbox_default .title_bg {height:34px; background:url('<?=$dmshop_planbox_path?>/img/title_bg.gif') repeat-x;}
.skin_planbox_default a {text-decoration:none; display:block; padding:6px 0px 5px 0px; width:100%; background:url('<?=$dmshop_planbox_path?>/img/array.gif') no-repeat 5px center;}
.skin_planbox_default a {font-weight:bold; line-height:22px; font-size:12px; color:#787878; font-family:gulim,굴림;}
.skin_planbox_default a:hover {line-height:22px; font-size:12px; color:#000000; font-family:gulim,굴림;}
.skin_planbox_default a.hover {line-height:22px; font-size:12px; color:#000000; font-family:gulim,굴림;}
.skin_planbox_default a span {margin-left:14px;}
.skin_planbox_default p.not {padding:0px; margin:10px 0 0 0; text-align:center; line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_planbox_default">
<tr>
    <td width="132"><img src="<?=$dmshop_planbox_path?>/img/title.gif"></td>
    <td class="title_bg none">&nbsp;</td>
    <td width="36"><img src="<?=$dmshop_planbox_path?>/img/title_arrow.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_planbox_default">
<? for ($i=0; $i<count($list); $i++) { ?>
<tr>
    <td><a href="<?=$shop['path']?>/plan.php?pl_id=<?=$list[$i]['id']?>" <? if ($list[$i]['id'] == $pl_id) { echo "class='hover'"; } ?>><span><?=$list[$i]['title']?></span></a></td>
</tr>
<tr><td height="1" bgcolor="#e4e4e5" class="none">&nbsp;</td></tr>
<? } ?>
<? if (!$i) { ?>
<tr><td><p class="not">현재 진행중인<br />기획전이 없습니다.</p></td></tr>
<? } ?>
</table>