<?
include_once("./_dmshop.php");

if ($help_type) { $help_type = preg_match("/^[0-9]+$/", $help_type) ? $help_type : ""; }
if ($help_code) { $help_code = preg_match("/^[a-zA-Z0-9]+$/", $help_code) ? $help_code : ""; }
if ($help_category) { $help_category = preg_match("/^[a-zA-Z0-9]+$/", $help_category) ? $help_category : ""; }

// 스킨 경로
$dmshop_help_path = "";
$dmshop_help_path = $shop['path']."/skin/help/".$dmshop_skin['skin_help'];

if ($m == '') {

    echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

    // 로그인
    if (!$shop_user_login) {

        message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "", "", false, true);

    }

    if (!$help_type || !$help_code) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "", "", false, true);

    }

    // 주문관련
    if ($help_type == '1') {

        // 주문번호 설정
        $order_code = $help_code;

        // 검색조건
        $sql_search = "";
        $sql_search = " where order_code = '".$order_code."' ";

        $cnt = sql_fetch(" select *, count(*) as cnt from $shop[order_table] $sql_search group by order_code ");

        // 데이터 임시저장
        $dmshop_order = $cnt;

        // 주문 내역이 없다.
        if (!$dmshop_order['id']) {

            message("<p class='title'>알림</p><p class='text'>존재하지 않는 주문번호입니다.</p>", "", "", false, true);

        }

        // 주문자가 다르다.
        if ($dmshop_user['user_id'] != $dmshop_order['user_id'] && !$shop_user_admin) {

            message("<p class='title'>알림</p><p class='text'>존재하지 않는 주문번호입니다.</p>", "", "", false, true);

        }

        $total_count = $cnt['cnt'];

        $rows = 1000;

        $total_page  = ceil($total_count / $rows);

        if (!$page) {

            $page = 1;

        }

        $from_record = ($page - 1) * $rows;

        $shop_pages = shop_paging_v1("10", $page, $total_page, "?page=");

        $list = array();
        $result = sql_query(" select * from $shop[order_table] $sql_search order by order_number asc limit $from_record, $rows ");
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            $list[$i] = $row;

        }
?>
<table border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td><img src="<?=$dmshop_help_path?>/img/help_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_help_path?>/img/t2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="10">
    <td></td>
</tr>
</table>

<!-- 주문정보 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_infor">
<tr>
    <td width="149" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">주문일시</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="47">
    <td align="center" class="date"><?=date("Y-m-d", strtotime($dmshop_order['order_datetime']));?><br><span class="time"><?=date("H시 i분", strtotime($dmshop_order['order_datetime']));?></span></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="1"></td>
    <td width="148" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">주문번호</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="47">
    <td align="center" class="code"><?=$order_code?></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="1"></td>
    <td width="148" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">결제금액</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="47">
    <td align="center" class="money"><?=number_format($dmshop_order['order_pay_money']);?> 원</td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="1"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">주문상태</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="47">
    <td align="center" class="mode"><?=shop_order_type($dmshop_order['order_type']);?></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 주문정보 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<!-- 주문상품목록 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list">
<colgroup>
    <col width="">
    <col width="1">
    <col width="90">
    <col width="1">
    <col width="90">
</colgroup>
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">상품명</td>
    <td></td>
    <td align="center" class="title">주문수량</td>
    <td></td>
    <td align="center" class="title">판매가격</td>
</tr>
<tr><td colspan="5" height="2" bgcolor="#777777"></td></tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($i > '0') { ?>
<tr><td colspan="5" class="dot"></td></tr>
<? } ?>
<tr height="73">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="9"></td>
    <td width="50" align="center"><div class="thumb"><a href="<?=$shop['path']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank"><img src="<?=shop_item_thumb($list[$i]['item_id'], "default", "", "50", "50");?>" width="50" height="50" border="0"></a></div></td>
    <td width="10"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=$list[$i]['item_code']?>" target="_blank" class="subject"><?=text($list[$i]['item_title'])?></a></td>
</tr>
</table>

<? if ($list[$i]['option_name']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><span class="option">주문옵션 : <?=text($list[$i]['option_name'])?></span></td>
</tr>
</table>
<? } ?>
    </td>
</tr>
</table>
    </td>
    <td bgcolor="#efefef"></td>
    <td align="center" class="limit"><?=number_format($list[$i]['order_limit']);?> 개</td>
    <td bgcolor="#efefef"></td>
    <td align="center" class="money"><?=number_format($list[$i]['order_item_money']);?> 원</td>
</tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>
<!-- 주문상품목록 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="30"><td></td></tr>
</table>

<script type="text/javascript">document.getElementById("order_pay_type").value = "<?=$dmshop_order['order_pay_type']?>";</script>
<?
    } // end if 주문관련 끝

    // 상품관련
    if ($help_type == '2') {

        // 상품번호 설정
        $item_code = $help_code;

        // 상품
        $dmshop_item = shop_item_code($item_code);

        // 상품이 없다.
        if (!$dmshop_item['id']) {

            message("<p class='title'>알림</p><p class='text'>존재하지 않는 상품번호입니다.</p>", "", "", false, true);

        }
?>
<table border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr>
    <td><img src="<?=$dmshop_help_path?>/img/help_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_help_path?>/img/t2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="10"><td></td></tr>
</table>

<!-- 상품목록 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="1"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_list">
<colgroup>
    <col width="">
    <col width="1">
    <col width="90">
</colgroup>
<tr height="30" bgcolor="#f7f7f7">
    <td align="center" class="title">상품명</td>
    <td></td>
    <td align="center" class="title">판매가격</td>
</tr>
<tr><td colspan="3" height="2" bgcolor="#777777"></td></tr>
<tr height="73">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="9"></td>
    <td width="50" align="center"><div class="thumb"><a href="<?=$shop['path']?>/item.php?id=<?=$dmshop_item['item_code']?>" target="_blank"><img src="<?=shop_item_thumb($dmshop_item['id'], "default", "", "50", "50");?>" width="50" height="50" border="0"></a></div></td>
    <td width="10"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=$dmshop_item['item_code']?>" target="_blank" class="subject"><?=text($dmshop_item['item_title'])?></a></td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
    <td bgcolor="#efefef"></td>
    <td align="center" class="money"><?=number_format($dmshop_item['item_money']);?> 원</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>
<!-- 상품목록 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box_bg">
<tr height="30"><td></td></tr>
</table>
<?
    } // end if 상품관련 끝

    echo "<script type='text/javascript'>document.getElementById('help_check').value = '".$help_code."';</script>";

}

// 등록
else if ($m == 'help') {

    if (!$shop_user_login) {

        message("<p class='title'>알림</p><p class='text'>로그인 후 이용하세요.</p>", "b");

    }

    if (!$help_type) {

        message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

    }

    // 주문관련
    if ($help_type == '1') {

        // 주문정보
        $dmshop_order = shop_order($help_code);

        // 주문자가 다르다.
        if ($dmshop_user['user_id'] != $dmshop_order['user_id'] && !$shop_user_admin) {

            message("<p class='title'>알림</p><p class='text'>주문내역이 삭제되었거나 존재하지 않는 주문번호입니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

        }

        // 주문취소, 교환신청, 환불신청
        if ($help_category == '300' || $help_category == '400' || $help_category == '500') {

            if ($dmshop_order['order_ok']) {

                message("<p class='title'>알림</p><p class='text'>구매완료된 주문은 신청하실 수 없습니다.</p>", "b");

            }

            if ($dmshop_order['order_cancel']) {

                message("<p class='title'>알림</p><p class='text'>이미 취소접수 중이거나 취소가 완료된 주문입니다.</p>", "b");

            }

            if ($dmshop_order['order_exchange']) {

                message("<p class='title'>알림</p><p class='text'>이미 교환접수 중이거나 교환이 완료된 주문입니다.</p>", "b");

            }

            if ($dmshop_order['order_refund']) {

                message("<p class='title'>알림</p><p class='text'>이미 환불접수 중이거나 환불이 완료된 주문입니다.</p>", "b");

            }

            // 상품수령
            if ($dmshop_order['order_receive']) {

                // 해당 상품의 교환가능한 날짜를 구함
                $order_receive_datetime = date("Y-m-d H:i:s", $shop['server_time'] - ($dmshop['order_exchange_day'] * 86400));

                // 날짜가 지났다면
                if ($order_receive_datetime >= $dmshop_order['order_receive_datetime']) {

                    message("<p class='title'>알림</p><p class='text'>$order_receive_datetime 상품수령일로부터 {$dmshop['order_exchange_day']}일이 지나면 취소, 교환, 환불을 하실 수 없습니다.</p>", "b");

                }

            } else {
            // 수령을 하지 않았을 때

                // 배송처리
                if ($dmshop_order['order_delivery']) {

                    message("<p class='title'>알림</p><p class='text'>상품을 수령확인 후 이용하여주시기 바랍니다.</p>", "b");

                }

            }

        }

        // 주문취소
        if ($help_category == '300') {

            // 배송처리
            if ($dmshop_order['order_delivery']) {

                message("<p class='title'>알림</p><p class='text'>상품을 수령확인 후 교환/환불으로 이용하여주시기 바랍니다.</p>", "b");

            }

            $sql_common = "";
            $sql_common .= " set order_type = '300' ";
            $sql_common .= ", order_type_tmp = '".$dmshop_order['order_type']."' ";
            $sql_common .= ", order_cancel = '1' ";
            $sql_common .= ", order_cancel_datetime = '".$shop['time_ymdhis']."' ";
            $sql_common .= ", order_refund_holder = '".trim(strip_tags(mysql_real_escape_string($_POST['order_refund_holder'])))."' ";
            $sql_common .= ", order_refund_number = '".trim(strip_tags(mysql_real_escape_string($_POST['order_refund_number'])))."' ";
            $sql_common .= ", order_refund_code = '".trim(strip_tags(mysql_real_escape_string($_POST['order_refund_code'])))."' ";
            $sql_common .= ", order_refund_jumin = '".trim(strip_tags(mysql_real_escape_string($_POST['order_refund_jumin'])))."' ";

            sql_query(" update $shop[order_table] $sql_common where order_code = '".$help_code."' ");

        }

        // 교환신청
        if ($help_category == '400') {

            // 미결제
            if ($dmshop_order['order_payment'] != '2') {

                message("<p class='title'>알림</p><p class='text'>결제되지 않은 주문은 교환신청을 하실 수 없습니다.</p>", "b");

            }

            $sql_common = "";
            $sql_common .= " set order_type = '400' ";
            $sql_common .= ", order_type_tmp = '".$dmshop_order['order_type']."' ";
            $sql_common .= ", order_exchange = '1' ";
            $sql_common .= ", order_exchange_datetime = '".$shop['time_ymdhis']."' ";

            // update
            sql_query(" update $shop[order_table] $sql_common where order_code = '".$help_code."' ");

        }

        // 환불신청
        if ($help_category == '500') {

            // 미결제
            if ($dmshop_order['order_payment'] != '2') {

                message("<p class='title'>알림</p><p class='text'>결제되지 않은 주문은 환불신청을 하실 수 없습니다.</p>", "b");

            }

            $sql_common = "";
            $sql_common .= " set order_type = '500' ";
            $sql_common .= ", order_type_tmp = '".$dmshop_order['order_type']."' ";
            $sql_common .= ", order_refund = '1' ";
            $sql_common .= ", order_refund_datetime = '".$shop['time_ymdhis']."' ";
            $sql_common .= ", order_refund_holder = '".trim(strip_tags(mysql_real_escape_string($_POST['order_refund_holder'])))."' ";
            $sql_common .= ", order_refund_number = '".trim(strip_tags(mysql_real_escape_string($_POST['order_refund_number'])))."' ";
            $sql_common .= ", order_refund_code = '".trim(strip_tags(mysql_real_escape_string($_POST['order_refund_code'])))."' ";
            $sql_common .= ", order_refund_jumin = '".trim(strip_tags(mysql_real_escape_string($_POST['order_refund_jumin'])))."' ";

            // update
            sql_query(" update $shop[order_table] $sql_common where order_code = '".$help_code."' ");

        }

    }

    // 상품관련
    if ($help_type == '2') {

        // 상품
        $dmshop_item = shop_item_code($help_code);

        // 상품이 없다.
        if (!$dmshop_item['id']) {

            message("<p class='title'>알림</p><p class='text'>상품이 삭제되었거나 존재하지 않는 상품번호입니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "b");

        }

    }

    // common
    $sql_common = "";
    $sql_common .= " set user_id = '".$dmshop_user['user_id']."' ";
    $sql_common .= ", user_name = '".trim(strip_tags(mysql_real_escape_string($dmshop_user['user_name'])))."' ";
    $sql_common .= ", help_category = '".trim(strip_tags(mysql_real_escape_string($help_category)))."' ";
    $sql_common .= ", help_type = '".trim(strip_tags(mysql_real_escape_string($help_type)))."' ";
    $sql_common .= ", help_code = '".trim(strip_tags(mysql_real_escape_string($help_code)))."' ";
    $sql_common .= ", subject = '".trim(mysql_real_escape_string($subject))."' ";
    $sql_common .= ", content = '".mysql_real_escape_string($content)."' ";
    $sql_common .= ", help_send_email = '1' ";
    $sql_common .= ", help_send_sms = '1' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    if ($user_email == '@' || !$user_email) {

        $sql_common .= ", user_email = '' ";

    } else {

        $sql_common .= ", user_email = '".trim(strip_tags(mysql_real_escape_string($user_email)))."' ";

    }

    if ($user_hp == '--' || !$user_hp) {

        $sql_common .= ", user_hp = '' ";

    } else {

        $sql_common .= ", user_hp = '".trim(strip_tags(mysql_real_escape_string($user_hp)))."' ";

    }

    // insert
    sql_query(" insert into $shop[help_table] $sql_common ");

    $help_id = "";
    $help_id = mysql_insert_id();

    // 아이디 기록
    sql_query(" update $shop[help_table] set help_id = '".$help_id."' where id = '".$help_id."' ");

    /*------------------------------
        ## 파일 ##
    ------------------------------*/

    // 파일경로
    $dir = $shop['path']."/data/help/".shop_data_path("", "");

    @mkdir("$dir", 0707);
    @chmod("$dir", 0707);

    // 회사소개 상단
    $upload_mode = $help_id;
    include("./upload_help_file.php");

    // sms
    $shop_sms_config = shop_sms_config("admin_help");

    // 사용
    if ($shop_sms_config['sms_use']) {

        $sms_to = $dmshop['rec_sms1'].$dmshop['rec_sms2'].$dmshop['rec_sms3'];
        $sms_from = $dmshop['sms1'].$dmshop['sms2'].$dmshop['sms3'];

        $sms_message = $shop_sms_config['sms_message'];
        $sms_message = str_replace("[문의유형]", shop_help_category($help_category), $sms_message);
        $sms_message = str_replace("[성명]", $dmshop_user['user_name'], $sms_message);
        $sms_message = str_replace("[아이디]", $dmshop_user['user_id'], $sms_message);
        $sms_message = str_replace("[쇼핑몰명]", $dmshop['shop_name'], $sms_message);
        $sms_message = str_replace("[URL]", $dmshop['domain'], $sms_message);

        // 전송
        shop_sms_send("admin_help", $dmshop_help['user_id'], $sms_to, $sms_from, $sms_message);

    }

    echo "<script type='text/javascript'>opener.location.reload();</script>";

    message("<p class='title'>알림</p><p class='text'>상담신청 접수를 완료하였습니다.</p>", "c");

} else {

    message("<p class='title'>알림</p><p class='text'>요청하신 서비스를 찾을 수 없습니다. 확인하신 후 다시 이용하시기 바랍니다.</p>", "c");

}
?>