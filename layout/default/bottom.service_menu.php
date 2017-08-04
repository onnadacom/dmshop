<?
if (!defined('_DMSHOP_')) exit;
// 바로가기 링크
?>
<table border="0" cellspacing="0" cellpadding="0" class="service_menu">
<tr>
<?
$k = 0;
$result = sql_query(" select * from $shop[board_table] where bottom_view = '1' and bbs_view = '1' order by bbs_position desc, bbs_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    if ($k > '0') {

        echo "<td><span class='line'>|</span></td>";

    }

    echo "<td><a href='".$shop['url']."/board.php?bbs_id=".$row['bbs_id']."'>".$row['bbs_title']."</a></td>";

    $k++;

}

$result = sql_query(" select * from $shop[page_table] where bottom_view = '1' and page_view = '1' order by page_position desc, page_id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    if ($k > '0') {

        echo "<td><span class='line'>|</span></td>";

    }

    echo "<td><a href='".$shop['url']."/page.php?page_id=".$row['page_id']."'>".$row['page_title']."</a></td>";

    $k++;

}
?>
</tr>
</table>