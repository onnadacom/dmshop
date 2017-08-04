// 결제수단별 메세지
var order_pay_msg1 = "<font color='#6d71d0'>[신용카드]</font> 온라인상에서 소유하신 신용카드를 통해, 전자결제를 진행 합니다.";
var order_pay_msg2 = "<font color='#6d71d0'>[실시간 계좌이체]</font> 주민번호, 계좌정보, 공인인증서를 통해 실시간 계좌이체를 진행 합니다.";
var order_pay_msg3 = "<font color='#6d71d0'>[휴대폰 결제]</font> 휴대폰 번호와 주민번호를 이용하여, SMS 인증을 통한 결제가 진행 됩니다.";
var order_pay_msg4 = "<font color='#6d71d0'>[가상계좌]</font> 원하시는 은행으로 가상계좌를 발급해 드리며, 발급된 계좌로 구매대금을 직접 송금 합니다.";
var order_pay_msg5 = "<font color='#6d71d0'>[무통장 입금]</font> 쇼핑몰의 대표 계좌로 구매대금을 직접 송금 합니다.";

// 주문체크
function orderCheck()
{

    var f = document.formOrder;

    // 적립금 사용
    if (user_cash_use) {

        var order_cash = parseInt(document.getElementById("order_cash").value);
    
        // 공백
        if (document.getElementById("order_cash").value == '') {
    
            // 0원으로 설정
            var order_cash = parseInt(0);
    
        }
    
        if (!shopNumeric(document.getElementById("order_cash").value)) {
    
            alert("숫자만 입력하여 주세요.");
            document.getElementById("order_cash").value = "0";
            orderCheck();
            return false;
    
        }

        if (document.getElementById("order_cash").value.charAt(0) == '0' && document.getElementById("order_cash").value.length > 1) {
    
            alert("적립금의 첫문자는 '0'로 시작할 수 없습니다.");
            document.getElementById("order_cash").value = "0";
            orderCheck();
            return false;
    
        }

        if (user_cash < order_cash_min && order_cash) {

            alert("보유하신 적립금이 "+order_cash_min+"원 이상일 때만 사용이 가능합니다.");
            document.getElementById("order_cash").value = "0";
            orderCheck();
            return false;

        }

        // 보유적립금 초과
        if (user_cash >= 0 && user_cash < order_cash) {
    
            alert("보유한 적립금이 부족합니다.");
            document.getElementById("order_cash").value = "0";
            orderCheck();
            return false;
    
        }

    } else {
    // 미사용

        var order_cash = parseInt(0);

    }

    // 결제수단
    var pay_type = "";
    for (var i=0; i<f.order_pay_type.length; i++) {

        if (f.order_pay_type[i].checked == true) {

            pay_type = f.order_pay_type[i].value;
            break;

        }

    }

    // 기본 결제금액
    var order_money = order_total_money - order_cash;

    // 카드결제
    if (pay_type == '1' && order_money) {

        // 총 결제금액 증가
        var order_pay_money = (order_money + (order_money * order_card_percent)).toFixed(0);

    }

    // 휴대폰결제
    else if (pay_type == '3' && order_money) {

        // 총 결제금액 증가
        var order_pay_money = (order_money + (order_money * order_mobile_percent)).toFixed(0);

    } else {
    // 일반수단

        // 기본 결제금액
        var order_pay_money = order_money;

    }

    // 마이너스이면
    if (order_pay_money < 0) {

        alert("결제금액이 마이너스 입니다.\n\n주문을 다시 확인하시기 바랍니다.");

        if (user_cash_use) {

            document.getElementById("order_cash").value = "0";

        }

        orderCheck();
        return false;

    }

    document.getElementById("order_pay_money").value = order_pay_money;
    document.getElementById("order_total_money_view").innerHTML = shopNumberFormat(String(order_pay_money));
    document.getElementById("order_pay_money_view").innerHTML = shopNumberFormat(String(order_pay_money))+" 원";

    if (user_cash_use) {

        document.getElementById("order_cash_view").innerHTML = shopNumberFormat(String(order_cash));

    }

}

// 적립금
function orderCash()
{

    // 적립금이 많다
    if (user_cash > order_total_money) {

        document.getElementById("order_cash").value = order_total_money;

    } else {
    // 부족하다

        document.getElementById("order_cash").value = user_cash;

    }

    orderCheck();

}

// 플러그인 체크
function orderPluginCheck()
{

    if (navigator.userAgent.indexOf('MSIE') > 0 || navigator.userAgent.indexOf('Trident/7.0') > 0) {

        if (document.Payplus.object != null) {

            return true;

        }

    } else {

        var inst = 0;
        for (var i = 0; i < navigator.plugins.length; i++) {

            if (navigator.plugins[i].name == "KCP") {

                inst = 1;

            }

        }

        if (inst == 1) {

            return true;

        } else {

            document.location.href = GetInstallFile();

        }

    }

    alert("플러그인을 설치하여주시기 바랍니다.\n이미 설치되어있는 경우에는 도구 -> 호환성 보기 설정 -> ‘이 웹 사이트 추가’를 해주시기 바랍니다.");
    return false;

}

// 결제
function orderSave()
{

    orderCheck();

/*
    // 플러그인 검증
    var plugin = orderPluginCheck();
    if (!plugin) {
        return false;
    }
*/

    var f = document.formOrder;

    // 적립금 사용
    if (user_cash_use) {

        // 공백
        if (document.getElementById("order_cash").value == '' || !document.getElementById("order_cash").value) {
    
            // 0원으로 설정
            var order_cash = parseInt(0);
    
        } else {

            var order_cash = parseInt(document.getElementById("order_cash").value);

        }

    } else {

        var order_cash = parseInt(0);

    }

    // 결제수단
    var pay_type = "";
    for (var i=0; i<f.order_pay_type.length; i++) {

        if (f.order_pay_type[i].checked == true) {

            pay_type = f.order_pay_type[i].value;

            break;

        }

    }

    // 무통장 결제만 가능한 쿠폰
    if (order_coupon_bank && pay_type != '5') {

        alert("무통장 결제만 가능한 쿠폰이 적용되었습니다.");
        return false;

    }

    // 적립금 사용불가 쿠폰
    if (order_coupon_cash && order_cash > 0) {

        alert("적립금을 사용할 수 없는 쿠폰이 적용되었습니다.");
        return false;

    }

    // 비회원
    if (shop_user_login == '') {

        if (f.order_name.value == '') {

            alert("주문자명을 입력하세요.");
            f.order_name.focus();
            return false;

        }

        if (f.order_addr1.value == '') {

            alert("주소를 입력하세요.");
            f.order_addr1.focus();
            return false;

        }

        if (f.order_addr2.value == '') {

            alert("상세주소를 입력하세요.");
            f.order_addr2.focus();
            return false;

        }

        if (f.order_hp1.value == '') {

            alert("휴대폰번호를 입력하세요.");
            f.order_hp1.focus();
            return false;

        }

        if (f.order_hp2.value == '') {

            alert("휴대폰번호를 입력하세요.");
            f.order_hp2.focus();
            return false;

        }

        if (f.order_hp3.value == '') {

            alert("휴대폰번호를 입력하세요.");
            f.order_hp3.focus();
            return false;

        }

        if (f.order_tel1.value == '') {

            alert("집전화를 입력하세요.");
            f.order_tel1.focus();
            return false;

        }

        if (f.order_tel2.value == '') {

            alert("집전화를 입력하세요.");
            f.order_tel2.focus();
            return false;

        }

        if (f.order_tel3.value == '') {

            alert("집전화를 입력하세요.");
            f.order_tel3.focus();
            return false;

        }

        if (f.order_email.value == '') {

            alert("이메일주소를 입력하세요.");
            f.order_email.focus();
            return false;

        }

        if (f.order_password.value == '') {

            alert("비밀번호를 입력하세요.");
            f.order_password.focus();
            return false;

        }

    }

    if (f.order_rec_name.value == '') {

        alert("수령자명을 입력하세요.");
        f.order_rec_name.focus();
        return false;

    }

    if (f.order_rec_addr1.value == '') {

        alert("주소를 입력하세요.");
        f.order_rec_addr1.focus();
        return false;

    }

    if (f.order_rec_addr2.value == '') {

        alert("상세주소를 입력하세요.");
        f.order_rec_addr2.focus();
        return false;

    }

    if (f.order_rec_hp1.value == '') {

        alert("휴대폰번호를 입력하세요.");
        f.order_rec_hp1.focus();
        return false;

    }

    if (f.order_rec_hp2.value == '') {

        alert("휴대폰번호를 입력하세요.");
        f.order_rec_hp2.focus();
        return false;

    }

    if (f.order_rec_hp3.value == '') {

        alert("휴대폰번호를 입력하세요.");
        f.order_rec_hp3.focus();
        return false;

    }

    if (f.order_rec_tel1.value == '') {

        alert("집전화를 입력하세요.");
        f.order_rec_tel1.focus();
        return false;

    }

    if (f.order_rec_tel2.value == '') {

        alert("집전화를 입력하세요.");
        f.order_rec_tel2.focus();
        return false;

    }

    if (f.order_rec_tel3.value == '') {

        alert("집전화를 입력하세요.");
        f.order_rec_tel3.focus();
        return false;

    }

    // 비회원
    if (shop_user_login == '') {

        if (pay_type == '5' && f.order_dep_name.value == '') {

            alert("입금자명을 입력하세요.");
            f.order_dep_name.focus();
            return false;

        }

    }

    if (f.order_receipt.value == '1' || f.order_receipt.value == '2') {

        var receipt_type = $("input[name='order_receipt_type']:checked").val();
        var receipt_name = $('#tmp'+receipt_type+'_order_receipt_name');
        var receipt_number = $('#tmp'+receipt_type+'_order_receipt_number');

        if (receipt_name.val() == '') {

            alert("항목을 입력하세요.");
            receipt_name.focus();
            return false;

        }

        if (receipt_number.val() == '') {

            alert("항목을 입력하세요.");
            receipt_number.focus();
            return false;

        }

        f.order_receipt_name.value = receipt_name.val();
        f.order_receipt_number.value = receipt_number.val();

    } else {

        f.order_receipt_name.value = "";
        f.order_receipt_number.value = "";

    }

    if (confirm("결제 하시겠습니까?")) {

        f.action = order_pay_url;
        //f.target = "order_update";
        f.submit();

    } else {

        return false;

    }

}

// 결제수단
function orderPayType(id)
{

    orderCheck();

    document.getElementById("order_pay_message").innerHTML = eval("order_pay_msg"+id);

    if (id == '5') {

        document.getElementById("order_pay_bank").style.display = "inline";

    } else {

        document.getElementById("order_pay_bank").style.display = "none";

    }

}

// 결제수단 로드
function orderPayTypeLoad()
{

    var f = document.formOrder;

    if (f.order_pay_type[0]) {

        f.order_pay_type[0].checked = true;
        orderPayType(f.order_pay_type[0].value);

    } else {

        f.order_pay_type.checked = true;
        orderPayType(f.order_pay_type.value);

    }

}

// 영수증 선택
function orderReceipt(receipt)
{

    $('#order_receipt_layer1').hide();
    $('#order_receipt_layer2').hide();
    $('#order_receipt_layer'+receipt).show();

    if (receipt == '1') {

        shopElementFocus('formOrder', 'order_receipt_type', '0');
        orderReceiptType('0');

    }

    if (receipt == '2') {

        shopElementFocus('formOrder', 'order_receipt_type', '3');
        orderReceiptType('3');

    }

}

// 영수증 발급방식
function orderReceiptType(receipt_type)
{

    $('#order_receipt_type_layer0').hide();
    $('#order_receipt_type_layer1').hide();
    $('#order_receipt_type_layer2').hide();
    $('#order_receipt_type_layer3').hide();
    $('#order_receipt_type_layer4').hide();
    $('#order_receipt_type_layer'+receipt_type).show();

}

// byte 체크
function orderByte(content, bytes)
{

    var conts = document.getElementById(content);
    var bytes = document.getElementById(bytes);

    var i = 0;
    var cnt = 0;
    var exceed = 0;
    var ch = '';

    for (i=0; i<conts.value.length; i++) {

        ch = conts.value.charAt(i);

        if (escape(ch).length > 4) {

            cnt += 2;

        } else {

            cnt += 1;

        }

    }

    bytes.innerHTML = cnt;

/*
    if (cnt > 80) {

        exceed = cnt - 80;
        alert('메시지 내용은 80바이트를 넘을수 없습니다.\n\n작성하신 메세지 내용은 '+ exceed +'byte가 초과되었습니다.\n\n초과된 부분은 자동으로 삭제됩니다.');
        var tcnt = 0;
        var xcnt = 0;
        var tmp = conts.value;
        for (i=0; i<tmp.length; i++) {

            ch = tmp.charAt(i);

            if (escape(ch).length > 4) {

                tcnt += 2;

            } else {

                tcnt += 1;

            }

            if (tcnt > 80) {

                tmp = tmp.substring(0,i);
                break;

            } else {

                xcnt = tcnt;

            }

        }

        conts.value = tmp;
        bytes.innerHTML = xcnt;

        return;

    }
*/

}

// 주소자동입력 (회원)
function orderAddr(mode)
{

    var f = document.formOrder;

    if (mode == 'insert') {

        f.order_rec_name.value = order_rec_name;
        f.order_rec_zip1.value = order_rec_zip1;
        f.order_rec_zip2.value = order_rec_zip2;
        f.order_rec_addr1.value = order_rec_addr1;
        f.order_rec_addr2.value = order_rec_addr2;
        f.order_rec_hp1.value = order_rec_hp1;
        f.order_rec_hp2.value = order_rec_hp2;
        f.order_rec_hp3.value = order_rec_hp3;
        f.order_rec_tel1.value = order_rec_tel1;
        f.order_rec_tel2.value = order_rec_tel2;
        f.order_rec_tel3.value = order_rec_tel3;

    } else {

        f.order_rec_name.value = "";
        f.order_rec_zip1.value = "";
        f.order_rec_zip2.value = "";
        f.order_rec_addr1.value = "";
        f.order_rec_addr2.value = "";
        f.order_rec_hp1.value = "";
        f.order_rec_hp2.value = "";
        f.order_rec_hp3.value = "";
        f.order_rec_tel1.value = "";
        f.order_rec_tel2.value = "";
        f.order_rec_tel3.value = "";

    }

}

// 주소자동입력 (비회원)
function orderAddr2()
{

    var f = document.formOrder;

    if (f.addr_type.checked == true) {

        f.order_rec_name.value = f.order_name.value;
        f.order_rec_zip1.value = f.order_zip1.value;
        f.order_rec_zip2.value = f.order_zip2.value;
        f.order_rec_addr1.value = f.order_addr1.value;
        f.order_rec_addr2.value = f.order_addr2.value;
        f.order_rec_hp1.value = f.order_hp1.value;
        f.order_rec_hp2.value = f.order_hp2.value;
        f.order_rec_hp3.value = f.order_hp3.value;
        f.order_rec_tel1.value = f.order_tel1.value;
        f.order_rec_tel2.value = f.order_tel2.value;
        f.order_rec_tel3.value = f.order_tel3.value;

    } else {

        f.order_rec_name.value = "";
        f.order_rec_zip1.value = "";
        f.order_rec_zip2.value = "";
        f.order_rec_addr1.value = "";
        f.order_rec_addr2.value = "";
        f.order_rec_hp1.value = "";
        f.order_rec_hp2.value = "";
        f.order_rec_hp3.value = "";
        f.order_rec_tel1.value = "";
        f.order_rec_tel2.value = "";
        f.order_rec_tel3.value = "";

    }

}

// 쿠폰
function cartCoupon(cart_id)
{

    shopOpen(shop_path+"/coupon_apply.php?coupon_page=order&cart_id="+cart_id, "couponApply", "width=650, height=700, scrollbars=yes");

}

// sms 발송
function smsSelfSend(order_code)
{

    var sms_message = $("#sms_message").val();
    var sms_hp1 = $("#sms_hp1").val();
    var sms_hp2 = $("#sms_hp2").val();

    if (sms_message == '') {

        alert("메세지 내용을 입력하세요.");
        return false;

    }

    if (sms_hp1 == '') {

        alert("수신번호를 입력하세요.");
        return false;

    }

    if (sms_hp2 == '') {

        alert("발신번호를 입력하세요.");
        return false;

    }

    $.post(shop_path+"/order_ok_sms.php", {"order_code" : order_code, "sms_message" : sms_message, "sms_hp1" : sms_hp1, "sms_hp2" : sms_hp2}, function(data) {

        $("#order_ok_update").html(data);

    });

}