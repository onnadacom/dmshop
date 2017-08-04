<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 수정
if ($m == 'u') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 쿠폰정보
        $dmshop_coupon = shop_coupon(addslashes($_POST['coupon_id'][$k]));

        // 쿠폰이 있다면
        if ($dmshop_coupon['id']) {

            // set
            $sql_common = "";
            $sql_common .= " set coupon_use = '".addslashes($_POST['coupon_use'][$k])."' ";
            $sql_common .= ", coupon_max = '".addslashes($_POST['coupon_max'][$k])."' ";

            // 쿠폰 업데이트
            sql_query(" update $shop[coupon_table] $sql_common where id = '".addslashes($_POST['coupon_id'][$k])."' ");

            // set
            $sql_common = "";
            $sql_common .= " set coupon_use = '".addslashes($_POST['coupon_use'][$k])."' ";

            // 내역 업데이트
            sql_query(" update $shop[coupon_list_table] $sql_common where coupon_id = '".addslashes($_POST['coupon_id'][$k])."' ");

        }

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}

// 삭제
else if ($m == 'd') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 쿠폰정보
        $dmshop_coupon = shop_coupon(addslashes($_POST['coupon_id'][$k]));

        // 쿠폰이 있다면
        if ($dmshop_coupon['id']) {

            // 첨부파일 삭제
            $result = sql_query(" select datetime, upload_file from $shop[coupon_file_table] where coupon_id = '".addslashes($_POST['coupon_id'][$k])."' ");
            for ($n=0; $file=sql_fetch_array($result); $n++) {

                // 원본
                $file_path = $shop['path']."/data/coupon/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

                // 첨부파일 삭제
                @unlink($file_path);

            }

            // 파일 삭제
            sql_query(" delete from $shop[coupon_file_table] where coupon_id = '".addslashes($_POST['coupon_id'][$k])."' ");

            // 쿠폰 삭제
            sql_query(" delete from $shop[coupon_table] where id = '".addslashes($_POST['coupon_id'][$k])."' ");

            // 쿠폰 내역 삭제
            sql_query(" delete from $shop[coupon_list_table] where coupon_id = '".addslashes($_POST['coupon_id'][$k])."' ");

        }

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}
?>