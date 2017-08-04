<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 13;

// 가입시 sms, 메일링 기본 동의
if ($m == '') {

    $dmshop_user['user_sms'] = 1;
    $dmshop_user['user_mailing'] = 1;

}
?>
<style type="text/css">
.signup_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.signup_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.signup_title .b1 {margin-top:6px;}
.signup_title .b2 {margin-top:7px;}
.signup_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.signup_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.signup_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.signup_service .title {font-weight:bold; line-height:14px; font-size:12px; color:#000000; font-family:gulim,굴림;}
.signup_service .sub {font-weight:bold; line-height:14px; font-size:12px; color:#808080; font-family:gulim,굴림;}
.signup_service .hyphen {line-height:15px; font-size:13px; color:#333333; font-family:gulim,굴림;}
.signup_service .help {line-height:17px; font-size:11px; color:#959595; font-family:gulim,굴림;}
.signup_service .real {line-height:17px; font-size:11px; color:#748dba; font-family:gulim,굴림;}
.signup_service .etc {line-height:14px; font-size:12px; color:#808080; font-family:gulim,굴림;}
.signup_service .etc2 {font-weight:bold; line-height:14px; font-size:12px; color:#4d6185; font-family:gulim,굴림;}
.signup_service .cash {font-weight:bold; line-height:14px; font-size:12px; color:#3197f0; font-family:gulim,굴림;}

.signup_service .check {line-height:21px; font-size:12px; color:#598527; font-family:gulim,굴림;}
.signup_service .radio {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:-1px;}
.signup_service .checkbox {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:-1px;}

.signup_service .input1 {width:150px; height:18px; border:1px solid #c9c9c9; padding:0px 3px 0px 3px;}
.signup_service .input1 {line-height:18px; font-size:12px; color:#414141; font-family:gulim,굴림;}

.signup_service .select {height:18px; border:1px solid #e4e4e4;}
.signup_service .select {line-height:18px; font-size:12px; color:#333333; font-family:dotum,돋움;}
.signup_service .select option {padding:0px 3px 0px 3px; line-height:18px; font-size:12px; color:#333333; font-family:dotum,돋움;}

.signup_service .textarea  {padding:3px; width:400px; height:118px; border:1px solid #cccccc;}
.signup_service .textarea  {line-height:15px; font-size:12px; color:#333333; font-family:dotum,돋움;}

.signup_service .line {height:1px; background-color:#d8d8d8;}

.signup_service .td {vertical-align:top;}
.signup_service .td .check {margin-top:8px;}
.signup_service .td p.title {margin-top:5px;}
</style>

<script type="text/javascript" src="<?=$shop['path']?>/js/util.js"></script>

<script type="text/javascript">
var user_real_check = "<?=text($dmshop_signup['user_real_check'])?>";
var user_id = "<?=text($dmshop_signup['user_id'])?>";
var user_pw = "<?=text($dmshop_signup['user_pw'])?>";
var user_pw_qa = "<?=text($dmshop_signup['user_pw_qa'])?>";
var user_name = "<?=text($dmshop_signup['user_name'])?>";
var user_birth = "<?=text($dmshop_signup['user_birth'])?>";
var user_sex = "<?=text($dmshop_signup['user_sex'])?>";
var user_nick = "<?=text($dmshop_signup['user_nick'])?>";
var user_hp = "<?=text($dmshop_signup['user_hp'])?>";
var user_tel = "<?=text($dmshop_signup['user_tel'])?>";
var user_addr = "<?=text($dmshop_signup['user_addr'])?>";
var user_company = "<?=text($dmshop_signup['user_company'])?>";
var user_company_tel = "<?=text($dmshop_signup['user_company_tel'])?>";
var user_company_addr = "<?=text($dmshop_signup['user_company_addr'])?>";
var user_email = "<?=text($dmshop_signup['user_email'])?>";
var user_homepage = "<?=text($dmshop_signup['user_homepage'])?>";
var user_recommend = "<?=text($dmshop_signup['user_recommend'])?>";
var user_profile = "<?=text($dmshop_signup['user_profile'])?>";
var user_robot = "<?=text($dmshop_signup['user_robot'])?>";
var user_etc = "<?=text($dmshop_signup['user_etc'])?>";
var user_etc1 = "<?=text($dmshop_signup['user_etc1'])?>";
var user_etc2 = "<?=text($dmshop_signup['user_etc2'])?>";
var user_etc3 = "<?=text($dmshop_signup['user_etc3'])?>";
var user_etc4 = "<?=text($dmshop_signup['user_etc4'])?>";
var user_etc5 = "<?=text($dmshop_signup['user_etc5'])?>";
var signup_year = "<?=date("Y", $shop['server_time']);?>";
var dmshop_signup_path = "<?=$dmshop_signup_path?>";
</script>

<script type="text/javascript" src="<?=$dmshop_signup_path?>/signup.js"></script>

<div id="signup_data" style="display:none;"></div>

<form method="post" name="formSignup" action="signup_form_update.php" onsubmit="return submitSignupForm();" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" id="page_id" name="page_id" value="signup_form" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="user_jumin" value="<?=text($user_jumin)?>" />
<? if ($m == '') { ?>
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
    <td width="350" valign="top"><img src="<?=$dmshop_signup_path?>/img/position2.gif"></td>
</tr>
</table>
<? } ?>

<? if ($m == 'u') { ?>
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
echo "<td><span class='off'>회원정보수정</span></td>";
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
<tr height="40"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="signup_title">
<tr>
    <td width="9"></td>
    <td width="123" valign="top"><img src="<?=$dmshop_signup_path?>/img/t1.gif"></td>
    <td width="10"></td>
    <td align="right"><p class="b2 t2">변경하실 항목을 입력 하신 후, 수정완료 버튼을 클릭하세요.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="14"><td></td></tr>
</table>
<? } ?>

<!-- 로그인정보입력 start //-->
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;" class="signup_service">
<div style="background-color:#ffffff; padding:25px 40px 25px 40px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($m == 'u') { ?>
    <td><img src="<?=$dmshop_signup_path?>/img/title2_sub1_edit.gif"></td>
<? } else { ?>
    <td><img src="<?=$dmshop_signup_path?>/img/title2_sub1.gif"></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<? if ($dmshop_signup['user_id']) { ?>
<input type="hidden" id="user_id_check" name="user_id_check" value="<?=text($dmshop_user['user_id'])?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_id'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title">회원 아이디</p></td>
<? if ($m == '') { ?>
    <td width="160"><input type="text" id="user_id" name="user_id" value="<?=text($dmshop_user['user_id'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="signupIdOverlap(); return false;"><img src="<?=$dmshop_signup_path?>/img/overlap.gif" border="0"></a></td>
    <td width="10"></td>
    <td><span id="user_id_message" class="help"></span></td>
<? } else { ?>
<input type="hidden" id="user_id" name="user_id" value="<?=text($dmshop_user['user_id'])?>" />
    <td><span class="sub"><?=text($dmshop_user['user_id'])?></span></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } ?>

<? if ($dmshop_signup['user_pw']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_pw'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title">비밀번호</p></td>
    <td><input type="password" id="user_pw" name="user_pw" value="" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_pw'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title">비밀번호 확인</p></td>
    <td><input type="password" id="user_pw_check" name="user_pw_check" value="" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } ?>

<? if ($dmshop_signup['user_pw_qa']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="17"></td>
    <td width="7" class="td"><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"></td>
    <td width="7"></td>
    <td width="138" class="td"><p class="title">비밀번호 재발급</p></td>
    <td class="td">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="help">비밀번호를 분실하실 경우, 비밀번호 재발급 질문/답변을 통해<br>비밀번호를 재발급 받습니다. 입력하신 질문과 답변을 잘 기억해 두세요.</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="31"><span class="sub">질문</span></td>
    <td>
<select id="user_pw_qs" name="user_pw_qs" onchange="signupPasswordQ(this.value);" class="select" style="width:319px;">
    <option value="">선택하십시오.</option>
    <option value="가장 기억에 남는 장소는?"> 가장 기억에 남는 장소는? </option>
    <option value="나의 좌우명은"> 나의 좌우명은? </option>
    <option value="나의 보물 제1호는?"> 나의 보물 제1호는? </option>
    <option value="가장 기억에 남는 선생님 성함은?"> 가장 기억에 남는 선생님 성함은? </option>
    <option value="다른 사람은 모르는 나만의 신체비밀은?"> 다른 사람은 모르는 나만의 신체비밀은? </option>
    <option value="오래도록 기억하고 싶은 날짜는?"> 오래도록 기억하고 싶은 날짜는? </option>
    <option value="받았던 선물 중 기억에 남는 독특한 선물은?"> 받았던 선물 중 기억에 남는 독특한 선물은? </option>
    <option value="가장 생각나는 친구 이름은?"> 가장 생각나는 친구 이름은? </option>
    <option value="인상 깊게 읽은 책 이름은?"> 인상 깊게 읽은 책 이름은? </option>
    <option value="읽은 책 중에서 좋아하는 구절은?"> 읽은 책 중에서 좋아하는 구절은? </option>
    <option value="내가 존경하는 인물은?"> 내가 존경하는 인물은? </option>
    <option value="다시 태어나면 되고 싶은 것은?"> 다시 태어나면 되고 싶은 것은? </option>
    <option value="내가 좋아하는 만화 캐릭터는?"> 내가 좋아하는 만화 캐릭터는? </option>
    <option value="초등학교 시절 나의 꿈은?"> 초등학교 시절 나의 꿈은? </option>
    <option value="내 휴대폰 3번에 등록된 사람은?"> 내 휴대폰 3번에 등록된 사람은? </option>
    <option value="나의 출신 초등학교는?"> 나의 출신 초등학교는? </option>
    <option value="우리집 애완동물의 이름은?"> 우리집 애완동물의 이름은? </option>
    <option value="나의 노래방 애창곡은?"> 나의 노래방 애창곡은? </option>
    <option value="가장 감명깊게 본 영화는?"> 가장 감명깊게 본 영화는? </option>
    <option value="좋아하는 스포츠 팀 이름은?"> 좋아하는 스포츠 팀 이름은? </option>
    <option value="본인의 출생지는?"> 본인의 출생지는? </option>
    <option value=""> 직접입력 </option>
</select>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="31"></td>
    <td><input type="text" name="user_pw_q" value="<?=text($dmshop_user['user_pw_q'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:310px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="31"><span class="sub">답변</span></td>
    <td><input type="text" name="user_pw_a" value="<?=text($dmshop_user['user_pw_a'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:310px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>
<? } ?>
</div>
</div>
<!-- 로그인정보입력 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<!-- 회원정보입력 start //-->
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;" class="signup_service">
<div style="background-color:#ffffff; padding:25px 40px 25px 40px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($m == 'u') { ?>
    <td><img src="<?=$dmshop_signup_path?>/img/title2_sub2_edit.gif"></td>
<? } else { ?>
    <td><img src="<?=$dmshop_signup_path?>/img/title2_sub2.gif"></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<? if ($dmshop_signup['user_name']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_name'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title">성 명</p></td>
<?
// 가입, 성명인증
if ($m == '' && $user_name) {

    echo "<td><input type='hidden' name='user_name' value='".text($user_name)."' /><span class='sub'>".text($user_name)."</span></td>";

} else {
// 수정
?>
    <td width="160"><input type="text" name="user_name" value="<?=text($dmshop_user['user_name'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" /></td>
    <td width="5"></td>
    <td><span class="help">실명 입력 (예:홍길동)</span></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } ?>

<? if ($m == '' && $dmshop_signup['user_birth']) { ?>
<input type="hidden" name="user_birth" value="<?=text($dmshop_user['user_birth'])?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_birth'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title">생년월일</p></td>
    <td width="50"><input type="text" name="user_birth1" value="<?=text($user_birth1)?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:40px;" /></td>
    <td width="5"></td>
    <td><span class="help">년</span></td>
    <td width="10"></td>
    <td width="30"><input type="text" name="user_birth2" value="<?=text($user_birth2)?>" maxlength="2" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:20px;" /></td>
    <td width="5"></td>
    <td><span class="help">월</span></td>
    <td width="10"></td>
    <td width="30"><input type="text" name="user_birth3" value="<?=text($user_birth3)?>" maxlength="2" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:20px;" /></td>
    <td width="5"></td>
    <td><span class="help">일</span></td>
    <td width="5"></td>
    <td><span class="help">(예:1990 년 01 년 01 일)</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_birth" value="<?=text($dmshop_user['user_birth'])?>" />
<? } ?>

<? if ($m == '' && $dmshop_signup['user_sex'] && $dmshop_signup['user_real_check'] != '1') { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_sex'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title">성 별</p></td>
    <td><input type="radio" name="user_sex" value="M" class="radio" <? if ($m == '' || $user_sex == 'M') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td><span class="help">남성</span></td>
    <td width="10"></td>
    <td><input type="radio" name="user_sex" value="F" class="radio" <? if ($user_sex == 'F') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td><span class="help">여성</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_sex" value="<?=text($user_sex)?>" />
<? } ?>

<? if ($dmshop_signup['user_nick']) { ?>
<input type="hidden" id="user_nick_check" name="user_nick_check" value="<?=text($dmshop_user['user_nick'])?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_nick'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title">닉네임</p></td>
    <td width="160"><input type="text" name="user_nick" value="<?=text($dmshop_user['user_nick'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="signupNickOverlap(); return false;"><img src="<?=$dmshop_signup_path?>/img/overlap.gif" border="0"></a></td>
    <td width="10"></td>
    <td><span id="user_nick_message" class="help">게시물 작성시 사용되는 닉네임 입력</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_nick" value="<?=text($dmshop_user['user_nick'])?>" />
<? } ?>

<? if ($dmshop_signup['user_hp'] || $dmshop_signup['user_real_check'] == '3') { ?>
<input type="hidden" name="user_hp" value="<?=text($user_hp)?>" />
<input type="hidden" id="real_hp1" name="real_hp1" value="<?=text($user_hp1)?>" />
<input type="hidden" id="real_hp2" name="real_hp2" value="<?=text($user_hp2)?>" />
<input type="hidden" id="real_hp3" name="real_hp3" value="<?=text($user_hp3)?>" />
<input type="hidden" id="real_hp_code" name="real_hp_code" value="<?=text($user_hp)?>" />
<input type="hidden" id="real_hp_check" name="real_hp_check" value="<?=text($user_hp)?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="17"></td>
    <td width="7" class="td"><? if ($dmshop_signup['user_hp'] == '2' || $dmshop_signup['user_hp'] == '3') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138" class="td"><p class="title">휴대폰 번호</p></td>
    <td class="td">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><select id="user_hp1" name="user_hp1" class="select"><option value="">선택</option><?=shop_option_sms2();?></select><script type="text/javascript">document.getElementById("user_hp1").value = "<?=text($user_hp1)?>";</script></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td width="50"><input type="text" id="user_hp2" name="user_hp2" value="<?=text($user_hp2)?>" maxlength="4" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:40px;" /></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td width="50"><input type="text" id="user_hp3" name="user_hp3" value="<?=text($user_hp3)?>" maxlength="4" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:40px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="7"><td></td></tr>
</table>

<? if ($dmshop_signup['user_hp'] == '3') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div id="signup_real_hp_layer1" style="display:inline;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="signupHpSend(); return false;"><img src="<?=$dmshop_signup_path?>/img/hp_real.gif" border="0"></a></td>
    <td width="10"></td>
    <td><span class="real"><? if ($m == '' && $dmshop_signup['user_real_check'] != '3') { echo "버튼을 클릭하시면, 입력하신 휴대폰 번호로 SMS 인증키가 발송 됩니다."; } else { echo "휴대폰 번호를 변경하셨다면, 인증키 발송 버튼을 클릭하여 재인증 하시기 바랍니다."; } ?></span></td>
</tr>
</table>
</div>

<div id="signup_real_hp_layer2" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><span class="etc2">인증키 입력</span></td>
    <td width="10"></td>
    <td width="60"><input type="text" id="real_hp_code_check" name="real_hp_code_check" value="<?=text($user_hp)?>" maxlength="6" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:50px;" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="signupHpCheck(); return false;"><img src="<?=$dmshop_signup_path?>/img/ok3.gif" border="0"></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="signupHpSend(); return false;"><img src="<?=$dmshop_signup_path?>/img/real_send.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="real">휴대폰으로 전송된 인증번호 6자리를 입력하세요. 인증번호 미수신시 ‘인증키 재발송’ 버튼을 클릭하세요.</span></td>
</tr>
</table>
</div>

<div id="signup_real_hp_layer3" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/hp_real_ok.gif"></td>
    <td width="10"></td>
    <td><span class="help">휴대폰 인증이 완료되었습니다.</span></td>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="checkbox" name="user_sms" value="1" class="checkbox" <? if ($dmshop_user['user_sms']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td><span class="sub">SMS 수신 동의</span></td>
    <td width="10"></td>
    <td><span class="help">본사에서 제공하는 이벤트 및 쇼핑정보를 SMS로 받아보시겠습니까?</span></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_hp" value="<?=text($dmshop_user['user_hp'])?>" />
<input type="hidden" name="user_sms" value="<?=text($dmshop_user['user_sms'])?>" />
<? } ?>

<? if ($dmshop_signup['user_tel']) { ?>
<input type="hidden" name="user_tel" value="<?=text($user_tel)?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_tel'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title">일반 전화</p></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><select id="user_tel1" name="user_tel1" class="select"><option value="">선택</option><?=shop_option_sms1();?></select><script type="text/javascript">document.getElementById("user_tel1").value = "<?=text($user_tel1)?>";</script></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td width="50"><input type="text" name="user_tel2" value="<?=text($user_tel2)?>" maxlength="4" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:40px;" /></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td width="50"><input type="text" name="user_tel3" value="<?=text($user_tel3)?>" maxlength="4" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:40px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_tel" value="<?=text($dmshop_user['user_tel'])?>" />
<? } ?>

<? if ($dmshop_signup['user_addr']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="17"></td>
    <td width="7" class="td"><? if ($dmshop_signup['user_addr'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138" class="td"><p class="title">기본 주소</p></td>
    <td class="td">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="50"><input type="text" name="user_zip1" value="<?=text($dmshop_user['user_zip1'])?>" readonly onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:40px;" /></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td width="50"><input type="text" name="user_zip2" value="<?=text($dmshop_user['user_zip2'])?>" readonly onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:40px;" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="shopZip('formSignup', 'user_zip1', 'user_zip2', 'user_addr1', 'user_addr2'); return false;"><img src="<?=$dmshop_signup_path?>/img/find_addr.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="text" name="user_addr1" value="<?=text($dmshop_user['user_addr1'])?>" readonly onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:300px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="text" name="user_addr2" value="<?=text($dmshop_user['user_addr2'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:300px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_zip1" value="<?=text($dmshop_user['user_zip1'])?>" />
<input type="hidden" name="user_zip2" value="<?=text($dmshop_user['user_zip2'])?>" />
<input type="hidden" name="user_addr1" value="<?=text($dmshop_user['user_addr1'])?>" />
<input type="hidden" name="user_addr2" value="<?=text($dmshop_user['user_addr2'])?>" />
<? } ?>

<? if ($dmshop_signup['user_company']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_company'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title">직장명</p></td>
    <td><input type="text" name="user_company" value="<?=text($dmshop_user['user_company'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_company" value="<?=text($dmshop_user['user_company'])?>" />
<? } ?>

<? if ($dmshop_signup['user_company_tel']) { ?>
<input type="hidden" name="user_company_tel" value="<?=text($user_company_tel)?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_company_tel'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title">직장 전화</p></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><select id="user_company_tel1" name="user_company_tel1" class="select"><option value="">선택</option><?=shop_option_sms1();?></select><script type="text/javascript">document.getElementById("user_company_tel1").value = "<?=text($user_company_tel1)?>";</script></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td width="50"><input type="text" name="user_company_tel2" value="<?=text($user_company_tel2)?>" maxlength="4" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:40px;" /></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td width="50"><input type="text" name="user_company_tel3" value="<?=text($user_company_tel3)?>" maxlength="4" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:40px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_company_tel" value="<?=text($dmshop_user['user_company_tel'])?>" />
<? } ?>

<? if ($dmshop_signup['user_company_addr']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="17"></td>
    <td width="7" class="td"><? if ($dmshop_signup['user_company_addr'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138" class="td"><p class="title">직장 주소</p></td>
    <td class="td">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="50"><input type="text" name="user_company_zip1" value="<?=text($dmshop_user['user_company_zip1'])?>" readonly onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:40px;" /></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td width="50"><input type="text" name="user_company_zip2" value="<?=text($dmshop_user['user_company_zip2'])?>" readonly onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:40px;" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="shopZip('formSignup', 'user_company_zip1', 'user_company_zip2', 'user_company_addr1', 'user_company_addr2'); return false;"><img src="<?=$dmshop_signup_path?>/img/find_addr.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="text" name="user_company_addr1" value="<?=text($dmshop_user['user_company_addr1'])?>" readonly onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:300px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="text" name="user_company_addr2" value="<?=text($dmshop_user['user_company_addr2'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:300px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_company_zip1" value="<?=text($dmshop_user['user_company_zip1'])?>" />
<input type="hidden" name="user_company_zip2" value="<?=text($dmshop_user['user_company_zip2'])?>" />
<input type="hidden" name="user_company_addr1" value="<?=text($dmshop_user['user_company_addr1'])?>" />
<input type="hidden" name="user_company_addr2" value="<?=text($dmshop_user['user_company_addr2'])?>" />
<? } ?>

<? if ($dmshop_signup['user_email'] || $dmshop_signup['user_real_check'] == '2') { ?>
<input type="hidden" name="user_email" value="<?=text($user_email)?>" />
<input type="hidden" id="real_email1" name="real_email1" value="<?=text($user_email1)?>" />
<input type="hidden" id="real_email2" name="real_email2" value="<?=text($user_email2)?>" />
<input type="hidden" id="real_email_code" name="real_email_code" value="<?=text($user_email)?>" />
<input type="hidden" id="real_email_check" name="real_email_check" value="<?=text($user_email)?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="17"></td>
    <td width="7" class="td"><? if ($dmshop_signup['user_email'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138" class="td"><p class="title">이메일 주소</p></td>
    <td class="td">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="100"><input type="text" name="user_email1" value="<?=text($user_email1)?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:90px;" /></td>
    <td width="20" align="center"><span class="sub">@</span></td>
    <td>
<input type="text" name="user_email2" value="<?=text($user_email2)?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:90px;" />

<select id="user_email_list" name="user_email_list" onChange="signupEmail();" class="select">
    <option value="self">직접입력</option>
    <option value="naver.com">naver.com</option>
    <option value="chol.com">chol.com</option>
    <option value="dreamwiz.com">dreamwiz.com</option>
    <option value="empal.com">empal.com</option>
    <option value="freechal.com">freechal.com</option>
    <option value="gmail.com">gmail.com</option>
    <option value="hanafos.com">hanafos.com</option>
    <option value="hanmail.net">hanmail.net</option>
    <option value="hanmir.com">hanmir.com</option>
    <option value="hitel.net">hitel.net</option>
    <option value="hotmail.com">hotmail.com</option>
    <option value="korea.com">korea.com</option>
    <option value="lycos.co.kr">lycos.co.kr</option>
    <option value="nate.com">nate.com</option>
    <option value="netian.com">netian.com</option>
    <option value="paran.com">paran.com</option>
    <option value="yahoo.com">yahoo.com</option>
    <option value="yahoo.co.kr">yahoo.co.kr</option>
</select>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="7"><td></td></tr>
</table>

<? if ($dmshop_signup['user_real_check'] == '2') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div id="signup_real_email_layer1" style="display:inline;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="signupEmailSend(); return false;"><img src="<?=$dmshop_signup_path?>/img/email_real.gif" border="0"></a></td>
    <td width="10"></td>
    <td><span class="real"><? if ($m == '' && $dmshop_signup['user_real_check'] != '2') { echo "버튼을 클릭하시면, 입력하신 이메일 주소로 인증키가 발송 됩니다."; } else { echo "이메일 주소를 변경하셨다면, 인증키 발송 버튼을 클릭하여 재인증 하시기 바랍니다."; } ?></span></td>
</tr>
</table>
</div>

<div id="signup_real_email_layer2" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><span class="etc2">인증키 입력</span></td>
    <td width="10"></td>
    <td width="60"><input type="text" id="real_email_code_check" name="real_email_code_check" value="<?=text($user_email)?>" maxlength="6" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:50px;" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="signupEmailCheck(); return false;"><img src="<?=$dmshop_signup_path?>/img/ok3.gif" border="0"></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="signupEmailSend(); return false;"><img src="<?=$dmshop_signup_path?>/img/real_send.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="real">이메일로 전송된 인증번호 6자리를 입력하세요. 인증번호 미수신시 ‘인증키 재발송’ 버튼을 클릭하세요.</span></td>
</tr>
</table>
</div>

<div id="signup_real_email_layer3" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/email_real_ok.gif"></td>
    <td width="10"></td>
    <td><span class="help">이메일 인증이 완료되었습니다.</span></td>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="checkbox" name="user_mailing" value="1" class="checkbox" <? if ($dmshop_user['user_mailing']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td><span class="sub">이메일 수신 동의</span></td>
    <td width="10"></td>
    <td><span class="help">본사에서 제공하는 이벤트 및 쇼핑정보를 메일로 받아보시겠습니까?</span></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_email" value="<?=text($dmshop_user['user_email'])?>" />
<input type="hidden" name="user_mailing" value="<?=text($dmshop_user['user_mailing'])?>" />
<? } ?>

<? if ($dmshop_signup['user_homepage']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_homepage'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title">홈페이지</p></td>
    <td><input type="text" name="user_homepage" value="<?=text($dmshop_user['user_homepage'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_homepage" value="<?=text($dmshop_user['user_homepage'])?>" />
<? } ?>

<? if ($m == '' && $dmshop_signup['user_recommend']) { ?>
<input type="hidden" id="user_recommend_check" name="user_recommend_check" value="<?=text($dmshop_user['user_recommend'])?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="17"></td>
    <td width="7" class="td"><? if ($dmshop_signup['user_recommend'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138" class="td"><p class="title">추천인 아이디</p></td>
    <td class="td">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="160"><input type="text" id="user_recommend" name="user_recommend" value="" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="signupRecommend(); return false;"><img src="<?=$dmshop_signup_path?>/img/ok2.gif" border="0"></a></td>
    <td width="10"></td>
    <td><span id="user_recommend_message" class="help">추천인 아이디 입력 후, 확인버튼을 클릭하세요.</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><span class="etc">추천인 입력시, 추천 받으신 분에게 <b class="cash"><?=text($dmshop_signup['user_recommend_cash'])?>원</b>, 입력하신 분에게 <b class="cash"><?=text($dmshop_signup['user_recommend_insert_cash'])?>원</b>의 적립금을 드립니다.</span></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10">
    <td></td>
</tr>
</table>
<? } ?>

<? if ($dmshop_signup['user_profile']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="17"></td>
    <td width="7" class="td"><? if ($dmshop_signup['user_recommend'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138" class="td"><p class="title">자기소개</p></td>
    <td class="td">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5">
    <td></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="user_profile" name="user_profile" class="textarea"><?=text($dmshop_user['user_profile']);?></textarea></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="line"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_profile" value="<?=text($dmshop_user['user_profile'])?>" />
<? } ?>

<? /* if ($m == '' && $dmshop_signup['user_robot']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="17"></td>
    <td width="7" class="td"><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"></td>
    <td width="7"></td>
    <td width="138" class="td"><p class="title">자동가입 방지</p></td>
    <td class="td">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img id="zsfImg" class="pointer"></td>
    <td width="10"></td>
    <td><span class="help">우측 이미지의 숫자를 정확히 입력하세요.<br>잘 보이지 않을 경우, 이미지를 클릭 합니다.</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="31"><span class="sub">입력</span></td>
    <td><input type="text" id="robot_key" name="robot_key" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" value="" style="width:58px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>
<? }*/ ?>
</div>
</div>
<!-- 회원정보입력 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<!-- 부가정보입력 start //-->
<? if ($dmshop_signup['user_etc'] && ($dmshop_signup['user_etc1'] || $dmshop_signup['user_etc2'] || $dmshop_signup['user_etc3'] || $dmshop_signup['user_etc4'] || $dmshop_signup['user_etc5'])) { ?>
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;" class="signup_service">
<div style="background-color:#ffffff; padding:25px 40px 25px 40px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($m == 'u') { ?>
    <td><img src="<?=$dmshop_signup_path?>/img/title2_sub3_edit.gif"></td>
<? } else { ?>
    <td><img src="<?=$dmshop_signup_path?>/img/title2_sub3.gif"></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<? if ($dmshop_signup['user_etc1']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_etc'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title"><?=text($dmshop_signup['user_etc1'])?></p></td>
    <td width="200"><input type="text" name="user_etc1" value="<?=text($dmshop_user['user_etc1'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:190px;" /></td>
    <td width="5"></td>
    <td><span class="help"><?=text($dmshop_signup['user_etc1_help'])?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_etc1" value="<?=text($dmshop_user['user_etc1'])?>" />
<? } ?>

<? if ($dmshop_signup['user_etc2']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_etc'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title"><?=text($dmshop_signup['user_etc2'])?></p></td>
    <td width="200"><input type="text" name="user_etc2" value="<?=text($dmshop_user['user_etc2'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:190px;" /></td>
    <td width="5"></td>
    <td><span class="help"><?=text($dmshop_signup['user_etc2_help'])?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_etc2" value="<?=text($dmshop_user['user_etc2'])?>" />
<? } ?>

<? if ($dmshop_signup['user_etc3']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_etc'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title"><?=text($dmshop_signup['user_etc3'])?></p></td>
    <td width="200"><input type="text" name="user_etc3" value="<?=text($dmshop_user['user_etc3'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:190px;" /></td>
    <td width="5"></td>
    <td><span class="help"><?=text($dmshop_signup['user_etc3_help'])?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_etc3" value="<?=text($dmshop_user['user_etc3'])?>" />
<? } ?>

<? if ($dmshop_signup['user_etc4']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_etc'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title"><?=text($dmshop_signup['user_etc4'])?></p></td>
    <td width="200"><input type="text" name="user_etc4" value="<?=text($dmshop_user['user_etc4'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:190px;" /></td>
    <td width="5"></td>
    <td><span class="help"><?=text($dmshop_signup['user_etc4_help'])?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_etc4" value="<?=text($dmshop_user['user_etc4'])?>" />
<? } ?>

<? if ($dmshop_signup['user_etc5']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="17"></td>
    <td width="7"><? if ($dmshop_signup['user_etc'] == '2') { ?><img src="<?=$dmshop_signup_path?>/img/check.gif" class="check"><? } ?></td>
    <td width="7"></td>
    <td width="138"><p class="title"><?=text($dmshop_signup['user_etc5'])?></p></td>
    <td width="200"><input type="text" name="user_etc5" value="<?=text($dmshop_user['user_etc5'])?>" onfocus="signupFocusIn3(this);" onblur="signupFocusOut3(this);" class="input1" style="width:190px;" /></td>
    <td width="5"></td>
    <td><span class="help"><?=text($dmshop_signup['user_etc5_help'])?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } else { ?>
<input type="hidden" name="user_etc5" value="<?=text($dmshop_user['user_etc5'])?>" />
<? } ?>
</div>
</div>
<? } else { ?>
<input type="hidden" name="user_etc1" value="<?=text($dmshop_user['user_etc1'])?>" />
<input type="hidden" name="user_etc2" value="<?=text($dmshop_user['user_etc2'])?>" />
<input type="hidden" name="user_etc3" value="<?=text($dmshop_user['user_etc3'])?>" />
<input type="hidden" name="user_etc4" value="<?=text($dmshop_user['user_etc4'])?>" />
<input type="hidden" name="user_etc5" value="<?=text($dmshop_user['user_etc5'])?>" />
<? } ?>
<!-- 부가정보입력 end //-->

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
<? if ($m == 'u') { ?>
    <td><input type="image" src="<?=$dmshop_signup_path?>/img/edit.gif" border="0"></td>
<? } else { ?>
    <td><input type="image" src="<?=$dmshop_signup_path?>/img/signup.gif" border="0"></td>
<? } ?>
    <td width="5"></td>
    <td><a href="<?=$shop['path']?>/"><img src="<?=$dmshop_signup_path?>/img/cancel.gif" border="0"></a></td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

<? /*<script type="text/javascript" src="<?=$shop['path']?>/js/zmspamfree.js"></script>*/ ?>