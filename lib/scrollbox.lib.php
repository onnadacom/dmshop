<?
if (!defined("_DMSHOP_")) exit;

/*--------------------------------
    ## 스크롤박스 ##
--------------------------------*/

function shop_scrollbox_skin($skin="default")
{

    global $shop, $dmshop_user, $shop_user_login, $scrollbox_top;

    $dmshop_scrollbox_path = "$shop[path]/skin/scrollbox/$skin";

    ob_start();
    include("$dmshop_scrollbox_path/scrollbox.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}
?>