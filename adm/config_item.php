<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "9";
$menu_id = "400";
$shop['title'] = "상품배송 안내";
include_once("./_top.php");

$colspan = "6";

// 내용이 없을 경우 br 코드 심는다.
//if (!$dmshop['item_delivery_text']) { $dmshop['item_delivery_text'] = "<br />"; }
?>
<style type="text/css">
.contents_box {min-width:1100px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    $(".tip1").simpletip({ content: '구매자가 상품 주문시 상품발송, 배송기간, 배송요금, 배송조회등의 안내' });
    $(".tip2").simpletip({ content: '위 상품배송 안내 내용을 모든 상품페이지의 배송안내에 적용합니다.' });

});
</script>

<script type="text/javascript">
function smarteditorImageAdd(irid, date, fileame)
{

    var sHTML = "<img src='<?=$shop['url']?>"+"/data/smarteditor/"+date+"/"+fileame+"' border='0'><p><br></p>";
    oEditors.getById[irid].exec("PASTE_HTML", [sHTML]);

}
</script>

<script type="text/javascript" src="<?=$shop['smarteditor_path']?>/js/HuskyEZCreator.js" charset="utf-8"></script>

<script type="text/javascript">
function configSubmit()
{

    oEditors.getById["item_delivery_text"].exec("UPDATE_CONTENTS_FIELD", []);

    var f = document.formConfig;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./config_item_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formConfig" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상품배송 안내 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip1">상품배송 안내 내용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><div style="padding:20px 0;"><textarea id="item_delivery_text" name="item_delivery_text" class="textarea1" style="width:838px; height:700px;"><?=text($dmshop['item_delivery_text']);?></textarea></div></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">변동 내용 업데이트</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="checkbox" name="item_delivery_text_all" value="1" class="checkbox" /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formConfig', 'item_delivery_text_all');">모든 상품페이지 일괄적용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="configSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./config_item.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 입력하신 설정값이 저장 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "item_delivery_text",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});
</script>

<script type="text/javascript">
$(document).ready(function() { shopTop(); });
</script>

<?
include_once("./_bottom.php");
?>