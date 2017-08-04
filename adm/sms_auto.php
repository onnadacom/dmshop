<?php
include_once("./_dmshop.php");
$shop['title'] = "SMS 자동완성 등록";
include_once("$shop[path]/shop.top.php");
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}
</style>

<script type="text/javascript">
function configSubmit()
{

    var f = document.formConfig;

    if (f.sms_message.value == '') {

        alert('내용을 입력하십시오.');
        f.sms_message.focus();
        return false;

    }

    if (!confirm("등록하시겠습니까?")) {

        return false;

    }

    f.action = "./sms_auto_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formConfig" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="popup_bg">
    <td width="15"></td>
    <td width="11"><img src="<?=$shop['image_path']?>/adm/arrow.gif" class="up2"></td>
    <td><span style="font-weight:bold; line-height:37px; font-size:14px; color:#ffffff; font-family:gulim,굴림;">SMS 자동완성 등록</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr height="20"><td></td></tr>
</table>

<div style="background-color:#ffffff;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<div class="sms_bg2">
<div style="padding:15px 0px;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><textarea id="sms_message" name="sms_message" onkeyup="shopByte('sms_message', 'sms_message_bytes');" class="sms_message">등록하실 내용을 입력 하세요.</textarea></td>
</tr>
</table>
</div>
</div>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes">0</span> / 80 바이트</td>
</tr>
</table>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="configSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인버튼을 클릭하시면 SMS자동완성이 추가 됩니다.</td>
</tr>
</table>
</form>
</div>

<script type="text/javascript">
$(function() {

    $("#sms_message").mouseenter(function() {

        if ($("#sms_message").val() == '등록하실 내용을 입력 하세요.') {

            $("#sms_message").val("");

        }

    });

});
</script>

<?
include_once("$shop[path]/shop.bottom.php");
?>