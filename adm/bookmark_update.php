<?php
include_once("./_dmshop.php");
if ($added_list) { $added_list = preg_match("/^[0-9\,]+$/", $added_list) ? $added_list : ""; }

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($added_list) {

    sql_query(" update $shop[bookmark_table] set mode = '0' ");

    $str = explode(",", trim($added_list));
    for ($i=0; $i<count($str); $i++) {

        $k = $str[$i];

        if ($k) {

            sql_query(" update $shop[bookmark_table] set position = '".$i."', mode = '1' where id = '".$k."' ");

        }

    }

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

echo "<script type='text/javascript'>opener.location.reload();</script>";

shop_url($urlencode);
?>