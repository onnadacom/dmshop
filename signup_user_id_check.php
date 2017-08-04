<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }

if (!$user_id) {

    message("<p class='title'>알림</p><p class='text'>회원 아이디는 영문, 숫자만 입력이 가능합니다.</p>", "", "", false, true);

}

// 회원 정보
$user = shop_user($user_id);

if ($user['user_id']) {

    echo "<script type='text/javascript'>";
    echo "document.getElementById('user_id_message').innerHTML = \"<font color='#ff0000'>".$user_id." 아이디는 이미 사용 중입니다.</font>\";";
    echo "document.getElementById('user_id_check').value = \"\";";
    echo "</script>";
    exit;

} else {

    echo "<script type='text/javascript'>";
    echo "document.getElementById('user_id_message').innerHTML = \"<font color='#0000ff'>".$user_id." 아이디는 사용하실 수 있습니다.</font>\";";
    echo "document.getElementById('user_id_check').value = \"".$user_id."\";";
    echo "</script>";
    exit;

}
?>