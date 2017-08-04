<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 4;

// 기간의 상위 주문을 뽑는다
$report = array();
$result = sql_query(" select *, sum(order_item_money) as report_money from $shop[order_table] where substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and user_id != '' group by user_id order by report_money desc limit 0, 10 ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $colspan++;

    $report[$i] = $row;

    $user = shop_user($row['user_id']);

    $report[$i]['user_name'] = $user['user_name'];

}

$list = array();
for ($i=0; $i<(int)(24); $i++) {

    $list[$i]['hour'] = sprintf("%02d" , $i);

}

$report_money = 0;
$report_money_etc = 0;
for ($i=0; $i<count($list); $i++) {

    // 해당 기간의 주문총액
    $order = sql_fetch(" select sum(order_item_money) as report_money from $shop[order_table] where substring(order_datetime,12,2) = '".$list[$i]['hour']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and user_id != '' ");

    $money_etc = 0;
    for ($k=0; $k<count($report); $k++) {

        // 해당 기간의 상품별 주문총액을 구한다
        $data = sql_fetch(" select sum(order_item_money) as report_money from $shop[order_table] where substring(order_datetime,12,2) = '".$list[$i]['hour']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and user_id = '".addslashes($report[$k]['user_id'])."' and user_id != '' ");

        // 해당 기간 상품별 주문금액
        $list[$i][$k]['report_money'] = (int)($data['report_money']);

        // 해당 상품 총 주문금액
        $report[$k]['report_money_total'] += (int)($data['report_money']);

        // 기타 주문금액을 구하기 위해서 현재 주문금액을 합산
        $money_etc += (int)($data['report_money']);

    }

    $list[$i]['report_money'] = (int)($order['report_money']);
    $list[$i]['report_money_etc'] = (int)($order['report_money'] - $money_etc);

    $report_money += $list[$i]['report_money'];
    $report_money_etc += $list[$i]['report_money_etc'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "회원 주문"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>주문금액 합계</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_title");?>><?=text($report[$k]['user_name'])?>(<?=text($report[$k]['user_id'])?>)</td>
<? } ?>
<td <?=shop_reporting_style("list_title");?>>기타</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['hour']?> 시</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_money']);?> 원</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i][$k]['report_money']);?> 원</td>
<? } ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_money_etc']);?> 원</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_money);?> 원</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report[$k]['report_money_total']);?> 원</td>
<? } ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_money_etc);?> 원</td>
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

<? for ($k=0; $k<count($report); $k++) { ?>
    data.addColumn('number', '<?=$report[$k]['report_money']?>');
<? } ?>
    data.addColumn('number', '기타');

    data.addRows(<? echo count($report) + 1; ?>);

<? for ($k=0; $k<count($report); $k++) { ?>
    data.setValue(<?=$k?>, 0, '<?=text($report[$k]['user_name'])?>(<?=text($report[$k]['user_id'])?>)');
    data.setValue(<?=$k?>, 1, <?=(int)($report[$k]['report_money']);?>);
<? } ?>
    data.setValue(<?=count($report);?>, 0, '기타');
    data.setValue(<?=count($report);?>, 1, <?=(int)($report_money_etc);?>);

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