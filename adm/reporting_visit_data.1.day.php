<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 7;

//$date_count = sql_fetch(" select datediff('$date1','$date2') as report_count ");
//echo $date_count[report_count];

// 날짜별 카운트 수를 구해야한다.
$date_count = strtotime($date2) - strtotime($date1);
$date_count = (int)(($date_count / 86400) + 1);

$list = array();
for ($i=0; $i<(int)($date_count); $i++) {

    $list[$i]['date'] = date("Y-m-d", strtotime($date1) + (86400 * $i));
    $list[$i]['week'] = shop_week(date("w", strtotime($list[$i]['date'])));
    $list[$i]['href'] = "./reporting_visit_list.php?date1=".$list[$i]['date']."&date2=".$list[$i]['date'];

}

$total_visit_count = 0;
$total_visit_page_count = 0;
$total_user_regist_count = 0;
$total_visit_regist_count = 0;
for ($i=0; $i<count($list); $i++) {

    // 방문자 수
    $visit = sql_fetch(" select count(vi_ip) as report_count from $shop[visit_table] where substring(vi_datetime,1,10) = '".$list[$i]['date']."' and vi_first = '1' ");

    // 페이지 뷰
    $visit_page = sql_fetch(" select count(*) as report_count from $shop[visit_table] where substring(vi_datetime,1,10) = '".$list[$i]['date']."' ");

    // 해당 기간의 가입자 수
    $user = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,10) = '".$list[$i]['date']."' and user_level >= '2' ");

    $list[$i]['total_visit_count'] = $visit['report_count'];
    $list[$i]['total_visit_page_count'] = $visit_page['report_count'];
    $list[$i]['total_user_regist_count'] = $user['report_count'];

    if ($list[$i]['total_visit_count'] && $list[$i]['total_user_regist_count']) {

        $list[$i]['total_visit_regist_count'] = round(($list[$i]['total_user_regist_count'] * 100) / $list[$i]['total_visit_count'], 2);

    } else {

        $list[$i]['total_visit_regist_count'] = 0;

    }

    $total_visit_count += $list[$i]['total_visit_count'];
    $total_visit_page_count += $list[$i]['total_visit_page_count'];
    $total_visit_regist_count += $list[$i]['total_visit_regist_count'];
    $total_user_regist_count += $list[$i]['total_user_regist_count'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "방문자"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>방문자 수</td>
<td <?=shop_reporting_style("list_title");?>>페이지 뷰</td>
<td <?=shop_reporting_style("list_title");?>>신규 가입자 수</td>
<td <?=shop_reporting_style("list_title");?>>회원 가입율</td>
<td <?=shop_reporting_style("list_title");?>>개별 방문기록</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<?
for ($i=0; $i<count($list); $i++) {
?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['date']?> (<?=$list[$i]['week']?>)</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_visit_page_count']);?> 건</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['total_user_regist_count']);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['total_visit_regist_count']?> %</td>
<td <?=shop_reporting_style("list_text");?>><? if ($m == '') { ?><a href="<?=$list[$i]['href']?>" target="_blank"><img src="<?=$shop['image_path']?>/adm/list_view.gif" border="0"></a><? } ?></td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_visit_page_count);?> 건</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($total_user_regist_count);?> 명</td>
<td <?=shop_reporting_style("list_text");?>>평균 <? if ($total_visit_regist_count) { echo round($total_visit_regist_count / count($list), 2); } else { echo 0; } ?> %</td>
<td <?=shop_reporting_style("list_text");?>>&nbsp;</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<? if ($m == '') { ?>
<script type="text/javascript">
function reportingChart()
{

   var data = google.visualization.arrayToDataTable([
    ['일자', '방문자 수', '페이지 뷰', '신규 가입자 수', '회원 가입율'],
<?
$comma = "";
for ($i=0; $i<count($list); $i++) {

    if ($i == '0') {

        $comma = "";

    } else {

        $comma = ",";

    }

    echo $comma."['".$list[$i]['date']."',".(int)($list[$i]['total_visit_count']).",".(int)($list[$i]['total_visit_page_count']).",".(int)($list[$i]['total_user_regist_count']).",".$list[$i]['total_visit_regist_count']."]";

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