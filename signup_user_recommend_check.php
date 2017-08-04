<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }

if (!$user_id) {

    message("<p class='title'>알림</p><p class='text'>추천인아이디가 입력되지 않았습니다.</p>", "", "", false, true);

}

// 회원 정보
$user = shop_user($user_id);

if ($user['user_id']) {

    echo "<script type='text/javascript'>";
    echo "document.getElementById('user_recommend_message').innerHTML = \"<font color='#0000ff'>".$user_id." 아이디가 확인되었습니다.</font>\";";
    echo "document.getElementById('user_recommend_check').value = \"".$user_id."\";";
    echo "</script>";
    exit;

} else {

    echo "<script type='text/javascript'>";
    echo "document.getElementById('user_recommend_message').innerHTML = \"<font color='#ff0000'>".$user_id." 아이디는 존재하지 않습니다.</font>\";";
    echo "document.getElementById('user_recommend_check').value = \"\";";
    echo "document.getElementById('user_recommend').value = \"\";";
    echo "</script>";
    exit;

}
?>