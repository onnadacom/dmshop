<?php
include_once("./_dmshop.php");
if ($plan_id) { $plan_id = preg_match("/^[0-9]+$/", $plan_id) ? $plan_id : ""; }
$top_id = "2";
$left_id = "3";

if ($m == '') {

    $menu_id = "201";
    $shop['title'] = "기획전 등록";

} else {

    $menu_id = "200";
    $shop['title'] = "기획전 수정";

}

include_once("./_top.php");

$colspan = "6";

// 이미지 설정
$dmshop_image = shop_design_image();

// 기획전
if ($dmshop_image['image_plan_use'] == '0') { $dmshop_image['thumb_width'] = shop_split("|", $dmshop_image['image_plan'], "0"); $dmshop_image['thumb_height'] = shop_split("|", $dmshop_image['image_plan'], "1"); } else { $dmshop_image['thumb_width'] = $dmshop_image['image_plan_width']; $dmshop_image['thumb_height'] = $dmshop_image['image_plan_height']; }

if ($m == '') {

    // pass
    $dmshop_plan = array();
    $dmshop_plan['position'] = "0";
    $dmshop_plan['date1'] = $shop['time_ymd'];
    $dmshop_plan['date2'] = date("Y-m-d", $shop['server_time'] + (30 * 86400));
    $dmshop_plan['view'] = "1";
    $dmshop_plan['skin'] = "basic";
    $dmshop_plan['item_width'] = "4";
    $dmshop_plan['item_height'] = "6";
    $dmshop_plan['thumb_width'] = "100";
    $dmshop_plan['thumb_height'] = "160";
    $dmshop_plan['text_top'] = "";
    $dmshop_plan['text_bottom'] = "";

}

else if ($m == 'u') {

    if (!$plan_id) {

        alert("기획전이 삭제되었거나 존재하지 않습니다.");

    }

    // 기획전
    $dmshop_plan = shop_plan($plan_id);

    if (!$dmshop_plan['id']) {

        alert("기획전이 삭제되었거나 존재하지 않습니다.");

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 내용이 없을 경우 br 코드 심는다.
//if (!$dmshop_plan['text_top']) { $dmshop_plan['text_top'] = "<br />"; }
//if (!$dmshop_plan['text_bottom']) { $dmshop_plan['text_bottom'] = "<br />"; }
?>
<style type="text/css">
.contents_box {min-width:1100px;}
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
function planSubmit()
{

    oEditors.getById["text_top"].exec("UPDATE_CONTENTS_FIELD", []);
    oEditors.getById["text_bottom"].exec("UPDATE_CONTENTS_FIELD", []);

    var f = document.formPlan;

    if (f.title.value == '') {

        alert('분류명을 입력하십시오.');
        f.title.focus();
        return false;

    }

    if (f.date1.value == '') {

        alert('전시 기간을 입력하십시오.');
        f.date1.focus();
        return false;

    }

    if (f.date2.value == '') {

        alert('전시 기간을 입력하십시오.');
        f.date2.focus();
        return false;

    }

    if (f.item_width.value == '') {

        alert('출력 이미지 수를 입력하십시오.');
        f.item_width.focus();
        return false;

    }

    if (f.item_height.value == '') {

        alert('출력 이미지 수를 입력하십시오.');
        f.item_height.focus();
        return false;

    }

    if (f.thumb_width.value == '') {

        alert('출력 이미지 크기를 입력하십시오.');
        f.thumb_width.focus();
        return false;

    }

    if (f.thumb_height.value == '') {

        alert('출력 이미지 크기를 입력하십시오.');
        f.thumb_height.focus();
        return false;

    }

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./plan_write_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td>
<? if ($m == '') { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="listname">기획전 추가</td>
</tr>
</table>
<? } else { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td class="listname">기획전 수정</td>
</tr>
</table>
<? } ?>
    </td>
<? if ($m == 'u') { ?>
    <td width="300" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/blank.gif" class="down1"></td>
    <td width="10"></td>
    <td><a href="<?=$shop['path']?>/plan.php?pl_id=<?=text($plan_id)?>" target="_blank" class="listname">화면 새창보기</a></td>
    <td width="20"></td>
</tr>
</table>
    </td>
<? } ?>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<form method="post" name="formPlan" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="plan_id" value="<?=text($plan_id)?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr height="1">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr height="30" bgcolor="#f5f5f5">
    <td colspan="<?=$colspan?>" class="guide_m">:: 기획전 기본화면 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td class="subject">기획전명</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="title" name="title" value="<?=text($dmshop_plan['title'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
    <td width="10"></td>
    <td class="help1">홈페이지의 메뉴(네비게이션)에서도 동일하게 표기 됨</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td class="subject">전시 기간</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="date1" name="date1" value="<?=text($dmshop_plan['date1'])?>" maxlength="10" readonly onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" onclick="shopDate('date1');" class="input" style="width:80px;" /></td>
    <td width="5"></td>
    <td class="tx2">부터 ~</td>
    <td width="7"></td>
    <td><input type="text" id="date2" name="date2" value="<?=text($dmshop_plan['date2'])?>" maxlength="10" readonly onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" onclick="shopDate('date2');" class="input" style="width:80px;" /></td>
    <td width="5"></td>
    <td class="tx2">까지</td>
    <td width="10"></td>
    <td class="help1">전시기간 종료 후에는 출력 설정이 자동으로 ‘가림’으로 변경 됩니다.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td class="subject">메뉴 표기</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="view" name="view" class="select">
    <option value="1"> 보임 </option>
    <option value="0"> 숨김 </option>
</select>

<script type="text/javascript">
$("#view").val("<?=$dmshop_plan['view']?>");
</script>
    </td>
    <td width="10"></td>
    <td class="help1">네비게이션메뉴 상에서 이 분류와 하위에 속한 분류를 보여주지 않습니다.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="39">
    <td></td>
    <td class="subject">분류 스킨</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="skin" name="skin" class="select">
<?
$skin_array = shop_skin_dir("plan");
for ($i=0; $i<count($skin_array); $i++) {

    echo "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}
?>
</select>

<script type="text/javascript">
$("#skin").val("<?=text($dmshop_plan['skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="help1">분류 페이지용 스킨 선택. (스킨이란? : 디자인과 기능이 포함된 기능, 자료실을 통해 다운로드/적용이 가능)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="65">
    <td></td>
    <td class="subject">이미지 수</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2">가로</td>
    <td width="9"></td>
    <td><input type="text" name="item_width" value="<?=text($dmshop_plan['item_width'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="9"></td>
    <td class="tx2">개 <span style="color:#b7b7b7;">(행)</span></td>
    <td width="25"></td>
    <td class="tx2">세로</td>
    <td width="9"></td>
    <td><input type="text" name="item_height" value="<?=text($dmshop_plan['item_height'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="9"></td>
    <td class="tx2">개 <span style="color:#b7b7b7;">(열)</span></td>
</tr>
</table>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td class="help1">상품 분류화면에서는 보여지는 이미지로 가로와 세로 수를 곱해진 수 만큼 화면에 보여지게 됩니다. (권장:권장 : 가로 4~6개 , 세로 4~8개)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="65">
    <td></td>
    <td class="subject" style="line-height:18px;">이미지 크기</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="thumb_use" value="0" class="radio" <? if ($dmshop_plan['thumb_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formPlan', 'thumb_use', '0');">공통크기</td>
    <td width="10"></td>
    <td class="help3">가로 <?=text($dmshop_image['thumb_width'])?>px / 세로 <?=text($dmshop_image['thumb_height'])?> px</td>
    <td width="30"></td>
    <td><input type="radio" name="thumb_use" value="1" class="radio" <? if ($dmshop_plan['thumb_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formPlan', 'thumb_use', '1');">개별크기</td>
    <td width="20"></td>
    <td class="tx2">가로</td>
    <td width="9"></td>
    <td><input type="text" name="thumb_width" value="<?=text($dmshop_plan['thumb_width'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" onclick="shopElementFocus('formPlan', 'thumb_use', '1');" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">px  / 세로</td>
    <td width="5"></td>
    <td><input type="text" name="thumb_height" value="<?=text($dmshop_plan['thumb_height'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" onclick="shopElementFocus('formPlan', 'thumb_use', '1');" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="tx2">px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
<tr>
    <td class="help1">통합설정 크기는 관리자 모드의 [디자인 > 통합이미지 설정 > 기획전 목록 이미지] 항목에서 변경 합니다. (권장)</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
<tr>
    <td class="help1">만일 기획전 목록의 이미지 크기를 다르게 설정하고자 하실 경우에는 임의크기를 선택하여 가로/세로 크기를 입력 합니다.</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td class="subject">기획전 출력 순서</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="position" value="<?=text($dmshop_plan['position'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:80px;" /></td>
    <td width="10"></td>
    <td class="help1">숫자가 높을수록 앞에 출력 99, 숫자가 낮을수록 뒤에 출력 -99, 기본 설정값 0일 경우, 최근등록 기획전이 우선 출력 됨.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td class="subject">혜택별 검색 사용</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height='25'>
<?
// 가로 갯수
$mod = "5";

$result = sql_query(" select * from $shop[icon_file_table] where view = '1' order by position desc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $checked = false;

    if (stristr($dmshop_plan['item_icon'], "|".$row['id']."|")) {

        $checked = true;

    }

    if ($i && $i%$mod == '0') {

        echo "</tr>\n<tr height='25'>\n";

    }

    if ($i%$mod >= '1') {

        echo "<td width='30'></td>";

    }

    echo "<td>";
?>
<table border='0' cellspacing='0' cellpadding='0'>
<tr>
    <td><input type="checkbox" name="icon_insert[<?=$row['id']?>]" value="1" class="checkbox" <? if ($checked) { echo 'checked'; } ?> /></td>
    <td width="5"></td>
    <td title="<?=$row['title']?>"><?=shop_file_view($shop['path']."/data/icon/".shop_data_path("u", $row['datetime'])."/".$row['upload_file'], $row['upload_width'], $row['upload_height']);?></td>
</tr>
</table>
<?
    echo "</td>";

}

// 나머지 셀을 채운다.
$cnt = $i%$mod;
if ($cnt) {

    for ($i=$cnt; $i<$mod; $i++) {

        if ($i%$mod >= '1') {
    
            echo "<td width='30'></td>";
    
        }

        echo "<td>&nbsp;</td>";

    }

}
?>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="39">
    <td></td>
    <td class="subject">동시적용</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"><input type="checkbox" name="check_all" value="1" class="checkbox" /></td>
    <td class="tx2" onclick="shopElementCheck('formPlan', 'check_all');">모든 기획전의 [출력스킨], [출력이미지수], [출력이미지크기], [혜택별 검색]을 위와 동일하게 설정 합니다.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="30" bgcolor="#f5f5f5">
    <td colspan="<?=$colspan?>" class="guide_m">:: 상품분류 화면 상단/하단 꾸미기 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="39">
    <td></td>
    <td class="subject">상단 이미지</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "plan_top_".$plan_id;
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
<? if ($file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
<? } ?>
    <td width="10"></td>
    <td class="help1">상품분류 화면의 상단에 보여질 JPG, GIF, PNG, SWF 파일 첨부</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="280">
    <td></td>
    <td class="subject">상단 내용</td>
    <td class="bc1"></td>
    <td></td>
    <td><textarea id="text_top" name="text_top" class="textarea1" style="width:788px; height:170px;"><?=text($dmshop_plan['text_top']);?></textarea></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="280">
    <td></td>
    <td class="subject">하단 내용</td>
    <td class="bc1"></td>
    <td></td>

    <td><textarea id="text_bottom" name="text_bottom" class="textarea1" style="width:788px; height:170px;"><?=text($dmshop_plan['text_bottom']);?></textarea></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="39">
    <td></td>
    <td class="subject">하단 이미지</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$upload_mode = "plan_bottom_".$plan_id;
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
<? if ($file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
<? } ?>
    <td width="10"></td>
    <td class="help1">상품분류 화면의 하단에 보여질 JPG, GIF, PNG, SWF 파일 첨부</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="30" bgcolor="#f5f5f5">
    <td colspan="<?=$colspan?>" class="guide_m">:: 상단/하단 파일 개별설정 (전문가용) ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td class="subject">TOP 파일 경로</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="include_top" value="<?=text($dmshop_plan['include_top'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:780px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
<tr>
    <td class="help1">직접 제작한 상단의 디자인 파일을 FTP에 업로드 후 상대경로를 입력합니다. ex) <?=$shop['path']?>/design/name_top.php</td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="40">
    <td></td>
    <td class="subject">BOTTOM 파일 경로</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="include_bottom" value="<?=text($dmshop_plan['include_bottom'])?>" onFocus="shopInfocus1(this);" onBlur="shopOutfocus1(this);" class="input" style="width:780px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
<tr>
    <td class="help1">직접 제작한 하단의 디자인 파일을 FTP에 업로드 후 상대경로를 입력합니다. ex) <?=$shop['path']?>/design/name_bottom.php</td>
</tr>
</table>
</div>
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
    <td><a href="#" onclick="planSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./plan_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 입력하신 상품이 등록 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "text_top",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "text_bottom",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});
</script>

<script type="text/javascript">
$(document).ready(function() { shopTop(); });
</script>

<?
include_once("./_bottom.php");
?>