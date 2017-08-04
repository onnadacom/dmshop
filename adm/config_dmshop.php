<?php
include_once("./_dmshop.php");
include_once("{$shop['path']}/lib/serial.lib.php");
$top_id = "2";
$left_id = "9";
$menu_id = "100";
$shop['title'] = "기본 환경설정";
include_once("./_top.php");

$colspan = "6";

// . 초기화
$dmshop['cookie_domain'] = substr($dmshop['cookie_domain'],1);
?>
<style type="text/css">
.contents_box {min-width:1100px;}
.contents_box .serial_ok {font-weight:bold; line-height:14px; font-size:12px; color:#00a651; font-family:gulim,굴림;}
.contents_box .serial_no {font-weight:bold; line-height:14px; font-size:12px; color:#9e0b0f; font-family:gulim,굴림;}
.contents_box .check {font-weight:bold; line-height:14px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.contents_box .tex {clear:both; margin-bottom:10px; height:300px; border:1px solid #f0f0f0; overflow:auto; overflow-x:hidden; position:relative;}
.contents_box .tex div {padding:10px 10px 10px 10px; line-height:24px; font-size:12px; color:#414141; font-family:gulim,굴림;}

.contents_box .select2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select2 .selectBox-dropdown {width:20px; height:19px;}
.contents_box .select2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.contents_box .select3 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select3 .selectBox-dropdown {width:100px; height:19px;}
.contents_box .select3 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    shopCurrent();

    $(".contents_box .select2 select").selectBox();
    $(".contents_box .select3 select").selectBox();

    $(".tip1").simpletip({ content: '사업자등록증에 기재된 정식 회사명을 입력합니다.' });
    $(".tip2").simpletip({ content: '하이픈(-)과 사업자 번호 10자리를 모두 입력하세요. (예:102-16-12345)<br />사업자 번호가 올바르지 않을 경우, 정품인증(시리얼)이올바르게 작동되지 않습니다.' });
    $(".tip3").simpletip({ content: '쇼핑몰명은 인터넷 브라우저 상단과 즐겨찾기에 적용되며<br />쇼핑몰 하단의 카피라이트 정보에 자동 기입 됩니다.' });
    $(".tip4").simpletip({ content: '통신판매업 신고증 좌측 상단에 기재된 글자, 숫자 입력합니다. (예:제 2011-서울강남-0123호)' });
    $(".tip5").simpletip({ content: '지역번호를 포함한 회사 전화번호 입력합니다.' });
    $(".tip6").simpletip({ content: '지역번호를 포함한 회사 팩스번호 입력합니다.' });
    $(".tip7").simpletip({ content: '우편번호 버튼을 클릭 후 주소를 검색하여 회사의 주소를 입력합니다.' });
    $(".tip8").simpletip({ content: '사업자등록증에 명시된 대표자 성명을 입력합니다.' });
    $(".tip9").simpletip({ content: '회사의 대표 이메일주소를 입력합니다.' });
    $(".tip10").simpletip({ content: '개인정보관리 책임자 성명을 입력합니다.' });
    $(".tip11").simpletip({ content: '개인정보관리 책임자 이메일주소를 입력합니다.' });
    $(".tip12").simpletip({ content: '인터넷 브라우저의 주소창에 쇼핑몰의 도메인(URL)과 페이지 표기 방식을 말합니다.<br />도메인 고정을 선택하면 "www.dmshop.kr"과 같은 형태의 주 도메인만을 고정하여 보여주며,<br />도메인 유동을 선택하면 "http://www.dmshop.kr/item.php?id=E226458660"과 같은 형태로<br />모든 경로를 각 페이지의 주소에 따라 유동적으로 보여주게 됩니다.' });
    $(".tip13").simpletip({ content: '회원가입을 하지 않은, 비회원의 상품 주문 기능의 사용 여부를 선택합니다.' });
    $(".tip14").simpletip({ content: '무료 배송 조건에 해당하지 않는 주문자에게 입력된 금액의 배송비를 추가로 받습니다.' });
    $(".tip15").simpletip({ content: '총 주문금액이 입력된 금액을 초과할 경우, 기본 배송비를 받지 않습니다.' });
    $(".tip16").simpletip({ content: '주문자가 상품 수령 후, "상품수령" 버튼을 클릭하지 않으면,<br />설정기간 경과 후, 자동으로 상품수령 처리합니다.<br /><br />* 본 내용과 설정기간은 마이페이지를 통해 회원에게 안내 됩니다.' });
    $(".tip17").simpletip({ content: '주문자가 상품수령 버튼을 클릭하고, "구매확정" 버튼을 클릭하지 않으면,<br />설정기간 경과 후, 자동으로 구매확정 처리합니다.<br /><br />* 본 내용과 설정기간은 마이페이지를 통해 회원에게 안내 됩니다.' });
    $(".tip18").simpletip({ content: '회원이 장바구니에 상품을 보관하면 설정 기간 동안<br />로그아웃, PC의 종료와 관계없이 상품을 보관합니다.<br />설정기간 경과 후에는 보관 기록을 자동 삭제합니다.' });
    $(".tip19").simpletip({ content: '최근 본 상품이란 회원이 가장 최근에 즉, 마지막으로 본 상품을 말하며<br />쇼핑몰 우측의 스크롤 메뉴나, 마이페이지 등을 통해 확인할 수 있습니다.<br />설정기간 경과 후에는 열람 기록을 자동 삭제합니다.' });
    $(".tip20").simpletip({ content: '사용안함 : 상품 주문 시 사용을 제한하며, 상품구매/게시물 작성 등의 설정에 입력된 모든 적립금을 지급하지 않습니다.<br />사용 : 상품정보 또는 게시판 설정에 따른 적립금을 회원에게 지급하며, 상품 주문 시 현금처럼 이용할 수 있습니다.' });
    $(".tip21").simpletip({ content: '설정된 금액 이상의 적립금을 보유했을 때만, 결제 시 사용할 수 있습니다.<br />일종의 제한 기능이며, 0을 입력하시면 제한이 없음을 의미합니다.' });
    $(".tip22").simpletip({ content: '설정된 등급 이상의 회원만 상품평을 작성할 수 있도록 제한합니다.' });
    $(".tip23").simpletip({ content: '설정된 등급 이상의 회원만 상품문의를 작성할 수 있도록 제한합니다.' });
    $(".tip24").simpletip({ content: '특정 IP가 쇼핑몰에 접속하는 것을 차단 합니다.<br />불량 회원, 로봇, 스팸글 등을 차단하는 목적으로 활용되며,<br />쇼핑몰의 "개별방문 기록"을 통해 IP를 확인하실 수 있습니다.<br /><br />복수 입력시 줄 바꿈(엔터)로 구분 합니다.<br /><br />예: 115.00.000.000<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;210.00.000.000' });
    $(".tip25").simpletip({ content: '특정 단어를 포함한 게시물이 작성되는 것을 차단 합니다.<br />욕설, 광고, 성인/도박 홍보글 등을 차단하는 목적으로 활용 됩니다.<br /><br />복수 입력시 콤마(,)로 구분 합니다.<br />예 : 개새끼, 시발, 비아그라, 바카라' });
    $(".tip26").simpletip({ content: '디엠샵코리아에서 시리얼 발급시 입력한 도메인 주소를 입력합니다.' });
    $(".tip27").simpletip({ content: '기본적으로 비워두세요. 일부 서버에서 로그인이 풀리는 현상이 발생될 때에만 도메인을 입력합니다.' });
    $(".tip28").simpletip({ content: '디엠샵 코리아로부터 발급받으신 시리얼 번호 20자를 입력합니다.<br />시리얼 번호를 모르실 경우, 디엠샵 코리아의 마이 페이지 > 디엠샵 시리얼을 확인하세요.<br />시리얼 번호를 발급받지 않았을 경우, 발급신청 버튼을 클릭하시기 바랍니다.<br /><br />* 시리얼 번호를 입력하지 않을 경우, 일부 기능 및 결제기능에 제한이 따릅니다.' });
    $(".tip29").simpletip({ content: '약관에 동의하지 않으실 경우, 본 솔루션 이용이 불가하며 즉시 사용이 중단됩니다.' });
    $(".tip30").simpletip({ content: '웹에이젼시 또는 프리랜서를 통해 쇼핑몰을 구축하셨을 경우,<br />정보 보관(메모) 용으로 기재해 두세요. (비워두셔도 무방 합니다.)' });
    $(".tip31").simpletip({ content: '쇼핑몰의 관리자 모드에서 디엠샵코리아와 부가서비스를 이용하고 싶다면 아이디를 기록해 두세요.' });
    $(".tip32").simpletip({ content: '쇼핑몰의 관리자 모드에서 디엠샵코리아와 부가서비스를 이용하고 싶다면 비밀번호를 기록해 두세요.' });
    $(".tip33").simpletip({ content: 'SSL인증서를 설치한 보안서버에서 사용하실 수 있습니다. 가입 및 주문등의 경로가 https:// 으로 변경됩니다.' });
    $(".tip34").simpletip({ content: '쇼핑몰내에서 마우스 우클릭을 금지합니다.' });
    $(".tip35").simpletip({ content: '쇼핑몰내에서 우편번호 찾기에 도로명 찾기 시스템을 도입합니다.' });

});
</script>

<script type="text/javascript">
function configSubmit()
{

    var f = document.formConfig;

    if (f.company_name.value == '') {

        alert('회사명을 입력하십시오.');
        f.company_name.focus();
        return false;

    }

    if (f.company_number1.value == '') {

        alert('사업자 등록번호를 입력하십시오.');
        f.company_number1.focus();
        return false;

    }

    if (f.shop_name.value == '') {

        alert('쇼핑몰명을 입력하십시오.');
        f.shop_name.focus();
        return false;

    }

    if (f.company_number2.value == '') {

        alert('통신판매업 신고번호를 입력하십시오.');
        f.company_number2.focus();
        return false;

    }

    if (f.number1.value == '') {

        alert('회사 전화번호를 입력하십시오.');
        f.number1.focus();
        return false;

    }

    if (f.number2.value == '') {

        alert('회사 전화번호를 입력하십시오.');
        f.number2.focus();
        return false;

    }

    if (f.number3.value == '') {

        alert('회사 전화번호를 입력하십시오.');
        f.number3.focus();
        return false;

    }

    if (f.addr1.value == '' || f.addr2.value == '') {

        alert('회사 주소를 입력하십시오.');
        f.addr2.focus();
        return false;

    }

    if (f.ceo_name.value == '') {

        alert('대표자명을 입력하십시오.');
        f.ceo_name.focus();
        return false;

    }

    if (f.ceo_email.value == '') {

        alert('대표 이메일을 입력하십시오.');
        f.ceo_email.focus();
        return false;

    }

    if (f.admin_name.value == '') {

        alert('개인정보 책임자 성명을 입력하십시오.');
        f.admin_name.focus();
        return false;

    }

    if (f.admin_email.value == '') {

        alert('개인정보 책임자 이메일을 입력하십시오.');
        f.admin_email.focus();
        return false;

    }

    if (f.domain.value == '') {

        alert('쇼핑몰 도메인(URL)을 입력하십시오.');
        f.domain.focus();
        return false;

    }

/*
    if (f.cookie_domain.value == '') {

        alert('쿠키 도메인(URL)을 입력하십시오.');
        f.cookie_domain.focus();
        return false;

    }
*/

    if (f.serial_key.value == '') {

        alert('정품인증 (시리얼)을 입력하십시오.');
        f.serial_key.focus();
        return false;

    }

    if (f.check1.checked == false) {

        alert('약관에 동의하지 않으셨습니다.');
        return false;

    }

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./config_dmshop_update.php";
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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 회사 및 쇼핑몰 정보 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">회사명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="company_name" value="<?=text($dmshop['company_name'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:190px;" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">사업자 등록번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="company_number1" value="<?=text($dmshop['company_number1'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:190px;" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">쇼핑몰명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="shop_name" value="<?=text($dmshop['shop_name'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:190px;" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">통신판매업 신고번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="company_number2" value="<?=text($dmshop['company_number2'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:190px;" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">회사 전화번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="number1" name="number1" class="select"><?=shop_option_sms1();?></select>

<script type="text/javascript">
$("#number1").val("<?=text($dmshop['number1'])?>");
</script>
    </td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" name="number2" value="<?=text($dmshop['number2'])?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" name="number3" value="<?=text($dmshop['number3'])?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">회사 팩스번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="fax1" name="fax1" class="select"><?=shop_option_sms1();?></select>

<script type="text/javascript">
$("#fax1").val("<?=text($dmshop['fax1'])?>");
</script>
    </td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" name="fax2" value="<?=text($dmshop['fax2'])?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" name="fax3" value="<?=text($dmshop['fax3'])?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="130">
    <td></td>
    <td class="subject"><span class="tip7">회사 주소</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="zip1" value="<?=text($dmshop['zip1'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" name="zip2" value="<?=text($dmshop['zip2'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="shopZip('formConfig', 'zip1', 'zip2', 'addr1', 'addr2'); return false;"><img src="<?=$shop['image_path']?>/adm/find_addr.gif" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><input type="text" name="addr1" value="<?=text($dmshop['addr1'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:250px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><input type="text" name="addr2" value="<?=text($dmshop['addr2'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:250px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8">대표자명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="ceo_name" value="<?=text($dmshop['ceo_name'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:190px;" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip9">대표 이메일</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="ceo_email" value="<?=text($dmshop['ceo_email'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:190px;" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip10">개인정보책임자명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="admin_name" value="<?=text($dmshop['admin_name'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:190px;" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip11">개인정보책임자 이메일</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="admin_email" value="<?=text($dmshop['admin_email'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:190px;" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 쇼핑몰 운영 정책 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip12">도메인(URL) 표기방식</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="domain_type" value="0" class="radio" <? if ($dmshop['domain_type'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'domain_type', '0');">도메인 고정</td>
    <td width="30"></td>
    <td><input type="radio" name="domain_type" value="1" class="radio" <? if ($dmshop['domain_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'domain_type', '1');">도메인 유동 (페이지, 경로 포함)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip33">SSL 보안서버 사용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="ssl_use" value="0" class="radio" <? if ($dmshop['ssl_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'ssl_use', '0');">사용안함</td>
    <td width="30"></td>
    <td><input type="radio" name="ssl_use" value="1" class="radio" <? if ($dmshop['ssl_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'ssl_use', '1');">사용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_order_guest_use">
    <td></td>
    <td class="subject"><span class="tip13">비회원 주문</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="order_guest_use" value="0" class="radio" <? if ($dmshop['order_guest_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'order_guest_use', '0');">사용안함</td>
    <td width="30"></td>
    <td><input type="radio" name="order_guest_use" value="1" class="radio" <? if ($dmshop['order_guest_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'order_guest_use', '1');">사용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_delivery_money">
    <td></td>
    <td class="subject"><span class="tip14">기본 배송비</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="delivery_money" value="<?=text($dmshop['delivery_money'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td class="tx2">원</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_delivery_money_free">
    <td></td>
    <td class="subject"><span class="tip15">무료 배송조건</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="delivery_money_free" value="<?=text($dmshop['delivery_money_free'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td class="tx2">원 이상 구매시</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_order_receive_day">
    <td></td>
    <td class="subject"><span class="tip16">자동 상품수령 기간</span></td>
    <td class="bc1"></td>
    <td></td>
    <td class="select2">
<select id="order_receive_day" name="order_receive_day" class="select">
<?
for ($i=1; $i<=30; $i++) {
    echo "<option value='".$i."'>".$i."일</option>";
}
?>
</select>

<script type="text/javascript">
$("#order_receive_day").val("<?=text($dmshop['order_receive_day'])?>");
</script>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_order_exchange_day">
    <td></td>
    <td class="subject"><p><span class="tip17">자동 구매확정 기간</span></p><p>(교환/환불 신청 기간)</p></td>
    <td class="bc1"></td>
    <td></td>
    <td class="select2">
<select id="order_exchange_day" name="order_exchange_day" class="select">
<?
for ($i=1; $i<=30; $i++) {
    echo "<option value='".$i."'>".$i."일</option>";
}
?>
</select>

<script type="text/javascript">
$("#order_exchange_day").val("<?=text($dmshop['order_exchange_day'])?>");
</script>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_cart_day">
    <td></td>
    <td class="subject"><span class="tip18">장바구니 보관기간</span></td>
    <td class="bc1"></td>
    <td></td>
    <td class="select2">
<select id="cart_day" name="cart_day" class="select">
<?
for ($i=1; $i<=30; $i++) {
    echo "<option value='".$i."'>".$i."일</option>";
}
?>
</select>

<script type="text/javascript">
$("#cart_day").val("<?=text($dmshop['cart_day'])?>");
</script>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_view_day">
    <td></td>
    <td class="subject"><span class="tip19">최근 본 상품 유지기간</span></td>
    <td class="bc1"></td>
    <td></td>
    <td class="select2">
<select id="view_day" name="view_day" class="select">
<?
for ($i=1; $i<=30; $i++) {
    echo "<option value='".$i."'>".$i."일</option>";
}
?>
</select>

<script type="text/javascript">
$("#view_day").val("<?=text($dmshop['view_day'])?>");
</script>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_payment_type6">
    <td></td>
    <td class="subject"><span class="tip20">적립금 지급/결제</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="payment_type6" value="0" class="radio" <? if ($dmshop['payment_type6'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'payment_type6', '0');">사용안함</td>
    <td width="30"></td>
    <td><input type="radio" name="payment_type6" value="1" class="radio" <? if ($dmshop['payment_type6'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'payment_type6', '1');">사용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_order_cash_min">
    <td></td>
    <td class="subject"><span class="tip21">적립금 사용조건</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_cash_min" value="<?=text($dmshop['order_cash_min'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="tx2">원 이상 보유 시</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_view_day">
    <td></td>
    <td class="subject"><span class="tip22">상품평 작성권한</span></td>
    <td class="bc1"></td>
    <td></td>
    <td class="select3">
<select id="reply_write_level" name="reply_write_level" class="select">
<?
$result = sql_query(" select * from $shop[user_level_table] order by level asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    echo "<option value='".text($row['level'])."'>".text($row['name'])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#reply_write_level").val("<?=text($dmshop['reply_write_level'])?>");
</script>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_view_day">
    <td></td>
    <td class="subject"><span class="tip23">상품문의 작성권한</span></td>
    <td class="bc1"></td>
    <td></td>
    <td class="select3">
<select id="qna_write_level" name="qna_write_level" class="select">
<?
$result = sql_query(" select * from $shop[user_level_table] order by level asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    echo "<option value='".text($row['level'])."'>".text($row['name'])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#qna_write_level").val("<?=text($dmshop['qna_write_level'])?>");
</script>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip35">도로명 주소찾기</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="zipcode" value="0" class="radio" <? if ($dmshop['zipcode'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'zipcode', '0');">사용안함</td>
    <td width="30"></td>
    <td><input type="radio" name="zipcode" value="1" class="radio" <? if ($dmshop['zipcode'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'zipcode', '1');">사용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 쇼핑몰 차단 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip24">아이피 차단</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="block_ip" name="block_ip" class="textarea1" style="width:425px; height:100px;"><?=text($dmshop['block_ip'])?></textarea></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip25">키워드 차단</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="block_keyword" name="block_keyword" class="textarea1" style="width:425px; height:100px;"><?=text($dmshop['block_keyword'])?></textarea></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip34">마우스 우클릭</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="mouse_event" value="0" class="radio" <? if ($dmshop['mouse_event'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'mouse_event', '0');">허용하기</td>
    <td width="30"></td>
    <td><input type="radio" name="mouse_event" value="1" class="radio" <? if ($dmshop['mouse_event'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'mouse_event', '1');">금지하기</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 솔루션 인증·공급 정보 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject bold"><span class="tip26">쇼핑몰 도메인(URL)</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">http://</td>
    <td width="5"></td>
    <td><input type="text" name="domain" value="<?=text($dmshop['domain'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip27">쿠키 도메인(URL)</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">http://</td>
    <td width="5"></td>
    <td><input type="text" name="cookie_domain" value="<?=text($dmshop['cookie_domain'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="90" id="current_serial_key">
    <td></td>
    <td class="subject bold"><span class="tip28">정품인증 (시리얼)</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="serial_key" value="<?=text($dmshop['serial_key'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td class="tx2">인증상태 :</td>
    <td width="6"></td>
    <td>
<?
if (shop_serial_check()) {

    echo "<span class='serial_ok'>정품인증</span>";

} else {

    echo "<span class='serial_no'>잘못된 번호</span>";

}
?>
    </td>
    <td width="10"></td>
    <td><a href="http://serial.dmshopkorea.com" target="_blank"><img src="<?=$shop['image_path']?>/adm/serial.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="370">
    <td></td>
    <td class="subject bold"><span class="tip29">솔루션 이용약관</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table width="780" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div class="tex">

    <div>
<!-- 이용약관 //-->
제 1조 목적<br><br>본 이용약관은 독립형 쇼핑몰 솔루션 디엠샵을 무상 제공하는 디엠샵코리아(이하 “회사”)와 본 솔루션을 운영하는 쇼핑몰 사용자(이하 “사용자”) 간에 솔루션 이용에 관한 권리와 의무, 책임 및 기타 제반 사항을 규정하는 것을 목적으로 합니다.<br><br>제2조 용어의 정의<br><br>① 솔루션 : 본 약관상의 솔루션이란, 전자상거래 및 홈페이지 구축을 위해 무상 제공되는 디엠샵을 말하며 이에 제반 되는 주문·배송, 상품·메뉴, 고객지원, 프로모션, 기타기능, 통계분석, 디자인, 환경설정, 부가서비스 등의 기능과 그에 따른 모든 소스코드와 디자인을 포함 합니다.<br>② 공식 사이트 : 솔루션 디엠샵의 다운로드 및 정품인증, 고객지원 서비스를 제공하는 배포 사이트인 디엠샵 코리아(www.dmshopkorea.com)를 말합니다.<br>③ 이용권리 : 회원가입, 시리얼 발급 등(4조 2항 참고)을 통해 회사로부터 사용자가 부여 받는 솔루션의 사용 권리를 말하며, 이는 소유권, 저작권과는 무관합니다.<br>④ 시리얼 번호: 이용약관의 동의 및 사용자 정보 등록 후, 사용자에게 부여되는 일련번호로서 이를 통해 정식 사용자를 식별하는 용도로 사용됩니다.<br><br>제3조 (솔루션의 저작권)<br><br>① 본 솔루션의 소유권 및 저작권은 개발사에 있으며, 소유권은 타인에게 제공되지 않습니다.<br>② 솔루션의 저작권은 한국저작권위원회(등록번호 : C-2012-003399)로부터 보호받고 있으며, 대한민국과 국제적인 저작권법, 조약, 저작권 협정으로 부터 보호받고 있습니다.<br>③ 솔루션에 포함된 일부, 공개 소스코드와 플러그인의 저작권은 해당 소스코드 제작자에게 있습니다.<br>④ 별도로 제공되는 모든 스킨(템플릿), 플러그인, 디자인 등의 저작권은 본 이용약관과는 무관한 개별적인 저작권과 약관을 따르며, 그에 맞게 사용하시기 바랍니다.<br><br>제4조 (사용 권리와 이용범위)<br><br>① 본 솔루션은 본 이용약관에 따른 독자적인 라이선스를 적용합니다.<br>② 개발사가 제공하는 솔루션의 사용 권리는 아래의 과정을 통해서만 제공되며, 이는 2조 4항에 의거 “정식 사용자”로 분류합니다.<br>&nbsp;&nbsp;&nbsp; 가. 공식 사이트의 “회원약관” 동의를 통한, 회원가입<br>&nbsp;&nbsp;&nbsp; 나. 디엠샵의 “이용약관” 동의를 통한, 다운로드<br>&nbsp;&nbsp;&nbsp; 다. 마이페이지 &gt; 시리얼 발급 메뉴를 통한 “사용자 정보 등록”<br>&nbsp;&nbsp;&nbsp; 라. 사용자 정보 등록 후 발급되는 “시리얼 번호”를 관리자 모드에 등록<br><br>제5조 (불법복제 및 무단배포 금지)<br><br>① 사용자는 개발사의 동의 없이 솔루션의 “사용 권리”를 제삼자에게 양도하거나 판매하실 수 없습니다.<br>② 제삼자에게 사용권리를 양도하고자 할 경우, 공식사이트를 통하여 사전 발급된 자신의 인증서를 폐기하고, 제삼자의 인증서를 신규 등록함으로써 권리를 양도할 수 있습니다.<br>③ 사용자는 개발사의 솔루션을 인터넷을 통해 직접 배포할 수 없습니다.<br>④ 개작 또는 변경을 통하여 2차 저작물을 만들었을 경우에도 회사의 저작물이 포함될 경우, 이를 배포하거나 저작권을 취득하실 수 없습니다.<br>⑤ 독자적인 기능 개선 및 추가기능을 직접 개발하여 배포할 경우, 자신이 개발한 범위에 한하여 개별적인 이용약관을 명시할 수 있습니다.<br>⑥ 개발사는 솔루션 내, “보안 및 정식/불법 사용자 구분”을 위해 별도의 암호화된 파일을 제공합니다. 위 사유로 제공되는 암호화 파일을 제거 또는 변조하거나, 이를 무력화 하는 별도의 파일을 개발하여 이용 및 배포 시에는 저작권 침해 행위로 간주합니다.<br>⑦ 위에 명시된 조항에 동의하지 않거나, 위배되는 사용자는 본 솔루션을 이용하실 수 없습니다. 본 이용약관을 무시하고 무단 사용 시, 컴퓨터프로그램 보호법 46조의 벌칙 규정에 따라 법적인 책임과 손해 배상이 따를 수 있습니다.<br><br>제6조 (솔루션의 변경 및 사용)<br><br>① 사용자는 솔루션을 자신의 용도에 맞추어 직접 또는 제삼자를 통하여 변경 하거나, 추가기능을 개발하여 탑재·이용하실 수 있습니다.<br>② 자신이 제작한 변경파일, 추가기능 등은 공식사이트를 통해 배포하실 수 있으며 개발사의 저작물이 포함되어 있지 않을 경우, 자신의 사이트를 통해서도 배포하실 수 있습니다.<br>③ 솔루션의 변경(customizing)작업으로 인한 피해 발생 시, 그 책임은 사용자 또는 변경작업을 수행한 제삼자에게 있으며, 원 개발사는 이에 일절 관여하지 않습니다.<br><br>제7조 (사용자 및 쇼핑몰의 정보수집)<br><br>① 개발사는 공식 사이트의 회원가입을 통해 사용자의 아이디, 비밀번호, 닉네임과 휴대폰, 이메일, 홈페이지 등의 정보를 수집합니다.<br>② 추가적으로 시리얼 번호의 발급 과정을 통하여 사용자의 사업자번호와 설치 도메인 정보를 수집합니다. 이는 개발사의 사용자 통계 및 사용자 간의 신뢰성 있는 서비스 제공을 목적으로 활용하며, 수집된 정보는 제삼자에게 제공하지 않습니다.<br><br>제8조 (회사의 고객지원 의무)<br><br>① 회사는 솔루션의 사용 권리를 무상 제공함에 있어 사용자에게 설치, 하자보수, 고객지원 등의 의무와 책임을 지지 않습니다.<br>② 사용자의 편의를 위하여, 공식 사이트를 통한 업데이트·패치·질문답변 등의 서비스를 무상 제공하나, 이는 개발사의 책임 및 의무사항이 아닙니다.<br>② 개발사는 사용자의 데이터베이스 및 프로그램으로 인한 오류 발생 시, 이에 책임지지 않습니다.<br>③ 사용자는 운영 중인 쇼핑몰(솔루션)에 가입한 회원의 정보를 보호할 의무가 있으며, 사용자의 실수 또는 해킹 등으로 인한 피해 발생 시, 그 책임은 사용자 본인에게 있습니다.<br><br>제9조 (면책조항)<br><br>① 회사는 천재지변, 전쟁 및 기타, 경영악화로 인한 사유 또는 이에 준하는 불가항력으로 인하여 서비스 종료 시 이에 대한 모든 책임이 면책됩니다.<br>② 회사는 사용자의 운영 부실, 소스파일 변형, 불법 복제물 설치 등과 관련하여 발생하는 모든 종류의 문제와 손해에 대한 책임을 지지 않습니다.<br>③ 회사는 사용자의 컴퓨터 또는 솔루션이 구동되는 서버의 오류 등으로 인한 장애와 발생 시, 이에 책임을 지지 않습니다.<br>④ 회사는 사용자의 솔루션 내 가입한 "회원"의 개인정보 및 기타정보의 유출 사고 발생 시, 어떠한 책임도 지지 않으며, 이에 개입하지 않습니다.<br>⑤ 회사는 사용자가 제삼자와 함께 솔루션을 사용하며 발생하는 모든 분쟁에 대해, 어떠한 책임도 지지 않으며, 이에 개입하지 않습니다.<br><br>제10조 (그 외 기타 사항)<br><br>① 본 이용약관에 명시되지 않은 사항에 대해서는 관계 법령 및 한국 소프트웨어 저작권 협회의 법령과 판례를 따릅니다.<br><br>제11조 (효력의 발생)<br><br>① 본 이용약관과 관련하여 발생하는 제반·분쟁사항에 대한 소송은 회사의 소재지관할 법원으로 합니다.<br><br>부칙 (시행일)<br><br>① 시행일 : 본 약관은 2012년 1월 2일부터 시행합니다.
<!-- 이용약관 //-->
    </div>

</div>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
<tr>
    <td><input type="checkbox" id="check1" name="check1" value="1" class="checkbox" <? if ($dmshop['serial_key']) { echo "checked"; } ?> /></td>
    <td width="10"></td>
    <td class="check"><label for="check1">솔루션 이용약관을 모두 읽었으며. 이에 동의 합니다.</label></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="120">
    <td></td>
    <td class="subject"><span class="tip30">공급자 정보</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="60" class="tx2">업체명</td>
    <td><input type="text" name="agency_name" value="<?=text($dmshop['agency_name'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="60" class="tx2">홈페이지</td>
    <td><input type="text" name="agency_url" value="<?=text($dmshop['agency_url'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="60" class="tx2">전화번호</td>
    <td><input type="text" name="agency_tel" value="<?=text($dmshop['agency_tel'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 디엠샵코리아 자동 로그인 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip31">디엠샵코리아 아이디</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="dm_user_id" value="<?=text($dmshop['dm_user_id'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip32">디엠샵코리아 비밀번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="password" name="dm_user_pw" value="<?=text($dmshop['dm_user_pw'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
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
    <td><a href="./config_dmshop.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 입력하신 설정값이 저장 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>