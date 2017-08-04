<?php
include_once("./_dmshop.php");
$shop['title'] = "배너그룹 설정";
include_once("$shop[path]/shop.top.php");

$colspan = "9";

// 검색조건
$sql_search = " where 1 ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[banner_group_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 5;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "group_id asc";

}

$result = sql_query(" select * from $shop[banner_group_table] $sql_search order by $sort limit $from_record, $rows ");
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}

.sort .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.sort .selectBox-dropdown {width:110px; height:19px;}
.sort .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.limit .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.limit .selectBox-dropdown {width:35px; height:19px;}
.limit .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.field .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.field .selectBox-dropdown {width:80px; height:19px;}
.field .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
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

        alert(msg + "할 그룹을 선택하세요.");
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

    if (!confirm("선택한 그룹을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./banner_group_update.php";
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

function listDelete(group_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.group_id.value = group_id;

    if (!confirm("해당 그룹을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./banner_group_update.php";
    f.submit();

}

function groupMake()
{

    var f = document.formUpdate;

    if (f.group_id.value == '') {

        alert("그룹명을 입력하여주세요.");
        f.group_id.focus();
        return false;

    }

    f.m.value = "";

    if (!confirm("그룹을 추가 하시겠습니까?")) {

        return false;

    }

    f.action = "./banner_group_update.php";
    f.submit();

}

function keywordOver()
{

    var f = document.formSearch;

    if (f.q.value == '<?=text($keyword)?>') {

        f.q.value = "";

    }

}
</script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d7d7d8" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#eeeeef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="title_bg2">
    <td width="26" align="center"><img src="<?=$shop['image_path']?>/adm/position_arrow.gif"></td>
    <td class="bigtitle">배너그룹 설정</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#c8cdd2" class="none">&nbsp;</td></tr>
</table>

<form method="post" name="formUpdate" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="90" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="listname">그룹명</td>
    <td width="10"></td>
    <td><input type="text" name="group_id" value="" onFocus="shopInfocus2(this);" onBlur="shopOutfocus2(this);" class="input2" style="width:150px;" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="groupMake(); return false;"><img src="<?=$shop['image_path']?>/adm/add.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="7"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="help1">그룹명은 띄어쓰기 없이, 영문 or 숫자로 그룹명을 입력합니다.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="5"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="help1">그룹명은 특정 페이지에서 배너를 직접 호출하거나, 랜덤 출력할 때 사용 합니다.</td>
</tr>
</table>
    </td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<form method="get" name="formSearch" action="banner_group.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="listname">그룹목록</span></td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">건</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="datetime desc">생성일시 내림차순</option>
    <option value="datetime asc">생성일시 오름차순</option>
    <option value="group_id desc">그룹명 내림차순</option>
    <option value="group_id asc">그룹명 오름차순</option>
</select>
    </td>
    <td width="4"></td>
    <td class="limit">
<select id="rows" name="rows" class="select" onchange="listSearch('sort');">
    <option value="5">5개씩</option>
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
    <option value="group_id">그룹명</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./banner_group.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
    <col width="">
    <col width="1">
    <col width="120">
    <col width="1">
    <col width="80">
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
    <td></td>
</tr>
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td align="center"><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">그룹명</td>
    <td class="bc1"></td>
    <td class="boxtitle">등록된 배너</td>
    <td class="bc1"></td>
    <td class="boxtitle"><p style="padding-left:9px;">개별지급</p></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {
?>
<input type="hidden" name="group_id[<?=$i?>]" value="<?=text($list['group_id'])?>" />
<tr height="46">
    <td></td>
    <td align="center" class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center" class="tx1"><?=text($list['group_id'])?></td>
    <td class="bc1"></td>
    <td align="center" class="tx1"><?=number_format(shop_banner_group_count($list['group_id']));?></td>
    <td class="bc1"></td>
    <td align="right"><a href="#" onclick="listDelete('<?=text($list['group_id'])?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_delete.gif" border="0"></a></td>
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
    <td><a href="#" onclick="checkDelete(); return false;"><img src="<?=$shop['image_path']?>/adm/del.gif" border="0" /></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0" /></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">선택하신 그룹을 위 조건으로 일괄 처리 합니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>