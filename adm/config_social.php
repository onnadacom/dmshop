<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "9";
$menu_id = "205";
$shop['title'] = "소셜";
include_once("./_top.php");

$colspan = "6";
?>
<style type="text/css">
.contents_box {min-width:1100px;}
</style>

<script type="text/javascript">
function configSubmit()
{

    var f = document.formConfig;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./config_social_update.php";
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
    <col width="">
</colgroup>
<tr>
    <td colspan="4" class="pagetitle">:: 소셜 연동 설정 ::</td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr height="60" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">소셜이란?</td>
    <td class="bc1"></td>
    <td>
<div style="padding:15px 30px 15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">
네이버, 카카오톡, 페이스북, 트위터, 구글 등의 서비스를 연동하기 위해 API키를 발급받아 등록합니다.<br />
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
</table>

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
    <td></td>
    <td class="subject"><span class="tip0">네이버</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="150" class="tx2">Client ID</td>
    <td><input type="text" name="login_naver_id" value="<?=text($dmshop['login_naver_id'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:450px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="150" class="tx2">Client Secret</td>
    <td><input type="text" name="login_naver_secret" value="<?=text($dmshop['login_naver_secret'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:450px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="150" class="tx2">Callback URL</td>
    <td><?=$shop['url']?>/login/naver.php</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="150" class="tx2">서비스</td>
    <td><a href="https://nid.naver.com/devcenter/register.nhn" target="_blank"><u>신청하기</u></a></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip0">카카오톡</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="150" class="tx2">REST API</td>
    <td><input type="text" name="login_kakao_key" value="<?=text($dmshop['login_kakao_key'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:450px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="150" class="tx2">Redirect Path</td>
    <td>/login/kakao.php</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="150" class="tx2">서비스</td>
    <td><a href="https://developers.kakao.com/apps" target="_blank"><u>신청하기</u></a></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip0">페이스북</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="150" class="tx2">App ID</td>
    <td><input type="text" name="login_facebook_id" value="<?=text($dmshop['login_facebook_id'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:450px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="150" class="tx2">App Secret</td>
    <td><input type="text" name="login_facebook_secret" value="<?=text($dmshop['login_facebook_secret'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:450px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="150" class="tx2">서비스</td>
    <td><a href="https://developers.facebook.com/apps/" target="_blank"><u>신청하기</u></a></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip0">트위터</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="150" class="tx2">Consumer Key</td>
    <td><input type="text" name="login_twitter_key" value="<?=text($dmshop['login_twitter_key'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:450px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="150" class="tx2">Consumer Secret</td>
    <td><input type="text" name="login_twitter_secret" value="<?=text($dmshop['login_twitter_secret'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:450px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="150" class="tx2">Callback URL</td>
    <td><?=$shop['url']?>/login/twitter.php</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="150" class="tx2">서비스</td>
    <td><a href="https://apps.twitter.com/" target="_blank"><u>신청하기</u></a></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip0">Google+</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="150" class="tx2">클라이언트 ID</td>
    <td><input type="text" name="login_google_id" value="<?=text($dmshop['login_google_id'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:450px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="150" class="tx2">클라이언트 보안 비밀</td>
    <td><input type="text" name="login_google_secret" value="<?=text($dmshop['login_google_secret'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:450px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="150" class="tx2">승인된 자바스크립트 원본</td>
    <td><?=$shop['url']?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="150" class="tx2">승인된 리디렉션 URI</td>
    <td><?=$shop['url']?>/login/google.php</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="150" class="tx2">서비스</td>
    <td><a href="https://console.developers.google.com/project" target="_blank"><u>신청하기</u></a></td>
</tr>
</table>
</div>
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
    <td><a href="./config_social.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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

<?
include_once("./_bottom.php");
?>