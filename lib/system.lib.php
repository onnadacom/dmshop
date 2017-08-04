<?php
if (!defined("_DMSHOP_")) exit;

/*------------------------------
    ## 공통함수 변경 ##
------------------------------*/

function text($text, $html=0)
{

    $text = stripslashes($text);

    $text = preg_replace("/&amp;/", "&", $text);
    $text = preg_replace("/&#8238/", "", $text);

    if ($html == 0) {

        $text = text_symbol($text);

    }

    $source[] = "/</";
    $target[] = "&lt;";
    $source[] = "/>/";
    $target[] = "&gt;";
    $source[] = "/\'/";
    $target[] = "&#039;";
    $source[] = "/\"/";
    $target[] = "&#034;";

    if ($html) {

        $source[] = "/\n/";
        $target[] = "<br/>";

    }

    return preg_replace($source, $target, $text);

}

function text2($text, $html="0", $cut="")
{

    if (!$text) {

        return false;

    }

    $text = preg_replace("/&#8238/", "", $text);
    $text = stripslashes($text);
    $text = filter_check($text, $html);

    if ($cut) {

        return text_cut($text, $cut, "");

    } else {

        return $text;

    }

}

function text3($text, $cut="")
{

    if (!$text) {

        return false;

    }

    $text = preg_replace("/&#8238/", "", $text);
    $text = trim(stripslashes(strip_tags($text)));

    $text = preg_replace("/  /i", "", $text);
    $text = preg_replace("/\\r/i", " ", $text);
    $text = preg_replace("/\\n/i", " ", $text);
    $text = preg_replace("/\&nbsp;/i", " ", $text);
    $text = preg_replace("/\&/i", "&amp;", $text);
    $text = preg_replace("/\"/", "&#034;", $text);
    $text = preg_replace("/\'/", "&#039;", $text);

    if ($cut) {

        return text_cut($text, $cut, "");

    } else {

        return $text;

    }

}

function text_view($text, $data="")
{

    if ($text) {

        return $text;

    } else {

        return $data;

    }

}

function text_hp($text, $data="")
{

    if ($text == '--' || $text == '') {

        return $data;

    } else {

        return $text;

    }

}

function text_date($view, $datetime, $data="")
{

    if ($datetime == '' || !$datetime) {

        return $data;

    }

    else if ($datetime == '0000-00-00 00:00:00') {

        return $data;

    }

    else if ($datetime == '0000-00-00') {

        return $data;

    } else {

        return date($view, strtotime($datetime));

    }

}

function text_symbol($str)
{

    return preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $str);

}

function text_cut($text, $length, $suffix="")
{

    if (!$text) {

        return false;

    }

    $text = strip_tags(htmlspecialchars_decode($text));
    $text = text2($text,1);

    if (!$length) {

        return $text;

    }

    $unicode = array();
    $values = array();
    $look = 1;

    for ($i=0; $i<strlen($text); $i++) {

        $ord = ord($text[$i]);

        if ($ord < 128) {

            $unicode[] = $ord;

        } else {

            if (count($values) == 0) {

                $look = $ord < 224 ? 2 : 3;

            }

            $values[] = $ord;

            if (count($values) == $look) {

                $number = $look == 3 ? (($values[0]%16)*4096)+(($values[1]%64)*64)+($values[2]%64) : (($values[0]%32)*64)+($values[1]%64);
                $unicode[] = $number;
                $values = array();
                $look = 1;

            }

        }

    }

    $text = "";
    $n = 0;
    for ($i=0; $i<count($unicode); $i++) {

        if ($unicode[$i] < 128) {

            $text .= chr($unicode[$i]);

        }

        else if ($unicode[$i] < 2048) {

            $text .= chr(192+(($unicode[$i]-($unicode[$i]%64))/64));
            $text .= chr(128+($unicode[$i]%64));

        } else {

            $text .= chr(224+(($unicode[$i]-($unicode[$i]%4096))/4096));
            $text .= chr(128+((($unicode[$i]%4096)-($unicode[$i]%64))/64));
            $text .= chr(128+($unicode[$i]%64));

        }

        if ($i > $length) {

            break;

        }

    }

    $text = text($text);

    if (count($unicode) > $length) {

        return $text.$suffix;

    } else {

        return $text;

    }

}

function text_split($mark, $text, $n)
{

    $s = explode($mark, $text);

    for ($i=0; $i<count($s); $i++) {

        $tmp[$i] = $s[$i];

    }

    return $tmp[$n];

}

function auto_link($str)
{

    $str = preg_replace("/&lt;/", "\t_lt_\t", $str);
    $str = preg_replace("/&gt;/", "\t_gt_\t", $str);
    $str = preg_replace("/&amp;/", "&", $str);
    $str = preg_replace("/&quot;/", "\"", $str);
    $str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
    $str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='_BLANK'>\\2</A>", $str);
    $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i", "\\1<A HREF=\"\\2\" TARGET='_BLANK'>\\2</A>", $str);
    $str = preg_replace("/([0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,4})/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
    $str = preg_replace("/\t_lt_\t/", "&lt;", $str);
    $str = preg_replace("/\t_gt_\t/", "&gt;", $str);

    return $str;

}

function auto_link2($str)
{

    $str = preg_replace("/&lt;/", "\t_lt_\t", $str);
    $str = preg_replace("/&gt;/", "\t_gt_\t", $str);
    $str = preg_replace("/&amp;/", "&", $str);
    $str = preg_replace("/&quot;/", "\"", $str);
    $str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
    $str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='_BLANK'>☞새창열기</A>", $str);
    $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i", "\\1<A HREF=\"\\2\" TARGET='_BLANK'>☞새창열기</A>", $str);
    $str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
    $str = preg_replace("/\t_lt_\t/", "&lt;", $str);
    $str = preg_replace("/\t_gt_\t/", "&gt;", $str);

    return $str;

}

function url_http($url)
{

    if (!trim($url)) {

        return;

    }

    if (!preg_match("/^(http|https|ftp|telnet|news|mms)\:\/\//i", $url)) {

        $url = "http://" . $url;

    }

    return $url;

}

function url($url)
{

    $url = preg_replace("/&amp;/", "&", $url);

    echo "<script type='text/javascript'>location.replace('$url');</script>";
    exit;

}

/*------------------------------
    ## DB 연결 ##
------------------------------*/

function sql_connect($host, $user, $pass)
{

    global $shop;

    return @mysql_connect($host, $user, $pass);

}

function sql_select_db($db, $connect)
{

    global $shop;

    if (strtolower($shop['charset']) == 'utf-8') @mysql_query(" set names utf8 ");
    else if (strtolower($shop['charset']) == 'euc-kr') @mysql_query(" set names euckr ");
    return @mysql_select_db($db, $connect);

}

function sql_query($sql, $error=TRUE)
{

    if ($error)
        $result = @mysql_query($sql) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    else
        $result = @mysql_query($sql);
    return $result;

}

function sql_fetch($sql, $error=TRUE)
{

    $result = sql_query($sql, $error);
    $row = sql_fetch_array($result);
    return $row;

}

function sql_fetch_array($result)
{

    $row = @mysql_fetch_assoc($result);
    return $row;

}

function sql_free_result($result)
{

    return mysql_free_result($result);

}

function sql_password($value)
{

    $row = sql_fetch(" select password('$value') as pass ");
    return $row[pass];

}

/*------------------------------
    ## 공통 함수 ##
------------------------------*/

function message($message="", $mode="", $url="", $html=true, $stop=true)
{

    global $shop;

    if (!$message) {

        $message = '메세지 내용이 없습니다.';

    }

    if ($url) {

        $message .= "<p class='btn'><a href='#' onclick='shopMessage(\"close\"); location.replace(\"".$url."\"); return false;' class='msgclose'><img src='".$shop['image_path']."/message_ok.gif' border='0'></a></p>";

    }

    else if ($mode == 'b') {

        $message .= "<p class='btn'><a href='#' onclick='shopMessage(\"close\"); history.go(-1); return false;' class='msgclose'><img src='".$shop['image_path']."/message_ok.gif' border='0'></a></p>";

    }

    else if ($mode == 'c') {

        $message .= "<p class='btn'><a href='#' onclick='window.close(); return false;' class='msgclose'><img src='".$shop['image_path']."/message_ok.gif' border='0'></a></p>";

    }

    else if ($mode == 'cart') {

        $message .= "<p class='btn'><a href='#' onclick='shopMessage(\"close\"); shopMove(&#034;".$shop['https_url']."/cart.php&#034;); return false;'><img src='".$shop['image_path']."/message_ok.gif' border='0'></a><a href='#' onclick='shopMessage(\"close\"); return false;' style='margin-left:2px;' class='msgclose'><img src='".$shop['image_path']."/message_cart.gif' border='0'></a></p>";

    }

    else if ($mode == 'favorite') {

        $message .= "<p class='btn'><a href='#' onclick='shopMessage(\"close\"); shopMove(&#034;".$shop['https_url']."/favorite.php&#034;); return false;'><img src='".$shop['image_path']."/message_ok.gif' border='0'></a><a href='#' onclick='shopMessage(\"close\"); return false;' style='margin-left:2px;' class='msgclose'><img src='".$shop['image_path']."/message_favorite.gif' border='0'></a></p>";

    } else {

        $message .= "<p class='btn'><a href='#' onclick='shopMessage(\"close\"); return false;' class='msgclose'><img src='".$shop['image_path']."/message_ok.gif' border='0'></a></p>";

    }

    if ($html) {

        echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
        echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
        echo "<head>";
        echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$shop['charset']."\">";
        echo "<title>알림</title>";
        echo "<link rel=\"stylesheet\" href=\"".$shop['path']."/css/default.css\" type=\"text/css\" />";
        echo "</head>";
        echo "<script type=\"text/javascript\" src=\"".$shop['path']."/js/jquery-1.7.1.min.js\"></script>";
        echo "<script type=\"text/javascript\" src=\"".$shop['path']."/js/shop.js\"></script>";
        echo "<body style='overflow:hidden;'>";
        echo "<div id='overlay'></div>";
        echo "<div id='message_box'></div>";

    }

    $message = preg_replace("/\"/", "&#034;", $message);

    echo "<script type='text/javascript'>$(document).ready(function() { setTimeout( function() { $('#message_box').html(\"$message\"); shopMessage('open'); }, 300 ); }); </script>";

    if ($html) {

        echo "</body>";
        echo "</html>";

    }

    if ($stop) {

        exit;

    }

}

function alert($msg='', $url='')
{

    global $shop;

    if (!$msg) {

        $msg = '메세지 내용이 없습니다.';

    }

    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$shop[charset]\">";
    echo "<script type='text/javascript'>alert('$msg');";

    if (!$url) {

        echo "history.go(-1);";

    }

    echo "</script>";

    if ($url) {

        shop_url($url);

    }

    exit;

}

function alert_close($msg)
{

    global $shop;

    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$shop[charset]\">";
    echo "<script type='text/javascript'> alert('$msg'); window.close(); </script>";
    exit;

}

// 필터1
function filter1($text, $html="0", $cut="")
{

    if (!$text) {

        return false;

    }

    $text = stripslashes(strip_tags($text));

    $text = preg_replace("/&amp;/", "&", $text);

    if ($html == '0') {

        $text = preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $text);

    }

    $source[] = "/</";
    $target[] = "&lt;";
    $source[] = "/>/";
    $target[] = "&gt;";
    $source[] = "/\"/";
    $target[] = "&#034;";
    $source[] = "/\'/";
    $target[] = "&#039;";

    if ($html) {

        $source[] = "/\n/";
        $target[] = "<br/>";

    }

    $text = preg_replace($source, $target, $text);

    if ($cut) {

        return shop_text_cut($text, $cut, "...");

    } else {

        return $text;

    }

}

// 필터2
function filter2($text, $html="0", $cut="")
{

    if (!$text) {

        return false;

    }

    $text = stripslashes($text);
    $text = filter_check($text, $html);

    if ($cut) {

        return shop_text_cut($text, $cut, "...");

    } else {

        return $text;

    }

}

// 필터3
function filter3($text, $cut="")
{

    if (!$text) {

        return false;

    }

    $text = trim(stripslashes(strip_tags($text)));

    $text = preg_replace("/  /i", "", $text);
    $text = preg_replace("/\\r/i", " ", $text);
    $text = preg_replace("/\\n/i", " ", $text);
    $text = preg_replace("/\&nbsp;/i", " ", $text);
    $text = preg_replace("/\&/i", "&amp;", $text);
    $text = preg_replace("/\"/", "&#034;", $text);
    $text = preg_replace("/\'/", "&#039;", $text);

    if ($cut) {

        return shop_text_cut($text, $cut, "...");

    } else {

        return $text;

    }

}

// 악성코드 차단
function filter_check($text, $html="", $tag="")
{

    if ($html) {

        $source = array();
        $target = array();

        $source[] = "//";
        $target[] = "";

         // 자동 줄바꿈
        if ($html == 2) {

            $source[] = "/\n/";
            $target[] = "<br/>";

        }

        // div 태그의 갯수를 세어 깨지지 않도록 한다.
        $table_begin_count = substr_count(strtolower($text), "<div");
        $table_end_count = substr_count(strtolower($text), "</div");
        for ($i=$table_end_count; $i<$table_begin_count; $i++) {

            $text .= "</div>";

        }

        $text = preg_replace($source, $target, $text);

        if (!$tag) {

            $text = preg_replace('@<(\/?(?:html|body|head|title|meta|base|link|script|style|applet|gsound|frame|frameset|layer|ilayer|object|xml|plaintext|form)(/*).*?>)@i', '&lt;$1', $text);
            $text = preg_replace_callback('@<(/?)([a-z]+[0-9]?)((?>"[^"]*"|\'[^\']*\'|[^>])*?\b(?:on[a-z]+|data|style|background|href|(?:dyn|low)?src)\s*=[\s\S]*?)(/?)($|>|<)@i', 'filter_callback', $text);

        }

        // 이런 경우를 방지함 <IMG STYLE="xss:expr/*XSS*/ession(alert('XSS'))">
        $text = preg_replace("#\/\*.*\*\/#iU", "", $text);

        $text = preg_replace("/(on)([a-z]+)([^a-z]*)(\=)/i", "&#111;&#110;$2$3$4", $text);
        $text = preg_replace("/(dy)(nsrc)/i", "&#100;&#121;$2", $text);
        $text = preg_replace("/(lo)(wsrc)/i", "&#108;&#111;$2", $text);
        $text = preg_replace("/(sc)(ript)/i", "&#115;&#99;$2", $text);
        $text = preg_replace("/\<(\w|\s|\?)*(xml)/i", "", $text);

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

        // 공백 처리
        $text = str_replace("  ", "&nbsp; ", $text);
        $text = str_replace("\n ", "\n&nbsp;", $text);

        $text = shop_text($text, 1);

        $text = shop_auto_link($text);

    }

    return $text;

}

function filter_callback($match)
{

    $tag = strtolower($match[2]);

    if ($tag == 'xmp') {

        return "<{$match[1]}xmp>";

    }

    if ($match[1]) {

        return $match[0];

    }

    if ($match[4]) {

        $match[4] = ' ' . $match[4];

    }

    $attrs = array();
    if (preg_match_all('/([\w:-]+)\s*=(?:\s*(["\']))?(?(2)(.*?)\2|([^ ]+))/s', $match[3], $m)) {

        foreach($m[1] as $idx => $name) {

            if (strlen($name) >= 2 && substr_compare($name, 'on', 0, 2) === 0) {

                continue;

            }

            $val = preg_replace('/&#(?:x([a-fA-F0-9]+)|0*(\d+));/', 'chr("\\1"?0x00\\1:\\2+0)', $m[3][$idx] . $m[4][$idx]);
            $val = preg_replace('/^\s+|[\t\n\r]+/', '', $val);

            if (preg_match('/^[a-z]+script:/i', $val)) {

                continue;

            }

            $attrs[$name] = $val;

        }

    }

    if (isset($attrs['style']) && preg_match('@(?:/\*|\*/|\n|:\s*expression\s*\()@i', $attrs['style'])) {
        unset($attrs['style']);
    }

    $attr = array();
    foreach($attrs as $name => $val) {

        if ($tag == 'object' || $tag == 'embed' || $tag == 'a') {

            $attribute = strtolower(trim($name));

            if ($attribute == 'data' || $attribute == 'src' || $attribute == 'href') {

                if (stripos($val, 'data:') === 0) {

                    continue;

                }

            }

        }

        if ($tag == 'img') {

            $attribute = strtolower(trim($name));

            if (stripos($val, 'data:') === 0) {

                continue;

            }

        }

        $val = str_replace('"', '&quot;', $val);
        $attr[] = $name . "=\"{$val}\"";

    }

    $attr = count($attr) ? ' ' . implode(' ', $attr) : '';

    return "<{$match[1]}{$tag}{$attr}{$match[4]}>";

}

// block
function shop_keyword_filter($text)
{

    global $dmshop;

    if (!$text || !$dmshop['block_keyword']) { return false; }

    $text = preg_replace("/[A-Za-z0-9\-|,.\&;\/\!\?\~\[\]]/", "", $text);
    //$text = preg_replace("/(ㄱ|ㄴ|ㄷ|ㄹ|ㅁ|ㅂ|ㅅ|ㅇ|ㅈ|ㅊ|ㅋ|ㅌ|ㅍ|ㅎ)/", "", $text);

    $replace = "는|은|도|이|는게|놈아|싶어|싶다|인가|에서|를|을|네|들아|들|야|하고|하자|할까|다|냐|왕";
    $text = preg_replace("/($replace)$/", "", $text);
    $text = preg_replace("/($replace)([[:space:]])/", " ", $text);

    $filter_list = "";
    $filter_list = $dmshop['block_keyword'];
    $filter_list = str_replace(", ", ",", $filter_list);
    $filter_list = str_replace(" ,", ",", $filter_list);
    $filter_list = trim(str_replace(",", "|", $filter_list));

    $security = false;

    if (preg_match("/^($filter_list)$/", $text)) {

        $security = true;

    }

    else if (preg_match("/^($filter_list)/", $text)) {

        $security = true;

    }

    else if (preg_match("/($filter_list)$/", $text)) {

        $security = true;

    }

    else if (preg_match("/^($filter_list)([[:space:]])/", $text)) {

        $security = true;

    }

    else if (preg_match("/($filter_list)([[:space:]])/", $text)) {

        $security = true;

    }

    else if (preg_match("/([[:space:]])($filter_list)/", $text)) {

        $security = true;

    }

    else if (preg_match("/([[:space:]])($filter_list)$/", $text)) {

        $security = true;

    }

    else if (preg_match("/([[:space:]])($filter_list)([[:space:]])/", $text)) {

        $security = true;

    } else {

        // pass

    }

    if ($security) {

        return true;

    } else {

        return false;

    }

}

// 이동
function shop_url($url)
{

    echo "<script type='text/javascript'>location.replace('$url');</script>";
    exit;

}

// 세션변수 생성
function shop_set_session($session_name, $value)
{

    if (PHP_VERSION < '5.3.0')
        session_register($session_name);
    // PHP 버전별 차이를 없애기 위한 방법
    $$session_name = $_SESSION["$session_name"] = $value;

}

// 세션변수값 얻음
function shop_get_session($session_name)
{

    return $_SESSION[$session_name];

}

// 쿠키변수 생성
function shop_set_cookie($cookie_name, $value, $expire)
{

    global $shop, $dmshop;

    setcookie(md5($cookie_name), base64_encode($value), $shop['server_time'] + $expire, '/', $dmshop['cookie_domain']);

}

// 쿠키변수값 얻음
function shop_get_cookie($cookie_name)
{

    return base64_decode($_COOKIE[md5($cookie_name)]);
    //return $_COOKIE[md5($cookie_name)];

}

// 파일의 용량을 구한다.
function shop_filesize($size)
{

    if ($size >= 1048576) {

        $size = number_format($size/1048576, 1) . "M";

    }

    else if ($size >= 1024) {

        $size = number_format($size/1024, 1) . "K";

    } else {

        $size = number_format($size, 0) . "byte";

    }

    return $size;

}

// 폴더 용량
function shop_dirsize($dir)
{

    $size = 0;
    $d = dir($dir);
    while ($entry = $d->read()) {

        if ($entry != "." && $entry != "..") {

            $size += filesize("$dir/$entry");

        }

    }

    $d->close();

    return $size;

}

// 파일 뷰 (이미지, 플래쉬)
function shop_file_view($file, $width, $height)
{

    static $ids;

    $ids++;

    if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file)) {

        return "<img src='{$file}' width='".$width."' height='".$height."' border='0'>";

    } else {

        return false;

    }

}

// 태그 출력
function shop_text($str, $html=0)
{

    $str = stripslashes($str);

    if ($html == 0) {

        $str = shop_text_symbol($str);

    }

    $source[] = "/</";
    $target[] = "&lt;";
    $source[] = "/>/";
    $target[] = "&gt;";
    $source[] = "/\'/";
    $target[] = "&#039;";
    $source[] = "/\"/";
    $target[] = "&#034;";

    if ($html) {

        $source[] = "/\n/";
        $target[] = "<br/>";

    }

    return preg_replace($source, $target, $str);

}

// 텍스트 출력
function shop_text_view($text, $html)
{

    if ($html) {

        // XSS
        $text = preg_replace("/(on)([a-z]+)([^a-z]*)(\=)/i", "&#111;&#110;$2$3$4", $text);
        $text = preg_replace("/(dy)(nsrc)/i", "&#100;&#121;$2", $text);
        $text = preg_replace("/(lo)(wsrc)/i", "&#108;&#111;$2", $text);
        $text = preg_replace("/(sc)(ript)/i", "&#115;&#99;$2", $text);
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

// symbol
function shop_text_symbol($str)
{

    return preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $str);

}

// 문자길이 자름
function shop_text_cut($text, $length, $suffix="…")
{

    if (!$text) {

        return false;

    }

    if (!$length) {

        return $text;

    }

    $c = 0;
    $n = 0;
    $cut = 0;
    for ($i=0; $i<strlen($text); $i++) {

        $cut++;

        $ord = ord($text[$i]);

        if ($ord < '128') {

            $c++;

        } else {

            $n++;

            if ($n == '3') {

                $c++;
                $n = 0;

            }

        }

        if ($c >= $length) {

            break;

        }

    }

    $data = substr($text, 0, $cut);

    if ($c >= $length) {

        return $data.$suffix;

    } else {

        return $data;

    }

}

// 문자열 숨김
function shop_text_last($str, $len, $suffix="…")
{

    return substr($str, 0, $len, $suffix);

}

// 자동 링크
function shop_auto_link($str)
{

    $str = preg_replace("/&lt;/", "\t_lt_\t", $str);
    $str = preg_replace("/&gt;/", "\t_gt_\t", $str);
    $str = preg_replace("/&amp;/", "&", $str);
    $str = preg_replace("/&quot;/", "\"", $str);
    $str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
    $str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='_BLANK'>\\2</A>", $str);
    $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i", "\\1<A HREF=\"\\2\" TARGET='_BLANK'>\\2</A>", $str);
    $str = preg_replace("/([0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,4})/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
    $str = preg_replace("/\t_lt_\t/", "&lt;", $str);
    $str = preg_replace("/\t_gt_\t/", "&gt;", $str);

    return $str;

}

// 날짜별 디렉토리
function shop_data_path($m, $datetime)
{

    global $shop;

    if ($m == '') {

        $date = date("Y-m-d", $shop['server_time']);

    }

    else if ($m == 'u') {

        $date = date("Y-m-d", strtotime($datetime));

    }

    return $date;

}

// 요일
function shop_week($w)
{

    if ($w == '1') {

        $msg = "월";

    }

    else if ($w == '2') {

        $msg = "화";

    }

    else if ($w == '3') {

        $msg = "수";

    }

    else if ($w == '4') {

        $msg = "목";

    }

    else if ($w == '5') {

        $msg = "금";

    }

    else if ($w == '6') {

        $msg = "토";

    }

    else if ($w == '0') {

        $msg = "일";

    }

    return $msg;

}

// 썸네일 생성방식
function shop_thumb_type($id)
{

    // 자동비율
    if ($id == '1') {

        $data = "0";

    }

    // 원본
    else if ($id == '2') {

        $data = "none";

    } else {
    // ARC

        $data = "2";

    }

    return $data;

}

// 썸네일 생성
function shop_thumb($thumb_width, $thumb_height, $img_source, $img_thumb='', $is_cut="", $quality="100", $crop_left="0", $crop_right="0", $crop_top="0", $crop_bottom="0")
{

    if (file_exists($img_source)) {

        // pass

    } else {

        return false;

    }

    global $shop;

    // gif
    $gifsicle_path = $shop['gifsicle_path'];

    if (!$img_thumb) {

        $img_thumb = $img_source;

    }

    $size = @getimagesize($img_source);

    if ($size[2] == 1) {

        $source = @imagecreatefromgif($img_source);

    }

    else if ($size[2] == 2) {

        $source = @imagecreatefromjpeg($img_source);

    }

    else if ($size[2] == 3) {

        $source = @imagecreatefrompng($img_source);

    } else {

        return false;

    }

    // ARC
    if ($is_cut == '2') {

        $size[0] = (int)($size[0] - ($crop_left + $crop_right));
        $size[1] = (int)($size[1] - $crop_top);
    
        // 가로 비율을 구한다
        $rate = $thumb_height / $size[1];
        $width = (int)($size[0] * $rate);
    
        // 세로 비율을 구한다
        $rate = $thumb_width / $size[0];
        $height = (int)($size[1] * $rate);

        // 원본이 썸네일보다 작을 때 (가로 세로 작다)
        if ($size[0] <= $thumb_width && $size[1] <= $thumb_height) {
    
            // 원본 비율
            $target = @imagecreatetruecolor($size[0], $size[1]);
            @imagecopyresampled($target, $source, 0, 0, 0, 0, $size[0], $size[1], $size[0], $size[1]);
    
        }

        // 가로가 크다
        else if ($size[0] > $size[1]) {
    
            // 원본 가로가 썸네일보다 작다면
            if ($size[0] < $thumb_width) {
    
                $thumb_width = $size[0];
    
            }
    
            // 원본 세로가 썸네일보다 작다면
            if ($size[1] < $thumb_height) {
    
                $thumb_height = $size[1];
    
            }
    
            // 가로비율이 썸네일보다 작다면
            if ($width < $thumb_width) {
    
                $create_width = $thumb_width;
    
            } else {
    
                $create_width = $width;
    
            }
    
            // 세로비율이 썸네일보다 작다면
            if ($height < $thumb_height) {
    
                $create_height = $thumb_height;
    
            } else {
    
                $create_height = $height;
    
            }
    
            $target = @imagecreatetruecolor($thumb_width, $thumb_height);
            @imagecopyresampled($target, $source, 0, 0, $crop_left, $crop_top, $create_width, $create_height, $size[0], $size[1]);
    
        }

        // 세로가 크다
        else if ($size[0] < $size[1]) {
    
            // 원본 가로가 썸네일보다 작다면
            if ($size[0] < $thumb_width) {
    
                $thumb_width = $size[0];
    
            }
    
            // 원본 세로가 썸네일보다 작다면
            if ($size[1] < $thumb_height) {
    
                $thumb_height = $size[1];
    
            }
    
            // 가로비율이 썸네일보다 작다면
            if ($width < $thumb_width) {
    
                $create_width = $thumb_width;
    
            } else {
    
                $create_width = $width;
    
            }
    
            // 세로비율이 썸네일보다 작다면
            if ($height < $thumb_height) {
    
                $create_height = $thumb_height;
    
            } else {
    
                $create_height = $height;
    
            }
    
            $target = @imagecreatetruecolor($thumb_width, $thumb_height);
            @imagecopyresampled($target, $source, 0, 0, $crop_left, $crop_top, $create_width, $create_height, $size[0], $size[1]);
    
        } else {
        // 가로세로 같을 때 비율처리
    
            // 가로 비율이 썸네일을 초과
            if ($width > $thumb_width) {
    
                $create_width = $thumb_width;
    
            } else {
            // 미초과
    
                $create_width = $width;
    
            }
    
            // 세로 비율이 썸네일을 초과
            if ($height > $thumb_height) {
    
                $create_height = $thumb_height;
    
            } else {
            // 미초과
    
                $create_height = $height;
    
            }
    
            $target = @imagecreatetruecolor($create_width, $create_height);
            @imagecopyresampled($target, $source, 0, 0, $crop_left, $crop_top, $create_width, $create_height, $size[0], $size[1]);
    
        }

        @imagejpeg($target, $img_thumb, $quality);
        @chmod($img_thumb, 0606); // 추후 삭제를 위하여 파일모드 변경

    } else {

        // 원본이 썸네일보다 작을 때 (가로 세로 작다)
        if ($size[0] <= $thumb_width && $size[1] <= $thumb_height || $is_cut == 'none') {

            // gif
            if ($shop['gifsicle_use'] && $size[2] == 1) {

                @exec(" $gifsicle_path --interlace --resize {$size[0]}"."x"."{$size[1]} {$img_source} > {$img_thumb} ");

            } else {
            // etc

                // 원본 비율
                $target = @imagecreatetruecolor($size[0], $size[1]);
                @imagecopyresampled($target, $source, 0, 0, 0, 0, $size[0], $size[1], $size[0], $size[1]);

                // jpg, png
                if ($size[2] == 2 || $size[2] == 3) {

                    @UnsharpMask($target, 50, 0.5, 0);

                }

                @imagejpeg($target, $img_thumb, $quality);

            }

        } else {

            $size[0] = (int)($size[0] - ($crop_left + $crop_right));
            $size[1] = (int)($size[1] - $crop_top);

            // 가로 비율을 구한다
            $rate = $thumb_height / $size[1];
            $width = (int)($size[0] * $rate);

            // 세로 비율을 구한다
            $rate = $thumb_width / $size[0];
            $height = (int)($size[1] * $rate);

            // 가로 비율이 썸네일을 초과
            if ($width > $thumb_width) {

                $create_width = $thumb_width;

            } else {
            // 미초과

                $create_width = $width;

            }

            // 세로 비율이 썸네일을 초과
            if ($height > $thumb_height) {

                $create_height = $thumb_height;

            } else {
            // 미초과

                $create_height = $height;

            }

            // gif
            if ($shop['gifsicle_use'] && $size[2] == 1) {

                @exec(" $gifsicle_path --interlace --resize {$create_width}"."x"."{$create_height} {$img_source} > {$img_thumb} ");

            } else {
            // etc

                $target = @imagecreatetruecolor($create_width, $create_height);
                @imagecopyresampled($target, $source, 0, 0, $crop_left, $crop_top, $create_width, $create_height, $size[0], $size[1]);

                // jpg, png
                if ($size[2] == 2 || $size[2] == 3) {

                    @UnsharpMask($target, 50, 0.5, 0);

                }

                @imagejpeg($target, $img_thumb, $quality);

            }

        }

        @chmod($img_thumb, 0606); // 추후 삭제를 위하여 파일모드 변경

    }

}

/*
Unsharp Mask for PHP - version 2.1.1  
Unsharp mask algorithm by Torstein Hønsi 2003-07.  
thoensi_at_netcom_dot_no.  
Please leave this notice.  
http://vikjavev.no/computing/ump.php

Amount: 50 - 200
Radius: 0.5 - 1
Threshold: 0 - 5
*/
function UnsharpMask($img, $amount, $radius, $threshold) {

    // $img is an image that is already created within php using 
    // imgcreatetruecolor. No url! $img must be a truecolor image. 

    // Attempt to calibrate the parameters to Photoshop: 
    if ($amount > 500)    $amount = 500; 
    $amount = $amount * 0.016; 
    if ($radius > 50)    $radius = 50; 
    $radius = $radius * 2; 
    if ($threshold > 255)    $threshold = 255; 
     
    $radius = abs(round($radius));     // Only integers make sense. 
    if ($radius == 0) { 
        return $img; imagedestroy($img); break;        } 
    $w = imagesx($img); $h = imagesy($img); 
    $imgCanvas = imagecreatetruecolor($w, $h); 
    $imgBlur = imagecreatetruecolor($w, $h); 
     

    // Gaussian blur matrix: 
    //                         
    //    1    2    1         
    //    2    4    2         
    //    1    2    1         
    //                         
    ////////////////////////////////////////////////// 
         

    if (function_exists('imageconvolution')) { // PHP >= 5.1  
            $matrix = array(  
            array( 1, 2, 1 ),  
            array( 2, 4, 2 ),  
            array( 1, 2, 1 )  
        );  
        imagecopy ($imgBlur, $img, 0, 0, 0, 0, $w, $h); 
        imageconvolution($imgBlur, $matrix, 16, 0);  
    }  
    else {  

    // Move copies of the image around one pixel at the time and merge them with weight 
    // according to the matrix. The same matrix is simply repeated for higher radii. 
        for ($i = 0; $i < $radius; $i++)    { 
            imagecopy ($imgBlur, $img, 0, 0, 1, 0, $w - 1, $h); // left 
            imagecopymerge ($imgBlur, $img, 1, 0, 0, 0, $w, $h, 50); // right 
            imagecopymerge ($imgBlur, $img, 0, 0, 0, 0, $w, $h, 50); // center 
            imagecopy ($imgCanvas, $imgBlur, 0, 0, 0, 0, $w, $h); 

            imagecopymerge ($imgBlur, $imgCanvas, 0, 0, 0, 1, $w, $h - 1, 33.33333 ); // up 
            imagecopymerge ($imgBlur, $imgCanvas, 0, 1, 0, 0, $w, $h, 25); // down 
        } 
    } 

    if($threshold>0){ 
        // Calculate the difference between the blurred pixels and the original 
        // and set the pixels 
        for ($x = 0; $x < $w-1; $x++)    { // each row
            for ($y = 0; $y < $h; $y++)    { // each pixel 
                     
                $rgbOrig = ImageColorAt($img, $x, $y); 
                $rOrig = (($rgbOrig >> 16) & 0xFF); 
                $gOrig = (($rgbOrig >> 8) & 0xFF); 
                $bOrig = ($rgbOrig & 0xFF); 
                 
                $rgbBlur = ImageColorAt($imgBlur, $x, $y); 
                 
                $rBlur = (($rgbBlur >> 16) & 0xFF); 
                $gBlur = (($rgbBlur >> 8) & 0xFF); 
                $bBlur = ($rgbBlur & 0xFF); 
                 
                // When the masked pixels differ less from the original 
                // than the threshold specifies, they are set to their original value. 
                $rNew = (abs($rOrig - $rBlur) >= $threshold)  
                    ? max(0, min(255, ($amount * ($rOrig - $rBlur)) + $rOrig))  
                    : $rOrig; 
                $gNew = (abs($gOrig - $gBlur) >= $threshold)  
                    ? max(0, min(255, ($amount * ($gOrig - $gBlur)) + $gOrig))  
                    : $gOrig; 
                $bNew = (abs($bOrig - $bBlur) >= $threshold)  
                    ? max(0, min(255, ($amount * ($bOrig - $bBlur)) + $bOrig))  
                    : $bOrig; 
                 
                 
                             
                if (($rOrig != $rNew) || ($gOrig != $gNew) || ($bOrig != $bNew)) { 
                        $pixCol = ImageColorAllocate($img, $rNew, $gNew, $bNew); 
                        ImageSetPixel($img, $x, $y, $pixCol); 
                    } 
            } 
        } 
    } 
    else{ 
        for ($x = 0; $x < $w; $x++)    { // each row 
            for ($y = 0; $y < $h; $y++)    { // each pixel 
                $rgbOrig = ImageColorAt($img, $x, $y); 
                $rOrig = (($rgbOrig >> 16) & 0xFF); 
                $gOrig = (($rgbOrig >> 8) & 0xFF); 
                $bOrig = ($rgbOrig & 0xFF); 
                 
                $rgbBlur = ImageColorAt($imgBlur, $x, $y); 
                 
                $rBlur = (($rgbBlur >> 16) & 0xFF); 
                $gBlur = (($rgbBlur >> 8) & 0xFF); 
                $bBlur = ($rgbBlur & 0xFF); 
                 
                $rNew = ($amount * ($rOrig - $rBlur)) + $rOrig; 
                    if($rNew>255){$rNew=255;} 
                    elseif($rNew<0){$rNew=0;} 
                $gNew = ($amount * ($gOrig - $gBlur)) + $gOrig; 
                    if($gNew>255){$gNew=255;} 
                    elseif($gNew<0){$gNew=0;} 
                $bNew = ($amount * ($bOrig - $bBlur)) + $bOrig; 
                    if($bNew>255){$bNew=255;} 
                    elseif($bNew<0){$bNew=0;} 
                $rgbNew = ($rNew << 16) + ($gNew <<8) + $bNew; 
                    ImageSetPixel($img, $x, $y, $rgbNew); 
            } 
        } 
    } 
    imagedestroy($imgCanvas); 
    imagedestroy($imgBlur); 
     
    return $img; 

}

// 이미지 저장
function shop_image_save($source, $file, $mode=false)
{

    global $shop;

    // 저장 경로 지정
    $tmp_dir = $shop['path']."/data/tmp";

    // 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
    @mkdir("$tmp_dir", 0707);
    @chmod("$tmp_dir", 0707);

    // 원본파일
    $source = shop_text($source);

    // file type
    if (!preg_match("/\.(jp[e]?g|gif|png)$/i", $file)) {

        return false;

    }

    // 파일명 선언
    $tmp_filename = $file;

    // 쓰기파일
    $target = $tmp_dir . "/" . $tmp_filename;

    // 읽기, 쓰기
    $rf = @fopen($source, 'r');
    $wf = @fopen($target, 'w');

    // error reading or opening file
    if ($rf == false || $wf == false) {

        return false;

    }

    while (!feof($rf)) {

        // 'Download error: Cannot write to file ('.$target.')';
        if (fwrite($wf, fread($rf, 1024)) == false) {

            return false;

        }

    }

    @fclose($rf);
    @fclose($wf);
    @chmod($wf, 0606);

    // 파일 사이즈
    $tmp_size = @filesize($target);

    // 파일 정보
    $tmp_type = @getimagesize($target);

    // 이미지 파일이 있다면.
    if ($tmp_size && ($tmp_type[2] == '1' || $tmp_type[2] == '2' || $tmp_type[2] == '3')) {

        return $target;

    } else {
    // 삭제

        @unlink($target);

    }

}

// 파일 확장자
function shop_image_type($source)
{

    // .으로 배열처리
    $file = explode('.', $source); // test.jpg.bmp.gif

    // 마지막 배열 구하기
    $file = array_pop($file); // -> gif

    // 확장자 체크
    if (preg_match("/(jpg)/i", $file)) {

        $filetype = "jpg";

    }

    else if (preg_match("/(jpeg)/i", $file)) {

        $filetype = "jpeg";

    }

    else if (preg_match("/(gif)/i", $file)) {

        $filetype = "gif";

    }

    else if (preg_match("/(png)/i", $file)) {

        $filetype = "png";

    }

    else if (preg_match("/(bmp)/i", $file)) {

        $filetype = "bmp";

    } else {

        //return true;
        $filetype = "jpg";

    }

    // .jpg 형식으로 출력.
    return ".".$filetype;

}

// url에 http:// 를 붙인다
function shop_http($url)
{

    if (!trim($url)) {

        return;

    }

    if (!preg_match("/^(http|https|ftp|telnet|news|mms)\:\/\//i", $url)) {

        $url = "http://" . $url;

    }

    return $url;

}

// 스킨경로를 얻는다
function shop_skin_dir($skin, $len='')
{
    global $shop;

    $result_array = array();

    $dirname = "$shop[path]/skin/$skin/";
    $handle = opendir($dirname);
    while ($file = readdir($handle)) 
    {
        if($file == "."||$file == "..") continue;

        if (is_dir($dirname.$file)) $result_array[] = $file;
    }
    closedir($handle);
    sort($result_array);

    return $result_array;
}

// 부호 쪼갠다
function shop_split($mark, $text, $n)
{

    $s = explode($mark, $text);

    for ($i=0; $i<count($s); $i++) {

        $tmp[$i] = $s[$i];

    }

    return $tmp[$n];

}

// 포지션
function shop_position($id)
{

    if ($id == '0') {

        $data = "left";

    }

    else if ($id == '1') {

        $data = "center";

    }

    else if ($id == '2') {

        $data = "right";

    } else {

        $data = "left";

    }

    return $data;

}

// 삭제
function shop_delete($file) 
{

    if (file_exists($file)) {

        @chmod($file,0777);

        if (is_dir($file)) {

            $handle = opendir($file); 

            while($filename = readdir($handle)) {

                if ($filename != "." && $filename != "..") {

                    shop_delete("$file/$filename");

                }

            }

            closedir($handle);
            rmdir($file);

        } else {

            unlink($file);

        }

    }

}

// utf8
function shop_is_utf8($string)
{

    // From http://w3.org/International/questions/qa-forms-utf-8.html
    return preg_match('%^(?:
          [\x09\x0A\x0D\x20-\x7E]            # ASCII
        | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
        |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
        | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
        |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
        |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
        | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
        |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
    )*$%xs', $string);

}

// 이메일 전송
function shop_email_send($to_email, $title, $content, $from_name, $from_email, $html_type)
{

    global $shop;

    $from_name   = "=?".$shop['charset']."?B?" . base64_encode($from_name) . "?=";
    $title = "=?".$shop['charset']."?B?" . base64_encode($title) . "?=";

    $header = "Return-Path: <$from_email>\n";
    $header .= "From: $from_name <$from_email>\n";
    $header .= "Reply-To: <$from_email>\n";
    $header .= "MIME-Version: 1.0\n";
    $header .= "X-Mailer: DMSHOP Mailer 0.1 (dmshop.kr) : $_SERVER[SERVER_ADDR] : $_SERVER[REMOTE_ADDR] : $shop[url] : $_SERVER[PHP_SELF] : $_SERVER[HTTP_REFERER] \n";

    if ($html_type) {

        $header .= "Content-Type: TEXT/HTML; charset=".$shop['charset']."\n";

        if ($html_type == '2') {

            $content = nl2br($content);

        }

    } else {

        $header .= "Content-Type: TEXT/PLAIN; charset=".$shop['charset']."\n";
        $content = stripslashes($content);

    }

    $header .= "Content-Transfer-Encoding: BASE64\n\n";
    $header .= chunk_split(base64_encode($content)) . "\n";

    @mail($to_email, $title, "", $header);

}

// sns url
function shop_sns_url($sns, $url, $title)
{

    global $dmshop;

    $dmshop['shop_name'] = str_replace("\"", "", $dmshop['shop_name']);
    $title = str_replace("\"", "", $title);

    $url = "http://".$dmshop['domain'].$url;

    if ($sns == '1') {

        $link = "http://twitter.com/?status=".urlencode($title." ".$url);

    }

    else if ($sns == '2') {

        $link = "http://www.facebook.com/sharer.php?u=".urlencode($url)."&t=".urlencode($title);

    }

    else if ($sns == '3') {

        $link = "http://me2day.net/posts/new?new_post[body]=".urlencode($title)."+++++++[\"".urlencode($dmshop['shop_name'])."\":".urlencode($url)."+]&new_post[tags]=".urlencode($title);

    }

    else if ($sns == '4') {

        $link = "http://yozm.daum.net/api/popup/prePost?sourceid=41&link=".urlencode($url)."&prefix=".urlencode($title);

    } else {

        return false;

    }

    return $link;

}

// 통계 스타일
function shop_reporting_style($mode)
{

    if ($mode == 'list_title') {

        $data = " class='text' style='padding:5px; min-width:120px; width:120px; _width:120px; height:30px; text-align:center; line-height:18px; font-size:12px; color:#959595; font-family:dotum,돋움; border-right:1px solid #e4e4e4;' ";

    }

    else if ($mode == 'list_title_area') {

        $data = " class='text' style='padding:5px; min-width:60px; width:60px; _width:60px; height:30px; text-align:center; line-height:18px; font-size:12px; color:#959595; font-family:dotum,돋움; border-right:1px solid #e4e4e4;' ";

    }

    else if ($mode == 'list_text') {

        $data = " class='text' style='text-align:center; line-height:40px; height:40px; font-size:12px; color:#474747; font-family:gulim,굴림; border-right:1px solid #e4e4e4;' ";

    }

    else if ($mode == 'list_text_bold') {

        $data = " class='text' style='text-align:center; font-weight:bold; line-height:40px; height:40px; font-size:12px; color:#474747; font-family:gulim,굴림; border-right:1px solid #e4e4e4;' ";

    } else {

        return false;

    }

    return $data;

}

// 폰트명
function shop_option_font_family()
{

    $option_font_family = "";
    $option_font_family .= "<option value='gulim' style='font-family:gulim;'>굴림</option>";
    $option_font_family .= "<option value='dotum' style='font-family:dotum;'>돋움</option>";
    $option_font_family .= "<option value='batang' style='font-family:batang;'>바탕</option>";
    $option_font_family .= "<option value='arial' style='font-family:arial;'>Arial</option>";
    $option_font_family .= "<option value='arial black' style='font-family:arial black;'>Arial Black</option>";
    $option_font_family .= "<option value='tahoma' style='font-family:tahoma;'>Tahoma</option>";
    $option_font_family .= "<option value='verdana' style='font-family:verdana;'>Verdana</option>";
    $option_font_family .= "<option value='sans-serif' style='font-family:sans-serif;'>Sans-serif</option>";
    $option_font_family .= "<option value='serif' style='font-family:serif;'>Serif</option>";
    $option_font_family .= "<option value='monospace' style='font-family:monospace;'>Monospace</option>";
    $option_font_family .= "<option value='cursive' style='font-family:cursive;'>Cursive</option>";
    $option_font_family .= "<option value='fantasy' style='font-family:fantasy;'>Fantasy</option>";

    return $option_font_family;

}

// 폰트명
function shop_option_font_size()
{

    $option_font_size = "";
    $option_font_size .= "<option value='6' style='font-size:6px;'>6px</option>";
    $option_font_size .= "<option value='8' style='font-size:8px;'>8px</option>";
    $option_font_size .= "<option value='9' style='font-size:9px;'>9px</option>";
    $option_font_size .= "<option value='10' style='font-size:10px;'>10px</option>";
    $option_font_size .= "<option value='11' style='font-size:11px;'>11px</option>";
    $option_font_size .= "<option value='12' style='font-size:12px;'>12px</option>";
    $option_font_size .= "<option value='13' style='font-size:13px;'>13px</option>";
    $option_font_size .= "<option value='14' style='font-size:14px;'>14px</option>";
    $option_font_size .= "<option value='15' style='font-size:15px;'>15px</option>";
    $option_font_size .= "<option value='16' style='font-size:16px;'>16px</option>";
    $option_font_size .= "<option value='18' style='font-size:18px;'>18px</option>";
    $option_font_size .= "<option value='24' style='font-size:24px;'>24px</option>";
    $option_font_size .= "<option value='30' style='font-size:30px;'>30px</option>";
    $option_font_size .= "<option value='36' style='font-size:36px;'>36px</option>";
    $option_font_size .= "<option value='48' style='font-size:48px;'>48px</option>";
    $option_font_size .= "<option value='60' style='font-size:60px;'>60px</option>";
    $option_font_size .= "<option value='72' style='font-size:72px;'>72px</option>";

    return $option_font_size;

}

// 번호 (전체)
function shop_option_sms1()
{

    $option = "";
    $option .= "<option value='02'>02</option>";
    $option .= "<option value='031'>031</option>";
    $option .= "<option value='032'>032</option>";
    $option .= "<option value='033'>033</option>";
    $option .= "<option value='041'>041</option>";
    $option .= "<option value='042'>042</option>";
    $option .= "<option value='043'>043</option>";
    $option .= "<option value='044'>044</option>";
    $option .= "<option value='050'>050</option>";
    $option .= "<option value='051'>051</option>";
    $option .= "<option value='052'>052</option>";
    $option .= "<option value='053'>053</option>";
    $option .= "<option value='054'>054</option>";
    $option .= "<option value='055'>055</option>";
    $option .= "<option value='061'>061</option>";
    $option .= "<option value='062'>062</option>";
    $option .= "<option value='063'>063</option>";
    $option .= "<option value='064'>064</option>";
    $option .= "<option value='010'>010</option>";
    $option .= "<option value='011'>011</option>";
    $option .= "<option value='016'>016</option>";
    $option .= "<option value='017'>017</option>";
    $option .= "<option value='018'>018</option>";
    $option .= "<option value='019'>019</option>";
    $option .= "<option value='013'>013</option>";
    $option .= "<option value='0303'>0303</option>";
    $option .= "<option value='0502'>0502</option>";
    $option .= "<option value='0504'>0504</option>";
    $option .= "<option value='0505'>0505</option>";
    $option .= "<option value='0506'>0506</option>";
    $option .= "<option value='070'>070</option>";
    $option .= "<option value='080'>080</option>";
    $option .= "<option value='1544'>1544</option>";
    $option .= "<option value='1566'>1566</option>";
    $option .= "<option value='1577'>1577</option>";
    $option .= "<option value='1588'>1588</option>";
    $option .= "<option value='1599'>1599</option>";
    $option .= "<option value='1600'>1600</option>";
    $option .= "<option value='1644'>1644</option>";
    $option .= "<option value='1661'>1661</option>";
    $option .= "<option value='1666'>1666</option>";
    $option .= "<option value='1670'>1670</option>";
    $option .= "<option value='1688'>1688</option>";

    return $option;

}

// 번호 (휴대폰)
function shop_option_sms2()
{

    $option = "";
    $option .= "<option value='010'>010</option>";
    $option .= "<option value='011'>011</option>";
    $option .= "<option value='016'>016</option>";
    $option .= "<option value='017'>017</option>";
    $option .= "<option value='018'>018</option>";
    $option .= "<option value='019'>019</option>";
    $option .= "<option value='013'>013</option>";

    return $option;

}
?>