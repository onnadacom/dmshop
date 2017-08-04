<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "3";
$menu_id = "200";
$shop['title'] = "기획전 목록";
include_once("./_top.php");

if (!$plan_id) {

    alert("기획전이 삭제되었거나 존재하지 않습니다.");

}

// 기획전
$dmshop_plan = shop_plan($plan_id);

if (!$dmshop_plan['id']) {

    alert("기획전이 삭제되었거나 존재하지 않습니다.");

}

$colspan = "17";

// 검색조건
$sql_search = " where plan_id = '".$plan_id."' ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[plan_item_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 20;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?plan_id=".$plan_id."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "datetime desc";

}

$result = sql_query(" select * from $shop[plan_item_table] $sql_search order by $sort limit $from_record, $rows ");

if (!$q) {

    $keyword = "검색어";
    $q = "검색어";

}
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.category .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category .selectBox-dropdown {width:295px; height:19px;}
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
    $(".category select").selectBox();
    $(".sort select").selectBox();
    $(".limit select").selectBox();
    $(".field select").selectBox();
});
</script>

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

    f.action = "./plan_item_list_update.php";
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

    if (!confirm("선택한 상품을 기획전에서 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./plan_item_list_update.php";
    f.submit();

}

function listDelete(plan_item_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.plan_item_id.value = plan_item_id;

    if (!confirm("해당 상품을 기획전에서 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./plan_item_write_update.php";
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
<input type="hidden" name="plan_item_id" value="" />
</form>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx1">기획전 상세목록</td>
    <td width="10"></td>
    <td class="category">
<select id="plan_move" name="plan_move" class="select" onchange="planMove(this.value);">
    <option value='plan_list'>기획전 목록</option>
<?
$result2 = sql_query(" select * from $shop[plan_table] order by datetime desc ");
for ($i=0; $row=sql_fetch_array($result2); $i++) {

    echo "<option value='".$row['id']."'>".$row['title']."</option>";

}
?>
</select>

<script type="text/javascript">
<? if ($plan_id) { ?>$("#plan_move").val("<?=$plan_id?>");<? } ?>
</script>
    </td>
</tr>
</table>
    </td>
    <td width="160" align="right"><a href="#" onclick="planitemWrite('<?=$plan_id?>'); return false;"><img src="<?=$shop['image_path']?>/adm/plan_item_write.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<form method="get" name="formSearch" action="plan_item_list.php" onSubmit="return listSearch('');" autocomplete="off">
<input type="hidden" name="plan_id" value="<?=$plan_id?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1"><?=$dmshop_plan['title']?> 기획전 상세목록</td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">건</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="datetime desc">등록일시 내림차순</option>
    <option value="datetime asc">등록일시 오름차순</option>
    <option value="position desc">진열선호도 내림차순</option>
    <option value="position asc">진열선호도 오름차순</option>
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
    <td width="350" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="field">
<select id="f" name="f" class="select">
    <option value="item_title">상품명</option>
    <option value="item_code">상품코드</option>
    <option value="item_money">판매가격</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./plan_item_list.php?plan_id=<?=$plan_id?>"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
<input type="hidden" name="plan_id" value="<?=$plan_id?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="form_list">
<colgroup>
    <col width="20">
    <col width="25">
    <col width="1">
    <col width="80">
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
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">전시순서</td>
    <td class="bc1"></td>
    <td class="boxtitle">대표이미지</td>
    <td class="bc1"></td>
    <td class="boxtitle">상품/분류명</td>
    <td class="bc1"></td>
    <td class="boxtitle">판매가격</td>
    <td class="bc1"></td>
    <td class="boxtitle">조회수</td>
    <td class="bc1"></td>
    <td class="boxtitle">주문건수</td>
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

    $thumb = shop_item_thumb($list['item_id'], "default", "", "50", "50", "2");
    if (!file_exists($thumb)) { $thumb = $shop['image_path']."/adm/noimage.gif"; }
?>
<input type="hidden" name="plan_item_id[<?=$i?>]" value="<?=$list['id']?>" />
<tr height="62">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><input type="text" name="position[<?=$i?>]" value="<?=$list['position']?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px; background-color:#e7feff;" /></td>
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
    <td align="center"><span class="item_money"><?=number_format($list['item_money']);?></span></td>
    <td class="bc1"></td>
    <td align="center"><span class="item_hit"><?=(int)($list['item_hit'])?></span></td>
    <td class="bc1"></td>
    <td align="center"><span class="item_sale"><?=(int)($list['item_sale'])?></span></td>
    <td class="bc1"></td>
    <td align="right" class="none">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="./item_write.php?m=u&item_id=<?=$list['item_id']?>"><img src="<?=$shop['image_path']?>/adm/list_config.gif" border="0"></a></td>
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
    <td><a href="./plan_item_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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