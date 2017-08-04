/* 공통 스크립트 */

(function () { var m = document.uniqueID && document.compatMode && !window.XMLHttpRequest && document.execCommand; try { if (!!m) { m("BackgroundImageCache", false, true); } } catch (oh) {}; }) ();

function shopFocus(id)
{

    document.getElementById(id).focus();

}

function shopTop()
{

    window.scrollTo(0,0);

}

function shopCurrent()
{

    var currentId = document.location.hash.split('#')[1];

    if (currentId) {

        var win = $(window);
        var box = $("#current_"+currentId);
        var boxTop = box.offset().top - ((win.height() / 2) - (box.height() / 2));

        $('html,body').animate({scrollTop: boxTop}, 700);
        box.css({ 'background-color': '#e8fcff' });

    }

}

function shopMessage(mode)
{

    var overlay = $("#overlay");
    var mbox = $("#message_box");

    if (mode == 'open') {

        overlay.show();
        mbox.show();

        var win = $(window);
        var body = $(document);
        var mboxLeft = (win.scrollLeft() + (win.width() / 2)) - (mbox.width() / 2);
        var mboxTop = (win.scrollTop() + (win.height() / 2)) - (mbox.height() / 2);

        var maxBodyHeight = body.height();

        if (maxBodyHeight >= '3000') {
            maxBodyHeight = 3000;
        }

        overlay.css( { 'width': win.width()+'px', 'height': maxBodyHeight+'px', 'opacity' : '0.5' } );
        mbox.css( { 'left': mboxLeft+'px', 'top': mboxTop+'px', 'opacity' : '1.0'} );

        $('#message_box p.btn a').focus();

        $(document).keydown(function (e) {

            if (e.keyCode == '13' || e.keyCode == '32' || e.keyCode == '27') {

                $('#message_box p.btn a.msgclose').click();

            }

        });

        overlay.click(function() {

            $('#message_box p.btn a.msgclose').click();

        });

    } else {

        mbox.hide();
        overlay.hide();

    }

}

function shopDate(id)
{

    var date = $("#"+id).val();

    shopOpen(shop_path+"/date.php?id="+id+"&d="+date,"dateOpen","width=250, height=250, scrollbars=no");

}

function shopOpen(url, name, option)
{

    var popup = window.open(url, name, option);
    popup.focus();

}

function shopFile(target, obj)
{
    
    pathpoint = obj.value.lastIndexOf('.');

    filepoint = obj.value.substring(pathpoint+1,obj.value.length);

    filetype = filepoint.toLowerCase();

    preViewer = (typeof(target) == "object") ? target : document.getElementById(target);

    var ua = window.navigator.userAgent;
    
    if (filetype=='jpg' || filetype=='gif' || filetype=='png' || filetype=='jpeg' || filetype=='bmp') {

        if (ua.indexOf("MSIE") > -1) {
    
            var img_path = "";
            
            if (obj.value.indexOf("\\fakepath\\") < 0) {
    
                img_path = obj.value;
    
            } else {
    
                obj.select();
    
                var selectionRange = document.selection.createRange();
    
                img_path = selectionRange.text.toString();
    
                obj.blur();
    
            }
    
            preViewer.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='fi" + "le://" + img_path + "', sizingMethod='scale')";
            
        } else {
        
            preViewer.innerHTML = "";
        
            var W = preViewer.offsetWidth;
        
            var H = preViewer.offsetHeight;
        
            var tmpImage = document.createElement("img");
        
            preViewer.appendChild(tmpImage);
            
            tmpImage.onerror = function () {
        
                return preViewer.innerHTML = "";
        
            }
    
            tmpImage.onload = function () {
        
                if (this.width > W) {
        
                    this.height = this.height / (this.width / W);
                    this.width = W;
        
                }
        
                if (this.height > H) {
        
                    this.width = this.width / (this.height / H);
                    this.height = H;
        
                }

            }

            if (ua.indexOf("Firefox/3") > -1 || ua.indexOf("Firefox/4") > -1 || ua.indexOf("Firefox/5") > -1 || ua.indexOf("Firefox/6") > -1 || ua.indexOf("Firefox/4") > -1 || ua.indexOf("Firefox/5") > -1 || ua.indexOf("Firefox/6") > -1) {

                var picData = obj.files.item(0).getAsDataURL();
                tmpImage.src = picData;

            } else {

                tmpImage.src = "file://" + obj.value;

            }

        }

    } else {

        alert('이미지 파일만 선택할 수 있습니다.');

        if (ua.indexOf("MSIE") > -1 ) {

            preViewer.style.filter = "";

        } else {

            preViewer.innerHTML = "";
            return false;

        }

    }
    
    if (filetype=='bmp') {

        upload = confirm('BMP 파일은 웹상에서 사용하기엔 적절한 이미지 포맷이 아닙니다.\n그래도 계속 하시겠습니까?');
        if(!upload) return false;

    }

}

function shopBookmark(title,url)
{

    if (window.sidebar) {

        window.sidebar.addPanel(title, url, '');

    }

    else if (window.opera && window.print) {

        var elem = document.createElement('a'); elem.setAttribute('href',url); elem.setAttribute('title',title); elem.setAttribute('rel','sidebar'); elem.click();

    }

    else if (document.all) {

        window.external.AddFavorite(url, title);

    }

}

function shopZip(form_name, form_zip1, form_zip2, form_addr1, form_addr2)
{

    url = shop_path+"/zip.php?form_name="+form_name+"&form_zip1="+form_zip1+"&form_zip2="+form_zip2+"&form_addr1="+form_addr1+"&form_addr2="+form_addr2;

    shopOpen(url, "windowZip", "left=50,top=50,width=616,height=460,scrollbars=1");

}

function shopFlash(src, ids, width, height, wmode)
{

    var wh = "";

    if (parseInt(width) && parseInt(height)) {

        wh = " width='"+width+"' height='"+height+"' ";

    }

    document.write("<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' "+wh+" id="+ids+"><param name=wmode value="+wmode+"><param name=movie value="+src+"><param name=quality value=high><embed src="+src+" quality=high wmode="+wmode+" type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash' "+wh+"></embed></object>");

}

function shopMovie(src, ids, width, height, autostart)
{

    var wh = "";

    if (parseInt(width) && parseInt(height)) {

        wh = " width='"+width+"' height='"+height+"' ";

    }

    if (!autostart) {

        autostart = false;

    }

    return "<embed src='"+src+"' "+wh+" autostart='"+autostart+"'></embed>";

}

function shopElementFocus(form_name, element_name, element_id)
{

    var obj = eval("document."+form_name+"."+element_name)[element_id];

    obj.checked = true;

}

function shopElementCheck(form_name, element_name)
{

    var obj = eval("document."+form_name+"."+element_name);

    if (obj.checked == true) {

        obj.checked = false;

    } else {

        obj.checked = true;

    }

}

function shopElementCheckID(element_id)
{

    var obj = document.getElementById(element_id);

    if (obj.checked == true) {

        obj.checked = false;

    } else {

        obj.checked = true;

    }

}

function shopMove(url)
{

    document.location.href = url;

}

function shopContainsCharsOnly(input, chars)
{

    for (var i=0; i< input.length; i++) {

        if (chars.indexOf(input.charAt(i)) == -1) {

            return false;

        }

  }

  return  true;

}

function shopNumeric(input)
{

    var chars = "0123456789";

    return shopContainsCharsOnly(input,chars);

}

function shopNumberFormat(data) 
{

    var tmp = '';
    var number = '';
    var cutlen = 3;
    var comma = ',';
    var i;

    len = data.length;
    mod = (len % cutlen);
    k = cutlen - mod;

    for (i=0; i<data.length; i++) {

        number = number + data.charAt(i);

        if (i < data.length - 1) {

            k++;

            if ((k % cutlen) == 0) {

                number = number + comma;
                k = 0;

            }

        }

    }

    return number;

}

function shopResizePopup(w, h)
{

    var oBody=document.getElementsByTagName("Body")[0];

    var oDivPopWrap = document.getElementById("pop_wrap");

    if (h == '') {

        var h = oDivPopWrap.offsetHeight + 30;

    }

    var clintAgent = navigator.userAgent;

    if ( clintAgent.indexOf("MSIE") != -1 ) {

        window.resizeBy(w-oBody.clientWidth, (h + 36)-oBody.clientHeight);

    } else {

        window.resizeBy(w-window.innerWidth, h-oBody.clientHeight);

    }

}

function shopResizeWindow(w, h)
{

    var oBody=document.getElementsByTagName("Body")[0];

    var oDivPopWrap = document.getElementById("pop_wrap");

    if (h == '') {

        var h = oDivPopWrap.offsetHeight;

    }

    var clintAgent = navigator.userAgent;

    if ( clintAgent.indexOf("MSIE") != -1 ) {

        window.resizeBy(w-oBody.clientWidth, h-oBody.clientHeight);

    } else {

        window.resizeBy(w-window.innerWidth, h-oBody.clientHeight);

    }

}

function shopResizeImage(imageWidth)
{

    var target = document.getElementsByName('shopResizeImage[]');
    var imageHeight = 0;

    if (target) {

        for (var i=0; i<target.length; i++) {

            target[i].tmp_width  = target[i].width;
            target[i].tmp_height = target[i].height;

            if (target[i].width > imageWidth) {

                imageHeight = parseFloat(target[i].width / target[i].height);
                target[i].width = imageWidth;
                target[i].height = parseInt(imageWidth / imageHeight);
                target[i].style.width = '';
                target[i].style.height = '';

            }

        }

    }

}

function shopImageView(img, w, h)
{

    if (w && h) {

        var w = parseInt(w);
        var h = parseInt(h);
        var url = img;

    } else {

        var w = img.tmp_width; 
        var h = img.tmp_height; 
        var url = img.src;

    }

    var winl = (screen.width-w)/2; 
    var wint = (screen.height-h)/3; 

    if (w >= screen.width) {

        winl = 0;
        h = (parseInt)(w * (h / w));

    }

    if (h >= screen.height) {

        wint = 0; 
        w = (parseInt)(h * (w / h));

    }

    var js_url = "<script type='text/javascript'>\n";

    js_url += "<!-- \n";
    js_url += "var ie=document.all; \n";
    js_url += "var nn6=document.getElementById&&!document.all; \n";
    js_url += "var isdrag=false; \n";
    js_url += "var x,y; \n";
    js_url += "var dobj; \n";
    js_url += "function movemouse(e) \n";
    js_url += "{ \n";
    js_url += "  if (isdrag) \n";
    js_url += "  { \n";
    js_url += "    var dobj_left = nn6 ? tx + e.clientX - x : tx + event.clientX - x; \n";
    js_url += "    var dobj_top  = nn6 ? ty + e.clientY - y : ty + event.clientY - y; \n";
    js_url += "    dobj.style.left = dobj_left + 'px'; \n";
    js_url += "    dobj.style.top  = dobj_top + 'px'; \n";
    js_url += "    return false; \n";
    js_url += "  } \n";
    js_url += "} \n";
    js_url += "function selectmouse(e) \n";
    js_url += "{ \n";
    js_url += "  var fobj      = nn6 ? e.target : event.srcElement; \n";
    js_url += "  var topelement = nn6 ? 'HTML' : 'BODY'; \n";
    js_url += "  while (fobj.tagName != topelement && fobj.className != 'dragme') \n";
    js_url += "  { \n";
    js_url += "    fobj = nn6 ? fobj.parentNode : fobj.parentElement; \n";
    js_url += "  } \n";
    js_url += "  if (fobj.className=='dragme') \n";
    js_url += "  { \n";
    js_url += "    isdrag = true; \n";
    js_url += "    dobj = fobj; \n";
    js_url += "    tx = parseInt(dobj.style.left+0); \n";
    js_url += "    ty = parseInt(dobj.style.top+0); \n";
    js_url += "    x = nn6 ? e.clientX : event.clientX; \n";
    js_url += "    y = nn6 ? e.clientY : event.clientY; \n";
    js_url += "    document.onmousemove=movemouse; \n";
    js_url += "    return false; \n";
    js_url += "  } \n";
    js_url += "} \n";
    js_url += "document.onmousedown=selectmouse; \n";
    js_url += "document.onmouseup=new Function('isdrag=false'); \n";
    js_url += "//--> \n";
    js_url += "</"+"script> \n";

    var settings;

/*
    if (shop_is_gecko) {

        settings  ='width='+(w+10)+',';
        settings +='height='+(h+10)+',';

    } else {

        settings  ='width='+w+','; 
        settings +='height='+h+',';

    }
*/
    settings  ='width='+w+','; 
    settings +='height='+h+',';
    settings +='top='+wint+',';
    settings +='left='+winl+',';
    settings +='scrollbars=no,';
    settings +='resizable=yes,';
    settings +='status=no';

    win=window.open("","image_window",settings);
    win.document.open();

    win.document.write ("<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>\n");
    win.document.write ("<html xmlns='http://www.w3.org/1999/xhtml'>\n");
    //win.document.write ("<html>\n");
    win.document.write ("<head>\n");
    win.document.write ("<meta http-equiv='imagetoolbar' CONTENT='no'>\n");
    win.document.write ("<meta http-equiv='content-type' content='text/html; charset="+shop_charset+"'>\n");

    var size = "이미지 사이즈 : "+w+" x "+h;

    win.document.write ("<title>"+size+"</title>\n");

    if (w >= screen.width || h >= screen.height) {

        win.document.write (js_url); 
        var click = "ondblclick='window.close();' style='cursor:move;'";

    } else {

        var click = "onclick='window.close();' style='cursor:pointer;'";

    }

    win.document.write ("<style type='text/css'> * {margin:0; padding:0;} html, body {width:100%; height:100%;} .dragme{position:relative;}</style>\n");
    win.document.write ("</head>\n");
    win.document.write ("<body bgcolor='#dddddd'>\n");
    win.document.write ("<table width='100%' height='100%' cellpadding='0' cellspacing='0'><tr><td align='center' valign='middle'><img src='"+url+"' width='"+w+"' height='"+h+"' border=0 class='dragme' "+click+"></td></tr></table>\n");
    win.document.write ("</body></html>");
    win.document.close();

    if (parseInt(navigator.appVersion) >= 4) {

        win.window.focus();

    } 

}

// byte 체크
function shopByte(content, bytes)
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

// 상세주문내역
function orderPopupView(order_code)
{

    shopOpen(shop_path+"/order_view.php?order_code="+order_code, "orderPopupView", "width=650, height=700, scrollbars=yes");

}

// 배송정보변경
function orderPopupAddress(order_code)
{

    shopOpen(shop_path+"/order_address.php?order_code="+order_code, "orderPopupAddress", "width=650, height=700, scrollbars=yes");

}

// 배송정보
function orderPopupDelivery(order_code)
{

    shopOpen(shop_path+"/order_delivery.php?order_code="+order_code, "orderPopupDelivery", "width=650, height=700, scrollbars=yes");

}

// 옵션변경
function orderPopupOption(order_code)
{

    shopOpen(shop_path+"/order_option.php?order_code="+order_code, "orderPopupOption", "width=650, height=700, scrollbars=yes");

}

// 주문취소
function orderPopupCancel(order_code)
{

    shopOpen(shop_path+"/help.php?help_category=300&help_type=1&help_code="+order_code, "orderPopupCancel", "width=650, height=700, scrollbars=yes");

}

// 교환신청
function orderPopupExchange(order_code)
{

    shopOpen(shop_path+"/help.php?help_category=400&help_type=1&help_code="+order_code, "orderPopupExchange", "width=650, height=700, scrollbars=yes");

}

// 환불신청
function orderPopupRefund(order_code)
{

    shopOpen(shop_path+"/help.php?help_category=500&help_type=1&help_code="+order_code, "orderPopupRefund", "width=650, height=700, scrollbars=yes");

}

// 1:1 문의 신청
function orderPopupHelp()
{

    shopOpen(shop_path+"/help.php", "orderPopupHelp", "width=650, height=700, scrollbars=yes");

}

// 1:1 문의 뷰
function orderPopupHelpView(help_id)
{

    shopOpen(shop_path+"/help_view.php?help_id="+help_id, "orderPopupHelpView", "width=730, height=700, scrollbars=yes");

}

// 영수증
function orderPopupPayReceipt(pg, id)
{

    // 이니시스
    if (pg == '1' ) {

        shopOpen("https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=" +id+ "&noMethod=1", "orderPopupPayReceipt", "width=430, height=700, scrollbars=yes");

    }

}

// 상세결제내역
function payPopupView(pay_code)
{

    shopOpen(shop_path+"/payment_view.php?pay_code="+pay_code, "payPopupView", "width=650, height=700, scrollbars=yes");

}

// 영수증 (KCP)
function payReceipt3(pay_type, site_code, code1, order_code, order_receipt, receipt_code)
{

    if (order_receipt == '2') {

        var order_receipt = "1";

    } else {

        var order_receipt = "0";

    }

    // 카드
    if (pay_type == '1') {

        shopOpen("https://admin.kcp.co.kr/Modules/Sale/Card/ADSA_CARD_BILL_Receipt.jsp?c_trade_no="+code1, "payReceipt", "width=400, height=670, scrollbars=no");

    }

    else if (pay_type == '2' && receipt_code || pay_type == '4' && receipt_code || pay_type == '5' && receipt_code) {

        shopOpen("https://admin.kcp.co.kr/Modules/Service/Cash/Cash_Bill_Common_View.jsp?term_id=PGNW"+site_code+"&orderid="+order_code+"&bill_yn="+order_receipt+"&authno="+receipt_code, "payReceipt", "width=360, height=645, scrollbars=no");

    } else {

        alert("영수증 정보가 없습니다.");
        return false;

    }

}

// 영수증 (KICC)
function payReceipt4(pay_type, site_code, code, order_code, order_receipt, receipt_code)
{

    if (order_receipt == '2') {

        var order_receipt = "1";

    } else {

        var order_receipt = "0";

    }

    // 카드
    if (pay_type == '1') {

        shopOpen("https://office.easypay.co.kr/receipt/ReceiptBranch.jsp?controlNo="+code, "payReceipt", "width=380, height=700, scrollbars=no");

    }

    else if (pay_type == '2' && receipt_code || pay_type == '4' && receipt_code || pay_type == '5' && code) {

        shopOpen("https://office.easypay.co.kr/receipt/ReceiptBranch.jsp?controlNo="+code, "payReceipt", "width=380, height=700, scrollbars=no");

    } else {

        alert("영수증 정보가 없습니다.");
        return false;

    }

}

// sms
function orderPopupSms(parameter)
{

    shopOpen(shop_path+"/sms.php?"+parameter, "orderPopupSms", "width=250, height=450, scrollbars=yes");

}

// email
function orderPopupEmail(parameter)
{

    shopOpen(shop_path+"/email.php?"+parameter, "orderPopupEmail", "width=600, height=450, scrollbars=yes");

}

// 배너클릭
function bannerClick(banner_id)
{

    $.post(shop_path+"/banner.php", {"banner_id" : banner_id});

}

// 소셜로그인
function naverLogin()
{

    if (check_touch) {

        location.href = shop_url+"/login/naver.php?loginmode=document&url="+shop_return_url;

    } else {

        shopOpen(shop_url+"/login/naver.php", "socialLogin", "width=500, height=600, scrollbars=1");

    }

}

function kakaoLogin()
{

    if (check_touch) {

        location.href = shop_url+"/login/kakao.php?loginmode=document&url="+shop_return_url;

    } else {

        shopOpen(shop_url+"/login/kakao.php", "socialLogin", "width=500, height=600, scrollbars=1");

    }

}

function facebookLogin()
{

    if (check_touch) {

        location.href = shop_url+"/login/facebook.php?loginmode=document&url="+shop_return_url;

    } else {

        shopOpen(shop_url+"/login/facebook.php", "socialLogin", "width=500, height=600, scrollbars=1");

    }

}

function twitterLogin()
{

    if (check_touch) {

        location.href = shop_url+"/login/twitter.php?loginmode=document&url="+shop_return_url;

    } else {

        shopOpen(shop_url+"/login/twitter.php", "socialLogin", "width=500, height=600, scrollbars=1");

    }

}

function googleLogin()
{

    if (check_touch) {

        location.href = shop_url+"/login/google.php?loginmode=document&url="+shop_return_url;

    } else {

        shopOpen(shop_url+"/login/google.php", "socialLogin", "width=500, height=600, scrollbars=1");

    }

}

function loginOk()
{

    var url = $('#url').val();

    if (url) {

        location.href = url;

    } else {

        location.reload();

    }

}