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

if ($m == 'u') {

    $dmshop_reply_msg = ":: 상품평 수정 ::";

}

else if ($m == 'd') {

    $dmshop_reply_msg = ":: 상품평 삭제 ::";

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

// 스킨 경로
$dmshop_item_path = "";
$dmshop_item_path = $shop['path']."/skin/item/".$dmshop_skin['skin_item'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_item['item_title'];

include_once("./shop.top.php");
include_once("$dmshop_item_path/reply_password.php");
include_once("./shop.bottom.php");
?>