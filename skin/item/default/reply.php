<?
if (!defined('_DMSHOP_')) exit;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="20"><td></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="200" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="8"><td></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><img src="<?=$dmshop_item_path?>/img/reply_title.gif"></td>
    <td width="4"></td>
    <td><span class="count down1">(<?=number_format($dmshop_item['item_reply']);?>)</span></td>
</tr>
</table>
    </td>
    <td align="right" valign="top"><a href="#" onclick="replyWrite('item', '', '<?=$item_id?>', '', '<?=$page?>'); return false;"><img src="<?=$dmshop_item_path?>/img/reply_write<? if ($shop_user_admin) { echo "2"; } ?>.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<?
$sql_search = " where item_id = '".$item_id."' and id = reply_id ";

$sql = " select count(*) as cnt from $shop[reply_table] $sql_search ";
$cnt = sql_fetch($sql);

$total_count = $cnt['cnt'];

$rows = 5;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_reply("10", $page, $total_page);

$sql = " select * from $shop[reply_table] $sql_search order by datetime desc limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 상품평
    if ($row['id'] == $row['reply_id']) {

        $reply_html = "";

        /* 가로라인 start */
        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='1' bgcolor='#efefef'><td></td></tr></table>";
        /* 가로라인 end */
    
        /*---------- ## 테이블 start ## ----------*/
        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0' onmouseover=\"this.style.backgroundColor='#ffffe5';\" onmouseout=\"this.style.backgroundColor='#ffffff';\"><tr>";
    
        /* 평점, 세로라인, 여백 start */
        $reply_html .= "<td width='124' valign='top'><div style='padding:14px 19px 0 19px;'><div class='star".$row['reply_score']."'></div></div></td>";
        $reply_html .= "<td width='2' valign='top'><div style='margin-top:10px;'><img src='".$dmshop_item_path."/img/reply_line.gif'></div></td>";
        $reply_html .= "<td width='20'></td>";
        /* 평점, 세로라인, 여백 end */

        /* 제목, 파일, 내용, 등록자 start */
        $reply_html .= "<td valign='top'>";
        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>";
        $reply_html .= "<td valign='top'>";
        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0' onclick=\"replyView('".$row['reply_id']."');\" class='pointer'><tr height='43'><td><span class='title'>".text($row['reply_title'])."</span>"; if ($row['reply_count']) { $reply_html .= " <span class='count'>(".$row['reply_count'].")</span>"; } $reply_html .= "</td></tr></table>";
        $reply_html .= "<div style='display:none;' class='reply_".$row['reply_id']."'>";
        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";

        // 파일
        $file = shop_reply_file($row['id']);

        if ($file['upload_file']) {

            $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td>".shop_reply_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 400, "")."</td></tr></table>";
            $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";

        }

        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='content'>".text2($row['reply_content'], 0)."</span></td></tr></table>";
        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";
        $reply_html .= "<table border='0' cellspacing='0' cellpadding='0'><tr>";

        // 관리자
        if ($shop_user_admin) {

            $reply_html .= "<td><a href='#' onclick=\"replyWrite('item', '', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/reply_btn_reply2.gif' border='0'></a></td>";
            $reply_html .= "<td width='2'></td>";
            $reply_html .= "<td><a href='#' onclick=\"replyWrite('item', 'u', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/reply_btn_edit2.gif' border='0'></a></td>";
            $reply_html .= "<td width='2'></td>";
            $reply_html .= "<td><a href='#' onclick=\"replyDelete('item', 'd', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/reply_btn_delete2.gif' border='0'></a></td>";
            $reply_html .= "<td width='2'></td>";

        }

        // 내글
        else if ($row['user_id'] && $dmshop_user['user_id'] == $row['user_id']) {

            $reply_html .= "<td><a href='#' onclick=\"replyWrite('item', 'u', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/reply_btn_edit.gif' border='0'></a></td>";
            $reply_html .= "<td width='2'></td>";
            $reply_html .= "<td><a href='#' onclick=\"replyDelete('item', 'd', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/reply_btn_delete.gif' border='0'></a></td>";
            $reply_html .= "<td width='2'></td>";

        }

        // 비회원
        else if (!$row['user_id'] && !$shop_user_login) {

            $reply_html .= "<td><a href='#' onclick=\"replyWrite('item', 'u', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/reply_btn_edit.gif' border='0'></a></td>";
            $reply_html .= "<td width='2'></td>";
            $reply_html .= "<td><a href='#' onclick=\"replyDelete('item', 'd', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/reply_btn_delete.gif' border='0'></a></td>";
            $reply_html .= "<td width='2'></td>";

        } else {

            // pass

        }

        // 회원작성
        if ($row['user_id']) {

            $reply_user_title = "작성자";
            $reply_user_name = text($row['reply_name']);

        } else {

            $reply_user_title = "비회원";
            $reply_user_name = text($row['reply_name']);

        }

        $reply_html .= "</tr></table>";
        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='15'><td></td></tr></table>";
        $reply_html .= "</div>";
        $reply_html .= "</td>";
        $reply_html .= "<td width='140' valign='top'>";
        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='7'><td></td></tr></table>";
        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='name'>".$reply_user_title." : ".$reply_user_name."</span></td></tr></table>";
        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='3'><td></td></tr></table>";
        $reply_html .= " <table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='name'>작성일 : ".date('Y-m-d', strtotime($row['datetime']))."</span></td></tr></table>";
        $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='5'><td></td></tr></table>";
        $reply_html .= "</td>";
        $reply_html .= "</tr></table>";
        $reply_html .= "</td>";
        /* 제목, 파일, 내용, 등록자 end */
    
        $reply_html .= "</tr></table>";
        /*---------- ## 테이블 end ## ----------*/
    
        echo $reply_html;
    
    }

    // 답변
    if ($row['reply_count']) {
    
        $sql = " select * from $shop[reply_table] where id != '".$row['id']."' and reply_id = '".$row['id']."' order by datetime asc ";
        $result2 = sql_query($sql);
        for ($k=0; $row2=sql_fetch_array($result2); $k++) {
    
            // 답변
            if ($row2['id']) {
        
                $reply_html = "";
        
                $reply_html .= "<div style='display:none;' class='reply_".$row2['reply_id']."'>";
        
                /*---------- ## 테이블 start ## ----------*/
                $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>";
        
                /* 평점, 세로라인, 여백(공백) start */
                $reply_html .= "<td width='124' valign='top'></td>";
                $reply_html .= "<td width='2' valign='top'></td>";
                $reply_html .= "<td width='20'></td>";
                /* 평점, 세로라인, 여백(공백) end */
        
                /* 제목, 파일, 내용, 등록자 start */
                $reply_html .= "<td valign='top'>";
                $reply_html .= "<div style='border:1px solid #efefef; padding:15px 10px 15px 10px;' onmouseover=\"this.style.backgroundColor='#f0f5f6';\" onmouseout=\"this.style.backgroundColor='#ffffff';\">";
                $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>";
                $reply_html .= "<td valign='top'>";
                $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='title'>".text($row2['reply_title'])."</span>"; if ($row2['reply_count']) { $reply_html .= " <span class='count'>(".$row2['reply_count'].")</span>"; } $reply_html .= "</td></tr></table>";
                $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";

                // 파일
                $file = shop_reply_file($row2['id']);

                if ($file['upload_file']) {

                    $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td>".shop_reply_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 400, "")."</td></tr></table>";
                    $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";

                }

                $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='content'>".text2($row2['reply_content'], 0)."</span></td></tr></table>";
                $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";
                $reply_html .= "<table border='0' cellspacing='0' cellpadding='0'><tr>";

                // 관리자
                if ($shop_user_admin) {
        
                    $reply_html .= "<td><a href='#' onclick=\"replyWrite('item', 'u', '".$item_id."', '".$row2['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/reply_btn_edit2.gif' border='0'></a></td>";
                    $reply_html .= "<td width='2'></td>";
                    $reply_html .= "<td><a href='#' onclick=\"replyDelete('item', 'd', '".$item_id."', '".$row2['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/reply_btn_delete2.gif' border='0'></a></td>";
                    $reply_html .= "<td width='2'></td>";
        
                } else {
        
                    // pass
        
                }

                $reply_html .= "</tr></table>";
                $reply_html .= "</td>";
                $reply_html .= "<td width='140' valign='top'>";
                $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";
                $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='name'>관리자 : ".text($row2['reply_name'])."</span></td></tr></table>";
                $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='3'><td></td></tr></table>";
                $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='name'>작성일 : ".date('Y-m-d', strtotime($row2['datetime']))."</span></td></tr></table>";
                $reply_html .= "</td>";
                $reply_html .= "</tr></table>";
                $reply_html .= "</div>";
                $reply_html .= "</td>";
                /* 제목, 파일, 내용, 등록자 end */

                $reply_html .= "</tr></table>";
                /*---------- ## 테이블 end ## ----------*/

                /* 하단 여백 start */
                $reply_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='5'><td></td></tr></table>";
                /* 하단 여백 end */

                $reply_html .= "</div>";

                echo $reply_html;

            }

        }

    }

}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1" bgcolor="#efefef" class="none">&nbsp;</td></tr>
</table>

<? if ($i && $total_count > $rows) { ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"></td></tr> 
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?=$shop_pages?></td>
</tr>
</table>
<? } ?>

<? if (!$i) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="150">
    <td align="center" class="content">등록된 상품평이 없습니다.</td>
</tr>
</table>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>