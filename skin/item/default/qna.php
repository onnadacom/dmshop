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
    <td><img src="<?=$dmshop_item_path?>/img/qna_title.gif"></td>
    <td width="4"></td>
    <td><span class="count down1">(<?=number_format($dmshop_item['item_qna']);?>)</span></td>
</tr>
</table>
    </td>
    <td align="right" valign="top"><a href="#" onclick="qnaWrite('item', '', '<?=$item_id?>', '', '<?=$page?>'); return false;"><img src="<?=$dmshop_item_path?>/img/qna_write<? if ($shop_user_admin) { echo "2"; } ?>.gif" border="0"></a></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr height="10"><td></td></tr>
</table>

<?
$sql_search = " where item_id = '".$item_id."' and id = qna_id ";

$sql = " select count(*) as cnt from $shop[qna_table] $sql_search ";
$cnt = sql_fetch($sql);

$total_count = $cnt['cnt'];

$rows = 5;

$total_page  = ceil($total_count / $rows);

if (!$page) {

    $page = 1;

}

$from_record = ($page - 1) * $rows;

$shop_pages = shop_paging_qna("10", $page, $total_page);

$sql = " select * from $shop[qna_table] $sql_search order by datetime desc limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $qna_secret_check = false;
    $qna_secret = "";

    // 상품평
    if ($row['id'] == $row['qna_id']) {

        // 답변이 있으면 완료 class
        if ($row['qna_count']) { $qna_smile = "smile1"; } else { $qna_smile = "smile0"; }

        // 비밀글
        if ($row['qna_secret']) {

            // 관리자 로그인
            if ($shop_user_admin) {

                $qna_secret_check = true;

            }

            // 회원
            else if ($row['user_id']) {

                // 내글
                if ($dmshop_user['user_id'] == $row['user_id']) {

                    $qna_secret_check = true;

                }

            } else {
            // 비회원

                $ss_name = "ss_name_qna_".$row['qna_id'];

                if (shop_get_session($ss_name)) {

                    $qna_secret_check = true;

                }

            }

            if ($qna_secret_check) {

                // 아이콘
                $qna_secret = "<img src='".$dmshop_item_path."/img/secret2.gif' align='absmiddle'> ";

            } else {

                // 아이콘
                $qna_secret = "<img src='".$dmshop_item_path."/img/qna_secret.gif' align='absmiddle'> ";

            }

        } else {

            $qna_secret_check = true;

        }

        // 뷰
        if ($qna_secret_check) {

            $qna_view_event = "onclick=\"qnaView('".$row['qna_id']."');\"";

        } else {
        // 가림

            $qna_view_event = "onclick=\"qnaPassword('item', '".$m."', '".$row['item_id']."', '".$row['id']."', '".$page."');\"";

        }

        $qna_html = "";

        /* 가로라인 start */
        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='1' bgcolor='#efefef'><td></td></tr></table>";
        /* 가로라인 end */

        /*---------- ## 테이블 start ## ----------*/
        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0' onmouseover=\"this.style.backgroundColor='#ffffe5';\" onmouseout=\"this.style.backgroundColor='#ffffff';\"><tr>";

        /* 평점, 세로라인, 여백 start */
        $qna_html .= "<td width='124' valign='top'><div style='padding:14px 19px 0 19px;'><div class='".$qna_smile."'></div></div></td>";
        $qna_html .= "<td width='2' valign='top'><div style='margin-top:10px;'><img src='".$dmshop_item_path."/img/qna_line.gif'></div></td>";
        $qna_html .= "<td width='20'></td>";
        /* 평점, 세로라인, 여백 end */

        /* 제목, 파일, 내용, 등록자 start */
        $qna_html .= "<td valign='top'>";
        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>";
        $qna_html .= "<td valign='top'>";
        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0' ".$qna_view_event." class='pointer'><tr height='43'><td>".$qna_secret."<span class='category'>[".$row['qna_category']."]</span> <span class='title'>".text($row['qna_title'])."</span>"; if ($row['qna_count']) { $qna_html .= " <span class='count'>(".$row['qna_count'].")</span>"; } $qna_html .= "</td></tr></table>";
        $qna_html .= "<div style='display:none;' class='qna_".$row['qna_id']."'>";
        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";

        // 파일
        $file = shop_qna_file($row['id']);

        if ($file['upload_file']) {

            $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td>".shop_qna_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 400, "")."</td></tr></table>";
            $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";

        }

        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='content'>".text2($row['qna_content'], 0)."</span></td></tr></table>";
        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";
        $qna_html .= "<table border='0' cellspacing='0' cellpadding='0'><tr>";

        // 관리자
        if ($shop_user_admin) {

            if (!$row['qna_count']) {

                $qna_html .= "<td><a href='#' onclick=\"qnaWrite('item', '', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/qna_btn_reply2.gif' border='0'></a></td>";
                $qna_html .= "<td width='2'></td>";

            }

            $qna_html .= "<td><a href='#' onclick=\"qnaWrite('item', 'u', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/qna_btn_edit2.gif' border='0'></a></td>";
            $qna_html .= "<td width='2'></td>";
            $qna_html .= "<td><a href='#' onclick=\"qnaDelete('item', 'd', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/qna_btn_delete2.gif' border='0'></a></td>";
            $qna_html .= "<td width='2'></td>";

        }

        // 내글
        else if ($row['user_id'] && $dmshop_user['user_id'] == $row['user_id']) {

            $qna_html .= "<td><a href='#' onclick=\"qnaWrite('item', 'u', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/qna_btn_edit.gif' border='0'></a></td>";
            $qna_html .= "<td width='2'></td>";
            $qna_html .= "<td><a href='#' onclick=\"qnaDelete('item', 'd', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/qna_btn_delete.gif' border='0'></a></td>";
            $qna_html .= "<td width='2'></td>";

        }

        // 비회원
        else if (!$row['user_id'] && !$shop_user_login) {

            $qna_html .= "<td><a href='#' onclick=\"qnaWrite('item', 'u', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/qna_btn_edit.gif' border='0'></a></td>";
            $qna_html .= "<td width='2'></td>";
            $qna_html .= "<td><a href='#' onclick=\"qnaDelete('item', 'd', '".$item_id."', '".$row['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/qna_btn_delete.gif' border='0'></a></td>";
            $qna_html .= "<td width='2'></td>";

        } else {

            // pass

        }

        // 회원작성
        if ($row['user_id']) {

            $qna_user_title = "회원명";
            $qna_user_name = text($row['qna_name']);

        } else {

            $qna_user_title = "비회원";
            $qna_user_name = text($row['qna_name']);

        }

        $qna_html .= "</tr></table>";
        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='15'><td></td></tr></table>";
        $qna_html .= "</div>";
        $qna_html .= "</td>";
        $qna_html .= "<td width='140' valign='top'>";
        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='7'><td></td></tr></table>";
        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='name'>".$qna_user_title." : ".$qna_user_name."</span></td></tr></table>";
        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='3'><td></td></tr></table>";
        $qna_html .= " <table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='name'>작성일 : ".date('Y-m-d', strtotime($row['datetime']))."</span></td></tr></table>";
        $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='5'><td></td></tr></table>";
        $qna_html .= "</td>";
        $qna_html .= "</tr></table>";
        $qna_html .= "</td>";
        /* 제목, 파일, 내용, 등록자 end */

        $qna_html .= "</tr></table>";
        /*---------- ## 테이블 end ## ----------*/

        echo $qna_html;

    }

    // 답변
    if ($row['qna_count'] && $qna_secret_check) {

        $sql = " select * from $shop[qna_table] where id != '".$row['id']."' and qna_id = '".$row['id']."' order by datetime asc ";
        $result2 = sql_query($sql);
        for ($k=0; $row2=sql_fetch_array($result2); $k++) {

            // 답변
            if ($row2['id']) {

                $qna_html = "";

                $qna_html .= "<div style='display:none;' class='qna_".$row2['qna_id']."'>";

                /*---------- ## 테이블 start ## ----------*/
                $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>";

                /* 평점, 세로라인, 여백(공백) start */
                $qna_html .= "<td width='124' valign='top'></td>";
                $qna_html .= "<td width='2' valign='top'></td>";
                $qna_html .= "<td width='20'></td>";
                /* 평점, 세로라인, 여백(공백) end */

                /* 제목, 파일, 내용, 등록자 start */
                $qna_html .= "<td valign='top'>";
                $qna_html .= "<div style='border:1px solid #efefef; padding:15px 10px 15px 10px;' onmouseover=\"this.style.backgroundColor='#f0f5f6';\" onmouseout=\"this.style.backgroundColor='#ffffff';\">";
                $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>";
                $qna_html .= "<td valign='top'>";
                $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='title'>".text($row2['qna_title'])."</span>"; if ($row2['qna_count']) { $qna_html .= " <span class='count'>(".$row2['qna_count'].")</span>"; } $qna_html .= "</td></tr></table>";
                $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";

                // 파일
                $file = shop_qna_file($row2['id']);

                if ($file['upload_file']) {

                    $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td>".shop_qna_view($file['datetime'], $file['upload_file'], $file['upload_width'], $file['upload_height'], 400, "")."</td></tr></table>";
                    $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";

                }

                $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='content'>".text2($row2['qna_content'], 0)."</span></td></tr></table>";
                $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";
                $qna_html .= "<table border='0' cellspacing='0' cellpadding='0'><tr>";

                // 관리자
                if ($shop_user_admin) {

                    $qna_html .= "<td><a href='#' onclick=\"qnaWrite('item', 'u', '".$item_id."', '".$row2['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/qna_btn_edit2.gif' border='0'></a></td>";
                    $qna_html .= "<td width='2'></td>";
                    $qna_html .= "<td><a href='#' onclick=\"qnaDelete('item', 'd', '".$item_id."', '".$row2['id']."', '".$page."'); return false;\"><img src='".$dmshop_item_path."/img/qna_btn_delete2.gif' border='0'></a></td>";
                    $qna_html .= "<td width='2'></td>";

                } else {

                    // pass

                }

                $qna_html .= "</tr></table>";
                $qna_html .= "</td>";
                $qna_html .= "<td width='140' valign='top'>";
                $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='10'><td></td></tr></table>";
                $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='name'>답변자 : ".text($row2['qna_name'])."</span></td></tr></table>";
                $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='3'><td></td></tr></table>";
                $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><span class='name'>작성일 : ".date('Y-m-d', strtotime($row2['datetime']))."</span></td></tr></table>";
                $qna_html .= "</td>";
                $qna_html .= "</tr></table>";
                $qna_html .= "</div>";
                $qna_html .= "</td>";
                /* 제목, 파일, 내용, 등록자 end */

                $qna_html .= "</tr></table>";
                /*---------- ## 테이블 end ## ----------*/

                /* 하단 여백 start */
                $qna_html .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr height='5'><td></td></tr></table>";
                /* 하단 여백 end */

                $qna_html .= "</div>";

                echo $qna_html;

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
    <td align="center" class="content">등록된 상품문의가 없습니다.</td>
</tr>
</table>
<? } ?>

<table border="0" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr> 
</table>