<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.order_box .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.order_box .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.order_box .input {width:190px; height:21px; border:2px solid #c9c9c9; padding:0px 5px 0px 5px;}
.order_box .input {font-weight:bold; line-height:21px; font-size:13px; color:#3a3a3a; font-family:gulim,굴림;}

.order_box .order_not {border-bottom:1px solid #efefef;}
.order_box .order_not div {border-top:1px solid #ffffff; border-bottom:1px solid #ffffff; background-color:#fbfbfb; height:40px; text-align:center;}
.order_box .order_not div {font-weight:bold; line-height:40px; font-size:12px; color:#ed145b; font-family:gulim,굴림;}

.order_box .guest_ok {border-bottom:1px solid #efefef;}
.order_box .guest_ok div {border-top:1px solid #ffffff; border-bottom:1px solid #ffffff; background-color:#fbfbfb; height:40px; text-align:center;}
.order_box .guest_ok div {font-weight:bold; line-height:40px; font-size:12px; color:#0000ff; font-family:gulim,굴림;}
</style>

<script type="text/javascript" src="<?=$dmshop_order_guest_path?>/order_guest.js"></script>

<script type="text/javascript">
function orderSubmit()
{

    var f = document.formOrder;

    if (!f.order_name.value) {

        alert("주문자명을 입력하십시오."); 
        f.order_name.focus();
        return false;

    }

    if (!f.order_hp.value) {

        alert("휴대폰번호를 입력하십시오."); 
        f.order_hp.focus();
        return false;

    }

    if (!f.order_password.value) {

        alert("비밀번호를 입력하십시오."); 
        f.order_password.focus();
        return false;

    }

    $.post("./order_guest_update.php", {"order_name" : f.order_name.value, "order_hp" : f.order_hp.value, "order_password" : f.order_password.value}, function(data) {

        $("#order_guest_message").html(data);

    });

}
</script>

<div style="border:1px solid #efefef; background-color:#f7f7f7;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_box">
<tr height="30">
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td><a href='".$shop['url']."' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_order_guest_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['https_url']."/order_guest.php' class='off'>비회원 주문조회</a></td>";
?>
</tr>
</table>
    </td>
    <td width="10"></td>
</tr>
</table>
</div>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="55">
    <td><img src="<?=$dmshop_order_guest_path?>/img/message1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_box">
<tr>
    <td>
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;">
<div style="background-color:#ffffff; padding:80px 0 80px 0;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<form method="post" name="formOrder" autocomplete="off">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_order_guest_path?>/img/dot.gif"></td>
    <td width="10"></td>
    <td><img src="<?=$dmshop_order_guest_path?>/img/title_order.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<div id="order_guest_message" style="display:none;"></div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="25">
    <td width="60"></td>
    <td align="right"><img src="<?=$dmshop_order_guest_path?>/img/name.gif"></td>
    <td width="10"></td>
    <td><input type="text" name="order_name" onfocus="orderFocusIn(this);" onblur="orderFocusOut(this);" class="input" /></td>
    <td width="60"></td>
</tr>
<tr><td colspan="3" height="5"></td></tr>
<tr height="25">
    <td width="60"></td>
    <td align="right"><img src="<?=$dmshop_order_guest_path?>/img/hp.gif"></td>
    <td width="10"></td>
    <td><input type="text" name="order_hp" onfocus="orderFocusIn(this);" onblur="orderFocusOut(this);" class="input" /></td>
    <td width="60"></td>
</tr>
<tr><td colspan="3" height="5"></td></tr>
<tr height="25">
    <td width="60"></td>
    <td align="right"><img src="<?=$dmshop_order_guest_path?>/img/pw.gif" id="guest_email"></td>
    <td width="10"></td>
    <td><input type="password" name="order_password" onfocus="orderFocusIn(this);" onblur="orderFocusOut(this);" class="input" /></td>
    <td width="60"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><div id="guest_btn"><a href="#" onclick="orderSubmit(); return false;"><img src="<?=$dmshop_order_guest_path?>/img/ok.gif" border="0"></a></div></td>
</tr>
</table>
</form>

<script type="text/javascript">
var f = document.formOrder;
f.order_name.focus();
</script>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>