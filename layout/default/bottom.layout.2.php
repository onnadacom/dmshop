<?
if (!defined('_DMSHOP_')) exit;
// 종합몰형
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center"><? include_once("$dmshop_bottom_path/bottom.service_menu.php"); ?></td>
</tr>
</table>

<?
$file = shop_design_file("bottom_logo");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="bottom">
<? include_once("$dmshop_bottom_path/bottom.information.php"); ?>
    </td>
<? if ($file['upload_file']) { ?>
    <td width="<?=(int)($file['upload_width'])?>" valign="top"><a href="<?=$shop['url']?>" onfocus="this.blur();"><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></a></td>
<? } ?>
</tr>
</table>

<? if ($dmshop_bottom['bottom_tag']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=stripslashes($dmshop_bottom['bottom_tag']);?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center"><? include_once("$dmshop_bottom_path/bottom.copyright.php"); ?></td>
</tr>
</table>