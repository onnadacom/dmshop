<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 4;

// 기간의 상위 판매량을 뽑는다
$report = array();
$result = sql_query(" select *, sum(order_limit) as report_count from $shop[order_table] where substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' group by item_id order by report_count desc limit 0, 10 ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $colspan++;

    $report[$i] = $row;

}

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

$report_count = 0;
$report_count_etc = 0;
for ($i=0; $i<count($list); $i++) {

    // 해당 기간의 판매량총수
    $order = sql_fetch(" select sum(order_limit) as report_count from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' ");

    $money_etc = 0;
    for ($k=0; $k<count($report); $k++) {

        // 해당 기간의 상품별 판매량총수을 구한다
        $data = sql_fetch(" select sum(order_limit) as report_count from $shop[order_table] where substring(order_datetime,1,7) = '".$list[$i]['month']."' and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' and item_id = '".$report[$k]['item_id']."' ");

        // 해당 기간 상품별 판매량수
        $list[$i][$k]['report_count'] = (int)($data['report_count']);

        // 해당 상품 총 판매량수
        $report[$k]['report_count_total'] += (int)($data['report_count']);

        // 기타 판매량수을 구하기 위해서 현재 판매량수을 합산
        $money_etc += (int)($data['report_count']);

    }

    $list[$i]['report_count'] = (int)($order['report_count']);
    $list[$i]['report_count_etc'] = (int)($order['report_count'] - $money_etc);

    $report_count += $list[$i]['report_count'];
    $report_count_etc += $list[$i]['report_count_etc'];

}
?>
<table width="100%" border
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "상품 판매량"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>판매량 합계</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_title");?>><?=text($report[$k]['item_title'])?></td>
<? } ?>
<td <?=shop_reporting_style("list_title");?>>기타</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['month']?></td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count']);?> 건</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i][$k]['report_count']);?> 건</td>
<? } ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_etc']);?> 건</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count);?> 건</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report[$k]['report_count_total']);?> 건</td>
<? } ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_etc);?> 건</td>
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
    data.addColumn('number', '<?=$report[$k]['report_count']?>');
<? } ?>
    data.addColumn('number', '기타');

    data.addRows(<? echo count($report) + 1; ?>);

<? for ($k=0; $k<count($report); $k++) { ?>
    data.setValue(<?=$k?>, 0, '<?=text($report[$k]['item_title'])?>');
    data.setValue(<?=$k?>, 1, <?=(int)($report[$k]['report_count']);?>);
<? } ?>
    data.setValue(<?=count($report);?>, 0, '기타');
    data.setValue(<?=count($report);?>, 1, <?=(int)($report_count_etc);?>);

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