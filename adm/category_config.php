<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "3";
$menu_id = "400";
$shop['title'] = "상품분류 생성·관리";
$shop['admin_width'] = "";
include_once("./_top.php");

// 초기화
$tmp_option1 = "<option value='0'>　[1차 분류 입력시 선택]　</option>";
$shopCateInput = "";
$shopCateInputLog = "";
$tmp_code = "0";
$tmp_shopCateInput_value0 = "";

// 분류 데이터
$result = sql_query(" select * from $shop[category_table] order by position asc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 첫번째 분류 옵션
    if ($row['category'] == '1' && $row['code'] == '0') {

        $tmp_option1 .= "<option value='".$row['id']."'>".text($row['subject'])."</option>";
        $tmp_shopCateInput_value0 .= "update:%:".$row['id'].":%:".text($row['subject']).":%:".$row['category'].":%:".$row['code']."|%|";

    }

    // 초기화
    $shopCateInput_value = "";

    // 데이터
    $result2 = sql_query(" select * from $shop[category_table] where code = '".$row['id']."' order by position asc, id asc ");
    for ($k=0; $code=sql_fetch_array($result2); $k++) {

        $shopCateInput_value .= "update:%:".$code['id'].":%:".text($code['subject']).":%:".$code['category'].":%:".$code['code']."|%|";

    }

    // id별 값을 생성
    $shopCateInput .= "shopCateInput('', '".$row['id']."', '".$shopCateInput_value."');";
    $shopCateInputLog .= "shopCateInputLog('', '".$row['id']."', '".$row['log']."');";

}

// 마지막 id 값을 구한다.
$count = sql_fetch(" select * from $shop[category_table] order by id desc ");

// 데이터가 존재하면
if ($count['id']) {

    // 마지막 id 값에 1 더한다.
    $tmp_code = $count['id'] + 1;

} else {

    $tmp_code = "0";

}
?>
<style type="text/css">
.contents_box {min-width:1045px;}
</style>

<script type="text/javascript" src="<?=$shop['path']?>/js/category.js"></script>

<script type="text/javascript">
function categorySave()
{

    var f = document.formCategory;

    f.m.value = "";

    if (confirm("현재의 상품분류 설정값을 저장 하시겠습니까?\n\n직접만들기 디자인을 사용하실 경우\n직접만들기(가로 메뉴바, 세로 메뉴바)의 설정을 한번 더 하셔야 메뉴가 정상출력 됩니다.")) {

        f.action = "./category_config_update.php";
        f.submit();

    } else {

        return false;

    }

}

function categoryTruncate()
{

    var f = document.formCategory;

    f.m.value = "truncate";

    if (confirm("상품분류를 초기화 하시겠습니까?\n\n초기화 하시면 복구가 불가능하며, 생성된 분류 및 설정값은 삭제됩니다.")) {

        f.action = "./category_config_update.php";
        f.submit();

    } else {

        return false;

    }

}
</script>

<div class="contents_box">
<form method="post" name="formCategory" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" id="category" name="category" value="0" />
<input type="hidden" id="code" name="code" />
<input type="hidden" id="tmp_code" name="tmp_code" value="<?=$tmp_code?>" />
<input type="hidden" id="defalt_category" name="defalt_category" value="0" />
<input type="hidden" id="defalt_code1" name="defalt_code1" value="0" />
<input type="hidden" id="defalt_code2" name="defalt_code2" value="" />
<input type="hidden" id="defalt_code3" name="defalt_code3" value="" />
<input type="hidden" id="defalt_code4" name="defalt_code4" value="" />
<input type="hidden" id="defalt_code5" name="defalt_code5" value="" />
<input type="hidden" id="tmp_option" name="tmp_option" value="" />
<input type="hidden" id="code0" name="code0" value="<?=$tmp_shopCateInput_value0?>" />
<input type="hidden" id="tmp_log" name="tmp_log" value="" />
<input type="hidden" id="log0" name="log0" value="" />

<table id="inputCodeAdd" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>
<table id="inputCodeAddKind" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>
<table id="inputCodeAddLog" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr height="443">
    <td width="305" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="title_bg">
    <td align="center" class="listname">관리자 분류 설정</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
<tr>
    <td width="30"></td>
    <td width="16"><img src="<?=$shop['image_path']?>/adm/ic1.gif"></td>
    <td class="listname">새 분류 추가</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
<tr>
    <td width="46"></td>
    <td><input type="text" id="subject" name="subject" value="" onFocus="shopInfocus2(this);" onBlur="shopOutfocus2(this);" class="input2" style="width:145px;" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="shopCateInsert(); return false;"><img src="<?=$shop['image_path']?>/adm/add.gif" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
<tr>
    <td width="46"></td>
    <td class="help1">분류상자에서 분류명을 선택 후 추가</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:17px;">
<tr><td class="line2"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
<tr>
    <td width="30"></td>
    <td width="16"><img src="<?=$shop['image_path']?>/adm/ic1.gif"></td>
    <td class="listname">분류명 변경</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
<tr>
    <td width="46"></td>
    <td><input type="text" id="ch_subject" name="ch_subject" value="" onFocus="shopInfocus2(this);" onBlur="shopOutfocus2(this);" class="input2" style="width:145px;" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="shopCateChange(); return false;"><img src="<?=$shop['image_path']?>/adm/edit.gif" border="0"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
<tr>
    <td width="46"></td>
    <td class="help1">선택하신 분류명의 명칭을 변경합니다.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:17px;">
<tr><td class="line2"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
<tr>
    <td width="30"></td>
    <td width="16"><img src="<?=$shop['image_path']?>/adm/ic1.gif"></td>
    <td class="listname">순서 정렬</td>
    <td width="79"></td>
    <td><a href="#" onclick="shopCateMove('U'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_u.gif" border="0" title="위로" alt="위로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopCateMove('D'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_d.gif" border="0" title="아래로" alt="아래로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopCateMove('T'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_t.gif" border="0" title="맨위로" alt="맨위로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopCateMove('B'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_b.gif" border="0" title="맨아래로" alt="맨아래로"></a></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
<tr>
    <td width="46"></td>
    <td class="help1">선택하신 분류명의 출력순서를 변경 합니다.</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:17px;">
<tr><td class="line2"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
<tr>
    <td width="30"></td>
    <td width="16"><img src="<?=$shop['image_path']?>/adm/ic1.gif"></td>
    <td class="listname">분류 삭제</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
<tr>
    <td width="46"></td>
    <td class="tx1">현재 선택된 분류명을</td>
    <td width="10"></td>
    <td><a href="#" onclick="shopDelete(); return false;"><img src="<?=$shop['image_path']?>/adm/delete.gif" border="0"></a></td>
    <td width="10"></td>
    <td class="tx1">합니다.</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:7px;">
<tr>
    <td width="46"></td>
    <td class="help1" style="line-height:16px;">Tip : 분류상자에서 분류명을 마우스 더블클릭<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;하셔도 삭제처리 됩니다.</td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="3"></td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="180" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="title_bg">
    <td align="center" class="listname">1단계 분류 상자</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><select id="category1" name="category1" size="2" class="select_list2" onclick="shopChange('1', this.value);" ondblclick="shopDelete();"><?=$tmp_option1?></select></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="3"></td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="180" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="title_bg">
    <td align="center" class="listname">2단계 분류 상자</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><select id="category2" name="category2" size="2" class="select_list2" onclick="shopChange('2', this.value);" ondblclick="shopDelete();"><option value="">　</option></select></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="3"></td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="180" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="title_bg">
    <td align="center" class="listname">3단계 분류 상자</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><select id="category3" name="category3" size="2" class="select_list2" onclick="shopChange('3', this.value);" ondblclick="shopDelete();"><option value="">　</option></select></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="3"></td>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td width="180" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="title_bg">
    <td align="center" class="listname">4단계 분류 상자</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><select id="category4" name="category4" size="2" class="select_list2" onclick="shopChange('4', this.value);" ondblclick="shopDelete();"><option value="">　</option></select></td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:3px;">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin:11px auto 0 auto;">
<tr>
    <td><a href="#" onclick="shopCateMove('U'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_u.gif" border="0" title="위로" alt="위로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopCateMove('D'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_d.gif" border="0" title="아래로" alt="아래로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopCateMove('T'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_t.gif" border="0" title="맨위로" alt="맨위로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopCateMove('B'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_b.gif" border="0" title="맨아래로" alt="맨아래로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopDelete(); return false;"><img src="<?=$shop['image_path']?>/adm/delete2.gif" border="0"></a></td>
</tr>
</table>
    </td>
</tr>
<tr height="1">
    <td bgcolor="#e4e4e4"></td>
    <td></td>
    <td bgcolor="#e4e4e4"></td>
    <td bgcolor="#e4e4e4"></td>
    <td bgcolor="#e4e4e4"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
<tr>
    <td><a href="#" onclick="categorySave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./category_config.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="categoryTruncate(); return false"><img src="<?=$shop['image_path']?>/adm/truncate.gif" border="0"></a></td>
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
</form>

<div class="page_bottom"></div>
</div>

<script type="text/javascript">
$(function() { <?=$shopCateInput?><?=$shopCateInputLog?> });
</script>

<?
include_once("./_bottom.php");
?>