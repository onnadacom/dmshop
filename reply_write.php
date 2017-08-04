<?
include_once("./_dmshop.php");

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

// 수정권한 체크
if ($m == 'u') {

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

            $url = $shop['shop']."/reply_password.php?page_id=".$page_id."&m=".$m."&item_id=".$item_id."&reply_id=".$reply_id."&page=".$page;

            shop_url($url);

            //echo "<script type=\"text/javascript\">opener.replyPassword('".$page_id."', '".$m."', '".$item_id."', '".$reply_id."', '".$page."');window.close();</script>";
            //exit;

        }

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

        // 초기화
        unset($dmshop_reply);

        $dmshop_reply_msg = ":: 관리자 상품평 답변 ::";

    } else {

        if ($shop_user_admin) {

            $dmshop_reply_msg = ":: 관리자 상품평 작성 ::";

        } else {

            $dmshop_reply_msg = ":: 상품평 작성 ::";

        }

    }

}

// 수정
else if ($m == 'u') {

    if ($shop_user_admin) {

        $dmshop_reply_msg = ":: 관리자 상품평 수정 ::";

    } else {

        $dmshop_reply_msg = ":: 상품평 수정 ::";

    }

    $dmshop_reply['reply_title'] = text($dmshop_reply['reply_title']);
    $dmshop_reply['reply_content'] = text2($dmshop_reply['reply_content'], 1);
    $dmshop_reply['reply_name'] = text($dmshop_reply['reply_name']);

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

// 스킨 경로
$dmshop_item_path = "";
$dmshop_item_path = $shop['path']."/skin/item/".$dmshop_skin['skin_item'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_item['item_title'];

include_once("./shop.top.php");
include_once("$dmshop_item_path/reply_write.php");
include_once("./shop.bottom.php");
?>