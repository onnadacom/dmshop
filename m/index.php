<?php // 메인
include_once("./_dmshop.php");

if (shop_get_session("pc_ver")) {

    unset($_SESSION['pc_ver']);

}

include_once("$shop[mobile_path]/_top.php");

// 검색조건 (3은 숨김)
$sql_search = " where item_use != '3' ";
$cnt = sql_fetch(" select count(*) as cnt from $shop[item_table] $sql_search ");

$total_count = $cnt['cnt'];
$rows = 30;
$total_page  = ceil($total_count / $rows);
if (!$page) { $page = 1; }
$from_record = ($page - 1) * $rows;
$shop_pages = shop_paging_v1("5", $page, $total_page, "?page=");
$list = array();
$result = sql_query(" select * from $shop[item_table] $sql_search order by item_position desc, datetime desc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

}

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

if (count($list) == 0) { echo "<div class='not'>등록된 상품이 없습니다.</div>"; }
?>
</div>
</div>
<? if ($i && $total_count > $rows) { ?>
<div class="page"><?=$shop_pages?></div>
<? } ?>
<?
include_once("$shop[mobile_path]/_bottom.php");
?>