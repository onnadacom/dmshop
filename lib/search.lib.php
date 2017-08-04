<?
if (!defined("_DMSHOP_")) exit;

/*--------------------------------
    ## 검색박스 ##
--------------------------------*/

function shop_searchbox_skin($skin="")
{

    global $shop;

    if (!$skin) {
        return false;
    }

    $dmshop_searchbox_path = "$shop[path]/skin/searchbox/$skin";

    ob_start();
    include("$dmshop_searchbox_path/searchbox.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}
?>