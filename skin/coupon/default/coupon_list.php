<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.coupon_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.coupon_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.coupon_title .b1 {margin-top:6px;}
.coupon_title .b2 {margin-top:7px;}
.coupon_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.coupon_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.coupon_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.coupon_all .bg {height:44px; background:url('<?=$dmshop_coupon_path?>/img/title_bg.gif') repeat-x;}
.coupon_all .t1 {line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.coupon_all .t2 {line-height:14px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;}
.coupon_all .date {line-height:18px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.coupon_all .time {line-height:18px; font-size:12px; color:#959595; font-family:gulim,굴림;}
.coupon_all .ic {font-weight:bold; line-height:14px; font-size:12px; color:#197b30; font-family:gulim,굴림;}
.coupon_all .subject {margin-left:10px; line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.coupon_all .option {margin-left:10px; line-height:16px; font-size:11px; color:#959595; font-family:gulim,굴림;}
.coupon_all .end {line-height:18px; font-size:11px; color:#ff3c00; font-family:gulim,굴림;}
.coupon_all .dot {height:1px; background:url('<?=$dmshop_coupon_path?>/img/dot.gif') repeat-x;}

.coupon_msg .t1 {line-height:18px; font-size:11px; color:#959595; font-family:dotum,돋움;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="coupon_position">
<tr height="34" bgcolor="#f8f8f8">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td width='10'></td>";
echo "<td><a href='".$shop['path']."/' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_coupon_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['path']."/mypage.php' class='off'>마이페이지</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_coupon_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['path']."/coupon_list.php' class='off'>쿠폰 사용내역</a></td>";
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="coupon_title">
<tr>
    <td width="9"></td>
    <td width="122" valign="top"><img src="<?=$dmshop_coupon_path?>/img/t2.gif"></td>
    <td width="10"></td>
    <td width="100"><p class="b1 t2"><span class="t1"><?=number_format($total_count);?></span> 건</p></td>
    <td align="right"><p class="b2 t2">쿠폰의 사용내역을 확인 합니다.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="coupon_all">
<colgroup>
    <col width="119">
    <col width="2">
    <col width="148">
    <col width="2">
    <col width="">
    <col width="2">
    <col width="159">
</colgroup>
<tr class="bg">
    <td align="center" class="t1"><b>발급일</b></td>
    <td><img src="<?=$dmshop_coupon_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>구분</b></td>
    <td><img src="<?=$dmshop_coupon_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>쿠폰명 / 적용상품</b></td>
    <td><img src="<?=$dmshop_coupon_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>사용일시</b></td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($i > '0') { ?>
<tr><td colspan="7" class="dot"></td></tr>
<? } ?>
<tr height="57">
    <td align="center"><span class="date"><?=date("Y-m-d", strtotime($list[$i]['datetime']));?></span><br><span class="time"><?=date("H시 i분", strtotime($list[$i]['datetime']));?></span></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_coupon_path?>/img/ic.gif" class="up1"></td>
    <td width="5"></td>
    <td><span class="ic"><?=number_format($list[$i]['coupon_discount']);?><?=shop_coupon_discount_type($list[$i]['coupon_discount_type']);?> 할인</span></td>
</tr>
</table>
    </td>
    <td></td>
    <td>
<div style="margin:5px 10px 5px 10px;">
<p class="subject"><?=$list[$i]['coupon_title']?></p>
<p class="option">
<?
// 기획전
if ($list[$i]['coupon_category_type']) {

    if ($list[$i]['coupon_plan']) {

        echo "[".shop_plan_name($list[$i]['coupon_plan'])." 기획전]";

    } else {

        echo "[모든 카테고리]";

    }

} else {
// 분류

    if ($list[$i]['coupon_category']) {

        echo "<a href='".$shop['path']."/list.php?ct_id=".$list[$i]['coupon_category']."' class='option' target='_blank'>[".shop_category_name($list[$i]['coupon_category'])." 분류]</a>";

    } else {

        echo "[모든 카테고리]";

    }

}

// 최소 또는 최대 금액이 있다
if ($list[$i]['coupon_discount_min'] || $list[$i]['coupon_discount_type'] == '1' && $list[$i]['coupon_discount_max']) {

    // 최소금액
    if ($list[$i]['coupon_discount_min']) {

        echo " ".number_format($list[$i]['coupon_discount_min'])."원 이상 구매시";

    }

    // 퍼센트비율, 최대금액
    if ($list[$i]['coupon_discount_type'] == '1' && $list[$i]['coupon_discount_max']) {

        echo " 최대 ".number_format($list[$i]['coupon_discount_max'])."원 할인";

    }

} else {

    echo " 자유이용 쿠폰";

}

if ($list[$i]['coupon_bank']) {

    echo " / 무통장 입금 전용";

}

if ($list[$i]['coupon_cash']) {

    echo " / 적립금 동시사용 불가";

}
?>
</p>
</div>
    </td>
    <td></td>
    <td align="center"><span class="date"><?=date("Y-m-d", strtotime($list[$i]['order_datetime']));?></span><br><span class="time"><?=date("H시 i분", strtotime($list[$i]['order_datetime']));?></span></td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="7" height="225" align="center"><img src="<?=$dmshop_coupon_path?>/img/coupon_list_no.gif"></td></tr>
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