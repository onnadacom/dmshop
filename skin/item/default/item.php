<?php
if (!defined('_DMSHOP_')) exit;

// 상품 옵션 사용
if ($dmshop_item['item_option_use']) {

    $item_order_option_first_id = "";
    $item_order_option_list = "";
    $item_order_option_select = "";
    $result = sql_query(" select * from $shop[item_option_table] where item_id = '".$dmshop_item['id']."' and option_mode = '1' order by option_position asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        if ($row['id']) {

            // 첫번째
            if ($i == '0') {

                // 아이디 지정
                $item_order_option_first_id = $row['id'];

            }

            $item_order_option_list .= "var item_option_".$row['id']."_name = '".addslashes($row['option_name'])."';\n";
            $item_order_option_list .= "var item_option_".$row['id']."_money = '".$row['option_money']."';\n";
            $item_order_option_list .= "var item_option_".$row['id']."_limit = '".$row['option_limit']."';\n";

            $item_order_option_select .= "<option value='".$row['id']."'>";
            $item_order_option_select .= $row['option_name'];

            // 금액이 있다면
            if ($row['option_money']) {

                if ($row['option_money'] > 0) {

                    $item_order_option_select .= " (+".number_format($row['option_money'])."원)";

                }

                else if ($row['option_money'] < 0) {

                    $item_order_option_select .= " (".number_format($row['option_money'])."원)";

                }

            }

            $item_order_option_select .= " : 남은수량 ".number_format($row['option_limit'])."개";
            $item_order_option_select .= "</option>";

        }

    }

}

include_once("$dmshop_item_path/item.css.php");
?>

<? if ($shop_user_admin) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div style="border:1px solid #b4d9e0; background-color:#e2fdff; text-align:center; padding:4px 0 3px 0;"><a href="<?=$shop['path']?>/adm/item_write.php?m=u&item_id=<?=$dmshop_item['id']?>"><span style="font-weight:bold; line-height:14px; font-size:12px; color:#027d94; font-family:dotum,돋움;">관리자 권한으로 현재 상품을 수정 합니다.</span></a></div></td>
</tr>
<tr><td height="10"></td></tr>
</table>
<? } ?>

<!--[if IE 6]>
<script type="text/javascript">
/* IE6 PNG 배경투명 */
DD_belatedPNG.fix('.star0');
DD_belatedPNG.fix('.star1');
DD_belatedPNG.fix('.star2');
DD_belatedPNG.fix('.star3');
DD_belatedPNG.fix('.star4');
DD_belatedPNG.fix('.star5');
DD_belatedPNG.fix('.smile0');
DD_belatedPNG.fix('.smile1');
</script>
<![endif]-->

<script type="text/javascript">
function itemGallery(id, upload_mode)
{

    shopOpen(shop_path+"/item_gallery.php?id="+id+"&upload_mode="+upload_mode, "galleryOpen", "width=950, height=670, scrollbars=yes");

}
</script>

<div style="border:1px solid #efefef; background-color:#ffffff;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="item_position">
<tr height="30" bgcolor="#f7f7f7">
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
echo "<td><a href='".$shop['path']."/' class='home'>홈</a></td>";

$item_category = $dmshop_item['category1']."|".$dmshop_item['category2']."|".$dmshop_item['category3']."|".$dmshop_item['category4'];

if ($dmshop_item['category1'] || $dmshop_item['category2'] || $dmshop_item['category3'] || $dmshop_item['category4']) {

    $str = explode("|", $item_category);

    for ($i=0; $i<count($str); $i++) {

        if ($str[$i]) {

            echo "<td width='20' align='center'><img src='".$dmshop_item_path."/img/arrow.gif' class='up1'></td>";
            echo "<td><a href='".$shop['path']."/list.php?ct_id=".$str[$i]."' class='off'>".shop_category_name($str[$i])."</a></td>";

        }

    }

}
?>
</tr>
</table>
    </td>
    <td width="130" align="right"><span class="title">상품번호 :</span> <span class="code"><?=$id?></span></td>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<?
// 분류가 있을 때
if ($ct_id) {

    // 이전, 다음
    $dmshop_item_prev = sql_fetch(" select * from $shop[item_table] where category".$dmshop_category['category']." = '".$ct_id."' and id > '".$dmshop_item['id']."' order by id asc ");
    $dmshop_item_next = sql_fetch(" select * from $shop[item_table] where category".$dmshop_category['category']." = '".$ct_id."' and id < '".$dmshop_item['id']."' order by id desc ");

} else {
// 없을 때

    // 이전, 다음
    $dmshop_item_prev = sql_fetch(" select * from $shop[item_table] where id > '".$dmshop_item['id']."' order by id asc ");
    $dmshop_item_next = sql_fetch(" select * from $shop[item_table] where id < '".$dmshop_item['id']."' order by id desc ");

}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="item_next">
<tr height="20">
    <td>&nbsp;</td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="60" align="center"><? if ($dmshop_item_prev['item_code']) { ?><a href="?ct_id=<?=$ct_id?>&id=<?=$dmshop_item_prev['item_code']?>">이전상품</a><? } else { ?><a href="#" onclick="alert('이전상품이 없습니다.'); return false;">이전상품</a><? } ?></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="2"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="60" align="center"><? if ($dmshop_item_next['item_code']) { ?><a href="?ct_id=<?=$ct_id?>&id=<?=$dmshop_item_next['item_code']?>">다음상품</a><? } else { ?><a href="#" onclick="alert('다음상품이 없습니다.'); return false;">다음상품</a><? } ?></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="5"></td>
</tr>
<tr height="1">
    <td></td>
    <td bgcolor="#efefef"></td>
    <td bgcolor="#efefef"></td>
    <td bgcolor="#efefef"></td>
    <td></td>
    <td bgcolor="#efefef"></td>
    <td bgcolor="#efefef"></td>
    <td bgcolor="#efefef"></td>
    <td></td>
</tr>
</table>

<div style="padding:10px 30px 20px 30px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="<?=$dmshop_design_item['image_default_width']?>" valign="top">
<!-- 상품 이미지 start //-->
<?
$thumb = shop_item_thumb($dmshop_item['id'], "default", "", $dmshop_design_item['image_default_width'], $dmshop_design_item['image_default_height'], shop_thumb_type($dmshop_design_item['thumb_type']));

// noimage
if ($thumb) { $image_default = true; } else { $image_default = false; $thumb = $dmshop_item_path."/img/noimage.gif"; }
?>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr <? if (!$dmshop_design_item['thumb_type']) { echo "width='".$dmshop_design_item['image_default_width']."' height='".(int)($dmshop_design_item['image_default_height'] + ($dmshop_design_item['image_default1_border'] * 2))."'"; } ?>>
<? if ($image_default) { ?>
    <td align="center" valign="middle"><a id="image_default_zoom" name="default" rel="zoomWidth:<?=$dmshop_design_item['image_default_width']?>, zoomHeight:<?=$dmshop_design_item['image_default_height']?>, adjustX:0, adjustY:0, position:'inside'" class='cloud-zoom' href="<?=shop_item_file_path($dmshop_item['id'], "default");?>" onclick="return false;"><img src="<?=$thumb?>" border="0" id="image_default" alt="" ></a></td>
<? } else { ?>
    <td style='background-color:#fafafa; width:<?=$dmshop_design_item['image_default_width']?>px; height:<?=$dmshop_design_item['image_default_height']?>px; text-align:center;'><img src="<?=$thumb?>"></td>
<? } ?>
</tr>
</table>

<?
// 상품 갤러리 사용
if ($dmshop_design_item['item_gallery']) {

    $k = 0;
    $gallery_thumb_html = "";
    $result = sql_query(" select * from $shop[item_file_table] where item_id = '".$dmshop_item['id']."' and substring(upload_mode,1,7) = 'gallery' order by upload_mode asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $thumb = "";
        $thumb = shop_item_thumb($dmshop_item['id'], $row['upload_mode'], "", $dmshop_design_item['image_gallery_thumb_width'], $dmshop_design_item['image_gallery_thumb_height'], "2");

        $thumb_large = "";
        $thumb_large = shop_item_thumb($dmshop_item['id'], $row['upload_mode'], "", $dmshop_design_item['image_default_width'], $dmshop_design_item['image_default_height'], "2");

        $file_path = "";
        if ($row['upload_file']) {

            // 파일 경로
            $file_path = $shop['path']."/data/item/".shop_data_path("u", $row['datetime'])."/".$row['upload_file'];

            // 파일이 있다면
            if (!file_exists($file_path) && !$row['upload_file']) {

                $file_path = "";

            }

        }

        if ($thumb) {

            $k++;

            $gallery_thumb_html .= "<li name='".$row['upload_mode']."'><img rel='".$file_path."' alt='' src='".$thumb."' width='".$dmshop_design_item['image_gallery_thumb_width']."' height='".$dmshop_design_item['image_gallery_thumb_height']."' border='0' onclick=\"itemGallery('".$id."', '".$row['upload_mode']."'); return false;\" name='".$thumb_large."'></li>";

        }

    }

    $visible = $k;

    if ($visible) {

        if ($visible > $dmshop_design_item['item_gallery']) {

            $visible = $dmshop_design_item['item_gallery'];

        }
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f4f4f4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="item_gallery">
<tr>
<? if ($k > $dmshop_design_item['item_gallery']) { ?>
    <td class="btn_prev"></td>
<? } else { ?>
    <td class="btn_prev_out"></td>
<? } ?>
    <td><div class="gallery_thumb"><ul><?=$gallery_thumb_html?></ul></div></td>
<? if ($k > $dmshop_design_item['item_gallery']) { ?>
    <td class="btn_next"></td>
<? } else { ?>
    <td class="btn_next_out"></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f4f4f4" class="none">&nbsp;</td></tr>
</table>

<script type="text/javascript">
$(function() {

    $("#image_default_zoom").click(function() {

        itemGallery('<?=$id?>', $(this).attr("name"));

    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {

    $("#image_default_zoom").mouseover(function() {
        $(this).addClass("on");
    }).mouseout(function(){
        $(this).removeClass("on");
    });

    $(".gallery_thumb").jCarouselLite({
        btnNext: ".item_gallery .btn_next",
        btnPrev: ".item_gallery .btn_prev",
        speed: 300,
        circular: false,
        visible: <?=(int)($visible);?>
    });

    $(".gallery_thumb img").mouseover(function() {
        $("#image_default_zoom").attr("href", $(this).attr("rel"));
<? if ($dmshop_design_item['smart_zoom']) { ?>
        cloudZoom();
<? } ?>
        $("#image_default").attr("src", $(this).attr("name"));
        $("#image_default_zoom").attr("name", $(this).parent().attr("name"));

        $(this).addClass("on");
    }).mouseout(function(){
        $(this).removeClass("on");
    });

});
</script>
<? } ?>
<? } ?>

<? if ($dmshop_design_item['smart_zoom']) { ?>
<link rel="stylesheet" type="text/css" href="<?=$shop['path']?>/css/cloud-zoom.css" />
<script type="text/javascript" src="<?=$shop['path']?>/js/cloud-zoom.1.0.2.min.js"></script>

<script type="text/javascript">
function cloudZoom()
{

    $('.cloud-zoom').CloudZoom();

}
</script>
<? } ?>
<!-- 상품 이미지 end //-->
    </td>
    <td width="50"></td>
    <td valign="top" class="item_information">
<!-- 상품 정보 박스 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="item_title"><?=$dmshop_item['item_title']?></td>
</tr>
</table>

<? if ($dmshop_item['item_icon']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=shop_icon_view($dmshop_item['item_icon'])?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<? if ($dmshop_design_item['buy_use1'] && $dmshop_item['item_price']) { ?>
<tr height="30">
    <td width="60" class="item_subtitle">시중가 :</td>
    <td class="item_price"><?=number_format($dmshop_item['item_price']);?></td>
</tr>
<? } ?>
<? if ($dmshop_design_item['buy_use1'] && $dmshop_item['item_price']) { ?><tr height="1" bgcolor="#f4f4f4"><td colspan="2"></td></tr><? } ?>
<? if ($dmshop_design_item['buy_use2']) { ?>
<tr height="30">
    <td width="60" class="item_subtitle">판매가 :</td>
    <td class="item_money"><?=number_format($dmshop_item['item_money']);?> 원</td>
</tr>
<tr height="1" bgcolor="#f4f4f4"><td colspan="2"></td></tr>
<? } ?>
<? if ($dmshop_design_item['buy_use3'] && $dmshop_item['item_cash']) { ?>
<tr height="30">
    <td width="60" class="item_subtitle">적립금 :</td>
    <td class="item_cash"><?=number_format($dmshop_item['item_cash']);?> P</td>
</tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
</table>

<? if ($dmshop_design_item['buy_use4'] && !$dmshop_item['item_option_use']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="60" class="item_subtitle">재고수량</td>
    <td class="item_limit"><?=number_format($dmshop_item['item_limit']);?>개</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f4f4f4" class="none">&nbsp;</td></tr>
</table>
<? } ?>

<? if ($dmshop_design_item['buy_use5']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="60" class="item_subtitle">판매수량</td>
    <td class="item_sale_limit"><?=number_format(shop_order_limit($dmshop_item['id']));?>개</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f4f4f4" class="none">&nbsp;</td></tr>
</table>
<? } ?>

<? if ($dmshop_design_item['buy_use6']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="60" class="item_subtitle">배송비</td>
<? if ($dmshop_item['item_delivery']) { ?>
    <td class="item_delivery_money"><?=number_format($dmshop_item['item_delivery']);?>원</td>
<? if ($dmshop_item['item_delivery_bunch']) { ?>
    <td width="5"></td>
    <td class="help"><?=number_format($dmshop['delivery_money_free']);?>원 이상 구매시 무료배송</td>
<? } ?>
<? } else { ?>
    <td class="item_delivery_money"><?=number_format($dmshop['delivery_money']);?>원</td>
    <td width="5"></td>
    <td class="help"><?=number_format($dmshop['delivery_money_free']);?>원 이상 구매시 무료배송</td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
</table>
<? } ?>

<div id="item_cart_data" style="display:none;"></div>

<form method="post" id="formItem" name="formItem" autocomplete="off">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="cart_type" value="" />
<input type="hidden" name="item_id" value="<?=$dmshop_item['id']?>" />
<input type="hidden" id="cart_id" name="cart_id" value="" />
<input type="hidden" id="order_start" name="order_start" value="" />
<input type="submit" value="ok" disabled style="display:none;" />
<? if ($dmshop_item['item_option_use']) { ?>
<script type="text/javascript">
<? if ($item_order_option_list) { echo $item_order_option_list; } ?>
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div style="border:1px solid #eaeaea; background-color:#f4f4f4;">
<div style="padding:7px 10px 7px 10px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="50" class="order_title">옵션</td>
    <td><select id="order_option" name="order_option" class="select" onchange="orderOption(this.value);"><option value="">선택하세요.</option><?=$item_order_option_select?></select></td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<div id="item_option_data"></div>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div style="border:1px solid #eaeaea; background-color:#ffffff;">
<div style="padding:7px 10px 7px 10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<? if (!$dmshop_item['item_option_use']) { ?>
    <td width="55" class="order_title">주문수량</td>
    <td width="85">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="order_limit" name="order_limit" class="input" value="1" onkeyup="orderCheck();" /></td>
    <td width="2"></td>
    <td class="order_limit">개</td>
    <td width="5"></td>
    <td><a href="#" onclick="orderLimit('plus'); return false;"><img src="<?=$dmshop_item_path?>/img/limit_plus.gif" border="0"></a></td>
    <td width="3"></td>
    <td><a href="#" onclick="orderLimit('minus'); return false;"><img src="<?=$dmshop_item_path?>/img/limit_minus.gif" border="0"></a></td>
</tr>
</table>
    </td>
<? } ?>
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="order_title2">금액 :</td>
    <td width="5"></td>
    <td class="item_total_money"><span id="order_total_money_view"><?=number_format($dmshop_item['item_money']);?></span>원</td>
</tr>
</table>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>

<input type="hidden" id="item_option_id" name="item_option_id" value="" />
<input type="hidden" id="order_total_money" name="order_total_money" value="0" />
</form>

<style type="text/css">
.list_option {border-top:1px solid #ebebeb;}
.list_option:first-child {border-top:0;}
.list_name {line-height:30px; font-size:11px; color:#898989; font-family:gulim,serif;}
.list_limit {width:100px; line-height:30px; font-size:11px; color:#898989; font-family:gulim,serif;}
.list_limit td a {display:block;}
.list_limit .list_input {width:30px; height:18px; border:1px solid #cccccc; padding:1px 3px 0px 3px;}
.list_limit .list_input {line-height:17px; font-size:12px; color:#363636; font-family:gulim,굴림;}
.list_money {text-align:right; width:80px; line-height:30px; font-size:11px; color:#5f5f5f; font-family:gulim,serif;}
.list_del {text-align:right; width:21px;}

#cart_list {display:none;}
</style>

<div id="cart_list"></div>

<script type="text/javascript">
// 옵션 사용여부
var item_option_mode = "<?=$dmshop_item['item_option_use']?>";
var item_option_num = 0;

// 옵션 선택
function orderOption(item_option_id)
{


    item_option_num++;
    // 옵션 사용
    if (item_option_mode == '1') {

        if (document.getElementById("order_option").value == '') {

            return false;

        }

    }

    var html = "";
    html += "<div id='list_option_"+item_option_num+"' class='list_option'>";
    html += "<input rel='option_id' type='hidden' name='list_option_id[]' value='"+item_option_id+"' />";
    html += "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
    html += "<tr>";
    html += "<td class='list_name'>"+eval("item_option_"+item_option_id+"_name")+"</td>";
    html += "<td class='list_limit' align='right'>";

    html += "<table border='0' cellspacing='0' cellpadding='0' align='right'>";
    html += "<tr>";
    html += "<td><input rel='option_limit' type='text' name='list_order_limit[]' class='list_input' value='1' onkeyup='orderCheck();' onblur='orderCheck();' /></td>";
    html += "<td width='2'></td>";
    html += "<td>";
    html += "<a href='#' onclick=\"listOrderLimit('"+item_option_num+"','plus'); return false;\"><img src='<?=$dmshop_item_path?>/img/list_limit_plus.png' border='0'></a>";
    html += "<a href='#' onclick=\"listOrderLimit('"+item_option_num+"','minus'); return false;\"><img src='<?=$dmshop_item_path?>/img/list_limit_minus.png' border='0'></a>";
    html += "</td>";
    html += "</tr>";
    html += "</table>";

    html += "</td>";
    html += "<td class='list_money'><span rel='option_money' data-option_money='"+eval("item_option_"+item_option_id+"_money")+"'>"+shopNumberFormat(String(eval("item_option_"+item_option_id+"_money")))+"</span>원</td>";
    html += "<td class='list_del'><a href='#' onclick=\"listOrderDel('"+item_option_num+"'); return false;\"><img src='<?=$dmshop_item_path?>/img/list_option_del.png' border='0'></a></td>";
    html += "</tr>";
    html += "</table>";
    html += "</div>";

    $('#item_option_data').html($('#item_option_data').html()+html);

    orderCheck();
    return false;

}

// 주문 삭제
function listOrderDel(item_option_num)
{

    $('#list_option_'+item_option_num).html('').hide();

    orderCheck();

}

// 주문 수량
function listOrderLimit(item_option_num, mode)
{

    var item_money = parseInt("<?=$dmshop_item['item_money']?>");
    var item_option_id = $('#list_option_'+item_option_num).find('input[rel="option_id"]').val();
    var obj_option_limit = $('#list_option_'+item_option_num).find('input[rel="option_limit"]');

    if (!item_option_id) {
        return false;
    }

    if (mode == 'plus') {

        var item_option_limit = parseInt(obj_option_limit.val()) + 1;

    } else {

        var item_option_limit = parseInt(obj_option_limit.val()) - 1;

        if (item_option_limit <= 0) {

            obj_option_limit.focus();
            return false;

        }

    }

    obj_option_limit.val(item_option_limit);
    obj_option_limit.attr('value', item_option_limit);

    var item_option_money = (item_money * item_option_limit) + (eval("item_option_"+item_option_id+"_money") * (item_option_limit));

    $('#list_option_'+item_option_num).find('span[rel="option_money"]').text(item_option_money);

    orderCheck();
    return false;

}

// 주문 수량
function orderLimit(mode)
{

    var order_limit = parseInt(document.getElementById("order_limit").value);

    if (mode == 'plus') {

        document.getElementById("order_limit").value = order_limit + 1;

    } else {

        document.getElementById("order_limit").value = order_limit - 1;

    }

    orderCheck();
    return false;

}

// 주문 체크
function orderCheck()
{

    var item_money = parseInt("<?=$dmshop_item['item_money']?>");

    // 옵션 사용
    if (item_option_mode == '1') {

        var order_total_money = 0;

        $('#item_option_data .list_option').each(function() {

            var obj_option_id = $(this).find('input[rel="option_id"]');

            if (obj_option_id.val()) {

                var obj_option_limit = $(this).find('input[rel="option_limit"]');
                var obj_option_money = $(this).find('span[rel="option_money"]');

                var item_option_limit = parseInt(obj_option_limit.val());

                if (item_option_limit > 0) {

                    var item_option_money = (item_money * item_option_limit) + (parseInt(obj_option_money.attr('data-option_money')) * (item_option_limit));

                    obj_option_money.text(shopNumberFormat(String(item_option_money)));
                    obj_option_limit.attr('value', item_option_limit);

                    order_total_money += item_option_money;

                } else {

                    obj_option_limit.val('1');
                    obj_option_limit.attr('value', 1);
                    obj_option_money.text(shopNumberFormat(String(obj_option_money.attr('data-option_money'))));

                    alert("수량을 입력하세요.");
                    obj_option_limit.focus();
                    return false;

                }

            }

        });

    } else {

        var item_option_money = parseInt(0);
        var item_option_limit = parseInt("<?=$dmshop_item['item_limit']?>");

        var order_limit = parseInt(document.getElementById("order_limit").value);

        if (order_limit <= '0') {

            alert("수량을 1개 이상으로 입력하여 주시기 바랍니다.");
            document.getElementById("order_limit").value = "1";
            orderCheck();
            return false;

        }

        if (!shopNumeric(document.getElementById("order_limit").value)) {

            alert("숫자만 입력하여 주세요.");
            document.getElementById("order_limit").value = "1";
            orderCheck();
            return false;

        }

        // 주문 수량 초과
        if (order_limit > item_option_limit && item_option_limit) {

            alert("주문수량이 재고수량보다 많습니다.");
            document.getElementById("order_limit").value = "1";

            // 옵션 사용
            if (item_option_mode == '1') {

                // 셀렉트 해제
                document.getElementById("order_option").value = '';

            }

            orderCheck();
            return false;

        }

        var order_money = (item_money * order_limit) + (item_option_money * order_limit);
        var order_total_money = parseInt(order_money);

        // 마이너스이면
        if (order_total_money < 0) {

            alert("금액이 마이너스 입니다.\n\n주문 옵션을 다시 확인하시기 바랍니다.");
            document.getElementById("order_limit").value = "1";
            //orderCheck();
            return false;

        }

    }

    document.getElementById("order_total_money").value = order_total_money;
    document.getElementById("order_total_money_view").innerHTML = shopNumberFormat(String(order_total_money));

}

function itemOrder()
{

    // 옵션 사용
    if (item_option_mode == '1') {

        var order_item_count = 0;
        $('#item_option_data .list_option').each(function() {

            var obj_option_id = $(this).find('input[rel="option_id"]');

            if (obj_option_id.val()) {

                var obj_option_limit = $(this).find('input[rel="option_limit"]');

                if (obj_option_limit.val() <= 0) {

                    alert("옵션을 먼저 선택하세요.");
                    return false;

                }

                order_item_count++;

            }

        });

        if (!order_item_count) {

            alert("옵션을 먼저 선택하세요.");
            return false;

        }

        var f = document.formItem;

        var item_id = f.item_id.value;

        f.m.value = "item_option_array";
        f.cart_type.value = "order";

        var string = $('#formItem').serialize();

        $.post("<?=$shop['https_url']?>/cart_update.php", string , function(data) {

            $("#item_cart_data").html(data);

            orderPage('opt');

        });

    } else {
    // 무옵션

        var f = document.formItem;

        f.m.value = "";

        var item_id = f.item_id.value;

        if (f.order_option) {

            var order_option = f.order_option.value;

        } else {

            var order_option = "";

        }

        var order_limit = f.order_limit.value;
        var item_option_limit = parseInt("<?=$dmshop_item['item_limit']?>");

        if (!item_option_limit) {

            alert("재고가 없습니다.");
            return false;

        }

        $('#order_start').val('');

        $.post("<?=$shop['https_url']?>/cart_update.php", {"item_id" : item_id, "order_option" : order_option, "order_limit" : order_limit, "cart_type" : "order"}, function(data) {

            $("#item_cart_data").html(data);

            orderPage('one');

        });

    }

}

function orderPage(type)
{

    if (type == 'one') {

        if ($('#order_start').val() == '') { return false; }

        var f = document.formItem;

        f.m.value = "";
        f.cart_type.value = "order";

        f.action = "<?=$shop['https_url']?>/order.php";
        f.submit();

    } else {

        var f = document.formCartList;

        f.action = "<?=$shop['https_url']?>/order.php";
        f.submit();

    }

}

function itemCart()
{

    // 옵션 사용
    if (item_option_mode == '1') {

        var order_item_count = 0;
        $('#item_option_data .list_option').each(function() {

            var obj_option_id = $(this).find('input[rel="option_id"]');

            if (obj_option_id.val()) {

                var obj_option_limit = $(this).find('input[rel="option_limit"]');

                if (obj_option_limit.val() <= 0) {

                    alert("옵션을 먼저 선택하세요.");
                    return false;

                }

                order_item_count++;

            }

        });

        if (!order_item_count) {

            alert("옵션을 먼저 선택하세요.");
            return false;

        }

        var f = document.formItem;

        var item_id = f.item_id.value;

        f.m.value = "item_option_array";
        f.cart_type.value = "cart";

        var string = $('#formItem').serialize();

        $.post("<?=$shop['https_url']?>/cart_update.php", string , function(data) {

            $("#item_cart_data").html(data);

        });

    } else {

        var f = document.formItem;
        var order_option = "";
        f.m.value = "";

        $.post("<?=$shop['https_url']?>/cart_update.php", {"item_id" : f.item_id.value, "order_option" : order_option, "order_limit" : f.order_limit.value, "cart_type" : "cart"}, function(data) {

            $("#item_cart_data").html(data);

        });

    }

}

function itemFavorite()
{

    // 옵션 사용
    if (item_option_mode == '1') {

        var order_item_count = 0;
        $('#item_option_data .list_option').each(function() {

            var obj_option_id = $(this).find('input[rel="option_id"]');

            if (obj_option_id.val()) {

                var obj_option_limit = $(this).find('input[rel="option_limit"]');

                if (obj_option_limit.val() <= 0) {

                    alert("옵션을 먼저 선택하세요.");
                    return false;

                }

                order_item_count++;

            }

        });

        if (!order_item_count) {

            alert("옵션을 먼저 선택하세요.");
            return false;

        }

        var f = document.formItem;

        var item_id = f.item_id.value;

        f.m.value = "item_option_array";
        f.cart_type.value = "item";

        var string = $('#formItem').serialize();

        $.post("<?=$shop['https_url']?>/favorite_update.php", string , function(data) {

            $("#item_cart_data").html(data);

        });

    } else {

        var f = document.formItem;

        f.m.value = "";

        $.post("<?=$shop['https_url']?>/favorite_update.php", {"item_id" : f.item_id.value, "order_option" : "", "order_limit" : f.order_limit.value, "cart_type" : "item"}, function(data) {

            $("#item_cart_data").html(data);

        });

    }

}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f4f4f4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="itemOrder(); return false;"><img src="<?=$dmshop_item_path?>/img/item_order.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="itemCart(); return false;"><img src="<?=$dmshop_item_path?>/img/item_cart.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="itemFavorite(); return false;"><img src="<?=$dmshop_item_path?>/img/item_favorite.gif" border="0"></a></td>
</tr>
</table>

<? if ($dmshop_design_item['sns_use1'] || $dmshop_design_item['sns_use2'] || $dmshop_design_item['sns_use3'] || $dmshop_design_item['sns_use4'] || $dmshop_design_item['sns_use5'] || $dmshop_design_item['sns_use6']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div class="sns_box">
<div style="padding:5px 10px 5px 10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="40"><img src="<?=$dmshop_item_path?>/img/title_sns.gif"></td>
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<?
if (preg_match("/(Mobile|Android)/", $_SERVER['HTTP_USER_AGENT'])) {

    if ($dmshop_design_item['sns_use1']) {

        echo "<td><a href='https://twitter.com/intent/tweet?url=".urlencode($shop['url']."/item.php?id=".$id)."&amp;text=".urlencode(text($dmshop_item['item_title'],1))."' target='_blank' title='트위터 퍼가기'><img src='".$dmshop_item_path."/img/sns_twitter.png' border='0'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use2']) {

        echo "<td><a href='https://www.facebook.com/sharer/sharer.php?u=".urlencode($shop['url']."/item.php?id=".$id)."' target='_blank' title='페이스북 퍼가기'><img src='".$dmshop_item_path."/img/sns_facebook.png' border='0'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use3']) {

        echo "<td><a href='#' onclick=\"kakaoLink();  return false;\" title='카카오톡 퍼가기'><img src='".$dmshop_item_path."/img/sns_kakaotalk.png' border='0'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use4']) {

        echo "<td><a href='#' onclick=\"Kakao.Story.share({url: '".$shop['url']."/item.php?id=".$id."'}); return false;\" title='카카오스토리 퍼가기'><img src='".$dmshop_item_path."/img/sns_kakaostory.png' border='0'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use5']) {

        echo "<td><a href='http://line.me/R/msg/text/?".urlencode(text($dmshop_item['item_title'],1))."%0d%0a".urlencode($shop['url']."/item.php?id=".$id)."' target='_blank' title='라인 퍼가기'><img src='".$dmshop_item_path."/img/sns_line.png' border='0'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use6']) {

        echo "<td><a href='#' onclick=\"orderPopupSms('item_code=".$id."'); return false;\"><img src='".$dmshop_item_path."/img/sns_email.gif' border='0'></a></td>";
        echo "<td width='4'></td>";

    }

} else {

    if ($dmshop_design_item['sns_use1']) {

        echo "<td><a href='https://twitter.com/intent/tweet?url=".urlencode($shop['url']."/item.php?id=".$id)."&amp;text=".urlencode(text($dmshop_item['item_title'],1))."' target='_blank' title='트위터 퍼가기'><img src='".$dmshop_item_path."/img/sns_twitter.png' border='0'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use2']) {

        echo "<td><a href='https://www.facebook.com/sharer/sharer.php?u=".urlencode($shop['url']."/item.php?id=".$id)."' target='_blank' title='페이스북 퍼가기'><img src='".$dmshop_item_path."/img/sns_facebook.png' border='0'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use4']) {

        echo "<td><a href='https://story.kakao.com/share?url=".urlencode($shop['url']."/item.php?id=".$id)."' target='_blank' title='카카오스토리 퍼가기'><img src='".$dmshop_item_path."/img/sns_kakaostory.png' border='0'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use6']) {

        echo "<td><a href='#' onclick=\"orderPopupSms('item_code=".$id."'); return false;\"><img src='".$dmshop_item_path."/img/sns_email.gif' border='0'></a></td>";
        echo "<td width='4'></td>";

    }

}
?>
</tr>
</table>
    </td>
</tr>
</table>
</div>
</div>
    </td>
</tr>
</table>
<? } ?>
<!-- 상품 정보 박스 end //-->
    </td>
</tr>
</table>
</div>
</div>

<!-- 관련상품 start //-->
<?
if ($dmshop_design_item['item_relation']) {
if (shop_relation_item($dmshop_item['id'])) {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<div style="border:1px solid #efefef; background-color:#ffffff;">
<div class="relation_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td bgcolor="#f4f4f4" width="137" align="center"><img src="<?=$dmshop_item_path?>/img/title_relation.gif"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td><div style="padding:20px 0;"><div id="relation_data"></div></div></td>
</tr>
</table>
</div>
</div>

<script type="text/javascript">
$(function() {

    $.post("<?=$dmshop_item_path?>/relation_data.php", {"item_id" : "<?=$dmshop_item['id']?>"}, function(data) {

        $("#relation_data").html(data);

    });

});
</script>
<?
}
}
?>
<!-- 관련상품 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<? if ($dmshop_design_item['tab_use1'] || $dmshop_design_item['tab_use2'] || $dmshop_design_item['tab_use3'] || $dmshop_design_item['tab_use4'] || $dmshop_design_item['tab_use5']) { ?>
<div style="border:1px solid #efefef; background-color:#ffffff;">
<!-- 상세정보 start //-->
<? if ($dmshop_design_item['tab_use1']) { ?>
<a name="item_view"></a>
<div style="padding:15px 15px 15px 15px;" class="item_view">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="tab_bg">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($dmshop_design_item['tab_use1']) { ?>
    <td width="141" onclick="shopMove('#item_view'); return false;" class="tab_use1_on pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use2']) { ?>
    <td width="141" onclick="shopMove('#item_delivery'); return false;" class="tab_use2_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use3']) { ?>
    <td width="141" onclick="shopMove('#item_refund'); return false;" class="tab_use3_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use4']) { ?>
    <td width="141" onclick="shopMove('#item_reply'); return false;" class="tab_use4_off pointer"><div class="tab_count1"><?=number_format($dmshop_item['item_reply']);?></div></td>
<? } ?>
<? if ($dmshop_design_item['tab_use5']) { ?>
    <td width="142" onclick="shopMove('#item_qna'); return false;" class="tab_use5_off pointer"><div class="tab_count1"><?=number_format($dmshop_item['item_qna']);?></div></td>
<? } ?>
</tr>
</table>
    </td>
    <td class="tab_side"></td>
</tr>
</table>

<!-- 상품 요약안내 start //-->
<? if ($dmshop_item['item_option1_text'] || $dmshop_item['item_option2_text'] || $dmshop_item['item_option3_text'] || $dmshop_item['item_option4_text'] || $dmshop_item['item_option5_text'] || $dmshop_item['item_option6_text'] || $dmshop_item['item_option7_text'] || $dmshop_item['item_option8_text'] || $dmshop_item['item_option9_text'] || $dmshop_item['item_option10_text']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20">
    <td></td>
</tr>
</table>

<?
$k = 0;
$item_option = array();
for ($i=1; $i<=10; $i++) {

    if ($dmshop_item["item_option".$i."_text"]) {

        $k++;

        $item_option[$k]['item_option_title'] = $dmshop_item["item_option".$i];
        $item_option[$k]['item_option_text'] = $dmshop_item["item_option".$i."_text"];

    }

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div style="border:1px solid #efefef;" class="item_information">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
$item_option_line = false;
?>
<? if ($item_option[1]['item_option_text'] || $item_option[2]['item_option_text']) { $item_option_line = true; ?>
<tr height="28">
<? if ($item_option[1]['item_option_text']) { ?>
    <td width="120" class="item_optiontitle" align="right" bgcolor="#fafafa"><?=$item_option[1]['item_option_title']?> :</td>
    <td width="10" bgcolor="#fafafa"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="10"></td>
    <td <? if (!$item_option[2]['item_option_text']) { echo " colspan='8' "; } ?> class="item_optioncontent"><?=$item_option[1]['item_option_text']?></td>
    <td width="10"></td>
<? } ?>
<? if ($item_option[2]['item_option_text']) { ?>
    <td width="1" bgcolor="#efefef"></td>
    <td width="120" class="item_optiontitle" align="right" bgcolor="#fafafa"><?=$item_option[2]['item_option_title']?> :</td>
    <td width="10" bgcolor="#fafafa"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="10"></td>
    <td class="item_optioncontent"><?=$item_option[2]['item_option_text']?></td>
    <td width="10"></td>
<? } ?>
</tr>
<? } ?>
<? if ($item_option[3]['item_option_text'] || $item_option[4]['item_option_text']) { $item_option_line = true; ?>
<? if ($item_option_line) { ?><tr height="1" bgcolor="#efefef"><td colspan="13"></td></tr><? } ?>
<tr height="28">
<? if ($item_option[3]['item_option_text']) { ?>
    <td width="120" class="item_optiontitle" align="right" bgcolor="#fafafa"><?=$item_option[3]['item_option_title']?> :</td>
    <td width="10" bgcolor="#fafafa"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="10"></td>
    <td <? if (!$item_option[4]['item_option_text']) { echo " colspan='8' "; } ?> class="item_optioncontent"><?=$item_option[3]['item_option_text']?></td>
    <td width="10"></td>
<? } ?>
<? if ($item_option[4]['item_option_text']) { ?>
    <td width="1" bgcolor="#efefef"></td>
    <td width="120" class="item_optiontitle" align="right" bgcolor="#fafafa"><?=$item_option[4]['item_option_title']?> :</td>
    <td width="10" bgcolor="#fafafa"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="10"></td>
    <td class="item_optioncontent"><?=$item_option[4]['item_option_text']?></td>
    <td width="10"></td>
<? } ?>
</tr>
<? } ?>
<? if ($item_option[5]['item_option_text'] || $item_option[6]['item_option_text']) { $item_option_line = true; ?>
<? if ($item_option_line) { ?><tr height="1" bgcolor="#efefef"><td colspan="13"></td></tr><? } ?>
<tr height="28">
<? if ($item_option[5]['item_option_text']) { ?>
    <td width="120" class="item_optiontitle" align="right" bgcolor="#fafafa"><?=$item_option[5]['item_option_title']?> :</td>
    <td width="10" bgcolor="#fafafa"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="10"></td>
    <td <? if (!$item_option[6]['item_option_text']) { echo " colspan='8' "; } ?> class="item_optioncontent"><?=$item_option[5]['item_option_text']?></td>
    <td width="10"></td>
<? } ?>
<? if ($item_option[6]['item_option_text']) { ?>
    <td width="1" bgcolor="#efefef"></td>
    <td width="120" class="item_optiontitle" align="right" bgcolor="#fafafa"><?=$item_option[6]['item_option_title']?> :</td>
    <td width="10" bgcolor="#fafafa"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="10"></td>
    <td class="item_optioncontent"><?=$item_option[6]['item_option_text']?></td>
    <td width="10"></td>
<? } ?>
</tr>
<? } ?>
<? if ($item_option[7]['item_option_text'] || $item_option[8]['item_option_text']) { $item_option_line = true; ?>
<? if ($item_option_line) { ?><tr height="1" bgcolor="#efefef"><td colspan="13"></td></tr><? } ?>
<tr height="28">
<? if ($item_option[7]['item_option_text']) { ?>
    <td width="120" class="item_optiontitle" align="right" bgcolor="#fafafa"><?=$item_option[7]['item_option_title']?> :</td>
    <td width="10" bgcolor="#fafafa"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="10"></td>
    <td <? if (!$item_option[8]['item_option_text']) { echo " colspan='8' "; } ?> class="item_optioncontent"><?=$item_option[7]['item_option_text']?></td>
    <td width="10"></td>
<? } ?>
<? if ($item_option[8]['item_option_text']) { ?>
    <td width="1" bgcolor="#efefef"></td>
    <td width="120" class="item_optiontitle" align="right" bgcolor="#fafafa"><?=$item_option[8]['item_option_title']?> :</td>
    <td width="10" bgcolor="#fafafa"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="10"></td>
    <td class="item_optioncontent"><?=$item_option[8]['item_option_text']?></td>
    <td width="10"></td>
<? } ?>
</tr>
<? } ?>
<? if ($item_option[9]['item_option_text'] || $item_option[10]['item_option_text']) { $item_option_line = true; ?>
<? if ($item_option_line) { ?><tr height="1" bgcolor="#efefef"><td colspan="13"></td></tr><? } ?>
<tr height="28">
<? if ($item_option[9]['item_option_text']) { ?>
    <td width="120" class="item_optiontitle" align="right" bgcolor="#fafafa"><?=$item_option[9]['item_option_title']?> :</td>
    <td width="10" bgcolor="#fafafa"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="10"></td>
    <td <? if (!$item_option[10]['item_option_text']) { echo " colspan='8' "; } ?> class="item_optioncontent"><?=$item_option[9]['item_option_text']?></td>
    <td width="10"></td>
<? } ?>
<? if ($item_option[10]['item_option_text']) { ?>
    <td width="1" bgcolor="#efefef"></td>
    <td width="120" class="item_optiontitle" align="right" bgcolor="#fafafa"><?=$item_option[10]['item_option_title']?> :</td>
    <td width="10" bgcolor="#fafafa"></td>
    <td width="1" bgcolor="#efefef"></td>
    <td width="10"></td>
    <td class="item_optioncontent"><?=$item_option[10]['item_option_text']?></td>
    <td width="10"></td>
<? } ?>
</tr>
<? } ?>
</table>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } ?>
<!-- 상품 요약안내 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="150">
    <td>
<?
$dmshop_item['item_text'] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 alt=\"\" name=\"shopResizeImage[]\" onclick=\"shopImageView(this);\" style=\"cursor:pointer;\" \\2 \\3", $dmshop_item['item_text']);
echo shop_item_view($dmshop_item['item_text'], 2);
?></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>
<? } ?>
<!-- 상세정보 end //-->

<!-- 배송안내 start //-->
<? if ($dmshop_design_item['tab_use2']) { ?>
<a name="item_delivery"></a>
<div style="padding:15px 15px 15px 15px;" class="item_view">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="tab_bg">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($dmshop_design_item['tab_use1']) { ?>
    <td width="141" onclick="shopMove('#item_view'); return false;" class="tab_use1_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use2']) { ?>
    <td width="141" onclick="shopMove('#item_delivery'); return false;" class="tab_use2_on pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use3']) { ?>
    <td width="141" onclick="shopMove('#item_refund'); return false;" class="tab_use3_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use4']) { ?>
    <td width="141" onclick="shopMove('#item_reply'); return false;" class="tab_use4_off pointer"><div class="tab_count1"><?=number_format($dmshop_item['item_reply']);?></div></td>
<? } ?>
<? if ($dmshop_design_item['tab_use5']) { ?>
    <td width="142" onclick="shopMove('#item_qna'); return false;" class="tab_use5_off pointer"><div class="tab_count1"><?=number_format($dmshop_item['item_qna']);?></div></td>
<? } ?>
</tr>
</table>
    </td>
    <td class="tab_side"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="150">
    <td><?=shop_item_view($dmshop_item['item_delivery_text'], 2);?></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>
<? } ?>
<!-- 배송안내 end //-->

<!-- 환불규정 start //-->
<? if ($dmshop_design_item['tab_use3']) { ?>
<a name="item_refund"></a>
<div style="padding:15px 15px 15px 15px;" class="item_view">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="tab_bg">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($dmshop_design_item['tab_use1']) { ?>
    <td width="141" onclick="shopMove('#item_view'); return false;" class="tab_use1_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use2']) { ?>
    <td width="141" onclick="shopMove('#item_delivery'); return false;" class="tab_use2_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use3']) { ?>
    <td width="141" onclick="shopMove('#item_refund'); return false;" class="tab_use3_on pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use4']) { ?>
    <td width="141" onclick="shopMove('#item_reply'); return false;" class="tab_use4_off pointer"><div class="tab_count1"><?=number_format($dmshop_item['item_reply']);?></div></td>
<? } ?>
<? if ($dmshop_design_item['tab_use5']) { ?>
    <td width="142" onclick="shopMove('#item_qna'); return false;" class="tab_use5_off pointer"><div class="tab_count1"><?=number_format($dmshop_item['item_qna']);?></div></td>
<? } ?>
</tr>
</table>
    </td>
    <td class="tab_side"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="150">
    <td><?=shop_item_view($dmshop_item['item_refund_text'], 2);?></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>
<? } ?>
<!-- 환불규정 end //-->

<!-- 상품평 start //-->
<? if ($dmshop_design_item['tab_use4']) { ?>
<a name="item_reply"></a>
<div style="padding:15px 15px 15px 15px;" class="item_view item_reply">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="tab_bg">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($dmshop_design_item['tab_use1']) { ?>
    <td width="141" onclick="shopMove('#item_view'); return false;" class="tab_use1_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use2']) { ?>
    <td width="141" onclick="shopMove('#item_delivery'); return false;" class="tab_use2_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use3']) { ?>
    <td width="141" onclick="shopMove('#item_refund'); return false;" class="tab_use3_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use4']) { ?>
    <td width="141" onclick="shopMove('#item_reply'); return false;" class="tab_use4_on pointer"><div class="tab_count2"><?=number_format($dmshop_item['item_reply']);?></div></td>
<? } ?>
<? if ($dmshop_design_item['tab_use5']) { ?>
    <td width="142" onclick="shopMove('#item_qna'); return false;" class="tab_use5_off pointer"><div class="tab_count1"><?=number_format($dmshop_item['item_qna']);?></div></td>
<? } ?>
</tr>
</table>
    </td>
    <td class="tab_side"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div id="reply_data"></div></td>
</tr>
</table>
</div>

<script type="text/javascript">
function replyWrite(page_id, m, item_id, reply_id, page)
{

    shopOpen("<?=$shop['path']?>/reply_write.php?page_id="+page_id+"&m="+m+"&item_id="+item_id+"&reply_id="+reply_id+"&page="+page, "shopReply", "width=620, height=750, scrollbars=yes");

}

function replyLoading(item_id, page)
{

    $.post("<?=$shop['path']?>/reply.php", {"item_id" : item_id, "page" : page}, function(data) {

        $("#reply_data").html(data);

    });

}

function replyView(reply_id)
{

    if ($("#reply_data .reply_"+reply_id).is(":hidden")) {

        $("#reply_data .reply_"+reply_id).slideDown("slow");

    } else {

        $("#reply_data .reply_"+reply_id).hide();

    }

}

function replyDelete(page_id, m, item_id, reply_id, page)
{

    if (confirm("삭제하시겠습니까?")) {

        $.post("<?=$shop['path']?>/reply_write_update.php", {"page_id" : page_id, "m" : m, "item_id" : item_id, "reply_id" : reply_id, "page" : page}, function(data) {

            $("#reply_data").html(data);

        });

    }

}

function replyPassword(page_id, m, item_id, reply_id, page)
{

    shopOpen("<?=$shop['path']?>/reply_password.php?page_id="+page_id+"&m="+m+"&item_id="+item_id+"&reply_id="+reply_id+"&page="+page, "shopReplyPassword", "width=620, height=750, scrollbars=yes");

}
</script>

<script type="text/javascript">
$(document).ready(function() { replyLoading('<?=$dmshop_item['id']?>', '1'); });
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>
<? } ?>
<!-- 상품평 end //-->

<!-- 상품문의 start //-->
<? if ($dmshop_design_item['tab_use5']) { ?>
<a name="item_qna"></a>
<div style="padding:15px 15px 15px 15px;" class="item_view item_qna">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="tab_bg">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($dmshop_design_item['tab_use1']) { ?>
    <td width="141" onclick="shopMove('#item_view'); return false;" class="tab_use1_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use2']) { ?>
    <td width="141" onclick="shopMove('#item_delivery'); return false;" class="tab_use2_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use3']) { ?>
    <td width="141" onclick="shopMove('#item_refund'); return false;" class="tab_use3_off pointer"></td>
<? } ?>
<? if ($dmshop_design_item['tab_use4']) { ?>
    <td width="141" onclick="shopMove('#item_reply'); return false;" class="tab_use4_off pointer"><div class="tab_count1"><?=number_format($dmshop_item['item_reply']);?></div></td>
<? } ?>
<? if ($dmshop_design_item['tab_use5']) { ?>
    <td width="142" onclick="shopMove('#item_qna'); return false;" class="tab_use5_on pointer"><div class="tab_count2"><?=number_format($dmshop_item['item_qna']);?></div></td>
<? } ?>
</tr>
</table>
    </td>
    <td class="tab_side"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div id="qna_data"></div></td>
</tr>
</table>
</div>

<script type="text/javascript">
function qnaWrite(page_id, m, item_id, qna_id, page)
{

    shopOpen("<?=$shop['path']?>/qna_write.php?page_id="+page_id+"&m="+m+"&item_id="+item_id+"&qna_id="+qna_id+"&page="+page, "shopQna", "width=620, height=720, scrollbars=yes");

}

function qnaLoading(item_id, page)
{

    $.post("<?=$shop['path']?>/qna.php", {"item_id" : item_id, "page" : page}, function(data) {

        $("#qna_data").html(data);

    });

}

function qnaView(qna_id)
{

    if ($("#qna_data .qna_"+qna_id).is(":hidden")) {

        $("#qna_data .qna_"+qna_id).slideDown("slow");

    } else {

        $("#qna_data .qna_"+qna_id).hide();

    }

}

function qnaDelete(page_id, m, item_id, qna_id, page)
{

    if (confirm("삭제하시겠습니까?")) {

        $.post("<?=$shop['path']?>/qna_write_update.php", {"page_id" : page_id, "m" : m, "item_id" : item_id, "qna_id" : qna_id, "page" : page}, function(data) {

            $("#qna_data").html(data);

        });

    }

}

function qnaPassword(page_id, m, item_id, qna_id, page)
{

    shopOpen("<?=$shop['path']?>/qna_password.php?page_id="+page_id+"&m="+m+"&item_id="+item_id+"&qna_id="+qna_id+"&page="+page, "shopQnaPassword", "width=620, height=720, scrollbars=yes");

}
</script>

<script type="text/javascript">
$(document).ready(function() { qnaLoading('<?=$dmshop_item['id']?>', '1'); });
</script>
<? } ?>
<!-- 상품문의 end //-->
</div>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="20"></td></tr>
</table>

<script type="text/javascript">
window.onload=function() { shopResizeImage(<?=$dmshop_design_item['item_image_width']?>); }
</script>