<?php
include_once("./_dmshop.php");
if ($date1) { $date1 = trim($date1); $date1 = preg_match("/^[0-9\-]+$/", $date1) ? $date1 : ""; }
if ($date2) { $date2 = trim($date2); $date2 = preg_match("/^[0-9\-]+$/", $date2) ? $date2 : ""; }
if ($hour) { $hour = preg_match("/^[0-9]+$/", $hour) ? $hour : ""; }
if ($week) { $week = preg_match("/^[0-9]+$/", $week) ? $week : ""; }
$top_id = "2";
$left_id = "7";
$menu_id = "101";
$shop['title'] = "개별 방문기록";
include_once("./_top.php");

$colspan = "17";

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
    ## 방문기록 ##
------------------------------*/

// 검색조건
$sql_search = " where vi_first = '1' ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

if (!$date1 || !$date2) {

    $date1 = $shop['time_ymd'];
    $date2 = $search_date_default2;

}

if ($date1 && $date2) {

    $sql_search .= " and substring(vi_datetime,1,10) >= '".$date1."' and substring(vi_datetime,1,10) <= '".$date2."' ";

}

if ($hour) {

    $sql_search .= " and substring(vi_datetime,12,2) = '".$hour."' ";

}

if ($week || $week == '0') {

    $sql_search .= " and dayofweek(vi_datetime) = '".(int)($week + 1)."' ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[visit_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 20;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?hour=".$hour."&week=".$week."&date1=".$date1."&date2=".$date2."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "vi_datetime desc";

}

$result = sql_query(" select * from $shop[visit_table] $sql_search order by $sort limit $from_record, $rows ");

if (!$q) {

    $keyword = "검색어";
    $q = "검색어";

}
?>
<style type="text/css">
.contents_box {min-width:1100px;}
</style>

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

    f.m.value = "check_delete";

    if (!confirm("선택한 내역을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./reporting_visit_list_update.php";
    f.submit();

}

function checkExcel()
{

    var msg = "액셀생성";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "check_visit";

    if (!confirm("선택한 내역을 액셀생성 하시겠습니까?")) {

        return false;

    }

    f.action = "./reporting_visit_list_excel.php";
    f.submit();

}

function listDelete(visit_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.visit_id.value = visit_id;

    if (!confirm("해당 내역을 삭제하시겠습니까?")) {

        return false;

    }

    f.action = "./reporting_visit_list_update.php";
    f.submit();

}

function visitTruncate()
{

    var f = document.formUpdate;

    f.m.value = "truncate";

    if (!confirm("방문자 데이터를 초기화 하시겠습니까?")) {

        return false;

    }

    f.action = "./reporting_visit_list_update.php";
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
<input type="hidden" name="visit_id" value="" />
</form>

<div class="contents_box">
<form method="get" name="formSearch" action="reporting_visit_list.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
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
    <td class="listname">방문 기록</span></td>
    <td width="20"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">건</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td>
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="vi_datetime desc">방문일시 내림차순</option>
    <option value="vi_datetime asc">방문일시 오름차순</option>
</select>
    </td>
    <td width="4"></td>
    <td>
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
    <td>
<select id="f" name="f" class="select">
    <option value="vi_keyword">키워드</option>
    <option value="vi_host">도메인</option>
    <option value="vi_referer">유입경로</option>
    <option value="vi_os">운영체제</option>
    <option value="vi_resolution">해상도</option>
    <option value="vi_browser">브라우저</option>
    <option value="vi_ip">아이피</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover=" keywordOver();" onFocus="shopInfocus1(this); keywordOver();" onBlur="shopOutfocus1(this);" class="input" style="width:110px;" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./reporting_visit_list.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
    <col width="120">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="150">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="100">
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
    <td></td>
</tr>
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td align="center"><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">방문일시</td>
    <td class="bc1"></td>
    <td class="boxtitle">아이피</td>
    <td class="bc1"></td>
    <td class="boxtitle">유입경로</td>
    <td class="bc1"></td>
    <td class="boxtitle">키워드</td>
    <td class="bc1"></td>
    <td class="boxtitle">브라우져</td>
    <td class="bc1"></td>
    <td class="boxtitle">운영체제</td>
    <td class="bc1"></td>
    <td class="boxtitle">모니터 해상도</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    if (shop_is_utf8(urldecode($list['vi_referer']))) { $vi_referer = urldecode($list['vi_referer']); } else { $vi_referer = mb_convert_encoding(urldecode($list['vi_referer']), 'UTF-8', 'CP949'); }
?>
<input type="hidden" name="visit_id[<?=$i?>]" value="<?=$list['id']?>" />
<tr height="40">
    <td></td>
    <td align="center" class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="datetime1"><?=date("Y-m-d", strtotime($list['vi_datetime']));?> <b>(<?=shop_week(date("w", strtotime($list['vi_datetime'])));?>)</b></p><p class="tx1"><?=date("H시 : i분 : s초", strtotime($list['vi_datetime']));?></p></td>
    <td class="bc1"></td>
    <td align="center"><a href="?f=vi_ip&q=<?=text($list['vi_ip'])?>" class="tx2 underline"><?=text($list['vi_ip'])?></a></td>
    <td class="bc1"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;">
<tr height="40">
    <td width="60" class="tx1" align="center"><?=shop_visit_host_name($list['vi_host']);?></td>
    <td width="1" class="bc1"></td>
    <td width="10"></td>
    <td><nobr style="display:block; overflow:hidden; width:100%; text-overflow:ellipsis;" title="<?=text($vi_referer);?>"><a href="<?=text($list['vi_referer']);?>" class="tx2 underline" target="_blank"><?=text($vi_referer);?></a></nobr></td>
    <td width="10"></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="center"><span class="tx2"><?=text($list['vi_keyword']);?></td>
    <td class="bc1"></td>
    <td align="center"><span class="tx2"><?=text($list['vi_browser']);?></span></td>
    <td class="bc1"></td>
    <td align="center"><span class="tx2"><?=text($list['vi_os']);?></span></td>
    <td class="bc1"></td>
    <td align="center"><span class="tx2"><?=text($list['vi_resolution']);?></span></td>
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
    <td><a href="#" onclick="checkDelete(); return false;"><img src="<?=$shop['image_path']?>/adm/del.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="visitTruncate(); return false"><img src="<?=$shop['image_path']?>/adm/truncate.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="checkExcel(); return false;"><img src="<?=$shop['image_path']?>/adm/all_excel.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./reporting_visit_list_excel.php?m=visit"><img src="<?=$shop['image_path']?>/adm/visit_excel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">선택하신 상품을 위 조건으로 일괄 처리 합니다. 초기화 시, 모든 방문기록을 삭제 합니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>