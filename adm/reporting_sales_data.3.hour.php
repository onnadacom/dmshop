<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 6;

$list = array();
for ($i=0; $i<(int)(24); $i++) {

    $list[$i]['hour'] = sprintf("%02d" , $i);

}

$total_order_count = 0;
$total_order_total_item_money = 0;
$total_item_money = 0;
$total_option_money = 0;
for ($i=0; $i<count($list); $i++) {

    // 결제가 되고, 취소, 환불 완료가 아닌 것만
    $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money, sum(order_total_item_money) as total_order_total_item_money from (select distinct order_code, order_pay_money, order_total_item_money from $shop[order_table] where substring(order_datetime,12,2) = '".$list[$i]['hour']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2') as x ");

    // 결제가 되고, 취소, 환불 완료가 아닌 것만
    $order_money = sql_fetch(" select count(*) as total_count, sum(item_money * order_limit) as total_item_money, sum(option_money * order_limit) as total_option_money from $shop[order_table] where substring(order_datetime,12,2) = '".$list[$i]['hour']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' ");

    $list[$i]['total_order_count'] = $order['total_order_count'];
    $list[$i]['total_order_total_item_money'] = $order['total_order_total_item_money'];
    $list[$i]['total_item_money'] = $order_money['total_item_money'];
    $list[$i]['total_option_money'] = $order_money['total_option_money'];

    $total_order_count += $list[$i]['total_order_count'];
    $total_order_total_item_money += $list[$i]['total_order_total_item_money'];
    $total_item_money += $list[$i]['total_item_money'];
    $total_option_money += $list[$i]['total_option_money'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "주문 금액"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>주문 수</td>
<td <?=shop_reporting_style("list_title");?>>판매가격</td>
<td <?=shop_reporting_style("list_title");?>>옵션 변동액</td>
<td <?=shop_reporting_style("list_title");?>>주문금액</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<?
for ($i=0; $i<count($list); $i++) {
?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['hour']?> 시</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_count']);?> 건</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_item_money']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_option_money']);?> 원</td>
<td <?=shop_reporting_style("list_text_bold");?>><?=number_format($list[$i]['total_order_total_item_money']);?> 원</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_count);?> 건</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_item_money);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_option_money);?> 원</td>
<td <?=shop_reporting_style("list_text_bold");?>><?=number_format($total_order_total_item_money);?> 원</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<? if ($m == '') { ?>
<script type="text/javascript">
function reportingChart()
{

   var data = google.visualization.arrayToDataTable([
    ['시간', '주문 수', '판매가격', '옵션 변동액', '주문금액'],
<?
$comma = "";
for ($i=0; $i<count($list); $i++) {

    if ($i == '0') {

        $comma = "";

    } else {

        $comma = ",";

    }

    echo $comma."['".$list[$i]['hour']."',".(int)($list[$i]['total_order_count']).",".(int)($list[$i]['total_item_money']).",".(int)($list[$i]['total_option_money']).",".(int)($list[$i]['total_order_total_item_money'])."]";

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
series: {3: {type: "line"}}

    });

}

$(document).ready(function() {
    reportingChart();
    shopAdminViewResize();
});
</script>
<? } ?>