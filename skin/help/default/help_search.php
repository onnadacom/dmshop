<?
if (!defined('_DMSHOP_')) exit;
?>
<!--[if IE 6]>
<script type="text/javascript">
/* IE6 PNG 배경투명 */
DD_belatedPNG.fix('.png');
</script>
<![endif]-->

<style type="text/css">
.top_bg {height:45px; background:url('<?=$dmshop_help_path?>/img/top_bg.gif') repeat-x;}

.help_box .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.help_box .list {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}

.order_list_all .bg {height:44px; background:url('<?=$dmshop_help_path?>/img/title_bg.gif') repeat-x;}
.order_list_all .t1 {line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_list_all .date {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_list_all .view {text-decoration:underline; line-height:14px; font-size:11px; color:#7da7d9; font-family:dotum,돋움;}
.order_list_all .thumb {border:2px solid #e4e4e4;}
.order_list_all .item_name {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_list_all .option {line-height:15px; font-size:11px; color:#717171; font-family:gulim,굴림;}
.order_list_all .money {line-height:15px; font-size:11px; color:#ff3c00; font-family:gulim,굴림;}
.order_list_all .type {line-height:15px; font-size:13px; color:#717171; font-family:gulim,굴림;}
.order_list_all .payment {line-height:15px; font-size:12px; color:#959595; font-family:dotum,돋움;}
.order_list_all .msg {line-height:15px; font-size:11px; color:#777777; font-family:dotum,돋움;}
.order_list_all .dot {height:1px; background:url('<?=$dmshop_help_path?>/img/dot.gif') repeat-x;}
</style>

<script type="text/javascript">
function helpChoice(help_code)
{

    opener.document.getElementById("help_code").value = help_code;
    window.close();

}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="top_bg">
    <td width="15"></td>
    <td><img src="<?=$dmshop_help_path?>/img/title_<?=$help_type?>.png" class="png"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="15"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_help_path?>/img/help_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_help_path?>/img/t0.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list_all">
<colgroup>
    <col width="50">
    <col width="2">
    <col width="139">
    <col width="2">
    <col width="">
    <col width="2">
    <col width="118">
</colgroup>
<tr class="bg">
    <td align="center" class="t1"><b>선택</b></td>
    <td><img src="<?=$dmshop_help_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>주문일자</b></td>
    <td><img src="<?=$dmshop_help_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>상품명/주문옵션</b></td>
    <td><img src="<?=$dmshop_help_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>주문상태</b></td>
</tr>
<?
for ($i=0; $i<count($list); $i++) {

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $dmshop_help_path."/img/noimage.gif"; }
?>
<? if ($i > '0') { ?>
<tr><td colspan="7" class="dot"></td></tr>
<? } ?>
<tr height="74">
    <td align="center"><a href="#" onclick="helpChoice('<?=$list[$i]['help_code']?>'); return false;"><img src="<?=$dmshop_help_path?>/img/choice.gif" border="0"></a></td>
    <td></td>
    <td align="center" class="date"><?=date("Y-m-d", strtotime($list[$i]['order_datetime']));?></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="9"></td>
    <td width="50" align="center"><div class="thumb"><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank"><img src="<?=$thumb?>" width="50" height="50" border="0"></a></div></td>
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank" class="item_name"><?=$list[$i]['item_title']?><? if ($list[$i]['option_name']) { ?> <span class="option">(옵션 : <?=$list[$i]['option_name']?>)</span><? } ?><? if ($list[$i]['cnt']) { ?> 외 <?=number_format($list[$i]['cnt']);?>건<? } ?></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="2"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="option"><b class="money"><?=number_format($list[$i]['order_pay_money']);?></b> 원 / <?=number_format($list[$i]['order_limit']);?>개</span></td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
    <td></td>
    <td align="center" class="type"><?=shop_order_type($list[$i]['order_type']);?></td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="7" height="225" align="center"><img src="<?=$dmshop_help_path?>/img/order_no.gif"></td></tr>
<? } ?>
<tr><td colspan="7" height="2" bgcolor="#dddddd"></td></tr>
</table>

<? if ($i && $total_count > $rows) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr> 
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=$shop_pages?></td>
</tr>
</table>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>
    </td>
    <td width="15"></td>
</tr>
</table>