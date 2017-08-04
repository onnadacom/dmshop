<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 10;

// 날짜별 카운트 수를 구해야한다.
$date_count = strtotime($date2) - strtotime(substr($date1,0,7)."-01");
$date_count = (int)(($date_count / 86400) + 1);

$month_count = 0;
for ($i=0; $i<(int)($date_count); $i++) {

    if (date("d", strtotime(substr($date1,0,7)."-01") + (86400 * $i)) == '01') {

        $month_count++;

    }

}

$list = array();
for ($i=0; $i<(int)($month_count); $i++) {

    if ($i == '0') {

        $month = date("Y-m", strtotime(substr($date1,0,7)."-15"));

    } else {

        $month = date("Y-m", strtotime(substr($month,0,7)."-15") + (86400 * 30));

    }

    $list[$i]['month'] = $month;

}

$total_order_count = 0;
$total_order_pay_money = 0;
$total_order_total_item_money = 0;
$total_order_delivery_count = 0;
$total_order_delivery_money = 0;
$total_order_pay_type1_count = 0;
$total_order_pay_type1_commission = 0;
$total_order_pay_type2_count = 0;
$total_order_pay_type2_commission = 0;
$total_order_pay_type3_count = 0;
$total_order_pay_type3_commission = 0;
$total_order_pay_type4_count = 0;
$total_order_pay_type4_commission = 0;
$total_sales_money = 0;
for ($i=0; $i<count($list); $i++) {

    // 결제가 되고, 취소, 환불 완료가 아닌 것만
    $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money, sum(order_total_item_money) as total_order_total_item_money from (select distinct order_code, order_pay_money, order_total_item_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2') as x ");

    // 결제가 되고, 취소, 환불 완료가 아닌 것, 배송비가 있는 것
    //$order_delivery = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_delivery_money) as total_order_delivery_money from (select distinct order_code, order_delivery_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_delivery_money != '0') as x ");
    $order_delivery = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_delivery_money) as total_order_delivery_money from (select distinct order_code, order_delivery_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2') as x ");

    // 결제가 되고, 취소, 환불 완료가 아닌 것, 신용카드 결제
    $order_pay_type1 = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_pay_type = '1') as x ");

    // 결제가 되고, 취소, 환불 완료가 아닌 것, 실시간계좌 이체
    $order_pay_type2 = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_pay_type = '2') as x ");

    // 결제가 되고, 취소, 환불 완료가 아닌 것, 휴대폰 결제
    $order_pay_type3 = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_pay_type = '3') as x ");

    // 결제가 되고, 취소, 환불 완료가 아닌 것, 가상계좌 결제
    $order_pay_type4 = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and order_pay_type = '4') as x ");

    // 기본 배송비
    $order_delivery['total_order_delivery_money'] = 0;

    // set1 배송
    if ($order_delivery['total_order_count'] && $set1) {

        $order_delivery['total_order_delivery_money'] = (int)($order_delivery['total_order_count'] * $set1);

    }

    // set2 카드 수수료
    if ($order_pay_type1['total_order_count'] && $set2) {

        $order_pay_type1['total_order_pay_commission'] = (int)(($order_pay_type1['total_order_pay_money'] * $set2) / 100);

    } else {

        $order_pay_type1['total_order_pay_commission'] = 0;

    }

    // set3 실시간계좌 이체
    if ($order_pay_type2['total_order_count'] && $set3) {

        $order_pay_type2['total_order_pay_commission'] = (int)(($order_pay_type2['total_order_pay_money'] * $set3) / 100);

    } else {

        $order_pay_type2['total_order_pay_commission'] = 0;

    }

    // set4 휴대폰 결제
    if ($order_pay_type3['total_order_count'] && $set4) {

        $order_pay_type3['total_order_pay_commission'] = (int)(($order_pay_type3['total_order_pay_money'] * $set4) / 100);

    } else {

        $order_pay_type3['total_order_pay_commission'] = 0;

    }

    // set5 가상계좌 결제
    if ($order_pay_type4['total_order_count'] && $set5) {

        $order_pay_type4['total_order_pay_commission'] = (int)($order_pay_type4['total_order_count'] * $set5);

    } else {

        $order_pay_type4['total_order_pay_commission'] = 0;

    }

    $list[$i]['total_order_count'] = $order['total_order_count'];
    $list[$i]['total_order_pay_money'] = $order['total_order_pay_money'];
    $list[$i]['total_order_total_item_money'] = $order['total_order_total_item_money'];
    $list[$i]['total_order_delivery_count'] = $order_delivery['total_order_count'];
    $list[$i]['total_order_delivery_money'] = $order_delivery['total_order_delivery_money'] * -1;
    $list[$i]['total_order_pay_type1_count'] = $order_pay_type1['total_order_count'];
    $list[$i]['total_order_pay_type1_commission'] = $order_pay_type1['total_order_pay_commission'] * -1;
    $list[$i]['total_order_pay_type2_count'] = $order_pay_type2['total_order_count'];
    $list[$i]['total_order_pay_type2_commission'] = $order_pay_type2['total_order_pay_commission'] * -1;
    $list[$i]['total_order_pay_type3_count'] = $order_pay_type3['total_order_count'];
    $list[$i]['total_order_pay_type3_commission'] = $order_pay_type3['total_order_pay_commission'] * -1;
    $list[$i]['total_order_pay_type4_count'] = $order_pay_type4['total_order_count'];
    $list[$i]['total_order_pay_type4_commission'] = $order_pay_type4['total_order_pay_commission'] * -1;
    $list[$i]['total_sales_money'] = (int)($list[$i]['total_order_pay_money'] + ($list[$i]['total_order_delivery_money'] + $list[$i]['total_order_pay_type1_commission'] + $list[$i]['total_order_pay_type2_commission'] + $list[$i]['total_order_pay_type3_commission'] + $list[$i]['total_order_pay_type4_commission']));

    $total_order_count += $list[$i]['total_order_count'];
    $total_order_pay_money += $list[$i]['total_order_pay_money'];
    $total_order_total_item_money += $list[$i]['total_order_total_item_money'];
    $total_order_delivery_count += $list[$i]['total_order_delivery_count'];
    $total_order_delivery_money += $list[$i]['total_order_delivery_money'];
    $total_order_pay_type1_count += $list[$i]['total_order_pay_type1_count'];
    $total_order_pay_type1_commission += $list[$i]['total_order_pay_type1_commission'];
    $total_order_pay_type2_count += $list[$i]['total_order_pay_type2_count'];
    $total_order_pay_type2_commission += $list[$i]['total_order_pay_type2_commission'];
    $total_order_pay_type3_count += $list[$i]['total_order_pay_type3_count'];
    $total_order_pay_type3_commission += $list[$i]['total_order_pay_type3_commission'];
    $total_order_pay_type4_count += $list[$i]['total_order_pay_type4_count'];
    $total_order_pay_type4_commission += $list[$i]['total_order_pay_type4_commission'];
    $total_sales_money += $list[$i]['total_sales_money'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "추정 매출"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>주문 수</td>
<td <?=shop_reporting_style("list_title");?>>결제금액</td>
<td <?=shop_reporting_style("list_title");?>>배송비 지출금액</td>
<td <?=shop_reporting_style("list_title");?>>신용카드 수수료</td>
<td <?=shop_reporting_style("list_title");?>>계좌이체 수수료</td>
<td <?=shop_reporting_style("list_title");?>>휴대폰결제 수수료</td>
<td <?=shop_reporting_style("list_title");?>>가상계좌 수수료</td>
<td <?=shop_reporting_style("list_title");?>>추정매출</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<?
for ($i=0; $i<count($list); $i++) {
?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['month']?></td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_count']);?> 건</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_money']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_delivery_money']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type1_commission']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type2_commission']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type3_commission']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_type4_commission']);?> 원</td>
<td <?=shop_reporting_style("list_text_bold");?>><?=number_format($list[$i]['total_sales_money']);?> 원</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_count);?> 건</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_money);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_delivery_money);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type1_commission);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type2_commission);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type3_commission);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_type4_commission);?> 원</td>
<td <?=shop_reporting_style("list_text_bold");?>><?=number_format($total_sales_money);?> 원</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<? if ($m == '') { ?>
<script type="text/javascript">
function reportingChart()
{

   var data = google.visualization.arrayToDataTable([
    ['월', '주문 수', '결제금액', '배송비 지출금액', '신용카드 수수료', '계좌이체 수수료', '휴대폰결제 수수료', '가상계좌 수수료', '추정매출'],
<?
$comma = "";
for ($i=0; $i<count($list); $i++) {

    if ($i == '0') {

        $comma = "";

    } else {

        $comma = ",";

    }

    echo $comma."['".$list[$i]['month']."',".(int)($list[$i]['total_order_count']).",".(int)($list[$i]['total_order_pay_money']).",".(int)($list[$i]['total_order_delivery_money']).",".(int)($list[$i]['total_order_pay_type1_commission']).",".(int)($list[$i]['total_order_pay_type2_commission']).",".(int)($list[$i]['total_order_pay_type3_commission']).",".(int)($list[$i]['total_order_pay_type4_commission']).",".(int)($list[$i]['total_sales_money'])."]";

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
series: {7: {type: "line"}}

    });

}

$(document).ready(function() {
    reportingChart();
    shopAdminViewResize();
});
</script>
<? } ?>