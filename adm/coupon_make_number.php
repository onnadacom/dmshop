<?php
include_once("./_dmshop.php");
if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }
if ($coupon_user) { $coupon_user = preg_match("/^[0-9]+$/", $coupon_user) ? $coupon_user : ""; }
$top_id = "2";
$left_id = "5";
$menu_id = "206";
$shop['title'] = "인쇄용 쿠폰 등록현황";
include_once("./_top.php");

$colspan = "18";

/*------------------------------
    ## 쿠폰 ##
------------------------------*/

if ($coupon_id) {

    $dmshop_coupon = shop_coupon($coupon_id);

}

// 검색조건
$sql_search = " where coupon_type = '1' ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

if ($coupon_id) {

    $sql_search .= " and coupon_id = '".$coupon_id."' ";

}

if ($coupon_user == '0') {

    $sql_search .= " and user_id = '' ";

}

if ($coupon_user == '1') {

    $sql_search .= " and user_id != '' ";

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

$shop_pages = shop_paging_v0("10", $page, $total_page, "?coupon_id=".$coupon_id."&coupon_user=".$coupon_user."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "id desc";

}

$result = sql_query(" select * from $shop[coupon_list_table] $sql_search order by $sort limit $from_record, $rows ");

if (!$q) {

    $keyword = "검색어";
    $q = "검색어";

}
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.category2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category2 .selectBox-dropdown {width:300px; height:19px;}
.category2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.category3 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category3 .selectBox-dropdown {width:100px; height:19px;}
.category3 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

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
    $(".category2 select").selectBox();
    $(".category3 select").selectBox();
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

function checkExcel()
{

    var msg = "액셀생성";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "check_coupon";

    if (!confirm("선택한 내역을 액셀생성 하시겠습니까?")) {

        return false;

    }

    f.action = "./coupon_excel.php";
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
<form method="get" name="formSearch" action="coupon_make_number.php" onSubmit="return listSearch('');" autocomplete="off">
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
$result2 = sql_query(" select * from $shop[coupon_table] where coupon_type = '1' order by datetime desc ");
for ($i=0; $row=sql_fetch_array($result2); $i++) {

    echo "<option value='".$row['id']."'>[".shop_coupon_type($row['coupon_type'])."] ".text($row['coupon_title'])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#coupon_id").val("<?=$coupon_id?>");
</script>
    </td>
    <td width="4"></td>
    <td class="category3">
<select id="coupon_user" name="coupon_user" class="select" onchange="listSearch('sort');">
    <option value="">등록여부 전체</option>
    <option value="1">등록완료</option>
    <option value="0">등록전</option>
</select>
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
    <td class="listname">등록내역</span></td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">건</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="id desc">등록일시 내림차순</option>
    <option value="id asc">등록일시 오름차순</option>
    <option value="datetime desc">등록일시 내림차순</option>
    <option value="datetime asc">등록일시 오름차순</option>
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
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./coupon_make_number.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>
    </td>
</tr>
</table>
</form>

<script type="text/javascript">
<? if ($coupon_user || $coupon_user == '0') { ?>$("#coupon_user").val("<?=$coupon_user?>");<? } ?>

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
    <col width="80">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="170">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="75">
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
    <td class="boxtitle">등록일시</td>
    <td class="bc1"></td>
    <td class="boxtitle">아이디</td>
    <td class="bc1"></td>
    <td class="boxtitle">성명</td>
    <td class="bc1"></td>
    <td class="boxtitle">쿠폰번호</td>
    <td class="bc1"></td>
    <td class="boxtitle">할인혜택</td>
    <td class="bc1"></td>
    <td class="boxtitle">사용기간</td>
    <td class="bc1"></td>
    <td class="boxtitle">쿠폰명/사용조건</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별설정</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    $user = shop_user($list['user_id']);

    // userview
    $userview = shop_userview($user['user_id'], $user['user_name'], $user['user_email'], $user['user_homepage'], $user['user_name']);
?>
<input type="hidden" name="coupon_list_id[<?=$i?>]" value="<?=$list['id']?>" />
<tr height="50">
    <td></td>
    <td align="center" class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center" class="tx2"><? if ($list['user_id']) { ?><p class="datetime1"><?=date("Y-m-d", strtotime($list['datetime']));?></p><p class="datetime2"><?=date("H시 : i분", strtotime($list['datetime']));?></p><? } else { ?>등록전<? } ?></td>
    <td class="bc1"></td>
    <td align="center" class="user_id"><?=shop_user_id($user['user_id'], $user['user_leave_datetime']);?></td>
    <td class="bc1"></td>
    <td align="center" class="user_name"><?=$userview?></td>
    <td class="bc1"></td>
    <td align="center" class="tx2">
<?
if ($list['user_id']) {

    echo "<a href='./coupon_make_list.php?f=coupon_number&q=".$list['coupon_number']."' class='tx2'>".$list['coupon_number']."</a>";

} else {

    echo "<font color='#cccccc'>".$list['coupon_number']."</font>";

}
?>
    </td>
    <td class="bc1"></td>
    <td align="center"><span class="order_coupon"><?=number_format($list['coupon_discount']);?></span><span class="tx2"> <?=shop_coupon_discount_type($list['coupon_discount_type']);?></span></td>
    <td class="bc1"></td>
    <td align="center">
<?
if ($list['coupon_date1'] == '0000-00-00') {

    echo "&nbsp;";

} else {

    if ($shop['time_ymd'] > $list['coupon_date2']) {

        echo "<p class='coupon_date'><font color='#ff0000'>".date("Y/m/d", strtotime($list['coupon_date1']))." 부터</font></p>";
        echo "<p class='coupon_date'><font color='#ff0000'>".date("Y/m/d", strtotime($list['coupon_date2']))." 까지</font></p>";

    } else {

        echo "<p class='coupon_date'>".date("Y/m/d", strtotime($list['coupon_date1']))." 부터</p>";
        echo "<p class='coupon_date'>".date("Y/m/d", strtotime($list['coupon_date2']))." 까지</p>";

    }

}
?>
    </td>
    <td class="bc1"></td>
    <td style="line-height:20px;">
<p style="margin-left:10px;">
<?
echo "<a href='#' onclick=\"couponPopupView('".$list['coupon_id']."'); return false;\" class='coupon_title'>".text($list['coupon_title'])."</a><br>";

echo "<span class='coupon_category'>";

// 기획전
if ($list['coupon_category_type']) {

    if ($list['coupon_plan']) {

        echo "[".text(shop_plan_name($list['coupon_plan']))." 기획전]";

    } else {

        echo "[모든 카테고리]";

    }

} else {
// 분류

    if ($list['coupon_category']) {

        echo "[".text(shop_category_name($list['coupon_category']))." 분류]";

    } else {

        echo "[모든 카테고리]";

    }

}

echo "</span>";

echo "<span class='coupon_type'>";

// 최소 또는 최대 금액이 있다
if ($list['coupon_discount_min'] || $list['coupon_discount_type'] == '1' && $list['coupon_discount_max']) {

    // 최소금액
    if ($list['coupon_discount_min']) {

        echo " ".number_format($list['coupon_discount_min'])."원 이상 구매시";

    }

    // 퍼센트비율, 최대금액
    if ($list['coupon_discount_type'] == '1' && $list['coupon_discount_max']) {

        echo " 최대 ".number_format($list['coupon_discount_max'])."원 할인";

    }

} else {

    echo " 자유이용 쿠폰";

}

if ($list['coupon_bank']) {

    echo " / 무통장 입금 전용";

}

if ($list['coupon_cash']) {

    echo " / 적립금 동시사용 불가";

}

if ($list['coupon_overlap']) {

    echo " / 중복다운불가";

}

echo "</span>";
?>
</p>
    </td>
    <td class="bc1"></td>
    <td align="center"><a href="#" onclick="listDelete('<?=$list['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_delete.gif" border="0"></a></td>
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
    <td width="5"></td>
    <td><a href="#" onclick="checkExcel(); return false;"><img src="<?=$shop['image_path']?>/adm/all_excel.gif" border="0" /></a></td>
<!--
    <td width="5"></td>
    <td><a href="./coupon_excel.php?m=coupon_id&coupon_id=<?=$coupon_id?>">액셀 전체 생성(현재 쿠폰)</a></td>
//-->
    <td width="5"></td>
    <td><a href="./coupon_excel.php?m=coupon"><img src="<?=$shop['image_path']?>/adm/user_excel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">삭제 버튼을 클릭하시면, 선택된 등록된 쿠폰을 삭제(회수) 합니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>