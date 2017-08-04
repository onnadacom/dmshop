<?php
include_once("./_dmshop.php");
if ($coupon_id) { $coupon_id = preg_match("/^[0-9]+$/", $coupon_id) ? $coupon_id : ""; }
$top_id = "2";
$left_id = "5";

if ($m == '') {

    $menu_id = "201";
    $shop['title'] = "쿠폰 등록";

} else {

    $menu_id = "200";
    $shop['title'] = "쿠폰 수정";

}

include_once("./_top.php");

$colspan = "6";

if ($m == '') {

    $dmshop_coupon = array();
    $dmshop_coupon['coupon_type'] = "0";
    $dmshop_coupon['coupon_number_type'] = "0";
    $dmshop_coupon['coupon_max'] = "0";
    $dmshop_coupon['coupon_discount'] = "0";
    $dmshop_coupon['coupon_discount_type'] = "0";
    $dmshop_coupon['coupon_discount_min'] = "0";
    $dmshop_coupon['coupon_discount_max'] = "0";
    $dmshop_coupon['coupon_day_type'] = "0";
    $dmshop_coupon['coupon_date1'] = $shop['time_ymd'];
    $dmshop_coupon['coupon_category_type'] = "0";
    $dmshop_coupon['coupon_image_type'] = "0";
    $dmshop_coupon['coupon_image'] = "1";

}

else if ($m == 'u') {

    if (!$coupon_id) {

        alert(" 쿠폰이 삭제되었거나 존재하지 않습니다.");

    }

    $dmshop_coupon = shop_coupon($coupon_id);

    if (!$dmshop_coupon['id']) {

        alert("쿠폰이 삭제되었거나 존재하지 않습니다.");

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}
?>
<style type="text/css">
.contents_box {min-width:1100px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    couponLoad();

});

function couponSubmit()
{

    var f = document.formCoupon;

    if (f.coupon_title.value == '') {

        alert('쿠폰명을 입력하십시오.');
        f.coupon_title.focus();
        return false;

    }

    if (f.coupon_discount.value == '' || f.coupon_discount.value == '0') {

        alert('할인금액(할인비율)을 입력하십시오.');
        f.coupon_discount.focus();
        return false;

    }

    if (f.coupon_discount_type[1].checked == true) {

        if (parseInt(f.coupon_discount.value) >= '100') {

            alert('할인비율은 최대 99까지 입력이 가능합니다.');
            f.coupon_discount.focus();
            return false;

        }

    }

    if (f.coupon_day_type[0].checked == true) {

        if (f.coupon_date1.value == '') {

            alert('날짜를 입력하십시오.');
            f.coupon_date1.focus();
            return false;

        }

        if (f.coupon_date2.value == '') {

            alert('날짜를 입력하십시오.');
            f.coupon_date2.focus();
            return false;

        }

    }

    if (f.coupon_day_type[1].checked == true) {

        if (f.coupon_day.value == '') {

            alert('날짜를 입력하십시오.');
            f.coupon_day.focus();
            return false;

        }

    }

    if (!confirm("생성하시겠습니까?")) {

        return false;

    }

    f.action = "./coupon_config_update.php";
    f.submit();

}

function couponNumberType(id)
{

    if (id == '1') {

        $('#coupon_number_type_layer').show();
        $('#coupon_image_type_layer').hide();

    } else {

        $('#coupon_number_type_layer').hide();
        $('#coupon_image_type_layer').show();

    }

}

function couponLoad()
{

    var f = document.formCoupon;

    // 인쇄용
    if (f.coupon_type[1].checked == true) {

        return false;

    }

    if (f.coupon_image_type[0].checked == true) {

        document.getElementById("preview_image").style.backgroundImage = "url('<?=$shop['image_path']?>/coupon/"+f.coupon_image.value+".jpg')";

    }

    if (f.coupon_discount_type[0].checked == true) {

        var coupon_discount_type = "0";

    } else {

        var coupon_discount_type = "1";

    }

    if (f.coupon_day_type[0].checked == true) {

        var coupon_day_type = "0";

    } else {

        var coupon_day_type = "1";

    }

    $.post("./coupon_config_data.php", {"coupon_discount" : f.coupon_discount.value, "coupon_discount_type" : coupon_discount_type, "coupon_day_type" : coupon_day_type, "coupon_day" : f.coupon_day.value, "coupon_date1" : f.coupon_date1.value, "coupon_date2" : f.coupon_date2.value}, function(data) {

        $("#preview_image").html(data);

    });

}
</script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="listname">쿠폰 생성</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<form method="post" name="formCoupon" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="coupon_id" value="<?=$coupon_id?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="30" bgcolor="#f5f5f5">
    <td colspan="<?=$colspan?>" class="guide_m">:: 쿠폰명, 사용기간, 할인금액 및 이용범위 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td class="subject">쿠폰유형</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="coupon_type" value="0" class="radio" onclick="couponNumberType('0');" <? if ($dmshop_coupon['coupon_type'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_type', '0'); couponNumberType('0');"><?=shop_coupon_type("0");?> 쿠폰</td>
    <td width="20"></td>
    <td><input type="radio" name="coupon_type" value="1" class="radio" onclick="couponNumberType('1');" <? if ($dmshop_coupon['coupon_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_type', '1'); couponNumberType('1');"><?=shop_coupon_type("1");?> 쿠폰</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
<tr>
    <td class="help1">일반 쿠폰 : 쇼핑몰의 이벤트 페이지/상품페이지 등에 삽입하여, 쿠폰 이미지 클릭을 통해 지급되는 쿠폰.</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
<tr>
    <td class="help1">인쇄용 쿠폰 : 명함/전단지 등에 인쇄하여, 쇼핑몰의 쿠폰등록 페이지에 시리얼 번호를 입력하여, 지급되는 쿠폰. (자동지급 설정불가)</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<div id="coupon_number_type_layer" style="display:<? if ($dmshop_coupon['coupon_type'] == '1') { echo "inline"; } else { echo "none"; } ?>;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60">
    <td></td>
    <td class="subject">쿠폰번호 유형</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="coupon_number_type" value="0" class="radio" <? if ($dmshop_coupon['coupon_number_type'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_number_type', '0');">랜덤 생성</td>
    <td width="30"></td>
    <td><input type="radio" name="coupon_number_type" value="1" class="radio" <? if ($dmshop_coupon['coupon_number_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_number_type', '1');">고정 생성</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="60">
    <td></td>
    <td class="subject">쿠폰명</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="coupon_title" value="<?=text($dmshop_coupon['coupon_title'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
    <td width="10"></td>
    <td class="help1">이용 카테고리 및 이용조건 등의 내용을 담아 입력 (예 : 여름신상 카테고리 5000원 할인쿠폰 or 현금결제 10% 할인쿠폰)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">발행매수</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="coupon_max" value="<?=text($dmshop_coupon['coupon_max'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td class="tx2">매</td>
    <td width="10"></td>
    <td class="help1">입력된 수량만큼 쿠폰이 발행 됩니다. 소진시 회원은 쿠폰을 다운로드 하실 수 없습니다. (숫자 0 입력시 발행매수 무제한)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">할인금액 설정</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<script type="text/javascript">
function discountLayer(mode)
{

    if (mode == '1') {

        $("#coupon_discount_max_layer").show();

    } else {

        $("#coupon_discount_max_layer").hide();

    }

}
</script>

<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="coupon_discount" value="<?=text($dmshop_coupon['coupon_discount'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:60px;" onclick="couponLoad();" onkeyup="couponLoad();" /></td>
    <td width="5"></td>
    <td><input type="radio" name="coupon_discount_type" value="0" class="radio" <? if ($dmshop_coupon['coupon_discount_type'] == '0') { echo "checked"; } ?> onclick="discountLayer('0'); couponLoad();" /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_discount_type', '0'); discountLayer('0'); couponLoad();"><?=shop_coupon_discount_type("0");?></td>
    <td width="30"></td>
    <td><input type="radio" name="coupon_discount_type" value="1" class="radio" <? if ($dmshop_coupon['coupon_discount_type'] == '1') { echo "checked"; } ?> onclick="discountLayer('1'); couponLoad();" /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_discount_type', '1'); discountLayer('0'); couponLoad();"><?=shop_coupon_discount_type("1");?> (퍼센트)</td>
</tr>
</table>

<div id="coupon_discount_max_layer" style="display:<? if ($dmshop_coupon['coupon_discount_type'] == '1') { echo "inline"; } else { echo "none"; } ?>;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">최대할인 금액</td>
    <td width="5"></td>
    <td><input type="text" name="coupon_discount_max" value="<?=text($dmshop_coupon['coupon_discount_max'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td class="tx2">원</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td class="help1">%할인쿠폰일 경우 최대할인 금액을 지정하실 수 있습니다. (예: 상품가 1,000,000원 - 10%할인쿠폰(최대할인 금액 50,000원) = 950,000원)</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
<tr>
    <td class="help1">(숫자 0 입력시 최대할인 금액 한도 없음)</td>
</tr>
</table>
</div>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">사용조건</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="coupon_discount_min" value="<?=text($dmshop_coupon['coupon_discount_min'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td class="tx2">원 이상 상품 주문시</td>
    <td width="10"></td>
    <td class="help1">입력하신 가격 이상의 상품 주문시에만 적용이 가능 합니다. (숫자 0 입력시 사용조건 없음)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">사용기간</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="coupon_day_type" value="0" class="radio" <? if ($dmshop_coupon['coupon_day_type'] == '0') { echo "checked"; } ?> onclick="couponLoad();" /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_day_type', '0'); couponLoad();">고정기간</td>
    <td width="10"></td>
    <td><input type="text" id="coupon_date1" name="coupon_date1" value="<?=text($dmshop_coupon['coupon_date1'])?>" onFocus="shopInfocus1(this); shopElementFocus('formCoupon', 'coupon_day_type', '0'); couponLoad();" onBlur="shopOutfocus1(this);" onkeyup="couponLoad();" class="input" style="width:70px;" /></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopDate('coupon_date1'); shopElementFocus('formCoupon', 'coupon_day_type', '0'); return false;"><img src="<?=$shop['image_path']?>/adm/calendar.gif" border="0"></a></td>
    <td width="55" align="center" class="tx2">부터 ~</td>
    <td><input type="text" id="coupon_date2" name="coupon_date2" value="<?=text($dmshop_coupon['coupon_date2'])?>" onFocus="shopInfocus1(this); shopElementFocus('formCoupon', 'coupon_day_type', '0'); couponLoad();" onBlur="shopOutfocus1(this);" onkeyup="couponLoad();" class="input" style="width:70px;" /></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopDate('coupon_date2'); shopElementFocus('formCoupon', 'coupon_day_type', '0'); return false;"><img src="<?=$shop['image_path']?>/adm/calendar.gif" border="0"></a></td>
    <td width="10"></td>
    <td class="tx2">까지</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
<tr>
    <td class="help1">쿠폰을 사용할 수 있는 시작일과 종료일을 입력 합니다. 해당기간 경과후 쿠폰은 자동소멸 됩니다. (시간은 시작일 자정 00시, 종료일 24시를 기준)</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><input type="radio" name="coupon_day_type" value="1" class="radio" <? if ($dmshop_coupon['coupon_day_type'] == '1') { echo "checked"; } ?> onclick="couponLoad();" /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_day_type', '1'); couponLoad();">발급일로 부터</td>
    <td width="10"></td>
    <td><input type="text" name="coupon_day" value="<?=text($dmshop_coupon['coupon_day'])?>" onFocus="shopInfocus1(this); shopElementFocus('formCoupon', 'coupon_day_type', '1'); couponLoad();" onBlur="shopOutfocus1(this);" onkeyup="couponLoad();" class="input" style="width:40px;" /></td>
    <td width="10"></td>
    <td class="tx2">일간</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
<tr>
    <td class="help1">발급일은 회원이 쿠폰을 취득한 날을 말하며, 발급일로 부터 입력된 기간 내에만 이용가능 합니다. 해당기간 경과후 쿠폰은 자동소멸 됩니다.</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">이용 카테고리</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="coupon_category_type" value="0" class="radio" <? if ($dmshop_coupon['coupon_category_type'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_category_type', '0');">카테고리</td>
    <td width="10"></td>
    <td>
<select id="coupon_category" name="coupon_category" class="select" onclick="shopElementFocus('formCoupon', 'coupon_category_type', '0');">
    <option value="">전체</option>
<?
$result = sql_query(" select * from $shop[category_table] where view = '1' order by position asc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    echo "<option value='".text($row['id'])."'>".text($row['subject'])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#coupon_category").val("<?=text($dmshop_coupon['coupon_category'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="tx2">에서 사용가능</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
<tr>
    <td class="help1">선택하신 카테고리 메뉴 내에서만 해당 쿠폰을 이용할 수 있습니다.</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><input type="radio" name="coupon_category_type" value="1" class="radio" <? if ($dmshop_coupon['coupon_category_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_category_type', '1');">기획전</td>
    <td width="10"></td>
    <td>
<select id="coupon_plan" name="coupon_plan" class="select" onclick="shopElementFocus('formCoupon', 'coupon_category_type', '1');">
    <option value="">전체</option>
<?
$result = sql_query(" select * from $shop[plan_table] where view = '1' order by datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    echo "<option value='".text($row['id'])."'>".text($row['title'])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#coupon_plan").val("<?=text($dmshop_coupon['coupon_plan'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="tx2">에서 사용가능</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
<tr>
    <td class="help1">선택하신 기획전 메뉴 내에서만 해당 쿠폰을 이용할 수 있습니다.</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">기타 이용제한</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="checkbox" name="coupon_bank" value="1" class="checkbox" <? if ($dmshop_coupon['coupon_bank'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formCoupon', 'coupon_bank');">결제수단 (무통장 입금) 외 적용불가</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><input type="checkbox" name="coupon_cash" value="1" class="checkbox" <? if ($dmshop_coupon['coupon_cash'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formCoupon', 'coupon_cash');">적립금 이용시 적용불가</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><input type="checkbox" name="coupon_overlap" value="1" class="checkbox" <? if ($dmshop_coupon['coupon_overlap'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formCoupon', 'coupon_overlap');">중복 다운로드 및 등록 불가 (회원 1인당 1장만 발급)</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<div id="coupon_image_type_layer" style="display:<? if ($dmshop_coupon['coupon_type'] == '0') { echo "inline"; } else { echo "none"; } ?>;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr><td colspan="<?=$colspan?>" height="1"></td></tr>
<tr height="30" bgcolor="#f5f5f5">
    <td colspan="<?=$colspan?>" class="guide_m">:: 쿠폰 디자인 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject">쿠폰 이미지 설정</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="coupon_image_type" value="0" class="radio" <? if ($dmshop_coupon['coupon_image_type'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_image_type', '0');">기본 이미지</td>
    <td width="10"></td>
    <td>
<select id="coupon_image" name="coupon_image" class="select" onchange="couponLoad();">
    <option value="1">type01</option>
    <option value="2">type02</option>
</select>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><div id="preview_image" style="width:400px; height:140px; background:url('<?=$shop['image_path']?>/coupon/<?=text($dmshop_coupon['coupon_image'])?>.jpg') no-repeat;"></div></td>
</tr>
</table>

<script type="text/javascript">
$("#coupon_image").val("<?=text($dmshop_coupon['coupon_image'])?>");
</script>

<?
$file = shop_coupon_file($coupon_id, "default");
?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><input type="radio" name="coupon_image_type" value="1" class="radio" <? if ($dmshop_coupon['coupon_image_type'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formCoupon', 'coupon_image_type', '1');">이미지 직접등록</td>
    <td width="10"></td>
    <td><input type="file" name="file_default" class="file" size="34" onchange="shopFile(document.getElementById('preview_image'), this);" onkeydown="return false;" onclick="shopElementFocus('formCoupon', 'coupon_image_type', '1');" /></td>
<? if ($file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_coupon.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_default" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td><span class="filedel">삭제</span></td>
<? } ?>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<script type="text/javascript">
document.getElementById("preview_image").style.backgroundImage = "url('<?=$shop['path']?>/data/coupon/<?=shop_data_path("u", $file['datetime'])?>/<?=$file['upload_file']?>')";
</script>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td class="help1">직접 디자인한 쿠폰 이미지를 업로드 합니다. (JPG/GIF/PNG, 권장 사이즈 가로 400px / 세로 140px)</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="couponSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./coupon_config_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 입력하신 정보를 바탕으로 쿠폰이 생성됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>