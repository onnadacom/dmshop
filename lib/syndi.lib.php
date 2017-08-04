<?php //신디케이션
if (!defined("_DMSHOP_")) exit;

function syndi_ping()
{

    global $dmshop, $shop;

    $ping_auth_header = "Authorization: Bearer ".$dmshop['syndi_token'];
    $ping_url = urlencode($shop['url']."/xml_syndi.xml");
    $ping_client_opt = array(
    CURLOPT_URL => "https://apis.naver.com/crawl/nsyndi/v2",
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => "ping_url=" . $ping_url, 
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 10, 
    CURLOPT_TIMEOUT => 10, 
    CURLOPT_HTTPHEADER => array("Host: apis.naver.com", "Pragma: no-cache", "Accept: */*", $ping_auth_header)
    );

    $ping = curl_init();
    curl_setopt_array($ping, $ping_client_opt);
    $query = curl_exec($ping);
    curl_close($ping);

    return true;

}

function syndi_create($file, $content)
{

    if (file_exists($file)) {

        @chmod($file, 0707);

    }

    $f = fopen($file, "w");
    @fwrite($f, $content);
    @fclose($f);
    @chmod($file, 0606);

    return syndi_ping();

}

function syndi_article($bbs_id, $article_id, $mode)
{

    global $dmshop, $shop;

    if (!$bbs_id || !$article_id || !$mode) {

        return false;

    }

    $timestamp = date("Y-m-d\\TH:i:s", $shop['server_time']). "+09:00";

    $shop_board = shop_board($bbs_id);

    if (!$shop_board['bbs_id']) {

        return false;

    }

    $shop_article = shop_article($bbs_id, $article_id);

    if (!$shop_article['id']) {

        return false;

    }

    $datetime = date("Y-m-d\\TH:i:s", strtotime($shop_article['datetime'])). "+09:00";

    ob_start();

    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    echo "<feed xmlns=\"http://webmastertool.naver.com\">\n";
    echo "<id>http://".$dmshop['domain']."</id>\n";
    echo "<title>".text($dmshop['shop_name'])."</title>\n";
    echo "<author>\n";
    echo "<name>".text($dmshop['shop_name'])."</name>\n";
    echo "<email>".text($dmshop['ceo_email'])."</email>\n";
    echo "</author>\n";
    echo "<updated>".$timestamp."</updated>\n";
    echo "<link rel=\"site\" href=\"http://".text($dmshop['domain'])."\" title=\"".text($dmshop['shop_name'])."\" />\n";

    if ($mode == 'regist') {

        echo "<entry>\n";
        echo "<id>".$shop['url']."/board.php?bbs_id=".$bbs_id."&amp;article_id=".$article_id."</id>\n";
        echo "<title><![CDATA[".text($shop_article['ar_title'])."]]></title>\n";
        echo "<author>\n";
        echo "<name>".text($shop_article['ar_name'])."</name>\n";
        echo "</author>\n";
        echo "<updated>".$datetime."</updated>\n";
        echo "<published>".$datetime."</published>\n";
        echo "<link rel=\"via\" href=\"".$shop['url']."/board.php?bbs_id=".$bbs_id."\" title=\"".text($shop_board['bbs_title'])."\" />\n";
        //echo "<link rel=\"mobile\" href=\"\" />\n";
        echo "<content type=\"html\"><![CDATA[".text2($shop_article['ar_content'],1)."]]></content>\n";
        echo "<summary type=\"text\"><![CDATA[".text3($shop_article['ar_content'])."]]></summary>\n";
        //echo "<category term=\"search_info\" label=\"\" />\n";
        echo "</entry>\n";

    }

    else if ($mode == 'delete') {

        echo "<deleted-entry ref=\"".$shop['url']."/board.php?bbs_id=".$bbs_id."&amp;article_id=".$article_id."\" when=\"".$datetime."\" />\n";

    }

    echo "</feed>\n";

    $content = ob_get_contents();
    ob_end_clean();

    return $content;

}
?>