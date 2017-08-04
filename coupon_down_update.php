<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }

if (!$coupon_id) {

    echo "<script type='text/javascript'>alert('존재하지 않는 쿠폰입니다.');</script>";
    exit;

}

// 로그인
if (!$shop_user_login) {

    echo "<script type='text/javascript'>alert('로그인 후 이용하여주세요.');</script>";
    exit;

}

// 쿠폰발급
$shop_coupon_make = shop_coupon_make($coupon_id, $dmshop_user['user_id'], "", true);

echo "<script type='text/javascript'>alert('{$shop_coupon_make}');</script>";
exit;
?>