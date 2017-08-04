<?php
if (!defined('_DMSHOP_')) exit;
?>
<!-- 배송정보 start //-->
<? if ($tab == '' || $tab == 'delivery') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<form method="post" name="formDelivery" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="order_code" value="<?=$order_code?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/manage_t4.gif"></td>
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
    <td bgcolor="#f7f7f7" class="popup_subject">수령자 성명</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="order_rec_name"><?=text($dmshop_order['order_rec_name'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">휴대폰 / 전화</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_rec_hp'])?> / <?=text($dmshop_order['order_rec_tel'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">배송지 주소</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="tx1">(우: <?=text($dmshop_order['order_rec_zip1'])?><?=text($dmshop_order['order_rec_zip2'])?>)</span><span class="tx2"> <?=text($dmshop_order['order_rec_addr1'])?> <?=text($dmshop_order['order_rec_addr2'])?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">배송 요구사항</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text2($dmshop_order['order_memo'],0)?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr>
    <td bgcolor="#edeef6" class="popup_subject3">상품발송 정보</td>
    <td bgcolor="#e4e4e4"></td>
    <td colspan="2" bgcolor="#f8f8fc">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx5">배송업체</td>
    <td width="10"></td>
    <td width="170" class="select1">
<select id="order_delivery_id" name="order_delivery_id" class="select" ><option value="">선택하세요.</option><?=shop_pg_parcel_option();?></select>

<script type="text/javascript">
$("#order_delivery_id").val("<?=text($dmshop_order['order_delivery_id'])?>");
</script>
    </td>
    <td width="20"><input type="checkbox" id="order_delivery_id_add" name="order_delivery_id_add" value="1" class="checkbox" onclick="formAdd('order_delivery_id_add', 'order_delivery_id', '<?=text($dmshop['parcel_id'])?>');" /></td>
    <td class="tx1" onclick="shopElementCheck('formDelivery', 'order_delivery_id_add'); formAdd('order_delivery_id_add', 'order_delivery_id', '<?=text($dmshop['parcel_id'])?>');"><?=shop_pg_parcelname($dmshop['parcel_id']);?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_line"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx5">업체 연락처</td>
    <td width="10"></td>
    <td width="170"><input type="text" id="order_delivery_tel" name="order_delivery_tel" value="<?=text($dmshop_order['order_delivery_tel'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:152px;" /></td>
    <td width="20"><input type="checkbox" id="order_delivery_tel_add" name="order_delivery_tel_add" value="1" class="checkbox" onclick="formAdd('order_delivery_tel_add', 'order_delivery_tel', '<?=text($dmshop['parcel_tel'])?>');" /></td>
    <td class="tx1" onclick="shopElementCheck('formDelivery', 'order_delivery_tel_add'); formAdd('order_delivery_tel_add', 'order_delivery_tel', '<?=text($dmshop['parcel_tel'])?>');"><?=text($dmshop['parcel_tel'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_line"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx5">배송조회 URL</td>
    <td width="10"></td>
    <td width="170"><input type="text" id="order_delivery_url" name="order_delivery_url" value="<?=text($dmshop_order['order_delivery_url'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:152px;" /></td>
    <td width="20"><input type="checkbox" id="parcel_search_url_add" name="parcel_search_url_add" value="1" class="checkbox" onclick="formAdd('parcel_search_url_add', 'order_delivery_url', '<?=text($dmshop['parcel_search_url'])?>');" /></td>
    <td class="tx1" onclick="shopElementCheck('formDelivery', 'parcel_search_url_add'); formAdd('parcel_search_url_add', 'order_delivery_url', '<?=text($dmshop['parcel_search_url'])?>');" title="<?=text($dmshop['parcel_search_url'])?>"><?=shop_text_cut($dmshop['parcel_search_url'],30,"...");?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_line"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx5">운송장 번호</td>
    <td width="10"></td>
    <td><input type="text" name="order_delivery_number" value="<?=text($dmshop_order['order_delivery_number'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:152px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_line"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx5">발송일시</td>
    <td width="10"></td>
    <td width="170"><input type="text" id="order_delivery_datetime" name="order_delivery_datetime" value="<?=text($dmshop_order['order_delivery_datetime'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:152px;" /></td>
    <td width="20"><input type="checkbox" id="order_delivery_datetime_add" name="order_delivery_datetime_add" value="1" class="checkbox" onclick="formAddTime('order_delivery_datetime_add', 'order_delivery_datetime');" /></td>
    <td class="tx1" onclick="shopElementCheck('formDelivery', 'order_delivery_datetime_add'); formAddTime('order_delivery_datetime_add', 'order_delivery_datetime');">현재시간</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_line"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="32">
    <td width="10"></td>
    <td width="80" align="right" class="tx5">SMS 안내</td>
    <td width="10"></td>
    <td width="20"><input type="checkbox" name="order_delivery_smstype1" value="1" class="checkbox" /></td>
    <td width="90" class="tx2" onclick="shopElementCheck('formDelivery', 'order_delivery_smstype1');">주문자 휴대폰</td>
    <td width="20"><input type="checkbox" name="order_delivery_smstype2" value="1" class="checkbox" /></td>
    <td class="tx2" onclick="shopElementCheck('formDelivery', 'order_delivery_smstype2');">수령자 휴대폰</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
<? if ($dmshop_order['order_delivery'] == '2') { ?>
    <td><a href="#" onclick="submitDelivery('delivery_update'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_delivery2_edit.gif" border="0"></a></td>
<? if ($dmshop_order['order_type'] == '201') { ?>
    <td width="1"></td>
    <td><a href="#" onclick="submitDelivery('delivery_cancel'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_delivery2_cancel.gif" border="0"></a></td>
<? } ?>
<? } else { ?>
    <td><a href="#" onclick="submitDelivery('delivery_ok'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_delivery2_ok.gif" border="0"></a></td>
<? } ?>
</tr>
</table>
</form>
<? } ?>
<!-- 배송정보 start //-->