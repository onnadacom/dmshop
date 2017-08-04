<?php
include_once("./_dmshop.php");
if ($date1) { $date1 = trim($date1); $date1 = preg_match("/^[0-9\-]+$/", $date1) ? $date1 : ""; }
if ($date2) { $date2 = trim($date2); $date2 = preg_match("/^[0-9\-]+$/", $date2) ? $date2 : ""; }
if ($order_receipt_code) { $order_receipt_code = preg_match("/^[0-9]+$/", $order_receipt_code) ? $order_receipt_code : ""; }
if ($order_receipt) { $order_receipt = preg_match("/^[0-9]+$/", $order_receipt) ? $order_receipt : ""; }
$top_id = "2";
$left_id = "2";
$menu_id = "300";
$shop['title'] = "영수증 관리";
include_once("./_top.php");

$colspan = "19";

/*--------------------------------
    ## 날짜 ##
--------------------------------*/

// 어제
$search_date1 = date("Y-m-d", $shop['server_time'] - (1 * 86400));

// 일주일
$search_date2 = date("Y-m-d", $shop['server_time'] - (7 * 86400));

// 이번달 1일
$search_date3 = date("Y-m-d", strtotime(date("Y-m", $shop['server_time'])."-01"));

// 지난달 1일
$search_date4 = date("Y-m-d", strtotime(date("Y-m", strtotime(date("Y-m", $shop['server_time'])."-01") - (86400 * 1))."-01"));

// 지난달 마지막일
$search_date5 = date("Y-m-d", strtotime(date("Y-m", $shop['server_time'])."-01") - (86400 * 1));

// 전체 (기본)
$search_date_default1 = "2012-01-01";
$search_date_default2 = $shop['time_ymd'];

/*--------------------------------
    ## 주문 ##
--------------------------------*/

// 검색조건
$sql_search = " where order_payment != '0' and order_number = '0' and order_pay_type in ('1','2','4','5') ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

if (!$date1 || !$date2) {

    $date1 = $search_date_default1;
    $date2 = $search_date_default2;

}

if ($date1 && $date2) {

    $sql_search .= " and substring(order_datetime,1,10) >= '".$date1."' and substring(order_datetime,1,10) <= '".$date2."' ";

}

if ($order_receipt || $order_receipt == '0') {

    // 미신청
    if ($order_receipt == '0') {

        // 무통장, 미신청
        $sql_search .= " and order_pay_type = '5' and order_receipt = '0' ";

    }

    // 신청(소득공제)
    if ($order_receipt == '1') {

        // 무통장, 신청(소득공제)
        $sql_search .= " and order_pay_type = '5' and order_receipt = '1' ";

    }

    // 신청(지출증빙)
    if ($order_receipt == '2') {

        // 무통장, 신청(지출증빙)
        $sql_search .= " and order_pay_type = '5' and order_receipt = '2' ";

    }

    // 자동
    if ($order_receipt == 'auto') {

        // 카드, 이체, 가상
        $sql_search .= " and order_pay_type in ('1','2','4') ";

    }

}

if ($order_receipt_code) {

    if ($order_receipt_code == '1') {

        // 발행전
        $sql_search .= " and order_receipt_code = '' ";

    }

    if ($order_receipt_code == '2') {

        // 발행완료
        $sql_search .= " and order_receipt_code != '' ";

    }

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[order_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 20;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?date1=".$date1."&date2=".$date2."&order_receipt=".$order_receipt."&order_receipt_code=".$order_receipt_code."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "order_datetime desc";

}

$result = sql_query(" select * from $shop[order_table] $sql_search order by $sort limit $from_record, $rows ");

if (!$q) {

    $keyword = "검색어";
    $q = "검색어";

}
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.category1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category1 .selectBox-dropdown {width:100px; height:19px;}
.category1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.category2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category2 .selectBox-dropdown {width:100px; height:19px;}
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

.contents_box .order_receipt {font-weight:bold; line-height:15px; font-size:13px; color:#114572; font-family:gulim,굴림;}
.contents_box .order_receipt_name {line-height:14px; font-size:12px; color:#027a8f; font-family:dotum,돋움;}
.contents_box .order_receipt_code0 {line-height:14px; font-size:12px; color:#333333; font-family:dotum,돋움;}
.contents_box .order_receipt_code1 {line-height:14px; font-size:12px; color:#9d9d9d; font-family:dotum,돋움;}
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

function checkExcel()
{

    var msg = "액셀생성";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "check_receipt";

    if (!confirm("선택한 내역을 액셀생성 하시겠습니까?")) {

        return false;

    }

    f.action = "./order_excel.php";
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

function listDate(mode)
{

    var f = document.formSearch;

    if (mode == '1') {

        f.date1.value = "<?=$shop['time_ymd']?>";
        f.date2.value = "<?=$shop['time_ymd']?>";

    }

    if (mode == '2') {

        f.date1.value = "<?=$search_date1?>";
        f.date2.value = "<?=$search_date1?>";

    }

    if (mode == '3') {

        f.date1.value = "<?=$search_date2?>";
        f.date2.value = "<?=$shop['time_ymd']?>";

    }

    if (mode == '4') {

        f.date1.value = "<?=$search_date3?>";
        f.date2.value = "<?=$shop['time_ymd']?>";

    }

    if (mode == '5') {

        f.date1.value = "<?=$search_date4?>";
        f.date2.value = "<?=$search_date5?>";

    }

    if (mode == '6') {

        f.date1.value = "<?=$search_date_default1?>";
        f.date2.value = "<?=$search_date_default2?>";

    }

    listSearch('sort');

}

function keywordOver()
{

    var f = document.formSearch;

    if (f.q.value == '<?=text($keyword)?>') {

        f.q.value = "";

    }

}
</script>

<form method="post" name="formUpdate" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="order_code" value="" />
</form>

<div class="contents_box">
<form method="get" name="formSearch" action="order_receipt_list.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">주문상태별 보기</td>
    <td width="10"></td>
    <td class="category1">
<select id="order_receipt" name="order_receipt" size="1" class="select" onchange="listSearch('sort');">
    <option value="">신청여부 전체</option>
    <option value="1">신청(소득공제)</option>
    <option value="2">신청(지출증빙)</option>
    <option value="0">신청안함</option>
    <option value="auto">자동</option>
</select>

<script type="text/javascript">
$("#order_receipt").val("<?=$order_receipt?>");
</script>
    </td>
    <td width="4"></td>
    <td class="category2">
<select id="order_receipt_code" name="order_receipt_code" size="1" class="select" onchange="listSearch('sort');">
    <option value="">발행여부 전체</option>
    <option value="1">발행 전</option>
    <option value="2">발행완료</option>
</select>

<script type="text/javascript">
$("#order_receipt_code").val("<?=$order_receipt_code?>");
</script>
    </td>
    <td width="20"></td>
    <td class="tx1">기간별 조회 :</td>
    <td width="5"></td>
    <td><input type="text" id="date1" name="date1" value="<?=$date1?>" onFocus="shopfocusIn4(this);" onBlur="shopfocusOut4(this);" class="input4" /></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopDate('date1'); return false;"><img src="<?=$shop['image_path']?>/adm/calendar.gif" border="0"></a></td>
    <td width="16" align="center" class="tx1">~</td>
    <td><input type="text" id="date2" name="date2" value="<?=$date2?>" onFocus="shopfocusIn4(this);" onBlur="shopfocusOut4(this);" class="input4" /></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopDate('date2'); return false;"><img src="<?=$shop['image_path']?>/adm/calendar.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="listSearch('sort'); return false;"><img src="<?=$shop['image_path']?>/adm/search3.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="listDate('1'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date1.gif" border="0"></a></td>
    <td><a href="#" onclick="listDate('2'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date2.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="listDate('3'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date3.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="listDate('4'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date4.gif" border="0"></a></td>
    <td><a href="#" onclick="listDate('5'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date5.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="#" onclick="listDate('6'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_date6.gif" border="0"></a></td>
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
    <td class="listname">주문내역</td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">건</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="order_datetime desc">주문일시 내림차순</option>
    <option value="order_datetime asc">주문일시 오름차순</option>
    <option value="order_name asc">주문자명 내림차순</option>
    <option value="order_name desc">주문자명 오름차순</option>
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
    <td width="400" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="field">
<select id="f" name="f" class="select">
    <option value="order_name">주문자명</option>
    <option value="order_code">주문번호</option>
    <option value="user_id">주문자ID</option>
    <option value="order_rec_name">수령자명</option>
    <option value="order_dep_name">입금자명</option>
    <option value="item_title">주문상품명</option>
    <option value="item_code">상품코드</option>
    <option value="order_tel">주문자 전화</option>
    <option value="order_hp">주문자 휴대폰</option>
    <option value="order_rec_tel">수령자 전화</option>
    <option value="order_rec_hp">수령자 휴대폰</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./order_receipt_list.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="25">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="129">
    <col width="20">
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
    <td></td>
</tr>
<tr height="50" bgcolor="#f5f5f5">
    <td></td>
    <td><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">주문일시</td>
    <td class="bc1"></td>
    <td class="boxtitle">주문번호</td>
    <td class="bc1"></td>
    <td class="boxtitle">주문자명<br>(수령자명)</td>
    <td class="bc1"></td>
    <td class="boxtitle">주문상태<br>(결제수단)</td>
    <td class="bc1"></td>
    <td class="boxtitle">주문상품 (주문옵션)</td>
    <td class="bc1"></td>
    <td class="boxtitle">신청여부</td>
    <td class="bc1"></td>
    <td class="boxtitle">발행여부</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별설정</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="form_list">
<colgroup>
    <col width="20">
    <col width="25">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="129">
    <col width="20">
</colgroup>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    // user
    $user = shop_user($list['user_id']);

    if ($user['id']) {

        $userview = shop_userview($user['user_id'], $user['user_name'], $user['user_email'], $user['user_homepage'], $list['order_name']);

    } else {

        $userview = shop_userview("", $dmshop_order['order_name'], $dmshop_order['order_email'], "", $list['order_name']);

    }
?>
<input type="hidden" name="order_code[<?=$i?>]" value="<?=$list['order_code']?>" />
<tr height="50" class="list_bg<?=$i%2?>">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="datetime1"><?=date("Y-m-d", strtotime($list['order_datetime']));?></p><p class="datetime2"><?=date("H시 : i분", strtotime($list['order_datetime']));?></p></td>
    <td class="bc1"></td>
    <td align="center"><a href="#" onclick="orderPopupDetail('<?=$list['order_code']?>'); return false;" class="order_code"><?=$list['order_code']?></a></td>
    <td class="bc1"></td>
    <td align="center"><? if ($list['order_name'] != $list['order_rec_name']) { echo "<p class='order_name'>".$userview."</p><p class='order_rec_name'>(".text($list['order_rec_name']).")</p>"; } else { echo "<p class='order_name'>".$userview."</p>"; } ?></td>
    <td class="bc1"></td>
    <td align="center"><p><span class="order_type_<?=$list['order_type']?>"><?=shop_order_type($list['order_type']);?></span></p><p class="order_pay_type<?=$list['order_pay_type']?>" style="margin-top:5px;"><?=shop_pay_name($list['order_pay_type']);?></p></td>
    <td class="bc1"></td>
    <td onclick="orderManage('', '<?=$list['order_code']?>'); return false;" class="pointer"><p style="margin-left:15px;"><a href="<?=$shop['path']?>/item.php?id=<?=$list['item_code']?>" target="_blank"><span class="item_title"><?=text($list['order_title'])?></span></a></p></td>
    <td class="bc1"></td>
    <td align="center">
<? if ($list['order_pay_type'] == '1' || $list['order_pay_type'] == '2' || $list['order_pay_type'] == '4') { ?>
<p class="order_receipt">자동</p>
<? } else { ?>
<? if ($list['order_receipt']) { ?>
<p class="order_receipt">신청</p><p class="order_receipt_name"><?=shop_receipt_name($list['order_receipt']);?></p>
<? } else { ?>
<p class="order_receipt">신청안함</p>
<? } ?>
<? } ?>
    </td>
    <td class="bc1"></td>
    <td align="center">
<? if ($list['order_receipt_code']) { ?>
<p class="order_receipt_code1">발행완료</p>
<? } else { ?>
<p class="order_receipt_code0">발행 전</p>
<? } ?>
    </td>
    <td class="bc1"></td>
    <td align="left" class="none">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
<?
// 무통장
if ($list['order_pay_type'] == '5') {

    // 발행완료
    if ($list['order_receipt_code']) {

        // 영수증 버튼
        $receipt_btn = str_replace("btn", "<img src='".$shop['image_path']."/adm/list_receipt_btn.gif' border='0'>", shop_order_receipt_btn($list['order_code']));
        echo "<td>".$receipt_btn."</td>";

        echo "<td width='4'></td>";

        // 변경
        echo "<td><a href=\"#\" onclick=\"orderPopupReceipt('".$list['order_code']."'); return false;\"><img src='".$shop['image_path']."/adm/list_receipt_edit.gif' border='0'></a></td>";

    } else {
    // 미발행

        // 승인번호 입력
        echo "<td><a href=\"#\" onclick=\"orderPopupReceipt('".$list['order_code']."'); return false;\"><img src='".$shop['image_path']."/adm/list_receipt_write.gif' border='0'></a></td>";

    }

} else {

    // 카드, 이체(영수증), 가상(영수증)
    if ($list['order_pay_type'] == '1' || $list['order_pay_type'] == '2' && $list['order_receipt_code'] || $list['order_pay_type'] == '4' && $list['order_receipt_code']) {

        // 영수증 버튼
        $receipt_btn = str_replace("btn", "<img src='".$shop['image_path']."/adm/list_receipt_btn.gif' border='0'>", shop_order_receipt_btn($list['order_code']));
        echo "<td>".$receipt_btn."</td>";

    }

}
?>
</tr>
</table>
    </td>
    <td></td>
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
    <td><a href="#" onclick="checkExcel(); return false;"><img src="<?=$shop['image_path']?>/adm/all_excel.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./order_excel.php?m=receipt"><img src="<?=$shop['image_path']?>/adm/excel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">선택하신 상품을 위 조건으로 일괄 처리 합니다.</td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>