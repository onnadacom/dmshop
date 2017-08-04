<?
include_once("./_dmshop.php");

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

    // 회원이 작성
    if ($dmshop_qna['user_id']) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

    }

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

if ($m == '') {

    $dmshop_qna_msg = ":: 상품문의 열람 ::";

}

else if ($m == 'u') {

    $dmshop_qna_msg = ":: 상품문의 수정 ::";

}

else if ($m == 'd') {

    $dmshop_qna_msg = ":: 상품문의 삭제 ::";

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}

// 스킨 경로
$dmshop_item_path = "";
$dmshop_item_path = $shop['path']."/skin/item/".$dmshop_skin['skin_item'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_item['item_title'];

include_once("./shop.top.php");
include_once("$dmshop_item_path/qna_password.php");
include_once("./shop.bottom.php");
?>