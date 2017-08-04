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

    if ($coupon_type == '1' && $coupon_max <= '0') {

        alert("인쇄용 쿠폰은 발행매수를 1매 이상 입력하셔야 합니다.");

    }

    $sql_common = "";
    $sql_common .= " set coupon_type = '".addslashes($_POST['coupon_type'])."' ";
    $sql_common .= ", coupon_title = '".addslashes($_POST['coupon_title'])."' ";
    $sql_common .= ", coupon_max = '".addslashes($_POST['coupon_max'])."' ";
    $sql_common .= ", coupon_discount_type = '".addslashes($_POST['coupon_discount_type'])."' ";
    $sql_common .= ", coupon_discount = '".addslashes($_POST['coupon_discount'])."' ";
    $sql_common .= ", coupon_discount_max = '".addslashes($_POST['coupon_discount_max'])."' ";
    $sql_common .= ", coupon_discount_min = '".addslashes($_POST['coupon_discount_min'])."' ";
    $sql_common .= ", coupon_day_type = '".addslashes($_POST['coupon_day_type'])."' ";
    $sql_common .= ", coupon_date1 = '".addslashes($_POST['coupon_date1'])."' ";
    $sql_common .= ", coupon_date2 = '".addslashes($_POST['coupon_date2'])."' ";
    $sql_common .= ", coupon_day = '".addslashes($_POST['coupon_day'])."' ";
    $sql_common .= ", coupon_category_type = '".addslashes($_POST['coupon_category_type'])."' ";
    $sql_common .= ", coupon_category = '".addslashes($_POST['coupon_category'])."' ";
    $sql_common .= ", coupon_plan = '".addslashes($_POST['coupon_plan'])."' ";
    $sql_common .= ", coupon_bank = '".addslashes($_POST['coupon_bank'])."' ";
    $sql_common .= ", coupon_cash = '".addslashes($_POST['coupon_cash'])."' ";
    $sql_common .= ", coupon_overlap = '".addslashes($_POST['coupon_overlap'])."' ";
    $sql_common .= ", coupon_image = '".addslashes($_POST['coupon_image'])."' ";
    $sql_common .= ", coupon_image_type = '".addslashes($_POST['coupon_image_type'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 등록
    sql_query(" insert into $shop[coupon_table] $sql_common ");

    $coupon_id = mysql_insert_id();

/*--------------------------------
    ## 인쇄용 쿠폰생성 start ##
--------------------------------*/

    if ($coupon_type == '1') {

        // 쿠폰옵션정보
        $coupon_option= "";

        // 최소 또는 최대 금액이 있다
        if ($_POST['coupon_discount_min'] || $_POST['coupon_discount_type'] == '1' && $_POST['coupon_discount_max']) {

            // 최소금액
            if ($_POST['coupon_discount_min']) {

                $coupon_option = number_format($_POST['coupon_discount_min'])."원 이상 구매시";

            }

            // 퍼센트비율, 최대금액
            if ($_POST['coupon_discount_type'] == '1' && $_POST['coupon_discount_max']) {

                $coupon_option = " 최대 ".number_format($_POST['coupon_discount_max'])."원 할인";

            }

        } else {

            $coupon_option = " 자유이용 쿠폰";

        }

        // set
        $sql_common = "";
        $sql_common .= " set user_id = '' ";
        $sql_common .= ", user_name = '' ";
        $sql_common .= ", coupon_id = '".addslashes($coupon_id)."' ";
        $sql_common .= ", coupon_type = '".addslashes($_POST['coupon_type'])."' ";
        $sql_common .= ", coupon_title = '".addslashes($_POST['coupon_title'])."' ";
        $sql_common .= ", coupon_discount_type = '".addslashes($_POST['coupon_discount_type'])."' ";
        $sql_common .= ", coupon_discount = '".addslashes($_POST['coupon_discount'])."' ";
        $sql_common .= ", coupon_discount_max = '".addslashes($_POST['coupon_discount_max'])."' ";
        $sql_common .= ", coupon_discount_min = '".addslashes($_POST['coupon_discount_min'])."' ";
        $sql_common .= ", coupon_category_type = '".addslashes($_POST['coupon_category_type'])."' ";
        $sql_common .= ", coupon_category = '".addslashes($_POST['coupon_category'])."' ";
        $sql_common .= ", coupon_plan = '".addslashes($_POST['coupon_plan'])."' ";
        $sql_common .= ", coupon_bank = '".addslashes($_POST['coupon_bank'])."' ";
        $sql_common .= ", coupon_cash = '".addslashes($_POST['coupon_cash'])."' ";
        $sql_common .= ", coupon_overlap = '".addslashes($_POST['coupon_overlap'])."' ";
        $sql_common .= ", coupon_use = '".addslashes($_POST['coupon_use'])."' ";

        // 발급일 기간
        if ($_POST['coupon_day_type']) {

            $sql_common .= ", coupon_date1 = '' ";
            $sql_common .= ", coupon_date2 = '' ";

        } else {

            $sql_common .= ", coupon_date1 = '".addslashes($_POST['coupon_date1'])."' ";
            $sql_common .= ", coupon_date2 = '".addslashes($_POST['coupon_date2'])."' ";

        }

        for ($i=1; $i<=$coupon_max; $i++) {

            if ($_POST['coupon_number_type']) {

                if (!$coupon_number) {

                    $tmp = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","0","1","2","3","4","5","6","7","8","9");
                    $coupon_number = $tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)]."-".$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)]."-".$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)]."-".$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)];

                }

            } else {

                $tmp = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","0","1","2","3","4","5","6","7","8","9");
                $coupon_number = $tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)]."-".$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)]."-".$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)]."-".$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)].$tmp[rand(0,35)];

            }

            // insert
            sql_query(" insert into $shop[coupon_list_table] $sql_common , coupon_number = '".$coupon_number."' ");

        }

        // 중복 번호는 삭제
        if ($_POST['coupon_number_type']) {

            // 동일한 번호가 존재한다.
            $chk = sql_fetch(" select * from $shop[coupon_list_table] where coupon_id != '".addslashes($coupon_id)."' and coupon_number = '".addslashes($coupon_number)."' ");
            if ($chk['id']) {

                sql_query(" delete from $shop[coupon_list_table] where coupon_id = '".addslashes($coupon_id)."' ");

                echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$shop[charset]\">";
                echo "<script type='text/javascript'>alert('쿠폰 생성중 중복된 번호로 인하여 발행을 실패하였습니다.');</script>";

            }

        } else {
        // 중복 번호는 삭제

            $k = 0;
            $result = sql_query(" select id, count(*) as total_count from $shop[coupon_list_table] where coupon_id = '".addslashes($coupon_id)."' group by coupon_number order by total_count ");
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                if ($row['total_count'] >= '2') {

                    $k++;

                    sql_query(" delete from $shop[coupon_list_table] where id = '".$row['id']."' ");

                }

            }

            if ($k) {

                echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$shop[charset]\">";
                echo "<script type='text/javascript'>alert('쿠폰 생성중 중복된 번호로 인하여 {$k}매 발행을 실패하였습니다.');</script>";

            }

        }

    }

/*--------------------------------
    ## 인쇄용 쿠폰생성 end ##
--------------------------------*/

}

// update
else if ($m == 'u') {

    if (!$_POST['coupon_id']) {

        alert(" 쿠폰이 삭제되었거나 존재하지 않습니다.");

    }

    $dmshop_coupon = shop_coupon($_POST['coupon_id']);

    if (!$dmshop_coupon['id']) {

        alert("쿠폰이 삭제되었거나 존재하지 않습니다.");

    }

    // set
    $sql_common = "";
    $sql_common .= " set coupon_type = '".addslashes($_POST['coupon_type'])."' ";
    $sql_common .= ", coupon_title = '".addslashes($_POST['coupon_title'])."' ";
    $sql_common .= ", coupon_max = '".addslashes($_POST['coupon_max'])."' ";
    $sql_common .= ", coupon_discount_type = '".addslashes($_POST['coupon_discount_type'])."' ";
    $sql_common .= ", coupon_discount = '".addslashes($_POST['coupon_discount'])."' ";
    $sql_common .= ", coupon_discount_max = '".addslashes($_POST['coupon_discount_max'])."' ";
    $sql_common .= ", coupon_discount_min = '".addslashes($_POST['coupon_discount_min'])."' ";
    $sql_common .= ", coupon_day_type = '".addslashes($_POST['coupon_day_type'])."' ";
    $sql_common .= ", coupon_date1 = '".addslashes($_POST['coupon_date1'])."' ";
    $sql_common .= ", coupon_date2 = '".addslashes($_POST['coupon_date2'])."' ";
    $sql_common .= ", coupon_day = '".addslashes($_POST['coupon_day'])."' ";
    $sql_common .= ", coupon_category_type = '".addslashes($_POST['coupon_category_type'])."' ";
    $sql_common .= ", coupon_category = '".addslashes($_POST['coupon_category'])."' ";
    $sql_common .= ", coupon_plan = '".addslashes($_POST['coupon_plan'])."' ";
    $sql_common .= ", coupon_bank = '".addslashes($_POST['coupon_bank'])."' ";
    $sql_common .= ", coupon_cash = '".addslashes($_POST['coupon_cash'])."' ";
    $sql_common .= ", coupon_overlap = '".addslashes($_POST['coupon_overlap'])."' ";
    $sql_common .= ", coupon_image = '".addslashes($_POST['coupon_image'])."' ";
    $sql_common .= ", coupon_image_type = '".addslashes($_POST['coupon_image_type'])."' ";

    // 수정
    sql_query(" update $shop[coupon_table] $sql_common where id = '".addslashes($_POST['coupon_id'])."' ");

    // set
    $sql_common = "";
    $sql_common .= " set coupon_title = '".addslashes($_POST['coupon_title'])."' ";
    $sql_common .= ", coupon_discount_type = '".addslashes($_POST['coupon_discount_type'])."' ";
    $sql_common .= ", coupon_discount = '".addslashes($_POST['coupon_discount'])."' ";
    $sql_common .= ", coupon_discount_max = '".addslashes($_POST['coupon_discount_max'])."' ";
    $sql_common .= ", coupon_discount_min = '".addslashes($_POST['coupon_discount_min'])."' ";
    $sql_common .= ", coupon_date1 = '".addslashes($_POST['coupon_date1'])."' ";
    $sql_common .= ", coupon_date2 = '".addslashes($_POST['coupon_date2'])."' ";
    $sql_common .= ", coupon_category_type = '".addslashes($_POST['coupon_category_type'])."' ";
    $sql_common .= ", coupon_category = '".addslashes($_POST['coupon_category'])."' ";
    $sql_common .= ", coupon_plan = '".addslashes($_POST['coupon_plan'])."' ";
    $sql_common .= ", coupon_bank = '".addslashes($_POST['coupon_bank'])."' ";
    $sql_common .= ", coupon_cash = '".addslashes($_POST['coupon_cash'])."' ";
    $sql_common .= ", coupon_overlap = '".addslashes($_POST['coupon_overlap'])."' ";

    // 내역 수정
    sql_query(" update $shop[coupon_list_table] $sql_common where coupon_id = '".addslashes($_POST['coupon_id'])."' ");

}

// update
else if ($m == 'd') {

    // 첨부파일 삭제
    $result = sql_query(" select datetime, upload_file from $shop[coupon_file_table] where coupon_id = '".addslashes($_POST['coupon_id'])."' ");
    for ($i=0; $file=sql_fetch_array($result); $i++) {

        // 원본
        $file_path = $shop['path']."/data/coupon/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 첨부파일 삭제
        @unlink($file_path);

    }

    // 파일 삭제
    sql_query(" delete from $shop[coupon_file_table] where coupon_id = '".addslashes($_POST['coupon_id'])."' ");

    // 쿠폰 삭제
    sql_query(" delete from $shop[coupon_table] where id = '".addslashes($_POST['coupon_id'])."' ");

    // 쿠폰 내역 삭제
    sql_query(" delete from $shop[coupon_list_table] where coupon_id = '".addslashes($_POST['coupon_id'])."' ");

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// insert, update
if ($m == '' || $m == 'u') {

    /*------------------------------
        ## 파일 파일 ##
    ------------------------------*/

    // 파일 업로드 경로
    $dir = $shop['path']."/data/coupon/".shop_data_path("", "");

    // 디렉토리 생성 및 퍼미션 변경
    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // 대표이미지
    $upload_mode = "default";
    include("./upload_coupon_file.php");

}

// 생성
if ($m == '') {

    // 리스트페이지로
    shop_url("./coupon_config_list.php");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>