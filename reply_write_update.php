<?
include_once("./_dmshop.php");

if (shop_keyword_filter($reply_title)) { message("<p class='title'>알림</p><p class='text'>제목에 금지어가 포함되어있습니다.</p>", "b"); }
if (shop_keyword_filter($reply_content)) { message("<p class='title'>알림</p><p class='text'>내용 금지어가 포함되어있습니다.</p>", "b"); }

// 권한설정
if ($dmshop['reply_write_level'] > '1') {

    if ($shop_user_login) {

        if ($dmshop_user['user_level'] < $dmshop['reply_write_level']) {

            message("<p class='title'>알림</p><p class='text'>작성할 권한이 없습니다.</p>", "c");

        }

    } else {

        message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

    }

}

if ($item_id) { $item_id = preg_match("/^[0-9]+$/", $item_id) ? $item_id : ""; }
if ($reply_id) { $reply_id = preg_match("/^[0-9]+$/", $reply_id) ? $reply_id : ""; }

// 아이디가 없다.
if (!$item_id) {

    message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "c");

}

// 상품
$dmshop_item = shop_item($item_id);

// 상품이 없다.
if (!$dmshop_item['id']) {

    message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "c");

}

// 답변 또는 수정
if ($reply_id) {

    // 상품평
    $dmshop_reply = shop_reply($reply_id);

    // 상품평이 없다.
    if (!$dmshop_reply['id']) {

        message("<p class='title'>알림</p><p class='text'>상품평이 삭제되었거나 존재하지 않습니다.</p>", "c");

    }

}

// 수정, 삭제 권한체크
if ($m == 'u' || $m == 'd') {

    // 관리자 통과
    if ($shop_user_admin) {

         // pass

    }

    // 회원
    else if ($dmshop_reply['user_id']) {

        // 작성자
        if ($dmshop_user['user_id'] == $dmshop_reply['user_id']) {

            // pass

        } else {

            message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

        }

    } else {

        // 비회원 세션이 있다면 승인
        $ss_name = "ss_name_reply_".$reply_id;

        if (shop_get_session($ss_name)) {

            // pass

        } else {

            echo "<script type=\"text/javascript\">replyPassword('".$page_id."', '".$m."', '".$item_id."', '".$reply_id."', '".$page."');</script>";

            if ($page_id == 'item') {

                echo "<script type=\"text/javascript\">replyLoading('".$item_id."', '".$page."');</script>";

            }

            exit;

        }

    }

}

// 관리자
if ($shop_user_admin) {

    if ($reply_name) {

        $user_id = $user_id;
        $reply_name = $reply_name;

    } else {

        $user_id = $dmshop_user['user_id'];
        $reply_name = $dmshop_user['user_name'];

    }

}

// 회원
else if ($shop_user_login) {

    $user_id = $dmshop_user['user_id'];
    $reply_name = $dmshop_user['user_name'];

} else {
// 비회원

    $user_id = "";
    $reply_name = $reply_name;

    if ($m == '' || $m == 'u') {

/*
        // 지엠스팸프리 검사
        include_once("$shop[path]/zmSpamFree/zmSpamFree.php");

        if (!zsfCheck($_POST['robot_key'])) {

            message("<p class='title'>알림</p><p class='text'>자동등록방지 코드가 틀렸습니다.</p>", "b");

        }
*/

    }

}

// 등록
if ($m == '') {

/*
    // 관리자가 아니라면
    if (!$shop_user_admin) {

        // 수령한 주문
        $dmshop_order = sql_fetch(" select * from $shop[order_table] where item_id = '".$item_id."' and user_id = '".$dmshop_user['user_id']."' and order_receive = '1'  ");

        // 주문내역이 없다면
        if ($dmshop_order['id']) {

            message("<p class='title'>알림</p><p class='text'>현재 상품을 주문(상품수령)하신 분만 상품평을 작성하실 수 있습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

        }

    }
*/

    // 답변
    if ($reply_id) {

        // 관리자가 아니라면
        if (!$shop_user_admin) {

            message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

        }

    }

    $sql_common = "";
    $sql_common .= " set item_id = '".$item_id."' ";
    $sql_common .= ", item_code = '".$dmshop_item['item_code']."' ";
    $sql_common .= ", category1 = '".$dmshop_item['category1']."' ";
    $sql_common .= ", category2 = '".$dmshop_item['category2']."' ";
    $sql_common .= ", category3 = '".$dmshop_item['category3']."' ";
    $sql_common .= ", category4 = '".$dmshop_item['category4']."' ";
    $sql_common .= ", reply_id = '".$reply_id."' ";
    $sql_common .= ", user_id = '".$user_id."' ";
    $sql_common .= ", reply_name = '".trim(strip_tags(mysql_real_escape_string($reply_name)))."' ";
    $sql_common .= ", reply_password = '".sql_password($reply_password)."' ";
    $sql_common .= ", reply_score = '".trim(strip_tags(mysql_real_escape_string($reply_score)))."' ";
    $sql_common .= ", reply_title = '".trim(mysql_real_escape_string($reply_title))."' ";
    $sql_common .= ", reply_content = '".mysql_real_escape_string($reply_content)."' ";
    $sql_common .= ", reply_ip = '".trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])))."' ";

    if ($shop_user_admin && $datetime) {

        $sql_common .= ", datetime = '".$datetime."' ";

    } else {

        $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    }

    // insert
    sql_query(" insert into $shop[reply_table] $sql_common ");

    $id = mysql_insert_id();

    // 답변
    if ($reply_id) {

        // 아이디 저장
        sql_query(" update $shop[reply_table] set reply_id = '".$dmshop_reply['reply_id']."' where id = '".$id."' ");

        // 카운트 증가
        sql_query(" update $shop[reply_table] set reply_count = reply_count + 1 where id = '".$dmshop_reply['reply_id']."' ");

    } else {
    // 원본

        // 아이디 저장
        sql_query(" update $shop[reply_table] set reply_id = '".$id."' where id = '".$id."' ");

        // 상품 카운트 증가
        sql_query(" update $shop[item_table] set item_reply = item_reply + 1 where id = '".$item_id."' ");

        // 기획전 카운트 증가
        sql_query(" update $shop[plan_item_table] set item_reply = item_reply + 1 where item_id = '".$item_id."' ");

        // 쿠폰 자동지급 (상품평 작성)
        shop_coupon_auto_make("4", $dmshop_user['user_id'], "");

    }

    // 비회원
    if (!$shop_user_login) {

        $ss_name = "ss_name_reply_".$id;

        if (!shop_get_session($ss_name)) {

            shop_set_session($ss_name, true);

        }

    }

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/reply/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // reply
    $upload_mode = $id;
    include("$shop[path]/upload_reply_file.php");

}

// 수정
else if ($m == 'u') {

    $sql_common = "";
    $sql_common .= " set reply_title = '".trim(mysql_real_escape_string($reply_title))."' ";
    $sql_common .= ", reply_content = '".mysql_real_escape_string($reply_content)."' ";

    if ($shop_user_admin && $reply_name) {

        $sql_common .= ", user_id = '".$user_id."' ";
        $sql_common .= ", reply_name = '".trim(strip_tags(mysql_real_escape_string($reply_name)))."' ";

    }

    if ($shop_user_admin && $datetime) {

        $sql_common .= ", datetime = '".$datetime."' ";

    }

    $sql_common .= ", reply_password = '".sql_password($reply_password)."' ";
    $sql_common .= ", reply_score = '".trim(strip_tags(mysql_real_escape_string($reply_score)))."' ";

    sql_query(" update $shop[reply_table] $sql_common where id = '".$reply_id."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/reply/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // reply
    $upload_mode = $reply_id;
    include("$shop[path]/upload_reply_file.php");

}

// 삭제
else if ($m == 'd') {

    // 원본
    if ($reply_id == $dmshop_reply['reply_id']) {

        // 상품평 카운트 감소
        sql_query(" update $shop[item_table] set item_reply = item_reply - 1 where id = '".$dmshop_reply['item_id']."' ");

        // 기획전 카운트 감소
        sql_query(" update $shop[plan_item_table] set item_reply = item_reply - 1 where item_id = '".$dmshop_reply['item_id']."' ");

        // 답변
        $dmshop_reply_reply = shop_reply_reply($reply_id);

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[reply_file_table] where upload_mode in ('".$reply_id."', '".$dmshop_reply_reply['id']."') ");
        for ($i=0; $file=sql_fetch_array($result); $i++) {

            // 원본
            $file_path = $shop['path']."/data/reply/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 상품평 삭제 (답변도 삭제)
        sql_query(" delete from $shop[reply_table] where reply_id = '".$reply_id."' ");

    } else {
    // 답변

        // 카운트 감소
        sql_query(" update $shop[reply_table] set reply_count = reply_count - 1 where id = '".$dmshop_reply['reply_id']."' ");

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[reply_file_table] where upload_mode in ('".$reply_id."') ");
        for ($i=0; $file=sql_fetch_array($result); $i++) {

            // 원본
            $file_path = $shop['path']."/data/reply/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 상품평 삭제
        sql_query(" delete from $shop[reply_table] where id = '".$reply_id."' ");

    }

    if ($page_id == 'item') {

        echo "<script type=\"text/javascript\">replyLoading('".$item_id."', '".$page."');</script>";
        exit;

    }

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

// 등록
if ($m == '') {

    if ($page_id == 'mypage' || $page_id == 'order_list') {

        message("<p class='title'>알림</p><p class='text'>상품평 작성을 완료하였습니다.</p>", "c");

    }

}

if ($page_id == 'item') {

    echo "<script type=\"text/javascript\">opener.replyLoading('".$item_id."', '".$page."');window.close();</script>";

} else {

    if ($url) {

        $urlencode = urldecode($url);

    } else {

        $urlencode = urldecode($_SERVER[REQUEST_URI]);

    }

    shop_url($urlencode);

}
?>