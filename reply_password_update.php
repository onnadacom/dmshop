<?
include_once("./_dmshop.php");

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

    // 회원이 작성
    if ($dmshop_reply['user_id']) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

    }

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

if (!$reply_password) {

    message("<p class='title'>알림</p><p class='text'>비밀번호를 입력하시기 바랍니다.</p>", "b");

}

// 패스워드 체크
if ($dmshop_reply['reply_password'] != sql_password($reply_password)) {

    message("<p class='title'>알림</p><p class='text'>비밀번호가 다릅니다.</p>", "b");

}

// 세션 생성
$ss_name = "ss_name_reply_".$dmshop_reply['reply_id'];

if (!shop_get_session($ss_name)) {

    shop_set_session($ss_name, true);

}

if ($m == 'u') {

    if ($page_id == 'item') {

        $url = $shop['shop']."/reply_write.php?page_id=".$page_id."&m=".$m."&item_id=".$item_id."&reply_id=".$reply_id."&page=".$page;

        shop_url($url);

    }

}

else if ($m == 'd') {

    if ($page_id == 'item') {

        echo "<script type=\"text/javascript\">opener.replyDelete('".$page_id."', '".$m."', '".$item_id."', '".$reply_id."', '".$page."');window.close();</script>";

        exit;

    }

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}
?>