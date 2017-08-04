<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.board_password .ic_secret {margin-top:-3px;}
.board_password .title {font-weight:bold; line-height:50px; font-size:13px; color:#787878; font-family:gulim,굴림;}
.board_password .text {font-weight:bold; line-height:24px; font-size:11px; color:#3a3a3a; font-family:dotum,돋움;}
.board_password .help {line-height:14px; font-size:11px; color:#b7b7b7; font-family:dotum,돋움;}
.board_password .input {height:21px; border:1px solid #dadada; padding:0px 3px 0px 3px;}
.board_password .input {line-height:21px; font-size:12px; color:#787878; font-family:gulim,굴림;}
</style>

<script type="text/javascript">
function articlePassword()
{

    var f = document.formPassword;

    if (f.password.value == '') {

        alert('비밀번호를 입력하세요.');
        f.password.focus();
        return false;

    }

    return true;

}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bebebe" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="100"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="board_password auto">
<tr>
    <td class="title">비밀글은 작성자와 관리자만 열람할 수 있습니다.</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="board_password auto">
<tr>
    <td>
<div style="border:1px solid #e9e9e9; background-color:#fdfdfd; padding:16px 20px;">
<form method="post" name="formPassword" action="board_password_update.php" onsubmit="return articlePassword();" autocomplete="off">
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<input type="hidden" name="article_id" value="<?=$article_id?>" />
<input type="hidden" name="reply_id" value="<?=$reply_id?>" />
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_board_path?>/img/ic_secret.gif" class="ic_secret"></td>
    <td width="10"></td>
    <td class="text">비밀번호</td>
    <td width="20"></td>
    <td><input type="password" id="password" name="password" value="" class="input" style="width:100px;" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$dmshop_board_path?>/img/btn_ok.gif" border="0" /></td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table width="355" border="0" cellspacing="0" cellpadding="0" class="auto">
<tr><td height="1" bgcolor="#e9e9e9" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="15"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="help">게시물을 작성 시 입력하신 비밀번호를 입력 하세요.</td>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="100"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#e9e9e9" class="none">&nbsp;</td></tr>
</table>

<script type="text/javascript">
document.getElementById("password").focus();
</script>