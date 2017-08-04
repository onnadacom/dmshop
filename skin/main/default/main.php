<?
if (!defined('_DMSHOP_')) exit;
// 메인스킨
?>
<style type="text/css">
.plan .tab_bg {height:33px; background:url('<?=$dmshop_main_path?>/img/plan_bg.gif') repeat-x;}
.plan .tab_line {width:1px; background:url('<?=$dmshop_main_path?>/img/plan_line.gif') no-repeat;}

.plan .tab_on {background:url('<?=$dmshop_main_path?>/img/plan_on.gif') repeat-x;}
.plan .tab_on_right {background:url('<?=$dmshop_main_path?>/img/plan_on_right.gif') no-repeat right 0;}
.plan .tab_on_text {text-decoration:none; display:block; text-align:center; padding:0 30px; height:33px; font-weight:bold; line-height:33px; font-size:12px; color:#3a3a3a; font-family:gulim,굴림;}

.plan .tab_off {background:url('<?=$dmshop_main_path?>/img/plan_off.gif') repeat-x;}
.plan .tab_off_text {text-decoration:none; display:block; text-align:center; padding:0 30px; height:33px; line-height:33px; font-size:12px; color:#9e9e9e; font-family:gulim,굴림;}

.plan .layer {display:none;}

.rank .tab_on {background:url('<?=$dmshop_main_path?>/img/rank_on.gif') repeat-x;}
.rank .tab_on_text {text-decoration:none; display:block; text-align:center; height:23px; line-height:23px; font-size:11px; color:#3a3a3a; font-family:dotum,돋움;}

.rank .tab_off {background:url('<?=$dmshop_main_path?>/img/rank_off.gif') repeat-x;}
.rank .tab_off_text {text-decoration:none; display:block; text-align:center; height:23px; line-height:23px; font-size:11px; color:#787878; font-family:dotum,돋움;}

.rank .layer {display:none;}

#rank1 a {width:63px;}
#rank2 a {width:63px;}
#rank3 a {width:53px;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f0f0f0" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#e4e4e5" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top"><?=shop_banner_skin("move_left2", "move_left2", "maintop", "", "6", "1", "", "5000", "ba_position desc"); /* 레이어ID, 스킨명, 배너그룹ID, 배너ID, 가로갯수, 새로갯수, 롤링횟수, 롤링시간, 정렬방식 */ ?></td>
    <td width="10"></td>
    <td width="250" valign="top">
<!-- callcenter start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_main_path?>/img/callcenter.gif"></td>
</tr>
</table>
<!-- callcenter end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<!-- notice & event start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="<?=$shop['path']?>/board.php?bbs_id=notice"><img src="<?=$dmshop_main_path?>/img/title_news_event.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:3px; table-layout:fixed;">
<tr>
    <td><?=shop_article_skin("", "list1", "notice", "1", "5", "", "", "36", "", "", "ar_id desc", 1, 1, "", ""); /* 레이어ID, 스킨명, 게시판ID, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식, 제목표기, 작성일표기, 작성자표기, 댓글수표기 */ ?></td>
</tr>
</table>
<!-- notice & event end //-->
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e5" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#f0f0f0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<!-- good start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_main_path?>/img/title_good_item.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#f0f0f0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="17"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="185">
    <td width="10"></td>
    <td valign="top"><?=shop_item_skin("good_item", "gallery1", "", "2", "", "", "4", "1", "120", "120", "60", "5", "5000", "item_position desc"); /* 레이어ID, 스킨명, 분류ID, 혜택ID, 상품ID, 상품코드, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식 */ ?></td>
</tr>
</table>
<!-- good end //-->
    </td>
    <td width="30"></td>
    <td width="180" valign="top">
<!-- sale start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_main_path?>/img/title_sale_item.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="224">
    <td valign="top"><?=shop_item_skin("showwindow_hot_sale", "hot_sale", "", "4", "", "", "1", "1", "120", "120", "42", "", "", "item_position desc"); /* 레이어ID, 스킨명, 분류ID, 혜택ID, 상품ID, 상품코드, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식 */ ?></td>
</tr>
</table>
<!-- sale end //-->
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="13"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#e4e4e5" class="none">&nbsp;</td></tr>
<tr><td height="1" bgcolor="#f0f0f0" class="none">&nbsp;</td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<!-- plan start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_main_path?>/img/title_plan.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="plan">
<tr class="tab_bg">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div id="plan1" class="tab_title"><div><a href="<?=$shop['path']?>/plan.php?pl_id=1">기획전 1</a></div></div></td>
    <td><div id="plan2" class="tab_title"><div><a href="<?=$shop['path']?>/plan.php?pl_id=2">기획전 2</a></div></div></td>
    <td><div id="plan3" class="tab_title"><div><a href="<?=$shop['path']?>/plan.php?pl_id=3">기획전 3</a></div></div></td>
    <td class="tab_line"></td>
</tr>
</table>
    </td>
    <td class="tab_line"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="20"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="plan">
<tr height="203">
    <td valign="top">
<div id="plan1_layer" class="layer">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=shop_plan_skin("showwindow_tab1", "gallery2", "1", "", "", "", "", "4", "1", "120", "120", "60", "", "", "b.position desc"); /* 레이어ID, 스킨명, 기획전ID, 분류ID, 혜택ID, 상품ID, 상품코드, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식 */ ?></td>
</tr>
</table>
</div>

<div id="plan2_layer" class="layer">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=shop_plan_skin("showwindow_tab2", "gallery2", "2", "", "", "", "", "4", "1", "120", "120", "60", "", "", "b.position desc"); /* 레이어ID, 스킨명, 기획전ID, 분류ID, 혜택ID, 상품ID, 상품코드, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식 */ ?></td>
</tr>
</table>
</div>

<div id="plan3_layer" class="layer">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=shop_plan_skin("showwindow_tab3", "gallery2", "3", "", "", "", "", "4", "1", "120", "120", "60", "", "", "b.position desc"); /* 레이어ID, 스킨명, 기획전ID, 분류ID, 혜택ID, 상품ID, 상품코드, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식 */ ?></td>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<script type="text/javascript">
var plan_on = function(id) {

    $("#"+id).removeClass("tab_off");
    $("#"+id+" div a").removeClass("tab_off_text");

    $("#"+id).addClass("tab_on");
    $("#"+id+" div").addClass("tab_on_right");
    $("#"+id+" div a").addClass("tab_on_text");
    $("#"+id+"_layer").show();

};

var plan_off = function() {

    $(".plan .tab_title").removeClass("tab_on");
    $(".plan .tab_title div").removeClass("tab_on_right");
    $(".plan .tab_title div a").removeClass("tab_on_text");

    $(".plan .tab_title").addClass("tab_off");
    $(".plan .tab_title div a").addClass("tab_off_text");
    $(".plan .layer").hide();

};

$(function() {

    $(".plan .tab_title").mouseover(function() {

        var this_id = $(this).attr("id");

        plan_off();
        plan_on(this_id);

    });

    plan_off();
    plan_on("plan1");

});
</script>
<!-- plan end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#d9d9d9" class="none">&nbsp;</td></tr>
</table>
    </td>
    <td width="30"></td>
    <td width="180" valign="top">
<!-- rank start //-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_main_path?>/img/title_rank.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="rank">
<tr>
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div id="rank1" class="tab_title"><div><a href="#" onclick="return false;">판매량순</a></div></div></td>
    <td><div id="rank2" class="tab_title"><div><a href="#" onclick="return false;">상품평순</a></div></div></td>
    <td><div id="rank3" class="tab_title"><div><a href="#" onclick="return false;">클릭순</a></div></div></td>
    <td width="1" bgcolor="#d6d6d6"></td>
</tr>
</table>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="10"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="rank">
<tr height="225">
    <td valign="top">
<div id="rank1_layer" class="layer">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=shop_item_skin("showwindow_rank1", "mini", "", "", "", "", "3", "3", "50", "40", "8", "", "", "item_sale desc"); /* 레이어ID, 스킨명, 분류ID, 혜택ID, 상품ID, 상품코드, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식 */ ?></td>
</tr>
</table>
</div>

<div id="rank2_layer" class="layer">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=shop_item_skin("showwindow_rank2", "mini", "", "", "", "", "3", "3", "50", "40", "8", "", "", "item_reply desc"); /* 레이어ID, 스킨명, 분류ID, 혜택ID, 상품ID, 상품코드, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식 */ ?></td>
</tr>
</table>
</div>

<div id="rank3_layer" class="layer">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=shop_item_skin("showwindow_rank3", "mini", "", "", "", "", "3", "3", "50", "40", "8", "", "", "item_hit desc"); /* 레이어ID, 스킨명, 분류ID, 혜택ID, 상품ID, 상품코드, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식 */ ?></td>
</tr>
</table>
</div>
    </td>
</tr>
</table>

<script type="text/javascript">
var rank_on = function(id) {

    $("#"+id).removeClass("tab_off");
    $("#"+id+" div a").removeClass("tab_off_text");

    $("#"+id).addClass("tab_on");
    $("#"+id+" div a").addClass("tab_on_text");
    $("#"+id+"_layer").show();

};

var rank_off = function() {

    $(".rank .tab_title").removeClass("tab_on");
    $(".rank .tab_title div a").removeClass("tab_on_text");

    $(".rank .tab_title").addClass("tab_off");
    $(".rank .tab_title div a").addClass("tab_off_text");
    $(".rank .layer").hide();

};

$(function() {

    $(".rank .tab_title").mouseover(function() {

        var this_id = $(this).attr("id");

        rank_off();
        rank_on(this_id);

    });

    rank_off();
    rank_on("rank1");

});
</script>
<!-- rank end //-->
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_main_path?>/img/title_newitem.gif"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=shop_item_skin("category_item", "gallery3", "", "", "", "", "3", "2", "240", "240", "42", "", "", "item_position desc"); /* 레이어ID, 스킨명, 분류ID, 혜택ID, 상품ID, 상품코드, 가로갯수, 새로갯수, 썸네일가로크기, 썸네일세로크기, 제목길이, 롤링횟수, 롤링시간, 정렬방식 */ ?></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
</table>