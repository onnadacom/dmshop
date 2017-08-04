<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "9";
$menu_id = "300";
$shop['title'] = "회원가입 양식";
include_once("./_top.php");

$colspan = "6";

$dmshop_signup = sql_fetch(" select * from $shop[signup_table] ");
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .select3 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select3 .selectBox-dropdown {width:100px; height:19px;}
.contents_box .select3 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    shopCurrent();

    $(".contents_box .select3 select").selectBox();

    $(".tip1").simpletip({ content: '- 이메일 인증 : 가입 예정자의 이메일로 인증번호를 발송하여, 입력하는 방식입니다.<br />- 휴대폰 인증 : 가입 예정자의 휴대폰 번호로 인증번호를 발송하여, 입력하는 방식입니다.<br />- 사용안함 : 가입 인증 절차를 생략하고, 약관 동의 후 바로 가입을 진행합니다.' });
    $(".tip2").simpletip({ content: '1일 실명인증 횟수 제한을 입력합니다.' });
    $(".tip3").simpletip({ content: '쇼핑몰 회원이 로그인시, 사용하는 ID' });
    $(".tip4").simpletip({ content: '쇼핑몰 회원이 로그인시, ID 인증을 위해 사용하는 비밀번호(PASSWORD)를 말함' });
    $(".tip5").simpletip({ content: '쇼핑몰 회원이 아이디 or 비밀번호 분실시, 이를 찾기 위해 이용하는 질문/답변 기능을 말함' });
    $(".tip6").simpletip({ content: '가입자의 성명' });
    $(".tip7").simpletip({ content: '가입자의 생년월일 입력 여부 결정' });
    $(".tip8").simpletip({ content: '가입자의 성별 입력 여부 결정' });
    $(".tip9").simpletip({ content: '질문 및 답변, 이용후기 게시판에 남겨지는 회원의 닉네임(사용안함 선택시, 성명(실명)으로 대체)' });
    $(".tip10").simpletip({ content: '가입자의 휴대폰 번호 입력 여부 결정' });
    $(".tip11").simpletip({ content: '가입자의 자택 전화번호 입력 여부 결정' });
    $(".tip12").simpletip({ content: '가입자의 자택 주소 입력 여부 결정' });
    $(".tip13").simpletip({ content: '가입자의 직장 명칭 입력 여부 결정' });
    $(".tip14").simpletip({ content: '가입자의 직장 전화번호 입력 여부 결정' });
    $(".tip15").simpletip({ content: '가입자의 직장 주소 입력 여부 결정' });
    $(".tip16").simpletip({ content: '상품주문내역 발송, 비밀번호 분실시 사용' });
    $(".tip17").simpletip({ content: '가입자의 홈페이지 주소 파악 희망시 사용' });
    $(".tip18").simpletip({ content: '회원가입시 추천인 아이디 입력 여부' });
    $(".tip19").simpletip({ content: '추천인 입력자와 추천인에게 별도 적립금 보상' });
    $(".tip20").simpletip({ content: '쇼핑몰 외 부가적인 커뮤니티 통합 운영시 활용' });
    $(".tip21").simpletip({ content: '자동가입방지로써 가입시 숫자, 알파벳등을 입력합니다.' });
    $(".tip22").simpletip({ content: '가입하는 회원의 등급을 설정합니다.' });
    $(".tip23").simpletip({ content: '위의 회원정보 외 추가적으로 가입시 받고자 하는 부가정보 사용 여부 결정 (결혼기념일, 자녀, 차량유무 등)' });
    $(".tip24").simpletip({ content: '부가 수집 정보 1을 입력합니다.' });
    $(".tip25").simpletip({ content: '부가 수집 정보 2을 입력합니다.' });
    $(".tip26").simpletip({ content: '부가 수집 정보 3을 입력합니다.' });
    $(".tip27").simpletip({ content: '부가 수집 정보 4을 입력합니다.' });
    $(".tip28").simpletip({ content: '부가 수집 정보 5을 입력합니다.' });

});
</script>

<script type="text/javascript">
function configSubmit()
{

    var f = document.formConfig;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./config_signup_update.php";
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
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 인증 방식 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_user_real_check">
    <td></td>
    <td class="subject"><span class="tip1">인증 방식</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_real_check" value="3" class="radio" <? if ($dmshop_signup['user_real_check'] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_real_check', '0');">휴대폰</td>
    <td width="30"></td>
    <td><input type="radio" name="user_real_check" value="2" class="radio" <? if ($dmshop_signup['user_real_check'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_real_check', '1');">이메일</td>
    <td width="30"></td>
    <td><input type="radio" name="user_real_check" value="0" class="radio" <? if ($dmshop_signup['user_real_check'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_real_check', '2');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">1일 인증 제한</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="user_real_max" value="<?=text($dmshop_signup['user_real_max'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">회</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 로그인 정보입력 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">아이디</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_id" value="2" class="radio" checked /></td>
    <td width="5"></td>
    <td class="tx2">사용 (필수)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">비밀번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_pw" value="2" class="radio" checked /></td>
    <td width="5"></td>
    <td class="tx2">사용 (필수)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">ID/PW 찾기 질문답변</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_pw_qa" value="2" class="radio" checked /></td>
    <td width="5"></td>
    <td class="tx2">사용 (필수)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="1">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 회원(개인) 정보입력 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">성명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_name" value="2" class="radio" checked /></td>
    <td width="5"></td>
    <td class="tx2">사용 (필수)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip7">생년월일</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_birth" value="2" class="radio" <? if ($dmshop_signup['user_birth'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_birth', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_birth" value="1" class="radio" <? if ($dmshop_signup['user_birth'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_birth', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_birth" value="0" class="radio" <? if ($dmshop_signup['user_birth'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_birth', '2');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8">성별</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_sex" value="2" class="radio" <? if ($dmshop_signup['user_sex'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_sex', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_sex" value="1" class="radio" <? if ($dmshop_signup['user_sex'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_sex', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_sex" value="0" class="radio" <? if ($dmshop_signup['user_sex'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_sex', '2');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip9">닉네임</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_nick" value="2" class="radio" <? if ($dmshop_signup['user_nick'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_nick', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_nick" value="1" class="radio" <? if ($dmshop_signup['user_nick'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_nick', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_nick" value="0" class="radio" <? if ($dmshop_signup['user_nick'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_nick', '2');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip10">휴대폰 번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_hp" value="2" class="radio" <? if ($dmshop_signup['user_hp'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_hp', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_hp" value="1" class="radio" <? if ($dmshop_signup['user_hp'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_hp', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_hp" value="3" class="radio" <? if ($dmshop_signup['user_hp'] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_hp', '2');">사용 (SMS인증)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_hp" value="0" class="radio" <? if ($dmshop_signup['user_hp'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_hp', '3');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip11">자택 전화번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_tel" value="2" class="radio" <? if ($dmshop_signup['user_tel'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_tel', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_tel" value="1" class="radio" <? if ($dmshop_signup['user_tel'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_tel', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_tel" value="0" class="radio" <? if ($dmshop_signup['user_tel'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_tel', '2');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip12">자택 주소</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_addr" value="2" class="radio" <? if ($dmshop_signup['user_addr'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_addr', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_addr" value="1" class="radio" <? if ($dmshop_signup['user_addr'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_addr', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_addr" value="0" class="radio" <? if ($dmshop_signup['user_addr'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_addr', '2');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip13">직장명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_company" value="2" class="radio" <? if ($dmshop_signup['user_company'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_company', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_company" value="1" class="radio" <? if ($dmshop_signup['user_company'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_company', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_company" value="0" class="radio" <? if ($dmshop_signup['user_company'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_company', '2');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip14">직장 전화번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_company_tel" value="2" class="radio" <? if ($dmshop_signup['user_company_tel'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_company_tel', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_company_tel" value="1" class="radio" <? if ($dmshop_signup['user_company_tel'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_company_tel', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_company_tel" value="0" class="radio" <? if ($dmshop_signup['user_company_tel'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_company_tel', '2');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip15">직장 주소</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_company_addr" value="2" class="radio" <? if ($dmshop_signup['user_company_addr'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_company_addr', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_company_addr" value="1" class="radio" <? if ($dmshop_signup['user_company_addr'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_company_addr', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_company_addr" value="0" class="radio" <? if ($dmshop_signup['user_company_addr'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_company_addr', '2');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip16">이메일</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_email" value="2" class="radio" checked /></td>
    <td width="5"></td>
    <td class="tx2">사용 (필수)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip17">홈페이지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_homepage" value="2" class="radio" <? if ($dmshop_signup['user_homepage'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_homepage', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_homepage" value="1" class="radio" <? if ($dmshop_signup['user_homepage'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_homepage', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_homepage" value="0" class="radio" <? if ($dmshop_signup['user_homepage'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_homepage', '2');">사용안함 (권장)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip18">추천인</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_recommend" value="2" class="radio" <? if ($dmshop_signup['user_recommend'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_recommend', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_recommend" value="1" class="radio" <? if ($dmshop_signup['user_recommend'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_recommend', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_recommend" value="0" class="radio" <? if ($dmshop_signup['user_recommend'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_recommend', '2');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip19">추천인 적립금</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">추천인에게 적립금</td>
    <td width="10"></td>
    <td><input type="text" name="user_recommend_cash" value="<?=text($dmshop_signup['user_recommend_cash'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td width="10"></td>
    <td class="tx2">원 지급, 추천인을 입력한 자에게 적립금</td>
    <td width="10"></td>
    <td><input type="text" name="user_recommend_insert_cash" value="<?=text($dmshop_signup['user_recommend_insert_cash'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td width="10"></td>
    <td class="tx2">원을 지급 합니다.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip20">자기소개</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_profile" value="2" class="radio" <? if ($dmshop_signup['user_profile'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_profile', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_profile" value="1" class="radio" <? if ($dmshop_signup['user_profile'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_profile', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_profile" value="0" class="radio" <? if ($dmshop_signup['user_profile'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_profile', '2');">사용안함 (권장)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip21">자동가입 방지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_robot" value="1" class="radio" <? if ($dmshop_signup['user_robot'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_robot', '0');">사용 (권장)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_robot" value="0" class="radio" <? if ($dmshop_signup['user_robot'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_robot', '1');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip22">등급</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select3">
<select id="user_level" name="user_level" class="select">
<?
// 1은 비회원
$user_level_options = "";
$result2 = sql_query(" select * from $shop[user_level_table] where level >= '2' order by level asc ");
for ($i=0; $row=sql_fetch_array($result2); $i++) {

    echo "<option value='".text($row['level'])."'>".text($row['name'])."</option>";

    $user_level_options .= "<option value='".text($row['level'])."'>".text($row['name'])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#user_level").val("<?=text($dmshop_signup['user_level'])?>");
</script>
    </td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 부가 수집 정보 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip23">부가정보 사용여부</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="user_etc" value="2" class="radio" <? if ($dmshop_signup['user_etc'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_etc', '0');">사용 (필수)</td>
    <td width="30"></td>
    <td><input type="radio" name="user_etc" value="1" class="radio" <? if ($dmshop_signup['user_etc'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_etc', '1');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="user_etc" value="0" class="radio" <? if ($dmshop_signup['user_etc'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'user_etc', '2');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip24">부가 수집 정보 1</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">제목</td>
    <td width="10"></td>
    <td><input type="text" name="user_etc1" value="<?=text($dmshop_signup['user_etc1'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
    <td width="30"></td>
    <td class="tx2">설명</td>
    <td width="10"></td>
    <td><input type="text" name="user_etc1_help" value="<?=text($dmshop_signup['user_etc1_help'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:400px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip25">부가 수집 정보 2</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">제목</td>
    <td width="10"></td>
    <td><input type="text" name="user_etc2" value="<?=text($dmshop_signup['user_etc2'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
    <td width="30"></td>
    <td class="tx2">설명</td>
    <td width="10"></td>
    <td><input type="text" name="user_etc2_help" value="<?=text($dmshop_signup['user_etc2_help'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:400px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip26">부가 수집 정보 3</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">제목</td>
    <td width="10"></td>
    <td><input type="text" name="user_etc3" value="<?=text($dmshop_signup['user_etc3'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
    <td width="30"></td>
    <td class="tx2">설명</td>
    <td width="10"></td>
    <td><input type="text" name="user_etc3_help" value="<?=text($dmshop_signup['user_etc3_help'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:400px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip27">부가 수집 정보 4</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">제목</td>
    <td width="10"></td>
    <td><input type="text" name="user_etc4" value="<?=text($dmshop_signup['user_etc4'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
    <td width="30"></td>
    <td class="tx2">설명</td>
    <td width="10"></td>
    <td><input type="text" name="user_etc4_help" value="<?=text($dmshop_signup['user_etc4_help'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:400px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip28">부가 수집 정보 5</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">제목</td>
    <td width="10"></td>
    <td><input type="text" name="user_etc5" value="<?=text($dmshop_signup['user_etc5'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
    <td width="30"></td>
    <td class="tx2">설명</td>
    <td width="10"></td>
    <td><input type="text" name="user_etc5_help" value="<?=text($dmshop_signup['user_etc5_help'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:400px;" /></td>
</tr>
</table>
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
    <td><a href="./config_signup.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 입력하신 설정값을 바탕으로 회원가입 양식이 생성 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>