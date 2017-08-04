<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 아이디가 없다면
if (!$_POST['user_id']) {

    alert("회원아이디를 입력하여주세요.");

}

// 회원 데이터
$user = shop_user(addslashes($_POST['user_id']));

if (!$user['id']) {

    alert("회원아이디가 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 메모작성
if ($m == 'memo') {

    // 업데이트
    $sql_common = "";
    $sql_common .= " set user_id = '".addslashes($_POST['user_id'])."' ";
    $sql_common .= ", content = '".addslashes($_POST['content'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // insert
    sql_query(" insert into $shop[user_memo_table] $sql_common ");

}

// 메모삭제
else if ($m == 'memo_delete') {

    // delete
    sql_query(" delete from $shop[user_memo_table] where id = '".addslashes($_POST['memo_id'])."' ");

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>