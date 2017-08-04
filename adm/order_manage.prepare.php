<?php
if (!defined('_DMSHOP_')) exit;
?>
<!-- 주문상품 start //-->
<? if ($tab == '' || $tab == 'prepare') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<form method="post" name="formPrepare" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="order_code" value="<?=$order_code?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/manage_t3.gif"></td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list">
<colgroup>
    <col width="">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
</colgroup>
<tr height="30" bgcolor="#f7f7f7">
    <td class="popup_subject">상품명</td>
    <td></td>
    <td class="popup_subject">주문금액</td>
    <td></td>
    <td class="popup_subject">주문수량</td>
    <td></td>
    <td class="popup_subject">현재재고</td>
    <td></td>
    <td class="popup_subject">배송비</td>
</tr>
<tr><td colspan="9" height="2" bgcolor="#777777"></td></tr>
<?
$item_delivery_bunch = false;

for ($i=0; $i<count($list); $i++) {

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $shop['image_path']."/adm/noimage.gif"; }
?>
<? if ($i > '0') { ?>
<tr><td colspan="9" class="manage_line"></td></tr>
<? } ?>
<tr height="73">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="9"></td>
    <td width="50" align="center"><div class="thumb"><a href="<?=$shop['path']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank"><img src="<?=$thumb?>" width="50" height="50" border="0"></a></div></td>
    <td width="10"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank" class="item_title"><?=text($list[$i]['item_title'])?></a></td>
</tr>
</table>

<? if ($list[$i]['option_name']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="option_name">(주문옵션 : <?=text($list[$i]['option_name'])?>)</span></td>
</tr>
</table>
<? } ?>
    </td>
</tr>
</table>
    </td>
    <td bgcolor="#efefef"></td>
    <td align="center" class="order_limit"><?=number_format($list[$i]['order_item_money']);?> 원</td>
    <td bgcolor="#efefef"></td>
    <td align="center" class="order_limit"><?=number_format($list[$i]['order_limit']);?> 개</td>
    <td bgcolor="#efefef"></td>
    <td align="center" class="item_limit"><?=number_format($list[$i]['item_limit']);?> 개</td>
    <td bgcolor="#efefef"></td>
    <td align="center" class="item_limit">
<?
if ($list[$i]['order_delivery_type'] == 2) {

    echo "<span class='delivery2'>";

    if ($list[$i]['order_delivery_pay']) {

        echo "착불<br />";

    } else {

        echo "선결제<br />";

    }

    echo number_format($list[$i]['order_real_delivery'])." 원<br />";

    echo "묶음배송불가";

    echo "</span>";

} else {

    echo "<span class='delivery2'>";

    if ($dmshop_order['order_total_item_money'] >= $dmshop_order['delivery_money_free']) {

        echo "묶음배송무료<br />";

    } else {

        if (!$item_delivery_bunch) {

            if ($order_delivery_pay) {

                echo "선결제<br />";

            } else {

                echo "착불<br />";

            }

            echo number_format($dmshop_order['delivery_money'])." 원<br />";

        }

        echo "묶음배송";

        $item_delivery_bunch = true;

    }

    echo "</span>";

}
?></td>
</tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
<? if ($dmshop_order['order_delivery']) { ?>
<? if ($dmshop_order['order_type'] == '200') { ?>
    <td><a href="#" onclick="submitPrepare('prepare_cancel'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_delivery_cancel.gif" border="0"></a></td>
<? } ?>
<? } else { ?>
    <td><a href="#" onclick="submitPrepare('prepare_ok'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_delivery_ok.gif" border="0"></a></td>
<? } ?>
</tr>
</table>
</form>
<? } ?>
<!-- 주문상품 start //-->