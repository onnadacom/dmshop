<?
if (!defined("_DMSHOP_")) exit;

/*--------------------------------
    ## 페이지 ##
--------------------------------*/

// 페이지
function shop_page($page_id)
{

    global $shop;

    if ($page_id) { $page_id = preg_match("/^[a-zA-Z0-9_\-]+$/", $page_id) ? $page_id : ""; }

    if (!$page_id) {

        return false;

    }

    return sql_fetch(" select * from $shop[page_table] where page_id = '$page_id' ");

}

// 페이지 내용 출력
function shop_page_view($text, $html)
{

    if ($html) {

        // XSS
        $text = preg_replace("/(on)([a-z]+)([^a-z]*)(\=)/i", "&#111;&#110;$2$3$4", $text);
        $text = preg_replace("/(dy)(nsrc)/i", "&#100;&#121;$2", $text);
        $text = preg_replace("/(lo)(wsrc)/i", "&#108;&#111;$2", $text);
        //$text = preg_replace("/(sc)(ript)/i", "&#115;&#99;$2", $text);
        $text = preg_replace("/\<(\w|\s|\?)*(xml)/i", "", $text);

        // <IMG STYLE="xss:expr/*XSS*/ession(alert('XSS'))">
        $text = preg_replace("#\/\*.*\*\/#iU", "", $text);

        $pattern = "";
        $pattern .= "(e|&#(x65|101);?)";
        $pattern .= "(x|&#(x78|120);?)";
        $pattern .= "(p|&#(x70|112);?)";
        $pattern .= "(r|&#(x72|114);?)";
        $pattern .= "(e|&#(x65|101);?)";
        $pattern .= "(s|&#(x73|115);?)";
        $pattern .= "(s|&#(x73|115);?)";
        $pattern .= "(i|&#(x6a|105);?)";
        $pattern .= "(o|&#(x6f|111);?)";
        $pattern .= "(n|&#(x6e|110);?)";
        $text = preg_replace("/".$pattern."/i", "__EXPRESSION__", $text);

    } else {

        $text = preg_replace("/&amp;/", "&", $text);

        // & 처리 : &amp; &nbsp; 등의 코드를 정상 출력함
        $text = shop_text_symbol($text);

        $text = str_replace("  ", "&nbsp; ", $text);
        $text = str_replace("\n ", "\n&nbsp;", $text);

        $text = shop_text($text, 1);

        $text = shop_auto_link($text);

    }

    return $text;

}
?>