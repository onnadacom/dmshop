<?
if (!defined('_DMSHOP_')) exit;

// layout 0
if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '0' || $layout_auto_set == '0') { ?>
</div>
</div>
<div class="layout_bottom"><div class="layout_bottom_bg"></div><? include_once("$dmshop_bottom_path/bottom.php"); ?></div>
<?
}

// layout 1
else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '1' || $layout_auto_set == '1') { ?>
</div>
<div class="layout_left"><? include_once("$dmshop_menu_path/menu.php"); ?></div>
</div>
<div class="layout_bottom"><div class="layout_bottom_bg"></div><? include_once("$dmshop_bottom_path/bottom.php"); ?></div>
<?
}

// layout 2
else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '2' || $layout_auto_set == '2') { ?>
</div>
</div>
<div class="layout_bottom"><div class="layout_bottom_bg"></div><? include_once("$dmshop_bottom_path/bottom.php"); ?></div>
<?
}

// layout 3
else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '3' || $layout_auto_set == '3') { ?>
<div class="layout_bottom"><div class="layout_bottom_bg"></div><? include_once("$dmshop_bottom_path/bottom.php"); ?></div>
</div>
</div>
<?
}

// layout 4
else if (!$layout_auto_set && $dmshop_design[$layout_column.'_layout'] == '4' || $layout_auto_set == '4') { ?>
<div class="layout_bottom"><div class="layout_bottom_bg"></div><? include_once("$dmshop_bottom_path/bottom.php"); ?></div>
</div>
<div class="layout_left"><? include_once("$dmshop_menu_path/menu.php"); ?></div>
</div>
<? } ?>

<script type="text/javascript">
$(document).ready( function() {

    $(window).resize(function() {

        $('.layout_bottom_bg').css( { 'left': -($('.layout_bottom').offset().left)+'px', 'width': $(window).width()+'px' } );

    });

    $('.layout_bottom_bg').css( { 'left': -($('.layout_bottom').offset().left)+'px', 'width': $(window).width()+'px', 'height': $('.layout_bottom').height()+'px' } );

});
</script>