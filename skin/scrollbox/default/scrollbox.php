<?
if (!defined('_DMSHOP_')) exit;
?>

<style type="text/css">
#scrollbox {display:none; right:0px; top:0px; position:fixed; z-index:9999; width:80px; background-color:#ffffff;}
#scrollbox .title {text-align:center; font-weight:bold; line-height:24px; font-size:11px; color:#848689; font-family:dotum,돋움;}
#scrollbox .list {line-height:17px; font-size:11px; color:#787878; font-family:dotum,돋움; letter-spacing:-1px;}
#scrollbox .c1 {font-weight:bold; line-height:17px; font-size:11px; color:#666666; font-family:dotum,돋움; letter-spacing:-1px;}
#scrollbox .c2 {font-weight:bold; line-height:17px; font-size:11px; color:#ff3c00; font-family:dotum,돋움; letter-spacing:-1px;}

#scrollbox .title2 {cursor:pointer; text-align:center; font-weight:bold; line-height:23px; font-size:11px; color:#787878; font-family:dotum,돋움;}
#scrollbox .not {padding:40px 0; text-align:center; line-height:16px; font-size:11px; color:#a6a6a6; font-family:dotum,돋움;}

#scrollbox_data1 {border-top:1px solid #dbdbdb; display:none;}
#scrollbox_data2 {border-bottom:1px solid #dbdbdb; display:none;}
#scrollbox_data3 {border-top:1px solid #dbdbdb; display:none;}

#scrollbox .count {font-weight:bold; line-height:24px; font-size:11px; color:#ff3c00; font-family:dotum,돋움;}
#scrollbox .text {line-height:24px; font-size:11px; color:#666666; font-family:dotum,돋움;}
#scrollbox .page {text-align:center; line-height:12px; font-size:11px; color:#666666; font-family:dotum,돋움;}

#scrollbox .thumb {position:relative; left:0px; top:0px; width:62px; height:62px;}
#scrollbox .close {position:absolute; z-index:2; right:1px; top:1px;}
#scrollbox .image {position:absolute; z-index:1; left:0px; top:0px;}
#scrollbox .image img {border:1px solid #c5c5c5;}
#scrollbox .image .on {border:1px solid #ff3c00;}

#scrollbox .top {cursor:pointer; text-align:center; font-weight:bold; line-height:21px; font-size:11px; color:#a5a5a5; font-family:dotum,돋움;}
#scrollbox .top img {position:relative; overflow:hidden; left:0; top:-2px;}
</style>

<div id="scrollbox_data" style="display:none;"></div>

<div id="scrollbox">
<div style="border:2px solid #d4d4d4;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="24" bgcolor="#dbdbdb">
    <td class="title">내 쇼핑정보</td>
</tr>
</table>

<?
// 미리 선언하는 것은 css 속성을 지정하기 때문!
$shop_coupon_user_count = shop_coupon_user_count($dmshop_user['user_id']);
$shop_favorite_user_count = shop_favorite_user_count($dmshop_user['user_id']);
$shop_order_user_count = shop_order_user_count($dmshop_user['user_id'], 0);
?>
<div style="padding:7px 0px 5px 6px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['https_url']?>/coupon.php" class="list">보유쿠폰 (<span class="<? if ($shop_coupon_user_count) { echo "c2"; } else { "c1"; } ?>"><?=(int)($shop_coupon_user_count);?></span>)</a></td>
</tr>
<tr>
    <td><a href="<?=$shop['https_url']?>/favorite.php" class="list">관심상품 (<span class="<? if ($shop_favorite_user_count) { echo "c2"; } else { "c1"; } ?>"><?=(int)($shop_favorite_user_count);?></span>)</a></td>
</tr>
<tr>
    <td><a href="<?=$shop['https_url']?>/order_list.php" class="list">주문내역 (<span class="<? if ($shop_order_user_count) { echo "c2"; } else { "c1"; } ?>"><?=(int)($shop_order_user_count);?></span>)</a></td>
</tr>
</table>
</div>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<div style="border:1px solid #dbdbdb;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data1_title">
<tr height="23" bgcolor="#f6f6f8">
    <td class="title2">인기상품</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div id="scrollbox_data1"></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#dbdbdb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data2_title">
<tr height="23" bgcolor="#f6f6f8">
    <td class="title2">최근본상품</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#dbdbdb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div id="scrollbox_data2"></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data3_title">
<tr height="23" bgcolor="#f6f6f8">
    <td class="title2">장바구니</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div id="scrollbox_data3"></div></td>
</tr>
</table>
</div>

<div style="border-left:1px solid #f6f6f8; border-right:1px solid #f6f6f8; border-bottom:1px solid #f6f6f8;">
<div style="border-left:1px solid #dbdbdb; border-right:1px solid #dbdbdb; border-bottom:1px solid #dbdbdb;" class="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="21">
    <td>TOP <img src="<?=$dmshop_scrollbox_path?>/img/top.gif"></td>
</tr>
</table>
</div>
</div>
</div>

<script type="text/javascript">
var dmshop_scrollbox_path = "<?=$dmshop_scrollbox_path?>";
var scrollbox_top = <?=(int)($scrollbox_top);?>;
</script>

<!--[if IE 6]>
<script type="text/javascript">
$("#scrollbox").css({'position':'absolute'});

$(document).ready(function() {

    var quickTop = $("#scrollbox").position().top;

    $(window).scroll(function() {

        var winTop = $(window).scrollTop();

        $("#scrollbox").animate({'top': parseInt($(".layout_contents").position().top + scrollbox_top + winTop + quickTop) + 'px'}, 0);

    });

});
</script>
<![endif]-->

<script type="text/javascript" src="<?=$dmshop_scrollbox_path?>/scrollbox.js"></script>