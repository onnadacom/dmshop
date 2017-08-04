if (typeof(USERVIEW_JS) == 'undefined') {

    if (typeof shop_path == 'undefined') {

        alert('로딩에 실패하였습니다. 새로고침을 다시한번 눌러주세요.');

    }

    var USERVIEW_JS = true;

    function insertHead(name, text, evt) 
    {

        var idx = this.heads.length;
        var row = new UserViewRow(-idx, name, text, evt);
        this.heads[idx] = row;
        return row;

    }

    function insertTail(name, evt) 
    {

        var idx = this.tails.length;
        var row = new UserViewRow(idx, name, evt);
        this.tails[idx] = row;
        return row;

    }

    function UserViewRow(idx, name, onclickEvent) 
    {

        this.idx = idx;
        this.name = name;
        this.onclickEvent = onclickEvent;
        this.renderRow = renderRow;

        this.isVisible = true;
        this.isDim = false;

    }

    function renderRow() 
    {

        if (!this.isVisible)
            return "";

        var str = "<tr height='20'><td id='userViewRow_"+this.name+"'><span class='userview'>"+this.onclickEvent+"</span></td></tr>";
        return str;

    }

    function showUserView(curObj, user_id, user_name, user_email, user_homepage) 
    {

        var userView = new UserView('nameContextMenu', curObj, user_id, user_name, user_email, user_homepage);
        userView.showLayer();

    }

    function UserView(targetObj, curObj, user_id, user_name, user_email, user_homepage) 
    {

        this.targetObj = targetObj;
        this.curObj = curObj;
        this.user_id = user_id;
        user_name = user_name.replace(/…/g,"");
        this.user_name = user_name;
        this.user_email = user_email;
        this.user_homepage = user_homepage;
        this.showLayer = showLayer;
        this.makeNameContextMenus = makeNameContextMenus;
        this.heads = new Array();
        this.insertHead = insertHead;
        this.tails = new Array();
        this.insertTail = insertTail;
        this.getRow = getRow;
        this.hideRow = hideRow;		
        this.dimRow = dimRow;

        if (shop_user_admin) {

            if (user_id)
                this.insertTail("userinfo", "<a href=\"#\" onclick=\"userManage('', '"+user_id+"'); return false;\">회원요약정보</a>");

            if (user_id)
                this.insertTail("modify", "<a href='"+shop_path+"/adm/user_regist.php?m=u&user_id="+user_id+"' target='_blank'>회원정보변경</a>");

            if (user_id)
                this.insertTail("userPopupLevel", "<a href='#' onclick=\"userPopupLevel('"+user_id+"'); return false;\">회원등급변경</a>");

            if (user_id)
                this.insertTail("order_all_list", "<a href='"+shop_path+"/adm/order_all_list.php?f=user_id&q="+user_id+"' target='_blank'>주문내역</a>");

            if (user_id)
                this.insertTail("coupon_make_list", "<a href='"+shop_path+"/adm/coupon_make_list.php?f=user_id&q="+user_id+"' target='_blank'>쿠폰내역</a>");

            if (user_id)
                this.insertTail("cash_list", "<a href='"+shop_path+"/adm/cash_list.php?f=user_id&q="+user_id+"' target='_blank'>적립금내역</a>");

        }

        if (user_id) {

            this.insertTail("sms", "<a href=\"#\" onclick=\"orderPopupSms('user_id="+user_id+"'); return false;\">문자보내기</a>");
            this.insertTail("email", "<a href=\"#\" onclick=\"orderPopupEmail('user_id="+user_id+"'); return false;\">이메일보내기</a>");

        }

    }

    function showLayer() 
    {

        clickAreaCheck = true;
        var oUserViewLayer = document.getElementById(this.targetObj);
        var oBody = document.body;

        if (oUserViewLayer == null) {

            oUserViewLayer = document.createElement("DIV");
            oUserViewLayer.id = this.targetObj;
            oUserViewLayer.style.position = "absolute";
            oUserViewLayer.style.zIndex = 999;
            oBody.appendChild(oUserViewLayer);

        }

        oUserViewLayer.innerHTML = this.makeNameContextMenus();

        if (getAbsoluteTop(this.curObj) + this.curObj.offsetHeight + oUserViewLayer.scrollHeight + 5 > oBody.scrollHeight)
            oUserViewLayer.style.top = getAbsoluteTop(this.curObj) - oUserViewLayer.scrollHeight + "px";
        else
            oUserViewLayer.style.top = getAbsoluteTop(this.curObj) + this.curObj.offsetHeight + "px";

        oUserViewLayer.style.left = getAbsoluteLeft(this.curObj) - this.curObj.offsetWidth + 14 + "px";

        divDisplay(this.targetObj, 'block');

        selectBoxHidden(this.targetObj);

    }

    function getAbsoluteTop(oNode)
    {

        var oCurrentNode=oNode;
        var iTop=0;

        if (oCurrentNode.offsetParent) {

            do {

                if (oCurrentNode.tagName!="body") {

                    iTop += oCurrentNode.offsetTop;

                }

            }

            while(oCurrentNode = oCurrentNode.offsetParent);

        }

        return iTop;

    }

    function getAbsoluteLeft(oNode)
    {

        var oCurrentNode=oNode;
        var iLeft=0;
        iLeft+=oCurrentNode.offsetWidth;

        if (oCurrentNode.offsetParent) {
        
            do {
        
            if (oCurrentNode.tagName!="body")
                iLeft += oCurrentNode.offsetLeft;
        
            }
        
            while(oCurrentNode = oCurrentNode.offsetParent);
        
        }
        
        return iLeft;

    }

    function makeNameContextMenus() 
    {

        var str = "<table width='90' cellpadding='0' cellspacing='0' style='border:2px solid #dddddd;' bgcolor='#ffffff' align='left'>";
        str += "<tr><td height='3' class='none'>&nbsp;</td></tr>";
        
        var i=0;
        for (i=this.heads.length - 1; i >= 0; i--)
            str += this.heads[i].renderRow();
       
        var j=0;
        for (j=0; j < this.tails.length; j++)
            str += this.tails[j].renderRow();

        str += "<tr><td height='2' class='none'>&nbsp;</td></tr>";
        str += "</table>";
        return str;

    }

    function getRow(name) 
    {

        var i = 0;
        var row = null;
        for (i=0; i<this.heads.length; ++i) {

            row = this.heads[i];
            if (row.name == name) return row;

        }

        for (i=0; i<this.tails.length; ++i) {

            row = this.tails[i];
            if (row.name == name) return row;

        }

        return row;

    }

    function hideRow(name) 
    {

        var row = this.getRow(name);

        if (row != null)
            row.isVisible = false;

    }

    function dimRow(name) 
    {

        var row = this.getRow(name);

        if (row != null)
            row.isDim = true;

    }

    function selectBoxHidden(layer_id) 
    {

        var ly = document.getElementById(layer_id);

        var ly_left   = ly.offsetLeft;
        var ly_top    = ly.offsetTop;
        var ly_right  = ly.offsetLeft + ly.offsetWidth;
        var ly_bottom = ly.offsetTop + ly.offsetHeight;

        var el;

        for (i=0; i<document.forms.length; i++) {

            for (k=0; k<document.forms[i].length; k++) {

                el = document.forms[i].elements[k];    

                if (el.type == "select-one") {

                    var el_left = el_top = 0;
                    var obj = el;

                    if (obj.offsetParent) {

                        while (obj.offsetParent) {

                            el_left += obj.offsetLeft;
                            el_top  += obj.offsetTop;
                            obj = obj.offsetParent;

                        }

                    }

                    el_left   += el.clientLeft;
                    el_top    += el.clientTop;
                    el_right  = el_left + el.clientWidth;
                    el_bottom = el_top + el.clientHeight;

                    if ((el_left >= ly_left && el_top >= ly_top && el_left <= ly_right && el_top <= ly_bottom) || (el_right >= ly_left && el_right <= ly_right && el_top >= ly_top && el_top <= ly_bottom) || (el_left >= ly_left && el_bottom >= ly_top && el_right <= ly_right && el_bottom <= ly_bottom) || (el_left >= ly_left && el_left <= ly_right && el_bottom >= ly_top && el_bottom <= ly_bottom) || (el_top <= ly_bottom && el_left <= ly_left && el_right >= ly_right)) {

                        el.style.visibility = 'hidden';

                    }

                }

            }

        }

    }

    function selectBoxVisible() 
    {

        for (i=0; i<document.forms.length; i++) {

            for (k=0; k<document.forms[i].length; k++) {

                el = document.forms[i].elements[k];    
                if (el.type == "select-one" && el.style.visibility == 'hidden')
                    el.style.visibility = 'visible';

            }

        }

    }

    function divDisplay(id, act) 
    {

        selectBoxVisible();

        document.getElementById(id).style.display = act;

    }

    function hideUserView() 
    {

        if (document.getElementById("nameContextMenu"))
            divDisplay ("nameContextMenu", 'none');

    }

    var clickAreaCheck = false;
    document.onclick = function()  {

        if (!clickAreaCheck) 
            hideUserView();
        else 
            clickAreaCheck = false;

    }

}