<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// insert
if ($m == '') {

    // 기획전
    $dmshop_plan = shop_plan(addslashes($_POST['plan_id']));

    if (!$dmshop_plan['id']) {

        alert("기획전이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    // 상품
    $dmshop_item = shop_item(addslashes($_POST['item_id']));

    if (!$dmshop_item['id']) {

        alert("상품이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    // 기획전 상품
    $dmshop_plan_item = shop_plan_item(addslashes($_POST['plan_id']), addslashes($_POST['item_id']));

    if ($dmshop_plan_item['id']) {

        alert("이미 기획전에 등록된 상품입니다.");

    }

    $sql_common = "";
    $sql_common .= " set plan_id = '".addslashes($_POST['plan_id'])."' ";
    $sql_common .= ", item_id = '".addslashes($_POST['item_id'])."' ";
    $sql_common .= ", item_title = '".addslashes($dmshop_item['item_title'])."' ";
    $sql_common .= ", item_code = '".$dmshop_item['item_code']."' ";
    $sql_common .= ", item_money = '".$dmshop_item['item_money']."' ";
    $sql_common .= ", item_cash = '".$dmshop_item['item_cash']."' ";
    $sql_common .= ", item_icon = '".$dmshop_item['item_icon']."' ";
    $sql_common .= ", item_hit = '".$dmshop_item['item_hit']."' ";
    $sql_common .= ", item_sale = '".$dmshop_item['item_sale']."' ";
    $sql_common .= ", item_reply = '".$dmshop_item['item_reply']."' ";
    $sql_common .= ", item_qna = '".$dmshop_item['item_qna']."' ";
    $sql_common .= ", item_use = '".$dmshop_item['item_use']."' ";
    $sql_common .= ", category1 = '".$dmshop_item['category1']."' ";
    $sql_common .= ", category2 = '".$dmshop_item['category2']."' ";
    $sql_common .= ", category3 = '".$dmshop_item['category3']."' ";
    $sql_common .= ", category4 = '".$dmshop_item['category4']."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 등록
    sql_query(" insert into $shop[plan_item_table] $sql_common ");

}

// delete
else if ($m == 'd') {

    // 기획전 상품 삭제
    sql_query(" delete from $shop[plan_item_table] where id = '".addslashes($_POST['plan_item_id'])."' ");

}

// 일괄등록
else if ($m == 'all') {

    // 기획전
    $dmshop_plan = shop_plan(addslashes($_POST['plan_id']));

    if (!$dmshop_plan['id']) {

        alert("기획전이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 상품
        $dmshop_item = shop_item(addslashes($_POST['item_id'][$k]));

        // 기획전 상품
        $dmshop_plan_item = shop_plan_item(addslashes($_POST['plan_id']), addslashes($_POST['item_id'][$k]));

        // 상품이 있으면서 중복이 아닐 때
        if ($dmshop_item['id'] && !$dmshop_plan_item['id']) {

            $sql_common = "";
            $sql_common .= " set plan_id = '".addslashes($_POST['plan_id'])."' ";
            $sql_common .= ", item_id = '".addslashes($_POST['item_id'][$k])."' ";
            $sql_common .= ", item_title = '".addslashes($dmshop_item['item_title'])."' ";
            $sql_common .= ", item_code = '".$dmshop_item['item_code']."' ";
            $sql_common .= ", item_money = '".$dmshop_item['item_money']."' ";
            $sql_common .= ", item_cash = '".$dmshop_item['item_cash']."' ";
            $sql_common .= ", item_icon = '".$dmshop_item['item_icon']."' ";
            $sql_common .= ", item_hit = '".$dmshop_item['item_hit']."' ";
            $sql_common .= ", item_sale = '".$dmshop_item['item_sale']."' ";
            $sql_common .= ", item_reply = '".$dmshop_item['item_reply']."' ";
            $sql_common .= ", item_qna = '".$dmshop_item['item_qna']."' ";
            $sql_common .= ", item_use = '".$dmshop_item['item_use']."' ";
            $sql_common .= ", category1 = '".$dmshop_item['category1']."' ";
            $sql_common .= ", category2 = '".$dmshop_item['category2']."' ";
            $sql_common .= ", category3 = '".$dmshop_item['category3']."' ";
            $sql_common .= ", category4 = '".$dmshop_item['category4']."' ";
            $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

            // 등록
            sql_query(" insert into $shop[plan_item_table] $sql_common ");

        } else {

            // pass

        }

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>