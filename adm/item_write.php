<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "3";

if ($m == '') {

    $menu_id = "101";
    $shop['title'] = "상품 등록";

} else {

    $menu_id = "100";
    $shop['title'] = "상품 수정";

}

include_once("./_top.php");

// 상품페이지 설정
$dmshop_design_item = shop_design_item();

$colspan = "6";

// 등록
if ($m == '') {

    $item_code = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $item_code = $item_code[rand(0,25)].rand(100000000,999999999);

    // 상품
    $dmshop_item = shop_item_code($item_code);

    if ($dmshop_item['id']) {

        alert("상품코드 생성중에 일시적인 오류가 발생되었습니다.\\n\\n다시 시도하여 주시기 바랍니다.");

    }

    $dmshop_item['item_code'] = $item_code;

    $dmshop_item['item_delivery_text'] = $dmshop['item_delivery_text']; // 기본 배송
    $dmshop_item['item_refund_text'] = $dmshop['item_refund_text']; // 기본 반품

    // 항목을 환경설정에서 불러옴
    $dmshop_item['item_option1'] = $dmshop_design_item['item_option1'];
    $dmshop_item['item_option2'] = $dmshop_design_item['item_option2'];
    $dmshop_item['item_option3'] = $dmshop_design_item['item_option3'];
    $dmshop_item['item_option4'] = $dmshop_design_item['item_option4'];
    $dmshop_item['item_option5'] = $dmshop_design_item['item_option5'];
    $dmshop_item['item_option6'] = $dmshop_design_item['item_option6'];
    $dmshop_item['item_option7'] = $dmshop_design_item['item_option7'];
    $dmshop_item['item_option8'] = $dmshop_design_item['item_option8'];
    $dmshop_item['item_option9'] = $dmshop_design_item['item_option9'];
    $dmshop_item['item_option10'] = $dmshop_design_item['item_option10'];

    $dmshop_item['item_position'] = "0"; // 상품 출력 순서
    $dmshop_item['item_price_use'] = "0"; // 시중가 사용유무
    $dmshop_item['item_price'] = ""; // 시중가
    $dmshop_item['item_money'] = ""; // 판매가격
    $dmshop_item['item_cash'] = ""; // 적립금
    $dmshop_item['item_option_use'] = "0"; // 옵션 사용유무
    $dmshop_item['item_limit'] = "9999"; // 기본 판매수량
    $dmshop_item['item_use'] = "0"; // 판매상태

    $dmshop_item['item_filedefault_use'] = "0"; // 기본상품목록 이미지 사용유무
    $dmshop_item['item_fileplan_use'] = "0"; // 기획전 목록 이미지 사용유무
    $dmshop_item['item_gallery_use'] = "0"; // 갤러리 사용유무

    $dmshop_item['item_delivery'] = $dmshop['delivery_money']; // 배송비
    $dmshop_item['item_delivery_bunch'] = 1; // 묶음배송여부

}

// 수정
else if ($m == 'u') {

    if (!$item_id) {

        alert("상품이 삭제되었거나 존재하지 않습니다.");

    }

    // 상품
    $dmshop_item = shop_item($item_id);

    if (!$dmshop_item['id']) {

        alert("상품이 삭제되었거나 존재하지 않습니다.");

    }

    $dmshop_item['item_filedefault_use'] = "1"; // 기본상품목록 이미지 사용유무
    $dmshop_item['item_fileplan_use'] = "1"; // 기획전 목록 이미지 사용유무
    $dmshop_item['item_gallery_use'] = "1"; // 갤러리 사용유무

    /*--------------------------------
        ## 옵션 ##
    --------------------------------*/

    $tmp_list_html = "";
    $tmp_list_add = "";

    $k = "0";
    $item_option = false;
    $result = sql_query(" select * from $shop[item_option_table] where item_id = '".$item_id."' order by option_position asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        if ($row['id']) {

            $k++;
            $item_option = true;

            $tmp_list_html .= "";
            $tmp_list_html .= "var list".$k."_id = '".$row['id']."';\n";
            $tmp_list_html .= "var list".$k."_mode = '".$row['option_mode']."';";
            $tmp_list_html .= "var list".$k."_name = '".addslashes($row['option_name'])."';\n";
            $tmp_list_html .= "var list".$k."_money = '".$row['option_money']."';\n";
            $tmp_list_html .= "var list".$k."_limit = '".$row['option_limit']."';\n";
            $tmp_list_html .= "var list".$k."_position = '".$k."';\n";

            $tmp_list_add .= "";
            $tmp_list_add .= "listAdd('edit', '".$k."', '".$row['id']."');\n";

        }

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 내용이 없을 경우 br 코드 심는다.
//if (!$dmshop_item['item_text']) { $dmshop_item['item_text'] = "<br />"; }
//if (!$dmshop_item['item_delivery_text']) { $dmshop_item['item_delivery_text'] = "<br />"; }
//if (!$dmshop_item['item_refund_text']) { $dmshop_item['item_refund_text'] = "<br />"; }

/*--------------------------------
    ## 기본 환경 설정 ##
--------------------------------*/

// 이미지 설정
$dmshop_image = shop_design_image();

// 대표 이미지
if ($dmshop_design_item['image_default_use'] == '0') { $dmshop_design_item['image_default_width'] = shop_split("|", $dmshop_design_item['image_default'], "0"); $dmshop_design_item['image_default_height'] = shop_split("|", $dmshop_design_item['image_default'], "1"); } else { $dmshop_design_item['image_default_width'] = $dmshop_design_item['image_default_width']; $dmshop_design_item['image_default_height'] = $dmshop_design_item['image_default_height']; }

// 기획전
if ($dmshop_image['image_plan_use'] == '0') { $dmshop_image['thumb_plan_width'] = shop_split("|", $dmshop_image['image_plan'], "0"); $dmshop_image['thumb_plan_height'] = shop_split("|", $dmshop_image['image_plan'], "1"); } else { $dmshop_image['thumb_plan_width'] = $dmshop_image['image_plan_width']; $dmshop_image['thumb_plan_height'] = $dmshop_image['image_plan_height']; }

// 갤러리 첨부 갯수
$dmshop['gallery_file_count'] = 10;

/*--------------------------------
    ## 분류 ##
--------------------------------*/

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
        $tmp_shopCateInput_value0 .= "update:%:".$row['id'].":%:".addslashes($row['subject']).":%:".$row['category'].":%:".$row['code']."|%|";

    }

    // 초기화
    $shopCateInput_value = "";

    // 데이터
    $result2 = sql_query(" select * from $shop[category_table] where code = '".$row['id']."' order by position asc, id asc ");
    for ($k=0; $code=sql_fetch_array($result2); $k++) {

        $shopCateInput_value .= "update:%:".$code['id'].":%:".addslashes($code['subject']).":%:".$code['category'].":%:".$code['code']."|%|";

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
.contents_box {min-width:1100px;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    shopTop();
    deliveryBunch('<?=$dmshop_item['item_delivery_bunch']?>');

    $(".tip1").simpletip({ content: '판매상품의 상품명 또는 서비스명 입력합니다. 특수문자는 가급적 자제를 바랍니다. (특수문자 사용시 결제시 오류가 발생될 수 있음)' });
    $(".tip2").simpletip({ content: '상품 검색시 사용될 키워드를 입력합니다. 예) 나이키, 운동화, 에어' });
    $(".tip3").simpletip({ content: '각 상품별로 독립적으로 존재하는 상품코드입니다. 자동생성을 권장합니다.' });
    $(".tip4").simpletip({ content: '현재 상품이 등록될 분류를 선택합니다. 하위 분류가 있을 경우 최종 분류까지 선택하는 것을 권장합니다.' });
    $(".tip5").simpletip({ content: '현재 상품을 선택한 기획전에 전시합니다.' });
    $(".tip6").simpletip({ content: '상품 제목과 함께 표시될 아이콘을 선택합니다. 혜택별 검색에도 사용됩니다.' });
    $(".tip7").simpletip({ content: '숫자가 높을수록 앞에 출력 99, 숫자가 낮을수록 뒤에 출력 -99, 기본 설정값 0일 경우 최근등록 상품이 우선 출력됩니다.' });
    $(".tip8").simpletip({ content: '시중에서 유통되는 가격을 말하며, 싸게 보이기 위해 사용합니다.<br />예:) 시중가 10,000원 → 판매가격 6,000원 (콤마는 입력하지 않아도 됩니다.)' });
    $(".tip9").simpletip({ content: '상품이 실제로 결제되는 금액을 입력합니다.' });
    $(".tip10").simpletip({ content: '상품 구매시 구매자에게 지급되는 적립금을 입력합니다. 적립금은 주문자가 구매확정을 하였을 경우 지급됩니다.' });
    $(".tip11").simpletip({ content: '현재 상품에 주문옵션 기능을 설정합니다.' });
    $(".tip12").simpletip({ content: '입력된 수량 소진시 상품을 주문할 수 없습니다.<br />단, 위의 ‘주문 옵션’을 사용할 경우 주문 옵션 상자에만 재고를 입력하세요.' });
    $(".tip13").simpletip({ content: '상품의 판매상태를 선택합니다. 일시중지, 품절, 숨김의 경우 상품을 주문할 수 없습니다.' });
    $(".tip14").simpletip({ content: '상품 상세정보 상단에 출력되는, 별도 안내 기능입니다.<br />안내 글의 자동완성 기능은 디자인 설정 > 상품페이지 설정에서 변경합니다.<br />안내글이 입력되어 있어도, 내용을 입력하지 않으시면 표기 되지 않습니다.' });
    $(".tip15").simpletip({ content: '현재 상품의 상세 정보를 입력합니다.' });
    $(".tip16").simpletip({ content: '현재 상품의 개별 배송 안내를 입력합니다.' });
    $(".tip17").simpletip({ content: '현재 상품의 개별 환불 규정을 입력합니다.' });
    $(".tip18").simpletip({ content: '현재 상품의 대표이미지를 등록하세요.<br /><br />- 대표이미지는 각각 페이지의 상품정보를 보여줄 때 사용됩니다.<br />- 설정크기의 이미지보다 크거나 작은 이미지를 첨부할 경우, 첨부한 원본 크기의 썸네일 이미지를 생성/적용합니다.<br />- 설정크기의 이미지 사이즈는 관리자 모드의 ‘디자인 > 상품 페이지’ 란에서 변경하실 수 있습니다.<br />- 썸네일의 이미지 가로/세로 축소비율이 맞지 않는다면, 외부 이미지 프로그램을 통해 동일한 비율의 크기로 만들어 첨부하시기 바랍니다.' });
    $(".tip19").simpletip({ content: '상품 목록에서 보여질 이미지를 등록하세요.<br />상품목록에서 연속적으로 보여지는 이미지 입니다.<br />설정크기의 이미지보다 크거나, 작은 이미지를 첨부할 경우, 설정값과 동일한 썸네일 이미지를 생성/적용 합니다.' });
    $(".tip20").simpletip({ content: '기획전 목록에서 보여질 이미지를 등록하세요.' });
    $(".tip21").simpletip({ content: '갤러리 모드에서 보여지는 이미지를 첨부 합니다. 가로, 세로 비율이 동일한 이미지를 삽입하시는것이 보기에 좋습니다.' });
    $(".tip22").simpletip({ content: '묶음배송 사용안함으로 설정시 배송비를 상품마다 추가할 수 있습니다.' });
    $(".tip23").simpletip({ content: '묶음배송 사용안함으로 설정시 배송비를 상품마다 추가할 수 있으며, 묶음배송 사용시에는 기본 배송비로 설정됩니다.' });

});

function deliveryBunch(id)
{

    if (id == '0') {

        $('#item_delivery').removeAttr('readonly').css( { 'background-color' : '#ffffff'} );

    } else {

        $('#item_delivery').attr('readonly', true).css( { 'background-color' : '#f7f7f7'} );

    }

}
</script>

<script type="text/javascript">
function smarteditorImageAdd(irid, date, fileame)
{

    var sHTML = "<img src='<?=$shop['smarteditor_data']?>"+"/"+date+"/"+fileame+"' border='0'><p><br></p>";
    oEditors.getById[irid].exec("PASTE_HTML", [sHTML]);

}
</script>

<script type="text/javascript" src="<?=$shop['smarteditor_path']?>/js/HuskyEZCreator.js" charset="utf-8"></script>

<script type="text/javascript" src="<?=$shop['path']?>/js/category.js"></script>

<script type="text/javascript">
function itemSave()
{

    oEditors.getById["item_text"].exec("UPDATE_CONTENTS_FIELD", []);
    oEditors.getById["item_delivery_text"].exec("UPDATE_CONTENTS_FIELD", []);
    oEditors.getById["item_refund_text"].exec("UPDATE_CONTENTS_FIELD", []);

    var f = document.formItem;

    if (f.item_delivery_bunch[0].checked == true) {

        if (f.item_delivery.value == '' || f.item_delivery.value == '0') {

            alert("배송비를 설정하여주세요.");
            f.item_delivery.focus();
            return false;

        }

    }

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./item_write_update.php";
    f.submit();

}
</script>

<div id="update_data" style="display:none;"></div>

<form method="post" name="formUpdate" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" name="relation_id" value="" />
</form>

<div class="contents_box">
<? if ($m == 'u') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_title_bg">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td><img src="<?=$shop['image_path']?>/adm/category_ic1.gif" align="absmiddle"></td>
    <td width="10"></td>
    <td class="listname"><?=text(shop_category_name($dmshop_item['category1']));?></span></td>
</tr>
</table>
    </td>
    <td width="300" align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$shop['image_path']?>/adm/blank.gif" class="down1"></td>
    <td width="10"></td>
    <td><a href="<?=$shop['path']?>/item.php?id=<?=$dmshop_item['item_code']?>" class="listname" target="_blank">화면 새창보기</a></td>
    <td width="20"></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>
<? } ?>

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

<input type="hidden" id="subject" name="subject" value="" />
<input type="hidden" id="ch_subject" name="ch_subject" value="" />

<form method="post" name="formItem" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="item_id" value="<?=$item_id?>" />

<input type="hidden" id="list_number" name="list_number" value="0" />
<input type="hidden" id="list_count" name="list_count" value="0" />
<input type="hidden" id="list_layer_count" name="list_layer_count" value="0" />

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
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상품명 / 분류 / 전시 / 아이콘 / 출력순서 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip1">상품명</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="item_title" name="item_title" value="<?=text($dmshop_item['item_title']);?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:200px;" /></td>
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
    <td class="subject"><span class="tip2">키워드</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="item_keyword" value="<?=text($dmshop_item['item_keyword'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:400px;" /></td>
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
    <td class="subject"><span class="tip3">상품코드</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<? if ($m == '') { ?>
<input type="hidden" id="item_code_chk" name="item_code_chk" value="" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="item_code_use" value="1" onclick="shopElementFocus('formItem', 'item_code_use', '0'); itemcodeReset();" class="radio" checked /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_code_use', '0'); itemcodeReset();">자동생성</td>
    <td width="7"></td>
    <td><input type="text" id="item_code1" name="item_code1" value="<?=text($dmshop_item['item_code'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:80px; background-color:#f0f0f0;" readonly /></td>
    <td width="30"></td>
    <td><input type="radio" name="item_code_use" value="2" onclick="shopElementFocus('formItem', 'item_code_use', '1');" class="radio" /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_code_use', '1');">수동입력 (10자리)</td>
    <td width="7"></td>
    <td><input type="text" id="item_code2" name="item_code2" value="" maxlength="10" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" onclick="shopElementFocus('formItem', 'item_code_use', '1');" class="input" style="width:80px;" /></td>
    <td width="5"></td>
    <td><a href="#" onclick="itemcodeCheck(); return false;"><img src="<?=$shop['image_path']?>/adm/check.gif" border="0"></a></td>
    <td width="13"></td>
    <td class="help1"><span id="item_code_msg"></span></td>
</tr>
</table>

<script type="text/javascript">
$("#item_code_chk").val("");

function itemcodeCheck()
{

    var item_code = $("#item_code2").val();

    if (!item_code) {

        alert("생성할 상품코드를 입력하세요.");
        $("#item_code2").focus();
        return false;

    }

    $.post("./item_write_code_check.php", {"item_code" : item_code}, function(data) {

        $("#update_data").html(data);

    });

}

function itemcodeReset()
{

    var f = document.formItem;

    f.item_code_chk.value = "";
    f.item_code2.value = "";
    $("#item_code_msg").html("각 상품들마다 독립적으로 존재하는 상품코드. 자동설정 권장");

}
</script>
<? } else { ?>
<input type="hidden" name="item_code" value="<?=text($dmshop_item['item_code'])?>" />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="tx2"><?=text($dmshop_item['item_code'])?></td>
</tr>
</table>
<? } ?>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip4">상품 분류</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-left:1px solid #e4e4e4; border-right:1px solid #e4e4e4;">
<tr class="title_bg">
    <td align="center" class="listname">1차 분류 선택</td>
</tr>
</table>

<select id="category1" name="category1" size="2" class="select_list" style="border-bottom:0px;" onclick="shopChange('1', this.value);" ><?=$tmp_option1?></select>
    </td>
    <td width="10"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-left:1px solid #e4e4e4; border-right:1px solid #e4e4e4;">
<tr class="title_bg">
    <td align="center" class="listname">2차 분류 선택</td>
</tr>
</table>

<select id="category2" name="category2" size="2" class="select_list" style="border-bottom:0px;" onclick="shopChange('2', this.value);" ><option value="">　</option></select>
    </td>
    <td width="10"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-left:1px solid #e4e4e4; border-right:1px solid #e4e4e4;">
<tr class="title_bg">
    <td align="center" class="listname">3차 분류 선택</td>
</tr>
</table>

<select id="category3" name="category3" size="2" class="select_list" style="border-bottom:0px;" onclick="shopChange('3', this.value);" ><option value="">　</option></select>
    </td>
    <td width="10"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-left:1px solid #e4e4e4; border-right:1px solid #e4e4e4;">
<tr class="title_bg">
    <td align="center" class="listname">4차 분류 선택</td>
</tr>
</table>

<select id="category4" name="category4" size="2" class="select_list" style="border-bottom:0px;" onclick="shopChange('4', this.value);" ><option value="">　</option></select>
   </td>
</tr>
</table>

<script type="text/javascript">
$(function() { <?=$shopCateInput?><?=$shopCateInputLog?> });
</script>

<script type="text/javascript">
var categoryValue1 = "<?=$dmshop_item['category1']?>";
var categoryValue2 = "<?=$dmshop_item['category2']?>";
var categoryValue3 = "<?=$dmshop_item['category3']?>";
var categoryValue4 = "<?=$dmshop_item['category4']?>";
</script>

<script type="text/javascript">
$(function() { <? if ($dmshop_item['category1']) { ?>shopChange('1', categoryValue1);<? } ?><? if ($dmshop_item['category2']) { ?>shopChange('2', categoryValue2);<? } ?><? if ($dmshop_item['category3']) { ?>shopChange('3', categoryValue3);<? } ?><? if ($dmshop_item['category4']) { ?>shopChange('4', categoryValue4);<? } ?> });
</script>

<script type="text/javascript">
$(function() { <? if ($dmshop_item['category1']) { ?>$("#category1").val(categoryValue1);<? } ?><? if ($dmshop_item['category2']) { ?>$("#category2").val(categoryValue2);<? } ?><? if ($dmshop_item['category3']) { ?>$("#category3").val(categoryValue3);<? } ?><? if ($dmshop_item['category4']) { ?>$("#category4").val(categoryValue4);<? } ?> });
</script>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip5">기획전 전시</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr height='25'>
<?
// 가로 갯수
$mod = "5";

// 기획전 리스트
$result = sql_query(" select * from $shop[plan_table] order by position desc, datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $checked = false;

    // 상품 수정 때만
    if ($m == 'u') {

        // 기획전 상품
        $dmshop_plan_item = shop_plan_item($row['id'], $item_id);

        // 있다
        if ($dmshop_plan_item['id']) {

            $checked = true;

        }

    }

    if ($i && $i%$mod == '0') {

        echo "</tr>\n<tr height='25'>\n";

    }

    if ($i%$mod >= '1') {

        echo "<td width='50'></td>";

    }

    echo "<td>";
?>
<table border='0' cellspacing='0' cellpadding='0'>
<tr>
    <td><input type="checkbox" id="plan_insert_<?=$row['id']?>" name="plan_insert[<?=$row['id']?>]" value="1" class="checkbox" <? if ($checked) { echo 'checked'; } ?> /></td>
    <td width='3'></td>
    <td class='tx2' onclick="shopElementCheckID('plan_insert_<?=$row['id']?>');"><?=text($row['title'])?></td>
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
    
            echo "<td width='50'></td>";
    
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
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip6">상품 아이콘</span></td>
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

    if (stristr($dmshop_item['item_icon'], "|".$row['id']."|")) {

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
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip7">상품진열 선호도</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="item_position" value="<?=$dmshop_item['item_position']?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:80px;" /></td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 판매가격 / 주문옵션 / 재고 / 판매상태 설정 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip8">시중 가격</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="item_price_use" value="0" class="radio" <? if ($dmshop_item['item_price_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_price_use', '0');">사용안함</td>
    <td width="30"></td>
    <td><input type="radio" name="item_price_use" value="1" class="radio" <? if ($dmshop_item['item_price_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_price_use', '1');">사용</td>
    <td width="7"></td>
    <td><input type="text" name="item_price" value="<?=text($dmshop_item['item_price'])?>" onfocus="shopInfocus1(this); shopElementFocus('formItem', 'item_price_use', '1');" onblur="shopOutfocus1(this);" class="input" style="width:80px;" /></td>
    <td width="5"></td>
    <td class="tx2">원</td>
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
    <td class="subject"><span class="tip9">판매 가격</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="item_money" value="<?=text($dmshop_item['item_money'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:80px;" /></td>
    <td width="5"></td>
    <td class="tx2">원</td>
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
    <td class="subject"><span class="tip10">적립금</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" name="item_cash" value="<?=text($dmshop_item['item_cash'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:80px;" /></td>
    <td width="5"></td>
    <td class="tx2">원</td>
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
    <td class="subject"><span class="tip22">묶음배송</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="item_delivery_bunch" value="0" class="radio" onclick="deliveryBunch('0');" <? if ($dmshop_item['item_delivery_bunch'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_delivery_bunch', '0'); deliveryBunch('0');">사용안함</td>
    <td width="30"></td>
    <td><input type="radio" name="item_delivery_bunch" value="1" class="radio" onclick="deliveryBunch('1'); $('#item_delivery').val('<?=text($dmshop['delivery_money'])?>');" <? if ($dmshop_item['item_delivery_bunch'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_delivery_bunch', '1'); deliveryBunch('1'); $('#item_delivery').val('<?=text($dmshop['delivery_money'])?>');">사용</td>
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
    <td class="subject"><span class="tip23">추가배송비</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="item_delivery" name="item_delivery" value="<?=text($dmshop_item['item_delivery'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:80px;" /></td>
    <td width="5"></td>
    <td class="tx2">원</td>
    <td width="10"></td>
    <td class="help1">(기본 배송비 <?=number_format($dmshop['delivery_money'])?>원)</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip11">주문 옵션</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<script type="text/javascript">
function itemoptionLayer(mode)
{

    if (mode == '1') {

        document.getElementById("item_option_layer").style.display = "inline";
        document.getElementById("item_limit").disabled = true;
        document.getElementById("item_limit").style.backgroundColor = "#f1f1f1";

    } else {

        document.getElementById("item_option_layer").style.display = "none";
        document.getElementById("item_limit").disabled = false;
        document.getElementById("item_limit").style.backgroundColor = "#ffffff";

    }

}
</script>

<div style="padding:20px 0 20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="item_option_use" value="0" onclick="itemoptionLayer('0');" class="radio" <? if ($dmshop_item['item_option_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_option_use', '0'); itemoptionLayer('0');">사용안함</td>
    <td width="30"></td>
    <td><input type="radio" name="item_option_use" value="1" onclick="itemoptionLayer('1');" class="radio" <? if ($dmshop_item['item_option_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_option_use', '1'); itemoptionLayer('1');">사용</td>
</tr>
</table>

<div id="item_option_layer" <? if ($dmshop_item['item_option_use'] == '0') { echo "style='display:none;'"; } else { echo "style='display:inline;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="3" height="8"></td></tr>
<tr><td colspan="3" height="2" bgcolor="#959595"></td></tr>
<tr>
    <td width="1" bgcolor="#c0c0c0"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="30" bgcolor="#f5f5f5" align="center" class="option_bg obtitle">:: 주문 옵션 상자 ::</td>
</tr>
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
<tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="24" bgcolor="#3a445b">
    <td width="73" align="center" class="obtitle2">순번</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/option_line.gif"></td>
    <td width="178" align="center" class="obtitle2">옵션명</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/option_line.gif"></td>
    <td width="116" align="center" class="obtitle2">차액</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/option_line.gif"></td>
    <td align="center" class="obtitle2">재고수량</td>
</tr>
</table>
    </td>
</tr>
<tr>
    <td bgcolor="#fafafa"><div style="padding:0 5px;"><table id="listAdd" cellpadding="0" cellspacing="0" border="0" style="display:inline;"></table></div></td>
</tr>
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#fafafa" class="none">&nbsp;</td></tr>
<tr height="34" bgcolor="#f5f5f5">
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td class="tx8">옵션 항목</td>
    <td width="10"></td>
    <td><a href="#" onclick="listAdd('new', '', ''); return false;"><img src="<?=$shop['image_path']?>/adm/option_add.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="listClose(); return false;"><img src="<?=$shop['image_path']?>/adm/option_del.gif" border="0"></a></td>
    <td width="10"></td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#c0c0c0"></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#c0c0c0"></td></tr>
</table>
</div>

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
    
            return false;
    
        }

    }

    var list_num = parseInt(document.getElementById("list_number").value) + 1;

    document.getElementById("list_number").value = list_num;

    var id = document.getElementById("listAdd");
    var objRow = id.insertRow(id.rows.length);
    var objCell = objRow.insertCell(0);

    var list_html = "";

    list_html += "<div id='list"+number+"_layer' style='display:inline;'>";
    list_html += "<table border='0' cellspacing='0' cellpadding='0'>";
    list_html += "<input type='hidden' id='list"+number+"_id' name='list"+number+"_id' value='' />";
    list_html += "<input type='hidden' id='list"+number+"_mode' name='list"+number+"_mode' value='1' />";
    list_html += "<tr height='34'>";
    list_html += "<td width='10'></td>";
    list_html += "<td><input type='text' id='list"+number+"_position' name='list"+number+"_position' class='input' style='width:40px;' value='"+list_num+"' /></td>";
    list_html += "<td width='10'></td>";
    list_html += "<td width='1'></td>";
    list_html += "<td width='10'></td>";
    list_html += "<td><input type='text' id='list"+number+"_name' name='list"+number+"_name' class='input' style='width:150px;' value='' /></td>";
    list_html += "<td width='10'></td>";
    list_html += "<td width='1'></td>";
    list_html += "<td width='10'></td>";
    list_html += "<td><input type='text' id='list"+number+"_money' name='list"+number+"_money' class='input' style='width:70px;' value='' /></td>";
    list_html += "<td width='7'></td>";
    list_html += "<td><span class='tx2'>원</span></td>";
    list_html += "<td width='10'></td>";
    list_html += "<td width='1'></td>";
    list_html += "<td width='10'></td>";
    list_html += "<td><input type='text' id='list"+number+"_limit' name='list"+number+"_limit' class='input' style='width:70px;' value='' /></td>";
    list_html += "<td width='7'></td>";
    list_html += "<td><span class='tx2'>개</span></td>";
    list_html += "<td width='10'></td>";
    list_html += "</tr>";
    list_html += "<tr><td colspan='19' height='1' bgcolor='#efefef'></td></tr>";
    list_html += "</table>";
    list_html += "</div>";

    objCell.innerHTML = list_html;

    if (mode == 'edit') {

        listEdit(mode, number, list_id);

    }

}

function listEdit(mode, number, list_id)
{

    document.getElementById("list"+number+"_id").value = eval("list"+number+"_id");
    document.getElementById("list"+number+"_mode").value = eval("list"+number+"_mode");
    document.getElementById("list"+number+"_name").value = eval("list"+number+"_name");
    document.getElementById("list"+number+"_money").value = eval("list"+number+"_money");
    document.getElementById("list"+number+"_limit").value = eval("list"+number+"_limit");
    document.getElementById("list"+number+"_position").value = eval("list"+number+"_position");

    var list_count = document.getElementById("list_count").value;

    var tmp_list_number = parseInt(list_count);

    var list_number = tmp_list_number + 1;

    // 1 증가
    document.getElementById("list_count").value = list_number;
    document.getElementById("list_layer_count").value = list_number;

}

function listClose()
{

    var list_layer_count = document.getElementById("list_layer_count").value;

    if (list_layer_count <= '1') {

        return false;

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
        return false;

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

<? if ($m == '' || $m == 'u' && !$item_option) { ?>
<script type="text/javascript">
$(function() {

    listAdd("new", "", "");
    listAdd("new", "", "");

});
</script>
<? } ?>

<? if ($m == 'u') { ?>
<script type="text/javascript">
<?=$tmp_list_html?>
<?=$tmp_list_add?>
</script>
<? } ?>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip12">재고 수량</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="text" id="item_limit" name="item_limit" value="<?=text($dmshop_item['item_limit'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:80px;" /></td>
    <td width="5"></td>
    <td class="tx2">개</td>
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
    <td class="subject"><span class="tip13">판매 상태</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="item_use" value="0" class="radio" <? if ($dmshop_item['item_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_use', '0');">판매가능</td>
    <td width="30"></td>
    <td><input type="radio" name="item_use" value="1" class="radio" <? if ($dmshop_item['item_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_use', '1');">일시중지</td>
    <td width="30"></td>
    <td><input type="radio" name="item_use" value="2" class="radio" <? if ($dmshop_item['item_use'] == '2') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_use', '2');">품절</td>
    <td width="30"></td>
    <td><input type="radio" name="item_use" value="3" class="radio" <? if ($dmshop_item['item_use'] == '3') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_use', '3');">숨김</td>
    <td width="10"></td>
    <td class="help1"></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상품 안내 / 상세 정보 / 배송 및 환불 / 관련상품 안내 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip14">상품 안내</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="45" class="tx2">안내1</td>
    <td><input type="text" name="item_option1" value="<?=text($dmshop_item['item_option1'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="20"></td>
    <td class="tx2">내용</td>
    <td width="10"></td>
    <td><input type="text" name="item_option1_text" value="<?=text($dmshop_item['item_option1_text'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:185px;" /></td>
    <td width="40"></td>
    <td width="45" class="tx2">안내2</td>
    <td><input type="text" name="item_option2" value="<?=text($dmshop_item['item_option2'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="20"></td>
    <td class="tx2">내용</td>
    <td width="10"></td>
    <td><input type="text" name="item_option2_text" value="<?=text($dmshop_item['item_option2_text'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:185px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="45" class="tx2">안내3</td>
    <td><input type="text" name="item_option3" value="<?=text($dmshop_item['item_option3'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="20"></td>
    <td class="tx2">내용</td>
    <td width="10"></td>
    <td><input type="text" name="item_option3_text" value="<?=text($dmshop_item['item_option3_text'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:185px;" /></td>
    <td width="40"></td>
    <td width="45" class="tx2">안내4</td>
    <td><input type="text" name="item_option4" value="<?=text($dmshop_item['item_option4'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="20"></td>
    <td class="tx2">내용</td>
    <td width="10"></td>
    <td><input type="text" name="item_option4_text" value="<?=text($dmshop_item['item_option4_text'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:185px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="45" class="tx2">안내5</td>
    <td><input type="text" name="item_option5" value="<?=text($dmshop_item['item_option5'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="20"></td>
    <td class="tx2">내용</td>
    <td width="10"></td>
    <td><input type="text" name="item_option5_text" value="<?=text($dmshop_item['item_option5_text'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:185px;" /></td>
    <td width="40"></td>
    <td width="45" class="tx2">안내6</td>
    <td><input type="text" name="item_option6" value="<?=text($dmshop_item['item_option6'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="20"></td>
    <td class="tx2">내용</td>
    <td width="10"></td>
    <td><input type="text" name="item_option6_text" value="<?=text($dmshop_item['item_option6_text'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:185px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="45" class="tx2">안내7</td>
    <td><input type="text" name="item_option7" value="<?=text($dmshop_item['item_option7'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="20"></td>
    <td class="tx2">내용</td>
    <td width="10"></td>
    <td><input type="text" name="item_option7_text" value="<?=text($dmshop_item['item_option7_text'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:185px;" /></td>
    <td width="40"></td>
    <td width="45" class="tx2">안내8</td>
    <td><input type="text" name="item_option8" value="<?=text($dmshop_item['item_option8'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="20"></td>
    <td class="tx2">내용</td>
    <td width="10"></td>
    <td><input type="text" name="item_option8_text" value="<?=text($dmshop_item['item_option8_text'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:185px;" /></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td width="45" class="tx2">안내9</td>
    <td><input type="text" name="item_option9" value="<?=text($dmshop_item['item_option9'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="20"></td>
    <td class="tx2">내용</td>
    <td width="10"></td>
    <td><input type="text" name="item_option9_text" value="<?=text($dmshop_item['item_option9_text'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:185px;" /></td>
    <td width="40"></td>
    <td width="45" class="tx2">안내10</td>
    <td><input type="text" name="item_option10" value="<?=text($dmshop_item['item_option10'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:100px;" /></td>
    <td width="20"></td>
    <td class="tx2">내용</td>
    <td width="10"></td>
    <td><input type="text" name="item_option10_text" value="<?=text($dmshop_item['item_option10_text'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:185px;" /></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip15">상품 상세 정보</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table width="840" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><textarea id="item_text" name="item_text" class="textarea1" style="width:838px; height:400px;"><?=text($dmshop_item['item_text']);?></textarea></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip16">개별 배송 안내</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table width="840" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
<tr>
    <td><textarea id="item_delivery_text" name="item_delivery_text" class="textarea1" style="width:838px; height:125px;"><?=text($dmshop_item['item_delivery_text']);?></textarea></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip17">개별 환불 규정</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:10px 0 10px 0;">
<table width="840" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><textarea id="item_refund_text" name="item_refund_text" class="textarea1" style="width:838px; height:125px;"><?=text($dmshop_item['item_refund_text']);?></textarea></td>
</tr>
</table>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr><td colspan="<?=$colspan?>" height="1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 상품 이미지 / 포토 갤러리 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip18">대표 이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<?
$file = shop_item_file($item_id, "default");
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_default" class="file" size="35" /></td>
<? if ($file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_item.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_default" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
<? } ?>
    <td width="10"></td>
    <td><span class="help2">설정크기 : </span><span class="help3">가로 <?=text($dmshop_design_item['image_default_width'])?>px / 세로 <?=text($dmshop_design_item['image_default_height'])?>px</span></td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject" style="line-height:18px;"><span class="tip19">기본 상품목록<br>이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<script type="text/javascript">
function itemfiledefaultLayer(mode)
{

    if (mode == '1') {

        $("#item_filedefault_layer").show();

    } else {

        $("#item_filedefault_layer").hide();

    }

}
</script>

<div style="padding:10px 0 10px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="item_filedefault_use" value="0" onclick="itemfiledefaultLayer('0');" class="radio" <? if ($dmshop_item['item_filedefault_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_filedefault_use', '0'); itemfiledefaultLayer('0');">대표 이미지로 부터 자동생성</td>
    <td width="30"></td>
    <td><input type="radio" name="item_filedefault_use" value="1" onclick="itemfiledefaultLayer('1');" class="radio" <? if ($dmshop_item['item_filedefault_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_filedefault_use', '1'); itemfiledefaultLayer('1');">다른 이미지 직접입력</td>
</tr>
</table>

<div id="item_filedefault_layer" <? if ($dmshop_item['item_filedefault_use'] == '0') { echo "style='display:none;'"; } else { echo "style='display:inline;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="10"></td>
</tr>
</table>

<?
$file = shop_item_file($item_id, "category");
?>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_category" class="file" size="35" /></td>
<? if ($file['upload_file']) { ?>
    <td width="10"></td>
    <td><a href="./download_item.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_category" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
<? } ?>
    <td width="10"></td>
</tr>
</table>
</div>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject" style="line-height:18px;"><span class="tip20">기획전 목록<br>이미지</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<script type="text/javascript">
function itemfileplanLayer(mode)
{

    if (mode == '1') {

        $("#item_fileplan_layer").show();

    } else {

        $("#item_fileplan_layer").hide();

    }

}
</script>

<div style="padding:20px 0 20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="item_fileplan_use" value="0" onclick="itemfileplanLayer('0');" class="radio" <? if ($dmshop_item['item_fileplan_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_fileplan_use', '0'); itemfileplanLayer('0');">대표 이미지로 부터 자동생성</td>
    <td width="30"></td>
    <td><input type="radio" name="item_fileplan_use" value="1" onclick="itemfileplanLayer('1');" class="radio" <? if ($dmshop_item['item_fileplan_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_fileplan_use', '1'); itemfileplanLayer('1');">다른 이미지 직접입력</td>
</tr>
</table>

<div id="item_fileplan_layer" <? if ($dmshop_item['item_fileplan_use'] == '0') { echo "style='display:none;'"; } else { echo "style='display:inline;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="20"></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="3" height="2" bgcolor="#959595"></td></tr>
<tr>
    <td width="1" bgcolor="#c0c0c0"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td align="center" class="option_bg obtitle" style="min-width:680px;">:: 기획전 이미지 첨부상자 ::</td>
</tr>
<tr><td height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="24" bgcolor="#3a445b">
    <td colspan="2" align="center" class="obtitle2">기획전명</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/option_line.gif"></td>
    <td colspan="3" align="center" class="obtitle2">이미지 첨부</td>
</tr>
<?
// 기획전 리스트
$result = sql_query(" select * from $shop[plan_table] order by position desc, datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 통합 이미지
    if ($row['thumb_use'] == '0') {

        $row['thumb_width'] = $dmshop_image['thumb_plan_width'];
        $row['thumb_height'] = $dmshop_image['thumb_plan_height'];

    }
?>
<? if ($i > '0') { ?>
<tr><td></td><td colspan="4" height="1" bgcolor="#efefef"></td><td></td></tr>
<? } ?>
<tr height="34" bgcolor="#fafafa">
    <td width="5"></td>
    <td width="132" class="obsubject"><p style="padding-left:20px;"><?=text($row['title'])?></p></td>
    <td width="1"></td>
    <td width="10"></td>
    <td>
<div style="padding:10px 0;">
<?
$file = shop_item_file($item_id, "plan".$row['id']);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_plan<?=$row['id']?>" class="file" size="35" /></td>
    <td width="10"></td>
    <td><span class="tx8">설정크기 : </span><span class="help3">가로 <?=text($row['thumb_width'])?>px / 세로 <?=text($row['thumb_height'])?>px</span></td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="./download_item.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_plan<?=$row['id']?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td width="5"></td>
</tr>
<? } ?>
</table>
    </td>
    <td width="1" bgcolor="#c0c0c0"></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#c0c0c0"></td></tr>
</table>
</div>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip21">갤러리</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<script type="text/javascript">
function itemfilegalleryLayer(mode)
{

    if (mode == '1') {

        $("#item_filegallery_layer").show();

    } else {

        $("#item_filegallery_layer").hide();

    }

}
</script>

<div style="padding:20px 0 20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="radio" name="item_gallery_use" value="0" onclick="itemfilegalleryLayer('0');" class="radio" <? if ($dmshop_item['item_gallery_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_gallery_use', '0'); itemfilegalleryLayer('0');">사용안함</td>
    <td width="30"></td>
    <td><input type="radio" name="item_gallery_use" value="1" onclick="itemfilegalleryLayer('1');" class="radio" <? if ($dmshop_item['item_gallery_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="tx2" onclick="shopElementFocus('formItem', 'item_gallery_use', '1'); itemfilegalleryLayer('1');">사용</td>
</tr>
</table>

<div id="item_filegallery_layer" <? if ($dmshop_item['item_gallery_use'] == '0') { echo "style='display:none;'"; } else { echo "style='display:inline;'"; } ?>>
<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="20"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="3" height="2" bgcolor="#959595"></td></tr>
<tr>
    <td width="1" bgcolor="#c0c0c0"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td align="center" class="option_bg obtitle" style="min-width:680px;">:: 갤러리 이미지 첨부상자 ::</td>
</tr>
<tr><td height="1" bgcolor="#e4e4e4"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="24" bgcolor="#3a445b">
    <td width="65" align="center" class="obtitle2">순번</td>
    <td width="1"><img src="<?=$shop['image_path']?>/adm/option_line.gif"></td>
    <td align="center" class="obtitle2">이미지 첨부</td>
</tr>
</table>

<?
for ($i=1; $i<=$dmshop['gallery_file_count']; $i++) {

    $file = shop_item_file($item_id, "gallery".$i);
?>
<div id="item_gallery_<?=$i?>" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<? if ($i > '0') { ?>
<tr><td></td><td colspan="4" height="1" bgcolor="#efefef"></td><td></td></tr>
<? } ?>
<tr height="34" bgcolor="#fafafa">
    <td width="5"></td>
    <td width="65" class="obsubject" align="center"><?=$i?></td>
    <td width="1"></td>
    <td width="10"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_gallery<?=$i?>" class="file" size="35" /></td>
<?
if ($file['upload_file']) {
?>
    <td width="10"></td>
    <td><a href="./download_item.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_gallery<?=$i?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
<? } ?>
</tr>
</table>
    </td>
    <td width="5"></td>
</tr>
</table>
</div>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#fafafa" class="none">&nbsp;</td></tr>
<tr height="34" bgcolor="#f5f5f5">
    <td align="right">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="30">
    <td class="tx8">사진 첨부</td>
    <td width="10"></td>
    <td><a href="#" onclick="itemGallery('Add'); return false;"><img src="<?=$shop['image_path']?>/adm/option_add.gif" border="0"></a></td>
    <td width="5"></td>
    <td><a href="#" onclick="itemGallery('Del'); return false;"><img src="<?=$shop['image_path']?>/adm/option_del.gif" border="0"></a></td>
    <td width="10"></td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#c0c0c0"></td>
</tr>
<tr><td colspan="3" height="1" bgcolor="#c0c0c0"></td></tr>
</table>

<input type="hidden" name="gallery_file_count" value="<?=text($dmshop['gallery_file_count'])?>" />
<input type="hidden" id="gallery_file_number" value="0" />

<script type="text/javascript">
$("#gallery_file_number").val("0");

function itemGallery(mode)
{

    var gallery_file_number = parseInt($("#gallery_file_number").val());

    if (mode == 'Add') {

        if (gallery_file_number >= '<?=$dmshop['gallery_file_count']?>') {

            return false;

        }

        var layer_id = gallery_file_number + 1;

        $("#item_gallery_"+layer_id).show();
        $("#gallery_file_number").val(layer_id);

    } else {

        if (gallery_file_number <= '1') {

            return false;

        }

        $("#item_gallery_"+gallery_file_number).hide();
        $("#gallery_file_number").val(gallery_file_number - 1);

    }

}
</script>

<script type="text/javascript">
$(function() {

<?
for ($i=1; $i<=$dmshop['gallery_file_count']; $i++) {

    echo "itemGallery('Add');\n";

}
?>

});
</script>
</div>
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
    <td><a href="#" onclick="itemSave(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./item_list.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
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
	elPlaceHolder: "item_text",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "item_delivery_text",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "item_refund_text",
	sSkinURI: "<?=$shop['smarteditor_path']?>/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});
</script>

<?
include_once("./_bottom.php");
?>