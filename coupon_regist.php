<?
include_once("./_dmshop.php");

// 로그인
if (!$shop_user_login) {

    shop_url("$shop[path]/signin.php?url={$urlencode}");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_mypage']) {

    message("<p class='title'>알림</p><p class='text'>마이페이지 스킨이 설정되지 않았습니다.</p>", "b");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_coupon']) {

    message("<p class='title'>알림</p><p class='text'>쿠폰 스킨이 설정되지 않았습니다.</p>", "b");

}

// 스킨 경로
$dmshop_mypage_path = "";
$dmshop_mypage_path = $shop['path']."/skin/mypage/".$dmshop_skin['skin_mypage'];

// 스킨 경로
$dmshop_coupon_path = "";
$dmshop_coupon_path = $shop['path']."/skin/coupon/".$dmshop_skin['skin_coupon'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 마이페이지 > 쿠폰 등록";

// 페이지 아이디
$page_id = "coupon_regist";

include_once("./_top.php");
include_once("$dmshop_coupon_path/coupon_regist.php");
include_once("./_bottom.php");
?>