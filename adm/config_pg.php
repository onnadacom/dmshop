<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "9";
$menu_id = "200";
$shop['title'] = "전자결제 (PG)";
include_once("./_top.php");

$colspan = "6";

// dm 초기화
$dmshop['ini_site_code'] = substr($dmshop['ini_site_code'],2);
$dmshop['ags_site_code'] = substr($dmshop['ags_site_code'],2);
$dmshop['kcp_site_code'] = substr($dmshop['kcp_site_code'],2);
$dmshop['kicc_site_code'] = substr($dmshop['kicc_site_code'],2);
?>
<style type="text/css">
.contents_box {min-width:1100px;}
.contents_box .msg1 a {line-height:18px; font-size:11px; color:#414141; font-family:dotum,돋움;}

.contents_box .select2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select2 .selectBox-dropdown {width:20px; height:19px;}
.contents_box .select2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    shopCurrent();

    $(".contents_box .select2 select").selectBox();

    $(".tip1").simpletip({ content: '가입한 PG사(전자결제)를 선택합니다.<br />미가입자의 경우 하단의 서비스 신청 버튼을 클릭하여 가입합니다.' });
    $(".tip2").simpletip({ content: '무통장 입금을 제외한 모든 결제 수단은 PG(전자결제)사와 계약 후 사용이 가능합니다.' });
    $(".tip3").simpletip({ content: '전체 현금거래금액 에스크로 사용이 의무입니다.<br /><a href="http://kcp.co.kr/alpa.escrow.info.do" target="_blank">에스크로 관련 자세히 보기</a>' });
    $(".tip4").simpletip({ content: '무통장 입금 주문시 사용되며, 입력된 정보로 결제안내를 통보합니다.' });
    $(".tip5").simpletip({ content: '무통장 입금 대기일이 지난 주문은 자동 삭제됩니다.' });
    $(".tip6").simpletip({ content: '가상계좌입금 대기일이 지난 주문은 자동 삭제됩니다.' });
    $(".tip7").simpletip({ content: '카드 결제로 주문시 입력한 추가 수수료를 주문자에게 부가합니다.' });
    $(".tip8").simpletip({ content: '휴대폰 결제로 주문시 입력한 추가 수수료를 주문자에게 부가합니다.' });

    $(".tip300").simpletip({ content: '신청서 작성 후 발급받으신 SITE CODE를 입력합니다.' });
    $(".tip301").simpletip({ content: '신청서 작성 후 발급받으신 SITE KEY를 입력합니다.' });
    $(".tip302").simpletip({ content: '결제창에 표시되는 가맹점명을 입력합니다.' });
    $(".tip303").simpletip({ content: '결제창에 표시되는 로고의 주소(URL)을 입력합니다.' });
    $(".tip304").simpletip({ content: '가상계좌, 에스크로 입금등의 통보를 받을 때 필요한 주소로써, 가맹점 상점 관리페이지에서 공통통보페이지 URL을 등록합니다.<br /><br /><img src="<?=$shop['image_path']?>/manual/config_pg_304.png">' });
    $(".tip305").simpletip({ content: '전자결제 공식 홈페이지입니다.' });
    $(".tip306").simpletip({ content: '신청서 작성 버튼을 클릭하여 신청서를 작성하시면, DM SHOP 전용 수수료 할인요율이 적용됩니다.' });

    $(".tip400").simpletip({ content: '신청서 작성 후 발급받으신 MALL ID를 입력합니다.' });
    $(".tip401").simpletip({ content: '결제창에 표시되는 가맹점명을 입력합니다.' });
    $(".tip402").simpletip({ content: '결제창에 표시되는 로고의 주소(URL)을 입력합니다.' });
    $(".tip403").simpletip({ content: '가상계좌, 에스크로 입금등의 통보를 받을 때 필요한 주소로써, 계약 담당자에게 현재의 공통통보 페이지 URL을 알려줍니다.' });
    $(".tip404").simpletip({ content: '전자결제 공식 홈페이지입니다.' });
    $(".tip405").simpletip({ content: '신청서 작성 버튼을 클릭하여 신청서를 작성하시면, DM SHOP 전용 수수료 할인요율이 적용됩니다.' });

});
</script>

<script type="text/javascript">
function configSubmit()
{

    var f = document.formConfig;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./config_pg_update.php";
    f.submit();

}
</script>

<script type="text/javascript">
function orderPgLayer(id)
{

    $("#order_pg_layer1").hide();
    $("#order_pg_layer2").hide();
    $("#order_pg_layer3").hide();
    $("#order_pg_layer4").hide();

    $("#order_pg_layer"+id).show();

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
    <td colspan="4" class="pagetitle">:: PG 선택·연동 설정 ::</td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr height="100" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">전자결제 연동안내</td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">DM샵은 [신용카드], [실시간계좌이체], [휴대폰결제], [가상계좌] 총 4종의 전자결제 수단과 [무통장 입금] 결제를 지원 합니다.<br>전자결제 서비스를 이용하기 위해서는 별도로 PG(전자결제)사에 가입하셔야 합니다. DM샵은 국내 4대 PG사 KCP, KICC, 이니시스, 올더게이트와 제휴를 통해<br>각각 수수료 할인, 보증보험료 할인, 연회비 면제 등의 혜택을 제공하고 있으니, <a href="http://pg.dmshopkorea.com/service_list.php" target="_blank">[PG사별 가입안내표]</a>를 참고하시어 희망하는 PG사에 가입하시면 됩니다.<br>- 단체회원 구분을 위하여 각 PG사에서 제공되는 ID 또는 CODE의 앞 두 글자에는 DM이 표기 됩니다.</td>
</tr>
</table>
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
<tr height="60" id="current_order_pg">
    <td></td>
    <td class="subject"><span class="tip1">PG사 선택</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="order_pg" value="3" onclick="orderPgLayer(this.value);" class="radio" <? if ($dmshop['order_pg'] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formConfig', 'order_pg', '0'); orderPgLayer('3');">KCP</td>
<!--
    <td width="30"></td>
    <td><input type="radio" name="order_pg" value="4" onclick="orderPgLayer(this.value);" class="radio" <? if ($dmshop['order_pg'] == '4') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formConfig', 'order_pg', '1'); orderPgLayer('4');">KICC</td>
    <td width="30"></td>
    <td><input type="radio" name="order_pg" value="1" onclick="orderPgLayer(this.value);" class="radio" <? if ($dmshop['order_pg'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formConfig', 'order_pg', '2'); orderPgLayer('1');">이니시스</td>
    <td width="30"></td>
    <td><input type="radio" name="order_pg" value="2" onclick="orderPgLayer(this.value);" class="radio" <? if ($dmshop['order_pg'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formConfig', 'order_pg', '3'); orderPgLayer('2');">올더게이트</td>
//-->
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<div id="order_pg_layer1" style="display:<? if ($dmshop['order_pg'] == '1') { echo "inline"; } else { echo "none"; } ?>;">
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
    <td class="subject bold"><span class="tip100">이니시스 상점 아이디</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">DM</td>
    <td width="5"></td>
    <td><input type="text" name="ini_site_code" value="<?=text($dmshop['ini_site_code'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:227px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject bold"><span class="tip101">이니시스 inlite key</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="ini_site_key" value="<?=text($dmshop['ini_site_key'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:250px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">이니시스 입금내역통보URL</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><? if ($dmshop['ini_site_file']) { ?><span class="url"><?=$shop['url']?>/pay/inicis/ini_<?=text($dmshop['ini_site_file'])?>_vacctinput.php</span><? } else { ?><span class="url">현재 설정을 저장 하신 후 확인하여 주시기 바랍니다.</span><? } ?></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip103">이니시스 홈페이지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><a href="https://iniweb.inicis.com/" target="_blank" class="url">https://iniweb.inicis.com/</a></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip104">서비스 신청</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><a href="http://pg.dmshopkorea.com/service_inicis.php" target="_blank"><img src="<?=$shop['image_path']?>/adm/application.gif" border="0"></a></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<div id="order_pg_layer2" style="display:<? if ($dmshop['order_pg'] == '2') { echo "inline"; } else { echo "none"; } ?>;">
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
    <td class="subject bold"><span class="tip200">올더게이트 상점 아이디</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">DM</td>
    <td width="5"></td>
    <td><input type="text" name="ags_site_code" value="<?=text($dmshop['ags_site_code'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:227px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject bold"><span class="tip201">올더게이트 inlite key</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="ags_site_key" value="<?=text($dmshop['ags_site_key'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:250px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">올더게이트 입금내역통보URL</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><? if ($dmshop['ags_site_file']) { ?><span class="url"><?=$shop['url']?>/pay/allthegate/AGS_<?=text($dmshop['ags_site_file'])?>_VirAcctResult.php</span><? } else { ?><span class="url">현재 설정을 저장 하신 후 확인하여 주시기 바랍니다.</span><? } ?></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip203">올더게이트 홈페이지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><a href="http://www.allthegate.com/" target="_blank" class="url">http://www.allthegate.com/</a></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip204">서비스 신청</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><a href="http://pg.dmshopkorea.com/service_allthegate.php" target="_blank"><img src="<?=$shop['image_path']?>/adm/application.gif" border="0"></a></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<div id="order_pg_layer3" style="display:<? if ($dmshop['order_pg'] == '3') { echo "inline"; } else { echo "none"; } ?>;">
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
    <td class="subject bold"><span class="tip300">SITE CODE</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">DM</td>
    <td width="5"></td>
    <td><input type="text" name="kcp_site_code" value="<?=text($dmshop['kcp_site_code'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:227px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject bold"><span class="tip301">SITE KEY</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="kcp_site_key" value="<?=text($dmshop['kcp_site_key'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:250px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject bold"><span class="tip302">가맹점명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="kcp_site_name" value="<?=text($dmshop['kcp_site_name'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:250px;" /></td>
    <td width="10"></td>
    <td class="text1">반드시 영문만 입력</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip303">결제창 로고 URL</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="kcp_site_logo" value="<?=text($dmshop['kcp_site_logo'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:400px;" /></td>
    <td width="10"></td>
    <td class="msg2">지원파일 : JPG, GIF, 사이즈 : 가로 150px, 세로 50px</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip304">공통통보 페이지 URL</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><? if ($dmshop['kcp_site_file']) { ?><span class="url"><?=$shop['url']?>/pay/kcp/kcp_<?=text($dmshop['kcp_site_file'])?>_bank.php</span><? } else { ?><span class="url">현재 설정을 저장 하신 후 확인하여 주시기 바랍니다.</span><? } ?></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip305">KCP 홈페이지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><a href="http://www.kcp.co.kr/" target="_blank" class="url">http://www.kcp.co.kr/</a></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip306">서비스 신청</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><a href="http://pg.dmshopkorea.com/service_kcp.php" target="_blank"><img src="<?=$shop['image_path']?>/adm/application.gif" border="0"></a></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<div id="order_pg_layer4" style="display:<? if ($dmshop['order_pg'] == '4') { echo "inline"; } else { echo "none"; } ?>;">
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
    <td class="subject bold"><span class="tip400">MALL ID</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">DM</td>
    <td width="5"></td>
    <td><input type="text" name="kicc_site_code" value="<?=text($dmshop['kicc_site_code'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:227px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject bold"><span class="tip401">가맹점명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="kicc_site_name" value="<?=text($dmshop['kicc_site_name'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:250px;" /></td>
    <td width="10"></td>
    <td class="text1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip402">결제창 로고 URL</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="kicc_site_logo" value="<?=text($dmshop['kicc_site_logo'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:400px;" /></td>
    <td width="10"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG, 사이즈 : 가로 125px, 세로 34px</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip403">공통통보 페이지 URL</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><? if ($dmshop['kicc_site_file']) { ?><span class="url"><?=$shop['url']?>/pay/kicc/kicc_<?=text($dmshop['kicc_site_file'])?>_bank.php</span><? } else { ?><span class="url">현재 설정을 저장 하신 후 확인하여 주시기 바랍니다.</span><? } ?></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip404">KICC 홈페이지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><a href="https://www.kicc.co.kr/" target="_blank" class="url">https://www.kicc.co.kr/</a></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip405">서비스 신청</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><a href="http://pg.dmshopkorea.com/service_kicc.php" target="_blank"><img src="<?=$shop['image_path']?>/adm/application.gif" border="0"></a></td>
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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 쇼핑몰 결제환경 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject bold"><span class="tip2">이용 결제수단</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="checkbox" name="payment_type1" value="1" class="checkbox" <? if ($dmshop['payment_type1'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formConfig', 'payment_type1');">신용카드</td>
    <td width="30"></td>
    <td><input type="checkbox" name="payment_type2" value="1" class="checkbox" <? if ($dmshop['payment_type2'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formConfig', 'payment_type2');">실시간 계좌이체</td>
    <td width="30"></td>
    <td><input type="checkbox" name="payment_type3" value="1" class="checkbox" <? if ($dmshop['payment_type3'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formConfig', 'payment_type3');">휴대폰 결제</td>
    <td width="30"></td>
    <td><input type="checkbox" name="payment_type4" value="1" class="checkbox" <? if ($dmshop['payment_type4'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formConfig', 'payment_type4');">가상계좌</td>
    <td width="30"></td>
    <td><input type="checkbox" name="payment_type5" value="1" class="checkbox" <? if ($dmshop['payment_type5'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formConfig', 'payment_type5');">무통장 입금</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">에스크로 사용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="order_escrow_use" value="0" class="radio" <? if ($dmshop['order_escrow_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'order_escrow_use', '0');">사용안함</td>
    <td width="30"></td>
    <td><input type="radio" name="order_escrow_use" value="1" class="radio" <? if ($dmshop['order_escrow_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'order_escrow_use', '1');">사용</td>
    <td width="20"></td>
    <td><input type="text" name="order_escrow_money" value="<?=text($dmshop['order_escrow_money'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td width="5"></td>
    <td class="tx2">원 이상 현금결제시 사용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip4">무통장입금 계좌안내</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80" class="tx2">은행명</td>
    <td><input type="text" name="bank_name" value="<?=text($dmshop['bank_name'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="80" class="tx2">계좌번호</td>
    <td><input type="text" name="bank_number" value="<?=text($dmshop['bank_number'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="80" class="tx2">예금주명</td>
    <td><input type="text" name="bank_holder" value="<?=text($dmshop['bank_holder'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_order_bank_day">
    <td></td>
    <td class="subject"><span class="tip5">무통장입금 대기일</span></td>
    <td class="bc1"></td>
    <td></td>
    <td class="select2">
<select id="order_bank_day" name="order_bank_day" class="select">
    <option value="1">1일</option>
    <option value="2">2일</option>
    <option value="3">3일</option>
    <option value="4">4일</option>
    <option value="5">5일</option>
    <option value="6">6일</option>
    <option value="7">7일</option>
</select>

<script type="text/javascript">
$("#order_bank_day").val("<?=text($dmshop['order_bank_day'])?>");
</script>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" id="current_order_pgbank_day">
    <td></td>
    <td class="subject"><span class="tip6">가상계좌입금 대기일</span></td>
    <td class="bc1"></td>
    <td></td>
    <td class="select2">
<select id="order_pgbank_day" name="order_pgbank_day" class="select">
    <option value="1">1일</option>
    <option value="2">2일</option>
    <option value="3">3일</option>
    <option value="4">4일</option>
    <option value="5">5일</option>
    <option value="6">6일</option>
    <option value="7">7일</option>
</select>

<script type="text/javascript">
$("#order_pgbank_day").val("<?=text($dmshop['order_pgbank_day'])?>");
</script>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!--
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip7">카드결제 추가 수수료</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_card_percent" value="<?=text($dmshop['order_card_percent'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="tx2">%</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
//-->
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8">휴대폰결제 추가 수수료</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_mobile_percent" value="<?=text($dmshop['order_mobile_percent'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="tx2">%</td>
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
    <td><a href="./config_pg.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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