<?
if (!defined('_DMSHOP_')) exit;

// 신규
if ($m == '') {

    // 매우만족 기본
    $dmshop_reply['reply_score'] = "5";

    $dmshop_reply['reply_name'] = $dmshop_user['user_name'];
    $dmshop_reply['datetime'] = $shop['time_ymdhis'];

}
?>
<style type="text/css">
body {background-color:#f4f4f4;}

.title {font-weight:bold; line-height:15px; font-size:13px; color:#ffffff; font-family:gulim,굴림;}
.title2 {font-weight:bold; line-height:15px; font-size:13px; color:#027d94; font-family:gulim,굴림;}
.step_title {font-weight:bold; line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.item_title {font-weight:bold; line-height:14px; font-size:12px; color:#414141; font-family:dotum,돋움;}
.name {line-height:14px; font-size:12px; color:#414141; font-family:dotum,돋움;}
.date {line-height:14px; font-size:12px; color:#414141; font-family:dotum,돋움;}
.help {line-height:14px; font-size:11px; color:#b7b7b7; font-family:dotum,돋움;}
.message {line-height:14px; font-size:11px; color:#414141; font-family:dotum,돋움;}
.write_title {font-weight:bold; line-height:14px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.source {font-size:12px; color:#2800bb; font-family:gulim,굴림;}
.filesize {font-size:12px; color:#9274ff; font-family:gulim,굴림;}
.filedel {font-size:12px; color:#9e0000; font-family:gulim,굴림;}

.input {width:112px; height:17px; border:1px solid #cccccc; padding:1px 3px 0px 3px;}
.input {line-height:17px; font-size:12px; color:#363636; font-family:gulim,굴림;}

.file {height:18px;}

.textarea {padding:5px; width:440px; height:170px; border:1px solid #c2c2c2;}
.textarea {line-height:15px; font-size:12px; color:#333333; font-family:dotum,돋움;}

.star0 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat;}
.star1 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat 0px -18px;}
.star2 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat 0px -36px;}
.star3 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat 0px -54px;}
.star4 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat 0px -72px;}
.star5 {width:85px; height:18px; background:transparent url('<?=$dmshop_item_path?>/img/reply_star.png') no-repeat 0px -90px;}
</style>

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
function replySave()
{

    var f = document.formReply;

<? if (!$shop_user_login) { ?>
    if (f.reply_name.value == '') {

        alert('작성자를 입력하십시오.');
        f.reply_name.focus();
        return false;

    }

    if (f.reply_password.value == '') {

        alert('비밀번호를 입력하십시오.');
        f.reply_password.focus();
        return false;

    }
<? } ?>

    if (f.reply_title.value == '') {

        alert('제목을 입력하십시오.');
        f.reply_title.focus();
        return false;

    }

    if (f.reply_content.value == '') {

        alert('내용을 입력하십시오.');
        f.reply_content.focus();
        return false;

    }

    if (!confirm("등록하시겠습니까?")) {

        return false;

    }

    f.action = "<?=$shop['path']?>/reply_write_update.php";
    f.submit();

}
</script>

<form method="post" name="formReply" enctype="multipart/form-data">
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="item_id" value="<?=$item_id?>" />
<input type="hidden" name="reply_id" value="<?=$reply_id?>" />
<input type="hidden" name="page_id" value="<?=$page_id?>" />
<input type="hidden" name="page" value="<?=$page?>" />
<? if ($shop_user_admin) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40" bgcolor="#e2fdff">
    <td align="center" class="title2"><?=$dmshop_reply_msg?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#b4d9e0" class="none">&nbsp;</td></tr>
</table>
<? } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40" bgcolor="#000000">
    <td align="center" class="title"><?=$dmshop_reply_msg?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#393939" class="none">&nbsp;</td></tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr height="15"><td></td></tr>
</table>

<div style="padding:10px 10px 10px 10px; background-color:#ffffff;">
<div style="border:1px solid #e0e0e0;">
<div style="padding:15px 17px 15px 17px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="84" valign="top"><div style="text-align:center; background-color:#fafafa; border:1px solid #e0e0e0;"><a href="<?=$shop['path']?>/item.php?id=<?=$dmshop_item['item_code']?>" target="_blank"><img src="<? $thumb = shop_item_thumb($item_id, "default", "", "82", "82", "2"); if ($thumb) { echo $thumb; } else { echo $dmshop_item_path."/img/noimage.gif"; } ?>" border="0"></a></div></td>
    <td width="28"></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="120" bgcolor="#f5f5f5" align="center"><span class="step_title">상품명</span></td>
    <td width="20"></td>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=$dmshop_item['item_code']?>" target="_blank" class="item_title"><?=$dmshop_item['item_title']?></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="120" bgcolor="#f5f5f5" align="center"><span class="step_title">작성일</span></td>
    <td width="20"></td>
<? if ($shop_user_admin) { ?>
    <td><input type="text" name="datetime" class="input" value="<?=$dmshop_reply['datetime']?>" /></td>
    <td width="5"></td>
    <td><span class="help">예: <?=$shop['time_ymdhis']?></span></td>
<? } else { ?>
    <td><span class="date"><?=$shop['time_ymd']?></span></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="120" bgcolor="#f5f5f5" align="center"><span class="step_title">작성자</span></td>
    <td width="20"></td>
<? if ($shop_user_login && !$shop_user_admin) { ?>
    <td><span class="name"><?=$dmshop_user['user_id']?></span></td>
<? } else { ?>
    <td><? if ($shop_user_admin) { ?><input type="hidden" name="user_id" class="input" value="<?=$dmshop_user['user_id']?>" /><? } ?><input type="text" name="reply_name" class="input" value="<?=$dmshop_reply['reply_name']?>" /></td>
    <td width="5"></td>
    <td><span class="help">예: 홍길동</span></td>
<? } ?>
</tr>
</table>

<? if (!$shop_user_login) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="120" bgcolor="#f5f5f5" align="center"><span class="step_title">비밀번호</span></td>
    <td width="20"></td>
    <td><input type="password" name="reply_password" class="input" value="" /></td>
    <td width="5"></td>
    <td><span class="help">상품평의 수정/삭제시 사용</span></td>
</tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>
    </td>
</tr>
</table>
</div>
</div>

<?
// 답변이거나 답변수정은 안뜨게 해야된다. 조건 신규등록, 수정 (원본만)
if ($m == '' && !$_GET['reply_id'] || $m == 'u' && $dmshop_reply['id'] == $dmshop_reply['reply_id']) {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5">
    <td></td>
</tr>
</table>

<div style="border:1px solid #e0e0e0;">
<div style="padding:1px;">
<div style="background-color:#ffffe5; padding:10px 15px;">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td width="85">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><div class="star5"></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="radio" name="reply_score" value="5" class="radio" <? if ($dmshop_reply['reply_score'] == '5') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td><span class="message">매우만족</span></td>
</tr>
</table>
    </td>
    <td width="28"></td>
    <td width="85">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><div class="star4"></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="radio" name="reply_score" value="4" class="radio" <? if ($dmshop_reply['reply_score'] == '4') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td><span class="message">만족</span></td>
</tr>
</table>
    </td>
    <td width="28"></td>
    <td width="85">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><div class="star3"></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3">
    <td></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="radio" name="reply_score" value="3" class="radio" <? if ($dmshop_reply['reply_score'] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td><span class="message">보통</span></td>
</tr>
</table>
    </td>
    <td width="28"></td>
    <td width="85">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><div class="star2"></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3">
    <td></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="radio" name="reply_score" value="2" class="radio" <? if ($dmshop_reply['reply_score'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td><span class="message">불만족</span></td>
</tr>
</table>
    </td>
    <td width="28"></td>
    <td width="85">
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><div class="star1"></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="radio" name="reply_score" value="1" class="radio" <? if ($dmshop_reply['reply_score'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td><span class="message">매우불만족</span></td>
</tr>
</table>
    </td>
</tr>
</table>
</div>
</div>
</div>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="120" bgcolor="#f5f5f5" align="center"><span class="write_title">제&nbsp;&nbsp;&nbsp;&nbsp;목</span></td>
    <td width="10"></td>
    <td><input type="text" name="reply_title" class="input" value="<?=$dmshop_reply['reply_title']?>" style="width:360px;" /></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="120" bgcolor="#f5f5f5" align="center"><span class="write_title">내&nbsp;&nbsp;&nbsp;&nbsp;용</span></td>
    <td width="10"></td>
    <td><div style="padding:10px 0 10px 0;"><textarea name="reply_content" class="textarea"><?=$dmshop_reply['reply_content']?></textarea></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="5"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td width="120" bgcolor="#f5f5f5" align="center"><span class="write_title">파일첨부</span></td>
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file" class="file" size="30" /></td>
<?
if ($reply_id) {

    $file = shop_reply_file($reply_id);

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
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
</table>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr height="15"><td></td></tr>
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
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="replySave(); return false;"><img src="<?=$dmshop_item_path?>/img/reply_ok.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$dmshop_item_path?>/img/reply_close.gif" border="0"></a></td>
</tr>
</table>
</form>

<script type="text/javascript" src="<?=$shop['path']?>/js/zmspamfree.js"></script>