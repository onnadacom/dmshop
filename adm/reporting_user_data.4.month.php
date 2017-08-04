<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 20;

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
$report_count_area1 = 0;
$report_count_area2 = 0;
$report_count_area3 = 0;
$report_count_area4 = 0;
$report_count_area5 = 0;
$report_count_area6 = 0;
$report_count_area7 = 0;
$report_count_area8 = 0;
$report_count_area9 = 0;
$report_count_area10 = 0;
$report_count_area11 = 0;
$report_count_area12 = 0;
$report_count_area13 = 0;
$report_count_area14 = 0;
$report_count_area15 = 0;
$report_count_area16 = 0;
$report_count_etc = 0;
for ($i=0; $i<count($list); $i++) {

    // 전체
    $total = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' ");

    $area1 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '서울%' ");
    $area2 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '강원%' ");
    $area3 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '대전%' ");
    $area4 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '충남%' ");
    $area5 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '충북%' ");
    $area6 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '경기%' ");
    $area7 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '인천%' ");
    $area8 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '광주%' ");
    $area9 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '전남%' ");
    $area10 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '전북%' ");
    $area11 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '부산%' ");
    $area12 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '경남%' ");
    $area13 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '경북%' ");
    $area14 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '대구%' ");
    $area15 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '울산%' ");
    $area16 = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,7) = '".$list[$i]['month']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_leave_datetime = '0000-00-00 00:00:00' and user_addr1 LIKE '제주%' ");

    $list[$i]['report_count_total'] = $total['report_count'];
    $list[$i]['report_count_area1'] = $area1['report_count'];
    $list[$i]['report_count_area2'] = $area2['report_count'];
    $list[$i]['report_count_area3'] = $area3['report_count'];
    $list[$i]['report_count_area4'] = $area4['report_count'];
    $list[$i]['report_count_area5'] = $area5['report_count'];
    $list[$i]['report_count_area6'] = $area6['report_count'];
    $list[$i]['report_count_area7'] = $area7['report_count'];
    $list[$i]['report_count_area8'] = $area8['report_count'];
    $list[$i]['report_count_area9'] = $area9['report_count'];
    $list[$i]['report_count_area10'] = $area10['report_count'];
    $list[$i]['report_count_area11'] = $area11['report_count'];
    $list[$i]['report_count_area12'] = $area12['report_count'];
    $list[$i]['report_count_area13'] = $area13['report_count'];
    $list[$i]['report_count_area14'] = $area14['report_count'];
    $list[$i]['report_count_area15'] = $area15['report_count'];
    $list[$i]['report_count_area16'] = $area16['report_count'];
    $list[$i]['report_count_etc'] = (int)($total['report_count'] - ($area1['report_count'] + $area2['report_count'] + $area3['report_count'] + $area4['report_count'] + $area5['report_count'] + $area6['report_count'] + $area7['report_count'] + $area8['report_count'] + $area9['report_count'] + $area10['report_count'] + $area11['report_count'] + $area12['report_count'] + $area13['report_count'] + $area14['report_count'] + $area15['report_count'] + $area16['report_count']));

    $report_count_total += $list[$i]['report_count_total'];
    $report_count_area1 += $list[$i]['report_count_area1'];
    $report_count_area2 += $list[$i]['report_count_area2'];
    $report_count_area3 += $list[$i]['report_count_area3'];
    $report_count_area4 += $list[$i]['report_count_area4'];
    $report_count_area5 += $list[$i]['report_count_area5'];
    $report_count_area6 += $list[$i]['report_count_area6'];
    $report_count_area7 += $list[$i]['report_count_area7'];
    $report_count_area8 += $list[$i]['report_count_area8'];
    $report_count_area9 += $list[$i]['report_count_area9'];
    $report_count_area10 += $list[$i]['report_count_area10'];
    $report_count_area11 += $list[$i]['report_count_area11'];
    $report_count_area12 += $list[$i]['report_count_area12'];
    $report_count_area13 += $list[$i]['report_count_area13'];
    $report_count_area14 += $list[$i]['report_count_area14'];
    $report_count_area15 += $list[$i]['report_count_area15'];
    $report_count_area16 += $list[$i]['report_count_area16'];
    $report_count_etc += $list[$i]['report_count_etc'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "회원 거주지"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title_area");?>>합계</td>
<td <?=shop_reporting_style("list_title_area");?>>서울</td>
<td <?=shop_reporting_style("list_title_area");?>>강원</td>
<td <?=shop_reporting_style("list_title_area");?>>대전</td>
<td <?=shop_reporting_style("list_title_area");?>>충남</td>
<td <?=shop_reporting_style("list_title_area");?>>충북</td>
<td <?=shop_reporting_style("list_title_area");?>>경기</td>
<td <?=shop_reporting_style("list_title_area");?>>인천</td>
<td <?=shop_reporting_style("list_title_area");?>>광주</td>
<td <?=shop_reporting_style("list_title_area");?>>전남</td>
<td <?=shop_reporting_style("list_title_area");?>>전북</td>
<td <?=shop_reporting_style("list_title_area");?>>부산</td>
<td <?=shop_reporting_style("list_title_area");?>>경남</td>
<td <?=shop_reporting_style("list_title_area");?>>경북</td>
<td <?=shop_reporting_style("list_title_area");?>>대구</td>
<td <?=shop_reporting_style("list_title_area");?>>울산</td>
<td <?=shop_reporting_style("list_title_area");?>>제주</td>
<td <?=shop_reporting_style("list_title");?>>기타</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<?
for ($i=0; $i<count($list); $i++) {
?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['month']?></td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_total']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area1']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area2']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area3']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area4']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area5']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area6']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area7']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area8']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area9']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area10']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area11']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area12']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area13']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area14']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area15']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_area16']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_etc']);?> 명</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_total);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area1);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area2);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area3);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area4);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area5);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area6);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area7);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area8);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area9);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area10);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area11);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area12);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area13);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area14);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area15);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_area16);?> 명</td>
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

    data.addColumn('number', '서울');
    data.addColumn('number', '강원');
    data.addColumn('number', '대전');
    data.addColumn('number', '충남');
    data.addColumn('number', '충북');
    data.addColumn('number', '경기');
    data.addColumn('number', '인천');
    data.addColumn('number', '광주');
    data.addColumn('number', '전남');
    data.addColumn('number', '전북');
    data.addColumn('number', '부산');
    data.addColumn('number', '경남');
    data.addColumn('number', '경북');
    data.addColumn('number', '대구');
    data.addColumn('number', '울산');
    data.addColumn('number', '제주');
    data.addColumn('number', '기타');

    data.addRows(17);

    data.setValue(0, 0, '서울');
    data.setValue(0, 1, <?=(int)($report_count_area1);?>);
    data.setValue(1, 0, '강원');
    data.setValue(1, 1, <?=(int)($report_count_area2);?>);
    data.setValue(2, 0, '대전');
    data.setValue(2, 1, <?=(int)($report_count_area3);?>);
    data.setValue(3, 0, '충남');
    data.setValue(3, 1, <?=(int)($report_count_area4);?>);
    data.setValue(4, 0, '충북');
    data.setValue(4, 1, <?=(int)($report_count_area5);?>);
    data.setValue(5, 0, '경기');
    data.setValue(5, 1, <?=(int)($report_count_area6);?>);
    data.setValue(6, 0, '인천');
    data.setValue(6, 1, <?=(int)($report_count_area7);?>);
    data.setValue(7, 0, '광주');
    data.setValue(7, 1, <?=(int)($report_count_area8);?>);
    data.setValue(8, 0, '전남');
    data.setValue(8, 1, <?=(int)($report_count_area9);?>);
    data.setValue(9, 0, '전북');
    data.setValue(9, 1, <?=(int)($report_count_area10);?>);
    data.setValue(10, 0, '부산');
    data.setValue(10, 1, <?=(int)($report_count_area11);?>);
    data.setValue(11, 0, '경남');
    data.setValue(11, 1, <?=(int)($report_count_area12);?>);
    data.setValue(12, 0, '경북');
    data.setValue(12, 1, <?=(int)($report_count_area13);?>);
    data.setValue(13, 0, '대구');
    data.setValue(13, 1, <?=(int)($report_count_area14);?>);
    data.setValue(14, 0, '울산');
    data.setValue(14, 1, <?=(int)($report_count_area15);?>);
    data.setValue(15, 0, '제주');
    data.setValue(15, 1, <?=(int)($report_count_area16);?>);
    data.setValue(16, 0, '기타');
    data.setValue(16, 1, <?=(int)($report_count_etc);?>);

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