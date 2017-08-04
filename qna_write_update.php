<?
include_once("./_dmshop.php");

if (shop_keyword_filter($qna_title)) { message("<p class='title'>알림</p><p class='text'>제목에 금지어가 포함되어있습니다.</p>", "b"); }
if (shop_keyword_filter($qna_content)) { message("<p class='title'>알림</p><p class='text'>내용 금지어가 포함되어있습니다.</p>", "b"); }

// 권한설정
if ($dmshop['qna_write_level'] > '1') {

    if ($shop_user_login) {

        if ($dmshop_user['user_level'] < $dmshop['qna_write_level']) {

            message("<p class='title'>알림</p><p class='text'>작성할 권한이 없습니다.</p>", "c");

        }

    } else {

        message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "c");

    }

}

if ($item_id) { $item_id = preg_match("/^[0-9]+$/", $item_id) ? $item_id : ""; }
if ($qna_id) { $qna_id = preg_match("/^[0-9]+$/", $qna_id) ? $qna_id : ""; }

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
if ($qna_id) {

    // 상품문의
    $dmshop_qna = shop_qna($qna_id);

    // 상품문의가 없다.
    if (!$dmshop_qna['id']) {

        message("<p class='title'>알림</p><p class='text'>상품문의가 삭제되었거나 존재하지 않습니다.</p>", "c");

    }

}

// 수정, 삭제 권한체크
if ($m == 'u' || $m == 'd') {

    // 관리자 통과
    if ($shop_user_admin) {

         // pass

    }

    // 회원
    else if ($dmshop_qna['user_id']) {

        // 작성자
        if ($dmshop_user['user_id'] == $dmshop_qna['user_id']) {

            // pass

        } else {

            message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

        }

    } else {

        // 비회원 세션이 있다면 승인
        $ss_name = "ss_name_qna_".$qna_id;

        if (shop_get_session($ss_name)) {

            // pass

        } else {

            echo "<script type=\"text/javascript\">qnaPassword('".$page_id."', '".$m."', '".$item_id."', '".$qna_id."', '".$page."');</script>";

            if ($page_id == 'item') {

                echo "<script type=\"text/javascript\">qnaLoading('".$item_id."', '".$page."');</script>";

            }

            exit;

        }

    }

}

// 관리자
if ($shop_user_admin) {

    if ($qna_name) {

        $user_id = $user_id;
        $qna_name = $qna_name;

    } else {

        $user_id = $dmshop_user['user_id'];
        $qna_name = $dmshop_user['user_name'];

    }

}

// 회원
else if ($shop_user_login) {

    $user_id = $dmshop_user['user_id'];
    $qna_name = $dmshop_user['user_name'];

} else {
// 비회원

    $user_id = "";
    $qna_name = $qna_name;

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

    // 답변
    if ($qna_id) {

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
    $sql_common .= ", qna_id = '".$qna_id."' ";
    $sql_common .= ", user_id = '".$user_id."' ";
    $sql_common .= ", qna_name = '".trim(strip_tags(mysql_real_escape_string($qna_name)))."' ";
    $sql_common .= ", qna_password = '".sql_password($qna_password)."' ";
    $sql_common .= ", qna_secret = '".trim(strip_tags(mysql_real_escape_string($qna_secret)))."' ";
    $sql_common .= ", qna_category = '".trim(strip_tags(mysql_real_escape_string($qna_category)))."' ";
    $sql_common .= ", qna_title = '".trim(mysql_real_escape_string($qna_title))."' ";
    $sql_common .= ", qna_content = '".mysql_real_escape_string($qna_content)."' ";
    $sql_common .= ", qna_ip = '".trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])))."' ";

    if ($shop_user_admin && $datetime) {

        $sql_common .= ", datetime = '".$datetime."' ";

    } else {

        $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    }

    // insert
    sql_query(" insert into $shop[qna_table] $sql_common ");

    $id = mysql_insert_id();

    // 답변
    if ($qna_id) {

        // 아이디 저장
        sql_query(" update $shop[qna_table] set qna_id = '".$dmshop_qna['qna_id']."' where id = '".$id."' ");

        // 카운트 증가
        sql_query(" update $shop[qna_table] set qna_count = qna_count + 1 where id = '".$dmshop_qna['qna_id']."' ");

    } else {
    // 신규

        // 아이디 저장
        sql_query(" update $shop[qna_table] set qna_id = '".$id."' where id = '".$id."' ");

        // 상품 카운트 증가
        sql_query(" update $shop[item_table] set item_qna = item_qna + 1 where id = '".$item_id."' ");

        // 기획전 카운트 증가
        sql_query(" update $shop[plan_item_table] set item_qna = item_qna + 1 where item_id = '".$item_id."' ");

    }

    // 비회원
    if (!$shop_user_login) {

        $ss_name = "ss_name_qna_".$id;

        if (!shop_get_session($ss_name)) {

            shop_set_session($ss_name, true);

        }

    }

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/qna/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // qna
    $upload_mode = $id;
    include("$shop[path]/upload_qna_file.php");

}

// 수정
else if ($m == 'u') {

    $sql_common = "";
    $sql_common .= " set qna_password = '".sql_password($qna_password)."' ";
    $sql_common .= ", qna_secret = '".trim(strip_tags(mysql_real_escape_string($qna_secret)))."' ";
    $sql_common .= ", qna_category = '".trim(strip_tags(mysql_real_escape_string($qna_category)))."' ";
    $sql_common .= ", qna_title = '".trim(mysql_real_escape_string($qna_title))."' ";
    $sql_common .= ", qna_content = '".mysql_real_escape_string($qna_content)."' ";

    if ($shop_user_admin && $qna_name) {

        $sql_common .= ", user_id = '".$user_id."' ";
        $sql_common .= ", qna_name = '".trim(strip_tags(mysql_real_escape_string($qna_name)))."' ";

    }

    if ($shop_user_admin && $datetime) {

        $sql_common .= ", datetime = '".$datetime."' ";

    }

    sql_query(" update $shop[qna_table] $sql_common where id = '".$qna_id."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/qna/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // qna
    $upload_mode = $qna_id;
    include("$shop[path]/upload_qna_file.php");

}

// 삭제
else if ($m == 'd') {

    // 신규
    if ($qna_id == $dmshop_qna['qna_id']) {

        // 상품문의 카운트 감소
        sql_query(" update $shop[item_table] set item_qna = item_qna - 1 where id = '".$dmshop_qna['item_id']."' ");

        // 기획전 카운트 감소
        sql_query(" update $shop[plan_item_table] set item_qna = item_qna - 1 where item_id = '".$dmshop_qna['item_id']."' ");

        // 답변
        $dmshop_qna_reply = shop_qna_reply($qna_id);

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[qna_file_table] where upload_mode in ('".$qna_id."', '".$dmshop_qna_reply['id']."') ");
        for ($i=0; $file=sql_fetch_array($result); $i++) {

            // 원본
            $file_path = $shop['path']."/data/qna/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 상품평 삭제 (답변도 삭제)
        sql_query(" delete from $shop[qna_table] where qna_id = '".$qna_id."' ");

    } else {
    // 답변

        // 카운트 감소
        sql_query(" update $shop[qna_table] set qna_count = qna_count - 1 where id = '".$dmshop_qna['qna_id']."' ");

        // 첨부파일 삭제
        $result = sql_query(" select datetime, upload_file from $shop[qna_file_table] where upload_mode in ('".$qna_id."') ");
        for ($i=0; $file=sql_fetch_array($result); $i++) {

            // 원본
            $file_path = $shop['path']."/data/qna/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

            // 첨부파일 삭제
            @unlink($file_path);

        }

        // 상품문의 삭제
        sql_query(" delete from $shop[qna_table] where id = '".$qna_id."' ");

    }

    if ($page_id == 'item') {

        echo "<script type=\"text/javascript\">qnaLoading('".$item_id."', '".$page."');</script>";
        exit;

    }

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

if ($page_id == 'item') {

    echo "<script type=\"text/javascript\">opener.qnaLoading('".$item_id."', '".$page."');window.close();</script>";

} else {

    if ($url) {
    
        $urlencode = urldecode($url);
    
    } else {
    
        $urlencode = urldecode($_SERVER[REQUEST_URI]);
    
    }
    
    shop_url($urlencode);

}
?>