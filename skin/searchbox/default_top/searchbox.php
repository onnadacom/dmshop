<?
if (!defined('_DMSHOP_')) exit;
// 검색스킨
?>
<form method="get" name="form_Searchbox_Default" action="<?=$shop['path']?>/search.php">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="q" value="검색어" onmouseover="if (this.value == '검색어') this.value = '';" onfocus="if (this.value == '검색어') this.value = '';" style="width:175px; height:18px; border:3px solid #419dae; border-right:0px; padding:1px 3px 0px 3px; line-height:18px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;" /></td>
    <td><input type="image" src="<?=$dmshop_searchbox_path?>/img/search.gif" border="0"></td>
</tr>
</table>
</form>