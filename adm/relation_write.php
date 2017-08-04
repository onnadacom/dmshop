<?php
include_once("./_dmshop.php");
if ($item_id) { $item_id = preg_match("/^[0-9]+$/", $item_id) ? $item_id : ""; }
if ($category1) { $category1 = preg_match("/^[0-9]+$/", $category1) ? $category1 : ""; }
if ($category2) { $category2 = preg_match("/^[0-9]+$/", $category2) ? $category2 : ""; }
if ($category3) { $category3 = preg_match("/^[0-9]+$/", $category3) ? $category3 : ""; }
if ($category4) { $category4 = preg_match("/^[0-9]+$/", $category4) ? $category4 : ""; }
$shop['title'] = "관련상품 추가";
include_once("$shop[path]/shop.top.php");

if (!$item_id) {

    alert_close("상품이 삭제되었거나 존재하지 않습니다.");

}

// 상품
$dmshop_item = shop_item($item_id);

if (!$dmshop_item['id']) {

    alert_close("상품이 삭제되었거나 존재하지 않습니다.");

}

$colspan = "11";

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

$shop_pages = shop_paging_v0("10", $page, $total_page, "?item_id=".$item_id."&category1=".$category1."&category2=".$category2."&category3=".$category3."&category4=".$category4."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "datetime desc";

}

$result = sql_query(" select * from $shop[item_table] $sql_search order by $sort limit $from_record, $rows ");
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}

.category .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category .selectBox-dropdown {width:100px; height:19px;}
.category .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

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
    $(".sort select").selectBox();
    $(".limit select").selectBox();
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

    var msg = "추가";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "all";

    if (!confirm("선택한 상품을 관련상품에 추가 하시겠습니까?")) {

        return false;

    }

    f.action = "./relation_write_update.php";
    f.submit();

}

function listAdd(item_add_id)
{

    var f = document.formUpdate;

    f.m.value = "";
    f.item_add_id.value = item_add_id;

    if (!confirm("해당 상품을 관련상품에 추가 하시겠습니까?")) {

        return false;

    }

    f.action = "./relation_write_update.php";
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
<input type="hidden" name="item_id" value="<?=$item_id?>" />
<input type="hidden" name="item_add_id" value="" />
</form>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d7d7d8" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#eeeeef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="title_bg2">
<tr>
    <td width="26" align="center"><img src="<?=$shop['image_path']?>/adm/position_arrow.gif"></td>
    <td><span class="bigtitle2">[<?=text($dmshop_item['item_title'])?>]</span> <span class="bigtitle">관련상품 추가</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#c8cdd2" class="none">&nbsp;</td></tr>
</table>

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

<form method="get" name="formSearch" action="relation_write.php" onSubmit="return listSearch('');" autocomplete="off">
<input type="hidden" name="item_id" value="<?=$item_id?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="category">
<tr>
    <td class="tx1">분류별 상품목록</td>
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
    <option value="item_title desc">상품명 내림차순</option>
    <option value="item_title asc">상품명 오름차순</option>
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
    <td width="320" align="right">
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
    <td><a href="./relation_write.php?item_id=<?=$item_id?>"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
<input type="hidden" name="item_id" value="<?=$item_id?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="form_list">
<colgroup>
    <col width="20">
    <col width="35">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="132">
    <col width="20">
</colgroup>
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td align="center"><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">대표이미지</td>
    <td class="bc1"></td>
    <td class="boxtitle">상품/분류명</td>
    <td class="bc1"></td>
    <td class="boxtitle">판매가격</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별추가</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    // 관련 상품
    $dmshop_relation = shop_relation_add($item_id, $list['id']);

    $relation_check = false;

    if ($dmshop_relation['id']) {

        $relation_check = true;

    }

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
<input type="hidden" name="item_add_id[<?=$i?>]" value="<?=$list['id']?>" />
<tr height="62">
    <td></td>
    <td align="center" class="chk_id"><? if ($relation_check) { ?><img src="<?=$shop['image_path']?>/adm/check2.gif"><? } else { ?><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /><? } ?></td>
    <td class="bc1"></td>
    <td align="center"><div style="width:50px; height:50px; border:2px solid #e4e4e4;"><img src="<?=$thumb?>"></div></td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="category"><?=$category?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="item_title"><?=text($list['item_title'])?></td>
    <td width="10"></td>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=$list['item_code']?>" target="_blank"><img src="<?=$shop['image_path']?>/adm/blank.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="center" class="item_money"><?=number_format($list['item_money']);?></td>
    <td class="bc1"></td>
    <td align="center" class="check_add"><? if ($relation_check) { ?>등록중<? } else { ?><a href="#" onclick="listAdd('<?=$list['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_add.gif" border="0"></a><? } ?></td>
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
    <td><a href="#" onclick="checkSave(); return false;"><img src="<?=$shop['image_path']?>/adm/select_add.gif" border="0" /></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">체크박스상 선택된 모든상품이 관련상품으로 추가 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>