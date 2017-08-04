<?
include_once("./_dmshop.php");
include_once("./shop.top.php");
if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }

// 쿠폰
$dmshop_coupon = shop_coupon($coupon_id);

if (!$dmshop_coupon['id']) {

    exit;

}

// 파일
$file = shop_coupon_file($coupon_id, "default");

if ($file['upload_file']) {

    $coupon_image = $shop['path']."/data/coupon/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

} else {

    $coupon_image = $shop['image_path']."/coupon/".$dmshop_coupon['coupon_image'].".jpg";

}
?>

<script type="text/javascript">
function couponDown()
{

    $.post("./coupon_down_update.php", {"coupon_id" : "<?=addslashes($coupon_id);?>"}, function(data) {

        $("#coupon_update").html(data);

    });

}
</script>

<div id="coupon_update" style="display:none;"></div>

<table border="0" cellspacing="0" cellpadding="0" style="width:400px; height:140px; cursor:pointer; background:url('<?=$coupon_image?>') no-repeat;" onclick="couponDown();">
<tr>
    <td valign="top">
<div style="padding:5px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="20">
    <td><p style="margin-left:5px; line-height:13px; font-size:11px; color:#000000; font-family:gulim,굴림;"><?=$dmshop['shop_name']?></p></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="76">
    <td width="245"><p style="text-align:right; line-height:50px; font-size:48px; color:#940708; font-family:Arial,gulim,굴림;"><?=number_format($dmshop_coupon['coupon_discount']);?> <?=shop_coupon_discount_type($dmshop_coupon['coupon_discount_type']);?></p></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="26">
    <td>
<p style="text-align:center; line-height:14px; font-size:12px; color:#ffffff; font-family:gulim,굴림;">
<?
// 발급일
if ($dmshop_coupon['coupon_day_type']) {

    echo "발급일로 부터 ".number_format($dmshop_coupon['coupon_day'])." 일간";

} else {
// 고정기간

    echo date("Y년 m월 d일", strtotime($dmshop_coupon['coupon_date1']))." 부터 ~ ".date("Y년 m월 d일", strtotime($dmshop_coupon['coupon_date2']))." 까지";

}
?>
</p>
    </td>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<?
include_once("./shop.bottom.php");
?>