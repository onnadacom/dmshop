<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.coupon_position .home {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.coupon_position .off {line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}

.coupon_title .b1 {margin-top:6px;}
.coupon_title .b2 {margin-top:7px;}
.coupon_title .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#777777; font-family:gulim,굴림;}
.coupon_title .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}
.coupon_title .t3 {text-decoration:underline; line-height:15px; font-size:11px; color:#000000; font-family:dotum,돋움;}

.coupon_code .t1 {font-weight:bold; line-height:15px; font-size:13px; color:#000000; font-family:gulim,굴림;}
.coupon_code .input {width:202px; height:24px; border:4px solid #cccccc; padding:1px 5px 0px 5px;}
.coupon_code .input {line-height:24px; font-size:14px; color:#000000; font-family:gulim,굴림;}

.coupon_msg .t1 {line-height:18px; font-size:11px; color:#959595; font-family:dotum,돋움;}
</style>

<script type="text/javascript">
function couponRegist()
{

    var coupon_number = $('#coupon_number').val();

    if (coupon_number == '') {

        alert("쿠폰 번호를 입력하세요.");
        $('#coupon_number').focus();
        return false;

    }

    $.post("<?=$shop['path']?>/coupon_regist_update.php", {"coupon_number" : coupon_number}, function(data) {

        $('#coupon_regist_message').html(data);

    });

}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="coupon_position">
<tr height="34" bgcolor="#f8f8f8">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td width='10'></td>";
echo "<td><a href='".$shop['path']."/' class='home'>홈</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_coupon_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['path']."/mypage.php' class='off'>마이페이지</a></td>";
echo "<td width='20' align='center'><img src='".$dmshop_coupon_path."/img/arrow.gif' class='up1'></td>";
echo "<td><a href='".$shop['path']."/coupon_regist.php' class='off'>쿠폰 등록</a></td>";
?>
</tr>
</table>
    </td>
</tr>
</table>

<?
// 회원등급 및 기타정보
include_once("$dmshop_mypage_path/information.php");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="coupon_title">
<tr>
    <td width="9"></td>
    <td width="84" valign="top"><img src="<?=$dmshop_coupon_path?>/img/t3.gif"></td>
    <td align="right"><p class="b2 t2">소지하신 쿠폰의 일련번호를 입력하여, 쿠폰을 발급 받습니다.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="coupon_code">
<tr>
    <td>
<div style="border:1px solid #efefef; background-color:#f7f7f7; padding:5px;">
<div style="background-color:#ffffff;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="105">
    <td></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="180">
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td class="t1">쿠폰번호 입력</td>
    <td width="10"></td>
    <td><input type="text" id="coupon_number" name="coupon_number" value="" class="input" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="couponRegist(); return false;"><img src="<?=$dmshop_coupon_path?>/img/regist_ok.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><div id="coupon_regist_message"><img src="<?=$dmshop_coupon_path?>/img/msg1.gif"></div></td>
</tr>
</table>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="20"></td></tr> 
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#dddddd" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td>
<div style="border:2px solid #f6f6f6; background-color:#dddddd; padding:1px;">
<div style="padding:15px 20px; background-color:#ffffff;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="coupon_msg">
<tr>
    <td class="t1">
- 오프라인상에서 소지하신 쿠폰(인쇄물 등)을 소지하신 회원님들을 위한 서비스 입니다.<br>
- 쿠폰에 쓰여 있는 쿠폰번호를 입력하시면 쿠폰 보관함에 추가되며, 바로 이용하실 수 있습니다.<br>
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