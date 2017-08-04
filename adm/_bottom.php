<?
if (!defined('_DMSHOP_')) exit;
?>
    </td>
</tr>
</table>
</div>

<script type="text/javascript">
$(document).ready(function() {

    var body = $(document);
    var h = body.height() - $(".top_menu").height();

    $(".contents").css( { 'height': h+'px'} );

});
</script>

<?
include_once("$shop[path]/shop.bottom.php");
?>