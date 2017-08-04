<?
if (!defined('_DMSHOP_')) exit;

$colspan = 7;

if ($dmshop_board['bbs_category_use']) { $colspan++; }
if ($shop_user_admin) { $colspan++; }
?>
<style type="text/css">
.board_list .input {height:19px; border:1px solid #d5d5d5; padding:0px 3px 0px 3px;}
.board_list .input {line-height:19px; font-size:12px; color:#414141; font-family:gulim,굴림;}
.board_list .checkbox {width:13px; height:13px; position:relative; overflow:hidden; left:0; top:-1px;}
.board_list .category .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.board_list .category .selectBox-dropdown {width:100px; height:19px;}
.board_list .category .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
.board_list .search .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.board_list .search .selectBox-dropdown {width:40px; height:19px;}
.board_list .search .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.board_list .category_title {width:40px; text-align:center; line-height:29px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_list .count_title {line-height:29px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_list .count_today {font-weight:bold; line-height:29px; font-size:11px; color:#027d94; font-family:dotum,돋움;}
.board_list .count_total {font-weight:bold; line-height:29px; font-size:11px; color:#787878; font-family:dotum,돋움;}

.board_list .list_title {text-align:center; line-height:28px; font-size:11px; color:#3a3a3a; font-family:dotum,돋움;}

.board_list .number {text-align:center; line-height:32px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_list .ar_category a {margin-left:10px; line-height:32px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;}
.board_list .ar_title nobr {margin-left:10px; display:block; overflow:hidden; width:100%; text-overflow:ellipsis;}
.board_list .ar_title a {line-height:32px; font-size:12px; color:#3a3a3a; font-family:gulim,굴림;}
.board_list .ar_title .ic_answer {position:relative; overflow:hidden; left:0; top:2px; margin:0 10px 0 0px;}
.board_list .ar_title .ic_new_time {margin-left:5px;}
.board_list .ar_title .ic_hit_time {margin-left:5px;}
.board_list .ar_title .ic_secret {position:relative; overflow:hidden; left:0; top:2px; margin-left:5px;}
.board_list .ar_reply {line-height:32px; font-size:11px; color:#027d94; font-family:Tahoma,dotum,돋움;}
.board_list .ar_name {text-align:center; line-height:32px; font-size:12px; color:#787878; font-family:gulim,굴림;}
.board_list .ar_date {line-height:32px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_list .ar_time {margin-left:4px; line-height:32px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}
.board_list .ar_hit {text-align:center; line-height:32px; font-size:11px; color:#787878; font-family:dotum,돋움;}
.board_list .not {text-align:center; line-height:14px; font-size:12px; color:#787878; font-family:gulim,굴림;}

.board_list .btn_check_title {line-height:40px; font-size:11px; color:#3a3a3a; font-family:dotum,돋움;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr>
<? if ($dmshop_board['bbs_category_use']) { ?>
    <td width="300">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="category_title">분류</td>
    <td class="category">
<select id="bbs_category" name="bbs_category" class="select" onchange="document.location.href='./board.php?bbs_id=<?=$bbs_id?>&bbs_category='+this.value;">
    <option value="">전체</option>
<?
$row = explode("|", $dmshop_board['bbs_category']);
for ($i=0; $i<count($row); $i++) {

    echo "<option value='".text($row[$i])."'>".text($row[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
<? if ($bbs_category) { ?>document.getElementById("bbs_category").value = "<?=text($bbs_category)?>";<? } ?>
</script>

<script type="text/javascript">$(document).ready( function() { $(".board_list .category select").selectBox(); });</script>
    </td>
</tr>
</table>
    </td>
<? } ?>
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="count_title">TODAY</td>
    <td width="5"></td>
    <td class="count_today"><?=number_format(shop_article_today($bbs_id));?></td>
    <td width="7"></td>
    <td class="count_title">TOTAL</td>
    <td width="5"></td>
    <td class="count_total"><?=number_format($dmshop_board['bbs_write_count']);?></td>
    <td width="10"></td>
</tr>
</table>
    </td>
</tr>
</table>

<form method="post" name="formList" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<colgroup>
    <col width="10">
<? if ($shop_user_admin) { ?>
    <col width="20">
<? } ?>
    <col width="40">
<? if ($dmshop_board['bbs_category_use']) { ?>
    <col width="90">
<? } ?>
    <col width="">
    <col width="90">
    <col width="90">
    <col width="50">
    <col width="10">
</colgroup>
<tr><td colspan="<?=$colspan?>" height="2" bgcolor="#bebebe"></td></tr>
<tr bgcolor="#fdfdfd">
    <td></td>
<? if ($shop_user_admin) { ?>
    <td><input type="checkbox" onclick="if (this.checked) articleCheckAll(true); else articleCheckAll(false);" class="checkbox" /></td>
<? } ?>
    <td class="list_title">번호</td>
<? if ($dmshop_board['bbs_category_use']) { ?>
    <td class="list_title">분류</td>
<? } ?>
    <td class="list_title">제목</td>
    <td class="list_title">작성자</td>
    <td class="list_title">작성일시</td>
    <td class="list_title">조회</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#dedede"></td></tr>
<!-- notice start //-->
<? for ($i=0; $i<count($notice); $i++) { ?>
<tr <? if ($article_id && $notice[$i]['id'] == $article_id) { echo "style='background-color:#f2f8fa;';"; } ?>>
    <td></td>
<? if ($shop_user_admin) { ?>
    <td class="none">&nbsp;</td>
<? } ?>
    <td class="number"><?=$notice[$i]['number']?></td>
<? if ($dmshop_board['bbs_category_use']) { ?>
    <td class="ar_category"><a href="./board.php?bbs_id=<?=$bbs_id?>&bbs_category=<?=urlencode($notice[$i]['ar_category']);?>"><?=$notice[$i]['ar_category']?></a></td>
<? } ?>
    <td class="ar_title"><nobr><?=$notice[$i]['ic_answer']?><a href="<?=$notice[$i]['href']?>" title="<?=$notice[$i]['ar_title']?>"><?=shop_text_cut($notice[$i]['ar_title'], $dmshop_board['bbs_sub_len'], "…");?></a><? if ($dmshop_board['bbs_reply_write'] && $notice[$i]['ar_reply']) { echo "<span class='ar_reply'> [".$notice[$i]['ar_reply']."]</span>"; } ?><?=$notice[$i]['ic_secret']?><?=$notice[$i]['ic_new_time']?><?=$notice[$i]['ic_hit_time']?></nobr></td>
    <td class="ar_name"><?=$notice[$i]['name']?></td>
    <td align="center"><span class="ar_date"><?=date("m-d", strtotime($notice[$i]['datetime']));?></span><span class="ar_time"><?=date("H:i", strtotime($notice[$i]['datetime']));?></span></td>
    <td class="ar_hit"><?=$notice[$i]['ar_hit']?></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e9e9e9"></td></tr>
<? } ?>
<!-- notice end //-->
<? for ($i=0; $i<count($list); $i++) { ?>
<input type="hidden" name="chk_article_id[<?=$i?>]" value="<?=$list[$i]['id']?>" />
<tr <? if ($article_id && $list[$i]['id'] == $article_id) { echo "style='background-color:#f2f8fa;';"; } ?>>
    <td></td>
<? if ($shop_user_admin) { ?>
    <td class="chk_id"><input type="checkbox" name="chk_id[]" value="<?=$i?>" class="checkbox" /></td>
<? } ?>
    <td class="number"><?=$list[$i]['number']?></td>
<? if ($dmshop_board['bbs_category_use']) { ?>
    <td class="ar_category"><a href="./board.php?bbs_id=<?=$bbs_id?>&bbs_category=<?=urlencode($list[$i]['ar_category']);?>"><?=$list[$i]['ar_category']?></a></td>
<? } ?>
    <td class="ar_title"><nobr><?=$list[$i]['ic_answer']?><a href="<?=$list[$i]['href']?>" title="<?=$list[$i]['ar_title']?>"><?=shop_text_cut($list[$i]['ar_title'], $dmshop_board['bbs_sub_len'], "…");?></a><? if ($dmshop_board['bbs_reply_write'] && $list[$i]['ar_reply']) { echo "<span class='ar_reply'> [".$list[$i]['ar_reply']."]</span>"; } ?><?=$list[$i]['ic_secret']?><?=$list[$i]['ic_new_time']?><?=$list[$i]['ic_hit_time']?></nobr></td>
    <td class="ar_name"><?=$list[$i]['name']?></td>
    <td align="center"><span class="ar_date"><?=date("m-d", strtotime($list[$i]['datetime']));?></span><span class="ar_time"><?=date("H:i", strtotime($list[$i]['datetime']));?></span></td>
    <td class="ar_hit"><?=$list[$i]['ar_hit']?></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e9e9e9"></td></tr>
<? } ?>
<? if (!count($list)) { ?>
<tr height="200">
    <td colspan="<?=$colspan?>" class="not">등록된 게시물이 없습니다.</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" bgcolor="#e9e9e9"></td></tr>
<? } ?>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="board_list">
<tr height="40">
<? if ($shop_user_admin) { ?>
    <td width="10"></td>
    <td width="50" class="btn_check_title">선택항목</td>
    <td width="43"><a href="#" onclick="articleCheckDelete(); return false;"><img src="<?=$dmshop_board_path?>/img/btn_delete.gif" border="0"></a></td>
    <td width="3"></td>
    <td width="43"><a href="#" onclick="articleCheckMove(); return false;"><img src="<?=$dmshop_board_path?>/img/btn_move.gif" border="0"></a></td>
<? } ?>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40">
    <td><?=$board_pages?></td>
</tr>
</table>
    </td>
<? if ($dmshop_board['btn_write']) { ?>
    <td width="75"><a href="./board_write.php?bbs_id=<?=$bbs_id?>"><img src="<?=$dmshop_board_path?>/img/btn_write.gif" border="0"></a></td>
<? } ?>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#e9e9e9" class="none">&nbsp;</td></tr>
<tr height="20"><td></td></tr>
</table>

<form method="get" name="formSearch" action="board.php" onSubmit="return articleSearch();" autocomplete="off">
<input type="hidden" name="bbs_id" value="<?=$bbs_id?>" />
<input type="hidden" name="ar_category" value="<?=text($ar_category)?>" />
<table border="0" cellspacing="0" cellpadding="0" class="board_list auto">
<tr>
    <td class="search">
<select id="f" name="f" class="select">
    <option value="ar_title">제목</option>
    <option value="ar_content">내용</option>
    <option value="ar_name">작성자</option>
    <option value="user_id">아이디</option>
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
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
</table>

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
</script>

<? if ($shop_user_admin) { ?>
<script type="text/javascript">
function articleCheckAll(mode)
{

    $('.board_list .chk_id input').attr('checked', mode);

}

function articleCheckConfirm(msg)
{

    var n = $('.board_list .chk_id input:checked').length;

    if (n <= '0') {

        alert(msg + "할 게시물을 선택하세요.");
        return false;

    }

    return true;

}

function articleCheckDelete()
{

    var msg = "삭제";
    if (!articleCheckConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "check_delete";

    if (!confirm("선택한 게시물을 삭제 하시겠습니까?")) {

        return false;

    }

    f.action = "./board_write_update.php";
    f.submit();

}

function articleCheckMove()
{

    var msg = "이동";
    if (!articleCheckConfirm(msg)) {

        return false;

    }

    var f = document.formList;

    f.m.value = "check_move";

    if (!confirm("선택한 게시물을 이동 하시겠습니까?")) {

        return false;

    }

    var sub_win = window.open("", "board_move", "width=650, height=650, scrollbars=1");

    f.target = "board_move";
    f.action = "./board_move.php";
    f.submit();

}
</script>
<? } ?>