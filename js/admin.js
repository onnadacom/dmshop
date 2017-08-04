// 포커스
function shopfocusIn4(i)
{

    (i).style.border = "1px solid #027d94";

}

function shopfocusOut4(i)
{

    (i).style.border = "1px solid #c9c9c9";

}

function shopInfocus1(i)
{

    (i).style.border = "1px solid #027d94";
    (i).style.padding = "0px 3px 0px 3px";

}

function shopOutfocus1(i)
{

    (i).style.border = "1px solid #c9c9c9";
    (i).style.padding = "0px 3px 0px 3px";

}

function shopInfocus1_1(i)
{

    (i).style.border = "1px solid #027d94";

}

function shopOutfocus1_1(i)
{

    (i).style.border = "1px solid #e4e4e4";

}

function shopInfocus2(i)
{

    (i).style.border = "2px solid #027d94";
    (i).style.padding = "0px 5px 0px 5px";

}

function shopOutfocus2(i)
{

    (i).style.border = "2px solid #c9c9c9";
    (i).style.padding = "0px 5px 0px 5px";

}

function shopInfocus4(i)
{

    (i).style.border = "2px solid #027d94";

}

function shopOutfocus4(i)
{

    (i).style.border = "1px solid #c9c9c9";

}

// 리사이즈
function shopAdminViewResize()
{

    var h = $(".contents .view").height() + $(".top_menu").height();

    $(".contents").css( { 'height': h+'px'} );

}

// 통계 로딩
function reportingLoader(mode)
{

    var layer = $("#reporting_body");
    var loader = $("#reporting_loader");

    if (mode == 'start') {

        loader.hide();
        layer.hide();

        var win = $(window);
        var body = $(document);
        var loaderLeft = (win.scrollLeft() + (win.width() / 2)) - (loader.width() / 2);
        var loaderTop = (win.scrollTop() + (win.height() / 2)) - (loader.height() / 2);

        layer.show();
        loader.show();

        layer.css( { 'width': win.width()+'px', 'height': body.height()+'px', 'opacity' : '0.5' } );
        loader.css( { 'left': loaderLeft+'px', 'top': loaderTop+'px', 'opacity' : '1.0'} );

    } else {

        loader.hide();
        layer.hide();

    }

}

// 기획전 이동
function planMove(plan_id)
{

    if (plan_id == 'plan_list') {

        document.location.href = shop_path+"/adm/plan_list.php";

    } else {

        document.location.href = shop_path+"/adm/plan_item_list.php?plan_id="+plan_id;

    }

}

// 기획전 상품창
function planitemWrite(plan_id)
{

    shopOpen(shop_path+"/adm/plan_item_write.php?plan_id="+plan_id, "planitemWrite", "width=1000, height=800, scrollbars=yes");

}

// 아이콘 등록창
function iconWrite()
{

    shopOpen(shop_path+"/adm/icon_write.php", "iconWrite", "width=650, height=800, scrollbars=yes");

}

// 아이콘 수정창
function iconEdit(icon_id)
{

    shopOpen(shop_path+"/adm/icon_edit.php?icon_id="+icon_id, "iconEdit", "width=650, height=400, scrollbars=yes");

}

// 관련상품 등록
function relationWrite(item_id)
{

    if (!item_id) {

        alert("관련 상품 추가는 신규 상품 등록일 때는 사용하실 수 없습니다.\n\n상품을 등록한 후에 이용하여 주시기 바랍니다.");
        return false;

    }

    shopOpen(shop_path+"/adm/relation_write.php?item_id="+item_id, "relationWrite", "width=800, height=800, scrollbars=yes");

}

// 주문관리
function orderManage(tab, order_code)
{

    shopOpen(shop_path+"/adm/order_manage.php?tab="+tab+"&order_code="+order_code, "orderManage", "width=820, height=800, scrollbars=yes");

}

// 주문내역서
function orderPopupDetail(order_code)
{

    shopOpen(shop_path+"/adm/order_detail.php?order_code="+order_code, "orderDetail", "width=800, height=800, scrollbars=yes");

}

// 영수증 승인번호 입력
function orderPopupReceipt(order_code)
{

    shopOpen(shop_path+"/adm/order_receipt_write.php?order_code="+order_code, "orderReceiptWrite", "width=800, height=800, scrollbars=yes");

}

// 개별결제창 내역서
function payPopupDetail(pay_code)
{

    shopOpen(shop_path+"/adm/payment_detail.php?pay_code="+pay_code, "payPopupDetail", "width=800, height=800, scrollbars=yes");

}

// 쿠폰지급
function couponPopupMake(user_id)
{

    shopOpen(shop_path+"/adm/coupon_make.php?f=user_id&q="+user_id, "couponPopupMake", "width=800, height=800, scrollbars=yes");

}

// 쿠폰 자동지급 설정
function couponPopupAuto(coupon_id)
{

    shopOpen(shop_path+"/adm/coupon_auto.php?coupon_id="+coupon_id, "couponPopupAuto", "width=800, height=800, scrollbars=yes");

}

// 쿠폰 상세정보
function couponPopupView(coupon_id)
{

    shopOpen(shop_path+"/adm/coupon_view.php?coupon_id="+coupon_id, "couponPopupView", "width=800, height=800, scrollbars=yes");

}

// 쿠폰 지급목록 이동
function couponPage(page_id, coupon_id)
{

    if (page_id == '') {

        return false;

    }

    if (page_id == 'config') {

        document.location.href = shop_path+"/adm/coupon_config_list.php";

    }

    else if (page_id == 'make') {

        document.location.href = shop_path+"/adm/coupon_make_list.php?coupon_id="+coupon_id;

    } else {

        document.location.href = shop_path+"/adm/coupon_order_list.php?coupon_id="+coupon_id;

    }

}

// 회원관리
function userManage(tab, user_id)
{

    shopOpen(shop_path+"/adm/user_manage.php?tab="+tab+"&user_id="+user_id, "userManage", "width=800, height=800, scrollbars=yes");

}

// 적립금 지급
function cashPopupMake(c, user_id)
{

    shopOpen(shop_path+"/adm/cash_make.php?c="+c+"&f=user_id&q="+user_id, "cashPopupMake", "width=800, height=800, scrollbars=yes");

}

// 회원 레벨 변경
function userPopupLevel(user_id)
{

    shopOpen(shop_path+"/adm/user_level.php?f=user_id&q="+user_id, "userPopupLevel", "width=800, height=800, scrollbars=yes");

}

// 배너 그룹
function bannerGroup()
{

    shopOpen(shop_path+"/adm/banner_group.php", "bannerGroup", "width=800, height=800, scrollbars=yes");

}

// 1:1 문의 뷰
function helpPopupView(help_id)
{

    shopOpen(shop_path+"/adm/help_view.php?help_id="+help_id, "helpPopupView", "width=730, height=700, scrollbars=yes");

}

// 1:1 문의 작성
function helpPopupWrite(help_id)
{

    shopOpen(shop_path+"/adm/help_write.php?help_id="+help_id, "helpPopupWrite", "width=730, height=700, scrollbars=yes");

}

// 상품평 작성
function replyPopupWrite(reply_id)
{

    shopOpen(shop_path+"/adm/reply_write.php?reply_id="+reply_id, "replyPopupWrite", "width=730, height=700, scrollbars=yes");

}

// 상품평 뷰
function replyPopupView(reply_id)
{

    shopOpen(shop_path+"/adm/reply_view.php?reply_id="+reply_id, "replyPopupView", "width=730, height=700, scrollbars=yes");

}

// 상품문의 작성
function qnaPopupWrite(qna_id)
{

    shopOpen(shop_path+"/adm/qna_write.php?qna_id="+qna_id, "qnaPopupWrite", "width=730, height=700, scrollbars=yes");

}

// 상품문의 뷰
function qnaPopupView(qna_id)
{

    shopOpen(shop_path+"/adm/qna_view.php?qna_id="+qna_id, "qnaPopupView", "width=730, height=700, scrollbars=yes");

}

// 바로가기 설정
function bookmakrPopup()
{

    shopOpen(shop_path+"/adm/bookmark.php", "bookmakrPopup", "width=600, height=580, scrollbars=no");

}