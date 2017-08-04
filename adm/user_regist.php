<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "4";

if ($m == '') {

    $menu_id = "401";
    $shop['title'] = "회원 등록";

} else {

    $menu_id = "400";
    $shop['title'] = "회원 수정";

}

include_once("./_top.php");

// 회원가입 설정
$dmshop_signup = shop_signup();

// 가입시 sms, 메일링 기본 동의
if ($m == '') {

    $user = array();
    $user['user_sms'] = "1";
    $user['user_mailing'] = "1";

}

else if ($m == 'u') {

    // 회원
    $user = shop_user($user_id);

    if (!$user['id']) {

        alert("존재하지 않는 회원입니다.");

    }

    // 휴대폰
    if ($user['user_hp']) {

        $user_hp = $user['user_hp'];
        $user_hp1 = shop_split("-", $user['user_hp'], "0");
        $user_hp2 = shop_split("-", $user['user_hp'], "1");
        $user_hp3 = shop_split("-", $user['user_hp'], "2");

    }

    // 일반전화
    if ($user['user_tel']) {

        $user_tel = $user['user_tel'];
        $user_tel1 = shop_split("-", $user['user_tel'], "0");
        $user_tel2 = shop_split("-", $user['user_tel'], "1");
        $user_tel3 = shop_split("-", $user['user_tel'], "2");

    }

    // 직장전화
    if ($user['user_company_tel']) {

        $user_company_tel = $user['user_company_tel'];
        $user_company_tel1 = shop_split("-", $user['user_company_tel'], "0");
        $user_company_tel2 = shop_split("-", $user['user_company_tel'], "1");
        $user_company_tel3 = shop_split("-", $user['user_company_tel'], "2");

    }

    // 이메일
    if ($user['user_email']) {

        $user_email = $user['user_email'];
        $user_email1 = shop_split("@", $user['user_email'], "0");
        $user_email2 = shop_split("@", $user['user_email'], "1");

    }


    // 생년월일
    $user_birth = $user['user_birth'];
    $user_birth1 = substr($user_birth,0,4);
    $user_birth2 = substr($user_birth,4,2);
    $user_birth3 = substr($user_birth,6,2);

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

$colspan = "6";
?>
<style type="text/css">
.contents_box {min-width:1100px;}
</style>

<script type="text/javascript" src="<?=$shop['path']?>/js/util.js"></script>

<script type="text/javascript">
// 저장
function userSubmit()
{

    var f = document.formSignup;

    // 아이디 입력
    if (f.m.value == '') {

        if (f.user_id.value == '') {

            alert("아이디를 입력하세요.");
            f.user_id.focus();
            return false;

        } else {

            retVal = isValid_id(f.user_id.value);

            if (!retVal) {

                f.user_id.focus();
                return false;

            }

        }

        if (f.m.value == '' && f.user_id_check.value == '' || f.m.value == '' && f.user_id_check.value != f.user_id.value) {

            alert("아이디 중복확인을 하세요.");
            f.user_id.focus();
            return false;

        }

    }

    // 패스워드 입력
    if (f.m.value == '' || f.m.value == 'u' && f.user_pw.value) {

        if (f.user_pw.value == "") {

            alert("비밀번호를 입력하세요.");
            f.user_pw.focus();
            return false;

        } else {

            res = isValid_passwd(f.user_pw.value);

            if (!res) {

                f.user_pw.focus();
                return false;

            }

        }

    }

    // 패스워드 qna 질문
    if (f.user_pw_q.value == '') {

        alert("비밀번호 재발급을 위한 질문을 입력 하세요.");
        f.user_pw_q.focus();
        return false;

    }

    // 패스워드 qna 답변
    if (f.user_pw_a.value == '') {

        alert("비밀번호 재발급을 위한 답변을 입력 하세요.");
        f.user_pw_a.focus();
        return false;

    }

    // 성명
    if (f.m.value == '') {

        if (f.user_name.value == '') {

            alert("성명을 입력하세요.");
            f.user_name.focus();
            return false;

        }

        if (isValid_name(f.user_name.value) == 0) {

            f.user_name.focus();
            return false;

        }

    }

    f.user_birth.value = f.user_birth1.value+f.user_birth2.value+f.user_birth3.value;

    if (f.user_nick.value == '') {

        alert("닉네임을 입력하세요.");
        f.user_nick.focus();
        return false;

    } else {

        retVal = isValid_nick(f.user_nick.value);

        if (!retVal) {

            f.user_nick.focus();
            return false;

        }

    }

    if (f.user_nick_check.value == '' || f.user_nick_check.value != f.user_nick.value) {

        alert("닉네임 중복확인을 하세요.");
        f.user_nick.focus();
        return false;

    }

    if (f.user_recommend.value && f.user_recommend_check.value != f.user_recommend.value) {

        alert("추천인 아이디 중복확인을 하세요.");
        f.user_recommend.focus();
        return false;

    }

    f.user_hp.value = f.user_hp1.value+"-"+f.user_hp2.value+"-"+f.user_hp3.value;
    f.user_tel.value = f.user_tel1.value+"-"+f.user_tel2.value+"-"+f.user_tel3.value;
    f.user_company_tel.value = f.user_company_tel1.value+"-"+f.user_company_tel2.value+"-"+f.user_company_tel3.value;
    f.user_email.value = f.user_email1.value+"@"+f.user_email2.value;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./user_regist_update.php";
    f.submit();

}

// 아이디 중복
function signupIdOverlap()
{

    var f = document.formSignup;

    if (f.user_id.value == '') {

        alert("아이디를 입력하세요.");
        f.user_id.focus();
        return false;

    } else {

        retVal = isValid_id(f.user_id.value);

        if (!retVal) {

            f.user_id.focus();
            return false;

        }

    }

    $.post("<?=$shop['path']?>/signup_user_id_check.php", {"user_id" : f.user_id.value}, function(data) {

        $("#user_id_message").html(data);

    });

}

// 닉네임 중복
function signupNickOverlap()
{

    var f = document.formSignup;

    if (f.user_nick.value == '') {

        alert("닉네임을 입력하세요.");
        f.user_nick.focus();
        return false;

    } else {

        retVal = isValid_nick(f.user_nick.value);

        if (!retVal) {

            f.user_nick.focus();
            return false;

        }

    }

    $.post("<?=$shop['path']?>/signup_user_nick_check.php", {"user_nick" : f.user_nick.value}, function(data) {

        $("#user_nick_message").html(data);

    });

}

// 패스워드 질문 선택
function signupPasswordQ(val)
{

    var f = document.formSignup;

    f.user_pw_q.value = val;

}

// 이메일 선택
function signupEmail()
{

    var f = document.formSignup;

    if (f.user_email_list.value != '' && f.user_email_list.value != 'self') {

        f.user_email2.value = f.user_email_list.value;
        f.user_email2.style.display = "none";

    }

    else if (f.user_email_list.value == 'self') {

        f.user_email2.value = "";
        f.user_email2.focus();
        f.user_email2.style.display = "";

    }

}

// 추천인 체크
function signupRecommend()
{

    var f = document.formSignup;

    if (f.user_recommend.value == '') {

        alert("추천인 아이디를 입력하세요.");
        f.user_recommend.focus();
        return false;

    }

    var f = document.formSignup;

    if (f.user_recommend.value == '') {

        alert("추천인 아이디를 입력하세요.");
        f.user_recommend.focus();
        return false;

    } else {

        retVal = isValid_id(f.user_recommend.value);

        if (!retVal) {

            f.user_recommend.focus();
            return false;

        }

    }

    $.post("<?=$shop['path']?>/signup_user_recommend_check.php", {"user_id" : f.user_recommend.value}, function(data) {

        $("#user_recommend_message").html(data);

    });

}
</script>

<div class="contents_box">
<form method="post" name="formSignup" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="210">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 로그인 정보 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><img src="<?=$shop['image_path']?>/adm/ess.gif" class="up1"> 아이디</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<input type="hidden" id="user_id_check" name="user_id_check" value="<?=text($user['user_id'])?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($m == '') { ?>
    <td><input type="text" name="user_id" value="<?=text($user['user_id'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="signupIdOverlap(); return false;"><img src="<?=$shop['image_path']?>/adm/overlap.gif" border="0"></a></td>
    <td width="10"></td>
    <td><span id="user_id_message" class="help1"></span></td>
<? } else { ?>
<input type="hidden" id="user_id" name="user_id" value="<?=text($user['user_id'])?>" />
    <td><span class="subject"><?=shop_user_id($user['user_id'], $user['user_leave_datetime']);?></span></td>
<? } ?>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><img src="<?=$shop['image_path']?>/adm/ess.gif" class="up1"> 비밀번호</td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="password" name="user_pw" value="" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><img src="<?=$shop['image_path']?>/adm/ess.gif" class="ess"> 비밀번호 재발급</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="31"><span class="tx2">질문</span></td>
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
    <td><input type="text" name="user_pw_q" value="<?=text($user['user_pw_q'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:310px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="31"><span class="tx2">답변</span></td>
    <td><input type="text" name="user_pw_a" value="<?=text($user['user_pw_a'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:310px;" /></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 회원 정보 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><img src="<?=$shop['image_path']?>/adm/ess.gif" class="up1"> 성 명</td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="user_name" value="<?=text($user['user_name'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">생년월일</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<input type="hidden" name="user_birth" value="<?=text($user['user_birth'])?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="50"><input type="text" name="user_birth1" value="<?=text($user_birth1)?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td><span class="tx2">년</span></td>
    <td width="10"></td>
    <td width="30"><input type="text" name="user_birth2" value="<?=text($user_birth2)?>" maxlength="2" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:20px;" /></td>
    <td width="5"></td>
    <td><span class="tx2">월</span></td>
    <td width="10"></td>
    <td width="30"><input type="text" name="user_birth3" value="<?=text($user_birth3)?>" maxlength="2" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:20px;" /></td>
    <td width="5"></td>
    <td><span class="tx2">일</span></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">닉네임</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<input type="hidden" id="user_nick_check" name="user_nick_check" value="<?=text($user['user_nick'])?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="user_nick" value="<?=text($user['user_nick'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="signupNickOverlap(); return false;"><img src="<?=$shop['image_path']?>/adm/overlap.gif" border="0"></a></td>
    <td width="10"></td>
    <td><span id="user_nick_message" class="help1"></span></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">성 별</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_sex" value="M" class="radio" <? if ($m == '' || $user['user_sex'] == 'M') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td onclick="shopElementFocus('formSignup', 'user_sex', '0');"><span align="center" class="tx2">남성</span></td>
    <td width="10"></td>
    <td><input type="radio" name="user_sex" value="F" class="radio" <? if ($user['user_sex'] == 'F') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td onclick="shopElementFocus('formSignup', 'user_sex', '1');"><span align="center" class="tx2">여성</span></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">휴대폰 번호</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<input type="hidden" name="user_hp" value="<?=text($user_hp)?>" />
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><select id="user_hp1" name="user_hp1" class="select"><option value="">선택</option><?=shop_option_sms2();?></select><script type="text/javascript">$("#user_hp1").val("<?=text($user_hp1)?>");</script></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td width="50"><input type="text" id="user_hp2" name="user_hp2" value="<?=text($user_hp2)?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td width="50"><input type="text" id="user_hp3" name="user_hp3" value="<?=text($user_hp3)?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="7"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="checkbox" name="user_sms" value="1" class="checkbox" <? if ($user['user_sms'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td onclick="shopElementCheck('formSignup', 'user_sms');"><span class="tx2">SMS 수신 여부</span></td>
    <td width="10"></td>
    <td class="help1">쇼핑몰에서 발송되는 SMS문자의 수신에 동의하였을 경우 자동체크</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">일반 전화</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<input type="hidden" name="user_tel" value="<?=text($user_tel)?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td>
<select id="user_tel1" name="user_tel1" class="select">
    <option value="">선택</option>
    <option value="02"  >02</option>
    <option value="031"  >031</option>
    <option value="032"  >032</option>
    <option value="033"  >033</option>
    <option value="041"  >041</option>
    <option value="042"  >042</option>
    <option value="043"  >043</option>
    <option value="050"  >050</option>
    <option value="051"  >051</option>
    <option value="052"  >052</option>
    <option value="053"  >053</option>
    <option value="054"  >054</option>
    <option value="055"  >055</option>
    <option value="061"  >061</option>
    <option value="062"  >062</option>
    <option value="063"  >063</option>
    <option value="064"  >064</option>
    <option value="010"  >010</option>
    <option value="011"  >011</option>
    <option value="016"  >016</option>
    <option value="017"  >017</option>
    <option value="018"  >018</option>
    <option value="019"  >019</option>
    <option value="013"  >013</option>
    <option value="0303"  >0303</option>
    <option value="0502"  >0502</option>
    <option value="0504"  >0504</option>
    <option value="0505"  >0505</option>
    <option value="0506"  >0506</option>
    <option value="070"  >070</option>
    <option value="080"  >080</option>
    <option value="1544">1544</option>
    <option value="1566">1566</option>
    <option value="1577">1577</option>
    <option value="1588">1588</option>
    <option value="1599">1599</option>
    <option value="1600">1600</option>
    <option value="1644">1644</option>
    <option value="1661">1661</option>
    <option value="1666">1666</option>
    <option value="1670">1670</option>
    <option value="1688">1688</option>
</select>
<script type="text/javascript">$("#user_tel1").val("<?=text($user_tel1)?>");</script>
    </td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td width="50"><input type="text" name="user_tel2" value="<?=text($user_tel2)?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td width="50"><input type="text" name="user_tel3" value="<?=text($user_tel3)?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">기본 주소</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="50"><input type="text" name="user_zip1" value="<?=text($user['user_zip1'])?>" readonly onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td width="50"><input type="text" name="user_zip2" value="<?=text($user['user_zip2'])?>" readonly onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="shopZip('formSignup', 'user_zip1', 'user_zip2', 'user_addr1', 'user_addr2'); return false;"><img src="<?=$shop['image_path']?>/adm/find_addr.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="text" name="user_addr1" value="<?=text($user['user_addr1'])?>" readonly onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:300px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="text" name="user_addr2" value="<?=text($user['user_addr2'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:300px;" /></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">직장명</td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="user_company" value="<?=text($user['user_company'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">직장 전화</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<input type="hidden" name="user_company_tel" value="<?=text($user_company_tel)?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td>
<select id="user_company_tel1" name="user_company_tel1" class="select">
    <option value="">선택</option>
    <option value="02"  >02</option>
    <option value="031"  >031</option>
    <option value="032"  >032</option>
    <option value="033"  >033</option>
    <option value="041"  >041</option>
    <option value="042"  >042</option>
    <option value="043"  >043</option>
    <option value="050"  >050</option>
    <option value="051"  >051</option>
    <option value="052"  >052</option>
    <option value="053"  >053</option>
    <option value="054"  >054</option>
    <option value="055"  >055</option>
    <option value="061"  >061</option>
    <option value="062"  >062</option>
    <option value="063"  >063</option>
    <option value="064"  >064</option>
    <option value="010"  >010</option>
    <option value="011"  >011</option>
    <option value="016"  >016</option>
    <option value="017"  >017</option>
    <option value="018"  >018</option>
    <option value="019"  >019</option>
    <option value="013"  >013</option>
    <option value="0303"  >0303</option>
    <option value="0502"  >0502</option>
    <option value="0504"  >0504</option>
    <option value="0505"  >0505</option>
    <option value="0506"  >0506</option>
    <option value="070"  >070</option>
    <option value="080"  >080</option>
    <option value="1544">1544</option>
    <option value="1566">1566</option>
    <option value="1577">1577</option>
    <option value="1588">1588</option>
    <option value="1599">1599</option>
    <option value="1600">1600</option>
    <option value="1644">1644</option>
    <option value="1661">1661</option>
    <option value="1666">1666</option>
    <option value="1670">1670</option>
    <option value="1688">1688</option>
</select>
<script type="text/javascript">$("#user_company_tel1").val("<?=text($user_company_tel1)?>");</script>
    </td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td width="50"><input type="text" name="user_company_tel2" value="<?=text($user_company_tel2)?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td width="50"><input type="text" name="user_company_tel3" value="<?=text($user_company_tel3)?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">직장 주소</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="50"><input type="text" name="user_company_zip1" value="<?=text($user['user_company_zip1'])?>" readonly onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td width="50"><input type="text" name="user_company_zip2" value="<?=text($user['user_company_zip2'])?>" readonly onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="shopZip('formSignup', 'user_company_zip1', 'user_company_zip2', 'user_company_addr1', 'user_company_addr2'); return false;"><img src="<?=$shop['image_path']?>/adm/find_addr.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="text" name="user_company_addr1" value="<?=text($user['user_company_addr1'])?>" readonly onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:300px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="text" name="user_company_addr2" value="<?=text($user['user_company_addr2'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:300px;" /></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">이메일 주소</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<input type="hidden" name="user_email" value="<?=text($user_email)?>" />
<input type="hidden" id="real_email1" name="real_email1" value="<?=text($user_email1)?>" />
<input type="hidden" id="real_email2" name="real_email2" value="<?=text($user_email2)?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="100"><input type="text" name="user_email1" value="<?=text($user_email1)?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:90px;" /></td>
    <td width="20" align="center"><span class="sub">@</span></td>
    <td>
<input type="text" name="user_email2" value="<?=text($user_email2)?>" onfocus="shopInfocus4(this);" onblur="shopOutfocus4(this);" class="input" style="width:90px;" />

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

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="checkbox" name="user_mailing" value="1" class="checkbox" <? if ($user['user_mailing']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td onclick="shopElementCheck('formSignup', 'user_mailing');"><span class="tx2">이메일 수신 동의</span></td>
    <td width="10"></td>
    <td><span class="help1">쇼핑몰에서 발송되는 이메일의 수신에 동의하였을 경우 자동체크</span></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">홈페이지</td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="user_homepage" value="<?=text($user['user_homepage'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">추천인 아이디</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<input type="hidden" id="user_recommend_check" name="user_recommend_check" value="<?=text($user['user_recommend'])?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="text" id="user_recommend" name="user_recommend" value="<?=text($user['user_recommend'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="signupRecommend(); return false;"><img src="<?=$shop['image_path']?>/adm/ok2.gif" border="0"></a></td>
    <td width="10"></td>
    <td><span id="user_recommend_message" class="help1"></span></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">자기소개</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="user_profile" name="user_profile" class="textarea1" style="width:425px; height:100px;"><?=text($user['user_profile'])?></textarea></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 부가 정보 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><? if ($dmshop_signup['user_etc1']) { echo text($dmshop_signup['user_etc1']); } else { echo "부가 수집 정보 1"; } ?></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="user_etc1" value="<?=text($user['user_etc1'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><? if ($dmshop_signup['user_etc2']) { echo text($dmshop_signup['user_etc2']); } else { echo "부가 수집 정보 2"; } ?></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="user_etc2" value="<?=text($user['user_etc2'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><? if ($dmshop_signup['user_etc3']) { echo text($dmshop_signup['user_etc3']); } else { echo "부가 수집 정보 3"; } ?></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="user_etc3" value="<?=text($user['user_etc3'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><? if ($dmshop_signup['user_etc4']) { echo text($dmshop_signup['user_etc4']); } else { echo "부가 수집 정보 4"; } ?></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="user_etc4" value="<?=text($user['user_etc4'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><? if ($dmshop_signup['user_etc5']) { echo text($dmshop_signup['user_etc5']); } else { echo "부가 수집 정보 5"; } ?></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="user_etc5" value="<?=text($user['user_etc5'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
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
    <td><a href="#" onclick="userSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./user_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2"><? if ($m == '') { echo "확인 버튼을 클릭하시면, 입력하신 정보를 바탕으로한 회원 ID가 생성 됩니다."; } else { echo "확인 버튼을 클릭하시면, 회원 정보가 저장됩니다."; } ?></td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>