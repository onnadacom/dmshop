<?php
if (!defined('_DMSHOP_')) exit;

//-- 메인 페이지 이미지 --//

// display_box_type
$result = sql_query(" select * from $shop[display_box_type_table] order by display_id asc, display_type asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_list"] = $row['box_type'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_box_width"] = $row['box_width'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_box_height"] = $row['box_height'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_side_width"] = $row['side_width'];

}

// display_box_list
$result = sql_query(" select * from $shop[display_box_list_table] order by display_id asc, display_type asc, display_list asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_category"] = $row['category'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_category_name"] = shop_category_name($row['category']);
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_icon"] = $row['icon'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_sort"] = $row['sort'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_skin"] = $row['skin'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_count_width"] = $row['count_width'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_count_height"] = $row['count_height'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_thumb_width"] = $row['thumb_width'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_thumb_height"] = $row['thumb_height'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_rolling_limit"] = $row['rolling_limit'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_rolling_time"] = $row['rolling_time'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_titletype"] = $row['titletype'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_title"] = $row['title'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_plan"] = $row['plan'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_board"] = $row['board'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_use1"] = $row['use1'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_use2"] = $row['use2'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_use3"] = $row['use3'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_use4"] = $row['use4'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_banner"] = $row['banner'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_url"] = $row['url'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_urltype"] = $row['urltype'];
    $dmshop_design["display".$row['display_id']."_".$row['display_type']."_".$row['display_list']."_html"] = $row['html'];

}

// 기획전 리스트
$plan_option = "<option value='0'>선택하세요.</option>";
$result = sql_query(" select * from $shop[plan_table] where view = '1' order by position desc, datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $plan_option .= "<option value='".$row['id']."'>".text($row['title'])."</option>";

}

// 아이콘
$icon_option = "<option value='0'>지정안함 (전체)</option>";
$result = sql_query(" select * from $shop[icon_file_table] where view = '1' order by position desc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $icon_option .= "<option value='".$row['id']."'>".text($row['title'])."</option>";

}

// 게시판
$board_option = "<option value=''>선택하세요.</option>";
$result = sql_query(" select * from $shop[board_table] where bbs_view = '1' order by bbs_position desc, bbs_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $board_option .= "<option value='".text($row['bbs_id'])."'>".text($row['bbs_title'])."</option>";

}

// 배너 그룹
$banner_option = "<option value=''>선택하세요.</option>";
$result = sql_query(" select * from $shop[banner_group_table] order by group_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $banner_option .= "<option value='".text($row['group_id'])."'>".text($row['group_id'])."</option>";

}

// 배너 스킨
$banner_skin_option = "";
$skin_array = shop_skin_dir("banner");
for ($i=0; $i<count($skin_array); $i++) {

    $banner_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 상품분류 스킨
$showwindow_skin_option = "";
$skin_array = shop_skin_dir("showwindow");
for ($i=0; $i<count($skin_array); $i++) {

    $showwindow_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 최신글 스킨
$article_skin_option = "";
$skin_array = shop_skin_dir("article");
for ($i=0; $i<count($skin_array); $i++) {

    $article_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 최신글 정렬조건
$article_sort_option = "";
$article_sort_option .= "<option value='datetime desc'>작성일 내림차순</option>";
$article_sort_option .= "<option value='datetime asc'>작성일 오름차순</option>";
$article_sort_option .= "<option value='ar_hit desc'>조회수 내림차순</option>";
$article_sort_option .= "<option value='ar_hit asc'>조회수 오름차순</option>";
$article_sort_option .= "<option value='ar_reply desc'>댓글수 내림차순</option>";
$article_sort_option .= "<option value='ar_reply asc'>댓글수 오름차순</option>";
$article_sort_option .= "<option value='rand()'>랜덤</option>";

// 상품 정렬방식
$item_sort_option = "";
$item_sort_option .= "<option value='datetime desc'>등록일시 내림차순</option>";
$item_sort_option .= "<option value='datetime asc'>등록일시 오름차순</option>";
$item_sort_option .= "<option value='item_position desc'>진열선호도 내림차순</option>";
$item_sort_option .= "<option value='item_position asc'>진열선호도 오름차순</option>";
$item_sort_option .= "<option value='item_money desc'>판매가격 내림차순</option>";
$item_sort_option .= "<option value='item_money asc'>판매가격 오름차순</option>";
$item_sort_option .= "<option value='item_cash desc'>적립금 내림차순</option>";
$item_sort_option .= "<option value='item_cash asc'>적립금 오름차순</option>";
$item_sort_option .= "<option value='item_title desc'>상품명 내림차순</option>";
$item_sort_option .= "<option value='item_title asc'>상품명 오름차순</option>";
$item_sort_option .= "<option value='item_hit desc'>조회수 내림차순</option>";
$item_sort_option .= "<option value='item_hit asc'>조회수 오름차순</option>";
$item_sort_option .= "<option value='item_sale desc'>주문건수 내림차순</option>";
$item_sort_option .= "<option value='item_sale asc'>주문건수 오름차순</option>";
$item_sort_option .= "<option value='item_reply desc'>상품평 내림차순</option>";
$item_sort_option .= "<option value='item_reply asc'>상품평 오름차순</option>";
$item_sort_option .= "<option value='item_qna desc'>상품문의 내림차순</option>";
$item_sort_option .= "<option value='item_qna asc'>상품문의 오름차순</option>";
$item_sort_option .= "<option value='rand()'>랜덤</option>";
/*
// 기획전 정렬방식
$plan_sort_option= "";
$plan_sort_option .= "<option value='datetime desc'>등록일시 내림차순</option>";
$plan_sort_option .= "<option value='datetime asc'>등록일시 오름차순</option>";
$plan_sort_option .= "<option value='title desc'>기획전명 내림차순</option>";
$plan_sort_option .= "<option value='title asc'>기획전명 오름차순</option>";
$plan_sort_option .= "<option value='position desc'>출력순서 내림차순</option>";
$plan_sort_option .= "<option value='position asc'>출력순서 오름차순</option>";
$plan_sort_option .= "<option value='date1 desc'>전시 시작일 내림차순</option>";
$plan_sort_option .= "<option value='date1 asc'>전시 시작일 오름차순</option>";
$plan_sort_option .= "<option value='date2 desc'>전시 마감일 내림차순</option>";
$plan_sort_option .= "<option value='date2 asc'>전시 마감일 오름차순</option>";
$plan_sort_option .= "<option value='rand()'>랜덤</option>";

// 상품직접등록 정렬방식
$itemadd_sort_option = "";
$itemadd_sort_option .= "<option value='datetime desc'>등록일시 내림차순</option>";
$itemadd_sort_option .= "<option value='datetime asc'>등록일시 오름차순</option>";
$itemadd_sort_option .= "<option value='rand()'>랜덤</option>";
*/
// 배너 정렬방식
$banner_sort_option = "";
$banner_sort_option .= "<option value='ba_datetime desc'>등록일시 내림차순</option>";
$banner_sort_option .= "<option value='ba_datetime asc'>등록일시 오름차순</option>";
$banner_sort_option .= "<option value='ba_position desc'>출력순서 내림차순</option>";
$banner_sort_option .= "<option value='ba_position asc'>출력순서 오름차순</option>";
$banner_sort_option .= "<option value='rand()'>랜덤</option>";

// 롤링횟수
$rolling_limit_option = "";
for ($i=1; $i<=10; $i++) {

    $rolling_limit_option .= "<option value='".$i."'>{$i}회</option>";

}

// 롤링시간
$rolling_time_option = "";
for ($i=1; $i<=10; $i++) {

    $rolling_time_option .= "<option value='".$i."000'>{$i}초</option>";

}
?>