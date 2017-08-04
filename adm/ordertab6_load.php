<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
$result = sql_query(" select * from $shop[order_table] where order_payment != '0' and order_number = '0' and order_type = '500' order by order_datetime desc limit 0, 5 ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // user
    $user = shop_user($row['user_id']);

    if ($user['id']) {

        $userview = shop_userview($user['user_id'], $user['user_name'], $user['user_email'], $user['user_homepage'], $row['order_name']);

    } else {

        $userview = shop_userview("", $dmshop_order['order_name'], $dmshop_order['order_email'], "", $row['order_name']);

    }
?>
<tr height="44">
    <td width="90" align="center"><p class="datetime1"><?=date("Y-m-d", strtotime($row['order_datetime']));?></p><p class="datetime2"><?=date("H시 : i분", strtotime($row['order_datetime']));?></p></td>
    <td width="1"></td>
    <td width="100" align="center"><a href="#" onclick="orderPopupDetail('<?=$row['order_code']?>'); return false;" class="order_code"><?=$row['order_code']?></a></td>
    <td width="1"></td>
    <td width="80" align="center"><? if ($row['order_name'] != $row['order_rec_name']) { echo "<p class='order_name'>".$userview."</p><p class='order_rec_name'>(".text($row['order_rec_name']).")</p>"; } else { echo "<p class='order_name'>".$userview."</p>"; } ?></td>
    <td width="1"></td>
    <td onclick="orderManage('', '<?=$row['order_code']?>'); return false;" class="pointer"><p style="margin-left:15px;"><a href="<?=$shop['path']?>/item.php?id=<?=$row['item_code']?>" target="_blank"><span class="item_title"><?=text($row['order_title'])?></span></a></p></td>
    <td width="1"></td>
    <td width="90" align="center" class="order_pay_money"><?=number_format($row['order_total_item_money']);?></td>
    <td width="1"></td>
    <td width="90" align="center"><a href="#" onclick="orderManage('refund', '<?=$row['order_code']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_option.gif" border="0"></a></td>
    <td width="10"></td>
</tr>
<tr><td colspan="12" height="1" bgcolor="#f1f1f1"></td></tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="12" class="ordertab_not">내역이 없습니다.</td></tr>
<? } ?>
</table>