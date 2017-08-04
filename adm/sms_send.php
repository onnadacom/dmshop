<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "5";
$menu_id = "302";
$shop['title'] = "개별·단체 직접발송";

include_once("./_top.php");

$colspan = "6";
?>

<style type="text/css">
.contents_box {min-width:1100px;}

.select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.select1 .selectBox-dropdown {width:100px; height:19px;}
.select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.select2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.select2 .selectBox-dropdown {width:20px; height:19px;}
.select2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.select3 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.select3 .selectBox-dropdown {width:30px; height:19px;}
.select3 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".contents_box .select1 select").selectBox();
    $(".contents_box .select2 select").selectBox();
    $(".contents_box .select3 select").selectBox();
    smsLevelMember("");
    smsAutoLoading("1");
});
</script>

<script type="text/javascript">
function configSubmit()
{

    var f = document.formConfig;

    if (f.sms_message.value == '') {

        alert('내용을 입력하십시오.');
        f.sms_message.focus();
        return false;

    }

    if (f.sms_from.value == '') {

        alert('발신번호를 입력하십시오.');
        f.sms_from.focus();
        return false;

    }

    if (f.sms_type[0].checked == true && f.sms_list.value == '') {

        alert('수신번호를 입력하십시오.');
        f.sms_list.focus();
        return false;

    }

    if (!confirm("발송하시겠습니까?")) {

        return false;

    }

    f.action = "./sms_send_update.php";
    f.submit();

}

function smsTypeLayer(id)
{

    $("#sms_type_layer1").hide();
    $("#sms_type_layer2").hide();

    $("#sms_type_layer"+id).show();

}

function smsLevelMember(level)
{

    $.post("./sms_send_member.php", {"level" : level}, function(data) {

        $("#sms_member").html(data);

    });

}

function smsAuto()
{

    shopOpen("./sms_auto.php", "smsAuto", "width=330, height=330, scrollbars=no");

}

function smsAutoLoading(page)
{

    $.post("./sms_auto_list.php", {"page" : page}, function(data) {

        $("#sms_auto_list").html(data);

    });

}

function smsAutoAdd(id)
{

    var data = $("#sms_auto_list_"+id).val();

    $("#sms_message").val(data);

    shopByte('sms_message', 'sms_message_bytes');

}

function smsMode(mode)
{

    return false;

}

function smsClear()
{

    $("#sms_message").val("");

}

function smsAutoDelete(id)
{

    if (!confirm("삭제 하시겠습니까?")) {

        return false;

    }

    $.post("./sms_auto_update.php", {"form_check" : "<?=$dmshop_user['datetime']?>", "m" : "d", "id" : id}, function(data) {

        $("#sms_auto_list").html(data);

    });

}
</script>

<div class="contents_box">
<form method="post" name="formConfig" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="">
</colgroup>
<tr>
    <td colspan="4" class="pagetitle">:: 메시지 내용 입력 ::</td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">SMS 문자내용</span></td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<div class="sms_bg">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="24"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td width="1"></td>
    <td><a href="#" onclick="smsMode('1'); return false;"><img src="<?=$shop['image_path']?>/adm/sms_mode1.gif" border="0"></a></td>
    <td width="53"><a href="#" onclick="smsClear(); return false;"><img src="<?=$shop['image_path']?>/adm/sms_clear.gif" border="0"></a></td>
    <td width="1"></td>
</tr>
</table>

<div style="padding:15px;"><textarea id="sms_message" name="sms_message" onkeyup="shopByte('sms_message', 'sms_message_bytes');" style="overflow:hidden; width:100px; height:230px; background-color:transparent; border:0px; margin:auto; line-height:15px; font-size:12px; color:#000000; font-family:굴림체,gulim,굴림;">내용을 입력 하세요.</textarea></div>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="9"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td width="50" class="sms_text">내용길이</td>
    <td align="right" class="sms_bytes"><span id="sms_message_bytes">0</span> / 80 바이트</td>
    <td width="10"></td>
</tr>
</table>

</div>
    </td>
    <td width="1" class="bc1"></td>
    <td width="181">
<p class="subject" style="text-align:center;">SMS 자동완성</p>
<p style="text-align:center;"><a href="#" onclick="smsAuto(); return false;"><img src="<?=$shop['image_path']?>/adm/btn_write.gif" border="0" /></a></p>
    </td>
    <td width="1" class="bc1"></td>
    <td valign="top"><div id="sms_auto_list"></div></td>
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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 발신자·수신자 입력 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">발신번호 (보내는 이)</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><input type="text" name="sms_from" value="<?=text($dmshop['rec_sms1']).text($dmshop['rec_sms2']).text($dmshop['rec_sms3'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">발송방식</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="sms_type" value="1" class="radio" onclick="smsTypeLayer(this.value);" checked /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'sms_type', '0'); smsTypeLayer('1');">개별발송</td>
    <td width="30"></td>
    <td><input type="radio" name="sms_type" value="2" class="radio" onclick="smsTypeLayer(this.value);" /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'sms_type', '1'); smsTypeLayer('2');">단체발송 (회원 등급별)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<div id="sms_type_layer1" style="display:inline;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="160">
    <td></td>
    <td class="subject"><span class="tip100">수신번호 (받는 이)</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea name="sms_list" class="textarea1" style="width:220px; height:100px;"></textarea></td>
    <td width="30"></td>
    <td class="msg3"><p>하이픈(-)을 제외한 번호 입력</p><p>다수 입력시 엔터(줄바꿈) 구분</p></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<div id="sms_type_layer2" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip100">수신그룹 선택</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select1">
<select name="user_level" size="1" class="select" onchange="smsLevelMember(this.value);">
    <option value="">전체회원</option>
<?
$result = sql_query(" select * from $shop[user_level_table] where level >= '2' order by level asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    echo "<option value='".text($row['level'])."'>".text($row['name'])."</option>";

}
?>
</select>
    </td>
    <td width="10"></td>
    <td class="text1"><b id="sms_member">0</b> 명</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">발송시간</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="sms_send" value="0" class="radio" checked /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'sms_send', '0');">즉시발송</td>
    <td width="30"></td>
    <td><input type="radio" name="sms_send" value="1" class="radio" /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formConfig', 'sms_send', '1');">예약발송</td>
    <td width="30"></td>
    <td class="select3">
<select id="sms_y" name="sms_y" class="select">
<?
echo "<option value='".date("Y", strtotime($shop['time_ymdhis']))."'>".date("Y", strtotime($shop['time_ymdhis']))."년</option>";
?>
</select>
    </td>
    <td width="3"></td>
    <td class="select2">
<select id="sms_m" name="sms_m" class="select">
<?
for ($i=1; $i<=12; $i++) {
    $k = sprintf("%02d" , $i);
    echo "<option value='".$k."'>".$k."월</option>";
}
?>
</select>

<script type="text/javascript">
$("#sms_m").val("<?=date("m", $shop['server_time']);?>");
</script>
    </td>
    <td width="3"></td>
    <td class="select2">
<select id="sms_d" name="sms_d" class="select">
<?
for ($i=1; $i<=31; $i++) {
    $k = sprintf("%02d" , $i);
    echo "<option value='".$k."'>".$k."일</option>";
}
?>
</select>

<script type="text/javascript">
$("#sms_d").val("<?=date("d", $shop['server_time']);?>");
</script>
    </td>
    <td width="3"></td>
    <td class="select2">
<select id="sms_h" name="sms_h" class="select">
<?
for ($i=0; $i<=23; $i++) {
    $k = sprintf("%02d" , $i);
    echo "<option value='".$k."'>".$k."시</option>";
}
?>
</select>

<script type="text/javascript">
$("#sms_h").val("<?=date("H", $shop['server_time']);?>");
</script>
    </td>
    <td width="3"></td>
    <td class="select2">
<select id="sms_i" name="sms_i" class="select">
<?
for ($i=0; $i<=59; $i++) {
    $k = sprintf("%02d" , $i);
    echo "<option value='".$k."'>".$k."분</option>";
}
?>
</select>

<script type="text/javascript">
$("#sms_i").val("<?=date("i", $shop['server_time']);?>");
</script>
    </td>
    <td width="3"></td>
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
    <td><a href="#" onclick="configSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./sms_send.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 위의 설정값에 따라 SMS를 전송/예약전송합니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<script type="text/javascript">
$(function() {

    $("#sms_message").mouseenter(function() {

        if ($("#sms_message").val() == '내용을 입력 하세요.') {

            $("#sms_message").val("");

        }

    });

});
</script>

<?
include_once("./_bottom.php");
?>