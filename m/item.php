<?php
include_once("./_dmshop.php");

if ($id) { $id = preg_match("/^[a-zA-Z0-9_\-]+$/", $id) ? $id : ""; }

// 아이디가 없다.
if (!$id) {

    message("<p class='title'>알림</p><p class='text'>상품분류가 삭제되었거나 존재하지 않습니다.</p>", "b");

}

// 상품
$dmshop_item = shop_item_code($id);

// 상품이 없다.
if (!$dmshop_item['id']) {

    message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않습니다.</p>", "b");

}

// 숨김
if ($dmshop_item['item_use'] == '3') {

    message("<p class='title'>알림</p><p class='text'>판매중인 상품이 아닙니다.</p>", "b");

}

// 분류 아이디
$ct_id = shop_category_id($ct_id, $dmshop_item['category1'], $dmshop_item['category2'], $dmshop_item['category3'], $dmshop_item['category4']);

// 분류 설정
$dmshop_category = shop_category($ct_id);

// 분류가 없다.
if (!$dmshop_category['id']) {

    message("<p class='title'>알림</p><p class='text'>상품분류가 삭제되었거나 존재하지 않아 상품페이지를 볼 수 없습니다.</p>", "b");

}

// 세션 생성
$ss_name = "item_view_".$id;

if (!shop_get_session($ss_name)) {

    // 상품 조회수 증가
    sql_query(" update $shop[item_table] set item_hit = item_hit + 1 where item_code = '".$id."' ");

    // 기획전 조회수 증가
    sql_query(" update $shop[plan_item_table] set item_hit = item_hit + 1 where item_code = '".$id."' ");

    // 세션 생성
    shop_set_session($ss_name, true);

}

// 게스트 아이디
$guest_id = "";

// 회원
if ($shop_user_login) {

    $user_id = $dmshop_user['user_id'];

} else {
// 비회원

    $user_id = "";

    // 쿠키 아이디
    $cookie_id = "dmshop_item_view";

    // 쿠키
    if (shop_get_cookie($cookie_id)) {

        $guest_id = shop_get_cookie($cookie_id);

    } else {

        $cookie_value = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR']))).rand(10000,99999);

        shop_set_cookie($cookie_id, $cookie_value, 86400);

        $guest_id = $cookie_value;

    }

}

// 검색조건
$sql_search = "";

if ($shop_user_login) {

    $sql_search = " where user_id = '".$dmshop_user['user_id']."' and item_id = '".$dmshop_item['id']."' ";

} else {

    $sql_search = " where guest_id = '".$guest_id."' and user_id = '' and item_id = '".$dmshop_item['id']."' ";

}

$dmshop_item_view = sql_fetch(" select * from $shop[item_view_table] $sql_search ");

// 없다면
if (!$dmshop_item_view['id']) {

    $sql_common = "";
    $sql_common .= " set user_id = '".$user_id."' ";
    $sql_common .= ", guest_id = '".trim(strip_tags(mysql_real_escape_string($guest_id)))."' ";
    $sql_common .= ", item_id = '".$dmshop_item['id']."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 내가 본 상품 등록
    sql_query(" insert into $shop[item_view_table] $sql_common ");

}

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_item['item_title'];

// 설정
$dmshop_design_item = shop_design_item();

// 대표 이미지
if ($dmshop_design_item['image_default_use'] == '0') { $dmshop_design_item['image_default_width'] = shop_split("|", $dmshop_design_item['image_default'], "0"); $dmshop_design_item['image_default_height'] = shop_split("|", $dmshop_design_item['image_default'], "1"); } else { $dmshop_design_item['image_default_width'] = $dmshop_design_item['image_default_width']; $dmshop_design_item['image_default_height'] = $dmshop_design_item['image_default_height']; }

// 갤러리 썸네일 이미지
if ($dmshop_design_item['image_gallery_thumb_use'] == '0') { $dmshop_design_item['image_gallery_thumb_width'] = shop_split("|", $dmshop_design_item['image_gallery_thumb'], "0"); $dmshop_design_item['image_gallery_thumb_height'] = shop_split("|", $dmshop_design_item['image_gallery_thumb'], "1"); } else { $dmshop_design_item['image_gallery_thumb_width'] = $dmshop_design_item['image_gallery_thumb_width']; $dmshop_design_item['image_gallery_thumb_height'] = $dmshop_design_item['image_gallery_thumb_height']; }

// 대표이미지
$thumb = shop_item_thumb($dmshop_item['id'], "default", "", $dmshop_design_item['image_default_width'], $dmshop_design_item['image_default_height'], shop_thumb_type($dmshop_design_item['thumb_type']));

// 대표이미지가 있으면 metatag 설정
if ($thumb) {

    $shop['meta_image'] = $shop['url'].substr($thumb,2);
    $shop['meta_image_width'] = $dmshop_design_item['image_default_width'];
    $shop['meta_image_height'] = $dmshop_design_item['image_default_height'];

}

$shop['meta_type'] = "article";
$shop['meta_subject'] = $dmshop_item['item_title'];

include_once("./_top.php");

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

$k = 0;
$list = array();

$thumb_width = 600;
$thumb_height = 600;

$thumb = shop_item_thumb($dmshop_item['id'], "default", "", $thumb_width, $thumb_height, 2);

if ($thumb) {

    $list[$k]['thumb'] = $thumb;
    $k++;

}

// 상품 갤러리 사용
if ($dmshop_design_item['item_gallery']) {

    $result = sql_query(" select * from $shop[item_file_table] where item_id = '".$dmshop_item['id']."' and substring(upload_mode,1,7) = 'gallery' order by upload_mode asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $thumb = shop_item_thumb($dmshop_item['id'], $row['upload_mode'], "", $thumb_width, $thumb_height, 2);

        if ($thumb) {

            $list[$k]['thumb'] = $thumb;

            $k++;

        }

    }

}
?>
<style type="text/css">
.conts .main {clear:both; padding:10px 0;}

.slider {padding:0 10px;}

.swipe {overflow:hidden; visibility:hidden; position:relative;}
.swipe-wrap {overflow:hidden; position:relative;}
.swipe-wrap .block {float:left; width:100%; position:relative; text-align:center; vertical-align:middle; height:300px;}
.swipe-wrap .block img {vertical-align:middle; width:100%; max-width:<?=$thumb_width?>px;}

.slidernum {width:100%; height:40px; text-align:center;}
.slidernum {font-weight:400; line-height:40px; font-size:13px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}

.itembox {padding:0 10px; border-top:1px solid #eeeeee;}

.itembox .title {padding-top:10px; width:100%; height:30px;}
.itembox .title {font-weight:700; line-height:30px; font-size:15px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
.itembox .text {font-weight:400; line-height:30px; font-size:12px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
.itembox .input {width:22px; height:17px; border:1px solid #cccccc; padding:1px 3px 0px 3px;}
.itembox .input {line-height:17px; font-size:12px; color:#363636; font-family:gulim,굴림;}

.itemoption {margin-top:20px; padding:10px 10px 0 10px; border-top:1px solid #eeeeee;}
.itemoption {font-weight:400; line-height:30px; font-size:12px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}

.itemview {margin-top:20px; padding:10px 10px 0 10px; border-top:1px solid #eeeeee;}
.itemview {font-weight:400; line-height:21px; font-size:12px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
.itemview img {width:100%;}
</style>
<script type="text/javascript">
$(document).ready( function() {

    window.mySwipe = new Swipe(document.getElementById('slider'), {
        startSlide: 0,
        speed: 0,
        auto: 0,
        continuous: true,
        disableScroll: false,
        stopPropagation: false,
        callback: function(index, elem) {

            $('.slidernum .num').text(index + 1);

        },
        transitionEnd: function(index, elem) {}
    });

});
</script>
<div class="slider">
<div id="slider" class="swipe">
<div class="swipe-wrap">
<?
for ($i=0; $i<count($list); $i++) {

    echo "<div class='block'><img src='".$list[$i]['thumb']."'></div>";

}
?>
</div>
</div>
</div>
<div class="slidernum"><span class="num">1</span> / <?=$k?></div>

<!-- 상품 정보 박스 start //-->
<div class="itembox">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="title">
<tr>
    <td><?=$dmshop_item['item_title']?></td>
</tr>
</table>

<? if ($dmshop_item['item_icon']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=shop_icon_view($dmshop_item['item_icon'])?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#eeeeee" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<? if ($dmshop_design_item['buy_use1'] && $dmshop_item['item_price']) { ?>
<tr>
    <td width="60" class="text">시중가 :</td>
    <td class="text"><?=number_format($dmshop_item['item_price']);?></td>
</tr>
<? } ?>
<? if ($dmshop_design_item['buy_use1'] && $dmshop_item['item_price']) { ?><tr height="1" bgcolor="#f4f4f4"><td colspan="2"></td></tr><? } ?>
<? if ($dmshop_design_item['buy_use2']) { ?>
<tr>
    <td width="60" class="text">판매가 :</td>
    <td class="text"><?=number_format($dmshop_item['item_money']);?> 원</td>
</tr>
<tr height="1" bgcolor="#f4f4f4"><td colspan="2"></td></tr>
<? } ?>
<? if ($dmshop_design_item['buy_use3'] && $dmshop_item['item_cash']) { ?>
<tr>
    <td width="60" class="text">적립금 :</td>
    <td class="text"><?=number_format($dmshop_item['item_cash']);?> P</td>
</tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#eeeeee" class="none">&nbsp;</td></tr>
</table>

<? if ($dmshop_design_item['buy_use4'] && !$dmshop_item['item_option_use']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="60" class="text">재고수량</td>
    <td class="text"><?=number_format($dmshop_item['item_limit']);?>개</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f4f4f4" class="none">&nbsp;</td></tr>
</table>
<? } ?>

<? if ($dmshop_design_item['buy_use5']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="60" class="text">판매수량</td>
    <td class="text"><?=number_format(shop_order_limit($dmshop_item['id']));?>개</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f4f4f4" class="none">&nbsp;</td></tr>
</table>
<? } ?>

<? if ($dmshop_design_item['buy_use6']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="60" class="text">배송비</td>
<? if ($dmshop_item['item_delivery']) { ?>
    <td class="text"><?=number_format($dmshop_item['item_delivery']);?>원</td>
<? if ($dmshop_item['item_delivery_bunch']) { ?>
    <td width="5"></td>
    <td class="help"><?=number_format($dmshop['delivery_money_free']);?>원 이상 구매시 무료배송</td>
<? } ?>
<? } else { ?>
    <td class="text"><?=number_format($dmshop['delivery_money']);?>원</td>
    <td width="5"></td>
    <td class="help"><?=number_format($dmshop['delivery_money_free']);?>원 이상 구매시 무료배송</td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#eeeeee" class="none">&nbsp;</td></tr>
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
    <td width="55" class="text">주문옵션</td>
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
    <td width="55" class="text">주문수량</td>
    <td width="85">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="order_limit" name="order_limit" class="input" value="1" onkeyup="orderCheck();" /></td>
    <td width="2"></td>
    <td class="text">개</td>
    <td width="5"></td>
    <td><a href="#" onclick="orderLimit('plus'); return false;"><img src="<?=$shop['mobile_url']?>/img/limit_plus.gif" border="0"></a></td>
    <td width="3"></td>
    <td><a href="#" onclick="orderLimit('minus'); return false;"><img src="<?=$shop['mobile_url']?>/img/limit_minus.gif" border="0"></a></td>
</tr>
</table>
    </td>
<? } ?>
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="text"><b>금액 :</b></td>
    <td width="5"></td>
    <td class="text"><b><span id="order_total_money_view"><?=number_format($dmshop_item['item_money']);?></span>원</b></td>
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
.list_limit {width:100px; line-height:10px; font-size:11px; color:#898989; font-family:gulim,serif;}
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
    html += "<a href='#' onclick=\"listOrderLimit('"+item_option_num+"','plus'); return false;\"><img src='<?=$shop['mobile_url']?>/img/list_limit_plus.png' border='0'></a>";
    html += "<a href='#' onclick=\"listOrderLimit('"+item_option_num+"','minus'); return false;\"><img src='<?=$shop['mobile_url']?>/img/list_limit_minus.png' border='0'></a>";
    html += "</td>";
    html += "</tr>";
    html += "</table>";

    html += "</td>";
    html += "<td class='list_money'><span rel='option_money' data-option_money='"+eval("item_option_"+item_option_id+"_money")+"'>"+shopNumberFormat(String(eval("item_option_"+item_option_id+"_money")))+"</span>원</td>";
    html += "<td class='list_del'><a href='#' onclick=\"listOrderDel('"+item_option_num+"'); return false;\"><img src='<?=$shop['mobile_url']?>/img/list_option_del.png' border='0'></a></td>";
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

        $.post("cart_update.php", string , function(data) {

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

        $.post("cart_update.php", {"item_id" : item_id, "order_option" : order_option, "order_limit" : order_limit, "cart_type" : "order"}, function(data) {

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

        f.action = "order.php";
        f.submit();

    } else {

        var f = document.formCartList;

        f.action = "order.php";
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

        $.post("cart_update.php", string , function(data) {

            $("#item_cart_data").html(data);

        });

    } else {

        var f = document.formItem;
        var order_option = "";
        f.m.value = "";

        $.post("cart_update.php", {"item_id" : f.item_id.value, "order_option" : order_option, "order_limit" : f.order_limit.value, "cart_type" : "cart"}, function(data) {

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
    <td><a href="#" onclick="itemOrder(); return false;"><img src="<?=$shop['mobile_url']?>/img/item_order.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="itemCart(); return false;"><img src="<?=$shop['mobile_url']?>/img/item_cart.gif" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
<tr>
<?
if (preg_match("/(Mobile|Android)/", $_SERVER['HTTP_USER_AGENT'])) {

    if ($dmshop_design_item['sns_use1']) {

        echo "<td><a href='https://twitter.com/intent/tweet?url=".urlencode($shop['mobile_url']."/item.php?id=".$id)."&amp;text=".urlencode(text($dmshop_item['item_title'],1))."' target='_blank' title='트위터 퍼가기'><img src='".$shop['mobile_url']."/img/sns_twitter.png' border='0' width='30'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use2']) {

        echo "<td><a href='https://www.facebook.com/sharer/sharer.php?u=".urlencode($shop['mobile_url']."/item.php?id=".$id)."' target='_blank' title='페이스북 퍼가기'><img src='".$shop['mobile_url']."/img/sns_facebook.png' border='0' width='30'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use3']) {

        echo "<td><a href='#' onclick=\"kakaoLink();  return false;\" title='카카오톡 퍼가기'><img src='".$shop['mobile_url']."/img/sns_kakaotalk.png' border='0' width='30'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use4']) {

        echo "<td><a href='#' onclick=\"Kakao.Story.share({url: '".$shop['mobile_url']."/item.php?id=".$id."'}); return false;\" title='카카오스토리 퍼가기'><img src='".$shop['mobile_url']."/img/sns_kakaostory.png' border='0' width='30'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use5']) {

        echo "<td><a href='http://line.me/R/msg/text/?".urlencode(text($dmshop_item['item_title'],1))."%0d%0a".urlencode($shop['mobile_url']."/item.php?id=".$id)."' target='_blank' title='라인 퍼가기'><img src='".$shop['mobile_url']."/img/sns_line.png' border='0' width='30'></a></td>";
        echo "<td width='4'></td>";

    }

} else {

    if ($dmshop_design_item['sns_use1']) {

        echo "<td><a href='https://twitter.com/intent/tweet?url=".urlencode($shop['mobile_url']."/item.php?id=".$id)."&amp;text=".urlencode(text($dmshop_item['item_title'],1))."' target='_blank' title='트위터 퍼가기'><img src='".$shop['mobile_url']."/img/sns_twitter.png' border='0' width='30'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use2']) {

        echo "<td><a href='https://www.facebook.com/sharer/sharer.php?u=".urlencode($shop['mobile_url']."/item.php?id=".$id)."' target='_blank' title='페이스북 퍼가기'><img src='".$shop['mobile_url']."/img/sns_facebook.png' border='0' width='30'></a></td>";
        echo "<td width='4'></td>";

    }

    if ($dmshop_design_item['sns_use4']) {

        echo "<td><a href='https://story.kakao.com/share?url=".urlencode($shop['mobile_url']."/item.php?id=".$id)."' target='_blank' title='카카오스토리 퍼가기'><img src='".$shop['mobile_url']."/img/sns_kakaostory.png' border='0' width='30'></a></td>";
        echo "<td width='4'></td>";

    }

}
?>
</tr>
</table>
</div>
<!-- 상품 정보 박스 end //-->

<!-- 상세정보 start //-->
<? if ($dmshop_design_item['tab_use1']) { ?>
<div class="itemview">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div style="border:1px solid #eeeeee;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<?
echo text2($dmshop_item['item_text'], 1);
?></td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>
<? } ?>
<!-- 상세정보 end //-->

<!-- 상품 요약안내 start //-->
<? if ($dmshop_item['item_option1_text'] || $dmshop_item['item_option2_text'] || $dmshop_item['item_option3_text'] || $dmshop_item['item_option4_text'] || $dmshop_item['item_option5_text'] || $dmshop_item['item_option6_text'] || $dmshop_item['item_option7_text'] || $dmshop_item['item_option8_text'] || $dmshop_item['item_option9_text'] || $dmshop_item['item_option10_text']) { ?>
<div class="itemoption">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div style="border:1px solid #eeeeee;">
<div style="padding:5px 10px 3px 10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
for ($i=1; $i<=10; $i++) {

if ($dmshop_item["item_option".$i."_text"]) {
?>
<? if ($i > '1') { ?>
<tr height="1" bgcolor="#f2f2f2"><td colspan="3"></td></tr>
<? } ?>
<tr>
    <td width="80" align="right"><?=text($dmshop_item["item_option".$i])?></td>
    <td width="20" align="center">:</td>
    <td><?=text($dmshop_item["item_option".$i."_text"])?></td>
</tr>
<?
    }

}
?>
</table>
</div>
</div>
    </td>
</tr>
</table>
</div>
<? } ?>
<!-- 상품 요약안내 end //-->

<?
include_once("./_bottom.php");
?>