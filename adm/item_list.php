<?php
include_once("./_dmshop.php");
if ($item_icon) { $item_icon = preg_match("/^[0-9]+$/", $item_icon) ? $item_icon : ""; }
if ($category1) { $category1 = preg_match("/^[0-9]+$/", $category1) ? $category1 : ""; }
if ($category2) { $category2 = preg_match("/^[0-9]+$/", $category2) ? $category2 : ""; }
if ($category3) { $category3 = preg_match("/^[0-9]+$/", $category3) ? $category3 : ""; }
if ($category4) { $category4 = preg_match("/^[0-9]+$/", $category4) ? $category4 : ""; }
$top_id = "2";
$left_id = "3";
$menu_id = "100";
$shop['title'] = "전체 상품목록";
include_once("./_top.php");

$colspan = "17";

/*--------------------------------
    ## 분류 ##
--------------------------------*/

// 초기화
$tmp_option1 = "<option value='0'>1단계 분류 선택</option>";
$shopCateInput = "";
$shopCateInputLog = "";
$tmp_code = "0";
$tmp_shopCateInput_value0 = "";

// 분류 데이터
$result = sql_query(" select * from $shop[category_table] order by position asc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 첫번째 분류 옵션
    if ($row['category'] == '1' && $row['code'] == '0') {

        $tmp_option1 .= "<option value='".$row['id']."'>".text($row['subject'])."</option>";
        $tmp_shopCateInput_value0 .= "update:%:".$row['id'].":%:".addslashes($row['subject']).":%:".$row['category'].":%:".$row['code']."|%|";

    }

    // 초기화
    $shopCateInput_value = "";

    // 데이터
    $result2 = sql_query(" select * from $shop[category_table] where code = '".$row['id']."' order by position asc, id asc ");
    for ($k=0; $code=sql_fetch_array($result2); $k++) {

        $shopCateInput_value .= "update:%:".$code['id'].":%:".addslashes($code['subject']).":%:".$code['category'].":%:".$code['code']."|%|";

    }

    // id별 값을 생성
    $shopCateInput .= "shopCateInput('', '".$row['id']."', '".$shopCateInput_value."');";
    $shopCateInputLog .= "shopCateInputLog('', '".$row['id']."', '".$row['log']."');";

}

// 마지막 id 값을 구한다.
$count = sql_fetch(" select * from $shop[category_table] order by id desc ");

// 데이터가 존재하면
if ($count['id']) {

    // 마지막 id 값에 1 더한다.
    $tmp_code = $count['id'] + 1;

} else {

    $tmp_code = "0";

}

/*--------------------------------
    ## 상품 ##
--------------------------------*/

// 검색조건
$sql_search = " where 1 ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

if ($category1) {

    $sql_search .= " and category1 = '".$category1."' ";

}

if ($category2) {

    $sql_search .= " and category2 = '".$category2."' ";

}

if ($category3) {

    $sql_search .= " and category3 = '".$category3."' ";

}

if ($category4) {

    $sql_search .= " and category4 = '".$category4."' ";

}

if ($item_icon) {

    $sql_search .= " and INSTR(item_icon, '|$item_icon|') ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[item_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 20;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?category1=".$category1."&category2=".$category2."&category3=".$category3."&category4=".$category4."&item_icon=".$item_icon."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "datetime desc";

}

$result = sql_query(" select * from $shop[item_table] $sql_search order by $sort limit $from_record, $rows ");

if (!$q) {

    $keyword = "검색어";
    $q = "검색어";

}

$icons = array();
$result2 = sql_query(" select * from $shop[icon_file_table] where view = '1' order by position desc, id asc ");
for ($i=0; $row=sql_fetch_array($result2); $i++) {

    $icons[$i] = $row;

}
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.category .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category .selectBox-dropdown {width:100px; height:19px;}
.category .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.sort .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.sort .selectBox-dropdown {width:110px; height:19px;}
.sort .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.limit .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.limit .selectBox-dropdown {width:35px; height:19px;}
.limit .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.icons .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.icons .selectBox-dropdown {width:100px; height:19px;}
.icons .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.field .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.field .selectBox-dropdown {width:50px; height:19px;}
.field .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".sort select").selectBox();
    $(".limit select").selectBox();
    $(".icons select").selectBox();
    $(".field select").selectBox();
});
</script>

<script type="text/javascript" src="<?=$shop['path']?>/js/category.js"></script>

<script type="text/javascript">
function checkAll(mode)
{

    $('.form_list .chk_id input').attr('checked', mode);

}

function checkConfirm(msg)
{

    var n = $('.form_list .chk_id input:checked').length;

    if (n <= '0') {

        alert(msg + "할 상품을 선택하세요.");
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

    if (!confirm("선택한 상품을 저장 하시겠습니까?")) {

        return false;

    }

    f.action = "./item_list_update.php";
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

    if (!confirm("선택한 상품을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./item_list_update.php";
    f.submit();

}

function listDelete(item_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.item_id.value = item_id;

    if (!confirm("해당 상품을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./item_write_update.php";
    f.submit();

}

function checkExcel()
{

    var msg = "액셀생성";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "check_item";

    if (!confirm("선택한 상품을 액셀생성 하시겠습니까?")) {

        return false;

    }

    f.action = "./item_excel.php";
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
<input type="hidden" name="item_id" value="" />
</form>

<div class="contents_box">
<input type="hidden" id="category" name="category" value="0" />
<input type="hidden" id="code" name="code" />
<input type="hidden" id="tmp_code" name="tmp_code" value="<?=$tmp_code?>" />
<input type="hidden" id="defalt_category" name="defalt_category" value="0" />
<input type="hidden" id="defalt_code1" name="defalt_code1" value="0" />
<input type="hidden" id="defalt_code2" name="defalt_code2" value="" />
<input type="hidden" id="defalt_code3" name="defalt_code3" value="" />
<input type="hidden" id="defalt_code4" name="defalt_code4" value="" />
<input type="hidden" id="defalt_code5" name="defalt_code5" value="" />
<input type="hidden" id="tmp_option" name="tmp_option" value="" />
<input type="hidden" id="code0" name="code0" value="<?=$tmp_shopCateInput_value0?>" />
<input type="hidden" id="tmp_log" name="tmp_log" value="" />
<input type="hidden" id="log0" name="log0" value="" />

<table id="inputCodeAdd" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>
<table id="inputCodeAddKind" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>
<table id="inputCodeAddLog" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>

<input type="hidden" id="subject" name="subject" value="" />
<input type="hidden" id="ch_subject" name="ch_subject" value="" />

<form method="get" name="formSearch" action="item_list.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="category">
<tr>
    <td class="tx1">카테고리별 상품목록</td>
    <td width="10"></td>
    <td><select id="category1" name="category1" size="1" class="select" onclick="shopChange('1', this.value);" onchange="listSearch('sort');"><?=$tmp_option1?></select></td>
    <td width="4"></td>
    <td><select id="category2" name="category2" size="1" class="select" onclick="shopChange('2', this.value);" onchange="listSearch('sort');"><option value="">2단계 분류 선택</option></select></td>
    <td width="4"></td>
    <td><select id="category3" name="category3" size="1" class="select" onclick="shopChange('3', this.value);" onchange="listSearch('sort');"><option value="">3단계 분류 선택</option></select></td>
    <td width="4"></td>
    <td><select id="category4" name="category4" size="1" class="select" onclick="shopChange('4', this.value);" onchange="listSearch('sort');"><option value="">4단계 분류 선택</option></select></td>
</tr>
</table>

<script type="text/javascript">
$(function() { <?=$shopCateInput?><?=$shopCateInputLog?> });
</script>

<script type="text/javascript">
var categoryValue1 = "<?=$category1?>";
var categoryValue2 = "<?=$category2?>";
var categoryValue3 = "<?=$category3?>";
var categoryValue4 = "<?=$category4?>";
</script>

<script type="text/javascript">
$(function() { <? if ($category1) { ?>shopChange('1', categoryValue1);<? } ?><? if ($category2) { ?>shopChange('2', categoryValue2);<? } ?><? if ($category3) { ?>shopChange('3', categoryValue3);<? } ?><? if ($category4) { ?>shopChange('4', categoryValue4);<? } ?> });
</script>

<script type="text/javascript">
$(function() { <? if ($category1) { ?>$("#category1").val(categoryValue1);<? } ?><? if ($category2) { ?>$("#category2").val(categoryValue2);<? } ?><? if ($category3) { ?>$("#category3").val(categoryValue3);<? } ?><? if ($category4) { ?>$("#category4").val(categoryValue4);<? } ?> });
</script>

<script type="text/javascript">$(document).ready( function() { $(".category select").selectBox(); });</script>
    </td>
    <td align="right"><a href="./item_write.php"><img src="<?=$shop['image_path']?>/adm/item_write.gif" border="0"></a></td>
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
    <td class="listname">상품목록</span></td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">상품</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="datetime desc">등록일시 내림차순</option>
    <option value="datetime asc">등록일시 오름차순</option>
    <option value="item_position desc">진열선호도 내림차순</option>
    <option value="item_position asc">진열선호도 오름차순</option>
    <option value="item_money desc">판매가격 내림차순</option>
    <option value="item_money asc">판매가격 오름차순</option>
    <option value="item_cash desc">적립금 내림차순</option>
    <option value="item_cash asc">적립금 오름차순</option>
    <option value="item_title desc">상품명 내림차순</option>
    <option value="item_title asc">상품명 오름차순</option>
    <option value="item_hit desc">조회수 내림차순</option>
    <option value="item_hit asc">조회수 오름차순</option>
    <option value="item_sale desc">판매수량 내림차순</option>
    <option value="item_sale asc">판매수량 오름차순</option>
    <option value="item_reply desc">상품평 내림차순</option>
    <option value="item_reply asc">상품평 오름차순</option>
    <option value="item_qna desc">상품문의 내림차순</option>
    <option value="item_qna asc">상품문의 오름차순</option>
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
    <td width="4"></td>
    <td class="icons">
<select id="item_icon" name="item_icon" class="select" onchange="listSearch('sort');">
    <option value="">아이콘 전체보기</option>
<? for ($i=0; $i<count($icons); $i++) { ?>
    <option value="<?=$icons[$i]['id']?>"><?=text($icons[$i]['title'])?></option>
<? } ?>
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
    <option value="item_title">상품명</option>
    <option value="item_code">상품코드</option>
    <option value="item_money">판매가격</option>
    <option value="item_text">상세정보</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./item_list.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
<? if ($item_icon) { ?>$("#item_icon").val("<?=$item_icon?>");<? } ?>
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
    <col width="100">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
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
<tr height="62" bgcolor="#f5f5f5">
    <td></td>
    <td><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">대표이미지</td>
    <td class="bc1"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td class="boxtitle">분류명</td>
</tr>
<tr height="1">
    <td class="bc1"></td>
</tr>
<tr height="30">
    <td class="boxtitle">상품명</td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td class="boxtitle">판매가격</td>
</tr>
<tr height="1">
    <td class="bc1"></td>
</tr>
<tr height="30">
    <td class="boxtitle">조회수</td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td class="boxtitle">적립금</td>
</tr>
<tr height="1">
    <td class="bc1"></td>
</tr>
<tr height="30">
    <td class="boxtitle">판매수량</td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td class="boxtitle">진열 선호도</td>
</tr>
<tr height="1">
    <td class="bc1"></td>
</tr>
<tr height="30">
    <td class="boxtitle">상품평/문의</td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td class="boxtitle">판매상태</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별설정</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

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

    $thumb = shop_item_thumb($list['id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $shop['image_path']."/adm/noimage.gif"; }
?>
<input type="hidden" name="item_id[<?=$i?>]" value="<?=$list['id']?>" />
<tr height="62">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><div style="width:50px; height:50px; border:2px solid #e4e4e4;"><img src="<?=$thumb?>"></div></td>
    <td class="bc1"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="10"></td>
    <td class="category"><?=$category?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><input type="text" name="item_title[<?=$i?>]" value="<?=text($list['item_title'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
    <td width="10"></td>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=$list['item_code']?>" target="_blank"><img src="<?=$shop['image_path']?>/adm/blank.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td align="center"><input type="text" name="item_money[<?=$i?>]" value="<?=$list['item_money']?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:60px; background-color:#fee9e6;" /></td>
</tr>
<tr height="1">
    <td class="bc1"></td>
</tr>
<tr height="30">
    <td align="center"><span class="item_hit"><?=(int)($list['item_hit'])?></span> <span class="tx1">회</spa></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td align="center"><input type="text" name="item_cash[<?=$i?>]" value="<?=$list['item_cash']?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:60px; background-color:#fdf3e5;" /></td>
</tr>
<tr height="1">
    <td class="bc1"></td>
</tr>
<tr height="30">
    <td align="center"><a href="./order_all_list.php?f=item_code&q=<?=text($list['item_code'])?>"><span class="item_sale"><?=number_format($list['item_sale']);?></span> <span class="tx1">건</spa></a></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td align="center"><input type="text" name="item_position[<?=$i?>]" value="<?=$list['item_position']?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:60px; background-color:#e5f1f4;" /></td>
</tr>
<tr height="1">
    <td class="bc1"></td>
</tr>
<tr height="30">
    <td align="center"><a href="./reply_list.php?f=item_code&q=<?=$list['item_code']?>"><span class="item_reply"><?=(int)($list['item_reply'])?></span> <span class="tx1">건</spa></a><span class="tx1"> / </spa><a href="./qna_list.php?f=item_code&q=<?=$list['item_code']?>"><span class="item_qna"><?=(int)($list['item_qna'])?></span> <span class="tx1">건</spa></a></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="center">
<select id="item_use[<?=$i?>]" name="item_use[<?=$i?>]" class="select">
    <option value="0">판매가능</option>
    <option value="1">일시중지</option>
    <option value="2">품절</option>
    <option value="3">숨김</option>
</select>

<script type="text/javascript">
document.getElementById("item_use[<?=$i?>]").value = "<?=$list['item_use']?>";
</script>
    </td>
    <td class="bc1"></td>
    <td align="right" class="none">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="./item_write.php?m=u&item_id=<?=$list['id']?>"><img src="<?=$shop['image_path']?>/adm/list_config.gif" border="0"></a></td>
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
    <td><a href="#" onclick="checkSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="checkDelete(); return false;"><img src="<?=$shop['image_path']?>/adm/del.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./item_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="checkExcel(); return false;"><img src="<?=$shop['image_path']?>/adm/all_excel.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./item_excel.php?m=item"><img src="<?=$shop['image_path']?>/adm/excel.gif" border="0"></a></td>
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