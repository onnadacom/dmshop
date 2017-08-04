<?
include_once("./_dmshop.php");

if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }
if ($item_code) { $item_code = preg_match("/^[a-zA-Z0-9_\-]+$/", $item_code) ? $item_code : ""; }
if ($email1) { $email1 = preg_match("/^[A-Za-z0-9_@\-\.]+$/", $email1) ? $email1 : ""; }
if ($email2) { $email2 = preg_match("/^[A-Za-z0-9_@\-\.]+$/", $email2) ? $email2 : ""; }

// 설정
$dmshop_design_item = shop_design_item();

if (!$dmshop_design_item['sns_use5']) {

    message("<p class='title'>알림</p><p class='text'>사용하지 않는 서비스입니다.</p>", "c");

}

if ($item_code) {

    // 상품
    $dmshop_item = shop_item_code($item_code);

    // 상품이 없다.
    if (!$dmshop_item['id']) {

        message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "c");

    }

}

if (!$name) {

    message("<p class='title'>알림</p><p class='text'>발신자명을 입력하세요.</p>", "c");

}

if (!$email1) {

    message("<p class='title'>알림</p><p class='text'>발신자 이메일주소가 올바르지 않습니다.</p>", "c");

}

if (!$email2) {

    message("<p class='title'>알림</p><p class='text'>수신자 이메일주소가 올바르지 않습니다.</p>", "c");

}

if (!$title) {

    message("<p class='title'>알림</p><p class='text'>제목을 입력하세요.</p>", "c");

}

if (!$content) {

    message("<p class='title'>알림</p><p class='text'>내용을 입력하세요.</p>", "c");

}

$content = text2($content, 0);

ob_start();
include_once("./email_text.php");
$content = ob_get_contents();
ob_end_clean();

$to_email = $email2; // 받는사람
$title = $title; // 제목
$from_name = $name; // 보내는사람 이름
$from_email = $email1; // 보내는사람 이메일

// 발송
shop_email_send($to_email, $title, $content, $from_name, $from_email, "1");

message("<p class='title'>알림</p><p class='text'>전송하였습니다.</p>", "c");
?>