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
.layout_contents {background:url('<?=$dmshop_mypage_path?>/img/left_menu_bg.gif') repeat-y;}

 /* 레이아웃사이즈를 조정한다 */
.layout_left {width:150px;}
.layout_main {width:<?=(int)(($dmshop_design[$layout_column.'_layout_width'] - $dmshop_design[$layout_column.'_mc_width']) - 150);?>px;}

.skin_mypage_menu {width:150px;}
.skin_mypage_menu .menu_list {width:142px;}
.skin_mypage_menu .off a {line-height:14px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;}
.skin_mypage_menu .on {background-color:#f2f2f2;}
.skin_mypage_menu .on a {font-weight:bold; line-height:14px; font-size:12px; color:#000000; font-family:gulim,굴림;}
</style>

<div class="skin_mypage_menu">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['https_url']?>/mypage.php"><img src="<?=$dmshop_mypage_path?>/img/title.gif" border="0"></a></td>
</tr>
</table>

<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<!-- 주문 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/lt1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="menu_list">
<tr height="21" class="<? if ($page_id == 'order_list') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/order_list.php">- 주문 내역</a></td>
</tr>
<tr height="21" class="<? if ($page_id == 'payment') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/payment.php">- 개별 결제창</a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="137" border="0" cellspacing="0" cellpadding="0">
<tr height="1">
    <td width="5"></td>
    <td bgcolor="#efefef" class="none">&nbsp;</td>
</tr>
</table>
<!-- 주문 end //-->

<!-- 취소 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/lt2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="menu_list">
<tr height="21" class="<? if ($page_id == 'cancel') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/cancel.php">- 취소 내역</a></td>
</tr>
<tr height="21" class="<? if ($page_id == 'exchange') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/exchange.php">- 교환 내역</a></td>
</tr>
<tr height="21" class="<? if ($page_id == 'refund') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/refund.php">- 환불 내역</a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="137" border="0" cellspacing="0" cellpadding="0">
<tr height="1">
    <td width="5"></td>
    <td bgcolor="#efefef" class="none">&nbsp;</td>
</tr>
</table>
<!-- 취소 end //-->

<!-- 혜택 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/lt3.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="menu_list">
<tr height="21" class="<? if ($page_id == 'cash') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/cash.php">- 적립금</a></td>
</tr>
<tr height="21" class="<? if ($page_id == 'coupon') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/coupon.php">- 쿠폰 보관함</a></td>
</tr>
<tr height="21" class="<? if ($page_id == 'coupon_list') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/coupon_list.php">- 쿠폰 사용내역</a></td>
</tr>
<tr height="21" class="<? if ($page_id == 'coupon_regist') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/coupon_regist.php" class="off">- 쿠폰 등록</a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>
<!-- 혜택 end //-->

<table width="137" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="5"></td>
    <td height="2" bgcolor="#555555"></td>
</tr>
</table>

<!-- 고객센터 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/lt4.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="menu_list">
<tr height="21" class="<? if ($page_id == 'help_list') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/help_list.php">- 1:1문의 내역</a></td>
</tr>
<tr height="21" class="<? if ($page_id == 'faq') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['url']?>/board.php?bbs_id=faq">- 자주묻는 질문</a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="137" border="0" cellspacing="0" cellpadding="0">
<tr height="1">
    <td width="5"></td>
    <td bgcolor="#efefef" class="none">&nbsp;</td>
</tr>
</table>
<!-- 고객센터 end //-->

<!-- 회원정보 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/lt5.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="menu_list">
<tr height="21" class="<? if ($page_id == 'signup_check' && $m == 'u' || $page_id == 'signup_form' && $m == 'u') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/signup_check.php">- 회원정보 수정</a></td>
</tr>
<tr height="21" class="<? if ($page_id == 'signup_check' && $m == 'd' || $page_id == 'signup_leave') { echo "on"; } else { echo "off"; } ?>">
    <td width="10"></td>
    <td><a href="<?=$shop['https_url']?>/signup_check.php?m=d">- 회원 탈퇴</a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="137" border="0" cellspacing="0" cellpadding="0">
<tr height="1">
    <td width="5"></td>
    <td bgcolor="#efefef" class="none">&nbsp;</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="5"></td>
    <td><a href="<?=$shop['https_url']?>/favorite.php"><img src="<?=$dmshop_mypage_path?>/img/btn_favorite.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="4"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="5"></td>
    <td><a href="<?=$shop['https_url']?>/cart.php"><img src="<?=$dmshop_mypage_path?>/img/btn_cart.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>
<!-- 회원정보관리 end //-->
    </td>
    <td width="1"></td>
</tr>
</table>
</div>