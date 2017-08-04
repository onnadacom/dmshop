<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($user_name) { $user_name = preg_match("/^[A-Za-z0-9_가-힣\x20]+$/", $user_name) ? $user_name : ""; }
if ($user_email) { $user_email = preg_match("/^[A-Za-z0-9_@\-\.]+$/", $user_email) ? $user_email : ""; }

// 회원
if ($shop_user_login) {

    shop_url("$shop[path]");

}

// 스킨이 없다.
if (!$dmshop_skin['skin_find']) {

    message("<p class='title'>알림</p><p class='text'>스킨이 설정되지 않았습니다.</p>", "", "", false, true);

}

// 스킨 경로
$dmshop_find_path = "";
$dmshop_find_path = $shop['path']."/skin/find/".$dmshop_skin['skin_find'];

if (!$user_name) {

    message("<p class='title'>알림</p><p class='text'>성명이 입력되지 않았습니다. 한글, 영문, 숫자만 가능합니다.</p>", "", "", false, true);

}

if (!$user_email) {

    message("<p class='title'>알림</p><p class='text'>이메일이 입력되지 않았습니다. 영문, 숫자만 가능합니다.</p>", "", "", false, true);

}

$user = sql_fetch(" select * from $shop[user_table] where user_name = '".addslashes($user_name)."' and user_email = '".addslashes($user_email)."' ");

if ($user['user_id']) {

    echo "<div class='find_id_ok'><div>회원님의 아이디를 찾았습니다.</div></div>";

    echo "<script type=\"text/javascript\">";
    echo "document.getElementById(\"find_id_message\").style.display = \"inline\";";
    echo "document.getElementById(\"user_name\").style.backgroundColor = \"#fffee9\";";
    echo "document.getElementById(\"user_email\").style.backgroundColor = \"#fffee9\";";
    echo "document.getElementById(\"user_name\").value = \"".$user['user_id']."\";";
    echo "document.getElementById(\"user_email\").value = \"".date("Y년 m월 d일", strtotime($user['datetime']))."\";";
    echo "document.getElementById(\"find_name\").src = \"".$dmshop_find_path."/img/id.gif\";";
    echo "document.getElementById(\"find_email\").src = \"".$dmshop_find_path."/img/date.gif\";";
    echo "document.getElementById(\"find_btn\").innerHTML = \"<a href='".$shop['path']."/signin.php'><img src='".$dmshop_find_path."/img/login.gif' border='0'></a>\";";
    echo "</script>";

} else {

    echo "<div class='find_id_not'><div>아이디를 찾을 수 없습니다. 다시 입력 하세요.</div></div>";

    echo "<script type='text/javascript'>";
    echo "document.getElementById('find_id_message').style.display = \"inline\";";
    echo "</script>";

}
?>