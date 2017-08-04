<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 완전 초기화
if ($m == 'truncate') {

    $result = sql_query(" select * from $shop[category_table] ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        // 첨부파일 삭제
        $result2 = sql_query(" select datetime, upload_file from $shop[design_file_table] where upload_mode in ('category_top_".$row['id']."','category_bottom_".$row['id']."','wmlist_image_category_1_".$row['id']."','wmlist_image_category_2_".$row['id']."','hmlist_image_category_1_".$row['id']."','hmlist_image_category_2_".$row['id']."') ");
        for ($k=0; $file=sql_fetch_array($result2); $k++) {

            // 원본
            $file_path = $shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 파일 삭제
        sql_query(" delete from $shop[design_file_table] where upload_mode in ('category_top_".$row['id']."','category_bottom_".$row['id']."','wmlist_image_category_1_".$row['id']."','wmlist_image_category_2_".$row['id']."','hmlist_image_category_1_".$row['id']."','hmlist_image_category_2_".$row['id']."') ");

    }

    // 분류 삭제
    sql_query(" delete from $shop[category_table] ");

    // 가로메뉴 삭제
    sql_query(" delete from $shop[design_wmlist_table] where menu_type = 'category' ");

    // 세로메뉴 삭제
    sql_query(" delete from $shop[design_hmlist_table] where menu_type = 'category' ");

    // 상품 분류 초기화
    sql_query(" update $shop[item_table] set category1 = '0', category2 = '0', category3 = '0', category4 = '0' ");

    // 기획전 분류 초기화
    sql_query(" update $shop[plan_item_table] set category1 = '0', category2 = '0', category3 = '0', category4 = '0' ");

    // 메인중앙 분류 초기화
    sql_query(" update $shop[display_box_list_table] set category = '0' ");

} else {

// 초기화
$tmp_id_list = "";

// num 값이 있다면.
if ($_POST['tmp_code']) {

    // 이미지 설정
    $dmshop_image = shop_design_image();

    // 분류
    if ($dmshop_image['image_category_use'] == '0') { $dmshop_image['thumb_width'] = shop_split("|", $dmshop_image['image_category'], "0"); $dmshop_image['thumb_height'] = shop_split("|", $dmshop_image['image_category'], "1"); } else { $dmshop_image['thumb_width'] = $dmshop_image['image_category_width']; $dmshop_image['thumb_height'] = $dmshop_image['image_category_height']; }

    // 돌려요
    for ($i=0; $i<=$tmp_code; $i++) {

/*--------------------------------
    ## CODE ##
--------------------------------*/

        // code
        $input_code = "code".$i;

        // post code
        $input_code_value = $_POST[$input_code];

        if ($input_code_value) {

            // 초기화
            $tmp_id_list = "";

            // 쪼갠다.
            $value = explode("|%|", trim($input_code_value));
            for ($k=0; $k<count($value); $k++) {

                if ($value[$k]) {

                    // 다시 쪼갠다.
                    $tmp_value = explode(":%:", trim($value[$k]));
                    for ($j=0; $j<count($tmp_value); $j++) {

                        // 첫번째 것만
                        if ($tmp_value[$j] && $j == '0') {

                            // 추가
                            if ($tmp_value[0] == 'insert') {

                                sql_query(" insert into $shop[category_table] set id = '".addslashes($tmp_value[1])."', category = '".addslashes($tmp_value[3])."', code = '".addslashes($tmp_value[4])."', subject = '".addslashes($tmp_value[2])."', position = '".$k."', view = '1', skin = 'default', item_width = '4', item_height = '5', thumb_width = '".$dmshop_image['thumb_width']."', thumb_height = '".$dmshop_image['thumb_height']."' ");

                                // 가로메뉴 업데이트
                                sql_query(" update $shop[design_wmlist_table] set title = '".addslashes($tmp_value[2])."', position = '".$k."' where menu_type = 'category' and menu_id = '".addslashes($tmp_value[1])."' ");

                            }

                            // 업데이트
                            else if ($tmp_value[0] == 'update') {

                                sql_query(" update $shop[category_table] set subject = '".addslashes($tmp_value[2])."', position = '".$k."' where id = '".addslashes($tmp_value[1])."' ");

                                // 가로메뉴 업데이트
                                sql_query(" update $shop[design_wmlist_table] set title = '".addslashes($tmp_value[2])."', position = '".$k."' where menu_type = 'category' and menu_id = '".addslashes($tmp_value[1])."' ");

                            } else {

                                // pass

                            }

                            // 삭제 제외할 아이디 값을 담는다.
                            $tmp_id_list .= ",".$tmp_value[1];

                        } // end if

                    } // end for

                } // end if

            } // end for

            // 동일 코드내 담은 아이디를 제외하고 나머지를 삭제한다.
            sql_query(" delete from $shop[category_table] where code = '".addslashes($tmp_value[4])."' and id not in (".substr($tmp_id_list,1).") ");

        } else {

            sql_query(" delete from $shop[category_table] where code = '".$i."' ");

        }

/*--------------------------------
    ## LOG ##
--------------------------------*/

        // log
        $input_log = "log".$i;
        $input_log_value = $_POST[$input_log];

        if ($input_log_value) {

            sql_query(" update $shop[category_table] set log = '".addslashes($input_log_value)."' where id = '".$i."' ");

        } else {

            // pass

        }

    } // end for

}

// 찌꺼기는 삭제해준다.
$result = sql_query(" select * from $shop[category_table] where code != '0' order by code asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_category = shop_category($row['code']);

    // 상위 분류가 없다면
    if (!$dmshop_category['id']) {

        // 삭제함
        sql_query(" delete from $shop[category_table] where id = '".$row['id']."' ");

    }

}

// display_box_list
$result = sql_query(" select * from $shop[display_box_list_table] where category != '0' ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $dmshop_category = shop_category($row['category']);

    // 분류가 없다면
    if (!$dmshop_category['id']) {

        // 메인중앙 분류 초기화
        sql_query(" update $shop[display_box_list_table] set category = '0' where category = '".$row['category']."' ");

    }

}

}

shop_url("./category_config.php");
?>