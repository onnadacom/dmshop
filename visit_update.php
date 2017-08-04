<?
include_once("./_dmshop.php");

if ($visit_id) { $visit_id = preg_match("/^[0-9]+$/", $visit_id) ? $visit_id : ""; }
if ($version) { $version = preg_match("/^[A-Za-z0-9\.]+$/", $version) ? $version : ""; }
if ($resolution) { $resolution = preg_match("/^[A-Za-z0-9]+$/", $resolution) ? $resolution : ""; }

if ($visit_id && $version && $resolution) {

    $ip = trim(strip_tags(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));
    $version = trim(strip_tags(mysql_real_escape_string($version)));
    $resolution = trim(strip_tags(mysql_real_escape_string($resolution)));

    $dmshop_visit = sql_fetch(" select id from $shop[visit_table] where id = '".$visit_id."' and vi_ip = '".$ip."' ");

    if ($dmshop_visit['id']) {

        $sql_common = "";
        $sql_common .= " set vi_version = '".$version."' ";
        $sql_common .= ", vi_resolution = '".$resolution."' ";

        // update
        sql_query(" update $shop[visit_table] $sql_common where id = '".$visit_id."' ");

    }

}
?>