<?php
include_once("./_dmshop.php");
if ($date1) { $date1 = trim($date1); $date1 = preg_match("/^[0-9\-]+$/", $date1) ? $date1 : ""; }
if ($date2) { $date2 = trim($date2); $date2 = preg_match("/^[0-9\-]+$/", $date2) ? $date2 : ""; }
if ($category) { $category = preg_match("/^[0-9]+$/", $category) ? $category : ""; }
if ($qna_category) { $qna_category = preg_match("/^[가-힣a-zA-Z0-9_\-%\.,\/\& ]+$/", $qna_category) ? $qna_category : ""; }
if ($qna_reply) { $qna_reply = preg_match("/^[0-9]+$/", $qna_reply) ? $qna_reply : ""; }
$top_id = "2";
$left_id = "4";
$menu_id = "101";
$shop['title'] = "상품문의 내역";
include_once("./_top.php");

$colspan = "22";

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
$sql_search = " where id = qna_id ";

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

if ($category) {

    $sql_search .= " and (category1 = '".$category."' or category2 = '".$category."' or category3 = '".$category."' or category4 = '".$category."') ";

}

if ($qna_category) {

    $sql_search .= " and qna_category = '".$qna_category."' ";

}

if ($qna_reply) {

    if ($qna_reply == '1') {

        $sql_search .= " and qna_view = '0' ";

    }

    if ($qna_reply == '2') {

        $sql_search .= " and qna_count = '0' ";

    }

    if ($qna_reply == '3') {

        $sql_search .= " and (qna_view = '0' or qna_count = '0') ";

    }

    if ($qna_reply == '4') {

        $sql_search .= " and qna_count = '1' ";

    }

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[qna_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 20;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?category=".$category."&qna_category=".$qna_category."&qna_reply=".$qna_reply."&date1=".$date1."&date2=".$date2."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "datetime desc";

}

$result = sql_query(" select * from $shop[qna_table] $sql_search order by $sort limit $from_record, $rows ");

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
.category2 .selectBox-dropdown {width:80px; height:19px;}
.category2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.category3 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category3 .selectBox-dropdown {width:80px; height:19px;}
.category3 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.sort .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.sort .selectBox-dropdown {width:110px; height:19px;}
.sort .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.limit .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.limit .selectBox-dropdown {width:35px; height:19px;}
.limit .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.field .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.field .selectBox-dropdown {width:60px; height:19px;}
.field .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".category1 select").selectBox();
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

    if (!confirm("선택한 내역을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./qna_list_update.php";
    f.submit();

}

function listDelete(qna_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.qna_id.value = qna_id;

    if (!confirm("해당 내역을 삭제하시겠습니까?")) {

        return false;

    }

    f.action = "./qna_list_update.php";
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
<input type="hidden" name="qna_id" value="" />
</form>

<div class="contents_box">
<form method="get" name="formSearch" action="qna_list.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">조건별 보기</td>
    <td width="10"></td>
    <td class="category1">
<select id="category" name="category" class="select" onchange="listSearch('sort');">
    <option value="">카테고리 전체</option>
<?
// 숨김은 제외
$result2 = sql_query(" select * from $shop[category_table] where view = '1' order by category asc, position asc, id asc ");
for ($i=0; $row=sql_fetch_array($result2); $i++) {

    echo "<option value='".$row['id']."'>".text($row['subject'])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#category").val("<?=$category?>");
</script>
    </td>
    <td width="4"></td>
    <td class="category2">
<select id="qna_category" name="qna_category" class="select" onchange="listSearch('sort');">
    <option value="">문의유형 선택</option>
    <option value="가격">가격</option>
    <option value="배송">배송</option>
    <option value="사이즈">사이즈</option>
    <option value="색상">색상</option>
    <option value="성능/기능">성능/기능</option>
    <option value="요구사항변경">요구사항변경</option>
    <option value="기타">기타</option>
</select>

<script type="text/javascript">
document.getElementById("qna_category").value = "<?=text($qna_category)?>";
</script>
    </td>
    <td width="4"></td>
    <td class="category3">
<select id="qna_reply" name="qna_reply" class="select" onchange="listSearch('sort');">
    <option value="">답변여부 전체</option>
    <option value="1">미열람</option>
    <option value="2">미답변</option>
    <option value="3">미열람 + 미답변</option>
    <option value="4">답변완료</option>
</select>

<script type="text/javascript">
$("#qna_reply").val("<?=$qna_reply?>");
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
    <td class="listname">접수내역</span></td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">건</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="datetime desc">작성일시 내림차순</option>
    <option value="datetime asc">작성일시 오름차순</option>
    <option value="qna_name asc">작성자 내림차순</option>
    <option value="qna_name desc">작성자 오름차순</option>
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
    <option value="qna_title">상품평 제목</option>
    <option value="qna_content">상품평 내용</option>
    <option value="qna_name">작성자명</option>
    <option value="user_id">아이디</option>
    <option value="item_code">상품코드</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./qna_list.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
    <col width="80">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="100">
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
    <td></td>
</tr>
<tr height="50" bgcolor="#f5f5f5">
    <td></td>
    <td align="center"><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">작성일시</td>
    <td class="bc1"></td>
    <td class="boxtitle">아이디</td>
    <td class="bc1"></td>
    <td class="boxtitle">작성자</td>
    <td class="bc1"></td>
    <td class="boxtitle">문의유형</td>
    <td class="bc1"></td>
    <td class="boxtitle">카테고리 / 상품명 / 제목</td>
    <td class="bc1"></td>
    <td class="boxtitle">답변여부</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별설정</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    $dmshop_item = shop_item($list['item_id']);

    $category = "";

    if ($list['category1']) {

        $category .= " > <a href='".$shop['path']."/list.php?ct_id=".$list['category1']."' target='_blank' class='category'>".shop_category_name($list['category1'])."</a>";

    }

    if ($list['category2']) {

        $category .= " > <a href='".$shop['path']."/list.php?ct_id=".$list['category2']."' target='_blank' class='category'>".shop_category_name($list['category2'])."</a>";

    }

    if ($list['category3']) {

        $category .= " > <a href='".$shop['path']."/list.php?ct_id=".$list['category3']."' target='_blank' class='category'>".shop_category_name($list['category3'])."</a>";

    }

    if ($list['category4']) {

        $category .= " > <a href='".$shop['path']."/list.php?ct_id=".$list['category4']."' target='_blank' class='category'>".shop_category_name($list['category4'])."</a>";

    }

    if ($category) {

        $category = substr($category, 3);

    }

    // user
    $user = shop_user($list['user_id']);

    // userview
    $userview = shop_userview($list['user_id'], $list['user_name'], $list['user_email'], $list['user_homepage'], $list['qna_name']);
?>
<input type="hidden" name="qna_id[<?=$i?>]" value="<?=$list['id']?>" />
<tr height="50">
    <td></td>
    <td align="center" class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="datetime1"><?=date("Y-m-d", strtotime($list['datetime']));?></p><p class="datetime2"><?=date("H시 : i분", strtotime($list['datetime']));?></p></td>
    <td class="bc1"></td>
    <td align="center" class="user_id"><?=shop_user_id($user['user_id'], $user['user_leave_datetime']);?></td>
    <td class="bc1"></td>
    <td align="center" class="user_name"><?=$userview?></td>
    <td class="bc1"></td>
    <td align="center" class="qna_category"><?=text($list['qna_category'])?></td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="category"><?=$category?></td>
    <td width="10"></td>
    <td class="item_title"><?=text($dmshop_item['item_title'])?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
<tr>
    <td width="10"></td>
    <td class="qna_title"><?=text($list['qna_title']);?></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="center">
<?
if ($list['qna_count']) {

    $dmshop_qna_reply = shop_qna_reply($list['qna_id']);

    echo "<p class='datetime1'>".date("Y-m-d", strtotime($dmshop_qna_reply['datetime']))."</p><p class='datetime2'>".date("H시 : i분", strtotime($dmshop_qna_reply['datetime']))."</p>";

}

else if ($list['qna_view']) {

    echo "<span class='no_reply'>미답변</span>";

} else {

    echo "<span class='no_read'>미열람</span>";

}
?>
    </td>
    <td class="bc1"></td>
    <td align="right" class="none">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($list['qna_count']) { ?>
    <td><a href="#" onclick="qnaPopupView('<?=$list['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_read.gif" border="0"></a></td>
<? } else { ?>
    <td><a href="#" onclick="qnaPopupWrite('<?=$list['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_reply.gif" border="0"></a></td>
<? } ?>
    <td width="4"></td>
    <td><a href="#" onclick="listDelete('<?=$list['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_delete.gif" border="0"></a></td>
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
    <td><a href="#" onclick="checkDelete(); return false;"><img src="<?=$shop['image_path']?>/adm/del.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">선택하신 상품평을 삭제 합니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>