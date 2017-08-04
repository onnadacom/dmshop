<?php
include_once("./_dmshop.php");
if ($group_id) { $group_id = preg_match("/^[a-zA-Z0-9_\-]+$/", $group_id) ? $group_id : ""; }

// 폼 체크
if (!$_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($dmshop_user['datetime'] != $_POST['form_check']) {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

// 등록
if ($m == '') {

    if (!$group_id) {

        alert("그룹명이 입력되지 않았거나 사용할 수 없는 그룹명입니다.");

    }

    $dmshop_banner_group = shop_banner_group($group_id);

    if ($dmshop_banner_group['group_id']) {

        alert("이미 등록된 그룹명입니다.");

    }

    // 등록
    sql_query(" insert into $shop[banner_group_table] set group_id = '".$group_id."', datetime = '".$shop['time_ymdhis']."' ");

}

// 삭제
else if ($m == 'd') {

    if (!$group_id) {

        alert("이미 삭제되었거나 존재하지 않습니다.");

    }

    $dmshop_banner_group = shop_banner_group($group_id);

    if (!$dmshop_banner_group['group_id']) {

        alert("이미 삭제되었거나 존재하지 않습니다.");

    }

    // 그룹 삭제
    sql_query(" delete from $shop[banner_group_table] where group_id = '".$group_id."' ");

    // 메인중앙 배너그룹 초기화
    sql_query(" update $shop[display_box_list_table] set banner = '' where banner = '".$group_id."' ");

    // 디자인TOP 배너그룹 초기화
    sql_query(" update $shop[design_top_table] set top_banner1_group = '' where top_banner1_group = '".$group_id."' ");
    sql_query(" update $shop[design_top_table] set top_banner2_group = '' where top_banner2_group = '".$group_id."' ");

    // 디자인MENU 배너그룹 초기화
    sql_query(" update $shop[design_menu_table] set menu_banner_group = '' where menu_banner_group = '".$group_id."' ");

}

// 선택 삭제
else if ($m == 'check_delete') {

    for ($i=0; $i<count($chk_id); $i++) {

        // 실제 번호를 넘김
        $k = $chk_id[$i];

        // 그룹 삭제
        sql_query(" delete from $shop[banner_group_table] where group_id = '".$group_id[$k]."' ");

        // 메인중앙 배너그룹 초기화
        sql_query(" update $shop[display_box_list_table] set banner = '' where banner = '".$group_id[$k]."' ");

        // 디자인TOP 배너그룹 초기화
        sql_query(" update $shop[design_top_table] set top_banner1_group = '' where top_banner1_group = '".$group_id[$k]."' ");
        sql_query(" update $shop[design_top_table] set top_banner2_group = '' where top_banner2_group = '".$group_id[$k]."' ");

        // 디자인MENU 배너그룹 초기화
        sql_query(" update $shop[design_menu_table] set menu_banner_group = '' where menu_banner_group = '".$group_id[$k]."' ");

    }

} else {

    alert("요청하신 서비스를 찾을 수 없습니다.\\n\\n확인하신 후 다시 이용하시기 바랍니다.");

}

if ($url) {

    $urlencode = urldecode($url);

} else {

    $urlencode = urldecode($_SERVER[REQUEST_URI]);

}

shop_url($urlencode);
?>