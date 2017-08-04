<?php
if (!defined('_DMSHOP_')) exit;
?>
<!-- 결제정보 start //-->
<? if ($tab == '' || $tab == 'bank') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<form method="post" name="formBank" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="order_code" value="<?=$order_code?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/manage_t2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">총 주문금액</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="item_money"><?=number_format($dmshop_order['order_total_item_money']);?></span><span class="tx2"> 원</span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">쿠폰 할인</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="order_coupon"><?=number_format($dmshop_order['order_total_coupon']);?></span><span class="tx2"> 원</span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">적립금 할인</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="order_cash"><?=number_format($dmshop_order['order_cash']);?></span><span class="tx2"> 원</span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">배송비</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="order_delivery_money"><?=number_format($dmshop_order['order_delivery_money']);?></span><span class="tx2"> 원</span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">결제금액</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="order_pay_money"><?=number_format($dmshop_order['order_pay_money']);?></span><span class="tx2"> 원</span><span class="tx2"> (<? if ($dmshop_order['order_payment'] == '1') { echo "미결제"; } else { echo "결제완료"; } ?>)</span>
</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">결제수단</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<?
echo "<span class='order_pay_type".$dmshop_order['order_pay_type']."'>".shop_pay_name($dmshop_order['order_pay_type'])."</span>";

// 무통장
if ($dmshop_order['order_pay_type'] == '5') {

    // 결제완료
    if ($dmshop_order['order_payment'] == '2') {

        echo "<span class='bank_ok'> (입금확인)</span>";

    }

    // 결제승인
    else if ($dmshop_order['order_payment'] == '1') {

        echo "<span class='bank_no'> (미확인)</span>";

    } else {

        // pass

    }

}
?>
    </td>
</tr>
<?
// 가상계좌
if ($dmshop_order['order_pay_type'] == '4') {
?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">입금은행</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_bank_name'])?> <?=text($dmshop_order['order_bank_number'])?> (예금주 : <?=text($dmshop_order['order_bank_holder'])?>)</td>
</tr>
<? } ?>
<?
// 카드, 이체, 휴대폰, 가상
if ($dmshop_order['order_pay_type'] == '1' || $dmshop_order['order_pay_type'] == '2' || $dmshop_order['order_pay_type'] == '3' || $dmshop_order['order_pay_type'] == '4') {
?>
<? if ($dmshop_order['order_pg_code1']) { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">PG 승인번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_pg_code1'])?></td>
</tr>
<? } ?>
<? if ($dmshop_order['order_pg_code1_date']) { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">PG 승인일자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_pg_code1_date'])?></td>
</tr>
<? } ?>
<? if ($dmshop_order['order_pg_code1_time']) { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">PG 승인시간</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_pg_code1_time'])?></td>
</tr>
<? } ?>
<? if ($dmshop_order['order_pg_code2']) { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">가상계좌 거래번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_pg_code2'])?></td>
</tr>
<? } ?>
<? if ($dmshop_order['order_pg_code2_date']) { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">가상계좌 승인일자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_pg_code2_date'])?></td>
</tr>
<? } ?>
<? if ($dmshop_order['order_pg_code2_time']) { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">가상계좌 승인시간</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_pg_code2_time'])?></td>
</tr>
<? } ?>
<? if ($dmshop_order['order_pg_card_code']) { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">신용카드 거래번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_pg_card_code'])?></td>
</tr>
<? } ?>
<? if ($dmshop_order['order_pg_code3']) { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">영수증 거래번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_pg_code3'])?></td>
</tr>
<? } ?>
<? if ($dmshop_order['order_pg_code3_date']) { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">영수증 승인일자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_pg_code3_date'])?></td>
</tr>
<? } ?>
<? if ($dmshop_order['order_pg_code3_time']) { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">영수증 승인시간</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_pg_code3_time'])?></td>
</tr>
<? } ?>
<? } ?>
<? if ($dmshop_order['order_pay_type'] == '5') { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">입금은행</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_bank_name'])?> <?=text($dmshop_order['order_bank_number'])?> (예금주 : <?=text($dmshop_order['order_bank_holder'])?>)</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr>
    <td bgcolor="#fff2f2" align="center" class="popup_subject2">무통장 입금정보</td>
    <td bgcolor="#e4e4e4"></td>
    <td colspan="2" bgcolor="#fffcfc">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx4">입금자명</td>
    <td width="10"></td>
    <td width="170"><input type="text" id="order_dep_name_real" name="order_dep_name_real" value="<?=text($dmshop_order['order_dep_name_real'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:152px;" /></td>
    <td width="20"><input type="checkbox" id="order_dep_name_real_add" name="order_dep_name_real_add" value="1" class="checkbox" onclick="formAdd('order_dep_name_real_add', 'order_dep_name_real', '<?=text($dmshop_order['order_dep_name'])?>');" /></td>
    <td class="tx1" onclick="shopElementCheck('formBank', 'order_dep_name_real_add'); formAdd('order_dep_name_real_add', 'order_dep_name_real', '<?=text($dmshop_order['order_dep_name'])?>');"><?=text($dmshop_order['order_dep_name'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_line"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx4">무통장 입금액</td>
    <td width="10"></td>
    <td width="170"><input type="text" id="order_dep_money_real" name="order_dep_money_real" value="<?=text($dmshop_order['order_dep_money_real'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:152px;" /></td>
    <td width="20"><input type="checkbox" id="order_dep_money_real_add" name="order_dep_money_real_add" value="1" class="checkbox" onclick="formAdd('order_dep_money_real_add', 'order_dep_money_real', '<?=text($dmshop_order['order_pay_money'])?>');" /></td>
    <td class="tx1" onclick="shopElementCheck('formBank', 'order_dep_money_real_add'); formAdd('order_dep_money_real_add', 'order_dep_money_real', '<?=text($dmshop_order['order_pay_money'])?>');"><?=number_format($dmshop_order['order_pay_money']);?>원</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_line"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx4">입금 확인일시</td>
    <td width="10"></td>
    <td width="170"><input type="text" id="order_pay_datetime" name="order_pay_datetime" value="<?=text($dmshop_order['order_pay_datetime'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:152px;" /></td>
    <td width="20"><input type="checkbox" id="order_pay_datetime_add" name="order_pay_datetime_add" value="1" class="checkbox" onclick="formAddTime('order_pay_datetime_add', 'order_pay_datetime');" /></td>
    <td class="tx1" onclick="shopElementCheck('formBank', 'order_pay_datetime_add'); formAddTime('order_pay_datetime_add', 'order_pay_datetime');">현재시간</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_line"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx4">SMS 안내</td>
    <td width="10"></td>
    <td width="20"><input type="checkbox" name="order_pay_smstype1" value="1" class="checkbox" /></td>
    <td width="90" class="tx2" onclick="shopElementCheck('formBank', 'order_pay_smstype1');">주문자 휴대폰</td>
    <td width="20"><input type="checkbox" name="order_pay_smstype2" value="1" class="checkbox" /></td>
    <td class="tx2" onclick="shopElementCheck('formBank', 'order_pay_smstype2');">수령자 휴대폰</td>
</tr>
</table>
    </td>
</tr>
<? } ?>
<? if ($dmshop_order['order_pay_type'] == '4' || $dmshop_order['order_pay_type'] == '5') { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr>
    <td bgcolor="#f7f7f7" align="center" class="popup_subject">환불 은행정보</td>
    <td bgcolor="#e4e4e4"></td>
    <td colspan="2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx5">예금주명</td>
    <td width="10"></td>
    <td><input type="text" name="order_refund_holder" value="<?=text($dmshop_order['order_refund_holder'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:152px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_line"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx5">계좌번호</td>
    <td width="10"></td>
    <td><input type="text" name="order_refund_number" value="<?=text($dmshop_order['order_refund_number'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:152px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_line"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx5">은행선택</td>
    <td width="10"></td>
    <td>
<select id="order_refund_code" name="order_refund_code" class="select"><option value="">선택하세요.</option><?=shop_pg_bankcode_option($dmshop_order['order_pg']);?></select>

<script type="text/javascript">
$("#order_refund_code").val("<?=text($dmshop_order['order_refund_code'])?>");
</script>
    </td>
</tr>
</table>

<? /*if ($dmshop_order['order_pg'] == '4' && $dmshop_order['order_pg_escrow']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_line"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx5">주민등록번호</td>
    <td width="10"></td>
    <td><input type="text" name="order_refund_jumin" value="<?=$dmshop_order['order_refund_jumin']?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:152px;" /></td>
</tr>
</table>
<? }*/ ?>
    </td>
</tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<? if ($dmshop_order['order_pay_type'] == '4') { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="submitBank('bank_refund'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_bank_edit.gif" border="0"></a></td>
</tr>
</table>
<? } ?>

<? if ($dmshop_order['order_pay_type'] == '5') { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
<? if ($dmshop_order['order_payment'] == '1') { ?>
    <td><a href="#" onclick="submitBank('bank_ok'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_bank_ok.gif" border="0"></a></td>
<? } ?>
<? if ($dmshop_order['order_payment'] == '2') { ?>
    <td width="1"></td>
    <td><a href="#" onclick="submitBank('bank_update'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_bank_edit.gif" border="0"></a></td>
<? if ($dmshop_order['order_type'] == '101') { ?>
    <td width="1"></td>
    <td><a href="#" onclick="submitBank('bank_cancel'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_bank_cancel.gif" border="0"></a></td>
<? } ?>
<? } ?>
</tr>
</table>
<? } ?>
</form>
<? } ?>
<!-- 결제정보 start //-->