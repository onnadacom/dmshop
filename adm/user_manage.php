<?php
include_once("./_dmshop.php");
if ($user_id) { $user_id = preg_match("/^[A-Za-z0-9_]+$/", $user_id) ? $user_id : ""; }
if ($tab) { $tab = preg_match("/^[0-9]+$/", $tab) ? $tab : ""; }
if ($order_type) { $order_type = preg_match("/^[0-9]+$/", $order_type) ? $order_type : ""; }
$shop['title'] = "회원관리 옵션";
include_once("$shop[path]/shop.top.php");

$colspan = "9";

if (!$user_id) {

    alert_close("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 회원 데이터
$user = shop_user($user_id);
?>

<link rel="stylesheet" href="./adm.css" type="text/css" />

<style type="text/css">
body {background-color:#ffffff;}

.order_list .thumb {border:2px solid #e4e4e4;}
</style>

<div class="contents_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="37" bgcolor="#1f1f22">
    <td width="15"></td>
    <td width="11"><img src="<?=$shop['image_path']?>/adm/arrow.gif" class="up2"></td>
    <td><span class="popup_title1"><?=text($user['user_name'])?> (<?=$user_id?>)</span> <span class="popup_title2">님의 요약정보</span></td>
    <td width="45"><a href="#" onclick="window.close(); return false;"><img src="<?=$shop['image_path']?>/adm/close2.gif" border="0"></a></td>
    <td width="10"></td>
</tr>
</table>

<!-- 상단 탭 start //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="manage_top_bg2">
    <td>
<table border="0" cellspacing="0" cellpadding="0">
<tr height="41">
    <td width="20"></td>
    <td <? if (!$tab) { echo "class='manage_tab'"; } ?>><a href="?user_id=<?=$user_id?>" class="<? if (!$tab) { echo "manage_on"; } else { echo "manage_off"; } ?>">요약정보</a></td>
    <td width="18" align="center" class="t70">|</td>
    <td <? if ($tab == '1') { echo "class='manage_tab'"; } ?>><a href="?user_id=<?=$user_id?>&tab=1" class="<? if ($tab == '1') { echo "manage_on"; } else { echo "manage_off"; } ?>">가입정보</a></td>
    <td width="18" align="center" class="t70">|</td>
    <td <? if ($tab == '2') { echo "class='manage_tab'"; } ?>><a href="?user_id=<?=$user_id?>&tab=2" class="<? if ($tab == '2') { echo "manage_on"; } else { echo "manage_off"; } ?>">쇼핑정보</a></td>
    <td width="18" align="center" class="t70">|</td>
    <td <? if ($tab == '3') { echo "class='manage_tab'"; } ?>><a href="?user_id=<?=$user_id?>&tab=3" class="<? if ($tab == '3') { echo "manage_on"; } else { echo "manage_off"; } ?>">접속정보</a></td>
    <td width="18" align="center" class="t70">|</td>
    <td <? if ($tab == '4') { echo "class='manage_tab'"; } ?>><a href="?user_id=<?=$user_id?>&tab=4" class="<? if ($tab == '4') { echo "manage_on"; } else { echo "manage_off"; } ?>">1:1문의</a></td>
    <td width="18" align="center" class="t70">|</td>
    <td <? if ($tab == '5') { echo "class='manage_tab'"; } ?>><a href="?user_id=<?=$user_id?>&tab=5" class="<? if ($tab == '5') { echo "manage_on"; } else { echo "manage_off"; } ?>">메모</a></td>
</tr>
</table>
    </td>
</tr>
</table>
<!-- 상단 탭 end //-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="20"></td>
    <td>
<?
if ($tab == '1') {

    include_once("user_manage.1.php");

}

else if ($tab == '2') {

    include_once("user_manage.2.php");

}

else if ($tab == '3') {

    include_once("user_manage.3.php");

}

else if ($tab == '4') {

    include_once("user_manage.4.php");

}

else if ($tab == '5') {

    include_once("user_manage.5.php");

} else {

    include_once("user_manage.0.php");

}
?>
    </td>
    <td width="20"></td>
</tr>
</table>

<div style="height:50px;"></div>
</div>

<?
include_once("$shop[path]/shop.bottom.php");
?>