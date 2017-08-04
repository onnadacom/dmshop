<?php
include_once("./_dmshop.php");

// 개별
if ($m == '') {

    // 회원정보
    $user = shop_user(addslashes($_POST['user_id']));

    if (!$user['id']) {

        alert("존재하지 않는 아이디입니다.");

    }

    // 업데이트
    sql_query(" update $shop[user_table] set user_level = '".addslashes($_POST['user_level'])."' where user_id = '".addslashes($_POST['user_id'])."' ");

}

// 일괄
else if ($m == 'all') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 회원정보
        $user = shop_user(addslashes($_POST['user_id'][$k]));

        if ($user['id']) {

            // 업데이트
            sql_query(" update $shop[user_table] set user_level = '".addslashes($_POST['user_level'])."' where user_id = '".addslashes($_POST['user_id'][$k])."' ");

        }

    }

}

// 등급별 지급
else if ($m == 'level') {

    $sql_search = " where user_id != 'admin' and user_leave_datetime = '0000-00-00 00:00:00' ";

    // 등급
    if ($_POST['level']) {

        $sql_search .= " and user_level = '".addslashes($_POST['level'])."' ";

    } else {

        // 2부터가 회원
        $sql_search .= " and user_level >= '2' ";

    }

    // 회원 데이터
    $result = sql_query(" select * from $shop[user_table] $sql_search order by id asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        // 업데이트
        sql_query(" update $shop[user_table] set user_level = '".addslashes($_POST['user_level'])."' where user_id = '".addslashes($row['user_id'])."' ");

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

//shop_url($urlencode);
alert("회원 등급변경을 완료하였습니다.", $urlencode);
?>