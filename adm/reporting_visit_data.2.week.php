<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 9;

$list = array();
for ($i=0; $i<(int)(7); $i++) {

    $list[$i]['week'] = $i; // php 0 부터
    $list[$i]['dayofweek'] = ($i + 1); // mysql 1부터

}

$total_visit_count = 0;
$total_visit_return1_count = 0;
$total_visit_return2_count = 0;
$total_visit_return3_count = 0;
$total_visit_return4_count = 0;
$total_visit_return5_count = 0;
$total_visit_return_ratio_count = 0;
for ($i=0; $i<count($list); $i++) {

    // 방문자 수
    $visit = sql_fetch(" select count(vi_ip) as report_count from (select distinct substring(vi_datetime,1,10), vi_ip from $shop[visit_table] where dayofweek(vi_datetime) = '".$list[$i]['dayofweek']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."') as x ");

    // 1회 방문
    $visit_return1 = sql_fetch(" select count(vi_ip) as report_count from (select distinct substring(vi_datetime,1,10), vi_ip from $shop[visit_table] where dayofweek(vi_datetime) = '".$list[$i]['dayofweek']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_return = '1') as x");

    // 2회 방문
    $visit_return2 = sql_fetch(" select count(vi_ip) as report_count from (select distinct substring(vi_datetime,1,10), vi_ip from $shop[visit_table] where dayofweek(vi_datetime) = '".$list[$i]['dayofweek']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_return = '2') as x");

    // 3회 방문
    $visit_return3 = sql_fetch(" select count(vi_ip) as report_count from (select distinct substring(vi_datetime,1,10), vi_ip from $shop[visit_table] where dayofweek(vi_datetime) = '".$list[$i]['dayofweek']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_return = '3') as x");

    // 4회 방문
    $visit_return4 = sql_fetch(" select count(vi_ip) as report_count from (select distinct substring(vi_datetime,1,10), vi_ip from $shop[visit_table] where dayofweek(vi_datetime) = '".$list[$i]['dayofweek']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_return = '4') as x");

    // 5회 이상 방문
    $visit_return5 = sql_fetch(" select count(vi_ip) as report_count from (select distinct substring(vi_datetime,1,10), vi_ip from $shop[visit_table] where dayofweek(vi_datetime) = '".$list[$i]['dayofweek']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_return >= '5') as x");

    $list[$i]['total_visit_count'] = $visit['report_count'];
    $list[$i]['total_visit_return1_count'] = $visit_return1['report_count'];
    $list[$i]['total_visit_return2_count'] = $visit_return2['report_count'];
    $list[$i]['total_visit_return3_count'] = $visit_return3['report_count'];
    $list[$i]['total_visit_return4_count'] = $visit_return4['report_count'];
    $list[$i]['total_visit_return5_count'] = $visit_return5['report_count'];

    if ($list[$i]['total_visit_count'] && ($list[$i]['total_visit_return2_count'] || $list[$i]['total_visit_return3_count'] || $list[$i]['total_visit_return4_count'] || $list[$i]['total_visit_return5_count'])) {

        $list[$i]['total_visit_return_ratio_count'] = round((($list[$i]['total_visit_return2_count']+ $list[$i]['total_visit_return3_count'] + $list[$i]['total_visit_return4_count']+ $list[$i]['total_visit_return5_count']) * 100) / $list[$i]['total_visit_count'], 2);

    } else {

        $list[$i]['total_visit_return_ratio_count'] = 0;

    }

    $total_visit_count += $list[$i]['total_visit_count'];
    $total_visit_return1_count += $list[$i]['total_visit_return1_count'];
    $total_visit_return2_count += $list[$i]['total_visit_return2_count'];
    $total_visit_return3_count += $list[$i]['total_visit_return3_count'];
    $total_visit_return4_count += $list[$i]['total_visit_return4_count'];
    $total_visit_return5_count += $list[$i]['total_visit_return5_count'];
    $total_visit_return_ratio_count += $list[$i]['total_visit_return_ratio_count'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "재방문자"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>방문자 수</td>
<td <?=shop_reporting_style("list_title");?>>1회 방문</td>
<td <?=shop_reporting_style("list_title");?>>2회 방문</td>
<td <?=shop_reporting_style("list_title");?>>3회 방문</td>
<td <?=shop_reporting_style("list_title");?>>4회 방문</td>
<td <?=shop_reporting_style("list_title");?>>5회 이상 방문</td>
<td <?=shop_reporting_style("list_title");?>>재방문율</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<?
for ($i=0; $i<count($list); $i++) {
?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=shop_week($list[$i]['week']);?>요일</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_return1_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_return2_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_return3_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_return4_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_return5_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['total_visit_return_ratio_count']?> %</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_return1_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_return2_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_return3_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_return4_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_return5_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>>평균 <? if ($total_visit_return_ratio_count) { echo round($total_visit_return_ratio_count / count($list), 2); } else { echo 0; } ?> %</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<? if ($m == '') { ?>
<script type="text/javascript">
function reportingChart()
{

   var data = google.visualization.arrayToDataTable([
    ['요일', '방문자 수', '1회 방문', '2회 방문', '3회 방문', '4회 방문', '5회 방문'],
<?
$comma = "";
for ($i=0; $i<count($list); $i++) {

    if ($i == '0') {

        $comma = "";

    } else {

        $comma = ",";

    }

    echo $comma."['".shop_week($list[$i]['week'])."요일',".(int)($list[$i]['total_visit_count']).",".(int)($list[$i]['total_visit_return1_count']).",".(int)($list[$i]['total_visit_return2_count']).",".(int)($list[$i]['total_visit_return3_count']).",".(int)($list[$i]['total_visit_return4_count']).",".(int)($list[$i]['total_visit_return5_count'])."]";

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
series: {0: {type: "line"}}

    });

}

$(document).ready(function() {
    reportingChart();
    shopAdminViewResize();
});
</script>
<? } ?>