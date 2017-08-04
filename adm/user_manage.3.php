<?php
if (!defined('_DMSHOP_')) exit;

/*------------------------------
    ## 로그인 ##
------------------------------*/

// 검색조건
$sql_search = " where user_id = '".$user_id."' ";

$cnt = sql_fetch(" select count(*) as cnt from $shop[user_login_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 10;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?tab=".$tab."&user_id=".$user_id."&page=");

if (!$sort) {

    $sort = " datetime desc ";

}

$result = sql_query(" select * from $shop[user_login_table] $sql_search order by $sort limit $from_record, $rows ");
?>

<!-- 접속정보 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/user_manage_t5.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">회원 가입일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=date("Y-m-d H:s", strtotime($user['datetime']));?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">최종접속 일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=date("Y-m-d H:s", strtotime($user['user_login']));?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">최종접속 IP</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><a href="./reporting_visit_list.php?date1=2012-01-01&date2=<?=$shop['time_ymd']?>&f=vi_ip&q=<?=text($user['user_login_ip'])?>" target="_blank" class="tx2 underline" title="방문기록 IP 조회하기"><?=text($user['user_login_ip'])?></a></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">누적 로그인 횟수</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><b><?=number_format($total_count);?></b> 회</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 접속정보 end //-->

<!-- 로그인기록 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="150">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/user_manage_t7.gif"></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="140">
    <col width="">
    <col width="90">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">접근일시</td>
    <td bgcolor="#f7f7f7" class="popup_subject">접근 IP</td>
    <td bgcolor="#f7f7f7" class="popup_subject">비고</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {
?>
<? if ($i > '0') { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<? } ?>
<tr height="30">
    <td align="center"><span class="datetime1"><?=date("Y-m-d", strtotime($list['datetime']));?></span><span class="datetime2"> <?=date("H:i", strtotime($list['datetime']));?></span></td>
    <td align="center"><a href="./reporting_visit_list.php?date1=2012-01-01&date2=<?=$shop['time_ymd']?>&f=vi_ip&q=<?=text($list['login_ip'])?>" target="_blank" class="tx2 underline" title="방문기록 IP 조회하기"><?=text($list['login_ip'])?></a></td>
    <td align="center" class="tx2"><?=shop_login_type($list['login_type']);?></td>
</tr>
<? } ?>
</table>

<? if (!$i) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="100">
    <td class="not">데이터가 없습니다.</td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 로그인기록 end //-->