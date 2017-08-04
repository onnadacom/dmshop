<?
if (!defined('_DMSHOP_')) exit;

if ($m == '' || $m == 'a') {

    $dmshop_article['datetime'] = $shop['time_ymdhis'];

}
?>
<style type="text/css">
.board_write .select {height:18px; border:1px solid #e9e9e9;}
.board_write .select {line-height:18px; font-size:12px; color:#333333; font-family:dotum,돋움;}
.board_write .select option {padding:0px 3px 0px 3px; line-height:18px; font-size:12px; color:#333333; font-family:dotum,돋움;}
.board_write .input {height:24px; border:1px solid #d5d5d5; padding:0px 3px 0px 3px;}
.board_write .input {font-weight:bold; line-height:24px; font-size:13px; color:#444444; font-family:gulim,굴림;}
.board_write .checkbox {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:-1px;}
.board_write .textarea {width:99%; height:450px;}
.board_write .file {height:22px;}

.board_write .title {width:90px; text-align:center; font-weight:bold; line-height:36px; font-size:12px; color:#444444; font-family:dotum,돋움;}
.board_write .text {line-height:36px; font-size:12px; color:#444444; font-family:dotum,돋움;}
.board_write .help {line-height:36px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.board_write .upload_source {line-height:36px; font-size:12px; color:#2800bb; font-family:gulim,굴림;}
.board_write .upload_filesize {line-height:36px; font-size:12px; color:#9274ff; font-family:dotum,돋움;}
</style>

<script type="text/javascript">
function smarteditorImageAdd(irid, date, fileame)
{

    var sHTML = "<img src='<?=$shop['smarteditor_data']?>"+"/"+date+"/"+fileame+"' border='0'><p><br></p>";
    oEditors.getById[irid].exec("PASTE_HTML", [sHTML]);

}
</script>

<script type="text/javascript" src="<?=$shop['smarteditor_path']?>/js/HuskyEZCreator.js" charset="utf-8"></script>

<script type="text/javascript">
function articleSave()
{

    oEditors.getById["ar_content"].exec("UPDATE_CONTENTS_FIELD", []);

    var f = document.formArticle;

<? if (!$shop_user_login) { ?>
    if (f.ar_name.value == '') {

        alert('작성자를 입력하세요.');
        f.ar_name.focus();
        return false;

    }

    if (f.ar_password.value == '') {

        alert('비밀번호를 입력하세요.');
        f.ar_password.focus();
        return false;

    }

    if (f.ar_email.value == '') {

        alert('이메일을 입력하세요.');
        f.ar_email.focus();
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

<? if ($dmshop_board['bbs_category_use']) { ?>
    if (f.ar_category.value == '') {

        alert('분류를 선택하세요.');
        f.ar_category.focus();
        return false;

    }
<? } ?>

    if (f.ar_title.value == '') {

        alert('제목을 입력하세요.');
        f.ar_title.focus();
        return false;

    }

    if (f.ar_content.value == '') {

        alert('내용을 입력하세요.');
        f.ar_content.focus();
        return false;

    }

    document.getElementById("article_submit").disabled = true;

    return true;

}
</script>

<form method="post" name="formArticle" action="board_write_update.php" onsubmit="return articleSave();" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<input type="hidden" name="article_id" value="<?=$article_id?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bebebe" class="none">&nbsp;</td></tr>
</table>

<? if ($dmshop_board['bbs_category_use'] || $dmshop_board['bbs_secret'] || $shop_user_admin) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_write">
<tr>
    <td class="title">
<?
if ($dmshop_board['bbs_category_use']) {

    echo "분류선택";

}

else if ($dmshop_board['bbs_secret']) {

    echo "옵 션";

} else {

    echo "옵 션";

}
?>
    </td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<? if ($dmshop_board['bbs_category_use']) { ?>
    <td>
<select id="ar_category" name="ar_category" class="select">
    <option value="">선택하세요.</option>
<?
$row = explode("|", $dmshop_board['bbs_category']);
for ($i=0; $i<count($row); $i++) {

    echo "<option value='".$row[$i]."'>".$row[$i]."</option>";

}
?>
</select>

<script type="text/javascript">
<? if ($dmshop_article['ar_category']) { ?>document.getElementById("ar_category").value = "<?=$dmshop_article['ar_category']?>";<? } ?>
</script>
    </td>
    <td width="20"></td>
<? } ?>
<? if ($dmshop_board['bbs_secret']) { ?>
    <td><input type="checkbox" name="ar_secret" value="1" <? if ($dmshop_article['ar_secret']) { echo "checked"; } ?> class="checkbox" /></td>
    <td width="5"></td>
    <td class="text">비밀글</td>
    <td width="20"></td>
<? } ?>
<? if ($shop_user_admin) { ?>
    <td><input type="checkbox" name="ar_notice" value="1" <? if ($dmshop_article['ar_notice']) { echo "checked"; } ?> class="checkbox" /></td>
    <td width="5"></td>
    <td class="text">공지사항</td>
    <td width="20"></td>
    <td><input type="checkbox" id="article_datetime" name="article_datetime" value="1" class="checkbox" /></td>
    <td width="5"></td>
    <td class="text">작성일 변경</td>
    <td width="20"></td>
    <td><input type="checkbox" id="article_name" name="article_name" value="1" class="checkbox" /></td>
    <td width="5"></td>
    <td class="text">작성자 변경(비회원)</td>
<? } ?>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#efefef"></td>
</table>
<? } ?>

<? if ($shop_user_admin) { ?>
<div id="article_datetime_layer" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_write">
<tr>
    <td class="title">작성일</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="datetime" value="<?=$dmshop_article['datetime']?>" class="input" style="width:150px;" /></td>
    <td width="10"></td>
    <td class="help">(입력 예: 2011-10-10 15:44:12)</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#efefef"></td>
</table>
</div>

<div id="article_name_layer" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_write">
<tr>
    <td class="title">작성자</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="ar_name" value="<?=$dmshop_article['ar_name']?>" class="input" style="width:70px;" /></td>
    <td width="10"></td>
    <td class="help">게시판의 작성자 폼에 보여질 내용. (비회원이 작성 게시물과 동일하게 보여짐)</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#efefef"></td>
<tr>
    <td class="title">&nbsp;</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="ar_email" value="<?=$dmshop_article['ar_email']?>" class="input" style="width:130px;" /></td>
    <td width="10"></td>
    <td class="help">작성자 회신용 이메일 주소 입력 (예:apple@google.com)</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#efefef"></td>
</table>
</div>
<? } ?>

<? if ($shop_user_admin) { ?>
<script type="text/javascript">
$("#article_datetime").click(function () {
  if ($("#article_datetime_layer").is(":hidden")) {
      $("#article_datetime_layer").slideDown(100);
  } else {
      $("#article_datetime_layer").slideUp();
  }
});

$("#article_name").click(function () {
  if ($("#article_name_layer").is(":hidden")) {
      $("#article_name_layer").slideDown(100);
  } else {
      $("#article_name_layer").slideUp();
  }
});
</script>
<? } ?>

<? if (!$shop_user_login) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_write">
<tr>
    <td class="title">작성자</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="ar_name" value="<?=$dmshop_article['ar_name']?>" class="input" style="width:70px;" /></td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#efefef"></td>
<tr>
    <td class="title">비밀번호</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="password" name="ar_password" value="" class="input" style="width:70px;" /></td>
    <td width="10"></td>
    <td class="help">비밀글의 답변확인, 게시물 수정/삭제 시 이용되는 비밀번호</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#efefef"></td>
<tr>
    <td class="title">이메일</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="ar_email" value="<?=$dmshop_article['ar_email']?>" class="input" style="width:130px;" /></td>
    <td width="10"></td>
    <td class="help">작성자 회신용 이메일 주소 입력 (예:apple@google.com)</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#efefef"></td>
<?
/*
<tr>
    <td class="title">스팸방지</td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="60"><img id="zsfImg"></td>
    <td><input type="text" id="robot_key" name="robot_key" value="" class="input" style="width:70px;" /></td>
    <td width="10"></td>
    <td class="help">우측 이미지에 기재된 문자입력. (보이 않을 경우 이미지 클릭)</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#efefef"></td>
*/
?>
</table>

<?
/*
<script type="text/javascript" src="<?=$shop['path']?>/js/zmspamfree.js"></script>
*/
?>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_write">
<tr>
    <td class="title">제 목</td>
    <td><input type="text" name="ar_title" value="<?=$dmshop_article['ar_title']?>" maxlength="100" class="input" style="width:98%;" /></td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#efefef"></td>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_write">
<tr><td height="10"></td>
<tr>
    <td><textarea id="ar_content" name="ar_content" class="textarea"><?=$dmshop_article['ar_content']?></textarea></td>
</tr>
<tr><td height="10"></td>
</table>

<? if ($dmshop_board['bbs_file_limit']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_write">
<?
for ($i=1; $i<=$dmshop_board['bbs_file_limit']; $i++) {
?>
<tr>
    <td class="title">첨부파일 #<?=$i?></td>
    <td>
<?
$upload_mode = "af_".$bbs_id."_".$article_id."_".$i;
$file = shop_article_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$i?>" class="file" size="35" /></td>
<? if ($m == 'u' && $file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_article.php?bbs_id=<?=$bbs_id?>&article_id=<?=$article_id?>&id=<?=$file['id']?>"><span class="upload_source"><?=filter1($file['upload_source']);?> <span class="upload_filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$i?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="text">삭제</td>
<? } ?>
    <td width="10"></td>
    <td class="help"><?=$dmshop_board['bbs_file_size']?> byte</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#efefef"></td>
<? } ?>
</table>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="image" src="<?=$dmshop_board_path?>/img/btn_write.gif" border="0" id="article_submit" /></td>
    <td width="4"></td>
    <td><a href="./board.php?bbs_id=<?=$bbs_id?>"><img src="<?=$dmshop_board_path?>/img/btn_cancel.gif" border="0"></a></td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
</table>

<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
    oAppRef: oEditors,
    elPlaceHolder: "ar_content",
    sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
    fCreator: "createSEditor2"
});
</script>