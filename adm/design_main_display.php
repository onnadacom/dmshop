<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";
if ($display_id) { $display_id = preg_match("/^[0-9]+$/", $display_id) ? $display_id : ""; }
// 디스플레이 탭

// 디자인 설정
$dmshop_design = shop_design();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" class="linecolor" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#3e424e">
    <td width="1" class="linecolor"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/display_step<?=$display_id?>.gif"></td>
    <td><input type="radio" name="display<?=$display_id?>_type" value="0" onclick="displayType('<?=$display_id?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_type"] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tab_title" onclick="shopElementFocus('formDesign', 'display<?=$display_id?>_type', '0'); displayType('<?=$display_id?>', '0');">사용안함</td>
    <td width="20"></td>
    <td><input type="radio" name="display<?=$display_id?>_type" value="1" onclick="displayType('<?=$display_id?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_type"] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tab_title" onclick="shopElementFocus('formDesign', 'display<?=$display_id?>_type', '1'); displayType('<?=$display_id?>', '1');">가로 1단</td>
    <td width="20"></td>
    <td><input type="radio" name="display<?=$display_id?>_type" value="2" onclick="displayType('<?=$display_id?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_type"] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tab_title" onclick="shopElementFocus('formDesign', 'display<?=$display_id?>_type', '2'); displayType('<?=$display_id?>', '2');">가로 2단</td>
    <td width="20"></td>
    <td><input type="radio" name="display<?=$display_id?>_type" value="3" onclick="displayType('<?=$display_id?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_type"] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tab_title" onclick="shopElementFocus('formDesign', 'display<?=$display_id?>_type', '3'); displayType('<?=$display_id?>', '3');">가로 3단</td>
</tr>
</table>
    </td>
    <td width="150" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="side_title">상단여백</td>
    <td width="5"></td>
    <td><input type="text" name="display<?=$display_id?>_top" value="<?=text($dmshop_design["display".$display_id."_top"])?>" class="input" style="width:18px; background-color:#f4ffd6;" /></td>
    <td width="5"></td>
    <td class="px">px</td>
</tr>
</table>
    </td>
    <td width="10"></td>
    <td width="1" class="linecolor"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" class="linecolor" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2"></td></tr>
</table>

<div id="design_main_display<?=$display_id?>_type1"></div>
<div id="design_main_display<?=$display_id?>_type2"></div>
<div id="design_main_display<?=$display_id?>_type3"></div>

<script type="text/javascript">
setTimeout("displayTypeLoading('<?=$display_id?>', '1');", 100);
setTimeout("displayTypeLoading('<?=$display_id?>', '2');", 200);
setTimeout("displayTypeLoading('<?=$display_id?>', '3');", 300);
</script>