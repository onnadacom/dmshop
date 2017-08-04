<?php
if (!defined('_DMSHOP_')) exit;

$colspan = 4;

// 기간의 상위 추천인을 뽑는다
$report = array();
$result = sql_query(" select *, count(*) as report_count from $shop[user_table] where substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_recommend != '' group by user_id order by report_count desc limit 0, 10 ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $colspan++;

    $report[$i] = $row;

    $user = shop_user($row['user_recommend']);

    $report[$i]['tmp_user_id'] = $user['user_id'];
    $report[$i]['tmp_user_name'] = $user['user_name'];

}

// 년도별 카운트 수를 구해야한다.
$year_count = strtotime($date2) - strtotime(substr($date1,0,7)."-01");
$year_count = (int)(($year_count / (86400 * 365)) + 1);

$list = array();
for ($i=0; $i<(int)($year_count); $i++) {

    $list[$i]['year'] = (int)(substr($date1,0,4) + $i);

}

$report_count = 0;
$report_count_etc = 0;
for ($i=0; $i<count($list); $i++) {

    // 해당 기간의 추천인총수
    $order = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,4) = '".$list[$i]['year']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_recommend != '' ");

    $list_etc = 0;
    for ($k=0; $k<count($report); $k++) {

        // 해당 기간의 추천인총수을 구한다
        $data = sql_fetch(" select count(*) as report_count from $shop[user_table] where substring(datetime,1,4) = '".$list[$i]['year']."' and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' and user_recommend = '".addslashes($report[$k]['user_recommend'])."' ");

        // 해당 기간 추천인수
        $list[$i][$k]['report_count'] = (int)($data['report_count']);

        // 해당 상품 총 추천인수
        $report[$k]['report_count_total'] += (int)($data['report_count']);

        // 기타 추천인수을 구하기 위해서 현재 추천인수을 합산
        $list_etc += (int)($data['report_count']);

    }

    $list[$i]['report_count'] = (int)($order['report_count']);
    $list[$i]['report_count_etc'] = (int)($order['report_count'] - $list_etc);

    $report_count += $list[$i]['report_count'];
    $report_count_etc += $list[$i]['report_count_etc'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#ffffff"></td></tr>
<tr><td colspan="<?=$colspan?>" height="30" bgcolor="#fafafa" class="reporting_subject">:: <? if ($m == 'excel') { echo "회원 추천인"; } else { echo "개별차트"; } ?> (기간 : <?=$date1?> ~ <?=$date2?>) ::</td></tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<tr bgcolor="#f5f5f5">
<td <?=shop_reporting_style("list_title");?>>기준/항목</td>
<td <?=shop_reporting_style("list_title");?>>추천인수 합계</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_title");?>><?=text($report[$k]['tmp_user_name'])?>(<?=text($report[$k]['tmp_user_id'])?>)</td>
<? } ?>
<td <?=shop_reporting_style("list_title");?>>기타</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr bgcolor="#ffffff">
<td <?=shop_reporting_style("list_text");?>><?=$list[$i]['year']?></td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count']);?> 회</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i][$k]['report_count']);?> 회</td>
<? } ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($list[$i]['report_count_etc']);?> 회</td>
<td class="none">&nbsp;</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr bgcolor="#f2ffff">
<td <?=shop_reporting_style("list_text");?>>합계</td>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count);?> 회</td>
<? for ($k=0; $k<count($report); $k++) { ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report[$k]['report_count_total']);?> 회</td>
<? } ?>
<td <?=shop_reporting_style("list_text");?>><?=number_format($report_count_etc);?> 회</td>
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
    data.setValue(<?=$k?>, 0, '<?=text($report[$k]['tmp_user_name'])?>(<?=text($report[$k]['tmp_user_id'])?>)');
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