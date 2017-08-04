<?
if (!defined('_DMSHOP_')) exit;

$colspan = "13";
?>
<style type="text/css">
/* 분류 */
.signup_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.signup_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.signup_service .tex {clear:both; height:160px; border:1px solid #e5e5e5; overflow:auto; overflow-x:hidden; position:relative;}
.signup_service .tex div {padding:20px 20px 20px 20px; line-height:21px; font-size:12px; color:#444444; font-family:dotum,돋움;}
.signup_service label {font-weight:bold; line-height:15px; font-size:13px; color:#000000; font-family:gulim,굴림;}
.signup_service .checkbox {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:-1px;}

.signup_service .title {font-weight:bold; line-height:15px; font-size:13px; color:#000000; font-family:gulim,굴림;}
.signup_service .hyphen {line-height:15px; font-size:13px; color:#333333; font-family:gulim,굴림;}
.signup_service .help {line-height:14px; font-size:12px; color:#959595; font-family:gulim,굴림;}
.signup_service .check {line-height:21px; font-size:12px; color:#598527; font-family:gulim,굴림;}

.signup_service .input1 {width:72px; height:19px; border:1px solid #c9c9c9; padding:0px 3px 0px 3px;}
.signup_service .input1 {line-height:19px; font-size:12px; color:#414141; font-family:gulim,굴림;}

.signup_service .input2 {width:95px; height:21px; border:2px solid #c9c9c9; padding:0px 5px 0px 5px;}
.signup_service .input2 {line-height:21px; font-size:14px; color:#414141; font-family:gulim,굴림;}

.signup_service .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.signup_service .selectBox-dropdown {width:25px; height:19px;}
.signup_service .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript" src="<?=$shop['path']?>/js/util.js"></script>

<script type="text/javascript">
var user_real_check = "<?=$dmshop_signup['user_real_check']?>";
</script>

<script type="text/javascript" src="<?=$dmshop_signup_path?>/signup.js"></script>

<div id="signup_data" style="display:none;"></div>

<form method="post" name="formSignup" action="signup_form.php" onsubmit="return submitSignup();" autocomplete="off">
<input type="hidden" id="page_id" name="page_id" value="signup" />
<input type="hidden" name="m" value="" />
<div style="border:1px solid #efefef; background-color:#f7f7f7;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="signup_position">
<tr height="30">
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td><a href='".$shop['path']."/' class='home'>홈</a></td>";
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
    <td width="350" valign="top"><img src="<?=$dmshop_signup_path?>/img/position1.gif"></td>
</tr>
</table>

<!-- 이용약관 start //-->
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;" class="signup_service">
<div style="background-color:#ffffff; padding:25px 40px 25px 40px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/title1_sub1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div class="tex"><div><?=text2($dmshop_service['service_text'], 1);?></div></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="28"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td><input type="checkbox" id="check1" name="check1" value="1" class="checkbox" /></td>
    <td width="5"></td>
    <td><label for="check1">본 서비스 이용약관에 동의 합니다.</label></td>
</tr>
</table>
</div>
</div>
<!-- 이용약관 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<!-- 개인정보취급방침 start //-->
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;" class="signup_service">
<div style="background-color:#ffffff; padding:25px 40px 25px 40px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/title1_sub2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div class="tex"><div><?=text2($dmshop_service['privacy_text'], 1);?></div></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="28"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td><input type="checkbox" id="check2" name="check2" value="1" class="checkbox" /></td>
    <td width="5"></td>
    <td><label for="check2">본 개인정보 취급방침에 동의 합니다.</label></td>
</tr>
</table>
</div>
</div>
<!-- 개인정보취급방침 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<!-- 주민등록번호 start //-->
<? if ($dmshop_signup['user_real_check'] == '1') { ?>
<div style="border:1px solid #d9d9d9; padding:1px;" class="signup_service">
<input type="hidden" id="real_user_name" name="real_user_name" value="" />
<input type="hidden" id="real_user_jumin" name="real_user_jumin" value="" />
<input type="hidden" id="real_jumin_check" name="real_jumin_check" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="678" border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/title1_sub3.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<div style="background-color:#f4f4f4; padding:25px 0 25px 0;">
<table width="678" border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<div style="border:1px solid #ffffff; background-color:#d9d9d9; padding:1px;">
<div style="border:4px solid #f4f4f4; background-color:#ffffff; padding:20px 0 20px 0;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td><span class="title">성 명</span></td>
    <td width="20"></td>
    <td><input type="text" id="user_name" name="user_name" onfocus="signupFocusIn2(this);" onblur="signupFocusOut2(this);" class="input2" /></td>
    <td width="20"></td>
    <td><span class="title">주민등록번호</span></td>
    <td width="20"></td>
    <td><input type="text" id="user_jumin1" name="user_jumin1" onkeyup="moveNext('user_jumin1', 'user_jumin2', 6);" maxlength="6" onfocus="signupFocusIn2(this);" onblur="signupFocusOut2(this);" class="input2" /></td>
    <td width="25" align="center"><span class="hyphen">-</span></td>
    <td><input type="password" id="user_jumin2" name="user_jumin2" maxlength="7" onfocus="signupFocusIn2(this);" onblur="signupFocusOut2(this);" class="input2" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="signupJuminSend(); return false;">실명확인</a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td><span class="help">※ 입력하신 주민등록번호는 중복가입 방지와 비밀번호 찾기를 위해서만 사용 됩니다.</span></td>
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
</div>
</div>
<? } ?>
<!-- 주민등록번호 end //-->

<!-- 이메일 start //-->
<? if ($dmshop_signup['user_real_check'] == '2') { ?>
<div style="border:1px solid #d9d9d9; padding:1px;" class="signup_service">
<input type="hidden" id="real_email" name="real_email" value="" />
<input type="hidden" id="real_email_code" name="real_email_code" value="" />
<input type="hidden" id="real_email_check" name="real_email_check" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="678" border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/title1_sub4.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<div style="background-color:#f4f4f4; padding:25px 0 25px 0;">
<table width="678" border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<div style="border:1px solid #ffffff; background-color:#d9d9d9; padding:1px;">
<div style="border:4px solid #f4f4f4; background-color:#ffffff; padding:20px 0 20px 0;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td><span class="title">성 명</span></td>
    <td width="20"></td>
    <td><input type="text" id="user_name" name="user_name" onfocus="signupFocusIn2(this);" onblur="signupFocusOut2(this);" class="input2" /></td>
    <td width="20"></td>
    <td><span class="title">이메일 주소</span></td>
    <td width="20"></td>
    <td><input type="text" id="user_email" name="user_email" onfocus="signupFocusIn2(this);" onblur="signupFocusOut2(this);" class="input2" style="width:195px;" /></td>
    <td width="5"></td>
    <td><div id="signup_real_email_layer1" style="display:inline;"><a href="#" onclick="signupEmailSend(); return false;"><img src="<?=$dmshop_signup_path?>/img/send.gif" border="0"></a></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td><span class="help">※ 이메일 주소를 입력하고 발송버튼을 누르시면, 해당 메일주소로 인증번호를 발송해 드립니다.</span></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<div id="signup_real_email_layer2" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<div style="border:1px solid #dadada; background-color:#fffcef; padding:5px 100px 5px 100px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="title">인증번호 입력</span></td>
    <td width="20"></td>
    <td><input type="text" id="real_email_code_check" name="real_email_code_check" onfocus="signupFocusIn2(this);" onblur="signupFocusOut2(this);" class="input2" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="signupEmailCheck(); return false;"><img src="<?=$dmshop_signup_path?>/img/ok.gif" border="0"></a></td>
</tr>
</table>
</div>
</div>

<div id="signup_real_email_layer3" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<div style="border:1px solid #dadada; background-color:#fffcef; padding:5px 100px 5px 100px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class='check'>인증번호가 올바르게 입력되었습니다.<br>다음버튼을 클릭하여, 회원가입양식을 작성하세요.</span></td>
</tr>
</table>
</div>
</div>
    </td>
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
</div>
</div>
<? } ?>
<!-- 이메일 end //-->

<!-- 휴대폰 start //-->
<? if ($dmshop_signup['user_real_check'] == '3') { ?>
<div style="border:1px solid #d9d9d9; padding:1px;" class="signup_service">
<input type="hidden" id="real_hp1" name="real_hp1" value="" />
<input type="hidden" id="real_hp2" name="real_hp2" value="" />
<input type="hidden" id="real_hp3" name="real_hp3" value="" />
<input type="hidden" id="real_hp_code" name="real_hp_code" value="" />
<input type="hidden" id="real_hp_check" name="real_hp_check" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10">
    <td></td>
</tr>
</table>

<table width="678" border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/title1_sub5.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<div style="background-color:#f4f4f4; padding:25px 0 25px 0;">
<table width="678" border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<div style="border:1px solid #ffffff; background-color:#d9d9d9; padding:1px;">
<div style="border:4px solid #f4f4f4; background-color:#ffffff; padding:20px 0 20px 0;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td><span class="title">성 명</span></td>
    <td width="20"></td>
    <td><input type="text" id="user_name" name="user_name" onfocus="signupFocusIn(this);" onblur="signupFocusOut(this);" class="input1" /></td>
    <td width="20"></td>
    <td><span class="title">휴대폰 번호</span></td>
    <td width="20"></td>
    <td><select id="user_hp1" name="user_hp1" class="select"><option value="">선택</option><?=shop_option_sms2();?></select></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td><input type="text" id="user_hp2" name="user_hp2" maxlength="4" onfocus="signupFocusIn(this);" onblur="signupFocusOut(this);" class="input1" style="width:40px;" /></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td><input type="text" id="user_hp3" name="user_hp3" maxlength="4" onfocus="signupFocusIn(this);" onblur="signupFocusOut(this);" class="input1" style="width:40px;" /></td>
    <td width="10"></td>
    <td><div id="signup_real_hp_layer1" style="display:inline;"><a href="#" onclick="signupHpSend(); return false;"><img src="<?=$dmshop_signup_path?>/img/send2.gif" border="0"></a></div></td>
</tr>
</table>

<script type="text/javascript">$(document).ready( function() { $(".signup_service select").selectBox(); });</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td><span class="help">※ 휴대폰번호를 입력하고 발송버튼을 누르시면, 해당 번호로 인증번호를 발송해 드립니다.</span></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<div id="signup_real_hp_layer2" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<div style="border:1px solid #dadada; background-color:#fffcef; padding:5px 100px 5px 100px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="title">인증번호 입력</span></td>
    <td width="20"></td>
    <td><input type="text" id="real_hp_code_check" name="real_hp_code_check" onfocus="signupFocusIn2(this);" onblur="signupFocusOut2(this);" class="input2" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="signupHpCheck(); return false;"><img src="<?=$dmshop_signup_path?>/img/ok.gif" border="0"></a></td>
</tr>
</table>
</div>
</div>

<div id="signup_real_hp_layer3" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<div style="border:1px solid #dadada; background-color:#fffcef; padding:5px 100px 5px 100px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class='check'>인증번호가 올바르게 입력되었습니다.<br>다음버튼을 클릭하여, 회원가입양식을 작성하세요.</span></td>
</tr>
</table>
</div>
</div>
    </td>
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
</div>
</div>
<? } ?>
<!-- 휴대폰 end //-->

<!-- 본인인증 start //-->
<? if ($dmshop_signup['user_real_check'] == '4') { ?>
추후개발
<? } ?>
<!-- 본인인증 end //-->

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
    <td><a href="<?=$shop['path']?>/"><img src="<?=$dmshop_signup_path?>/img/cancel.gif" border="0"></a></td>
    <td width="5"></td>
    <td><input type="image" src="<?=$dmshop_signup_path?>/img/next.gif" border="0"></td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>