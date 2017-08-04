<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "6";
$menu_id = "100";
$shop['title'] = "게시판 목록";
include_once("./_top.php");

$colspan = "17";

// 검색조건
$sql_search = " where 1 ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[board_table] $sql_search ");

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

$result = sql_query(" select * from $shop[board_table] $sql_search order by $sort limit $from_record, $rows ");

if (!$q) {

    $keyword = "검색어";
    $q = "검색어";

}
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.sort .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.sort .selectBox-dropdown {width:120px; height:19px;}
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

        alert(msg + "할 게시판을 선택하세요.");
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

    if (!confirm("선택한 게시판을 저장 하시겠습니까?")) {

        return false;

    }

    f.action = "./board_list_update.php";
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

    if (!confirm("선택한 게시판을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./board_list_update.php";
    f.submit();

}

function listDelete(bbs_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.bbs_id.value = bbs_id;

    if (!confirm("해당 게시판을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./board_write_update.php";
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
<input type="hidden" name="bbs_id" value="" />
</form>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td width="20"></td>
    <td>&nbsp;</td>
    <td width="160" align="right"><a href="./board_write.php"><img src="<?=$shop['image_path']?>/adm/board_write.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<form method="get" name="formSearch" action="board_list.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="listname">게시판 목록</td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">건</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="datetime desc">생성일시 내림차순</option>
    <option value="datetime asc">생성일시 오름차순</option>
    <option value="bbs_title desc">게시판명 내림차순</option>
    <option value="bbs_title asc">게시판명 오름차순</option>
    <option value="bbs_id desc">게시판아이디 내림차순</option>
    <option value="bbs_id asc">게시판아이디 오름차순</option>
    <option value="bbs_position desc">출력순서 내림차순</option>
    <option value="bbs_position asc">출력순서 오름차순</option>
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
    <option value="bbs_title">게시판명</option>
    <option value="bbs_id">게시판아이디</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./board_list.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
    <col width="100">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="140">
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
    <td><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">출력순서</td>
    <td class="bc1"></td>
    <td class="boxtitle">메뉴출력</td>
    <td class="bc1"></td>
    <td class="boxtitle">게시판아이디</td>
    <td class="bc1"></td>
    <td class="boxtitle">게시판명</td>
    <td class="bc1"></td>
    <td class="boxtitle">게시물</td>
    <td class="bc1"></td>
    <td class="boxtitle">적용스킨</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별설정</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
$board_skin_option = "";
$skin_array = shop_skin_dir("board");
for ($i=0; $i<count($skin_array); $i++) {

    $board_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

for ($i=0; $list=sql_fetch_array($result); $i++) {
?>
<input type="hidden" name="bbs_id[<?=$i?>]" value="<?=text($list['bbs_id'])?>" />
<tr height="50">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><input type="text" name="bbs_position[<?=$i?>]" value="<?=text($list['bbs_position'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td class="bc1"></td>
    <td align="center">
<select id="bbs_view[<?=$i?>]" name="bbs_view[<?=$i?>]" class="select">
    <option value="1"> 보임 </option>
    <option value="0"> 숨김 </option>
</select>

<script type="text/javascript">
document.getElementById("bbs_view[<?=$i?>]").value = "<?=text($list['bbs_view'])?>";
</script>
    </td>
    <td class="bc1"></td>
    <td align="center"><a href="<?=$shop['path']?>/board.php?bbs_id=<?=text($list['bbs_id'])?>" target="_blank" class="bbs_id"><?=text($list['bbs_id'])?></a></td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td><input type="text" name="bbs_title[<?=$i?>]" value="<?=text($list['bbs_title'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:197px;" /></td>
    <td width="10"></td>
    <td><a href="<?=$shop['path']?>/board.php?bbs_id=<?=text($list['bbs_id'])?>" target="_blank"><img src="<?=$shop['image_path']?>/adm/blank.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="center"><span class="bbs_write_count"><?=number_format($list['bbs_write_count']);?> 건</span></td>
    <td class="bc1"></td>
    <td align="center">
<select id="bbs_skin[<?=$i?>]" name="bbs_skin[<?=$i?>]" class="select"><?=$board_skin_option?></select>

<script type="text/javascript">
document.getElementById("bbs_skin[<?=$i?>]").value = "<?=text($list['bbs_skin'])?>";
</script>
    </td>
    <td class="bc1"></td>
    <td align="right" class="none">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="./board_write.php?m=u&bbs_id=<?=text($list['bbs_id'])?>"><img src="<?=$shop['image_path']?>/adm/list_config.gif" border="0"></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="listDelete('<?=text($list['bbs_id'])?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_delete.gif" border="0"></a></td>
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
    <td><a href="./board_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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