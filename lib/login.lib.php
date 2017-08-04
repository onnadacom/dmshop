<?php
if (!defined("_DMSHOP_")) exit;

/*--------------------------------
    ## 로그인 ##
--------------------------------*/

function shop_loginbox_skin($skin="default")
{

    global $shop, $dmshop, $dmshop_user, $shop_user_login, $shop_user_admin, $urlencode;

    $dmshop_loginbox_path = "$shop[path]/skin/loginbox/$skin";

    $user_icon = "";
    if ($shop_user_login) {

        // 레벨 아이콘
        $file = shop_user_level_file($dmshop_user['user_level']);

        // 파일 경로
        $file_path = $shop['path']."/data/user_level/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

        // 파일이 있다면
        if (file_exists($file_path) && $file['upload_file']) {

            $user_icon = $file_path;

        }

        // 쿠폰
        $dmshop_coupon = sql_fetch(" select count(*) as total_count from $shop[coupon_list_table] where user_id = '".$dmshop_user['user_id']."' and coupon_date2 >= '".$shop['time_ymd']."' and coupon_mode in (0,1) ");

    } else {

        // 아이디 자동저장
        $user_id_save = "";
        $user_id_save = shop_get_cookie("user_id_save");

        if ($user_id_save) {

            $user_id_save = text($user_id_save);
            $user_id_save_checked = "checked";

        }

    }

    ob_start();
    if ($shop_user_login) {
        include("$dmshop_loginbox_path/loginbox2.php");
    } else {
        include("$dmshop_loginbox_path/loginbox1.php");
    }
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}
?>