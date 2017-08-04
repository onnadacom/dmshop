<?php
include_once("./_dmshop.php");
if ($qna_id) { $qna_id = preg_match("/^[0-9]+$/", $qna_id) ? $qna_id : ""; }

if (!$qna_id) {

    alert_close("상품문의가 삭제되었거나 존재하지 않습니다.");

}

$dmshop_qna = shop_qna($qna_id);

if (!$dmshop_qna['id']) {

    alert_close("상품문의가 삭제되었거나 존재하지 않습니다.");

}

if ($dmshop_qna['id'] != $dmshop_qna['qna_id']) {

    alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 답변
$dmshop_qna_reply = shop_qna_reply($dmshop_qna['id']);

if (!$dmshop_qna_reply['id']) {

    alert_close("답변이 있을 때만 열람이 가능합니다.");

}

// 상품
$dmshop_item = shop_item($dmshop_qna['item_id']);

// user
$user = shop_user($dmshop_qna['user_id']);

// userview
$userview = shop_userview($user['user_id'], $user['user_name'], $user['user_email'], $user['user_homepage'], $dmshop_qna['qna_name']);

$shop['title'] = "상품문의 열람";
include_once("$shop[path]/shop.top.php");

$colspan = "9";
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="20"></td></tr>
</table>

<div style="border:1px solid #dddddd;">
<div style="border:1px solid #ffffff; background-color:#f9f9f9;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="30">
    <td><a href="<?=$shop['path']?>/item.php?id=<?=$dmshop_item['item_code']?>" target="_blank"><span class="item_code">[<?=$dmshop_item['item_code']?>]</span> <span class="item_title2"><?=text($dmshop_item['item_title'])?></span></a></td>
</tr>
</table>
</div>
</div>

<!-- start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/qna_title1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" bgcolor="#ffffff"</td></tr>
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
    <td bgcolor="#f7f7f7" class="popup_subject">작성 일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="datetime1"><?=date("Y-m-d", strtotime($dmshop_qna['datetime']));?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($dmshop_qna['datetime']));?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">작성자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="user_name"><?=$userview?></span><? if ($dmshop_qna['user_id']) { ?><span class="user_id"> (<?=text($dmshop_qna['user_id'])?>)</span><? } ?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">문의유형</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="qna_category"><?=text($dmshop_qna['qna_category'])?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_qna['qna_title']);?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">내용</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=text2($dmshop_qna['qna_content'], 0);?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
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
$file = shop_qna_file($dmshop_qna['id']);

if ($file['upload_file']) {

    echo shop_qna_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 500, "");

    echo "<br><br><a href='./download_qna.php?id=".$file['id']."' class='source'>".text($file['upload_source'])."</a>";

}
?>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="2" bgcolor="#777777"></td>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:10px auto 0 auto;">
<tr>
    <td><a href="qna_write.php?m=u&qna_id=<?=$dmshop_qna['id']?>"><img src="<?=$shop['image_path']?>/adm/modify.gif" border="0" /></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0" /></a></td>
</tr>
</table>
<!-- end //-->

<!-- start //-->
<? if ($dmshop_qna_reply['id']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/qna_title4.gif"></td>
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
    <td><span class="datetime1"><?=date("Y-m-d", strtotime($dmshop_qna_reply['datetime']));?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($dmshop_qna_reply['datetime']));?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="user_name"><?=text($dmshop_qna_reply['qna_name'])?></span><? if ($dmshop_qna_reply['user_id']) { ?><span class="user_id"> (<?=text($dmshop_qna_reply['user_id'])?>)</span><? } ?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변 제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_qna_reply['qna_title']);?></span></td>
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
    <td class="tx2"><?=text2($dmshop_qna_reply['qna_content'], 0);?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
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
$file = shop_qna_file($dmshop_qna_reply['id']);

if ($file['upload_file']) {

    echo shop_qna_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 500, "");

    echo "<br><br><a href='./download_qna.php?id=".$file['id']."' class='source'>".text($file['upload_source'])."</a>";

}
?>
    </td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>
<? } ?>
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
    <td><a href="./qna_write.php?m=ru&qna_id=<?=$dmshop_qna_reply['id']?>"><img src="<?=$shop['image_path']?>/adm/modify.gif" border="0" /></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0" /></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
</table>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>