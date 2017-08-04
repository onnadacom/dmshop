<?php
include_once("./_dmshop.php");
if ($display_id) { $display_id = preg_match("/^[0-9]+$/", $display_id) ? $display_id : ""; }
if ($display_type) { $display_type = preg_match("/^[0-9]+$/", $display_type) ? $display_type : ""; }
if ($display_list) { $display_list = preg_match("/^[0-9]+$/", $display_list) ? $display_list : ""; }
if ($category1) { $category1 = preg_match("/^[0-9]+$/", $category1) ? $category1 : ""; }
if ($category2) { $category2 = preg_match("/^[0-9]+$/", $category2) ? $category2 : ""; }
if ($category3) { $category3 = preg_match("/^[0-9]+$/", $category3) ? $category3 : ""; }
if ($category4) { $category4 = preg_match("/^[0-9]+$/", $category4) ? $category4 : ""; }

$shop['title'] = "디스플레이 박스 - 상품선택";
include_once("$shop[path]/shop.top.php");

if (!$display_id || !$display_type || !$display_list) {

    alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

$colspan = "11";

/*------------------------------
    ## 분류 ##
------------------------------*/

// 초기화
$tmp_option1 = "<option value='0'>1단계 분류 선택</option>";
$shopCateInput = "";
$shopCateInputLog = "";
$tmp_code = "0";
$tmp_shopCateInput_value0 = "";

// 분류 데이터
$result = sql_query(" select * from $shop[category_table] order by position asc, id asc ");
for ($i=0; $data=sql_fetch_array($result); $i++) {

    // 첫번째 분류 옵션
    if ($data['category'] == '1' && $data['code'] == '0') {

        $tmp_option1 .= "<option value='".$data['id']."'>".text($data['subject'])."</option>";
        $tmp_shopCateInput_value0 .= "update:%:".$data['id'].":%:".addslashes($data['subject']).":%:".$data['category'].":%:".$data['code']."|%|";

    }

    // 초기화
    $shopCateInput_value = "";

    // 데이터
    $result2 = sql_query(" select * from $shop[category_table] where code = '$data[id]' order by position asc, id asc ");
    for ($k=0; $code=sql_fetch_array($result2); $k++) {

        $shopCateInput_value .= "update:%:".$code['id'].":%:".addslashes($code['subject']).":%:".$code['category'].":%:".$code['code']."|%|";

    }

    // id별 값을 생성
    $shopCateInput .= "shopCateInput('', '{$data['id']}', '{$shopCateInput_value}');\n";
    $shopCateInputLog .= "shopCateInputLog('', '{$data['id']}', '{$data['log']}');\n";

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


$sql_search = " ";

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

$shop_pages = shop_paging_v0("10", $page, $total_page, "?display_id=".$display_id."&display_type=".$display_type."&display_list=".$display_list."&category1=".$category1."&category2=".$category2."&category3=".$category3."&category4=".$category4."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "item_position desc, datetime desc";

}

$result = sql_query(" select * from $shop[item_table] $sql_search order by $sort limit $from_record, $rows ");
?>

<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}
</style>

<script type="text/javascript" src="<?=$shop['path']?>/js/category.js"></script>

<script type="text/javascript">
function checkAll(sw)
{

    var f = document.formList;

    for (var i=0; i<f.length; i++) {

        if (f.elements[i].name == "chk_id[]") {

            f.elements[i].checked = sw;

        }

    }

}

function checkConfirm(str)
{

    var f = document.formList;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {

        if (f.elements[i].name == "chk_id[]" && f.elements[i].checked) {

            chk_count++;

        }

    }

    if (!chk_count) {

        alert(str + "할 상품을 선택하세요.");
        return false;

    }

    return true;

}

function checkSave()
{

    str = "추가";
    if (!checkConfirm(str)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "all";

    if (!confirm("선택한 상품을 추가 하시겠습니까?")) {

        return false;

    }

    f.action = "./design_main_display_item_update.php";
    f.submit();

}

function listAdd(item_id)
{

    var f = document.formUpdate;

    f.m.value = "";
    f.item_id.value = item_id;

    if (!confirm("해당 상품을 전시항목에 추가 하시겠습니까?")) {

        return false;

    }

    f.action = "./design_main_display_item_update.php";
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
<input type="hidden" name="display_id" value="<?=$display_id?>" />
<input type="hidden" name="display_type" value="<?=$display_type?>" />
<input type="hidden" name="display_list" value="<?=$display_list?>" />
<input type="hidden" name="item_id" value="" />
</form>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d7d7d8" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#eeeeef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="title_bg2">
<tr>
    <td width="26" align="center"><img src="<?=$shop['image_path']?>/adm/position_arrow.gif"></td>
    <td><span class="bigtitle">디스플레이 박스 - 상품선택</span></td>
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

<form method="get" name="formSearch" action="design_main_display_item.php" onSubmit="return listSearch('');">
<input type="hidden" name="display_id" value="<?=$display_id?>" />
<input type="hidden" name="display_type" value="<?=$display_type?>" />
<input type="hidden" name="display_list" value="<?=$display_list?>" />
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
    <td width="20"></td>
    <td><span class="tx1 up2">총</span> <span class="totalnum up2" id="total_count"><?=(int)($total_count);?></span> <span class="tx1 up2">상품</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td>
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="datetime desc">최근 등록한 상품</option>
    <option value="datetime asc">오래 등록한 상품</option>
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
    <td width="300" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="f" name="f" class="select">
    <option value="item_title">상품명</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover=" keywordOver();" onFocus="shopInfocus1(this); keywordOver();" onBlur="shopOutfocus1(this);" class="input" style="width:110px;" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./design_main_display_item.php?display_id=<?=$display_id?>&display_type=<?=$display_type?>&display_list=<?=$display_list?>"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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

<form method="post" name="formList">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="display_id" value="<?=$display_id?>" />
<input type="hidden" name="display_type" value="<?=$display_type?>" />
<input type="hidden" name="display_list" value="<?=$display_list?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="30">
    <col width="25">
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
    <td></td>
</tr>
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
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

    // 기획전
    $di = sql_fetch(" select * from $shop[display_item_table] where display_id = '".$display_id."' and display_type = '".$display_type."' and display_list = '".$display_list."' and item_id = '".$list['id']."' ");

    $display_check = false;

    if ($di['id']) {

        $display_check = true;

    }

    $category = "";

    if ($list['category1']) {
    
        $category .= " > ".shop_category_name($list['category1']);
    
    }
    
    if ($list['category2']) {
    
        $category .= " > ".shop_category_name($list['category2']);
    
    }
    
    if ($list['category3']) {
    
        $category .= " > ".shop_category_name($list['category3']);
    
    }
    
    if ($list['category4']) {
    
        $category .= " > ".shop_category_name($list['category4']);
    
    }
    
    if ($category) {
    
        $category = substr($category, 3);
    
    }
?>
<input type="hidden" name="item_id[<?=$i?>]" value="<?=$list['id']?>" />
<tr height="62">
    <td></td>
    <td><? if ($display_check) { ?><img src="<?=$shop['image_path']?>/adm/check2.gif"><? } else { ?><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /><? } ?></td>
    <td class="bc1"></td>
    <td align="center"><div style="width:50px; height:50px; border:2px solid #e4e4e4;"><img src="<?=shop_item_file_path($list['id'], "default");?>" width="50" height="50"></div></td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="item_title"><?=text($list['item_title'])?></td>
    <td width="10"></td>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=text($list['item_code'])?>" target="_blank"><img src="<?=$shop['image_path']?>/adm/blank.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="category"><?=text($category)?></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="center" class="item_money"><?=number_format($list['item_money']);?></td>
    <td class="bc1"></td>
    <td align="center" class="check_add"><? if ($display_check) { ?>등록중<? } else { ?><a href="#" onclick="listAdd('<?=$list['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_add.gif" border="0"></a><? } ?></td>
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
<tr><td height="3" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="checkSave(); return false;"><img src="<?=$shop['image_path']?>/adm/select_add.gif" border="0" /></a></td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:14px auto 0 auto;">
<tr>
    <td><span class="msg2">체크박스상 선택된 모든상품이 추가 됩니다.</span></td>
</tr>
</table>
</form>

<div style="height:100px;"></div>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>