<?
if (!defined('_DMSHOP_')) exit;
// 세로메뉴바
?>
<style type="text/css">
.hmbar_default .title_bg {height:50px; background:url('<?=$dmshop_hmbar_path?>/img/title_bg.gif') repeat-x;}
.hmbar_default a {text-decoration:none; display:block; padding:6px 0px 5px 0px; width:100%; background:url('<?=$dmshop_hmbar_path?>/img/arrow_off.gif') no-repeat 15px center; background-color:#419dae;}
.hmbar_default a {font-weight:bold; line-height:16px; font-size:13px; color:#daf9ff; font-family:gulim,굴림;}
.hmbar_default a:hover {font-weight:bold; line-height:16px; font-size:13px; color:#daf9ff; font-family:gulim,굴림; background:url('<?=$dmshop_hmbar_path?>/img/arrow_on.gif') no-repeat 15px center; background-color:#347e8b;}
.hmbar_default a.hover {font-weight:bold; line-height:16px; font-size:13px; color:#daf9ff; font-family:gulim,굴림; background:url('<?=$dmshop_hmbar_path?>/img/arrow_on.gif') no-repeat 15px center; background-color:#347e8b;}
.hmbar_default a span {margin-left:27px;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hmbar_default">
<tr>
    <td width="185"><img src="<?=$dmshop_hmbar_path?>/img/title.gif"></td>
    <td class="title_bg none">&nbsp;</td>
    <td width="5"><img src="<?=$dmshop_hmbar_path?>/img/title_side.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hmbar_default">
<? for ($i=0; $i<count($list); $i++) { ?>
<tr><td><a href="<?=$list[$i]['menu_link']?>" <? if ($list[$i]['menu_hover']) { echo "class='hover'"; } ?>><span><?=$list[$i]['menu_title']?></span></a></td></tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td bgcolor="#419dae" height="10" class="none">&nbsp;</td></tr>
</table>