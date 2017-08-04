<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 6;

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

$report_count_total = 0;
$report_count_man = 0;
$report_count_woman = 0;
$report_count_etc = 0;
for ($i=0; $i<count($list); $i++) {

    // 전체
    $total = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' ");

    // 남자
    $man = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_sex = 'M' ");

    // 여자
    $woman = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_sex = 'F' ");

    // 없다
    $etc = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_sex = '' ");

    $list[$i]['total_visit_count'] = $visit['report_count'];
    $list[$i]['report_count_total'] = $total['report_count'];
    $list[$i]['report_count_man'] = $man['report_count'];
    $list[$i]['report_count_woman'] = $woman['report_count'];
    $list[$i]['report_count_etc'] = $etc['report_count'];

    $report_count_total += $list[$i]['report_count_total'];
    $report_count_man += $list[$i]['report_count_man'];
    $report_count_woman += $list[$i]['report_count_woman'];
    $report_count_etc += $list[$i]['report_count_etc'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "회원 성별"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>합계</td>
<td <?=shop_reporting_style("list_title");?>>남자</td>
<td <?=shop_reporting_style("list_title");?>>여자</td>
<td <?=shop_reporting_style("list_title");?>>기타 (미입력)</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<?
for ($i=0; $i<count($list); $i++) {
?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['month']?></td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_total']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_man']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_woman']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_etc']);?> 명</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_total);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_man);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_woman);?> 명</td>
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

    data.addColumn('number', '남자');
    data.addColumn('number', '여자');
    data.addColumn('number', '기타 (미입력)');

    data.addRows(3);

    data.setValue(0, 0, '남자');
    data.setValue(0, 1, <?=(int)($report_count_man);?>);
    data.setValue(1, 0, '여자');
    data.setValue(1, 1, <?=(int)($report_count_woman);?>);
    data.setValue(2, 0, '기타 (미입력)');
    data.setValue(2, 1, <?=(int)($report_count_etc);?>);

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