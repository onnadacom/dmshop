<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

// 스킨이 없다.
if (!$dmshop_skin['skin_item']) {

    message("<p class='title'>알림</p><p class='text'>상품 스킨이 설정되지 않았습니다.</p>", "", "", false, true);

}

// 스킨 경로
$dmshop_item_path = "";
$dmshop_item_path = $shop['path']."/skin/item/".$dmshop_skin['skin_item'];

// 설정
$dmshop_design_item = shop_design_item();

// 관련상품 이미지
if ($dmshop_design_item['image_relation_use'] == '0') { $thumb_width = shop_split("|", $dmshop_design_item['image_relation'], "0"); $thumb_height = shop_split("|", $dmshop_design_item['image_relation'], "1"); } else { $thumb_width = $dmshop_design_item['image_relation_width']; $thumb_height = $dmshop_design_item['image_relation_height']; }

$k = 0;
$relation_html = "";
$result = sql_query(" select * from $shop[relation_table] where item_id = '".$item_id."' order by id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $k++;

    // 상품 정보
    $dmshop_item = shop_item($row['item_add_id']);

    // 링크
    $item_link = $shop['path']."/item.php?id=".$dmshop_item['item_code'];

    $thumb = "";
    $thumb = shop_item_thumb($row['item_add_id'], "default", "default", $thumb_width, $thumb_height, "2");

    if ($thumb) {

        $img = "<img src='".$thumb."' width='".$thumb_width."' height='".$thumb_height."' border='0'>";

    } else {

        $img = "<img src='".$dmshop_item_path."/img/noimage.gif' border='0'>";

    }

    $relation_html .= "<li><div style='width:".$thumb_width."px;'>";
    $relation_html .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td><a href='".$item_link."'>".$img."</a></td></tr></table>";
    $relation_html .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td height='5'></td></tr></table>";
    $relation_html .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td><a href='".$item_link."' class='item_relation_title'>".$dmshop_item['item_title']."</a></td></tr></table>";
    $relation_html .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td height='5'></td></tr></table>";
    $relation_html .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td><span class='item_relation_money'>".number_format($dmshop_item['item_money'])."</span></td></tr></table>";
    $relation_html .= "</div></li>";

}

$visible = $k;

if ($visible > $dmshop_design_item['item_relation']) {

    $visible = $dmshop_design_item['item_relation'];

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($k > $dmshop_design_item['item_relation']) { ?>
    <td class="btn_prev"></td>
<? } else { ?>
    <td class="btn_prev_out"></td>
<? } ?>
    <td><div class="relation_list"><ul><?=$relation_html?></ul></div></td>
<? if ($k > $dmshop_design_item['item_relation']) { ?>
    <td class="btn_next"></td>
<? } else { ?>
    <td class="btn_next_out"></td>
<? } ?>
</tr>
</table>

<script type="text/javascript">
$(document).ready(function() {

    $(".relation_list").jCarouselLite({
        btnNext: ".relation_box .btn_next",
        btnPrev: ".relation_box .btn_prev",
        speed: 300,
        circular: false,
        visible: <?=(int)($visible);?>
    });

    $(".relation_list img").mouseover(function() {
        $(this).addClass("on");
    }).mouseout(function(){
        $(this).removeClass("on");
    });

});
</script>