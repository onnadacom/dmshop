<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 11;

$date_count = strtotime($date2) - strtotime($date1);
$date_count = (int)(($date_count / 86400) + 1);

$list = array();
for ($i=0; $i<(int)($date_count); $i++) {

    $list[$i]['date'] = date("Y-m-d", strtotime($date1) + (86400 * $i));
    $list[$i]['week'] = shop_week(date("w", strtotime($list[$i]['date'])));

}

$report_count_total = 0;
$report_count_age0 = 0;
$report_count_age1 = 0;
$report_count_age2 = 0;
$report_count_age3 = 0;
$report_count_age4 = 0;
$report_count_age5 = 0;
$report_count_age6 = 0;
$report_count_etc = 0;
for ($i=0; $i<count($list); $i++) {

    // 전체
    $total = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,10) = '".$list[$i]['date']."' and user_leave_datetime = '0000-00-00 00:00:00' ");

    // 10대 미만
    $age0 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,10) = '".$list[$i]['date']."' and user_leave_datetime = '0000-00-00 00:00:00' and user_birth != '' and substring(user_birth,1,4) > '".(int)(date("Y", $shop['server_time']) - 9)."' ");

    // 10대
    $age1 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,10) = '".$list[$i]['date']."' and user_leave_datetime = '0000-00-00 00:00:00' and user_birth != '' and substring(user_birth,1,4) >= '".(int)(date("Y", $shop['server_time']) - 18)."' and substring(user_birth,1,4) <= '".(int)(date("Y", $shop['server_time']) - 9)."' ");

    // 20대
    $age2 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,10) = '".$list[$i]['date']."' and user_leave_datetime = '0000-00-00 00:00:00' and user_birth != '' and substring(user_birth,1,4) >= '".(int)(date("Y", $shop['server_time']) - 28)."' and substring(user_birth,1,4) <= '".(int)(date("Y", $shop['server_time']) - 19)."' ");

    // 30대
    $age3 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,10) = '".$list[$i]['date']."' and user_leave_datetime = '0000-00-00 00:00:00' and user_birth != '' and substring(user_birth,1,4) >= '".(int)(date("Y", $shop['server_time']) - 38)."' and substring(user_birth,1,4) <= '".(int)(date("Y", $shop['server_time']) - 29)."' ");

    // 40대
    $age4 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,10) = '".$list[$i]['date']."' and user_leave_datetime = '0000-00-00 00:00:00' and user_birth != '' and substring(user_birth,1,4) >= '".(int)(date("Y", $shop['server_time']) - 48)."' and substring(user_birth,1,4) <= '".(int)(date("Y", $shop['server_time']) - 39)."' ");

    // 50대
    $age5 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,10) = '".$list[$i]['date']."' and user_leave_datetime = '0000-00-00 00:00:00' and user_birth != '' and substring(user_birth,1,4) >= '".(int)(date("Y", $shop['server_time']) - 58)."' and substring(user_birth,1,4) <= '".(int)(date("Y", $shop['server_time']) - 49)."' ");

    // 60대
    $age6 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,10) = '".$list[$i]['date']."' and user_leave_datetime = '0000-00-00 00:00:00' and user_birth != '' and substring(user_birth,1,4) <= '".(int)(date("Y", $shop['server_time']) - 59)."' ");

    // 없다
    $etc = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,10) = '".$list[$i]['date']."' and user_leave_datetime = '0000-00-00 00:00:00' and user_birth = '' ");

    $list[$i]['report_count_total'] = $total['report_count'];
    $list[$i]['report_count_age0'] = $age0['report_count'];
    $list[$i]['report_count_age1'] = $age1['report_count'];
    $list[$i]['report_count_age2'] = $age2['report_count'];
    $list[$i]['report_count_age3'] = $age3['report_count'];
    $list[$i]['report_count_age4'] = $age4['report_count'];
    $list[$i]['report_count_age5'] = $age5['report_count'];
    $list[$i]['report_count_age6'] = $age6['report_count'];
    $list[$i]['report_count_etc'] = $etc['report_count'];

    $report_count_total += $list[$i]['report_count_total'];
    $report_count_age0 += $list[$i]['report_count_age0'];
    $report_count_age1 += $list[$i]['report_count_age1'];
    $report_count_age2 += $list[$i]['report_count_age2'];
    $report_count_age3 += $list[$i]['report_count_age3'];
    $report_count_age4 += $list[$i]['report_count_age4'];
    $report_count_age5 += $list[$i]['report_count_age5'];
    $report_count_age6 += $list[$i]['report_count_age6'];
    $report_count_etc += $list[$i]['report_count_etc'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "회원 연령"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>합계</td>
<td <?=shop_reporting_style("list_title");?>>10대 미만</td>
<td <?=shop_reporting_style("list_title");?>>10대</td>
<td <?=shop_reporting_style("list_title");?>>20대</td>
<td <?=shop_reporting_style("list_title");?>>30대</td>
<td <?=shop_reporting_style("list_title");?>>40대</td>
<td <?=shop_reporting_style("list_title");?>>50대</td>
<td <?=shop_reporting_style("list_title");?>>60대 이상</td>
<td <?=shop_reporting_style("list_title");?>>기타 (미입력)</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<?
for ($i=0; $i<count($list); $i++) {
?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['date']?> (<?=$list[$i]['week']?>)</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_total']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_age0']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_age1']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_age2']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_age3']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_age4']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_age5']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_age6']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_etc']);?> 명</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_total);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_age0);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_age1);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_age2);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_age3);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_age4);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_age5);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_age6);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_etc);?> 명</td>
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

    data.addColumn('number', '10대 미만');
    data.addColumn('number', '10대');
    data.addColumn('number', '20대');
    data.addColumn('number', '30대');
    data.addColumn('number', '40대');
    data.addColumn('number', '50대');
    data.addColumn('number', '60대 이상');
    data.addColumn('number', '기타 (미입력)');

    data.addRows(8);

    data.setValue(0, 0, '10대 미만');
    data.setValue(0, 1, <?=(int)($report_count_age0);?>);
    data.setValue(1, 0, '10대');
    data.setValue(1, 1, <?=(int)($report_count_age1);?>);
    data.setValue(2, 0, '20대');
    data.setValue(2, 1, <?=(int)($report_count_age2);?>);
    data.setValue(3, 0, '30대');
    data.setValue(3, 1, <?=(int)($report_count_age3);?>);
    data.setValue(4, 0, '40대');
    data.setValue(4, 1, <?=(int)($report_count_age4);?>);
    data.setValue(5, 0, '50대');
    data.setValue(5, 1, <?=(int)($report_count_age5);?>);
    data.setValue(6, 0, '60대 이상');
    data.setValue(6, 1, <?=(int)($report_count_age6);?>);
    data.setValue(7, 0, '기타 (미입력)');
    data.setValue(7, 1, <?=(int)($report_count_etc);?>);

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