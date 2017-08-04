<?php
include_once("./_dmshop.php");
if ($coupon_type) { $coupon_type = preg_match("/^[0-9]+$/", $coupon_type) ? $coupon_type : ""; }
$top_id = "2";
$left_id = "5";
$menu_id = "200";
$shop['title'] = "전체 쿠폰목록";
include_once("./_top.php");

$colspan = "22";

/*------------------------------
    ## 쿠폰 ##
------------------------------*/

// 검색조건
$sql_search = " where 1 ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

if ($coupon_type || $coupon_type == '0') {

    $sql_search .= " and coupon_type = '".$coupon_type."' ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[coupon_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 20;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?coupon_type=".$coupon_type."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "datetime desc";

}

$result = sql_query(" select * from $shop[coupon_table] $sql_search order by $sort limit $from_record, $rows ");

if (!$q) {

    $keyword = "검색어";
    $q = "검색어";

}
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.category .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category .selectBox-dropdown {width:80px; height:19px;}
.category .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

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

function checkSave()
{

    var msg = "변경";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "u";

    if (!confirm("선택한 쿠폰을 변경하시겠습니까?")) {

        return false;

    }

    f.action = "./coupon_config_list_update.php";
    f.submit();

}

function checkDelete()
{

    var msg = "삭제";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "d";

    if (!confirm("선택한 쿠폰을 삭제 하시겠습니까?\n\n삭제하시면 발급 및 사용된 쿠폰 모두 삭제됩니다.")) {

        return false;

    }

    f.action = "./coupon_config_list_update.php";
    f.submit();

}

function listDelete(coupon_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.coupon_id.value = coupon_id;

    if (!confirm("쿠폰을 삭제하시겠습니까?\n\n삭제하시면 발급 및 사용된 쿠폰 모두 삭제됩니다.")) {

        return false;

    }

    f.action = "./coupon_config_update.php";
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

<script type="text/javascript">
$(document).ready( function() {
    $(".category select").selectBox();
    $(".sort select").selectBox();
    $(".limit select").selectBox();
    $(".field select").selectBox();
});
</script>

<form method="post" name="formUpdate">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="coupon_id" value="" />
</form>

<div class="contents_box">
<form method="get" name="formSearch" action="coupon_config_list.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">유형별 보기</td>
    <td width="10"></td>
    <td class="category">
<select id="coupon_type" name="coupon_type" class="select" onchange="listSearch('sort');">
    <option value="">전체보기</option>
    <option value="0">일반</option>
    <option value="1">인쇄용</option>
</select>
    </td>
</tr>
</table>
    </td>
    <td width="250" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="./coupon_config.php"><img src="<?=$shop['image_path']?>/adm/coupon_config.gif" border="0"></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="couponPopupMake(''); return false;"><img src="<?=$shop['image_path']?>/adm/coupon_make.gif" border="0"></a></td>
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
    <td class="listname">쿠폰목록</span></td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">건</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="datetime desc">발행일순 내림차순</option>
    <option value="datetime asc">발행일순 오름차순</option>
    <option value="coupon_title desc">쿠폰명 내림차순</option>
    <option value="coupon_title asc">쿠폰명 오름차순</option>
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
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./coupon_config_list.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>
    </td>
</tr>
</table>
</form>

<script type="text/javascript">
<? if ($coupon_type || $coupon_type == '0') { ?>$("#coupon_type").val("<?=$coupon_type?>");<? } ?>
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
    <col width="70">
    <col width="1">
    <col width="95">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="85">
    <col width="1">
    <col width="65">
    <col width="1">
    <col width="65">
    <col width="1">
    <col width="120">
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
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
</tr>
<tr height="50" bgcolor="#f5f5f5">
    <td></td>
    <td align="center"><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">유형</td>
    <td class="bc1"></td>
    <td class="boxtitle">지급유무</td>
    <td class="bc1"></td>
    <td class="boxtitle">할인/혜택</td>
    <td class="bc1"></td>
    <td class="boxtitle">쿠폰명/사용조건</td>
    <td class="bc1"></td>
    <td class="boxtitle">사용기간</td>
    <td class="bc1"></td>
    <td class="boxtitle">발행매수</td>
    <td class="bc1"></td>
    <td class="boxtitle">지급매수</td>
    <td class="bc1"></td>
    <td class="boxtitle">사용내역</td>
    <td class="bc1"></td>
    <td class="boxtitle">자동지급 설정</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별설정</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {
?>
<input type="hidden" name="coupon_id[<?=$i?>]" value="<?=$list['id']?>" />
<tr height="50">
    <td></td>
    <td align="center" class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center" class="tx2"><?=shop_coupon_type($list['coupon_type']);?></td>
    <td class="bc1"></td>
    <td align="center">
<select id="coupon_use[<?=$i?>]" name="coupon_use[<?=$i?>]" class="select">
    <option value="0">지급가능</option>
    <option value="1">지급중단</option>
</select>

<script type="text/javascript">
document.getElementById("coupon_use[<?=$i?>]").value = "<?=$list['coupon_use']?>";
</script>
    </td>
    <td class="bc1"></td>
    <td align="center"><span class="order_coupon"><?=number_format($list['coupon_discount']);?></span><span class="tx2"> <?=shop_coupon_discount_type($list['coupon_discount_type']);?></span></td>
    <td class="bc1"></td>
    <td style="line-height:20px;">
<p style="margin-left:10px;">
<?
echo "<a href='#' onclick=\"couponPopupView('".$list['id']."'); return false;\" class='coupon_title'>".text($list['coupon_title'])."</a><br>";

echo "<span class='coupon_category'>";

// 기획전
if ($list['coupon_category_type']) {

    if ($list['coupon_plan']) {

        echo "[".shop_plan_name($list['coupon_plan'])." 기획전]";

    } else {

        echo "[모든 카테고리]";

    }

} else {
// 분류

    if ($list['coupon_category']) {

        echo "[".shop_category_name($list['coupon_category'])." 분류]";

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
    <td align="center">
<?
// 발급일
if ($list['coupon_day_type']) {

    echo "<p class='coupon_date'>발급일로 부터</p>";
    echo "<p class='coupon_date'>".number_format($list['coupon_day'])." 일간</p>";

} else {
// 고정기간

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
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
<? if ($list['coupon_type'] == '1') { ?>
<input type="hidden" name="coupon_max[<?=$i?>]" value="<?=text($list['coupon_max'])?>" />
    <td align="center"><a href="./coupon_make_number.php?coupon_id=<?=$list['id']?>"><span class="tx1"><b><?=number_format($list['coupon_max']);?></b></span> <span class="tx1">매</span></a></td>
    <td class="bc1"></td>
<? } else { ?>
    <td><input type="text" name="coupon_max[<?=$i?>]" value="<?=text($list['coupon_max'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:42px;" /></td>
    <td width="5"></td>
    <td class="tx1">매</td>
<? } ?>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="center"><a href="./coupon_make_list.php?coupon_id=<?=$list['id']?>"><span class="coupon_down"><?=number_format($list['coupon_down']);?></span> <span class="tx1">건</span></a></td>
    <td class="bc1"></td>
    <td align="center"><a href="./coupon_order_list.php?coupon_id=<?=$list['id']?>"><span class="coupon_order"><?=number_format($list['coupon_order']);?></span> <span class="tx1">건</span></a></td>
    <td class="bc1"></td>
    <td>
<? if ($list['coupon_type']) { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="tx1">자동지급 불가</td>
</tr>
</table>
<? } else { ?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="tx1">
<?
echo shop_coupon_auto($list['coupon_auto']);

if ($list['coupon_auto'] == '5') {

    echo " ".number_format($list['coupon_order_money'])." 원 이상 구매";

}
?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="couponPopupAuto('<?=$list['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_setting.gif" border="0"></a></td>
</tr>
</table>
<? } ?>
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
    <td><a href="#" onclick="checkSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="checkDelete(); return false;"><img src="<?=$shop['image_path']?>/adm/del.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="./coupon_config_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 선택항목의 변동된 설정값이 저장 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>