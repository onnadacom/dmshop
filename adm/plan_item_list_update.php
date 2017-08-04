<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

for ($i=0; $i<count($chk_id); $i++) {

    // 실제 번호를 넘김
    $k = $chk_id[$i];

    // update
    if ($m == 'u') {

        $sql_common = "";
        $sql_common .= " set position = '".addslashes($_POST['position'][$k])."' ";

        // 업데이트
        sql_query(" update $shop[plan_item_table] $sql_common where id = '".addslashes($_POST['plan_item_id'][$k])."' ");

    }

    // delete
    else if ($m == 'd') {

        // 기획전 상품 삭제
        sql_query(" delete from $shop[plan_item_table] where id = '".addslashes($_POST['plan_item_id'][$k])."' ");

    } else {

        // pass

    }

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>