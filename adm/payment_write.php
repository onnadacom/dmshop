<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "4";

if ($m == '') {

    $menu_id = "301";
    $shop['title'] = "개별결제창 발급";

} else {

    $menu_id = "300";
    $shop['title'] = "개별결제창 수정";

}

$colspan = "6";

if ($m == '') {

    $arr_alphabet = "";
    $arr_alphabet = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $pay_code = $arr_alphabet[rand(0,25)].$arr_alphabet[rand(0,25)].date("ymd", $shop['server_time']).rand(1000,9999);

    // 상품
    $dmshop_payment = shop_payment_code($pay_code);

    if ($dmshop_payment['id']) {

        alert("결제번호 생성중에 일시적인 오류가 발생되었습니다.\\n\\n다시 시도하여 주시기 바랍니다.");

    }

    $dmshop_payment['pay_code'] = $pay_code;
    $dmshop_payment['pay_type'] = 1;

}

else if ($m == 'u') {

    if (!$pay_id) {

        alert("발급내역이 삭제되었거나 존재하지 않습니다.");

    }

    $dmshop_payment = shop_payment($pay_id);

    if (!$dmshop_payment['id']) {

        alert("발급내역이 삭제되었거나 존재하지 않습니다.");

    }

    // 휴대폰
    if ($dmshop_payment['user_hp']) {

        $dmshop_payment['user_hp1'] = shop_split("-", $dmshop_payment['user_hp'], "0");
        $dmshop_payment['user_hp2'] = shop_split("-", $dmshop_payment['user_hp'], "1");
        $dmshop_payment['user_hp3'] = shop_split("-", $dmshop_payment['user_hp'], "2");

    }

    // 일반전화
    if ($user['user_tel']) {

        $dmshop_payment['user_tel1'] = shop_split("-", $dmshop_payment['user_tel'], "0");
        $dmshop_payment['user_tel2'] = shop_split("-", $dmshop_payment['user_tel'], "1");
        $dmshop_payment['user_tel3'] = shop_split("-", $dmshop_payment['user_tel'], "2");

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

include_once("./_top.php");
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .select2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select2 .selectBox-dropdown {width:20px; height:19px;}
.contents_box .select2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    $(".tip1").simpletip({ content: '도움말 1' });
    $(".tip2").simpletip({ content: '도움말 2' });
    $(".tip3").simpletip({ content: '도움말 3' });
    $(".tip4").simpletip({ content: '도움말 4' });
    $(".tip5").simpletip({ content: '도움말 5' });
    $(".tip6").simpletip({ content: '도움말 6' });
    $(".tip7").simpletip({ content: '도움말 7' });

});
</script>

<script type="text/javascript">
$(document).ready( function() {
    $(".contents_box .select2 select").selectBox();
});
</script>

<script type="text/javascript">
function paySubmit()
{

    var f = document.formPayment;

    if (f.m.value == '') {

    if (f.m.value == '' && f.pay_code.value == '') {

        alert('결제번호를 입력하세요.');
        f.pay_code.focus();
        return false;

    }

    if (f.m.value == '' && f.pay_code_chk.value == '') {

        alert('결제번호 중복확인을 하세요.');
        f.pay_code.focus();
        return false;

    }

    if (f.user_id.value == '') {

        alert('회원 아이디를 입력하세요.');
        f.user_id.focus();
        return false;

    }

    if (f.m.value == '' && f.user_id_chk.value == '') {

        alert('회원 아이디 확인버튼을 클릭하세요.');
        f.user_id.focus();
        return false;

    }

    if (f.user_name.value == '') {

        alert('성명을 입력하세요.');
        f.user_name.focus();
        return false;

    }

    if (f.user_addr1.value == '') {

        alert('주소를 입력하세요.');
        f.user_zip1.focus();
        return false;

    }

    if (f.user_addr2.value == '') {

        alert('상세주소를 입력하세요.');
        f.user_addr2.focus();
        return false;

    }

    if (f.user_hp1.value == '' || f.user_hp2.value == '' || f.user_hp3.value == '') {

        alert('휴대폰 번호를 입력하세요.');
        f.user_hp3.focus();
        return false;

    }

    if (f.user_tel1.value == '' || f.user_tel2.value == '' || f.user_tel3.value == '') {

        alert('자택 전화번호를 입력하세요.');
        f.user_tel3.focus();
        return false;

    }

    if (f.pay_money.value == '' || f.pay_money.value == '0') {

        alert('결제금액을 입력하세요.');
        f.pay_money.focus();
        return false;

    }

    if (f.pay_title.value == '') {

        alert('제목을 입력하세요.');
        f.pay_title.focus();
        return false;

    }

    }

    if (f.pay_memo.value == '') {

        alert('전달 메세지를 입력하세요.');
        f.pay_memo.focus();
        return false;

    }

    if (f.m.value == '') {

        var message = "발급하시겠습니까?";

    } else {

        var message = "수정하시겠습니까?";

    }

    if (!confirm(message)) {

        return false;

    }

    f.action = "./payment_write_update.php";
    f.submit();

}

function payBank(mode)
{

    var f = document.formPayment;

    if (mode == 'bank_ok') {

        var message = "결제완료 상태로 변경하시겠습니까?";

    }

    else if (mode == 'bank_cancel') {

        var message = "결제전 상태로 변경하시겠습니까?";

    } else {

        var message = "취소완료 상태로 변경하시겠습니까?";

    }

    if (!confirm(message)) {

        return false;

    }

    f.m.value = mode;

    f.action = "./payment_write_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formPayment" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="pay_id" value="<?=$pay_id?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="">
</colgroup>
<tr height="100" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">개별결제창 유의사항</td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">개별결제창은 회원 ID를 바탕으로, 1인에게만 발급되는 개인 결제창 입니다. 회원은 마이페이지 > 개별결제창 메뉴를 통해 확인/결제가 가능 합니다.<br>주로 도매회원의 대량구매, 반품/교환으로 인한 차액/배송비 등 특정 회원에게 임의의 금액을 지정된 결제수단으로 청구하고자 할 때 사용 합니다.<br>- 개별결제창은 주문·배송 메뉴에서 관리하지 않으며, 본 개별결제창 발급내역 메뉴를 통해서만 관리가 가능하며, 통계분석 기능에서는 제외 됩니다.<br>- 개별결제창은 결제상태 확인(결제전/결제완료)과 취소여부 확인(취소접수/취소완료)만 제공되므로 이 점 유의하시기 바랍니다.</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 개별결제창 기본·결제 정보 ::</td>
</tr>
<? if ($m == 'u') { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">결제상태</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
// 취소접수
if ($dmshop_payment['pay_payment'] == '300') {
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="order_type_<?=$dmshop_payment['pay_payment']?>"><?=shop_payment_type($dmshop_payment['pay_payment']);?></span></td>
    <td width="10"></td>
    <td><a href="#" onclick="payBank('cancel'); return false;"><img src="<?=$shop['image_path']?>/adm/cancel_ok.gif" border="0"></a></td>
</tr>
</table>
<?
}

// 무통장
else if ($dmshop_payment['pay_type'] == '5' && $dmshop_payment['pay_payment'] != '300' && $dmshop_payment['pay_payment'] != '301') {
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="order_type_<?=$dmshop_payment['pay_payment']?>"><?=shop_payment_type($dmshop_payment['pay_payment']);?></span></td>
    <td width="10"></td>
<? if ($dmshop_payment['pay_payment'] == '100') { ?>
    <td><a href="#" onclick="payBank('bank_ok'); return false;"><img src="<?=$shop['image_path']?>/adm/payment_ok.gif" border="0"></a></td>
<? } else { ?>
    <td><a href="#" onclick="payBank('bank_cancel'); return false;"><img src="<?=$shop['image_path']?>/adm/payment_cancel.gif" border="0"></a></td>
<? } ?>
</tr>
</table>
<?
} else { ?>
<span class="order_type_<?=$dmshop_payment['pay_payment']?>"><?=shop_payment_type($dmshop_payment['pay_payment']);?></span>
<? } ?>
    </td>
    <td></td>
</tr>
<? } ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">결제번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<? if ($m == '') { ?>
<input type="hidden" id="pay_code_chk" name="pay_code_chk" value="" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="pay_code" name="pay_code" value="<?=$dmshop_payment['pay_code']?>" maxlength="20" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="paycodeCheck(); return false;"><img src="<?=$shop['image_path']?>/adm/check.gif" border="0"></a></td>
    <td width="13"></td>
    <td class="help1"><span id="pay_code_msg">중복확인 버튼을 클릭하여주시기 바랍니다.</span></td>
</tr>
</table>

<script type="text/javascript">
$("#pay_code_chk").val("");

function paycodeCheck()
{

    var pay_code = $("#pay_code").val();

    if (!pay_code) {

        alert("결제번호를 입력하세요.");
        $("#pay_code").focus();
        return false;

    }

    $.post("./payment_code_check.php", {"pay_code" : pay_code}, function(data) {

        $("#dmshop_update").html(data);

    });

}
</script>
<? } else { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="payPopupDetail('<?=$dmshop_payment['pay_code']?>'); return false;" class="order_code"><?=$dmshop_payment['pay_code']?></a></td>
</tr>
</table>
<? } ?>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">회원ID</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<? if ($m == '') { ?>
<input type="hidden" id="user_id_chk" name="user_id_chk" value="" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="user_id" name="user_id" value="<?=text($dmshop_payment['user_id'])?>" maxlength="20" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="useridCheck(); return false;"><img src="<?=$shop['image_path']?>/adm/overlap_id.gif" border="0"></a></td>
    <td width="13"></td>
    <td class="help1"><span id="user_id_msg">ID확인 버튼을 클릭하여주시기 바랍니다.</span></td>
</tr>
</table>

<script type="text/javascript">
$("#user_id_chk").val("");

function useridCheck()
{

    var user_id = $("#user_id").val();

    if (!user_id) {

        alert("회원아이디를 입력하세요.");
        $("#user_id").focus();
        return false;

    }

    $.post("./payment_user_check.php", {"user_id" : user_id}, function(data) {

        $("#dmshop_update").html(data);

    });

}
</script>
<? } else { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=text($dmshop_payment['user_id'])?></td>
</tr>
</table>
<? } ?>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><p><span class="tip3">회원 정보</span></p><p>(수령 정보)</p></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="51">
    <td width="30"></td>
    <td width="110" class="text1">성명 (수령자명)</td>
    <td>
<? if ($m == '') { ?>
<input type="text" id="user_name" name="user_name" value="<?=text($dmshop_payment['user_name'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" />
<? } else { ?>
<span class="tx2"><?=text($dmshop_payment['user_name'])?></span>
<? } ?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" class="bc1 none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="30"></td>
    <td width="110" class="text1">주소 (배송지)</td>
    <td>
<? if ($m == '') { ?>
<div style="padding:15px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="50"><input type="text" id="user_zip1" name="user_zip1" value="<?=text($dmshop_payment['user_zip1'])?>" readonly onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td width="50"><input type="text" id="user_zip2" name="user_zip2" value="<?=text($dmshop_payment['user_zip2'])?>" readonly onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="shopZip('formPayment', 'user_zip1', 'user_zip2', 'user_addr1', 'user_addr2'); return false;"><img src="<?=$shop['image_path']?>/adm/find_addr.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="text" id="user_addr1" name="user_addr1" value="<?=text($dmshop_payment['user_addr1'])?>" readonly onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:300px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td><input type="text" id="user_addr2" name="user_addr2" value="<?=text($dmshop_payment['user_addr2'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:300px;" /></td>
</tr>
</table>
</div>
<? } else { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="51">
    <td class="tx2">(우 : <?=text($dmshop_payment['user_zip1'])?><?=text($dmshop_payment['user_zip2'])?>) <?=text($dmshop_payment['user_addr1'])?> <?=text($dmshop_payment['user_addr2'])?></td>
</tr>
</table>
<? } ?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" class="bc1 none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="51">
    <td width="30"></td>
    <td width="110" class="text1">휴대폰 번호</td>
    <td>
<? if ($m == '') { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="user_hp1" name="user_hp1" class="select"><?=shop_option_sms1();?></select>

<script type="text/javascript">
$("#user_hp1").val("<?=text($dmshop_payment['user_hp1'])?>");
</script>
    </td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" id="user_hp2" name="user_hp2" value="<?=text($dmshop_payment['user_hp2'])?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" id="user_hp3" name="user_hp3" value="<?=text($dmshop_payment['user_hp3'])?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
</tr>
</table>
<? } else { ?>
<span class="tx2"><?=text($dmshop_payment['user_hp'])?></span>
<? } ?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" class="bc1 none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="51">
    <td width="30"></td>
    <td width="110" class="text1">자택 전화번호</td>
    <td>
<? if ($m == '') { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="user_tel1" name="user_tel1" class="select"><?=shop_option_sms1();?></select>

<script type="text/javascript">
$("#user_tel1").val("<?=text($dmshop_payment['user_tel1'])?>");
</script>
    </td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" id="user_tel2" name="user_tel2" value="<?=text($dmshop_payment['user_tel2'])?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="16" align="center"><span class="tx2">-</span></td>
    <td><input type="text" id="user_tel3" name="user_tel3" value="<?=text($dmshop_payment['user_tel3'])?>" maxlength="4" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
</tr>
</table>
<? } else { ?>
<span class="tx2"><?=text($dmshop_payment['user_tel'])?></span>
<? } ?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" class="bc1 none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="51">
    <td width="30"></td>
    <td width="110" class="text1">이메일 주소</td>
    <td>
<? if ($m == '') { ?>
<input type="text" id="user_email" name="user_email" value="<?=text($dmshop_payment['user_email'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:250px;" /></td>
<? } else { ?>
<span class="tx2"><?=text($dmshop_payment['user_email'])?></span>
<? } ?>
    </td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">결제금액</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<? if ($m == '') { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="pay_money" value="<?=text($dmshop_payment['pay_money'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" /></td>
    <td width="10"></td>
    <td class="text1">원</td>
</tr>
</table>
<? } else { ?>
<span class="tx2"><?=number_format($dmshop_payment['pay_money']);?> 원</span>
<? } ?>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">결제수단</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<? if ($m == '') { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="pay_type" value="1" class="radio" <? if ($dmshop_payment['pay_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formPayment', 'pay_type', '0');">신용카드</td>
    <td width="30"></td>
    <td><input type="radio" name="pay_type" value="2" class="radio" <? if ($dmshop_payment['pay_type'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formPayment', 'pay_type', '1');">실시간 계좌이체</td>
    <td width="30"></td>
    <td><input type="radio" name="pay_type" value="3" class="radio" <? if ($dmshop_payment['pay_type'] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formPayment', 'pay_type', '2');">휴대폰 결제</td>
    <td width="30"></td>
    <td><input type="radio" name="pay_type" value="4" class="radio" <? if ($dmshop_payment['pay_type'] == '4') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formPayment', 'pay_type', '3');">가상계좌</td>
    <td width="30"></td>
    <td><input type="radio" name="pay_type" value="5" class="radio" <? if ($dmshop_payment['pay_type'] == '5') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formPayment', 'pay_type', '4');">무통장 입금</td>
</tr>
</table>
<? } else { ?>
<span class="tx2"><?=shop_pay_name($dmshop_payment['pay_type']);?></span>
<? } ?>
    </td>
    <td></td>
</tr>
<? if ($m == 'u') { ?>
<? if ($dmshop_payment['pay_type'] == '5') { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">입금은행</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><?=text($dmshop_payment['pay_bank_name'])?> <?=text($dmshop_payment['pay_bank_number'])?> (예금주 : <?=text($dmshop_payment['pay_bank_holder'])?>)</span></td>
    <td></td>
</tr>
<? } ?>
<?
// 카드, 이체, 휴대폰, 가상
if ($dmshop_payment['pay_type'] == '1' || $dmshop_payment['pay_type'] == '2' || $dmshop_payment['pay_type'] == '3' || $dmshop_payment['pay_type'] == '4') {
?>
<? if ($dmshop_payment['pay_pg_code1']) { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">PG 승인거래번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><?=text($dmshop_payment['pay_pg_code1'])?></span></td>
    <td></td>
</tr>
<? } ?>
<? if ($dmshop_payment['pay_pg_code1_date']) { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">PG 승인일자</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><?=text($dmshop_payment['pay_pg_code1_date'])?></span></td>
    <td></td>
</tr>
<? } ?>
<? if ($dmshop_payment['pay_pg_code1_time']) { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">PG 승인시간</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><?=text($dmshop_payment['pay_pg_code1_time'])?></span></td>
    <td></td>
</tr>
<? } ?>
<? if ($dmshop_payment['pay_pg_code2']) { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">가상계좌 거래번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><?=text($dmshop_payment['pay_pg_code2'])?></span></td>
    <td></td>
</tr>
<? } ?>
<? if ($dmshop_payment['pay_pg_code2_date']) { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">가상계좌 승인일자</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><?=text($dmshop_payment['pay_pg_code2_date'])?></span></td>
    <td></td>
</tr>
<? } ?>
<? if ($dmshop_payment['pay_pg_code2_time']) { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">가상계좌 승인시간</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><?=text($dmshop_payment['pay_pg_code2_time'])?></span></td>
    <td></td>
</tr>
<? } ?>
<? if ($dmshop_payment['pay_pg_card_code']) { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">신용카드 거래번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><?=text($dmshop_payment['pay_pg_card_code'])?></span></td>
    <td></td>
</tr>
<? } ?>
<? if ($dmshop_payment['pay_pg_code3']) { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">영수증 거래번호</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><?=text($dmshop_payment['pay_pg_code3'])?></span></td>
    <td></td>
</tr>
<? } ?>
<? if ($dmshop_payment['pay_pg_code3_date']) { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">영수증 승인일자</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><?=text($dmshop_payment['pay_pg_code3_date'])?></span></td>
    <td></td>
</tr>
<? } ?>
<? if ($dmshop_payment['pay_pg_code3_time']) { ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">영수증 승인시간</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><?=text($dmshop_payment['pay_pg_code3_time'])?></span></td>
    <td></td>
</tr>
<? } ?>
<? } ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">결제일시</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><span class="tx2"><? if ($dmshop_payment['pay_ok_datetime'] == '0000-00-00 00:00:00') { echo shop_payment_type($dmshop_payment['pay_payment']); } else { echo $dmshop_payment['pay_ok_datetime']; } ?></span></td>
    <td></td>
</tr>
<? } ?>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">제목</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<? if ($m == '') { ?>
<input type="text" name="pay_title" value="<?=text($dmshop_payment['pay_title'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:460px;" />
<? } else { ?>
<span class="tx2"><?=text($dmshop_payment['pay_title'])?></span>
<? } ?>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="200">
    <td></td>
    <td class="subject"><p><span class="tip7">전달 메세지</span></p><? if ($m == 'u') { ?><p>(내용 추가/수정)</p><? } ?></td>
    <td class="bc1"></td>
    <td></td>
    <td><textarea id="pay_memo" name="pay_memo" class="textarea1" style="width:455px; height:140px;"><?=text($dmshop_payment['pay_memo'])?></textarea></td>
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
    <td><a href="#" onclick="paySubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./payment_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 개별결제창이 <? if ($m == '') { echo "발급"; } else { echo "수정"; } ?> 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>