<?
if (!defined('_DMSHOP_')) exit;
?>
<!--[if IE 6]>
<script type="text/javascript">
/* IE6 PNG 배경투명 */
DD_belatedPNG.fix('.png');
</script>
<![endif]-->

<style type="text/css">
body {background-color:#f4f4f4;}
.box_bg {background-color:#ffffff;}
.top_bg {height:45px; background:url('<?=$dmshop_help_path?>/img/top_bg.gif') repeat-x;}

.help_box .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.help_box .list {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.help_box .msg {line-height:16px; font-size:11px; color:#717171; font-family:gulim,굴림;}
.help_box .msg2 {line-height:16px; font-size:11px; color:#f26c4f; font-family:gulim,굴림;}
#code_msg {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}

.help_box .category .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.help_box .category .selectBox-dropdown {width:150px; height:19px;}
.help_box .category .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

/* 영역을 이탈하니 기본 셀렉트로만 해주자.
.help_box .email .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.help_box .email .selectBox-dropdown {width:100px; height:19px;}
.help_box .email .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
*/

.help_box .input {width:94px; height:17px; border:1px solid #c9c9c9; padding:1px 3px 0px 3px;}
.help_box .input {line-height:17px; font-size:12px; color:#414141; font-family:gulim,굴림;}

.help_box .file {width:300px; height:17px; border:1px solid #c9c9c9; padding:0px 3px 0px 3px;}
.help_box .file {line-height:17px; font-size:12px; color:#414141; font-family:gulim,굴림;}

.help_box .radio {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:-1px;}

.help_box .textarea {padding:3px; width:425px; height:180px; border:1px solid #c9c9c9;}
.help_box .textarea {line-height:15px; font-size:12px; color:#333333; font-family:dotum,돋움;}

.title p {margin-top:10px;}

.order_infor .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_infor .date {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_infor .time {line-height:16px; font-size:11px; color:#adadad; font-family:dotum,돋움;}
.order_infor .code {line-height:16px; font-size:12px; color:#7da7d9; font-family:gulim,굴림;}
.order_infor .money {line-height:16px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.order_infor .mode {line-height:16px; font-size:12px; color:#000000; font-family:gulim,굴림;}

.order_list .thumb {border:2px solid #e4e4e4;}

.order_list .title {font-weight:bold; line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.order_list .subject {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .option {line-height:16px; font-size:11px; color:#8b49c7; font-family:dotum,돋움;}
.order_list .limit {line-height:16px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.order_list .money {line-height:16px; font-size:12px; color:#ff3c00; font-family:dotum,돋움;}
.order_list .dot {height:1px; background:url('<?=$dmshop_help_path?>/img/dot.gif') repeat-x;}
</style>

<script type="text/javascript">
// 이메일 선택
function helpEmail()
{

    var f = document.formHelp;

    if (f.user_email_list.value != '' && f.user_email_list.value != 'self') {

        f.user_email2.value = f.user_email_list.value;
        f.user_email2.style.display = "none";

    }

    else if (f.user_email_list.value == 'self') {

        f.user_email2.value = "";
        f.user_email2.focus();
        f.user_email2.style.display = "";

    }

}

// 유형 선택
function helpCategory(id)
{

    var order_pay_type = document.getElementById("order_pay_type").value;

    document.getElementById("return_layer").style.display = "none";

    if (order_pay_type == '4' || order_pay_type == '5') {

        if (id == '300' || id == '500') {

            document.getElementById("return_layer").style.display = "inline";

        }

    }

}

// 문의대상
function helpType(id, mode)
{

    document.getElementById("help_check").value = "";

    if (mode == 'reset') {

        document.getElementById("help_code").value = "";

    }

    if (id == '1' || id == '2') {

        document.getElementById("code_layer").style.display = "inline";

    } else {

        document.getElementById("code_layer").style.display = "none";

    }

    if (id == '1') {

        document.getElementById("code_msg").innerHTML = "주문번호 입력";

    }

    if (id == '2') {

        document.getElementById("code_msg").innerHTML = "상품번호 입력";

    }

    document.getElementById("help_data").innerHTML = "";

}

// 확인
function helpOk()
{

    var f = document.formHelp;

    if (f.help_code.value == '') {

        if (f.help_type[0].checked == true) {

            alert("주문번호를 입력하세요.");
            f.help_code.focus();

        }

        if (f.help_type[1].checked == true) {

            alert("상품번호를 입력하세요.");
            f.help_code.focus();

        }

        return false;

    }

    if (f.help_type[0].checked == true) {

        var help_type = "1";

    }

    if (f.help_type[1].checked == true) {

        var help_type = "2";

    }

    if (f.help_type[2].checked == true) {

        var help_type = "3";

    }

    $.post("<?=$shop['path']?>/help_update.php", {"m" : "", "help_type" : help_type, "help_code" : f.help_code.value}, function(data) {

        $("#help_data").html(data);

        if (help_type == '1') {

            helpCategory(f.help_category.value);

        }

    });

}

// 찾기
function helpSearch()
{

    var f = document.formHelp;

    if (f.help_type[0].checked == true) {

        var help_type = "1";

    }

    if (f.help_type[1].checked == true) {

        var help_type = "2";

    }

    shopOpen("<?=$shop['path']?>/help_search.php?help_type="+help_type, "helpSearch", "width=650, height=720, scrollbars=yes");

}

// 저장
function submitHelp()
{

    var f = document.formHelp;

    if (f.help_category.value == '') {

        alert("문의유형을 선택하세요.");
        return false;

    }

    if (f.help_type[0].checked == true || f.help_type[1].checked == true) {

        // 확인되지 않았다
        if (f.help_check.value == '' || f.help_code.value == '' || f.help_check.value != f.help_code.value) {
    
            if (f.help_type[0].checked == true) {
    
                alert("주문번호를 입력하신 후 확인버튼을 눌러주세요.");
                f.help_code.focus();
    
            }
    
            if (f.help_type[1].checked == true) {
    
                alert("상품번호를 입력하신 후 확인버튼을 눌러주세요.");
                f.help_code.focus();
    
            }
    
            return false;
    
        }

    }

    if (f.subject.value == '') {

        alert("상담 제목을 입력하세요.");
        f.subject.focus();
        return false;

    }

    if (f.content.value == '') {

        alert("상담 내용을 입력하세요.");
        f.content.focus();
        return false;

    }

    if (document.getElementById("return_layer").style.display == 'inline') {

        if (f.order_refund_holder.value == '') {

            alert("예금주명을 입력하세요.");
            f.order_refund_holder.focus();
            return false;

        }

        if (f.order_refund_number.value == '') {

            alert("계좌번호을 입력하세요.");
            f.order_refund_number.focus();
            return false;

        }

        if (f.order_refund_code.value == '') {

            alert("은행을 선택하세요.");
            f.order_refund_code.focus();
            return false;

        }
/*
        if (f.order_refund_jumin.value == '') {

            alert("예금주 주민등록번호를 입력하세요.");
            f.order_refund_jumin.focus();
            return false;

        }
*/

    }

    f.user_email.value = f.user_email1.value+"@"+f.user_email2.value;
    f.user_hp.value = f.user_hp1.value+"-"+f.user_hp2.value+"-"+f.user_hp3.value;

    if (confirm("상담내용을 접수하시겠습니까?")) {

        return true;

    } else {

        return false;

    }

}
</script>

<script type="text/javascript">
$(document).ready( function() {

    $(".help_box .category select").selectBox();
    //$(".help_box .email select").selectBox();

    <? if ($help_type) { ?>
    setTimeout("helpType('<?=$help_type?>', 'load');", 100);
    setTimeout("helpOk();", 500);
    <? } ?>

});
</script>

<form method="post" name="formHelp" action="<?=$shop['path']?>/help_update.php" onsubmit="return submitHelp();" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" id="order_pay_type" name="order_pay_type" value="" />
<input type="hidden" id="help_check" name="help_check" value="" />
<input type="hidden" name="m" value="help" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="top_bg">
    <td width="15"></td>
    <td><img src="<?=$dmshop_help_path?>/img/title.png" class="png"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td width="15"></td>
    <td>
<!-- 문의유형 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_help_path?>/img/help_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_help_path?>/img/t1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="help_box">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">문의 유형</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="category">
<select id="help_category" name="help_category" onchange="helpCategory(this.value);" class="select">
    <option value="">문의유형을 선택해 주세요.</option>
    <option value="200"><?=shop_help_category("200");?></option>
    <option value="300"><?=shop_help_category("300");?></option>
    <option value="400"><?=shop_help_category("400");?></option>
    <option value="500"><?=shop_help_category("500");?></option>
    <option value="1"><?=shop_help_category("1");?></option>
    <option value="2"><?=shop_help_category("2");?></option>
    <option value="3"><?=shop_help_category("3");?></option>
    <option value="4"><?=shop_help_category("4");?></option>
    <option value="0"><?=shop_help_category("0");?></option>
</select>

<? if ($help_category) { ?>
<script type="text/javascript">
document.getElementById('help_category').value = "<?=$help_category?>";
</script>
<? } ?>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#dddddd"></td>
<tr>
    <td bgcolor="#f7f7f7" align="center" class="title" valign="top"><p>문의 대상</p></td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="help_type" value="1" class="radio" onclick="helpType('1', 'reset');" <? if ($help_type == '1' || !$help_type) { echo "checked"; } ?> /></td>
    <td width="3"></td>
    <td class="list">주문관련</td>
    <td width="15"></td>
    <td><input type="radio" name="help_type" value="2" class="radio" onclick="helpType('2', 'reset');" <? if ($help_type == '2') { echo "checked"; } ?> /></td>
    <td width="3"></td>
    <td class="list">상품관련</td>
    <td width="15"></td>
    <td><input type="radio" name="help_type" value="3" class="radio" onclick="helpType('3', 'reset');" <? if ($help_type == '3') { echo "checked"; } ?> /></td>
    <td width="3"></td>
    <td class="list">없음(상품 외 문의)</td>
</tr>
</table>

<div id="code_layer" style="display:inline;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="7"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<div style="border:1px solid #e0e0e0; background-color:#f5f5f5; padding:7px 10px 7px 10px;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span id="code_msg">주문번호 입력</span></td>
    <td width="10"></td>
    <td><input type="text" id="help_code" name="help_code" value="<?=$help_code?>" class="input" /></td>
    <td width="2"></td>
    <td><a href="#" onclick="helpOk(); return false;"><img src="<?=$dmshop_help_path?>/img/ok.gif" border="0"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="helpSearch(); return false;"><img src="<?=$dmshop_help_path?>/img/find.gif" border="0"></a></td>
</tr>
</table>
</div>
    </td>
</tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 문의유형 end //-->

<!-- 문의대상정보 start //--><table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="30"><td></td></tr>
</table>

<div id="help_data"></div>
<!-- 문의대상정보 end //-->

<!-- 내용작성 start //-->
<table border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td><img src="<?=$dmshop_help_path?>/img/help_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_help_path?>/img/t3.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="help_box box_bg">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">상담 제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><input type="text" name="subject" class="input" style="width:425px;" /></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr>
    <td bgcolor="#f7f7f7" align="center" class="title">상담 내용</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<textarea name="content" class="textarea"></textarea>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">첨부파일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file" class="file" size="30" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="7"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="msg">이미지 등의 증빙파일을 첨부하고자 하실 경우 우측 ‘찾아보기’버튼 클릭<br>첨부파일이 많을 경우, 압축후 등록해 주시기 바랍니다.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 내용작성 end //-->

<!-- 환불정보 start //-->
<div id="return_layer" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td><img src="<?=$dmshop_help_path?>/img/help_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_help_path?>/img/t4.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="help_box box_bg">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">예금주명</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><input type="text" name="order_refund_holder" value="<?=text($dmshop_user['user_name'])?>" class="input" style="width:100px;" /></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">계좌번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><input type="text" name="order_refund_number" value="" class="input" style="width:200px;" /></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">은행선택</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><select id="order_refund_code" name="order_refund_code" class="select"><option value="">선택하세요.</option><?=shop_pg_bankcode_option($dmshop['order_pg']);?></select></td>
</tr>
<?
/*
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">예금주 주민등록번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><input type="text" name="order_refund_jumin" value="" maxlength="13" class="input" style="width:100px;" /> <span class="msg">(- 부호생략)</span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
*/
?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
</div>
<!-- 환불정보 end //-->

<!-- 답변확인정보 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td><img src="<?=$dmshop_help_path?>/img/help_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_help_path?>/img/t5.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="help_box box_bg">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">답변수신 메일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<input type="hidden" name="user_email" value="<?=text($user_email)?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100"><input type="text" name="user_email1" value="<?=text($user_email1)?>" class="input" style="width:90px;" /></td>
    <td width="20" align="center"><span class="sub">@</span></td>
    <td><input type="text" name="user_email2" value="<?=text($user_email2)?>" class="input" style="width:90px; margin-right:5px;" /></td>
    <td class="email">
<select id="user_email_list" name="user_email_list" onChange="helpEmail();" class="select">
    <option value="self">직접입력</option>
    <option value="naver.com">naver.com</option>
    <option value="chol.com">chol.com</option>
    <option value="dreamwiz.com">dreamwiz.com</option>
    <option value="empal.com">empal.com</option>
    <option value="freechal.com">freechal.com</option>
    <option value="gmail.com">gmail.com</option>
    <option value="hanafos.com">hanafos.com</option>
    <option value="hanmail.net">hanmail.net</option>
    <option value="hanmir.com">hanmir.com</option>
    <option value="hitel.net">hitel.net</option>
    <option value="hotmail.com">hotmail.com</option>
    <option value="korea.com">korea.com</option>
    <option value="lycos.co.kr">lycos.co.kr</option>
    <option value="nate.com">nate.com</option>
    <option value="netian.com">netian.com</option>
    <option value="paran.com">paran.com</option>
    <option value="yahoo.com">yahoo.com</option>
    <option value="yahoo.co.kr">yahoo.co.kr</option>
</select>
    </td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center" class="title">답변안내 문자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<input type="hidden" name="user_hp" value="<?=text($user_hp)?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><select id="user_hp1" name="user_hp1" class="select"><option value="">선택</option><?=shop_option_sms2();?></select><script type="text/javascript">document.getElementById("user_hp1").value = "<?=text($user_hp1)?>";</script></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td width="50"><input type="text" id="user_hp2" name="user_hp2" value="<?=text($user_hp2)?>" maxlength="4" class="input" style="width:40px;" /></td>
    <td width="15" align="center"><span class="hyphen">-</span></td>
    <td width="50"><input type="text" id="user_hp3" name="user_hp3" value="<?=text($user_hp3)?>" maxlength="4" class="input" style="width:40px;" /></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 답변확인정보 end //-->
    </td>
    <td width="15"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="90">
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="image" src="<?=$dmshop_help_path?>/img/submit.gif" border="0"></td>
    <td width="5"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$dmshop_help_path?>/img/cancel.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>
</form>