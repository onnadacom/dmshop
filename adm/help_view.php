<?php
include_once("./_dmshop.php");
if ($help_id) { $help_id = preg_match("/^[0-9]+$/", $help_id) ? $help_id : ""; }

if (!$help_id) {

    alert_close("문의가 삭제되었거나 존재하지 않습니다.");

}

$dmshop_help = shop_help($help_id);

if (!$dmshop_help['id']) {

    alert_close("문의가 삭제되었거나 존재하지 않습니다.");

}

if ($dmshop_help['id'] != $dmshop_help['help_id']) {

    alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 답변
$dmshop_help_reply = shop_help_reply($dmshop_help['id']);

if (!$dmshop_help_reply['id']) {

    alert_close("답변이 있을 때만 열람이 가능합니다.");

}

// user
$user = shop_user($dmshop_help['user_id']);

// userview
$userview = shop_userview($user['user_id'], $user['user_name'], $user['user_email'], $user['user_homepage'], $user['user_name']);

$shop['title'] = "1:1문의 열람";
include_once("$shop[path]/shop.top.php");

$colspan = "9";
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}

.send_ok {font-weight:bold; line-height:14px; font-size:12px; color:#027d94; font-family:gulim,굴림;}
.send_no {font-weight:bold; line-height:14px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.send_msg {line-height:14px; font-size:11px; color:#717171; font-family:dotum,돋움;}
</style>

<script type="text/javascript" src="<?=$shop['path']?>/js/userview.js"></script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="detail_bg">
    <td width="15"></td>
    <td width="6"><img src="<?=$shop['image_path']?>/adm/arrow.gif"></td>
    <td width="5"></td>
    <td><span class="popup_title1"><?=text($shop['title'])?></span></td>
    <td width="45"><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/close2.gif" border="0"></a></td>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr>
    <td width="20"></td>
    <td>
<!-- start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="30"></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/help_title1.gif"></td>
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
    <td bgcolor="#f7f7f7" class="popup_subject">문의 일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="datetime1"><?=date("Y-m-d", strtotime($dmshop_help['datetime']));?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($dmshop_help['datetime']));?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">문의자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="user_name"><?=$userview?></span><span class="user_id"> (<?=text($dmshop_help['user_id'])?>)</span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">문의유형/대상</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="help_category">[<?=shop_help_category($dmshop_help['help_category']);?>]</td>
<? if ($dmshop_help['help_type'] == '1' && $dmshop_help['help_code']) { ?>
    <td width="5"></td>
    <td><a href="#" onclick="orderManage('', '<?=text($dmshop_help['help_code'])?>'); return false;" class="help_code">주문번호 - <?=text($dmshop_help['help_code'])?></a></td>
<? } ?>
<? if ($dmshop_help['help_type'] == '2' && $dmshop_help['help_code']) { ?>
    <td width="5"></td>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=text($dmshop_help['help_code'])?>" target="_blank" class="help_code">상품번호 - <?=text($dmshop_help['help_code'])?></a></td>
<? } ?>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">문의 제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_help['subject']);?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">문의 내용</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=text2($dmshop_help['content'], 0);?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<?
$file = shop_help_file($dmshop_help['id']);
if ($file['upload_file']) {
?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">첨부파일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<?
$shop_help_view = shop_help_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 500, "");

if ($shop_help_view) {

    echo $shop_help_view."<br><br>";

}

echo "<a href='".$shop['path']."/download_help.php?upload_mode=".$file['upload_mode']."' class='source'>".text($file['upload_source'])."</a>";
?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<? } ?>
<tr><td colspan="4" height="2" bgcolor="#777777"></td>
</table>
<!-- end //-->

<!-- start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/help_title2.gif"></td>
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
    <td bgcolor="#f7f7f7" class="popup_subject">답변 일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="datetime1"><?=date("Y-m-d", strtotime($dmshop_help_reply['datetime']));?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($dmshop_help_reply['datetime']));?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="user_name"><?=text($dmshop_help_reply['user_name'])?></span><span class="user_id"> (<?=text($dmshop_help_reply['user_id'])?>)</span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변 제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_help_reply['subject']);?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변 내용</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=text2($dmshop_help_reply['content'], 0);?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<?
$file = shop_help_file($dmshop_help_reply['id']);
if ($file['upload_file']) {
?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">첨부파일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<?
$shop_help_view = shop_help_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 500, "");

if ($shop_help_view) {

    echo $shop_help_view."<br><br>";

}

echo "<a href='".$shop['path']."/download_help.php?upload_mode=".$file['upload_mode']."' class='source'>".text($file['upload_source'])."</a>";
?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<? } ?>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변내용 메일</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($dmshop_help_reply['help_send_email']) { ?>
    <td class="send_ok">발송완료</td>
<? } else { ?>
    <td class="send_no">발송안함</td>
<? } ?>
    <td width="20"></td>
    <td class="send_msg">답변내용 발송 메일 : <font color="#7da7d9"><?=text($dmshop_help['user_email'])?></font></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변안내 문자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($dmshop_help_reply['help_send_sms']) { ?>
    <td class="send_ok">발송완료</td>
<? } else { ?>
    <td class="send_no">발송안함</td>
<? } ?>
    <td width="20"></td>
    <td class="send_msg">답변안내 문자 발송 번호 : <font color="#7da7d9"><?=text($dmshop_help['user_hp'])?></font></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>
<!-- end //-->
    </td>
    <td width="20"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="./help_write.php?m=ru&help_id=<?=$dmshop_help_reply['id']?>"><img src="<?=$shop['image_path']?>/adm/modify.gif" border="0" /></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0" /></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="50"><td></td></tr>
</table>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>