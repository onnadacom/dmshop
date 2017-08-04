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

        $k = $chk_id[$i];

        if ($_POST['user_id'][$k] && $_POST['user_level'][$k]) {

            // set
            $sql_common = "";
            $sql_common .= " set user_level = '".addslashes($_POST['user_level'][$k])."' ";

            // 업데이트
            sql_query(" update $shop[user_table] $sql_common where user_id = '".addslashes($_POST['user_id'][$k])."' ");

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
else if ($m == 'alld') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        if ($_POST['user_id'][$k]) {

            // 회원 탈퇴
            shop_user_leave(addslashes($_POST['user_id'][$k]));

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

    // 회원 탈퇴
    shop_user_leave(addslashes($_POST['user_id']));

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