<?
if (!defined("_DMSHOP_")) exit;
// 기획전박스
?>
<style type="text/css">
.skin_planbox_default.title_bg {height:36px; background:url('<?=$dmshop_planbox_path?>/img/title_bg.gif') repeat-x;}
.skin_planbox_default a {text-decoration:none; display:block; padding:6px 0px 5px 0px; width:100%; background:url('<?=$dmshop_planbox_path?>/img/array.gif') no-repeat 5px center;}
.skin_planbox_default a {font-weight:bold; line-height:16px; font-size:12px; color:#717171; font-family:dotum,돋움;}
.skin_planbox_default a:hover {line-height:16px; font-size:12px; color:#333333; font-family:dotum,돋움;}
.skin_planbox_default a.hover {line-height:16px; font-size:12px; color:#333333; font-family:dotum,돋움;}
.skin_planbox_default a span {margin-left:14px;}
.skin_planbox_default .line {height:1px; background:url('<?=$dmshop_planbox_path?>/img/line.gif') repeat-x;}
.skin_planbox_default .bottom_bg {height:5px; background:url('<?=$dmshop_planbox_path?>/img/bottom_bg.gif') repeat-x;}
.skin_planbox_default p.not {padding:0px; margin-top:5px; text-align:center; line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_planbox_default title_bg">
<tr>
    <td align="center"><img src="<?=$dmshop_planbox_path?>/img/title.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="5"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_planbox_default">
<tr>
    <td>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($i > '0') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td width="10"></td><td class="line"></td><td width="10"></td></tr>
</table>
<? } ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['path']?>/plan.php?pl_id=<?=$list[$i]['id']?>" <? if ($list[$i]['id'] == $pl_id) { echo "class='hover'"; } ?>><span><?=$list[$i]['title']?></span></a></td>
</tr>
</table>
<? } ?>
<? if (!$i) { ?>
<p class="not">현재 진행중인<br />기획전이 없습니다.</p>
<? } ?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="5"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_planbox_default">
<tr><td class="bottom_bg none">&nbsp;</td></tr>
</table>