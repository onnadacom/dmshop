<?php
include_once("./_dmshop.php");
if ($level) { $level = preg_match("/^[0-9]+$/", $level) ? $level : ""; }
$shop['title'] = "회원 등급 관리";
include_once("$shop[path]/shop.top.php");

$colspan = "15";

// 검색조건
$sql_search = " where user_id != 'admin' and user_leave_datetime = '0000-00-00 00:00:00' ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

if ($level) {

    $sql_search .= " and user_level = '".$level."' ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[user_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 5;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?level=".$level."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "user_id asc";

}

$result = sql_query(" select * from $shop[user_table] $sql_search order by $sort limit $from_record, $rows ");
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}

.category1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category1 .selectBox-dropdown {width:100px; height:19px;}
.category1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.category2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category2 .selectBox-dropdown {width:100px; height:19px;}
.category2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

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
    $(".category1 select").selectBox();
    $(".category2 select").selectBox();
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

        alert(msg + "할 회원을 선택하세요.");
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

    f.m.value = "all";
    f.user_level.value = document.getElementById("user_level").value;

    if (!confirm("선택한 회원의 등급을 변경 하시겠습니까?")) {

        return false;

    }

    f.action = "./user_level_update.php";
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

function listEdit(user_id)
{

    var f = document.formUpdate;

    f.m.value = "";
    f.user_id.value = user_id;

    if (!confirm("해당 회원의 등급을 변경 하시겠습니까?")) {

        return false;

    }

    f.action = "./user_level_update.php";
    f.submit();

}

function keywordOver()
{

    var f = document.formSearch;

    if (f.q.value == '<?=text($keyword)?>') {

        f.q.value = "";

    }

}

function levelAll()
{

    var f = document.formUpdate;

    f.m.value = "level";
    f.level.value = document.getElementById("level").value;

    var index = document.getElementById("level").selectedIndex;
    var level = document.getElementById("level").options[index].text;

    if (!confirm(level+" 회원의 등급을 변경 하시겠습니까?")) {

        return false;

    }

    f.action = "./user_level_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d7d7d8" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#eeeeef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="title_bg2">
<tr>
    <td width="26" align="center"><img src="<?=$shop['image_path']?>/adm/position_arrow.gif"></td>
    <td class="bigtitle">회원 등급설정</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#c8cdd2" class="none">&nbsp;</td></tr>
</table>

<form method="post" name="formUpdate" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="level" value="" />
<input type="hidden" name="user_id" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">등급 선택</td>
    <td width="10"></td>
    <td class="category1">
<select id="user_level" name="user_level" size="1" class="select">
<?
// 1은 비회원
$result2 = sql_query(" select * from $shop[user_level_table] where level >= '2' order by level asc ");
for ($i=0; $row=sql_fetch_array($result2); $i++) {

    echo "<option value='".text($row['level'])."'>".text($row['name'])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#user_level").val("2");
</script>
    </td>
    <td width="10"></td>
    <td><span class="help1">변경될 회원등급을 선택 하세요.</span></td>
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

<form method="get" name="formSearch" action="user_level.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1"><?=text($message)?> 대상</td>
    <td width="10"></td>
    <td class="category2">
<select id="level" name="level" size="1" class="select" onchange="listSearch('sort');">
    <option value="">전체</option>
<?
$result3 = sql_query(" select * from $shop[user_level_table] where level > '1' order by level asc ");
for ($i=0; $row=sql_fetch_array($result3); $i++) {

    echo "<option value='".text($row['level'])."'>".text($row['name'])."</option>\n";

}
?>
</select>

<script type="text/javascript">
$("#level").val("<?=$level?>");
</script>
    </td>
    <td width="10"></td>
    <td><span class="help1">변경하실 대상(회원)을 선택하세요.</span></td>
</tr>
</table>
    </td>
    <td width="220" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="160" align="right"><a href="#" onclick="levelAll(); return false;"><img src="<?=$shop['image_path']?>/adm/level_all.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>
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
    <td class="listname">회원목록</span></td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=(int)($total_count);?></span> <span class="tx1">명</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">정렬방식</td>
    <td width="10"></td>
    <td class="sort">
<select id="sort" name="sort" class="select" onchange="listSearch('sort');">
    <option value="datetime desc">가입일시 내림차순</option>
    <option value="datetime asc">가입일시 오름차순</option>
    <option value="user_name asc">성명 내림차순</option>
    <option value="user_name desc">성명 오름차순</option>
    <option value="user_id asc">아이디 내림차순</option>
    <option value="user_id desc">아이디 오름차순</option>
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
    <td width="320" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="field">
<select id="f" name="f" class="select">
    <option value="user_name">성명</option>
    <option value="user_id">아이디</option>
    <option value="user_hp">휴대폰</option>
    <option value="user_tel">일반전화</option>
    <option value="user_addr1">주소</option>
    <option value="user_ip">가입IP</option>
    <option value="user_login_ip">로그인IP</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./user_level.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
<input type="hidden" name="level" value="" />
<input type="hidden" name="user_level" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="form_list">
<colgroup>
    <col width="20">
    <col width="35">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="80">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="64">
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
    <td align="center"><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">아이디</td>
    <td class="bc1"></td>
    <td class="boxtitle">성명</td>
    <td class="bc1"></td>
    <td class="boxtitle">생년월일</td>
    <td class="bc1"></td>
    <td class="boxtitle">기본주소/휴대폰</td>
    <td class="bc1"></td>
    <td class="boxtitle">현재등급</td>
    <td class="bc1"></td>
    <td class="boxtitle"><p style="padding-left:9px;">개별변경</p></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    // userview
    $userview = shop_userview($list['user_id'], $list['user_name'], $list['user_email'], $list['user_homepage'], $list['user_name']);

    if ($list['user_level'] >= '9') {

        $level = "<span class='level_a' style='color:#ff0000;'>".shop_user_level($list['user_level'])."</span>";

    } else {

        $level = "<span class='level'>".shop_user_level($list['user_level'])."</span>";

    }
?>
<input type="hidden" name="user_id[<?=$i?>]" value="<?=$list['user_id']?>" />
<tr height="46">
    <td></td>
    <td align="center" class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center" class="user_id"><?=shop_user_id($list['user_id'], $list['user_leave_datetime']);?></td>
    <td class="bc1"></td>
    <td align="center" class="user_name"><?=$userview?></td>
    <td class="bc1"></td>
    <td align="center" class="user_birth"><? if ($list['user_birth']) { echo date("Y-m-d", strtotime($list['user_birth'])); } ?></td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="user_addr"><?=text($list['user_addr1'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="user_tel"><? if ($list['user_hp']) { echo text($list['user_hp']); } else { echo text($list['user_tel']); } ?></td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td align="center" class="level"><?=$level?></td>
    <td class="bc1"></td>
    <td align="right"><a href="#" onclick="listEdit('<?=text($list['user_id'])?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_edit.gif" border="0"></a></td>
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
    <td width="4"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0" /></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">회원목록의 체크박스상 선택된 회원의 등급을 변경 합니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>