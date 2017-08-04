<?
if (!defined('_DMSHOP_')) exit;

// 주문
$dmshop_infor1 = sql_fetch(" select count(distinct order_code) as cnt from $shop[order_table] where user_id = '".$dmshop_user['user_id']."' and order_payment != '0' and order_cancel = '0' and order_exchange = '0' and order_refund = '0' ");

// 취소
$dmshop_infor2 = sql_fetch(" select count(distinct order_code) as cnt from $shop[order_table] where user_id = '".$dmshop_user['user_id']."' and order_cancel != '0' ");

// 교환
$dmshop_infor3 = sql_fetch(" select count(distinct order_code) as cnt from $shop[order_table] where user_id = '".$dmshop_user['user_id']."' and order_exchange != '0' ");

// 환불
$dmshop_infor4 = sql_fetch(" select count(distinct order_code) as cnt from $shop[order_table] where user_id = '".$dmshop_user['user_id']."' and order_refund != '0' ");

// 1:1
$dmshop_infor5 = sql_fetch(" select count(*) as cnt from $shop[help_table] where id = help_id and user_id = '".$dmshop_user['user_id']."' ");

// 쿠폰
$dmshop_infor6 = sql_fetch(" select count(*) as cnt from $shop[coupon_list_table] where user_id = '".$dmshop_user['user_id']."' and coupon_date2 >= '".$shop['time_ymd']."' and coupon_mode in (0,1) ");

// 레벨 아이콘
$file = shop_user_level_file($dmshop_user['user_level']);

// 파일 경로
$file_path = $shop['path']."/data/user_level/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'];

// 파일이 있다면
$user_icon = "";
if (file_exists($file_path) && $file['upload_file']) {

    $user_icon = $file_path;

}
?>
<style type="text/css">
.mypage_infor .infor_bg {height:100px; background:url('<?=$dmshop_mypage_path?>/img/infor_bg.gif') repeat-x;}
.mypage_infor .level {margin-top:2px; line-height:14px; font-size:11px; color:#9e9e9e; font-family:gulim,굴림;}
.mypage_infor .t1 {font-weight:bold; line-height:16px; font-size:14px; color:#000000; font-family:gulim,굴림;}
.mypage_infor .t2 {font-weight:bold; line-height:16px; font-size:14px; color:#3198f0; font-family:gulim,굴림;}
.mypage_infor .t3 {font-weight:bold; line-height:16px; font-size:14px; color:#ff3c00; font-family:gulim,굴림;}

.mypage_title p {line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.mypage_title p .t1 {font-weight:bold; line-height:14px; font-size:12px; color:#3198f0; font-family:gulim,굴림;}
.mypage_title p .t2 {font-weight:bold; line-height:14px; font-size:12px; color:#ff3c00; font-family:gulim,굴림;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_infor">
<tr height="100">
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
<tr>
<? if ($user_icon) { ?>
    <td width="90" align="center" valign="top"><img src="<?=$user_icon?>"></td>
<? } ?>
    <td valign="top"><div><img src="<?=$dmshop_mypage_path?>/img/title_level.gif"></div><div class="level"><? if ($shop_user_login) { ?><?=$dmshop_user['user_name']?>님의 회원등급은<br><?=shop_user_level($dmshop_user['user_level']);?> 입니다.<? } else { ?>현재 <?=shop_user_level($dmshop_user['user_level']);?> 입니다.<? } ?></div></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#d5d5d5"></td>
    <td width="554" class="infor_bg">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="110" valign="top" class="pointer" onclick="shopMove('<?=$shop['path']?>/order_list.php');">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_mypage_path?>/img/title_t1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><span class="t1"><?=number_format($dmshop_infor1['cnt']);?></span></td>
    <td width="4"></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/limit.gif"></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#d5d5d5"></td>
    <td width="110" valign="top" class="pointer" onclick="shopMove('<?=$shop['path']?>/cancel.php');">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_mypage_path?>/img/title_t2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><span class="t1"><?=number_format($dmshop_infor2['cnt']);?></span></td>
    <td width="4"></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/limit.gif"></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#d5d5d5"></td>
    <td width="110" valign="top" class="pointer" onclick="shopMove('<?=$shop['path']?>/exchange.php');">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_mypage_path?>/img/title_t3.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><span class="t1"><?=number_format($dmshop_infor3['cnt']);?></span></td>
    <td width="4"></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/limit.gif"></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#d5d5d5"></td>
    <td width="110" valign="top" class="pointer" onclick="shopMove('<?=$shop['path']?>/refund.php');">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_mypage_path?>/img/title_t4.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><span class="t1"><?=number_format($dmshop_infor4['cnt']);?></span></td>
    <td width="4"></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/limit.gif"></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#d5d5d5"></td>
    <td width="110" valign="top" class="pointer" onclick="shopMove('<?=$shop['path']?>/help_list.php');">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><img src="<?=$dmshop_mypage_path?>/img/title_t5.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><span class="t1"><?=number_format($dmshop_infor5['cnt']);?></span></td>
    <td width="4"></td>
    <td><img src="<?=$dmshop_mypage_path?>/img/limit.gif"></td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="2" bgcolor="#f7f7f7" class="none">&nbsp;</td></tr>
</table>

<? if ($shop_user_login) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_title">
<tr height="30">
    <td align="right"><p><?=text($dmshop_user['user_name'])?>님의 사용가능하신 <a href="<?=$shop['https_url']?>/cash.php"><span class="t1">적립금은 <?=number_format($dmshop_user['user_cash']);?>원</span></a>이며, 사용 가능하신 <a href="<?=$shop['https_url']?>/coupon.php"><span class="t2">쿠폰은 <?=number_format($dmshop_infor6['cnt']);?>장</span></a>이 있습니다.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
</table>
<? } ?>