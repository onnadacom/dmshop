<?php
include_once("./_dmshop.php");

if ($m == 'check_item') {

    for ($i=0; $i<count($chk_id); $i++) {

        $k = $chk_id[$i];

        $list[$i] = shop_user(addslashes($_POST['user_id'][$k]));

    }

} else {

    $sql_search = " where user_leave_datetime = '0000-00-00 00:00:00' ";

    if ($m == 'user') {

        $sql_search .= " ";

    }

    $result = sql_query(" select * from $shop[user_table] $sql_search order by datetime desc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $list[$i] = $row;

    }

}

// 회원가입 설정
$dmshop_signup = shop_signup();

$filename="user.xls";
header("Content-Type: application/vnd.ms-xls");
header("Content-Disposition: inline; filename=$filename");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$shop['charset']?>" />
<title>xls</title>
<style type="text/css">
.text {mso-number-format:"\@";mso-text-control:shrinktofit;white-space:nowrap;}
</style>
</head>
<body>

<? if ($m == 'user' || $m == 'check_user') { ?>
<table border="1" cellspacing="0" cellpadding="0">
<tr height="35">
    <td colspan="27" bgcolor="#000000" align="center"><span style='font-size:12px; color:#ffffff;'><b>전체회원 내역</b></span></td>
</tr>
<tr height="25">
    <td align="center" bgcolor="#d9d9d9">가입일시</td>
    <td align="center" bgcolor="#d9d9d9">아이디</td>
    <td align="center" bgcolor="#d9d9d9">성명</td>
    <td align="center" bgcolor="#d9d9d9">생년월일</td>
    <td align="center" bgcolor="#d9d9d9">성별</td>
    <td align="center" bgcolor="#d9d9d9">닉네임</td>
    <td align="center" bgcolor="#d9d9d9">휴대폰 번호</td>
    <td align="center" bgcolor="#d9d9d9">SMS 수신 동의</td>
    <td align="center" bgcolor="#d9d9d9">자택 전화번호</td>
    <td width="500" align="center" bgcolor="#d9d9d9">자택 주소</td>
    <td align="center" bgcolor="#d9d9d9">직장명</td>
    <td align="center" bgcolor="#d9d9d9">직장 전화번호</td>
    <td width="500" align="center" bgcolor="#d9d9d9">직장 주소</td>
    <td align="center" bgcolor="#d9d9d9">이메일</td>
    <td align="center" bgcolor="#d9d9d9">이메일 수신 동의</td>
    <td align="center" bgcolor="#d9d9d9">홈페이지</td>
    <td align="center" bgcolor="#d9d9d9">추천인</td>
    <td align="center" bgcolor="#d9d9d9"><? if ($dmshop_signup['user_etc1']) { echo text($dmshop_signup['user_etc1']); } else { echo "부가 수집 정보 1"; } ?></td>
    <td align="center" bgcolor="#d9d9d9"><? if ($dmshop_signup['user_etc2']) { echo text($dmshop_signup['user_etc2']); } else { echo "부가 수집 정보 2"; } ?></td>
    <td align="center" bgcolor="#d9d9d9"><? if ($dmshop_signup['user_etc3']) { echo text($dmshop_signup['user_etc3']); } else { echo "부가 수집 정보 3"; } ?></td>
    <td align="center" bgcolor="#d9d9d9"><? if ($dmshop_signup['user_etc4']) { echo text($dmshop_signup['user_etc4']); } else { echo "부가 수집 정보 4"; } ?></td>
    <td align="center" bgcolor="#d9d9d9"><? if ($dmshop_signup['user_etc5']) { echo text($dmshop_signup['user_etc5']); } else { echo "부가 수집 정보 5"; } ?></td>
    <td align="center" bgcolor="#d9d9d9">회원등급</td>
    <td align="center" bgcolor="#d9d9d9">누적 구매횟수</td>
    <td align="center" bgcolor="#d9d9d9">누적 구매금액</td>
    <td align="center" bgcolor="#d9d9d9">보유 적립금</td>
    <td align="center" bgcolor="#d9d9d9">보유 쿠폰</td>
</tr>
<?
for ($i=0; $i<count($list); $i++) {

    // 해당 회원의 구매횟수 및 실결제총액 (배송완료인 주문내역을 뽑는다)
    $order = sql_fetch(" select count(distinct order_code) as total_order_count, sum(order_pay_money) as total_order_pay_money from (select distinct order_code, order_pay_money from $shop[order_table] where user_id = '".addslashes($list[$i]['user_id'])."' and order_type in ('202','900')) as x ");

?>
<tr height="25">
    <td align="center"><?=$list[$i]['datetime']?></td>
    <td align="center"><?=text($list[$i]['user_id'])?></td>
    <td align="center"><?=text($list[$i]['user_name'])?></td>
    <td align="center"><?=text($list[$i]['user_birth'])?></td>
    <td align="center"><?=shop_user_sex($list[$i]['user_sex']);?></td>
    <td align="center"><?=text($list[$i]['user_nick'])?></td>
    <td align="center"><?=text($list[$i]['user_hp'])?></td>
    <td align="center"><? if ($list[$i]['user_sms']) { echo "O"; } ?></td>
    <td align="center"><?=text($list[$i]['user_tel'])?></td>
    <td>(<?=text($list[$i]['user_zip1'])?><?=text($list[$i]['user_zip2'])?>) <?=text($list[$i]['user_addr1'])?> <?=text($list[$i]['user_addr2'])?></td>
    <td align="center"><?=text($list[$i]['user_company'])?></td>
    <td align="center"><?=text($list[$i]['user_company_tel'])?></td>
    <td>(<?=text($list[$i]['user_company_zip1'])?><?=text($list[$i]['user_company_zip2'])?>) <?=text($list[$i]['user_company_addr1'])?> <?=text($list[$i]['user_company_addr2'])?></td>
    <td align="center"><?=text($list[$i]['user_email'])?></td>
    <td align="center"><? if ($list[$i]['user_mailing']) { echo "O"; } ?></td>
    <td align="center"><?=text($list[$i]['user_homepage'])?></td>
    <td align="center"><?=text($list[$i]['user_recommend'])?></td>
    <td align="center"><?=text($list[$i]['user_etc1'])?></td>
    <td align="center"><?=text($list[$i]['user_etc2'])?></td>
    <td align="center"><?=text($list[$i]['user_etc3'])?></td>
    <td align="center"><?=text($list[$i]['user_etc4'])?></td>
    <td align="center"><?=text($list[$i]['user_etc5'])?></td>
    <td align="center"><?=shop_user_level($list[$i]['user_level']);?></td>
    <td align="center"><?=text($order['total_order_count'])?></td>
    <td align="center"><?=text($order['total_order_pay_money'])?></td>
    <td align="center"><?=text($list[$i]['user_cash'])?></td>
    <td align="center"><?=shop_coupon_user_count($list[$i]['user_id']);?></td>
</tr>
<? } ?>
</table>
<? } ?>

</body>
</html>