<?php
include_once("./_dmshop.php");

$percent = 10;

if ($color) { $color = preg_match("/^[0-9]+$/", $color) ? $color : ""; }
if ($percent) { $percent = preg_match("/^[0-9]+$/", $percent) ? $percent : ""; }
if ($m1) { $m1 = preg_match("/^[0-9]+$/", $m1) ? $m1 : ""; }
if ($m2) { $m2 = preg_match("/^[0-9]+$/", $m2) ? $m2 : ""; }
if ($ct_id) { $ct_id = preg_match("/^[0-9]+$/", $ct_id) ? $ct_id : ""; }
if ($sort) { $sort = preg_match("/^[0-9]+$/", $sort) ? $sort : ""; }
if ($liststyle) { $liststyle = preg_match("/^[0-9]+$/", $liststyle) ? $liststyle : ""; }
if ($rows) { $rows = preg_match("/^[0-9]+$/", $rows) ? $rows : ""; }
if ($q) { $q = preg_match("/^[A-Za-z0-9_가-힣\x20\/\-\.!]+$/", $q) ? $q : ""; }
$q = addslashes(urlencode($q));
if (shop_is_utf8(urldecode($q))) { $q = urldecode($q); } else { $q = mb_convert_encoding(urldecode($q), 'UTF-8', 'CP949'); }

// 분류 아이디가 없다.
if (!$ct_id) {

    message("<p class='title'>알림</p><p class='text'>상품분류가 삭제되었거나 존재하지 않습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

// 분류 설정
$dmshop_category = shop_category($ct_id);

// 분류가 없다.
if (!$dmshop_category['id']) {

    message("<p class='title'>알림</p><p class='text'>상품분류가 삭제되었거나 존재하지 않습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

}

// 페이징 사용시 경로 설정
$href = "";

/*------------------------------
    ## 카테고리 ##
------------------------------*/

// 하위 체크
$chk = sql_fetch(" select * from $shop[category_table] where category != '1' and view = '1' and code = '".$ct_id."' ");

// 있으면
if ($chk['id']) {

    $sql_search = " where category != '1' and view = '1' and code = '".$ct_id."' ";

} else {

    $sql_search = " where category != '1' and view = '1' and code = '".$dmshop_category['code']."' ";

}

$category = array();
$result = sql_query(" select * from $shop[category_table] $sql_search order by position asc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $category[$i] = $row;

}

/*------------------------------
    ## 혜택검색 ##
------------------------------*/

$sql_search_icon = "";
$k = 0;
$icon = array();
$str = explode("|", $dmshop_category['item_icon']);
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
$total_rows = (int)($dmshop_category['item_width'] * $dmshop_category['item_height']);

if (!$liststyle || $liststyle != '2') {

    $liststyle = "1";

}

if (!$sort) {

    $sort = "1";

}

// 검색조건 (3은 숨김)
$sql_search = " where item_use != '3' and category".$dmshop_category['category']." = '".$ct_id."' ";

if ($q && $q != $query) {

    $sql_search .= " and (item_title LIKE '%".$q."%' or item_keyword LIKE '%".$q."%') ";

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

$sql_money = "";

// 시작가
if ($m1) {

    $sql_money .= " and item_money >= '".$m1."' ";

}

// 최고가
if ($m2) {

    $sql_money .= " and item_money <= '".$m2."' ";

}

$cnt = sql_fetch(" select count(*) as cnt from $shop[item_table] $sql_search $sql_money ");

$total_count = $cnt['cnt'];

if (!$rows) {

    $rows = $total_rows;

}

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("5", $page, $total_page, "?color=".$color."&percent=".$percent."&m1=".$m1."&m2=".$m2."&ct_id=".$ct_id."&liststyle=".$liststyle."&sort=".$sort."&rows=".$rows."&f=".$f."&q=".$q.$href."&page=");

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
$result = sql_query(" select * from $shop[item_table] $sql_search $sql_money order by $sql_sort limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

}

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_category['subject'];
include_once("./_top.php");

// 썸네일 가로세로
$thumb_width = 400;
$thumb_height = 400;
?>
<style type="text/css">
.wrap {margin:10px 10px 0 0;}
.container {font-size:0; line-height:0;}
.container:after {display:block; clear:both; content:'';}
.container p {margin:0px; padding:0px;}
.container .sizer,
.container .item {width:20%; float:left;}
.container .item .block {margin:0 0 20px 10px; position:relative; background-color:#ffffff;}
.container .item .thumb {overflow:hidden;}
.container .item .thumb img {width:100%; border:0;}
.container .title {margin-top:5px; text-align:center; vertical-align:middle;}
.container .title a {font-weight:400; line-height:15px; font-size:12px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
.container .money {margin-top:2px; text-align:center; font-weight:400; line-height:15px; font-size:11px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
.container .not {width:100%; text-align:center; font-weight:400; line-height:200px; font-size:12px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}

.page {clear:both; width:100%; padding:20px 0 30px 0;}
.page table {margin:0 auto;}

@media screen and (max-width:960px) {

.container .sizer,
.container .item {width:33.333%;}

}

@media screen and (max-width:640px) {

.container .sizer,
.container .item {width:50%;}

}
</style>
<script type="text/javascript">
$(document).ready( function() {

    var $grid = $('.container').imagesLoaded( function() {

      $grid.masonry({
        columnWidth: '.sizer',
        itemSelector: '.item',
        percentPosition: true
      });

    });

});
</script>
<div class="wrap">
<div class="container">
<div class="sizer"></div>
<?
$html = "";
for ($i=0; $i<count($list); $i++) {

    // 상품 페이지
    $list[$i]['href'] = "item.php?ct_id=".$ct_id."&amp;id=".$list[$i]['item_code'];

    $thumb = shop_item_thumb($list[$i]['id'], "category", "default", $thumb_width, $thumb_height, 2);

    if ($thumb) {

        $img = "<a href='".$list[$i]['href']."'><img src='".$thumb."'></a>";

    } else {

        $img = "<a href='".$list[$i]['href']."'><img src='".$shop['mobile_url']."/img/blank.gif'></a>";

    }

    $html .= "<div class='item'>";
    $html .= "<div class='block'>";
    $html .= "<p class='thumb'>".$img."</p>";
    $html .= "<p class='title'><a href='".$list[$i]['href']."'>".text($list[$i]['item_title'])."</a></p>";
    $html .= "<p class='money'>".number_format($list[$i]['item_money'])."</p>";
    $html .= "</div>";
    $html .= "</div>\n";

}

echo $html;
?>
</div>
</div>
<?
if (count($list) == 0) { echo "<div class='not'>등록된 상품이 없습니다.</div>"; }
?>
<? if ($i && $total_count > $rows) { ?>
<div class="page"><?=$shop_pages?></div>
<? } ?>
<?
include_once("./_bottom.php");
?>