<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 4;

// 기간의 상위 해상도를 뽑는다
$report = array();
$result = sql_query(" select vi_resolution, count(vi_resolution) as report_count from $shop[visit_table] where substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_first = '1' group by vi_resolution order by report_count desc limit 0, 10 ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $colspan++;

    $report[$i] = $row;

}

// 날짜별 카운트 수를 구해야한다.
$date_count = strtotime($date2) - strtotime($date1);
$date_count = (int)(($date_count / 86400) + 1);

$list = array();
for ($i=0; $i<(int)($date_count); $i++) {

    $list[$i]['date'] = date("Y-m-d", strtotime($date1) + (86400 * $i));
    $list[$i]['week'] = shop_week(date("w", strtotime($list[$i]['date'])));

}

$report_count = 0;
$report_count_etc = 0;
for ($i=0; $i<count($list); $i++) {

    // 방문자 수
    $visit = sql_fetch(" select count(vi_ip) as report_count from $shop[visit_table] where substring(vi_datetime,1,10) = '".$list[$i]['date']."' and vi_first = '1' ");

    $list_count = 0;
    for ($k=0; $k<count($report); $k++) {

        // 해당 기간의 해상도별 카운트를 구한다
        $data = sql_fetch(" select count(vi_resolution) as report_count from $shop[visit_table] where substring(vi_datetime,1,10) = '".$list[$i]['date']."' and vi_resolution = '".addslashes($report[$k]['vi_resolution'])."' and vi_first = '1' group by vi_resolution ");

        // 해당 기간 해상도별 카운트
        $list[$i][$k]['report_count'] = (int)($data['report_count']);

        // 해당 해상도 총합
        $report[$k]['report_count_total'] += (int)($data['report_count']);

        // 기타 해상도를 구하기 위해서 현재 해상도를 합산
        $list_count += (int)($data['report_count']);

    }

    $list[$i]['report_count'] = (int)($visit['report_count']);
    $list[$i]['report_count_etc'] = (int)($visit['report_count'] - $list_count);

    $report_count += $list[$i]['report_count'];
    $report_count_etc += $list[$i]['report_count_etc'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "모니터 해상도"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>방문자 수</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_title");?>><? if ($report[$k]['vi_resolution']) { echo text($report[$k]['vi_resolution']); } else { echo "없음"; } ?></td>
<? } ?>
<td <?=shop_reporting_style("list_title");?>>기타</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['date']?> (<?=$list[$i]['week']?>)</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count']);?> 명</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i][$k]['report_count']);?> 명</td>
<? } ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_etc']);?> 명</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count);?> 명</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report[$k]['report_count_total']);?> 명</td>
<? } ?>
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

<? for ($k=0; $k<count($report); $k++) { ?>
    data.addColumn('number', '<? if ($report[$k]['vi_resolution']) { echo text($report[$k]['vi_resolution']); } else { echo "없음"; } ?>');
<? } ?>
    data.addColumn('number', '기타');

    data.addRows(<? echo count($report) + 1; ?>);

<? for ($k=0; $k<count($report); $k++) { ?>
    data.setValue(<?=$k?>, 0, '<? if ($report[$k]['vi_resolution']) { echo text($report[$k]['vi_resolution']); } else { echo "없음"; } ?>');
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