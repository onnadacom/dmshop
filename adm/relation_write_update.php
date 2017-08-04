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

    // 상품
    $dmshop_item = shop_item(addslashes($_POST['item_id']));

    if (!$dmshop_item['id']) {

        alert("상품이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    // 상품
    $dmshop_item = shop_item(addslashes($_POST['item_add_id']));

    if (!$dmshop_item['id']) {

        alert("상품이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    // 관련상품
    $dmshop_relation = shop_relation_add(addslashes($_POST['item_id']), addslashes($_POST['item_add_id']));

    if ($dmshop_relation['id']) {

        alert("이미 관련상품에 등록된 상품입니다.");

    }

    $sql_common = "";
    $sql_common .= " set item_id = '".addslashes($_POST['item_id'])."' ";
    $sql_common .= ", item_add_id = '".addslashes($_POST['item_add_id'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 등록
    sql_query(" insert into $shop[relation_table] $sql_common ");

}

// delete
else if ($m == 'd') {

    // 관련상품 삭제
    sql_query(" delete from $shop[relation_table] where id = '".addslashes($_POST['relation_id'])."' ");

}

// 일괄등록
else if ($m == 'all') {

    // 상품
    $dmshop_item = shop_item(addslashes($_POST['item_id']));

    if (!$dmshop_item['id']) {

        alert("상품이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 상품
        $dmshop_item = shop_item(addslashes($_POST['item_add_id'][$k]));

        // 관련상품
        $dmshop_relation = shop_relation_add(addslashes($_POST['item_id']), addslashes($_POST['item_add_id'][$k]));

        // 상품이 있으면서 중복이 아닐 때
        if ($dmshop_item['id'] && !$dmshop_relation['id']) {

            $sql_common = "";
            $sql_common .= " set item_id = '".addslashes($_POST['item_id'])."' ";
            $sql_common .= ", item_add_id = '".addslashes($_POST['item_add_id'][$k])."' ";
            $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

            // 등록
            sql_query(" insert into $shop[relation_table] $sql_common ");

        } else {

            // pass

        }

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($m == '' || $m == 'all') {

    echo "<script type='text/javascript'>opener.location.reload();</script>";

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>