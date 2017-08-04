<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "3";
$menu_id = "200";
$shop['title'] = "기획전 목록";
include_once("./_top.php");

$colspan = "17";

// 검색조건
$sql_search = " where 1 ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[plan_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 20;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "datetime desc";

}

$result = sql_query(" select * from $shop[plan_table] $sql_search order by $sort limit $from_record, $rows ");

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

        alert(msg + "할 기획전을 선택하세요.");
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

    if (!confirm("선택한 기획전을 저장 하시겠습니까?")) {

        return false;

    }

    f.action = "./plan_list_update.php";
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

    if (!confirm("선택한 기획전을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./plan_list_update.php";
    f.submit();

}

function listDelete(plan_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.plan_id.value = plan_id;

    if (!confirm("해당 기획전을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./plan_write_update.php";
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
<input type="hidden" name="plan_id" value="" />
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

    echo "<option value='".$row['id']."'>".text($row['title'])."</option>";

}
?>
</select>

<script type="text/javascript">
<? if ($plan_id) { ?>$("#plan_move").val("<?=text($plan_id)?>");<? } ?>
</script>
    </td>
</tr>
</table>
    </td>
    <td width="160" align="right"><a href="./plan_write.php"><img src="<?=$shop['image_path']?>/adm/plan_write.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<form method="get" name="formSearch" action="plan_list.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="listname">기획전 목록</td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">상품</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="datetime desc">등록일시 내림차순</option>
    <option value="datetime asc">등록일시 오름차순</option>
    <option value="title desc">기획전명 내림차순</option>
    <option value="title asc">기획전명 오름차순</option>
    <option value="position desc">출력순서 내림차순</option>
    <option value="position asc">출력순서 오름차순</option>
    <option value="date1 desc">전시 시작일 내림차순</option>
    <option value="date1 asc">전시 시작일 오름차순</option>
    <option value="date2 desc">전시 마감일 내림차순</option>
    <option value="date2 asc">전시 마감일 오름차순</option>
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
    <option value="title">기획전명</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./plan_list.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
    <col width="80">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="70">
    <col width="1">
    <col width="160">
    <col width="1">
    <col width="160">
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
    <td class="boxtitle">출력순서</td>
    <td class="bc1"></td>
    <td class="boxtitle">메뉴표기</td>
    <td class="bc1"></td>
    <td class="boxtitle">기획전명</td>
    <td class="bc1"></td>
    <td class="boxtitle">등록상품</td>
    <td class="bc1"></td>
    <td class="boxtitle">상품 출력수(가로/세로)</td>
    <td class="bc1"></td>
    <td class="boxtitle">썸네일 크기(가로/세로)</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별설정</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {
?>
<input type="hidden" name="plan_id[<?=$i?>]" value="<?=$list['id']?>" />
<tr height="40">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><input type="text" name="position[<?=$i?>]" value="<?=$list['position']?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td class="bc1"></td>
    <td align="center">
<select id="view[<?=$i?>]" name="view[<?=$i?>]" class="select">
    <option value="1"> 보임 </option>
    <option value="0"> 숨김 </option>
</select>

<script type="text/javascript">
document.getElementById("view[<?=$i?>]").value = "<?=$list['view']?>";
</script>
    </td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><input type="text" name="title[<?=$i?>]" value="<?=text($list['title'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:197px;" /></td>
    <td width="10"></td>
    <td><a href="<?=$shop['path']?>/plan.php?pl_id=<?=$list['id']?>" target="_blank"><img src="<?=$shop['image_path']?>/adm/blank.gif" border="0"></a></td>
    <td width="10"></td>
    <td><a href="#" onclick="planitemWrite('<?=$list['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/plan_item_write2.gif" border="0" alt="등록" title="등록"></a></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="center"><a href="./plan_item_list.php?plan_id=<?=$list['id']?>" class="item_title"><?=(int)(shop_plan_item_count($list['id']))?></a> <span class="tx1">건</span></td>
    <td class="bc1"></td>
    <td align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="item_width[<?=$i?>]" value="<?=text($list['item_width'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:33px;" /></td>
    <td width="4"></td>
    <td class="tx1">개 /</td>
    <td width="4"></td>
    <td><input type="text" name="item_height[<?=$i?>]" value="<?=text($list['item_height'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:33px;" /></td>
    <td width="4"></td>
    <td class="tx1">개</td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="thumb_width[<?=$i?>]" value="<?=text($list['thumb_width'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:33px;" /></td>
    <td width="4"></td>
    <td class="tx1">px /</td>
    <td width="4"></td>
    <td><input type="text" name="thumb_height[<?=$i?>]" value="<?=text($list['thumb_height'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:33px;" /></td>
    <td width="4"></td>
    <td class="tx1">px</td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="right" class="none">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="./plan_write.php?m=u&plan_id=<?=$list['id']?>"><img src="<?=$shop['image_path']?>/adm/list_config.gif" border="0"></a></td>
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
    <td><a href="./plan_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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