<?
if (!defined("_DMSHOP_")) exit;

/*--------------------------------
    ## 페이징 함수 ##
--------------------------------*/

// 관리자 페이징
function shop_paging_v0($write_pages, $cur_page, $total_page, $url, $add="")
{

    global $shop;

    $str = "";
    $str = "<style type='text/css'>";
    $str .= "#paging_v0 {margin:0 auto;}";
    $str .= "#paging_v0 .page_line {line-height:18px; font-size:11px; color:#e5e5e5; font-family:dotum,돋움;}";
    $str .= "#paging_v0 .page_on {display:block; width:23px; height:20px; border:1px solid #e4e4e4; background-color:#027d94; text-align:center;}";
    $str .= "#paging_v0 .page_on {font-weight:bold; text-decoration:none; line-height:20px; font-size:11px; color:#ffffff; font-family:Tahoma,dotum,gulim;}";
    $str .= "#paging_v0 .page_off {display:block; width:23px; height:20px; border:1px solid #e4e4e4; background-color:#ffffff; text-align:center;}";
    $str .= "#paging_v0 .page_off {font-weight:bold; text-decoration:none; line-height:20px; font-size:11px; color:#676767; font-family:Tahoma,dotum,gulim;}";
    $str .= "#paging_v0 a.page_off:hover {background-color:#027d94; color:#ffffff;}";
    $str .= "#paging_v0 .btn a {text-decoration:none; font-weight:bold; line-height:18px; font-size:11px; color:#676767; font-family:dotum,돋움;}";
    $str .= "#paging_v0 .btn a:hover {text-decoration:underline; color:#027d94;}";
    $str .= "</style>";
    $str .= "<table id='paging_v0' cellspacing='0' cellpadding='0' border='0' align='center'><tr><td>";

    if ($cur_page > 1) {

        $str .= "<td class='btn'><a href='" . $url . "{$add}&page=1'>맨앞으로</a></td>";

    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) {

        $str .= "<td style='padding:0 5px 0 5px;' ><span class='page_line'>|</span></td>";
        $str .= "<td class='btn'><a href='" . $url . ($start_page-1) . "{$add}'>이전</a></td>";

    }

    $str .= "<td width='15'></td>";

    if ($total_page > 1) {

        $str .= "<td width='4'></td>";

        $n = 0;

        for ($k=$start_page;$k<=$end_page;$k++) {

            $n++;

            if ($n > '1') {

                $str .= "<td width='4'></td>";

            }

            if ($cur_page != $k) {

                $str .= "<td><a href='{$url}{$k}' class='page_off'>$k</span></a></td>";

            } else {

                $str .= "<td><a href='{$url}{$k}' class='page_on'>$k</a></td>";
            }

        }

    }

    $str .= "<td width='15'></td>";

    if ($total_page > $end_page) {

        $str .= "<td class='btn'><a href='" . $url . ($end_page+1) . "{$add}'>다음</a></td>";
        $str .= "<td style='padding:0 5px 0 5px;' ><span class='page_line'>|</span></td>";

    }

    if ($cur_page < $total_page) {

        $str .= "<td class='btn'><a href='$url$total_page{$add}'>맨뒤로</a></td>";

    }

    $str .= "</tr></table>";

    return $str;

}

// 관리자 SMS 자동완성 페이징
function shop_paging_smsauto($write_pages, $cur_page, $total_page)
{

    global $shop;

    $str = "";
    $str = "<style type='text/css'>";
    $str .= "#paging_sms {margin:0 auto;}";
    $str .= "#paging_sms .page_line {line-height:18px; font-size:11px; color:#e5e5e5; font-family:dotum,돋움;}";
    $str .= "#paging_sms .page_on {display:block; width:23px; height:20px; border:1px solid #e4e4e4; background-color:#555555; text-align:center;}";
    $str .= "#paging_sms .page_on {font-weight:bold; text-decoration:none; line-height:20px; font-size:11px; color:#ffffff; font-family:Tahoma,dotum,gulim;}";
    $str .= "#paging_sms .page_off {display:block; width:23px; height:20px; border:1px solid #e4e4e4; background-color:#ffffff; text-align:center;}";
    $str .= "#paging_sms .page_off {font-weight:bold; text-decoration:none; line-height:20px; font-size:11px; color:#676767; font-family:Tahoma,dotum,gulim;}";
    $str .= "#paging_sms a.page_off:hover {background-color:#555555; color:#ffffff;}";
    $str .= "#paging_sms .btn a {text-decoration:none; font-weight:bold; line-height:18px; font-size:11px; color:#676767; font-family:dotum,돋움;}";
    $str .= "#paging_sms .btn a:hover {text-decoration:underline; color:#555555;}";
    $str .= "</style>";
    $str .= "<table id='paging_sms' cellspacing='0' cellpadding='0' border='0' align='center'><tr><td>";

    if ($cur_page > 1) {

        $str .= "<td class='btn'><a href='#' onclick=\"smsAutoLoading('1'); return false;\">맨앞으로</a></td>";

    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) {

        $str .= "<td style='padding:0 5px 0 5px;' ><span class='page_line'>|</span></td>";
        $str .= "<td class='btn'><a href='#' onclick=\"smsAutoLoading('".($start_page-1)."'); return false;\">이전</a></td>";

    }

    $str .= "<td width='15'></td>";

    if ($total_page > 1) {

        $str .= "<td width='4'></td>";

        $n = 0;

        for ($k=$start_page;$k<=$end_page;$k++) {

            $n++;

            if ($n > '1') {

                $str .= "<td width='4'></td>";

            }

            if ($cur_page != $k) {

                $str .= "<td><a href='#' class='page_off' onclick=\"smsAutoLoading('".$k."'); return false;\">$k</span></a></td>";

            } else {

                $str .= "<td><a href='#' class='page_on' onclick=\"smsAutoLoading('".$k."'); return false;\">$k</a></td>";
            }

        }

    }

    $str .= "<td width='15'></td>";

    if ($total_page > $end_page) {

        $str .= "<td class='btn'><a href='#' onclick=\"smsAutoLoading('".($end_page+1)."'); return false;\">다음</a></td>";
        $str .= "<td style='padding:0 5px 0 5px;'><span class='page_line'>|</span></td>";

    }

    if ($cur_page < $total_page) {

        $str .= "<td class='btn'><a href='#' onclick=\"smsAutoLoading('".$total_page."'); return false;\">맨뒤로</a></td>";

    }

    $str .= "</tr></table>";

    return $str;

}

// 일반 페이징
function shop_paging_v1($write_pages, $cur_page, $total_page, $url, $add="")
{

    global $shop;

    $str = "";
    $str = "<style type='text/css'>";
    $str .= "#paging_v1 {margin:0 auto;}";
    $str .= "#paging_v1 .page_line {line-height:18px; font-size:11px; color:#e5e5e5; font-family:dotum,돋움;}";
    $str .= "#paging_v1 .page_on {display:block; width:23px; height:20px; border:1px solid #e4e4e4; background-color:#555555; text-align:center;}";
    $str .= "#paging_v1 .page_on {font-weight:bold; text-decoration:none; line-height:20px; font-size:11px; color:#ffffff; font-family:Tahoma,dotum,gulim;}";
    $str .= "#paging_v1 .page_off {display:block; width:23px; height:20px; border:1px solid #e4e4e4; background-color:#ffffff; text-align:center;}";
    $str .= "#paging_v1 .page_off {font-weight:bold; text-decoration:none; line-height:20px; font-size:11px; color:#676767; font-family:Tahoma,dotum,gulim;}";
    $str .= "#paging_v1 a.page_off:hover {background-color:#555555; color:#ffffff;}";
    $str .= "#paging_v1 .btn a {text-decoration:none; font-weight:bold; line-height:18px; font-size:11px; color:#676767; font-family:dotum,돋움;}";
    $str .= "#paging_v1 .btn a:hover {text-decoration:underline; color:#555555;}";
    $str .= "</style>";
    $str .= "<table id='paging_v1' cellspacing='0' cellpadding='0' border='0' align='center'><tr><td>";

    if ($cur_page > 1) {

        $str .= "<td class='btn'><a href='" . $url . "{$add}&page=1'>맨앞으로</a></td>";

    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) {

        $str .= "<td style='padding:0 5px 0 5px;' ><span class='page_line'>|</span></td>";
        $str .= "<td class='btn'><a href='" . $url . ($start_page-1) . "{$add}'>이전</a></td>";

    }

    $str .= "<td width='15'></td>";

    if ($total_page > 1) {

        $str .= "<td width='4'></td>";

        $n = 0;

        for ($k=$start_page;$k<=$end_page;$k++) {

            $n++;

            if ($n > '1') {

                $str .= "<td width='4'></td>";

            }

            if ($cur_page != $k) {

                $str .= "<td><a href='{$url}{$k}' class='page_off'>$k</span></a></td>";

            } else {

                $str .= "<td><a href='{$url}{$k}' class='page_on'>$k</a></td>";
            }

        }

    }

    $str .= "<td width='15'></td>";

    if ($total_page > $end_page) {

        $str .= "<td class='btn'><a href='" . $url . ($end_page+1) . "{$add}'>다음</a></td>";
        $str .= "<td style='padding:0 5px 0 5px;' ><span class='page_line'>|</span></td>";

    }

    if ($cur_page < $total_page) {

        $str .= "<td class='btn'><a href='$url$total_page{$add}'>맨뒤로</a></td>";

    }

    $str .= "</tr></table>";

    return $str;

}

// 상품평 페이징
function shop_paging_reply($write_pages, $cur_page, $total_page)
{

    global $shop, $item_id;

    $str = "";
    $str = "<style type='text/css'>";
    $str .= "#paging_reply {margin:0 auto;}";
    $str .= "#paging_reply .page_line {line-height:18px; font-size:11px; color:#e5e5e5; font-family:dotum,돋움;}";
    $str .= "#paging_reply .page_on {display:block; width:23px; height:20px; border:1px solid #e4e4e4; background-color:#555555; text-align:center;}";
    $str .= "#paging_reply .page_on {font-weight:bold; text-decoration:none; line-height:20px; font-size:11px; color:#ffffff; font-family:Tahoma,dotum,gulim;}";
    $str .= "#paging_reply .page_off {display:block; width:23px; height:20px; border:1px solid #e4e4e4; background-color:#ffffff; text-align:center;}";
    $str .= "#paging_reply .page_off {font-weight:bold; text-decoration:none; line-height:20px; font-size:11px; color:#676767; font-family:Tahoma,dotum,gulim;}";
    $str .= "#paging_reply a.page_off:hover {background-color:#555555; color:#ffffff;}";
    $str .= "#paging_reply .btn a {text-decoration:none; font-weight:bold; line-height:18px; font-size:11px; color:#676767; font-family:dotum,돋움;}";
    $str .= "#paging_reply .btn a:hover {text-decoration:underline; color:#555555;}";
    $str .= "</style>";
    $str .= "<table id='paging_reply' cellspacing='0' cellpadding='0' border='0' align='center'><tr><td>";

    if ($cur_page > 1) {

        $str .= "<td class='btn'><a href='#' onclick=\"replyLoading('".$item_id."', '1'); return false;\">맨앞으로</a></td>";

    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) {

        $str .= "<td style='padding:0 5px 0 5px;' ><span class='page_line'>|</span></td>";
        $str .= "<td class='btn'><a href='#' onclick=\"replyLoading('".$item_id."', '".($start_page-1)."'); return false;\">이전</a></td>";

    }

    $str .= "<td width='15'></td>";

    if ($total_page > 1) {

        $str .= "<td width='4'></td>";

        $n = 0;

        for ($k=$start_page;$k<=$end_page;$k++) {

            $n++;

            if ($n > '1') {

                $str .= "<td width='4'></td>";

            }

            if ($cur_page != $k) {

                $str .= "<td><a href='#' class='page_off' onclick=\"replyLoading('".$item_id."', '".$k."'); return false;\">$k</span></a></td>";

            } else {

                $str .= "<td><a href='#' class='page_on' onclick=\"replyLoading('".$item_id."', '".$k."'); return false;\">$k</a></td>";
            }

        }

    }

    $str .= "<td width='15'></td>";

    if ($total_page > $end_page) {

        $str .= "<td class='btn'><a href='#' onclick=\"replyLoading('".$item_id."', '".($end_page+1)."'); return false;\">다음</a></td>";
        $str .= "<td style='padding:0 5px 0 5px;'><span class='page_line'>|</span></td>";

    }

    if ($cur_page < $total_page) {

        $str .= "<td class='btn'><a href='#' onclick=\"replyLoading('".$item_id."', '".$total_page."'); return false;\">맨뒤로</a></td>";

    }

    $str .= "</tr></table>";

    return $str;

}

// 상품문의 페이징
function shop_paging_qna($write_pages, $cur_page, $total_page)
{

    global $shop, $item_id;

    $str = "";
    $str = "<style type='text/css'>";
    $str .= "#paging_qna {margin:0 auto;}";
    $str .= "#paging_qna .page_line {line-height:18px; font-size:11px; color:#e5e5e5; font-family:dotum,돋움;}";
    $str .= "#paging_qna .page_on {display:block; width:23px; height:20px; border:1px solid #e4e4e4; background-color:#555555; text-align:center;}";
    $str .= "#paging_qna .page_on {font-weight:bold; text-decoration:none; line-height:20px; font-size:11px; color:#ffffff; font-family:Tahoma,dotum,gulim;}";
    $str .= "#paging_qna .page_off {display:block; width:23px; height:20px; border:1px solid #e4e4e4; background-color:#ffffff; text-align:center;}";
    $str .= "#paging_qna .page_off {font-weight:bold; text-decoration:none; line-height:20px; font-size:11px; color:#676767; font-family:Tahoma,dotum,gulim;}";
    $str .= "#paging_qna a.page_off:hover {background-color:#555555; color:#ffffff;}";
    $str .= "#paging_qna .btn a {text-decoration:none; font-weight:bold; line-height:18px; font-size:11px; color:#676767; font-family:dotum,돋움;}";
    $str .= "#paging_qna .btn a:hover {text-decoration:underline; color:#555555;}";
    $str .= "</style>";
    $str .= "<table id='paging_qna' cellspacing='0' cellpadding='0' border='0' align='center'><tr><td>";

    if ($cur_page > 1) {

        $str .= "<td class='btn'><a href='#' onclick=\"qnaLoading('".$item_id."', '1'); return false;\">맨앞으로</a></td>";

    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) {

        $str .= "<td style='padding:0 5px 0 5px;' ><span class='page_line'>|</span></td>";
        $str .= "<td class='btn'><a href='#' onclick=\"qnaLoading('".$item_id."', '".($start_page-1)."'); return false;\">이전</a></td>";

    }

    $str .= "<td width='15'></td>";

    if ($total_page > 1) {

        $str .= "<td width='4'></td>";

        $n = 0;

        for ($k=$start_page;$k<=$end_page;$k++) {

            $n++;

            if ($n > '1') {

                $str .= "<td width='4'></td>";

            }

            if ($cur_page != $k) {

                $str .= "<td><a href='#' class='page_off' onclick=\"qnaLoading('".$item_id."', '".$k."'); return false;\">$k</span></a></td>";

            } else {

                $str .= "<td><a href='#' class='page_on' onclick=\"qnaLoading('".$item_id."', '".$k."'); return false;\">$k</a></td>";
            }

        }

    }

    $str .= "<td width='15'></td>";

    if ($total_page > $end_page) {

        $str .= "<td class='btn'><a href='#' onclick=\"qnaLoading('".$item_id."', '".($end_page+1)."'); return false;\">다음</a></td>";
        $str .= "<td style='padding:0 5px 0 5px;'><span class='page_line'>|</span></td>";

    }

    if ($cur_page < $total_page) {

        $str .= "<td class='btn'><a href='#' onclick=\"qnaLoading('".$item_id."', '".$total_page."'); return false;\">맨뒤로</a></td>";

    }

    $str .= "</tr></table>";

    return $str;

}

// 게시판 페이징
function shop_paging_board($write_pages, $cur_page, $total_page, $url, $add="")
{

    global $shop;

    $str = "";
    $str = "<style type='text/css'>";
    $str .= "#paging_v1 {margin:0 auto;}";
    $str .= "#paging_v1 .page_line {line-height:18px; font-size:11px; color:#e5e5e5; font-family:dotum,돋움;}";
    $str .= "#paging_v1 .page_on {display:block; width:18px; height:20px; text-align:center;}";
    $str .= "#paging_v1 .page_on {font-weight:bold; text-decoration:underline; line-height:20px; font-size:12px; color:#027d94; font-family:dotum,돋움;}";
    $str .= "#paging_v1 .page_off {display:block; width:18px; height:20px; text-align:center;}";
    $str .= "#paging_v1 .page_off {font-weight:bold; text-decoration:none; line-height:20px; font-size:12px; color:#9e9e9e; font-family:dotum,돋움;}";
    $str .= "#paging_v1 a.page_off:hover {text-decoration:underline; color:#027d94;}";
    $str .= "#paging_v1 .btn a {text-decoration:none; font-weight:bold; line-height:18px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;}";
    $str .= "#paging_v1 .btn a:hover {text-decoration:underline; color:#027d94;}";
    $str .= "</style>";
    $str .= "<table id='paging_v1' cellspacing='0' cellpadding='0' border='0' align='center'><tr><td>";

    if ($cur_page > 1) {

        $str .= "<td class='btn'><a href='" . $url . "{$add}&page=1'>맨앞으로</a></td>";

    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) {

        $str .= "<td style='padding:0 5px 0 5px;' ><span class='page_line'>|</span></td>";
        $str .= "<td class='btn'><a href='" . $url . ($start_page-1) . "{$add}'>이전</a></td>";

    }

    $str .= "<td width='15'></td>";

    if ($total_page > 1) {

        $str .= "<td width='4'></td>";

        $n = 0;

        for ($k=$start_page;$k<=$end_page;$k++) {

            $n++;

            if ($n > '1') {

                $str .= "<td width='4'></td>";

            }

            if ($cur_page != $k) {

                $str .= "<td><a href='{$url}{$k}' class='page_off'>$k</span></a></td>";

            } else {

                $str .= "<td><a href='{$url}{$k}' class='page_on'>$k</a></td>";
            }

        }

    }

    $str .= "<td width='15'></td>";

    if ($total_page > $end_page) {

        $str .= "<td class='btn'><a href='" . $url . ($end_page+1) . "{$add}'>다음</a></td>";
        $str .= "<td style='padding:0 5px 0 5px;' ><span class='page_line'>|</span></td>";

    }

    if ($cur_page < $total_page) {

        $str .= "<td class='btn'><a href='$url$total_page{$add}'>맨뒤로</a></td>";

    }

    $str .= "</tr></table>";

    return $str;

}
?>