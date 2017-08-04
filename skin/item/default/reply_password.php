<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
body {background-color:#f4f4f4;}

.title {font-weight:bold; line-height:15px; font-size:13px; color:#ffffff; font-family:gulim,굴림;}
.step_title {font-weight:bold; line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.help {line-height:14px; font-size:11px; color:#b7b7b7; font-family:dotum,돋움;}
.help2 {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}

.input {width:112px; height:17px; border:1px solid #cccccc; padding:1px 3px 0px 3px;}
.input {line-height:17px; font-size:12px; color:#363636; font-family:gulim,굴림;}
</style>

<script type="text/javascript">
function replySave()
{

    var f = document.formReply;

    if (f.reply_password.value == '') {

        alert('비밀번호를 입력하십시오.');
        f.reply_password.focus();
        return false;

    }

}
</script>

<form method="post" name="formReply" action="reply_password_update.php" onsubmit="return replySave();">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="item_id" value="<?=$item_id?>" />
<input type="hidden" name="reply_id" value="<?=$reply_id?>" />
<input type="hidden" name="page_id" value="<?=$page_id?>" />
<input type="hidden" name="page" value="<?=$page?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40" bgcolor="#000000">
    <td align="center" class="title"><?=$dmshop_reply_msg?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#393939" class="none">&nbsp;</td></tr>
</table>

<div style="padding:50px 150px 50px 150px; background-color:#ffffff;">
<div style="border:1px solid #e5e5e5; background-color:#f4f4f4;">
<div style="padding:15px 17px 15px 17px;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="30">
    <td><span class="step_title">비밀번호</span></td>
    <td width="10"></td>
    <td><input type="password" id="reply_password" name="reply_password" class="input" value="" /></td>
</tr>
</table>
</div>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_item_path?>/img/secret.gif" class="up2"></td>
    <td width="5"></td>
    <td class="help">
<?
if ($_GET['m'] == 'u') {

    echo "상품평 수정을 위해, 초기 입력한 비밀번호를 입력 하세요.";

}

else if ($_GET['m'] == 'd') {

    echo "상품평 삭제를 위해, 초기 입력한 비밀번호를 입력 하세요.";

}
?>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="image" src="<?=$dmshop_item_path?>/img/password_<?=$m?>.gif" border="0"></td>
</tr>
</table>
</form>

<script type="text/javascript">
document.getElementById("reply_password").focus();
</script>