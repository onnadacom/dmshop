<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
/* 로그인 */
.skin_loginbox_default .user_name {font-weight:bold; line-height:14px; font-size:12px; color:#555555; font-family:dotum,돋움;}
.skin_loginbox_default .user_id {margin-left:3px; line-height:14px; font-size:11px; color:#848689; font-family:dotum,돋움;}
.skin_loginbox_default .user_nim {line-height:14px; font-size:11px; color:#555555; font-family:dotum,돋움;}
.skin_loginbox_default .user_level {line-height:14px; font-size:11px; color:#848689; font-family:dotum,돋움;}
.skin_loginbox_default .coupon {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.skin_loginbox_default .coupon_count {font-weight:bold; line-height:14px; font-size:11px; color:#ff3c00; font-family:dotum,돋움;}
.skin_loginbox_default .cash {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.skin_loginbox_default .cash_count {font-weight:bold; line-height:14px; font-size:11px; color:#3198f0; font-family:dotum,돋움;}
.skin_loginbox_default .edit {line-height:14px; font-size:11px; color:#848689; font-family:dotum,돋움;}
.skin_loginbox_default .mypage {line-height:14px; font-size:11px; color:#848689; font-family:dotum,돋움;}
.skin_loginbox_default .line {padding:0 4px; line-height:14px; font-size:11px; color:#cccccc; font-family:dotum,돋움;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="skin_loginbox_default">
<tr>
    <td>
<div style="border:1px solid #cccccc;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="1" bgcolor="#ffffff"></td>
    <td bgcolor="#f4f4f4">
<div style="padding:4px;">
<div style="border:1px solid #cccccc; background-color:#ffffff; padding:5px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($user_icon) { ?>
    <td valign="top"><img src="<?=$user_icon?>" width="40"></td>
    <td width="10"></td>
<? } ?>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
<tr>
    <td><span class="user_name"><?=text($dmshop_user['user_name'])?></span><span class="user_id">(<?=text($dmshop_user['user_id'])?>)</span><span class="user_nim">님</span></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
<tr>
    <td><span class="user_level">회원등급 : <?=shop_user_level($dmshop_user['user_level']);?></span></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="<?=$shop['path']?>/coupon.php"><span class="coupon">쿠폰 : </span><span class="coupon_count"><?=number_format($dmshop_coupon['total_count']);?></span></a></td>
    <td width="10" align="center"><span class="line">|</span></td>
    <td><a href="<?=$shop['path']?>/cash.php"><span class="cash">적립금 : </span><span class="cash_count"><?=number_format($dmshop_user['user_cash']);?></span></a></td>
</tr>
</table>
</div>
</div>
    </td>
    <td width="1" bgcolor="#eaeaea"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#eaeaea" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="1" bgcolor="#ffffff"></td>
    <td bgcolor="#f4f4f4">
<div style="padding:5px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($shop_user_admin) { ?>
    <td><a href="<?=$shop['path']?>/adm/" class="edit">관리홈</a></td>
<? } else { ?>
    <td><a href="<?=$shop['https_url']?>/signup_check.php" class="edit">정보수정</a></td>
<? } ?>
    <td><span class="line">|</span></td>
    <td><a href="<?=$shop['https_url']?>/mypage.php" class="mypage">마이페이지</a></td>
</tr>
</table>
    </td>
    <td width="69"><a href="<?=$shop['path']?>/signout.php"><img src="<?=$dmshop_loginbox_path?>/img/logout.gif" border="0"></a></td>
</tr>
</table>
</div>
    </td>
    <td width="1" bgcolor="#eaeaea"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#eaeaea" class="none">&nbsp;</td></tr>
</table>
</div>
    </td>
</tr>
</table>