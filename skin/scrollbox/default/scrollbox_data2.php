<?
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

if ($page) { $page = preg_match("/^[0-9]+$/", $page) ? $page : ""; }

// 스킨 경로 지정
$dmshop_scrollbox_path = "$shop[path]/skin/scrollbox/default";

// 비회원용
$guest_id = "";
$guest_id = shop_get_cookie("dmshop_item_view");

// 로그인
if ($shop_user_login) {

    // 비회원으로 본 상품을 회원으로 변경
    sql_query(" update $shop[item_view_table] set user_id = '".$dmshop_user['user_id']."', guest_id = '' where guest_id = '".$guest_id."' ");

}

// 검색조건
$sql_search = "";

if ($shop_user_login) {

    $sql_search = " where user_id = '".$dmshop_user['user_id']."' ";

} else {

    $sql_search = " where guest_id = '".$guest_id."' and user_id = '' ";

}

$total_count = sql_fetch(" select count(*) as total_count from $shop[item_view_table] $sql_search ");

// 출력 갯수
$rows = 3;

// 최대 페이지
if ($total_count['total_count']) {

    $max_page = ceil($total_count['total_count'] / $rows);

} else {

    $max_page = 1;

}

if (!$page) {

    $page = 1;

}

if ($page > $max_page) {

    $page = $max_page;

}

// 이전
if ($page > '1') {

    $prev = $page - 1;

} else {

    $prev = 1;

}

// 다음
if ($page >= $max_page) {

    $next = $max_page;

}

else if ($page < $max_page) {

    $next = $page + 1;

} else {

    $next = 1;

}

// 출력 위치
if ($page) {

    $limit = ($page - 1) * $rows;

} else {

    $limit = 0;

}

$result = sql_query(" select * from $shop[item_view_table] $sql_search order by datetime desc limit $limit, $rows ");
?>
<div style="padding:3px 8px 0 8px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="24">
    <td align="right"><span  class="count"><?=$total_count['total_count']?></span> <span class="text">건</span></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="12">
    <td width="11"><a href="#" onclick="scrollboxDataLoad('2', '<?=$prev?>', 'no'); return false;"><img src="<?=$dmshop_scrollbox_path?>/img/btn_prev.gif" border="0"></a></td>
    <td class="page"><b><?=$page?></b>/<?=$max_page?></td>
    <td width="11"><a href="#" onclick="scrollboxDataLoad('2', '<?=$next?>', 'no'); return false;"><img src="<?=$dmshop_scrollbox_path?>/img/btn_next.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="3"><td></td></tr>
</table>

<?
$thumb_width = 60; // 썸네일 가로
$thumb_height = 60; // 썸네일 세로
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 상품정보
    $dmshop_item = shop_item($row['item_id']);

    // 상품 페이지
    $item_link = $shop['path']."/item.php?id=".$dmshop_item['item_code'];

    $thumb = "";
    $thumb = shop_item_thumb($dmshop_item['id'], "", "default", $thumb_width, $thumb_height, "2");

    if ($thumb) {

        $img = "<img src='".$thumb."'  border='0'>";

    } else {

        $img = "<img src='".$dmshop_scrollbox_path."/img/noimage.gif' border='0'>";

    }
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div class="thumb"><div class="close"><a href="#" onclick="scrollboxItemViewDelete('<?=$row['id']?>', '<?=$page?>'); return false;"><img src="<?=$dmshop_scrollbox_path?>/img/btn_close.gif" border="0"></a></div><div class="image"><a href="<?=$item_link?>"><?=$img?></a></div></div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>
<? } ?>
</div>

<? if (!$total_count['total_count']) { ?>
<script type="text/javascript">
$(document).ready(function() {

    var data = "<div class='not'>열람하신<br>상품이<br>없습니다.</div>";

    $("#scrollbox_data2").html(data);

});
</script>
<? } ?>

<script type="text/javascript">
$(document).ready(function() { scrollboxImageOver(); });
</script>