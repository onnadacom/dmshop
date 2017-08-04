// 전체 선택
function checkAll(mode)
{

    $('.favorite_list .chk_id input').attr('checked', mode);

}

// 미선택
function checkConfirm(msg)
{

    var n = $('.favorite_list .chk_id input:checked').length;

    if (n <= '0') {

        alert(msg + "할 상품을 선택하세요.");
        return false;

    }

    return true;

}

// 선택장바구니
function checkCart()
{

    var msg = "장바구니";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "all";

    if (!confirm("선택하신 상품을 장바구니로 이동하시겠습니까?")) {

        return false;

    }

    f.action = shop_path+"/cart_update.php";
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

    if (!confirm("선택하신 상품을 관심상품에서 삭제하시겠습니까?")) {

        return false;

    }

    f.action = shop_path+"/favorite_update.php";
    f.submit();

}

// 주문 (카트에 담는다)
function favoriteOrder(item_id, order_option, order_limit)
{

    var f = document.formUpdate;

    $('#order_start').val('');

    $.post(shop_path+"/cart_update.php", {"item_id" : item_id, "order_option" : order_option, "order_limit" : order_limit, "cart_type" : "order"}, function(data) {

        $("#item_cart_data").html(data);

        orderPage();

    });

}

// 주문처리
function orderPage()
{

    if ($('#order_start').val() == '') { return false; }

    var f = document.formUpdate;

    f.m.value = "";
    f.cart_type.value = "order";

    f.action = shop_path+"/order.php";
    f.submit();

}

// 장바구니
function favoriteCart(favorite_id)
{

    var f = document.formUpdate;

    f.m.value = "favorite";
    f.favorite_id.value = favorite_id;

    f.action = shop_path+"/cart_update.php";
    f.submit();

}

// 삭제
function favoriteDelete(favorite_id)
{

    var f = document.formUpdate;

    f.m.value = "d";
    f.favorite_id.value = favorite_id;

    if (!confirm("해당 상품을 관심상품에서 삭제하시겠습니까?")) {

        return false;

    }

    f.action = shop_path+"/favorite_update.php";
    f.submit();

}