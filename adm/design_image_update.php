<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 썸네일 설정
if ($_POST['image_category_use'] == '0') {

    $thumb_width = shop_split("|", $_POST['image_category'], "0");
    $thumb_height = shop_split("|", $_POST['image_category'], "1");

} else {

    $thumb_width = $_POST['image_category_width'];
    $thumb_height = $_POST['image_category_height'];

}

// 카테고리 동시적용
if ($_POST['image_category_all']) {

    // common
    $sql_common = "";
    $sql_common .= " set thumb_width = '".addslashes($thumb_width)."' ";
    $sql_common .= ", thumb_height = '".addslashes($thumb_height)."' ";
    $sql_common .= ", thumb_use = '0' ";

    // update
    sql_query(" update $shop[category_table] $sql_common ");

}

// 기획전
if ($_POST['image_plan_all']) {

    // common
    $sql_common = "";
    $sql_common .= " set thumb_width = '".addslashes($thumb_width)."' ";
    $sql_common .= ", thumb_height = '".addslashes($thumb_height)."' ";
    $sql_common .= ", thumb_use = '0' ";

    // update
    sql_query(" update $shop[plan_table] $sql_common ");

}

// common
$sql_common = "";
$sql_common .= " set image_category_use = '".addslashes($_POST['image_category_use'])."' ";
$sql_common .= ", image_category = '".addslashes($_POST['image_category'])."' ";
$sql_common .= ", image_category_width = '".addslashes($_POST['image_category_width'])."' ";
$sql_common .= ", image_category_height = '".addslashes($_POST['image_category_height'])."' ";
$sql_common .= ", image_category_thumb_type = '".addslashes($_POST['image_category_thumb_type'])."' ";
$sql_common .= ", image_category1_border = '".addslashes($_POST['image_category1_border'])."' ";
$sql_common .= ", image_category1_border_color = '".addslashes($_POST['image_category1_border_color'])."' ";
$sql_common .= ", image_category2_border = '".addslashes($_POST['image_category2_border'])."' ";
$sql_common .= ", image_category2_border_color = '".addslashes($_POST['image_category2_border_color'])."' ";
$sql_common .= ", image_plan_use = '".addslashes($_POST['image_plan_use'])."' ";
$sql_common .= ", image_plan = '".addslashes($_POST['image_plan'])."' ";
$sql_common .= ", image_plan_width = '".addslashes($_POST['image_plan_width'])."' ";
$sql_common .= ", image_plan_height = '".addslashes($_POST['image_plan_height'])."' ";
$sql_common .= ", image_plan_thumb_type = '".addslashes($_POST['image_plan_thumb_type'])."' ";
$sql_common .= ", image_plan1_border = '".addslashes($_POST['image_plan1_border'])."' ";
$sql_common .= ", image_plan1_border_color = '".addslashes($_POST['image_plan1_border_color'])."' ";
$sql_common .= ", image_plan2_border = '".addslashes($_POST['image_plan2_border'])."' ";
$sql_common .= ", image_plan2_border_color = '".addslashes($_POST['image_plan2_border_color'])."' ";

// update
sql_query(" update $shop[design_image_table] $sql_common ");

// 썸네일 폴더 삭제
shop_delete("{$shop['path']}/data/thumb/item");

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>