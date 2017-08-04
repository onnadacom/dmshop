<?
if (!defined('_DMSHOP_')) exit;

function shop_session_open($save_path, $session_name)
{

    global $shop, $connect_db, $select_db, $mysql_host, $mysql_user, $mysql_password, $mysql_db;

    if (!$connect_db) {

	$connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
	$select_db = sql_select_db($mysql_db, $connect_db);

	if (!$select_db) {

	    die("database error");

        }

	return $select_db;

    }

    else if ($connect_db && $select_db) {

	return $select_db;

    } else {

        return false;

    }

}

function shop_session_close()
{

    global $connect_db;

    return mysql_close($connect_db);

}

function shop_session_read($id)
{

    global $shop, $connect_db;

    $id = mysql_real_escape_string($id);

    $row = sql_fetch(" select ss_data from $shop[session_table] where id = '$id' ");

    return $row['ss_data']; 

}

function shop_session_write($id, $data)
{

    global $shop, $connect_db;

    $id = mysql_real_escape_string($id);
    $ss_data = mysql_real_escape_string($data);

    $ss_datetime = $shop['time_ymdhis'];

    $query = sql_query(" replace into $shop[session_table] values ('$id', '$ss_datetime', '$ss_data') ");

    return $query; 

}

function shop_session_destroy($id)
{

    global $shop, $connect_db;

    $id = mysql_real_escape_string($id);

    $query = sql_query(" delete from $shop[session_table] where id = '$id' ");

    return $query;

}

function shop_session_clean($clean)
{

    global $shop, $connect_db;

    $time = date("Y-m-d H:i:s", $shop['server_time'] - $clean);

    $query = sql_query(" delete from $shop[session_table] where ss_datetime < '$time' ");

    return $query;

}
?>