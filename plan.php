<?
include_once("./_dmshop.php");

if ($pl_id) { $pl_id = preg_match("/^[0-9]+$/", $pl_id) ? $pl_id : ""; }
if ($sort) { $sort = preg_match("/^[0-9]+$/", $sort) ? $sort : ""; }
if ($liststyle) { $liststyle = preg_match("/^[0-9]+$/", $liststyle) ? $liststyle : ""; }
if ($rows) { $rows = preg_match("/^[0-9]+$/", $rows) ? $rows : ""; }
if ($q) { $q = preg_match("/^[A-Za-z0-9_가-힣\x20\/\-\.!]+$/", $q) ? $q : ""; }
$q = addslashes(urlencode($q));
if (shop_is_utf8(urldecode($q))) { $q = urldecode($q); } else { $q = mb_convert_encoding(urldecode($q), 'UTF-8', 'CP949'); }

// 기획전 아이디가 없다.
if (!$pl_id) {

    $dmshop_plan_first = shop_plan_first();

    if ($dmshop_plan_first['id']) { 

        shop_url("?pl_id=".$dmshop_plan_first['id']);

    }

    message("<p class='title'>알림</p><p class='text'>진행중인 기획전이 없습니다.</p>", "b");

}

// 기획전 설정
$dmshop_plan = shop_plan($pl_id);

// 분류가 없다.
if (!$dmshop_plan['id']) {

    message("<p class='title'>알림</p><p class='text'>기획전이 삭제되었거나 존재하지 않습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

// 스킨이 없다.
if (!$dmshop_plan['skin']) {

    message("<p class='title'>알림</p><p class='text'>기획전 스킨이 설정되지 않았습니다.</p>", "b");

}

// 페이징 사용시 경로 설정
$href = "";

/*------------------------------
    ## 혜택검색 ##
------------------------------*/

$sql_search_icon = "";
$k = 0;
$icon = array();
$str = explode("|", $dmshop_plan['item_icon']);
for ($i=0; $i<count($str); $i++) {

    if ($str[$i]) {

        $row = shop_icon_file($str[$i]);

        if ($row['id']) {

            $icon[$k] = $row;

            $icon[$k]['checked'] = false;

            if ($ic[$k]) { $ic[$k] = preg_match("/^[0-9]+$/", $ic[$k]) ? $ic[$k] : ""; }
            if ($ic[$k]) {

                $icon[$k]['checked'] = true;

                if (!$sql_search_icon) {

                    $sql_search_icon .= " INSTR(item_icon, '|$ic[$k]|') ";

                } else {

                    $sql_search_icon .= " and INSTR(item_icon, '|$ic[$k]|') ";

                }

                $href .= "&ic[$k]=".$row['id'];

            }

            $k++;

        }

    }

}

/*------------------------------
    ## 상품검색 ##
------------------------------*/

// 출력갯수
$total_rows = (int)($dmshop_plan['item_width'] * $dmshop_plan['item_height']);

if (!$liststyle || $liststyle != '2') {

    $liststyle = "1";

}

if (!$sort) {

    $sort = "1";

}

// 검색조건 (3은 숨김)
$sql_search = " where item_use != '3' and plan_id = '".$pl_id."' ";

if ($q && $q != $query) {

    $sql_search .= " and (item_title LIKE '%".$q."%') ";

}

// 혜택 검색
if ($ic) {

    if ($sql_search_icon) {

        $sql_search_icon = " and (".$sql_search_icon.")";
        $sql_search .= $sql_search_icon;

    }

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[plan_item_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = $total_rows;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?pl_id=".$pl_id."&liststyle=".$liststyle."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q.$href."&page=");

if ($sort == '1') {

    $sql_sort = "position desc, datetime desc";

}

else if ($sort == '2') {

    $sql_sort = "datetime desc";

}

else if ($sort == '3') {

    $sql_sort = "item_sale desc, datetime desc";

}

else if ($sort == '4') {

    $sql_sort = "item_hit desc, datetime desc";

}

else if ($sort == '5') {

    $sql_sort = "item_title desc, datetime desc";

}

else if ($sort == '6') {

    $sql_sort = "item_reply desc, datetime desc";

}

else if ($sort == '7') {

    $sql_sort = "item_money asc, datetime desc";

}

else if ($sort == '8') {

    $sql_sort = "item_money desc, datetime desc";

} else {

    $sql_sort = "position desc, datetime desc";

}

$list = array();
$result = sql_query(" select * from $shop[plan_item_table] $sql_search order by $sql_sort limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    $dmshop_item = shop_item($row['item_id']);
    $list[$i]['item_option_use'] = $dmshop_item['item_option_use'];
    $list[$i]['item_limit'] = $dmshop_item['item_limit'];

}

// 스킨 경로
$dmshop_plan_path = "";
$dmshop_plan_path = $shop['path']."/skin/plan/".$dmshop_plan['skin'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_plan['title'];

// 페이지 아이디
$page_id = "plan";

if ($dmshop_plan['include_top']) { include($dmshop_plan['include_top']); } else { include_once("./_top.php"); }
include_once("$dmshop_plan_path/plan.php");
if ($dmshop_plan['include_bottom']) { include($dmshop_plan['include_bottom']); } else { include_once("./_bottom.php"); }
?>