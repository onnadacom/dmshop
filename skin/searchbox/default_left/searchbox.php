<?
if (!defined('_DMSHOP_')) exit;
// 검색스킨
?>
<form method="get" name="form_Searchbox_Default" action="<?=$shop['path']?>/search.php">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td style="height:5px; background:url('<?=$dmshop_searchbox_path?>/img/bg_top.gif') repeat-x;" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#ffffff;">
<tr height="37">
    <td width="48"><img src="<?=$dmshop_searchbox_path?>/img/title.gif"></td>
    <td><input type="text" name="q" value="검색어" onmouseover="if (this.value == '검색어') this.value = '';" onfocus="if (this.value == '검색어') this.value = '';" style="width:100%; height:21px; border:1px solid #cccccc; padding:0px 3px 0px 3px; line-height:21px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;" /></td>
    <td width="26"><input type="image" src="<?=$dmshop_searchbox_path?>/img/search.gif" border="0"></td>
    <td width="7"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td style="height:5px; background:url('<?=$dmshop_searchbox_path?>/img/bg_bottom.gif') repeat-x;" class="none">&nbsp;</td></tr>
</table>
</form>