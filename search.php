<?
include_once("./_dmshop.php");
if ($ct_id) { $ct_id = preg_match("/^[0-9]+$/", $ct_id) ? $ct_id : ""; }
if ($sort) { $sort = preg_match("/^[0-9]+$/", $sort) ? $sort : ""; }
if ($liststyle) { $liststyle = preg_match("/^[0-9]+$/", $liststyle) ? $liststyle : ""; }
if ($rows) { $rows = preg_match("/^[0-9]+$/", $rows) ? $rows : ""; }
if ($m1) { $m1 = preg_match("/^[0-9]+$/", $m1) ? $m1 : ""; }
if ($m2) { $m2 = preg_match("/^[0-9]+$/", $m2) ? $m2 : ""; }
if ($color) { $color = preg_match("/^[0-9]+$/", $color) ? $color : ""; }
if ($percent) { $percent = preg_match("/^[0-9]+$/", $percent) ? $percent : ""; }
if ($q) { $q = preg_match("/^[A-Za-z0-9_가-힣\x20\/\-\.!,]+$/", $q) ? $q : ""; }
$q = addslashes(urlencode(trim($q)));
if (shop_is_utf8(urldecode($q))) { $q = urldecode($q); } else { $q = mb_convert_encoding(urldecode($q), 'UTF-8', 'CP949'); }
if ($add) { $add = preg_match("/^[A-Za-z0-9_가-힣\x20\/\-\.!,]+$/", $add) ? $add : ""; }
$add = addslashes(urlencode(trim($add)));
if (shop_is_utf8(urldecode($add))) { $add = urldecode($add); } else { $add = mb_convert_encoding(urldecode($add), 'UTF-8', 'CP949'); }

// 스킨이 없다.
if (!$dmshop_skin['skin_search']) {

    message("<p class='title'>알림</p><p class='text'>검색 스킨이 설정되지 않았습니다.</p>", "b");

}

// 페이징 사용시 경로 설정
$href = "";

/*------------------------------
    ## 혜택검색 ##
------------------------------*/

$sql_search_icon = "";
$icon = array();
$result = sql_query(" select * from $shop[icon_file_table] where view = '1' order by position desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $icon[$i] = $row;

    $icon[$i]['checked'] = false;

    if ($ic[$i]) { $ic[$i] = preg_match("/^[0-9]+$/", $ic[$i]) ? $ic[$i] : ""; }
    if ($ic[$i]) {

        $icon[$i]['checked'] = true;

        if (!$sql_search_icon) {

            $sql_search_icon .= " INSTR(item_icon, '|$ic[$i]|') ";

        } else {

            $sql_search_icon .= " and INSTR(item_icon, '|$ic[$i]|') ";

        }

        $href .= "&ic[$i]=".$row['id'];

    }

}

/*------------------------------
    ## 상품검색 ##
------------------------------*/

// 출력갯수
$total_rows = 10;

if (!$sort) {

    $sort = "1";

}

// 검색조건 (3은 숨김)
$sql_search = " where item_use != '3' ";

if ($q && $q != $query) {

    $sql_search .= " and (item_title LIKE '%".$q."%' or item_keyword LIKE '%".$q."%') ";

}

// 분류
if ($ct_id) {

    // 분류 설정
    $dmshop_category = shop_category($ct_id);

    // 분류가 없다.
    if (!$dmshop_category['id']) {

        message("<p class='title'>알림</p><p class='text'>상품분류가 삭제되었거나 존재하지 않습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

    }

    $sql_search .= " and (category1 = '$ct_id' or category2 = '$ct_id' or category3 = '$ct_id' or category4 = '$ct_id') ";

}

// 시작가
if ($m1) {

    $sql_search .= " and item_money >= '".$m1."' ";

}

// 최고가
if ($m2) {

    $sql_search .= " and item_money <= '".$m2."' ";

}

// 혜택 검색
if ($ic) {

    if ($sql_search_icon) {

        $sql_search_icon = " and (".$sql_search_icon.")";
        $sql_search .= $sql_search_icon;

    }

}

// 색상 검색
if ($color && !$percent) { $percent = "10"; }
if ($color && $color >= '1' && $color <= '21' && $percent) {

    $sql_search .= " and color{$color} >= '".$percent."' ";

}

// 결과내 재검색
if ($add && $q) {

    $add = preg_replace("/(,$q)$/", "", $add);
    $add = preg_replace("/^($q)$/", "", $add);
    $add = preg_replace("/^($q),/", "", $add);
    $add = $add.",".$q;

    $k = 0;
    $sql_add = " and (";
    $str = explode(",", trim($add));
    for ($i=0; $i<count($str); $i++) {

        if ($str[$i]) {

            if ($k == '0') {

                $sql_add .= " item_title LIKE '%$str[$i]%' ";

            } else {

                $sql_add .= " and item_title LIKE '%$str[$i]%' ";

            }

            $k++;

        }

    }

    $sql_add .= ") ";

    if ($k) {

        $sql_search .= $sql_add;

    }

} else {
// 체크해제시 변수 초기화

    //$add = $q;
    $add = "";

}

// 첫자리에 콤마가 온다면 초기화
$add = preg_replace("/^(,)/", "", $add);

// 1차 분류를 뽑아낸다
$total_category = 0;
$category1 = array();
$category2 = array();
$result = sql_query(" select *, count(*) as count from $shop[item_table] $sql_search group by category1 order by count desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $total_category++;

    $category1[$i] = $row;
    $category1[$i]['subject'] = shop_category_name($row['category1']);
    $category1[$i]['ct_id'] = $row['category1'];

    // 2차 분류를 뽑아낸다
    $result2 = sql_query(" select *, count(*) as count from $shop[item_table] $sql_search and category1 = '".$row['category1']."' and category2 != '0' group by category2 order by count desc ");
    for ($i2=0; $row2=sql_fetch_array($result2); $i2++) {

        $total_category++;

        $category2[$i][$i2] = $row2;
        $category2[$i][$i2]['subject'] = shop_category_name($row2['category2']);
        $category2[$i][$i2]['ct_id'] = $row2['category2'];

    }

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[item_table] $sql_search ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = $total_rows;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?ct_id=".$ct_id."&m1=".$m1."&m2=".$m2."&cv=".$cv."&color=".$color."&percent=".$percent."&add=".$add."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q.$href."&page=");

if ($sort == '1') {

    $sql_sort = "item_position desc, datetime desc";

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

    $sql_sort = "item_position desc, datetime desc";

}

$list = array();
$result = sql_query(" select * from $shop[item_table] $sql_search order by $sql_sort limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

}

// 스킨 경로
$dmshop_search_path = "";
$dmshop_search_path = $shop['path']."/skin/search/".$dmshop_skin['skin_search'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 검색 : ".$q;

// 페이지 아이디
$page_id = "search";

include_once("./_top.php");
include_once("$dmshop_search_path/search.php");
include_once("./_bottom.php");
?>