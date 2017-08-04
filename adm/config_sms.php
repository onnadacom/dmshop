<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "9";
$menu_id = "201";
$shop['title'] = "문자 (SMS)";
include_once("./_top.php");

$colspan = "6";

$tmp_sms = array();

// 아이코드 체크
$btn_charge = true;
if ($dmshop['icode_id'] && $dmshop['icode_pw']) {

    $tmp_sms = shop_sms_sock("http://www.icodekorea.com/res/userinfo.php?userid=".text($dmshop['icode_id'])."&userpw=".text($dmshop['icode_pw'])."");
    $tmp_sms = explode(';', $tmp_sms);
    $icode = array('code' => $tmp_sms[0], 'coin' => $tmp_sms[1], 'gpay' => $tmp_sms[2], 'payment' => $tmp_sms[3]);

    if ($tmp_sms[0] == '202') {

        unset($tmp_sms);
        $btn_charge = false;

    }

} else {

    $btn_charge = false;

}

// dm 초기화
$dmshop['icode_id'] = substr($dmshop['icode_id'],3);
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .select2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select2 .selectBox-dropdown {width:20px; height:19px;}
.contents_box .select2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    shopCurrent();

    $(".contents_box .select2 select").selectBox();

    $(".tip1").simpletip({ content: '계약한 회사를 선택합니다.' });
    $(".tip2").simpletip({ content: '회원에게 문자 전송시 발신번호에 기재되는 번호를 말 합니다.' });
    $(".tip3").simpletip({ content: '환경설정 > 프로모션 > 관리자용 자동발송 설정에 입력된 조건으로,<br/>수신되는 관리자용 휴대폰 번호를 말 합니다.' });
    $(".tip4").simpletip({ content: '회원 수신용 설정 페이지' });
    $(".tip5").simpletip({ content: '문자 관리자 수신용 설정 페이지' });
    $(".tip6").simpletip({ content: '문자 발송 내역 확인 페이지' });

    $(".tip100").simpletip({ content: '서비스 신청한 이용자의 ID를 입력합니다.' });
    $(".tip101").simpletip({ content: '서비스 신청한 이용자의 암호를 입력합니다.' });
    $(".tip102").simpletip({ content: '잔액소진시 SMS서비스가 불가하오니, 소진 전 미리 충전해두시기 바랍니다.' });
    $(".tip103").simpletip({ content: '아이코드 공식 홈페이지입니다.' });
    $(".tip104").simpletip({ content: '신청서 작성 버튼을 클릭하여 신청서를 작성하시면, DM SHOP 전용 수수료 할인요금이 적용됩니다.' });

});
</script>

<script type="text/javascript">
function configSubmit()
{

    var f = document.formConfig;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./config_sms_update.php";
    f.submit();

}

function smsTypeLayer(id)
{

    $("#sms_type_layer1").hide();

    $("#sms_type_layer"+id).show();

}

function icodeCharge()
{

    window.open("","icodeChargePopup");
    document.formCharge.action = "http://icodekorea.com/company/credit_card_input.php";
    document.formCharge.target = "icodeChargePopup";
    document.formCharge.submit();

}
</script>

<div class="contents_box">

<form method="post" name="formCharge" autocomplete="off">
<input type="hidden" name="icode_id" value="dm_<?=text($dmshop['icode_id'])?>" />
<input type="hidden" name="icode_passwd" value="<?=text($dmshop['icode_pw'])?>" />
</form>

<form method="post" name="formConfig" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="">
</colgroup>
<tr>
    <td colspan="4" class="pagetitle">:: SMS 선택·연동 설정 ::</td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr height="60" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">문자 연동안내</td>
    <td class="bc1"></td>
    <td>
<div style="padding:15px 30px 15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">DM샵은 프로모션 설정값에 따라 [회원가입], [휴대폰인증], [주문확인]등이 이루어질 때 회원에게 [회원 수신용] SMS문자를 자동발송 하며, [상품주문], [1:1문의]등이 접수될 때 [관리자 수신용] SMS문자를 자동 발송할 수 있습니다.<br>자동 SMS 서비스의 이용을 희망하실 경우 아래의 SMS 서비스 업체에 가입 후, 아이디와 비밀번호를 입력하시기 바랍니다. 자동 SMS 서비스는 (주)아이코드를 통하여, 선불충전 방식으로 건당 14원에 이용하실 수 있습니다.<br>- 단체회원 구분을 위하여 각 PG사에서 제공되는 ID 또는 CODE의 앞 글자에는 DM_ 이 표기 됩니다.</td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60" id="current_sms_type">
    <td></td>
    <td class="subject"><span class="tip1">SMS사 선택</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="sms_type" value="1" onclick="smsTypeLayer(this.value);" class="radio" <? if ($dmshop['sms_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="smsTypeLayer('1');">아이코드</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<div id="sms_type_layer1" style="display:<? if ($dmshop['sms_type'] == '1') { echo "inline"; } else { echo "none"; } ?>;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60">
    <td></td>
    <td class="subject bold"><span class="tip100">아이코드 아이디</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="text1">dm_</td>
    <td width="5"></td>
    <td><input type="text" name="icode_id" value="<?=text($dmshop['icode_id'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject bold"><span class="tip101">아이코드 암호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="password" name="icode_pw" value="<?=text($dmshop['icode_pw'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:173px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip102">잔액확인/충전</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="text1">남은 잔액 <span class="bold"><?=number_format($tmp_sms[1]);?></span> 원 / 건당요금 <?=number_format($tmp_sms[2]);?>원</td>
<? if ($btn_charge) { ?>
    <td width="10"></td>
    <td><a href="#" onclick="icodeCharge(); return false;"><img src="<?=$shop['image_path']?>/adm/charge.gif" border="0"></a></td>
<? } ?>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip103">아이코드 홈페이지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="http://www.icodekorea.com/" target="_blank" class="url">http://www.icodekorea.com/</a></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip104">서비스 신청</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="http://sms.dmshopkorea.com/service_icode.php" target="_blank"><img src="<?=$shop['image_path']?>/adm/application.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

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
    <td colspan="<?=$colspan?>" class="pagetitle">:: SMS 이용환경 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">발신자 휴대폰 번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="sms1" name="sms1" class="select"><?=shop_option_sms1();?></select>

<script type="text/javascript">
$("#sms1").val("<?=text($dmshop['sms1'])?>");
</script>
    </td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" name="sms2" value="<?=text($dmshop['sms2'])?>" maxlength="4" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" name="sms3" value="<?=text($dmshop['sms3'])?>" maxlength="4" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">관리자 수신용 번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="rec_sms1" name="rec_sms1" class="select"><?=shop_option_sms2();?></select>

<script type="text/javascript">
$("#rec_sms1").val("<?=text($dmshop['rec_sms1'])?>");
</script>
    </td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" name="rec_sms2" value="<?=text($dmshop['rec_sms2'])?>" maxlength="4" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" name="rec_sms3" value="<?=text($dmshop['rec_sms3'])?>" maxlength="4" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">회원 수신용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><a href="./sms_config.php" class="link">설정 페이지 이동</a></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">관리자 수신용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><a href="./sms_config.php?sms_list=1" class="link">설정 페이지 이동</a></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">발송 내역</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><a href="./sms_log.php" class="link">확인 페이지 이동</a></td>
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
    <td><a href="./config_sms.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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

<script type="text/javascript">
//setTimeout("shopTop();", 100);
</script>

<?
include_once("./_bottom.php");
?>