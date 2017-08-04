<?
if (!defined('_DMSHOP_')) exit;

$colspan = 3;

if ($dmshop_board['bbs_category_use']) { $colspan++; $colspan++; }
?>
<style type="text/css">
.board_list .b1 {margin-top:6px;}
.board_list .b2 {margin-top:7px;}
.board_list .t2 {line-height:15px; font-size:11px; color:#acacac; font-family:dotum,돋움;}

.board_list .schbox1 {width:5px; height:53px; background:url('<?=$dmshop_board_path?>/img/schbox1.gif') no-repeat;}
.board_list .schbox2 {height:53px; background:url('<?=$dmshop_board_path?>/img/schbox2.gif') repeat-x;}
.board_list .schbox3 {width:5px; height:53px; background:url('<?=$dmshop_board_path?>/img/schbox3.gif') no-repeat;}

.board_list .bbs_category_bg {height:35px; background:url('<?=$dmshop_board_path?>/img/category_bg.gif') repeat-x;}
.board_list .category_off {display:block; padding:0 20px; text-decoration:none; text-align:center; border-top:1px solid #d5d5d5; border-right:1px solid #d5d5d5; border-bottom:1px solid #d5d5d5; height:33px; background-color:#fbfbfb; line-height:33px; font-size:12px; color:#717171; font-family:gulim,굴림;}
.board_list .category_on {display:block; padding:0 20px; text-decoration:none; text-align:center; border-top:1px solid #d5d5d5; border-right:1px solid #d5d5d5; border-bottom:1px solid #ffffff; height:33px; background-color:#ffffff; font-weight:bold; line-height:33px; font-size:12px; color:#000000; font-family:gulim,굴림;}

.board_list .input {width:209px; height:19px; border:1px solid #d5d5d5; padding:0px 3px 0px 3px;}
.board_list .input {line-height:19px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.board_list .checkbox {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:-1px;}
.board_list .search .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.board_list .search .selectBox-dropdown {width:40px; height:19px;}
.board_list .search .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.board_list .search_keyword {font-weight:bold; line-height:33px; font-size:12px; color:#000000; font-family:dotum,돋움;}
.board_list .search_list {line-height:33px; font-size:12px; color:#717171; font-family:dotum,돋움;}
.board_list .search_count {font-weight:bold; line-height:33px; font-size:12px; color:#000000; font-family:dotum,돋움;}

.board_list .ic_q {text-align:center;}
.board_list .ar_category a {line-height:37px; font-size:12px; color:#acacac; font-family:dotum,돋움;}
.board_list .ar_title nobr {margin-left:10px; display:block; overflow:hidden; width:100%; text-overflow:ellipsis;}
.board_list .ar_title span {line-height:37px; font-size:12px; color:#787878; font-family:dotum,돋움;}
.board_list .ar_title .edit {margin-left:10px;}
.board_list .ar_title .delete {margin-left:1px;}
.board_list .ic_view {text-align:center;}
.board_list .not {text-align:center; line-height:14px; font-size:12px; color:#787878; font-family:gulim,굴림;}
.board_list .ic_view_off {width:32px; height:6px; background:url('<?=$dmshop_board_path?>/img/ic_view.gif') no-repeat 0 0;}
.board_list .ic_view_on {width:32px; height:6px; background:url('<?=$dmshop_board_path?>/img/ic_view.gif') no-repeat -32px 0;}

.board_list .ar_content {line-height:160%; font-size:12px; color:#000000; font-family:dotum,돋움;}
.board_list .ar_content p {margin-top:0px; margin-bottom:0px;}

.ar_view {display:none;}
.ar_bg {cursor:pointer;}
</style>

<script type="text/javascript">
function articleSearch()
{

/*
    var f = document.formSearch;

    if (f.q.value == '') {

        alert('검색어를 입력하세요.');
        f.q.focus();
        return false;

    }
*/
    return true;

}

function articleDelete(article_id)
{

    var f = document.formBoard;

    f.m.value = "d";
    f.article_id.value = article_id;

    if (confirm("해당 데이터를 삭제하시겠습니까?")) {

        f.action = "./board_write_update.php";
        f.submit();

    } else {

        return false;

    }

}
</script>

<form method="post" name="formBoard" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<input type="hidden" name="article_id" value="" />
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#cccccc" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="34" bgcolor="#f8f8f8" class="none">&nbsp;</td></tr>
</table>

<?
// 회원등급 및 기타정보
include_once("$dmshop_mypage_path/information.php");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr>
    <td width="9"></td>
    <td width="123" valign="top"><img src="<?=$dmshop_board_path?>/img/title.gif"></td>
    <td width="10"></td>
    <td align="right"><p class="b2 t2">아래 내용에서 원하는 답변이 없을 경우, 1:1 문의를 이용하시기 바랍니다.</p></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#bbbbbb" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="board_list auto">
<tr>
    <td class="schbox1"></td>
    <td class="schbox2">
<form method="get" name="formSearch" action="board.php" onSubmit="return articleSearch();" autocomplete="off">
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<input type="hidden" name="ar_category" value="<?=text($ar_category)?>" />
<table border="0" cellspacing="0" cellpadding="0" class="board_list auto">
<tr>
    <td width="10"></td>
    <td class="search">
<select id="f" name="f" class="select">
    <option value="ar_title">제목</option>
    <option value="ar_content">내용</option>
</select>

<script type="text/javascript">
<? if ($f) { ?>document.getElementById("f").value = "<?=$f?>";<? } ?>
</script>

<script type="text/javascript">$(document).ready( function() { $(".board_list .search select").selectBox(); });</script>
    </td>
    <td width="3"></td>
    <td><input type="text" name="q" value="<?=text($q)?>" class="input" /></td>
    <td width="3"></td>
    <td><input type="image" src="<?=$dmshop_board_path?>/img/btn_search.gif" border="0" /></td>
    <td width="10"></td>
</tr>
</table>
</form>
    </td>
    <td class="schbox3"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<? if ($f && $q) { ?>
<div style="border:1px solid #d5d5d5; background-color:#fbfbfb;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr>
    <td width="10"></td>
    <td class="search_list"><span class="search_keyword"><?=text($q)?></span>에 대한 제목 검색결과는 <span class="search_count"><?=number_format($total_count);?></span>건 입니다.</td>
    <td width="34"><a href="./board.php?bbs_id=<?=$bbs_id?>"><img src="<?=$dmshop_board_path?>/img/btn_reset.gif" border="0"></a></td>
    <td width="6"></td>
</tr>
</table>
</div>
<? } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr>
    <td width="1" bgcolor="#d5d5d5"></td>
    <td class="bbs_category_bg">
<table border="0" cellspacing="0" cellpadding="0" class="bbs_category">
<tr>
    <td><a href="./board.php?bbs_id=<?=$bbs_id?>" class="<? if (!$bbs_category) { echo "category_on"; } else { echo "category_off"; } ?>">전체</a></td>
<? if ($dmshop_board['bbs_category_use']) { ?>
<?
$row = explode("|", trim($dmshop_board['bbs_category']));
for ($i=0; $i<count($row); $i++) {

    if ($bbs_category == $row[$i]) {

        echo "<td><a href='./board.php?bbs_id=".$bbs_id."&bbs_category=".urlencode($row[$i])."' class='category_on'>".text($row[$i])."</a></td>";

    } else {

        echo "<td><a href='./board.php?bbs_id=".$bbs_id."&bbs_category=".urlencode($row[$i])."' class='category_off'>".text($row[$i])."</a></td>";

    }

}
?>
<? } ?>
</tr>
</table>
    </td>
</tr>
</table>
<? } ?>

<form method="post" name="formList" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<?
for ($i=0; $i<count($list); $i++) {

    $article_file_view = "";
    $result = sql_query(" select * from $shop[article_file_table] where INSTR(upload_mode, 'af_".$bbs_id."_".$list[$i]['id']."_') order by id asc ");
    for ($k=0; $row=sql_fetch_array($result); $k++) {

        // 이미지, 플래시, 동영상, 음악파일은 본문에 노출!
        if (preg_match("/\.(jp[e]?g|gif|png|swf|asx|asf|wmv|wma|mpg|mpeg|mov|avi|mp3)$/i", $row['upload_file'])) {

            $article_file_view .= "<p>".shop_article_file_view($bbs_id, $row['datetime'], $row['upload_file'], $row['upload_width'], $row['upload_height'], $dmshop_board['bbs_view_image'], "")."<br /></p>";

        }

    }

    $list[$i]['ar_content'] = text2($list[$i]['ar_content'], 1);
    $list[$i]['ar_content'] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 alt=\"\" name=\"shopResizeImage[]\" onclick=\"shopImageView(this);\" style=\"cursor:pointer;\" \\2 \\3", $list[$i]['ar_content']);
?>
<input type="hidden" name="chk_article_id[<?=$i?>]" value="<?=$list[$i]['id']?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr class="ar_bg ar_bg_<?=$list[$i]['id']?>" name="<?=$list[$i]['id']?>">
    <td width="40" class="ic_q"><img src="<?=$dmshop_board_path?>/img/ic_q.gif"></td>
<? if ($dmshop_board['bbs_category_use']) { ?>
    <td width="110" class="ar_category"><a href="./board.php?bbs_id=<?=$bbs_id?>&bbs_category=<?=urlencode($list[$i]['ar_category']);?>" onclick="event.cancelBubble=true;"><?=$list[$i]['ar_category']?></a></td>
    <td width="1"><img src="<?=$dmshop_board_path?>/img/ic_line.gif"></td>
<? } ?>
    <td class="ar_title"><nobr><span title="<?=$list[$i]['ar_title']?>" onfocus="this.blur();"><?=shop_text_cut($list[$i]['ar_title'], $dmshop_board['bbs_sub_len'], "…");?></span><? if ($shop_user_admin) { ?><a href="./board_write.php?bbs_id=<?=$bbs_id?>&article_id=<?=$list[$i]['id']?>&m=u" class="edit" onclick="event.cancelBubble=true;"><img src="<?=$dmshop_board_path?>/img/btn_edit.gif" border="0" align="absmiddle"></a><a href="#" onclick="articleDelete('<?=$list[$i]['id']?>'); return false;" class="delete" onclick="event.cancelBubble=true;"><img src="<?=$dmshop_board_path?>/img/btn_delete.gif" border="0" align="absmiddle"></a><? } ?></nobr></td>
    <td width="32"><p class="ic_view ic_view_off"></p></td>
</tr>
</table>

<div class="ar_view ar_view_<?=$list[$i]['id']?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f2f2f2" class="none">&nbsp;</td></tr>
</table>

<div style="padding:20px 0;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr>
    <td width="40"></td>
<? if ($dmshop_board['bbs_category_use']) { ?>
    <td width="110"></td>
    <td width="1"></td>
<? } ?>
    <td width="10"></td>
    <td class="ar_content"><?=$article_file_view?><?=$list[$i]['ar_content']?></td>
</tr>
</table>
</div>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f2f2f2" class="none">&nbsp;</td></tr>
</table>
<? } ?>
</form>
<? if (!count($list)) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr height="200">
    <td class="not">등록된 자주묻는 질문이 없습니다.</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e9e9e9"></td></tr>
</table>
<? } ?>

<? if ($dmshop_board['btn_write']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr height="40">
    <td align="right"><a href="./board_write.php?bbs_id=<?=$bbs_id?>"><img src="<?=$dmshop_board_path?>/img/btn_write.gif" border="0"></a></td>
    <td width="10"></td>
</tr>
<tr><td colspan="2" height="2" bgcolor="#e9e9e9" class="none">&nbsp;</td></tr>
</table>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=shop_paging_v1("10", $page, $total_page, "?bbs_id=".$bbs_id."&bbs_category=".text($bbs_category)."&f=".$f."&q=".text($q)."&page=");?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
</table>

<script type="text/javascript">
$(function() {

    $(".ar_bg").click(function () {

        var article_id = $(this).attr("name");
        var obj = $('.ar_view_'+article_id);

        if (obj.is(":hidden")) {

            $('.ar_bg_'+article_id).css({ 'background-color' : '#fbfbfb' });
            $('.ar_bg_'+article_id+' .ar_category a').css({ 'font-weight' : 'bold', 'color' : '#000000' });
            $('.ar_bg_'+article_id+' .ar_title span').css({ 'font-weight' : 'bold', 'color' : '#000000' });
            $('.ar_bg_'+article_id+' .ic_view').addClass("ic_view_on");
            obj.slideDown(500);
            shopResizeImage(<?=$dmshop_board['bbs_view_image']?>);

        } else {

            $('.ar_bg_'+article_id).css({ 'background-color' : '#ffffff' });
            $('.ar_bg_'+article_id+' .ar_category a').css({ 'font-weight' : 'normal', 'color' : '#acacac' });
            $('.ar_bg_'+article_id+' .ar_title span').css({ 'font-weight' : 'normal', 'color' : '#787878' });
            $('.ar_bg_'+article_id+' .ic_view').removeClass("ic_view_on");
            obj.slideUp(500);

        }

    });

});
</script>

<script type="text/javascript">
window.onload=function() { shopResizeImage(<?=$dmshop_board['bbs_view_image']?>); }
</script>