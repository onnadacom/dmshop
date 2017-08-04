<?php
if (!defined("_DMSHOP_")) exit;

/*--------------------------------
    ## 배너 ##
--------------------------------*/

// 배너 그룹
function shop_banner_group($group_id)
{

    global $shop;

    if ($group_id) { $group_id = preg_match("/^[a-zA-Z0-9_\-]+$/", $group_id) ? $group_id : ""; }

    if (!$group_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[banner_group_table] where group_id = '$group_id' ");

}

// 배너 그룹 카운트
function shop_banner_group_count($group_id)
{

    global $shop;

    if ($group_id) { $group_id = preg_match("/^[a-zA-Z0-9_\-]+$/", $group_id) ? $group_id : ""; }

    if (!$group_id) {

        return false;

    }

    $data = sql_fetch(" select count(*) as total_count from $shop[banner_table] where group_id = '$group_id' ");

    if ($data['total_count']) {

        return $data['total_count'];

    } else {

        return false;

    }

}

// 배너
function shop_banner($banner_id)
{

    global $shop;

    if ($banner_id) { $banner_id = preg_match("/^[0-9]+$/", $banner_id) ? $banner_id : ""; }

    if (!$banner_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[banner_table] where id = '$banner_id' ");

}

// file 뷰
function shop_banner_view($datetime, $file, $width, $height, $image_width, $thumb)
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
    $source = $shop['path']."/data/banner/".shop_data_path("u", $datetime)."/".$file;

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

// 배너 스킨 출력
function shop_banner_skin($this_id, $skin, $group_id, $banner_id, $count_width, $count_height, $rolling, $time, $order)
{

    global $shop, $display, $display_id, $display_type, $display_list;

    if ($group_id) { $group_id = preg_match("/^[a-zA-Z0-9_\-]+$/", $group_id) ? $group_id : ""; }
    if ($banner_id) { $banner_id = preg_match("/^[a-zA-Z0-9_\-]+$/", $banner_id) ? $banner_id : ""; }

    $sql_search = " where ba_view = '1' ";

    if ($group_id) {

        $sql_search .= " and group_id = '".$group_id."' ";

    }

    if ($banner_id) {

        $sql_search .= " and id = '".$banner_id."' ";

    }

    if (!$rolling) {

        $rolling = 1;

    }

    if (!$time) {

        $time = 0;

    }

    if (!$count_width) {

        $count_width = 1;

    }

    if (!$count_height) {

        $count_height = 1;

    }

    $count = (int)($count_width * $count_height);
    $limit = (int)($count_width * $count_height * $rolling);

    $list = array();
    $k = 0;
    $n = 0;
    $result = sql_query(" select * from $shop[banner_table] $sql_search order by $order limit 0, $limit ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $k++;

        // 1개일 때
        if ($k == '1') {

            $n++;
            $rolling_max = $n;

            // 시작점 지정
            $rolling_start[$n] = $i;

        }

        // 도달
        if ($k >= $count) {

            // 리셋
            $k = 0;

        }

        // 종료점 지정
        $rolling_end[$n] = $i;

        $list[$i] = $row;

        if ($row['ba_target']) {

            $list[$i]['target'] = "_blank";

        } else {

            $list[$i]['target'] = "_self";

        }

        $ss_name = "banner_hit_".$row['id'];
        if (!shop_get_session($ss_name)) {

            sql_query(" update $shop[banner_table] set ba_hit = ba_hit + 1 where id = '".$row['id']."' ");

            shop_set_session($ss_name, true);

        }

    }

    if (!$rolling_max) {

        $rolling_max = 0;

    }

    $dmshop_banner_path = "$shop[path]/skin/banner/$skin";

    ob_start();
    include("$dmshop_banner_path/banner.php");
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;

}
?>