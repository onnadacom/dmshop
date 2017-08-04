<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 10;

$list = array();
for ($i=0; $i<(int)(24); $i++) {

    $list[$i]['hour'] = sprintf("%02d" , $i);

}

$total_visit_count = 0;
$total_visit_host1_count = 0;
$total_visit_host2_count = 0;
$total_visit_host3_count = 0;
$total_visit_host4_count = 0;
$total_visit_host5_count = 0;
$total_visit_host6_count = 0;
$total_visit_host7_count = 0;
for ($i=0; $i<count($list); $i++) {

    // 방문자 수
    $visit = sql_fetch(" select count(vi_ip) as total_count from $shop[visit_table] where substring(vi_datetime,12,2) = '".$list[$i]['hour']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_first = '1' ");

    // 네이버 방문
    $visit_host1 = sql_fetch(" select count(vi_ip) as total_count from $shop[visit_table] where substring(vi_datetime,12,2) = '".$list[$i]['hour']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_first = '1' and (INSTR(vi_host,'naver.')) ");

    // 다음 방문
    $visit_host2 = sql_fetch(" select count(vi_ip) as total_count from $shop[visit_table] where substring(vi_datetime,12,2) = '".$list[$i]['hour']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_first = '1' and (INSTR(vi_host,'daum.')) ");

    // 네이트 방문
    $visit_host3 = sql_fetch(" select count(vi_ip) as total_count from $shop[visit_table] where substring(vi_datetime,12,2) = '".$list[$i]['hour']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_first = '1' and (INSTR(vi_host,'nate.')) ");

    // 야후 방문
    $visit_host4 = sql_fetch(" select count(vi_ip) as total_count from $shop[visit_table] where substring(vi_datetime,12,2) = '".$list[$i]['hour']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_first = '1' and (INSTR(vi_host,'yahoo.')) ");

    // 구글 방문
    $visit_host5 = sql_fetch(" select count(vi_ip) as total_count from $shop[visit_table] where substring(vi_datetime,12,2) = '".$list[$i]['hour']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_first = '1' and (INSTR(vi_host,'google.')) ");

    // 직접 방문
    $visit_host6 = sql_fetch(" select count(vi_ip) as total_count from $shop[visit_table] where substring(vi_datetime,12,2) = '".$list[$i]['hour']."' and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' and vi_first = '1' and vi_host in ('{$dmshop['doamin']}', '') ");

    $list[$i]['total_visit_count'] = $visit['total_count'];
    $list[$i]['total_visit_host1_count'] = $visit_host1['total_count'];
    $list[$i]['total_visit_host2_count'] = $visit_host2['total_count'];
    $list[$i]['total_visit_host3_count'] = $visit_host3['total_count'];
    $list[$i]['total_visit_host4_count'] = $visit_host4['total_count'];
    $list[$i]['total_visit_host5_count'] = $visit_host5['total_count'];
    $list[$i]['total_visit_host6_count'] = $visit_host6['total_count'];
    $list[$i]['total_visit_host7_count'] = (int)($list[$i]['total_visit_count'] - ($list[$i]['total_visit_host1_count'] + $list[$i]['total_visit_host2_count'] + $list[$i]['total_visit_host3_count'] + $list[$i]['total_visit_host4_count'] + $list[$i]['total_visit_host5_count'] + $list[$i]['total_visit_host6_count']));

    $total_visit_count += $list[$i]['total_visit_count'];
    $total_visit_host1_count += $list[$i]['total_visit_host1_count'];
    $total_visit_host2_count += $list[$i]['total_visit_host2_count'];
    $total_visit_host3_count += $list[$i]['total_visit_host3_count'];
    $total_visit_host4_count += $list[$i]['total_visit_host4_count'];
    $total_visit_host5_count += $list[$i]['total_visit_host5_count'];
    $total_visit_host6_count += $list[$i]['total_visit_host6_count'];
    $total_visit_host7_count += $list[$i]['total_visit_host7_count'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "유입 경로별"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>방문자 수</td>
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
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['hour']?> 시</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_host1_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_host2_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_host3_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_host4_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_host5_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_host6_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_host7_count']);?> 명</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_host1_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_host2_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_host3_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_host4_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_host5_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_host6_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_host7_count);?> 명</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<? if ($m == '') { ?>
<script type="text/javascript">
function reportingChart()
{

   var data = google.visualization.arrayToDataTable([
    ['시간', '방문자 수', '네이버', '다음', '네이트', '야후', '구글', '직접방문', '기타'],
<?
$comma = "";
for ($i=0; $i<count($list); $i++) {

    if ($i == '0') {

        $comma = "";

    } else {

        $comma = ",";

    }

    echo $comma."['".$list[$i]['hour']."',".(int)($list[$i]['total_visit_count']).",".(int)($list[$i]['total_visit_host1_count']).",".(int)($list[$i]['total_visit_host2_count']).",".(int)($list[$i]['total_visit_host3_count']).",".(int)($list[$i]['total_visit_host4_count']).",".(int)($list[$i]['total_visit_host5_count']).",".(int)($list[$i]['total_visit_host6_count']).",".(int)($list[$i]['total_visit_host7_count'])."]";

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
seriesType: "bars"

    });

}

$(document).ready(function() {
    reportingChart();
    shopAdminViewResize();
});
</script>
<? } ?>