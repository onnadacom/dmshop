<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "3";
$menu_id = "401";
$shop['title'] = "상품분류 화면설정";
$shop['admin_width'] = "100%";
include_once("./_top.php");

$colspan = "13";

// 검색조건
$sql_search = " where category = '1' ";

if ($f && $q) {

    $sql_search .= " and INSTR(".$f.", '".$q."') ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[category_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = 1000;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v0("10", $page, $total_page, "?f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "position asc, id asc";

}

$result = sql_query(" select * from $shop[category_table] $sql_search order by $sort limit $from_record, $rows ");

if (!$q) {

    $keyword = "검색어";
    $q = "검색어";

}
?>
<style type="text/css">
.contents_box {min-width:1070px;}

.field .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.field .selectBox-dropdown {width:60px; height:19px;}
.field .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
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

        alert(msg + "할 분류를 선택하세요.");
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

    if (!confirm("선택한 분류를 저장 하시겠습니까?")) {

        return false;

    }

    f.action = "./category_list_update.php";
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

    if (!confirm("선택한 분류를 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./category_list_update.php";
    f.submit();

}

function listDelete(id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.id.value = id;

    if (!confirm("해당 분류를 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./category_setting_update.php";
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

<form method="post" name="formUpdate">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="id" value="" />
</form>

<div class="contents_box">
<form method="get" name="formSearch" action="category_list.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="listname">분류 목록</td>
    <td width="10"></td>
    <td><span class="tx1">총</span> <span class="totalnum" id="total_count"><?=$total_count?></span> <span class="tx1">분류</span></td>
    <td width="13" class="line">|</td>
    <td class="tx1">출력순서별 표시</td>
</tr>
</table>
    </td>
    <td width="350" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="field">
<select id="f" name="f" class="select">
    <option value="subject">1차 분류명</option>
</select>
    </td>
    <td width="4"></td>
    <td><input type="text" name="q" value="<?=$q?>" onmouseover="keywordOver();" onFocus="shopInfocus1_1(this); keywordOver();" onBlur="shopOutfocus1_1(this);" class="input3" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$shop['image_path']?>/adm/search.gif" border="0"></td>
    <td width="4"></td>
    <td><a href="./category_list.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>
    </td>
</tr>
</table>
</form>

<script type="text/javascript">
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
    <col width="100">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="180">
    <col width="1">
    <col width="180">
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
    <td></td>
</tr>
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">화면출력</td>
    <td class="bc1"></td>
    <td class="boxtitle">분류명</td>
    <td class="bc1"></td>
    <td class="boxtitle">상품 출력(가로/세로)</td>
    <td class="bc1"></td>
    <td class="boxtitle">썸네일 크기(가로/세로)</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별설정</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
$list = "";
$list_data = "";
$list_data_script = "";
$list_category = "";
$c = -1;

// 1차 분류
$n = 0;
for ($i=0; $category1=sql_fetch_array($result); $i++) {

    $c++;

    // data
    $list = $category1;

    // check
    $chk = sql_fetch(" select count(*) as cnt from $shop[category_table] where code = '".$list['code']."' and position > '".$list['position']."' ");

    $list_category_ic1 = false;

    if ($chk['cnt']) {

        $list_category_ic1 = true;

    }

    include("./category_list_data.php");

    // 2차 분류
    $nn = 0;
    $result2 = sql_query(" select * from $shop[category_table] where code = '".$list['id']."' order by position asc, id asc ");
    for ($ii=0; $category2=sql_fetch_array($result2); $ii++) {

        $c++;

        // data
        $list = $category2;

        // check
        $chk = sql_fetch(" select count(*) as cnt from $shop[category_table] where code = '".$list['code']."' and position > '".$list['position']."' ");

        $list_category_ic2 = false;

        if ($chk['cnt']) {

            $list_category_ic2 = true;

        }

        include("./category_list_data.php");

        // 3차 분류
        $nnn = 0;
        $result3 = sql_query(" select * from $shop[category_table] where code = '".$list['id']."' order by position asc, id asc ");
        for ($iii=0; $category3=sql_fetch_array($result3); $iii++) {

            $c++;

            // data
            $list = $category3;

            // check
            $chk = sql_fetch(" select count(*) as cnt from $shop[category_table] where code = '".$list['code']."' and position > '".$list['position']."' ");

            $list_category_ic3 = false;

            if ($chk['cnt']) {

                $list_category_ic3 = true;

            }

            include("./category_list_data.php");

            // 4차 분류
            $nnnn = 0;
            $result4 = sql_query(" select * from $shop[category_table] where code = '".$list['id']."' order by position asc, id asc ");
            for ($iiii=0; $category4=sql_fetch_array($result4); $iiii++) {

                $c++;

                // data
                $list = $category4;

                // check
                $chk = sql_fetch(" select count(*) as cnt from $shop[category_table] where code = '".$list['code']."' and position > '".$list['position']."' ");

                $list_category_ic4 = false;

                if ($chk['cnt']) {

                    $list_category_ic4 = true;

                }

                include("./category_list_data.php");

            }

        }

    }

}

echo $list_data;

if ($c > '0') {

    echo "<script type='text/javascript'>$('#total_count').html('".$c."');</script>";

}
?>

<script type="text/javascript">
<?=$list_data_script?>
</script>
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
    <td><a href="./category_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하셔야만 현재의 설정값이 적용 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>