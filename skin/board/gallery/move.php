<?
if (!defined('_DMSHOP_')) exit;
?>
<!--[if IE 6]>
<script type="text/javascript">
/* IE6 PNG 배경투명 */
DD_belatedPNG.fix('.png');
</script>
<![endif]-->

<style type="text/css">
body {background-color:#f4f4f4;}

.top_bg {height:45px; background:url('<?=$dmshop_board_path?>/img/move_top_bg.gif') repeat-x;}

.board_move {background-color:#ffffff;}
.board_move .select {height:18px; border:1px solid #e4e4e4;}
.board_move .select {line-height:18px; font-size:12px; color:#555555; font-family:gulim,굴림;}
.board_move .select option {padding:0px 3px 0px 3px; line-height:18px; font-size:12px; color:#555555; font-family:gulim,굴림;}

.board_move .title {text-align:center; font-weight:bold; line-height:30px; font-size:11px; color:#717171; font-family:dotum,돋움;}
.board_move .text {text-align:center; line-height:30px; font-size:12px; color:#717171; font-family:gulim,굴림;}
</style>

<script type="text/javascript">
function articleMove()
{

    var f = document.formArticle;

    if (f.target_bbs_id.value == '') {

        alert('이동할 게시판을 선택하세요.');
        return false;

    }

    if (confirm("이동하시겠습니까?")) {

        return true;

    } else {

        return false;

    }

}
</script>

<form method="post" name="formArticle" action="board_move_update.php" onsubmit="return articleMove();" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="top_bg">
    <td width="15"></td>
    <td><img src="<?=$dmshop_board_path?>/img/move_title.png" class="png"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_move">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_move">
<tr>
    <td width="15"></td>
    <td>
<!-- 게시물 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_board_path?>/img/move_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_board_path?>/img/move_t1.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_move">
<colgroup>
    <col width="150">
    <col width="1">
    <col width="60">
    <col width="1">
    <col width="">
    <col width="1">
    <col width="100">
</colgroup>
<tr bgcolor="#f7f7f7">
    <td class="title">현재 위치</td>
    <td bgcolor="#e4e4e4"></td>
    <td class="title">번호</td>
    <td bgcolor="#e4e4e4"></td>
    <td class="title">제목</td>
    <td bgcolor="#e4e4e4"></td>
    <td class="title">작성자</td>
</tr>
<tr><td colspan="7" height="1" bgcolor="#e4e4e4"></td></tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<input type="hidden" name="chk_article_id[<?=$i?>]" value="<?=$list[$i]['id']?>" />
<input type="hidden" name="chk_id[]" value="<?=$i?>" />
<? if ($i > '0') { ?>
<tr><td colspan="7" height="1" bgcolor="#e4e4e4"></td></tr>
<? } ?>
<tr>
    <td class="text"><?=$dmshop_board['bbs_title']?></td>
    <td bgcolor="#e4e4e4"></td>
    <td class="text"><?=$list[$i]['id']?></td>
    <td bgcolor="#e4e4e4"></td>
    <td class="text"><?=$list[$i]['ar_title']?></td>
    <td bgcolor="#e4e4e4"></td>
    <td class="text"><?=$list[$i]['ar_name']?></td>
</tr>
<? } ?>
<tr><td colspan="7" height="2" bgcolor="#777777"></td></tr>
</table>
<!-- 게시물 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<!-- 게시판 대상 start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_board_path?>/img/move_arrow.gif"></td>
    <td width="5"></td>
    <td><img src="<?=$dmshop_board_path?>/img/move_t2.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_move">
<tr>
    <td bgcolor="#f7f7f7" width="120" class="title">이동 위치</td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="10"></td>
    <td><select name="target_bbs_id" class="select"><option value="">선택하세요.</option><?=$dmshop_board_option?></select></td>
</tr>
<tr><td colspan="7" height="2" bgcolor="#777777"></td></tr>
</table>
<!-- 게시판 대상 end //-->
    </td>
    <td width="15"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_move">
<tr height="50"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#e0e0e0" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><input type="image" src="<?=$dmshop_board_path?>/img/move_ok.gif" border="0"></td>
    <td width="5"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$dmshop_board_path?>/img/move_close.gif" border="0"></a></td>
</tr>
</table>
</form>