<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 10;

//$date_count = sql_fetch(" select datediff('$date1','$date2') as total_count ");
//echo $date_count[total_count];

// 날짜별 카운트 수를 구해야한다.
$date_count = strtotime($date2) - strtotime($date1);
$date_count = (int)(($date_count / 86400) + 1);

$list = array();
for ($i=0; $i<(int)($date_count); $i++) {

    $list[$i]['date'] = date("Y-m-d", strtotime($date1) + (86400 * $i));
    $list[$i]['week'] = shop_week(date("w", strtotime($list[$i]['date'])));

}

$total_order_pay_money = 0;
$total_order_pay_money_host1 = 0;
$total_order_pay_money_host2 = 0;
$total_order_pay_money_host3 = 0;
$total_order_pay_money_host4 = 0;
$total_order_pay_money_host5 = 0;
$total_order_pay_money_host6 = 0;
$total_order_pay_money_host7 = 0;
for ($i=0; $i<count($list); $i++) {

    // 결제가 되고, 취소, 환불 완료가 아닌 것만
    $order = sql_fetch(" select sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where substring(order_datetime,1,10) = '".$list[$i]['date']."' and order_payment = '2' and order_cancel != '2' and order_refund != '2') as x ");

    $order_host1 = sql_fetch(" 
select sum(order_pay_money) as total_order_pay_money from (
select distinct a.order_code, a.order_pay_money from $shop[order_table] a, $shop[visit_table] b where substring(a.order_datetime,1,10) = '".$list[$i]['date']."' and a.order_payment = '2' and a.order_cancel != '2' and a.order_refund != '2'
and substring(b.vi_datetime,1,10) = '".$list[$i]['date']."' and b.vi_first = '1' and (INSTR(b.vi_host,'naver.'))
and a.order_ip = b.vi_ip
) as x 

");

    $order_host2 = sql_fetch(" 
select sum(order_pay_money) as total_order_pay_money from (
select distinct a.order_code, a.order_pay_money from $shop[order_table] a, $shop[visit_table] b where substring(a.order_datetime,1,10) = '".$list[$i]['date']."' and a.order_payment = '2' and a.order_cancel != '2' and a.order_refund != '2'
and substring(b.vi_datetime,1,10) = '".$list[$i]['date']."' and b.vi_first = '1' and (INSTR(b.vi_host,'daum.'))
and a.order_ip = b.vi_ip
) as x 

");

    $order_host3 = sql_fetch(" 
select sum(order_pay_money) as total_order_pay_money from (
select distinct a.order_code, a.order_pay_money from $shop[order_table] a, $shop[visit_table] b where substring(a.order_datetime,1,10) = '".$list[$i]['date']."' and a.order_payment = '2' and a.order_cancel != '2' and a.order_refund != '2'
and substring(b.vi_datetime,1,10) = '".$list[$i]['date']."' and b.vi_first = '1' and (INSTR(b.vi_host,'nate.'))
and a.order_ip = b.vi_ip
) as x 

");

    $order_host4 = sql_fetch(" 
select sum(order_pay_money) as total_order_pay_money from (
select distinct a.order_code, a.order_pay_money from $shop[order_table] a, $shop[visit_table] b where substring(a.order_datetime,1,10) = '".$list[$i]['date']."' and a.order_payment = '2' and a.order_cancel != '2' and a.order_refund != '2'
and substring(b.vi_datetime,1,10) = '".$list[$i]['date']."' and b.vi_first = '1' and (INSTR(b.vi_host,'yahoo.'))
and a.order_ip = b.vi_ip
) as x 

");

    $order_host5 = sql_fetch(" 
select sum(order_pay_money) as total_order_pay_money from (
select distinct a.order_code, a.order_pay_money from $shop[order_table] a, $shop[visit_table] b where substring(a.order_datetime,1,10) = '".$list[$i]['date']."' and a.order_payment = '2' and a.order_cancel != '2' and a.order_refund != '2'
and substring(b.vi_datetime,1,10) = '".$list[$i]['date']."' and b.vi_first = '1' and (INSTR(b.vi_host,'google.'))
and a.order_ip = b.vi_ip
) as x 

");

    $order_host6 = sql_fetch(" 
select sum(order_pay_money) as total_order_pay_money from (
select distinct a.order_code, a.order_pay_money from $shop[order_table] a, $shop[visit_table] b where substring(a.order_datetime,1,10) = '".$list[$i]['date']."' and a.order_payment = '2' and a.order_cancel != '2' and a.order_refund != '2'
and substring(b.vi_datetime,1,10) = '".$list[$i]['date']."' and b.vi_first = '1' and b.vi_host in ('{$dmshop['doamin']}', '')
and a.order_ip = b.vi_ip
) as x 

");

    $list[$i]['total_order_pay_money'] = $order['total_order_pay_money'];
    $list[$i]['total_order_pay_money_host1'] = $order_host1['total_order_pay_money'];
    $list[$i]['total_order_pay_money_host2'] = $order_host2['total_order_pay_money'];
    $list[$i]['total_order_pay_money_host3'] = $order_host3['total_order_pay_money'];
    $list[$i]['total_order_pay_money_host4'] = $order_host4['total_order_pay_money'];
    $list[$i]['total_order_pay_money_host5'] = $order_host5['total_order_pay_money'];
    $list[$i]['total_order_pay_money_host6'] = $order_host6['total_order_pay_money'];
    $list[$i]['total_order_pay_money_host7'] = (int)($list[$i]['total_order_pay_money'] - ($list[$i]['total_order_pay_money_host1'] + $list[$i]['total_order_pay_money_host2'] + $list[$i]['total_order_pay_money_host3'] + $list[$i]['total_order_pay_money_host4'] + $list[$i]['total_order_pay_money_host5'] + $list[$i]['total_order_pay_money_host6']));

    $total_order_pay_money += $list[$i]['total_order_pay_money'];
    $total_order_pay_money_host1 += $list[$i]['total_order_pay_money_host1'];
    $total_order_pay_money_host2 += $list[$i]['total_order_pay_money_host2'];
    $total_order_pay_money_host3 += $list[$i]['total_order_pay_money_host3'];
    $total_order_pay_money_host4 += $list[$i]['total_order_pay_money_host4'];
    $total_order_pay_money_host5 += $list[$i]['total_order_pay_money_host5'];
    $total_order_pay_money_host6 += $list[$i]['total_order_pay_money_host6'];
    $total_order_pay_money_host7 += $list[$i]['total_order_pay_money_host7'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "유입 경로별"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>총 결제금액</td>
<td <?=shop_reporting_style("list_title");?>>네이버</td>
<td <?=shop_reporting_style("list_title");?>>다음</td>
<td <?=shop_reporting_style("list_title");?>>네이트</td>
<td <?=shop_reporting_style("list_title");?>>야후</td>
<td <?=shop_reporting_style("list_title");?>>구글</td>
<td <?=shop_reporting_style("list_title");?>>직접방문</td>
<td <?=shop_reporting_style("list_title");?>>기타</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<?
for ($i=0; $i<count($list); $i++) {
?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['date']?> (<?=$list[$i]['week']?>)</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_money']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_money_host1']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_money_host2']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_money_host3']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_money_host4']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_money_host5']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_money_host6']);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_order_pay_money_host7']);?> 원</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_money);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_money_host1);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_money_host2);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_money_host3);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_money_host4);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_money_host5);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_money_host6);?> 원</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_order_pay_money_host7);?> 원</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<? if ($m == '') { ?>
<script type="text/javascript">
function reportingChart()
{

    var data = new google.visualization.DataTable();

    data.addColumn('string', 'Task');

    data.addColumn('number', '네이버');
    data.addColumn('number', '다음');
    data.addColumn('number', '네이트');
    data.addColumn('number', '야후');
    data.addColumn('number', '구글');
    data.addColumn('number', '직접방문');
    data.addColumn('number', '기타');

    data.addRows(7);

    data.setValue(0, 0, '네이버');
    data.setValue(0, 1, <?=(int)($total_order_pay_money_host1);?>);
    data.setValue(1, 0, '다음');
    data.setValue(1, 1, <?=(int)($total_order_pay_money_host2);?>);
    data.setValue(2, 0, '네이트');
    data.setValue(2, 1, <?=(int)($total_order_pay_money_host3);?>);
    data.setValue(3, 0, '야후');
    data.setValue(3, 1, <?=(int)($total_order_pay_money_host4);?>);
    data.setValue(4, 0, '구글');
    data.setValue(4, 1, <?=(int)($total_order_pay_money_host5);?>);
    data.setValue(5, 0, '직접방문');
    data.setValue(5, 1, <?=(int)($total_order_pay_money_host6);?>);
    data.setValue(6, 0, '기타');
    data.setValue(6, 1, <?=(int)($total_order_pay_money_host7);?>);

    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

    chart.draw(data, {

    width: '100%', height: '500',
    legend: 'right',
    legendTextStyle: {fontName: 'gulim', fontSize: '12'},
    tooltipTextStyle: {color: '#006679', fontName: 'dotum', fontSize: '12'}
    });

}

$(document).ready(function() {
    reportingChart();
    shopAdminViewResize();
});
</script>
<? } ?>