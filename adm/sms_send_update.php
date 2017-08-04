<?php
include_once("./_dmshop.php");

if ($_POST['sms_type'] == '1') {

    $str = explode("\n", trim($_POST['sms_list']));
    for ($i=0; $i<count($str); $i++) {

        if ($str[$i]) {

            // 예약
            if ($_POST['sms_send']) {

                // 전송
                shop_sms_send("self", "", addslashes($str[$i]), addslashes($_POST['sms_from']), addslashes($_POST['sms_message']), true, addslashes($_POST['sms_y']), addslashes($_POST['sms_m']), addslashes($_POST['sms_d']), addslashes($_POST['sms_h']), addslashes($_POST['sms_i']));

            } else {

                // 전송
                shop_sms_send("self", "", addslashes($str[$i]), addslashes($_POST['sms_from']), addslashes($_POST['sms_message']));

            }

        }

    }

}

// 등급별
else if ($_POST['sms_type'] == '2') {

    // 등급
    if ($_POST['user_level']) {

        $sql_search = " where user_level = '".addslashes($_POST['user_level'])."' ";

    } else {

        // 2부터가 회원
        $sql_search = " where user_level >= '2' ";

    }

    // 회원 데이터
    $result = sql_query(" select * from $shop[user_table] $sql_search order by id asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        // 휴대폰이 있다면
        if ($row['user_hp']) {

            // 예약
            if ($_POST['sms_send']) {

                // 전송
                shop_sms_send("self", addslashes($row['user_id']), addslashes($row['user_hp']), addslashes($_POST['sms_from']), addslashes($_POST['sms_message']), true, addslashes($_POST['sms_y']), addslashes($_POST['sms_m']), addslashes($_POST['sms_d']), addslashes($_POST['sms_h']), addslashes($_POST['sms_i']));

            } else {

                // 전송
                shop_sms_send("self", addslashes($row['user_id']), addslashes($row['user_hp']), addslashes($_POST['sms_from']), addslashes($_POST['sms_message']));

            }

        }

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

alert("발송을 완료하였습니다.", $urlencode);
?>