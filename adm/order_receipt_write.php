<?php
include_once("./_dmshop.php");
if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }
$shop['title'] = "승인번호 입력";
include_once("$shop[path]/shop.top.php");

$dmshop_order = shop_order($order_code);

// 주문 내역이 없다.
if (!$dmshop_order['id']) {

    alert_close("주문내역이 존재하지 않습니다.");

}

$dmshop_order['tmp'.$dmshop_order['order_receipt_type'].'_order_receipt_name'] = $dmshop_order['order_receipt_name'];
$dmshop_order['tmp'.$dmshop_order['order_receipt_type'].'_order_receipt_number'] = $dmshop_order['order_receipt_number'];

$colspan = "9";
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}

.contents_box .title {font-weight:bold; line-height:32px; font-size:13px; color:#555555; font-family:gulim,굴림;}
.contents_box .pg {text-decoration:underline; line-height:14px; font-size:12px; color:#0000ff; font-family:gulim,굴림;}
.contents_box .receipt_title {line-height:28px; font-size:11px; color:#555555; font-family:dotum,돋움;}
.contents_box .receipt_text {line-height:28px; font-size:11px; color:#000000; font-family:dotum,돋움;}
.contents_box .receipt_code {font-weight:bold; line-height:25px; font-size:13px; color:#114572; font-family:gulim,굴림;}
.contents_box .receipt_message {line-height:25px; font-size:11px; color:#114572; font-family:gulim,굴림;}
.contents_box .receipt_message2 {line-height:18px; font-size:11px; color:#555555; font-family:gulim,굴림;}

.contents_box .receipt_input {background-color:#f0f3fa; width:110px; height:17px; border:1px solid #bdc1cb; padding:1px 3px 0px 3px;}
.contents_box .receipt_input {line-height:17px; font-size:12px; color:#000000; font-family:gulim,굴림;}
.contents_box .receipt_input2 {width:130px; height:17px; border:1px solid #e4e4e4; padding:1px 3px 0px 3px;}
.contents_box .receipt_input2 {line-height:17px; font-size:12px; color:#414141; font-family:gulim,굴림;}
</style>

<script type="text/javascript">
function orderReceipt(receipt, receipt_type)
{

    $('#order_receipt_layer1').hide();
    $('#order_receipt_layer2').hide();
    $('#order_receipt_layer'+receipt).show();

    shopElementFocus('formOrder', 'order_receipt', receipt);

    if (receipt == '1' || receipt == '2') {

        shopElementFocus('formOrder', 'order_receipt_type', receipt_type);
        orderReceiptType(receipt_type);

    }

}

function orderReceiptType(receipt_type)
{

    $('#order_receipt_type_layer0').hide();
    $('#order_receipt_type_layer1').hide();
    $('#order_receipt_type_layer2').hide();
    $('#order_receipt_type_layer3').hide();
    $('#order_receipt_type_layer4').hide();
    $('#order_receipt_type_layer'+receipt_type).show();

}

// 저장
function formSubmit()
{

    var f = document.formOrder;

    var receipt = $("input[name='order_receipt']:checked").val();

    if (receipt == '1' || receipt == '2') {

        var receipt_type = $("input[name='order_receipt_type']:checked").val();
        var receipt_name = $('#tmp'+receipt_type+'_order_receipt_name');
        var receipt_number = $('#tmp'+receipt_type+'_order_receipt_number');

        if (receipt_name.val() == '') {

            alert("항목을 입력하십시오.");
            receipt_name.focus();
            return false;

        }

        if (receipt_number.val() == '') {

            alert("항목을 입력하십시오.");
            receipt_number.focus();
            return false;

        }

        f.order_receipt_name.value = receipt_name.val();
        f.order_receipt_number.value = receipt_number.val();

    } else {

        f.order_receipt_name.value = "";
        f.order_receipt_number.value = "";

    }

    if (confirm("저장 하시겠습니까?")) {

        f.action = "./order_receipt_write_update.php";
        f.submit();

    } else {

        return false;

    }

}
</script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="detail_bg">
    <td width="15"></td>
    <td width="6"><img src="<?=$shop['image_path']?>/adm/arrow.gif"></td>
    <td width="5"></td>
    <td><span class="popup_title1"><?=$shop['title']?></span></td>
    <td width="45"><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/close2.gif" border="0"></a></td>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr>
    <td width="20"></td>
    <td>
<!-- start //-->
<form name="formOrder" method="post" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="order_code" value="<?=$order_code?>" />
<input type="hidden" name="order_receipt_name" value="" />
<input type="hidden" name="order_receipt_number" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow.gif"></td>
    <td width="10"></td>
    <td class="title">거래정보</td>
</tr>
</table>
    </td>
    <td width="200" align="right"><a href="<?=shop_http(shop_pg_admin($dmshop_order['order_pg']));?>" target="_blank" class="pg">PG사 상점관리</a></td>
</tr>
</table>

<div style="border:1px solid #dddddd;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">신청여부</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="order_receipt" value="0" class="radio" onclick="orderReceipt(this.value, '0');" /></td>
    <td width="5"></td>
    <td class="receipt_text"><?=shop_receipt_name("0");?></td>
    <td width="20"></td>
    <td><input type="radio" name="order_receipt" value="1" class="radio" onclick="orderReceipt(this.value, '0');" /></td>
    <td width="5"></td>
    <td class="receipt_text"><?=shop_receipt_name("1");?></td>
    <td width="20"></td>
    <td><input type="radio" name="order_receipt" value="2" class="radio" onclick="orderReceipt(this.value, '3');" /></td>
    <td width="5"></td>
    <td class="receipt_text"><?=shop_receipt_name("2");?></td>
</tr>
</table>
    </td>
</tr>
</table>

<div id="order_receipt_layer1" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="4" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">발급방식</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="order_receipt_type" value="0" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td class="receipt_text">휴대폰</td>
    <td width="20"></td>
    <td><input type="radio" name="order_receipt_type" value="1" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td class="receipt_text">주민등록번호</td>
    <td width="20"></td>
    <td><input type="radio" name="order_receipt_type" value="2" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td class="receipt_text">현금영수증카드</td>
</tr>
</table>
    </td>
</tr>
</table>

<div id="order_receipt_type_layer0" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="4" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">휴대폰</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td><input type="text" id="tmp0_order_receipt_number" value="<?=text($dmshop_order['tmp0_order_receipt_number'])?>" class="receipt_input" style="width:110px;" /></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">이름</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td><input type="text" id="tmp0_order_receipt_name" value="<?=text($dmshop_order['tmp0_order_receipt_name'])?>" class="receipt_input" style="width:110px;" /></td>
</tr>
</table>
</div>

<div id="order_receipt_type_layer1" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="4" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">주민등록번호</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td><input type="text" id="tmp1_order_receipt_number" value="<?=text($dmshop_order['tmp1_order_receipt_number'])?>" class="receipt_input" style="width:110px;" /></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">이름</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td><input type="text" id="tmp1_order_receipt_name" value="<?=text($dmshop_order['tmp1_order_receipt_name'])?>" class="receipt_input" style="width:110px;" /></td>
</tr>
</table>
</div>

<div id="order_receipt_type_layer2" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="4" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">현금영수증카드</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td><input type="text" id="tmp2_order_receipt_number" value="<?=text($dmshop_order['tmp2_order_receipt_number'])?>" class="receipt_input" style="width:110px;" /></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">이름</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td><input type="text" id="tmp2_order_receipt_name" value="<?=text($dmshop_order['tmp2_order_receipt_name'])?>" class="receipt_input" style="width:110px;" /></td>
</tr>
</table>
</div>
</div>

<div id="order_receipt_layer2" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="4" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">발급방식</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="order_receipt_type" value="3" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td class="receipt_text">사업자 번호</td>
    <td width="20"></td>
    <td><input type="radio" name="order_receipt_type" value="4" onclick="orderReceiptType(this.value);" class="radio" /></td>
    <td width="5"></td>
    <td class="receipt_text">현금영수증카드</td>
</tr>
</table>
    </td>
</tr>
</table>

<div id="order_receipt_type_layer3" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="4" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">사업자번호</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td><input type="text" id="tmp3_order_receipt_number" value="<?=text($dmshop_order['tmp3_order_receipt_number'])?>" class="receipt_input" style="width:110px;" /></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">이름</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td><input type="text" id="tmp3_order_receipt_name" value="<?=text($dmshop_order['tmp3_order_receipt_name'])?>" class="receipt_input" style="width:110px;" /></td>
</tr>
</table>
</div>

<div id="order_receipt_type_layer4" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="4" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">현금영수증카드</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td><input type="text" id="tmp4_order_receipt_number" value="<?=text($dmshop_order['tmp4_order_receipt_number'])?>" class="receipt_input" style="width:110px;" /></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">이름</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td><input type="text" id="tmp4_order_receipt_name" value="<?=text($dmshop_order['tmp4_order_receipt_name'])?>" class="receipt_input" style="width:110px;" /></td>
</tr>
</table>
</div>
</div>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<div style="border:1px solid #dddddd;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">상품명</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td colspan="6" class="receipt_title"><?=text($dmshop_order['order_title'])?></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">주문자명</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td width="180" class="receipt_title"><?=text($dmshop_order['order_name'])?></td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">거래일시</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td class="receipt_title"><?=date("YmdHis", strtotime($dmshop_order['order_datetime']));?></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">거래금액</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td width="180">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="receipt_title"><?=number_format($dmshop_order['order_pay_money']);?></td>
    <td width="3"></td>
    <td class="receipt_title">원</td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">주문번호</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td class="receipt_title"><?=$dmshop_order['order_code']?></td>
</tr>
<tr><td colspan="9" height="1" bgcolor="#dddddd"></td></tr>
<tr height="28">
    <td width="100" align="center" bgcolor="#fcfcfc" class="receipt_title">이메일</td>
    <td width="1" bgcolor="#dddddd"></td>
    <td width="10"></td>
    <td colspan="6" class="receipt_title"><?=text($dmshop_order['order_email'])?></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<div style="padding:10px 0; border:1px solid #bdc1cb; background-color:#f0f3fa;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<? if ($dmshop['order_pg'] == '4') { ?>
<tr height="30">
    <td class="receipt_code">거래번호 입력</td>
    <td width="10"></td>
    <td><input type="text" name="order_pg_code3" value="<?=text($dmshop_order['order_pg_code3'])?>" class="receipt_input2" /></td>
    <td width="10"></td>
    <td class="receipt_message">PG사로 부터 발급된 거래번호를 입력 합니다.</td>
</tr>
<tr><td colspan="5" height="5"></td></tr>
<? } ?>
<tr height="30">
    <td class="receipt_code">승인번호 입력</td>
    <td width="10"></td>
    <td><input type="text" name="order_receipt_code" value="<?=text($dmshop_order['order_receipt_code'])?>" class="receipt_input2" /></td>
    <td width="10"></td>
    <td class="receipt_message">PG사로 부터 발급된 승인번호를 입력 합니다.</td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#dddddd" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="receipt_message2">
- 소비자가 결제 수단을 ‘무통장 입금’을 통해 상품을 주문하고 현금 영수증 발행을 요청할 경우,<br />
&nbsp;&nbsp;<font color="#018598">정보확인 > PG사 상점관리 방문 > 현금영수증 등록 > 승인번호 생성 > 승인번호 입력</font><br />
&nbsp;&nbsp;순으로 현금 영수증을 생성하여, 제공 합니다. (이용하는 PG사 마다 다소 차이가 있음)<br />
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="receipt_message2">
- 전자결제 주문건은 위의 절차가 자동으로 진행/ 공급되므로 별도의 작업이 필요 없습니다.<br />
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#dddddd" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>
</form>
<!-- end //-->
    </td>
    <td width="20"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="formSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0" /></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하셔야만 현재의 설정값이 적용 됩니다.</td>
</tr>
</table>
</div>

<script type="text/javascript">
orderReceipt('<?=text($dmshop_order['order_receipt'])?>', '<?=text($dmshop_order['order_receipt_type'])?>');
</script>

<?
include_once("$shop[path]/shop.bottom.php");
?>