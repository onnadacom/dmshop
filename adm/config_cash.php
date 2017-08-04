<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "5";
$menu_id = "103";
$shop['title'] = "적립금 지급·사용 내역";
include_once("./_top.php");

$colspan = "11";

$dmshop_signup = shop_signup();
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.select1 .selectBox-dropdown {width:80px; height:19px;}
.select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.contents_box .help {line-height:16px; font-size:12px; color:#959595; font-family:dotum,돋움;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".select1 select").selectBox();
});
</script>

<script type="text/javascript">
function checkAll(mode)
{

    $(".form_list input[type='checkbox']").attr('checked', mode);

}

function configSubmit()
{

    var f = document.formList;

    f.m.value = "";

    if (!confirm("선택한 내역을 저장 하시겠습니까?")) {

        return false;

    }

    f.action = "./config_cash_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formList" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="35">
    <col width="1">
    <col width="120">
    <col width="1">
    <col width="150">
    <col width="1">
    <col width="130">
    <col width="1">
    <col width="">
    <col width="20">
</colgroup>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 적립금 지급 조건·금액 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
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
</tr>
<tr height="50" bgcolor="#f5f5f5">
    <td></td>
    <td align="center"><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">조건</td>
    <td class="bc1"></td>
    <td class="boxtitle">지급 방식</td>
    <td class="bc1"></td>
    <td class="boxtitle">지급 적립금</td>
    <td class="bc1"></td>
    <td class="boxtitle">도움말</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="form_list select1">
<colgroup>
    <col width="20">
    <col width="35">
    <col width="1">
    <col width="120">
    <col width="1">
    <col width="150">
    <col width="1">
    <col width="130">
    <col width="1">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60">
    <td></td>
    <td align="center"><input type="checkbox" name="check1" value="1" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center" class="text1">회원가입</td>
    <td class="bc1"></td>
    <td align="center">
<select id="user_signup_cash" name="user_signup_cash" class="select">
    <option value="0">:: 사용안함 ::</option>
    <option value="1">회원 가입시</option>
</select>

<script type="text/javascript">
$("#user_signup_cash").val("<?=text($dmshop_signup['user_signup_cash'])?>");
</script>
    </td>
    <td class="bc1"></td>
    <td align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="user_cash" value="<?=text($dmshop_signup['user_cash'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:70px;" /></td>
    <td width="5"></td>
    <td class="tx2">원</td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td>
<div style="padding-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="help">최초 회원가입 시, 입력된 적립금 지급</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td align="center"><input type="checkbox" name="check2" value="1" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center" class="text1">생일축하</td>
    <td class="bc1"></td>
    <td align="center">
<select id="birth_cash_use" name="birth_cash_use" class="select">
    <option value="0">:: 사용안함 ::</option>
    <option value="1">생일 당일</option>
</select>

<script type="text/javascript">
$("#birth_cash_use").val("<?=text($dmshop['birth_cash_use'])?>");
</script>
    </td>
    <td class="bc1"></td>
    <td align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="birth_cash" value="<?=text($dmshop['birth_cash'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:70px;" /></td>
    <td width="5"></td>
    <td class="tx2">원</td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td>
<div style="padding-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="help">회원의 생일 당일, 입력된 적립금 지급<br>회원의 DB에 생년월일이 없을 경우 지급불가</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td align="center"><input type="checkbox" name="check3" value="1" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center" class="text1">첫구매 감사</td>
    <td class="bc1"></td>
    <td align="center">
<select id="order_first_use" name="order_first_use" class="select">
    <option value="0">:: 사용안함 ::</option>
    <option value="1">첫 구매시</option>
</select>

<script type="text/javascript">
$("#order_first_use").val("<?=text($dmshop['order_first_use'])?>");
</script>
    </td>
    <td class="bc1"></td>
    <td align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_first_cash" value="<?=text($dmshop['order_first_cash'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:70px;" /></td>
    <td width="5"></td>
    <td class="tx2">원</td>
</tr>
</table>
    </td>
    <td class="bc1"></td>
    <td>
<div style="padding-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="help">회원이 처음으로 상품구매 시, 최초 1회에 한하여 지급</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td align="center"><input type="checkbox" name="check4" value="1" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center" class="text1">상품구매</td>
    <td class="bc1"></td>
    <td align="center">
<select id="order_cash_use" name="order_cash_use" class="select">
    <option value="0">:: 사용안함 ::</option>
    <option value="1">구매 확정시</option>
</select>

<script type="text/javascript">
$("#order_cash_use").val("<?=text($dmshop['order_cash_use'])?>");
</script>
    </td>
    <td class="bc1"></td>
    <td align="center" class="text1"><p>각 상품의</p><p>설정값에 따름</p></td>
    <td class="bc1"></td>
    <td>
<div style="padding-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="help">회원이 상품구매 후 구매확정 버튼클릭 시, 상품등록시 입력된 적립금 지급<br>구매확정 미 클릭 시, 자동 상품수령 기간 경과 후 자동지급</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td align="center"><input type="checkbox" name="check5" value="1" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center" class="text1">게시물 작성</td>
    <td class="bc1"></td>
    <td align="center">
<select id="article_cash_use" name="article_cash_use" class="select">
    <option value="0">:: 사용안함 ::</option>
    <option value="1">게시물 작성시</option>
</select>

<script type="text/javascript">
$("#article_cash_use").val("<?=text($dmshop['article_cash_use'])?>");
</script>
    </td>
    <td class="bc1"></td>
    <td align="center" class="text1"><p>각 게시판의</p><p>설정값에 따름</p></td>
    <td class="bc1"></td>
    <td>
<div style="padding-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="help">게시판에 게시물 작성 시, 각 게시판의 설정에 입력된 적립금 지급</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td align="center"><input type="checkbox" name="check6" value="1" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center" class="text1">댓글 작성</td>
    <td class="bc1"></td>
    <td align="center">
<select id="reply_cash_use" name="reply_cash_use" class="select">
    <option value="0">:: 사용안함 ::</option>
    <option value="1">댓글 작성시</option>
</select>

<script type="text/javascript">
$("#reply_cash_use").val("<?=text($dmshop['reply_cash_use'])?>");
</script>
    </td>
    <td class="bc1"></td>
    <td align="center" class="text1"><p>각 게시판의</p><p>설정값에 따름</p></td>
    <td class="bc1"></td>
    <td>
<div style="padding-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="help">게시판에 댓글 작성 시, 각 게시판의 설정에 입력된 적립금 지급</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="configSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./config_cash.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 입력하신 설정값이 저장 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>