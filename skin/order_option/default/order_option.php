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
.top_bg {height:45px; background:url('<?=$dmshop_order_option_path?>/img/top_bg.gif') repeat-x;}

.order_msg .t1 {line-height:21px; font-size:12px; color:#958660; font-family:dotum,돋움;}

.order_option .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_option .list {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_option .option {line-height:16px; font-size:12px; color:#8b49c7; font-family:gulim,굴림;}

.order_option .select {height:18px; border:1px solid #e4e4e4;}
.order_option .select {line-height:18px; font-size:12px; color:#555555; font-family:gulim,굴림;}
.order_option .select option {padding:0px 3px 0px 3px; line-height:18px; font-size:12px; color:#555555; font-family:gulim,굴림;}
</style>

<script type="text/javascript">
function orderOption(order_id)
{

    if (order_id == '') {

        return false;

    }

    $.post("<?=$shop['path']?>/order_option_update.php", {"m" : "", "order_id" : order_id}, function(data) {

        $("#item_name").html(data);

    });

}

function submitOrder()
{

    var f = document.formOrder;

    if (f.order_id.value == '') {

        alert("변경하실 상품을 선택하세요.");
        return false;

    }

    if (document.getElementById("option_id")) {

        if (f.option_id.value == '') {
    
            alert("변경하실 주문옵션을 선택하세요.");
            return false;
    
        }

    } else {

        alert("변경하실 주문옵션이 없습니다.");
        return false;

    }

    if (confirm("주문옵션을 변경하시겠습니까?")) {

        return true;

    } else {

        return false;

    }

}
</script>

<form method="post" name="formOrder" action="<?=$shop['path']?>/order_option_update.php" onsubmit="return submitOrder();">
<input type="hidden" name="m" value="u" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="top_bg">
    <td width="15"></td>
    <td><img src="<?=$dmshop_order_option_path?>/img/title.png" class="png"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td width="15"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_msg">
<tr>
    <td>
<div style="border:1px solid #e2cb91; background-color:#ffeec4; padding:5px;">
<div style="padding:15px 20px; background-color:#fffdea;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="t1">
- 주문하신 상품의 주문옵션 중, 동일한 가격의 주문옵션으로 변경하실 수 있습니다.<br>
- 색상이나 사이즈 등의 단순 변경 시에만 이용 가능하며, 다른상품 or 차액이 발생되는 옵션상품으로<br>
&nbsp;&nbsp;변경하고자 하실 경우, 주문취소 후 재구매해 주시기 바랍니다..<br>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<!-- 변경대상선택 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_option_path?>/img/arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_order_option_path?>/img/t1.gif"></td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_option">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">상품명</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><select name="order_id" class="select" onchange="orderOption(this.value);"><option value="">변경하실 상품을 선택하세요.</option><?=$order_optons?></select></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 변경대상선택 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="30"><td></td></tr>
</table>

<!-- 주문상품정보 start //-->
<table border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td><img src="<?=$dmshop_order_option_path?>/img/arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_order_option_path?>/img/t2.gif"></td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_option box_bg">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">상품명</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><span id="item_name">변경대상이 선택되지 않았습니다.</span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">주문옵션</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="option"><span id="item_option"></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 주문상품정보 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="30"><td></td></tr>
</table>

<!-- 변경상품정보 start //-->
<table border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td><img src="<?=$dmshop_order_option_path?>/img/arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_order_option_path?>/img/t3.gif"></td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_option box_bg">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">상품명</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="list"><span id="target_name">변경대상이 선택되지 않았습니다.</span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">주문옵션</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="option"><span id="target_option"></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 변경상품정보 end //-->
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
    <td><input type="image" src="<?=$dmshop_order_option_path?>/img/ok.gif" border="0"></td>
    <td width="5"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$dmshop_order_option_path?>/img/close.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>
</form>