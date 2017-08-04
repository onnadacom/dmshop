<?
if (!defined("_DMSHOP_")) exit;

/*--------------------------------
    ## 방문자 ##
--------------------------------*/

// 브라우저
function shop_visit_browser($agent)
{

    $agent = strtolower($agent);

    if (preg_match("/msie 5.0[0-9]*/", $agent)) { $data = "MSIE 5.0"; }
    else if (preg_match("/msie 5.5[0-9]*/", $agent)) { $data = "MSIE 5.5"; }
    else if (preg_match("/msie 6.0[0-9]*/", $agent)) { $data = "MSIE 6.0"; }
    else if (preg_match("/msie 7.0[0-9]*/", $agent)) { $data = "MSIE 7.0"; }
    else if (preg_match("/msie 8.0[0-9]*/", $agent)) { $data = "MSIE 8.0"; }
    else if (preg_match("/msie 9.0[0-9]*/", $agent)) { $data = "MSIE 9.0"; }
    else if (preg_match("/msie 10.0[0-9]*/", $agent)) { $data = "MSIE 10.0"; }
    else if (preg_match("/msie 11.0[0-9]*/", $agent)) { $data = "MSIE 11.0"; }
    else if (preg_match("/msie 12.0[0-9]*/", $agent)) { $data = "MSIE 12.0"; }
    else if (preg_match("/msie 13.0[0-9]*/", $agent)) { $data = "MSIE 13.0"; }
    else if (preg_match("/msie 14.0[0-9]*/", $agent)) { $data = "MSIE 14.0"; }
    else if (preg_match("/msie 15.0[0-9]*/", $agent)) { $data = "MSIE 15.0"; }
    else if (preg_match("/msie 4.[0-9]*/", $agent)) { $data = "MSIE 4.x"; }
    else if (preg_match("/firefox/", $agent)) { $data = "Firefox"; }
    else if (preg_match("/chrome/", $agent)) { $data = "Chrome"; }
    else if (preg_match("/safari/", $agent)) { $data = "Safari"; }
    else if (preg_match("/x11/", $agent)) { $data = "Netscape"; }
    else if (preg_match("/opera/", $agent)) { $data = "Opera"; }
    else if (preg_match("/gec/", $agent)) { $data = "Gecko"; }
    else if (preg_match("/bot|slurp|daumoa/", $agent)) { $data = "Robot"; }
    else if (preg_match("/internet explorer/", $agent)) { $data = "IE"; }
    else if (preg_match("/mozilla/", $agent)) { $data = "Mozilla"; }
    else { $data = "기타"; }

    return $data;

}

// OS
function shop_visit_os($agent)
{

    $agent = strtolower($agent);

    if (preg_match("/iphone/", $agent)) { $data = "iPhone"; } //iPhone
    else if (preg_match("/ipad/", $agent)) { $data = "iPad"; } //iPad
    else if (preg_match("/iPod/", $agent)) { $data = "iPod"; } //iPod
    else if (preg_match("/android/", $agent)) { $data = "Android"; } //Android
    else if (preg_match("/psp/", $agent)) { $data = "PSP"; } //PSP
    else if (preg_match("/playstation/", $agent)) { $data = "PLAYSTATION"; } //PLAYSTATION
    else if (preg_match("/berry/", $agent)) { $data = "BlackBerry"; } //BlackBerry
    else if (preg_match("/symbian/", $agent)) { $data = "Symbian"; } //Symbian
    else if (preg_match("/ericsson/", $agent)) { $data = "SonyEricsson"; } //SonyEricsson
    else if (preg_match("/nokia/", $agent)) { $data = "Nokia"; } //Nokia
    else if (preg_match("/sph/", $agent)) { $data = "애니콜"; } //삼성폰
    else if (preg_match("/sgh/", $agent)) { $data = "옴니아"; } //옴니아
    else if (preg_match("/sch/", $agent)) { $data = "T*옴니아"; } //T*옴니아
    else if (preg_match("/im-s/", $agent)) { $data = "스카이폰"; } //스카이폰
    else if (preg_match("/lgtelecom/", $agent)) { $data = "LG 사이언"; } //LG 사이언
    else if  (preg_match("/windows 98/", $agent)) { $data = "98"; }
    else if (preg_match("/windows 95/", $agent)) { $data = "95"; }
    else if (preg_match("/windows nt 4\.[0-9]*/", $agent)) { $data = "NT"; }
    else if (preg_match("/windows nt 5\.0/", $agent)) { $data = "2000"; }
    else if (preg_match("/windows nt 5\.1/", $agent)) { $data = "XP"; }
    else if (preg_match("/windows nt 5\.2/", $agent)) { $data = "2003"; }
    else if (preg_match("/windows nt 6\.0/", $agent)) { $data = "Vista"; }
    else if (preg_match("/windows nt 6\.1/", $agent)) { $data = "Windows7"; }
    else if (preg_match("/windows 9x/", $agent)) { $data = "ME"; }
    else if (preg_match("/windows ce/", $agent)) { $data = "CE"; }
    else if (preg_match("/mac/", $agent)) { $data = "MAC"; }
    else if (preg_match("/linux/", $agent)) { $data = "Linux"; }
    else if (preg_match("/sunos/", $agent)) { $data = "sunOS"; }
    else if (preg_match("/irix/", $agent)) { $data = "IRIX"; }
    else if (preg_match("/phone/", $agent)) { $data = "Phone"; }
    else if (preg_match("/bot|slurp|daumoa/", $agent)) { $data = "Robot"; }
    else if (preg_match("/internet explorer/", $agent)) { $data = "IE"; }
    else if (preg_match("/mozilla/", $agent)) { $data = "Mozilla"; }
    else { $data = "기타"; }

    return $data;

}

// HOST
function shop_visit_host($referer)
{

    if (!$referer) {

        return false;

    }

    $host = preg_match("/^http[s]*:\/\/([\.\-\_0-9a-zA-Z]*)\//", $referer, $match);
    $host = trim($match[1]);

    if ($host) {

        return $host;

    } else {

        return false;

    }

}

// HOST NAME
function shop_visit_host_name($host)
{

    global $shop;

    //$domain = preg_replace("/\./i", ".", $host);

    if (preg_match("/(naver\.com)$/i", $host)) {

        $data = "<span class='host_naver'>네이버</span>";

    }

    else if (preg_match("/(daum\.net)$/i", $host)) {

        $data = "<span class='host_daum'>다음</span>";

    }

    else if (preg_match("/(nate\.com)$/i", $host)) {

        $data = "<span class='host_nate'>네이트</span>";

    }

    else if (preg_match("/(yahoo\.com)$/i", $host)) {

        $data = "<span class='host_yahoo'>야후</span>";

    }

    else if (preg_match("/(google\.com|google\.co\.kr)$/i", $host)) {

        $data = "<span class='host_google'>구글</span>";

    }

    //else if ($host && $domain && preg_match("/($domain)$/i", $host) || !$host) {
    else if (!$host) {

        $data = "직접";

    } else {

        $data = "기타";

    }

    return $data;

}

// 키워드
function shop_visit_keyword($referer)
{

    global $dmshop;

    if (!$referer) {

        return false;

    }

    $domain = preg_replace("/\./i", "\.", $dmshop['domain']);

    if (preg_match("/($domain)$/i", $referer)) {

        return false;

    }

    if (preg_match("/(query=|q=)/", $referer)) {

        $keyword = preg_replace("/(.*)(query=|q=)(.*)/", "$3", $referer);

        if (preg_match("/(&)/", $keyword)) {

            $keyword = preg_match("/(.*)\&/U", $keyword, $match);
            $keyword = trim($match[1]);

        }

        if (shop_is_utf8(urldecode($keyword))) { $keyword = urldecode($keyword); } else { $keyword = mb_convert_encoding(urldecode($keyword), 'UTF-8', 'CP949'); }

        if ($keyword) {

            return $keyword;

        } else {

            return false;

        }

    }

    return false;

}
?>