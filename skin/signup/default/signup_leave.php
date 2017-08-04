<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.signup_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.signup_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.signup_title .b1 {margin-top:6px;}
.signup_title .b2 {margin-top:7px;}
.signup_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.signup_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.signup_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.signup_msg .t1 {line-height:21px; font-size:12px; color:#958660; font-family:dotum,돋움;}

.signup_service .title {font-weight:bold; line-height:14px; font-size:12px; color:#000000; font-family:gulim,굴림;}
.signup_service .sub {line-height:14px; font-size:12px; color:#808080; font-family:gulim,굴림;}

.signup_service label {font-weight:bold; line-height:15px; font-size:13px; color:#000000; font-family:gulim,굴림;}
.signup_service .radio {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:-1px;}
.signup_service .checkbox {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:-1px;}

.signup_service .textarea  {padding:3px; width:500px; height:100px; border:1px solid #cccccc;}
.signup_service .textarea  {line-height:15px; font-size:12px; color:#333333; font-family:dotum,돋움;}

.signup_service .line {height:1px; background-color:#d8d8d8;}

.signup_service .td {vertical-align:top;}
</style>

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
echo "<td><span class='off'>회원 탈퇴</span></td>";
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
    <td width="123" valign="top"><img src="<?=$dmshop_signup_path?>/img/t2.gif"></td>
    <td width="10"></td>
    <td align="right"><p class="b2 t2">회원탈퇴시 입력하신, 개인정보 및 이용정보는 일정기간 보존 후, 파기 됩니다.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="14"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="signup_msg">
<tr>
    <td>
<div style="border:1px solid #e2cb91; background-color:#ffeec4; padding:5px;">
<div style="padding:15px 20px; background-color:#fffdea;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="t1">
<b>회원탈퇴시 주의사항</b><br>
- 주문이 진행중인 상품이 있는지 확인하시기 바랍니다. (탈퇴시 확인불가)<br>
- 보유하신 적립금과, 쿠폰은 모두 삭제되며, 재가입 후에도 복원되지 않습니다.<br>
<br>
<b>개인정보의 보존기간 및 파기절차</b><br>
- 탈퇴한 회원의 ID는 영구 보존되며, 신규회원의 가입 or 탈퇴회원의 재가입 시에도 영구적으로 사용하실 수 없습니다.<br>
- 회원가입시 입력하신 개인정보는 개인정보 취급방침 절차에 따라 다음과 같이 일정기간 보존 후, 파기 됩니다.<br>
 · 이용약관 동의 및 회원가입을 통한 개인정보 기록 : 1년<br>
 · 상품 대금결제 및 공급에 관한 기록 : 1년<br>
<br>
<b>재가입 유예기간</b><br>
- 회원탈퇴 후 7일 경과 후 재가입 가능<br>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<form method="post" name="formSignup" action="signup_leave_update.php" onsubmit="return submitSignupLeave();">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="tmp_user_pw" value="<?=text($tmp_user_pw)?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="signup_service">
<tr>
    <td>
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;">
<div style="background-color:#ffffff;">
<div style="background-color:#ffffff; padding:25px 40px 40px 40px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_signup_path?>/img/title4_sub1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="31"></td>
    <td width="115" valign="top"><p class="title">회원탈퇴 사유</p></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_leave" value="고객지원 불만" class="radio" checked /></td>
    <td width="5"></td>
    <td width="145" class="sub">고객지원 불만</td>
    <td><input type="radio" name="user_leave" value="상품종류 부족" class="radio" /></td>
    <td width="5"></td>
    <td width="145" class="sub">상품종류 부족</td>
    <td><input type="radio" name="user_leave" value="이민/장기 출국" class="radio" /></td>
    <td width="5"></td>
    <td width="145" class="sub">이민/장기 출국</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_leave" value="반품/환불 문제" class="radio" /></td>
    <td width="5"></td>
    <td width="145" class="sub">반품/환불 문제</td>
    <td><input type="radio" name="user_leave" value="상품품질 문제" class="radio" /></td>
    <td width="5"></td>
    <td width="145" class="sub">상품품질 문제</td>
    <td><input type="radio" name="user_leave" value="타인의 개인정보 사용" class="radio" /></td>
    <td width="5"></td>
    <td width="145" class="sub">타인의 개인정보 사용</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_leave" value="상품가격 불만" class="radio" /></td>
    <td width="5"></td>
    <td width="145" class="sub">상품가격 불만</td>
    <td><input type="radio" name="user_leave" value="쇼핑몰 이용장애" class="radio" /></td>
    <td width="5"></td>
    <td width="145" class="sub">쇼핑몰 이용장애</td>
    <td><input type="radio" name="user_leave" value="기타" class="radio" /></td>
    <td width="5"></td>
    <td width="145" class="sub">기타</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="31"></td>
    <td width="115" valign="top"><p class="title">전하실 말씀</p></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="user_leave_memo" name="user_leave_memo" class="textarea"></textarea></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td><input type="checkbox" id="check1" name="check1" value="1" class="checkbox" /></td>
    <td width="5"></td>
    <td><label for="check1">회원탈퇴와 관련한 내용을 모두 확인하였으며 이에 동의 합니다.</label></td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

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
    <td><input type="image" src="<?=$dmshop_signup_path?>/img/leave.gif" border="0"></td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>