<?php
include_once("./_dmshop.php");
if ($sms_list) { $sms_list = preg_match("/^[0-9]+$/", $sms_list) ? $sms_list : ""; }
$top_id = "2";
$left_id = "5";

if ($sms_list == '1') {

    $menu_id = "301";
    $shop['title'] = "관리자용 자동발송";

} else {

    $menu_id = "300";
    $shop['title'] = "고객용 자동발송";

}

include_once("./_top.php");

$colspan = "10";
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.select1 .selectBox-dropdown {width:100px; height:19px;}
.select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.select2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.select2 .selectBox-dropdown {width:45px; height:19px;}
.select2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".select1 select").selectBox();
    $(".select2 select").selectBox();
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

        alert(msg + "할 설정을 선택하세요.");
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

    if (!confirm("선택한 설정을 저장 하시겠습니까?")) {

        return false;

    }

    f.action = "./sms_config_update.php";
    f.submit();

}

function smsBg(id, val)
{

    document.getElementById("sms_bg"+id).className = "sms_bg"+val;

}
</script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="tx1">목록 선택</td>
    <td width="10"></td>
    <td class="select1">
<select id="sms_list" name="sms_list" class="select" onchange="document.location.href = './sms_config.php?sms_list='+this.value+'';">
    <option value="0">회원 수신용 문자</option>
    <option value="1">관리자 수신용 문자</option>
</select>
    </td>
</tr>
</table>
    </td>
</tr>
</table>

<script type="text/javascript">
<? if ($sms_list) { ?>$("#sms_list").val("<?=$sms_list?>");<? } ?>
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<?
// 0부터 시작하기 위해 설정
$i = -1;
?>
<form method="post" name="formList" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="form_list select2">
<colgroup>
    <col width="20">
    <col width="25">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="100">
    <col width="1">
    <col width="170">
    <col width="1">
    <col width="">
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
</tr>
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td><input type="checkbox" onclick="if (this.checked) checkAll(true); else checkAll(false);" class="checkbox" /></td>
    <td class="bc1"></td>
    <td class="boxtitle">조건</td>
    <td class="bc1"></td>
    <td class="boxtitle">사용유무</td>
    <td class="bc1"></td>
    <td class="boxtitle">SMS 내용</td>
    <td class="bc1"></td>
    <td class="boxtitle">도움말</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<? if ($sms_list == '0' || !$sms_list) { ?>
<!-- 1 start //-->
<? $i++; $shop_sms_config = shop_sms_config("signup"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">회원가입 완료</p><p class="subject2">회원 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 회원가입 완료 시<br>
발송방식 : <span class="sms_auto">자동 발송</span><br>
자동완성 : <b>[성명]</b> : 가입자 실명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[아이디]</b> : 가입자 아이디<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[URL]</b> : 기본 환경설정의 쇼핑몰URL에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 1 end //-->
<!-- 2 start //-->
<? $i++; $shop_sms_config = shop_sms_config("hp_real"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">휴대폰 인증</p><p class="subject2">입력된 번호</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 회원가입 중, 휴대폰 인증 시<br>
발송방식 : <span class="sms_self">회원 요청시 발송</span><br>
자동완성 : <b>[인증키]</b> : 휴대폰 인증을 위해 발송되는 6자리 숫자<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[URL]</b> : 기본 환경설정의 쇼핑몰URL에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 2 end //-->
<!-- 3 start //-->
<? $i++; $shop_sms_config = shop_sms_config("birth"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">생일기념</p><p class="subject2">회원 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 회원가입 시 입력된, 회원의 생일(당일)<br>
발송방식 : <span class="sms_auto">자동 발송</span><br>
자동완성 : <b>[성명]</b> : 가입자 실명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[아이디]</b> : 가입자 아이디<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[URL]</b> : 기본 환경설정의 쇼핑몰URL에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 3 end //-->
<!-- 4 start //-->
<? $i++; $shop_sms_config = shop_sms_config("order"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">상품주문시</p><p class="subject2">회원 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 상품주문 시<br>
발송방식 : <span class="sms_auto">자동 발송</span><br>
자동완성 : <b>[주문번호]</b> : 회원이 주문한 상품의 주문번호<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[주문상품]</b> : 회원이 주문한 상품의 상품명 (예 : 후트티, 후드티 외 2개)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 4 end //-->
<!-- 5 start //-->
<? $i++; $shop_sms_config = shop_sms_config("order_pg"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">결제정보 안내<br>(전자결제)</p><p class="subject2">회원 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 결제수단이 전자결제(신용카드, 실시간 계좌이체, 휴대폰 결제, 가상계좌)일 시<br>
발송방식 : <span class="sms_auto">자동 발송</span><br>
자동완성 : <b>[결제금액]</b> : 회원이 주문한 상품의 결제금액<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[입금자명]</b> : 회원이 상품주문시 입력한 입금자명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 5 end //-->
<!-- 6 start //-->
<? $i++; $shop_sms_config = shop_sms_config("order_bank"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">결제정보 안내<br>(무통장 입금)</p><p class="subject2">회원 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 결제수단이 무통장입금일 시<br>
발송방식 : <span class="sms_auto">자동 발송</span><br>
자동완성 : <b>[은행명], [계좌], [예금주]</b> : 기본 환경설정의 무통장입금 정보에 입력하신 내용<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[결제금액]</b> : 회원이 입금해야할 금액<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[입금자명]</b> : 회원이 상품주문시 입력한 입금자명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 6 end //-->
<!-- 7 start //-->
<? $i++; $shop_sms_config = shop_sms_config("order_bank_self"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">입금정보<br>문자로 받기</p><p class="subject2">입력된 번호</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 결제수단이 무통장입금일 시<br>
발송방식 : <span class="sms_self">회원 셀프 발송 (내용수정 및 수신번호 변경 가능)</span><br>
자동완성 : <b>[은행명], [계좌], [예금주]</b> : 기본 환경설정의 무통장입금 정보에 입력하신 내용<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[결제금액]</b> : 회원이 입금해야할 금액<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[입금자명]</b> : 회원이 상품주문시 입력한 입금자명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 7 end //-->
<!-- 8 start //-->
<? $i++; $shop_sms_config = shop_sms_config("order_bank_ok"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">무통장 입금확인</p><p class="subject2">회원 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 관리자 모드 > 주문관리 옵션 > 결제정보에서 [입금확인] 시<br>
발송방식 : <span class="sms_choice">관리자 선택 발송</span><br>
자동완성 : <b>[은행명], [계좌], [예금주]</b> : 기본 환경설정의 무통장입금 정보에 입력하신 내용<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[결제금액]</b> : 회원이 입금해야할 금액<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[입금자명]</b> : 회원이 상품주문시 입력한 입금자명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 8 end //-->
<!-- 9 start //-->
<? $i++; $shop_sms_config = shop_sms_config("delivery"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">상품 발송</p><p class="subject2">회원 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 관리자 모드 > 주문관리 옵션 > 상품발송에서 [발송확인] 시<br>
발송방식 : <span class="sms_choice">관리자 선택 발송</span><br>
자동완성 : <b>[주문번호]</b> : 회원이 주문한 상품의 주문번호<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[주문상품]</b> : 회원이 주문한 상품의 상품명 (예 : 후트티, 후드티 외 2개)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[배송업체], [배송연락처], [운송장]</b> : 상품발송 정보에 각각 입력하신 내용<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 9 end //-->
<!-- 10 start //-->
<? $i++; $shop_sms_config = shop_sms_config("coupon"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">쿠폰 지급<br>(관리자 지급)</p><p class="subject2">회원 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 관리자 모드 > 쿠폰생성관리 > 쿠폰지급에서 [지급대상]을 선택하여 지급 시<br>
발송방식 : <span class="sms_choice">관리자 선택 발송</span><br>
자동완성 : <b>[성명]</b> : 가입자 실명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쿠폰명]</b> : 쿠폰발행 목록의 생성된 쿠폰명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쿠폰정보]</b> : 쿠폰발행 목록의 생성된 쿠폰의 할/혜택 정보  (예 : 1000원, 10%)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 10 end //-->
<!-- 11 start //-->
<? $i++; $shop_sms_config = shop_sms_config("coupon_auto"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">쿠폰 지급<br>(자동 지급)</p><p class="subject2">회원 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 관리자 모드 > 쿠폰생성관리 > 자동지급 설정 후, 쿠폰 자동발급 시<br>
발송방식 : <span class="sms_auto">자동 발송</span><br>
자동완성 : <b>[성명]</b> : 가입자 실명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쿠폰명]</b> : 쿠폰발행 목록의 생성된 쿠폰명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쿠폰정보]</b> : 쿠폰발행 목록의 생성된 쿠폰의 할/혜택 정보  (예 : 1000원, 10%)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 11 end //-->
<!-- 12 start //-->
<? $i++; $shop_sms_config = shop_sms_config("help"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">1:1문의 답변</p><p class="subject2">회원 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 회원이 작성한 1:1문의 글에 관리자가 [답변등록] 시<br>
발송방식 : <span class="sms_choice">관리자 선택 발송</span><br>
자동완성 : <b>[성명]</b> : 가입자 실명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 12 end //-->
<? } else { ?>
<!-- 1 start //-->
<? $i++; $shop_sms_config = shop_sms_config("adm_signup"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">회원가입</p><p class="subject2">관리자 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 회원가입 완료 시<br>
발송방식 : <span class="sms_auto">자동 발송</span><br>
자동완성 : <b>[성명]</b> : 가입자 실명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[아이디]</b> : 가입자 아이디<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[URL]</b> : 기본 환경설정의 쇼핑몰URL에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 1 end //-->
<!-- 2 start //-->
<? $i++; $shop_sms_config = shop_sms_config("admin_order"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">상품주문</p><p class="subject2">관리자 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 상품주문 시<br>
발송방식 : <span class="sms_auto">자동 발송</span><br>
자동완성 : <b>[주문번호]</b> : 회원이 주문한 상품의 주문번호<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[주문상품]</b> : 회원이 주문한 상품의 상품명 (예 : 후트티, 후드티 외 2개)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 2 end //-->
<!-- 3 start //-->
<? $i++; $shop_sms_config = shop_sms_config("admin_order_ok"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">결제완료</p><p class="subject2">관리자 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 결제완료 시<br>
발송방식 : <span class="sms_auto">자동 발송</span><br>
자동완성 : <b>[주문번호]</b> : 회원이 주문한 상품의 주문번호<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[주문상품]</b> : 회원이 주문한 상품의 상품명 (예 : 후트티, 후드티 외 2개)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[쇼핑몰명]</b> : 기본 환경설정의 쇼핑몰명에 입력하신 내용<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 3 end //-->
<!-- 4 start //-->
<? $i++; $shop_sms_config = shop_sms_config("admin_help"); ?>
<input type="hidden" name="sms_code[<?=$i?>]" value="<?=$shop_sms_config['sms_code']?>" />
<tr height="160">
    <td></td>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
    <td class="bc1"></td>
    <td align="center"><p class="subject">1:1문의 접수</p><p class="subject2">관리자 휴대폰</p></td>
    <td class="bc1"></td>
    <td align="center"><select id="sms_use_<?=$i?>" name="sms_use[<?=$i?>]" class="select" onchange="smsBg('<?=$i?>', this.value);"><option value="1">사용</option><option value="0">사용안함</option></select><script type="text/javascript">$('#sms_use_<?=$i?>').val('<?=$shop_sms_config['sms_use']?>');</script></td>
    <td class="bc1"></td>
    <td align="center">
<div id="sms_bg<?=$i?>" class="sms_bg<?=$shop_sms_config['sms_use']?>">
<div style="padding:30px 35px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="sms_message[<?=$i?>]" name="sms_message[<?=$i?>]" onkeyup="shopByte('sms_message[<?=$i?>]', 'sms_message_bytes[<?=$i?>]');" class="sms_message"><?=text($shop_sms_config['sms_message'])?></textarea></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="sms_bytes"><span id="sms_message_bytes[<?=$i?>]">0</span> / 80 바이트</td>
</tr>
</table>
</div>
</div>
    </td>
    <td class="bc1"></td>
    <td>
<div style="margin-left:20px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="sms_etc">
발송조건 : 1:1문의 접수 시<br>
발송방식 : <span class="sms_auto">자동 발송</span><br>
자동완성 : <b>[문의유형]</b> : 1:1문의 접수시 문의 유형<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[성명]</b> : 접수자 성명<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[아이디]</b> : 접수자 아이디<br>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<!-- 4 end //-->
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="checkSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./sms_config.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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