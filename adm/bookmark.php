<?php
include_once("./_dmshop.php");
$shop['title'] = "바로가기 설정";
include_once("$shop[path]/shop.top.php");

$colspan = "9";
?>
<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#f5f5f5;}

.contents_box .message {line-height:40px; font-size:12px; color:#555555; font-family:dotum,돋움;}
.contents_box .title {font-weight:bold; line-height:32px; font-size:13px; color:#555555; font-family:gulim,굴림;}

.contents_box .bookmark_select {width:210px; height:250px; border:1px solid #e4e4e4;}
.contents_box .bookmark_select {line-height:18px; font-size:12px; color:#333333; font-family:dotum,돋움;}
.contents_box .bookmark_select option {padding:0px 3px 0px 3px; line-height:18px; font-size:12px; color:#333333; font-family:dotum,돋움;}
</style>

<script type="text/javascript">
var removedlist = new Array();
var addedlist = new Array();

function moveToRight()
{

    var selLeft = document.formSetting.left_select.options;
    var selRight = document.formSetting.right_select.options;

    if (selLeft.selectedIndex < 0) {

        alert("목록을 선택하세요.");
        return false;

    }

    for (var i=0;i<selLeft.length;i++) {

/*
        if (selRight.length>=30) {

            alert("30개까지만 선택할 수 있습니다.");
            selectColor();
            return false;

        }
*/

        if (selLeft[i].selected) {

            var found_in_right = false;

            for (var j=0;j<selRight.length;j++) {

                if (selLeft[i].value == selRight[j].value) {

                    found_in_right = true;
                    break;

                }

            }

            if (!found_in_right) {

                var newOpt = document.createElement("OPTION");

                newOpt.text = selLeft[i].text;	
                newOpt.value = selLeft[i].value;
                selRight.add(newOpt);

                if (!removedlist[selLeft[i].value]) {

                    addedlist[selLeft[i].value] = true;

                }

                delete removedlist[selLeft[i].value];

            }

        }

    }

    selectColor();

}

function moveToLeft()
{

    var selRight = document.formSetting.right_select.options;

    if (selRight.selectedIndex < 0) {

        alert("삭제할 목록을 선택하세요.");
        return false;

    }

    for (var i=0;i<selRight.length;i++) {

        if (selRight[i].selected) {

            removedlist[selRight[i].value] = true;

            if (!addedlist[selRight[i].value]) {

                delete addedlist[selRight[i].value];

            }

            document.formSetting.right_select.remove(i);
            i--;

        }

    }

    selectColor();

}

function selectColor()
{

    var n1=document.formSetting.right_select.options.length;
    var n2=document.formSetting.left_select.options.length;

    for (var j=0;j<n2;j++) {

        document.formSetting.left_select.options[j].style.color='black';

    }

    for (var i=0;i<n1;i++) {

        for (var j=0;j<n2;j++) {

            if (document.formSetting.left_select.options[j].value==document.formSetting.right_select.options[i].value) {

                document.formSetting.left_select.options[j].style.color='#d9d9d9';
                break;

            }

        }

    }

}

function moveVertically(type, frm)
{

    var selRight = frm.right_select;
    var index = selRight.selectedIndex;

    if (index < 0) {

        alert("바로가기를 선택하세요.");
        return false;

    }

    if (type == "U") {

        if (index > 0) {

            swap(selRight, index, index - 1);

        }

    }

    else if (type == "D") {

        if (index < selRight.options.length-1) {

            swap(selRight, index, index + 1);

        }
    }

    else if (type == "T") {

		    for (var i = index; i > 0; i--) {

            swap(selRight, i, i - 1);

		    }

    }

    else if (type == "B") {

        for (var i = index; i < selRight.options.length - 1; i++) {

            swap(selRight, i, i + 1);

        }

    }

    selectColor();

}

function swap(selectedOption, index, targetIndex)
{

    var onetext = selectedOption.options[targetIndex].text;
    var onevalue = selectedOption.options[targetIndex].value;

    selectedOption.options[targetIndex].text = selectedOption.options[index].text;
    selectedOption.options[targetIndex].value = selectedOption.options[index].value;
    selectedOption.options[index].text = onetext;
    selectedOption.options[index].value = onevalue;
    selectedOption.options.selectedIndex = targetIndex;
    selectedOption.options[targetIndex].selected = true;

}

function updateMyMenuList()
{

    var selRight = document.formSetting.right_select;
    var addedArray = new Array(selRight.options.length);

    for (var i = 0; i < selRight.options.length; i++) {

        addedArray[i] = selRight.options[i].value;

    }

    document.formSetting.added_list.value = addedArray;

    var removedArray = new Array();

    for (var i in removedlist) {

        removedArray.push(i);

    }

    var addedArray = new Array();

    for (var i in addedlist) {

        addedArray.push(i);

    }

    document.formSetting.removed_list.value = removedArray;
    document.formSetting.inserted_list.value = addedArray;

    if (!confirm("적용하시겠습니까?")) {

        return false;

    } else {

        document.formSetting.submit();

    }

}
</script>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="detail_bg">
    <td width="15"></td>
    <td width="6"><img src="<?=$shop['image_path']?>/adm/arrow.gif"></td>
    <td width="5"></td>
    <td><span class="popup_title1"><?=text($shop['title'])?></span></td>
    <td width="45"><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/close2.gif" border="0"></a></td>
    <td width="10"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr>
    <td width="20"></td>
    <td>
<!-- start //-->
<form name="formSetting" method="post" action="./bookmark_update.php">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="added_list" />
<input type="hidden" name="removed_list" />
<input type="hidden" name="inserted_list" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="2" bgcolor="#777777" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="40">
    <td width="10"></td>
    <td class="message">전체 서비스 목록에서 서비스명을 선택하고, 추가 버튼을 클릭하시기 바랍니다.</td>
</tr>
</table>

<div style="padding:1px; background-color:#ffffff; border:1px solid #dddddd;">
<div style="background-color:#f9f9f9; padding:5px 10px 10px 10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="210" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow.gif"></td>
    <td width="10"></td>
    <td class="title">전체 서비스 목록</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="left_select" name="left_select" size="10" ondblclick="moveToRight();" class="bookmark_select">
<?
$result = sql_query(" select * from $shop[bookmark_table] order by id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    echo "<option value='".text($row['id'])."'>".text($row['title'])."</option>";

}
?>
</select>
    </td>
</tr>
</table>
    </td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="moveToRight(); return false;"><img src="<?=$shop['image_path']?>/adm/bookmark_add.gif" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="moveToLeft(); return false;"><img src="<?=$shop['image_path']?>/adm/bookmark_del.gif" border="0"></a></td>
</tr>
</table>
    </td>
    <td width="210" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/arrow.gif"></td>
    <td width="10"></td>
    <td class="title">바로가기 목록</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="right_select" name="right_select" size="10" ondblclick="moveToLeft();" class="bookmark_select">
<?
$result = sql_query(" select * from $shop[bookmark_table] where mode = '1' order by position asc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    echo "<option value='".text($row['id'])."'>".text($row['title'])."</option>";

}
?>
</select>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr height="10"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" class="auto">
<tr>
    <td><a href="#" onclick="moveVertically('U', document.formSetting); return false;"><img src="<?=$shop['image_path']?>/adm/btn_u.gif" border="0" title="위로" alt="위로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="moveVertically('D', document.formSetting); return false;"><img src="<?=$shop['image_path']?>/adm/btn_d.gif" border="0" title="아래로" alt="아래로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="moveVertically('T', document.formSetting); return false;"><img src="<?=$shop['image_path']?>/adm/btn_t.gif" border="0" title="맨위로" alt="맨위로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="moveVertically('B', document.formSetting); return false;"><img src="<?=$shop['image_path']?>/adm/btn_b.gif" border="0" title="맨아래로" alt="맨아래로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="moveToLeft(); return false;"><img src="<?=$shop['image_path']?>/adm/delete2.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
</table>
</div>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>
</form>
<!-- end //-->
    </td>
    <td width="20"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="updateMyMenuList(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="4"></td>
    <td><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0" /></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하셔야만 현재의 설정값이 적용 됩니다.</td>
</tr>
</table>
</div>

<script type="text/javascript">
selectColor();
</script>

<?
include_once("$shop[path]/shop.bottom.php");
?>