<?php
if (!defined("_DMSHOP_")) exit;

/*
// 주문페이지의 상품이 차례대로 넘어온다.
for ($i=0; $i<count($list); $i++) {

    // 장바구니 데이터를 불러온다.
    $dmshop_cart = shop_cart($list[$i]['id']);

    // 장바구니 내역이 있다.
    if ($dmshop_cart['id']) {

        // 장바구니에 저장한 컬럼값을 주문내역에 업데이트한다.
        $sql_common = "";
        $sql_common .= " set option1 = '".addslashes($dmshop_cart['option1'])."' ";
        $sql_common .= ", option2 = '".addslashes($dmshop_cart['option2'])."' ";
        $sql_common .= ", option3 = '".addslashes($dmshop_cart['option3'])."' ";
        $sql_common .= ", option4 = '".addslashes($dmshop_cart['option4'])."' ";
        $sql_common .= ", option5 = '".addslashes($dmshop_cart['option5'])."' ";
        $sql_common .= ", option6 = '".addslashes($dmshop_cart['option6'])."' ";
        $sql_common .= ", option7 = '".addslashes($dmshop_cart['option7'])."' ";
        $sql_common .= ", option8 = '".addslashes($dmshop_cart['option8'])."' ";
        $sql_common .= ", option9 = '".addslashes($dmshop_cart['option9'])."' ";
        $sql_common .= ", option10 = '".addslashes($dmshop_cart['option10'])."' ";

        sql_query(" update $shop[order_table] $sql_common where cart_id = '".$list[$i]['id']."' ");

    }

}
*/
?>