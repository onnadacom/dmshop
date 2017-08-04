<?
if (!defined('_DMSHOP_')) exit;

$colspan = "13";
?>
<style type="text/css">
.signup_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.signup_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.signup_title .t1 {margin-top:20px; line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}

.signup_msg .t1 {line-height:21px; font-size:12px; color:#958660; font-family:dotum,돋움;}

.signup_code .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#000000; font-family:gulim,굴림;}
.signup_code .t2 {font-weight:bold; line-height:15px; font-size:13px; color:#000000; font-family:gulim,굴림;}
.signup_code .input {width:190px; height:20px; border:2px solid #777777; padding:1px 3px 0px 3px;}
.signup_code .input {line-height:19px; font-size:12px; color:#848689; font-family:gulim,굴림;}
</style>

<script type="text/javascript" src="<?=$shop['path']?>/js/util.js"></script>
<script type="text/javascript" src="<?=$dmshop_signup_path?>/signup.js"></script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="signup_position">
<tr height="34" bgcolor="#f8f8f8">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td width='10'></td>";
echo "<td><a href='".$shop['path']."/' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_signup_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['path']."/mypage.php' class='off'>마이페이지</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_signup_path."/img/arrow.gif' class='up1'></td>";
echo "<td><span class='off'>비밀번호 확인</span></td>";
?>
</tr>
</table>
    </td>
</tr>
</table>

<?
// 회원등급 및 기타정보
include_once("$dmshop_mypage_path/information.php");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<form method="post" name="formSignup" action="<?=$action?>" onsubmit="return submitSignupCheck();">
<input type="hidden" name="m" value="<?=$m?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="signup_code">
<tr>
    <td>
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;">
<div style="background-color:#ffffff;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="95"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="220">
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/lock.gif"></td>
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="75" class="t1">아이디</td>
    <td class="t2"><?=$dmshop_user['user_id']?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="75" class="t1">비밀번호</td>
    <td><input type="password" name="user_pw" value="" class="input up1" /></td>
    <td width="5"></td>
    <td><input type="image" src="<?=$dmshop_signup_path?>/img/ok4.gif" border="0"></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
<? if ($m == 'd') { ?>
    <td><img src="<?=$dmshop_signup_path?>/img/msg2.gif"></td>
<? } else { ?>
    <td><img src="<?=$dmshop_signup_path?>/img/msg1.gif"></td>
<? } ?>
</tr>
</table>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>