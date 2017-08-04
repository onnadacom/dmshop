<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// br 태그제거
if ($_POST['item_text'] == '<br>' || $_POST['item_text'] == '<br />') {

    $_POST['item_text'] = "";

}

if ($_POST['item_delivery_text'] == '<br>' || $_POST['item_delivery_text'] == '<br />') {

    $_POST['item_delivery_text'] = "";

}

if ($_POST['item_refund_text'] == '<br>' || $_POST['item_refund_text'] == '<br />') {

    $_POST['item_refund_text'] = "";

}

// insert
if ($m == '') {

    // 자동
    if ($_POST['item_code_use'] == '1') {

        $item_code = $_POST['item_code1'];

    } else {

        $item_code = $_POST['item_code2'];

    }

    // 상품
    $dmshop_item = shop_item_code(addslashes($item_code));

    if ($dmshop_item['id']) {

        alert("이미 중복된 상품코드가 있습니다.\\n\\n다시 시도하여 주시기 바랍니다.");

    }

    $sql_common = "";
    $sql_common .= " set item_title = '".addslashes($_POST['item_title'])."' ";
    $sql_common .= ", item_keyword = '".addslashes($_POST['item_keyword'])."' ";
    $sql_common .= ", item_code = '".addslashes($item_code)."' ";
    $sql_common .= ", category1 = '".addslashes($_POST['category1'])."' ";
    $sql_common .= ", category2 = '".addslashes($_POST['category2'])."' ";
    $sql_common .= ", category3 = '".addslashes($_POST['category3'])."' ";
    $sql_common .= ", category4 = '".addslashes($_POST['category4'])."' ";
    $sql_common .= ", item_position = '".addslashes($_POST['item_position'])."' ";
    $sql_common .= ", item_price_use = '".addslashes($_POST['item_price_use'])."' ";
    $sql_common .= ", item_price = '".str_replace(",", "", addslashes($_POST['item_price']))."' ";
    $sql_common .= ", item_money = '".str_replace(",", "", addslashes($_POST['item_money']))."' ";
    $sql_common .= ", item_cash = '".str_replace(",", "", addslashes($_POST['item_cash']))."' ";
    $sql_common .= ", item_delivery = '".str_replace(",", "", addslashes($_POST['item_delivery']))."' ";
    $sql_common .= ", item_delivery_bunch = '".addslashes($_POST['item_delivery_bunch'])."' ";
    $sql_common .= ", item_option_use = '".addslashes($_POST['item_option_use'])."' ";
    $sql_common .= ", item_limit = '".str_replace(",", "", addslashes($_POST['item_limit']))."' ";
    $sql_common .= ", item_use = '".addslashes($_POST['item_use'])."' ";
    $sql_common .= ", item_option1 = '".addslashes($_POST['item_option1'])."' ";
    $sql_common .= ", item_option2 = '".addslashes($_POST['item_option2'])."' ";
    $sql_common .= ", item_option3 = '".addslashes($_POST['item_option3'])."' ";
    $sql_common .= ", item_option4 = '".addslashes($_POST['item_option4'])."' ";
    $sql_common .= ", item_option5 = '".addslashes($_POST['item_option5'])."' ";
    $sql_common .= ", item_option6 = '".addslashes($_POST['item_option6'])."' ";
    $sql_common .= ", item_option7 = '".addslashes($_POST['item_option7'])."' ";
    $sql_common .= ", item_option8 = '".addslashes($_POST['item_option8'])."' ";
    $sql_common .= ", item_option9 = '".addslashes($_POST['item_option9'])."' ";
    $sql_common .= ", item_option10 = '".addslashes($_POST['item_option10'])."' ";
    $sql_common .= ", item_option1_text = '".addslashes($_POST['item_option1_text'])."' ";
    $sql_common .= ", item_option2_text = '".addslashes($_POST['item_option2_text'])."' ";
    $sql_common .= ", item_option3_text = '".addslashes($_POST['item_option3_text'])."' ";
    $sql_common .= ", item_option4_text = '".addslashes($_POST['item_option4_text'])."' ";
    $sql_common .= ", item_option5_text = '".addslashes($_POST['item_option5_text'])."' ";
    $sql_common .= ", item_option6_text = '".addslashes($_POST['item_option6_text'])."' ";
    $sql_common .= ", item_option7_text = '".addslashes($_POST['item_option7_text'])."' ";
    $sql_common .= ", item_option8_text = '".addslashes($_POST['item_option8_text'])."' ";
    $sql_common .= ", item_option9_text = '".addslashes($_POST['item_option9_text'])."' ";
    $sql_common .= ", item_option10_text = '".addslashes($_POST['item_option10_text'])."' ";
    $sql_common .= ", item_text = '".addslashes($_POST['item_text'])."' ";
    $sql_common .= ", item_delivery_text = '".addslashes($_POST['item_delivery_text'])."' ";
    $sql_common .= ", item_refund_text = '".addslashes($_POST['item_refund_text'])."' ";
    $sql_common .= ", item_gallery_use = '".addslashes($_POST['item_gallery_use'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 등록
    sql_query(" insert into $shop[item_table] $sql_common ");

    $item_id = "";
    $item_id = mysql_insert_id();

    /*--------------------------------
        ## 주문옵션 ##
    --------------------------------*/

    if ($_POST['list_count'] && $_POST['item_option_use']) {

        // 돌려요
        for ($i=0; $i<=$_POST['list_count']; $i++) {

            $sql_common = "";

            // 레이어 공개한 것만
            if ($_POST["list".$i."_mode"]) {

                $sql_common = "";
                $sql_common .= " set item_id = '".addslashes($item_id)."' ";
                $sql_common .= ", option_mode = '".addslashes($_POST["list".$i."_mode"])."' ";
                $sql_common .= ", option_name = '".addslashes($_POST["list".$i."_name"])."' ";
                $sql_common .= ", option_money = '".str_replace(",", "", addslashes($_POST["list".$i."_money"]))."' ";
                $sql_common .= ", option_limit = '".str_replace(",", "", addslashes($_POST["list".$i."_limit"]))."' ";
                $sql_common .= ", option_position = '".addslashes($_POST["list".$i."_position"])."' ";

                // 등록
                sql_query(" insert into $shop[item_option_table] $sql_common ");

            }

        } // end for

    } // end if

}

// update
else if ($m == 'u') {

    $sql_common = "";
    $sql_common .= " set item_title = '".addslashes($_POST['item_title'])."' ";
    $sql_common .= ", item_keyword = '".addslashes($_POST['item_keyword'])."' ";
    $sql_common .= ", item_code = '".addslashes($_POST['item_code'])."' ";
    $sql_common .= ", category1 = '".addslashes($_POST['category1'])."' ";
    $sql_common .= ", category2 = '".addslashes($_POST['category2'])."' ";
    $sql_common .= ", category3 = '".addslashes($_POST['category3'])."' ";
    $sql_common .= ", category4 = '".addslashes($_POST['category4'])."' ";
    $sql_common .= ", item_position = '".addslashes($_POST['item_position'])."' ";
    $sql_common .= ", item_price_use = '".addslashes($_POST['item_price_use'])."' ";
    $sql_common .= ", item_price = '".str_replace(",", "", addslashes($_POST['item_price']))."' ";
    $sql_common .= ", item_money = '".str_replace(",", "", addslashes($_POST['item_money']))."' ";
    $sql_common .= ", item_cash = '".str_replace(",", "", addslashes($_POST['item_cash']))."' ";
    $sql_common .= ", item_delivery = '".str_replace(",", "", addslashes($_POST['item_delivery']))."' ";
    $sql_common .= ", item_delivery_bunch = '".addslashes($_POST['item_delivery_bunch'])."' ";
    $sql_common .= ", item_option_use = '".addslashes($_POST['item_option_use'])."' ";
    $sql_common .= ", item_limit = '".str_replace(",", "", addslashes($_POST['item_limit']))."' ";
    $sql_common .= ", item_use = '".addslashes($_POST['item_use'])."' ";
    $sql_common .= ", item_option1 = '".addslashes($_POST['item_option1'])."' ";
    $sql_common .= ", item_option2 = '".addslashes($_POST['item_option2'])."' ";
    $sql_common .= ", item_option3 = '".addslashes($_POST['item_option3'])."' ";
    $sql_common .= ", item_option4 = '".addslashes($_POST['item_option4'])."' ";
    $sql_common .= ", item_option5 = '".addslashes($_POST['item_option5'])."' ";
    $sql_common .= ", item_option6 = '".addslashes($_POST['item_option6'])."' ";
    $sql_common .= ", item_option7 = '".addslashes($_POST['item_option7'])."' ";
    $sql_common .= ", item_option8 = '".addslashes($_POST['item_option8'])."' ";
    $sql_common .= ", item_option9 = '".addslashes($_POST['item_option9'])."' ";
    $sql_common .= ", item_option10 = '".addslashes($_POST['item_option10'])."' ";
    $sql_common .= ", item_option1_text = '".addslashes($_POST['item_option1_text'])."' ";
    $sql_common .= ", item_option2_text = '".addslashes($_POST['item_option2_text'])."' ";
    $sql_common .= ", item_option3_text = '".addslashes($_POST['item_option3_text'])."' ";
    $sql_common .= ", item_option4_text = '".addslashes($_POST['item_option4_text'])."' ";
    $sql_common .= ", item_option5_text = '".addslashes($_POST['item_option5_text'])."' ";
    $sql_common .= ", item_option6_text = '".addslashes($_POST['item_option6_text'])."' ";
    $sql_common .= ", item_option7_text = '".addslashes($_POST['item_option7_text'])."' ";
    $sql_common .= ", item_option8_text = '".addslashes($_POST['item_option8_text'])."' ";
    $sql_common .= ", item_option9_text = '".addslashes($_POST['item_option9_text'])."' ";
    $sql_common .= ", item_option10_text = '".addslashes($_POST['item_option10_text'])."' ";
    $sql_common .= ", item_text = '".addslashes($_POST['item_text'])."' ";
    $sql_common .= ", item_delivery_text = '".addslashes($_POST['item_delivery_text'])."' ";
    $sql_common .= ", item_refund_text = '".addslashes($_POST['item_refund_text'])."' ";
    $sql_common .= ", item_gallery_use = '".addslashes($_POST['item_gallery_use'])."' ";

    // 수정
    sql_query(" update $shop[item_table] $sql_common where id = '".addslashes($_POST['item_id'])."' ");

    /*--------------------------------
        ## 주문옵션 ##
    --------------------------------*/

    if ($_POST['list_count'] && $_POST['item_option_use']) {

        // 돌려요
        for ($i=0; $i<=$_POST['list_count']; $i++) {

            // 아이디
            $list_id = addslashes($_POST["list".$i."_id"]);

            // 상품 옵션
            $dmshop_item_option = shop_item_option($list_id);

            $sql_common = "";

            // 레이어 공개한 것만
            if ($_POST["list".$i."_mode"]) {

                $sql_common = "";
                $sql_common .= " set item_id = '".addslashes($_POST['item_id'])."' ";
                $sql_common .= ", option_mode = '".addslashes($_POST["list".$i."_mode"])."' ";
                $sql_common .= ", option_name = '".addslashes($_POST["list".$i."_name"])."' ";
                $sql_common .= ", option_money = '".str_replace(",", "", addslashes($_POST["list".$i."_money"]))."' ";
                $sql_common .= ", option_limit = '".str_replace(",", "", addslashes($_POST["list".$i."_limit"]))."' ";
                $sql_common .= ", option_position = '".addslashes($_POST["list".$i."_position"])."' ";

                // 있다면
                if ($dmshop_item_option['id']) {

                    // 업데이트
                    sql_query(" update $shop[item_option_table] $sql_common where id = '".$list_id."' ");

                } else {
                // 없다면

                    // 기록
                    sql_query(" insert into $shop[item_option_table] $sql_common ");

                }

            } else {
            // 감춘 것은 삭제

                sql_query(" delete from $shop[item_option_table] where id = '".$list_id."' ");

            }

        } // end for

    } // end if

}

// delete
else if ($m == 'd') {

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[item_file_table] where item_id = '".addslashes($_POST['item_id'])."' ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/item/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[item_file_table] where item_id = '".addslashes($_POST['item_id'])."' ");

    // 기획전 상품 삭제
    sql_query(" delete from $shop[plan_item_table] where item_id = '".addslashes($_POST['item_id'])."' ");

    // 옵션 삭제
    sql_query(" delete from $shop[item_option_table] where item_id = '".addslashes($_POST['item_id'])."' ");

    // 관련상품 삭제
    sql_query(" delete from $shop[relation_table] where item_id = '".addslashes($_POST['item_id'])."' ");

    // 관련상품 삭제
    sql_query(" delete from $shop[relation_table] where item_add_id = '".addslashes($_POST['item_id'])."' ");

    // 최근 본 상품 삭제
    sql_query(" delete from $shop[item_view_table] where item_id = '".addslashes($_POST['item_id'])."' ");

    // 장바구니 삭제
    sql_query(" delete from $shop[cart_table] where item_id = '".addslashes($_POST['item_id'])."' ");

    // 관심상품 삭제
    sql_query(" delete from $shop[favorite_table] where item_id = '".addslashes($_POST['item_id'])."' ");

    // 적용중인 쿠폰 미사용으로 변경
    sql_query(" update $shop[coupon_list_table] set coupon_mode  = '0', cart_id = '0' where item_id = '".addslashes($_POST['item_id'])."' and coupon_mode = '1' ");

    // 메인중앙 등록상품 삭제
    sql_query(" delete from $shop[display_item_table] where item_id = '".addslashes($_POST['item_id'])."' ");

    // 상품 삭제
    sql_query(" delete from $shop[item_table] where id = '".addslashes($_POST['item_id'])."' ");

} else {

    alert("분류가 삭제되었거나 존재하지 않습니다.");

}

// insert, update
if ($m == '' || $m == 'u') {

    /*--------------------------------
        ## 상품 아이콘 ##
    --------------------------------*/

    $tmp_icon_id_add = "";

    // 아이콘 리스트
    $result = sql_query(" select * from $shop[icon_file_table] order by position desc, id asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $tmp_icon_id = $row['id'];

        // 등록
        if ($_POST['icon_insert'][$tmp_icon_id]) {

            $tmp_icon_id_add .= "|".$tmp_icon_id;

        }

    }

    if ($tmp_icon_id_add) {

        $tmp_icon_id_add = $tmp_icon_id_add."|";

        // 수정
        sql_query(" update $shop[item_table] set item_icon = '".$tmp_icon_id_add."' where id = '".addslashes($item_id)."' ");

    } else {

        // 수정
        sql_query(" update $shop[item_table] set item_icon = '' where id = '".addslashes($item_id)."' ");

    }

    /*--------------------------------
        ## 기본 파일 ##
    --------------------------------*/

    // 파일 업로드 경로
    $dir = $shop['path']."/data/item/".shop_data_path("", "");
    
    // 디렉토리 생성 및 퍼미션 변경
    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // 대표이미지
    $upload_mode = "default";
    include("./upload_item_file.php");

    // 상품 파일 데이터
    $source = shop_item_file($item_id, "default");

    $filedefault = false;
    if ($source['upload_file']) {

        // 파일 경로
        $source_path = $shop['path']."/data/item/".shop_data_path("u", $source['datetime'])."/".$source['upload_file'];

        // 파일이 있다면
        if (file_exists($source_path) && $source['upload_file']) {

            $filedefault = true;

            if ($source_path) {

                include_once("$shop[path]/lib/colorcompare.lib.php");

                $result = ColorCompare::compare(10, $source_path);
                if ($result) {

                    $sql_common = "";

                    $i = 0;
                    $total_count = 0;
                    $list = array();
                    foreach ($result as $name => $count) {

                        $list[$i]['color'] = ColorCompare::$swatches[$name];
                        $list[$i]['name'] = $name;
                        $list[$i]['count'] = $count;

                        $total_count += $count;
                        $i++;

                    }

                    for ($i=0; $i<count($list); $i++) {

                        $ratio = (int)(($list[$i]['count'] * 100) / $total_count);

                        if ($i == '0') {

                            $sql_common .= " ".color_column($list[$i]['name'])." = '".$ratio."' ";

                        } else {

                            $sql_common .= ", ".color_column($list[$i]['name'])." = '".$ratio."' ";

                        }

                    }

                    if ($sql_common) {

                        sql_query(" update $shop[item_table] set $sql_common where id = '".addslashes($item_id)."' ");

                    }

                }

            }

        }

    }

    // 대표이미지로부터 생성
    if ($_POST['item_filedefault_use'] == '0') {

        // 파일이 있다면
        if ($filedefault) {

            // 기본상품목록
            $upload_mode = "category";
            include("./upload_item_file_copy.php");

        }

    } else {
    // 직접 생성

        // 기본상품목록
        $upload_mode = "category";
        include("./upload_item_file.php");

    }

    /*--------------------------------
        ## 갤러리 ##
    --------------------------------*/

    for ($i=1; $i<=$_POST['gallery_file_count']; $i++) {

        // 갤러리
        $upload_mode = "gallery".$i;
        include("./upload_item_file.php");

    }

    /*--------------------------------
        ## 기획전 상품 ##
    --------------------------------*/

    // 상품
    $dmshop_item = shop_item(addslashes($item_id));

    // 기획전 리스트
    $result = sql_query(" select * from $shop[plan_table] order by position desc, datetime desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $tmp_plan_id = $row['id'];

        // 등록
        if ($_POST['plan_insert'][$tmp_plan_id]) {

            // 기획전 상품
            $dmshop_plan_item = shop_plan_item($tmp_plan_id, addslashes($item_id));

            if ($dmshop_plan_item['id']) {

                $sql_common = "";
                $sql_common .= " set item_title = '".addslashes($dmshop_item['item_title'])."' ";
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

                sql_query(" update $shop[plan_item_table] $sql_common where id = '".$dmshop_plan_item['id']."' ");

            } else {

                $sql_common = "";
                $sql_common .= " set plan_id = '".$tmp_plan_id."' ";
                $sql_common .= ", item_id = '".addslashes($item_id)."' ";
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

                sql_query(" insert into $shop[plan_item_table] $sql_common ");

            }

        } else {
        // 삭제

            // 기획전 상품 삭제
            sql_query(" delete from $shop[plan_item_table] where plan_id = '".$tmp_plan_id."' and item_id = '".addslashes($item_id)."' ");

        }

        // 대표이미지로부터 생성
        if ($_POST['item_fileplan_use'] == '0') {

            // 파일이 있다면
            if ($filedefault) {

                // 기본상품목록
                $upload_mode = "plan".$row['id'];
                include("./upload_item_file_copy.php");

            }

        } else {
        // 직접 생성

            // 기본상품목록
            $upload_mode = "plan".$row['id'];
            include("./upload_item_file.php");

        }

    }

}

// 신규 등록
if ($m == '') {

    shop_url("./item_list.php");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>