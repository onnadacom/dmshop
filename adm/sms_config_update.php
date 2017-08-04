<?php
include_once("./_dmshop.php");

// 변경
if ($m == 'u') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 업데이트
        $sql_common = "";
        $sql_common .= " set sms_use = '".addslashes($_POST['sms_use'][$k])."' ";
        $sql_common .= ", sms_message = '".addslashes($_POST['sms_message'][$k])."' ";

        // update
        sql_query(" update $shop[sms_config_table] $sql_common where sms_code = '".addslashes($_POST['sms_code'][$k])."' ");

        if ($_POST['sms_code'][$k] == 'hp_real' && $_POST['sms_use'][$k]) {

            // update
            sql_query(" update $shop[signup_table] set user_hp = '3' ");

        }

    }

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}
?>