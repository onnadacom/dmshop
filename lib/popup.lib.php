<?
if (!defined("_DMSHOP_")) exit;

/*--------------------------------
    ## 팝업 ##
--------------------------------*/

// 팝업
function shop_popup($popup_id)
{

    global $shop;

    if ($popup_id) { $popup_id = preg_match("/^[0-9]+$/", $popup_id) ? $popup_id : ""; }

    if (!$popup_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[popup_table] where id = '$popup_id' ");

}

// file 뷰
function shop_popup_view($datetime, $file, $width, $height, $image_width, $thumb)
{

    global $shop;
    static $ids;

    if (!$file) {

        return false;

    }

    $ids++;

    $source_width = (int)($width);
    $source_height = (int)($height);

    if ($image_width) {

        if ($width >= $image_width) {

            $style = "width:".$image_width."px;";

        }

    } else {

        $style = "";

    }

    // 원본
    $source = $shop['path']."/data/popup/".shop_data_path("u", $datetime)."/".$file;

    if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && $thumb) {

        return "<img src='{$thumb}' style='".$style."' border='0'>";

    }

    else if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file)) {

        return "<img src='{$source}' style='".$style."' border='0'>";

    }

    else if (preg_match("/\.(swf)$/i", $file)) {

        return "<script type='text/javascript'>shopFlash('{$source}', '_shop_{$ids}', '$width', '$height', 'transparent');</script>";

    }

    else if (preg_match("/\.(asx|asf|wmv|wma|mpg|mpeg|mov|avi|mp3)$/i", $file)) {

        return "<script type='text/javascript'>shopMovie('$source', '_shop_{$ids}', '$width', '$height');</script>";

    } else {

        return false;

    }

}

// 스킨 출력
function shop_popup_skin($skin)
{

    global $shop;

    $list = array();
    $result = sql_query(" select * from $shop[popup_table] where pop_view = '1' and pop_start <= '".$shop['time_ymdhis']."' and pop_end >= '".$shop['time_ymdhis']."' order by pop_position desc, id desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $list[$i] = $row;

        if ($row['pop_target']) {

            $list[$i]['target'] = "_blank";

        } else {

            $list[$i]['target'] = "_self";

        }

        $cookie_id = "popup_".$row['id'];
        if ($_COOKIE[$cookie_id] != 'ok') {

            sql_query(" update $shop[popup_table] set pop_hit = pop_hit + 1 where id = '".$row['id']."' ");

        }

    }

    $dmshop_popup_path = "$shop[path]/skin/popup/$skin";

    ob_start();
    include("$dmshop_popup_path/popup.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}
?>