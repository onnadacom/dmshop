<?php
include_once("./_dmshop.php");

// 스킨이 없다.
if (!$dmshop_skin['skin_zip']) {

    message("<p class='title'>알림</p><p class='text'>우편번호찾기 스킨이 설정되지 않았습니다.</p>", "b");

}

$message = "";

if ($id) { $id = preg_match("/^[0-9]+$/", $id) ? $id : ""; }

if ($q) {

    // 도로명
    if ($dmshop['zipcode'] == 1) {

        $url = "http://zipcode.teraboard.net/?id=".$id."&q=".urlencode($q);
        $url = shop_text($url);

        $data = array('id' => $id, 'q' => $q);

        while(list($n,$v) = each($data)){
            $send_data[] = "$n=$v";
        }
        $send_data = implode('&', $send_data);

        $url = parse_url($url);

        $host = $url['host'];
        $path = $url['path'];

        $fp = fsockopen($host, 80, $errno, $errstr, 5);
        if (!is_resource($fp)) {
            return false;
        }

        fputs($fp, "POST $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: " . strlen($send_data) . "\r\n");
        fputs($fp, "Connection:close" . "\r\n\r\n");
        fputs($fp, $send_data);

        $result = '';
        while(!feof($fp)) {
            $result .= fgets($fp, 128);
        }
        fclose($fp);

        $result = explode("\r\n\r\n", $result, 2);

        $header = isset($result[0]) ? $result[0] : '';
        $content = isset($result[1]) ? $result[1] : '';

        //결과 출력
        //echo $header;
        //echo $content;

        preg_match_all("/<item>(.*)<\/item>/Uis", $content, $matches);

        $message = preg_match("/<message><!\[CDATA\[(.*)\]\]><\/message>/Uis", $content, $match);
        $message = trim($match[1]);

        unset($content);

        $n = 0;
        $list = array();
        for ($i=0; $i<count($matches[1]); $i++) {

            $zipcode = preg_match("/<zipcode><!\[CDATA\[(.*)\]\]><\/zipcode>/Uis", $matches[1][$i], $match);
            $zipcode = trim($match[1]);

            $addr = preg_match("/<addr><!\[CDATA\[(.*)\]\]><\/addr>/Uis", $matches[1][$i], $match);
            $addr = trim($match[1]);

            $addr2 = preg_match("/<addr2><!\[CDATA\[(.*)\]\]><\/addr2>/Uis", $matches[1][$i], $match);
            $addr2 = trim($match[1]);

            $building = preg_match("/<building><!\[CDATA\[(.*)\]\]><\/building>/Uis", $matches[1][$i], $match);
            $building = trim($match[1]);

            $list[$n]['zip1'] = shop_split("-", filter1($zipcode), 0);
            $list[$n]['zip2'] = shop_split("-", filter1($zipcode), 1);

            $list[$n]['addr'] = filter1($addr);
            $list[$n]['addr2'] = filter1($addr2);

            if ($building) {

                $list[$n]['addr'] .= " (".filter1($building).")";
                $list[$n]['addr2'] .= " (".filter1($building).")";

            }

            $list[$n]['building'] = filter1($building);

            $n++;

        }

    } else {
    // 지번

        $array = array();
        $list = array();
        $fp = fopen($shop['path']."/zip.db", "r");
        while(!feof($fp)) {
            $array[] = fgets($fp, 4096);
        }
        fclose($fp);

        $zip_count = 0;
        foreach($array as $data) {

            if (strstr($data,$q)) {

                $list[$zip_count]['zip1'] = substr($data,0,3);
                $list[$zip_count]['zip2'] = substr($data,3,3);
    
                $addr_array = explode(' ', substr($data,7));
                if (substr($addr_array[sizeof($addr_array)-1],0,1) == '(' || intval(substr($addr_array[count($addr_array)-1],0,1))) {

                    $addr = trim(str_replace($addr_array[count($addr_array)-1], '', substr($data,7)));	

                } else {

                    $addr = trim(substr($data,7));

                }

                $list[$zip_count]['full_addr'] = trim(substr($data,7));
                $list[$zip_count]['addr'] = $addr;

                $zip_count++;

            }

        }

    }

}

// 스킨 경로
$dmshop_zip_path = "";
$dmshop_zip_path = $shop['path']."/skin/zip/".$dmshop_skin['skin_zip'];

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - 우편번호찾기";

include_once("./shop.top.php");
include_once("$dmshop_zip_path/zip.php");
include_once("./shop.bottom.php");
?>