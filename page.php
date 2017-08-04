<?
include_once("./_dmshop.php");

if ($page_id) { $page_id = preg_match("/^[a-zA-Z0-9_]+$/", $page_id) ? $page_id : ""; }

if (!$page_id) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 페이지입니다.</p>", "b");

}

$dmshop_page = shop_page($page_id);

if (!$dmshop_page['page_id']) {

    message("<p class='title'>알림</p><p class='text'>존재하지 않는 페이지입니다.</p>", "b");

}

if (!$dmshop_page['page_view']) {

    message("<p class='title'>알림</p><p class='text'>접근할 수 없는 페이지입니다.</p>", "b");

}

$ss_name = "page_view_".$page_id;

if (!shop_get_session($ss_name)) {

    shop_set_session($ss_name, true);

    // 조회수 증가
    sql_query(" update $shop[page_table] set page_hit = page_hit + 1 where page_id = '".$page_id."' ");

}

// 타이틀 제목
$shop['title'] = $dmshop['shop_name']." - ".$dmshop_page['page_title'];

// 페이지 아이디
$page_id = $page_id;

if ($dmshop_page['page_include_top']) { include($dmshop_page['page_include_top']); } else { include_once("./_top.php"); }

// 관리자 페이지 수정 버튼
if ($shop_user_admin) {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div style="border:1px solid #b4d9e0; background-color:#e2fdff; text-align:center; padding:4px 0 3px 0;"><a href="<?=$shop['path']?>/adm/page_write.php?m=u&page_id=<?=$page_id?>"><span style="font-weight:bold; line-height:14px; font-size:12px; color:#027d94; font-family:dotum,돋움;">관리자 권한으로 본 페이지를 수정 합니다.</span></a></div></td>
</tr>
<tr><td height="10"></td></tr>
</table>
<?
}

// top 이미지
$file = shop_design_file("page_top_".$page_id); if ($file['upload_file']) { echo "<div>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</div>"; }

// top 내용
if ($dmshop_page['page_text_top']) { echo "<div>".stripslashes($dmshop_page['page_text_top'])."</div>"; }

// 본문 내용
if ($dmshop_page['page_text_content']) { echo "<div>".stripslashes($dmshop_page['page_text_content'])."</div>"; }

// bottom 내용
if ($dmshop_page['page_text_bottom']) { echo "<div>".stripslashes($dmshop_page['page_text_bottom'])."</div>"; }

// bottom 이미지
$file = shop_design_file("page_bottom_".$page_id); if ($file['upload_file']) { echo "<div>".shop_file_view($shop['path']."/data/design/".shop_data_path("u", $file['datetime'])."/".$file['upload_file'], $file['upload_width'], $file['upload_height'])."</div>"; }

if ($dmshop_page['page_include_bottom']) { include($dmshop_page['page_include_bottom']); } else { include_once("./_bottom.php"); }
?>