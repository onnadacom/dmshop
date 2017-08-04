<?php
if (!defined('_DMSHOP_')) exit;

// 해당 회원의 구매횟수 및 실결제총액 (배송완료인 주문내역을 뽑는다)
$order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where user_id = '".$user_id."' and order_type in ('202','900')) as x ");

// 해당 회원의 최근 구매
$dmshop_order = sql_fetch(" select * from $shop[order_table] where user_id = '".$user_id."' order by order_datetime desc ");

// 해당 회원의 보유쿠폰
$dmshop_coupon_list = shop_coupon_user_count($user_id);

// 해당 회원의 총 상품문의
$dmshop_qna = sql_fetch(" select count(*) as total_count from $shop[qna_table] where user_id = '".$user_id."' ");

// 해당 회원의 총 상품평
$dmshop_reply = sql_fetch(" select count(*) as total_count from $shop[reply_table] where user_id = '".$user_id."' ");

// 해당 회원의 총 1:1문의
$dmshop_help = sql_fetch(" select count(*) as total_count from $shop[help_table] where user_id = '".$user_id."' ");
?>
<!-- 가입정보 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/user_manage_t0.gif"></td>
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
    <td bgcolor="#f7f7f7" class="popup_subject">아이디</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="user_id"><?=shop_user_id($user['user_id'], $user['user_leave_datetime']);?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">성명/등급</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><span class="user_name"><?=text($user['user_name'])?></span> (<?=shop_user_level($user['user_level']);?>)</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">생년월일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><? if ($user['user_birth']) { ?><?=date("Y년 m월 d일", strtotime($user['user_birth']));?><? } ?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">기본 주소</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><? if ($user['user_zip1']) { ?><span class="zip">(우: <?=text($user['user_zip1'])?><?=text($user['user_zip2'])?>)</span> <?=text($user['user_addr1'])?> <?=text($user['user_addr2'])?><? } ?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">휴대폰 / 일반전화</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($user['user_hp']) { ?>
    <td><img src="<?=$shop['image_path']?>/adm/btn_hp.gif"></td>
    <td width="5"></td>
    <td class="tx2"><?=text($user['user_hp'])?></td>
<? } ?>
<? if ($user['user_tel']) { ?>
    <td width="20"></td>
    <td><img src="<?=$shop['image_path']?>/adm/btn_tel.gif"></td>
    <td width="5"></td>
    <td class="tx2"><?=text($user['user_tel'])?></td>
<? } ?>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">이메일 / 홈페이지</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($user['user_email']) { ?>
    <td><img src="<?=$shop['image_path']?>/adm/btn_email.gif"></td>
    <td width="5"></td>
    <td class="tx2"><?=text($user['user_email'])?></td>
    <td width="20"></td>
    <td><a href="<?=shop_http(text($user['user_homepage']));?>" target="_blank" class="tx2"><?=text($user['user_homepage'])?></a></td>
<? } ?>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 가입정보 end //-->

<!-- 메모내역 start //-->
<script type="text/javascript">
// 메모삭제
function memoDelete(memo_id)
{

    var f = document.formMemo;

    f.m.value = "memo_delete";
    f.memo_id.value = memo_id;

    f.action = "./user_manage_update.php";
    f.submit();

}
</script>

<form method="post" name="formMemo">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="user_id" value="<?=$user_id?>" />
<input type="hidden" name="memo_id" value="" />
</form>

<?
$result = sql_query(" select * from $shop[user_memo_table] where user_id = '".$user_id."' order by id desc limit 0, 5 ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $list[$i] = $row;

}
?>
<? if (count($list)) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/user_manage_t1.gif"></td>
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
<? for ($i=0; $i<count($list); $i++) { ?>
<? if ($i > '0') { ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<? } ?>
<tr height="30">
    <td bgcolor="#f7f7f7" align="center"><span class="datetime1"><?=date("Y-m-d", strtotime($list[$i]['datetime']))?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($list[$i]['datetime']))?></span></td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=text2($list[$i]['content'], 0);?> <a href="#" onclick="memoDelete('<?=$list[$i]['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/manage_memo_delete.gif" border="0" class="down2"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<? } ?>
<? if (!$i) { ?>
<tr><td colspan="4" height="100" align="center" class="tx2">등록된 메모가 없습니다.</td>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 메모내역 end //-->
<? } ?>

<!-- 쇼핑정보 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/user_manage_t2.gif"></td>
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
    <td bgcolor="#f7f7f7" class="popup_subject">최근 주문상품</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><? if ($dmshop_order['id']) { ?><a href="<?=$shop['path']?>/item.php?id=<?=$dmshop_order['item_code']?>" target="_blank" class="item_title"><?=text($dmshop_order['item_title'])?><? if ($dmshop_order['option_name']) { ?> <span class="item_option">(옵션 : <?=text($dmshop_order['option_name'])?>)</span><? } ?></a><? } ?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">누적 구매횟수</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><a href="./order_all_list.php?f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="주문내역 조회하기"><b><?=number_format($order['total_order_count']);?></b> 회</a></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">누적 구매금액</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><b><?=number_format($order['total_order_pay_money']);?></b> 원</td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">적립금 현황</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="./cash_list.php?f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="적립내역 조회하기"><b><?=number_format($user['user_cash']);?></b> 원</a></td>
    <td width="10"></td>
    <td><a href="#" onclick="cashPopupMake('plus', '<?=$user_id?>'); return false;" class="popup_btn">적립금 지급</a></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">쿠폰 현황</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="./coupon_make_list.php?f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="쿠폰내역 조회하기"><b><?=number_format($dmshop_coupon_list['total_count']);?></b> 장</a></td>
    <td width="10"></td>
    <td><a href="#" onclick="couponPopupMake('<?=$user_id?>'); return false;" class="popup_btn">쿠폰 지급</a></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 쇼핑정보 end //-->

<!-- 접속정보 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/user_manage_t3.gif"></td>
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
    <td bgcolor="#f7f7f7" class="popup_subject">회원 가입일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=date("Y-m-d H:s", strtotime($user['datetime']));?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">회원 가입IP</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><a href="./reporting_visit_list.php?date1=2012-01-01&date2=<?=$shop['time_ymd']?>&f=vi_ip&q=<?=text($user['user_ip'])?>" target="_blank" class="tx2 underline" title="방문기록 IP 조회하기"><?=text($user['user_ip'])?></a></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">최종접속 일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=date("Y-m-d H:s", strtotime($user['user_login']));?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">최종접속 IP</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><a href="./reporting_visit_list.php?date1=2012-01-01&date2=<?=$shop['time_ymd']?>&f=vi_ip&q=<?=text($user['user_login_ip'])?>" target="_blank" class="tx2 underline" title="방문기록 IP 조회하기"><?=text($user['user_login_ip'])?></a></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">상품평 작성</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><a href="./reply_list.php?f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="상품평 작성내역 조회하기"><?=number_format($dmshop_reply['total_count']);?> 회</a></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">상품문의 작성</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><a href="./qna_list.php?f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="상품문의 작성내역 조회하기"><?=number_format($dmshop_qna['total_count']);?> 회</a></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">1:1 문의 접수</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><a href="./help_list.php?f=user_id&q=<?=$user_id?>" target="_blank" class="tx2 underline" title="1:1 문의 접수내역 조회하기"><?=number_format($dmshop_help['total_count']);?> 회</a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>
<!-- 접속정보 end //-->