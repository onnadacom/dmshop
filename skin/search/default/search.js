// 상품검색
function itemSearch(sort)
{

    var f = document.formItemSearch;

    if (f.q.value == query) {

        f.q.value = "";

    }

    if (sort) {

        if (sort == 'search') {

            // pass

        } else {

            f.sort.value = sort;

        }

        f.submit();

    } else {

        if (!f.q.value) {

            alert("검색어를 입력하십시오."); 
            f.q.focus();
            return false;

        }

    }

}

// 키워드 리셋
function itemSearchReset()
{

    var f = document.formItemSearch;

    if (f.q.value == query) {

        f.q.value = "";

    }

}

// 키워드 리셋
function itemSearchAdd()
{

    var f = document.formItemSearch;

    if (f.q.value != '' && f.q.value != query) {

        if (f.add.value == '') {

            f.add.value = f.q.value;

        } else {

            f.add.value = f.add.value+","+f.q.value;

        }

    }

    f.q.value = "";

}

// 색상
function itemColor(color)
{

    var f = document.formItemSearch;

    f.color.value = color;

    itemSearch('search');

}

// 색상 레이어
function itemColorView()
{

    var f = document.formItemSearch;

    if (f.cv.checked == true) {

        $("#color_layer").show();

    } else {

        $("#color_layer").hide();
        f.color.value = "";

    }

}

// 분류
function itemCategory(ct_id)
{

    var f = document.formItemSearch;

    f.ct_id.value = ct_id;

    itemSearch('search');

}

// 장바구니
function itemCart(item_id)
{

    $.post(shop_path+"/item_option_check.php", {"item_id" : item_id}, function(data) {

        $("#item_data").html(data);

        var f = document.formItem;

        $.post(shop_path+"/cart_update.php", {"item_id" : item_id, "order_option" : f.order_option.value, "order_limit" : "1", "cart_type" : "cart"}, function(data) {

            $("#item_data").html(data);

        });

    });

}

// 보관함
function itemFavorite(item_id)
{

    $.post(shop_path+"/item_option_check.php", {"item_id" : item_id}, function(data) {

        $("#item_data").html(data);

        var f = document.formItem;

        $.post(shop_path+"/favorite_update.php", {"item_id" : item_id, "order_option" : f.order_option.value, "order_limit" : "1"}, function(data) {

            $("#item_data").html(data);

        });

    });

}

// 이하 선택처리
function checkAll(mode)
{

    $('.search_item .chk_id input').attr('checked', mode);

}

// 미선택
function checkConfirm(msg)
{

    var n = $('.search_item .chk_id input:checked').length;

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

    f.m.value = "listall";

    f.action = shop_path+"/cart_update.php";
    f.submit();

}

// 선택보관
function checkFavorite()
{

    var msg = "보관함";
    if (!checkConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "listall";

    f.action = shop_path+"/favorite_update.php";
    f.submit();

}

// 미리보기
function itemPreview(id)
{

    if (id == '') {

        return false;

    }

    $("#item_preview").hide();

    $.post(shop_path+"/item_preview.php", {"id" : id}, function(data) {

        $("#item_preview").html(data);

    });

}