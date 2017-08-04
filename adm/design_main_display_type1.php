<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";
if ($display_id) { $display_id = preg_match("/^[0-9]+$/", $display_id) ? $display_id : ""; }

// 가로 1단

// 디자인 설정
$dmshop_design = shop_design();

include_once("./design_main_display.query.php");
?>

<div id="display<?=$display_id?>_1" <? if ($dmshop_design["display".$display_id."_type"] == '1') { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<?
$display_type = "1";
?>

<div style="border:1px solid #d6e2ff; background-color:#f5f8ff;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="35">
    <td class="side_title">박스 가로폭</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_box_width" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_box_width"])?>" class="input" style="border:1px solid #95a9d2; width:27px;" /></td>
    <td width="5"></td>
    <td class="px">px</td>
    <td width="20"></td>
    <td class="side_title">박스 세로폭</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_box_height" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_box_height"])?>" class="input" style="border:1px solid #95a9d2; width:27px;" /></td>
    <td width="5"></td>
    <td class="px">px</td>
</tr>
</table>
</div>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="2"></td></tr>
</table>

<div style="border:1px solid #c2c2c2;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="42" bgcolor="#eeeeee">
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><span class="display_title">디스플레이</span></td>
    <td width="10"></td>
    <td class="select1">
<select id="display<?=$display_id?>_<?=$display_type?>_list" name="display<?=$display_id?>_<?=$display_type?>_list" onchange="displayList('<?=$display_id?>', '<?=$display_type?>', this.value);" class="select">
    <option value="0">선택하세요.</option>
    <option value="1">분류 상품</option>
    <option value="2">기획전 상품</option>
    <option value="3">상품 직접등록</option>
    <option value="4">게시판</option>
    <option value="5">배너</option>
    <option value="6">이미지/링크</option>
    <option value="7">HTML 태그</option>
</select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_list").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_list"])?>");
</script>
    </td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="auto">
<tr class="display_height">
    <td valign="top">
<div id="display<?=$display_id?>_<?=$display_type?>_0" <? if ($dmshop_design["display".$display_id."_".$display_type."_list"] == '0') { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="display_select">전시항목을 선택하십시요.</td>
</tr>
</table>
</div>

<?
include("./design_main_display_list.php");
?>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="2"></td></tr>
</table>
</div>