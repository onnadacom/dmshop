<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "8";
$menu_id = "402";
$shop['title'] = "기타 스킨 설정";
include_once("./_top.php");

$colspan = "6";
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select1 .selectBox-dropdown {width:180px; height:19px;}
.contents_box .select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    $(".contents_box .select1 select").selectBox();

    $(".tip1").simpletip({ content: '회원가입 스킨을 선택합니다.' });
    $(".tip2").simpletip({ content: '로그인 스킨을 선택합니다.' });
    $(".tip3").simpletip({ content: 'ID/PW 찾기 스킨을 선택합니다.' });
    $(".tip4").simpletip({ content: '우편번호 찾기 스킨을 선택합니다.' });
    $(".tip5").simpletip({ content: '팝업창 스킨을 선택합니다.' });
    $(".tip6").simpletip({ content: 'SMS 스킨을 선택합니다.' });
    $(".tip7").simpletip({ content: 'E-Mail 스킨을 선택합니다.' });
    $(".tip8").simpletip({ content: '상품 검색결과 스킨을 선택합니다.' });
    $(".tip9").simpletip({ content: '상품 갤러리 스킨을 선택합니다.' });
    $(".tip10").simpletip({ content: '상품 미리보기 스킨을 선택합니다.' });
    $(".tip11").simpletip({ content: '상품 주문 스킨을 선택합니다.' });
    $(".tip12").simpletip({ content: '마이페이지 스킨을 선택합니다.' });
    $(".tip13").simpletip({ content: '주문내역 스킨을 선택합니다.' });
    $(".tip14").simpletip({ content: '비회원 주문내역 스킨을 선택합니다.' });
    $(".tip15").simpletip({ content: '적립금 내역 스킨을 선택합니다.' });
    $(".tip16").simpletip({ content: '쿠폰함 스킨을 선택합니다.' });
    $(".tip17").simpletip({ content: '개별 결제창 스킨을 선택합니다.' });
    $(".tip18").simpletip({ content: '교환신청 내역 스킨을 선택합니다.' });
    $(".tip19").simpletip({ content: '반품신청 내역 스킨을 선택합니다.' });
    $(".tip20").simpletip({ content: '주문취소 내역 스킨을 선택합니다.' });
    $(".tip21").simpletip({ content: '1:1문의 스킨을 선택합니다.' });
    $(".tip22").simpletip({ content: '관심상품 스킨을 선택합니다.' });
    $(".tip23").simpletip({ content: '장바구니 스킨을 선택합니다.' });
    $(".tip24").simpletip({ content: '배송조회 스킨을 선택합니다.' });
    $(".tip25").simpletip({ content: '배송지 변경 스킨을 선택합니다.' });
    $(".tip26").simpletip({ content: '주문상세정보 스킨을 선택합니다.' });
    $(".tip27").simpletip({ content: '주문옵션 변경 스킨을 선택합니다.' });

});
</script>

<script type="text/javascript">
function designSubmit()
{

    var f = document.formDesign;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./design_skin_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formDesign" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="select1">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">기타 스킨 설정안내</td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">스킨이란 쇼핑몰의 운영을 위해 필요한 디자인, 기능이 포함된 파일 입니다. 스킨은 DM SHOP 자료실을 통해 다운로드 하실 수 있습니다.<br>이곳에서는 회원가입, 마이페이지 등에서 사용되는 스킨을 설정하며, 아래에서 제외된 메인, 상품페이지 등의 스킨은 해당 설정 페이지에서 변경하시기 바랍니다.</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 부분·기능 스킨 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">회원가입</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_signup" name="skin_signup" class="select">
<?
$skin_array = shop_skin_dir("signup");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_signup").val("<?=text($dmshop_skin['skin_signup'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/signup</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">로그인</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_signin" name="skin_signin" class="select">
<?
$skin_array = shop_skin_dir("signin");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_signin").val("<?=text($dmshop_skin['skin_signin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/signin</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">ID/PW 찾기</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_find" name="skin_find" class="select">
<?
$skin_array = shop_skin_dir("find");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_find").val("<?=text($dmshop_skin['skin_find'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/find</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">우편번호 찾기</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_zip" name="skin_zip" class="select">
<?
$skin_array = shop_skin_dir("zip");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_zip").val("<?=text($dmshop_skin['skin_zip'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/zip</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">팝업창</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_popup" name="skin_popup" class="select">
<?
$skin_array = shop_skin_dir("popup");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_popup").val("<?=text($dmshop_skin['skin_popup'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/popup</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">SMS</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_sms" name="skin_sms" class="select">
<?
$skin_array = shop_skin_dir("sms");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_sms").val("<?=text($dmshop_skin['skin_sms'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/sms</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip7">E-Mail</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_email" name="skin_email" class="select">
<?
$skin_array = shop_skin_dir("email");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_email").val("<?=text($dmshop_skin['skin_email'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/email</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상품 관련 스킨 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8">상품 검색결과</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_search" name="skin_search" class="select">
<?
$skin_array = shop_skin_dir("search");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_search").val("<?=text($dmshop_skin['skin_search'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/search</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip9">상품 갤러리</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_item_gallery" name="skin_item_gallery" class="select">
<?
$skin_array = shop_skin_dir("item_gallery");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_item_gallery").val("<?=text($dmshop_skin['skin_item_gallery'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/item_gallery</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip10">상품 미리보기</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_item_preview" name="skin_item_preview" class="select">
<?
$skin_array = shop_skin_dir("item_preview");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_item_preview").val("<?=text($dmshop_skin['skin_item_preview'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/item_preview</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip11">상품 주문</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_order" name="skin_order" class="select">
<?
$skin_array = shop_skin_dir("order");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_order").val("<?=text($dmshop_skin['skin_order'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/order</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 마이페이지 관련 스킨 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip12">마이페이지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_mypage" name="skin_mypage" class="select">
<?
$skin_array = shop_skin_dir("mypage");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_mypage").val("<?=text($dmshop_skin['skin_mypage'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/mypage</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip13">주문내역</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_order_list" name="skin_order_list" class="select">
<?
$skin_array = shop_skin_dir("order_list");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_order_list").val("<?=text($dmshop_skin['skin_order_list'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/order_list</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip14">비회원 주문내역</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_order_guest" name="skin_order_guest" class="select">
<?
$skin_array = shop_skin_dir("order_guest");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_order_guest").val("<?=text($dmshop_skin['skin_order_guest'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/order_guest</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip15">적립금 내역</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_cash" name="skin_cash" class="select">
<?
$skin_array = shop_skin_dir("cash");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_cash").val("<?=text($dmshop_skin['skin_cash'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/cash</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip16">쿠폰함</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_coupon" name="skin_coupon" class="select">
<?
$skin_array = shop_skin_dir("coupon");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_coupon").val("<?=text($dmshop_skin['skin_coupon'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/coupon</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip17">개별 결제창</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_payment" name="skin_payment" class="select">
<?
$skin_array = shop_skin_dir("payment");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_payment").val("<?=text($dmshop_skin['skin_payment'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/payment</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip18">교환신청 내역</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_exchange" name="skin_exchange" class="select">
<?
$skin_array = shop_skin_dir("exchange");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_exchange").val("<?=text($dmshop_skin['skin_exchange'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/exchange</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip19">반품신청 내역</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_refund" name="skin_refund" class="select">
<?
$skin_array = shop_skin_dir("refund");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_refund").val("<?=text($dmshop_skin['skin_refund'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/refund</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip20">주문취소 내역</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_cancel" name="skin_cancel" class="select">
<?
$skin_array = shop_skin_dir("cancel");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_cancel").val("<?=text($dmshop_skin['skin_cancel'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/cancel</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip21">1:1문의</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_help" name="skin_help" class="select">
<?
$skin_array = shop_skin_dir("help");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_help").val("<?=text($dmshop_skin['skin_help'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/help</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip22">관심상품</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_favorite" name="skin_favorite" class="select">
<?
$skin_array = shop_skin_dir("favorite");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_favorite").val("<?=text($dmshop_skin['skin_favorite'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/favorite</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip23">장바구니</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_cart" name="skin_cart" class="select">
<?
$skin_array = shop_skin_dir("cart");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_cart").val("<?=text($dmshop_skin['skin_cart'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/cart</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip24">배송조회</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_order_delivery" name="skin_order_delivery" class="select">
<?
$skin_array = shop_skin_dir("order_delivery");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_order_delivery").val("<?=text($dmshop_skin['skin_order_delivery'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/order_delivery</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip25">배송지 변경</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_order_address" name="skin_order_address" class="select">
<?
$skin_array = shop_skin_dir("order_address");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_order_address").val("<?=text($dmshop_skin['skin_order_address'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/order_address</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip26">주문상세정보</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_order_view" name="skin_order_view" class="select">
<?
$skin_array = shop_skin_dir("order_view");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_order_view").val("<?=text($dmshop_skin['skin_order_view'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/order_view</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip27">주문옵션 변경</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin_order_option" name="skin_order_option" class="select">
<?
$skin_array = shop_skin_dir("order_option");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin_order_option").val("<?=text($dmshop_skin['skin_order_option'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : /skin/order_option</td>
</tr>
</table>
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
    <td><a href="#" onclick="designSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./design_skin.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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