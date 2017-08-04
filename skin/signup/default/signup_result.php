<?
if (!defined('_DMSHOP_')) exit;

$colspan = "13";
?>
<style type="text/css">
/* 분류 */
.signup_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.signup_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.signup_service .message {font-weight:bold; line-height:15px; font-size:13px; color:#9e9e9e; font-family:dotum,돋움;}

.signup_service .title {line-height:14px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;}
.signup_service .list {font-weight:bold; line-height:14px; font-size:12px; color:#808080; font-family:gulim,굴림;}
.signup_service .help {line-height:21px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
</style>

<div style="border:1px solid #efefef; background-color:#f7f7f7;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="signup_position">
<tr height="30">
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td><a href='".$shop['url']."/' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_signup_path."/img/arrow.gif' class='up1'></td>";
echo "<td><span class='off'>회원가입</span></td>";
?>
</tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/title1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>
    </td>
    <td width="350" valign="top"><img src="<?=$dmshop_signup_path?>/img/position3.gif"></td>
</tr>
</table>

<!-- 안내메세지 start //-->
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;" class="signup_service">
<div style="background-color:#ffffff; padding:45px 40px 45px 40px;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/title3_sub1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<?
// 적립금, 쿠폰
if ($dmshop_signup['user_signup_cash'] && $dmshop_signup['user_signup_coupon']) {

    echo "<span class='message'>감사의 마음을 담아 <font color='#fe6e1a'>10% 할인쿠폰</font>과 적립금 <font color='#3197f0'>".number_format($dmshop_signup['user_cash'])."원</font>을 드립니다.</span>";

}

// 적립금
else if ($dmshop_signup['user_signup_cash']) {

    echo "<span class='message'>감사의 마음을 담아 적립금 <font color='#3197f0'>".number_format($dmshop_signup['user_cash'])."원</font>을 드립니다.</span>";

}

// 쿠폰
else if ($dmshop_signup['user_signup_coupon']) {

    echo "<span class='message'>감사의 마음을 담아 <font color='#fe6e1a'>10% 할인쿠폰</font>을 드립니다.</span>";

} else {

    echo "<span class='message'>수고하셨습니다. <font color='#393939'>".text($dmshop_user['user_name'])."</font> 회원님, 많은 관심과 사랑 부탁드립니다.</span>";

}
?>
    </td>
</tr>
</table>
</div>
</div>
<!-- 안내메세지 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<!-- 회원가입정보 start //-->
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;" class="signup_service">
<div style="background-color:#ffffff; padding:25px 40px 25px 40px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/title3_sub2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="31">
    <td width="20"></td>
    <td width="3"><img src="<?=$dmshop_signup_path?>/img/arrow2.gif"></td>
    <td width="8"></td>
    <td width="75"><p class="title">성 명</p></td>
    <td><p class="list"><?=text($dmshop_user['user_name'])?></p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d8d8d8" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="31">
    <td width="20"></td>
    <td width="3"><img src="<?=$dmshop_signup_path?>/img/arrow2.gif"></td>
    <td width="8"></td>
    <td width="75"><p class="title">아이디</p></td>
    <td><p class="list"><?=text($dmshop_user['user_id'])?></p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d8d8d8" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="31">
    <td width="20"></td>
    <td width="3"><img src="<?=$dmshop_signup_path?>/img/arrow2.gif"></td>
    <td width="8"></td>
    <td width="75"><p class="title">이메일</p></td>
    <td><p class="list"><?=text($dmshop_user['user_email'])?></p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d8d8d8" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="31">
    <td width="20"></td>
    <td width="3"><img src="<?=$dmshop_signup_path?>/img/arrow2.gif"></td>
    <td width="8"></td>
    <td width="75"><p class="title">휴대폰</p></td>
    <td><p class="list"><?=text($dmshop_user['user_hp'])?></p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d8d8d8" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="31">
    <td width="20"></td>
    <td width="3"><img src="<?=$dmshop_signup_path?>/img/arrow2.gif"></td>
    <td width="8"></td>
    <td width="75"><p class="title">기본주소</p></td>
    <td><p class="list"><?=text($dmshop_user['user_addr1'])?> <?=text($dmshop_user['user_addr2'])?></p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d8d8d8" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="25"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><p class="help">입력하신 모든 정보는 회원님의 동의 없이 제 3자에게 제공하거나, 외부 마케팅을 목적으로 이용하지 않습니다.<br>또한 관리자는 회원님께 개인정보를 묻지 않으므로, 개인정보를 타인에게 절때 알려주지 마시기 바랍니다.</p></td>
</tr>
</table>
</div>
</div>
<!-- 회원가입정보 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="<?=$shop['url']?>"><img src="<?=$dmshop_signup_path?>/img/home.gif" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>