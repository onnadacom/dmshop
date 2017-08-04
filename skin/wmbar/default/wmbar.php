<?
if (!defined('_DMSHOP_')) exit;
// 가로메뉴바
?>
<style type="text/css">
.skin_wmbar_default {border-bottom:3px solid #419dae;}
.skin_wmbar_default a {text-decoration:none; display:block; padding:0px 20px;}
.skin_wmbar_default a {font-weight:bold; line-height:40px; font-size:13px; color:#419dae; font-family:gulim,굴림;}
.skin_wmbar_default a:hover {font-weight:bold; line-height:40px; font-size:13px; color:#000000; font-family:gulim,굴림;}
.skin_wmbar_default a.hover {font-weight:bold; line-height:40px; font-size:13px; color:#000000; font-family:gulim,굴림;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_wmbar_default">
<tr height="40">
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($i > '0') { ?>
    <td><img src="<?=$dmshop_wmbar_path?>/img/line.gif"></td>
<? } ?>
    <td><a href="<?=$list[$i]['menu_link']?>" <? if ($list[$i]['menu_hover']) { echo "class='hover'"; } ?>><?=$list[$i]['menu_title']?></a></td>
<? } ?>
</tr>
</table>
    </td>
</tr>
</table>