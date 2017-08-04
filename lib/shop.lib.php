<?
if (!defined("_DMSHOP_")) exit;

/*--------------------------------
    ## 분류 ##
--------------------------------*/

// 분류
function shop_category($category_id)
{

    global $shop;

    if ($category_id) { $category_id = preg_match("/^[0-9]+$/", $category_id) ? $category_id : ""; }

    if (!$category_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[category_table] where id = '$category_id' ");

}

// 분류 아이디 추출
function shop_category_id($ct_id, $category1, $category2, $category3, $category4)
{

    if ($ct_id) {

        $ct_id = $ct_id;

    }

    else if ($category4) {

        $ct_id = $category4;

    }

    else if ($category3) {

        $ct_id = $category3;

    }

    else if ($category2) {

        $ct_id = $category2;

    }

    else if ($category1) {

        $ct_id = $category1;

    } else {

        $ct_id = "";

    }

    return $ct_id;

}

// 분류 제목
function shop_category_name($category_id)
{

    global $shop;

    if ($category_id) { $category_id = preg_match("/^[0-9]+$/", $category_id) ? $category_id : ""; }

    if (!$category_id) {

        return false;

    }

    $data = sql_fetch(" select * from $shop[category_table] where id = '".$category_id."' ");

    if ($data['subject']) {

        $name = $data['subject'];

    } else {

        $name = "";

    }

    return text($name);

}

/*--------------------------------
    ## 기획전 ##
--------------------------------*/

// 기획전
function shop_plan($plan_id)
{

    global $shop;

    if ($plan_id) { $plan_id = preg_match("/^[0-9]+$/", $plan_id) ? $plan_id : ""; }

    if (!$plan_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[plan_table] where id = '$plan_id' ");

}

// 기획전 제목
function shop_plan_name($plan_id)
{

    global $shop;

    if ($plan_id) { $plan_id = preg_match("/^[0-9]+$/", $plan_id) ? $plan_id : ""; }

    if (!$plan_id) {

        return false;

    }

    $data = sql_fetch(" select * from $shop[plan_table] where id = '".$plan_id."' ");

    if ($data['title']) {

        $name = $data['title'];

    } else {

        $name = "";

    }

    return text($name);

}

// 기획전 상품
function shop_plan_item($plan_id, $item_id)
{

    global $shop;

    if ($plan_id) { $plan_id = preg_match("/^[0-9]+$/", $plan_id) ? $plan_id : ""; }
    if ($item_id) { $item_id = preg_match("/^[a-zA-Z0-9]+$/", $item_id) ? $item_id : ""; }

    if (!$plan_id || !$item_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[plan_item_table] where plan_id = '$plan_id' and item_id = '$item_id' ");

}

// 기획전 상품수
function shop_plan_item_count($plan_id)
{

    global $shop;

    if ($plan_id) { $plan_id = preg_match("/^[0-9]+$/", $plan_id) ? $plan_id : ""; }

    if (!$plan_id) {

        return false;

    }

    $data = sql_fetch(" select count(*) as total_count from $shop[plan_item_table] where plan_id = '".$plan_id."' ");

    return $data['total_count'];

}

// 기획전 첫번째
function shop_plan_first()
{

    global $shop;

    return sql_fetch(" select * from $shop[plan_table] where view = '1' and date1 <= '".$shop['time_ymd']."' and date2 >= '".$shop['time_ymd']."' order by position desc, datetime desc ");

}

// 기획전박스
function shop_planbox_skin($skin="default", $limit="")
{

    global $shop, $pl_id, $display, $display_id, $display_type, $display_list;

    $sql_limit = "";

    if ($limit) {
        $sql_limit = " limit 0, ".$limit;
    }

    // 진행중인 기획전
    $list = array();
    $result = sql_query(" select * from $shop[plan_table] where view = '1' and date1 <= '".$shop['time_ymd']."' and date2 >= '".$shop['time_ymd']."' order by position desc, datetime desc $sql_limit ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $list[$i] = $row;

    }

    $dmshop_planbox_path = "$shop[path]/skin/planbox/$skin";

    ob_start();
    include("$dmshop_planbox_path/planbox.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}

/*--------------------------------
    ## 상품 ##
--------------------------------*/

// 상품
function shop_item($item_id)
{

    global $shop;

    if ($item_id) { $item_id = preg_match("/^[a-zA-Z0-9]+$/", $item_id) ? $item_id : ""; }

    if (!$item_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[item_table] where id = '$item_id' ");

}

// 상품
function shop_item_code($item_code)
{

    global $shop;

    if ($item_code) { $item_code = preg_match("/^[a-zA-Z0-9]+$/", $item_code) ? $item_code : ""; }

    if (!$item_code) {

        return false;

    }

    return sql_fetch(" select * from $shop[item_table] where item_code = '$item_code' ");

}

// 상품 옵션
function shop_item_option($option_id)
{

    global $shop;

    if ($option_id) { $option_id = preg_match("/^[0-9]+$/", $option_id) ? $option_id : ""; }

    if (!$option_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[item_option_table] where id = '$option_id' ");

}

// 상품 옵션 수량
function shop_item_option_limit($item_id)
{

    global $shop;

    if ($item_id) { $item_id = preg_match("/^[a-zA-Z0-9]+$/", $item_id) ? $item_id : ""; }

    if (!$item_id) {

        return false;

    }

    $item_option = sql_fetch(" select sum(option_limit) as total_count from $shop[item_option_table] where item_id = '$item_id' and option_mode = '1' ");

    if ($item_option['total_count']) {

        return (int)($item_option['total_count']);

    } else {

        return false;

    }

}

// 상품수
function shop_item_count($tab, $id, $view)
{

    global $shop;

    $sql_search = " where id >= '1' ";

    if ($tab && $id) {

        $sql_search .= " and category".$tab." = '$id' ";

    }

    if ($view) {

        $sql_search .= " and item_use = '$view' ";

    }

    $item = sql_fetch(" select count(*) as cnt from $shop[item_table] $sql_search ");

    return $item['cnt'];

}

// 상품 파일
function shop_item_file($item_id, $upload_mode)
{

    global $shop;

    return sql_fetch(" select * from $shop[item_file_table] where item_id = '".addslashes($item_id)."' and upload_mode = '".addslashes($upload_mode)."' ");

}

// 상품 파일 경로
function shop_item_file_path($item_id, $upload_mode)
{

    global $shop;

    // 상품 파일
    $file = shop_item_file($item_id, $upload_mode);

    if ($file['upload_file']) {

        // 파일 경로
        $file_path = $shop['path']."/data/item/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 파일이 있다면
        if (file_exists($file_path) && $file['upload_file']) {

            $upload_file = $file_path;

        } else {

            $upload_file = "";

        }

    } else {

        $upload_file = "";

    }

    return $upload_file;

}

// 상품 썸네일 생성
function shop_item_thumb($item_id, $upload_mode, $default, $thumb_width, $thumb_height, $is_cut="")
{

    global $shop;

    // 썸네일
    $dir = $shop['path']."/data/thumb";

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    $dir = $shop['path']."/data/thumb/item";

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    $thumb_path = $dir . "/" . $thumb_width . "x" . $thumb_height;

    @mkdir($thumb_path, 0707);
    @chmod($thumb_path, 0707);

    // 설정
    $file = shop_item_file($item_id, $upload_mode);

    // 없다면 대표이미지
    if (!$file['upload_file'] && $default) {

        $file = shop_item_file($item_id, $default);

    }

    // 파일
    if ($file['upload_file']) {

        // 썸네일
        $thumb = $thumb_path.'/'.$file['upload_file'];

        // 원본
        $thumb_file = $shop['path']."/data/item/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 파일명
        $img_filename = $file['upload_file'];

    }

    // 썸네일이 없다면
    if (!file_exists($thumb)) {

        // 확장자 체크
        if (preg_match("/\.(jp[e]?g|gif|png)$/i", $thumb_file)) {

            // 썸네일 생성. 가로, 세로, 원본경로, 생성경로
            shop_thumb($thumb_width, $thumb_height, $thumb_file, $thumb, $is_cut);

        }

    }

    if (file_exists($thumb) && $img_filename) {

        $img = $thumb;

    } else {

        $img = "";

    }

    return $img;

}

// 상품페이지 출력
function shop_item_view($text, $html)
{

    $text = stripslashes($text);

    if ($html) {

        // XSS
        $text = preg_replace("/(on)([a-z]+)([^a-z]*)(\=)/i", "&#111;&#110;$2$3$4", $text);
        $text = preg_replace("/(dy)(nsrc)/i", "&#100;&#121;$2", $text);
        $text = preg_replace("/(lo)(wsrc)/i", "&#108;&#111;$2", $text);
        //$text = preg_replace("/(sc)(ript)/i", "&#115;&#99;$2", $text);
        $text = preg_replace("/\<(\w|\s|\?)*(xml)/i", "", $text);

        // <IMG STYLE="xss:expr/*XSS*/ession(alert('XSS'))">
        $text = preg_replace("#\/\*.*\*\/#iU", "", $text);

        $pattern = "";
        $pattern .= "(e|&#(x65|101);?)";
        $pattern .= "(x|&#(x78|120);?)";
        $pattern .= "(p|&#(x70|112);?)";
        $pattern .= "(r|&#(x72|114);?)";
        $pattern .= "(e|&#(x65|101);?)";
        $pattern .= "(s|&#(x73|115);?)";
        $pattern .= "(s|&#(x73|115);?)";
        $pattern .= "(i|&#(x6a|105);?)";
        $pattern .= "(o|&#(x6f|111);?)";
        $pattern .= "(n|&#(x6e|110);?)";
        $text = preg_replace("/".$pattern."/i", "__EXPRESSION__", $text);

    } else {

        $text = preg_replace("/&amp;/", "&", $text);

        // & 처리 : &amp; &nbsp; 등의 코드를 정상 출력함
        $text = shop_text_symbol($text);

        $text = str_replace("  ", "&nbsp; ", $text);
        $text = str_replace("\n ", "\n&nbsp;", $text);

        $text = shop_text($text, 1);

        $text = shop_auto_link($text);

    }

    return $text;

}

// 상품 스킨 출력
function shop_item_skin($this_id, $skin, $ct_id, $icon_id, $item_id, $item_code, $count_width, $count_height, $thumb_width, $thumb_height, $title_len, $rolling, $time, $order, $start=0)
{

    global $shop, $display, $display_id, $display_type, $display_list, $shop_user_login;

    $sql_search = " where item_use != '3' ";

    if ($icon_id) {

        $sql_search .= " and INSTR(item_icon, '|$icon_id|') ";

    }

    if ($ct_id) {

        $sql_search .= " and (category1 = '$ct_id' or category2 = '$ct_id' or category3 = '$ct_id' or category4 = '$ct_id') ";

    }

    if ($item_id) {

        $sql_id = "";
        $k = 0;
        $s = explode(",", trim($item_id));
        for ($i=0; $i<count($s); $i++) {

            if ($s[$i]) {

                if ($k) {

                    $sql_id .= ",'{$s[$i]}'";

                } else {

                    $sql_id .= "'{$s[$i]}'";

                }

                $k++;

            }

        }

        if ($k && $sql_id) {

            $sql_search .= " and id in ($sql_id) ";

        }

    }

    if ($item_code) {

        $sql_search .= " and item_code = '".$item_code."' ";

    }

    if (!$rolling) {

        $rolling = 1;

    }

    if (!$time) {

        $time = 0;

    }

    if (!$count_width) {

        $count_width = 1;

    }

    if (!$count_height) {

        $count_height = 1;

    }

    $count = (int)($count_width * $count_height);
    $limit = (int)($count_width * $count_height * $rolling);

    $list = array();
    $k = 0;
    $n = 0;
    $result = sql_query(" select * from $shop[item_table] $sql_search order by $order limit $start, $limit ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $k++;

        // 1개일 때
        if ($k == '1') {

            $n++;
            $rolling_max = $n;

            // 시작점 지정
            $rolling_start[$n] = $i;

        }

        // 도달
        if ($k >= $count) {

            // 리셋
            $k = 0;

        }

        // 종료점 지정
        $rolling_end[$n] = $i;

        $list[$i] = $row;

    }

    if (!$rolling_max) {

        $rolling_max = 0;

    }

    $dmshop_showwindow_path = "$shop[path]/skin/showwindow/$skin";

    ob_start();
    include("$dmshop_showwindow_path/showwindow.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}

// 기획전 상품 스킨 출력
function shop_plan_skin($this_id, $skin, $plan_id, $ct_id, $icon_id, $item_id, $item_code, $count_width, $count_height, $thumb_width, $thumb_height, $title_len, $rolling, $time, $order)
{

    global $shop, $display, $display_id, $display_type, $display_list;

    $sql_search = " where a.id = b.item_id and a.item_use != '3' ";

    if ($plan_id) {

        $sql_search .= " and b.plan_id = '".$plan_id."' ";

    }

    if ($icon_id) {

        $sql_search .= " and INSTR(a.item_icon, '|$icon_id|') ";

    }

    if ($ct_id) {

        $sql_search .= " and (a.category1 = '$ct_id' or a.category2 = '$ct_id' or a.category3 = '$ct_id' or a.category4 = '$ct_id') ";

    }

    if ($item_id) {

        $sql_id = "";
        $k = 0;
        $s = explode(",", trim($item_id));
        for ($i=0; $i<count($s); $i++) {

            if ($s[$i]) {

                if ($k) {

                    $sql_id .= ",'{$s[$i]}'";

                } else {

                    $sql_id .= "'{$s[$i]}'";

                }

                $k++;

            }

        }

        if ($k && $sql_id) {

            $sql_search .= " and id in ($sql_id) ";

        }

    }

    if ($item_code) {

        $sql_search .= " and a.item_code = '".$item_code."' ";

    }

    if (!$rolling) {

        $rolling = 1;

    }

    if (!$time) {

        $time = 0;

    }

    if (!$count_width) {

        $count_width = 1;

    }

    if (!$count_height) {

        $count_height = 1;

    }

    $count = (int)($count_width * $count_height);
    $limit = (int)($count_width * $count_height * $rolling);

    $list = array();
    $k = 0;
    $n = 0;
    $result = sql_query(" select a.* from $shop[item_table] a, $shop[plan_item_table] b $sql_search order by $order limit 0, $limit ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $k++;

        // 1개일 때
        if ($k == '1') {

            $n++;
            $rolling_max = $n;

            // 시작점 지정
            $rolling_start[$n] = $i;

        }

        // 도달
        if ($k >= $count) {

            // 리셋
            $k = 0;

        }

        // 종료점 지정
        $rolling_end[$n] = $i;

        $list[$i] = $row;

    }

    if (!$rolling_max) {

        $rolling_max = 0;

    }

    $dmshop_showwindow_path = "$shop[path]/skin/showwindow/$skin";

    ob_start();
    include("$dmshop_showwindow_path/showwindow.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}

// 상품 아이콘
function shop_icon_file($id)
{

    global $shop;

    if ($id) { $id = preg_match("/^[0-9]+$/", $id) ? $id : ""; }

    if (!$id) {

        return false;

    }

    return sql_fetch(" select * from $shop[icon_file_table] where id = '$id' ");

}

// 상품 아이콘 전체
function shop_icon_view($item_icon)
{

    global $shop;

    if (!$item_icon) {
        return false;
    }

    $icon = "";

    $str = explode("|", $item_icon);
    for ($k=0; $k<count($str); $k++) {
    
        if ($str[$k]) {
    
            $file = shop_icon_file($str[$k]);
    
            if ($file['upload_file'] && $file['view']) {

                $icon .= shop_file_view($shop['path']."/data/icon/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);

            }
    
        }
    
    }

    return $icon;

}

// 관련상품
function shop_relation($relation_id)
{

    global $shop;

    if ($relation_id) { $relation_id = preg_match("/^[0-9]+$/", $relation_id) ? $relation_id : ""; }

    if (!$relation_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[relation_table] where id = '$relation_id' ");

}

// 관련상품
function shop_relation_item($item_id)
{

    global $shop;

    if ($item_id) { $item_id = preg_match("/^[a-zA-Z0-9]+$/", $item_id) ? $item_id : ""; }

    if (!$item_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[relation_table] where item_id = '$item_id' ");

}

// 관련상품
function shop_relation_add($item_id, $item_add_id)
{

    global $shop;

    if ($item_id) { $item_id = preg_match("/^[a-zA-Z0-9]+$/", $item_id) ? $item_id : ""; }
    if ($item_add_id) { $item_add_id = preg_match("/^[0-9]+$/", $item_add_id) ? $item_add_id : ""; }

    if (!$item_id || !$item_add_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[relation_table] where item_id = '$item_id' and item_add_id = '$item_add_id' ");

}

// 관심상품 보관수
function shop_favorite_user_count($user_id)
{

    global $shop;

    if (!$user_id) {

        return false;

    }

    $data = sql_fetch(" select count(*) as total_count from $shop[favorite_table] where user_id = '".$user_id."' ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

/*--------------------------------
    ## 주문 및 결제 ##
--------------------------------*/

// 장바구니
function shop_cart($cart_id)
{

    global $shop;

    if ($cart_id) { $cart_id = preg_match("/^[0-9]+$/", $cart_id) ? $cart_id : ""; }

    if (!$cart_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[cart_table] where id = '$cart_id' ");

}

// 보관함
function shop_favorite($favorite_id)
{

    global $shop;

    if ($favorite_id) { $favorite_id = preg_match("/^[0-9]+$/", $favorite_id) ? $favorite_id : ""; }

    if (!$favorite_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[favorite_table] where id = '$favorite_id' ");

}

// 결제수단 명칭
function shop_pay_name($id)
{

    if ($id == '1') {

        $data = "신용카드";

    }

    else if ($id == '2') {

        $data = "실시간 계좌이체";

    }

    else if ($id == '3') {

        $data = "휴대폰 결제";

    }

    else if ($id == '4') {

        $data = "가상계좌";

    }

    else if ($id == '5') {

        $data = "무통장 입금";

    }

    else if ($id == '6') {

        $data = "적립금";

    } else {

        $data = "기타";

    }

    return $data;

}

// 영수증 명칭
function shop_receipt_name($order_receipt)
{

    if ($order_receipt == '1') {

        $data = "개인소득공제";

    }

    else if ($order_receipt == '2') {

        $data = "사업자지출증빙";

    }

    else if ($order_receipt == '3') {

        $data = "-";

    } else {

        $data = "신청안함";

    }

    return $data;

}

// 결제상태
function shop_order_payment($id)
{

    if ($id == '0') {

        $data = "결제승인중";

    }

    else if ($id == '1') {

        $data = "결제전";

    }

    else if ($id == '2') {

        $data = "결제완료";

    } else {

        $data = "기타";

    }

    return $data;

}

// 주문상태
function shop_order_type($id)
{

    if ($id == '100') {

        $data = "결제전";

    }

    else if ($id == '101') {

        $data = "결제완료";

    }

    else if ($id == '200') {

        $data = "배송준비";

    }

    else if ($id == '201') {

        $data = "배송중";

    }

    else if ($id == '202') {

        $data = "상품수령";

    }

    else if ($id == '300') {

        $data = "취소접수";

    }

    else if ($id == '301') {

        $data = "취소완료";

    }

    else if ($id == '400') {

        $data = "교환접수";

    }

    else if ($id == '401') {

        $data = "교환중";

    }

    else if ($id == '500') {

        $data = "환불접수";

    }

    else if ($id == '501') {

        $data = "환불완료";

    }

    else if ($id == '900') {

        $data = "구매완료";

    } else {

        $data = "기타";

    }

    return $data;

}

// 주문 정보
function shop_order($order_code)
{

    global $shop;

    if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }

    if (!$order_code) {

        return false;

    }

    return sql_fetch(" select * from $shop[order_table] where order_code = '$order_code' ");

}

// 주문 정보
function shop_order_id($order_id)
{

    global $shop;

    if ($order_id) { $order_id = preg_match("/^[0-9]+$/", $order_id) ? $order_id : ""; }

    if (!$order_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[order_table] where id = '$order_id' ");

}

// 주문 외 몇 건
function shop_order_etc_count($order_code)
{

    global $shop;

    if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }

    if (!$order_code) {

        return false;

    }

    $order = sql_fetch(" select count(*) as total_count from $shop[order_table] where order_code = '$order_code' ");

    if ($order['total_count'] && $order['total_count'] > '1') {

        return $order['total_count'];

    } else {

        return false;

    }

}

// 주문 공통 처리 (쿠폰, 수량, 판매수)
function shop_order_update($mode, $order_code, $sms_send="")
{

    global $shop, $dmshop;

    if (!$order_code) {

        return false;

    }

    // 주문
    if ($mode == 'order') {

        // 장바구니 삭제
        sql_query(" delete from $shop[cart_table] where order_code = '".$order_code."' ");

        // 주문내역
        $count = 0;
        $result = sql_query(" select * from $shop[order_table] where order_code = '".$order_code."' order by id asc ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            if ($i > '0') {

                $count++;

            }

            if ($i == '0') {

                $dmshop_order = $row;

            }

            // 쿠폰적용
            if ($row['order_coupon_id']) {

                // 쿠폰 사용완료 변경
                sql_query(" update $shop[coupon_list_table] set coupon_mode  = '2', item_id = '".$row['item_id']."', item_code = '".$row['item_code']."', item_title = '".addslashes($row['item_title'])."', order_id = '".$row['id']."', order_code = '".$order_code."', order_datetime = '".$shop['time_ymdhis']."' where id = '".$row['order_coupon_id']."' ");

                // 쿠폰 데이터
                $dmshop_coupon_list = shop_coupon_list($row['order_coupon_id']);

                // 쿠폰이 있다면
                if ($dmshop_coupon_list['coupon_id']) {

                    // 쿠폰 사용수 증가
                    sql_query(" update $shop[coupon_table] set coupon_order = coupon_order + 1 where id = '".$dmshop_coupon_list['coupon_id']."' ");

                }

            }

            // 옵션 수량 감소
            if ($row['option_id']) {

                sql_query(" update $shop[item_option_table] set option_limit  = option_limit - ".(int)($row['order_limit'])." where id = '".$row['option_id']."' ");

            } else {
            // 기본 수량 감소

                sql_query(" update $shop[item_table] set item_limit  = item_limit - ".(int)($row['order_limit'])." where id = '".$row['item_id']."' ");

            }

            // 상품 판매수 증가
            sql_query(" update $shop[item_table] set item_sale  = item_sale + 1 where id = '".$row['item_id']."' ");

            // 기획전 판매수 증가
            sql_query(" update $shop[plan_item_table] set item_sale  = item_sale + 1 where item_id = '".$row['item_id']."' ");

        }

        if ($sms_send) {

            // sms 1
            $shop_sms_config = shop_sms_config("order");

            // 사용
            if ($shop_sms_config['sms_use']) {

                $sms_to = $dmshop_order['order_hp'];
                $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

                $sms_message = $shop_sms_config['sms_message'];
                $sms_message = str_replace("[주문번호]", $order_code, $sms_message);
                $sms_message = str_replace("[주문자명]", $dmshop_order['order_name'], $sms_message);
                $sms_message = str_replace("[결제금액]", $dmshop_order['order_pay_money'], $sms_message);
                $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
                $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

                if ($count) {

                    $sms_message = str_replace("[주문상품]", $dmshop_order['item_title']." 외 {$count}건", $sms_message);

                } else {

                    $sms_message = str_replace("[주문상품]", $dmshop_order['item_title'], $sms_message);

                }

                // 전송
                shop_sms_send("order", $dmshop_order['user_id'], $sms_to, $sms_from, $sms_message);

            }

            // sms 2
            $shop_sms_config = shop_sms_config("admin_order");

            // 사용
            if ($shop_sms_config['sms_use']) {

                $sms_to = $dmshop['rec_sms1'].$dmshop['rec_sms2'].$dmshop['rec_sms3'];
                $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

                $sms_message = $shop_sms_config['sms_message'];
                $sms_message = str_replace("[주문번호]", $order_code, $sms_message);
                $sms_message = str_replace("[주문자명]", $dmshop_order['order_name'], $sms_message);
                $sms_message = str_replace("[결제금액]", $dmshop_order['order_pay_money'], $sms_message);
                $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
                $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

                if ($count) {

                    $sms_message = str_replace("[주문상품]", $dmshop_order['item_title']." 외 {$count}건", $sms_message);

                } else {

                    $sms_message = str_replace("[주문상품]", $dmshop_order['item_title'], $sms_message);

                }

                // 전송
                shop_sms_send("admin_order", $dmshop_order['user_id'], $sms_to, $sms_from, $sms_message);

            }

        }

    } else {
    // 취소

        // 주문내역
        $result = sql_query(" select * from $shop[order_table] where order_code = '".$order_code."' order by id asc ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            // 쿠폰적용
            if ($row['order_coupon_id']) {

                // 쿠폰 미사용으로 변경
                sql_query(" update $shop[coupon_list_table] set coupon_mode  = '0', item_id = '0', item_code = '', item_title = '', cart_id = '0', order_id = '0', order_code = '', order_datetime = '0000-00-00 00:00:00' where id = '".$row['order_coupon_id']."' ");

                // 쿠폰 데이터
                $dmshop_coupon_list = shop_coupon_list($row['order_coupon_id']);

                // 쿠폰이 있다면
                if ($dmshop_coupon_list['coupon_id']) {

                    // 쿠폰 사용수 감소
                    sql_query(" update $shop[coupon_table] set coupon_order = coupon_order - 1 where id = '".$dmshop_coupon_list['coupon_id']."' ");

                }

            }

            // 옵션 수량 증가
            if ($row['option_id']) {

                sql_query(" update $shop[item_option_table] set option_limit  = option_limit + ".(int)($row['order_limit'])." where id = '".$row['option_id']."' ");

            } else {
            // 기본 수량 증가

                sql_query(" update $shop[item_table] set item_limit  = item_limit + ".(int)($row['order_limit'])." where id = '".$row['item_id']."' ");

            }

            // 상품 판매수 감소
            sql_query(" update $shop[item_table] set item_sale  = item_sale - 1 where id = '".$row['item_id']."' ");

            // 기획전 판매수 감소
            sql_query(" update $shop[plan_item_table] set item_sale  = item_sale - 1 where item_id = '".$row['item_id']."' ");

        }

    }

    return true;

}

// 주문 무통장 처리
function shop_order_bank($mode, $order_code, $order_dep_name_real, $order_dep_money_real, $order_pay_datetime, $order_pay_smstype1, $order_pay_smstype2)
{

    global $shop, $dmshop;

    if (!$order_code) {

        return false;

    }

    // 주문정보
    $dmshop_order = shop_order($order_code);

    // 데이터가 없다
    if (!$dmshop_order['id']) {

        return false;

    }

    // 입금확인
    if ($mode == 'ok') {

        // 결제전 상태
        if ($dmshop_order['order_type'] == '100') {

            $sql_common = "";
            $sql_common .= " set order_type = '101' ";
            $sql_common .= ", order_payment = '2' ";
            $sql_common .= ", order_dep_name_real = '".$order_dep_name_real."' ";
            $sql_common .= ", order_dep_money_real = '".$order_dep_money_real."' ";
            $sql_common .= ", order_pay_datetime = '".$order_pay_datetime."' ";

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

            // 주문자 sms 발송
            if ($order_pay_smstype1) {

                // sms 1
                $shop_sms_config = shop_sms_config("order_bank_ok");

                // 사용
                if ($shop_sms_config['sms_use']) {

                    $sms_to = $dmshop_order['order_hp'];
                    $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

                    $sms_message = $shop_sms_config['sms_message'];
                    $sms_message = str_replace("[주문번호]", $order_code, $sms_message);
                    $sms_message = str_replace("[주문자명]", $dmshop_order['order_name'], $sms_message);
                    $sms_message = str_replace("[수령자명]", $dmshop_order['order_rec_name'], $sms_message);
                    $sms_message = str_replace("[결제금액]", $dmshop_order['order_pay_money'], $sms_message);
                    $sms_message = str_replace("[은행명]", $dmshop_order['order_bank_name'], $sms_message);
                    $sms_message = str_replace("[계좌]", $dmshop_order['order_bank_number'], $sms_message);
                    $sms_message = str_replace("[예금주]", $dmshop_order['order_bank_holder'], $sms_message);
                    $sms_message = str_replace("[입금자명]", $dmshop_order['order_dep_name'], $sms_message);
                    $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
                    $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

                    $count = shop_order_etc_count($order_code);

                    if ($count) {

                        $sms_message = str_replace("[주문상품]", $dmshop_order['item_title']." 외 {$count}건", $sms_message);

                    } else {

                        $sms_message = str_replace("[주문상품]", $dmshop_order['item_title'], $sms_message);

                    }

                    // 전송
                    shop_sms_send("order_bank_ok", $dmshop_order['user_id'], $sms_to, $sms_from, $sms_message);

                }

            }

            // 수령자 sms 발송
            if ($order_pay_smstype2) {

                // sms 2
                $shop_sms_config = shop_sms_config("order_bank_ok");

                // 사용
                if ($shop_sms_config['sms_use']) {

                    $sms_to = $dmshop_order['order_rec_hp'];
                    $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

                    $sms_message = $shop_sms_config['sms_message'];
                    $sms_message = str_replace("[주문번호]", $order_code, $sms_message);
                    $sms_message = str_replace("[주문자명]", $dmshop_order['order_name'], $sms_message);
                    $sms_message = str_replace("[수령자명]", $dmshop_order['order_rec_name'], $sms_message);
                    $sms_message = str_replace("[결제금액]", $dmshop_order['order_pay_money'], $sms_message);
                    $sms_message = str_replace("[은행명]", $dmshop_order['order_bank_name'], $sms_message);
                    $sms_message = str_replace("[계좌]", $dmshop_order['order_bank_number'], $sms_message);
                    $sms_message = str_replace("[예금주]", $dmshop_order['order_bank_holder'], $sms_message);
                    $sms_message = str_replace("[입금자명]", $dmshop_order['order_dep_name'], $sms_message);
                    $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
                    $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

                    $count = shop_order_etc_count($order_code);

                    if ($count) {

                        $sms_message = str_replace("[주문상품]", $dmshop_order['item_title']." 외 {$count}건", $sms_message);

                    } else {

                        $sms_message = str_replace("[주문상품]", $dmshop_order['item_title'], $sms_message);

                    }

                    // 전송
                    shop_sms_send("order_bank_ok", $dmshop_order['user_id'], $sms_to, $sms_from, $sms_message);

                }

            }

        }

    }

    // 입금정보 수정
    else if ($mode == 'update') {

        $sql_common = "";
        $sql_common .= " set order_dep_name_real = '".$order_dep_name_real."' ";
        $sql_common .= ", order_dep_money_real = '".$order_dep_money_real."' ";
        $sql_common .= ", order_pay_datetime = '".$order_pay_datetime."' ";

        sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

    }

    // 입금 취소
    else if ($mode == 'cancel') {

        // 결제완료 상태
        if ($dmshop_order['order_type'] == '101') {

            $sql_common = "";
            $sql_common .= " set order_type = '100' ";
            $sql_common .= ", order_payment = '1' ";
            $sql_common .= ", order_dep_name_real = '' ";
            $sql_common .= ", order_dep_money_real = '' ";
            $sql_common .= ", order_pay_datetime = '0000-00-00 00:00:00' ";

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

        }

    } else {

        return false;

    }

    return true;

}

// 주문 배송준비 처리
function shop_order_prepare($mode, $order_code)
{

    global $shop;

    if (!$order_code) {

        return false;

    }

    // 주문정보
    $dmshop_order = shop_order($order_code);

    // 데이터가 없다
    if (!$dmshop_order['id']) {

        return false;

    }

    // 배송준비
    if ($mode == 'ok') {

        // 결제완료 상태
        if ($dmshop_order['order_type'] == '101') {

            $sql_common = "";
            $sql_common .= " set order_type = '200' ";
            $sql_common .= ", order_delivery = '1' ";

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

        }

    }

    // 배송준비 취소
    else if ($mode == 'cancel') {

        // 배송준비 상태
        if ($dmshop_order['order_type'] == '200') {

            $sql_common = "";
            $sql_common .= " set order_type = '101' ";
            $sql_common .= ", order_delivery = '0' ";

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

        }

    } else {

        return false;

    }

    return true;

}

// 주문 상품발송 처리
function shop_order_delivery($mode, $order_code, $order_delivery_id, $order_delivery_tel, $order_delivery_url, $order_delivery_number, $order_delivery_datetime, $order_delivery_smstype1, $order_delivery_smstype2)
{

    global $shop, $dmshop, $dmshop_user;

    if (!$order_code) {

        return false;

    }

    // 주문정보
    $dmshop_order = shop_order($order_code);

    // 데이터가 없다
    if (!$dmshop_order['id']) {

        return false;

    }

    // 상품발송
    if ($mode == 'ok') {

        // 배송준비중 상태
        if ($dmshop_order['order_type'] == '200') {

            $sql_common = "";
            $sql_common .= " set order_type = '201' ";
            $sql_common .= ", order_delivery = '2' ";
            $sql_common .= ", order_delivery_id = '".$order_delivery_id."' ";
            $sql_common .= ", order_delivery_name = '".shop_pg_parcelname($order_delivery_id)."' ";
            $sql_common .= ", order_delivery_tel = '".$order_delivery_tel."' ";
            $sql_common .= ", order_delivery_url = '".$order_delivery_url."' ";
            $sql_common .= ", order_delivery_number = '".$order_delivery_number."' ";
            $sql_common .= ", order_delivery_datetime = '".$order_delivery_datetime."' ";

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

            // 주문자 sms 발송
            if ($order_delivery_smstype1) {

                // sms 1
                $shop_sms_config = shop_sms_config("delivery");

                // 사용
                if ($shop_sms_config['sms_use']) {

                    $sms_to = $dmshop_order['order_hp'];
                    $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

                    $sms_message = $shop_sms_config['sms_message'];
                    $sms_message = str_replace("[주문번호]", $order_code, $sms_message);
                    $sms_message = str_replace("[주문자명]", $dmshop_order['order_name'], $sms_message);
                    $sms_message = str_replace("[수령자명]", $dmshop_order['order_rec_name'], $sms_message);
                    $sms_message = str_replace("[결제금액]", $dmshop_order['order_pay_money'], $sms_message);
                    $sms_message = str_replace("[배송업체]", shop_pg_parcelname($order_delivery_id), $sms_message);
                    $sms_message = str_replace("[배송연락처]", $order_delivery_tel, $sms_message);
                    $sms_message = str_replace("[운송장]", $order_delivery_number, $sms_message);
                    $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
                    $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

                    $count = shop_order_etc_count($order_code);

                    if ($count) {

                        $sms_message = str_replace("[주문상품]", $dmshop_order['item_title']." 외 {$count}건", $sms_message);

                    } else {

                        $sms_message = str_replace("[주문상품]", $dmshop_order['item_title'], $sms_message);

                    }

                    // 전송
                    shop_sms_send("delivery", $dmshop_order['user_id'], $sms_to, $sms_from, $sms_message);

                }

            }

            // 수령자 sms 발송
            if ($order_delivery_smstype2) {

                // sms 2
                $shop_sms_config = shop_sms_config("delivery");

                // 사용
                if ($shop_sms_config['sms_use']) {

                    $sms_to = $dmshop_order['order_rec_hp'];
                    $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

                    $sms_message = $shop_sms_config['sms_message'];
                    $sms_message = str_replace("[주문번호]", $order_code, $sms_message);
                    $sms_message = str_replace("[주문자명]", $dmshop_order['order_name'], $sms_message);
                    $sms_message = str_replace("[수령자명]", $dmshop_order['order_rec_name'], $sms_message);
                    $sms_message = str_replace("[결제금액]", $dmshop_order['order_pay_money'], $sms_message);
                    $sms_message = str_replace("[배송업체]", shop_pg_parcelname($order_delivery_id), $sms_message);
                    $sms_message = str_replace("[배송연락처]", $order_delivery_tel, $sms_message);
                    $sms_message = str_replace("[운송장]", $order_delivery_number, $sms_message);
                    $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
                    $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

                    $count = shop_order_etc_count($order_code);

                    if ($count) {

                        $sms_message = str_replace("[주문상품]", $dmshop_order['item_title']." 외 {$count}건", $sms_message);

                    } else {

                        $sms_message = str_replace("[주문상품]", $dmshop_order['item_title'], $sms_message);

                    }

                    // 전송
                    shop_sms_send("delivery", $dmshop_order['user_id'], $sms_to, $sms_from, $sms_message);

                }

            }

            // kcp 에스크로
            if ($dmshop_order['order_pg'] == '3' && $dmshop_order['order_pg_escrow'] == '1' && $dmshop['kcp_site_code'] && $dmshop_order['order_pg_code1']) {

                // lib
                include_once("$shop[path]/pay/kcp/cfg/site_conf_inc.php");
                include_once("$shop[path]/pay/kcp/pp_ax_hub_lib.php");

                $tno = $dmshop_order['order_pg_code1'];
                $cust_ip = getenv("REMOTE_ADDR");
                $ordr_idxx = $order_code;

                $c_PayPlus = new C_PP_CLI;
                $c_PayPlus->mf_clear();

                $tran_cd = "00200000";

                $mod_type = "STE1"; // 배송시작

                $c_PayPlus->mf_set_modx_data("tno", $tno); // KCP 원거래 거래번호
                $c_PayPlus->mf_set_modx_data("mod_type", $mod_type); // 원거래 변경 요청 종류
                $c_PayPlus->mf_set_modx_data("mod_ip", $cust_ip); // 변경 요청자 IP
                $c_PayPlus->mf_set_modx_data("mod_desc", ""); // 변경 사유

                // 송장번호가 있다면
                if ($order_delivery_id && $order_delivery_number) {

                    $c_PayPlus->mf_set_modx_data("deli_numb", $order_delivery_number); // 운송장 번호
                    $c_PayPlus->mf_set_modx_data("deli_corp", shop_pg_parcelname($order_delivery_id)); // 택배 업체명

                } else {
                // 직접배송

                    $c_PayPlus->mf_set_modx_data("deli_numb", "0000"); // 운송장 번호
                    $c_PayPlus->mf_set_modx_data("deli_corp", "자가배송"); // 택배 업체명

                }

                $c_PayPlus->mf_do_tx($tno, $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "", $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx, $cust_ip, $g_conf_log_level, 0, 0, $g_conf_key_dir, $g_conf_log_dir);

                $res_cd  = $c_PayPlus->m_res_cd;  // 결과 코드
                $res_msg = $c_PayPlus->m_res_msg; // 결과 메시지
                $res_msg = mb_convert_encoding($res_msg, 'UTF-8', 'CP949'); // 한글 문자열을 변환

                if ($res_cd == '0000') {

                    // 배송시작
                    sql_query(" update $shop[order_table] set order_pg_escrow = '2' where order_code = '".$order_code."' ");

                } else {

                    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$shop[charset]\">";
                    echo "<script type='text/javascript'>alert('KCP 에스크로 배송시작을 실패하였습니다.\\n\\n가맹점 상점관리에서 직접 배송시작을 하시기 바랍니다.\\n\\n결과 메세지 : {$res_msg}\\n\\n주문번호 : {$order_code}');</script>";

                }

            }

        }

    }

    // 상품발송 수정
    else if ($mode == 'update') {

        $sql_common = "";
        $sql_common .= " set order_delivery_id = '".$order_delivery_id."' ";
        $sql_common .= ", order_delivery_name = '".shop_pg_parcelname($order_delivery_id)."' ";
        $sql_common .= ", order_delivery_tel = '".$order_delivery_tel."' ";
        $sql_common .= ", order_delivery_url = '".$order_delivery_url."' ";
        $sql_common .= ", order_delivery_number = '".$order_delivery_number."' ";
        $sql_common .= ", order_delivery_datetime = '".$order_delivery_datetime."' ";

        sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

    }

    // 상품발송 취소
    else if ($mode == 'cancel') {

        // 상품발송 상태
        if ($dmshop_order['order_type'] == '201') {

            $sql_common = "";
            $sql_common .= " set order_type = '200' ";
            $sql_common .= ", order_delivery = '1' ";
            $sql_common .= ", order_delivery_id = '' ";
            $sql_common .= ", order_delivery_name = '' ";
            $sql_common .= ", order_delivery_tel = '' ";
            $sql_common .= ", order_delivery_url = '' ";
            $sql_common .= ", order_delivery_number = '' ";
            $sql_common .= ", order_delivery_datetime = '0000-00-00 00:00:00' ";

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

        }

    } else {

        return false;

    }

    return true;

}

// 주문 취소 처리
function shop_order_cancel($mode, $order_code)
{

    global $shop;

    if (!$order_code) {

        return false;

    }

    // 주문정보
    $dmshop_order = shop_order($order_code);

    // 데이터가 없다
    if (!$dmshop_order['id']) {

        return false;

    }

    // 취소완료
    if ($mode == 'ok') {

        // 이미 취소되었다면
        if ($dmshop_order['order_cancel'] == '2') {

            return false;

        }

        // 결제완료, 에스크로, 가상계좌
        if ($dmshop_order['order_payment'] == '2' && $dmshop_order['order_pg_escrow'] && $dmshop_order['order_pay_type'] == '4') {

            // KCP
            if ($dmshop_order['order_pg'] == '3') {

                // 환불 계좌 정보가 없다면
                if (!$dmshop_order['order_refund_number'] || !$dmshop_order['order_refund_holder'] || !$dmshop_order['order_refund_code']) {

                    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$shop[charset]\">";
                    echo "<script type='text/javascript'>alert('관리자 주문관리 옵션 -> 결제정보 -> 환불 은행정보를 먼저 등록하시기 바랍니다.\\n\\n주문번호 : {$order_code}');</script>";

                    return false;

                }

            }

        }

        $sql_common = "";
        $sql_common .= " set order_type = '301' ";
        $sql_common .= ", order_cancel = '2' ";
        $sql_common .= ", order_cancel_ok_datetime = '".$shop['time_ymdhis']."' ";

        // 접수내역이 없을 때
        if (!$dmshop_order['order_cancel']) {

            $sql_common .= ", order_type_tmp = '".$dmshop_order['order_type']."' ";
            $sql_common .= ", order_cancel_datetime = '".$shop['time_ymdhis']."' ";

        }

        sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

        // 주문 공통 처리 (쿠폰, 수량, 판매수)
        shop_order_update("cancel", $order_code);

        // 주문내역 (전체)
        $result = sql_query(" select * from $shop[order_table] where order_code = '".$order_code."' ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            // 적립 금액이 있다면
            if ($row['item_cash'] && $row['user_id']) {

                // 상품 적립금 회수
                shop_cash_delete($row['user_id'], "", $row['user_id'], $row['id'], "order_item");

            }

        }

        if ($dmshop_order['user_id']) {

            // 결제시 사용된 적립금 반환
            shop_cash_delete($dmshop_order['user_id'], "", $dmshop_order['user_id'], $order_code, "order");

        }

        // 카드, 이체, 휴대폰
        if ($dmshop_order['order_pay_type'] == '1' || $dmshop_order['order_pay_type'] == '2' || $dmshop_order['order_pay_type'] == '3' || $dmshop_order['order_pay_type'] == '4') {

            // PG 결제 취소한다
            shop_pg_cancel($order_code);

        }

    }

    // 취소거절
    else if ($mode == 'cancel') {

        // 취소접수 상태만 가능
        if ($dmshop_order['order_type'] == '300') {

            $sql_common = "";
            $sql_common .= " set order_type = '".$dmshop_order['order_type_tmp']."' ";
            $sql_common .= ", order_type_tmp = '' ";
            $sql_common .= ", order_cancel = '0' ";
            $sql_common .= ", order_cancel_datetime = '0000-00-00 00:00:00' ";
            $sql_common .= ", order_cancel_ok_datetime = '0000-00-00 00:00:00' ";

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

        }

    }

    // 내역삭제
    else if ($mode == 'delete') {

        // 취소완료 상태만 가능
        //if ($dmshop_order['order_type'] == '301') {

            sql_query(" delete from $shop[order_table] where order_code = '".$order_code."' ");

        //}

    } else {

        return false;

    }

    return true;

}

// 주문 교환 처리
function shop_order_exchange($mode, $order_code)
{

    global $shop;

    if (!$order_code) {

        return false;

    }

    // 주문정보
    $dmshop_order = shop_order($order_code);

    // 데이터가 없다
    if (!$dmshop_order['id']) {

        return false;

    }

    // 교환완료
    if ($mode == 'ok') {

        // 이미 교환되었다면
        if ($dmshop_order['order_exchange'] == '2') {

            return false;

        }

        // 교환접수 상태만 가능
        if ($dmshop_order['order_type'] == '400') {

            $sql_common = "";
            $sql_common .= " set order_type = '401' ";
            $sql_common .= ", order_exchange = '2' ";
            $sql_common .= ", order_exchange_ok_datetime = '".$shop['time_ymdhis']."' ";

            // 접수내역이 없을 때
            if (!$dmshop_order['order_exchange']) {

                $sql_common .= ", order_type_tmp = '".$dmshop_order['order_type']."' ";
                $sql_common .= ", order_exchange_datetime = '".$shop['time_ymdhis']."' ";

            }

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

        }

    }

    // 교환거절
    else if ($mode == 'cancel') {

        // 교환접수 상태만 가능
        if ($dmshop_order['order_type'] == '400') {

            $sql_common = "";
            $sql_common .= " set order_type = '".$dmshop_order['order_type_tmp']."' ";
            $sql_common .= ", order_type_tmp = '' ";
            $sql_common .= ", order_exchange = '0' ";
            $sql_common .= ", order_exchange_datetime = '0000-00-00 00:00:00' ";
            $sql_common .= ", order_exchange_ok_datetime = '0000-00-00 00:00:00' ";

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

        }

    }

    // 내역삭제
    else if ($mode == 'delete') {

        // 교환완료 상태만 가능
        //if ($dmshop_order['order_type'] == '401') {

            sql_query(" delete from $shop[order_table] where order_code = '".$order_code."' ");

        //}

    } else {

        return false;

    }

    return true;

}

// 주문 환불 처리
function shop_order_refund($mode, $order_code)
{

    global $shop;

    if (!$order_code) {

        return false;

    }

    // 주문정보
    $dmshop_order = shop_order($order_code);

    // 데이터가 없다
    if (!$dmshop_order['id']) {

        return false;

    }

    // 환불완료
    if ($mode == 'ok') {

        // 환불접수 상태만 가능
        if ($dmshop_order['order_type'] == '500') {

            // 이미 환불되었다면
            if ($dmshop_order['order_refund'] == '2') {

                return false;

            }

            // 결제완료, 에스크로, 가상계좌
            if ($dmshop_order['order_payment'] == '2' && $dmshop_order['order_pg_escrow'] && $dmshop_order['order_pay_type'] == '4') {

                // KCP
                if ($dmshop_order['order_pg'] == '3') {

                    // 환불 계좌 정보가 없다면
                    if (!$dmshop_order['order_refund_number'] || !$dmshop_order['order_refund_holder'] || !$dmshop_order['order_refund_code']) {

                        echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$shop[charset]\">";
                        echo "<script type='text/javascript'>alert('관리자 주문관리 옵션 -> 결제정보 -> 환불 은행정보를 먼저 등록하시기 바랍니다.\\n\\n주문번호 : {$order_code}');</script>";

                        return false;

                    }

                }

            }

            $sql_common = "";
            $sql_common .= " set order_type = '501' ";
            $sql_common .= ", order_refund = '2' ";
            $sql_common .= ", order_refund_ok_datetime = '".$shop['time_ymdhis']."' ";

            // 접수내역이 없을 때
            if (!$dmshop_order['order_refund']) {

                $sql_common .= ", order_type_tmp = '".$dmshop_order['order_type']."' ";
                $sql_common .= ", order_refund_datetime = '".$shop['time_ymdhis']."' ";

            }

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

            // 주문 공통 처리 (쿠폰, 수량, 판매수)
            shop_order_update("cancel", $order_code);

            // 주문내역 (전체)
            $result = sql_query(" select * from $shop[order_table] where order_code = '".$order_code."' ");
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                // 적립 금액이 있다면
                if ($row['item_cash'] && $row['user_id']) {

                    // 상품 적립금 회수
                    shop_cash_delete($row['user_id'], "", $row['user_id'], $row['id'], "order_item");

                }

            }

            if ($dmshop_order['user_id']) {

                // 결제시 사용된 적립금 반환
                shop_cash_delete($dmshop_order['user_id'], "", $dmshop_order['user_id'], $order_code, "order");

            }

            // 카드, 이체, 휴대폰
            if ($dmshop_order['order_pay_type'] == '1' || $dmshop_order['order_pay_type'] == '2' || $dmshop_order['order_pay_type'] == '3' || $dmshop_order['order_pay_type'] == '4') {

                // PG 결제 취소한다
                shop_pg_cancel($order_code);

            }

        }

    }

    // 환불거절
    else if ($mode == 'cancel') {

        // 환불접수 상태만 가능
        if ($dmshop_order['order_type'] == '500') {

            $sql_common = "";
            $sql_common .= " set order_type = '".$dmshop_order['order_type_tmp']."' ";
            $sql_common .= ", order_type_tmp = '' ";
            $sql_common .= ", order_refund = '0' ";
            $sql_common .= ", order_refund_datetime = '0000-00-00 00:00:00' ";
            $sql_common .= ", order_refund_ok_datetime = '0000-00-00 00:00:00' ";

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$order_code."' ");

        }

    }

    // 내역삭제
    else if ($mode == 'delete') {

        // 환불완료 상태만 가능
        //if ($dmshop_order['order_type'] == '501') {

            sql_query(" delete from $shop[order_table] where order_code = '".$order_code."' ");

        //}

    } else {

        return false;

    }

    return true;

}

// 주문 수량
function shop_order_limit($item_id)
{

    global $shop;

    if ($item_id) { $item_id = preg_match("/^[a-zA-Z0-9]+$/", $item_id) ? $item_id : ""; }

    if (!$item_id) {

        return false;

    }

    // 결제가 되고, 취소, 환불 완료가 아닌 것만
    $order = sql_fetch(" select sum(order_limit) as total_count from $shop[order_table] where item_id = '".$item_id."' and order_payment = '2' and order_cancel != '2' and order_refund != '2' ");

    if ($order['total_count']) {

        return (int)($order['total_count']);

    } else {

        return false;

    }

}

// 주문수
function shop_order_user_count($user_id, $order_payment)
{

    global $shop;

    if (!$user_id) {

        return false;

    }

    // 결제여부
    if ($order_payment) {

        $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where user_id = '".$user_id."' and order_payment = '".$order_payment."' ");

    } else {
    // 전체 주문건만 (취소 환불 반품 제외)

        $data = sql_fetch(" select count(distinct order_code) as total_count from $shop[order_table] where user_id = '".$user_id."' and order_payment != '0' and order_cancel = '0' and order_exchange = '0' and order_refund = '0' ");

    }

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 자동수령확인
function shop_order_receive_ok()
{

    global $shop, $dmshop;

    // 수령시각
    $order_delivery_datetime = date("Y-m-d H:i:s", $shop['server_time'] - ($dmshop['order_receive_day'] * 86400));

    // 발송했고, 미수령, 기간 경과, 취소, 환불, 교환, 구매확정이 아닌 상품
    $sql_search = " where order_delivery = '2' and order_receive = '0' and order_delivery_datetime <= '".$order_delivery_datetime."' and order_cancel = '0' and order_refund = '0' and order_exchange = '0' and order_ok = '0' ";

    // 주문내역 (전체)
    $result = sql_query(" select * from $shop[order_table] $sql_search ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        // 상품수령
        sql_query(" update $shop[order_table] set order_type = '202', order_receive = '1', order_receive_datetime = '".$shop['time_ymdhis']."' where id = '".$row['id']."' ");

    }

    return true;

}

// 구매확정
function shop_order_ok($order_code, $mode)
{

    global $shop, $dmshop;

    // 특정 주문번호
    if ($order_code) {

        $dmshop_order = shop_order($order_code);

        if (!$dmshop_order['order_code']) {

            return false;

        }

        // 구매 확정하였다
        if ($dmshop_order['order_ok']) {

            return false;

        }

        // 첫 구매 (먼저 처리를 하자)
        if ($dmshop_order['user_id'] && $dmshop['order_first_use'] && $dmshop['order_first_cash']) {

            // 구매완료 체크
            $chk = sql_fetch(" select * from $shop[order_table] where user_id = '".$dmshop_order['user_id']."' and order_ok = '1' ");

            // 없다면
            if (!$chk['order_code']) {

                // 적립금 지급
                shop_cash_insert($dmshop_order['user_id'], (int)($dmshop['order_first_cash'] * 1), "첫구매 감사", $dmshop_order['user_id'], $shop['time_ymd'], "order_first");

            }

        }

        // 해당 주문내역
        $result = sql_query(" select * from $shop[order_table] where order_code = '".$order_code."' ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            // 옵션
            $option_name = "";
            if ($row['option_name']) {

                $option_name = " (".$row['option_name'].")";

            }

            if ($row['item_cash'] && $row['user_id']) {

                // 상품 적립금 지급
                shop_cash_insert($row['user_id'], (int)($row['item_cash'] * $row['order_limit']), $row['item_title'].$option_name, $row['user_id'], $row['id'], "order_item");

            }

        }

        if ($dmshop_order['user_id']) {

            // 쿠폰 자동지급 (첫구매)
            shop_coupon_auto_make("3", $dmshop_order['user_id'], "");

            // 쿠폰 자동지급 (원 이상 구매)
            shop_coupon_auto_make("5", $dmshop_order['user_id'], $order_code);

        }

        // 구매확정
        sql_query(" update $shop[order_table] set order_type = '900', order_ok = '1', order_ok_datetime = '".$shop['time_ymdhis']."' where order_code = '".$order_code."' ");

    } else {
    // 기간이 경과된 주문은 자동 확정

        // 수령시각
        $order_receive_datetime = date("Y-m-d H:i:s", $shop['server_time'] - ($dmshop['order_exchange_day'] * 86400));

        // 수취확인일로부터
        if ($mode == '1') {

            // 수령, 기간경과, 미취소, 미교환, 미환불, 미구매확정
            $sql_search = " where order_receive = '1' and order_receive_datetime <= '".$order_receive_datetime."' and order_cancel = '0' and order_exchange = '0' and order_refund = '0' and order_ok = '0' ";

        } else {
        // 교환승인일로부터

            // 수령, 기간경과, 미취소, 교환완료, 미환불, 미구매확정
            $sql_search = " where order_receive = '1' and order_exchange_ok_datetime <= '".$order_receive_datetime."' and order_cancel = '0' and order_exchange = '2' and order_refund = '0' and order_ok = '0' ";

        }

        // 주문내역 (전체)
        $result = sql_query(" select * from $shop[order_table] $sql_search ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            // 옵션
            $option_name = "";
            if ($row['option_name']) {

                $option_name = " (".$row['option_name'].")";

            }

            if ($row['item_cash'] && $row['user_id']) {

                // 상품 적립금 지급
                shop_cash_insert($row['user_id'], (int)($row['item_cash'] * $row['order_limit']), $row['item_title'].$option_name, $row['user_id'], $row['id'], "order_item");

            }

        }

        // 주문내역 (해당 건만)
        $list = array();
        $result = sql_query(" select * from $shop[order_table] $sql_search group by order_code ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            $list[$i] = $row;

            if ($row['user_id']) {

                // 첫 구매 (먼저 처리를 하자)
                if ($dmshop['order_first_use'] && $dmshop['order_first_cash']) {

                    // 구매완료 체크
                    $chk = sql_fetch(" select * from $shop[order_table] where user_id = '".$row['user_id']."' and order_ok = '1' ");

                    // 없다면
                    if (!$chk['order_code']) {

                        // 적립금 지급
                        shop_cash_insert($row['user_id'], (int)($dmshop['order_first_cash'] * 1), "첫구매 감사", $row['user_id'], $shop['time_ymd'], "order_first");

                    }

                }

                // 쿠폰 자동지급 (첫구매)
                shop_coupon_auto_make("3", $row['user_id'], "");

                // 쿠폰 자동지급 (원 이상 구매)
                shop_coupon_auto_make("5", $row['user_id'], $row['order_code']);

            }

        }

        // 한번에 날릴까 했는데, 절묘한 타이밍이 발생할 수도 있으니.
        for ($i=0; $i<count($list); $i++) {

            // 구매완료
            sql_query(" update $shop[order_table] set order_type = '900', order_receive = '1', order_receive_datetime = '".$shop['time_ymdhis']."', order_ok = '1', order_ok_datetime = '".$shop['time_ymdhis']."' where order_code = '".$list[$i]['order_code']."' ");

        }

    }

    return true;

}

// 주문 삭제 처리 (기간 만료)
function shop_order_delete_day()
{

    global $shop, $dmshop;

    // 1. 무통장입금 대기일
    $order_datetime = date("Y-m-d H:i:s", $shop['server_time'] - ($dmshop['order_bank_day'] * 86400));

    // 무통장, 미결제, 무통장 입금기간이 지난 주문내역
    $result = sql_query(" select * from $shop[order_table] where order_pay_type = '5' and order_payment = '1' and order_datetime <= '".$order_datetime."' group by order_code ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        // 취소완료
        shop_order_cancel("ok", $row['order_code']);

        // 내역삭제
        shop_order_cancel("delete", $row['order_code']);

    }

    // 2. 가상계좌입금 대기일
    $order_datetime = date("Y-m-d H:i:s", $shop['server_time'] - ($dmshop['order_pgbank_day'] * 86400));

    // 가상계좌, 미결제, 가상계좌 입금기간이 지난 주문내역
    $result = sql_query(" select * from $shop[order_table] where order_pay_type = '4' and order_payment = '1' and order_datetime <= '".$order_datetime."' group by order_code ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        // 취소완료
        shop_order_cancel("ok", $row['order_code']);

        // 내역삭제
        shop_order_cancel("delete", $row['order_code']);

    }

}

// 영수증 버튼
function shop_order_receipt_btn($order_code)
{

    global $shop, $dmshop;

    if (!$order_code) {

        return false;

    }

    // 주문정보
    $dmshop_order = shop_order($order_code);

    // 데이터가 없다
    if (!$dmshop_order['id']) {

        return false;

    }

    // 미결제
    if ($dmshop_order['order_payment'] != '2') {

        return false;

    }

    $data = "";

    // KCP
    if ($dmshop_order['order_pg'] == '3') {

        // 신용카드
        if ($dmshop_order['order_pay_type'] == '1') {

            $data = "<a href='#' onclick=\"payReceipt3('".$dmshop_order['order_pay_type']."', '".$dmshop['kcp_site_code']."', '".$dmshop_order['order_pg_code1']."', '".$order_code."', '".$dmshop_order['order_receipt']."', '".$dmshop_order['order_receipt_code']."'); return false;\">btn</a>";

        }

        // 실시간 계좌이체
        else if ($dmshop_order['order_pay_type'] == '2' && $dmshop_order['order_receipt_code']) {

            $data = "<a href='#' onclick=\"payReceipt3('".$dmshop_order['order_pay_type']."', '".$dmshop['kcp_site_code']."', '".$dmshop_order['order_pg_code1']."', '".$order_code."', '".$dmshop_order['order_receipt']."', '".$dmshop_order['order_receipt_code']."'); return false;\">btn</a>";

        }

        // 가상계좌
        else if ($dmshop_order['order_pay_type'] == '4' && $dmshop_order['order_receipt_code']) {

            $data = "<a href='#' onclick=\"payReceipt3('".$dmshop_order['order_pay_type']."', '".$dmshop['kcp_site_code']."', '".$dmshop_order['order_pg_code1']."', '".$order_code."', '".$dmshop_order['order_receipt']."', '".$dmshop_order['order_receipt_code']."'); return false;\">btn</a>";

        }

        // 무통장
        else if ($dmshop_order['order_pay_type'] == '5' && $dmshop_order['order_receipt_code']) {

            $data = "<a href='#' onclick=\"payReceipt3('".$dmshop_order['order_pay_type']."', '".$dmshop['kcp_site_code']."', '".$dmshop_order['order_pg_code1']."', '".$order_code."', '".$dmshop_order['order_receipt']."', '".$dmshop_order['order_receipt_code']."'); return false;\">btn</a>";

        } else {

            $data = "";

        }

    } else {

        return false;

    }

    return $data;

}

/*--------------------------------
    ## 상품평 ##
--------------------------------*/

// reply
function shop_reply($reply_id)
{

    global $shop;

    if ($reply_id) { $reply_id = preg_match("/^[0-9]+$/", $reply_id) ? $reply_id : ""; }

    if (!$reply_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[reply_table] where id = '$reply_id' ");

}

// reply 답변
function shop_reply_reply($reply_id)
{

    global $shop;

    if ($reply_id) { $reply_id = preg_match("/^[0-9]+$/", $reply_id) ? $reply_id : ""; }

    if (!$reply_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[reply_table] where reply_id = '$reply_id' and id != reply_id ");

}

// reply 만족도
function shop_reply_score($reply_score)
{

    if ($reply_score == '1') {

        $data = "매우불만족";

    }

    else if ($reply_score == '2') {

        $data = "불만족";

    }

    else if ($reply_score == '3') {

        $data = "보통";

    }

    else if ($reply_score == '4') {

        $data = "만족";

    }

    else if ($reply_score == '5') {

        $data = "매우만족";

    } else {

        $data = "기타";

    }

    return $data;

}

// reply 평균 만족도
function shop_reply_score_total($item_id)
{

    global $shop;

    if ($item_id) { $item_id = preg_match("/^[a-zA-Z0-9]+$/", $item_id) ? $item_id : ""; }

    if (!$item_id) {

        return false;

    }

    $reply = sql_fetch(" select count(*) as total_count, sum(reply_score) as total_score from $shop[reply_table] where item_id = '".$item_id."' and id = reply_id ");

    if ($reply['total_score']) {

        $data = (int)($reply['total_score'] / $reply['total_count']);

        return $data;

    } else {

        return false;

    }

}

// reply 파일
function shop_reply_file($upload_mode)
{

    global $shop;

    return sql_fetch(" select * from $shop[reply_file_table] where upload_mode = '".addslashes($upload_mode)."' ");

}

// reply 뷰
function shop_reply_view($datetime, $file, $width, $height, $image_width, $thumb)
{

    global $shop;
    static $ids;

    if (!$file) {

        return false;

    }

    $ids++;

    $source_width = (int)($width);
    $source_height = (int)($height);

    if ($image_width) {

        if ($width >= $image_width) {

            $style = "width:".$image_width."px;";

        }

    } else {

        $style = "";

    }

    // 원본
    $source = $shop['path']."/data/reply/".shop_data_path("u", $datetime)."/".$file;

    if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && $thumb) {

        return "<img src='{$thumb}' onclick=\"shopImageView('$source', '$source_width', '$source_height');\" style='".$style." cursor:pointer;'>";

    }

    else if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file)) {

        return "<img src='{$source}' onclick=\"shopImageView('$source', '$source_width', '$source_height');\" style='".$style." cursor:pointer;'>";

    } else {

        return false;

    }

}

/*--------------------------------
    ## 상품문의 ##
--------------------------------*/

// qna
function shop_qna($qna_id)
{

    global $shop;

    if ($qna_id) { $qna_id = preg_match("/^[0-9]+$/", $qna_id) ? $qna_id : ""; }

    if (!$qna_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[qna_table] where id = '$qna_id' ");

}

// qna 답변
function shop_qna_reply($qna_id)
{

    global $shop;

    if ($qna_id) { $qna_id = preg_match("/^[0-9]+$/", $qna_id) ? $qna_id : ""; }

    if (!$qna_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[qna_table] where qna_id = '$qna_id' and id != qna_id ");

}

// qna 파일
function shop_qna_file($upload_mode)
{

    global $shop;

    return sql_fetch(" select * from $shop[qna_file_table] where upload_mode = '".addslashes($upload_mode)."' ");

}

// qna 뷰
function shop_qna_view($datetime, $file, $width, $height, $image_width, $thumb)
{

    global $shop;
    static $ids;

    if (!$file) {

        return false;

    }

    $ids++;

    $source_width = (int)($width);
    $source_height = (int)($height);

    if ($image_width) {

        if ($width >= $image_width) {

            $style = "width:".$image_width."px;";

        }

    } else {

        $style = "";

    }

    // 원본
    $source = $shop['path']."/data/qna/".shop_data_path("u", $datetime)."/".$file;

    if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && $thumb) {

        return "<img src='{$thumb}' onclick=\"shopImageView('$source', '$source_width', '$source_height');\" style='".$style." cursor:pointer;'>";

    }

    else if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file)) {

        return "<img src='{$source}' onclick=\"shopImageView('$source', '$source_width', '$source_height');\" style='".$style." cursor:pointer;'>";

    } else {

        return false;

    }

}

/*--------------------------------
    ## 1:1문의 ##
--------------------------------*/

// help
function shop_help($help_id)
{

    global $shop;

    if ($help_id) { $help_id = preg_match("/^[0-9]+$/", $help_id) ? $help_id : ""; }

    if (!$help_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[help_table] where id = '$help_id' ");

}

// help 답변
function shop_help_reply($help_id)
{

    global $shop;

    if ($help_id) { $help_id = preg_match("/^[0-9]+$/", $help_id) ? $help_id : ""; }

    if (!$help_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[help_table] where help_id = '$help_id' and id != help_id ");

}

// help 최근 데이터
function shop_help_new($help_code, $help_category)
{

    global $shop;

    // 최근 것을 기준으로 뽑는다. (거절의 경우 재신청 되어있을 경우)
    return sql_fetch(" select * from $shop[help_table] where help_code = '$help_code' and help_category = '$help_category' order by id desc ");

}

// help 파일
function shop_help_file($upload_mode)
{

    global $shop;

    return sql_fetch(" select * from $shop[help_file_table] where upload_mode = '".addslashes($upload_mode)."' ");

}

// help 카테고리명
function shop_help_category($help_category)
{

    if ($help_category == '200') {

        $data = "상품배송";

    }

    else if ($help_category == '300') {

        $data = "주문취소";

    }

    else if ($help_category == '400') {

        $data = "교환";

    }

    else if ($help_category == '500') {

        $data = "환불";

    }

    else if ($help_category == '1') {

        $data = "A/S 관련";

    }

    else if ($help_category == '2') {

        $data = "영수증/계산서";

    }

    else if ($help_category == '3') {

        $data = "이벤트/행사";

    }

    else if ($help_category == '4') {

        $data = "쇼핑몰 이용";

    } else {

        $data = "기타";

    }

    return $data;

}

// help 뷰
function shop_help_view($datetime, $file, $width, $height, $image_width, $thumb)
{

    global $shop;
    static $ids;

    if (!$file) {

        return false;

    }

    $ids++;

    $source_width = (int)($width);
    $source_height = (int)($height);

    if ($image_width) {

        if ($width >= $image_width) {

            $style = "width:".$image_width."px;";

        }

    } else {

        $style = "";

    }

    // 원본
    $source = $shop['path']."/data/help/".shop_data_path("u", $datetime)."/".$file;

    if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && $thumb) {

        return "<img src='{$thumb}' onclick=\"shopImageView('$source', '$source_width', '$source_height');\" style='".$style." cursor:pointer;'>";

    }

    else if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file)) {

        return "<img src='{$source}' onclick=\"shopImageView('$source', '$source_width', '$source_height');\" style='".$style." cursor:pointer;'>";

    } else {

        return false;

    }

}
?>