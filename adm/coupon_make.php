<?php
include_once("./_dmshop.php");
if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }
if ($level) { $level = preg_match("/^[0-9]+$/", $level) ? $level : ""; }
$shop['title'] = "쿠폰 직권 지급";
include_once("$shop[path]/shop.top.php");

$colspan = "15";

$sql_search = " ";

// 쿠폰
$tmp_coupon_options = "";
$result2 = sql_query(" select * from $shop[coupon_table] where coupon_type = '0' and coupon_use = '0' order by datetime desc ");
for ($i=0; $row=sql_fetch_array($result2); $i++) {

    $tmp_coupon_options .= "<option value='".$row['id']."'>".text($row['coupon_title'])."</option>\n";

    // 쿠폰아이디가 없으면서 첫번째라면
    if ($i == '0' && !$coupon_id) {

        // 기본 아이디 지정
        $coupon_id = $row['id'];

    }

}

if (!$coupon_id) {

    $tmp_coupon_options .= "<option value=''>생성한 쿠폰이 없습니다.</option>\n";

}

// 검색조건
$sql_search = " where user_leave_datetime = '0000-00-00 00:00:00' ";

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

$shop_pages = shop_paging_v0("10", $page, $total_page, "?coupon_id=".$coupon_id."&level=".$level."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q."&page=");

if (!$sort) {

    $sort = "user_id asc";

}

$result = sql_query(" select * from $shop[user_table] $sql_search order by $sort limit $from_record, $rows ");
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}

.category1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.category1 .selectBox-dropdown {width:300px; height:19px;}
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

    var msg = "쿠폰지급";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "all";

    if (document.getElementById("sms_check").checked == true) {

        f.sms_send.value = "1";

    } else {

        f.sms_send.value = "";

    }

    if (!confirm("선택한 회원에게 쿠폰을 지급 하시겠습니까?")) {

        return false;

    }

    f.action = "./coupon_make_update.php";
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

function listMake(user_id)
{

    var f = document.formUpdate;

    f.m.value = "";
    f.user_id.value = user_id;

    if (document.getElementById("sms_check").checked == true) {

        f.sms_send.value = "1";

    } else {

        f.sms_send.value = "";

    }

    if (!confirm("해당 회원에게 쿠폰을 지급 하시겠습니까?\n\n중복다운 불가의 사용조건일 경우, 이미 지급된 회원은 지급되지 않습니다.")) {

        return false;

    }

    f.action = "./coupon_make_update.php";
    f.submit();

}

function couponAll()
{

    var f = document.formUpdate;

    f.m.value = "level";
    f.level.value = $("#level").val();

    if (document.getElementById("sms_level").checked == true) {

        f.sms_send.value = "1";

    } else {

        f.sms_send.value = "";

    }

    var index = document.getElementById("level").selectedIndex;
    var level = document.getElementById("level").options[index].text;

    if (!confirm(level+" 회원에게 쿠폰을 지급 하시겠습니까?\n\n중복다운 불가의 사용조건일 경우, 이미 지급된 회원은 지급되지 않습니다.")) {

        return false;

    }

    f.action = "./coupon_make_update.php";
    f.submit();

}

function keywordOver()
{

    var f = document.formSearch;

    if (f.q.value == '<?=text($keyword)?>') {

        f.q.value = "";

    }

}

function couponLoad(coupon_id)
{

    if (!coupon_id) {

        var coupon_id = $("#coupon_id").val();

    }

    $.post("./coupon_make_data.php", {"coupon_id" : coupon_id}, function(data) {

        $("#coupon_data").html(data);

    });

}
</script>

<form method="post" name="formUpdate" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="coupon_id" value="<?=$coupon_id?>" />
<input type="hidden" name="level" value="" />
<input type="hidden" name="user_id" value="" />
<input type="hidden" name="sms_send" value="" />
</form>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d7d7d8" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#eeeeef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="title_bg2">
    <td width="26" align="center"><img src="<?=$shop['image_path']?>/adm/position_arrow.gif"></td>
    <td class="bigtitle"><?=text($shop['title'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#c8cdd2" class="none">&nbsp;</td></tr>
</table>

<form method="get" name="formSearch" action="coupon_make.php" onSubmit="return listSearch('');" autocomplete="off">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">쿠폰 선택</td>
    <td width="10"></td>
    <td class="category1">
<select id="coupon_id" name="coupon_id" size="1" class="select" onchange="couponLoad(this.value); listSearch('sort');">
<?=$tmp_coupon_options?>
</select>

<script type="text/javascript">
$("#coupon_id").val("<?=$coupon_id?>");
</script>
    </td>
    <td width="10"></td>
    <td class="help1">지급하실 쿠폰을 선택하세요. (일반쿠폰만 가능)</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="80">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="70">
    <col width="1">
    <col width="65">
    <col width="1">
    <col width="65">
    <col width="20">
</colgroup>
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td class="boxtitle">할인/혜택</td>
    <td class="bc1"></td>
    <td class="boxtitle">쿠폰명/사용조건</td>
    <td class="bc1"></td>
    <td class="boxtitle">사용기간</td>
    <td class="bc1"></td>
    <td class="boxtitle">발행매수</td>
    <td class="bc1"></td>
    <td class="boxtitle">지급매수</td>
    <td class="bc1"></td>
    <td class="boxtitle">사용내역</td>
    <td></td>
</tr>
<tr><td colspan="13" height="1" class="bc1"></td></tr>
</table>

<div id="coupon_data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50">
    <td></td>
</tr>
</table>
</div>

<script type="text/javascript">
<? if ($coupon_id) { ?>
$(function() { couponLoad('<?=$coupon_id?>'); });
<? } ?>
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="20"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">지급 대상</td>
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
    <td class="help1">지급대상(회원)을 선택하세요.</td>
</tr>
</table>
    </td>
    <td width="270" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="checkbox" id="sms_level" name="sms_level" value="1" class="checkbox" /></td>
    <td width="5"></td>
    <td class="tx2">SMS 통보</td>
    <td width="10"></td>
    <td><a href="#" onclick="couponAll(); return false;"><img src="<?=$shop['image_path']?>/adm/coupon_all.gif" border="0"></a></td>
    <td width="10"></td>
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
    <td><a href="./coupon_make.php"><img src="<?=$shop['image_path']?>/adm/reset.gif" border="0"></a></td>
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
<input type="hidden" name="coupon_id" value="<?=$coupon_id?>" />
<input type="hidden" name="level" value="" />
<input type="hidden" name="sms_send" value="" />
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
    <col width="90">
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
    <td class="boxtitle">구매횟수/금액</td>
    <td class="bc1"></td>
    <td class="boxtitle">개별지급</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<?
for ($i=0; $list=sql_fetch_array($result); $i++) {

    // userview
    $userview = shop_userview($list['user_id'], $list['user_name'], $list['user_email'], $list['user_homepage'], $list['user_name']);

    // 해당 회원의 구매횟수 및 실결제총액 (배송완료인 주문내역을 뽑는다)
    $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where user_id = '".addslashes($list['user_id'])."' and order_type in ('202','900')) as x ");
?>
<input type="hidden" name="user_id[<?=$i?>]" value="<?=text($list['user_id'])?>" />
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
    <td align="center"><p><span class="order_total_count"><?=number_format($order['total_order_count']);?></span><span class="tx1"> 회</span></p><p><span class="order_total_money"><?=number_format($order['total_order_pay_money']);?></span><span class="tx1"> 원</span></p></td>
    <td class="bc1"></td>
    <td align="center"><a href="#" onclick="listMake('<?=text($list['user_id'])?>'); return false;"><img src="<?=$shop['image_path']?>/adm/list_make.gif" border="0"></a></td>
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
    <td><input type="checkbox" id="sms_check" name="sms_check" value="1" class="checkbox" /></td>
    <td width="5"></td>
    <td class="tx2">SMS 통보</td>
    <td width="10"></td>
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
    <td class="msg2">회원목록의 체크박스상 선택된 회원에게, 선택하신 쿠폰을 지급 합니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>