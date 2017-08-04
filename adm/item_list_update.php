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
        $sql_common .= " set item_title = '".addslashes($_POST['item_title'][$k])."' ";
        $sql_common .= ", item_money = '".str_replace(",", "", addslashes($_POST['item_money'][$k]))."' ";
        $sql_common .= ", item_cash = '".str_replace(",", "", addslashes($_POST['item_cash'][$k]))."' ";
        $sql_common .= ", item_position = '".addslashes($_POST['item_position'][$k])."' ";
        $sql_common .= ", item_use = '".addslashes($_POST['item_use'][$k])."' ";

        // 상품 업데이트
        sql_query(" update $shop[item_table] $sql_common where id = '".addslashes($_POST['item_id'][$k])."' ");

        $sql_common = "";
        $sql_common .= " set item_title = '".addslashes($_POST['item_title'][$k])."' ";
        $sql_common .= ", item_money = '".str_replace(",", "", addslashes($_POST['item_money'][$k]))."' ";
        $sql_common .= ", item_cash = '".str_replace(",", "", addslashes($_POST['item_cash'][$k]))."' ";
        $sql_common .= ", item_use = '".addslashes($_POST['item_use'][$k])."' ";

        // 기획전 상품 업데이트
        sql_query(" update $shop[plan_item_table] $sql_common where item_id = '".addslashes($_POST['item_id'][$k])."' ");

    }

    // delete
    else if ($m == 'd') {

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[item_file_table] where item_id = '".addslashes($_POST['item_id'][$k])."' ");
        for ($n=0; $file=sql_fetch_array($result); $n++) {

            // 원본
            $file_path = $shop['path']."/data/item/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 파일 삭제
        sql_query(" delete from $shop[item_file_table] where item_id = '".addslashes($_POST['item_id'][$k])."' ");

        // 기획전 상품 삭제
        sql_query(" delete from $shop[plan_item_table] where item_id = '".addslashes($_POST['item_id'][$k])."' ");

        // 옵션 삭제
        sql_query(" delete from $shop[item_option_table] where item_id = '".addslashes($_POST['item_id'][$k])."' ");

        // 관련상품 삭제
        sql_query(" delete from $shop[relation_table] where item_id = '".addslashes($_POST['item_id'][$k])."' ");

        // 관련상품 삭제
        sql_query(" delete from $shop[relation_table] where item_add_id = '".addslashes($_POST['item_id'][$k])."' ");

        // 최근 본 상품 삭제
        sql_query(" delete from $shop[item_view_table] where item_id = '".addslashes($_POST['item_id'][$k])."' ");

        // 장바구니 삭제
        sql_query(" delete from $shop[cart_table] where item_id = '".addslashes($_POST['item_id'][$k])."' ");

        // 관심상품 삭제
        sql_query(" delete from $shop[favorite_table] where item_id = '".addslashes($_POST['item_id'][$k])."' ");

        // 적용중인 쿠폰 미사용으로 변경
        sql_query(" update $shop[coupon_list_table] set coupon_mode  = '0', cart_id = '0' where item_id = '".addslashes($_POST['item_id'][$k])."' and coupon_mode = '1' ");

        // 메인중앙 등록상품 삭제
        sql_query(" delete from $shop[display_item_table] where item_id = '".addslashes($_POST['item_id'][$k])."' ");

        // 상품 삭제
        sql_query(" delete from $shop[item_table] where id = '".addslashes($_POST['item_id'][$k])."' ");

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