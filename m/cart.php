<?php
include_once("./_dmshop.php");

// 스킨이 없다.
if (!$dmshop_skin['skin_cart']) {

    message("<p class='title'>알림</p><p class='text'>장바구니 스킨이 설정되지 않았습니다.</p>", "b");

}

// 기간만료 장바구니 삭제
$result = sql_query(" select * from $shop[cart_table] where datetime < '".date("Y-m-d H:i:s", $shop['server_time'] - (86400 * $dmshop['cart_day']))."' ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 적용중인 쿠폰 미사용으로 변경
    sql_query(" update $shop[coupon_list_table] set coupon_mode  = '0', cart_id = '0' where cart_id = '".addslashes($row['id'])."' ");

    // 장바구니 삭제
    sql_query(" delete from $shop[cart_table] where id = '".addslashes($row['id'])."' ");

}

// 비회원용
$guest_id = "";
$guest_id = shop_get_cookie("dmshop_cart");

// 로그인
if ($shop_user_login) {

    // 비회원 장바구니를 회원으로 변경
    sql_query(" update $shop[cart_table] set user_id = '".$dmshop_user['user_id']."', guest_id = '' where user_id = '' and guest_id = '".addslashes($guest_id)."' ");

}

// 검색조건
$sql_search = "";

if ($shop_user_login) {

    $sql_search = " where user_id = '".$dmshop_user['user_id']."' ";

} else {

    $sql_search = " where guest_id = '".addslashes($guest_id)."' and user_id = '' ";

}

// 가격 초기화
$order_total_item_money = 0;
$order_total_coupon = 0;
$order_delivery_money = 0;
$order_total_money = 0;

// 묶음배송
$delivery_money_free = false;

// 배송비 선결제
$order_delivery_pay = false;

// 장바구니
$list = array();
$result = sql_query(" select * from $shop[cart_table] $sql_search order by datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 상품정보
    $dmshop_item = shop_item($row['item_id']);

    // 상품이 없다.
    if (!$dmshop_item['id']) {

        // 장바구니에서 삭제
        sql_query(" delete from $shop[cart_table] where id = '".$row['id']."' ");

        // 다시 로드
        shop_url("{$shop['mobile_url']}/cart.php");

    }

    // 옵션 초기화
    unset($dmshop_item_option);

    // 옵션 가격 문구 초기화
    $option_money = "";

    // 옵션
    if ($row['order_option']) {

        // 옵션정보
        $dmshop_item_option = shop_item_option($row['order_option']);

        if ($dmshop_item_option['option_money'] > '0') {

            $option_money = " (+".number_format($dmshop_item_option['option_money'])."원)";

        }

        else if ($row['option_money'] < '0') {

            $option_money = " (".number_format($dmshop_item_option['option_money'])."원)";

        } else {

            $option_money = "";

        }

    }

    // 옵션 금액이 없다면
    if (!$dmshop_item_option['option_money']) {

        // 옵션 가격 초기화(옵션이 없을경우를 처리)
        $dmshop_item_option['option_money'] = 0;

    }

    // 판매 가격 (옵션가격 포함)
    $order_item_money = ($dmshop_item['item_money'] * $row['order_limit']) + ((int)($dmshop_item_option['option_money']) * $row['order_limit']);

    // 판매가 합계
    $order_total_item_money += $order_item_money;

    // 쿠폰 합계
    $order_total_coupon += $row['order_coupon'];

    // 기타 설정
    $list[$i]['item_code'] = $dmshop_item['item_code']; // 상품코드
    $list[$i]['item_title'] = $dmshop_item['item_title']; // 상품제목
    $list[$i]['option_name'] = $dmshop_item_option['option_name']; // 옵션명
    $list[$i]['option_money'] = $option_money; // 옵션금액 (위에서 메세지를 따로 처리 하였다.)
    $list[$i]['order_item_money'] = $order_item_money; // 옵션포함 상품가격
    $list[$i]['item_delivery'] = $dmshop_item['item_delivery']; // 배송비
    $list[$i]['item_delivery_bunch'] = $dmshop_item['item_delivery_bunch']; // 묶음배송

    $item_delivery = 0;

    // 배송비
    if ($list[$i]['item_delivery']) {

        // 묶음배송
        if ($list[$i]['item_delivery_bunch']) {

            $delivery_money_free = true;

            $list[$i]['delivery_type'] = 1;

            $list[$i]['item_delivery'] = 0;

            // 선결제
            if (!$list[$i]['order_delivery_pay']) {

                $order_delivery_pay = true;

            }

        } else {
        // 묶음배송이 아니다면 추가배송비

            $list[$i]['delivery_type'] = 2;

            // 착불
            if ($list[$i]['order_delivery_pay']) {

                $item_delivery = 0;

            } else {
            // 착불이 아닐 때

                $order_delivery_money += $list[$i]['item_delivery'];
                $list[$i]['item_delivery'] = $list[$i]['item_delivery'];

                $item_delivery = $list[$i]['item_delivery'];

            }

        }

    } else {
    // 배송비 없음 (묶음배송)

        $delivery_money_free = true;

        $list[$i]['delivery_type'] = 0;

        $list[$i]['item_delivery'] = 0;

        // 선결제
        if (!$list[$i]['order_delivery_pay']) {

            $order_delivery_pay = true;

        }

    }

    $list[$i]['order_total_money'] = ($order_item_money + $item_delivery) - $row['order_coupon']; // 옵션포함상품가, 배송비, 쿠폰적용 (해당 상품의 결제가격이다)

}

if ($i) {

    // 판매가 합계가 무료배송비 미만
    if ($order_delivery_pay && $delivery_money_free && $order_total_item_money < $dmshop['delivery_money_free']) {

        // 기본 배송비
        $order_delivery_money += $dmshop['delivery_money'];

    }

    // 결제 총액 (옵션포함 총 판매가격 - 총 쿠폰가격 + 배송비)
    $order_total_money = ($order_total_item_money - $order_total_coupon) + $order_delivery_money;

}

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 장바구니";

include_once("./_top.php");
$colspan = 15;
?>
<style type="text/css">
.conts .main {padding:5px 10px 15px 10px;}
.conts .main .text {font-weight:400; line-height:30px; font-size:12px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}

#order_cash {width:52px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
#order_cash {font-weight:bold; line-height:17px; font-size:12px; color:#3197f0; font-family:dotum,돋움;}

.conts .main .input {width:30px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.conts .main .input {line-height:17px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.conts .main .step {font-weight:800; line-height:30px; font-size:15px; color:#333333; font-family:'Nanum Gothic',gulim,serif;}
</style>

<script type="text/javascript" src="<?=$shop['mobile_url']?>/js/cart.js"></script>

<form method="post" name="formUpdate">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="item_id" value="" />
<input type="hidden" name="cart_id" value="" />
<input type="hidden" name="order_limit" value="" />
<input type="hidden" name="order_option" value="" />
</form>

<!-- 리스트 start //-->
<form method="post" name="formList" autocomplete="off" class="cart_list">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="submit" value="ok" disabled style="display:none;" />
<?
$item_delivery_bunch = false;

for ($i=0; $i<count($list); $i++) {

    $thumb = shop_item_thumb($list[$i]['item_id'], "default", "", "82", "82", "2");
    if (!file_exists($thumb)) { $thumb = $shop['mobile_url']."/img/noimage.gif"; }
?>
<input type="hidden" name="cart_id[<?=$i?>]" value="<?=$list[$i]['id']?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px; border:1px solid #eeeeee;" class="text">
<tr>
    <td width="30" align="center" class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" checked class="checkbox" /></td>
    <td width="84"><div style="border:1px solid #e0e0e0; width:82px; height:82px;"><a href="item.php?id=<?=$list[$i]['item_code']?>"><img src="<?=$thumb?>" width="82" height="82" border="0"></a></div></td>
    <td width="15"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="item.php?id=<?=$list[$i]['item_code']?>" class="title"><?=$list[$i]['item_title']?></a></td>
</tr>
</table>

<? if ($list[$i]['order_option']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>옵션 : <?=$list[$i]['option_name']?><?=$list[$i]['option_money']?></td>
</tr>
</table>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>수량 :</td>
    <td width="5"></td>
    <td><input type="text" id="order_limit_<?=$list[$i]['id']?>" name="order_limit[<?=$i?>]" class="input" value="<?=$list[$i]['order_limit']?>" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="cartLimit('<?=$list[$i]['id']?>', '<?=$list[$i]['item_id']?>', '<?=$list[$i]['order_option']?>'); return false;"><img src="<?=$shop['mobile_url']?>/img/limit.gif" align="absmiddle" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>주문금액 : <?=number_format($list[$i]['order_item_money'])?> 원</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<?
echo "배송비 : ";

if ($list[$i]['delivery_type'] == 2) {

    if ($list[$i]['order_delivery_pay']) {

        echo "착불";

    } else {

        echo "선결제";

    }

    echo " ".number_format($list[$i]['item_delivery'])." 원";

    echo "(묶음배송불가)";

} else {

    if ($order_total_item_money >= $dmshop['delivery_money_free']) {

        echo "묶음배송무료";

    } else {

        if (!$item_delivery_bunch) {

            if ($order_delivery_pay) {

                echo "선결제";

            } else {

                echo "착불";

            }

            echo " ".number_format($dmshop['delivery_money'])." 원";

        }

        echo "(묶음배송)";

        $item_delivery_bunch = true;

    }

}
?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="#" onclick="cartOrder('<?=$list[$i]['id']?>'); return false;"><img src="<?=$shop['mobile_url']?>/img/order.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="cartDelete('<?=$list[$i]['id']?>'); return false;"><img src="<?=$shop['mobile_url']?>/img/delete.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>
<? } ?>
</form>
<!-- 리스트 end //-->

<? if ($i) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_btn">
<tr height="34" bgcolor="#f5f5f5">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="msg">선택상품</td>
    <td width="7"></td>
    <td><a href="#" onclick="checkDelete(); return false;"><img src="<?=$shop['mobile_url']?>/img/check_delete.gif" align="absmiddle" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>

<!-- 결제금액합산 start //-->
<div style="margin-top:10px; border:1px solid #eeeeee;" class="text">
<div style="padding:5px 10px 3px 10px;">

<b class="step">장바구니 주문금액</b><br />

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="80">주문금액</td>
    <td><?=number_format($order_total_item_money);?>원</td>
</tr>
<tr>
    <td width="80">배송비</td>
    <td><?=number_format($order_delivery_money);?>원</td>
</tr>
<tr>
    <td>쿠폰할인</td>
    <td><?=number_format($order_total_coupon);?>원</td>
</tr>
<tr>
    <td>결제금액</td>
    <td><?=number_format($order_total_money);?>원</td>
</tr>
</table>
</div>
</div>
<!-- 결제금액합산 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#6b6b6b" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="checkOrder(); return false;"><img src="<?=$shop['mobile_url']?>/img/cart_order.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>
<? } else { ?>
<div style="margin-top:10px; border:1px solid #eeeeee;" class="text">
<div style="padding:5px 10px 3px 10px; text-align:center; line-height:100px;">
장바구니에 담긴 상품이 없습니다.
</div>
</div>
<? } ?>
<?
include_once("./_bottom.php");
?>