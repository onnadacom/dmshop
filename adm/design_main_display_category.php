<?php
include_once("./_dmshop.php");
if ($display_id) { $display_id = preg_match("/^[0-9]+$/", $display_id) ? $display_id : ""; }
if ($display_type) { $display_type = preg_match("/^[0-9]+$/", $display_type) ? $display_type : ""; }
if ($display_list) { $display_list = preg_match("/^[0-9]+$/", $display_list) ? $display_list : ""; }
if ($category1) { $category1 = preg_match("/^[0-9]+$/", $category1) ? $category1 : ""; }
if ($category2) { $category2 = preg_match("/^[0-9]+$/", $category2) ? $category2 : ""; }
if ($category3) { $category3 = preg_match("/^[0-9]+$/", $category3) ? $category3 : ""; }
if ($category4) { $category4 = preg_match("/^[0-9]+$/", $category4) ? $category4 : ""; }
$shop['title'] = "디스플레이 박스 - 분류선택";
include_once("$shop[path]/shop.top.php");

$colspan = "11";

/*------------------------------
    ## 분류 ##
------------------------------*/

// 초기화
$tmp_option1 = "<option value='0'>1단계 분류 선택</option>";
$shopCateInput = "";
$shopCateInputLog = "";
$tmp_code = "0";
$tmp_shopCateInput_value0 = "";

// 분류 데이터
$result = sql_query(" select * from $shop[category_table] order by position asc, id asc ");
for ($i=0; $data=sql_fetch_array($result); $i++) {

    // 첫번째 분류 옵션
    if ($data['category'] == '1' && $data['code'] == '0') {

        $tmp_option1 .= "<option value='".$data['id']."'>".text($data['subject'])."</option>";
        $tmp_shopCateInput_value0 .= "update:%:".$data['id'].":%:".addslashes($data['subject']).":%:".$data['category'].":%:".$data['code']."|%|";

    }

    // 초기화
    $shopCateInput_value = "";

    // 데이터
    $result2 = sql_query(" select * from $shop[category_table] where code = '$data[id]' order by position asc, id asc ");
    for ($k=0; $code=sql_fetch_array($result2); $k++) {
    
        $shopCateInput_value .= "update:%:".$code['id'].":%:".addslashes($code['subject']).":%:".$code['category'].":%:".$code['code']."|%|";

    }

    // id별 값을 생성
    $shopCateInput .= "shopCateInput('', '{$data['id']}', '{$shopCateInput_value}');\n";
    $shopCateInputLog .= "shopCateInputLog('', '{$data['id']}', '{$data['log']}');\n";

}

// 마지막 id 값을 구한다.
$count = sql_fetch(" select * from $shop[category_table] order by id desc ");

// 데이터가 존재하면
if ($count['id']) {

    // 마지막 id 값에 1 더한다.
    $tmp_code = $count['id'] + 1;

} else {

    $tmp_code = "0";

}
?>

<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}
</style>

<script type="text/javascript" src="<?=$shop['path']?>/js/category.js"></script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d7d7d8" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#eeeeef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="title_bg2">
<tr>
    <td width="26" align="center"><img src="<?=$shop['image_path']?>/adm/position_arrow.gif"></td>
    <td><span class="bigtitle">[<?=text($dmshop_plan['title'])?>]</span> <span class="bigtitle">디스플레이 박스 - 분류선택</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#c8cdd2" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="20"></td></tr>
</table>

<input type="hidden" id="category" name="category" value="0" />
<input type="hidden" id="code" name="code" />
<input type="hidden" id="tmp_code" name="tmp_code" value="<?=$tmp_code?>" />
<input type="hidden" id="defalt_category" name="defalt_category" value="0" />
<input type="hidden" id="defalt_code1" name="defalt_code1" value="0" />
<input type="hidden" id="defalt_code2" name="defalt_code2" value="" />
<input type="hidden" id="defalt_code3" name="defalt_code3" value="" />
<input type="hidden" id="defalt_code4" name="defalt_code4" value="" />
<input type="hidden" id="defalt_code5" name="defalt_code5" value="" />
<input type="hidden" id="tmp_option" name="tmp_option" value="" />
<input type="hidden" id="code0" name="code0" value="<?=$tmp_shopCateInput_value0?>" />
<input type="hidden" id="tmp_log" name="tmp_log" value="" />
<input type="hidden" id="log0" name="log0" value="" />

<table id="inputCodeAdd" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>
<table id="inputCodeAddKind" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>
<table id="inputCodeAddLog" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>

<input type="hidden" id="subject" name="subject" value="" />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><select id="category1" name="category1" size="2" class="select_list2" onclick="shopChange('1', this.value);" ><?=$tmp_option1?></select></td>
    <td width="10"></td>
    <td><select id="category2" name="category2" size="2" class="select_list2" onclick="shopChange('2', this.value);" ><option value="">　</option></select></td>
    <td width="10"></td>
    <td><select id="category3" name="category3" size="2" class="select_list2" onclick="shopChange('3', this.value);" ><option value="">　</option></select></td>
    <td width="10"></td>
    <td><select id="category4" name="category4" size="2" class="select_list2" onclick="shopChange('4', this.value);" ><option value="">　</option></select></td>
</tr>
</table>

<script type="text/javascript">
$(function() { <?=$shopCateInput?><?=$shopCateInputLog?> });
</script>

<script type="text/javascript">
var categoryValue1 = "<?=text($category1)?>";
var categoryValue2 = "<?=text($category2)?>";
var categoryValue3 = "<?=text($category3)?>";
var categoryValue4 = "<?=text($category4)?>";
</script>

<script type="text/javascript">
$(function() { <? if ($category1) { ?>shopChange('1', categoryValue1);<? } ?><? if ($category2) { ?>shopChange('2', categoryValue2);<? } ?><? if ($category3) { ?>shopChange('3', categoryValue3);<? } ?><? if ($category4) { ?>shopChange('4', categoryValue4);<? } ?> });
</script>

<script type="text/javascript">
$(function() { <? if ($category1) { ?>$("#category1").val(categoryValue1);<? } ?><? if ($category2) { ?>$("#category2").val(categoryValue2);<? } ?><? if ($category3) { ?>$("#category3").val(categoryValue3);<? } ?><? if ($category4) { ?>$("#category4").val(categoryValue4);<? } ?> });
</script>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin:25px auto 0px auto;">
<tr>
    <td><span class="tx1">선택된 분류명</span></td>
    <td width="20"></td>
    <td><input type="text" id="ch_subject" name="ch_subject" value="" class="input" style="width:200px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="displayCategoryOk(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="window.close();"><img src="<?=$shop['image_path']?>/adm/close.gif" border="0"></a></td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:15px auto 0 auto;">
<tr>
    <td><span class="msg2">확인 버튼을 클릭하시면 선택된 분류명이 추가 됩니다.</span></td>
</tr>
</table>

<div class="page_bottom"></div>
</div>

<script type="text/javascript">
function displayCategoryOk()
{

    opener.document.getElementById("display<?=text($display_id)?>_<?=text($display_type)?>_<?=text($display_list)?>_selection_name").innerHTML = document.getElementById("ch_subject").value;
    opener.document.getElementById("display<?=text($display_id)?>_<?=text($display_type)?>_<?=text($display_list)?>_category").value = document.getElementById("code").value;

    window.close();

}
</script>

<?
include_once("$shop[path]/shop.bottom.php");
?>