<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.board_reply .input {height:21px; border:1px solid #dadada; padding:0px 3px 0px 3px;}
.board_reply .input {line-height:21px; font-size:12px; color:#787878; font-family:gulim,굴림;}
.board_reply .textarea {border:1px solid #dadada; padding:5px; width:99%; height:50px;}
.board_reply .textarea {line-height:18px; font-size:12px; color:#444444; font-family:gulim,굴림;}

.board_reply .reply_bg {background-color:#fdfdfd;}
.board_reply .reply_count {text-decoration:underline; font-weight:bold; line-height:30px; font-size:12px; color:#37719e; font-family:gulim,굴림;}
.board_reply .reply_sort {line-height:30px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_reply .ic_arrow {position:relative; overflow:hidden; left:0; top:-2px; margin-left:4px;}
.board_reply .reply_name {font-weight:bold; line-height:24px; font-size:12px; color:#787878; font-family:gulim,굴림;}
.board_reply .reply_guest {line-height:24px; font-size:12px; color:#787878; font-family:gulim,굴림;}
.board_reply .reply_date {line-height:24px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_reply .reply_time {margin-left:4px; line-height:24px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.board_reply .reply_line {height:1px; background:url('<?=$dmshop_board_path?>/img/ic_reply_line.gif') repeat-x;}
.board_reply .reply_title {line-height:23px; font-size:12px; color:#787878; font-family:gulim,굴림;}
.board_reply .reply_content {line-height:18px; font-size:12px; color:#444444; font-family:gulim,굴림;}
.board_reply .ic_reply {position:relative; overflow:hidden; left:0; top:-1px;}
.board_reply .ic_reply_write {position:relative; overflow:hidden; left:0; top:-1px;}
.board_reply .ic_reply_edit {position:relative; overflow:hidden; left:0; top:-2px;}
</style>

<table border="0" cellspacing="0" cellpadding="0" class="board_reply">
<tr>
    <td width="10"></td>
    <td class="reply_count">댓글 <?=number_format($dmshop_article['ar_reply']);?></td>
    <td width="10"></td>
    <td class="reply_sort">작성일시 최신순<img src="<?=$dmshop_board_path?>/img/ic_arrow.gif" class="ic_arrow"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#dadada" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="8"></td></tr>
</table>

<? for ($i=0; $i<count($list); $i++) { ?>
<a name="reply<?=$list[$i]['id']?>"></a>
<? if ($i > '0') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="8"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_reply">
<tr><td width="20"></td><td class="reply_line none">&nbsp;</td><td width="20"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="8"></td></tr>
</table>
<? } ?>

<div id="reply_view_<?=$list[$i]['id']?>" style="display:inline;" class="board_reply">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="reply_bg">
    <td width="20"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_board_path?>/img/ic_reply.gif" class="ic_reply"></td>
    <td width="7"></td>
    <td class="<? if ($list[$i]['user_id']) { echo "reply_name"; } else { echo "reply_guest"; } ?>"><?=$list[$i]['name']?></td>
    <td width="10"></td>
    <td><span class="reply_date"><?=date("m-d", strtotime($list[$i]['datetime']));?></span><span class="reply_time"><?=date("H:i", strtotime($list[$i]['datetime']));?></span></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="21"></td>
    <td class="reply_content"><?=$list[$i]['content']?></td>
</tr>
</table>
    </td>
<? if ($list[$i]['btn_edit'] || $list[$i]['btn_delete']) { ?>
    <td width="89">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($list[$i]['btn_edit']) { ?>
    <td><a href="#" onclick="replyEdit('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_board_path?>/img/btn_edit.gif" border="0"></a></td>
<? } ?>
    <td width="3"></td>
<? if ($list[$i]['btn_delete']) { ?>
    <td><a href="#" onclick="replyDelete('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_board_path?>/img/btn_delete.gif" border="0"></a></td>
<? } ?>
</tr>
</table>
    </td>
<? } ?>
    <td width="20"></td>
</tr>
</table>
</div>

<div id="reply_edit_<?=$list[$i]['id']?>" style="display:none;" class="board_reply">
<table border="0" cellspacing="0" cellpadding="0" >
<tr>
    <td width="20"></td>
    <td><img src="<?=$dmshop_board_path?>/img/ic_reply_edit.gif" class="ic_reply_edit"></td>
    <td width="7"></td>
    <td class="reply_title">작성자 :</td>
    <td width="5"></td>
    <td><input type="text" id="reply_name_<?=$list[$i]['id']?>" name="reply_name_<?=$list[$i]['id']?>" value="<?=text($list[$i]['reply_name']);?>" class="input" style="width:70px;<? if ($list[$i]['user_id'] && !$shop_user_admin) { echo " background-color:#ededed;"; } ?>" <? if ($list[$i]['user_id'] && !$shop_user_admin) { echo "readonly"; } ?> /></td>
<? if (!$list[$i]['user_id']) { ?>
    <td width="20"></td>
    <td class="reply_title">비밀번호 :</td>
    <td width="5"></td>
    <td><input type="password" id="reply_password_<?=$list[$i]['id']?>" name="reply_password_<?=$list[$i]['id']?>" value="" class="input" style="width:70px;" /></td>
<? } ?>
<? if ($shop_user_admin) { ?>
    <td width="20"></td>
    <td class="reply_title">작성일 :</td>
    <td width="5"></td>
    <td><input type="text" id="reply_datetime_<?=$list[$i]['id']?>" name="reply_datetime_<?=$list[$i]['id']?>" value="<?=$list[$i]['datetime']?>" class="input" style="width:115px;" /></td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="5"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
    <td width="20"></td>
    <td><textarea id="reply_content_<?=$list[$i]['id']?>" name="reply_content_<?=$list[$i]['id']?>" class="textarea"><?=text2($list[$i]['reply_content'], 1);?></textarea></td>
    <td width="20"></td>
    <td width="89">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="replyEditSave('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_board_path?>/img/btn_ok.gif" border="0"></a></td>
    <td width="3"></td>
    <td><a href="#" onclick="replyCancel('<?=$list[$i]['id']?>'); return false;"><img src="<?=$dmshop_board_path?>/img/btn_cancel.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td width="20"></td>
</tr>
</table>
</div>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e2e2e2" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1"></td></tr>
</table>

<div class="board_reply" style="padding:10px 20px; background-color:#f8f8f8;">
<form method="post" name="formReply" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<input type="hidden" name="article_id" value="<?=$article_id?>" />
<input type="hidden" name="reply_id" value="" />
<input type="hidden" name="page" value="<?=$page?>" />
<? if ($shop_user_login) { ?>
<input type="hidden" name="reply_password" value="" />
<? } ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="3"></td>
    <td><img src="<?=$dmshop_board_path?>/img/ic_reply_write.gif" class="ic_reply_write"></td>
    <td width="7"></td>
    <td class="reply_title">작성자 :</td>
    <td width="5"></td>
    <td><input type="text" name="reply_name" value="<?=$dmshop_user['write_name']?>" class="input" style="width:70px;<? if ($shop_user_login && !$shop_user_admin) { echo " font-weight:bold; background-color:#ededed;"; } ?>" <? if ($shop_user_login && !$shop_user_admin) { echo "readonly"; } ?> /></td>
<? if ($shop_user_admin) { ?>
    <td>
<div id="reply_datetime_layer" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="reply_title">작성일 :</td>
    <td width="5"></td>
    <td><input type="text" id="datetime" name="datetime" value="<?=$shop['time_ymdhis']?>" class="input" style="width:115px;" /></td>
</tr>
</table>
</div>
    </td>
    <td width="20"></td>
    <td><input type="checkbox" id="reply_datetime" name="reply_datetime" value="1" class="checkbox" /></td>
    <td width="5"></td>
    <td class="reply_title">작성일 변경</td>
    <td width="20"></td>
<? } ?>
<? if (!$shop_user_login) { ?>
    <td width="20"></td>
    <td class="reply_title">비밀번호 :</td>
    <td width="5"></td>
    <td><input type="password" name="reply_password" value="" class="input" style="width:70px;" /></td>
<? /*
    <td width="20"></td>
    <td class="reply_title">스팸방지 :</td>
    <td width="5"></td>
    <td><img id="zsfImg"></td>
    <td width="5"></td>
    <td><input type="text" id="robot_key" name="robot_key" value="" class="input" style="width:70px;" /></td>
*/ ?>
<? } ?>
</tr>
</table>

<? if ($shop_user_admin) { ?>
<script type="text/javascript">
$("#reply_datetime").click(function () {
  if ($("#reply_datetime_layer").is(":hidden")) {
      $("#reply_datetime_layer").show();
  } else {
      $("#reply_datetime_layer").hide();
  }
});
</script>
<? } ?>

<? /*if (!$shop_user_login) { ?>
<script type="text/javascript" src="<?=$shop['path']?>/js/zmspamfree.js"></script>
<? }*/ ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="5"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
    <td><textarea name="reply_content" class="textarea"><? if (!$dmshop_board['btn_reply_write']) { echo "로그인 후 이용하세요."; } ?></textarea></td>
    <td width="20"></td>
    <td width="89"><a href="#" onclick="replySave(); return false;"><img src="<?=$dmshop_board_path?>/img/btn_reply_submit.gif" border="0"></a></td>
</tr>
</table>
</form>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#eaeaea" class="none">&nbsp;</td></tr>
</table>

<script type="text/javascript">
function replySave()
{

<? if (!$dmshop_board['btn_reply_write']) { ?>
    alert('로그인 후 이용하세요.');
    return false;
<? } ?>

    var f = document.formReply;

    f.m.value = "";
    f.reply_id.value = "";

<? if (!$shop_user_login) { ?>
    if (f.reply_name.value == '') {

        alert('작성자를 입력하세요.');
        f.reply_name.focus();
        return false;

    }

    if (f.reply_password.value == '') {

        alert('비밀번호를 입력하세요.');
        f.reply_password.focus();
        return false;

    }

/*
    if (f.robot_key.value == '') {

        alert('스팸방지를 입력하세요.');
        f.robot_key.focus();
        return false;

    }

   if (typeof(f.robot_key) != 'undefined') {

        if (!checkFrm()) {

            alert ("스팸방지 코드가 틀렸습니다. 다시 입력하세요.");
            return false;

        }

    }
*/
<? } ?>

    if (f.reply_content.value == '') {

        alert('내용을 입력하세요.');
        f.reply_content.focus();
        return false;

    }

    f.action = "./board_reply_update.php";
    f.submit();

}

function replyEdit(id)
{

    var f = document.formReply;

    if (f.reply_id.value && f.reply_id.value != id) {

        document.getElementById("reply_view_"+f.reply_id.value).style.display = "inline";
        document.getElementById("reply_edit_"+f.reply_id.value).style.display = "none";

    }

    document.getElementById("reply_view_"+id).style.display = "none";
    document.getElementById("reply_edit_"+id).style.display = "inline";

    f.reply_id.value = id;

}

function replyEditSave(id)
{

    var f = document.formReply;

    f.m.value = "u";
    f.reply_id.value = id;

    if (document.getElementById("reply_name_"+id)) {

        if (document.getElementById("reply_name_"+id).value == '') {

            alert('작성자를 입력하세요.');
            document.getElementById("reply_name_"+id).focus();
            return false;

        }

    }

<? if (!$shop_user_admin) { ?>
    if (document.getElementById("reply_password_"+id)) {

        if (document.getElementById("reply_password_"+id).value == '') {

            alert('비밀번호를 입력하세요.');
            document.getElementById("reply_password_"+id).focus();
            return false;

        }

    }
<? } ?>

    if (document.getElementById("reply_content_"+id)) {

        if (document.getElementById("reply_content_"+id).value == '') {

            alert('내용을 입력하세요.');
            document.getElementById("reply_content_"+id).focus();
            return false;

        }

    }

    if (document.getElementById("reply_name_"+id)) {

        f.reply_name.value = document.getElementById("reply_name_"+id).value;

    }

    if (document.getElementById("reply_password_"+id)) {

        f.reply_password.value = document.getElementById("reply_password_"+id).value;

    }

<? if ($shop_user_admin) { ?>
    if (document.getElementById("reply_datetime_"+id)) {

        f.datetime.value = document.getElementById("reply_datetime_"+id).value;

    }
<? } ?>

    if (document.getElementById("reply_content_"+id)) {

        f.reply_content.value = document.getElementById("reply_content_"+id).value;

    }

    f.action = "./board_reply_update.php";
    f.submit();

}

function replyCancel(id)
{

    var f = document.formReply;

    document.getElementById("reply_edit_"+id).style.display = "none";
    document.getElementById("reply_view_"+id).style.display = "inline";

    f.m.value = "";
    f.reply_id.value = "";

}

function replyDelete(id)
{

    var f = document.formReply;

    f.m.value = "d";
    f.reply_id.value = id;

    if (confirm("해당 댓글을 삭제하시겠습니까?")) {

        f.action = "./board_reply_update.php";
        f.submit();

    } else {

        return false;

    }

}
</script>