<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "6";

if ($m == '') {

    $menu_id = "101";
    $shop['title'] = "게시판 생성";

} else {

    $menu_id = "100";
    $shop['title'] = "게시판 수정";

}

$colspan = "6";

if ($m == '') {

    $dmshop_board = array();
    $dmshop_board['bbs_position'] = "0";
    $dmshop_board['bbs_view'] = "1";
    $dmshop_board['bbs_skin'] = "basic";
    $dmshop_board['bbs_order'] = "ar_id desc, id asc";
    $dmshop_board['bbs_sub_len'] = "100";
    $dmshop_board['bbs_new_time'] = "24";
    $dmshop_board['bbs_hit_time'] = "1000";
    $dmshop_board['bbs_rows'] = "20";
    $dmshop_board['bbs_gallery'] = "4";
    $dmshop_board['bbs_thumb_width'] = "100";
    $dmshop_board['bbs_thumb_height'] = "100";
    $dmshop_board['bbs_view_image'] = "600";
    $dmshop_board['bbs_view_list'] = "1";
    $dmshop_board['bbs_name'] = "1";
    $dmshop_board['bbs_privacy'] = "0";
    $dmshop_board['bbs_reply_write'] = "1";
    $dmshop_board['bbs_secret'] = "0";
    $dmshop_board['bbs_list_level'] = "1";
    $dmshop_board['bbs_read_level'] = "1";
    $dmshop_board['bbs_write_level'] = "2";
    $dmshop_board['bbs_write_level'] = "2";
    $dmshop_board['bbs_answer_level'] = "9";
    $dmshop_board['bbs_reply_level'] = "2";
    $dmshop_board['bbs_download_level'] = "1";
    $dmshop_board['bbs_file_limit'] = "2";
    $dmshop_board['bbs_file_size'] = "1048576";
    $dmshop_board['bbs_write_cash'] = "0";
    $dmshop_board['bbs_reply_cash'] = "0";
    $dmshop_board['bbs_text_top'] = "";
    $dmshop_board['bbs_text_bottom'] = "";

    $shop['title'] = "게시판 추가";

}

else if ($m == 'u') {

    if (!$bbs_id) {

        alert("게시판이 삭제되었거나 존재하지 않습니다.");

    }

    // 게시판
    $dmshop_board = shop_board($bbs_id);

    if (!$dmshop_board['bbs_id']) {

        alert("게시판이 삭제되었거나 존재하지 않습니다.");

    }

    $shop['title'] = "게시판 수정";

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 내용이 없을 경우 br 코드 심는다.
//if (!$dmshop_board['bbs_write_text']) { $dmshop_board['bbs_write_text'] = "<br />"; }
//if (!$dmshop_board['bbs_text_top']) { $dmshop_board['bbs_text_top'] = "<br />"; }
//if (!$dmshop_board['bbs_text_bottom']) { $dmshop_board['bbs_text_bottom'] = "<br />"; }

include_once("./_top.php");
?>
<style type="text/css">
.contents_box {min-width:1100px;}

.contents_box .select1 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select1 .selectBox-dropdown {width:180px; height:19px;}
.contents_box .select1 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.contents_box .select2 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select2 .selectBox-dropdown {width:20px; height:19px;}
.contents_box .select2 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.contents_box .select3 .select {line-height: 1.5; font-size:12px; color:#000000; font-family:"돋움",Dotum,Helvetica,AppleGothic,Sans-serif;}
.contents_box .select3 .selectBox-dropdown {width:110px; height:19px;}
.contents_box .select3 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    $(".contents_box .select1 select").selectBox();
    $(".contents_box .select2 select").selectBox();
    $(".contents_box .select3 select").selectBox();

    $(".tip1").simpletip({ content: '게시판 아이디는 본 게시판의 주소로 활용되며, 중복될 수 없습니다.' });
    $(".tip2").simpletip({ content: '게시판명은 메뉴바에도 표기되므로, 짧막한 표준명칭 사용을 권장 합니다.' });
    $(".tip3").simpletip({ content: '숫자가 높을수록 앞에 출력 99, 숫자가 낮을수록 뒤에 출력 -99, 기본 설정값 0일 경우 기본 등록순으로 보여집니다.' });
    $(".tip4").simpletip({ content: '메뉴출력을 숨김으로 설정하면, 메뉴바 상에서 보여지지 않습니다.' });
    $(".tip5").simpletip({ content: '여러 분류 입력시 | 구분자로 사용됩니다. (예: 서울|대전|대구|부산)' });
    $(".tip6").simpletip({ content: '게시판용 스킨 선택. (스킨이란? : 디자인과 기능이 포함된 기능. 자료실을 통해 다운로드/적용이 가능)' });
    $(".tip7").simpletip({ content: '게시물이 정렬되는 조건을 말합니다. (권장 : 작성일 내림차순)' });
    $(".tip8").simpletip({ content: '게시판 목록에서 보여질 제목길의의 최대 허용치. 입력된 수치 초과시 ··· 표기' });
    $(".tip9").simpletip({ content: '게시물 등록후 입력된 시간 동안, 제목에 NEW 아이콘 표시' });
    $(".tip10").simpletip({ content: '입력된 조회수이상 열람된 글에 한하여, 제목에 HIT 아이콘 표시' });
    $(".tip11").simpletip({ content: '게시판 목록의 한 페이지에서 보여질 게시물(제목)의 수' });
    $(".tip12").simpletip({ content: '갤러리 스킨의 경우, 목록의 한 페이지에서 보여질 이미지의 수를 정할 수 있습니다. (권장 : 가로4개)' });
    $(".tip13").simpletip({ content: '게시판 목록에서 보여질 이미지의 크기. 목록당 보여질 가로 이미지 수가 많을 경우, 크기를 적게 입력.' });
    $(".tip14").simpletip({ content: '게시판 내용에서 보여질 이미지의 최대 가로폭. 초과시 자동 축소' });
    $(".tip15").simpletip({ content: '게시판 내용에서 하단에 게시판 목록이 출력됩니다.' });
    $(".tip16").simpletip({ content: '게시물 작성자를 표기하는 방식입니다.' });
    $(".tip17").simpletip({ content: '작성자 정보를 부분노출합니다.' });
    $(".tip18").simpletip({ content: '댓글 작성여부를 설정합니다.' });
    $(".tip19").simpletip({ content: '비밀글 작성여부를 설정합니다.' });
    $(".tip20").simpletip({ content: '모든 게시판의 설정을 위의 설정으로 동시적용합니다.' });
    $(".tip21").simpletip({ content: '설정된 레벨 이상의 회원만 게시판의 목록(리스트) 열람가능.' });
    $(".tip22").simpletip({ content: '설정된 레벨 이상의 회원만, 게시물의 내용 열람가능.' });
    $(".tip23").simpletip({ content: '설정된 레벨 이상의 회원만, 게시물 작성가능. (Lv.1[비회원] 작성 설정 시 자동입력 방지 플러그인 자동실행)' });
    $(".tip24").simpletip({ content: '설정된 레벨 이상의 회원만, 게시물 답변가능. (Lv.1[비회원] 작성 설정 시 자동입력 방지 플러그인 자동실행)' });
    $(".tip25").simpletip({ content: '설정된 레벨 이상의 회원만, 덧글 작성가능. (Lv.1[비회원] 작성 설정 시 자동입력 방지 플러그인 자동실행)' });
    $(".tip26").simpletip({ content: '설정된 레벨 이상의 회원만, 게시물의 첨부파일 다운로드 가능.' });
    $(".tip27").simpletip({ content: '첨부파일의 최대용량은 이용하시는 웹호스팅 및 서버환경에 따라 다를 수 있습니다.' });
    $(".tip28").simpletip({ content: '게시물 작성시 작성자에게 적립금을 지급합니다.' });
    $(".tip29").simpletip({ content: '댓글 작성시 작성자에게 적립금을 지급합니다.' });
    $(".tip30").simpletip({ content: '글쓰기 기본 내용에 보여질 항목입니다.' });
    $(".tip31").simpletip({ content: '모든 게시판의 설정을 위의 설정으로 동시적용합니다.' });
    $(".tip32").simpletip({ content: '게시판 상단에 보여질 이미지 파일을 첨부합니다.' });
    $(".tip33").simpletip({ content: '게시판 상단에 보여질 내용을 입력합니다.' });
    $(".tip34").simpletip({ content: '게시판 하단에 보여질 내용을 입력합니다.' });
    $(".tip35").simpletip({ content: '게시판 하단에 보여질 이미지 파일을 첨부합니다.' });
    $(".tip36").simpletip({ content: '직접 제작한 상단의 디자인 파일을 FTP에 업로드 후 상대경로를 입력합니다. ex) <?=$shop['path']?>/design/name_top.php' });
    $(".tip37").simpletip({ content: '직접 제작한 하단의 디자인 파일을 FTP에 업로드 후 상대경로를 입력합니다. ex) <?=$shop['path']?>/design/name_bottom.php' });

    shopTop();

});
</script>

<script type="text/javascript">
function smarteditorImageAdd(irid, date, fileame)
{

    var sHTML = "<img src='<?=$shop['smarteditor_data']?>"+"/"+date+"/"+fileame+"' border='0'><p><br></p>";
    oEditors.getById[irid].exec("PASTE_HTML", [sHTML]);

}
</script>

<script type="text/javascript" src="<?=$shop['smarteditor_path']?>/js/HuskyEZCreator.js" charset="utf-8"></script>

<script type="text/javascript">
function boardSave()
{

    oEditors.getById["bbs_write_text"].exec("UPDATE_CONTENTS_FIELD", []);
    oEditors.getById["bbs_text_top"].exec("UPDATE_CONTENTS_FIELD", []);
    oEditors.getById["bbs_text_bottom"].exec("UPDATE_CONTENTS_FIELD", []);

    var f = document.formBoard;

    if (f.bbs_id.value == '') {

        alert('게시판 아이디를 입력하십시오.');
        f.bbs_id.focus();
        return false;

    }

    if (f.bbs_title.value == '') {

        alert('게시판명을 입력하십시오.');
        f.bbs_title.focus();
        return false;

    }

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./board_write_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formBoard" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 게시판 기본 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">게시판 아이디</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<? if ($m == '') { ?>
<input type="hidden" id="bbs_id_chk" name="bbs_id_chk" value="" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="bbs_id" name="bbs_id" value="<?=text($bbs_id)?>" maxlength="20" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="bbsidCheck(); return false;"><img src="<?=$shop['image_path']?>/adm/check.gif" border="0"></a></td>
    <td width="13"></td>
    <td class="help1"><span id="bbs_id_msg"></span></td>
</tr>
</table>

<script type="text/javascript">
$("#bbs_id_chk").val("");

function bbsidCheck()
{

    var bbs_id = $("#bbs_id").val();

    if (!bbs_id) {

        alert("게시판 아이디를 입력하세요.");
        $("#bbs_id").focus();
        return false;

    }

    $.post("./board_id_check.php", {"bbs_id" : bbs_id}, function(data) {

        $("#dmshop_update").html(data);

    });

}
</script>
<? } else { ?>
<input type="hidden" name="bbs_id" value="<?=text($bbs_id)?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=text($bbs_id)?></td>
    <td width="10"></td>
    <td><a href="<?=$shop['path']?>/board.php?bbs_id=<?=text($bbs_id)?>" target="_blank"><img src="<?=$shop['image_path']?>/adm/blank.gif" border="0" align="absmiddle"></a></td>
</tr>
</table>
<? } ?>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip2">게시판명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="bbs_title" value="<?=text($dmshop_board['bbs_title'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip3">출력순서</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="bbs_position" value="<?=text($dmshop_board['bbs_position'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:80px;" /></td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip4">메뉴출력</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select2">
<select id="bbs_view" name="bbs_view" class="select">
    <option value="1">보임</option>
    <option value="0">숨김</option>
</select>

<script type="text/javascript">
$("#bbs_view").val("<?=text($dmshop_board['bbs_view'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="63">
    <td></td>
    <td class="subject"><span class="tip5">게시물 분류</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="bbs_category" value="<?=text($dmshop_board['bbs_category'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:500px;" /></td>
    <td width="10"></td>
    <td><input type="checkbox" name="bbs_category_use" value="1" class="checkbox" <? if ($dmshop_board['bbs_category_use']) { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementCheck('formBoard', 'bbs_category_use');">사용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 게시물 출력 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">게시판 스킨</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select3">
<select id="bbs_skin" name="bbs_skin" class="select">
<?
$skin_array = shop_skin_dir("board");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#bbs_skin").val("<?=text($dmshop_board['bbs_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip7">게시물 정렬조건</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select3">
<select id="bbs_order" name="bbs_order" class="select">
<option value="ar_id desc, id asc">기본 등록순</option>
<option value="datetime desc">작성일 내림차순</option>
<option value="datetime asc">작성일 오름차순</option>
<option value="ar_hit desc">조회수 내림차순</option>
<option value="ar_hit asc">조회수 오름차순</option>
<option value="ar_title desc">게시물 제목 내림차순</option>
<option value="ar_title asc">게시물 제목 오름차순</option>
</select>

<script type="text/javascript">
$("#bbs_order").val("<?=text($dmshop_board['bbs_order'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8">제목 길이</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="bbs_sub_len" value="<?=text($dmshop_board['bbs_sub_len'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td width="5"></td>
    <td class="tx2">자</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip9">NEW 아이콘</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="bbs_new_time" value="<?=text($dmshop_board['bbs_new_time'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td width="5"></td>
    <td class="tx2">시간</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip10">HIT 아이콘</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="bbs_hit_time" value="<?=text($dmshop_board['bbs_hit_time'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td width="5"></td>
    <td class="tx2">조회</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip11">목록당 게시물 수</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="bbs_rows" value="<?=text($dmshop_board['bbs_rows'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td width="5"></td>
    <td class="tx2">건</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><p><span class="tip12">목록당 이미지 수</span></p><p>(갤러리 스킨 전용)</p></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">가로</td>
    <td width="5"></td>
    <td><input type="text" name="bbs_gallery" value="<?=text($dmshop_board['bbs_gallery'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">개</td>
    <td width="5"></td>
    <td class="help1">(행)</td>
    <td width="30"></td>
    <td class="tx2">세로</td>
    <td width="5"></td>
    <td><input type="text" name="bbs_gallery_tmp" value="목록당 게시물 수 ÷ 가로갯수" class="input" style="width:160px; background-color:#f5f5f5;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><p><span class="tip13">목록 이미지 크기</span></p><p>(갤러리 스킨 전용)</p></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">가로</td>
    <td width="5"></td>
    <td><input type="text" name="bbs_thumb_width" value="<?=text($dmshop_board['bbs_thumb_width'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">PX</td>
    <td width="30"></td>
    <td class="tx2">세로</td>
    <td width="5"></td>
    <td><input type="text" name="bbs_thumb_height" value="<?=text($dmshop_board['bbs_thumb_height'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">PX</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip14">내용 이미지 크기</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">가로</td>
    <td width="5"></td>
    <td><input type="text" name="bbs_view_image" value="<?=text($dmshop_board['bbs_view_image'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:50px;" /></td>
    <td width="5"></td>
    <td class="tx2">PX</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip15">내용하단 목록 출력</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="bbs_view_list" value="1" class="radio" <? if ($dmshop_board['bbs_view_list'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formBoard', 'bbs_view_list', '0');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="bbs_view_list" value="0" class="radio" <? if ($dmshop_board['bbs_view_list'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formBoard', 'bbs_view_list', '1');">미사용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip16">작성자 표기방식</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="bbs_name" value="0" class="radio" <? if ($dmshop_board['bbs_name'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formBoard', 'bbs_name', '0');">아이디</td>
    <td width="30"></td>
    <td><input type="radio" name="bbs_name" value="1" class="radio" <? if ($dmshop_board['bbs_name'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formBoard', 'bbs_name', '1');">성명</td>
    <td width="30"></td>
    <td><input type="radio" name="bbs_name" value="2" class="radio" <? if ($dmshop_board['bbs_name'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formBoard', 'bbs_name', '2');">닉네임</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip17">작성자 프라이버시</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="bbs_privacy" value="0" class="radio" <? if ($dmshop_board['bbs_privacy'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td onclick="shopElementFocus('formBoard', 'bbs_privacy', '0');"><span class="tx2">없음</span><span class="help1">(홍길동)</span></td>
    <td width="30"></td>
    <td><input type="radio" name="bbs_privacy" value="1" class="radio" <? if ($dmshop_board['bbs_privacy'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td onclick="shopElementFocus('formBoard', 'bbs_privacy', '1');"><span class="tx2">1글자</span><span class="help1">(홍**)</span></td>
    <td width="30"></td>
    <td><input type="radio" name="bbs_privacy" value="2" class="radio" <? if ($dmshop_board['bbs_privacy'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td onclick="shopElementFocus('formBoard', 'bbs_privacy', '2');"><span class="tx2">2글자</span><span class="help1">(홍길*)</span></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip18">댓글 작성</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="bbs_reply_write" value="1" class="radio" <? if ($dmshop_board['bbs_reply_write'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formBoard', 'bbs_reply_write', '0');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="bbs_reply_write" value="0" class="radio" <? if ($dmshop_board['bbs_reply_write'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formBoard', 'bbs_reply_write', '1');">미사용</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip19">비밀글 작성</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="bbs_secret" value="0" class="radio" <? if ($dmshop_board['bbs_secret'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td onclick="shopElementFocus('formBoard', 'bbs_secret', '0');"><span class="tx2">사용안함</span></td>
    <td width="30"></td>
    <td><input type="radio" name="bbs_secret" value="1" class="radio" <? if ($dmshop_board['bbs_secret'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td onclick="shopElementFocus('formBoard', 'bbs_secret', '1');"><span class="tx2">사용</span><span class="help1"> (게시물 입력시 비밀글 체크박스 출력)</span></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip20">동시적용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"><input type="checkbox" name="check_all" value="1" class="checkbox" /></td>
    <td class="tx2" onclick="shopElementCheck('formBoard', 'check_all');">모든 게시판의 출력 설정을 위와 동일하게 설정 합니다.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 게시판 기능 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip21">목록보기 권한</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select3">
<?
$user_level_option = "";
$result = sql_query(" select * from $shop[user_level_table] order by level asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $user_level_option .= "<option value='".text($row['level'])."'>".text($row['name'])."</option>";

}
?>
<select id="bbs_list_level" name="bbs_list_level" class="select">
<?=$user_level_option?>
</select>

<script type="text/javascript">
$("#bbs_list_level").val("<?=text($dmshop_board['bbs_list_level'])?>");
</script>
    </td>
    <td width="5"></td>
    <td class="tx2">이상</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip22">내용보기 권한</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select3">
<select id="bbs_read_level" name="bbs_read_level" class="select">
<?=$user_level_option?>
</select>

<script type="text/javascript">
$("#bbs_read_level").val("<?=text($dmshop_board['bbs_read_level'])?>");
</script>
    </td>
    <td width="5"></td>
    <td class="tx2">이상</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip23">게시물 작성 권한</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select3">
<select id="bbs_write_level" name="bbs_write_level" class="select">
<?=$user_level_option?>
</select>

<script type="text/javascript">
$("#bbs_write_level").val("<?=text($dmshop_board['bbs_write_level'])?>");
</script>
    </td>
    <td width="5"></td>
    <td class="tx2">이상</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip24">게시물 답변 권한</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select3">
<select id="bbs_answer_level" name="bbs_answer_level" class="select">
<?=$user_level_option?>
</select>

<script type="text/javascript">
$("#bbs_answer_level").val("<?=text($dmshop_board['bbs_answer_level'])?>");
</script>
    </td>
    <td width="5"></td>
    <td class="tx2">이상</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip25">댓글 작성 권한</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select3">
<select id="bbs_reply_level" name="bbs_reply_level" class="select">
<?=$user_level_option?>
</select>

<script type="text/javascript">
$("#bbs_reply_level").val("<?=text($dmshop_board['bbs_reply_level'])?>");
</script>
    </td>
    <td width="5"></td>
    <td class="tx2">이상</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip26">첨부파일 다운 권한</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="select3">
<select id="bbs_download_level" name="bbs_download_level" class="select">
<?=$user_level_option?>
</select>

<script type="text/javascript">
$("#bbs_download_level").val("<?=text($dmshop_board['bbs_download_level'])?>");
</script>
    </td>
    <td width="5"></td>
    <td class="tx2">이상</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip27">첨부파일 업로드 설정</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">파일 수</td>
    <td width="5"></td>
    <td><input type="text" name="bbs_file_limit" value="<?=text($dmshop_board['bbs_file_limit'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">개</td>
    <td width="30"></td>
    <td class="tx2">개당 최대용량</td>
    <td width="5"></td>
    <td><input type="text" name="bbs_file_size" value="<?=text($dmshop_board['bbs_file_size'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td class="tx2">byte 이하</td>
    <td width="3"></td>
    <td class="help1">(1M = 1048576 byte)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip28">게시물 작성시 적립금</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="bbs_write_cash" value="<?=text($dmshop_board['bbs_write_cash'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td class="tx2">원 지급</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip29">댓글 작성시 적립금</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="bbs_reply_cash" value="<?=text($dmshop_board['bbs_reply_cash'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:60px;" /></td>
    <td width="5"></td>
    <td class="tx2">원 지급</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="280">
    <td></td>
    <td class="subject"><span class="tip30">글쓰기 기본 내용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><textarea id="bbs_write_text" name="bbs_write_text" class="textarea1" style="width:788px; height:170px;"><?=text($dmshop_board['bbs_write_text']);?></textarea></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip31">동시적용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"><input type="checkbox" name="check_all2" value="1" class="checkbox" /></td>
    <td class="tx2" onclick="shopElementCheck('formBoard', 'check_all2');">모든 게시판의 출력 설정을 위와 동일하게 설정 합니다.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 게시판 상단/하단 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip32">상단 이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "board_top_".$bbs_id;
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_top" class="file" size="35" /></td>
<? if ($m == 'u' && $file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_top" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
<? } ?>
    <td width="10"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG, SWF</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="280">
    <td></td>
    <td class="subject"><span class="tip33">상단 내용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><textarea id="bbs_text_top" name="bbs_text_top" class="textarea1" style="width:788px; height:170px;"><?=text($dmshop_board['bbs_text_top']);?></textarea></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="280">
    <td></td>
    <td class="subject"><span class="tip34">하단 내용</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><textarea id="bbs_text_bottom" name="bbs_text_bottom" class="textarea1" style="width:788px; height:170px;"><?=text($dmshop_board['bbs_text_bottom']);?></textarea></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip35">하단 이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "board_bottom_".$bbs_id;
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_bottom" class="file" size="35" /></td>
<? if ($m == 'u' && $file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_design.php?id=<?=text($file['id'])?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_bottom" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
<? } ?>
    <td width="10"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG, SWF</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상단/하단 파일 개별설정 (전문가용) ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip36">TOP 파일 경로</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="bbs_include_top" value="<?=text($dmshop_board['bbs_include_top'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:780px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip37">BOTTOM 파일 경로</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="bbs_include_bottom" value="<?=text($dmshop_board['bbs_include_bottom'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:780px;" /></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="boardSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./board_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 현재의 설정값이 적용 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "bbs_write_text",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "bbs_text_top",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "bbs_text_bottom",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});
</script>

<?
include_once("./_bottom.php");
?>