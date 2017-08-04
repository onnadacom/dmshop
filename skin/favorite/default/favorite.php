<?
if (!defined('_DMSHOP_')) exit;

$colspan = "9";
?>
<style type="text/css">
.favorite_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.favorite_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.favorite_title .b1 {margin-top:6px;}
.favorite_title .b2 {margin-top:7px;}
.favorite_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.favorite_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.favorite_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.favorite_title .bg1 {width:2px; height:30px; background:url('<?=$dmshop_favorite_path?>/img/title_bg1.gif') no-repeat;}
.favorite_title .bg2 {height:30px; background:url('<?=$dmshop_favorite_path?>/img/title_bg2.gif') repeat-x;}
.favorite_title .bg3 {width:2px; background:url('<?=$dmshop_favorite_path?>/img/title_bg3.gif') no-repeat;}

.favorite_list .title {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.favorite_list .option {line-height:16px; font-size:11px; color:#8b49c7; font-family:dotum,돋움;}
.favorite_list .option_line {line-height:16px; font-size:11px; color:#d6d6d6; font-family:dotum,돋움;}
.favorite_list .limit {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.favorite_list .money {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.favorite_list .total {font-weight:bold; line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}

.favorite_list .line_w {height:1px; background-color:#d6d6d6;}
.favorite_list .line_h {width:1px; background-color:#efefef;}

.favorite_btn .msg {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}
</style>

<script type="text/javascript" src="<?=$dmshop_favorite_path?>/favorite.js"></script>

<div id="item_cart_data" style="display:none;"></div>

<form method="post" name="formUpdate">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="item_id" value="" />
<input type="hidden" name="cart_type" value="" />
<input type="hidden" name="favorite_id" value="" />
<input type="hidden" name="order_limit" value="" />
<input type="hidden" name="order_option" value="" />
<input type="hidden" id="cart_id" name="cart_id" value="" />
<input type="hidden" id="order_start" name="order_start" value="" />
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="favorite_position">
<tr height="34" bgcolor="#f8f8f8">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td width='10'></td>";
echo "<td><a href='".$shop['url']."/' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_favorite_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/mypage.php' class='off'>마이페이지</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_favorite_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/favorite.php' class='off'>관심상품 목록</a></td>";
?>
</tr>
</table>
    </td>
</tr>
</table>

<?
// 회원등급 및 기타정보
include_once("$dmshop_mypage_path/information.php");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="favorite_title">
<tr>
    <td width="9"></td>
    <td width="123" valign="top"><img src="<?=$dmshop_favorite_path?>/img/t1.gif"></td>
    <td width="10"></td>
    <td width="100"><p class="b1 t2"><span class="t1"><?=number_format($total_count);?></span> 건</p></td>
    <td align="right"><p class="b2 t2">관심상품에 보관중인 상품은 삭제전까지 영구보존 됩니다.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<!-- 타이틀 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="favorite_title">
<tr>
    <td class="bg1"></td>
    <td class="bg2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="6"></td>
    <td width="21"><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" checked /></td>
    <td align="center"><img src="<?=$dmshop_favorite_path?>/img/title_item.gif"></td>
    <td width="1"></td>
    <td width="100" align="center"><img src="<?=$dmshop_favorite_path?>/img/title_limit.gif"></td>
    <td width="1"></td>
    <td width="100" align="center"><img src="<?=$dmshop_favorite_path?>/img/title_money.gif"></td>
    <td width="1"></td>
    <td width="100" align="center"><img src="<?=$dmshop_favorite_path?>/img/title_option.gif"></td>
</tr>
</table>
    </td>
    <td class="bg3"></td>
</tr>
</table>
<!-- 타이틀 end //-->

<!-- 리스트 start //-->
<form method="post" name="formList">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="submit" value="ok" disabled style="display:none;" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="favorite_list">
<colgroup>
    <col width="6">
    <col width="21">
    <col width="">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="100">
</colgroup>
<?
for ($i=0; $i<count($list); $i++) {

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "82", "82", "2");
    if (!file_exists($thumb)) { $thumb = $dmshop_favorite_path."/img/noimage.gif"; }
?>
<input type="hidden" name="favorite_id[<?=$i?>]" value="<?=$list[$i]['id']?>" />
<tr>
    <td></td>
    <td valign="top" style="padding:15px 0 15px 0;" class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" checked class="checkbox" /></td>
    <td valign="top" style="padding:15px 0 15px 0;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="84" valign="top"><div style="border:1px solid #e0e0e0;"><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>"><img src="<?=$thumb?>" width="82" height="82" border="0"></a></div></td>
    <td width="15"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" class="title"><?=text($list[$i]['item_title'])?></a></td>
</tr>
</table>

<? if ($list[$i]['order_option']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="option">주문옵션 : <?=$list[$i]['option_name']?><?=$list[$i]['option_money']?></span></td>
    <td width="15" align="center"><span class="option_line">|</span></td>
    <td><span class="option">주문수량 : <?=number_format($list[$i]['order_limit']);?> 개</span></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['url']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank"><img src="<?=$dmshop_favorite_path?>/img/blank.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td width="20"></td>
</tr>
</table>
    </td>
    <td class="line_h"></td>
    <td class="limit" align="center"><?=number_format($list[$i]['item_limit']);?> 개</td>
    <td class="line_h"></td>
    <td class="money" align="center"><?=number_format($list[$i]['order_item_money']);?> 원</td>
    <td class="line_h"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="favoriteOrder('<?=$list[$i]['item_id']?>','<?=$list[$i]['order_option']?>','<?=$list[$i]['order_limit']?>'); return false;"><img src="<?=$dmshop_favorite_path?>/img/order.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="favoriteCart('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_favorite_path?>/img/cart.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="favoriteDelete('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_favorite_path?>/img/delete.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" class="line_w"></td></tr>
<? } ?>
</table>
</form>
<!-- 리스트 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<? if ($i) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="favorite_btn">
<tr height="34" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="msg">선택상품</td>
    <td width="7"></td>
    <td><a href="#" onclick="checkDelete(); return false;"><img src="<?=$dmshop_favorite_path?>/img/check_delete.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="checkCart(); return false;"><img src="<?=$dmshop_favorite_path?>/img/check_cart.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1" bgcolor="#d6d6d6">
    <td></td>
</tr>
</table>
<? } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="225" align="center"><img src="<?=$dmshop_favorite_path?>/img/favorite_no.gif"></td></tr>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#dddddd" class="none">&nbsp;</td></tr>
</table>
<? } ?>

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