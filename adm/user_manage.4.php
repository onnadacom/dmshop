<?php
if (!defined('_DMSHOP_')) exit;

/*------------------------------
    ## 1:1 ##
------------------------------*/

// 검색조건
$sql_search = " where user_id = '".$user_id."' ";

$cnt = sql_fetch(" select count(*) as cnt from $shop[help_table] $sql_search ");

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

$result = sql_query(" select * from $shop[help_table] $sql_search order by $sort limit $from_record, $rows ");
?>

<!-- 1:1 start //-->
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
    <td><img src="<?=$shop['image_path']?>/adm/user_manage_t8.gif"></td>
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
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">작성일시</td>
    <td bgcolor="#f7f7f7" class="popup_subject">제목</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {
?>
<? if ($i > '0') { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<? } ?>
<tr height="30">
    <td align="center"><span class="datetime1"><?=date("Y-m-d", strtotime($list['datetime']));?></span> <span class="datetime2"><?=date("H:i", strtotime($list['datetime']));?></span></td>
    <td><p style="margin-left:30px;"><a href="" class="tx2">[<?=shop_help_category($list['help_category']);?>] <?=text($list['subject'])?></a></p></td>
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

<? if ($i && $total_count > $rows) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="90">
    <td><?=$shop_pages?></td>
</tr>
</table>
<? } ?>
<!-- 1:1 end //-->