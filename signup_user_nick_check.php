<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($user_nick) { $user_nick = preg_match("/^[A-Za-z0-9_가-힣\x20\-]+$/", $user_nick) ? $user_nick : ""; }

if (!$user_nick) {

    message("<p class='title'>알림</p><p class='text'>닉네임은 한글, 영문, 숫자만 입력이 가능합니다.</p>", "", "", false, true);

}

// 닉네임 검사
$user = shop_user_nick($user_nick);

if ($user['user_nick']) {

    echo "<script type='text/javascript'>";
    echo "document.getElementById('user_nick_message').innerHTML = \"<font color='#ff0000'>".text($user_nick)." 닉네임은 이미 사용 중입니다.</font>\";";
    echo "document.getElementById('user_nick_check').value = \"\";";
    echo "</script>";
    exit;

} else {

    echo "<script type='text/javascript'>";
    echo "document.getElementById('user_nick_message').innerHTML = \"<font color='#0000ff'>".text($user_nick)." 닉네임은 사용하실 수 있습니다.</font>\";";
    echo "document.getElementById('user_nick_check').value = \"".text($user_nick)."\";";
    echo "</script>";
    exit;

}
?>