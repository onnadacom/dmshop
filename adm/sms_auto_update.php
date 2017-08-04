<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 생성
if ($m == '') {

    // insert
    sql_query(" insert into $shop[sms_auto_table] set sms_message = '".addslashes($_POST['sms_message'])."', datetime = '".$shop['time_ymdhis']."' ");

    echo "<script type=\"text/javascript\">opener.smsAutoLoading('1'); window.close();</script>";

}

else if ($m == 'd') {

    // delete
    sql_query(" delete from $shop[sms_auto_table] where id = '".$id."' ");

    echo "<script type=\"text/javascript\">smsAutoLoading('1');</script>";

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}
?>