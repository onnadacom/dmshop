<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "3";
$menu_id = "300";
$shop['title'] = "혜택별 상품 아이콘";
$shop['admin_width'] = "100%";
include_once("./_top.php");

$colspan = "15";

// 검색조건
$sql_search = " where 1 ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[icon_file_table] $sql_search ");

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

    $sort = "id asc";

}

$result = sql_query(" select * from $shop[icon_file_table] $sql_search order by $sort limit $from_record, $rows ");

if (!$q) {

    $keyword = "검색어";
    $q = "검색어";

}
?>
<style type="text/css">
.contents_box {min-width:1070px;}

.sort .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.sort .selectBox-dropdown {width:110px; height:19px;}
.sort .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".sort select").selectBox();
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

        alert(msg + "할 아이콘을 선택하세요.");
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

    if (!confirm("선택한 아이콘을 저장 하시겠습니까?")) {

        return false;

    }

    f.action = "./icon_list_update.php";
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

    if (!confirm("선택한 아이콘을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./icon_list_update.php";
    f.submit();

}

function listDelete(icon_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.icon_id.value = icon_id;

    if (!confirm("해당 아이콘을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./icon_write_update.php";
    f.submit();

}

function listSearch(mode)
{

    var f = document.formSearch;

    if (mode == 'sort') {

        f.submit();

    }

}
</script>

<form method="post" name="formUpdate">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="icon_id" value="" />
</form>

<div class="contents_box">
<form method="get" name="formSearch" action="icon_list.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="listname">아이콘 목록</td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">건</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="id desc">아이디 내림차순</option>
    <option value="id asc">아이디 오름차순</option>
    <option value="datetime desc">등록일시 내림차순</option>
    <option value="datetime asc">등록일시 오름차순</option>
    <option value="title desc">아이콘명 내림차순</option>
    <option value="title asc">아이콘명 오름차순</option>
    <option value="position desc">출력순서 내림차순</option>
    <option value="position asc">출력순서 오름차순</option>
</select>
    </td>
</tr>
</table>
    </td>
    <td width="160" align="right"><a href="#" onclick="iconWrite(); return false;"><img src="<?=$shop['image_path']?>/adm/icon_write.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>
</form>

<script type="text/javascript">
<? if ($sort) { ?>$("#sort").val("<?=$sort?>");<? } ?>
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
    <col width="100">
    <col width="1">
    <col width="120">
    <col width="1">
    <col width="">
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
    <td></td>
</tr>
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">출력순서</td>
    <td class="bc1"></td>
    <td class="boxtitle">사용여부</td>
    <td class="bc1"></td>
    <td class="boxtitle">아이콘아이디</td>
    <td class="bc1"></td>
    <td class="boxtitle">이미지</td>
    <td class="bc1"></td>
    <td class="boxtitle">아이콘명</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별설정</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    // 파일 경로
    $file_path = $shop['path']."/data/icon/".shop_data_path("u", $list['datetime'])."/".$list['upload_file'];

    // 파일이 있다면
    if (file_exists($file_path) && $list['upload_file']) {

        $file_icon = "<img src='".$file_path."'>";

    } else {

        $file_icon = "";

    }
?>
<input type="hidden" name="icon_id[<?=$i?>]" value="<?=$list['id']?>" />
<tr height="40">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><input type="text" name="position[<?=$i?>]" value="<?=$list['position']?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td class="bc1"></td>
    <td align="center">
<select id="view[<?=$i?>]" name="view[<?=$i?>]" class="select">
    <option value="1">보임</option>
    <option value="0">숨김</option>
</select>

<script type="text/javascript">
document.getElementById("view[<?=$i?>]").value = "<?=$list['view']?>";
</script>
    </td>
    <td class="bc1"></td>
    <td align="center" class="tx2"><?=$list['id']?></td>
    <td class="bc1"></td>
    <td align="center"><?=$file_icon?></td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><input type="text" name="title[<?=$i?>]" value="<?=text($list['title'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="right" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="iconEdit('<?=$list['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_edit.gif" border="0"></a></td>
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
    <td><a href="./icon_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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