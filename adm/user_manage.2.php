<?php
if (!defined('_DMSHOP_')) exit;

// 해당 회원의 구매횟수 및 실결제총액 (배송완료인 주문내역을 뽑는다)
$order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where user_id = '".$user_id."' and order_type in ('202','900')) as x ");

// 해당 회원의 취소
$order_cancel = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where user_id = '".$user_id."' and order_cancel in (1,2) ");

// 해당 회원의 교환
$order_exchange = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where user_id = '".$user_id."' and order_exchange in (1,2) ");

// 해당 회원의 환불
$order_refund = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where user_id = '".$user_id."' and order_refund in (1,2) ");

// 해당 회원의 보유쿠폰
$dmshop_coupon_list = sql_fetch(" select count(*) as total_count from $shop[coupon_list_table] where user_id = '".$user_id."' and coupon_date2 >= '".$shop['time_ymd']."' and coupon_mode in (0,1) ");

/*------------------------------
    ## 주문 ##
------------------------------*/

// 검색조건
$sql_search = " where order_payment != '0' and user_id = '".$user_id."' ";

if ($order_type) {

    $sql_search .= " and order_type = '".$order_type."' ";

}

$cnt = sql_fetch(" select count(distinct order_code) as cnt from $shop[order_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 10000;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?tab=".$tab."&user_id=".$user_id."&order_type=".$order_type."&page=");

if (!$sort) {

    $sort = " order_datetime desc ";

}

$result = sql_query(" select *, count(order_code) as cnt from $shop[order_table] $sql_search group by order_code order by $sort limit $from_record, $rows ");
?>

<script type="text/javascript">
function listSearch()
{

    var f = document.formSearch;

    f.action = "./user_manage.php";
    f.submit();

}
</script>

<!-- 쇼핑정보 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/user_manage_t2.gif"></td>
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
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">누적구매 횟수/금액</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><a href="./order_all_list.php?f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="주문내역 조회하기"><b><?=number_format($order['total_order_count']);?></b> 회 / <b><?=number_format($order['total_order_pay_money']);?></b> 원</a></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">취소/교환/환불 횟수</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><a href="./order_cancel_list.php?order_type=300301&f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="취소내역 조회하기"><b><?=number_format($order_cancel['total_count']);?></b> 회</a> / <a href="./order_exchange_list.php?order_type=400401&f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="교환내역 조회하기"><b><?=number_format($order_exchange['total_count']);?></b> 회</a> / <a href="./order_refund_list.php?order_type=500501&f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="환불내역 조회하기"><b><?=number_format($order_refund['total_count']);?></b> 회</a></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">적립금 현황</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="./cash_list.php?f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="적립내역 조회하기"><b><?=number_format($user['user_cash']);?></b> 원</a></td>
    <td width="10"></td>
    <td><a href="#" onclick="cashPopupMake('plus', '<?=$user_id?>'); return false;" class="popup_btn">적립금 지급</a></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">쿠폰 현황</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="./coupon_make_list.php?f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="쿠폰내역 조회하기"><b><?=number_format($dmshop_coupon_list['total_count']);?></b> 장</a></td>
    <td width="10"></td>
    <td><a href="#" onclick="couponPopupMake('<?=$user_id?>'); return false;" class="popup_btn">쿠폰 지급</a></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 쇼핑정보 end //-->

<!-- 주문정보 start //-->
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
    <td><img src="<?=$shop['image_path']?>/adm/user_manage_t4.gif"></td>
</tr>
</table>
    </td>
    <td align="right">
<form method="get" name="formSearch" action="user_manage.php">
<input type="hidden" name="user_id" value="<?=$user_id?>" />
<input type="hidden" name="tab" value="<?=$tab?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx1">주문상태별 보기</td>
    <td width="10"></td>
    <td>
<select id="order_type" name="order_type" size="1" class="select" onchange="listSearch();">
    <option value="">전체보기</option>
    <option value="100"><?=shop_order_type("100");?></option>
    <option value="101"><?=shop_order_type("101");?></option>
    <option value="200"><?=shop_order_type("200");?></option>
    <option value="201"><?=shop_order_type("201");?></option>
    <option value="202"><?=shop_order_type("202");?></option>
    <option value="300"><?=shop_order_type("300");?></option>
    <option value="301"><?=shop_order_type("301");?></option>
    <option value="400"><?=shop_order_type("400");?></option>
    <option value="401"><?=shop_order_type("401");?></option>
    <option value="500"><?=shop_order_type("500");?></option>
    <option value="501"><?=shop_order_type("501");?></option>
</select>

<script type="text/javascript">
$("#order_type").val("<?=$order_type?>");
</script>
    </td>
</tr>
</table>
</form>
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
    <col width="90">
    <col width="90">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">주문일시</td>
    <td bgcolor="#f7f7f7" class="popup_subject">상품명(옵션)</td>
    <td bgcolor="#f7f7f7" class="popup_subject">주문상태</td>
    <td bgcolor="#f7f7f7" class="popup_subject">결제금액</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    // 1건도 포함됨으로 빼준다.
    $list['cnt'] = (int)($list['cnt'] - 1);
?>
<? if ($i > '0') { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<? } ?>
<tr height="30">
    <td align="center"><span class="datetime1"><?=date("Y-m-d", strtotime($list['order_datetime']));?></span><span class="datetime2"> <?=date("H:i", strtotime($list['order_datetime']));?></span></td>
    <td><p style="margin-left:15px;"><a href="#" onclick="orderManage('', '<?=$list['order_code']?>'); return false;" class="tx2"><?=text($list['item_title'])?><? if ($list['option_name']) { ?> <span class="t58">(옵션 : <?=text($list['option_name'])?>)</span><? } ?><? if ($list['cnt']) { ?> 외 <?=number_format($list['cnt']);?>건<? } ?></a></p></td>
    <td align="center" class="tx2"><?=shop_order_type($list['order_type']);?></td>
    <td align="center" class="tx2"><?=number_format($list['order_total_item_money']);?> 원</td>
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
<!-- 주문정보 end //-->