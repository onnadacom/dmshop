<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "9";
$menu_id = "203";
$shop['title'] = "배송·택배 서비스 연동";
include_once("./_top.php");

$colspan = "6";
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select1 .selectBox-dropdown {width:180px; height:19px;}
.contents_box .select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    shopCurrent();

    $(".contents_box .select1 select").selectBox();

    $(".tip1").simpletip({ content: '대표적으로 사용하는 택배사 업체명 선택하세요.' });
    $(".tip2").simpletip({ content: '택배사의 기본 홈페이지 URL 정보 입력하세요.' });
    $(".tip3").simpletip({ content: '주문자가 마이페이지 내의 주문배송조회 버튼을 클릭하였을 때 열리는 페이지 URL 입력하세요.' });
    $(".tip4").simpletip({ content: '대표적으로 사용하는 택배사 대표번호 입력하세요.' });

});
</script>

<script type="text/javascript">
function configSubmit()
{

    var f = document.formConfig;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./config_delivery_update.php";
    f.submit();

}

function parcelSelect(id)
{

    var f = document.formConfig;

    if (id == 'etc') {

        f.parcel_name.value = "";
        f.parcel_url.value = "";
        f.parcel_search_url.value = "";
        f.parcel_tel.value = "";

        return false;

    }

    if (id == '1') {

        f.parcel_name.value = "대한통운";
        f.parcel_url.value = "https://www.doortodoor.co.kr/";
        f.parcel_search_url.value = "https://www.doortodoor.co.kr/parcel/doortodoor.do?fsp_action=PARC_ACT_002&fsp_cmd=retrieveInvNoACT&invc_no=";
        f.parcel_tel.value = "1588-1255";

        return false;

    }

    if (id == '2') {

        f.parcel_name.value = "CJ GLS";
        f.parcel_url.value = "http://www.cjgls.co.kr/";
        f.parcel_search_url.value = "http://nexs.cjgls.com/web/service02_01.jsp?slipno=";
        f.parcel_tel.value = "1588-5353";

        return false;

    }

    if (id == '3') {

        f.parcel_name.value = "로젠 택배";
        f.parcel_url.value = "http://www.ilogen.com/";
        f.parcel_search_url.value = "http://www.ilogen.com/iLOGEN.Web.New/TRACE/TraceNoView.aspx?slipno=";
        f.parcel_tel.value = "1588-9988";

        return false;

    }

    if (id == '4') {

        f.parcel_name.value = "한진 택배";
        f.parcel_url.value = "http://hanex.hanjin.co.kr/";
        f.parcel_search_url.value = "http://www.hanjin.co.kr/Delivery_html/inquiry/result_waybill.jsp?wbl_num=";
        f.parcel_tel.value = "1588-0011";

        return false;

    }

    if (id == '5') {

        f.parcel_name.value = "현대 택배";
        f.parcel_url.value = "http://www.hlc.co.kr/";
        f.parcel_search_url.value = "http://www.hlc.co.kr/personalService/tracking/06/tracking_goods_result.jsp?InvNo=";
        f.parcel_tel.value = "1588-2121";

        return false;

    }

    if (id == '6') {

        f.parcel_name.value = "우체국 택배";
        f.parcel_url.value = "http://parcel.epost.go.kr";
        f.parcel_search_url.value = "http://service.epost.go.kr/trace.RetrieveRegiPrclDeliv.postal?sid1=";
        f.parcel_tel.value = "1588-1300";

        return false;

    }

    if (id == '7') {

        f.parcel_name.value = "KG 옐로우캡";
        f.parcel_url.value = "http://www.yellowcap.co.kr/";
        f.parcel_search_url.value = "http://www.yellowcap.co.kr/custom/inquiry_result.asp?invoice_no=";
        f.parcel_tel.value = "1588-0123";

        return false;

    }

    if (id == '8') {

        f.parcel_name.value = "KGB 택배";
        f.parcel_url.value = "http://www.kgbls.co.kr/";
        f.parcel_search_url.value = "http://www.kgbls.co.kr/sub5/trace.asp?f_slipno=";
        f.parcel_tel.value = "1577-4577";

        return false;

    }

    if (id == '9') {

        f.parcel_name.value = "SC로지스";
        f.parcel_url.value = "";
        f.parcel_search_url.value = "";
        f.parcel_tel.value = "";

        return false;

    }

    if (id == '10') {

        f.parcel_name.value = "동부익스프레스택배";
        f.parcel_url.value = "";
        f.parcel_search_url.value = "";
        f.parcel_tel.value = "";

        return false;

    }

    if (id == '11') {

        f.parcel_name.value = "하나로택배";
        f.parcel_url.value = "";
        f.parcel_search_url.value = "";
        f.parcel_tel.value = "";

        return false;

    }

    if (id == '12') {

        f.parcel_name.value = "기타";
        f.parcel_url.value = "";
        f.parcel_search_url.value = "";
        f.parcel_tel.value = "";

        return false;

    }

    if (id == '99') {

        f.parcel_name.value = "자가배송";
        f.parcel_url.value = "";
        f.parcel_search_url.value = "";
        f.parcel_tel.value = "";

        return false;

    }

}
</script>

<div class="contents_box">
<form method="post" name="formConfig" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="parcel_name" value="<?=text($dmshop['parcel_name'])?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="">
</colgroup>
<tr>
    <td colspan="4" class="pagetitle">:: 택배사 연동 설정 ::</td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr height="60" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">배송정보 연동안내</td>
    <td class="bc1"></td>
    <td>
<div style="padding:15px 30px 15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">지정 택배사가 있을 경우, 배송·택배 연동설정을 합니다. 택배사의 정보와 배송정보 URL을 사전 등록해 두시면, 주문·배송 작업 시<br>상품발송 정보 입력 시, 자동완성 기능을 작동 됩니다. 이와 함께 소비자가 마이페이지에서 주문조회 기능을 편리하게 이용할 수 있습니다.</td>
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
<tr height="60" id="current_parcel_id">
    <td></td>
    <td class="subject"><span class="tip1">택배사 선택</span></td>
    <td class="bc1"></td>
    <td></td>
    <td class="select1">
<select id="parcel_id" name="parcel_id" class="select" onchange="parcelSelect(this.value);"><option value="">선택하세요.</option><?=shop_pg_parcel_option();?></select>

<script type="text/javascript">
$("#parcel_id").val("<?=text($dmshop['parcel_id'])?>");
</script>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">택배사 홈페이지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="parcel_url" value="<?=text($dmshop['parcel_url'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:214px;" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">배송조회 URL</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="parcel_search_url" value="<?=text($dmshop['parcel_search_url'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:700px;" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">택배사 전화번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="parcel_tel" value="<?=text($dmshop['parcel_tel'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:214px;" /></td>
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
    <td><a href="./config_delivery.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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