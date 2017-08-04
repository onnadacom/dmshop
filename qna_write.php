<?
include_once("./_dmshop.php");

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

// 수정권한 체크
if ($m == 'u') {

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

            $url = $shop['shop']."/qna_password.php?page_id=".$page_id."&m=".$m."&item_id=".$item_id."&qna_id=".$qna_id."&page=".$page;

            shop_url($url);

            //echo "<script type=\"text/javascript\">opener.qnaPassword('".$page_id."', '".$m."', '".$item_id."', '".$qna_id."', '".$page."');window.close();</script>";
            //exit;

        }

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

        // 초기화
        unset($dmshop_qna);

        $dmshop_qna_msg = ":: 관리자 상품문의 답변 ::";

    } else {

        if ($shop_user_admin) {

            $dmshop_qna_msg = ":: 관리자 상품문의 작성 ::";

        } else {

            $dmshop_qna_msg = ":: 상품문의 작성 ::";

        }

    }

}

// 수정
else if ($m == 'u') {

    if ($shop_user_admin) {

        $dmshop_qna_msg = ":: 관리자 상품문의 수정 ::";

    } else {

        $dmshop_qna_msg = ":: 상품문의 수정 ::";

    }

    $dmshop_qna['qna_title'] = text($dmshop_qna['qna_title']);
    $dmshop_qna['qna_content'] = text2($dmshop_qna['qna_content'], 1);
    $dmshop_qna['qna_name'] = text($dmshop_qna['qna_name']);

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

// 스킨 경로
$dmshop_item_path = "";
$dmshop_item_path = $shop['path']."/skin/item/".$dmshop_skin['skin_item'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_item['item_title'];

include_once("./shop.top.php");
include_once("$dmshop_item_path/qna_write.php");
include_once("./shop.bottom.php");
?>