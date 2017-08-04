<?php
include_once("./_dmshop.php");
if ($c) { $c = preg_match("/^[a-zA-Z0-9_\-]+$/", $c) ? $c : ""; }
if ($level) { $level = preg_match("/^[0-9]+$/", $level) ? $level : ""; }
if ($cash) { $cash = preg_match("/^[0-9]+$/", $cash) ? $cash : ""; }

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($cash <= 0) {

    alert($message." 금액은 부호없이 숫자만 입력하세요.");

}

if (!$content) {

    alert($message."명을 입력하세요.");

}

if ($c == 'plus') {

    $message = "지급";

}

else if ($c == 'minus') {

    $message = "차감";

} else {

    alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 개별
if ($m == '') {

    // 회원정보
    $user = shop_user($user_id);

    if (!$user['id']) {

        alert("존재하지 않는 아이디입니다.");

    }

    // 지급
    if ($c == 'plus') {

        // 적립금 처리
        shop_cash_insert($user_id, (int)($cash * 1), $content, "cash_make", $shop['time_ymdhis'], "cash_plus");

    }

    // 차감
    else if ($c == 'minus') {

        // 적립금 처리
        shop_cash_insert($user_id, (int)($cash * -1), $content, "cash_make", $shop['time_ymdhis'], "cash_minus");

    } else {

        // pass

    }

}

// 일괄
else if ($m == 'all') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 회원정보
        $user = shop_user($user_id[$k]);

        if ($user['id']) {

            // 지급
            if ($c == 'plus') {

                // 적립금 처리
                shop_cash_insert(addslashes($_POST['user_id'][$k]), (int)($cash * 1), $content, "cash_make", $shop['time_ymdhis'], "cash_plus");

            }

            // 차감
            else if ($c == 'minus') {

                // 적립금 처리
                shop_cash_insert(addslashes($_POST['user_id'][$k]), (int)($cash * -1), $content, "cash_make", $shop['time_ymdhis'], "cash_minus");

            } else {

                // pass

            }

        }

    }

}

// 등급별 지급
else if ($m == 'level') {

    // 등급
    if ($level) {

        $sql_search = " where user_level = '".$level."' ";

    } else {

        // 2부터가 회원
        $sql_search = " where user_level >= '2' ";

    }

    // 회원 데이터
    $result = sql_query(" select * from $shop[user_table] $sql_search order by id asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        // 지급
        if ($c == 'plus') {

            // 적립금 처리
            shop_cash_insert($row['user_id'], (int)($cash * 1), $content, "cash_make", $shop['time_ymdhis'], "cash_plus");

        }
    
        // 차감
        else if ($c == 'minus') {
    
            // 적립금 처리
            shop_cash_insert($row['user_id'], (int)($cash * -1), $content, "cash_make", $shop['time_ymdhis'], "cash_minus");
    
        } else {
    
            // pass
    
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

echo "<script type='text/javascript'>opener.location.reload();</script>";

//shop_url($urlencode);
alert("적립금 ".$message."을 완료하였습니다.", $urlencode);
?>