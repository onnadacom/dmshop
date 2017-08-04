<?php
include_once("./_dmshop.php");
$top_id = "2";
$left_id = "8";
$menu_id = "201";
$shop['title'] = "메뉴 (MENU)";
include_once("./_top.php");

$colspan = "6";

// 디자인 설정
$dmshop_design = shop_design();

// 메뉴 설정
$dmshop_menu = shop_design_menu();

// 메인, 서브 권장설정
if ($dmshop_design['main_width_use'] == '0') { $dmshop_design['main_menu_width'] = shop_split("|", $dmshop_design['main_width'], "0"); $dmshop_design['main_center_width'] = shop_split("|", $dmshop_design['main_width'], "1"); }
if ($dmshop_design['sub_width_use'] == '0') { $dmshop_design['sub_menu_width'] = shop_split("|", $dmshop_design['sub_width'], "0"); $dmshop_design['sub_center_width'] = shop_split("|", $dmshop_design['sub_width'], "1"); }

// 배너 그룹
$banner_group_option = "<option value=''>:: 사용안함 ::</option>";
$result = sql_query(" select * from $shop[banner_group_table] order by group_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $banner_group_option .= "<option value='".text($row['group_id'])."'>".text($row['group_id'])."</option>";

}

// 게시판
$board_option = "<option value=''>:: 사용안함 ::</option>";
$result = sql_query(" select * from $shop[board_table] where bbs_view = '1' order by bbs_position desc, bbs_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $board_option .= "<option value='".text($row['bbs_id'])."'>".text($row['bbs_title'])."</option>";

}

// 배너 스킨
$banner_skin_option = "";
$skin_array = shop_skin_dir("banner");
for ($i=0; $i<count($skin_array); $i++) {

    $banner_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 최신글 스킨
$article_skin_option = "";
$skin_array = shop_skin_dir("article");
for ($i=0; $i<count($skin_array); $i++) {

    $article_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 상품 검색창 스킨
$searchbox_skin_option = "<option value=''>:: 사용안함 ::</option>";
$skin_array = shop_skin_dir("searchbox");
for ($i=0; $i<count($skin_array); $i++) {

    $searchbox_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 로그인박스 스킨
$loginbox_skin_option = "<option value=''>:: 사용안함 ::</option>";
$skin_array = shop_skin_dir("loginbox");
for ($i=0; $i<count($skin_array); $i++) {

    $loginbox_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 게시판
$boardbox_skin_option = "<option value=''>:: 사용안함 ::</option>";
$skin_array = shop_skin_dir("boardbox");
for ($i=0; $i<count($skin_array); $i++) {

    $boardbox_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 기획전
$planbox_skin_option = "<option value=''>:: 사용안함 ::</option>";
$skin_array = shop_skin_dir("planbox");
for ($i=0; $i<count($skin_array); $i++) {

    $planbox_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 세로메뉴바 스킨
$hmbar_skin_option = "<option value=''>직접 만들기</option>";
$skin_array = shop_skin_dir("hmbar");
for ($i=0; $i<count($skin_array); $i++) {

    $hmbar_skin_option .= "<option value='".text($skin_array[$i])."'>".text($skin_array[$i])."</option>";

}

// 최신글 정렬조건
$article_sort_option = "";
$article_sort_option .= "<option value='datetime desc'>작성일 내림차순</option>";
$article_sort_option .= "<option value='datetime asc'>작성일 오름차순</option>";
$article_sort_option .= "<option value='ar_hit desc'>조회수 내림차순</option>";
$article_sort_option .= "<option value='ar_hit asc'>조회수 오름차순</option>";
$article_sort_option .= "<option value='ar_reply desc'>댓글수 내림차순</option>";
$article_sort_option .= "<option value='ar_reply asc'>댓글수 오름차순</option>";
$article_sort_option .= "<option value='rand()'>랜덤</option>";

// 배너 정렬방식
$banner_sort_option = "";
$banner_sort_option .= "<option value='ba_datetime desc'>등록일시 내림차순</option>";
$banner_sort_option .= "<option value='ba_datetime asc'>등록일시 오름차순</option>";
$banner_sort_option .= "<option value='ba_position desc'>출력순서 내림차순</option>";
$banner_sort_option .= "<option value='ba_position asc'>출력순서 오름차순</option>";
$banner_sort_option .= "<option value='rand()'>랜덤</option>";

// 롤링횟수
$rolling_limit_option = "";
for ($i=1; $i<=10; $i++) {

    $rolling_limit_option .= "<option value='".$i."'>{$i}회</option>";

}

// 롤링시간
$rolling_time_option = "";
for ($i=1; $i<=10; $i++) {

    $rolling_time_option .= "<option value='".$i."000'>{$i}초</option>";

}
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
.contents_box .select3 .selectBox-dropdown {width:100px; height:19px;}
.contents_box .select3 .selectBox-dropdown .selectBox-label {padding:1px 5px 1px 5px;}

.contents_box .menu_bg {width:210px; height:620px; background:url('/image/shop/adm/menu_bg.gif') no-repeat;}
.contents_box .menu_list_box {padding:35px 0 0 40px;}

#menu_list_view div {margin-top:5px;}

#menu_list_view .menu_list1 {width:130px; height:35px; background:url('<?=$shop['image_path']?>/adm/left_menu_list1.gif') no-repeat;}
#menu_list_view .menu_list2 {width:130px; height:35px; background:url('<?=$shop['image_path']?>/adm/left_menu_list2.gif') no-repeat;}
#menu_list_view .menu_list3 {width:130px; height:70px; background:url('<?=$shop['image_path']?>/adm/left_menu_list3.gif') no-repeat;}
#menu_list_view .menu_list4 {width:130px; height:70px; background:url('<?=$shop['image_path']?>/adm/left_menu_list4.gif') no-repeat;}
#menu_list_view .menu_list5 {width:130px; height:70px; background:url('<?=$shop['image_path']?>/adm/left_menu_list5.gif') no-repeat;}
#menu_list_view .menu_list6 {width:130px; height:35px; background:url('<?=$shop['image_path']?>/adm/left_menu_list6.gif') no-repeat;}
#menu_list_view .menu_list7 {width:130px; height:35px; background:url('<?=$shop['image_path']?>/adm/left_menu_list7.gif') no-repeat;}
#menu_list_view .menu_list8 {width:130px; height:35px; background:url('<?=$shop['image_path']?>/adm/left_menu_list8.gif') no-repeat;}
#menu_list_view .menu_list9 {width:130px; height:35px; background:url('<?=$shop['image_path']?>/adm/left_menu_list9.gif') no-repeat;}
#menu_list_view .menu_list10 {width:130px; height:35px; background:url('<?=$shop['image_path']?>/adm/left_menu_list10.gif') no-repeat;}
#menu_list_view .menu_list11 {width:130px; height:35px; background:url('<?=$shop['image_path']?>/adm/left_menu_list11.gif') no-repeat;}
</style>

<script type="text/javascript">
$(document).ready( function() {

    shopMenuList();
    shopMenuLoad();

    $(".contents_box .select1 select").selectBox();
    $(".contents_box .select2 select").selectBox();
    $(".contents_box .select3 select").selectBox();

    $(".tip1").simpletip({ content: '메뉴 레이아웃이 적용된 모습입니다.' });
    $(".tip2").simpletip({ content: '각 메뉴를 선택하여 이동할 수 있습니다.' });
    $(".tip3").simpletip({ content: '메뉴의 여백을 설정합니다.' });
    $(".tip4").simpletip({ content: '메뉴의 배경 이미지를 설정합니다.' });
    $(".tip5").simpletip({ content: '상품 검색창 스킨을 선택합니다.' });
    $(".tip6").simpletip({ content: '로그인박스 스킨을 선택합니다.' });
    $(".tip7").simpletip({ content: '세로 메뉴바 스킨을 선택합니다.' });
    $(".tip8").simpletip({ content: '기획전 목록 스킨을 선택합니다.' });
    $(".tip9").simpletip({ content: '게시판 목록 스킨을 선택합니다.' });
    $(".tip10").simpletip({ content: '고객지원안내 이미지를 첨부합니다.' });
    $(".tip11").simpletip({ content: '무통장입금 안내 이미지를 첨부합니다.' });
    $(".tip12").simpletip({ content: '게시판 최신글을 설정합니다.' });
    $(".tip13").simpletip({ content: '배너를 설정합니다.' });
    $(".tip14").simpletip({ content: '태그를 입력합니다.' });
    $(".tip15").simpletip({ content: '로고를 첨부합니다.' });

});
</script>

<script type="text/javascript">
function shopMenuMove(type)
{

    var id = document.getElementById("menu_list");
    var index = id.selectedIndex;

    if (type == "U") {

        if (index > 0) {

            shopMennuSwap(id, index, index - 1, type);

        }

    }

    else if (type == "D") {

        if (index < id.options.length-1) {

            shopMennuSwap(id, index, index + 1, type);

        }

    }

    else if (type == "T") {

        for (var i = index; i > 0; i--) {

            shopMennuSwap(id, i, i - 1, type);

        }

    }

    else if (type == "B") {

        for (var i = index; i < id.options.length - 1; i++) {

            shopMennuSwap(id, i, i + 1, type);

        }

    }

}

function shopMennuSwap(id, index, targetIndex, type)
{

    var onetext = id.options[targetIndex].text;
    var onevalue = id.options[targetIndex].value;

    id.options[targetIndex].text = id.options[index].text;
    id.options[targetIndex].value = id.options[index].value;
    id.options[index].text = onetext;
    id.options[index].value = onevalue;
    id.options.selectedIndex = targetIndex;
    id.options[targetIndex].selected = true;

    shopMenuList();
    shopMenuLoad();

}

function shopMenuList()
{

    document.getElementById("menu_list_id").value = "";
    document.getElementById("menu_list_view").innerHTML = "";

    var id = document.getElementById("menu_list");

    for (var i=0; i<id.options.length; i++) {

        document.getElementById("menu_list_id").value = document.getElementById("menu_list_id").value + "," + id.options[i].value;
        document.getElementById("menu_list_view").innerHTML = document.getElementById("menu_list_view").innerHTML + "<div name='"+id.options[i].value+"'></div>";

    }

}

function shopMenuLoad()
{

    var m = document.getElementById("menu_list");

    for (var i=0; i<m.options.length; i++) {

        $("#menu_list_view div[name='"+m.options[i].value+"']").addClass("menu_list"+m.options[i].value);

    }

}
</script>

<script type="text/javascript">
function designSubmit()
{

    var f = document.formDesign;

    if (!confirm("저장하시겠습니까?")) {

        return false;

    }

    f.action = "./design_menu_update.php";
    f.submit();

}
</script>

<div class="contents_box">
<form method="post" name="formDesign" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="form_check" value="<?=$dmshop_user['datetime']?>" />
<input type="hidden" name="url" value="<?=$urlencode?>" />
<input type="hidden" name="m" value="" />
<input type="hidden" id="menu_list_id" name="menu_list_id" value="" />

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="">
</colgroup>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="4" class="pagetitle">:: 상단 레이아웃 ::</td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr height="230" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">메뉴 설정정보</td>
    <td class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td valign="top"><div style="border:3px solid #e4e4e4;"><img src="<?=$shop['image_path']?>/adm/layout_main<?=$dmshop_design['main_layout']?>_menu.gif"></div></td>
    <td width="20"></td>
    <td width="200" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_title">메인 디자인 설정</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">레이아웃 : <?=shop_design_layout_name("main", $dmshop_design['main_layout']);?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">매뉴스킨 : <?=shop_design_skin_name($dmshop_skin['skin_main_menu']);?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">전체가로 : <?=(int)($dmshop_design['main_menu_width'] + $dmshop_design['main_center_width'] + $dmshop_design['main_mc_width']);?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴가로 : <b style="color:#f26c4f;"><?=text($dmshop_design['main_menu_width'])?>px</b></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메인중앙 : <?=text($dmshop_design['main_center_width'])?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴, 메인중앙간 여백 : <?=text($dmshop_design['main_mc_width'])?>px</td>
</tr>
</table>
    </td>
    <td valign="top"><div style="border:3px solid #e4e4e4;"><img src="<?=$shop['image_path']?>/adm/layout_sub<?=$dmshop_design['sub_layout']?>_menu.gif"></div></td>
    <td width="20"></td>
    <td width="200" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_title">서브 디자인 설정</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">레이아웃 : <?=shop_design_layout_name("sub", $dmshop_design['sub_layout']);?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴스킨 : <?=shop_design_skin_name($dmshop_skin['skin_sub_menu']);?></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">전체가로 : <?=(int)($dmshop_design['sub_menu_width'] + $dmshop_design['sub_center_width'] + $dmshop_design['sub_mc_width']);?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴가로 : <b style="color:#f26c4f;"><?=text($dmshop_design['sub_menu_width'])?>px</b></td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">공통영역 : <?=text($dmshop_design['sub_center_width'])?>px</td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="layout_text">메뉴, 공통영역간 여백 : <?=text($dmshop_design['sub_mc_width'])?>px</td>
</tr>
</table>
    </td>
</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
<tr>
    <td width="20">&nbsp;</td>
    <td class="msg1">메인/서브 디자인 설정의 상단스킨이 ‘직접 만들기’로 선택되어야만 아래의 설정된 구성물이 100% 적용 됩니다.<br>다른 스킨이 선택되어 있을 경우, 해당 스킨의 레이아웃을 따르며, 구성물 전체 또는 일부가 적용되지 않을 수 있습니다.</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="4" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><p><span class="tip1">메뉴 레이아웃</span></p><p>(미리보기)</p></td>
    <td class="bc1"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="250" valign="top"><div class="menu_bg" style="width:210px; margin:20px auto;"><div class="menu_list_box"><div id="menu_list_view"></div></div></div></td>
    <td width="1" class="bc1"></td>
    <td valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="255">
    <td width="170" class="subject"><span class="tip2">메뉴 레이아웃</span></td>
    <td width="1" class="bc1"></td>
    <td width="20"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" colspan="3" bgcolor="#e4e4e4"></td></tr>
<tr>
    <td width="1" bgcolor="#e4e4e4"></td>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="title_bg" align="center"><span class="tx2">메뉴위치 이동 상자</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td>
<select id="menu_list" name="menu_list" size="2" class="select_list">
<?
$menu = array();
$menu[1]['name'] = "상품 검색창";
$menu[2]['name'] = "로그인 박스";
$menu[3]['name'] = "세로 메뉴바";
$menu[4]['name'] = "기획전 목록";
$menu[5]['name'] = "게시판 목록";
$menu[6]['name'] = "고객지원 안내";
$menu[7]['name'] = "무통장입금 안내";
$menu[8]['name'] = "게시판 최신글";
$menu[9]['name'] = "배너";
$menu[10]['name'] = "태그";
$menu[11]['name'] = "로고";

$text = $dmshop_menu['menu_list_id'];
$s = explode(",", $text);
for ($i=1; $i<=count($s); $i++) {

    $k = $s[$i];

    if ($k) {

        echo "<option value='".$k."'>".text($menu[$k]['name'])."</option>";

    }

}
?>
</select>
    </td>
</tr>
</table>
    </td>
    <td width="1" bgcolor="#e4e4e4"></td>
</tr>
<tr><td height="1" colspan="3" bgcolor="#e4e4e4"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="margin:10px auto 0 auto;">
<tr>
    <td><a href="#" onclick="shopMenuMove('U'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_u.gif" border="0" title="위로" alt="위로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopMenuMove('D'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_d.gif" border="0" title="아래로" alt="아래로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopMenuMove('T'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_t.gif" border="0" title="맨위로" alt="맨위로"></a></td>
    <td width="2"></td>
    <td><a href="#" onclick="shopMenuMove('B'); return false;"><img src="<?=$shop['image_path']?>/adm/btn_b.gif" border="0" title="맨아래로" alt="맨아래로"></a></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="170" class="subject"><span class="tip3">메뉴 여백</span></td>
    <td width="1" class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="20"></td>
    <td width="110" class="text1">상단여백</td>
    <td><input type="text" name="menu_margin_top" value="<?=text($dmshop_menu['menu_margin_top'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="20"></td>
    <td width="110" class="text1">좌측여백</td>
    <td><input type="text" name="menu_margin_left" value="<?=text($dmshop_menu['menu_margin_left'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="20"></td>
    <td width="110" class="text1">우측여백</td>
    <td><input type="text" name="menu_margin_right" value="<?=text($dmshop_menu['menu_margin_right'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="20"></td>
    <td width="110" class="text1">구성물간 여백</td>
    <td><input type="text" name="menu_margin_side" value="<?=text($dmshop_menu['menu_margin_side'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="20"></td>
    <td width="110" class="text1">하단 여백</td>
    <td><input type="text" name="menu_margin_bottom" value="<?=text($dmshop_menu['menu_margin_bottom'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:30px;" /></td>
    <td width="5"></td>
    <td class="text2">px</td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="170" class="subject"><span class="tip4">메뉴 배경 이미지</span></td>
    <td width="1" class="bc1"></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="20"></td>
    <td width="110" class="text1">배경 기본</td>
    <td>
<?
$upload_mode = "menu_background_default";
$file = shop_design_file($upload_mode);
?>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="20"></td>
    <td width="110" class="text1">배경 상단</td>
    <td>
<?
$upload_mode = "menu_background_top";
$file = shop_design_file($upload_mode);
?>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="20"></td>
    <td width="110" class="text1">배경 하단</td>
    <td>
<?
$upload_mode = "menu_background_bottom";
$file = shop_design_file($upload_mode);
?>
<div style="padding:20px 0;">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
    </td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<colgroup>
    <col width="20">
    <col width="150">
    <col width="1">
    <col width="30">
    <col width="">
    <col width="20">
</colgroup>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td colspan="<?=$colspan?>" class="pagetitle">:: 메뉴 구성물 ::</td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60" bgcolor="#f5f5f5">
    <td></td>
    <td class="subject">구성물 설정정보</td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td class="msg1">위에서 선택하신 메뉴 레이아웃의 구성물 위치에 보여질 메뉴바, 게시판목록, 최신글 등을 세부적으로 설정 합니다.<br>선택하신 메뉴 레이아웃에 구성물이 없을 경우에는 아래의 설정된 구성물은 불러지지 않습니다.</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip5">상품 검색창</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="menu_searchbox_skin" name="menu_searchbox_skin" class="select"><?=$searchbox_skin_option?></select>

<script type="text/javascript">
$("#menu_searchbox_skin").val("<?=text($dmshop_menu['menu_searchbox_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/searchbox</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip6">로그인 박스</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="menu_loginbox_skin" name="menu_loginbox_skin" class="select"><?=$loginbox_skin_option?></select>

<script type="text/javascript">
$("#menu_loginbox_skin").val("<?=text($dmshop_menu['menu_loginbox_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/loginbox</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip7">세로 메뉴바</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td><input type="radio" name="menu_menubar_use" value="1" class="radio" <? if ($dmshop_menu['menu_menubar_use'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'menu_menubar_use', '0');">사용</td>
    <td width="30"></td>
    <td><input type="radio" name="menu_menubar_use" value="0" class="radio" <? if ($dmshop_menu['menu_menubar_use'] == '0') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementFocus('formDesign', 'menu_menubar_use', '1');">사용안함</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="menu_menubar_skin" name="menu_menubar_skin" class="select"><?=$hmbar_skin_option?></select>

<script type="text/javascript">
$("#menu_menubar_skin").val("<?=text($dmshop_menu['menu_menubar_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/hmbar</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip8">기획전 목록</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="menu_planbox_skin" name="menu_planbox_skin" class="select"><?=$planbox_skin_option?></select>

<script type="text/javascript">
$("#menu_planbox_skin").val("<?=text($dmshop_menu['menu_planbox_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/planbox</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip9">게시판 목록</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="menu_boardbox_skin" name="menu_boardbox_skin" class="select"><?=$boardbox_skin_option?></select>

<script type="text/javascript">
$("#menu_boardbox_skin").val("<?=text($dmshop_menu['menu_boardbox_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/boardbox</td>
</tr>
</table>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip10">고객지원 안내</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<?
$upload_mode = "menu_help";
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG, SWF</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
    <td width="10"></td>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip11">무통장입금 안내</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<?
$upload_mode = "menu_bank";
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG, SWF</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
    <td width="10"></td>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
</div>
    </td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip12">게시판 최신글</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">게시판 선택</td>
    <td class="select1">
<select id="menu_article" name="menu_article" class="select"><?=$board_option?></select>

<script type="text/javascript">
$("#menu_article").val("<?=text($dmshop_menu['menu_article'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="menu_article_skin" name="menu_article_skin" class="select"><?=$article_skin_option?></select>

<script type="text/javascript">
$("#menu_article_skin").val("<?=text($dmshop_menu['menu_article_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/article</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">게시물 정렬조건</td>
    <td class="select1">
<select id="menu_article_sort" name="menu_article_sort" class="select"><?=$article_sort_option?></select>

<script type="text/javascript">
$("#menu_article_sort").val("<?=text($dmshop_menu['menu_article_sort'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">표기항목</td>
    <td><input type="checkbox" name="menu_article_use0" value="1" class="checkbox" checked onclick="return false;" /></td>
    <td width="5"></td>
    <td class="text1">제목</td>
    <td width="30"></td>
    <td><input type="checkbox" name="menu_article_use1" value="1" class="checkbox" <? if ($dmshop_menu['menu_article_use1'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'menu_article_use1');">작성일</td>
    <td width="30"></td>
    <td><input type="checkbox" name="menu_article_use2" value="1" class="checkbox" <? if ($dmshop_menu['menu_article_use2'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'menu_article_use2');">작성자</td>
    <td width="30"></td>
    <td><input type="checkbox" name="menu_article_use3" value="1" class="checkbox" <? if ($dmshop_menu['menu_article_use3'] == '1') { echo "checked"; } ?> /></td>
    <td width="5"></td>
    <td class="text1" onclick="shopElementCheck('formDesign', 'menu_article_use3');">댓글수</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">게시물 가로갯수</td>
    <td><input type="text" name="menu_article_width" value="<?=text($dmshop_menu['menu_article_width'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">개</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">게시물 세로갯수</td>
    <td><input type="text" name="menu_article_height" value="<?=text($dmshop_menu['menu_article_height'])?>" onfocus="shopInfocus1(this);" onblur="shopOutfocus1(this);" class="input" style="width:40px;" /></td>
    <td width="5"></td>
    <td class="text2">개</td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr>
    <td></td>
    <td class="subject"><span class="tip13">배너</span></td>
    <td class="bc1"></td>
    <td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">그룹 선택</td>
    <td class="select1">
<select id="menu_banner_group" name="menu_banner_group" class="select"><?=$banner_group_option?></select>

<script type="text/javascript">
$("#menu_banner_group").val("<?=text($dmshop_menu['menu_banner_group'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">정렬 방식</td>
    <td class="select1">
<select id="menu_banner_sort" name="menu_banner_sort" class="select"><?=$banner_sort_option?></select>

<script type="text/javascript">
$("#menu_banner_sort").val("<?=text($dmshop_menu['menu_banner_sort'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">스킨 선택</td>
    <td class="select1">
<select id="menu_banner_skin" name="menu_banner_skin" class="select"><?=$banner_skin_option?></select>

<script type="text/javascript">
$("#menu_banner_skin").val("<?=text($dmshop_menu['menu_banner_skin'])?>");
</script>
    </td>
    <td width="10"></td>
    <td class="dir">설치 디렉토리 : ../skin/banner</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">롤링 횟수</td>
    <td class="select2">
<select id="menu_banner_rolling_limit" name="menu_banner_rolling_limit" class="select"><?=$rolling_limit_option?></select>

<script type="text/javascript">
$("#menu_banner_rolling_limit").val("<?=text($dmshop_menu['menu_banner_rolling_limit'])?>");
</script>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#ececec" class="none">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" >
<tr height="60">
    <td width="30"></td>
    <td width="110" class="tx2">롤링 시간</td>
    <td class="select2">
<select id="menu_banner_rolling_time" name="menu_banner_rolling_time" class="select"><?=$rolling_time_option?></select>

<script type="text/javascript">
$("#menu_banner_rolling_time").val("<?=text($dmshop_menu['menu_banner_rolling_time'])?>");
</script>
    </td>
</tr>
</table>
    </td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="180">
    <td></td>
    <td class="subject"><span class="tip14">태그</span></td>
    <td class="bc1"></td>
    <td></td>
    <td><textarea id="menu_tag" name="menu_tag" class="textarea1" style="width:58%; height:130px;"><?=text($dmshop_menu['menu_tag'])?></textarea></td>
    <td></td>
</tr>
<tr><td colspan="<?=$colspan?>" height="1" class="bc1"></td></tr>
<tr height="60">
    <td></td>
    <td class="subject"><span class="tip15">로고</span></td>
    <td class="bc1"></td>
    <td></td>
    <td>
<div style="padding:20px 0;">
<?
$upload_mode = "menu_logo";
$file = shop_design_file($upload_mode);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><input type="file" name="file_<?=$upload_mode?>" class="file" size="35" /></td>
    <td width="20"></td>
    <td class="msg2">지원파일 : JPG, GIF, PNG, SWF</td>
</tr>
</table>

<? if ($file['upload_file']) { ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
<tr>
    <td><?=shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height']);?></td>
    <td width="10"></td>
    <td><a href="./download_design.php?id=<?=$file['id']?>"><span class="source"><?=text($file['upload_source'])?> <span class="filesize">(<?=shop_filesize($file['upload_filesize'])?>)</span></a></td>
    <td width="5"></td>
    <td><input type="checkbox" name="filedel_<?=$upload_mode?>" value="1" class="checkbox" /></td>
    <td width="3"></td>
    <td class="filedel">삭제</td>
</tr>
</table>
<? } ?>
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
    <td><a href="#" onclick="designSubmit(); return false;"><img src="<?=$shop['image_path']?>/adm/confirm.gif" border="0" /></a></td>
    <td width="5"></td>
    <td><a href="./design_menu.php"><img src="<?=$shop['image_path']?>/adm/cancel.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="15"><td></td></tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="auto">
<tr>
    <td class="msg2">확인 버튼을 클릭하시면, 입력하신 설정값이 저장 됩니다.</td>
</tr>
</table>
</form>

<div class="page_bottom"></div>
</div>

<?
include_once("./_bottom.php");
?>