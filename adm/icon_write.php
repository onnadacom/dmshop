<?php
include_once("./_dmshop.php");
$shop['title'] = "상품 아이콘 추가";
include_once("$shop[path]/shop.top.php");

$colspan = "9";
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}
</style>

<script type="text/javascript">
function iconSubmit()
{

    var f = document.formIcon;

    if (!confirm("등록하시겠습니까?")) {

        return false;

    }

    f.action = "./icon_write_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d7d7d8" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#eeeeef" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="title_bg2">
<tr>
    <td width="26" align="center"><img src="<?=$shop['image_path']?>/adm/position_arrow.gif"></td>
    <td class="bigtitle">아이콘 추가</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#c8cdd2" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="39" bgcolor="#f5f5f5">
    <td class="guide_t">아이콘 목록에 추가될 이미지를 등록 합니다. (권장 사이즈 = 가로 40px, 세로 15px 이하)</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx1">이미지 첨부 상자</td>
    <td width="10"></td>
    <td><a href="javascript:listAdd('new', '', '');" class="t1"><img src="<?=$shop['image_path']?>/adm/option_add.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="javascript:listClose();" class="t1"><img src="<?=$shop['image_path']?>/adm/option_del.gif" border="0"></a></td>
    <td width="20"></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<form method="post" name="formIcon" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" id="list_number" name="list_number" value="0" />
<input type="hidden" id="list_count" name="list_count" value="0" />
<input type="hidden" id="list_layer_count" name="list_layer_count" value="0" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="100">
    <col width="1">
    <col width="140">
    <col width="1">
    <col width="20">
    <col width="">
    <col width="20">
</colgroup>
<tr height="1">
    <td></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td class="bc1"></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr height="30" bgcolor="#f5f5f5">
    <td></td>
    <td class="boxtitle">미리보기</td>
    <td class="bc1"></td>
    <td class="boxtitle">아이콘명</td>
    <td class="bc1"></td>
    <td></td>
    <td class="boxtitle">파일첨부</td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
</table>

<table id="listAdd" cellpadding="0" cellspacing="0" border="0" style="display:inline;" class="conts_middle"></table>

<script type="text/javascript">
function listAdd(mode, number, list_id)
{

    // 새로 추가 된다면
    if (mode == 'new') {

        var list_count = document.getElementById("list_count").value;
    
        var tmp_list_number = parseInt(list_count);
    
        var list_number = tmp_list_number + 1;
    
        document.getElementById("list_count").value = list_number;
        document.getElementById("list_layer_count").value = list_number;

        var number = list_number;

    } else {

        if (!number) {
    
            return;
    
        }

    }

    var list_num = parseInt(document.getElementById("list_number").value) + 1;

    document.getElementById("list_number").value = list_num;

    var id = document.getElementById("listAdd");
    var objRow = id.insertRow(id.rows.length);
    var objCell = objRow.insertCell(0);

    var list_html = "";

    list_html += "<div id='list"+number+"_layer' style='display:inline;'>";
    list_html += "<input type='hidden' id='list"+number+"_position' name='list"+number+"_position' value='"+list_num+"' />";
    list_html += "<input type='hidden' id='list"+number+"_id' name='list"+number+"_id' value='' />";
    list_html += "<input type='hidden' id='list"+number+"_mode' name='list"+number+"_mode' value='1' />";
    list_html += "<table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#ffffff' style='table-layout:fixed;'>";
    list_html += "<tr height='50'>";
    list_html += "<td width='20'></td>";
    list_html += "<td width='80' align='center'><div id='list"+number+"_preview' style='width:80px; height:20px; text-align:center;'>&nbsp;</div></td>";
    list_html += "<td width='20'></td>";
    list_html += "<td width='1' class='bc1'></td>";
    list_html += "<td width='140' align='center'><input type='text' id='list"+number+"_title' name='list"+number+"_title' onFocus='shopInfocus1(this);' onBlur='shopOutfocus1(this);' class='input' style='width:100px;' value='' /></td>";
    list_html += "<td width='1' class='bc1'></td>";
    list_html += "<td width='20'></td>";
    list_html += "<td><input type='file' id='list"+number+"_file' name='list"+number+"_file' class='file' size='35' onchange=\"shopFile(document.getElementById('list"+number+"_preview'), this);\" onkeydown=\"return false\" /></td>";
    list_html += "<td width='20'></td>";
    list_html += "</tr>";
    list_html += "<tr><td colspan='<?=$colspan?>' height='1' class='bc1'></td></tr>";
    list_html += "</table>";
    list_html += "</div>";

    objCell.innerHTML = list_html;

}

function listClose()
{

    var list_layer_count = document.getElementById("list_layer_count").value;

    if (list_layer_count <= '1') {

        return;

    }

    var list_num = parseInt(document.getElementById("list_number").value) - 1;

    if (list_num > '0') {

        document.getElementById("list_number").value = list_num;

    }

    var tmp_layer_number = parseInt(list_layer_count);

    var list_layer_number = tmp_layer_number - 1;

    // 1 감소
    document.getElementById("list_layer_count").value = list_layer_number;

    var tmp_mode = document.getElementById("list"+list_layer_count+"_mode").value;

    if (tmp_mode == '0') {

        listClose();
        return;

    }

    // 레이어 숨김
    document.getElementById("list"+list_layer_count+"_layer").style.display = "none";

    // 사용 안 함
    document.getElementById("list"+list_layer_count+"_mode").value = "0";

}
</script>

<script type="text/javascript">
// 초기화
document.getElementById("list_number").value = "0";
document.getElementById("list_count").value = "0";
document.getElementById("list_layer_count").value = "0";
</script>

<script type="text/javascript">
$(function() {

    listAdd("new", "", "");
    listAdd("new", "", "");
    listAdd("new", "", "");
    listAdd("new", "", "");
    listAdd("new", "", "");

});
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="iconSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="15"></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2" style="line-height:18px;">확인버튼을 클릭하시면 현재 첨부된 모든 이미지가 등록 됩니다.<br><span style="font-size:12px;">※</span> 미리보기 이미지는 익스플로러의 버그로 실 사이즈와 다르게 보일수 있으나,<br>확인버튼을 클릭하여 업로드 하시면, 정상(원본) 사이즈로 등록 됩니다.<br />이미지가 첨부되지 않을경우 등록되지 않습니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>