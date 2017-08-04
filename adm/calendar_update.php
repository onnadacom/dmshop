<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";
if ($calendarView) { $calendarView = preg_match("/^[a-zA-Z0-9_\-]+$/", $calendarView) ? $calendarView : ""; }
if ($id) { $id = preg_match("/^[0-9]+$/", $id) ? $id : ""; }
if ($date_etc1) { $date_etc1 = preg_match("/^[0-9\-]+$/", $date_etc1) ? $date_etc1 : ""; }
if ($date_etc2) { $date_etc2 = preg_match("/^[0-9\-]+$/", $date_etc2) ? $date_etc2 : ""; }
if ($date1) { $date1 = preg_match("/^[0-9\-]+$/", $date1) ? $date1 : ""; }
if ($date2) { $date2 = preg_match("/^[0-9\-]+$/", $date2) ? $date2 : ""; }
if ($h1) { $h1 = preg_match("/^[0-9]+$/", $h1) ? $h1 : ""; }
if ($h2) { $h2 = preg_match("/^[0-9]+$/", $h2) ? $h2 : ""; }
if ($i1) { $i1 = preg_match("/^[0-9]+$/", $i1) ? $i1 : ""; }
if ($i2) { $i2 = preg_match("/^[0-9]+$/", $i2) ? $i2 : ""; }

$title = trim(strip_tags(mysql_real_escape_string($_POST['title'])));

if ($m == '' || $m == 'u') {

    if (!$title) {

        $title = "내용없음";

    }

    // key 생성
    $secret_date1 = "1970-01-01 00:00:00";
    $secret_date2 = date("Y-m-d H:i:s", time());
    $secret_date3 = ((strtotime($secret_date2) - strtotime($secret_date1)));
    $secret_key = $secret_date3; // UNIX timestamp

    // 키
    $tmp_code = substr(md5($dmshop_user['user_id'].$secret_key),0,10);

    // 데이터 체크
    $chk = sql_fetch(" select * from $shop[calendar_table] where code = '".$tmp_code."' ");

    if ($chk['id']) {

        echo "<script type='text/javascript'>alert('일시적인 장애가 발생되었습니다. 다시 시도하여 주시기 바랍니다.');</script>";
        exit;

    }

    $k = "0";
    $calendar_del_list = "";
    $calendar_add_list = "";
    if ($date1 && $date2) {

        // 기간이 잘못 되었다면
        if ($date2 < $date1) {

            echo "<script type='text/javascript'>alert('기간을 잘못 입력하셨습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.');</script>";
            exit;

        }

        for ($i=0; $i<=10000; $i++) {

            $date = date("Y-m-d", strtotime($date1) + ($i * 86400));

            if ($date > $date2) {

                break;

            } else {
            // 기록

                $k++;

                $sql_common = "";
                $sql_common .= " set code = '".$tmp_code."' ";
                $sql_common .= ", user_id = '".addslashes($dmshop_user['user_id'])."' ";
                $sql_common .= ", title = '".$title."' ";
                $sql_common .= ", date = '".$date."' ";
                $sql_common .= ", date1 = '".$date1."' ";
                $sql_common .= ", date2 = '".$date2."' ";
                $sql_common .= ", h1 = '".$h1."' ";
                $sql_common .= ", h2 = '".$h2."' ";
                $sql_common .= ", i1 = '".$i1."' ";
                $sql_common .= ", i2 = '".$i2."' ";
                $sql_common .= ", datetime = '".$shop['time_ymdhis']."'";

                sql_query(" insert into $shop[calendar_table] $sql_common ");

                $calendar_id = mysql_insert_id();

                if ($k == '1') {

                    $code_id = $calendar_id;

                }

                // 구간 업데이트
                if ($date >= $date_etc1 && $date <= $date_etc2) {

                    // 같은 날 일정을 뽑는다.
                    $result = sql_query(" select * from $shop[calendar_table] where date = '".$date."' and user_id = '".addslashes($dmshop_user['user_id'])."' order by h1 asc, i1 asc ");
                    for ($j=0; $data=sql_fetch_array($result); $j++) {

                        // 기존 일정 삭제
                        $calendar_del_list .= "calendarDel('".$data['date']."');";

                        // 기존 일정 추가
                        $calendar_add_list .= "calendarAdd('".$data['date']."', '".$data['id']."', '".text($data['title'])."', '".$data['date1']."', '".$data['date2']."', '".$data['h1']."', '".$data['h2']."', '".$data['i1']."', '".$data['i2']."', '".$calendarView."');";

                    }

                }

            }

        }

    } else {

        echo "<script type='text/javascript'>alert('요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.');</script>";
        exit;

    }

    if ($code_id) {

        sql_query(" update $shop[calendar_table] set code = '".addslashes($code_id)."' where code = '".$tmp_code."' and user_id = '".addslashes($dmshop_user['user_id'])."' ");

    }

    $calendar_del_list2 = "";
    $calendar_add_list2 = "";

    // 수정
    if ($m == 'u') {

        // 데이터 체크
        $del = sql_fetch(" select * from $shop[calendar_table] where id = '".$id."' and user_id = '".addslashes($dmshop_user['user_id'])."' ");

        // 전체 구간 업데이트
        $result = sql_query(" select * from $shop[calendar_table] where date >= '".$date_etc1."' and date <= '".$date_etc2."' and user_id = '".addslashes($dmshop_user['user_id'])."' order by h1 asc, i1 asc ");
        for ($i=0; $data=sql_fetch_array($result); $i++) {

            // 기존 일정 삭제
            $calendar_del_list2 .= "calendarDel('".$data['date']."');";

            // 삭제하는 일정은 제외
            if ($data['code'] != $del['code']) {

                // 기존 일정 추가
                $calendar_add_list2 .= "calendarAdd('".$data['date']."', '".$data['id']."', '".text($data['title'])."', '".$data['date1']."', '".$data['date2']."', '".$data['h1']."', '".$data['h2']."', '".$data['i1']."', '".$data['i2']."', '".$calendarView."');";

            }

        }

        // 동일 일정 삭제
        sql_query(" delete from $shop[calendar_table] where code = '".$del['code']."' and user_id = '".addslashes($dmshop_user['user_id'])."' ");

    }

    echo "<script type='text/javascript'>".$calendar_del_list." ".$calendar_add_list."</script>";
    echo "<script type='text/javascript'>".$calendar_del_list2." ".$calendar_add_list2."</script>";
    echo "<script type='text/javascript'>calendarClose();</script>";

}

// 삭제
else if ($m == 'd') {

    $calendar_del_list = "";
    $calendar_add_list = "";

    $sql_search = "";

    if (!$is_admin) {

        $sql_search = " and user_id = '".addslashes($dmshop_user['user_id'])."' ";

    }

    // 데이터 체크
    $del = sql_fetch(" select * from $shop[calendar_table] where id = '".$id."' $sql_search ");

    // 전체 구간 업데이트
    $result = sql_query(" select * from $shop[calendar_table] where date >= '".$date_etc1."' and date <= '".$date_etc2."' and user_id = '".addslashes($dmshop_user['user_id'])."' order by h1 asc, i1 asc ");
    for ($i=0; $data=sql_fetch_array($result); $i++) {

        // 기존 일정 삭제
        $calendar_del_list .= "calendarDel('".$data['date']."');";

        // 삭제하는 일정은 제외
        if ($data['code'] != $del['code']) {

            // 기존 일정 추가
            $calendar_add_list .= "calendarAdd('".$data['date']."', '".$data['id']."', '".text($data['title'])."', '".$data['date1']."', '".$data['date2']."', '".$data['h1']."', '".$data['h2']."', '".$data['i1']."', '".$data['i2']."', '".$calendarView."');";

        }

    }

    // 동일 일정 삭제
    sql_query(" delete from $shop[calendar_table] where code = '".$del['code']."' $sql_search ");

    echo "<script type='text/javascript'>".$calendar_del_list." ".$calendar_add_list."</script>";
    echo "<script type='text/javascript'>calendarClose();</script>";

} else {

    echo "<script type='text/javascript'>alert('요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.');</script>";
    exit;

}
?>