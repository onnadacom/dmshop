<?php
if (!defined('_DMSHOP_')) exit;
// 리스트
?>
<!-- DISPLAY 1 START //-->
<?
$display_list = "1";
?>
<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>" <? if ($dmshop_design["display".$display_id."_".$display_type."_list"] == $display_list) { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<input type="hidden" id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_category" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_category" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_category"])?>" />
<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">분류명</td>
    <td><div style="padding:15px 0;"><span id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_selection_name" class="selection_name"><? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_category"]) { ?><?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_category_name"])?><? } else { ?><a href="#" onclick="displayCategory('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>'); return false;" class="display_category">전체 분류</a><? } ?></span></div></td>
    <td width="5"></td>
    <td><a href="#" onclick="displayCategory('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>'); return false;"><img src="<?=$shop['image_path']?>/adm/selection.gif" border="0"></a></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">혜택별 출력</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_icon" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_icon" class="select"><?=$icon_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_icon").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_icon"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">정렬 방식</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort" class="select"><?=$item_sort_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_sort"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">쇼윈도 스킨</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin" class="select"><?=$showwindow_skin_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_skin"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">이미지 크기</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">가로크기</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_thumb_width" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_thumb_width"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">세로크기</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_thumb_height" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_thumb_height"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">이미지 갯수</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">가로(행)</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_count_width" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_count_width"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">개</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">세로(열)</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_count_height" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_count_height"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">개</td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0" class="select3">
<tr>
    <td class="display_subject">이미지 롤링</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">횟수</td>
    <td width="10"></td>
    <td>
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit" class="select"><?=$rolling_limit_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_rolling_limit"])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">시간</td>
    <td width="10"></td>
    <td>
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time" class="select"><?=$rolling_time_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_rolling_time"])?>");
</script>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">상단 타이틀</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype" value="0" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text3" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', '0'); shopElementFocus('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype', '0');">텍스트</td>
    <td width="30"></td>
    <td><input type="radio" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype" value="1" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text3" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', '1'); shopElementFocus('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype', '1');">이미지</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title_text" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '0') { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_title"])?>" class="input" style="width:142px;" /></td>
</tr>
</table>
</div>

<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title_file" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '1') { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_file" class="file" style="width:150px;" size="10" /></td>
</tr>
</table>

<?
$file = shop_display_box_file("display".$display_id."_".$display_type."_".$display_list."_file");

if ($file['upload_file']) {
?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_display_box.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_file_del" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
</div>
    </td>
</tr>
</table>
</div>
</div>
<!-- DISPLAY 1 END //-->

<!-- DISPLAY 2 START //-->
<?
$display_list = "2";
?>
<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>" <? if ($dmshop_design["display".$display_id."_".$display_type."_list"] == $display_list) { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">기획전명</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_plan" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_plan" class="select"><?=$plan_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_plan").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_plan"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">정렬 방식</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort" class="select"><?=$item_sort_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_sort"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">쇼윈도 스킨</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin" class="select"><?=$showwindow_skin_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_skin"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">이미지 크기</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">가로크기</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_thumb_width" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_thumb_width"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">세로크기</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_thumb_height" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_thumb_height"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">이미지 갯수</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">가로(행)</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_count_width" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_count_width"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">개</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">세로(열)</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_count_height" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_count_height"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">개</td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0" class="select3">
<tr>
    <td class="display_subject">이미지 롤링</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">횟수</td>
    <td width="10"></td>
    <td>
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit" class="select"><?=$rolling_limit_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_rolling_limit"])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">시간</td>
    <td width="10"></td>
    <td>
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time" class="select"><?=$rolling_time_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_rolling_time"])?>");
</script>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">상단 타이틀</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype" value="0" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text3" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', '0'); shopElementFocus('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype', '0');">텍스트</td>
    <td width="30"></td>
    <td><input type="radio" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype" value="1" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text3" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', '1'); shopElementFocus('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype', '1');">이미지</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title_text" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '0') { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_title"])?>" class="input" style="width:142px;" /></td>
</tr>
</table>
</div>

<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title_file" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '1') { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_file" class="file" style="width:150px;" size="10" /></td>
</tr>
</table>

<?
$file = shop_display_box_file("display".$display_id."_".$display_type."_".$display_list."_file");

if ($file['upload_file']) {
?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_display_box.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_file_del" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
</div>
    </td>
</tr>
</table>
</div>
</div>
<!-- DISPLAY 2 END //-->

<!-- DISPLAY 3 START //-->
<?
$display_list = "3";
?>
<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>" <? if ($dmshop_design["display".$display_id."_".$display_type."_list"] == $display_list) { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">상품 선택</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="displayItem('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>'); return false;"><img src="<?=$shop['image_path']?>/adm/item_selection.gif" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="5"></td></tr>
</table>

<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_item_list">
<?
$result = sql_query(" select * from $shop[display_item_table] where display_id = '".$display_id."' and display_type = '".$display_type."' and display_list = '".$display_list."' order by position desc, datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $item = sql_fetch(" select * from $shop[item_table] where id = '".$row['item_id']."' ");
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="displayItemDelete('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', '<?=$row['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/delete3.gif" border="0" class="down3"></a> <a href="<?=$shop['path']?>/item.php?id=<?=text($item['item_code'])?>" class="selection_name" target="_blank"><?=text($item['item_title'])?></a></td>
</tr>
</table>
<? } ?>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">정렬 방식</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort" class="select"><?=$item_sort_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_sort"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">쇼윈도 스킨</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin" class="select"><?=$showwindow_skin_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_skin"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">이미지 크기</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">가로크기</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_thumb_width" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_thumb_width"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">세로크기</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_thumb_height" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_thumb_height"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">이미지 갯수</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">가로(행)</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_count_width" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_count_width"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">개</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">세로(열)</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_count_height" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_count_height"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">개</td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0" class="select3">
<tr>
    <td class="display_subject">이미지 롤링</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">횟수</td>
    <td width="10"></td>
    <td>
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit" class="select"><?=$rolling_limit_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_rolling_limit"])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">시간</td>
    <td width="10"></td>
    <td>
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time" class="select"><?=$rolling_time_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_rolling_time"])?>");
</script>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">상단 타이틀</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype" value="0" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text3" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', '0'); shopElementFocus('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype', '0');">텍스트</td>
    <td width="30"></td>
    <td><input type="radio" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype" value="1" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text3" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', '1'); shopElementFocus('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype', '1');">이미지</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title_text" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '0') { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_title"])?>" class="input" style="width:142px;" /></td>
</tr>
</table>
</div>

<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title_file" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '1') { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_file" class="file" style="width:150px;" size="10" /></td>
</tr>
</table>

<?
$file = shop_display_box_file("display".$display_id."_".$display_type."_".$display_list."_file");

if ($file['upload_file']) {
?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_display_box.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_file_del" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
</div>
    </td>
</tr>
</table>
</div>
</div>
<!-- DISPLAY 3 END //-->

<!-- DISPLAY 4 START //-->
<?
$display_list = "4";
?>
<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>" <? if ($dmshop_design["display".$display_id."_".$display_type."_list"] == $display_list) { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">게시판명</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_board" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_board" class="select"><?=$board_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_board").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_board"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">정렬 방식</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort" class="select"><?=$article_sort_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_sort"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">스킨 선택</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin" class="select"><?=$article_skin_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_skin"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">표기 항목</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="checkbox" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_use1" value="1" class="checkbox" checked onclick="return false;" /></td>
    <td width="5"></td>
    <td class="display_text1">제목</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="checkbox" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_use2" value="1" class="checkbox" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_use2"]) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text1" onclick="shopElementCheck('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_use2');">작성일</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="checkbox" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_use3" value="1" class="checkbox" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_use3"]) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text1" onclick="shopElementCheck('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_use3');">작성자</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="checkbox" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_use4" value="1" class="checkbox" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_use4"]) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text1" onclick="shopElementCheck('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_use4');">댓글수</td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">게시물 갯수</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">세로(열)</td>
    <td width="10"></td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_count_height" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_count_height"])?>" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">개</td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_subject">상단 타이틀</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype" value="0" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text3" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', '0'); shopElementFocus('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype', '0');">텍스트</td>
    <td width="30"></td>
    <td><input type="radio" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype" value="1" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', this.value);" class="radio" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text3" onclick="displayTitle('<?=$display_id?>', '<?=$display_type?>', '<?=$display_list?>', '1'); shopElementFocus('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_titletype', '1');">이미지</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title_text" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '0') { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_title"])?>" class="input" style="width:142px;" /></td>
</tr>
</table>
</div>

<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_title_file" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_titletype"] == '1') { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_file" class="file" style="width:150px;" size="10" /></td>
</tr>
</table>

<?
$file = shop_display_box_file("display".$display_id."_".$display_type."_".$display_list."_file");

if ($file['upload_file']) {
?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_display_box.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_file_del" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
</div>
    </td>
</tr>
</table>
</div>
</div>
<!-- DISPLAY 4 END //-->

<!-- DISPLAY 5 START //-->
<?
$display_list = "5";
?>
<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>" <? if ($dmshop_design["display".$display_id."_".$display_type."_list"] == $display_list) { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">배너 그룹명</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_banner" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_banner" class="select"><?=$banner_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_banner").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_banner"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">정렬 방식</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort" class="select"><?=$banner_sort_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_sort").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_sort"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">스킨 선택</td>
    <td class="select2">
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin" class="select"><?=$banner_skin_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_skin").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_skin"])?>");
</script>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0" class="select3">
<tr>
    <td class="display_subject">이미지 롤링</td>
    <td>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">횟수</td>
    <td width="10"></td>
    <td>
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit" class="select"><?=$rolling_limit_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_limit").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_rolling_limit"])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="display_text1">시간</td>
    <td width="10"></td>
    <td>
<select id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time" class="select"><?=$rolling_time_option?></select>

<script type="text/javascript">
$("#display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_rolling_time").val("<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_rolling_time"])?>");
</script>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>
</div>
<!-- DISPLAY 5 END //-->

<!-- DISPLAY 6 START //-->
<?
$display_list = "6";
?>
<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>" <? if ($dmshop_design["display".$display_id."_".$display_type."_list"] == $display_list) { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">이미지 첨부</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_file" class="file" style="width:150px;" size="10" /></td>
</tr>
</table>

<?
$file = shop_display_box_file("display".$display_id."_".$display_type."_".$display_list."_file");

if ($file['upload_file']) {
?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_display_box.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_file_del" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">링크 경로</td>
    <td><input type="text" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_url" value="<?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_url"])?>" class="input" style="width:142px;" /></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="display_line none">&nbsp;</td></tr>
</table>

<div class="display_list">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td class="display_subject">링크 방식</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_urltype" value="0" class="radio" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_urltype"] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text3" onclick="shopElementFocus('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_urltype', '0');">이동</td>
    <td width="30"></td>
    <td><input type="radio" name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_urltype" value="1" class="radio" <? if ($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_urltype"] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="display_text3" onclick="shopElementFocus('formDesign', 'display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_urltype', '1');">새창</td>
</tr>
</table>
    </td>
</tr>
</table>
</div>
</div>
<!-- DISPLAY 6 END //-->

<!-- DISPLAY 7 START //-->
<?
$display_list = "7";
?>
<div id="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>" <? if ($dmshop_design["display".$display_id."_".$display_type."_list"] == $display_list) { echo "style='display:inline;'"; } else { echo "style='display:none;'"; } ?>>
<div class="display_list">
<div style="padding:15px 0;"><textarea name="display<?=$display_id?>_<?=$display_type?>_<?=$display_list?>_html" class="display_textarea"><?=text($dmshop_design["display".$display_id."_".$display_type."_".$display_list."_html"])?></textarea></div>
</div>
</div>
<!-- DISPLAY 7 END //-->