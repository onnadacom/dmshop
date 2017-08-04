<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
// 가로 갯수
$mod = "3";

$cnt = sql_fetch(" select count(*) as cnt from $shop[sms_auto_table] ");

$total_count = $cnt['cnt'];

$rows = 6;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_smsauto("10", $page, $total_page);

$result = sql_query(" select * from $shop[sms_auto_table] order by datetime desc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    if ($i && $i%$mod == '0') {

        echo "</tr><tr><td colspan='".(int)($mod * 2)."' height='1' class='bc1'></td></tr><tr>";

    }

    echo "<td width='157' valign='top'>";
?>
<div class="sms_bg3">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="right"><a href="#" onclick="smsAutoDelete('<?=$row['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_delete.gif" border="0"></a></td>
</tr>
</table>

<div style="padding:2px 15px 15px 15px;">
    <div style="padding:15px;" onclick="smsAutoAdd('<?=$row['id']?>');" class="pointer"><textarea id="sms_auto_list_<?=$row['id']?>" class="sms_message pointer"><?=text($row['sms_message']);?></textarea></div>
</div>
</div>
<?
    echo "</td>";
    echo "<td width='1' class='bc1'></td>";

}

// 나머지 셀을 채운다.
$cnt = $i%$rows;
if ($cnt) {

    for ($i=$cnt; $i<$rows; $i++) {

        if ($i && $i%$mod == '0') {

            echo "</tr><tr><td colspan='".(int)($mod * 2)."' height='1' class='bc1'></td></tr><tr>";

        }

        echo "<td width='157' height='146' bgcolor='#fcfcfc' style='line-height:19px; font-size:12px; color:#000000; font-family:gulim,굴림; text-align:center;'>등록된 자동완성<br>내용이 없습니다</td>";
        echo "<td width='1' class='bc1'></td>";

    }

}

echo "</tr><tr><td colspan='".(int)($mod * 2)."' height='1' class='bc1'></td></tr><tr>";
?>
</tr>
</table>

<? if ($i && $total_count > $rows) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td><?=$shop_pages?></td>
</tr>
</table>
<? } ?>

<? if (!$i) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<?
for ($i=0; $i<$rows; $i++) {

    if ($i && $i%$mod == '0') {

        echo "</tr><tr><td colspan='".(int)($mod * 2)."' height='1' class='bc1'></td></tr><tr>";

    }

    echo "<td width='157' height='146' bgcolor='#fcfcfc' style='line-height:19px; font-size:12px; color:#000000; font-family:gulim,굴림; text-align:center;'>등록된 자동완성<br>내용이 없습니다</td>";
    echo "<td width='1' class='bc1'></td>";

}

echo "</tr><tr><td colspan='".(int)($mod * 2)."' height='1' class='bc1'></td></tr><tr>";
?>
</table>
<? } ?>