<?
if (!defined('_DMSHOP_')) exit;
?>
<style type="text/css">
.board_view .btn_text {line-height:16px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_view .btn_line {width:16px; text-align:center; line-height:16px; font-size:10px; color:#efefef; font-family:dotum,돋움;}
.board_view .ic_prev {position:relative; overflow:hidden; left:0; top:-2px; margin-right:4px;}
.board_view .ic_next {position:relative; overflow:hidden; left:0; top:-2px; margin-right:4px;}
.board_view .category_line {width:17px; text-align:center; line-height:35px; font-size:11px; color:#bebebe; font-family:dotum,돋움;}
.board_view .ar_category {line-height:35px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;}
.board_view .ar_title p {margin:9px 0 7px 0; font-weight:bold; line-height:18px; font-size:13px; color:#444444; font-family:gulim,굴림;}
.board_view .ar_title .ic_answer {position:relative; overflow:hidden; left:0; top:2px; margin:0 10px 0 0px;}
.board_view .ar_title .ic_new_time {margin-left:5px;}
.board_view .ar_title .ic_hit_time {margin-left:5px;}
.board_view .ar_title .ic_secret {position:relative; overflow:hidden; left:0; top:2px; margin-left:5px;}
.board_view .name_title {line-height:30px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.board_view .name_line {width:16px; text-align:center; line-height:30px; font-size:10px; color:#efefef; font-family:dotum,돋움;}
.board_view .ar_name {line-height:30px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_view .ar_date {line-height:30px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_view .ar_hit {line-height:30px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_view .ic_file {position:relative; overflow:hidden; left:0; top:3px; margin-right:5px;}
.board_view .upload_source {line-height:30px; font-size:12px; color:#2800bb; font-family:gulim,굴림;}
.board_view .upload_filesize {line-height:30px; font-size:12px; color:#9274ff; font-family:dotum,돋움;}

#article_content {padding:15px 10px 50px 10px;}
#article_content {line-height:160%; font-size:12px; color:#000000; font-family:dotum,돋움;}
#article_content p {margin-top:0px; margin-bottom:0px;}
</style>

<script type="text/javascript">
function articleDelete()
{

    var f = document.formView;

    f.m.value = "d";

    if (confirm("게시물을 삭제하시겠습니까?")) {

        f.action = "./board_write_update.php";
        f.submit();

    } else {

        return false;

    }

}
</script>

<? if ($shop_user_admin) { ?>
<script type="text/javascript">
function articleMove()
{

    shopOpen("./board_move.php?bbs_id=<?=$bbs_id?>&article_id=<?=$article_id?>","board_move","width=650, height=650, scrollbars=1");

}
</script>
<? } ?>

<form method="post" name="formView" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<input type="hidden" name="article_id" value="<?=$article_id?>" />
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<? ob_start(); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_view">
<tr>
    <td width="150" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="8"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$dmshop_article['href']?>" class="btn_text">목록</a></td>
    <td class="btn_line">|</td>
    <td></td>
<? if ($dmshop_article['href_prev']) { ?>
    <td><img src="<?=$dmshop_board_path?>/img/ic_prev.gif" border="0" class="ic_prev"><a href="<?=$dmshop_article['href_prev']?>" class="btn_text">이전글</a></td>
<? } ?>
<? if ($dmshop_article['href_prev'] && $dmshop_article['href_next']) { ?>
    <td class="btn_line">|</td>
<? } ?>
<? if ($dmshop_article['href_next']) { ?>
    <td><img src="<?=$dmshop_board_path?>/img/ic_next.gif" border="0" class="ic_next"><a href="<?=$dmshop_article['href_next']?>" class="btn_text">다음글</a></td>
<? } ?>
</tr>
</table>
    </td>
    <td valign="top" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$dmshop_article['href']?>"><img src="<?=$dmshop_board_path?>/img/btn_list.gif" border="0"></a></td>
<? if ($dmshop_board['btn_edit']) { ?>
    <td width="3"></td>
    <td><a href="./board_write.php?bbs_id=<?=$bbs_id?>&article_id=<?=$article_id?>&m=u"><img src="<?=$dmshop_board_path?>/img/btn_edit.gif" border="0"></a></td>
<? } ?>
<? if ($dmshop_board['btn_delete']) { ?>
    <td width="3"></td>
    <td><a href="#" onclick="articleDelete(); return false;"><img src="<?=$dmshop_board_path?>/img/btn_delete.gif" border="0"></a></td>
<? } ?>
<? if ($shop_user_admin) { ?>
    <td width="3"></td>
    <td><a href="#" onclick="articleMove(); return false;"><img src="<?=$dmshop_board_path?>/img/btn_move.gif" border="0"></a></td>
<? } ?>
<? if ($dmshop_board['btn_write']) { ?>
    <td width="3"></td>
    <td><a href="./board_write.php?bbs_id=<?=$bbs_id?>"><img src="<?=$dmshop_board_path?>/img/btn_write.gif" border="0"></a></td>
<? } ?>
<? if ($dmshop_board['btn_answer']) { ?>
    <td width="3"></td>
    <td><a href="./board_write.php?bbs_id=<?=$bbs_id?>&article_id=<?=$article_id?>&m=a"><img src="<?=$dmshop_board_path?>/img/btn_answer.gif" border="0"></a></td>
<? } ?>
</tr>
</table>
    </td>
</tr>
</table>
<?
$article_button = ob_get_contents();
ob_end_flush();
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="7"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bebebe" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_view">
<tr bgcolor="#fdfdfd">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
<? if ($dmshop_board['bbs_category_use']) { ?>
    <td class="ar_category"><?=$dmshop_article['ar_category']?></td>
    <td class="category_line">|</td>
<? } ?>
    <td class="ar_title"><p><?=$dmshop_article['ic_answer']?><?=$dmshop_article['ar_title']?><?=$dmshop_article['ic_secret']?><?=$dmshop_article['ic_new_time']?><?=$dmshop_article['ic_hit_time']?></p></td>
    <td width="10"></td>
</tr>
</table>
    </td>
</tr>
<tr><td height="1" bgcolor="#efefef"></td></tr>
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="name_title">작성자</td>
    <td width="5"></td>
    <td class="ar_name"><?=$dmshop_article['name']?></td>
    <td class="name_line">|</td>
    <td class="name_title">작성일시</td>
    <td width="5"></td>
    <td class="ar_date"><?=date("Y-m-d H:i", strtotime($dmshop_article['datetime']));?></td>
    <td class="name_line">|</td>
    <td class="name_title">조회</td>
    <td width="5"></td>
    <td class="ar_hit"><?=number_format($dmshop_article['ar_hit']);?></td>
    <td width="10"></td>
</tr>
</table>
    </td>
</tr>
<tr><td height="1" bgcolor="#efefef"></td></tr>
<?
$n = 0;
$article_file_view = "";
for ($i=0; $i<count($article_file); $i++) {

    $n++;

    // 이미지, 플래시, 동영상, 음악파일은 본문에 노출!
    if (preg_match("/\.(jp[e]?g|gif|png|swf|asx|asf|wmv|wma|mpg|mpeg|mov|avi|mp3)$/i", $article_file[$i]['upload_file'])) { $article_file_view .= "<p>".shop_article_file_view($bbs_id, $article_file[$i]['datetime'], $article_file[$i]['upload_file'], $article_file[$i]['upload_width'], $article_file[$i]['upload_height'], $dmshop_board['bbs_view_image'], "")."<br /></p>"; }
?>
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"></td>
    <td class="name_title">첨부파일<? if (count($article_file) > '1') { echo " #".$n; } ?></td>
    <td width="10"></td>
    <td><img src="<?=$dmshop_board_path?>/img/ic_file.gif" class="ic_file"><a href="./download_article.php?bbs_id=<?=$bbs_id?>&article_id=<?=$article_id?>&id=<?=$article_file[$i]['id']?>"><span class="upload_source"><?=filter1($article_file[$i]['upload_source']);?> <span class="upload_filesize">(<?=shop_filesize($article_file[$i]['upload_filesize'])?>)</span></a></td>
    <td width="10"></td>
</tr>
</table>
    </td>
</tr>
<tr><td height="1" bgcolor="#efefef"></td></tr>
<? } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="300">
    <td valign="top"><div id="article_content"><?=$article_file_view?><?=$dmshop_article['ar_content']?></div></td>
</tr>
</table>

<?
if ($dmshop_board['bbs_reply_write']) {

    include_once("./board_reply.php");

}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e9e9e9" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="8"></td></tr>
</table>

<?=$article_button?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="8"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#e9e9e9" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
</table>

<script type="text/javascript">
window.onload=function() { shopResizeImage(<?=$dmshop_board['bbs_view_image']?>); }
</script>