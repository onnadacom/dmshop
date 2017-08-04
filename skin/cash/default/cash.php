<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.cash_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.cash_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.cash_title .b1 {margin-top:6px;}
.cash_title .b2 {margin-top:7px;}
.cash_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.cash_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.cash_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.cash_all .bg {height:44px; background:url('<?=$dmshop_cash_path?>/img/title_bg.gif') repeat-x;}
.cash_all .t1 {line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.cash_all .t2 {line-height:14px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;}
.cash_all .date {line-height:18px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.cash_all .time {line-height:18px; font-size:12px; color:#959595; font-family:gulim,굴림;}
.cash_all .ic1 {font-weight:bold; line-height:14px; font-size:12px; color:#005eaf; font-family:gulim,굴림;}
.cash_all .ic2 {font-weight:bold; line-height:14px; font-size:12px; color:#af3100; font-family:gulim,굴림;}
.cash_all .cash {margin-right:25px;}
.cash_all .cash1 {line-height:14px; font-size:12px; color:#005eaf; font-family:gulim,굴림;}
.cash_all .cash2 {line-height:14px; font-size:12px; color:#af3100; font-family:gulim,굴림;}
.cash_all .subject {margin-left:10px; line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.cash_all .option {line-height:15px; font-size:11px; color:#717171; font-family:gulim,굴림;}
.cash_all .dot {height:1px; background:url('<?=$dmshop_cash_path?>/img/dot.gif') repeat-x;}

.cash_msg .t1 {line-height:18px; font-size:11px; color:#959595; font-family:dotum,돋움;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cash_position">
<tr height="34" bgcolor="#f8f8f8">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td width='10'></td>";
echo "<td><a href='".$shop['url']."/' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_cash_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/mypage.php' class='off'>마이페이지</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_cash_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/cash.php' class='off'>적립금</a></td>";
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cash_title">
<tr>
    <td width="9"></td>
    <td width="59" valign="top"><img src="<?=$dmshop_cash_path?>/img/t1.gif"></td>
    <td width="10"></td>
    <td width="100"><p class="b1 t2"><span class="t1"><?=number_format($total_count);?></span> 건</p></td>
    <td align="right"><p class="b2 t2">적립금의 적립 및 사용내역을 확인 합니다.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cash_all">
<colgroup>
    <col width="119">
    <col width="2">
    <col width="118">
    <col width="2">
    <col width="118">
    <col width="2">
    <col width="">
</colgroup>
<tr class="bg">
    <td align="center" class="t1"><b>날짜</b></td>
    <td><img src="<?=$dmshop_cash_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>구분</b></td>
    <td><img src="<?=$dmshop_cash_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>금액</b></td>
    <td><img src="<?=$dmshop_cash_path?>/img/line.gif"></td>
    <td align="center" class="t1"><b>내용</b></td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($i > '0') { ?>
<tr><td colspan="7" class="dot"></td></tr>
<? } ?>
<tr height="57">
    <td align="center"><span class="date"><?=date("Y-m-d", strtotime($list[$i]['datetime']));?></span><br><span class="time"><?=date("H시 i분", strtotime($list[$i]['datetime']));?></span></td>
    <td></td>
    <td class="<?=$list[$i]['cash_class']?>" align="center"><?=shop_cash_type($list[$i]['cash_key3']);?></td>
    <td></td>
    <td align="right"><p class="cash <?=$list[$i]['cash_class']?> bold"><?=$list[$i]['cash']?></p></td>
    <td></td>
    <td><p class="subject"><?=text($list[$i]['content'])?></p></td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="7" height="225" align="center"><img src="<?=$dmshop_cash_path?>/img/cash_no.gif"></td></tr>
<? } ?>
<tr><td colspan="7" height="2" bgcolor="#dddddd"></td></tr>
<tr><td colspan="7" height="1"></td></tr>
<tr bgcolor="#f7f7f7">
    <td colspan="7" height="49">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="400">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="30"></td>
    <td class="t2">누적 적립금액</td>
    <td width="10"></td>
    <td class="cash1"><?=number_format($cash_sum1);?> 원</td>
    <td width="30"></td>
    <td class="t2">누적 사용금액</td>
    <td width="10"></td>
    <td class="cash2"><?=number_format($cash_sum2);?> 원</td>
</tr>
</table>
    </td>
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="t2"><b>현재 잔액(사용가능 금액)</b></td>
    <td width="10"></td>
    <td class="cash1 bold"><?=number_format($dmshop_user['user_cash']);?> 원</td>
    <td width="30"></td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
</tr>
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

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<div style="border:2px solid #f6f6f6; background-color:#dddddd; padding:1px;">
<div style="padding:15px 20px; background-color:#ffffff;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cash_msg">
<tr>
    <td class="t1">
- 적립금은 상품 구매 또는 상품평 작성, 이벤트 등을 통해 지급 되며, 상품 구매시 현금처럼 이용하실 수 있습니다.<br>
- 저희 쇼핑몰은 <b>적립금의 보유금액이 <?=number_format($dmshop['order_cash_min']);?>원 이상일 경우에만 이용 가능</b> 합니다.<br>
- 적립금은 환불 및 현금교환이 불가하며, 회원탈퇴시 영구 소멸 됩니다.<br>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>