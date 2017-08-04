<?
if (!defined('_DMSHOP_')) exit;
?>
<div style='clear:both; height:<?=(int)(($limit * 23) + 14);?>px;'>
<ul style='padding:7px 5px 7px 5px;'>
<?
for ($i=0; $i<count($list); $i++) {

    echo "<li style='clear:both; width:100%; height:23px;'><nobr style='display:block; overflow:hidden; width:100%;'>";
    echo "<img src='".$dmshop_article_path."/img/arrow.gif' style='margin:1px 6px 0 8px; vertical-align:middle;'>";
    echo "<a href='".$shop['path']."/board.php?bbs_id=".$bbs_id."&amp;article_id=".$list[$i]['id']."'>";

    if ($use_date) { echo "<span style='margin-right:4px; line-height:23px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;'>[".date("m-d", strtotime($list[$i]['datetime']))."]</span>"; }
    if ($use_title) { echo "<span style='margin-right:4px; line-height:23px; font-size:11px; color:#555555; font-family:dotum,돋움;'>".filter1($list[$i]['ar_title'], 0, $title_len)."</span>"; }
    if ($use_reply && $list[$i]['ar_reply']) { echo "<span style='margin-right:4px; margin-right:4px; line-height:21px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;'>[".$list[$i]['ar_reply']."]</span>"; }
    if ($use_user) { echo "<span style='margin-right:4px; margin-right:4px; line-height:21px; font-size:11px; color:#9e9e9e; font-family:dotum,돋움;'>".$list[$i]['ar_name']."</span>"; }

    echo "</a>";
    echo "</nobr></li>";

}

if (count($list) == '0') { echo "<li><p style='margin-top:".(int)((($count - 1) * 23) / 2)."px; text-align:center; line-height:23px; font-size:11px; color:#555555; font-family:dotum,돋움;'>등록된 게시물이 없습니다.</p></li>"; }
?>
</ul>
</div>