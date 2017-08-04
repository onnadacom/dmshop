<?
if (!defined('_DMSHOP_')) exit;
?>
<!--[if IE 6]>
<script type="text/javascript">
/* IE6 PNG 배경투명 */
DD_belatedPNG.fix('.png');
</script>
<![endif]-->

<style type="text/css">
body {background-color:#f4f4f4;}
.box_bg {background-color:#ffffff;}
.top_bg {height:45px; background:url('<?=$dmshop_order_address_path?>/img/top_bg.gif') repeat-x;}

.order_addr .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_addr .list {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_addr .zip {line-height:16px; font-size:11px; color:#8b8d8e; font-family:dotum,돋움;}
.order_addr .hyphen {line-height:14px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.order_addr .byte {line-height:14px; font-size:11px; color:#787878; font-family:dotum,돋움;}

.order_addr .input {width:94px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.order_addr .input {line-height:17px; font-size:12px; color:#414141; font-family:gulim,굴림;}

.order_addr .textarea  {padding:3px; width:340px; height:40px; border:1px solid #c9c9c9;}
.order_addr .textarea  {line-height:15px; font-size:12px; color:#333333; font-family:dotum,돋움;}
</style>

<script type="text/javascript">
// byte 체크
function orderByte(content, bytes)
{

    var conts = document.getElementById(content);
    var bytes = document.getElementById(bytes);

    var i = 0;
    var cnt = 0;
    var exceed = 0;
    var ch = '';

    for (i=0; i<conts.value.length; i++) {

        ch = conts.value.charAt(i);

        if (escape(ch).length > 4) {

            cnt += 2;

        } else {

            cnt += 1;

        }

    }

    bytes.innerHTML = cnt;

/*
    if (cnt > 80) {

        exceed = cnt - 80;
        alert('메시지 내용은 80바이트를 넘을수 없습니다.\n\n작성하신 메세지 내용은 '+ exceed +'byte가 초과되었습니다.\n\n초과된 부분은 자동으로 삭제됩니다.');
        var tcnt = 0;
        var xcnt = 0;
        var tmp = conts.value;
        for (i=0; i<tmp.length; i++) {

            ch = tmp.charAt(i);

            if (escape(ch).length > 4) {

                tcnt += 2;

            } else {

                tcnt += 1;

            }

            if (tcnt > 80) {

                tmp = tmp.substring(0,i);
                break;

            } else {

                xcnt = tcnt;

            }

        }

        conts.value = tmp;
        bytes.innerHTML = xcnt;

        return;

    }
*/

}

function submitOrder()
{

    var f = document.formOrder;

    if (!f.order_rec_name.value) {

        alert("수령자명을 입력하세요.");
        f.order_rec_name.focus();
        return false;

    }

    if (!f.order_rec_hp1.value) {

        alert("휴대폰번호를 입력하십시오.");
        f.order_rec_hp1.focus();
        return false;

    }

    if (!f.order_rec_hp2.value) {

        alert("휴대폰번호를 입력하십시오.");
        f.order_rec_hp2.focus();
        return false;

    }

    if (!f.order_rec_hp3.value) {

        alert("휴대폰번호를 입력하십시오.");
        f.order_rec_hp3.focus();
        return false;

    }

    if (!f.order_rec_tel1.value) {

        alert("일반전화를 입력하십시오.");
        f.order_rec_tel1.focus();
        return false;

    }

    if (!f.order_rec_tel2.value) {

        alert("일반전화를 입력하십시오.");
        f.order_rec_tel2.focus();
        return false;

    }

    if (!f.order_rec_tel3.value) {

        alert("일반전화를 입력하십시오.");
        f.order_rec_tel3.focus();
        return false;

    }

    if (!f.order_rec_addr1.value) {

        alert("주소를 입력하세요.");
        f.order_rec_addr1.focus();
        return false;

    }

    if (!f.order_rec_addr2.value) {

        alert("상세주소를 입력하세요.");
        f.order_rec_addr2.focus();
        return false;

    }

    if (confirm("배송지정보를 변경하시겠습니까?")) {

        return true;

    } else {

        return false;

    }

}
</script>

<form method="post" name="formOrder" action="<?=$shop['path']?>/order_address_update.php" onsubmit="return submitOrder();">
<input type="hidden" name="order_code" value="<?=$order_code?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="top_bg">
    <td width="15"></td>
    <td><img src="<?=$dmshop_order_address_path?>/img/title.png" class="png"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td width="15"></td>
    <td>
<!-- 배송지정보 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_address_path?>/img/arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_order_address_path?>/img/t1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_addr">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">수령자 성명</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><?=text($dmshop_order['order_rec_name'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">휴대폰 / 전화</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><?=text($dmshop_order['order_rec_hp'])?> / <?=text($dmshop_order['order_rec_tel'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">배송지 주소</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><span class="zip">(우: <?=text($dmshop_order['order_rec_zip1'])?><?=text($dmshop_order['order_rec_zip2'])?>)</span> <?=text($dmshop_order['order_rec_addr1'])?> <?=text($dmshop_order['order_rec_addr2'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td></tr>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">배송 요구사항</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><?=text($dmshop_order['order_memo'])?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 배송지정보 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="30"><td></td></tr>
</table>

<!-- 변경배송지정보 start //-->
<table border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td><img src="<?=$dmshop_order_address_path?>/img/arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_order_address_path?>/img/t2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_addr box_bg">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">수령자 성명</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><input type="text" name="order_rec_name" value="<?=text($dmshop_order['order_rec_name'])?>" class="input" /></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">휴대폰</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_hp1" value="<?=text($order_rec_hp1)?>" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_hp2" value="<?=text($order_rec_hp2)?>" class="input" style="width:40px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_hp3" value="<?=text($order_rec_hp3)?>" class="input" style="width:40px;" /></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">일반전화</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_tel1" value="<?=text($order_rec_tel1)?>" class="input" style="width:27px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_tel2" value="<?=text($order_rec_tel2)?>" class="input" style="width:40px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_tel3" value="<?=text($order_rec_tel3)?>" class="input" style="width:40px;" /></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">배송지 주소</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_zip1" value="<?=text($dmshop_order['order_rec_zip1'])?>" class="input" style="width:40px;" /></td>
    <td width="20" align="center" class="hyphen">-</td>
    <td><input type="text" name="order_rec_zip2" value="<?=text($dmshop_order['order_rec_zip2'])?>" class="input" style="width:40px;" /></td>
    <td width="10"></td>
    <td><a href="#" onclick="shopZip('formOrder', 'order_rec_zip1', 'order_rec_zip2', 'order_rec_addr1', 'order_rec_addr2'); return false;"><img src="<?=$dmshop_order_address_path?>/img/find_addr.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_addr1" value="<?=text($dmshop_order['order_rec_addr1'])?>" class="input" style="width:340px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="order_rec_addr2" value="<?=text($dmshop_order['order_rec_addr2'])?>" class="input" style="width:340px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td></tr>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">배송 요구사항</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="order_memo" name="order_memo" class="textarea" onkeyup="orderByte('order_memo', 'order_memo_byte');"><?=text($dmshop_order['order_memo'])?></textarea></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="byte">( <span id="order_memo_byte">0</span> / 120byte)</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 변경배송지정보 end //-->
    </td>
    <td width="15"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="90">
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="image" src="<?=$dmshop_order_address_path?>/img/ok.gif" border="0"></td>
    <td width="5"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$dmshop_order_address_path?>/img/close.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>
</form>