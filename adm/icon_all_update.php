<?php
include_once("./_dmshop.php");

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 아이콘 리스트
$icons = array();
$result = sql_query(" select * from $shop[icon_file_table] order by position desc, id asc ");
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $icons[$i] = $row;

}

for ($i=0; $i<count($chk_id); $i++) {

    // 실제 번호를 넘김
    $k = $chk_id[$i];

    // update
    if ($m == 'u') {

        /*--------------------------------
            ## 상품 아이콘 ##
        --------------------------------*/

        $tmp_icon_id_add = "";

        for ($n=0; $n<count($icons); $n++) {

            $tmp_icon_id = $icons[$n]['id'];

            // 등록
            if ($_POST['icon_insert'][$k][$tmp_icon_id]) {

                $tmp_icon_id_add .= "|".$tmp_icon_id;

            }

        }

        if ($tmp_icon_id_add) {

            $tmp_icon_id_add = $tmp_icon_id_add."|";

            // update
            sql_query(" update $shop[item_table] set item_icon = '".addslashes($tmp_icon_id_add)."' where id = '".addslashes($_POST['item_id'][$k])."' ");

        } else {

            // update
            sql_query(" update $shop[item_table] set item_icon = '' where id = '".addslashes($_POST['item_id'][$k])."' ");

        }

    } else {

        // pass

    }

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>