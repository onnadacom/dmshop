<?php
include_once("./_dmshop.php");
echo "<meta http-equiv='content-type' content='text/html; charset=$shop[charset]'>";

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// insert
if ($m == '') {

    // 상품
    $item = shop_item(addslashes($_POST['item_id']));

    if (!$item['id']) {

        alert("상품이 삭제되었거나 존재하지 않습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

    }

    // 중복 체크
    $chk = sql_fetch(" select * from $shop[display_item_table] where display_id = '".addslashes($_POST['display_id'])."' and display_type = '".addslashes($_POST['display_type'])."' and display_list = '".addslashes($_POST['display_list'])."' and item_id = '".addslashes($_POST['item_id'])."' ");

    if ($chk['id']) {

        alert("이미 등록된 상품입니다.");

    }

    $sql_common = "";
    $sql_common .= " set display_id = '".addslashes($_POST['display_id'])."' ";
    $sql_common .= ", display_type = '".addslashes($_POST['display_type'])."' ";
    $sql_common .= ", display_list = '".addslashes($_POST['display_list'])."' ";
    $sql_common .= ", item_id = '".addslashes($_POST['item_id'])."' ";
    $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

    // 등록
    sql_query(" insert into $shop[display_item_table] $sql_common ");

}

// delete
else if ($m == 'd') {

    // 상품 삭제
    sql_query(" delete from $shop[display_item_table] where id = '".addslashes($_POST['display_item_id'])."' ");

}

// 일괄등록
else if ($m == 'all') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 상품
        $item = shop_item(addslashes($_POST['item_id'][$k]));

        // 중복 체크
        $chk = sql_fetch(" select * from $shop[display_item_table] where display_id = '".addslashes($_POST['display_id'])."' and display_type = '".addslashes($_POST['display_type'])."' and display_list = '".addslashes($_POST['display_list'])."' and item_id = '".addslashes($_POST['item_id'][$k])."' ");

        // 상품이 있으면서 중복이 아닐 때
        if ($item['id'] && !$chk['id']) {

            $sql_common = "";
            $sql_common .= " set display_id = '".addslashes($_POST['display_id'])."' ";
            $sql_common .= ", display_type = '".addslashes($_POST['display_type'])."' ";
            $sql_common .= ", display_list = '".addslashes($_POST['display_list'])."' ";
            $sql_common .= ", item_id = '".addslashes($_POST['item_id'][$k])."' ";
            $sql_common .= ", datetime = '".$shop['time_ymdhis']."' ";

            // 등록
            sql_query(" insert into $shop[display_item_table] $sql_common ");

        } else {

            // pass

        }

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}
?>
<? if ($m == '' || $m == 'all') { ?>
<div style="display:none;">
<div id="item_list">
<?
$result = sql_query(" select * from $shop[display_item_table] where display_id = '".addslashes($_POST['display_id'])."' and display_type = '".addslashes($_POST['display_type'])."' and display_list = '".addslashes($_POST['display_list'])."' order by position desc, datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $item = shop_item($row['item_id']);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="displayItemDelete('<?=text($_POST['display_id'])?>', '<?=text($_POST['display_type'])?>', '<?=text($_POST['display_list'])?>', '<?=$row['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/delete3.gif" border="0" class="down3"></a> <a href="<?=$shop['path']?>/item.php?id=<?=text($item['item_code'])?>" class="selection_name" target="_blank"><?=text($item['item_title'])?></a></td>
</tr>
</table>
<? } ?>
</div>
</div>

<script type="text/javascript">
parent.opener.document.getElementById("display<?=text($display_id)?>_<?=text($display_type)?>_<?=text($display_list)?>_item_list").innerHTML = document.getElementById("item_list").innerHTML;
</script>
<?
if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);

} else { ?>
<?
$result = sql_query(" select * from $shop[display_item_table] where display_id = '".addslashes($_POST['display_id'])."' and display_type = '".addslashes($_POST['display_type'])."' and display_list = '".addslashes($_POST['display_list'])."' order by position desc, datetime desc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $item = shop_item($row['item_id']);
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><a href="#" onclick="displayItemDelete('<?=text($_POST['display_id'])?>', '<?=text($_POST['display_type'])?>', '<?=text($_POST['display_list'])?>', '<?=$row['id']?>'); return false;"><img src="<?=$shop['image_path']?>/adm/delete3.gif" border="0" class="down3"></a> <a href="<?=$shop['path']?>/item.php?id=<?=text($item['item_code'])?>" class="selection_name" target="_blank"><?=text($item['item_title'])?></a></td>
</tr>
</table>
<? } ?>
<? } ?>