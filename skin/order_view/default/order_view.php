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
.top_bg {height:45px; background:url('<?=$dmshop_order_view_path?>/img/top_bg.gif') repeat-x;}

.order_infor .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_infor .date {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_infor .time {line-height:16px; font-size:11px; color:#adadad; font-family:dotum,돋움;}
.order_infor .code {line-height:16px; font-size:12px; color:#7da7d9; font-family:gulim,굴림;}
.order_infor .money {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_infor .mode {line-height:16px; font-size:12px; color:#000000; font-family:gulim,굴림;}

.order_list .thumb {border:2px solid #e4e4e4;}

.order_list .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_list .subject {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .option {line-height:16px; font-size:11px; color:#8b49c7; font-family:dotum,돋움;}
.order_list .limit {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .money {line-height:16px; font-size:12px; color:#ff3c00; font-family:dotum,돋움;}
.order_list .dot {height:1px; background:url('<?=$dmshop_order_view_path?>/img/dot.gif') repeat-x;}

.order_addr .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_addr .list {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_addr .zip {line-height:16px; font-size:11px; color:#8b8d8e; font-family:dotum,돋움;}

.order_pay .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_pay .t1 {line-height:16px; font-size:12px; color:#ff3c00; font-family:gulim,굴림;}
.order_pay .t2 {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_pay .t3 {font-weight:bold; line-height:16px; font-size:13px; color:#010101; font-family:gulim,굴림;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="top_bg">
    <td width="15"></td>
    <td><img src="<?=$dmshop_order_view_path?>/img/title.png" class="png"></td>
    <td width="200" align="right" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top"><a href="#" onclick="dataPrint(); return false;"><img src="<?=$dmshop_order_view_path?>/img/print.png" class="png" border="0"></a></td>
    <td width="2"></td>
    <td valign="top"><a href="#" onclick="window.close(); return false;"><img src="<?=$dmshop_order_view_path?>/img/close.png" class="png" border="0"></a></td>
</tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<div id="print_data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="15"></td>
    <td>
<!-- 주문정보 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_view_path?>/img/arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_order_view_path?>/img/t1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_infor">
<tr>
    <td width="149" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">주문일시</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="47">
    <td align="center" class="date"><?=date("Y-m-d", strtotime($dmshop_order['order_datetime']));?><br><span class="time"><?=date("H:i", strtotime($dmshop_order['order_datetime']));?></span></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="1"></td>
    <td width="148" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">주문번호</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="47">
    <td align="center" class="code"><?=$order_code?></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="1"></td>
    <td width="148" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">결제금액</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="47">
    <td align="center" class="money"><?=number_format($dmshop_order['order_pay_money']);?> 원</td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="1"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">주문상태</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="47">
    <td align="center" class="mode"><?=shop_order_type($dmshop_order['order_type']);?></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 주문정보 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<!-- 주문상품목록 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_view_path?>/img/arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_order_view_path?>/img/t2.gif"></td>
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
</colgroup>
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">상품명</td>
    <td></td>
    <td align="center" class="title">주문수량</td>
    <td></td>
    <td align="center" class="title">판매가격</td>
    <td></td>
    <td align="center" class="title">배송비</td>
</tr>
<tr><td colspan="7" height="2" bgcolor="#777777"></td></tr>
<?
$item_delivery_bunch = false;

for ($i=0; $i<count($list); $i++) {

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $dmshop_mypage_path."/img/noimage.gif"; }
?>
<? if ($i > '0') { ?>
<tr><td colspan="7" class="dot"></td></tr>
<? } ?>
<tr height="73">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="9"></td>
    <td width="50" align="center"><div class="thumb"><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank"><img src="<?=$thumb?>" width="50" height="50" border="0"></a></div></td>
    <td width="10"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank" class="subject"><?=text($list[$i]['item_title'])?></a></td>
</tr>
</table>

<? if ($list[$i]['option_name']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="option">주문옵션 : <?=text($list[$i]['option_name'])?></span></td>
</tr>
</table>
<? } ?>
    </td>
</tr>
</table>
    </td>
    <td bgcolor="#efefef"></td>
    <td align="center" class="limit"><?=number_format($list[$i]['order_limit']);?> 개</td>
    <td bgcolor="#efefef"></td>
    <td align="center" class="money"><?=number_format($list[$i]['order_item_money']);?> 원</td>
    <td bgcolor="#efefef"></td>
    <td align="center" class="limit">
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
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>
<!-- 주문상품목록 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<!-- 배송지정보 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_view_path?>/img/arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_order_view_path?>/img/t3.gif"></td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<!-- 결제정보 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_view_path?>/img/arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_order_view_path?>/img/t4.gif"></td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_pay">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">총 주문금액</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="t1"><?=number_format($dmshop_order['order_total_item_money']);?> 원</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">쿠폰 할인</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="t2"><?=number_format($dmshop_order['order_coupon']);?> 원</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">적립금 할인</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="t2"><?=number_format($dmshop_order['order_cash']);?> 원</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">배송비</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="t2"><?=number_format($dmshop_order['order_delivery_money']);?> 원</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">실 결제금액</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="t3"><?=number_format($dmshop_order['order_pay_money']);?> 원</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">결제수단</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="t2"><?=shop_pay_name($dmshop_order['order_pay_type']);?></td>
</tr>
<? if ($dmshop_order['order_pay_type'] == '4' || $dmshop_order['order_pay_type'] == '5') { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">입금은행</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="t2"><?=text($dmshop_order['order_bank_name'])?> <?=text($dmshop_order['order_bank_number'])?> (예금주 : <?=text($dmshop_order['order_bank_holder'])?>)</td>
</tr>
<? if ($dmshop_order['order_dep_name']) { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">입금자명</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="t2"><?=text($dmshop_order['order_dep_name'])?></td>
</tr>
<? } ?>
<? } ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">영수증</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="t2">
<?
// 영수증 버튼
$receipt_btn = str_replace("btn", "<img src='".$dmshop_order_view_path."/img/receipt_btn.gif' border='0'>", shop_order_receipt_btn($dmshop_order['order_code']));
echo $receipt_btn;
?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 결제정보 end //-->
    </td>
    <td width="15"></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

<script type="text/javascript">
var tmp;

function dataPrint()
{

    beforePrint();

    window.print();

    setTimeout("afterPrint();", 1000);

}

function beforePrint()
{

    tmp = document.body.innerHTML;

    document.body.innerHTML = document.getElementById("print_data").innerHTML;

}

function afterPrint()
{

    document.body.innerHTML = tmp;

}
</script>