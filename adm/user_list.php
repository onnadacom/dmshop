<?php
include_once("./_dmshop.php");
if ($date1) { $date1 = trim($date1); $date1 = preg_match("/^[0-9\-]+$/", $date1) ? $date1 : ""; }
if ($date2) { $date2 = trim($date2); $date2 = preg_match("/^[0-9\-]+$/", $date2) ? $date2 : ""; }
if ($user_level) { $user_level = preg_match("/^[a-zA-Z0-9_\-]+$/", $user_level) ? $user_level : ""; }
$top_id = "2";
$left_id = "4";
$menu_id = "400";
$shop['title'] = "전체 회원목록";
include_once("./_top.php");

$colspan = "23";

/*------------------------------
    ## 날짜 ##
------------------------------*/

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

/*------------------------------
    ## 회원 ##
------------------------------*/

// 검색조건
$sql_search = " where 1 ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

if (!$date1 || !$date2) {

    $date1 = $search_date_default1;
    $date2 = $search_date_default2;

}

if ($date1 && $date2) {

    $sql_search .= " and substring(datetime,1,10) >= '".$date1."' and substring(datetime,1,10) <= '".$date2."' ";

}

if ($user_level) {

    // 탈퇴
    if ($user_level == 'leave') {

        $sql_search .= " and user_leave_datetime != '0000-00-00 00:00:00' ";

    }

    // 차단
    else if ($user_level == 'block') {

        $sql_search .= " and user_block_datetime != '0000-00-00 00:00:00' ";

    } else {

        $sql_search .= " and user_level = '".$user_level."' ";

    }

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[user_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 20;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?user_level=".$user_level."&date1=".$date1."&date2=".$date2."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "datetime desc";

}

$result = sql_query(" select * from $shop[user_table] $sql_search order by $sort limit $from_record, $rows ");

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

.sort .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.sort .selectBox-dropdown {width:110px; height:19px;}
.sort .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.limit .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.limit .selectBox-dropdown {width:35px; height:19px;}
.limit .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.field .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.field .selectBox-dropdown {width:50px; height:19px;}
.field .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".category1 select").selectBox();
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

function checkSave()
{

    var msg = "저장";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "u";

    if (!confirm("선택한 내역을 변경하시겠습니까?")) {

        return false;

    }

    f.action = "./user_list_update.php";
    f.submit();

}

function checkDelete()
{

    var msg = "삭제";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "alld";

    if (!confirm("선택한 내역을 삭제 하시겠습니까?\n\n삭제하시면 아이디, 성명이 남고 기타 정보는 모두 삭제됩니다.")) {

        return false;

    }

    f.action = "./user_list_update.php";
    f.submit();

}

function checkExcel()
{

    var msg = "액셀생성";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "check_user";

    if (!confirm("선택한 내역을 액셀생성 하시겠습니까?")) {

        return false;

    }

    f.action = "./user_excel.php";
    f.submit();

}

function listDelete(user_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.user_id.value = user_id;

    if (!confirm("해당 회원을 삭제하시겠습니까?\n\n삭제하시면 아이디, 성명이 남고 기타 정보는 모두 삭제됩니다.")) {

        return false;

    }

    f.action = "./user_list_update.php";
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

<form method="post" name="formUpdate">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="user_id" value="" />
</form>

<div class="contents_box">
<form method="get" name="formSearch" action="user_list.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">회원상태별 보기</td>
    <td width="10"></td>
    <td class="category1">
<select id="user_level" name="user_level" size="1" class="select" onchange="listSearch('sort');">
    <option value="">전체보기</option>
<?
// 1은 비회원
$user_level_options = "";
$result2 = sql_query(" select * from $shop[user_level_table] where level >= '2' order by level asc ");
for ($i=0; $row=sql_fetch_array($result2); $i++) {

    echo "<option value='".$row['level']."'>".text($row['name'])."</option>";

    $user_level_options .= "<option value='".$row['level']."'>".text($row['name'])."</option>";

}
?>
    <option value="leave">탈퇴한 회원</option>
<?/*    <option value="block">차단된 회원</option>*/?>
</select>

<script type="text/javascript">
$("#user_level").val("<?=$user_level?>");
</script>
    </td>
    <td width="20"></td>
    <td class="tx1">가입기간별 조회 :</td>
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
    <td width="123" align="right"><a href="./user_regist.php"><img src="<?=$shop['image_path']?>/adm/user_regist.gif" border="0"></a></td>
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
    <td class="listname">회원목록</span></td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">건</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="datetime desc">가입일시 내림차순</option>
    <option value="datetime asc">가입일시 오름차순</option>
    <option value="user_name asc">성명 내림차순</option>
    <option value="user_name desc">성명 오름차순</option>
    <option value="user_id asc">아이디 내림차순</option>
    <option value="user_id desc">아이디 오름차순</option>
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
    <option value="user_name">성명</option>
    <option value="user_id">아이디</option>
    <option value="user_hp">휴대폰</option>
    <option value="user_tel">일반전화</option>
    <option value="user_addr1">주소</option>
    <option value="user_ip">가입IP</option>
    <option value="user_login_ip">로그인IP</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./user_list.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
    <col width="25">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="70">
    <col width="1">
    <col width="70">
    <col width="1">
    <col width="70">
    <col width="1">
    <col width="122">
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
    <td class="boxtitle">가입일시</td>
    <td class="bc1"></td>
    <td class="boxtitle">아이디</td>
    <td class="bc1"></td>
    <td class="boxtitle">성명</td>
    <td class="bc1"></td>
    <td class="boxtitle">등급</td>
    <td class="bc1"></td>
    <td class="boxtitle">주소/휴대폰/일반전화</td>
    <td class="bc1"></td>
    <td class="boxtitle">구매횟수/금액</td>
    <td class="bc1"></td>
    <td class="boxtitle">적립금</td>
    <td class="bc1"></td>
    <td class="boxtitle">보유쿠폰</td>
    <td class="bc1"></td>
    <td class="boxtitle">수신동의</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별설정</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    // 해당 회원의 구매횟수 및 실결제총액 (배송완료인 주문내역을 뽑는다)
    $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where user_id = '".addslashes($list['user_id'])."' and order_type in ('202','900')) as x ");

    // userview
    $userview = shop_userview($list['user_id'], $list['user_name'], $list['user_email'], $list['user_homepage'], $list['user_name']);
?>
<input type="hidden" name="user_id[<?=$i?>]" value="<?=$list['user_id']?>" />
<tr height="50">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="datetime1"><?=date("Y-m-d", strtotime($list['datetime']));?></p><p class="datetime2"><?=date("H시 : i분", strtotime($list['datetime']));?></p></td>
    <td class="bc1"></td>
    <td align="center" class="user_id"><?=shop_user_id($list['user_id'], $list['user_leave_datetime']);?></td>
    <td class="bc1"></td>
    <td align="center" class="user_name"><?=$userview?></td>
    <td class="bc1"></td>
    <td align="center">
<? if ($list['user_level'] >= '2') { ?>
<select id="user_level[<?=$i?>]" name="user_level[<?=$i?>]" class="select"><?=$user_level_options?></select>

<script type="text/javascript">
document.getElementById("user_level[<?=$i?>]").value = "<?=$list['user_level']?>";
</script>
<? } else { ?>
<span class="tx2"><?=shop_user_level($list['user_level']);?></span>
<? } ?>
    </td>
    <td class="bc1"></td>
    <td><p class="user_addr" style="margin-left:10px;"><?=text($list['user_addr1'])?></p><p class="user_tel" style="margin-left:10px;"><?=text($list['user_tel'])?><? if ($list['user_tel'] && $list['user_hp']) { echo " / "; } ?><?=text($list['user_hp'])?></p></td>
    <td class="bc1"></td>
    <td align="center"><p><span class="order_total_count"><?=number_format($order['total_order_count']);?></span><span class="tx1"> 회</span></p><p><span class="order_total_money"><?=number_format($order['total_order_pay_money']);?></span><span class="tx1"> 원</span></p></td>
    <td class="bc1"></td>
    <td align="center"><a href="./cash_list.php?f=user_id&q=<?=text($list['user_id'])?>" target="_blank"><span class="user_cash"><?=number_format($list['user_cash']);?></span><span class="tx1"> 원</span></a></td>
    <td class="bc1"></td>
    <td align="center"><a href="./coupon_make_list.php?f=user_id&q=<?=text($list['user_id'])?>" target="_blank"><span class="coupon_down"><?=number_format(shop_coupon_user_count($list['user_id']));?></span><span class="tx1"> 장</span></a></td>
    <td class="bc1"></td>
    <td align="center">
<? if ($list['user_sms'] || $list['user_mailing']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($list['user_sms']) { ?>
    <td><a href="#" onclick="orderPopupSms('user_id=<?=text($list['user_id'])?>'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_hp.gif" border="0"></a></td>
<? } ?>
<? if ($list['user_mailing']) { ?>
    <td width="10"></td>
    <td><a href="#" onclick="orderPopupEmail('user_id=<?=text($list['user_id'])?>'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_tel.gif" border="0"></a></td>
<? } ?>
</tr>
</table>
<? } ?>
    </td>
    <td class="bc1"></td>
    <td align="right" class="none">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="./user_regist.php?m=u&user_id=<?=text($list['user_id'])?>"><img src="<?=$shop['image_path']?>/adm/list_config.gif" border="0"></a></td>
    <td width="5"></td>
    <td align="center"><a href="#" onclick="listDelete('<?=text($list['user_id'])?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_delete.gif" border="0"></a></td>
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
    <td><a href="#" onclick="checkSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="checkDelete(); return false;"><img src="<?=$shop['image_path']?>/adm/del.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="./user_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="checkExcel(); return false;"><img src="<?=$shop['image_path']?>/adm/all_excel.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./user_excel.php?m=user"><img src="<?=$shop['image_path']?>/adm/user_excel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">선택하신 회원을 위 조건으로 일괄 처리 합니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>