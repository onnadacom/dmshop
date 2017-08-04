<?php
include_once("./_dmshop.php");
if ($order_code) { $order_code = preg_match("/^[a-zA-Z0-9]+$/", $order_code) ? $order_code : ""; }
if ($tab) { $tab = preg_match("/^[a-zA-Z0-9]+$/", $tab) ? $tab : ""; }
$shop['title'] = "주문관리 옵션";
include_once("$shop[path]/shop.top.php");
//shop_pg_cancel("GR1204179219");

$colspan = "9";

if (!$order_code) {

    alert_close("주문내역이 존재하지 않습니다.");

}

// 검색조건
$sql_search = "";
$sql_search = " where order_code = '".$order_code."' ";

$cnt = sql_fetch(" select *, count(order_code) as cnt from $shop[order_table] $sql_search group by order_code ");

// 데이터 임시저장
$dmshop_order = $cnt;

// 주문 내역이 없다.
if (!$dmshop_order['cnt']) {

    alert_close("{$order_code} 주문내역은 삭제되었습니다.");

}

$total_count = $cnt['cnt'];

$rows = 1000;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_v1("10", $page, $total_page, "?page=");

$result = sql_query(" select * from $shop[order_table] $sql_search order by order_number asc limit $from_record, $rows ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

    // 상품
    $dmshop_item = shop_item($row['item_id']);

    // 옵션 초기화
    unset($dmshop_item_option);

    // 옵션
    if ($row['option_id']) {

        // 상품 옵션
        $dmshop_item_option = shop_item_option($row['option_id']);

        // 수량
        $list[$i]['item_limit'] = $dmshop_item_option['option_limit'];

    } else {
    // 일반

        // 상품정보가 있을 때
        if ($dmshop_item['id']) {

            // 수량
            $list[$i]['item_limit'] = $dmshop_item['item_limit'];

        } else {
        // 없다면

            // 수량 제로
            $list[$i]['item_limit'] = "0";

        }

    }

}

// 총 카운트
$order_total_count = $total_count;

// 결제금액없다
if (!$dmshop_order['order_dep_money_real']) {

    $dmshop_order['order_dep_money_real'] = "";

}

// 결제일이 없다
if ($dmshop_order['order_pay_datetime'] == '0000-00-00 00:00:00') {

    $dmshop_order['order_pay_datetime'] = "";

}

// 배송일시가 없다
if ($dmshop_order['order_delivery_datetime'] == '0000-00-00 00:00:00') {

    $dmshop_order['order_delivery_datetime'] = "";

}

// 수령일시가 없다
if ($dmshop_order['order_receive_datetime'] == '0000-00-00 00:00:00') {

    $dmshop_order['order_receive_datetime'] = "";

}

// 취소일시가 없다
if ($dmshop_order['order_cancel_datetime'] == '0000-00-00 00:00:00') {

    $dmshop_order['order_cancel_datetime'] = "";

}

// 취소승인일시가 없다
if ($dmshop_order['order_cancel_ok_datetime'] == '0000-00-00 00:00:00') {

    $dmshop_order['order_cancel_ok_datetime'] = "";

}

// 교환일시가 없다
if ($dmshop_order['order_exchange_datetime'] == '0000-00-00 00:00:00') {

    $dmshop_order['order_exchange_datetime'] = "";

}

// 교환승인일시가 없다
if ($dmshop_order['order_exchange_ok_datetime'] == '0000-00-00 00:00:00') {

    $dmshop_order['order_exchange_ok_datetime'] = "";

}

// 환불일시가 없다
if ($dmshop_order['order_refund_datetime'] == '0000-00-00 00:00:00') {

    $dmshop_order['order_refund_datetime'] = "";

}

// 환불승인일시가 없다
if ($dmshop_order['order_refund_ok_datetime'] == '0000-00-00 00:00:00') {

    $dmshop_order['order_refund_ok_datetime'] = "";

}

// user
$user = shop_user($dmshop_order['user_id']);

if ($user['id']) {

    $userview = shop_userview($user['user_id'], $user['user_name'], $user['user_email'], $user['user_homepage'], $user['user_id']);

} else {

    $userview = shop_userview("", $dmshop_order['order_name'], $dmshop_order['order_email'], "", shop_user_level("1"));

}
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#ffffff;}

.order_list .thumb {border:2px solid #e4e4e4;}

.contents_box .select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select1 .selectBox-dropdown {width:100px; height:19px;}
.contents_box .select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {
    $(".contents_box .select1 select").selectBox();
});
</script>

<script type="text/javascript" src="<?=$shop['path']?>/js/userview.js"></script>

<script type="text/javascript">
function formAdd(id1, id2, val)
{

    if (id2 == 'order_delivery_id') {

        if (document.getElementById(id1).checked == true) {

            $("#"+id2).selectBox('value', val);

        } else {

            $("#"+id2).selectBox('value', '');

        }

    } else {

        if (document.getElementById(id1).checked == true) {

            document.getElementById(id2).value = val;

        } else {

            document.getElementById(id2).value = "";

        }

    }

}

function formAddTime(id1, id2)
{

    var date = new Date();

    var Year = date.getFullYear();
    var Month = date.getMonth() + 1;
    var Day = date.getDate();
    var Hour = date.getHours();
    var Min = date.getMinutes();
    var Sec = date.getSeconds();

    if (Month < 10) {

        var Month = "0"+Month;

    }

    if (Day < 10) {

        var Day = "0"+Day;

    }

    if (Hour < 10) {

        var Hour = "0"+Hour;

    }

    if (Min < 10) {

        var Min = "0"+Min;

    }

    if (Sec < 10) {

        var Sec = "0"+Sec;

    }

    var time_view = Year+"-"+Month+"-"+Day+" "+Hour+":"+Min+":"+Sec;

    if (document.getElementById(id1).checked == true) {

        document.getElementById(id2).value = time_view;

    } else {

        document.getElementById(id2).value = "";

    }

}

// 입금확인
function submitBank(m)
{

    var f = document.formBank;

    if (m == 'bank_ok' || m == 'bank_update') {

        if (f.order_dep_name_real.value == '') {

            alert("입금자명을 입력하세요.");
            f.order_dep_name_real.focus();
            return false;

        }

        if (f.order_dep_money_real.value == '') {

            alert("무통장 입금액을 입력하세요.");
            f.order_dep_money_real.focus();
            return false;

        }

        if (f.order_pay_datetime.value == '') {

            alert("입금 확인일시를 입력하세요.");
            f.order_pay_datetime.focus();
            return false;

        }

    }

    if (m == 'bank_refund') {

        if (f.order_refund_holder.value == '') {

            alert("예금주명을 입력하세요.");
            f.order_refund_holder.focus();
            return false;

        }

        if (f.order_refund_number.value == '') {

            alert("계좌번호를 입력하세요.");
            f.order_refund_number.focus();
            return false;

        }

        if (f.order_refund_code.value == '') {

            alert("은행을 선택하세요.");
            f.order_refund_code.select();
            return false;

        }

    }

    f.m.value = m;

    f.action = "./order_manage_update.php";
    f.submit();

}

// 배송준비
function submitPrepare(m)
{

    var f = document.formPrepare;

    f.m.value = m;

    f.action = "./order_manage_update.php";
    f.submit();

}

// 상품발송
function submitDelivery(m)
{

    var f = document.formDelivery;

    if (m == 'delivery_ok' || m == 'delivery_update') {

        if (f.order_delivery_id.value == '') {

            alert("배송업체를 선택하세요.");
            //f.order_delivery_id.focus();
            return false;

        }

        if (f.order_delivery_tel.value == '') {

            alert("업체 연락처를 입력하세요.");
            f.order_delivery_tel.focus();
            return false;

        }

        if (f.order_delivery_url.value == '') {

            alert("배송조회 URL을 입력하세요.");
            f.order_delivery_url.focus();
            return false;

        }

        if (f.order_delivery_number.value == '') {

            alert("운송장 번호를 입력하세요.");
            f.order_delivery_number.focus();
            return false;

        }

        if (f.order_delivery_datetime.value == '') {

            alert("배송일시를 입력하세요.");
            f.order_delivery_datetime.focus();
            return false;

        }

    }

    f.m.value = m;

    f.action = "./order_manage_update.php";
    f.submit();

}

// 취소상태
function submitCancel(m)
{

    var f = document.formCancel;

    f.m.value = m;

    f.action = "./order_manage_update.php";
    f.submit();

}

// 교환상태
function submitExchange(m)
{

    var f = document.formExchange;

    f.m.value = m;

    f.action = "./order_manage_update.php";
    f.submit();

}

// 환불상태
function submitRefund(m)
{

    var f = document.formRefund;

    f.m.value = m;

    f.action = "./order_manage_update.php";
    f.submit();

}

// 답변
function submitHelp()
{

    var f = document.formHelp;

    if (f.subject.value == '') {

        alert("답변 제목을 입력하세요.");
        f.subject.focus();
        return false;

    }

    if (f.content.value == '') {

        alert("답변 내용을 입력하세요.");
        f.content.focus();
        return false;

    }

    f.action = "./order_manage_update.php";
    f.submit();

}

// 메모등록
function submitMemo()
{

    var f = document.formMemo;

    if (f.content.value == '') {

        alert("내용을 입력하세요.");
        f.content.focus();
        return false;

    }

    f.m.value = "memo";

    f.action = "./order_manage_update.php";
    f.submit();

}

// 메모삭제
function memoDelete(memo_id)
{

    var f = document.formMemo;

    f.m.value = "memo_delete";
    f.memo_id.value = memo_id;

    f.action = "./order_manage_update.php";
    f.submit();

}

// 직권취소
function orderCancel()
{

    var f = document.formUpdate;

    f.m.value = "cancel_ok";

    if (!confirm("주문을 취소하시겠습니까?\n\n취소된 주문은 복구할 수 없습니다.")) {

        return false;

    }

    f.action = "./order_manage_update.php";
    f.submit();

}
</script>

<form method="post" name="formUpdate" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="order_code" value="<?=$order_code?>" />
</form>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="37" bgcolor="#1f1f22">
    <td width="15"></td>
    <td width="11"><img src="<?=$shop['image_path']?>/adm/arrow.gif" class="up2"></td>
    <td><span class="popup_title1">주문관리 옵션</span></td>
<? if ($dmshop_order['order_cancel'] != '2' && $dmshop_order['order_exchange'] != '2' && $dmshop_order['order_refund'] != '2') { ?>
    <td width="103"><a href="#" onclick="orderCancel(); return false;"><img src="<?=$shop['image_path']?>/adm/order_cancel.gif" border="0"></a></td>
    <td width="5"></td>
<? } ?>
    <td width="45"><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/close2.gif" border="0"></a></td>
    <td width="10"></td>
</tr>
</table>

<!-- 상단 탭 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_top_bg">
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="41">
    <td width="20"></td>
    <td width="60" class="popup_title3">주문상태</td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="15"><img src="<?=$shop['image_path']?>/adm/manage_top_box1.gif"></td>
    <td class="manage_top_box2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="popup_order_type_100">결제전</td>
    <td width="34" align="center"><img src="<?=$shop['image_path']?>/adm/arrow2.gif"></td>
    <td class="popup_order_type<? if ($dmshop_order['order_payment'] == '2') { echo " popup_order_type_101"; } ?>"><?=shop_order_type("101");?></td>
    <td width="34" align="center"><img src="<?=$shop['image_path']?>/adm/arrow2.gif"></td>
    <td class="popup_order_type<? if ($dmshop_order['order_delivery']) { echo " popup_order_type_200"; } ?>"><?=shop_order_type("200");?></td>
    <td width="34" align="center"><img src="<?=$shop['image_path']?>/adm/arrow2.gif"></td>
    <td class="popup_order_type<? if ($dmshop_order['order_delivery'] == '2') { echo " popup_order_type_201"; } ?>"><?=shop_order_type("201");?></td>
    <td width="34" align="center"><img src="<?=$shop['image_path']?>/adm/arrow2.gif"></td>
    <td class="popup_order_type<? if ($dmshop_order['order_receive']) { echo " popup_order_type_202"; } ?>"><?=shop_order_type("202");?></td>
    <td width="34" align="center"><img src="<?=$shop['image_path']?>/adm/arrow3.gif"></td>
    <td class="popup_order_type<? if ($dmshop_order['order_ok']) { echo " popup_order_type_900"; } ?>"><?=shop_order_type("900");?></td>
    <td width="34" align="center"><img src="<?=$shop['image_path']?>/adm/arrow3.gif"></td>
<?
// 교환접수
if ($dmshop_order['order_exchange']) {
?>
    <td class="popup_order_type<? if ($dmshop_order['order_exchange']) { echo " popup_order_type_400"; } ?>"><?=shop_order_type("400");?></td>
    <td width="34" align="center"><img src="<?=$shop['image_path']?>/adm/arrow2.gif"></td>
    <td class="popup_order_type<? if ($dmshop_order['order_exchange'] == '2') { echo " popup_order_type_401"; } ?>"><?=shop_order_type("401");?></td>
<?
}

// 환불접수
else if ($dmshop_order['order_refund']) {
?>
    <td class="popup_order_type<? if ($dmshop_order['order_refund']) { echo " popup_order_type_500"; } ?>"><?=shop_order_type("500");?></td>
    <td width="34" align="center"><img src="<?=$shop['image_path']?>/adm/arrow2.gif"></td>
    <td class="popup_order_type<? if ($dmshop_order['order_refund'] == '2') { echo " popup_order_type_501"; } ?>"><?=shop_order_type("501");?></td>
<? } else { ?>
    <td class="popup_order_type<? if ($dmshop_order['order_cancel']) { echo " popup_order_type_300"; } ?>"><?=shop_order_type("300");?></td>
    <td width="34" align="center"><img src="<?=$shop['image_path']?>/adm/arrow2.gif"></td>
    <td class="popup_order_type<? if ($dmshop_order['order_cancel'] == '2') { echo " popup_order_type_301"; } ?>"><?=shop_order_type("301");?></td>
<? } ?>
</tr>
</table>
    </td>
    <td width="15"><img src="<?=$shop['image_path']?>/adm/manage_top_box3.gif"></td>
</tr>
</table>
    </td>
    <td width="20"></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="41">
    <td width="20"></td>
    <td <? if (!$tab) { echo "class='manage_tab'"; } ?>><a href="?order_code=<?=$order_code?>" class="<? if (!$tab) { echo "manage_on"; } else { echo "manage_off"; } ?>">종합정보</a></td>
    <td width="18" align="center" class="manage_tab_line">|</td>
    <td <? if ($tab == 'bank') { echo "class='manage_tab'"; } ?>><a href="?order_code=<?=$order_code?>&tab=bank" class="<? if ($tab == 'bank') { echo "manage_on"; } else { echo "manage_off"; } ?>">결제정보</a></td>
    <td width="18" align="center" class="manage_tab_line">|</td>
    <td <? if ($tab == 'prepare') { echo "class='manage_tab'"; } ?>><a href="?order_code=<?=$order_code?>&tab=prepare" class="<? if ($tab == 'prepare') { echo "manage_on"; } else { echo "manage_off"; } ?>">배송준비</a></td>
    <td width="18" align="center" class="manage_tab_line">|</td>
    <td <? if ($tab == 'delivery') { echo "class='manage_tab'"; } ?>><a href="?order_code=<?=$order_code?>&tab=delivery" class="<? if ($tab == 'delivery') { echo "manage_on"; } else { echo "manage_off"; } ?>">상품발송</a></td>
    <td width="18" align="center" class="manage_tab_line">|</td>
    <td <? if ($tab == 'cancel') { echo "class='manage_tab'"; } ?>><a href="?order_code=<?=$order_code?>&tab=cancel" class="<? if ($tab == 'cancel') { echo "manage_on"; } else { echo "manage_off"; } ?>">취소관리</a></td>
    <td width="18" align="center" class="manage_tab_line">|</td>
    <td <? if ($tab == 'exchange') { echo "class='manage_tab'"; } ?>><a href="?order_code=<?=$order_code?>&tab=exchange" class="<? if ($tab == 'exchange') { echo "manage_on"; } else { echo "manage_off"; } ?>">교환관리</a></td>
    <td width="18" align="center" class="manage_tab_line">|</td>
    <td <? if ($tab == 'refund') { echo "class='manage_tab'"; } ?>><a href="?order_code=<?=$order_code?>&tab=refund" class="<? if ($tab == 'refund') { echo "manage_on"; } else { echo "manage_off"; } ?>">환불관리</a></td>
    <td width="18" align="center" class="manage_tab_line">|</td>
    <td <? if ($tab == 'memo') { echo "class='manage_tab'"; } ?>><a href="?order_code=<?=$order_code?>&tab=memo" class="<? if ($tab == 'memo') { echo "manage_on"; } else { echo "manage_off"; } ?>">메모</a></td>
</tr>
</table>
    </td>
</tr>
</table>
<!-- 상단 탭 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td>
<!-- 주문정보 start //-->
<? if ($tab == '') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="30"></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/manage_t1.gif"></td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">주문번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="order_code"><?=$order_code?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">주문자명 (ID)</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="order_name"><?=text($dmshop_order['order_name'])?></span><span class="user_id"> (<?=$userview?>)</span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">주문자 연락처</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_order['order_hp'])?> / <?=text($dmshop_order['order_tel'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">주문자 주소</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="tx1">(우: <?=text($dmshop_order['order_zip1'])?><?=text($dmshop_order['order_zip2'])?>)</span><span class="tx2"> <?=text($dmshop_order['order_addr1'])?> <?=text($dmshop_order['order_addr2'])?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">주문일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="datetime1"><?=date("Y-m-d", strtotime($dmshop_order['order_datetime']));?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($dmshop_order['order_datetime']));?></span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<? } ?>
<!-- 주문정보 start //-->

<?
include_once("order_manage.bank.php");
include_once("order_manage.prepare.php");
include_once("order_manage.delivery.php");
include_once("order_manage.cancel.php");
include_once("order_manage.exchange.php");
include_once("order_manage.refund.php");
include_once("order_manage.memo.php");
?>

<!-- 상품수령정보 start //-->
<? if ($tab == '') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/manage_t5.gif"></td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup>
    <col width="149">
    <col width="1">
    <col width="15">
    <col width="">
</colgroup>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">수령일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2">
<?
if ($dmshop_order['order_receive_datetime']) {

    echo date("Y-m-d", strtotime($dmshop_order['order_receive_datetime']));

    echo " <span style='color:#adadad;'>".date("H:i", strtotime($dmshop_order['order_receive_datetime']))."</span>";

}
?>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">수령정보</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2">
<?
if ($dmshop_order['order_receive']) {

    // 발송일에서 수령기간을 더한다.
    $order_delivery_datetime = date("Y-m-d H:i:s", strtotime($dmshop_order['order_delivery_datetime']) + ($dmshop['order_receive_day'] * 86400));

    // 수령확인시간이 지나지 않았다.
    if ($order_delivery_datetime > $dmshop_order['order_receive_datetime']) {

        echo "구매자 수령확인";

    } else {
    // 지났다

        echo "배송일로 부터 ".$dmshop['order_receive_day']."일 경과";

    }

}
?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<? } ?>
<!-- 상품수령정보 start //-->

    </td>
    <td width="20"></td>
</tr>
</table>

<div style="height:50px;"></div>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>