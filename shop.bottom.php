<?
if (!defined("_DMSHOP_")) exit;

// 관리자페이지 제외
if (!$shop['admin_page']) {

// visit start
$ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));
$agent = trim(strip_tags(mysql_real_escape_string($_SERVER['HTTP_USER_AGENT'])));
$referer = trim(strip_tags(mysql_real_escape_string($_SERVER['HTTP_REFERER'])));
$request_uri = trim(strip_tags(mysql_real_escape_string($_SERVER['REQUEST_URI'])));
$browser = shop_visit_browser($agent);
$os = shop_visit_os($agent);
$host = shop_visit_host($referer);
$keyword = shop_visit_keyword($referer);

// 오늘 방문하였는가
$dmshop_visit = sql_fetch(" select * from $shop[visit_table] where substring(vi_datetime,1,10) = '".$shop['time_ymd']."' and vi_ip = '".$ip."' order by id asc ");

// 있다면
if ($dmshop_visit['id']) {

    $vi_first = "0";

} else {
// 없다면

    $vi_first = "1";

}

$sql_common = "";
$sql_common .= " set vi_ip = '".$ip."' ";
$sql_common .= ", vi_first = '".$vi_first."' ";
$sql_common .= ", vi_browser = '".$browser."' ";
$sql_common .= ", vi_os = '".$os."' ";
$sql_common .= ", vi_agent = '".$agent."' ";
$sql_common .= ", vi_referer = '".$referer."' ";
$sql_common .= ", vi_host = '".$host."' ";
$sql_common .= ", vi_keyword = '".$keyword."' ";
$sql_common .= ", vi_url = '".$request_uri."' ";
$sql_common .= ", vi_datetime = '".$shop['time_ymdhis']."' ";

// insert
sql_query(" insert into $shop[visit_table] $sql_common ");

$visit_id = mysql_insert_id();

// 세션
$ss_name = "visit_".$ip;

// 세션이 없다면
if (!shop_get_session($ss_name)) {

    shop_set_session($ss_name, true);

    // 있다면
    if ($dmshop_visit['id']) {

        $return_id = $dmshop_visit['id'];

    } else {
    // 없다면

        $return_id = $visit_id;

    }

    // 방문횟수 기록
    sql_query(" update $shop[visit_table] set vi_return = vi_return + 1 where id = '".$return_id."' ");

}
?>
<script type="text/javascript">$(document).ready(function() { var version = $.browser.version; var resolution = screen.width+"x"+screen.height; $.post("<?=$shop['path']?>/visit_update.php", {"visit_id" : "<?=$visit_id?>", "version" : version, "resolution" : resolution}); });</script>
<?
}

// visit end

// 오늘 생일인 사람 쿠폰 지급
shop_coupon_auto_make("2", "", "");

// 오늘 생일인 사람 적립금 지급
shop_cash_auto();
?>
</body>
</html>