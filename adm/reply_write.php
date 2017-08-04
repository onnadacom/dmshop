<?php
include_once("./_dmshop.php");

if (!$reply_id) {

    alert_close("상품평이 삭제되었거나 존재하지 않습니다.");

}

$dmshop_reply = shop_reply($reply_id);

if (!$dmshop_reply['id']) {

    alert_close("상품평이 삭제되었거나 존재하지 않습니다.");

}

// 상품
$dmshop_item = shop_item($dmshop_reply['item_id']);

if ($m == '') {

    if ($dmshop_reply['id'] != $dmshop_reply['reply_id']) {

        alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    if ($dmshop_reply['reply_count']) {

        alert_close("이미 답변이 등록되었습니다.");

    }

    if (!$dmshop_reply['reply_view']) {

        sql_query(" update $shop[reply_table] set reply_view = '1' where id = '".$reply_id."' ");

    }

    $dmshop_reply_reply['datetime'] = $shop['time_ymdhis'];
    $dmshop_reply_reply['reply_name'] = $dmshop_user['user_name'];

    $shop['title'] = "상품평 답변 등록";

}

else if ($m == 'u') {

    if ($dmshop_reply['id'] != $dmshop_reply['reply_id']) {

        alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    $shop['title'] = "상품평 수정";

}

else if ($m == 'ru') {

    if ($dmshop_reply['id'] == $dmshop_reply['reply_id']) {

        alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    // 답변
    $dmshop_reply_reply = $dmshop_reply;

    // 원본
    $dmshop_reply = shop_reply($dmshop_reply_reply['reply_id']);

    $shop['title'] = "상품평 답변 수정";

} else {

    alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// user
$user = shop_user($dmshop_reply['user_id']);

// userview
$userview = shop_userview($user['user_id'], $user['user_name'], $user['user_email'], $user['user_homepage'], $dmshop_reply['reply_name']);

include_once("$shop[path]/shop.top.php");

$colspan = "9";
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}
</style>

<script type="text/javascript" src="<?=$shop['path']?>/js/userview.js"></script>

<!--[if IE 6]>
<script type="text/javascript">
/* IE6 PNG 배경투명 */
DD_belatedPNG.fix('.star0');
DD_belatedPNG.fix('.star1');
DD_belatedPNG.fix('.star2');
DD_belatedPNG.fix('.star3');
DD_belatedPNG.fix('.star4');
DD_belatedPNG.fix('.star5');
</script>
<![endif]-->

<script type="text/javascript">
function replySubmit()
{

    var f = document.formReply;

    if (f.reply_title.value == '') {

        alert("제목을 입력하여주세요.");
        f.reply_title.focus();
        return false;

    }

    if (f.reply_content.value == '') {

        alert("내용을 입력하여주세요.");
        f.reply_content.focus();
        return false;

    }

    if (!confirm("등록 하시겠습니까?")) {

        return false;

    }

    f.action = "./reply_write_update.php";
    f.submit();

}
</script>

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
<? if ($m == '' || $m == 'ru') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/reply_title1.gif"></td>
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
    <td bgcolor="#f7f7f7" class="popup_subject">작성 일시</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="datetime1"><?=date("Y-m-d", strtotime($dmshop_reply['datetime']));?></span><span class="datetime2"> <?=date("H시 : i분", strtotime($dmshop_reply['datetime']));?></span></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">작성자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><span class="user_name"><?=$userview?></span><? if ($dmshop_reply['user_id']) { ?><span class="user_id"> (<?=text($dmshop_reply['user_id'])?>)</span><? } ?></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">만족도</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div class="star<?=text($dmshop_reply['reply_score'])?>"></div></td>
    <td width="20"></td>
    <td class="tx2"><?=shop_reply_score($dmshop_reply['reply_score']);?></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td class="tx2"><?=text($dmshop_reply['reply_title']);?></td>
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
    <td class="tx2"><?=text2($dmshop_reply['reply_content'], 0);?></td>
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
    <td class="tx2">
<?
$file = shop_reply_file($dmshop_reply['id']);

if ($file['upload_file']) {

    echo shop_reply_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 500, "");

    echo "<br><br><a href='./download_reply.php?id=".$file['id']."'>".text($file['upload_source'])."</a>";

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
    <td><a href="?m=u&reply_id=<?=$dmshop_reply['id']?>"><img src="<?=$shop['image_path']?>/adm/modify.gif" border="0" /></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0" /></a></td>
</tr>
</table>
<? } ?>
<!-- end //-->

<!-- start //-->
<? if ($m == 'u') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/reply_title3.gif"></td>
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

<form method="post" name="formReply" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="reply_id" value="<?=$dmshop_reply['id']?>" />
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
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="datetime" value="<?=text($dmshop_reply['datetime'])?>" class="input" style="width:110px;" /></td>
    <td width="10"></td>
    <td class="help1">예: 2011-09-26 18:56:38</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">작성자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="reply_name" value="<?=text($dmshop_reply['reply_name'])?>" class="input" style="width:110px;" /></td>
    <td width="10"></td>
    <td class="help1">예: 홍길동</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">만족도</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<select id="reply_score" name="reply_score" class="select">
    <option value="5">★★★★★</option>
    <option value="4">★★★★☆</option>
    <option value="3">★★★☆☆</option>
    <option value="2">★★☆☆☆</option>
    <option value="1">★☆☆☆☆</option>
</select>

<script type="text/javascript">
$("#reply_score").val("<?=$dmshop_reply['reply_score']?>");
</script>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">작성 제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><input type="text" name="reply_title" value="<?=text($dmshop_reply['reply_title']);?>" class="input" style="width:430px;" /></td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">작성 내용</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<textarea name="reply_content" class="textarea1" style="width:425px; height:180px;"><?=text($dmshop_reply['reply_content']);?></textarea>

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

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file" class="file" size="30" /></td>
<?
if ($m == 'u') {

    $file = shop_reply_file($dmshop_reply['id']);

    if ($file['upload_file']) {
?>
    <td width="10"></td>
    <td><a href="./download_reply.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td><span class="filedel">삭제</span></td>
<?
    }

}
?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="7"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><p class="help1">이미지 등의 증빙파일을 첨부하고자 하실 경우 우측 ‘찾아보기’버튼 클릭</p><p class="help1">첨부파일이 많을 경우, 압축후 등록해 주시기 바랍니다.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="2"><td bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>
</form>
<? } ?>
<!-- end //-->

<!-- start //-->
<? if ($m == '' || $m == 'ru') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow4.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$shop['image_path']?>/adm/reply_title2.gif"></td>
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

<form method="post" name="formReply" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="reply_id" value="<?=$dmshop_reply['id']?>" />
<input type="hidden" name="reply_reply_id" value="<?=$dmshop_reply_reply['id']?>" />
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
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="datetime" value="<?=text($dmshop_reply_reply['datetime'])?>" class="input" style="width:110px;" /></td>
    <td width="10"></td>
    <td class="help1">예: 2011-09-26 18:56:38</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변자</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="reply_name" value="<?=text($dmshop_reply_reply['reply_name'])?>" class="input" style="width:110px;" /></td>
    <td width="10"></td>
    <td class="help1">예: 홍길동</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" bgcolor="#bbbbbb"></td>
<tr height="30">
    <td bgcolor="#f7f7f7" class="popup_subject">답변 제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td><input type="text" name="reply_title" value="<?=text($dmshop_reply_reply['reply_title']);?>" class="input" style="width:430px;" /></td>
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

<textarea name="reply_content" class="textarea1" style="width:425px; height:180px;"><?=text($dmshop_reply_reply['reply_content']);?></textarea>

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

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file" class="file" size="30" /></td>
<?
if ($m == 'ru') {

    $file = shop_reply_file($dmshop_reply_reply['id']);

    if ($file['upload_file']) {
?>
    <td width="10"></td>
    <td><a href="./download_reply.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td><span class="filedel">삭제</span></td>
<?
    }

}
?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="7"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><p class="help1">이미지 등의 증빙파일을 첨부하고자 하실 경우 우측 ‘찾아보기’버튼 클릭</p><p class="help1">첨부파일이 많을 경우, 압축후 등록해 주시기 바랍니다.</p></td>
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
</form>
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
    <td><a href="#" onclick="replySubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
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