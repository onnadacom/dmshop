<?php
include_once("./_dmshop.php");
if ($coupon_type) { $coupon_type = preg_match("/^[0-9]+$/", $coupon_type) ? $coupon_type : ""; }
if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }
$top_id = "2";
$left_id = "5";
$menu_id = "205";
$shop['title'] = "쿠폰 사용내역";
include_once("./_top.php");

$colspan = "18";

/*------------------------------
    ## 쿠폰 ##
------------------------------*/

if ($coupon_id) {

    $dmshop_coupon = shop_coupon($coupon_id);

}

// 검색조건 (사용된 쿠폰)
$sql_search = " where coupon_mode = '2' ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

if ($coupon_type || $coupon_type == '0') {

    $sql_search .= " and coupon_type = '".$coupon_type."' ";

}

if ($coupon_id) {

    $sql_search .= " and coupon_id = '".$coupon_id."' ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[coupon_list_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 20;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?coupon_type=".$coupon_type."&coupon_id=".$coupon_id."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "datetime desc";

}

$result = sql_query(" select * from $shop[coupon_list_table] $sql_search order by $sort limit $from_record, $rows ");

if (!$q) {

    $keyword = "검색어";
    $q = "검색어";

}
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.category1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category1 .selectBox-dropdown {width:80px; height:19px;}
.category1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.category2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category2 .selectBox-dropdown {width:300px; height:19px;}
.category2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.sort .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.sort .selectBox-dropdown {width:110px; height:19px;}
.sort .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.limit .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.limit .selectBox-dropdown {width:35px; height:19px;}
.limit .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.field .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.field .selectBox-dropdown {width:80px; height:19px;}
.field .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".category1 select").selectBox();
    $(".category2 select").selectBox();
    $(".sort select").selectBox();
    $(".limit select").selectBox();
    $(".field select").selectBox();
});
</script>

<script type="text/javascript" src="<?=$shop['path']?>/js/userview.js"></script>

<script type="text/javascript">
function checkAll(mode)
{

    $('.form_list .chk_id input').attr('checked', mode);

}

function checkConfirm(msg)
{

    var n = $('.form_list .chk_id input:checked').length;

    if (n <= '0') {

        alert(msg + "할 내역을 선택하세요.");
        return false;

    }

    return true;

}

function checkDelete()
{

    var msg = "삭제";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "alld";

    if (!confirm("선택한 쿠폰을 삭제 하시겠습니까?\n\n사용중 상태의 쿠폰은 삭제되지 않으며, 주문이 완료된 후 삭제하셔야 합니다.")) {

        return false;

    }

    f.action = "./coupon_make_list_update.php";
    f.submit();

}

function listDelete(coupon_list_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.coupon_list_id.value = coupon_list_id;

    if (!confirm("쿠폰을 삭제하시겠습니까?\n\n사용중 상태의 쿠폰은 삭제되지 않으며, 주문이 완료된 후 삭제하셔야 합니다.")) {

        return false;

    }

    f.action = "./coupon_make_list_update.php";
    f.submit();

}

function listSearch(mode)
{

    var f = document.formSearch;

    if (f.q.value == '<?=text($keyword)?>') {

        f.q.value = "";

    }

    if (mode == 'sort') {

        f.submit();

    } else {

        if (!f.q.value) {

            alert("검색어를 입력하십시오."); 
            f.q.focus();
            return false;

        }

    }

}

function keywordOver()
{

    var f = document.formSearch;

    if (f.q.value == '<?=text($keyword)?>') {

        f.q.value = "";

    }

}
</script>

<form method="post" name="formUpdate">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="coupon_list_id" value="" />
</form>

<div class="contents_box">
<form method="get" name="formSearch" action="coupon_order_list.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">쿠폰선택</td>
    <td width="5"></td>
    <td class="category2">
<select id="coupon_id" name="coupon_id" class="select" onchange="listSearch('sort');">
    <option value=''>전체 쿠폰</option>
<?
$result2 = sql_query(" select * from $shop[coupon_table] order by datetime desc ");
for ($i=0; $row=sql_fetch_array($result2); $i++) {

    echo "<option value='".$row['id']."'>[".text(shop_coupon_type($row['coupon_type']))."] ".text($row['coupon_title'])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#coupon_id").val("<?=$coupon_id?>");
</script>
    </td>
</tr>
</table>
    </td>
    <td width="20"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="listname">사용내역</span></td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">건</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="datetime desc">사용일시 내림차순</option>
    <option value="datetime asc">사용일시 오름차순</option>
    <option value="user_id desc">회원아이디 내림차순</option>
    <option value="user_id asc">회원아이디 오름차순</option>
    <option value="user_name desc">성명 내림차순</option>
    <option value="user_name asc">성명 오름차순</option>
</select>
    </td>
    <td width="4"></td>
    <td class="limit">
<select id="rows" name="rows" class="select" onchange="listSearch('sort');">
    <option value="20">20개씩</option>
    <option value="40">40개씩</option>
    <option value="80">80개씩</option>
    <option value="100">100개씩</option>
</select>
    </td>
</tr>
</table>
    </td>
    <td width="350" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="field">
<select id="f" name="f" class="select">
    <option value="coupon_title">쿠폰명</option>
    <option value="coupon_number">쿠폰번호</option>
    <option value="user_id">회원아이디</option>
    <option value="user_name">성명</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./coupon_order_list.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>
    </td>
</tr>
</table>
</form>

<script type="text/javascript">
<? if ($sort) { ?>$("#sort").val("<?=$sort?>");<? } ?>
<? if ($rows) { ?>$("#rows").val("<?=$rows?>");<? } ?>
<? if ($f) { ?>$("#f").val("<?=$f?>");<? } ?>
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<form method="post" name="formList" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="form_list">
<colgroup>
    <col width="20">
    <col width="35">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="100">
</colgroup>
<tr height="1">
    <td></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
</tr>
<tr height="50" bgcolor="#f5f5f5">
    <td></td>
    <td align="center"><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">사용일시</td>
    <td class="bc1"></td>
    <td class="boxtitle">아이디</td>
    <td class="bc1"></td>
    <td class="boxtitle">성명</td>
    <td class="bc1"></td>
    <td class="boxtitle">주문상품</td>
    <td class="bc1"></td>
    <td class="boxtitle">주문금액</td>
    <td class="bc1"></td>
    <td class="boxtitle">쿠폰 할인</td>
    <td class="bc1"></td>
    <td class="boxtitle">적립금 할인</td>
    <td class="bc1"></td>
    <td class="boxtitle">결제금액/수단</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    $user = shop_user($list['user_id']);

    // userview
    $userview = shop_userview($user['user_id'], $user['user_name'], $user['user_email'], $user['user_homepage'], $user['user_name']);

    // 상품 정보
    $dmshop_item = shop_item($list['item_id']);

    // 주문 정보
    $dmshop_order = shop_order_id($list['order_id']);
?>
<input type="hidden" name="coupon_list_id[<?=$i?>]" value="<?=$list['id']?>" />
<tr height="50">
    <td></td>
    <td align="center" class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="datetime1"><?=date("Y-m-d", strtotime($list['order_datetime']));?></p><p class="datetime2"><?=date("H시 : i분", strtotime($list['order_datetime']));?></p></td>
    <td class="bc1"></td>
    <td align="center" class="user_id"><?=shop_user_id($user['user_id'], $user['user_leave_datetime']);?></td>
    <td class="bc1"></td>
    <td align="center" class="user_name"><?=$userview?></td>
    <td class="bc1"></td>
    <td onclick="orderManage('', '<?=text($list['order_code'])?>'); return false;" class="pointer">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=text($list['item_code'])?>" target="_blank" class="item_title"><?=text($list['item_title'])?><? if ($dmshop_order['option_name']) { ?> <span class="option_name">(옵션 : <?=text($dmshop_order['option_name'])?>)</span><? } ?></a></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="center" class="item_money"><?=number_format($dmshop_order['order_total_item_money']);?></td>
    <td class="bc1"></td>
    <td align="center" class="order_coupon"><?=number_format($dmshop_order['order_coupon']);?></td>
    <td class="bc1"></td>
    <td align="center" class="order_cash"><?=number_format($dmshop_order['order_cash']);?></td>
    <td class="bc1"></td>
    <td align="center"><p class="order_pay_money"><?=number_format($dmshop_order['order_pay_money']);?></p><p class="order_pay_type<?=text($dmshop_order['order_pay_type'])?>"><?=shop_pay_name($dmshop_order['order_pay_type']);?></p></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<? } ?>
</table>

<? if ($i && $total_count > $rows) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr height="90">
    <td><?=$shop_pages?></td>
</tr>
</table>
<? } ?>

<? if (!$i) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="200">
    <td class="not">데이터가 없습니다.</td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="checkDelete(); return false;"><img src="<?=$shop['image_path']?>/adm/del.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">삭제 버튼을 클릭하시면, 선택된 회원의 쿠폰을 삭제(회수) 합니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>