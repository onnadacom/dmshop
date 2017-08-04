<?
if (!defined('_DMSHOP_')) exit;
?>
<!--[if IE 6]>
<script type="text/javascript">
/* IE6 PNG 배경투명 */
DD_belatedPNG.fix('.png');
</script>
<![endif]-->

<style type="text/css">
body {background-color:#f4f4f4;}

.box_bg {background-color:#ffffff;}
.top_bg {height:45px; background:url('<?=$dmshop_order_delivery_path?>/img/top_bg.gif') repeat-x;}

.order_addr .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_addr .list {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_addr .url {text-decoration:underline; line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="top_bg">
    <td width="15"></td>
    <td><img src="<?=$dmshop_order_delivery_path?>/img/title.png" class="png"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td width="15"></td>
    <td>
<!-- 송장정보 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_delivery_path?>/img/arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_order_delivery_path?>/img/t1.gif"></td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_addr">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">발송일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><?=date("Y-m-d", strtotime($dmshop_order['order_delivery_datetime']));?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">운송장번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><?=text($dmshop_order['order_delivery_number'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">배송업체</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><?=text($dmshop_order['order_delivery_name'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td></tr>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">배송조회 URL</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><a href="<?=shop_http($dmshop_order['order_delivery_url']);?><?=text($dmshop_order['order_delivery_number'])?>" target="_blank" class="url"><? echo shop_text_cut(shop_http($dmshop_order['order_delivery_url']).$dmshop_order['order_delivery_number'], 50, "..."); ?></a></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td></tr>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">배송문의 전화</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><?=text($dmshop_order['order_delivery_tel'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 송장정보 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="30"><td></td></tr>
</table>

<!-- 배송지정보 start //-->
<table border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td><img src="<?=$dmshop_order_delivery_path?>/img/arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_order_delivery_path?>/img/t2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_addr">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">수령자 성명</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><?=text($dmshop_order['order_rec_name'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">휴대폰 / 전화</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><?=text($dmshop_order['order_rec_hp'])?> / <?=text($dmshop_order['order_rec_tel'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">배송지 주소</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><span class="zip">(우: <?=text($dmshop_order['order_rec_zip1'])?><?=text($dmshop_order['order_rec_zip2'])?>)</span> <?=text($dmshop_order['order_rec_addr1'])?> <?=text($dmshop_order['order_rec_addr2'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td></tr>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">배송 요구사항</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><?=text($dmshop_order['order_memo'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 배송지정보 end //-->
    </td>
    <td width="15"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1" bgcolor="#ffffff"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="90">
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$dmshop_order_delivery_path?>/img/close.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>