// 전체 선택
function checkAll(mode)
{

    $('.cart_list .chk_id input').attr('checked', mode);

}

// 미선택
function checkConfirm(msg)
{

    var n = $('.cart_list .chk_id input:checked').length;

    if (n <= '0') {

        alert(msg + "할 상품을 선택하세요.");
        return false;

    }

    return true;

}

// 선택주문
function checkOrder()
{

    var msg = "주문";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "all";

    f.action = "order.php";
    f.submit();

}

// 선택보관
function checkFavorite()
{

    var msg = "보관";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "all";

    if (!confirm("선택하신 상품을 보관하시겠습니까?")) {

        return false;

    }

    f.action = "favorite_update.php";
    f.submit();

}

// 선택삭제
function checkDelete()
{

    var msg = "삭제";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "alld";

    if (!confirm("선택하신 상품을 장바구니에서 삭제하시겠습니까?")) {

        return false;

    }

    f.action = "cart_update.php";
    f.submit();

}

// 수량변경
function cartLimit(cart_id, item_id, order_option)
{

    var f = document.formUpdate;

    f.m.value = "u";
    f.cart_id.value = cart_id;
    f.item_id.value = item_id;
    f.order_option.value = order_option;
    f.order_limit.value = document.getElementById("order_limit_"+cart_id).value;

    f.action = "cart_update.php";
    f.submit();

}

// 주문
function cartOrder(cart_id)
{

    var f = document.formUpdate;

    f.m.value = "";
    f.cart_id.value = cart_id;

    f.action = "order.php";
    f.submit();

}

// 보관
function cartFavorite(cart_id)
{

    var f = document.formUpdate;

    f.m.value = "cart";
    f.cart_id.value = cart_id;

    f.action = "favorite_update.php";
    f.submit();

}

// 삭제
function cartDelete(cart_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.cart_id.value = cart_id;

    if (!confirm("해당 상품을 장바구니에서 삭제하시겠습니까?")) {

        return false;

    }

    f.action = "cart_update.php";
    f.submit();

}

// 계속쇼핑
function cartBack()
{

    history.go(-1);

}