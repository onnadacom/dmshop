<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "9";
$menu_id = "202";
$shop['title'] = "실명인증";
include_once("./_top.php");

$colspan = "6";

$dmshop['kcb_id'] = substr($dmshop['kcb_id'],0,-3);
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

    $(".tip1").simpletip({ content: '실명인증 서비스 사용 희망 시, 이용하고자 하는 업체를 선택합니다.<br />실명인증 서비를 쓰지 않을 시, 사용안함을 선택하세요.' });
    $(".tip2").simpletip({ content: '회원사 ID를 입력합니다.' });
    $(".tip3").simpletip({ content: '실명인증사에서 서버 IP를 요청할 경우, 이 번호를 알려주시기 바랍니다.' });
    $(".tip4").simpletip({ content: '실명 인증사 KCB 올크레딧의 홈페이지 입니다.' });
    $(".tip5").simpletip({ content: '실명인증사의 ID가 없을 경우, 서비스 신청을 통해 발급받으실 수 있습니다.' });

});
</script>

<script type="text/javascript">
function configSubmit()
{

    var f = document.formConfig;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./config_real_update.php";
    f.submit();

}

function realTypeLayer(id)
{

    $("#real_type_layer0").hide();
    $("#real_type_layer1").hide();
    $("#real_type_layer"+id).show();

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
    <td colspan="4" class="pagetitle">:: 실명인증 선택·연동 설정 ::</td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr height="60" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">실명인증 연동안내</td>
    <td class="bc1"></td>
    <td>
<div style="padding:15px 30px 15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">실명인증이란, 주민등록번호와 이름을 조회하여 사실 여부를 판단하는 수단입니다.<br />
본 서비스를 이용하기 위해서는 외부 실명인증사와 별도의 서비스 이용 계약(유료)이 필요합니다.<br />
- 실명인증 서비스를 이용하고자 하신다면, 실명 인증사를 선택하고 서비스 신청 후 회원정보를 입력하시기 바랍니다.<br />
&nbsp;&nbsp;또한 회원가입 양식의 가입 인증 방식을 "주민등록번호"로 선택하시기 바랍니다.<br />
- 실명인증 서비스를 이용하지 않고, 주민등록번호의 유효성만을 검사하고자 하신다면 "사용안함"을 선택하세요.</td>
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
<tr height="60" id="current_real_type">
    <td></td>
    <td class="subject"><span class="tip1">실명인증사 선택</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="real_type" value="1" onclick="realTypeLayer(this.value);" class="radio" <? if ($dmshop['real_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formConfig', 'real_type', '0'); realTypeLayer('1');">KCB</td>
    <td width="30"></td>
    <td><input type="radio" name="real_type" value="0" onclick="realTypeLayer(this.value);" class="radio" <? if ($dmshop['real_type'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formConfig', 'real_type', '1'); realTypeLayer('0');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<div id="real_type_layer0" style="display:<? if ($dmshop['real_type'] == '0') { echo "inline"; } else { echo "none"; } ?>;">
</div>

<div id="real_type_layer1" style="display:<? if ($dmshop['real_type'] == '1') { echo "inline"; } else { echo "none"; } ?>;">
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
    <td class="subject bold"><span class="tip2">회원사 ID</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="kcb_id" value="<?=text($dmshop['kcb_id'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:150px;" /></td>
    <td width="5"></td>
    <td class="tx2">DMP</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">쇼핑몰 아이피</span></td>
    <td class="bc1"></td>
    <td></td>
    <td class="text1"><?=text($_SERVER['SERVER_ADDR'])?></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">KCB 홈페이지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="http://okname.allcredit.co.kr/" target="_blank" class="url">http://okname.allcredit.co.kr/</a></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">서비스 신청</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="http://real.dmshopkorea.com/service_kcb.php" target="_blank"><img src="<?=$shop['image_path']?>/adm/application.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="configSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./config_real.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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