<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "9";
$menu_id = "204";
$shop['title'] = "신디케이션";
include_once("./_top.php");

$colspan = "6";
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

    $(".tip1").simpletip({ content: '신디케이션 사용시 사용에, 사용하지 않을경우 사용안함으로 설정하여주세요.' });
    $(".tip2").simpletip({ content: '네이버에서 발급받은 연동키(token)을 입력합니다.' });
    $(".tip3").simpletip({ content: '신디케이션을 사용하기 위해서는 네이버에서 연동키를 발급받아야합니다.' });

});
</script>

<script type="text/javascript">
function configSubmit()
{

    var f = document.formConfig;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./config_syndi_update.php";
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
    <col width="">
</colgroup>
<tr>
    <td colspan="4" class="pagetitle">:: 신디케이션 연동 설정 ::</td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr height="60" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">신디케이션이란?</td>
    <td class="bc1"></td>
    <td>
<div style="padding:15px 30px 15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">
신디케이션이란 웹 사이트가 보유하고 있는 콘텐츠를 다른 웹 사이트가 이용할 수 있게 하는 방식의 하나이다.<br />
콘텐츠를 보유하고 있는 웹 사이트는 정해진 형식에 따라 문서를 구성하여 해당 문서의 링크를 다른 웹 사이트에 전송하고, 이를 전송 받은 웹 사이트는 해당 문서의 내용을 분석하여 사용한다.<br />
네이버와 같은 검색 서비스는 웹 로봇을 이용하여 여러 웹 사이트의 콘텐츠를 수집하는데, 이때 무작위로 접근하는 크롤링 기법을 이용하여 웹 사이트에 부하를 줄 수 있으며 수집 결과도 분석하기 어렵다.<br />
신디케이션을 이용하면 크롤링 기법에 비해 웹 사이트에 부하를 적게 줄 수 있으며, 콘텐츠 제공자가 원하는 부분만 검색 서비스에 노출할 수 있다.<br />
또한 신규 콘텐츠나 수정된 콘텐츠가 검색 서비스에 빠르게 반영되며, 제목, 내용, 태그 등 콘텐츠의 구조가 검색 결과에 정확히 반영된다는 장점이 있다.<br />
    </td>
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
<tr height="60" id="current_syndi_type">
    <td></td>
    <td class="subject"><span class="tip1">사용여부</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="syndi_type" value="1" class="radio" <? if ($dmshop['syndi_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formConfig', 'syndi_type', '0');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="syndi_type" value="0" class="radio" <? if ($dmshop['syndi_type'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formConfig', 'syndi_type', '1');">사용안함</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
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
<tr height="60">
    <td></td>
    <td class="subject bold"><span class="tip2">연동키(token)</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="syndi_token" value="<?=text($dmshop['syndi_token'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:650px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">연동키(token) 신청</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="http://webmastertool.naver.com/" target="_blank" class="url">http://webmastertool.naver.com/</a></td>
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
    <td><a href="./config_syndi.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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