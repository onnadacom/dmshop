<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 8;

// 년도별 카운트 수를 구해야한다.
$year_count = strtotime($date2) - strtotime(substr($date1,0,7)."-01");
$year_count = (int)(($year_count / (86400 * 365)) + 1);

$list = array();
for ($i=0; $i<(int)($year_count); $i++) {

    $list[$i]['year'] = (int)(substr($date1,0,4) + $i);

}

$total_order_count = 0;
$total_order_total_item_money = 0;
$total_order_pay_money = 0;
$total_order_delivery_money = 0;
$total_order_total_coupon = 0;
$total_order_cash = 0;
for ($i=0; $i<count($list); $i++) {

    // 결제가 되고, 취소, 환불 완료가 아닌 것만
    $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money, sum(order_total_item_money) as total_order_total_item_money from (select distinct order_code, order_pay_money, order_total_item_money from $shop[order_table] where substring(order_datetime,1,4) = '".$list[$i]['year']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2') as x ");

    // 결제가 되고, 취소, 환불 완료가 아닌 것, 배송비가 있는 것
    $order_delivery = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_delivery_money) as total_order_delivery_money from (select distinct order_code, order_delivery_money from $shop[order_table] where substring(order_datetime,1,4) = '".$list[$i]['year']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_delivery_money != '0') as x ");

    // 결제가 되고, 취소, 환불 완료가 아닌 것, 쿠폰가격합계가 있는 것
    $order_coupon = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_total_coupon) as total_order_total_coupon from (select distinct order_code, order_total_coupon from $shop[order_table] where substring(order_datetime,1,4) = '".$list[$i]['year']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_total_coupon != '0') as x ");

    // 결제가 되고, 취소, 환불 완료가 아닌 것, 쿠폰가격합계가 있는 것
    $order_cash = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_cash) as total_order_cash from (select distinct order_code, order_cash from $shop[order_table] where substring(order_datetime,1,4) = '".$list[$i]['year']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_cash != '0') as x ");

    $list[$i]['total_order_count'] = $order['total_order_count'];
    $list[$i]['total_order_total_item_money'] = $order['total_order_total_item_money'];
    $list[$i]['total_order_pay_money'] = $order['total_order_pay_money'];
    $list[$i]['total_order_delivery_money'] = $order_delivery['total_order_delivery_money'];
    $list[$i]['total_order_total_coupon'] = (int)($order_coupon['total_order_total_coupon'] * -1);
    $list[$i]['total_order_cash'] = (int)($order_cash['total_order_cash'] * -1);

    $total_order_count += $list[$i]['total_order_count'];
    $total_order_total_item_money += $list[$i]['total_order_total_item_money'];
    $total_order_pay_money += $list[$i]['total_order_pay_money'];
    $total_order_delivery_money += $list[$i]['total_order_delivery_money'];
    $total_order_total_coupon += $list[$i]['total_order_total_coupon'];
    $total_order_cash += $list[$i]['total_order_cash'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "결제 금액"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>주문 수</td>
<td <?=shop_reporting_style("list_title");?>>주문금액</td>
<td <?=shop_reporting_style("list_title");?>>배송비 결제금액</td>
<td <?=shop_reporting_style("list_title");?>>쿠폰 사용금액</td>
<td <?=shop_reporting_style("list_title");?>>적립금 사용금액</td>
<td <?=shop_reporting_style("list_title");?>>결제금액</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<?
for ($i=0; $i<count($list); $i++) {
?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['year']?></td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_count']);?> 건</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_total_item_money']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_delivery_money']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_total_coupon']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_cash']);?> 원</td>
<td <?=shop_reporting_style("list_text_bold");?>><?=number_format($list[$i]['total_order_pay_money']);?> 원</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_count);?> 건</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_total_item_money);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_delivery_money);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_total_coupon);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_cash);?> 원</td>
<td <?=shop_reporting_style("list_text_bold");?>><?=number_format($total_order_pay_money);?> 원</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<? if ($m == '') { ?>
<script type="text/javascript">
function reportingChart()
{

   var data = google.visualization.arrayToDataTable([
    ['년도', '주문 수', '주문금액', '배송비 결제금액', '쿠폰 사용금액', '적립금 사용금액', '결제금액'],
<?
$comma = "";
for ($i=0; $i<count($list); $i++) {

    if ($i == '0') {

        $comma = "";

    } else {

        $comma = ",";

    }

    echo $comma."['".$list[$i]['year']."',".(int)($list[$i]['total_order_count']).",".(int)($list[$i]['total_order_total_item_money']).",".(int)($list[$i]['total_order_delivery_money']).",".(int)($list[$i]['total_order_total_coupon']).",".(int)($list[$i]['total_order_cash']).",".(int)($list[$i]['total_order_pay_money'])."]";

}
?>
    ]);

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));

    chart.draw(data, {

    width: '100%', height: '500',
    legend: 'right',
    legendTextStyle: {fontName: 'gulim', fontSize: '12'},
    tooltipTextStyle: {color: '#006679', fontName: 'dotum', fontSize: '12'},

    hAxis: {textStyle: {color: '#959595', fontName: 'dotum', fontSize: '12'}},
    vAxis: {textStyle: {color: '#959595', fontName: 'dotum', fontSize: '12'}, gridlineColor: '#e1e1e1', baselineColor: '#e1e1e1', textPosition: 'out'},

lineWidth: 3,
pointSize: 5,
seriesType: "bars",
series: {5: {type: "line"}}

    });

}

$(document).ready(function() {
    reportingChart();
    shopAdminViewResize();
});
</script>
<? } ?>