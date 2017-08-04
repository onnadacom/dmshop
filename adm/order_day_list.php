<?php
include_once("./_dmshop.php");
if ($d) { $d = trim($d); $d = preg_match("/^[0-9\-]+$/", $d) ? $d : ""; }
if ($order_type) { $order_type = preg_match("/^[0-9]+$/", $order_type) ? $order_type : ""; }
if ($order_pay_type) { $order_pay_type = preg_match("/^[0-9]+$/", $order_pay_type) ? $order_pay_type : ""; }
$top_id = "2";
$left_id = "2";
$menu_id = "101";
$shop['title'] = "일일 주문내역";
include_once("./_top.php");

$colspan = "19";

/*--------------------------------
    ## 날짜 ##
--------------------------------*/

$datetime = $d;

if (!$datetime) {

    $datetime = $shop['time_ymd'];

}

// 현재 시각에서 월을 구한다.
$dateT1 = date("Y-m", strtotime($datetime));

// 현재 월의 1일의 요일 값을 구한다.
$dateT2 = date("w", strtotime($dateT1."-01"));

// 현재 월의 1일에서 요일 값을 뺀다.
$dateT3 = date("Y-m-d", strtotime($dateT1."-01") - (86400 * $dateT2));

// 현재 월의 1일에서 31일을 더한다.
$dateN1 = date("Y-m-d", strtotime($dateT1."-01") + (86400 * 31));

// 다음 달의 월을 구한다.
$dateN2 = date("Y-m", strtotime($dateN1));

// 다음 달 1일을 구한다.
$dateN3 = date("Y-m-d", strtotime($dateN2."-01"));

// 다음 달 1일에서 1일을 뺀다. 그럼 이번 달 마지막일
$dateN4 = date("d", strtotime($dateN3) - (86400 * 1));

// 6 뺀다. 현재 달 마지막 일 요일을 구해서.
$dateN5 = 6 - date("w", strtotime($dateT1."-".$dateN4));

// 현재 월의 1일에서 1일을 뺀다.
$dateP1 = date("Y-m-d", strtotime($dateT1."-01") - (86400 * 1));

// 작년
$dateM1 = (int)(date("Y", strtotime($datetime)) - 1)."-".date("m", strtotime($datetime))."-01";

// 내년
$dateM2 = (int)(date("Y", strtotime($datetime)) + 1)."-".date("m", strtotime($datetime))."-01";

/*--------------------------------
    ## 주문 ##
--------------------------------*/

// 검색조건
$sql_search = " where order_payment != '0' and order_number = '0' ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

if ($datetime) {

    $sql_search .= " and substring(order_datetime,1,10) = '".$datetime."' ";

}

if ($order_type) {

    $sql_search .= " and order_type = '".$order_type."' ";

}

if ($order_pay_type) {

    $sql_search .= " and order_pay_type = '".$order_pay_type."' ";

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

$shop_pages = shop_paging_v0("10", $page, $total_page, "?d=".$d."&order_type=".$order_type."&order_pay_type=".$order_pay_type."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

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
.category1 .selectBox-dropdown {width:50px; height:19px;}
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

.date_box .sun1 {font-weight:bold; line-height:16px; font-size:12px; color:#cd8181; font-family:dotum,돋움;}
.date_box .sat1 {font-weight:bold; line-height:16px; font-size:12px; color:#5f92cc; font-family:dotum,돋움;}
.date_box .day1 {font-weight:bold; line-height:16px; font-size:12px; color:#717171; font-family:dotum,돋움;}

.date_box .sun2 {font-weight:bold; line-height:16px; font-size:12px; color:#ffffff; font-family:dotum,돋움;}
.date_box .sat2 {font-weight:bold; line-height:16px; font-size:12px; color:#ffffff; font-family:dotum,돋움;}
.date_box .day2 {font-weight:bold; line-height:16px; font-size:12px; color:#ffffff; font-family:dotum,돋움;}
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

    f.m.value = "check_order";

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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#ebebeb">
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="date_box">
<tr height="25" bgcolor="#ebebeb">
    <td width="20"></td>
    <td><a href="?d=<?=$dateM1?>"><img src="<?=$shop['image_path']?>/adm/day3.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="?d=<?=$dateP1?>"><img src="<?=$shop['image_path']?>/adm/day1.gif" border="0"></a></td>
    <td width="3"></td>
    <td><span class="listname"><?=date("Y년 m월", strtotime($datetime));?></span></td>
    <td width="3"></td>
    <td><a href="?d=<?=$dateN3?>"><img src="<?=$shop['image_path']?>/adm/day2.gif" border="0"></a></td>
    <td width="1"></td>
    <td><a href="?d=<?=$dateM2?>"><img src="<?=$shop['image_path']?>/adm/day4.gif" border="0"></a></td>
    <td width="20"></td>
<?
// 돌리고 돌리고~ 마지막 일에서 이번 달 1일의 요일 값 만큼 더한다.
for ($i=0; $i<($dateN4 + $dateT2 + $dateN5); $i++) {

    // 6일 뺀 날짜부터 돌린다.
    $dateT4 = date("Y-m-d", strtotime($dateT3) + (86400 * $i));

    // 해당 날짜의 요일을 구한다.
    $dateT5 = date("w", strtotime($dateT3) + (86400 * $i));

    // 현재 월과 돌린 월이 일치할 때만.
    if ($dateT1 == substr($dateT4,0,7)) {

        // 지정일
        if ($dateT4 == $datetime) {

            $class = "bgcolor='#027d94'";

            // 0은 일요일.
            if ($dateT5 == '0') {

                // 빨강색
                $dateClassName = "sun2";

            }

            // 6은 토요일
            else if ($dateT5 == '6') {

                // 파랑색
                $dateClassName = "sat2";

            } else {

                // 기타
                $dateClassName = "day2";

            }

        } else {

            $class = "";

            // 0은 일요일.
            if ($dateT5 == '0') {

                // 빨강색
                $dateClassName = "sun1";

            }

            // 6은 토요일
            else if ($dateT5 == '6') {

                // 파랑색
                $dateClassName = "sat1";

            } else {

                // 기타
                $dateClassName = "day1";

            }

        }

        echo "<td width='1' bgcolor='#e4e4e4'></td>";
        echo "<td width='25' align='center' ".$class.">";
        echo "<a href=\"#\" onclick=\"shopMove('order_day_list.php?d=".$dateT4."'); return false;\">";
        echo "<span class='" . $dateClassName . "'>";
        echo substr($dateT4,8,2);
        echo "</span>";
        echo "</a>";
        echo "</td>\n";

    }

}
?>
    <td width="1" bgcolor='#e4e4e4'></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<form method="get" name="formSearch" action="order_day_list.php" onSubmit="return listSearch('');" autocomplete="off">
<input type="hidden" name="d" value="<?=$d?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">주문상태별 보기</td>
    <td width="10"></td>
    <td class="category1">
<select id="order_type" name="order_type" size="1" class="select" onchange="listSearch('sort');">
    <option value="">전체보기</option>
    <option value="100"><?=shop_order_type("100");?></option>
    <option value="101"><?=shop_order_type("101");?></option>
    <option value="200"><?=shop_order_type("200");?></option>
    <option value="201"><?=shop_order_type("201");?></option>
    <option value="202"><?=shop_order_type("202");?></option>
    <option value="900"><?=shop_order_type("900");?></option>
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
    <td width="4"></td>
    <td class="category2">
<select id="order_pay_type" name="order_pay_type" size="1" class="select" onchange="listSearch('sort');">
    <option value="">결제수단 전체</option>
    <option value="1"><?=shop_pay_name("1");?></option>
    <option value="2"><?=shop_pay_name("2");?></option>
    <option value="3"><?=shop_pay_name("3");?></option>
    <option value="4"><?=shop_pay_name("4");?></option>
    <option value="5"><?=shop_pay_name("5");?></option>
    <option value="6"><?=shop_pay_name("6");?></option>
</select>

<script type="text/javascript">
$("#order_pay_type").val("<?=$order_pay_type?>");
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
    <td><a href="./order_day_list.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
    <col width="">
    <col width="1">
    <col width="70">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="138">
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
    <td class="boxtitle">주문상품 (주문옵션)</td>
    <td class="bc1"></td>
    <td class="boxtitle">수량</td>
    <td class="bc1"></td>
    <td class="boxtitle">총 주문금액<br>(결제금액)</td>
    <td class="bc1"></td>
    <td class="boxtitle">주문상태<br>(결제수단)</td>
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
    <col width="">
    <col width="1">
    <col width="70">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="138">
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
    <td colspan="3">
<? if ($list['order_count'] == '1') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td onclick="orderManage('', '<?=$list['order_code']?>'); return false;" class="pointer"><p style="margin-left:15px;"><a href="<?=$shop['path']?>/item.php?id=<?=$list['item_code']?>" target="_blank"><span class="item_title"><?=text($list['item_title'])?></span><? if ($list['option_name']) { ?><span class="option_name"> (옵션 : <?=text($list['option_name'])?>)</span><? } ?></a></p></td>
    <td width="1" class="bc1"></td>
    <td width="70" align="center" class="order_limit"><?=number_format($list['order_limit']);?></td>
</tr>
</table>
<?
} else {

$result2 = sql_query(" select * from $shop[order_table] where order_code = '".$list['order_code']."' order by order_number asc ");
for ($k=0; $row=sql_fetch_array($result2); $k++) {
?>
<? if ($k > '0') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="line2" height="1"></td></tr>
</table>
<? } ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td onclick="orderManage('', '<?=$list['order_code']?>'); return false;" class="pointer"><p style="margin-left:15px;"><a href="<?=$shop['path']?>/item.php?id=<?=$row['item_code']?>" target="_blank"><span class="item_title"><?=text($row['item_title'])?></span><? if ($row['option_name']) { ?><span class="option_name"> (옵션 : <?=text($row['option_name'])?>)</span><? } ?></a></p></td>
    <td width="1" class="bc1"></td>
    <td width="70" align="center" class="order_limit"><?=number_format($row['order_limit']);?></td>
</tr>
</table>
<?
}

}
?>
    </td>
    <td class="bc1"></td>
    <td align="center"><p class="item_money"><?=number_format($list['order_total_item_money']);?></p><p class="order_pay_money" style="margin-top:4px;"><? if ($list['order_payment'] == '1') { echo "미결제"; } else { echo number_format($list['order_pay_money']); } ?></p></td>
    <td class="bc1"></td>
    <td align="center"><p><span class="order_type_<?=$list['order_type']?>"><?=shop_order_type($list['order_type']);?></span></p><p class="order_pay_type<?=$list['order_pay_type']?>" style="margin-top:5px;"><?=shop_pay_name($list['order_pay_type']);?></p></td>
    <td class="bc1"></td>
    <td align="left" class="none">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10"></td>
    <td><a href="#" onclick="orderManage('', '<?=$list['order_code']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_option.gif" border="0"></a></td>
<?
// 취소, 교환, 환불이 완료된 내역이 아닐 때
if ($list['order_cancel'] != '2' && $list['order_exchange'] != '2' && $list['order_refund'] != '2') { ?>
    <td width="4"></td>
    <td>
<?
// 취소접수
if ($list['order_cancel'] == '1') {

    // 취소관리 버튼
    echo "<a href='#' onclick=\"orderManage('cancel', '".$list['order_code']."'); return false;\"><img src='".$shop['image_path']."/adm/list_order_cancel.gif' border='0'></a>";

}

// 교환접수
else if ($list['order_exchange'] == '1') {

    // 취소관리 버튼
    echo "<a href='#' onclick=\"orderManage('exchange', '".$list['order_code']."'); return false;\"><img src='".$shop['image_path']."/adm/list_order_exchange.gif' border='0'></a>";

}

// 환불접수
else if ($list['order_refund'] == '1') {

    // 취소관리 버튼
    echo "<a href='#' onclick=\"orderManage('refund', '".$list['order_code']."'); return false;\"><img src='".$shop['image_path']."/adm/list_order_refund.gif' border='0'></a>";

}

// 미결제, 무통장입금
else if ($list['order_payment'] == '1' && $list['order_pay_type'] == '5') {

    // 입금확인 버튼
    echo "<a href='#' onclick=\"orderManage('bank', '".$list['order_code']."'); return false;\"><img src='".$shop['image_path']."/adm/list_order_bank.gif' border='0'></a>";

}

// 결제완료, 배송준비단계가 아닌 것
else if ($list['order_payment'] == '2' && $list['order_delivery'] == '0') {

    // 배송준비 버튼
    echo "<a href='#' onclick=\"orderManage('prepare', '".$list['order_code']."'); return false;\"><img src='".$shop['image_path']."/adm/list_order_delivery.gif' border='0'></a>";

}

// 결제완료, 배송준비단계
else if ($list['order_payment'] == '2' && $list['order_delivery'] == '1') {

    // 상품발송 버튼
    echo "<a href='#' onclick=\"orderManage('delivery', '".$list['order_code']."'); return false;\"><img src='".$shop['image_path']."/adm/list_order_delivery_ok.gif' border='0'></a>";

} else {

    // pass

}
?>
    </td>
<? } ?>
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
    <td><a href="./order_excel.php?m=order"><img src="<?=$shop['image_path']?>/adm/excel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">선택하신 상품을 위 조건으로 일괄 처리 합니다. (입금확인은 개별처리)</td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/guide_order_all.gif" border="0" usemap="#guide_map"></td>
</tr>
</table>

<map name="guide_map"><area shape="rect" coords="685,8,764,31" href="#"></map>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>