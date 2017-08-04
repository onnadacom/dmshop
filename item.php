<?
include_once("./_dmshop.php");

if ($id) { $id = preg_match("/^[a-zA-Z0-9_\-]+$/", $id) ? $id : ""; }

// 아이디가 없다.
if (!$id) {

    message("<p class='title'>알림</p><p class='text'>상품분류가 삭제되었거나 존재하지 않습니다.</p>", "b");

}

// 상품
$dmshop_item = shop_item_code($id);

// 상품이 없다.
if (!$dmshop_item['id']) {

    message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "b");

}

// 숨김
if ($dmshop_item['item_use'] == '3') {

    message("<p class='title'>알림</p><p class='text'>판매중인 상품이 아닙니다.</p>", "b");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_item']) {

    message("<p class='title'>알림</p><p class='text'>상품 스킨이 설정되지 않았습니다.</p>", "b");

}

// 분류 아이디
$ct_id = shop_category_id($ct_id, $dmshop_item['category1'], $dmshop_item['category2'], $dmshop_item['category3'], $dmshop_item['category4']);

// 분류 설정
$dmshop_category = shop_category($ct_id);

// 분류가 없다.
if (!$dmshop_category['id']) {

    message("<p class='title'>알림</p><p class='text'>상품분류가 삭제되었거나 존재하지 않아 상품페이지를 볼 수 없습니다.</p>", "b");

}

// 스킨이 없다.
if (!$dmshop_category['skin']) {

    message("<p class='title'>알림</p><p class='text'>분류 스킨이 설정되지 않았습니다.</p>", "b");

}

// 세션 생성
$ss_name = "item_view_".$id;

if (!shop_get_session($ss_name)) {

    // 상품 조회수 증가
    sql_query(" update $shop[item_table] set item_hit = item_hit + 1 where item_code = '".$id."' ");

    // 기획전 조회수 증가
    sql_query(" update $shop[plan_item_table] set item_hit = item_hit + 1 where item_code = '".$id."' ");

    // 세션 생성
    shop_set_session($ss_name, true);

}

// 게스트 아이디
$guest_id = "";

// 회원
if ($shop_user_login) {

    $user_id = $dmshop_user['user_id'];

} else {
// 비회원

    $user_id = "";

    // 쿠키 아이디
    $cookie_id = "dmshop_item_view";

    // 쿠키
    if (shop_get_cookie($cookie_id)) {

        $guest_id = shop_get_cookie($cookie_id);

    } else {

        $cookie_value = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR']))).rand(10000,99999);

        shop_set_cookie($cookie_id, $cookie_value, 86400);

        $guest_id = $cookie_value;

    }

}

// 검색조건
$sql_search = "";

if ($shop_user_login) {

    $sql_search = " where user_id = '".$dmshop_user['user_id']."' and item_id = '".$dmshop_item['id']."' ";

} else {

    $sql_search = " where guest_id = '".$guest_id."' and user_id = '' and item_id = '".$dmshop_item['id']."' ";

}

$dmshop_item_view = sql_fetch(" select * from $shop[item_view_table] $sql_search ");

// 없다면
if (!$dmshop_item_view['id']) {

    $sql_common = "";
    $sql_common .= " set user_id = '".$user_id."' ";
    $sql_common .= ", guest_id = '".trim(strip_tags(mysql_real_escape_string($guest_id)))."' ";
    $sql_common .= ", item_id = '".$dmshop_item['id']."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 내가 본 상품 등록
    sql_query(" insert into $shop[item_view_table] $sql_common ");

}

// 스킨 경로
$dmshop_item_path = "";
$dmshop_item_path = $shop['path']."/skin/item/".$dmshop_skin['skin_item'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_item['item_title'];

// 페이지 아이디
$page_id = "item";

// 설정
$dmshop_design_item = shop_design_item();

// 대표 이미지
if ($dmshop_design_item['image_default_use'] == '0') { $dmshop_design_item['image_default_width'] = shop_split("|", $dmshop_design_item['image_default'], "0"); $dmshop_design_item['image_default_height'] = shop_split("|", $dmshop_design_item['image_default'], "1"); } else { $dmshop_design_item['image_default_width'] = $dmshop_design_item['image_default_width']; $dmshop_design_item['image_default_height'] = $dmshop_design_item['image_default_height']; }

// 갤러리 썸네일 이미지
if ($dmshop_design_item['image_gallery_thumb_use'] == '0') { $dmshop_design_item['image_gallery_thumb_width'] = shop_split("|", $dmshop_design_item['image_gallery_thumb'], "0"); $dmshop_design_item['image_gallery_thumb_height'] = shop_split("|", $dmshop_design_item['image_gallery_thumb'], "1"); } else { $dmshop_design_item['image_gallery_thumb_width'] = $dmshop_design_item['image_gallery_thumb_width']; $dmshop_design_item['image_gallery_thumb_height'] = $dmshop_design_item['image_gallery_thumb_height']; }

// 대표이미지
$thumb = shop_item_thumb($dmshop_item['id'], "default", "", $dmshop_design_item['image_default_width'], $dmshop_design_item['image_default_height'], shop_thumb_type($dmshop_design_item['thumb_type']));

// 대표이미지가 있으면 metatag 설정
if ($thumb) {

    $shop['meta_image'] = $shop['url'].substr($thumb,1);
    $shop['meta_image_width'] = $dmshop_design_item['image_default_width'];
    $shop['meta_image_height'] = $dmshop_design_item['image_default_height'];

}

$shop['meta_type'] = "article";
$shop['meta_subject'] = $dmshop_item['item_title'];

if ($dmshop_category['include_top']) { include($dmshop_category['include_top']); } else { include_once("./_top.php"); }
include_once("$dmshop_item_path/item.php");
if ($dmshop_category['include_bottom']) { include($dmshop_category['include_bottom']); } else { include_once("./_bottom.php"); }
?>