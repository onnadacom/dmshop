<?php
include_once("./_dmshop.php");
if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }
$shop['title'] = "주문 내역서";
include_once("$shop[path]/shop.top.php");

$colspan = "9";

if (!$order_code) {

    alert_close("주문내역이 존재하지 않습니다.");

}

// 검색조건
$sql_search = " where order_code = '".$order_code."' ";

$cnt = sql_fetch(" select *, count(order_code) as cnt from $shop[order_table] $sql_search group by order_code ");

// 데이터 임시저장
$dmshop_order = $cnt;

// 주문 내역이 없다.
if (!$dmshop_order['id']) {

    alert_close("주문내역이 존재하지 않습니다.");

}

$total_count = $cnt['cnt'];

$rows = 1000;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?order_code=".$order_code."&page=");

$result = sql_query(" select * from $shop[order_table] $sql_search order by order_number asc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

}

// 총 카운트
$order_total_count = $total_count;
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#ffffff;}
</style>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="detail_bg">
    <td width="15"></td>
    <td width="11"><img src="<?=$shop['image_path']?>/adm/arrow.gif" class="up2"></td>
    <td><span style="font-weight:bold; line-height:37px; font-size:14px; color:#ffffff; font-family:gulim,굴림;">주문 내역서</span></td>
    <td width="80"><a href="#" onclick="dataPrint(); return false;"><img src="<?=$shop['image_path']?>/adm/print.gif" border="0"></a></td>
    <td width="5"></td>
    <td width="45"><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/close2.gif" border="0"></a></td>
    <td width="10"></td>
</tr>
</table>

<div id="print_data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="75">
    <td align="center"><span style="text-decoration:underline; font-weight:bold; line-height:26px; font-size:24px; color:#010101; font-family:gulim,굴림;">주문 내역서</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span style="font-weight:bold; line-height:16px; font-size:13px; color:#010101; font-family:gulim,굴림;">■ 주문자(수령자) 정보</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#414141" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="120" align="center" bgcolor="#f2f2f2"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">수령자 성명</span></td>
    <td width="10"></td>
    <td><span style="line-height:16px; font-size:12px; color:#414141; font-family:gulim,굴림;"><?=text($dmshop_order['order_rec_name'])?></span></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e4e4e4"></td></tr>
<tr height="30">
    <td width="120" align="center" bgcolor="#f2f2f2"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">휴대폰 / 전화</span></td>
    <td width="10"></td>
    <td><span style="line-height:16px; font-size:12px; color:#414141; font-family:gulim,굴림;"><?=text($dmshop_order['order_rec_hp'])?> / <?=text($dmshop_order['order_rec_tel'])?></span></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e4e4e4"></td></tr>
<tr height="30">
    <td width="120" align="center" bgcolor="#f2f2f2"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">배송지 주소</span></td>
    <td width="10"></td>
    <td><span style="line-height:16px; font-size:12px; color:#414141; font-family:gulim,굴림;">(우: <?=text($dmshop_order['order_rec_zip1'])?><?=text($dmshop_order['order_rec_zip2'])?>) <?=text($dmshop_order['order_rec_addr1'])?> <?=text($dmshop_order['order_rec_addr2'])?></span></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e4e4e4"></td></tr>
<tr height="30">
    <td width="120" align="center" bgcolor="#f2f2f2"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">배송 요구사항</span></td>
    <td width="10"></td>
    <td><span style="line-height:16px; font-size:12px; color:#414141; font-family:gulim,굴림;"><?=text($dmshop_order['order_memo'])?></span></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="150"><span style="font-weight:bold; line-height:16px; font-size:13px; color:#010101; font-family:gulim,굴림;">■ 주문상품 내역</span></td>
    <td align="right"><span style="line-height:16px; font-size:11px; color:#010101; font-family:gulim,굴림;">주문번호 : <?=$order_code?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#414141" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30" bgcolor="#f2f2f2">
    <td width="10"></td>
    <td><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">주문상품(옵션)</span></td>
    <td width="60" align="center"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">수량</span></td>
    <td width="100" align="center"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">상품가격</span></td>
</tr>
<tr>
    <td colspan="4" height="1" bgcolor="#e4e4e4"></td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr height="30">
    <td width="10"></td>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;">[<?=$list[$i]['item_code']?>] <?=text($list[$i]['item_title'])?><? if ($list[$i]['option_name']) { ?> (옵션 : <?=text($list[$i]['option_name'])?>)<? } ?></span></a></td>
    <td width="60" align="center"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;"><?=number_format($list[$i]['order_limit']);?></span></td>
    <td width="100" align="center"><span style="line-height:16px; font-size:12px; color:#414141; font-family:dotum,돋움;"><?=number_format($list[$i]['order_item_money']);?></span></td>
</tr>
<tr>
    <td colspan="4" height="1" bgcolor="#e4e4e4"></td>
</tr>
<? } ?>
<?
if ($i < '4') {

    // 나머지 라인을 채운다.
    for ($k=$i; $k < 5; $k++) {
?>
<tr>
    <td colspan="4" height="30"></td>
</tr>
<tr>
    <td colspan="4" height="1" bgcolor="#e4e4e4"></td>
</tr>
<?
    }

}
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#414141">
    <td width="10"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span style="line-height:16px; font-size:12px; color:#ffffff; font-family:gulim,굴림;"><?=text($dmshop['shop_name'])?> | <?=text($dmshop['domain'])?><br>(우:<?=text($dmshop['zip1'])?><?=text($dmshop['zip2'])?>) <?=text($dmshop['addr1'])?> <?=text($dmshop['addr2'])?></span></td>
    <td width="300" align="right"><span style="line-height:16px; font-size:12px; color:#ffffff; font-family:gulim,굴림;">전화 : <?=text($dmshop['number1'])?>-<?=text($dmshop['number2'])?>-<?=text($dmshop['number3'])?><? if ($dmshop['fax1'] && $dmshop['fax2'] && $dmshop['fax3']) { ?> | 팩스 : <?=text($dmshop['fax1'])?>-<?=text($dmshop['fax2'])?>-<?=text($dmshop['fax3'])?><? } ?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>
    </td>
    <td width="20"></td>
</tr>
</table>
</div>

</div>

<script type="text/javascript">
var tmp;

function dataPrint()
{

    beforePrint();

    window.print();

    setTimeout("afterPrint();", 1000);

}

function beforePrint()
{

    tmp = document.body.innerHTML;

    document.body.innerHTML = document.getElementById("print_data").innerHTML;

}

function afterPrint()
{

    document.body.innerHTML = tmp;

}
</script>

<?
include_once("$shop[path]/shop.bottom.php");
?>